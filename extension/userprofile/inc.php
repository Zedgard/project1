<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

class userprofile extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить информацию о пользователе
     */
    public function get_user_info($user_id) {
        $querySelect = "SELECT * FROM `zay_users` u WHERE u.id='?'";
        return $this->getSelectArray($querySelect, array($user_id))[0];
    }

    /**
     * Радактируем общую информацию по пользователю
     * @param type $user_id
     * @param type $first_name
     * @param type $last_name
     * @param type $city
     * @param type $city_code
     * @param type $active_subscriber
     * @return boolean
     */
    public function save_user_info($user_id, $user_phone, $first_name, $last_name, $city, $city_code, $active_subscriber) {
        $user = new \project\user();
        if ($user_id > 0) {
            $query = "UPDATE `zay_users` "
                    . "SET `first_name`='?',`last_name`='?', `city`='?',"
                    . "`city_code`='?', `active_subscriber`='?' "
                    . "WHERE `id`='?' ";
            // Телефон могут менять только редакторы
            if ($user->isEditor()) {
                $queryPhoneUpdate = "UPDATE `zay_users` "
                        . "SET `phone`='?' "
                        . "WHERE `id`='?' ";
                $this->query($queryPhoneUpdate, array($user_phone, $user_id));
            }
            $ret = $this->query($query, array($first_name, $last_name, $city, $city_code, $active_subscriber, $user_id));

            return $ret;
        }
        return false;
    }

    /**
     * Изменить изображение аватара
     * @param type $user_id
     * @param type $file_url
     * @return type
     */
    public function upload_avatar($user_id, $file_url) {
        if ($user_id > 0) {
            $query = "UPDATE `zay_users` "
                    . "SET `avatar`='?' "
                    . "WHERE `id`='?' ";
            $ret = $this->query($query, array($file_url, $user_id));
            if ($ret) {
                $_SESSION['user']['info']['avatar'] = $file_url;
            }
            return $ret;
        }
    }

}
