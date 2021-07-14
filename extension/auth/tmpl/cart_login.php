<style>
    .cart_fast_login{
        margin-top: 1rem;
        clear: both;
    }
    .cart_fast_login .fl_title{
        font-size: 1.2rem;
        font-weight: 900;
        color: #000000;
        margin-bottom: 1rem;
    }
    .cart_fast_login .fl_info{
        font-size: 0.8rem;
        color: #C9C9C9;

    }
    .cart_fast_login .fl_input_title{
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }
    .cart_fast_login .check_indicator{
        margin-top: 1rem;
        margin-left: 1rem;
    }
</style>
<? if (!isset($_GET['registrations'])): ?>
    <form id="registration" action="/jpost.php?extension=auth" method="POST">
        <div class="row cart_fast_login">
            <div class="col-md-6 mt-3">
                <div class="fl_title">Введи свою почту, чтобы купить</div>

                <div class="d-none" style="height: 31px;"></div>
                <div class="d-none fl_input_title">Контактный телефон*</div>
                <div class="d-none"><input type="text" class="form-control input-lg phone" name="phone" id="phone" aria-describedby="nameHelp" type="phone"></div>
                <div class="fl_input_title">Электронная почта*</div>
                <div><input type="email" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp" type="email"></div>
                <div class="fl_info">
                    <div>Для заказа товаров требуется регистрация</div>
                    <div>Если вы уже зарегистрированы, войдите в свою учетную запись</div>
                </div>
                <div class="mt-2">
                    <div class="check_indicator2 mb-2">
                        <label class="control control-checkbox">
                            <input type="checkbox" id="check_indicator" name="check_indicator" value="1" class="mr-2" /> 
                            <span style="margin-left: 6px;">
                                Я ознакомлен(-а) с условиями и положениями <a href="/privacy_policy/" target="_blank">Политики конфиденциальности</a> и даю <a href="/personal_data/" target="_blank">согласие на обработку персональных данных</a>
                            </span>
                            <div class="control-indicator"></div>

                        </label>
                    </div>
                    <div class="form_result" style="display: none;">

                    </div>
                    <input type="hidden" name="registration_fast" />  
                    <button type="submit" class="btn btn-lg btn-primary btn-block mt-4 mb-4" style="">Отправить</button>
                </div>
                <div></div>
            </div>
            <div class="col-md-6 mt-3">
                <div class=" d-md-block">
                    <div class="fl_title" style="margin-bottom: 2.7rem;">
                        или авторизируйся, если уже есть аккаунт 
                    </div>
                    <div class="row">
                        <div class="col col-mb mb-4 text-center">
                            <a class="btn btngreen-outline align-self-center cart_product_go_card" href="?registrations">Авторизация</a>
                        </div>
                        <div class="col col-mb mb-4 text-center">

                            <a href="<?= $google_link ?>"><img src="/assets/img/ui-icons/google_32.png"/></a>
                            <a href="<?= $ya_link ?>"><img src="/assets/img/ui-icons/yandex.png"/></a>
                            <a href="<?= $vk_link ?>"><img src="/assets/img/ui-icons/vk.png"/></a>
                            <a href="<?= $facebook_link ?>"><img src="/assets/img/ui-icons/facebook_32.png"/></a>
                            <div style="font-size: 0.8rem;margin: 0.3rem;">авторизация с помощью</div>
                        </div>
                        <div class="d-none d-md-block col col-mb mb-4"></div>
                    </div>
                </div>
            </div>

        </div>
    </form>
<? endif; ?>
<!-- Блок Авторизация -->
<? if (isset($_GET['registrations'])): ?>
    <div class="col-lg-8 col-md-10 offset-md-2">
        <div class="card cart_fast_login">
            <div class="card-body p-5">

                <div class="fl_title mb-5">Авторизация</div>
                <form id="authorization" action="/jpost.php?extension=auth&url=/shop/cart/" method="POST">
                    <div class="row">
                        <div class="form-group col-md-12 mb-4">
                            <input type="login" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp" type="email" placeholder="Телефон / Эл. Почта" required />
                            <div class="valid-feedback">
                                принято!
                            </div>
                        </div>
                        <div class="form-group col-md-12 ">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Пароль" required />
                            <label class="control control-checkbox mt-2 float-right" style="font-size: 0.8rem;">
                                <input type="checkbox" class="form-check-input password-checkbox">
                                <div class="control-indicator"></div>
                                <span class="">Показать пароль</span>
                            </label>
                            <div class="valid-feedback">
                                принято!
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control control-checkbox">
                                        <input type="checkbox" id="remember_me" name="remember_me" value="1" />
                                        <div class="control-indicator"></div>
                                        Запомни меня
                                    </label>
                                </div> 
                                <div class="col-md-6 text-right">
                                    <p><a class="text-blue re_password_link" href="javascript:void(0)">Забыли пароль?</a></p>
                                </div> 


                            </div>

                            <div class="form_result" style="display: none;">

                            </div>
                            <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Авторизация</button>
                            <div class="mb-4 text-center">
                                <div style="font-size: 0.8rem;margin-bottom: 0.2rem;">авторизация с помощью</div>

                                <a href="<?= $google_link ?>"><img src="/assets/img/ui-icons/google_32.png"/></a>
                                <a href="<?= $ya_link ?>"><img src="/assets/img/ui-icons/yandex.png"/></a>
                                <a href="<?= $vk_link ?>"><img src="/assets/img/ui-icons/vk.png"/></a>
                                <a href="<?= $facebook_link ?>"><img src="/assets/img/ui-icons/facebook_32.png"/></a>

                            </div>
                            <div class="text-right" style="margin-top: 3rem;font-size: 1rem;">
                                Нет учетной записи <a class="text-blue" href="./">Регистрация</a>
                            </div>
                        </div> 
                    </div>
                    <input type="hidden" name="authorization" />    
                </form>
            </div>
        </div>
    </div>
<? endif; ?>


<script>
    $(function () {
        $('#authorization').sendPost(function (result) {
            //console.log("authorization ok");
        });
        $('#registration').sendPost(function (result) {
            //console.log("registration ok");
        });
        $(".re_password_link").unbind("click").click(function () {
            $("#form_re_password_modal").modal("show");
            $(".btn_re_password").unbind("click").click(function () {
                init_send_re_password();
            });
        });
        /*
         * Удаляет выпадающий список из ulogin
         */
        var uLogin = setInterval(function () {
            // .ulogin-dropdown-button
            if (!!$(".ulogin-dropdown-button")) {
                $(".ulogin-dropdown-button").remove();
                $(".ulogin-buttons-container").css("width", "218px");
                clearInterval(uLogin);
            }
        }, 300);
        //$('.phone').mask('+7 (999) 999-9999');
    });

    /*
     * Отправить сообщение на восстановление пароля
     */
    function init_send_re_password() {
        var re_user_email = $(".re_user_email").val();
        sendPostLigth('/jpost.php?extension=auth',
                {
                    "re_password": 1,
                    "re_user_email": re_user_email
                },
                function (e) {
                    if (e['success'] == '1') {
                        $(".modal-body").html("На указанную почту отправлено письмо с инструкцией восстановления");
                    }
                });
    }
    /*
     * Восстановление 
     */
    function init_re_password() {
        var p = $(".re_password").val();
        var p2 = $(".re_password2").val();
        sendPostLigth('/jpost.php?extension=auth',
                {
                    "re_password_go": 1,
                    "p": p,
                    "p2": p2
                },
                function (e) {
                    if (e['success'] == '1') {
                        $(".modal-body").html("Пароль изменен!");
                    }
                });
    }
</script> 