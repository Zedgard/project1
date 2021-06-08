<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css<?= $_SESSION['rand'] ?>">
<script src="/assets/plugins/calamansi/calamansi.min.js<?= $_SESSION['rand'] ?>"></script>
<link href="/extension/marathons/css/marathons.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<link href="/assets/plugins/video/css/videojs.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<script src="/assets/plugins/video/videojs.js<?= $_SESSION['rand'] ?>"></script>
<script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>
<input type="hidden" name="marathons_wares_id" value="<?= $_GET['wares_id'] ?>" class="marathons_wares_id" />
<div class="container-fluid">
    <div class="row">
        <div class="col-lg">
            <div class="marathons_wares_title"><span style="display: none;">Прохождение марафона &laquo; <?= $wares['title'] ?> &raquo;</span><?= $wares['title'] ?></div>
        </div>
        <div class="col-lg">

        </div>
    </div>

    <div class="row">
        <div class="col-lg">

            <div class="row mb-3">
                <div class="col-md mb-1">
                    <div class="marathons_elm">
                        <a href="javascript:void(0)" 
                           class="d-none d-lg-block marathons_btn marathons_btn_green marathons_material_series_btn ckick_to_upload_page" 
                           series_id="0" 
                           elm_type="D"
                           >
                            <span>Общие материалы марафона</span>
                        </a>
                        <a href="javascript:void(0)" 
                           class="d-block d-lg-none marathons_btn marathons_btn_green marathons_material_series_btn ckick_to_upload_page" 
                           series_id="0" 
                           elm_type="M"
                           >
                            <span>Общие материалы марафона</span>
                        </a>
                    </div>
                </div>
                <div class="col-md mb-1" style="<?= $bonus_btn_style ?>">
                    <div class="marathons_elm">
                        <a href="javascript:void(0)" 
                           class="d-none d-lg-block marathons_btn marathons_btn_brown marathons_material_series_btn" 
                           bonus_material_id="<?= $bonus_material_id ?>"
                           elm_type="D"
                           >
                            <span>Бонус</span> <?= $bonus_lock_content ?>
                        </a>
                        <a href="javascript:void(0)" 
                           class="d-block d-lg-none marathons_btn marathons_btn_brown marathons_material_series_btn" 
                           bonus_material_id="<?= $bonus_material_id ?>"
                           elm_type="M"
                           >
                            <span>Бонус</span> <?= $bonus_lock_content ?>
                        </a>
                    </div>
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
                            <div class="marathons_elm mb-1">
                                <a href="javascript:void(0)" 
                                   class="d-none d-lg-block marathons_btn marathons_btn_green marathons_material_series_btn <?= $bonus_class ?>" 
                                   style="<?= $bonus_style ?>" 
                                   series_id="<?= $series_value['id'] ?>"
                                   elm_type="D"
                                   >
                                    <span><?= $series_value['title'] ?></span><i class="fas fa-plus"></i>
                                </a>
                                <a href="javascript:void(0)" 
                                   class="d-block d-lg-none marathons_btn marathons_btn_green marathons_material_series_btn <?= $bonus_class ?>" 
                                   style="<?= $bonus_style ?>" 
                                   series_id="<?= $series_value['id'] ?>"
                                   elm_type="M"
                                   >
                                    <span><?= $series_value['title'] ?></span><i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <?
                        } else {
                            ?>
                            <div class="row mb-1">
                                <div class="marathons_not_btn marathons_btn_enable_day_lock" series_id="<?= $series_value['id'] ?>"><?= $series_value['title'] ?><i class="fas fa-lock"></i></div>
                            </div>
                            <?
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg">    
            <div class="col-md mb-1 materials_list">

            </div>
        </div>

    </div>
</div>
<script>
    var bonus_lock = '<?= $bonus_lock ?>';
    var init_series_id = '';
    $(document).ready(function () {
        $(".marathons_material_series_btn").unbind('click').click(function () {
            var o = this;
            var series_id = $(o).attr('series_id');
            var elm_type = $(o).attr('elm_type');
            var title = $(o).find('span').html();
            var bonus_material_id = $(o).attr('bonus_material_id');

            if (bonus_material_id > 0) {
                console.log('bonus_material_id: ' + bonus_material_id);
                series_id = bonus_material_id;
            }

            $('.fas').removeClass('fa-minus');
            $('.fas').addClass('fa-plus');
            var e = $(o).find('.fas'); // <i class="fas fa-minus">
            if (e.length > 0) {
                e.removeClass('fa-plus');
                e.addClass('fa-minus');
            }

            $(".marathons_material_series_btn").removeClass("marathons_material_series_active");
            $(o).addClass("marathons_material_series_active");

            var html = '<div class="marathons_material_list_block" style="display:none;">\n\
                    <div class="marathons_material_list_block_title">' + title + '</div>\n\
                    <div class="marathons_material_lists">\n\
                        <div class="material_info" style="display: block;">\n\
                            <div class="">\n\
                                <div class="material_content_block">\n\
<div class="mt-3 mb-2 text-center">\n\
<div class="spinner-border text-success" role="status"><span class="visually-hidden"></span></div>\n\
</div>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                    </div>\n\
                </div>';
            if (elm_type === 'M') { // Мобильные
                // Отображение и скрытие
                if (init_series_id === series_id) {
                    $(".marathons_material_list_block").toggle(200);
                } else {
                    $(".marathons_material_list_block").remove();
                    $(o).closest('.marathons_elm').after(html);
                    // Подгрузим сразу общие материалы
                    marathon_series_material_post(series_id);
                    $(".marathons_material_list_block_title").remove();
                    $(".marathons_material_list_block").show(200);
                }
            } else { // Десктоп
                if (init_series_id === series_id) {
                    $(".marathons_material_list_block").toggle(200);
                } else {
                    $('.materials_list').html(html);
                    // Подгрузим сразу общие материалы
                    marathon_series_material_post(series_id);
                    $(".marathons_material_list_block").show(200);
                }
            }
            move(".marathons_material_list_block", 200);
            init_series_id = series_id;
        });

    });

    /**
     * Подгрузим сразу общие материалы
     
     * @param {type} series_id
     * @returns {undefined}     */
    function marathon_series_material_post(series_id) {
        $.ajax({
            url: '/jpost.php?extension=marathons',
            type: 'GET',
            async: true,
            dataType: 'json',
            //processData: false,
            crossDomain: true,
            //xhrFields: {withCredentials: true},
            data: {
                "marathon_series_material": 1,
                "series_id": series_id,
                "wares_id": $(".marathons_wares_id").val()
            },
            success: function (e) {
                if (e['success'] == '1') {
                    $(".material_content_block").html(e['html']);
                    $(".marathons_elm_content").html(e['html']);

                    $(".material_info").unbind('mouseenter').mouseenter(function () {
                        var wares_id = $(".marathons_wares_id").val();
                        var series_id = $(this).attr('series_id');
                        var material_id = $(this).attr('material_id');
                        if (series_id > 0 && material_id > 0) {
                            sendPostLigth('/jpost.php?extension=wares',
                                    {"waresVideoSeriesSee": series_id, "wares_id": wares_id},
                                    function (e) {
                                        if (e['data']['bonus_open'] == '1') {
                                            $(".marathons_material_bonus").find(".fa-lock").remove();
                                            bonus_lock = 0;
                                        }
                                    });
                        }
                    });
                }

            }
        });
    }
</script>