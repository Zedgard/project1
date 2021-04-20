<div class="video_see">
    <div class="video_u_block_left"></div>
    <div class="video_u_block_right"></div>
    <video
        id="video_<?= $value['id'] ?>"
        class="video-js vjs-default-skin material_video_youtube"
        controls
        autoplay
        style="width: 50%;min-height: 400px;margin: 0 auto;"
        data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "<?= $value['video_youtube'] ?>"}] }'
        >
    </video>
    <script>
        $(document).ready(function () {
            var options = {};
            var player = videojs('video_<?= $value['id'] ?>', options, function onPlayerReady() {
                //this.play();
                this.on('ended', function () {
                });
            });
            player.src({src: '<?= $value['video_youtube'] ?>', type: 'video/youtube'});
        });
    </script>
</div> 
<?
/*
 * <iframe class="material_video_youtube" width="100%" height="415" allowfullscreen
            src="<?= $value['video_youtube'] ?>?autoplay=0&mute=0&loop=1&iv_load_policy=0&enablejsapi=1&controls=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0">
    </iframe>
 */