<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
<div id="player" src="https://www.youtube.com/iframe_api"></div> 

  
<!-- VUE -->
@section("vue")
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
            search: 'freestyle beat',
            player: null,
            list: false,
        },
        methods: {
            onYouTubeIframeAPIReady() {
                this.player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: this.getRandomBeat(),
                    events: {
                    'onReady': this.onPlayerReady,
                    'onStateChange': this.onPlayerStateChange
                    }
                });
            },

            getRandomBeat() {
                min = Math.ceil(0);
                max = Math.floor(24);
                index = Math.floor(Math.random() * (max - min) + min);
                return this.list[index].id.videoId;
            },

            onPlayerReady(event) {
                //event.target.playVideo();
            },

            onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
                }
            },

            refreshList(_list) {
                this.list = _list;
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
            clear () {
                this.search = ''
            },
        },
        created: function(){
            this.getBeats();
        }
    })
  </script>
@endsection