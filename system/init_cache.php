<?php

/*
 * Инициализация кеширования
 */
$cache = fast_mysql_select_data("SELECT c.config_val FROM `zay_configs` c WHERE config_code='site_cache_on'")[0]['config_val'];
// cache = 0 Отключает кэширование
if ($cache == 0) {
    opcache_reset();
    include_once 'cache.php';
} else {
    $_SESSION['rand'] = '';
}