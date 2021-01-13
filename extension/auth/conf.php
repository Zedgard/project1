<?php

$config = array(
    'title' => $lang['auth'][$_SESSION['lang']]['title'],
    'descr' => $lang['auth'][$_SESSION['lang']]['descr'],
    'urls' => array(
        $lang['statistic'][$_SESSION['lang']]['extension_admin'] => '/extension/auth/admin.php',
        $lang['statistic'][$_SESSION['lang']]['extension_index'] => '/extension/auth/index.php'
    ),
    'version' => '0.1'
);
