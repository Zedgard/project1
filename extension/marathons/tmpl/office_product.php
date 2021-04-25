<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css<?= $_SESSION['rand'] ?>">
<script src="/assets/plugins/calamansi/calamansi.min.js<?= $_SESSION['rand'] ?>"></script>
<link href="/extension/marathons/css/marathons.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<div class="container-fluid">
    <!-- Большие экраны -->
    <div class="d-none d-lg-block">
        <div class="row">
            <div class="col-12" style="height: 10px;"></div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="marathons_wares_title">Прохождение марафона &laquo; <?= $wares['title'] ?> &raquo;</div>
                <div class="row mb-3">
                    <div class="col-6">
                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_green marathons_material_series_btn marathons_material_default marathons_material_series_active" series_id="0" style="background-color: #FFFFFF;color: #000000;">Общие материалы марафона</a>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_brown marathons_material_bonus">Бонус <i class="fas fa-lock"></i></a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <?
                        foreach ($series as $series_value) {
                            if ($series_value['series_enable'] == 1) {
                                ?>
                                <div class="row mb-1">
                                    <div class="col-11" style="margin: 0 auto;">
                                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_enable_day_green marathons_material_series_btn" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <?
                            } else {
                                ?>
                                <div class="row mb-1">
                                    <div class="col-11" style="margin: 0 auto;">
                                        <div class="marathons_not_btn marathons_btn_enable_day_lock" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?><i class="fas fa-lock"></i></div>
                                    </div>
                                </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-6 marathons_material_list_block">
                <div class="marathons_material_list_block_title">Общие материалы марафона</div>
                <div class="marathons_material_lists">
                    <?
                    $video_i = 0;

                    /*
                     * Уроки без серии
                     */
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
                                            include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_video.php';
                                            $video_id = $value['id'];
                                            ?>
                                            <script>
                                                var see_video_id = <?= $video_id ?>;
                                                $(document).ready(function () {


            //                                                    $(".content").removeClass("content");
            //                                                    $(".btn_video_see").click(function () {
            //                                                        video_id = $(this).attr("video_id");
            //                                                    });

                                                    $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                        console.log("material_video_youtube mouseenter");
                                                        // waresVideoSee
                                                        //var video_id = $(this).attr("video_id");
                                                        sendPostLigth('/jpost.php?extension=wares',
                                                                {"waresVideoSee": see_video_id},
                                                                function (e) {
                                                                });
                                                    });

                                                    // После загрузки сворачиваем меню 
            //                                                    setTimeout(function () {
            //                                                        $("#sidebar-toggler").click();
            //                                                    }, 2000);
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

                    foreach ($series as $series_value) {
                        if ($series_value['series_enable'] == 1) {
                            foreach ($materials as $key => $value) {
                                if ($value['series_id'] == $series_value['id']) {
                                    $video_i++;
                                    $union_elm_id = mt_rand(100000, 999999) . $value['id'];
                                    ?>
                                    <div class="material_info series_<?= $value['series_id'] ?>" style="display: none;">
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


                    //                                                    $(".content").removeClass("content");
                    //                                                    $(".btn_video_see").click(function () {
                    //                                                        video_id = $(this).attr("video_id");
                    //                                                    });

                                                            $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                                console.log("material_video_youtube mouseenter");
                                                                // waresVideoSee
                                                                //var video_id = $(this).attr("video_id");
                                                                sendPostLigth('/jpost.php?extension=wares',
                                                                        {"waresVideoSee": see_video_id},
                                                                        function (e) {
                                                                        });
                                                            });

                                                            // После загрузки сворачиваем меню 
                    //                                                    setTimeout(function () {
                    //                                                        $("#sidebar-toggler").click();
                    //                                                    }, 2000);
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
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



    <!------------------------------------ Мобильная версия ---------------------------------------------->
    <div class="d-lg-none">
        <div class="row">
            <div class="col-12" style="height: 10px;"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="marathons_wares_title">Прохождение марафона &laquo; <?= $wares['title'] ?> &raquo;</div>
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_green marathons_material_series_btn marathons_material_default marathons_material_series_active" series_id="0" style="background-color: #FFFFFF;color: #000000;">Общие материалы марафона</a>
                    </div>
                </div>
                <div class="col-12 mb-3 material_info series_0 marathons_material_list_block" style="display: block;">
                    <div class="marathons_material_list_block_title">Общие материалы марафона</div>
                    <div class="marathons_material_lists">
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
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_brown marathons_material_bonus">Бонус <i class="fas fa-lock"></i></a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <?
                        foreach ($series as $series_value) {
                            if ($series_value['series_enable'] == 1) {
                                ?>
                                <div class="row mb-1">
                                    <div class="col-12" style="margin: 0 auto;">
                                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_enable_day_green marathons_material_series_btn" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <?
                            } else {
                                ?>
                                <div class="row mb-1">
                                    <div class="col-12" style="margin: 0 auto;">
                                        <div class="marathons_not_btn marathons_btn_enable_day_lock" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?><i class="fas fa-lock"></i></div>
                                    </div>
                                </div>
                                <?
                            }
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <?
                                    if ($series_value['series_enable'] == 1) {
                                        foreach ($materials as $key => $value) {
                                            if ($value['series_id'] == $series_value['id']) {
                                                $video_i++;
                                                ?>
                                                <div class="mb-3 marathons_material_list_block material_info series_<?= $value['series_id'] ?>" style="display: none;">
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
                            </div>
                            <?
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".marathons_material_series_btn").unbind('click').click(function () {
        $(".material_info").hide();
        $(".marathons_material_series_btn").removeClass("marathons_material_series_active");
        $('.marathons_material_series_btn').removeAttr('style');
        var o = this;
        var title = $(o).html();
        var series_id = $(o).attr("series_id");
        $(o).addClass("marathons_material_series_active");
        $(o).css("background-color", "#ffffff");
        $(o).css("color", "#000000");
        if (series_id > 0) {
            $(".marathons_material_list_block_title").html("Список материалов «" + title.replace(/<\/?[^>]+(>|$)/g, "") + "»");
        } else {
            $(".marathons_material_list_block_title").html("Общие материалы марафона");
        }
        $(".series_" + series_id).show(200);
    });

</script>