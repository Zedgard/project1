<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php'; 

class category extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список всех категорий с реализацией поиска
     * @param string $searchStr
     * @return array
     */
    public function getCategoryAllArray($searchStr) {
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT * FROM `zay_category` WHERE `title` like '%?%' ORDER BY `type`, `title` ASC ";
            return $this->getSelectArray($querySelect, array($searchStr, $searchStr));
        } else {
            $querySelect = "SELECT * FROM `zay_category` ORDER BY `type`, `title` ASC";
            return $this->getSelectArray($querySelect, array($type));
        }
    }
    
    /**
     * Список категорий указанного типа с реализацией поиска
     * @param string $searchStr
     * @return array
     */
    public function getCategoryArray($type, $searchStr) {
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT * FROM `zay_category` WHERE `type`='?' and `title` like '%?%' ORDER BY `zay_category`.`title` ASC ";
            return $this->getSelectArray($querySelect, array($type, $searchStr, $searchStr));
        } else {
            $querySelect = "SELECT * FROM `zay_category` WHERE `type`='?' ORDER BY `zay_category`.`title` ASC";
            return $this->getSelectArray($querySelect, array($type));
        }
    }

    /**
     * Список категорий с реализацией поиска
     * @param string $searchStr
     * @return array
     */
    public function getCategoryElem($id) {
        if ($id > 0) {
            $querySelect = "SELECT * FROM `zay_category` WHERE id='?' ";
            return $this->getSelectArray($querySelect, array($id));
        }
        return array();
    }

    /**
     * Список имеющийхся категорий
     * @return type
     */
    public function getCategoryTypes() {
        $querySelect = "SELECT DISTINCT `type` FROM `zay_category` ";
        return $this->getSelectArray($querySelect, array($id));
    }
    
     /**
      * Добавить катенгорию
      * @param type $type
      * @param type $title
      * @return type
      */
    public function addCategory($type, $title, $color = '') {
        $querySelect = "INSERT INTO `zay_category`(`type`, `title`,`color`) VALUES ('?','?','?')";
        return $this->query($querySelect, array($type, $title, $color));
    }

}
