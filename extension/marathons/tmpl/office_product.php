<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css<?= $_SESSION['rand'] ?>">
<script src="/assets/plugins/calamansi/calamansi.min.js<?= $_SESSION['rand'] ?>"></script>
<link href="/extension/marathons/css/marathons.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<link href="/assets/plugins/video/css/videojs.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<script src="/assets/plugins/video/videojs.js<?= $_SESSION['rand'] ?>"></script>
<script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>
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

                    <div class="material_info" style="display: block;">
                        <div class="row mt-2 mb-2">
                            <div class="col-12 material_content_block">
                            </div>
                        </div>
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
            $('.video-js').remove();
            $(".clmns--hide-on-pause").click();
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

            if ($('.series_' + series_id).css("display") == 'block') {
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
//            if (hide == 1) {
//                $(".marathons_material_list_block").hide(100);
//                $('.series_' + series_id).hide(100);
//                $('.marathons_material_series_btn').find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
//                $(".marathons_material_series_btn").removeClass("marathons_material_series_active");
//                $('.marathons_material_series_btn').removeAttr('style');
//            } else {
//                $(".marathons_material_list_block").show(100);
//                $(".material_info:visible").hide();
//                $('.marathons_material_series_btn').find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
//                $(o).find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
//                $('.series_' + series_id).show(100);
//            }

            //console.log('series_id: ' + series_id + ' hide: ' + hide);
            //$('.series_' + series_id).each(function () {
            //$(".material_content_block").html('series_id: ' + series_id);

            marathon_series_material_post(series_id);


        });

        $(".marathons_material_bonus").unbind('click').click(function () {
            if (bonus_lock == '1') {
                alert('Бонус будет доступен после завершения марафона!');
            } else {
                var o = this;
                var series_id = $(o).attr("bonus_material_id");
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
                //$(".material_info:visible").hide();

                $(".series_" + series_id).show(100);
                console.log('БОНУС');
                $(".marathons_material_list_block_title").html("«БОНУС»");
                marathon_series_material_post(series_id);
            }
        });


        setTimeout(function () {
            $('.marathons_material_series_btn[series_id="0"]').click();
        }, 200);

    });

    function marathon_series_material_post(series_id) {
        sendPostLigth('/jpost.php?extension=marathons',
                {
                    "marathon_series_material": 1,
                    "series_id": series_id,
                    "wares_id": $(".marathons_wares_id").val()
                },
                function (e) {
                    if (e['success'] == '1') {
                        $(".material_content_block").html(e['html']);

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
                });
    }
</script>