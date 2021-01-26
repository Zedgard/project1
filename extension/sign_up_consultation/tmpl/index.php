<div class="sign_up_consultation ">
    <div class="sign_up_consultation_back">
        <div class="container">
            <style>
                .ui-icon-circle-triangle-e{
                    background-image: url('/assets/plugins/jquery/jquery-ui-1.12.1/images/l.svg') !important;
                    background-repeat: no-repeat;
                }
                .ui-icon-circle-triangle-w{
                    background-image: url('/assets/plugins/jquery/jquery-ui-1.12.1/images/r.svg') !important;
                    background-repeat: no-repeat;
                }
                *
                .ui-datepicker-prev{
                    background-image: url('/assets/plugins/jquery/jquery-ui-1.12.1/images/l.svg') !important;
                    background-repeat: no-repeat;
                    font-size: 0.9rem;
                }
                .ui-datepicker-next{
                    background-image: url('/assets/plugins/jquery/jquery-ui-1.12.1/images/r.svg') !important;
                    background-repeat: no-repeat;
                    font-size: 0.9rem;
                }

            </style>
            <?
            //print_r($_SESSION['cart']);
            ?>
            <div class="row">
                <div class="col-md-12 top80 bottom100">
                    <div class="datetime_piker_select_block">
                        <div class="datetime_piker_select_title">
                            <div class="float-left">Записаться на консультацию</div> <div class="float-right" style="display: none;">время Мск. <?= date("H:i") ?></div>
                            <div style="height: 0px;clear: both;"></div>
                        </div>  
                        <div style="width: 100%;">

                            <div style="padding: 0% 6%;">

                                <!-- STEP 1 -->
                                <div class="step1">
                                    <div class="row mt-5">
                                        <div class="col-md-6 mb-5">

                                            <div class="top30 text-left">
                                                <input type="text" name="consult_first_name" value="<?= $_SESSION['consultation']['first_name'] ?>" placeholder="Ваше Имя и Фамилия" class="consult_form_input consult_first_name w-100 fontfize150" />
                                            </div>
                                            <div class="top30 text-left">
                                                <input type="text" name="consult_user_phone" value="<?= $_SESSION['consultation']['user_phone'] ?>" placeholder="Телефон" class="consult_form_input consult_user_phone w-100 fontfize150" />
                                            </div>
                                            <div class="top30 text-left">
                                                <input type="text" name="consult_user_email" value="<?= $_SESSION['consultation']['user_email'] ?>" placeholder="Email" class="consult_form_input consult_user_email w-100 fontfize150" />
                                            </div>
                                            <div class="top50 text-left">
                                                <select name="consult_your_master" class="consult_form_input consult_your_master w-100 fontfize150" >

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-5 mb-5">
                                            <div class="text-center mt-3">
                                                <div class="fontfize150" style="margin-bottom: 10px;">
                                                    Выберите дату
                                                </div>
                                                <div class="datepicker"></div>
                                                <input type="hidden" name="datepicker_data" value="" class="datepicker_data" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-5" title="Выберите специалиста">
                                            <div class="fontfize150 text-center mt-3" style="margin-bottom: 10px;">
                                                Время (МСК.)
                                            </div>
                                            <div class="d-flex bd-highlight text-center">
                                                <div class="select_timer align-self-center p-2 bd-highlight"></div>
                                                <input type="hidden" name="timepicker_data" value="" class="timepicker_data"  />
                                            </div>
                                        </div> 


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div style="text-align: left;padding: 30px 0;">
                                                <input type="button" value="Срочная консультация" step="2" class="btn btn-lg btn_fast_consultation fontmedium font-size-18" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="text-align: right;padding: 30px 0;">
                                                <input type="button" value="Следующий шаг" step="2" class="btn btn-lg btn_next_step fontmedium font-size-18" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STEP 3 -->
                                <div class="step2" style="display: none;">
                                    <div class="row mt-5">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Ваше Имя и Фамилия</div>
                                                    <div class="first_name"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Телефон</div>
                                                    <div class="user_phone"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Email</div>
                                                    <div class="user_email"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Специалист</div>
                                                    <div class="your_master"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Дата проведения</div>
                                                    <div class="datepicker_data"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Время</div>
                                                    <div class="timepicker_data"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <div class="fontmedium mb-4">Продолжительность</div>
                                                    <select name="select_time_period" class="form-control select_time_period w-100">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 defaultcolor fontfize150">
                                                    Цена: <span class="total_price font-bold">0</span> <i class="fa fa-ruble"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: right;padding: 30px 0;">
                                        <input type="button" value="Назад" step="1" class="btn btn-lg btn_last_step fontmedium font-size-18" />
                                        <input type="button" value="Оплатить" step="3" class="btn btn-lg btn_step_end disabled fontmedium font-size-18" />
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <!-- true alert -->
                <div class="modal fade" id="consultation_send" tabindex="-1" role="dialog" aria-labelledby="consultation_send" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalSmallTitle">Оплата</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        Оплатить любым удобным способом
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-left mt-3">
                                        <a href="/pay.php?yandex=1" class="btn button btngreen2 text-center btn_cart btn_cart_yandex">Картой</a>
                                    </div>

                                    <div class="col-lg-3 text-left mt-3">
                                        <a href="/pay.php?interkassa=1" class="btn button btngreen2 text-center btn_cart btn_cart_interkassa">InterKassa</a> 
                                    </div>
                                    <div class="col-lg-3 text-left mt-3">
                                        <?
                                        if (strlen($paypal_email) == 0) {
                                            ?>
                                            <a href="javascript:alert('Недоступен')" class="btn button btngreen2 text-center btn_cart">PayPal</a>
                                            <?
                                        } else {
                                            /*
                                             * <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                              <input type="hidden" name="cmd" value="_xclick">
                                              <input type="hidden" name="business" value="<?= $paypal_email ?>">
                                              <input type="hidden" name="item_name" value="<?= $title ?>">
                                              <input type="hidden" name="item_number" value="1">
                                              <input type="hidden" name="amount" value="<?= $price_total ?>">
                                              <input type="hidden" name="return" value="<?= $url_ref ?>">
                                              <input type="hidden" name="no_shipping" value="1">
                                              <input type="hidden" name="email" value="<?= $email ?>">
                                              <input type="submit" name="submit" border="0" class="btn button btngreen2 text-center btn_cart btn_cart_paypal" value="PayPal">
                                              </form>
                                             */
                                            ?>
                                            <a href="javascript:void(0)" class="btn button btngreen2 text-center btn_cart btn_cart_paypal">PayPal</a>
                                            <?
                                        }
                                        ?>

                                    </div>
                                    <div class="col-lg-3 text-left mt-3">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Отмена</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include 'fast_consultation.php';
?>
<script>
    var consult_your_master_select = '<?= $_SESSION['consultation']['your_master'] ?>';
</script>
<script src="/assets/js/consultation.js?v=<?= rand() ?>"></script>
