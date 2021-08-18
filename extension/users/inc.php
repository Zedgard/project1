<?php

namespace project;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/validator.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/mail.php';
/*
 * $_SESSION['user']['info']
 */

class user extends \project\extension { 

    private $page_max = 50;
    private $id, $email, $phone, $first_name, $last_name, $u_pass, $lastdate;
    protected $errors = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     * Колличество пользователей
     * @return int
     */
    public function user_count() {
        $select = "SELECT count(*) as col FROM zay_users ";
        $r = $this->getSelectArray($select, array(), 0)[0]['col'];
        return $r;
    }

    /**
     * Информация по пользователю
     * @param type $email
     * @return array
     */
    public function user_info($email) {
        $select = "SELECT * FROM zay_users u WHERE u.active='1' and u.email='?'";
        $data = $this->getSelectArray($select, array($email), 0);
        if (count($data) == 1) {
            return $data[0];
        }
        return array();
    }

    /**
     * Инофрмация по пользователю
     * @param type $id
     * @return type
     */
    public function getUserInfo($id = 0, $page_num = 1, $input_search_str = '', $params = array()) {
        $col = ($page_num * $this->page_max);
        $data = array();

        if ($id > 0) {
            $select = "SELECT u.*, ru.role_id, ru.user_id, r.role_name as role_name, r.role_privilege as role_privilege, 
                    IF(ADDTIME(u.active_lastdate, \"0:05:0.00\") > CURRENT_TIMESTAMP(), '1', '0') as `user_online`,
                    if((cc.id>0),1,0) as close_club_true, 
                    if((cc.freeze_date>CURRENT_DATE),0,cc.status) as close_club_status, 
                    cc.end_date as close_club_end_date 
                    FROM zay_users u 
                    left join zay_close_club cc on cc.user_id=u.id
                    left join zay_roles_users ru on ru.user_id=u.id 
                    left join zay_roles r on r.id=ru.role_id 
                    WHERE u.id='?'";
            $data = $this->getSelectArray($select, array($id))[0];
        } else {
            $where_val = array();
            $where_array = array();
            $where2 = '';
            $w = '';
            if (strlen($input_search_str) > 0) {
                $where_val[] = "`email` LIKE '%?%'";
                $where_val[] = "`phone` LIKE '%?%'";
                $where_val[] = "`first_name` LIKE '%?%'";
                $where_val[] = "`last_name` LIKE '%?%'";
                $where_array[] = $input_search_str;
                $where_array[] = $input_search_str;
                $where_array[] = $input_search_str;
                $where_array[] = $input_search_str;
            }

            if (count($where_val) > 0) {
                $w = implode(' or ', $where_val);
                $where = "WHERE {$w} ";
            }

            if (count($params) > 0) {
                if (isset($params['input_search_close_club_users']) && $params['input_search_close_club_users'] == 1) {
                    //$where_val[] = "cc.freeze_date>CURRENT_DATE";
                    if (strlen($where2) > 0) {
                        $where2 .= " AND dd.close_club_true>0";
                    } else {
                        $where2 = "WHERE dd.close_club_true>0";
                    }
                }
            }

            if (strlen($where) > 0 || strlen($where2) > 0) {
                $where_array[] = '';
            } else {
                $where_array[] = 'LIMIT ' . $col;
            }


            $select = "select dd.* from (
                    SELECT u.*, ru.role_id, ru.user_id, r.role_name, r.role_privilege, 
                    IF(ADDTIME(u.active_lastdate, \"0:05:0.00\") > CURRENT_TIMESTAMP(), '1', '0') as `user_online`,
                    if((cc.id>0),1,0) as close_club_true, 
                    if((cc.freeze_date>CURRENT_DATE),0,cc.status) as close_club_status, 
                    cc.end_date as close_club_end_date 
                    FROM zay_users u 
                    left join zay_close_club cc on cc.user_id=u.id
                    left join zay_roles_users ru on ru.user_id=u.id 
                    left join zay_roles r on r.id=ru.role_id 
                    {$where} 
                    ORDER BY u.id DESC ? ) as dd
                    {$where2} ";
//                    "SELECT u.id, u.`email`, u.`phone`, u.`first_name`, u.`last_name`, "
//                    . "u.`active`, u.`active_lastdate`, ru.`role_id`, ru.`user_id`, r.role_privilege, "
//                    . "IF(ADDTIME(CURRENT_TIMESTAMP(), \"0:05:0.00\") > u.`active_lastdate`, '1', '0') as `user_online` "
//                    . "FROM `zay_users` u "
//                    . "left join `zay_roles_users` ru on ru.user_id=u.id "
//                    . "left join `zay_roles` r on r.id=ru.role_id ";
            $data = $this->getSelectArray($select, $where_array, 0);
            //  echo "{$select}";
            // $data = array();        
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

    /**
     * Получить доступные роли
     * @return type
     */
    public function get_roles_array() {
        $querySelect = "SELECT * FROM `zay_roles` ORDER BY `role_name` ASC ";
        return $this->getSelectArray($querySelect);
    }

    /**
     * Обновить данные по роли пользователя
     * @param type $user_id
     * @param type $role_id
     * @return type
     */
    public function edit_user_role($user_id, $role_id) {
        $querySelect = "SELECT * FROM zay_roles_users WHERE user_id='?'";
        $objs = $this->getSelectArray($querySelect, array($user_id));
        if (count($objs) == 0) {
            $insetr = "INSERT INTO `zay_roles_users`(`role_id`, `user_id`) VALUES ('?','?')";
            return $this->query($insetr, array($role_id, $user_id));
        } else {
            $update = "update `zay_roles_users` ru set ru.`role_id`='?' where ru.`user_id`='?' ";
            return $this->query($update, array($role_id, $user_id));
        }
        return false;
    }

    /**
     * Обновить роль пользователя при изменении
     */
    public function upUserRole() {
        if (isset($_SESSION['user']['info']['role_privilege'])) {
            if ($_SESSION['user']['info']['id'] > 0) {
                $querySelect = "SELECT * FROM `zay_roles_users` ru "
                        . "left join `zay_roles` r on r.id=ru.role_id "
                        . "where ru.user_id='?' ";
                $_SESSION['user']['info']['role_privilege'] = $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id']))[0]['role_privilege'];
            }
        }
    }

    /**
     * Доступ определенный ролью
     * @param type $roles список имеющийхся ролей  "role_privilege"
     * @return boolean
     */
    public function roleAccess($roles) {
        // Признак отображения блока
        $block_see = false;
        // проверим на роли
        foreach ($roles as $value) {
            if ($value['role_privilege'] == 0) {
                $block_see = true;
            }
            if ($block_see == 0 && count($_SESSION['user']) > 0 && $_SESSION['user']['info']['role_privilege'] >= $value['role_privilege']) {
                $block_see = true;
            }
        }
        return $block_see;
    }

    /**
     * Админы
     * @return boolean
     */
    static public function isAdmin() {
        $role_privilege = $_SESSION['user']['info']['role_privilege'];
        if ($role_privilege >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Редакторы
     * @return boolean
     */
    static public function isEditor() {
        //print_r($_SESSION['user']['info']);
        $role_privilege = $_SESSION['user']['info']['role_privilege'];
        if ($role_privilege >= 8) {
            return true;
        }
        return false;
    }
    
    /**
     * Редакторы
     * @return boolean
     */
    static public function isEditorUTM() {
        //print_r($_SESSION['user']['info']);
        $role_privilege = $_SESSION['user']['info']['role_privilege'];
        if ($role_privilege >= 7) {
            return true;
        }
        return false;
    }

    /**
     * Только клиенты
     * @return boolean
     */
    static public function isClient() {
        if (trim($_SESSION['user']['info']['role_privilege']) == '') {
            if ($_SESSION['user']['other'] == 1) {
                $role_privilege = 1;
                $_SESSION['user']['info']['role_privilege'] = 1;
            }
        } else {
            $role_privilege = $_SESSION['user']['info']['role_privilege'];
        }
        if ($role_privilege > 0 && $role_privilege < 2) {
            return true;
        }
        return false;
    }

    /**
     * Для всех
     * @return boolean
     */
    static public function isAll() {
        return true;
    }

    /**
     * Получить ID авторизированного клиента
     * @return int
     */
    public function isClientId() {
        if (isset($_SESSION['user']['info']['id']) && $_SESSION['user']['info']['id'] > 0) {
            return $_SESSION['user']['info']['id'];
        } else {
            return 0;
        }
    }

    /**
     * Получить email авторизированного клиента
     * @return string
     */
    public function isClientEmail() {
        if (isset($_SESSION['user']['info']['email']) && strlen($_SESSION['user']['info']['email']) > 0) {
            return $_SESSION['user']['info']['email'];
        } else {
            return '';
        }
    }

    /**
     * Отправка письма от администратора сайта
     * @global \project\type $lang
     * @param type $email
     * @return boolean
     */
    public function sendEmail($to_email, $file_name, $arrayReplaseText) {
        global $lang;
        $config = new \project\config();
        $send_emails = new \project\send_emails();
        $validator = new Validator();
        $error = array();

        if (!$validator->valid_email($to_email)) {
            $error[] = 'Ошибка! Адрес электронной почты не верный.';
        }

        if (count($error) == 0) {
//            $link_ed_mailto = '';
//            if (strlen($config->getConfigParam('link_ed_mailto')) > 0) {
//                $link_ed_mailto = $config->getConfigParam('link_ed_mailto');
//            }
            //$from_site = 'https://' . $_SERVER['SERVER_NAME'];
            // получи фаил шаблона письма
            //echo "file_name: {$file_name} <br/>\n";
            //$email_body = $this->fileTmpl($file_name, $arrayReplaseText);
            //echo "email_body: {$email_body} <br/>\n";
            // заменим тэги
            //$email_body = str_replace("{site}", 'http://' . $_SERVER['SERVER_NAME'], $email_body);
            //$email_body = str_replace("{site_name}", $_SERVER['SERVER_NAME'], $email_body);
            //echo "1: {$to_email} <br/>\n";
            //echo "2: {$subject} <br/>\n";
            //echo "3: {$file_name} <br/>\n";
            //echo "email_body {$email_body} <br/>\n";
            //$mail = new \project\Mail($link_ed_mailto);  // Создаём экземпляр класса
            //$mail->setType('text/html');
            //$mail->setFromName($link_ed_mailto); // Устанавливаем имя в обратном адресе
            //var_dump($mail->send($to_email, $subject, $email_body));
            if ($send_emails->send($file_name, $to_email, $arrayReplaseText)) {
                return true;
            }
//            if ($mail->send($to_email, $subject, $email_body)) {
//                return true;
//            }
        }
        return false;
    }

    /**
     * Получить тело письма
     * @param type $file_name
     * @param type $email
     * @return type
     */
    private function fileTmpl($file_name, $arrayReplaseText = array(), $lang = 'ru') {
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/extension/users/emailTmpl/' . $file_name . '_' . $lang . '.html';
        $html = ob_get_clean();
        if (count($arrayReplaseText) > 0) {
            foreach ($arrayReplaseText as $key => $val) {
                $html = str_replace('{' . $key . '}', $val, $html);
            }
        }
        return $html;
    }

}
