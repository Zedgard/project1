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
        <script src="/assets/js/init.js<?= $_SESSION['rand'] ?>"></script>   
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





        <!-- https://www.youtube.com/embed/hPXX4vzw0kk -->
         <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
        <div id="player"></div>

        <script>
            // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');

            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '360',
                    width: '50%',
                    videoId: 'hPXX4vzw0kk',
                    playerVars: {
                        enablejsapi: 1,
                        disablekb: 1,
                        controls: 0,
                        iv_load_policy: 3,
                        loop: 1,
                        modestbranding: 1,
                        rel: 0,
                        showinfo: 0,
                        origin = 1
                    },
                    events: {
                        'onReady': onPlayerReady,
                        //'onStateChange': onPlayerStateChange
                    }
                });
            }

            // 4. The API will call this function when the video player is ready.
            function onPlayerReady(event) {
                event.target.playVideo();
                var d = event.target.getDuration();
                var o = event.target.getIframe();
                console.log('D: ' + d);
                console.log(o);
            }

            // 5. The API calls this function when the player's state changes.
            //    The function indicates that when playing a video (state=1),
            //    the player should play for six seconds and then stop.
            var done = false;
            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING && !done) {
                    setTimeout(stopVideo, 6000);
                    done = true;
                }
            }
            function stopVideo() {
                player.stopVideo();
            }
        </script>



    </body>
</html>