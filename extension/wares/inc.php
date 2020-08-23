<?php

namespace project;

defined('__CMS__') or die;

class config extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список настроек
     * @param string $searchStr
     * @return array
     */
    public function getConfigArray($searchStr) {
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT * FROM `zay_configs` WHERE `config_code` like '%?%' OR `config_title` like '%?%' ";
            return $this->getSelectArray($querySelect, array($searchStr, $searchStr));
        } else {
            $querySelect = "SELECT * FROM `zay_configs` ";
            return $this->getSelectArray($querySelect, array());
        }
    }

    /**
     * Данные элемента
     * @param type $id
     * @return array
     */
    public function getConfigElem($id) {
        if ($id > 0) {
            $querySelect = "SELECT * FROM `zay_configs` WHERE id='?' ";
            return $this->getSelectArray($querySelect, array($id));
        }
        return array();
    }

    /**
     * Создание изменение
     * @param type $id
     * @param type $config_code
     * @param type $config_title
     * @param type $config_type
     * @param type $config_val
     * @return boolean
     */
    public function insertOrUpdateConfig($id, $config_code, $config_title, $config_descr, $config_type, $config_val) {
        if ($id > 0) {
            $query = "UPDATE `zay_configs` "
                    . "SET `config_title`='?', `config_descr`='?', `config_val`='?' "
                    . "WHERE `id`='?' ";
            if ($this->query($query, array($config_title, $config_descr, $config_val, $id))) {
                return true;
            }
        } else {
            $query = "INSERT INTO `zay_configs` "
                    . "(`config_code`, `config_title`, `config_descr`, `config_type`, `config_val`) "
                    . "VALUES ('?','?','?','?','?')";
            if ($this->query($query, array($config_code, $config_title, $config_descr, $config_type, $config_val))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Удаление настройки
     * @param type $id
     * @return boolean
     */
    public function deleteConfig($id) {
        $query = "DELETE FROM `zay_configs` WHERE id='?' ";
        if ($this->query($query, array($id))) {
            return true;
        }
        return false;
    }

}
