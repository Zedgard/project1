<?php

// zay_consultation_master

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';

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
        $date_ex = explode('/', $data['date']);
        $consultation_date = "{$date_ex[2]}/{$date_ex[1]}/{$date_ex[0]}";
        $period_id = ($data['period_id'] > 0) ? $data['period_id'] : 0;

        $querySelect = "SELECT * FROM `zay_consultation` WHERE `consultation_date`='?' AND `consultation_time`='?' and `cancel`=0 ";
        $objs = $this->getSelectArray($querySelect, array($consultation_date, $data['time']));

        if (count($objs) == 0) {
            $query = "INSERT INTO `zay_consultation`(`pay_id`, `master_id`, `first_name`, `user_phone`, `user_email`, `pay_descr`, `consultation_date`, `consultation_time`, `period_id`) "
                    . "VALUES ('?','?','?','?','?','?','?','?','?')";
            //echo 'sign_up_consultation';

            return $this->query($query, array($data['pay_id'], $data['your_master_id'], $data['first_name'], $data['user_phone'], $data['user_email'], $data['pay_descr'], $consultation_date, $data['time'], $period_id), 1);
        } else {
            return true;
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
                    `pay_descr`='?',
                    `consultation_date`='?',
                    `consultation_time`='?',
                    `cancel`='?',
                    `lastdate`=CURRENT_TIMESTAMP
                  WHERE `id`='?'";
        return $this->query($query, array(
                    $data['user_email'],
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
    public function edit_consultation_period($consultation_period, $master_id, $period_hour, $periods_minute, $period_price) {
        if ($consultation_period > 0) {
            $query = "UPDATE `zay_consultation_periods` SET `master_id`='?',`period_hour`='?',`periods_minute`='?',`period_price`='?' "
                    . "WHERE `id`='?'";
            return $this->query($query, array($master_id, $period_hour, $periods_minute, $period_price, $consultation_period));
        } else {
            $query = "INSERT INTO `zay_consultation_periods` (`master_id`, `period_hour`, `periods_minute`, `period_price`) "
                    . "VALUES ('?','?','?','?')";
            return $this->query($query, array($master_id, $period_hour, $periods_minute, $period_price));
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
                where c.master_id='?' and `consultation_date`>=CURRENT_DATE and p.pay_status='succeeded'";
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
    public function get_consultation_times($master_id) {
        $return_data = array();
        $querySelect = "SELECT
                    m.*,
                    ( 
                    SELECT p.period_price FROM 
                       zay_consultation_periods p 
                    WHERE p.master_id = m.id AND p.period_hour = 1 
                    ) AS period_price
                FROM
                    zay_consultation_master m
                WHERE 
                    m.id = 1";
        $data = $this->getSelectArray($querySelect, array($master_id), 0);
        if (count($data) > 0) {
            $ex = explode(',', $data[0]['list_times']);

            foreach ($ex as $value) {
                $timestamp = strtotime($value) + 60 * 60;
                $time = date('H:i', $timestamp);
                $data[0]['period_time'] = $value . ' - ' . $time;

                $return_data[] = $data[0]; 
            }
        }
        return $return_data;
    }

}
