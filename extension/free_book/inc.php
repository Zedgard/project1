<?php

namespace project;

defined('__CMS__') or die;

class free_book extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список бесплатных продуктов
     * @param string $searchStr
     * @return array
     */
    public function getFreeBookArray($searchStr) {
        /**
         * Список продуктов с реализацией поиска
         * @param string $searchStr
         * @return array
         */
        $active = 1;
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT * FROM `zay_product` WHERE price='0' and `active`='?' and `title` like '%?%' and `is_delete`='0' order by id desc ";
            $d = $this->getSelectArray($querySelect, array($active, $searchStr));
        } else {
            if ($active == 9) {
                $querySelect = "SELECT * FROM `zay_product` WHERE price='0' and `is_delete`='1' order by lastdate desc";
                $d = $this->getSelectArray($querySelect, array());
            } else {
                $querySelect = "SELECT * FROM `zay_product` WHERE price='0' and `active`='?' and `is_delete`='0' order by id desc";
                $d = $this->getSelectArray($querySelect, array($active));
            }
        }
        $data = array();
        foreach ($d as $key => $value) {
            //$value['images_str'];
            $image = $value['images_str']; //$this->checkImageFile($value['images_str']);
            if (strlen($image) > 0) {
                $value['images_str'] = $value['images_str'];
                ;
            } else {
                $value['images_str'] = '/assets/img/no_tovar_bg.jpg';
            }
            $data[] = $value;
        }
        return $data;
    }

}
