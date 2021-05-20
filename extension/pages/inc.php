<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

class pages extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить список заголовков
     * @return type
     */
    public function titles() {
        $querySelect = "SELECT * FROM `zay_pages_titles` ORDER by `url` ASC";
        return $this->getSelectArray($querySelect, array());
    }

    /**
     * Получить список заголовков
     * @param type $url
     * @return string
     */
    public function title_get_url($url) {
        $data = array();
        $url = str_replace('&', '&amp;', $url);
        if (strlen(trim($url)) > 0) {
            $querySelect = "SELECT * FROM `zay_pages_titles` WHERE `url`='?' ORDER by `url` ASC";
            $data = $this->getSelectArray($querySelect, array($url), 0);
            if (count($data) > 0) {
                return $data;
            }
        }
        return $data;
    }

    /**
     * Добавление нового заголовка
     * @return type
     */
    public function title_insert() {
        $query = "INSERT INTO `zay_pages_titles`(`url`, `title_text`, `descr_text`) VALUES ('','','')";
        return $this->query($query);
    }

}
