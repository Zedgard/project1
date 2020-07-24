<?php

$config = array(
    'title' => $lang['pages'][$_SESSION['lang']]['title'],
    'descr' => $lang['pages'][$_SESSION['lang']]['descr'],
    'urls' => array(
        $lang['statistic'][$_SESSION['lang']]['extension_admin'] => '/extension/users/admin.php',
        $lang['statistic'][$_SESSION['lang']]['extension_index'] => '/extension/users/index.php'
    ),
    'version' => '0.1'
);
