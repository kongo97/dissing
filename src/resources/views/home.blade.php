<template>
  <v-card>
    <v-card-text>

    <v-row>
        <v-col cols="12" md="1">
            <v-btn
                x-large
                color="#263238"
                dark
                @click="stopVideo"
                v-if="player"
            >
                STOP
            </v-btn>
        </v-col>

        <v-col cols="12" md="1">
            <v-btn
                x-large
                color="#263238"
                dark
                @click="playVideo"
                v-if="player"
            >
                PLAY
            </v-btn>
        </v-col>

        <v-col cols="12" md="1">
            <v-row>
                <v-layout column align-center>
                    <v-switch
                        v-model = 'words_enable'
                        label = 'Words'
                        @change = 'toggleWords'
                        v-if="words"
                    ></v-switch>
                </v-layout>
            </v-row>
        </v-col>

        <v-col cols="12" md="2">
            <v-slider
                style="margin-top: 10px;"
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

<template>
    <v-card id="word" v-if="words_enable" elevation="5">
        <v-card-text>
            <p>@{{ word }}</p>

            <v-progress-circular v-if="!word"
                :size="70"
                :width="7"
                color="#D32F2F"
                indeterminate
            ></v-progress-circular>
        </v-card-text>
    </v-card>
</template>


<v-btn
    id="next"
    x-large
    color="#D32F2F"
    dark
    @click="getBeat"
    v-if="beat"
>
    Next
</v-btn>
  
<!-- VUE -->
@section("vue")
<style>
    #word {
        margin-top: 100px;
        height: auto;
        padding: 100px;
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
        transform: scale(1);
        animation: pulse 5s infinite;
        margin-left: 20%;
        margin-right: 20%;
    }

    #word p {
        font-family: 'Nunito', sans-serif;
        font-weight: 800;
        text-align: center;
        font-size: 5rem;
        text-transform: uppercase;
        color: #263238;
    }

    #next {
        position: fixed;
        width: 80px;
        bottom: 50px;
        left: calc(50% - 40px);
        right: calc(50% - 40px);
    }

    .v-input--selection-controls.v-input {
        flex: 0 1 auto;
        margin-top: 10px;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }
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
            search: 'beat rap hard',
            player: null,
            list: false,
            timeout: 3,
            word: '',
            word_index: 0,
            max: 10,
            min: 1,
            beat: false,
            words_enable: false,
            words: false,
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
                    self.setWord(self.words[self.word_index].word);

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
                if (event.data == YT.PlayerState.PLAYING) {
                setTimeout(this.player.stopVideo, 6000);
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

            refreshWords(_words) {
                this.words = _words;
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

                if(this.player != null)
                {
                    this.stopVideo();
                    this.player.destroy();
                }
                
                this.player = null;

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

                    self.onYouTubeIframeAPIReady();
                });
            },

            getWords() {
                self = this;

                if(this.player != null)
                {
                    this.stopVideo();
                    this.player.destroy();
                }
                
                this.player = null;

                axios.post('/getWords', {})
                .then(function (response) 
                {
                    console.log('response', response);

                    // case error
                    if (response.data.result === false) {
                        return false;
                    } 

                    console.log('words', response.data);

                    words = response.data;

                    self.refreshWords(words);
                });
            },

            clear () {
                this.search = ''
            },
        },
        created: function(){
            this.getBeat();
            this.getWords();
        }
    })
  </script>
@endsection