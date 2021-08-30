<?
session_start();
//print_r($_SESSION['user']);
//echo 'user_id: ' . $_SESSION['user']['info']['id'];
if (isset($_SESSION['user']['info']['id']) && $_SESSION['user']['info']['id'] > 0) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
            <title>elFinder</title>

            <!-- jQuery UI (REQUIRED) -->
            <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css?v=<?= rand() ?>">
            <!-- elFinder CSS (REQUIRED) -->
            <link rel="stylesheet" type="text/css" href="/system/elfinder/css/elfinder.full.css?v=<?= rand() ?>">
            <link rel="stylesheet" type="text/css" href="/system/elfinder/css/theme.css?v=<?= rand() ?>">
            <script src="/assets/plugins/jquery/jquery.js?v=1515819968"></script>

            <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.css?v=<?= rand() ?>">
            <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.theme.css?v=<?= rand() ?>">
            <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js?v=<?= rand() ?>"></script>
            <!-- elFinder JS (REQUIRED) -->
            <script src="/system/elfinder/js/elfinder.min.js?v=<?= rand() ?>"></script>
            <!-- Extra contents editors (OPTIONAL) -->
            <script src="/system/elfinder/js/extras/editors.default.js?v=<?= rand() ?>"></script>

        </head>
        <body>

            <div id="elfinder"></div>

        </body>
        <script>
            $(document).ready(function () {
                $('#elfinder').elfinder({
                    cssAutoLoad: false, // Disable CSS auto loading
                    baseUrl: './', // Base URL to css/*, js/*
                    url: '/system/elfinder/php/connector.minimal.php', // connector URL (REQUIRED)
                    lang: 'ru', // language (OPTIONAL)
                    getFileCallback: function (file) { // editor callback
                        alert(file.url); // pass selected file path to TinyMCE
                    }
                }).elfinder('instance');
            });
        </script>
    </html>
    <?
}
?>