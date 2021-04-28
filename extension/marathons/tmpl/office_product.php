<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css<?= $_SESSION['rand'] ?>">
<script src="/assets/plugins/calamansi/calamansi.min.js<?= $_SESSION['rand'] ?>"></script>
<link href="/extension/marathons/css/marathons.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<input type="hidden" name="marathons_wares_id" value="<?= $_GET['wares_id'] ?>" class="marathons_wares_id" />
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
                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_brown marathons_material_bonus" style="<?= $bonus_btn_style ?>" bonus_material_id="<?= $bonus_material_id ?>">Бонус <?= $bonus_lock_content ?></a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <?
                        foreach ($series as $series_value) {
                            if ($series_value['series_enable'] == 1) {
                                if (mb_strtoupper($series_value['title']) == 'БОНУС') {
                                    continue;
                                }
                                ?>
                                <div class="row mb-1">
                                    <div class="col-11" style="margin: 0 auto;">
                                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_enable_day_green marathons_material_series_btn <?= $bonus_class ?>" style="<?= $bonus_style ?>" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?> <?= $g ?><i class="fas fa-plus"></i></a>
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
                            <div class="material_info series_<?= $value['series_id'] ?>" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>" style="display: block;">
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
                                                var see_video_id_<?= $video_id ?> = '<?= $video_id ?>';
                                                $(document).ready(function () {
                                                    $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                        //console.log("material_video_youtube mouseenter");
                                                        sendPostLigth('/jpost.php?extension=wares',
                                                                {"waresVideoSee": see_video_id_<?= $video_id ?>},
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
                    /*
                     * Уроки в Серии
                     */
                    foreach ($series as $series_value) {
                        $bonus_class = '';
                        $bonus_style = '';
                        $bonus_block = '';
                        if ($series_value['series_enable'] == 1) {
                            if (mb_strtoupper($series_value['title']) == 'БОНУС') {
                                $bonus_class = 'marathons_material_bonus_block';
                                $bonus_style = 'display:none;';
                                $bonus_block = '_bonus';
                            }
                            foreach ($materials as $key => $value) {
                                if ($value['series_id'] == $series_value['id']) {
                                    $video_i++;
                                    $union_elm_id = mt_rand(100000, 999999) . $value['id'];
                                    ?>
                                    <div class="material_info series_<?= $value['series_id'] ?>" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>" style="display: none;">
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
                                                        var see_video_id_<?= $video_id ?> = '<?= $video_id ?>';
                                                        $(document).ready(function () {
                                                            $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                                //console.log("material_video_youtube mouseenter");
                                                                sendPostLigth('/jpost.php?extension=wares',
                                                                        {"waresVideoSee": see_video_id_<?= $video_id ?>},
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
                                $union_elm_id = mt_rand(100000, 999999) . $value['id'];
                                ?>
                                <div class="material_info series_<?= $value['series_id'] ?>" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>" style="display: block;">
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
                                                    var see_video_id_<?= $video_id ?> = '<?= $video_id ?>';
                                                    $(document).ready(function () {
                                                        $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                            //console.log("material_video_youtube mouseenter");
                                                            sendPostLigth('/jpost.php?extension=wares',
                                                                    {"waresVideoSee": see_video_id_<?= $video_id ?>},
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
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_brown marathons_material_bonus" style="<?= $bonus_btn_style ?>" bonus_material_id="<?= $bonus_material_id ?>">Бонус <?= $bonus_lock_content ?></a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <?
                        foreach ($series as $series_value) {
                            if ($series_value['series_enable'] == 1) {
                                $bonus_class = '';
                                $bonus_style = '';
                                if (mb_strtoupper($series_value['title']) == 'БОНУС') {
                                    $bonus_class = 'marathons_material_bonus_block';
                                    $bonus_style = 'display:none;';
                                }
                                ?>
                                <div class="row mb-1">
                                    <div class="col-12" style="margin: 0 auto;">
                                        <a href="javascript:void(0)" class="marathons_btn marathons_btn_enable_day_green marathons_material_series_btn <?= $bonus_class ?>" style="<?= $bonus_style ?>" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?><i class="fas fa-plus"></i></a>
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
                                        $bonus_class = '';
                                        $bonus_style = '';
                                        $bonus_block = '';
                                        if (mb_strtoupper($series_value['title']) == 'БОНУС') {
                                            $bonus_class = 'marathons_material_bonus_block';
                                            $bonus_style = 'display:none;';
                                            $bonus_block = '_bonus';
                                        }
                                        foreach ($materials as $key => $value) {
                                            if ($value['series_id'] == $series_value['id']) {
                                                $video_i++;
                                                $union_elm_id = mt_rand(100000, 999999) . $value['id'];
                                                ?>
                                                <div class="mb-3 marathons_material_list_block material_info series_<?= $value['series_id'] ?>" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>" style="display: none;">
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
                                                                    var see_video_id_<?= $video_id ?> = '<?= $video_id ?>';
                                                                    $(document).ready(function () {
                                                                        $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                                                                            //console.log("material_video_youtube mouseenter");
                                                                            sendPostLigth('/jpost.php?extension=wares',
                                                                                    {"waresVideoSee": see_video_id_<?= $video_id ?>},
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
    var bonus_lock = '<?= $bonus_lock ?>';
    $(document).ready(function () {

        $(".marathons_material_series_btn").unbind('click').click(function () {
            var o = this;
            var title = $(o).html();
            var series_id = $(o).attr("series_id");
            var hide = 0;

            var default_class = 'marathons_btn_enable_day_green';
            var green_class = 'marathons_btn_enable_day_green';
            var white_class = 'marathons_btn_white';
            var brown_class = 'marathons_btn_brown';

            default_class = green_class;
            $(o).attr('old_class', green_class);

            $(".marathons_material_bonus").removeClass(white_class);
            $(".marathons_material_bonus").addClass(brown_class);
            $(".material_info_bonus").hide();
            $(".marathons_material_series_btn").each(function (index) {
                if ($(this).attr('old_class')) {
                    var v_class = $(this).attr('old_class');
                    if (!$(this).hasClass(v_class)) {
                        $(this).removeClass(white_class);
                        $(this).addClass(v_class);
                    }

                }

                $(this).find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
            });

            if ($(".series_" + series_id + "").css("display") == 'block') {
                hide = 1;
            }

            $(".marathons_material_series_btn").removeClass("marathons_material_series_active");
            $('.marathons_material_series_btn').removeAttr('style');

//        $(".marathons_btn").each(function (index) {
//            //console.log($(this).hasClass(green_class));
//            if (!$(this).hasClass(green_class)) {
//                $(this).removeClass(white_class);
//                $(this).addClass(default_class);
//            }
//        });

            $(o).addClass("marathons_material_series_active");
            $(o).removeClass(default_class);
            $(o).addClass("marathons_btn_white");
            //$(o).css("background-color", "#ffffff");
            //$(o).css("color", "#000000");


            if (series_id > 0) {
                $(".marathons_material_list_block_title").html("Список материалов «" + title.replace(/<\/?[^>]+(>|$)/g, "") + "»");
            } else {
                $(".marathons_material_list_block_title").html("Общие материалы марафона");
            }
            if (hide === 1) {
                $(".marathons_material_list_block").hide(100);
                $(".series_" + series_id).hide(100);
                $('.marathons_material_series_btn').find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
                $(".marathons_material_series_btn").removeClass("marathons_material_series_active");
                $('.marathons_material_series_btn').removeAttr('style');
            } else {
                $(".marathons_material_list_block").show(100);
                $(".material_info:visible").hide();
                $('.marathons_material_series_btn').find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
                $(o).find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
                $(".series_" + series_id).show(100);
            }
        });

        $(".marathons_material_bonus").unbind('click').click(function () {
            if (bonus_lock == '1') {
                alert('Бонус будет доступен после завершения марафона!');
            } else {
                var o = this;
                var default_class = 'marathons_btn_enable_day_green';
                var green_class = 'marathons_btn_enable_day_green';
                var white_class = 'marathons_btn_white';
                var brown_class = 'marathons_btn_brown';
                $(o).attr('old_class', '');

                $(".marathons_btn").each(function (index) {
                    if ($(this).attr('old_class')) {
                        var v_class = $(this).attr('old_class');
                        if (!$(this).hasClass(v_class)) {
                            $(this).removeClass(white_class);
                            $(this).addClass(v_class);

                        }
                    }
                    $(this).find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
                });
                $(o).addClass("marathons_material_series_active");
                $(o).attr('old_class', brown_class);
                $(o).addClass(white_class);
                $(o).removeClass(brown_class);
                $(".material_info:visible").hide();
                var material_id = $(this).attr('bonus_material_id');
                $(".series_" + material_id).show(100);
            }
        });

        $(".material_info").mouseenter(function () {
            var wares_id = $(".marathons_wares_id").val();
            var series_id = $(this).attr('series_id');
            var material_id = $(this).attr('material_id');
            //console.log("material_info mouseenter  series_id=" + series_id);
            //console.log("material_info mouseenter  material_id=" + material_id);
            sendPostLigth('/jpost.php?extension=wares',
                    {"waresVideoSeriesSee": series_id, "wares_id": wares_id},
                    function (e) {
                        if (e['data']['bonus_open'] == '1') {
                            $(".marathons_material_bonus").find(".fa-lock").remove();
                            bonus_lock = 0;
                        }
                    });
        });
    });
</script>