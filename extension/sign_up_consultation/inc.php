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
            return $this->query($query, array($id));
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

}
