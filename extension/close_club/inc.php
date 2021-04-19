<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';

class close_club extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить данные по активным пользователям
     * @return type
     */
    public function close_club_active_users($login_instagram = '') {
        $this->end_open_period_close_club();
        $this->freeze_update();
        $filter = array();
        $array = array();
        if (strlen(trim($login_instagram)) > 0) {
            $filter[] = "u.login_instagram='?'";
            $array[] = $login_instagram;
        }

        $filter_str = '';
        if (count($filter) > 0) {
            $filter_str = 'AND ' . implode(' AND ', $filter);
        }

        $query = "SELECT
                        cc.status,
                        cc.end_date,
                        cc.freeze_date,
                        cc.freeze_day,
                        u.email,
                        u.phone,
                        u.first_name,
                        u.last_name,
                        u.login_instagram
                    FROM
                        zay_close_club cc
                    LEFT JOIN zay_users u ON
                        u.id = cc.user_id
                    WHERE
                        cc.status = '1' AND u.login_instagram IS NOT NULL " . $filter_str;
        $this->setMysqliAssos();
        $data = $this->getSelectArray($query, $array, 0);
        return $data;
    }

    /**
     * Подучить данные по клубу
     * @return type
     */
    public function get_club_user_info($user_id) {
        $this->end_open_period_close_club();
        $this->freeze_update();
        $data = array();
        if ($user_id > 0) {
            $query = "SELECT cc.*,
                        TIMESTAMPDIFF(MONTH, NOW(), cc.end_date) as diff_month, 
                        (DATE_FORMAT(LAST_DAY(NOW()),'%d') - DATE_FORMAT(cc.end_date,'%d')) as diff_day, 
                        TIMESTAMPDIFF(HOUR, DATE_FORMAT(NOW(),'%Y-%m-%d'), NOW()) as diff_hour, 
                        TIMESTAMPDIFF(MINUTE, DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i'), DATE_FORMAT(NOW(),'%Y-%m-%d %H:59:59')) as diff_minute
                        FROM zay_close_club cc WHERE cc.user_id='?'";
            $data = $this->getSelectArray($query, array($user_id));
        }
        return $data;
    }

    /**
     * Получить данные по клубу
     * @return type
     */
    public function get_close_club($id) {
        $this->end_open_period_close_club();
        $this->freeze_update();
        $data = array();
        if ($user_id > 0) {
            $query = "SELECT * FROM zay_close_club WHERE id='?'";
            $data = $this->getSelectArray($query, array($id));
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
                . "left join zay_product pr on pr.id=pp.product_id "
                . "left join zay_product_wares pw on pw.product_id=pr.id "
                . "left join zay_wares w on w.id=pw.wares_id "
                . "WHERE p.id='?' and p.pay_status='succeeded' and w.club_month_period>0";
        $data = $this->getSelectArray($query, array($pay_id));
        if (count($data) > 0 && $data[0]['user_id'] > 0) {
            $club_month_period = $data[0]['club_month_period'];

            // Данные по клубу
            $club_info = $this->get_club_user_info($data[0]['user_id']);
            if (count($club_info) > 0) {
                $amount = $club_info[0]['period_month'] + $club_month_period;
                // Обновим данные
                $queryInsertClub = "UPDATE zay_close_club cc SET cc.period_month='?', cc.lastdate=NOW(), cc.status='1',"
                        . " cc.end_date=(if(c.last_date is null, DATE_ADD(c.last_date, INTERVAL ? MONTH),DATE_ADD(NOW(), INTERVAL ? MONTH))) "
                        . "WHERE cc.user_id='?'";
                return $this->getSelectArray($queryInsertClub, array($amount, $club_month_period, $club_month_period, $data[0]['user_id']));
            } else {
                // Зафиксируем
                // 
                $queryInsertClub = "INSERT INTO `zay_close_club`(`user_id`, `period_month`, `lastdate`, `end_date`, `status`, `freeze_day`) "
                        . "VALUES ('?','?',NOW(), DATE_ADD(NOW(), INTERVAL ? MONTH), 1)";
                return $this->getSelectArray($queryInsertClub, array($data[0]['user_id'], $club_month_period, $club_month_period, '40'));
            }
            return false;
        }
        return true;
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

    /**
     * Проверить дату доступа и перекрыть доступ если абонемент закончился
     * @param type $param
     * @return boolean
     */
    private function end_open_period_close_club() {
        try {
            $query = "UPDATE zay_close_club cc SET cc.status='0' WHERE cc.status='1' AND cc.end_date < NOW() ";
            return $this->query($query, array());
        } catch (Exception $exc) {
            $_SESSION['errors'][] = $exc->getTraceAsString();
        }
        return false;
    }

    /**
     * Обновить дни заморозки раз в год, в начале года
     * @return type
     */
    private function freeze_update() {
        $query = "UPDATE zay_close_club cc 
                    SET cc.freeze_day='40', cc.freeze_date=NOW()
                  WHERE DATE_FORMAT(cc.freeze_date,'%Y-%m-%d')<>DATE_FORMAT(NOW(),'%Y-%m-%d')";
        return $this->query($query, array());
    }

}
