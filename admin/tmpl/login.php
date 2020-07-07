<div class="wrapper">

    <!-- Home Link -->
    <a href="/"  target="_blank" class="github-link" title="Главная страница">
        <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
            <defs>
                <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#896def;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#482271;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M 0,0 L115,115 L115,115 L142,142 L250,250 L250,0 Z" fill="url(#grad1)"></path>
        </svg>
        <i class="mdi mdi-home"></i>
    </a>


    <div class="wrapper">

        <div class="content-wrapper">
            <div class="content">							
                <div class="row">

                    <? if (!isset($_GET['registrations'])): ?>
                        <div class="col-xl-5 col-lg-6 col-md-10 offset-md-3">
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
                                    <form action="/">
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-4">
                                                <input type="login" class="form-control input-lg" id="email" aria-describedby="emailHelp" type="email" placeholder="Телефон / Эл. Почта" required />
                                                <div class="valid-feedback">
                                                    принято!
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <input type="password" class="form-control input-lg" id="password" placeholder="Пароль" required />
                                                <div class="valid-feedback">
                                                    принято!
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-flex my-2 justify-content-between">
                                                    <p><a class="text-blue" href="#">Забыли пароль?</a></p>
                                                </div>
                                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Авторизация</button>
                                                <p>
                                                    Нет учетной записи
                                                    <a class="text-blue" href="?registrations">Регистрация</a>
                                                </p>
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>

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
                                    <form action="/index.html">
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-4">
                                                <input type="text" class="form-control input-lg" id="phone" data-mask="+7 (999) 999-9999" aria-describedby="nameHelp" type="phone" placeholder="Мобильный телефон">
                                            </div>
                                            <div class="form-group col-md-12 mb-4">
                                                <input type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" type="email" placeholder="Адрес электронной почты">
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <input type="password" class="form-control input-lg" id="password" placeholder="Пароль">
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <input type="password" class="form-control input-lg" id="cpassword" placeholder="Повторить пароль">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-inline-block mr-3">
                                                    <label class="control control-checkbox">
                                                        <input type="checkbox" id="check_indicator" value="1" />
                                                        <div class="control-indicator"></div>
                                                        Я согласен с условиями и положениями
                                                    </label>

                                                </div>
                                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Регистрация</button>
                                                <p>У меня есть уже аккаунт
                                                    <a class="text-blue" href="./index.php">Авторизация</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>



            <div class="right-sidebar-2">
                <div class="right-sidebar-container-2">
                    <div class="slim-scroll-right-sidebar-2">

                        <div class="right-sidebar-2-header">
                            <h2>Layout Settings</h2>
                            <p>User Interface Settings</p>
                            <div class="btn-close-right-sidebar-2">
                                <i class="mdi mdi-window-close"></i>
                            </div>
                        </div>

                        <div class="right-sidebar-2-body">
                            <span class="right-sidebar-2-subtitle">Header Layout</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 header-fixed-to btn-right-sidebar-2-active">Fixed</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 header-static-to">Static</a>
                            </div>

                            <span class="right-sidebar-2-subtitle">Sidebar Layout</span>
                            <div class="no-col-space">
                                <select class="right-sidebar-2-select" id="sidebar-option-select">
                                    <option value="sidebar-fixed">Fixed Default</option>
                                    <option value="sidebar-fixed-minified">Fixed Minified</option>
                                    <option value="sidebar-fixed-offcanvas">Fixed Offcanvas</option>
                                    <option value="sidebar-static">Static Default</option>
                                    <option value="sidebar-static-minified">Static Minified</option>
                                    <option value="sidebar-static-offcanvas">Static Offcanvas</option>
                                </select>
                            </div>

                            <span class="right-sidebar-2-subtitle">Header Background</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active header-light-to">Light</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 header-dark-to">Dark</a>
                            </div>

                            <span class="right-sidebar-2-subtitle">Navigation Background</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active sidebar-dark-to">Dark</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 sidebar-light-to">Light</a>
                            </div>

                            <span class="right-sidebar-2-subtitle">Direction</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active ltr-to">LTR</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 rtl-to">RTL</a>
                            </div>

                            <div class="d-flex justify-content-center" style="padding-top: 30px">
                                <div id="reset-options" style="width: auto; cursor: pointer" class="btn-right-sidebar-2 btn-reset">Reset
                                    Settings</div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>



            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year"><?= date("Y") ?></span> Copyright by 
                        <a
                            class="text-primary"
                            href="/"
                            target="_blank"
                            ><?= $_SESSION['site_name'] ?></a
                        >.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>
</div>