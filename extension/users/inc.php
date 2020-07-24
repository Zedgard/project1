<?php

namespace project;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
/*
 * $_SESSION['user_auth_data']
 */

class user extends \project\extension {

    private $id, $email, $phone, $first_name, $last_name, $u_pass, $lastdate;
    protected $errors = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     * Инофрмация по пользователю
     * @param type $id
     * @return type
     */
    public function getUserInfo($id = 0) {
        if ($id > 0) {
            $select = "SELECT u.id, u.`email`, u.`phone`, u.`first_name`, u.`last_name`, "
                    . "u.`active`, u.`active_lastdate`, ru.`role_id`, ru.`user_id`, "
                    . "IF(ADDTIME(CURRENT_TIMESTAMP(), \"0:05:0.00\") > u.`active_lastdate`, '1', '0') as `user_online` "
                    . "FROM `zay_users` u "
                    . "left join `zay_roles_users` ru on ru.user_id=u.id "
                    . "WHERE u.id='?'";
            /*
              "SELECT * FROM `zay_users` u "
              . "left join `zay_roles_users` ru on ru.user_id=u.id "
              . "WHERE u.id='?' ";
             * 
             */
            $data = $this->getSelectArray($select, array($id))[0];
            $_SESSION['user']['info'] = $data;
        } else {
            $select = "SELECT u.id, u.`email`, u.`phone`, u.`first_name`, u.`last_name`, "
                    . "u.`active`, u.`active_lastdate`, ru.`role_id`, ru.`user_id`, "
                    . "IF(ADDTIME(CURRENT_TIMESTAMP(), \"0:05:0.00\") > u.`active_lastdate`, '1', '0') as `user_online` "
                    . "FROM `zay_users` u "
                    . "left join `zay_roles_users` ru on ru.user_id=u.id ";
            $data = $this->getSelectArray($select);
        }
        return $data;
    }

    /**
     * Обновить дату последней активности пользователя
     */
    public function updateActiveLastdate() {
        if (isset($_SESSION['user']['info']) && $_SESSION['user']['info']['user_id'] > 0) {
            $s = "UPDATE `zay_users` u set u.active_lastdate=CURRENT_TIMESTAMP() "
                    . "where u.id='?' ";
            $this->query($s, array($_SESSION['user']['info']['user_id']));
        }
    }

    /**
     * Удалить пользовательскую запись
     */
    public function deleteUsed($user_id) {
        if ($this->isAdmin()) {
            $s = "DELETE FROM `zay_users` where `id`=? ";
            return $this->query($s, array($user_id));
        }
        return false;
    }

    /*
     * Доступы
     */

    static public function isAdmin() {
        $role_id = $_SESSION['user']['info']['role_id'];
        if ($role_id == 1) {
            return true;
        }
        return false;
    }

    static public function isEditor() {
        $role_id = $_SESSION['user']['info']['role_id'];
        if ($role_id == 2) {
            return true;
        }
        return false;
    }

    static public function isClient() {
        $role_id = $_SESSION['user']['info']['role_id'];
        if ($role_id == 3) {
            return true;
        }
        return false;
    }

}
