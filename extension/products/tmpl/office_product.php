<link rel="stylesheet" href="/extension/products/office.css<?= $_SESSION['rand'] ?>">
<link href="/extension/products/office.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<script src="/assets/plugins/plyr/plyr.js?v=<?= rand() ?>"></script>
<link rel="stylesheet" href="/assets/plugins/plyr/css/plyr.min.css?v=<?= rand() ?>" />
<div class="office_block_top_main">
    <div class="office_block_top_left">
        <a href="#" onclick="window.history.go(-1); return false;" class="office_link_back">
            <i class="fas fa-arrow-left"></i>
        </a> 
        <div class="ml-3" style="float: left;font-size: 1.4rem;padding: 0.8rem 0;color: <?= $wares_info['category_color'] ?>;"><?= $wares_info['category_title'] ?></div>
    </div>
</div>
<div class="container-fluid" style="background-color: #FFFFFF;">
    <div class="row">
        <div class="col-12">
            <div class="row webinar_head_bg pt-3 pb-3">
                <div class="col-md-3 mb-3">
                    <div class="webinar_head_logo2 mb-2 text-center">
                        <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img mt-2"/>    
                    </div>
                </div>
                <div class="col-md-9 mb-3">
                    <div class="mb-3">
                        <div class="webinar_head_title" style="display: block;">
                            <?= $wares_info['title'] ?>
                        </div>
                    </div>
                    <div class="webinar_head_file2 mb-2">
                        <div>
                            <?
                            if (strlen($wares['url_file']) > 0) {
                                $file_type = array_reverse(explode('.', $wares['url_file']))[0];
                                if ($file_type == 'mp3') {
                                    $union_elm_id = $wares['id'];
                                    ?>
                                    <audio id="player_<?= $wares['id'] ?>" class="player_<?= $wares['id'] ?>" controls style="--plyr-color-main: #1ac266;"> 
                                        <source src="<?= $wares['url_file'] ?>" type="audio/mp3" />
                                    </audio>
                                    <script>
                                        //const player = new Plyr('#player_<?= $wares['id'] ?>', {controls});
                                        const player<?= $union_elm_id ?> = new Plyr('#player_<?= $union_elm_id ?>', {controls, 'autopause': true});
                                        controls.remove('download');

                                        /*
                                         * Оповещение если ссылка на фаил не верная 
                                         */
                                        $("#mp3_<?= $union_elm_id ?>").on("error", function (e) {

                                            const player<?= $union_elm_id ?> = new Plyr('#player_<?= $union_elm_id ?>', {controls, 'autopause': true});
                                            controls.remove('download');
                                            $("#mp3_<?= $union_elm_id ?>").on("error", function (e) {
                                                sendPostLigth('/jpost.php?extension=wares',
                                                        {
                                                            'error_message_material_file_source': 1,
                                                            'material_id': '<?= $wares['id'] ?>',
                                                            'material_file': '<?= $wares['url_file'] ?>',
                                                            'type': 'audio'
                                                        },
                                                        function (e) {
                                                        });
                                            });
                                        });

                                        player<?= $union_elm_id ?>.on('playing', event => {
                                            if (!!eplayer && eplayer != player<?= $union_elm_id ?>) {
                                                eplayer.pause();
                                            }
                                            eplayer = player<?= $union_elm_id ?>;
                                            const instance = event.detail.plyr;
                                            const players = Plyr.setup('.js-player');

                                        });
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
                    <div class="webinar_head_articul text-right mb-2">
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
                                <audio id="player_<?= $wares['id'] ?>" class="player_<?= $wares['id'] ?>" controls style="--plyr-color-main: #1ac266;"> 
                                    <source src="<?= $wares['url_file'] ?>" type="audio/mp3" />
                                </audio>
                                <script>
                                    const player = new Plyr('#player_<?= $wares['id'] ?>', {controls});
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
    </div>

    <div class="row">
        <div class="col-12">
            <div class="">
                <?
                $video_i = 0;
                /*
                 * Уроки без серии
                 */
                if (count($materials) > 0) {
                    foreach ($materials as $key => $value) {
                        if ($value['series_id'] == '0') {
                            $video_i++;
                            $union_elm_id = mt_rand(100000, 999999) . $value['id'];
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
                                            ?>
                                            <div class="">
                                                <?
                                                include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_video.php';
                                                $video_id = $value['id'];
                                                ?>
                                                <script>
                                                    var see_video_id = <?= $video_id ?>;
                                                    $(document).ready(function () {
                                                        $(".see_video_<?= $video_id ?>").unbind('click').click(function () {
                                                            //console.log("material_video_youtube mouseenter");
                                                            sendPostLigth('/jpost.php?extension=wares',
                                                                    {"waresVideoSee": see_video_id},
                                                                    function (e) {
                                                                    });
                                                        });
                                                    });
                                                </script>
                                            </div>
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

                //print_r($series);
                if (count($series) > 0) {
                    foreach ($series as $series_value) {
                        ?>
                        <hr/>
                        <div class="h3"><?= $series_value['title'] ?></div>
                        <?
                        if ($series_value['series_enable'] == 1) {
                            foreach ($materials as $key => $value) {
                                if ($value['series_id'] == $series_value['id']) {
                                    $video_i++;
                                    $union_elm_id = mt_rand(100000, 999999) . $value['id'];
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
                                                            $(".see_video_<?= $video_id ?>").unbind('click').click(function () {
                                                                //console.log("material_video_youtube mouseenter");
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
                        }
                        ?>

                        <?
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>
<script>
    var video_id = '<?= $video_id ?>';
    $(document).ready(function () {

//        var player = new Calamansi(document.querySelector('#player'), {
//            skin: 'path/to/skins/skin-folder'
//        });
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
