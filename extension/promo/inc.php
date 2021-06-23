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
            $query = "SELECT * FROM zay_promo p WHERE (p.code like '%?%' or p.title like '%?%') and ADDDATE(p.date_end, INTERVAL 30 DAY)>=DATE_FORMAT(NOW(),'%y-%m-%d')";
            return $this->getSelectArray($query, array($find_str, $find_str));
        } else {
            $query = "SELECT * FROM zay_promo p WHERE ADDDATE(p.date_end, INTERVAL 30 DAY)>=DATE_FORMAT(NOW(),'%y-%m-%d')";
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
        $query = "SELECT p.*, "
                . "(select GROUP_CONCAT(pp.product_id) from zay_promo_products pp WHERE pp.promo_id=p.id) as product_ids "
                . "FROM zay_promo p WHERE p.id='?'";
        $data = $this->getSelectArray($query, array($id))[0];
        return $data;
    }

    /**
     * Получить данные по промо через код
     * @param type $id
     * @return type
     */
    public function promo_get_code($code) {
        $query = "SELECT p.*, 
                (select GROUP_CONCAT(pp.product_id) from zay_promo_products pp WHERE pp.promo_id=p.id) as product_ids 
                FROM zay_promo p WHERE p.code='?' AND p.status='1' AND p.date_start<=DATE_FORMAT(NOW(),'%y-%m-%d') AND p.date_end>DATE_FORMAT(NOW(),'%y-%m-%d')";
        return $this->getSelectArray($query, array($code), 0);
    }

    /**
     * Создание или редактирование промо
     * @param type $id
     * @param type $data
     * @return type
     */
    public function promo_update($id, $data) {
        $return = false;
        if ($id > 0) {
            $query = "UPDATE `zay_promo` SET `code`='?',`title`='?',`date_start`='?',"
                    . "`date_end`='?',`status`='?',`amount`='?',`percent`='?', `number_uses`='?', `alliance`='?' "
                    . "WHERE `id`='?'";
            $return = $this->query($query, array(
                $data['code'],
                $data['title'],
                $data['date_start'],
                $data['date_end'],
                $data['status'],
                $data['amount'],
                $data['percent'],
                $data['number_uses'],
                $data['promo_alliance'],
                $id), 0
            );
        } else {
            $id = $this->queryNextId('zay_promo');
            $query = "INSERT INTO `zay_promo`(`code`, `title`, `date_start`, `date_end`, `status`, `amount`, `percent`, `number_uses`, `alliance`) "
                    . "VALUES ('?','?','?','?','?','?','?','?','?')";
            $return = $this->query($query, array(
                $data['code'],
                $data['title'],
                $data['date_start'],
                $data['date_end'],
                $data['status'],
                $data['amount'],
                $data['percent'],
                $data['number_uses'],
                $data['promo_alliance'])
            );
        }

        if ($return) {
            $this->insert_promo_products($id, $data['promo_products']);
        }
        return $return;
    }

    /**
     * Удаление промо
     * @param type $id
     * @param type $data
     * @return type
     */
    public function promo_delete($id) {
        if ($id > 0) {
            $queryDelete = "DELETE FROM `zay_promo_products` WHERE `promo_id`='?' ";
            $this->query($queryDelete, array($id));
            $query = "DELETE FROM `zay_promo` WHERE `id`='?'";
            return $this->query($query, array($id));
        }
        return false;
    }

    /**
     * Привязка товаров учавствующих в промо
     * @param type $product_id продукт ид
     * @param type $wares_ids массив категорий
     */
    public function insert_promo_products($promo_id, $product_ids) {
        if ($promo_id > 0) {
            $queryDelete = "DELETE FROM `zay_promo_products` WHERE `promo_id`='?' ";
            $this->query($queryDelete, array($promo_id));
            $col = count($product_ids);
            if ($col > 0) {
                for ($i = 0; $i < $col; $i++) {
                    $query = "INSERT INTO `zay_promo_products`(`promo_id`, `product_id`) VALUES ('?','?') ";
                    $this->query($query, array($promo_id, $product_ids[$i]));
                }
            }
        }
    }

    /**
     * Получим продукты данного промо
     * @param type $promo_id
     * @return type
     */
    public function get_promo_products($promo_id) {
        $query = "SELECT * FROM `zay_promo_products` WHERE `promo_id`='?'";
        return $this->getSelectArray($query, array($promo_id));
    }

    /**
     * Зафиксируем продажу по промо
     * @param type $code
     * @return boolean
     */
    public function sale_promo_code($code) {
        $querySelect = "select p.id, (p.number_uses-1) as number_uses from zay_promo p where p.code='?'";
        $data = $this->getSelectArray($querySelect, array($code));
        if (count($data) > 0) {
            $id = $data[0]['id'];
            $number_uses = ($data[0]['number_uses'] >= 0) ? $data[0]['number_uses'] : 0;
            $query = "UPDATE `zay_promo` pp SET pp.number_uses='?' WHERE pp.id='?'";
            return $this->query($query, array($number_uses, $id));
        }
        return false;
    }

    /**
     * Получить данные по модальному окну
     * @return type
     */
    public function promo_get_modal_data($id = 0) {
        if ($id == 0) {
            $query_select = "SELECT * FROM zay_promo_modal ";
            $data = $this->getSelectArray($query_select, array());
        } else {
            $query_select = "SELECT * FROM zay_promo_modal WHERE id='?'";
            $data = $this->getSelectArray($query_select, array($id));
        }
        if (count($data) == 0) {
            $query = "INSERT INTO `zay_promo_modal` (`id`, `title`, `descr`, `product_id`, `active`, `lastdate`)    
                        VALUES (1, 'test', 'descr', 0, 0, NULL)";
            $this->query($query);
            $data = $this->getSelectArray($query_select, array());
        }
        return $data;
    }

    public function promo_get_modal_windows($id) {
        $modal_data = $this->promo_get_modal_data($id);
        //print_r($modal_data);
        if (count($modal_data) > 0 && $modal_data[0]['active'] == 1) {
            include 'tmpl/promo_modal.php';
        }
    }

}
