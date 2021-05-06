<link rel="stylesheet" href="/extension/close_club/css/close_club.css<?= $_SESSION['rand'] ?>">
<div>
    <div class="row">
        <div class="col-lg-12">
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

                            <div class="mb-3">
                                <div style="background-color: #e6e6e6;display: inline-block;min-width: 200px;padding: 10px;">
                                    Ник в инстаграм: <span style="font-weight: 900;"><?= $_SESSION['user']['info']['login_instagram'] ?></span>&nbsp;&nbsp;&nbsp;<span class="float-right"><a href="/office/userprofile_admin/">Изменить</a></span>
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <?
                                // Если есть купленный период к закрытому клубу
                                if (count($close_club_info) > 0 && $close_club_info[0]['status'] == '1') {
                                    ?>
                                    <div class="mb-3">Твой абонемент заканчивается через:</div>
                                    <div class="mb-3" style="border: 3px solid #47a44a;padding: 10px;display: inline-block;font-size: 1.4rem;font-weight: 900;color: #000000;">
                                        <?= $close_club_info[0]['diff_month'] ?> мес <?= $close_club_info[0]['diff_day'] ?> дн <?= $close_club_info[0]['diff_hour'] ?> ч <?= $close_club_info[0]['diff_minute'] ?> м
                                    </div>
                                    <div class="mb-3">
                                        <?
                                        foreach ($waresClub as $value) {
                                            // Разрешить покупку если период не превышает 12 месяцев
                                            if ($close_club->check_add_new_period($value['club_month_period'])) {
                                                ?>
                                                <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add mb-2 pl-5 pr-5" go_url="/shop/cart/" product_id="<?= $value['id'] ?>"><?= $value['title'] ?></a>
                                                <div style="display: none;">
                                                    <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add pl-5 pr-5" go_url="/shop/cart/" product_id="<?= $value['id'] ?>">Купить</a>
                                                    <div class="btn-group">
                                                        <a href="/shop/cart/" class="btn button btngreen-outline btn-success textcenter cart_product_go_card" product_id="<?= $value['id'] ?>" style="display: none;padding: 0.8rem;border-right: none;">Перейти в корзину</a>
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $value['id'] ?>" style="display: none;padding: 0.4rem;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
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

                            <div class="row mb-3" >
                                <div class="col-12">
                                    <strong>Приобрести один из тарифов</strong>
                                </div>
                            </div>

                            <div class="row" style="display: none;">
                                <div class="col-12">
                                    <table class="table table-hover">
                                        <thead style="display: none;">
                                            <tr>
                                                <th>Наменование</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                            foreach ($waresClub as $value) {
                                                // Разрешить покупку если период не превышает 12 месяцев
                                                if ($close_club->check_add_new_period($value['club_month_period'])) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $value['title'] ?></td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn button btn-success textcenter cart_product_add pl-5 pr-5" go_url="/shop/cart/" product_id="<?= $value['id'] ?>">Купить</a>
                                                            <div class="btn-group">
                                                                <a href="/shop/cart/" class="btn button btn-success textcenter cart_product_go_card" product_id="<?= $value['id'] ?>" style="display: none;">Перейти в корзину</a>
                                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $value['id'] ?>" style="display: none;" title="Удалить из корзины"><i class="fa fa-trash" style="font-size: 1.2rem;padding-top: 6px;"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
        </div>
    </div>
</div>
