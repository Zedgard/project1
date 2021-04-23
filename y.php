<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/plugins/video/css/videojs.css?v=<?= rand() ?>" rel="stylesheet">
    </head>
    <body oncontextmenu="return false;">

        <a href="<?= $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' .$_SERVER['SERVER_NAME'] ?>"><?= $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' .$_SERVER['SERVER_NAME'] ?></a>
        <br/><br/>
        <?
        print_r($_SERVER);
        ?>

        <video
            id="vid1"
            class="video-js vjs-default-skin h-100"
            controls
            autoplay
            style="width: 640px;min-height: 400px;"
            data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/embed/hPXX4vzw0k"}] }'
            >
        </video>
        <script src="/assets/plugins/jquery/jquery.js?v=<?= rand() ?>"></script>
        <script src="//vjs.zencdn.net/7.10.2/video.js"></script>
        <script src="/assets/plugins/video/Youtube.js?v=<?= rand() ?>"></script>
        <script>
            $(document).ready(function () {
                var options = {};
                var player = videojs('vid1', options, function onPlayerReady() {
                    // In this context, `this` is the player that was created by Video.js.
                    this.play();
                    // How about an event listener?
                    this.on('ended', function () {
                    });
                });
            });
        </script>
    </body>
</html>
