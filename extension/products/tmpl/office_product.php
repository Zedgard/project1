<link rel="stylesheet" href="/extension/products/office.css<?= $_SESSION['rand'] ?>">
<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css">
<script src="/assets/plugins/calamansi/calamansi.min.js"></script>
<div class="row" style="background-color: #FFFFFF;">
    <div class="col-lg-12">
        <div class="card1 card-default1">
            <div class="mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="office_block_top_main">
                            <div class="office_block_top_left">
                                <a href="/office/?katalog" class="office_link_back">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                            <div class="webinar_head_title2"><?= $wares_info['title'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="row webinar_head_bg pt-3 pb-3" style="margin-top: 60px;">
                    <div class="col-md-3">
                        <div class="webinar_head_logo2 mb-2 text-center">
                            <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img mt-2"/>    
                        </div>
                    </div>
                    <div class="col-md-9 p-5">
                        <div class="webinar_head_title2 mb-4" style="display: none;">
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
                        <div class="webinar_head_articul mb-3">
                            Артикул: <span><?= $wares_info['articul'] ?></span>
                        </div>
                        <div class="wares_info_descr ulli">
                            <?= $wares_info['descr'] ?>
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

            <div class="row">
                <div class="col-12">
                    <div class="">
                        <?
                        $video_i = 0;
                        /*
                         * Уроки без серии
                         */
                        foreach ($materials as $key => $value) {
                            if ($value['series_id'] == '0') {
                                $video_i++;
                                ?>
                                <div class="material_info series_<?= $value['series_id'] ?>" style="display: block;">
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <?
                                            if ($value['material_type'] == 'material_type_text') {
                                                include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_text.php';
                                            }
                                            if ($value['material_type'] == 'material_type_audio') {
                                                include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_audio.php';
                                            }
                                            if ($value['material_type'] == 'material_type_file') {
                                                include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_file.php';
                                            }
                                            if ($value['material_type'] == 'material_type_video') {
                                                include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_video.php';
                                                $video_id = $value['id'];
                                                ?>
                                                <script>
                                                    var see_video_id = <?= $video_id ?>;
                                                    $(document).ready(function () {
                                                        $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                            console.log("material_video_youtube mouseenter");
                                                            sendPostLigth('/jpost.php?extension=wares',
                                                                    {"waresVideoSee": see_video_id},
                                                                    function (e) {
                                                                    });
                                                        });
                                                    });
                                                </script>
                                                <?
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?
                            }
                        }

                        //print_r($series);
                        foreach ($series as $series_value) {
                            ?>
                            <hr/>
                            <div class="h3"><?= $series_value['title'] ?></div>
                            <?
                            if ($series_value['series_enable'] == 1) {
                                foreach ($materials as $key => $value) {
                                    if ($value['series_id'] == $series_value['id']) {
                                        $video_i++;
                                        ?>
                                        <div class="material_info series_<?= $value['series_id'] ?>" style="display: block;">
                                            <div class="row mt-2 mb-2">
                                                <div class="col-12">
                                                    <?
                                                    if ($value['material_type'] == 'material_type_text') {
                                                        include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_text.php';
                                                    }
                                                    if ($value['material_type'] == 'material_type_audio') {
                                                        include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_audio.php';
                                                    }
                                                    if ($value['material_type'] == 'material_type_file') {
                                                        include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_file.php';
                                                    }
                                                    if ($value['material_type'] == 'material_type_video') {
                                                        include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_video.php';
                                                        $video_id = $value['id'];
                                                        //echo "video_id: {$video_id}<br/>\n";
                                                        ?>
                                                        <script>
                                                            var see_video_id = <?= $video_id ?>;
                                                            $(document).ready(function () {
                                                                $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                                    sendPostLigth('/jpost.php?extension=wares', {"waresVideoSee": see_video_id}, function (e) {});
                                                                });
                                                            });
                                                        </script>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?
                                    }
                                }
                            }
                            ?>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <hr/>

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
