<div class="row">
    <div class="col-lg-12">
        <div class="card1 card-default1">
            <style>
                .webinar_head_bg{
                    background: linear-gradient(140deg, #63A7D6, #0BC496);
                    background-position: center;
                    background-size: cover;
                    width: 100%;
                    height: 35vh;
                }
                .webinar_head_logo{
                    text-align: center;
                    background-color: #e3e3e3;
                    position: absolute;
                    margin-left: 5vw;
                    margin-top: 6vh;
                    z-index: 9;
                }
                .webinar_head_title{
                    text-align: left;
                    position: absolute;
                    margin-left: 23vw;
                    color: #FFFFFF;
                    font-size: 2rem;
                    margin-top: 6vh;
                    z-index: 9;
                }
                .webinar_head_file{
                    text-align: left;
                    position: absolute;
                    margin-left: 23vw;
                    color: #FFFFFF;
                    font-size: 2rem;
                    margin-top: 24vh;
                    z-index: 9;
                }
                .webinar_head_logo_img{
                    padding: 0.25rem;
                    background-color: #e3e3e3;
                    border: 1px solid #dee2e6;
                    max-height: 36vh;
                    max-width: 16vw;
                }

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
                .accordion .card .card-header button:after{
                    font-size: 3rem;
                    color: #000000;
                }
                .accordion .card-header .btn[aria-expanded="true"], .accordion .card-header a[aria-expanded="true"]{
                    color: #000000;
                }
                .accordion .card-header .btn[aria-expanded="true"]:after, .accordion .card-header a[aria-expanded="true"]:after{
                    color: #000000;
                }
                .series_block_main{
                    width: 90%;
                    margin: 0 auto;
                }
                .btn_serial_video{
                    background-color: #C9C9C9;
                    color: #FFFFFF;
                }
                .series_series_btn{
                    text-align: left;
                    border: 1px solid #C9C9C9;
                    width: 100%;
                    margin: 0 auto;
                    font-size: 1.5rem;
                }

            </style>

            <div class="mb-4 webinar_head_bg">
                <?
                if (strlen($wares_info['images']) > 0):
                    ?>
                    <div class="webinar_head_logo">
                        <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img"/>    
                    </div>
                    <div class="webinar_head_title">
                        <?= $wares_info['title'] ?>
                    </div>
                    <div class="webinar_head_file">
                        <?
                        if (strlen($wares['url_file']) > 0) {
                            ?>
                            <a href="<?= $wares['url_file'] ?>" class="btn btn-primary">Скачать файлы</a>
                            <?
                        }
                        ?>
                    </div>
                    <?
                endif;
                ?>
            </div>
            <br/>
            <div class="card-header1 card-header-border-bottom1" style="display: none;">
                <h2 class="col-lg-12"><span class="float-left"><?= $wares['title'] ?></span> <span class="float-right"><?= $wares['articul'] ?></span></h2>
            </div>

            <div style="height: 10px;"></div>
            <div class="series_block_main">
                <div class="row mb-5 clearfix">
                    <div class="col-12">
                        <?= $wares_info['descr'] ?>
                    </div>
                </div>
            </div>
            <div class="series_block_main">
                <?
                /*
                 * Если указана серия уроков
                 */
                foreach ($series as $series_key => $series_value) {
                    ?>
                    <div id="accordion<?= $series_value['id'] ?>" class="accordion accordion-bordered">
                        <div class="card">
                            <div class="card-header" id="heading<?= $series_value['id'] ?>">
                                <button class="btn collapsed btn_serial_video" video_id="<?= $series_value['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $series_value['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $series_value['id'] ?>">
                                    <h3>
                                        <?= $series_value['title'] ?>
                                    </h3> 
                                </button>
                            </div>

                            <div id="collapse<?= $series_value['id'] ?>" class="collapse" aria-labelledby="heading<?= $series_value['id'] ?>" data-parent="#accordion<?= $series_value['id'] ?>" style="">
                                <div class="card-body">
                                    <?
                                    $i = 0;
                                    foreach ($video_materials as $key => $material_val) {
                                        $show = '';
                                        $expanded = 'false';
                                        $collapsed = 'collapsed';
//                                        if ($i == 0) {
//                                            $show = 'show';
//                                            $expanded = 'true';
//                                            $collapsed = '';
//                                            $video_id = $material_val['id'];
//                                        }
                                        $i++;
                                        ?>
                                        <div class="card1">
                                            <div class="card-header1" id="heading<?= $i ?>">
                                                <button class="btn btn-link series_series_btn btn_video_see <?= $collapsed ?>" video_id="<?= $material_val['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="<?= $expanded ?>" aria-controls="collapse<?= $i ?>">
                                                    <span class="float-left"><i class="far fa-play-circle"></i></span> <span class="ml-3 float-left"><?= $material_val['video_title'] ?></span> <span class="float-right"><?= $material_val['video_time'] ?></span>
                                                </button>
                                            </div>

                                            <div id="collapse<?= $i ?>" class="collapse <?= $show ?>" aria-labelledby="heading<?= $i ?>" data-parent="#accordion1">
                                                <div class="card-body1 video_see">
                                                    <div class="mt-3 mb-3"><?= $material_val['video_descr'] ?></div>
                                                    <div>
                                                        <?
                                                        if (strlen($material_val['video_youtube']) > 0) {
                                                            ?>
                                                            <div class="video_u_block_left"></div>
                                                            <div class="video_u_block_right"></div>
                                                            <iframe width="100%" height="415" allowfullscreen
                                                                    src="<?= $material_val['video_youtube'] ?>?autoplay=0&mute=0&loop=1&iv_load_policy=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0">
                                                            </iframe>

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
                                                </div>
                                            </div>
                                        </div>
                                        <?
                                    }
                                    ?>
                                </div>
                            </div>


                        </div>
                        <?
                    }
                    ?>


                    <div id="accordion1" class="mt-3 accordion accordion-bordered" style="display: none;">
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
                            <div class="card1">
                                <div class="card-header1" id="heading<?= $i ?>">
                                    <button class="btn btn-link btn_video_see <?= $collapsed ?>" video_id="<?= $material_val['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="<?= $expanded ?>" aria-controls="collapse<?= $i ?>">
                                        <h3><?= $material_val['video_title'] ?></h3>
                                    </button>
                                </div>

                                <div id="collapse<?= $i ?>" class="collapse <?= $show ?>" aria-labelledby="heading<?= $i ?>" data-parent="#accordion1">
                                    <div class="card-body1 video_see">
                                        <div class="mb-3"><?= $material_val['video_descr'] ?></div>
                                        <div>
                                            <?
                                            if (strlen($material_val['video_youtube']) > 0) {
                                                ?>
                                                <div class="video_u_block_left"></div>
                                                <div class="video_u_block_right"></div>
                                                <iframe width="100%" height="415" allowfullscreen
                                                        src="<?= $material_val['video_youtube'] ?>?autoplay=0&mute=0&loop=1&iv_load_policy=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0">
                                                </iframe>

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
                                    </div>
                                </div>
                            </div>
                            <?
                        }
                        ?>

                    </div>

                    <div style="height: 20px;"></div>
                    <div class="form-footer p-4  border-top">
                        <div style="height: 10px;"></div>
                        <a href="./" class="btn btn-secondary">назад</a>
                    </div>

                </div> 
            </div>
        </div>
    </div>
    <script>
        var video_id = <?= $video_id ?>;
        $(document).ready(function () {
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

        });
    </script>
