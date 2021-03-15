<?php
// phpinfo();
// e159086ea548b2a39a6d0359aa083e9f9c63d2cb

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/wordpress/class-phpass.php';

// Объявляем класс
//$wp_hasher = new PasswordHash( 8, TRUE );
//
//$user_password = 'Kopass1987';
//$db_pass = '$P$B7Pl7ji14CO7GAsiajYqZzhf2I0xY5/';
//
//// Проверка пароль
//var_dump($wp_hasher->CheckPassword('Kopass1987', $db_pass));
//echo "<br/>\n";
//
//// Создать пароль
//echo "Pass: {$wp_hasher->HashPassword( trim( $user_password ) )} ";
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css<?= $_SESSION['rand'] ?>" 
              integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
              crossorigin="anonymous">
        <!-- FAVICON -->
        <link href="/favicon.ico" rel="shortcut icon" />
        <script src="/assets/plugins/jquery/jquery.js<?= $_SESSION['rand'] ?>"></script>
        <link href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.min.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />
        <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js<?= $_SESSION['rand'] ?>"></script>
        <link href="/assets/css/sleek.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
        <script src="/assets/js/ajax.js<?= $_SESSION['rand'] ?>"></script>   

        <link href="/assets/css/sleek.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
        <script src="/assets/js/sleek.bundle.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/js/sleek.js<?= $_SESSION['rand'] ?>"></script>
        <link rel="stylesheet" href="/extension/products/office.css<?= $_SESSION['rand'] ?>">
        <link href="/extension/wares/css/edit_videos.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
        <link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css">
        <script src="/assets/plugins/calamansi/calamansi.min.js"></script>
    </head>
    <body class="header-fixed sidebar-fixed sidebar-dark header-light">
        <div class="player-block float-left">
            <div id="calamansi-player-<?= $union_elm_id ?>">
                Загрузка плеера... 
            </div>
        </div>
        <script>
            Calamansi.autoload();
            // document.getElementById('full-demo-player')
            //document.querySelector('#calamansi-player-<?= $union_elm_id ?>')
            new Calamansi(
                    document.querySelector('#calamansi-player-<?= $union_elm_id ?>'), {
                skin: '/assets/plugins/calamansi/skins/basic_download',
                playlists: {
                    'Classics': [
                        {
                            source: 'https://download.edgardzaitsev.com/catalog/meditations/meditatsiya-razgovor-s-sudej.mp3',
                        }
                    ],
                },
                defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
            });

            //player.destroy();
        </script>
        <a href="https://download.edgardzaitsev.com/catalog/meditations/meditatsiya-razgovor-s-sudej.mp3" target="_blank" class="clmns--link clmns--track-info clmns--track-info--url" style="color: red; visibility: visible;"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 124 124"><path fill="#48cf3a" d="M6,123.15h112c3.3,0,6-2.7,6-6v-12c0-3.3-2.7-6-6-6H6c-3.3,0-6,2.7-6,6v12C0,120.45,2.6,123.15,6,123.15z M70.4,0.85H53.5c-3.4,0-6.2,2.8-6.2,6.2v25c0,3.4-2.8,6.2-6.2,6.2H30.3c-5.2,0-8.1,6-4.9,10.1l31.1,40c2.5,3.199,7.4,3.199,9.9,0l32-40c3.199-4.1,0.3-10.1-5-10.1H82.8c-3.399,0-6.2-2.8-6.2-6.2v-25C76.6,3.65,73.8,0.85,70.4,0.85z"></path></svg></a>


    </body>
</html>