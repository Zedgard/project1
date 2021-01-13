<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <style>
                    .video_u_block_left{
                        width: 300px;
                        height: 100px;
                        position: absolute;
                        z-index: 9;
                    }
                    .video_u_block_right{
                        float: right;
                        width: 300px;
                        height: 100px;
                        margin-bottom: -100px;
                        position: relative;
                        z-index: 9;
                    }
                </style>
                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-12"><span class="float-left"><?= $wares['title'] ?></span> <span class="float-right"><?= $wares['articul'] ?></span></h2>
                </div>

                <div class="card-body">

                    <?
                    if (strlen($wares['url_file']) > 0) {
                        ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="text-center"><img src="<?= $wares['images'] ?>" class="w-100" style="max-width: 300px;"/></div>
                            </div>
                            <div class="col-lg-9">
                                <a href="<?= $wares['url_file'] ?>" class="btn btn-primary">Скачать файлы</a>
                            </div>
                        </div>
                        <?
                    }
                    ?>
                    <?
                    //unset($_SESSION['wares_video_see']);
                    //print_r($_SESSION['wares_video_see'])
                    // <div id="accordion1" class="accordion accordion-bordered">
                    ?>

                    <?
                    $i = 0;
                    foreach ($video_materials as $key => $material_val) {
                        $show = '';
                        $expanded = 'false';
                        $collapsed = 'collapsed';
                        if ($i == 0) {
                            $show = 'show';
                            $expanded = 'true';
                            $collapsed = '';
                            $video_id = $material_val['id'];
                        }
                        $i++;
                        ?>
                        <div class="webinar_card">
                            <h3 class="mb-3"><?= $material_val['video_title'] ?></h3>
                            <div class="card-header" id="heading<?= $i ?>" style="display: none;">
                                <button class="btn btn-link btn_video_see <?= $collapsed ?>" video_id="<?= $material_val['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="<?= $expanded ?>" aria-controls="collapse<?= $i ?>">
                                    <h3><?= $material_val['video_title'] ?></h3>
                                </button>
                            </div>

                            <div id="collapse<?= $i ?>" class="collapse <?= $show ?>" aria-labelledby="heading<?= $i ?>" data-parent="#accordion1">
                                <div class="webinar_card-body video_see">

                                    <div class="row">
                                        <?
                                        if (strlen($material_val['video_youtube']) > 0) {
                                            $video_youtube_ip = '';
                                            $str_repl = str_replace('https://', '', $material_val['video_youtube']);
                                            $video_youtube_ip = array_reverse(explode('/', $str_repl))[0];
                                            ?>
                                            <div class="col-xxl-9">
                                                <div class="video_u_block_left"></div>
                                                <div class="video_u_block_right"></div>
                                                <div id="player_youtube"></div>
                                                <script>
                                                    // 2. This code loads the IFrame Player API code asynchronously.
                                                    var tag = document.createElement('script');

                                                    tag.src = "https://www.youtube.com/iframe_api";
                                                    var firstScriptTag = document.getElementsByTagName('script')[0];
                                                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                                                    // 3. This function creates an <iframe> (and YouTube player)
                                                    //    after the API code downloads.
                                                    var player;

                                                    var playerConfig = {}, // Define the player config here
                                                            queue = {// To queue a function and invoke when player is ready
                                                                content: null,
                                                                push: function (fn) {
                                                                    this.content = fn;
                                                                },
                                                                pop: function () {
                                                                    this.content.call();
                                                                    this.content = null;
                                                                }
                                                            },
                                                            player;

                                                    function onYouTubeIframeAPIReady() {
                                                        player = new YT.Player('player_youtube', {
                                                            height: '415',
                                                            width: '100%',
                                                            videoId: '<?= $video_youtube_ip ?>',
                                                            playerVars: {'autoplay': 1,
                                                                'mute': 1,
                                                                'loop': 1, 'iv_load_policy': 0,
                                                                'rel': 0,
                                                                'modestbranding': 1,
                                                                'disablekb': 1,
                                                                'showinfo': 0,
                                                                'iv_load_policy': 3,
                                                                wmode: "opaque"},
                                                            events: {
                                                                'onReady': onPlayerReady,
                                                                'onStateChange': onPlayerStateChange
                                                            }
                                                        });
                                                    }

                                                    // 4. The API will call this function when the video player is ready.
                                                    function onPlayerReady(event) {

                                                       // $("#player_youtube").find('.ytp-contextmenu').remove();

                                                       
                                                        //                                                        event.target.setVolume(100);
                                                        //
                                                        //                                                        setTimeout(function () {
                                                        //                                                            $(popup).css('display', 'none');
                                                        //                                                        }, 500);
                                                        //                                                        console.log(event.target);
                                                        //                                                        console.log($(event.target)[0].o);
                                                        //                                                        setTimeout(function () {
                                                        //                                                            if (event.target.isMuted()) {
                                                        //                                                                event.target.unMute();
                                                        //                                                                console.log('isMuted');
                                                        //                                                            }
                                                        //                                                        }, 1000);
                                                        //                                                        setInterval(function () {
                                                        //                                                            $('.ytp-contextmenu').remove();
                                                        //                                                        }, 500);
                                                    }

                                                    // Helper function to check if the player is ready
                                                    function isPlayerReady(player) {
                                                        return player && typeof player.playVideo === 'function';
                                                    }

                                                    // Instead of calling player.playVideo() directly, 
                                                    // using this function to play the video. 
                                                    // If the player is not ready, queue player.playVideo() and invoke it when the player is ready
                                                    function playVideo(player) {
                                                        isPlayerReady(player) ? player.playVideo() : queue.push(function () {
                                                            player.playVideo();
                                                        });
                                                    }

                                                    // 5. The API calls this function when the player's state changes.
                                                    //    The function indicates that when playing a video (state=1),
                                                    //    the player should play for six seconds and then stop.
                                                    var done = false;
                                                    function onPlayerStateChange(event) {
                                                        if (event.data == YT.PlayerState.PLAYING && !done) {
                                                            setTimeout(stopVideo, 6000);
                                                            done = true;
                                                        }
                                                    }
                                                    function stopVideo() {
                                                        player.stopVideo();
                                                    }
                                                </script>


                                            </div>
                                            <div class="col-xxl-3">
                                                <?
                                                /*
                                                  <iframe width="100%" height="415"
                                                  src="<?= $material_val['video_youtube'] ?>?autoplay=1&mute=1&loop=1&iv_load_policy=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0" frameborder="0" allow="autoplay" allowfullscreen oncontextmenu="return false;">
                                                  </iframe>
                                                 */
                                                $chat->chat_show();
                                                ?>
                                            </div>
                                            <?
                                            /*
                                             * <iframe class="video_see" width="100%" height="415" allowfullscreen
                                              src="<?= $material_val['video_youtube'] ?>?autoplay=0&mute=0&loop=1&iv_load_policy=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0">
                                              </iframe>
                                             */
                                            // https://www.youtube.com/watch?v=hPXX4vzw0kk&feature=youtu.be
                                            // ?controls=1&disablekb=0&iv_load_policy=0&mute=0&loop=1&enablejsapi=0&autoplay=0&modestbranding=0&rel=0&showinfo=0
                                        } else {
                                            ?>
                                            <video class="d-block w-100" video_id="<?= $material_val['id'] ?>" data-holder-rendered="true" preload="auto" controlsList="nodownload" controls loop>
                                                <source src="<?= $material_val['video_mp4'] ?>" type="video/mp4">
                                                <source src="<?= $material_val['video_ogv'] ?>" type="video/webm"> 
                                                <source src="<?= $material_val['video_webm'] ?>" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>
                                            <?
                                        }
                                        ?>
                                    </div>
                                    <div class="mt-3"><?= $material_val['video_descr'] ?></div>
                                </div>
                            </div>
                        </div>

                        <?
                    }
                    // </div>
                    ?>


                </div>

                <div class="form-footer p-4  border-top ">
                    <a href="./" class="btn btn-secondary">назад</a>
                </div>

            </div> 
        </div>
    </div>
</div>

<script>
    var video_id = <?= $video_id ?>;
    $(document).ready(function () {


        $(".content").removeClass("content");
        $(".btn_video_see").click(function () {
            video_id = $(this).attr("video_id");
        });

        $(".video_see").mouseenter(function () {
            // waresVideoSee
            //var video_id = $(this).attr("video_id");
            sendPostLigth('/jpost.php?extension=wares',
                    {"waresVideoSee": video_id},
                    function (e) {
                    });
        });

        // После загрузки сворачиваем меню 
        setTimeout(function () {
            $("#sidebar-toggler").click();
        }, 2000);
    });
</script>
