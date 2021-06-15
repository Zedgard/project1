<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';

class config extends \project\extension {

    public function __construct() {
        parent::__construct();
        // Получим все настройки и зарегистрируем их вглобальной переменной
        $configs = $this->getConfigArray('0', '');
        foreach ($configs as $value) {
            $_SESSION['config'][$value['config_code']] = $value['config_val'];
        }
    }

    /**
     * Список настроек
     * @param string $searchStr
     * @return array
     */
    public function getConfigArray($category_id, $searchStr) {
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT * FROM `zay_configs` c WHERE c.`category`='?' and  (c.`config_code` like '%?%' OR c.`config_title` like '%?%') ";
            return $this->getSelectArray($querySelect, array($category_id, $searchStr, $searchStr));
        } else {
            // получим все настройки
            if ($category_id == 0) {
                $querySelect = "SELECT * FROM `zay_configs` c ";
                return $this->getSelectArray($querySelect, array(), 0);
            } else {
                // конкретной категории если передали
                $querySelect = "SELECT * FROM `zay_configs` c WHERE c.`category`='?'";
                return $this->getSelectArray($querySelect, array($category_id), 0);
            }
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
     * Данные элемента
     * @param type $id
     * @return array
     */
    public function getConfigParam($config_code) {
        if (strlen($config_code) > 0) {
            if (isset($_SESSION['config'][$config_code]) && strlen($_SESSION['config'][$config_code]) > 0) {
                $v = $_SESSION['config'][$config_code];
            } else {
                $querySelect = "SELECT * FROM `zay_configs` WHERE `config_code`='?' ";
                $data = $this->getSelectArray($querySelect, array($config_code)); //[0]['config_val'];
                if (count($data) > 0) {
                    $_SESSION['config'][$config_code] = $data[0]['config_val'];
                    $v = $data[0]['config_val'];
                } else {
                    $v = '';
                }
            }
            return $v;
        }
        return '';
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
    public function insertOrUpdateConfig($id, $config_category, $config_code, $config_title, $config_descr, $config_type, $config_val) {
        if ($id > 0) {
            $query = "UPDATE `zay_configs` "
                    . "SET `category`='?', `config_title`='?', `config_descr`='?', `config_val`='?' "
                    . "WHERE `id`='?' ";
            if ($this->query($query, array($config_category, $config_title, $config_descr, $config_val, $id), 0)) {
                return true;
            }
        } else {
            $query = "INSERT INTO `zay_configs` "
                    . "(`category`, `config_code`, `config_title`, `config_descr`, `config_type`, `config_val`) "
                    . "VALUES ('?','?','?','?','?','?')";
            if ($this->query($query, array($config_category, $config_code, $config_title, $config_descr, $config_type, $config_val), 0)) {
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

    /**
     * Получить категории настроек
     * @return type
     */
    public function getCategoryes() {
        $pr_category = new \project\category();
        return $pr_category->getCategoryArray('config', '');
    }

}
