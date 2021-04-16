<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';

class close_club extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Подучить данные по клубу
     * @return type
     */
    public function get_club_user_info($user_id) {
        $data = array();
        if ($user_id > 0) {
            $query = "SELECT * FROM zay_close_club WHERE user_id='?'";
            $data = $this->getSelectArray($query, array($user_id));
        }
        return $data;
    }

    /**
     * Получить данные по покупке значения периода
     * @param type $pay_id
     * @return type
     */
    public function ispay_wares_club_month_period($pay_id) {
        $club_month_period = 0;
        $query = "select w.club_month_period "
                . "from zay_pay_products pp "
                . "left join zay_product p on p.id=pp.product_id "
                . "left join zay_product_wares pw on pw.product_id=p.id "
                . "left join zay_wares w on w.id=pw.wares_id "
                . "WHERE pp.pay_id='?' and club_month_period>0";
        $data = $this->getSelectArray($query, array($pay_id));
        if (count($data) > 0) {
            $club_month_period = $data[0]['club_month_period'];
        }
        return $club_month_period;
    }

    /**
     * Регистрация данные по покупке значения периода
     * @param type $pay_id
     * @return boolean
     */
    public function register_ispay_club_month_period($pay_id) {
        $club_month_period = 0;
        $query = "select w.club_month_period, p.user_id "
                . "from zay_pay p "
                . "left join zay_pay_products pp on pp.pay_id=p.id "
                . "left join zay_product p on p.id=pp.product_id "
                . "left join zay_product_wares pw on pw.product_id=p.id "
                . "left join zay_wares w on w.id=pw.wares_id "
                . "WHERE p.id='?' and club_month_period>0";
        $data = $this->getSelectArray($query, array($pay_id));
        if (count($data) > 0 && $data[0]['user_id'] > 0) {
            $club_month_period = $data[0]['club_month_period'];

            // Данные по клубу
            $club_info = $this->get_club_user_info($data[0]['user_id']);
            if (count($club_info) > 0) {
                $amount = $club_info[0]['period_month'] + $club_month_period;
                // Обновим данные
                $queryInsertClub = "UPDATE zay_close_club cc SET cc.period_month='?', `lastdate`=NOW() "
                        . "WHERE user_id='?'";
                return $this->getSelectArray($queryInsertClub, array($amount, $club_info[0]['id']));
            } else {
                // Зафиксируем
                $queryInsertClub = "INSERT INTO `zay_close_club`(`user_id`, `period_month`, `lastdate`) VALUES ('?','?',NOW())";
                return $this->getSelectArray($queryInsertClub, array($data[0]['user_id'], $club_month_period));
            }
        }
        return false;
    }

    /**
     * Проверить можно ли покупать новый период<br/>
     * Сумма периодов не должна превышать 12 месяцев
     * @param type $period_value
     * @return boolean
     */
    public function check_add_new_period($period_value) {
        $club_info = $this->get_club_user_info($_SESSION['user']['info']['id']);
        $amount = 0;
        if (count($club_info) > 0) {
            $amount = $club_info[0]['period_month'] + $period_value;
        } else {
            $amount = $period_value;
        }
        if ($period_value < 13) {
            return true;
        }
        return false;
    }

}
