<?php

namespace project;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
/*
 * $_SESSION['user']['info']
 */

class pay extends \project\extension {

    private $page_max = 10; // Колличество на страницу
    private $pay_data_count = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список операция
     * @param type $page_number
     * @return type
     */
    public function pay_data_list($page_number, $search_pay_user_str, $excel_from = '', $excel_to = '', $pay_search_type = '', $pay_search_status = '') {
        //$queryCount = "SELECT count(*) as col FROM `zay_pay`";
        //$this->pay_data_count = $this->getSelectArray($queryCount)[0]['col'];
        $sqlLight = new \project\sqlLight();
        $queryArray = array();
        $w = array();
        if (strlen($excel_from) > 0 && strlen($excel_to) > 0) {
            $queryArray[] = date_sql_format($excel_from);
            $queryArray[] = date_sql_format($excel_to);
            $w[] = "p.pay_date BETWEEN '? 00:00:00' AND '? 23:59:59' ";
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
        $queryArray[] = ($page_number * $this->page_max);

        $querySelect = "SELECT p.*, pt.pay_type_title, "
                . "u.email, u.phone, u.first_name, u.last_name "
                . "FROM `zay_pay` p "
                . "left join `zay_users` u on u.id=p.user_id "
                . "left join `zay_pay_type` pt on pt.pay_type_code=p.pay_type "
                . "{$where} "
                . "ORDER BY p.`pay_date` DESC LIMIT ?";
        $data = $sqlLight->queryList($querySelect, $queryArray, 0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['info'] = $this->get_pay_products_info($data[$i]['id']);
        }
        return $data;
    }

    /**
     * информация по транзакции
     * @param type $id
     * @return type
     */
    public function get_pay_info($id) {
        $querySelect = "SELECT
                        p.*,
                        if(pcr.id is not null, pcr.id, 0) as pay_credit,
                        pcr.pay_tinkoff_id,
                        pcr.pay_tinkoff_link,
                        pt.*
                    FROM
                        zay_pay p
                        left join zay_pay_credit pcr on pcr.pay_id=p.id
                    LEFT JOIN zay_pay_type pt ON
                        pt.pay_type_code = p.pay_type
                    WHERE
                        p.id='?'";
        return $this->getSelectArray($querySelect, array($id))[0];
    }

    /**
     * информация по транзакции
     * @param type $id
     * @return type
     */
    public function get_pay_products_info($id) {
        $querySelect = "SELECT pp.*, p.* FROM zay_pay_products pp "
                . "left join zay_product p on p.id=pp.product_id "
                . "where pp.pay_id='?' ORDER BY `pay_id` ASC";
        return $this->getSelectArray($querySelect, array($id));
    }

    /**
     * Отметить что запись просмотрена
     * @param type $obj_id
     * @return boolean
     */
    public function check_processed($obj_id) {
        if ($obj_id > 0) {
            $sqlLight = new \project\sqlLight();
            $querySelect = "select p.processed from `zay_pay` p where p.id='?' ";
            $processed = $this->getSelectArray($querySelect, array($obj_id))[0]['processed'];
            if ($processed == '1') {
                $processed = '0';
            } else {
                $processed = '1';
            }
            if ($obj_id > 0) {
                $query = "UPDATE `zay_pay` SET `processed`='?' WHERE `id`='?'";
                if ($sqlLight->query($query, array($processed, $obj_id))) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Создаем новую транзакцию
     * @param type $user_id
     * @param type $wares_ex_code
     * @param type $price
     */
    public function set_product_pay($user_id, $wares_ex_code, $price) {
        $sqlLight = new \project\sqlLight();
        $products = new \project\products();
        $pay_date = date("Y-m-d H:i:s"); // Получаем дату и время
        $pay_status = "succeeded"; // Устанавливаем стандартный статус платежа
        $pay_descr = '';

        // Найдем товар
        $q_wares = "SELECT * FROM `zay_wares` WHERE `ex_code`='?' ";
        $wares = $sqlLight->queryList($q_wares, array($wares_ex_code), 0);

        $querySelectProductWares1 = "SELECT pw.product_id, 
            ( SELECT COUNT(*) FROM `zay_product_wares` pw2 WHERE pw2.`wares_id` = pw.`wares_id` AND pw2.product_id = pw.product_id ) as col
            FROM `zay_product_wares` pw 
            WHERE pw.`wares_id` = '290' 
            GROUP BY pw.product_id  
            ORDER BY `col`  DESC";
        $product_list = $sqlLight->queryList($querySelectProductWares1, array($wares[0]['id']));

        foreach ($product_list as $value) {
            if ($value['col'] == 1) {
                $product_id = $value['product_id'];
            }
        }

        $queryMaxId = "select MAX(p.id) max_id from `zay_pay` p";
        $max_id = $sqlLight->queryList($queryMaxId, array())[0]['max_id'] + 1;

        if ($product_id > 0) {
            $query = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`, `pay_interkassa_id`, `pay_descr`, `confirmationUrl`) "
                    . "VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
            if ($sqlLight->query($query, array(($max_id), 'in', $user_id, $price, $pay_date, '', $pay_status, '', $pay_descr, ''), 0)) {

                $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`) "
                        . "VALUES ('?','?','?')";
                $sqlLight->query($queryProductRegister, array($max_id, $product_id, $price));
                // Зафиксируем продажу
                $products->setSoldAdd($max_id);
            }
            //echo "product_id: {$product_id}";
//exit();
            // Отправляем пользователя на страницу оплаты
            //header('Location: /office/');
        }
    }

    /**
     * Получить типы все операций
     * @return type
     */
    public function get_pay_all_tipes() {
        $sqlLight = new \project\sqlLight();
        $query = "SELECT DISTINCT p.pay_type, pt.pay_type_title "
                . "FROM `zay_pay` p "
                . "left join `zay_pay_type` pt on pt.pay_type_code=p.pay_type";
        return $sqlLight->queryList($query, array());
    }

    /**
     * Получить типы все операций
     * @return type
     */
    public function get_pay_all_status() {
        $sqlLight = new \project\sqlLight();
        $query = "SELECT DISTINCT `pay_status` FROM `zay_pay`";
        return $sqlLight->queryList($query, array());
    }

}
