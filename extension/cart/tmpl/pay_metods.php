<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
<script src="https://yookassa.ru/checkout-widget/v1/checkout-widget.js"></script>
<div class="row justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart_big btn_cart_cloudpayments">Картой</a> 
    </div> 
</div>
<div class="row mb-3 justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen4 text-center btn_cart btn_cart_tinkoff" target="_blank">Картой через Тинькофф</a>
    </div>

    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen4 text-center btn_cart btn_cart_other">Другой способ</a>
    </div>
</div>

<div class="row mt-3 block_cart_other" style="display: none;">
    <div class="col-12">

    </div>
</div>

<div>
    <div class="row mb-3">
        <a href="javascript:void(0)" class="btn button btngreen4 TINKOFF_BTN_YELLOW btn_cart_credit" style="max-width: 400px;margin: 0 auto;">Взять в рассрочку</a>
    </div>
</div>

<div class="col-lg-4 text-left mt-3" style="display: none;">
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
<div class="col-lg-3 text-left mt-3" style="display: none;">
</div>

<script>
    init_pay();
</script>