<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

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
                        cc.id,
                        if((cc.freeze_date>CURRENT_DATE),0,cc.status) as status,
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
                        u.login_instagram IS NOT NULL " . $filter_str;
        $this->setMysqliAssos();
        $data = $this->getSelectArray($query, $array, 0);
        return $data;
    }

    /**
     * Получить данные по клубу
     * @return type
     */
    public function get_club_user_info($user_id) {
        $this->end_open_period_close_club();
        $this->freeze_update();
        $data = array();
        if ($user_id > 0) {
            // OLD (DATE_FORMAT(LAST_DAY(NOW()),'%d') - DATE_FORMAT(cc.end_date,'%d')) as diff_day 
            $query = "SELECT cc.*,
                        if(cc.freeze_date > NOW(), cc.freeze_date, '') as freeze_date_str,
                        TIMESTAMPDIFF(MONTH, DATE_FORMAT(NOW(),'%Y-%m-%d 23:59:59'), cc.end_date) as diff_month, 
                        (DATEDIFF(cc.end_date, NOW())) as diff_day, 
                        TIMESTAMPDIFF(HOUR, NOW(), DATE_FORMAT(NOW(),'%Y-%m-%d 23:59:59')) as diff_hour, 
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
        $query = "select w.club_month_period, p.user_id 
                        from zay_pay p 
                        left join zay_pay_products pp on pp.pay_id=p.id 
                        left join zay_product pr on pr.id=pp.product_id 
                        left join zay_product_wares pw on pw.product_id=pr.id 
                        left join zay_wares w on w.id=pw.wares_id 
                        WHERE p.id='?' and p.pay_status='succeeded' and w.club_month_period>0";
        $data = $this->getSelectArray($query, array($pay_id));
        if (count($data) > 0 && $data[0]['user_id'] > 0) {
            $club_month_period = $data[0]['club_month_period'];

            // Данные по клубу
            $club_info = $this->get_club_user_info($data[0]['user_id']);
            if (count($club_info) > 0) {
                // Обновим данные
                $queryInsertClub = "UPDATE zay_close_club cc SET cc.period_month='?', cc.lastdate=NOW(), cc.status='1', cc.freeze_day='40', 
                    cc.end_date=(if((cc.end_date is null or cc.end_date < NOW()), DATE_ADD(NOW(), INTERVAL ? MONTH), DATE_ADD(cc.end_date, INTERVAL ? MONTH) )) 
                    WHERE cc.user_id='?'";
                return $this->query($queryInsertClub, array($club_month_period, $club_month_period, $club_month_period, $data[0]['user_id']));
            } else {
                // Зафиксируем
                $queryInsertClub = "INSERT INTO `zay_close_club`(`user_id`, `period_month`, `lastdate`, `end_date`, `status`, `freeze_day`) "
                        . "VALUES ('?','?',NOW(), DATE_ADD(NOW(), INTERVAL ? MONTH), 1, 40)";
                return $this->query($queryInsertClub, array($data[0]['user_id'], $club_month_period, $club_month_period, '40'));
            }
            return false;
        }
        return true;
    }

    /**
     * Загрузить данные по закрытому клубу со сторонней системы 
     * @param type $data
     */
    public function import_club_data($data) {
        $sqlLight = new \project\sqlLight();
        $auth = new \project\auth();
        $user_email = $data['_billing_email'];
        $user_pass = $data['user_pass'];
        $user_phone = $data['_billing_phone'];
        $user_instagram = $data['Instagram'];
        $date1 = $data['_schedule_next_payment'];
        $date2 = $data['_schedule_end'];
        // echo "user_email: {$user_email} | user_instagram: {$user_instagram} | date1: {$date1} | date2: {$date2}<br/>\n";

        $date1 = strtotime(substr($data['_schedule_next_payment'], 10));
        $date2 = strtotime(substr($data['_schedule_end'], 10));
        $date = ($date1 > $date2) ? $data['_schedule_next_payment'] : $data['_schedule_end'];

        $select = "SELECT u.* FROM `zay_users` u WHERE u.email='?' and u.active='1'";
        $users = $sqlLight->queryList($select, array($user_email), 0);
        //print_r($users);
        // Зарегистрируем пользователей
        if (count($users) == 0) {
            $user_id = $sqlLight->queryNextId('zay_users');
            $query = "INSERT INTO `zay_users`(`email`, `phone`, `login_instagram`, `first_name`, `last_name`, `u_pass`, `active`, `active_code`, `active_lastdate`) "
                    . "VALUES ('?','?','?','','','?','?','?', NOW() )";
            $sqlLight->query($query, array($user_email, $user_phone, $user_instagram, $user_pass, 1, ''), 0);
        } else {
            $user_id = $users[0]['id'];
            // Обновим логин инстаграмм
            $query_update_insta = "UPDATE zay_users u SET u.login_instagram='?' WHERE u.id='?'";
            if ($sqlLight->query($query_update_insta, array($user_instagram, $user_id), 0)) {
                echo "query_update_insta OK <br/>\n";
            } else {
                echo "query_update_insta NOT <br/>\n";
            }
        }

        // Получим данные по клиенту
        $select_find_user = "SELECT u.* FROM `zay_users` u WHERE u.email='?' and u.active='1'";
        $user_data = $sqlLight->queryList($select_find_user, array($user_email), 0);
        $user_id = $user_data[0]['id'];

        echo "<br/>--user_id: {$user_id} | user_email: {$user_email} | user_phone {$user_phone} | user_instagram: {$user_instagram} | date: {$date}<br/>\n";

        $club_info = $this->get_club_user_info($user_id);
        if (count($club_info) > 0) {
            // Обновим данные
            $queryInsertClub = "UPDATE zay_close_club cc 
                                SET cc.period_month='6', 
                                cc.status='1',
                                cc.end_date=(DATE_FORMAT('?', '%Y-%m-%d'))
                                WHERE cc.user_id='?'";
            if ($sqlLight->query($queryInsertClub, array($date, $user_id), 1)) {
                echo "UPDATE OK <br/>\n";
            } else {
                echo "UPDATE NOT <br/>\n";
            }
        } else {
            // Зафиксируем
            $queryInsertClub = "INSERT INTO `zay_close_club`(`user_id`, `period_month`, `lastdate`, `end_date`, `status`, `freeze_date`, `freeze_day`) "
                    . "VALUES ('?','6',CURRENT_TIMESTAMP,(DATE_FORMAT('?', '%Y-%m-%d')),'1',CURRENT_TIMESTAMP, '40')";
            if ($sqlLight->query($queryInsertClub, array($user_id, $date), 1)) {
                echo "INSERT OK <br/>\n";
            } else {
                echo "INSERT NOT <br/>\n";
            }
        }

        echo "-----<br/>\n";
    }

    /**
     * Проверить можно ли покупать новый период<br/>
     * Сумма периодов не должна превышать 12 месяцев
     * @param type $period_value
     * @return boolean
     */
    public function check_add_new_period($period_value, $club_info) {
        //echo "period_value: {$period_value}<br/>";
        //$club_info = $this->get_club_user_info($_SESSION['user']['info']['id']);
        $amount = 0;
        if (count($club_info) > 0) {
            $amount = $club_info[0]['diff_month'] + $period_value;
        } else {
            $amount = $period_value;
        }
        if ($amount < 13) {
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
            $this->query($query, array());
            $query = "UPDATE zay_close_club cc SET cc.status='1' WHERE cc.status='0' AND DATE_FORMAT(cc.end_date, '%Y-%m-%d 23:59:59') > NOW() ";
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
                  WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') > DATE_ADD(DATE_FORMAT(cc.end_date, '%Y-%m-%d'), INTERVAL 1 YEAR)";
        // "UPDATE zay_close_club cc 
        //    SET cc.freeze_day='40', cc.freeze_date=NOW()
        //  WHERE DATE_ADD(DATE_FORMAT(cc.freeze_date, '%Y-%m-%d'), INTERVAL 1 YEAR)>=DATE_FORMAT(NOW(),'%Y-%m-%d')";
        return $this->query($query, array());
    }

    /**
     * Заморозить абонемент на колличество дней
     * @param type $user_id
     * @param type $day_num
     * @return type
     */
    public function close_club_set_freeze_day($user_id, $day_num) {
        $query = "UPDATE zay_close_club cc SET 
                cc.freeze_date=(DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'), INTERVAL ? DAY)),
                cc.end_date=(DATE_ADD(cc.end_date, INTERVAL ? DAY)),
                cc.freeze_day=(cc.freeze_day-?) 
                WHERE cc.user_id='?' ";
        return $this->query($query, array($day_num, $day_num, $day_num, $user_id));
    }

}
