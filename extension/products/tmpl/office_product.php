<link rel="stylesheet" href="/extension/products/office.css<?= $_SESSION['rand'] ?>">
<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css">
<script src="/assets/plugins/calamansi/calamansi.min.js"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="card1 card-default1">
            <div class="mb-4">
                <div class="row webinar_head_bg pt-3 pb-3">
                    <div class="col-md-3">
                        <div class="webinar_head_logo2 mb-2 text-center">
                            <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img mt-2"/>    
                        </div>
                    </div>
                    <div class="col-md-9 p-5">
                        <div class="webinar_head_title2 mb-4">
                            <div class="h2"><?= $wares_info['title'] ?></div>
                        </div>
                        <div class="webinar_head_file2 mb-3">
                            <div>
                                <?
                                if (strlen($wares['url_file']) > 0) {
                                    $file_type = array_reverse(explode('.', $wares['url_file']))[0];
                                    if ($file_type == 'mp3') {
                                        ?>

                                        <div class="player-block float-left">
                                            <div id="calamansi-player-<?= $wares['id'] ?>">
                                                Загрузка плеера... 
                                            </div>
                                        </div>
                                        <script>
                                            Calamansi.autoload();
                                            // document.getElementById('full-demo-player')
                                            //document.querySelector('#calamansi-player-<?= $wares['id'] ?>')
                                            new Calamansi(
                                                    document.querySelector('#calamansi-player-<?= $wares['id'] ?>'), {
                                                skin: '/assets/plugins/calamansi/skins/basic_download2',
                                                playlists: {
                                                    'Classics': [
                                                        {
                                                            source: '<?= $wares['url_file'] ?>',
                                                        }
                                                    ],
                                                },
                                                defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
                                            });
                                            //player.destroy();
                                        </script>
                                        <div style="clear: both;height: 1rem;"></div>
                                        <?
                                    } else {
                                        ?>
                                        <a href="<?= $wares['url_file'] ?>" target="_blank" class="btn btn-primary">Скачать файлы</a>
                                        <?
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="webinar_head_articul">
                            Артикул: <span><?= $wares_info['articul'] ?></span>
                        </div>
                    </div>
                </div>

                <?
                if (strlen($wares_info['images']) > 0):
                    ?>
                    <div class="webinar_head_logo" style="display: none;">
                        <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img"/>    
                    </div>
                    <div class="webinar_head_title" style="display: none;">
                        <?= $wares_info['title'] ?>
                    </div>
                    <div class="webinar_head_articul" style="display: none;">
                        Артикул: <span><?= $wares_info['articul'] ?></span>
                    </div>
                    <div class="webinar_head_file" style="display: none;">
                        <div class="mt-2">
                            <?
                            if (strlen($wares['url_file']) > 0) {
                                $file_type = array_reverse(explode('.', $wares['url_file']))[0];
                                if ($file_type == 'mp3') {
                                    ?>

                                    <div class="player-block float-left">
                                        <div id="calamansi-player-<?= $wares['id'] ?>">
                                            Загрузка плеера... 
                                        </div>
                                    </div>
                                    <script>
                                        Calamansi.autoload();
                                        // document.getElementById('full-demo-player')
                                        //document.querySelector('#calamansi-player-<?= $wares['id'] ?>')
                                        new Calamansi(
                                                document.querySelector('#calamansi-player-<?= $wares['id'] ?>'), {
                                            skin: '/assets/plugins/calamansi/skins/basic_download2',
                                            playlists: {
                                                'Classics': [
                                                    {
                                                        source: '<?= $wares['url_file'] ?>',
                                                    }
                                                ],
                                            },
                                            defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
                                        });
                                        //player.destroy();
                                    </script>
                                    <div style="clear: both;height: 1rem;"></div>
                                    <?
                                } else {
                                    ?>
                                    <a href="<?= $wares['url_file'] ?>" target="_blank" class="btn btn-primary">Скачать файлы</a>
                                    <?
                                }
                            }
                            ?>
                        </div>
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
                    <div class="col-12 wares_info_descr ulli">
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
        var video_id = '<?= $video_id ?>';
        $(document).ready(function () {

            var player = new Calamansi(document.querySelector('#player'), {
                skin: 'path/to/skins/skin-folder'
            });
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
