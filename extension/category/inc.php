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
     * Список категорий если у пользователя есть товары данной категории
     * @return фккфн
     */
    public function getCategoryUserArray() {
        $querySelect = "SELECT
                        c.*
                    FROM
                        (
                        SELECT DISTINCT
                            wcat.category_id
                        FROM
                            `zay_pay` p
                        LEFT JOIN `zay_pay_products` pp ON
                            pp.`pay_id` = p.`id`
                        LEFT JOIN `zay_product` pr ON
                            pr.`id` = pp.`product_id`
                        LEFT JOIN `zay_product_wares` pw ON
                            pw.`product_id` = pr.`id`
                        LEFT JOIN zay_wares w ON
                            w.id = pw.wares_id
                        LEFT JOIN zay_wares_category wcat ON
                            wcat.wares_id = w.id
                        WHERE
                            p.`user_id` = '?' AND p.`pay_status` = 'succeeded' AND w.`id` > 0 AND(
                                wcat.category_id <> 2 and wcat.category_id <> 9
                            )
                            and  wcat.category_id IS NOT NULL
                    ) dd
                    LEFT JOIN zay_category c ON
                        c.id = dd.category_id
                    ORDER BY
                        c.`title` ASC";
        return $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id']), 0);
    }
    
    /**
     * Список категорий если у пользователя есть товары данной категории
     * @return фккфн
     */
    public function getCategoryProductsArray() {
        $querySelect = "SELECT
                        c.*
                    FROM
                        (
                        SELECT DISTINCT
                            pcat.category_id
                        FROM
                            zay_pay p
                        LEFT JOIN zay_pay_products pp ON
                            pp.pay_id = p.id
                        LEFT JOIN zay_product pr ON
                            pr.id = pp.product_id
                        LEFT JOIN zay_product_wares pw ON
                            pw.product_id = pr.id
                        LEFT JOIN zay_wares w ON
                            w.id = pw.wares_id
                        LEFT JOIN zay_product_category pcat ON
                            pcat.product_id = pr.id
                        LEFT JOIN zay_category cat ON cat.id=pcat.category_id  
                        WHERE
                            p.user_id='?' AND p.pay_status='succeeded' AND w.id>0
                            
/*
Исключали продукты 
AND(
                                cat.type='product_category' and cat.title<>'Вебинары' and cat.title<>'Марафоны' and cat.title<>'Онлайн-тренинги' and cat.title<>'Кейсы'
                            )
                            */
                            and  pcat.category_id IS NOT NULL
                    ) dd
                    LEFT JOIN zay_category c ON
                        c.id = dd.category_id
                    ORDER BY
                        c.title ASC";
        return $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id']), 0);
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
