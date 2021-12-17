<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';

class webhook extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить все аккаунты
     * @param new_id
     * @param pay_type
     * @param user_id
     * @param pay_sum
     * @param pay_date
     * @param pay_key
     * @param pay_status
     * @param pay_descr
     * @param confirmationUrl
     * @param processed
     * @return type
     */
    public function create_payment($new_id, $pay_type, $user_id, $pay_sum, $pay_date, $pay_key, $pay_status, $pay_descr ,$confirmationUrl) {
        $query = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`, `pay_descr`, `confirmationUrl`, `processed`) "
            ."VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
        return $sqlLight->query($query, [$new_id, $pay_type, $user_id, $pay_sum, $pay_date, $pay_key, $pay_status, $pay_descr ,$confirmationUrl, 1]);
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
