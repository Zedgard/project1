<link rel="stylesheet" href="/extension/close_club/css/close_club.css<?= $_SESSION['rand'] ?>">
<div class="card card-default">

    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6">Закрытый клуб</h2>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3 d-none" style="margin-top: -20px;">
                    Задай вопрос своему <a href="https://t.me/valerevna_annet" target="_blank">куратору</a>
                </div>

                <div class="mb-4">
                    <div style="background-color: #e6e6e6;display: inline-block;min-width: 200px;padding: 10px;">
                        Ник в инстаграм: <span style="font-weight: 900;"><?= $_SESSION['user']['info']['login_instagram'] ?></span>&nbsp;&nbsp;&nbsp;<span class="float-right"><a href="/office/userprofile_admin/" title="Изменить"><i class="mdi mdi-file-document-edit-outline" style="color: #000;"></i></a></span>
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <?
                    // Если есть купленный период к закрытому клубу
                    if (count($close_club_info) > 0 && $close_club_info[0]['status'] == '1') {
                        ?>
                        <div class="mb-3">Твой абонемент заканчивается "<?= date_jquery_format($close_club_info[0]['end_date']) ?>" через:</div>
                        <div class="mb-3" style="border: 3px solid #47a44a;padding: 10px;display: inline-block;font-size: 1.3rem;font-weight: 900;color: #000000;">
                            <!--<?= $close_club_info[0]['diff_month'] ?> мес --><?= $close_club_info[0]['diff_day'] ?> дн <?= $close_club_info[0]['diff_hour'] ?> ч <?= $close_club_info[0]['diff_minute'] ?> м
                        </div>
                        <?
                    } else {
                        ?>
                        <div class="mb-3" style="border: 3px solid #FF0000;padding: 10px;display: inline-block;font-size: 1.3rem;font-weight: 900;color: #FF0000;">
                            Нет абонемента!
                        </div>
                        <div class="mb-3">Купить абонемент на период</div>
                        <?
                    }
                    ?>
                    <div class="mb-3 m-auto d-block d-xl-none">
                        <?
                        foreach ($waresClub as $value) {
                            // Разрешить покупку если период не превышает 12 месяцев
                            if ($close_club->check_add_new_period($value['club_month_period'], $close_club_info)) {
                                ?>
                                <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add mb-2 " go_url="/shop/cart/" product_id="<?= $value['id'] ?>" style="width: 143px;"><?= $value['title'] ?> <i class="fas fa-bullhorn"></i></a>
                                <?
                            } else {
                                ?>
                                <a href="javascript:void(0)" class="btn button btn-secondary textcenter mb-2 " onclick="alert('Нельзя купить больше 12 месяцев!');return false;" style="width: 143px;"><?= $value['title'] ?> <i class="fas fa-bullhorn"></i></a>
                                <?
                            }
                        }
                        ?>
                    </div>
                    <div class="mb-3 m-auto w-50 d-none d-xl-block">
                        <?
                        foreach ($waresClub as $value) {
                            // Разрешить покупку если период не превышает 12 месяцев
                            if ($close_club->check_add_new_period($value['club_month_period'], $close_club_info)) {
                                ?>
                                <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add mb-2" go_url="/shop/cart/" product_id="<?= $value['id'] ?>" style="width: 180px;"><?= $value['title'] ?> <i class="fas fa-bullhorn"></i></a>
                                <?
                            } else {
                                ?>
                                <a href="javascript:void(0)" class="btn button btn-secondary textcenter mb-2 " onclick="alert('Нельзя купить больше 12 месяцев!');return false;" style="width: 180px;"><?= $value['title'] ?> <i class="fas fa-bullhorn"></i></a>
                                <?
                            }
                        }
                        ?>
                    </div>

                </div>

                <div class="row mb-3 d-none">
                    <div class="col-12 text-center">
                        <strong><a href="javascript:void(0)">Пригласить друга в Клуб Друзей</a></strong>
                    </div>
                </div>

                <?
                if ($close_club_info[0]['status'] == '1') {
                    ?>
                    <div class="row freeze_ticket_block mb-3 p-3">
                        <div class="col-12 text-center">
                            <?
                            if (strlen(trim($close_club_info[0]['freeze_date_str'])) > 0) {
                                ?>
                                <div class="freeze_date_str">
                                    Абонемент заморожен до: <span class="freeze_date"><?= date_jquery_format($close_club_info[0]['freeze_date_str']) ?></span> <i class="far fa-snowflake"></i>
                                </div>
                                <?
                            } else {
                                ?>
                                <div class="mb-3 freeze_title_text"><i class="far fa-snowflake"></i> Заморозить абонемент на:</div>
                                <div class="freeze_day_buttons">
                                    <?
                                    foreach ($freeze_day_buttons as $value) {
                                        ?>
                                        <div class="freeze_button">
                                            <div class="freeze_bg <?= $value['class'] ?>">
                                                <div class="title_sum"><?= $value['title_sum'] ?></div>
                                                <div class="title_name"><?= $value['title_name'] ?></div>
                                            </div>
                                            <div class="button_text button btn-success textcenter p-1 w-100 <?= $value['button_class'] ?>"><?= $value['button_text'] ?></div>
                                        </div>
                                        <?
                                    }
                                    ?>

                                </div>
                                <?
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <?
                }
                ?>
            </div>
            <div class="col-lg-6">

            </div>
        </div>

    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top ">

    </div>

</div> 
<script>
    $(document).ready(function () {
        setInterval(function () {
            if (!!$(".cart_product_add") && $(".cart_product_add").css('display') == 'none') {
                $(".cart_product_add").show();
            }
        }, 1000);
        $(".freeze_user_active").unbind('click').click(function () {
            var v = $(this).closest(".freeze_button").find('.title_sum').html();
            if (confirm('Вы уверены что хотите заморозить абонемент на ' + v + ' суток?')) {

                sendPostLigth('/jpost.php?extension=close_club',
                        {
                            "set_freeze_day": v
                        },
                        function (e) {
                            if (e['success'] == '1') {
                                alert(e['success_text']);
                                location.reload();
                            } else {
                                alert(e['success_text']);
                            }
                        });
            }
        });

    });
</script>