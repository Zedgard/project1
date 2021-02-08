<div class="container mt-4">
    <h1>Корзина</h1>
    <div class="row mt-5">
        <div class="col-lg-12">

            <?
            if ($p_user->isClientId() == 0) {
                include $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/tmpl/login_minimal.php';
            }
            ?>
            <div class="cart_list">

            </div>

            <div class="row">
                <div class="col-12 font-weight-bold">

                    <div class="row pb-4 pt-3">
                        <div class="col-9">
                            Итог:
                        </div>
                        <div class="col-3 text-right" style="font-size: 1.4rem;">
                            <span class="cart_total init_price_val">0</span> <i class="fa fa-ruble"></i>
                        </div>
                    </div>

                    <div class="row  pb-1" style="color: #808080;">
                        <div class="col-9">
                            Скидка:
                        </div>
                        <div class="col-3 text-right" style="font-size: 1rem;">
                            <span class="init_price_val price_promo_total">0</span> <i class="fa fa-ruble"></i>
                        </div>
                    </div>
                    <hr class="mt-4 mb-4"/>
                </div>
            </div>

            <div class="row font-weight-bold">
                <div class="col-9">
                    Способ оплаты
                </div>
            </div>
            <div class="row">
                <?
                if ($p_user->isClientId() > 0) {
                    ?>
                    <div class="col-lg-3 text-left mt-3">
                        <a href="javascript:void(0)" class="btn button btngreen2 text-center btn_cart btn_cart_yandex">Картой</a>
                    </div>
                    <div class="col-lg-3 text-left mt-3">
                        <a href="javascript:void(0)" class="btn button btngreen2 text-center btn_cart btn_cart_interkassa">InterKassa</a> 
                    </div>    
                    <div class="col-lg-3 text-left mt-3">
                        <?
                        if (strlen($paypal_email) == 0) {
                            ?>
                            <a href="javascript:alert('В разработке')" class="btn button btngreen2 text-center btn_cart btn_cart_paypal">PayPal</a>
                            <?
                        } else {
                            // Справка 
                            // https://dcblog.dev/how-to-integrate-paypal-into-php
                            /*
                             * <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                              <input type="hidden" name="cmd" value="_xclick">
                              <input type="hidden" name="business" value="<?= $paypal_email ?>">
                              <input type="hidden" name="item_name" value="<?= $title ?>">
                              <input type="hidden" name="item_number" value="1">
                              <input type="hidden" name="amount" value="<?= $price_total ?>">
                              <input type="hidden" name="return" value="<?= $url_ref ?>">
                              <input type="hidden" name="no_shipping" value="1">
                              <input type="hidden" name="currency_code" value="RUB">
                              <input type="hidden" name="lc" value="RU" />
                              <input type="hidden" name="email" value="<?= $email ?>">
                              <input type="submit" name="submit" border="0" class="btn button btngreen2 text-center btn_cart btn_cart_paypal" value="PayPal">
                              </form>
                             */
                            ?>
                            <a href="javascript:void(0)" class="btn button btngreen2 text-center btn_cart btn_cart_paypal" e="<?= $email ?>">PayPal</a> 
                            <div id="smart-button-container">
                                <div style="text-align: center;">
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                    <div class="col-lg-3 text-left mt-3">

                    </div>
                    <?
                } else {
                    ?>
                    <div style="font-size: 2rem;border: 1px solid red;margin: 2rem 0;color: red;text-align: center;padding: 2rem 0;width: 100%;">Для оплаты войдите в личный кабинет на сайте!</div>
                    <?
                }
                ?>
            </div>
            <div class="row mt-5">

            </div>
        </div>
    </div>
</div>