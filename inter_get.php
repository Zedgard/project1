<?php
include $_SERVER['DOCUMENT_ROOT'] . '/system/ik-php-master/interkassa.php';
Interkassa::register();

$shop_id = '5f5dfdf8f3f7ad5888515cd6';
$secret_key = 'd5fWukz9AQxhWKH5';

// Create a shop
?>
<form name = "payment" method = "post" action = "https://sci.interkassa.com/" accept-charset = "UTF-8">
    <input type = "hidden" name = "ik_co_id" value = "5f5dfdf8f3f7ad5888515cd6"/>
    <input type = "hidden" name = "ik_inv_id" value = "244440086"/>
    <input type = "hidden" name = "ik_inv_st" value = "success"/>
    <input type = "hidden" name = "ik_pm_no" value = "1"/>
    <input type = "submit" value = "Check">
</form>
