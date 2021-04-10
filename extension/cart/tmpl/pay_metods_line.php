<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
<script src="https://yookassa.ru/checkout-widget/v1/checkout-widget.js"></script>
<div class="pays_list_line_block text-center">
    <div class="row mb-3">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart_big btn_cart_cloudpayments">Картой</a> 
    </div>
    <div class="row mb-3">
        <a href="/pay.php?tinkoff=1" class="btn button btngreen4 text-center btn_cart btn_cart_yandex" target="_blank">Картой через Тинькофф</a>
    </div>
    <div class="row mb-3">
        <a href="javascript:void(0)" class="btn button btngreen4 text-center btn_cart btn_cart_other">Другой способ</a>
    </div>
    <div class="row mb-3">
        <div class="col-12 block_cart_other" style="display: none;">

        </div>
    </div>
</div>
<script>
    init_pay();
</script>