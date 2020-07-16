<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


        <title><?= $_SESSION['site_title'] ?></title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


        <!-- PLUGINS CSS STYLE -->
        <link href="/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />

        <!-- No Extra plugin used -->

        <link href="/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />

        <link href="/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

        <link href="/assets/plugins/toastr/toastr.min.css" rel="stylesheet" />

        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="/assets/css/sleek.css" />

        <!-- FAVICON -->
        <link href="/assets/img/favicon.png" rel="shortcut icon" />

        <!--
          HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
        -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="/assets/plugins/nprogress/nprogress.js"></script>
    </head>


    <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

        <script>
            NProgress.configure({showSpinner: false});
            NProgress.start();
        </script>


        <div id="toaster"></div>


        <div class="wrapper">
            <!-- Github Link -->
            <a href="/"  target="_blank" class="github-link" title="<?= $lang['link_go_home_page'] ?>">
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

            <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
            -->
            <aside class="left-sidebar bg-sidebar">
                <div id="sidebar" class="sidebar ">
                    <!-- Aplication Brand -->
                    <div class="app-brand">
                        <a href="/admin/" title="<?= $_SESSION['page']['page_title'] ?>">
                            <svg
                                class="brand-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                preserveAspectRatio="xMidYMid"
                                width="30"
                                height="33"
                                viewBox="0 0 30 33"
                                >
                            <g fill="none" fill-rule="evenodd">
                            <path
                                class="logo-fill-blue"
                                fill="#7DBCFF"
                                d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                                />
                            <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                            </g>
                            </svg>
                            <span class="brand-name text-truncate">Админ панель</span>
                        </a>
                    </div>
                    <!-- begin sidebar scrollbar -->
                    <? 
                    include 'menu_left.php';
                    ?>


                </div>
            </aside>


            <div class="page-wrapper">
                <!-- Header -->
                <header class="main-header " id="header">
                    <nav class="navbar navbar-static-top navbar-expand-lg">
                        <!-- Sidebar toggle button -->
                        <button id="sidebar-toggler" class="sidebar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                        </button>
                        <!-- search form -->
                        <div class="search-form d-none d-lg-inline-block">
                            <div class="input-group">
                                <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                                <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc."
                                       autofocus autocomplete="off" />
                            </div>
                            <div id="search-results-container">
                                <ul id="search-results"></ul>
                            </div>
                        </div>

                        <div class="navbar-right ">
                            <ul class="nav navbar-nav">
                                <li class="dropdown notifications-menu">
                                    <button class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="mdi mdi-bell-outline"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-header">You have 5 notifications</li>
                                        <li>
                                            <a href="#">
                                                <i class="mdi mdi-account-plus"></i> New user registered
                                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="mdi mdi-account-remove"></i> User deleted
                                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 07 AM</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 12 PM</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="mdi mdi-account-supervisor"></i> New client
                                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="mdi mdi-server-network-off"></i> Server overloaded
                                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 AM</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-footer">
                                            <a class="text-center" href="#"> View All </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="right-sidebar-in right-sidebar-2-menu">
                                    <i class="mdi mdi-settings mdi-spin"></i>
                                </li>
                                <!-- User Account -->
                                <li class="dropdown user-menu">
                                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                        <img src="/assets/img/user/user.png" class="user-image" alt="User Image" />
                                        <span class="d-none d-lg-inline-block">Abdus Salam</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <!-- User image -->
                                        <li class="dropdown-header">
                                            <img src="/assets/img/user/user.png" class="img-circle" alt="User Image" />
                                            <div class="d-inline-block">
                                                Abdus Salam <small class="pt-1">iamabdus@gmail.com</small>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="user-profile.html">
                                                <i class="mdi mdi-account"></i> My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="mdi mdi-email"></i> Message
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"> <i class="mdi mdi-diamond-stone"></i> Projects </a>
                                        </li>
                                        <li class="right-sidebar-in">
                                            <a href="javascript:0"> <i class="mdi mdi-settings"></i> Setting </a>
                                        </li>

                                        <li class="dropdown-footer">
                                            <a href="index.html"> <i class="mdi mdi-logout"></i> Log Out </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>


                </header>


                <div class="content-wrapper">
                    <div class="content">						 
                        
                       <?= $_SESSION['page']['block_center'] ?>
                  
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
                            &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                            <a
                                class="text-primary"
                                href="http://www.iamabdus.com/"
                                target="_blank"
                                >Abdus</a
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

        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
        <script src="/assets/plugins/jekyll-search.min.js"></script>



        <script src="/assets/plugins/charts/Chart.min.js"></script>



        <script src="/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>



        <script src="/assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script>
                        jQuery(document).ready(function () {
                            jQuery('input[name="dateRange"]').daterangepicker({
                                autoUpdateInput: false,
                                singleDatePicker: true,
                                locale: {
                                    cancelLabel: 'Clear'
                                }
                            });
                            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                            });
                            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                                jQuery(this).val('');
                            });

                        });
                        window.isMinified = <?= $_SESSION['system']['sidebar_toggler'] ?>;
                        window.isCollapsed = false;
        </script>



        <script src="/assets/plugins/toastr/toastr.min.js"></script>

    <scritp>

    </script>
    <script src="/assets/js/sleek.bundle.js"></script>
</body>

</html>
