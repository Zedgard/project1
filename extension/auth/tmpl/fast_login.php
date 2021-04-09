<style>
    .cart_fast_login{
        margin-top: 1rem;
        clear: both;
    }
    .cart_fast_login .fl_title{
        font-size: 1.4rem;
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

<form id="registration" class="show_form_registration" action="/jpost.php?extension=auth" method="POST" style="display: block;">
    <div class="card cart_fast_login">
        <div class="card-body p-5">

            <div class="fl_title">
                <span class="text-left">
                    Регистрация
                </span>
                <span class="text-right" style="float: right;margin-top: -10px;">
                    <a class="btn btngreen-outline align-self-center btn_show_other_form" href="javascript:void(0)">Авторизация</a>
                </span>
            </div>
            <div style="height: 10px;"></div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div>
                        <div class="text-center">
                            <div style="font-size: 0.8rem;margin: 0.3rem;">Регистрация с помощью</div>
                            <a href="<?= $google_link ?>"><img src="/assets/img/ui-icons/google_32.png"/></a>
                            <a href="<?= $ya_link ?>"><img src="/assets/img/ui-icons/yandex.png"/></a>
                            <a href="<?= $vk_link ?>"><img src="/assets/img/ui-icons/vk.png"/></a>
                            <a href="<?= $facebook_link ?>"><img src="/assets/img/ui-icons/facebook_32.png"/></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="fl_title">Ваши данные</div>
                    <div style="height: 10px;"></div>
                    <div class="fl_input_title">Контактный телефон*</div>
                    <div><input type="text" class="form-control input-lg phone" name="phone" id="phone" aria-describedby="nameHelp" type="phone"></div>
                    <div class="fl_input_title">Электронная почта*</div>
                    <div><input type="email" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp" type="email"></div>
                    <div class="fl_input_title">Пароль*</div>
                    <div><input type="password" class="form-control input-lg" name="password" id="password"></div>
                    <div class="fl_input_title">Повторить пароль*</div>
                    <div><input type="password" class="form-control input-lg" name="cpassword" id="cpassword"></div>
                    <div></div>
                </div>
            </div>
            <div class="row">
                <div class="col-mb-12">
                    <div class="check_indicator">
                        <label class="control control-checkbox">
                            <input type="checkbox" id="check_indicator" name="check_indicator" value="1" />
                            <div class="control-indicator"></div>
                            Я согласен с условиями и положениями
                        </label>
                    </div>
                    <div class="form_result" style="display: none;">

                    </div>
                    <input type="hidden" name="registration" />  
                    <button type="submit" class="btn btn-lg btn-primary btn-block mt-4 mb-4" style="margin-left: 1rem;">Отправить</button>
                    <div class="mb-3"></div>

                </div>
            </div>
        </div>
    </div>
</form>

<!-- Блок Авторизация -->
<div class="col-lg-12 show_form_auth" style="display: none;">
    <div class="card cart_fast_login">
        <div class="card-body p-5">

            <div class="fl_title mb-5">
                <span class="text-left">
                    Авторизация
                </span>
                <span class="text-right" style="float: right;margin-top: -10px;">
                    <a class="btn btngreen-outline align-self-center btn_show_other_form" href="javascript:void(0)">Регистрация</a>
                </span>
            </div>
            <form id="authorization" action="/jpost.php?extension=auth&url=none" method="POST">
                <div class="row">
                    <div class="form-group col-md-12 mb-4">
                        <input type="login" class="form-control input-lg" name="email" id="email" type="email" placeholder="Телефон / Эл. Почта" required />
                        <div class="valid-feedback">
                            принято!
                        </div>
                    </div>
                    <div class="form-group col-md-12 ">
                        <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Пароль" required />
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
                            Нет учетной записи <a class="text-blue btn_show_other_form" href="javascript:void(0)">Регистрация</a>
                        </div>
                    </div> 
                </div>
                <input type="hidden" name="authorization" />    
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        init_show_other_form();
        $('#authorization').sendPost(function (result) {
            //console.log("authorization ok");
            if (result['success'] == '1') {
                var h = '';
                h += '<div class="mb-2">Зравствуйте, ' + result['data']['first_name'] + ' ' + result['data']['last_name'] + '</div>';
                h += '<div class="mb-2">Можете продолжить покупку под своей учетной записью</div>';

                $(".cart_fast_login .card-body").html(h);
            } else {
                alert(result['errors'].toString());
            }
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

    function init_show_other_form() {
        $(".btn_show_other_form").unbind('click').click(function () {
            var show_form_auth = $(".show_form_auth").css("display");
            if (show_form_auth == 'block') {
                $(".show_form_registration").show(200);
                $(".show_form_auth").hide(200);
            } else {
                $(".show_form_registration").hide(200);
                $(".show_form_auth").show(200);
            }
        });
    }

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