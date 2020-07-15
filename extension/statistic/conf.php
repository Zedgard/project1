<?php

$config = array(
    'title' => $lang['statistic'][$_SESSION['lang']]['title'],
    'descr' => $lang['statistic'][$_SESSION['lang']]['descr'],
    'urls' => array(
        $lang['statistic'][$_SESSION['lang']]['extension_admin'] => '/extension/statistic/admin.php',
        $lang['statistic'][$_SESSION['lang']]['extension_index'] => '/extension/statistic/index.php'
    ),
    'version' => '0.1'
);
