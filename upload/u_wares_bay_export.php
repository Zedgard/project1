<?php

/*
 * Импортирование покупок пользователей, можно запускать по крон заданию или вручную
 * /upload/u_wares_bay_export.php
 * 
 * Почистить записи
 * /upload/u_wares_bay_export.php?clear=1
 * 
 * 
 * 127111
 */
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
$sqlLight = new \project\sqlLight();

if (isset($_GET['clear'])) {
    // SELECT pp.id FROM zay_pay_products pp WHERE pp.pay_id in(SELECT p.id FROM zay_pay p WHERE p.pay_type='wp')
    $objs = $sqlLight->queryList("SELECT p.id FROM zay_pay p WHERE p.pay_type='wp'");
    foreach ($objs as $value) {
        if ($sqlLight->query("DELETE FROM zay_pay_products WHERE pay_id=? ", array($value['id']), 0)) {
            //echo "{$value['id']} ok<br/>\n"; 
        }
    }
    $sqlLight->query("DELETE FROM zay_pay WHERE pay_type='wp' ");
    $sqlLight->query("UPDATE `zay_import` SET `val`='0' WHERE `code`='wp_pays'");
    
    echo 'Clear OK!';
    exit();
}

/**
 * Запись о продажи
 * @param type $table
 * @param array $params
 */
