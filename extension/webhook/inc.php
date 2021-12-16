<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

class webhook extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить все аккаунты
     * @return type
     */
    public function get_accounts_all() {
        $querySelect = "SELECT * FROM `zay_accounts` ac order by ac.name asc";
        return $this->getSelectArray($querySelect, array());
    }

    /**
     * Получить меню данные по конкретному меню
     * @return type
     */
    public function get_menu($menu_id) {
        $querySelect = "SELECT * FROM `zay_menu` m WHERE m.id='?'";
        return $this->getSelectArray($querySelect, array($menu_id))[0];
    }

    /**
     * Добавление изменение
     * @param type $account_id
     * @param type $account_name
     * @param type $account_category
     * @return type
     */
    public function edit_account($account_id, $account_name, $account_category) {
        if ($account_id > 0) {
            $query = "UPDATE `zay_accounts` SET `name`='?',`category_id`='?' WHERE `id`='?' ";
            return $this->query($query, array($account_name, $account_category,$account_id));
        } else {
            $query = "INSERT INTO `zay_accounts`(`name`, `category_id`) VALUES ('?','?')";
            return $this->query($query, array($account_name, $account_category));
        }
    }

    /**
     * Удаление меню
     * @param type $menu_id
     * @return type
     */
    public function delete_account($account_id) {
        $query = "DELETE FROM `zay_accounts` WHERE `id`='?' ";
        return $this->query($query, array($account_id));
    }

}
