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
    //kaijean
    //Получить информацию по проданным продуктам - количество продаж, количество позиций
    public function user_product_payments($user_id = 0)
    {
        if($user_id > 0)
        {
            $querySelect = "SELECT u.first_name, u.last_name, u.email, u.phone, p.id AS payment_id, p.pay_sum AS payment_sum, pp.product_id AS product_id, pr.title AS product_title FROM zay_pay p 
                LEFT JOIN zay_users u ON p.user_id=u.id 
                RIGHT JOIN zay_pay_products pp ON pp.pay_id=p.id 
                LEFT JOIN zay_product pr ON pp.product_id=pr.id 
                WHERE u.id='?' AND p.pay_status='succeeded' AND pr.title <> 'NULL'";
            // $select = "SELECT u.first_name, u.last_name, u.email, u.phone FROM zay_users u WHERE u.id='?'";
            $data = $this->getSelectArray($querySelect, array($user_id));
            return $data;
        }
        return [];
    }
    /**
     * Информация по консультациям пользователя
     * @param type $phone
     * @param type $email
     * @return array
     */
    public function user_consultations($phone,$email)
    {
        if(!empty($phone) && !empty($email))
        {
            $phoneDigits = preg_replace("/[^0-9]/", '', $phone);
            $regAr = str_split($phoneDigits);
            $regStr = implode(".*", $regAr);
            $regExp = "^.*(".$regStr.").*$";
            $select = "SELECT pc.id, p.pay_sum FROM zay_pay_consultation pc 
                LEFT JOIN zay_pay p ON pc.pay_id=p.id 
                WHERE p.id <> 'NULL' AND (pc.user_phone REGEXP '?' OR pc.user_email='?')";
            $data = $this->getSelectArray($select, array($regExp,$email));
            return $data;
        }
        else
            return [];
    }
    /**
     * Создать оплату по данным переданным снаружи на вебхук
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
        $query = "INSERT INTO `zay_pay` (`id`, `pay_type`, `user_id`, `pay_sum`, `pay_date`, `pay_key`, `pay_status`, `pay_descr`, `confirmationUrl`) "
            ."VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?')";
        return $this->query($query, [$new_id, $pay_type, $user_id, $pay_sum, $pay_date, $pay_key, $pay_status, $pay_descr ,$confirmationUrl]);
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
