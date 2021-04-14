<?php

// zay_consultation_master

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

class sign_up_consultation extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавление новой консультации
     * @param type $data
     * @return type
     */
    public function add_consultation($data) {
        if (isset($data['consultation_date']) && strlen($data['consultation_date']) > 0) {
            $consultation_date = $data['consultation_date'];
        } else {
            $date_ex = explode('/', $data['date']);
            $consultation_date = "{$date_ex[2]}/{$date_ex[1]}/{$date_ex[0]}";
        }
        $period_id = ($data['period_id'] > 0) ? $data['period_id'] : 0;

        $querySelect = "SELECT * FROM `zay_consultation` WHERE `consultation_date`='?' AND `consultation_time`='?' and `cancel`=0 ";
        $objs = $this->getSelectArray($querySelect, array($consultation_date, $data['time']));

        if (count($objs) == 0) {
            $query = "INSERT INTO `zay_consultation`(`pay_id`, `master_id`, `first_name`, `user_phone`, `user_email`, `pay_descr`, `consultation_date`, `consultation_time`, `period_id`) "
                    . "VALUES ('?','?','?','?','?','?','?','?','?')";
            //echo 'sign_up_consultation';

            return $this->query($query, array($data['pay_id'], $data['your_master_id'], $data['first_name'], $data['user_phone'], $data['user_email'], $data['pay_descr'], $consultation_date, $data['time'], $period_id), 0);
        } else {
            $_SESSION['errors'][] = 'Уже есть запись на эту дату!';
        }
        return false;
    }

    /**
     * Обновлениеданных о консультации
     * @param type $data
     */
    public function update_consultation($data) {
        $query = "UPDATE `zay_consultation` 
                    SET `user_email`='?',
                    `first_name`='?',
                    `user_phone`='?',
                    `master_id`='?',
                    `pay_descr`='?',
                    `consultation_date`='?',
                    `consultation_time`='?',
                    `cancel`='?',
                    `lastdate`=CURRENT_TIMESTAMP
                  WHERE `id`='?'";
        return $this->query($query, array(
                    $data['user_email'],
                    $data['first_name'],
                    $data['user_phone'],
                    $data['your_master_id'],
                    $data['pay_descr'],
                    $data['consultation_date'],
                    $data['consultation_time'],
                    $data['consultation_cancel'],
                    $data['consultation_id']
                        ), 0);
    }

    /*
     * Мастера для консультаций
     */

    /**
     * Получить кураторов
     * @param type $id или конкретного куратора
     * @return type
     */
    public function get_consultation_master($id = 0) {
        if ($id > 0) {
            $querySelect = "SELECT * FROM `zay_consultation_master` WHERE `id`='?' ORDER BY `position` ASC";
            return $this->getSelectArray($querySelect, array($id));
        } else {
            $querySelect = "SELECT * FROM `zay_consultation_master` ORDER BY `position` ASC";
            return $this->getSelectArray($querySelect);
        }
    }

    /**
     * Определение настроек для консультаций
     * @param type $master_id
     */
    public function set_consultation_config($master_id) {
        $consultation_masters = $this->get_consultation_master($master_id);
        if (count($consultation_masters) > 0) {
            foreach ($consultation_masters as $value) {
                $_SESSION['consultation_id'] = $value['id'];
                $_SESSION['consultation_master'] = $value['master_name'];
                $_SESSION['consultation_credentials'] = $value['credentials_file_name'];
                $_SESSION['consultation_token'] = $value['token_file_name'];
                return true;
            }
        }
        return false;
    }

    /**
     * Изменение информации о консультанте
     * @param type $id
     * @param type $master_name
     * @param type $token_file_name
     * @param type $credentials_file_name
     * @return boolean
     */
    public function edit_consultation_master($id, $master_name, $token_file_name, $credentials_file_name, $list_times) {
        if ($id > 0) {
            $masters = $this->get_consultation_master();
            $count_masters = count($masters) + 1;
            $query = "UPDATE `zay_consultation_master` "
                    . "SET `master_name`='?',`token_file_name`='?',`credentials_file_name`='?', `list_times`='?', `position`='?' "
                    . "WHERE `id`='?' ";
            return $this->query($query, array($master_name, $token_file_name, $credentials_file_name, $list_times, $count_masters, $id));
        } else {
            $query = "INSERT INTO `zay_consultation_master`(`master_name`, `token_file_name`, `credentials_file_name`, `list_times`, `position`) "
                    . "VALUES ('?','?','?','?')";
            return $this->query($query, array($master_name, $token_file_name, $credentials_file_name, $list_times, $count_masters));
        }
        return false;
    }

    /**
     * Удаление консультанта
     * @param type $id
     * @return boolean
     */
    public function delete_consultation_master($id) {
        if ($id > 0) {
            $query = "DELETE FROM `zay_consultation_master` WHERE `id`='?' ";
            $ret = $this->query($query, array($id));
            if ($ret) {
                // Чистим периоды
                $this->delete_consultation_period_or_master($id);
            }
            return $ret;
        }
        return false;
    }

    /*
     * Методы для периодов консультаций
     */

    /**
     * 
     * @param type $master_id
     * @return typeПолучить список периодав и цен
     */
    public function get_master_consultation_periods($master_id) {
        $querySelect = "SELECT * FROM `zay_consultation_periods` cp where cp.`master_id`='?' ORDER BY `cp`.`period_hour` ASC, `cp`.`periods_minute` ASC";
        return $this->getSelectArray($querySelect, array($master_id));
    }

    /**
     * Редактирование периодов консультаций и цен
     * @param type $consultation_period
     * @param type $master_id
     * @param type $period_hour
     * @param type $periods_minute
     * @param type $period_price
     * @return type
     */
    public function edit_consultation_period($consultation_period, $master_id, $period_time, $period_hour, $periods_minute, $period_price, $period_active) {
        if ($consultation_period > 0) {
            $query = "UPDATE `zay_consultation_periods` SET `master_id`='?',`period_time`='?', "
                    . "`period_hour`='?',`periods_minute`='?',`period_price`='?', `period_active`='?' "
                    . "WHERE `id`='?'";
            return $this->query($query, array($master_id, $period_time, $period_hour, $periods_minute, $period_price, $period_active, $consultation_period));
        } else {
            $query = "INSERT INTO `zay_consultation_periods` (`master_id`, `period_time`, `period_hour`, `periods_minute`, `period_price`, `period_active`) "
                    . "VALUES ('?','?','?','?','?','?')";
            return $this->query($query, array($master_id, '00:00:00', $period_hour, $periods_minute, $period_price, '1'));
        }
    }

    /**
     * Удаление периода консультаций
     * @param type $consultation_period
     * @return type
     */
    public function delete_consultation_period($consultation_period) {
        $query = "DELETE FROM `zay_consultation_periods` WHERE `id`='?'";
        return $this->query($query, array($consultation_period));
    }

    /**
     * Удаление периодов по мастеру
     * @param type $id
     * @return boolean
     */
    public function delete_consultation_period_or_master($master_id) {
        if ($master_id > 0) {
            $queryPeriods = "DELETE FROM `zay_consultation_periods` WHERE master_id='?'";
            // Чистим периоды
            return $this->query($queryPeriods, array($master_id));
        }
        return false;
    }

    /**
     * Получить список купленных консультаций
     * @param type $master_id
     * @return type
     */
    public function get_master_consultations($master_id) {
        $querySelect = "SELECT c.master_id, c.consultation_date, c.consultation_time, c.period_id 
                FROM zay_consultation c 
                left join zay_pay p on p.id=c.pay_id
                where c.master_id='?' and `consultation_date`>=CURRENT_DATE and p.pay_status='succeeded' and cancel=0 ";
        return $this->getSelectArray($querySelect, array($master_id), 0);
    }

    /**
     * Получить список купленных консультаций
     * @param type $master_id
     * @return type
     */
    public function get_master_consultations_full($master_id) {
        $querySelect = "SELECT c.* 
                FROM zay_consultation c 
                left join zay_pay p on p.id=c.pay_id
                where c.master_id='?' and (`consultation_date`>=CURRENT_DATE and p.pay_status='succeeded') or c.pay_id='0'";
        return $this->getSelectArray($querySelect, array($master_id), 0);
    }

    /**
     * Получить список консультаций
     * @param type $master_id
     * @return type
     */
    public function get_master_consultations_all($master_id) {
        $querySelect = "SELECT c.*  FROM zay_consultation c where c.master_id='?' ";
        return $this->getSelectArray($querySelect, array($master_id), 0);
    }

    /**
     * Информация по консультации
     * @param type $master_id
     * @return type
     */
    public function get_consultations_id($id) {
        $querySelect = "SELECT c.* 
                FROM zay_consultation c 
                left join zay_pay p on p.id=c.pay_id
                where c.id='?'";
        return $this->getSelectArray($querySelect, array($id), 0);
    }

    /**
     * Данные о периодах консультанта
     * @param type $master_id
     * @return type
     */
    public function get_consultation_times($master_id = 1, $day = '') {
        $day_sql = date_sql_format($day);
        $querySelect = "SELECT p.*,
                                (
                                SELECT count(*) FROM zay_consultation c WHERE
                                    c.master_id = p.master_id AND c.consultation_date = '?' AND c.consultation_time = p.period_time
                                ) AS is_pay
                            FROM
                                zay_consultation_periods p
                            WHERE
                                p.master_id = '?'";
        $data = $this->getSelectArray($querySelect, array($day_sql, $master_id), 0);
        return $data;
    }

    /**
     * Данные консультации по периоду
     * @param type $period_id
     * @return type
     */
    public function get_consultation_on_period_info($period_id) {
        $data = array();
        $querySelect = "SELECT
                            p.id, m.master_name, m.list_times, p.period_price, p.period_hour, p.periods_minute
                        FROM
                        zay_consultation_periods p
                           left join zay_consultation_master m on p.master_id=m.id
                        WHERE
                            p.id = '?'";
        $data = $this->getSelectArray($querySelect, array($period_id), 0)[0];

        return $data;
    }

    public function set_consultation_times($master_id, $times = array()) {

        print_r($times);
        if (is_array($times)) {
            $querySelect = "SELECT * FROM zay_consultation_times t WHERE t.master_id='?' ";
            $data = $this->getSelectArray($querySelect, array($master_id), 0);

            echo "count: " . count($times) . " >= " . count($data) . "<br/>\n";
            $a = array();
            if (count($times) >= count($data)) {
                echo "1<br/>\n";
                for ($i = 0; $i < count($times); $i++) {
                    //$times[$i]['insert'] = 1;
                    $a[$i]['value'] = $times[$i];
                    $a[$i]['insert'] = 1;
                    $a[$i]['del'] = 0;
                    if (count($data) > 0) {
                        foreach ($data as $v) {
                            if ($times[$i] == substr($v['vtime'], 0, 5)) {
                                $a[$i]['insert'] = 0;
                                $a[$i]['del'] = 0;
                            }
                        }
                    }
                }
            } else {
                echo "2<br/>\n";
                for ($i = 0; $i < count($data); $i++) {
                    //$times[$i]['insert'] = 1;
                    $a[$i]['value'] = $data[$i]['vtime'];
                    $a[$i]['insert'] = 0;
                    $a[$i]['del'] = 1;
                    if (count($times) > 0) {
                        foreach ($times as $v) {
                            $a[$i]['insert'] = 1;
                            if (substr($data[$i]['vtime'], 0, 5) == $v) {
                                $a[$i]['insert'] = 0;
                                $a[$i]['del'] = 0;
                            }
                        }
                    }
                }
            }
        }
        //print_r($a);
        foreach ($a as $value) {
            echo "<br/>\n";
            print_r($value);
            if ($value['insert'] == 1) {
                $query_insert = "INSERT INTO `zay_consultation_times` (`master_id`, `vtime`, `active`) VALUES ('?','?','?')";
                //$this->query($query_insert, array($master_id, $value['value'], 1));
            }
        }
        return false;
    }

}
