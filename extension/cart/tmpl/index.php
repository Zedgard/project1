<div class="container mt-4">
    <h1>Корзина</h1>
    <div class="row mt-5">
        <div class="col-lg-12">
            <style>
                .cart_product_list_img{
                    width: 82px;
                    height: 82px;
                }
                .cart_product_list_title{
                    font-size: 1.2rem;
                }
            </style>
            <div class="cart_list">

            </div>

            <div class="row">
                <div class="col-12 font-weight-bold">

                    <div class="row pb-4 pt-3">
                        <div class="col-9" style="font-size: 1.2rem">
                            Итого:
                        </div>
                        <div class="col-3 text-right" style="font-size: 1.4rem;">
                            <span class="cart_total init_price_val">0</span> <i class="fa fa-ruble"></i>
                        </div>
                    </div>

                    <div class="row pb-1 cart_product_promo_block" style="color: #808080;">
                        <div class="col-9">
                            Скидка:
                        </div>
                        <div class="col-3 text-right" style="font-size: 1rem;">
                            <span class="init_price_val price_promo_total">0</span> <i class="fa fa-ruble"></i>
                        </div>
                    </div>
                    <div class="list_promos">

                    </div>
                    <div class="mt-3">
                        <div class="btn-group">
                            <span style="font-size: 1.2rem;margin-right: 10px;padding: 0.5rem 0;">Промо код:</span> <input type="text" name="input_promo_code" value="" class="form-control input_promo_code" style="max-width: 160px;" />
                        </div>
                    </div>
                    
                    <hr class="mt-4 mb-4"/>
                </div>
            </div>

            <div class="row font-weight-bold">
                <div class="col-12 font-size-16">
                    Способ оплаты
                </div>
            </div>
            <div class="row font-weight-bold">
                <div class="col-12 pay_result font-bold color-black text-center pt-2 pb-4" style="display: none;"></div>
            </div>
            <?
            if ($p_user->isClientId() > 0) {
                include 'pay_metods.php';
            } else {
                ?>
                <div class="col-12">
                    <?
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/tmpl/cart_login.php';
                    ?>
                </div>
                <!-- 
                <div style="font-size: 2rem;border: 1px solid red;margin: 2rem 0;color: red;text-align: center;padding: 2rem 0;width: 100%;">Для оплаты войдите в личный кабинет на сайте!</div>
                -->


                <?
            }
            ?>


            <div class="row mt-5">

            </div>
        </div>
    </div>
    <?
//    if ($p_user->isClientId() == 0) {
//        include $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/tmpl/cart_login.php';
//    }
    ?>
</div>