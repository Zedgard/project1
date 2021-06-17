<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/close_club/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/promo/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/utm/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';

class cart extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Покупки пользователя
     * @return type
     */
    public function get_pay_user_list() {
        $query = "select distinct p.id, p.pay_date, p.pay_sum, p.pay_descr, "
                . "(select GROUP_CONCAT(w.title SEPARATOR ',') from "
                . "zay_pay_products pp "
                . "left join zay_product_wares pw on pw.product_id=pp.product_id "
                . "left join zay_wares w on w.id=pw.wares_id "
                . "where pp.pay_id=p.id) as wares_title "
                . "from zay_pay p "
                . "where p.user_id='?' and p.pay_status='succeeded' ORDER BY p.pay_date DESC";
        $data = $this->getSelectArray($query, array($_SESSION['user']['info']['id']), 0);
        return $data;
    }

    /**
     * Регистрация покупки
     * @param type $pay_id
     */
    public function register_pay($pay_id) {
        $sign_up_consultation = new \project\sign_up_consultation();
        $close_club = new \project\close_club();
        $promo = new \project\promo();
        $utm = new \project\utm();
        $products = new \project\products();
        /*
         * Если клиент перешел по utm метки то фиксируем покупку реферала 
         */
        $utm->utm_product_bay($pay_id);
        /*
         * Если это консультация 
         */
        if (isset($_SESSION['consultation']['your_master_id']) && $_SESSION['consultation']['your_master_id'] > 0) {
            $_SESSION['consultation']['pay_id'] = $pay_id;
            $sign_up_consultation->add_consultation($_SESSION['consultation']);
        }
        // Зафиксируем покупку по закрытому клубу
        $close_club->register_ispay_club_month_period($pay_id);

        // Применили промо то отметим что промо использовано
        if (count($_SESSION['promos']) > 0) {
            foreach ($_SESSION['promos'] as $key => $value) {
                $promo->sale_promo_code($key);
            }
        }

        // Зафиксируем продажу товара
        $query_products = "SELECT pp.* FROM zay_pay p 
                            left join zay_pay_products pp on pp.pay_id=p.id
                            WHERE p.id='?'";
        $products_data = $this->getSelectArray($query_products, array($pay_id));
        foreach ($products_data as $v) {
            $products->setSoldAdd($v['product_id']);
        }
    }

}
