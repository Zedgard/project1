<?php

/*
 * Експорт продаж для бухгалтера
 */
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
$sqlLight = new \project\sqlLight();

$user = new \project\user();

if (!$user->isAdmin()) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    location_href('/');
    exit();
}
$from = (isset($_GET['from']) && strlen($_GET['from']) > 0) ? trim($_GET['from']) : '';
$to = (isset($_GET['to']) && strlen($_GET['to']) > 0) ? trim($_GET['to']) : '';

// Шапка
function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

// массив  в csv
function array2csv(array &$array) {
    if (count($array) == 0) {
        return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)),';');
    foreach ($array as $row) {
        fputcsv($df, $row,';');
    }
    fclose($df);
    return ob_get_clean();
}

// Придадим формат дате
function date_sql_format($date_str) {
    $arr = explode('.', $date_str);
    $date_new = "{$arr[2]}-{$arr[1]}-{$arr[0]}";
    return $date_new;
}

if (strlen($from) > 0 && strlen($to) > 0) {

    $from = date_sql_format($from);
    $to = date_sql_format($to);

    $query = "SELECT p.id, pt.pay_type_title, "
            . "u.email, u.phone, u.first_name, u.last_name, "
            . "p.pay_sum, p.pay_date, p.payment_bank, p.pay_status, p.pay_descr "
            . "FROM zay_pay p "
            . "left join zay_pay_type pt on pt.pay_type_code=p.pay_type "
            . "left join zay_users u on u.id=p.user_id "
            . "where p.pay_date BETWEEN '? 00:00:00' and '? 23:59:59' " //p.pay_status='succeeded'
            . "ORDER BY p.pay_date DESC";
    
            
    $sqlLight->setMysqliAssos();
    $data = $sqlLight->queryList($query, array($from, $to), 0);
    if (count($data) > 0) {
        //foreach ($data as $key => $value) {
        download_send_headers("data_export___{$from}-{$to}.csv");
        echo array2csv($data);

        //}
    }
} else {
    echo 'Не верные параметры!';
}

