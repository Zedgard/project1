<?php

namespace project;

defined('__CMS__') or die;

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

}
