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

/*
 * Функции
 */

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
    header("content-type: application/csv;charset=WINDOWS-1251");

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
    fputcsv($df, array_keys(reset($array)), ';');
    foreach ($array as $row) {
        $s = mb_convert_encoding($row, "WINDOWS-1251", "UTF-8");
        fputcsv($df, $s, ';');
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

/*
 * Процесс
 */
if ($user->isEditor()) {
    $from = (isset($_GET['from']) && strlen($_GET['from']) > 0) ? trim($_GET['from']) : '';
    $to = (isset($_GET['to']) && strlen($_GET['to']) > 0) ? trim($_GET['to']) : '';



    if (strlen($from) > 0 && strlen($to) > 0) {
        //print_r($_SESSION['admin_pay_filter']);
        $from = date_sql_format($_SESSION['admin_pay_filter']['excel_from']);
        $to = date_sql_format($_SESSION['admin_pay_filter']['excel_to']);

        $search_pay_user_str = $_SESSION['admin_pay_filter']['search_pay_user_str'];
        $pay_search_type = $_SESSION['admin_pay_filter']['pay_search_type'];
        $pay_search_status = $_SESSION['admin_pay_filter']['pay_search_status'];

        $queryArray = array();
        $w = array();
        if (strlen($from) > 0 && strlen($to) > 0) {
            $queryArray[] = $from;
            $queryArray[] = $to;
            $w[] = "p.pay_date BETWEEN '? 00:00:00' and '? 23:59:59' ";
        }
        if (strlen($pay_search_type) > 0) {
            $queryArray[] = $pay_search_type;
            $w[] = "p.pay_type='?'";
        }
        if (strlen($pay_search_status) > 0) {
            $queryArray[] = $pay_search_status;
            $w[] = "p.pay_status='?'";
        }
        if (strlen($search_pay_user_str) > 0) {
            $queryArray[] = $search_pay_user_str;
            $queryArray[] = $search_pay_user_str;
            $w[] = "(u.email like '%?%' or u.phone like '%?%') "; //pt.pay_type_title like '%?%'
        }
        //print_r($w);
        if (count($w) > 0) {
            $where = 'WHERE ' . implode(' and ', $w);
        }

        $query = "SELECT p.id, pt.pay_type_title, "
                . "u.email, u.phone, u.first_name, u.last_name, "
                . "p.pay_sum, p.pay_date, p.payment_bank, p.pay_status, p.pay_descr,"
                . " (
                SELECT
                    GROUP_CONCAT(pr.title)
                FROM
                    zay_pay_products pps
                LEFT JOIN zay_product pr ON
                    pr.id = pps.product_id
                WHERE
                    pps.pay_id = p.id
            ) AS product_list "
                . "FROM zay_pay p "
                . "left join zay_pay_type pt on pt.pay_type_code=p.pay_type "
                . "left join zay_users u on u.id=p.user_id "
                . "{$where} " //where p.pay_date BETWEEN '? 00:00:00' and '? 23:59:59' p.pay_status='succeeded'
                . "ORDER BY p.pay_date DESC";



        $sqlLight->setMysqliAssos();
        $data = $sqlLight->queryList($query, $queryArray, 0);
        //exit();
        if (count($data) > 0) {
            //foreach ($data as $key => $value) {
            download_send_headers("data_export___{$from}-{$to}.csv");
            echo array2csv($data);

            //}
        } else {
            echo 'Записей не найдено!';
        }
    } else {
        echo 'Не верные параметры!';
    }
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    ?><div>Нет прав доступа для просмотра информации</div><?
    //location_href('/');
    exit();
}
