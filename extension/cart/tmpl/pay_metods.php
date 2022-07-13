<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
<script src="https://yookassa.ru/checkout-widget/v1/checkout-widget.js"></script>
<div class="row justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart btn_cart_cloudpayments">Картой<br/>
            <span class="btn_pay_small_text">(Любой картой через Cloudpayments)</span></a> 
    </div> 
</div>
<div class="row justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart btn_cart_tinkoff">Картой через Тинькофф<br/>
            <span class="btn_pay_small_text">(Картами Visa, Mastercard, ВТБ через Тинькофф)</span></a>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart btn_cart_other">Картой через ЮКАССА<br/>
            <span class="btn_pay_small_text">(Любой картой, любой банк, разные способы)</span></a>
    </div>
</div>
<div class="row mt-3 block_cart_other" style="display: none;">
    <div class="col-12">

    </div>
</div>
<!-- <div class="row justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart btn_cart_paypal">Через PayPal<br/>
            <span class="btn_pay_small_text">(Подходит для оплаты из заграницы)</span></a>
    </div>
</div> -->

<div class="row justify-content-md-center">
    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen TINKOFF_BTN_YELLOW btn_cart btn_cart_credit">Взять в рассрочку</a>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="credModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Выбрать рассрочку</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-grid gap-2">
            <input type="button" class="btn btn-choose TINKOFF_BTN_YELLOW" data-bs-dismiss="modal" name="installment_0_0_3_5,19" value="3 месяца">
            <input type="button" class="btn btn-choose TINKOFF_BTN_YELLOW" data-bs-dismiss="modal" name="installment_0_0_4_6,43" value="4 месяца">
            <input type="button" class="btn btn-choose TINKOFF_BTN_YELLOW" data-bs-dismiss="modal" name="installment_0_0_6_8,84" value="6 месяцев">
            <input type="button" class="btn btn-choose TINKOFF_BTN_YELLOW" data-bs-dismiss="modal" name="installment_0_0_10_13,42" value="10 месяцев">
            <input type="button" class="btn btn-choose TINKOFF_BTN_YELLOW" data-bs-dismiss="modal" name="installment_0_0_12_15,59" value="12 месяцев">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-3 justify-content-md-center d-none">
    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen text-center btn_cart btn_cart_tinkoff">Картой через Тинькофф</a>
    </div>

    <div class="col-lg-4 text-center text-lg-left mt-3" style="display: block;">
        <a href="javascript:void(0)" class="btn button btngreen4 text-center btn_cart btn_cart_other">Другой способ</a>
    </div>
</div>


<div class="col-lg-3 text-left mt-3" style="display: none;">
</div>

<script>
    document.addEventListener('DOMContentLoaded', init_pay);
</script>