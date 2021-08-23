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
                                                        $(".series_<?= $value['series_id'] ?>").unbind('mouseenter').mouseenter(function () {
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
                                                <div class="material_info marathons_material_list_block  series_<?= $value['series_id'] ?> mb-3" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>" style="display: none;">
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-12 material_content_block">

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