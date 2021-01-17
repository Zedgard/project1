<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    .js-count{
        padding: 0 10px;
    }
    .total-cart-summ{
        font-weight: bold;
    }
    .btn_cart{
        font-weight: bold;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 90%;
    }
</style>
<div class="container mt-4">
    <h1>Корзина</h1>
    <div class="row mt-5">
        <div class="col-lg-12">
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
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/tmpl/login_minimal.php';
                }
                ?>
            </div>
            <div class="row mt-5">

            </div>
            <!--
                        <div class="row mt-5 mb-5">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="title">Служба технической поддержки</h3>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        Приветствуем! Вам нужна техническая помощь?<br/>
                                        Мы ответим вам так быстро, как сможем, а пока вы ожидаете почитайте рубрику САМОСТОЯТЕЛЬНЫЕ тех.РЕШЕНИЯ.
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <i class="fa fa-support" style="color:#2e8ece; font-size:25px; line-height:25px; vertical-align: middle;"></i> <span class="font-size-18 font-weight-medium">Хотите получить ответ на свой вопрос?</span> 
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        Укажите фамилию, имя и электронную почту на которую был оформлен заказ
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <i class="fa fa-clock-o" style="color:#2e8ece; font-size:25px; line-height:25px; vertical-align: middle;"></i> <span class="font-size-18 font-weight-medium">Время работы службы технической поддержки:</span>
                                    </div>
                                </div>
            
                                <div class="row mt-2">
                                    <div class="col-12">
                                        с 02:00 до 20:00 *по московскому времени
                                    </div>
                                </div>
            
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <i class="fa fa-info" style="color:#2e8ece; font-size:25px; line-height:25px; vertical-align: middle;"></i> <span class="font-size-18 font-weight-medium">Время ответа на вопросы</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        от 5 минут до нескольких часов
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
            
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <span class="font-size-18 font-weight-medium">Опишите вашу ситуацию</span>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-12 form_send_user_message">
                                                <div class="contact-left">
                                                    <p>
                                                        <input type="text" name="user_fio" value="" size="40" class="form-control user_fio" placeholder="Ваше имя *">
                                                    </p>
                                                    <p>
                                                        <input type="text" name="user_email" value="" size="40" class="form-control user_email" placeholder="Email *">
                                                    </p>
                                                    <p>
                                                        <input type="text" name="user_subject" value="" size="40" class="form-control user_subject" placeholder="Тема *">
                                                    </p>
                                                </div>
                                                <div class="contact-right">
                                                    <p>
                                                        <textarea name="user_message" class="form-control user_message" placeholder="Сообщение *"></textarea>
                                                    </p>
                                                </div>
                                                <p class="contact-submit">
                                                    <input type="submit" value="Отправить сообщение" class="btn btn-primary btn_send_user_message">
                                                </p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="form_result mt-3 mb-3"></span>
                                                    </div>
                                                </div>
            
            
                                            </div>
                                        </div>
            
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
            
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div>
                                            <button class="btn btn-secondary btn-lg w-100" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                                Оплата прошла, а письма со ссылкой нет.<br/>
                                                Куда обычно отправляется заказ?	
                                            </button>
                                        </div>
                                        <div class="collapse show" id="collapseExample1">
                                            <div class="card card-body">
                                                <p>На электронный адрес, указанный при оформлении заказа, сразу после оплаты, автоматически, отправляется письмо со ссылками. Если вы не получили такое письмо, то:</p>
                                                <p><span class="">1.</span> Проверьте все папки вашей электронной почты, возможно письмо попало в папку СПАМ.</p>
                                                <p><span class="">2.</span> Все ваши заказы и ссылки на загрузку хранятся в вашем личном кабинете, с которого вы в любое время можете загрузить свой заказ. Войти в свой личный кабинет можно <a href="/auth/">здесь</a>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div>
                                            <button class="btn btn-secondary btn-lg w-100" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">         
                                                Сайт запрашивает авторизацию, где взять логин и пароль?							
                                            </button>
                                        </div>
                                        <div class="collapse" id="collapseExample2">
                                            <div class="card card-body">
                                                <p>Регистрация происходит автоматически, при оформлении первого заказа и на Ваш электронный адрес приходит письмо с логином и паролем для входа в личный кабинет. Если вы не смогли найти это письмо, то запросите новый пароль <a href="/auth/">здесь</a>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div>
                                            <button class="btn btn-secondary btn-lg w-100" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                                                Ввожу логин и пароль, при авторизации, а меня выкидывает на главную страницу. Что я делаю не так?						
                                            </button>
                                        </div>
                                        <div class="collapse" id="collapseExample3">
                                            <div class="card card-body">
                                                <p>Если у вас похожая ситуация, значит вы вводите логин и пароль с ошибкой. Введите корректные учетные данные. Вы можете сбросить автоматический пароль и создать свой собственный, легкий пароль <a href="/auth/">здесь</a>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
            
            
                            </div>
                        </div>
            -->


        </div>
    </div>
</div>
<script src="/assets/js/cart.js?v=<?= rand() ?>"></script>   