<?php

/*
 * Промо на сайте
 */

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';

class promo extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить данные про действующим и предстоящим промо
     * @param type $find_str
     * @return type
     */
    public function promos_get_array($find_str) {
        if (strlen(trim($find_str)) > 0) {
            $query = "SELECT * FROM zay_promo p WHERE (p.code like '%?%' or p.title like '%?%') and p.date_end>=DATE_FORMAT(NOW(),'%y-%m-%d')";
            return $this->getSelectArray($query, array($find_str, $find_str));
        } else {
            $query = "SELECT * FROM zay_promo p WHERE p.date_end>=DATE_FORMAT(NOW(),'%y-%m-%d')";
            return $this->getSelectArray($query, array());
        }
    }

    /**
     * Получить данные по промо
     * @param type $id
     * @return type
     */
    public function promo_get_id($id) {
        $data = array();
        $query = "SELECT * FROM zay_promo p WHERE p.id='?'";
        $data = $this->getSelectArray($query, array($id))[0];
        return $data;
    }

    /**
     * Создание или редактирование промо
     * @param type $id
     * @param type $data
     * @return type
     */
    public function promo_update($id, $data) {
        if ($id > 0) {
            $query = "UPDATE `zay_promo` SET `code`='?',`title`='?',`date_start`='?',`date_end`='?',`status`='?',`amount`='?',`percent`='?' WHERE `id`='?'";
            return $this->query($query, array(
                        $data['code'],
                        $data['title'],
                        $data['date_start'],
                        $data['date_end'],
                        $data['status'],
                        $data['amount'],
                        $data['percent'],
                        $id)
            );
        } else {
            $query = "INSERT INTO `zay_promo`(`code`, `title`, `date_start`, `date_end`, `status`, `amount`, `percent`) "
                    . "VALUES ('?','?','?','?','?','?','?')";
            return $this->query($query, array(
                        $data['code'],
                        $data['title'],
                        $data['date_start'],
                        $data['date_end'],
                        $data['status'],
                        $data['amount'],
                        $data['percent'])
            );
        }
    }

    /**
     * Удаление промо
     * @param type $id
     * @param type $data
     * @return type
     */
    public function promo_delete($id) {
        if ($id > 0) {
            $query = "DELETE FROM `zay_promo` WHERE `id`='?'";
            return $this->query($query, array($id));
        }
        return false;
    }

}
