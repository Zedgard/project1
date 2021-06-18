<?php

/*
 * Инициализация кеширования
 */
//$cache = fast_mysql_select_data("SELECT c.config_val FROM `zay_configs` c WHERE config_code='site_cache_on'")[0]['config_val']; // старая реализация кэширования
$session_number = fast_mysql_select_data("SELECT c.config_val FROM `zay_configs` c WHERE config_code='session_number'")[0]['config_val'];
// cache = 0 Отключает кэширование
//if ($cache == 0) {
//    opcache_reset();
//    include_once 'cache.php';
//} else {
//    $_SESSION['rand'] = '';
//}
if (!isset($_SESSION['session_number'])) {
    $_SESSION['session_number'] = 0;
}
if ($session_number > 0) {
    if ($_SESSION['session_number'] <> $session_number) {
        $_SESSION['session_number'] = $session_number;
        opcache_reset();
        include_once 'cache.php';
    }
    $_SESSION['rand'] = '?v=' . $session_number; //mt_rand(1000, 9999);
}