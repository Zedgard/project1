<!DOCTYPE html>
<html>
    <head>
        <script src="/assets/plugins/jquery/jquery.js?v=<?= rand() ?>"></script>
        <link href="/assets/plugins/video/css/videojs.css?v=<?= rand() ?>" rel="stylesheet">

        <script src="/assets/plugins/plyr/plyr.js?v=<?= rand() ?>"></script>
        <link rel="stylesheet" href="/assets/plugins/plyr/css/plyr.min.css?v=<?= rand() ?>" />
    </head>
    <body oncontextmenu="return false;">

        <div>
            <h1>Новый плеер</h1> 
            <div> 
                <div>аудио фаил</div>
                <audio id="player" class="player" controls style="--plyr-color-main: #1ac266;"> 
                    <source src="/assets/files/catalog/meditations/Meditatsiya-nachni-strojnet.mp3" type="audio/mp3" />
                </audio>
                <input type="button" value="play audio" class="play_audio" /> <input type="button" value="stop audio" class="stop_audio" />
                <br/>
                <div>видео фаил</div>
                <div style="width: 400px;">
                    <div id="player2" class="player" data-plyr-provider="youtube" data-plyr-embed-id="SbvxDPX34Xs" 
                         disableContextMenu="false"
                         hideControls="false"
                         resetOnEnd="true"
                         showinfo="0"
                         controls="0"
                         enablejsapi="1"
                         noCookie="false"
                         disablekb="1"
                         rel="0"
                         autoplay="0"
                         style="--plyr-color-main: #1ac266;"></div>
                </div>

                <script>
                    var p = '';
                    //controls.push('download');
                    const player = new Plyr('#player', {controls});
                    const player2 = new Plyr('#player2', {controls});
//                    document.addEventListener("contextmenu", function (e) {
//                        if (e.className === "player") {
//                            console.log(1111);
//                            //e.preventDefault();
//                        }
//                    }, false);




                    player.on('ready', event => {
                        const instance = event.detail.plyr;
                        p = instance;
                    });
//                    player2.on('ready', event => {
//                        const instance = event.detail.plyr;
//                        p = instance;
//                    });

                    $(".play_audio").click(function () {
                        console.log('play_audio');
                        p.play();
                    });
                    $(".stop_audio").click(function () {
                        console.log('stop_audio');
                        p.pause();
                    });

                </script>
            </div>
        </div>

    </body>
</html>
