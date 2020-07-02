<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


        <title>Form Validation - Sleek Admin Dashboard Template</title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


        <!-- PLUGINS CSS STYLE -->
        <link href="/assets/panel/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />



        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="/assets/panel/assets/css/sleek.css" />

        <!-- FAVICON -->
        <link href="/assets/panel/assets/img/favicon.png" rel="shortcut icon" />



        <!--
          HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
        -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="/assets/panel/assets/plugins/nprogress/nprogress.js"></script>
    </head>


    <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

        <script>
            NProgress.configure({showSpinner: false});
            NProgress.start();
        </script>



        <div class="wrapper">
            <!-- Github Link -->
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




            <div class="">



                <div class="content-wrapper">
                    <div class="content">							
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-default">
                                    <div class="card-header card-header-border-bottom">
                                        <h2>Авторизация</h2>
                                    </div>
                                    <div class="card-body">
                                        <form >
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationServer01">First name</label>
                                                    <input type="text" class="form-control" id="validationServer01" placeholder="First name" value="Md" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationServer02">Last name</label>
                                                    <input type="text" class="form-control" id="validationServer02" placeholder="Last name" value="Rahad" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationServerUsername">Username</label>
                                                    <input type="text" class="form-control" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3"
                                                           required>
                                                    <div class="invalid-feedback">
                                                        Please choose a username.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationServer03">City</label>
                                                    <input type="text" class="form-control" id="validationServer03" placeholder="City" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid city.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServer04">State</label>
                                                    <input type="text" class="form-control" id="validationServer04" placeholder="State" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid state.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServer05">Zip</label>
                                                    <input type="text" class="form-control" id="validationServer05" placeholder="Zip" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid zip.
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card card-default">
                                    <div class="card-header card-header-border-bottom">
                                        <h2>Регистрация</h2>
                                    </div>
                                    <div class="card-body">
                                        <form >
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationServer01">First name</label>
                                                    <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="Md"
                                                           required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationServer02">Last name</label>
                                                    <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Rahad"
                                                           required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationServerUsername">Username</label>
                                                    <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Username"
                                                           aria-describedby="inputGroupPrepend3" required>
                                                    <div class="invalid-feedback">
                                                        Please choose a username.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationServer03">City</label>
                                                    <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="City" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid city.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServer04">State</label>
                                                    <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="State" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid state.
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServer05">Zip</label>
                                                    <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid zip.
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

                </div>

                <footer class="footer mt-auto">
                    <div class="copyright bg-white">
                        <p>
                            &copy; <span id="copy-year"><?= date("Y")?></span> Copyright by 
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

        <script src="/assets/panel/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/panel/assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
        <script src="/assets/panel/assets/plugins/jekyll-search.min.js"></script>



        <script src="/assets/panel/assets/js/sleek.bundle.js"></script>
    </body>

</html>