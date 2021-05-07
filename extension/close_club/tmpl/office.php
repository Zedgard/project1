<link rel="stylesheet" href="/extension/close_club/css/close_club.css<?= $_SESSION['rand'] ?>">
<div class="card card-default">

    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6">Закрытый клуб</h2>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3" style="margin-top: -20px;">
                    Информация от КУРАТОРА
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
                        <div class="mb-3">Твой абонемент заканчивается через:</div>
                        <div class="mb-3" style="border: 3px solid #47a44a;padding: 10px;display: inline-block;font-size: 1.3rem;font-weight: 900;color: #000000;">
                            <?= $close_club_info[0]['diff_month'] ?> мес <?= $close_club_info[0]['diff_day'] ?> дн <?= $close_club_info[0]['diff_hour'] ?> ч <?= $close_club_info[0]['diff_minute'] ?> м
                        </div>
                        <div class="mb-3 m-auto d-block d-xl-none">
                            <?
                            foreach ($waresClub as $value) {
                                // Разрешить покупку если период не превышает 12 месяцев
                                if ($close_club->check_add_new_period($value['club_month_period'])) {
                                    ?>
                                    <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add mb-2 " go_url="/shop/cart/" product_id="<?= $value['id'] ?>" style="width: 140px;"><?= $value['title'] ?></a>
                                    <div style="display: none;">
                                        <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add" go_url="/shop/cart/" product_id="<?= $value['id'] ?>" style="width: 140px;">Купить</a>
                                        <div class="btn-group">
                                            <a href="/shop/cart/" class="btn button btngreen-outline btn-success textcenter cart_product_go_card" product_id="<?= $value['id'] ?>" style="width: 140px;display: none;padding: 0.8rem;border-right: none;">Перейти в корзину</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $value['id'] ?>" style="width: 140px;display: none;padding: 0.4rem;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <?
                                }
                            }
                            ?>
                        </div>
                        <div class="mb-3 m-auto w-50 d-none d-xl-block">
                            <?
                            foreach ($waresClub as $value) {
                                // Разрешить покупку если период не превышает 12 месяцев
                                if ($close_club->check_add_new_period($value['club_month_period'])) {
                                    ?>
                                    <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add mb-2 pl-5 pr-5" go_url="/shop/cart/" product_id="<?= $value['id'] ?>" style="width: 180px;"><?= $value['title'] ?></a>
                                    <div style="display: none;">
                                        <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add pl-5 pr-5" go_url="/shop/cart/" product_id="<?= $value['id'] ?>" style="width: 180px;">Купить</a>
                                        <div class="btn-group">
                                            <a href="/shop/cart/" class="btn button btngreen-outline btn-success textcenter cart_product_go_card" product_id="<?= $value['id'] ?>" style="width: 180px;display: none;padding: 0.8rem;border-right: none;">В корзину</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $value['id'] ?>" style="width: 180px;display: none;padding: 0.4rem;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <?
                                }
                            }
                            ?>
                        </div>
                        <?
                    }
                    ?>
                </div>

                <div class="row mb-3 d-none">
                    <div class="col-12 text-center">
                        <strong><a href="javascript:void(0)">Пригласить друга в Клуб Друзей</a></strong>
                    </div>
                </div>

                <div class="row freeze_ticket_block mb-3 p-3">
                    <div class="col-12">
                        <div class="text-center mb-3">Заморозить абонемент на:</div>
                        <div class="freeze_day_buttons">
                            <?
                            // print_r($freeze_day_buttons);
                            ?>
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
                        <div class="clearfix"></div>
                    </div>
                </div>


            </div>
            <div class="col-lg-6">

            </div>
        </div>

    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top ">

    </div>

</div> 

