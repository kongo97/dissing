<template>
  <v-card>
    <v-card-text>

    <v-row>
        <v-col cols="12" md="3">
            <v-btn
                x-large
                color="blue-grey"
                dark
                @click="onYouTubeIframeAPIReady"
                v-if="beat"
            >
                Start
            </v-btn>
        </v-col>

        <v-col cols="12" md="3">
            <v-row>
                <v-layout column align-center>
                    <v-switch
                        v-model = 'words_enable'
                        label = 'Words'
                        @change = 'toggleWords'
                    ></v-switch>
                </v-layout>
            </v-row>
        </v-col>

        <v-col cols="12" md="3">
            <v-slider
                v-model="timeout"
                step="1"
                thumb-label
                ticks
                label="timeout"
                :max="max"
                :min="min"
            ></v-slider>
        </v-col>
    </v-row>
    
    </v-card-text>
  </v-card>
</template>

<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
<div id="player" src="https://www.youtube.com/iframe_api" style="display: none;"></div>

<p id="word">@{{ word }}</p>

  
<!-- VUE -->
@section("vue")
<style>
    #word {
        position: absolute;
        left: 0;
        right: 0;
        height: 100px;
        top: calc(50% - 50px);
        font-family: 'Black Ops One';
        text-align: center;
        font-size: 3rem;
    }
</style>

<script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
</script>
  <script>
    var app = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data: {
            search: 'beat rap extrabeat',
            player: null,
            list: false,
            timeout: 3,
            word: '',
            word_index: 0,
            max: 10,
            min: 1,
            beat: false,
            words_enable: false,
            words: [
                'prova',
                'parola',
                'simone',
                'antonio',
                'cane',
                'pippo',
                'formaggio',
                'bomba'
            ],
        },
        methods: {
            onYouTubeIframeAPIReady() {
                this.player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: this.beat.id_youtube,
                    events: {
                    'onReady': this.onPlayerReady,
                    'onStateChange': this.onPlayerStateChange
                    }
                });
            },

            changeWord: function() {
                self = this;
                this.word_index++;
                const int = setInterval(() => {
                    self.setWord(self.words[self.word_index]);

                    clearInterval(int);

                    if(this.words_enable)
                        return self.changeWord();                    
                }, this.timeout*1000);
            },

            setWord(_word) {
                this.word = _word;
            },

            getRandomBeat() {
                min = Math.ceil(0);
                max = Math.floor(24);
                index = Math.floor(Math.random() * (max - min) + min);
                return this.list[index].id.videoId;
            },

            onPlayerReady(event) {
                event.target.playVideo();
            },

            onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
                }
            },

            stopVideo() {
                this.player.stopVideo();
            },

            playVideo() {
                this.player.playVideo();
            },

            refreshList(_list) {
                this.list = _list;
            },

            refreshBeat(_beat) {
                this.beat = _beat;
            },

            toggleWords() {
                if(this.words_enable)
                    this.changeWord();
            },

            getBeats() {
                self = this;

                axios.post('/search', {
                    search: self.search,
                })
                .then(function (response) 
                {
                    console.log('response', response);

                    // case error
                    if (response.data.result === false) {
                        return false;
                    } 

                    console.log('result', response.data);

                    list = response.data.items;

                    self.refreshList(list);
                });
            },

            getBeat() {
                self = this;

                axios.post('/getBeat', {})
                .then(function (response) 
                {
                    console.log('response', response);

                    // case error
                    if (response.data.result === false) {
                        return false;
                    } 

                    console.log('beat', response.data);

                    beat = response.data;

                    self.refreshBeat(beat);
                });
            },

            clear () {
                this.search = ''
            },
        },
        created: function(){
            this.getBeat();
        }
    })
  </script>
@endsection