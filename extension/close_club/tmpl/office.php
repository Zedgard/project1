<link rel="stylesheet" href="/extension/close_club/css/close_club.css<?= $_SESSION['rand'] ?>">
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Закрытый клуб</h2>
                </div>

                <div class="card-body">

                    <div class="row mb-3" style="margin-top: -30px;">
                        <div class="col-12">
                            <strong>Приобрести один из тарифов</strong>
                        </div>
                    </div>

                    <div class="row">
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

                <div class="form-footer pt-4 pt-5 mt-4 border-top ">

                </div>

            </div> 
        </div>
    </div>
</div>
