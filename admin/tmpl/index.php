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

        <? include $_body ?>

        <script src="/assets/panel/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/panel/assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
        <script src="/assets/panel/assets/plugins/jekyll-search.min.js"></script>
        <script src="/assets/panel/assets/js/sleek.bundle.js"></script>
        <script src="/assets/panel/assets/plugins/select2/js/select2.min.js"></script>
        <script src="/assets/panel/assets/plugins/jquery-mask-input/jquery.mask.min.js"></script>

        <?
        foreach ($_body_javascript as $value) {
            echo $value . "<br/>\n";
        }
        ?>

    </body>

</html>