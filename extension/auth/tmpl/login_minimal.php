<div class="">

    <div class="">
        <div class="content">							
            <div class="row">

                <!-- Обработка ошибок -->
                <?
                if (count($_SESSION['errors']) > 0) {
                    ?>
                    <div class="col-xl-5 col-lg-6 col-md-10 offset-md-3">
                        <div class="card">
                            <div class="card-body p-3">  
                                <?
                                foreach ($_SESSION['errors'] as $value) {
                                    ?>
                                    <div class="alert alert-danger" role="alert"><?= $value ?></div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?
                }
                ?>
                <!-- Обработка ошибок КОНЕЦ -->

                <!-- Блок Авторизация -->
                <? if (!isset($_GET['registrations'])): ?>
                    <div class="col-lg-8 col-md-10 offset-md-2">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="app-brand">
                                    <a href="/">
                                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                                             viewBox="0 0 30 33">
                                            <g fill="none" fill-rule="evenodd">
                                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                            </g>
                                        </svg>
                                        <span class="brand-name"><?= $_SESSION['site_name'] ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-5">

                                <h4 class="text-dark mb-5">Авторизация</h4>
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
                                                Нет учетной записи <a class="text-blue" href="/auth/?registrations">Регистрация</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <input type="hidden" name="authorization" />    
                                </form>
                            </div>
                        </div>
                    </div>
                <? endif; ?>

                <!-- Блок Регистрация -->
                <? if (isset($_GET['registrations'])): ?>
                    <div class="col-xl-5 col-lg-6 col-md-10 offset-md-3">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="app-brand">
                                    <a href="/">
                                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                                             height="33" viewBox="0 0 30 33">
                                            <g fill="none" fill-rule="evenodd">
                                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                            </g>
                                        </svg>
                                        <span class="brand-name"><?= $_SESSION['site_name'] ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <h4 class="text-dark mb-5">Регистрация</h4>
                                <form id="registration" action="/jpost.php?extension=auth" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" class="form-control input-lg phone" name="phone" id="phone" aria-describedby="nameHelp" type="phone" placeholder="Мобильный телефон">
                                        </div>
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp" type="email" placeholder="Адрес электронной почты">
                                        </div>
                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Пароль">
                                        </div>
                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" name="cpassword" id="cpassword" placeholder="Повторить пароль">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-inline-block mr-3">
                                                <label class="control control-checkbox">
                                                    <input type="checkbox" id="check_indicator" name="check_indicator" value="1" />
                                                    <div class="control-indicator"></div>
                                                    Я ознакомлен(-а) с условиями и положениями <a href="/privacy_policy/" target="_blank">Политики конфиденциальности</a> и даю <a href="/personal_data/" target="_blank">согласие на обработку персональных данных</a>
                                                </label>

                                            </div>
                                            <div class="form_result" style="display: none;">

                                            </div>

                                            <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Регистрация</button>
                                            <p>У меня есть уже аккаунт
                                                <a class="text-blue" href="/auth/">Авторизация</a>
                                            </p> 
                                        </div>
                                    </div>
                                    <input type="hidden" name="registration" />  
                                </form>

                            </div>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        </div>

        <!-- Блок подвала -->
        <footer class="footer mt-auto">
            <div class="copyright bg-white">
                <p>
                    &copy; <span id="copy-year"><?= date("Y") ?></span> Copyright by 
                    <a
                        class="text-primary"
                        href="/"
                        target="_blank"
                        ><?= $_SERVER['SERVER_NAME'] ?></a>.
                </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
        </footer                >

    </div>
</div>
<?
include 're_login.php';
?>
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