function updateOrInsertData($data, $user_id) {
    // $wares_ex_code, $product_price, $user_id, $pay_date
    $sqlLight = new \project\sqlLight();
    $product_price = (strlen(trim($data['_order_total'])) > 0) ? $data['_order_total'] : 0;

    // Получим местный ID товара
    $wares_id = 0;
    $queryWaresId = "select * from `zay_wares` w WHERE w.`ex_code`='?'";
    $wares_id = $sqlLight->queryList($queryWaresId, array($data['product_id']), 1)[0]['id'];

    // Получим по товару связанный продукт 
    $queryProducts = "SELECT pw.`product_id`, pw.`wares_id`, "
            . "(select count(*) from zay_product_wares pw2 where pw2.`product_id`=pw.`product_id`) as wares_col "
            . "FROM `zay_product_wares` pw "
            . "WHERE pw.`wares_id` = '?' "
            . "and pw.`product_id` is not null ";
    $products = $sqlLight->queryList($queryProducts, array($wares_id), 0);
    $p = 0;
    foreach ($products as $key => $value) {
        if ($value['wares_col'] == 1) {
            $p = $value['product_id'];
        }
    }
    // Если есть товар то создаем покупку
    if ($p > 0) {
        //echo "p: {$p} <br/>\n";
        //if ($p > 0) {
        // Найдем купленные продукты
        $col = 0;
        if ($wares_id > 0) {
            $query = "SELECT count(*) as col FROM zay_pay p
                LEFT JOIN zay_pay_products pp on pp.pay_id=p.id
                LEFT JOIN zay_product_wares pw on pw.product_id=pp.product_id
                where p.user_id='?' and p.pay_status='succeeded' and pw.wares_id='?' "; //and pw.wares_id is not null
            //  LEFT JOIN zay_wares w on w.id=pw.wares_id
            $col = $sqlLight->queryList($query, array($user_id, $wares_id), 1)[0]['col'];
        }
//    $query = "SELECT * FROM `zay_pay_products` pp "
//            . "left join `zay_pay` p on p.`id`=pp.`pay_id`"
//            . "where pp.`product_id`='{$p}' and p.`user_id`='{$user_id}' ";
//    $objs = $sqlLight->queryList($query);
        if ($col == 0) {
            // Создание новой записи
            $queryInsert = "INSERT INTO `zay_pay`(`pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `payment_type`, `payment_c`, `payment_bank`, `pay_status`, `pay_descr`, `confirmationUrl`, `pay_interkassa_id`, `processed`) "
                    . "VALUES ('wp','{$user_id}','{$product_price}','{$data['_paid_date']}','{$data['_transaction_id']}','{$data['_payment_method']}','','','succeeded','{$data['_payment_method_title']}','','','1')";
            if ($sqlLight->query($queryInsert, array(), 0)) {
                echo "INSERT INTO `zay_pay` true <br/>\n";
                $qq = "select max(p.id) as col from `zay_pay` p";
                $pay_id = $sqlLight->queryList($qq)[0]['col'];



                // Добавим связь покупки и продукта
                $q = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`, `creat_date`) "
                        . "VALUES ('{$pay_id}','{$p}','{$product_price}','{$data['_paid_date']}')";
                if ($sqlLight->query($q, array(), 0)) {
                    echo "-- INSERT {$wares_id} {$user_id} true<br/>\n";
                }
            } else {
                echo "-- INSERT {$wares_id} {$user_id} false<br/>\n";
            }
        }
    }
    // Отметим что данные импортировали
    $queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_pays'";
    $sqlLight->query($queryInsert, array($user_id));

}

// получим данные по импорту
$external_code = 0;
try {
    $user_id = $sqlLight->queryList("select * from `zay_import` i WHERE i.`code`='?' ", array('wp_pays'))[0]['val'];
} catch (Exception $exc) {
    exit('В таблице "zay_import" отсутствует запись! ' . $exc);
}
echo "external_code: {$user_id} <br/>\n";

/*
 * Получим код пользователя
 */
$queryInsertImport = "SELECT * FROM `zay_users` u where u.`id`>'?' and u.`external_code`>0 ORDER BY `id` ASC limit 1";
$users = $sqlLight->queryList($queryInsertImport, array($user_id));
//print_r($obj_imports);
//echo "----------<br/>\n\n";

if (count($users) > 0) {
    /*
     * Импортируем данные из другой базы
     */
    foreach ($users as $value) {
        unset($sqlLight);
        include $_SERVER['DOCUMENT_ROOT'] . '/config_old.php';
        $sqlLight = new \project\sqlLight();
//        $q = "";
//        $external_code = $value['external_code'];
//        $external_email = $value['email'];
//        //echo "external_email: {$external_email} <br/>\n";
//        $q = "SELECT pp.`permission_id`, pp.`download_id`, "
//                . "pp.`product_id`, pp.`order_id`, pp.`order_key`, pp.`user_email`, pp.`user_id`, "
//                . "pp.`downloads_remaining`, pp.`access_granted`, pp.`access_expires`, pp.`download_count`, "
//                . "(SELECT pm.`meta_value` FROM `wp_postmeta` pm WHERE pm.`post_id` = pp.`product_id` and pm.`meta_key`='_regular_price' and pm.`meta_value`>0 limit 1 ) as price "
//                . "FROM `wp_woocommerce_downloadable_product_permissions` pp "
//                . "left join `wp_posts` wp on wp.`ID`=pp.`product_id` "
//                . "where pp.`user_email`='{$external_email}' and wp.`ID` is not null";
        $q = "SELECT DISTINCT
                p.ID,
                p.post_status,
                p.post_date,
                p.post_title,
                dpp.product_id,
                (select p1.meta_value from wp_postmeta p1 where p1.post_id=p.id and p1.meta_key='_transaction_id') as _transaction_id,
                (select p2.meta_value from wp_postmeta p2 where p2.post_id=p.id and p2.meta_key='_payment_method' LIMIT 1) as _payment_method,
                (select p3.meta_value from wp_postmeta p3 where p3.post_id=p.id and p3.meta_key='_payment_method_title' LIMIT 1) as _payment_method_title,    
                (select p4.meta_value from wp_postmeta p4 where p4.post_id=p.id and p4.meta_key='_paid_date' LIMIT 1) as _paid_date,    
                (select p5.meta_value from wp_postmeta p5 where p5.post_id=p.id and p5.meta_key='_completed_date' LIMIT 1) as _completed_date, 
                (select p6.meta_value from wp_postmeta p6 where p6.post_id=p.id and p6.meta_key='_billing_email' LIMIT 1) as _billing_email,  
                (select p7.meta_value from wp_postmeta p7 where p7.post_id=p.id and p7.meta_key='_billing_phone') as _billing_phone,  
                (select p8.meta_value from wp_postmeta p8 where p8.post_id=p.id and p8.meta_key='_order_currency') as _order_currency, 
                (select p9.meta_value from wp_postmeta p9 where p9.post_id=p.id and p9.meta_key='_order_total') as _order_total, 
                (select p10.meta_value from wp_postmeta p10 where p10.post_id=p.id and p10.meta_key='_paypal_status') as _paypal_status
            FROM
                wp_posts p
                LEFT JOIN wp_woocommerce_downloadable_product_permissions dpp on dpp.order_id=p.ID
                LEFT JOIN wp_postmeta pm ON
                pm.post_id = p.ID
            WHERE
                p.post_type = 'shop_order' AND p.post_status = 'wc-completed' and pm.meta_value='?'";

        $wp_pays = $sqlLight->queryList($q, array($value['email']), 1);
        //echo 'wp_pays'."<br/>\n";
        print_r($wp_wares);
        exit();
        if (count($wp_pays) > 0) {
            unset($sqlLight);
            include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
            //exit();

            foreach ($wp_pays as $w_value) {
                echo "----------<br/>\n";
                updateOrInsertData($w_value, $value['id']);
                // $w_value['product_id'], $w_value['price'], $value['id'], $w_value['access_granted']
            }
        }
    }
}

