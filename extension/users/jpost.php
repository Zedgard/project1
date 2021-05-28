<?php

defined('__CMS__') or die;


include_once 'inc.php';
include_once DOCUMENT_ROOT . '/extension/auth/inc.php';
include 'lang.php';

$user = new \project\user();
$auth = new \project\auth();

if ($user->isEditor()) {
    // Данные по пользователю
    if (isset($_POST['getUsersList'])) {
        $page_num = $_POST['page_num'];

        $input_search_close_club_users = $_POST['input_search_close_club_users'];
        $_SESSION['input_search_str'] = $_POST['input_search_str'];

        $user_id = 0;
        if (isset($_POST['system_user_id']) && $_POST['system_user_id'] > 0) {
            $user_id = $_POST['system_user_id'];
            $_SESSION['user_edit_obj_id'] = $user_id;
        }
        $params = array();
        //$params['input_search_close_club_users'] = $input_search_close_club_users;
        $data = $user->getUserInfo($user_id, $page_num, $_SESSION['input_search_str'], $params);
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    }

// Сохранить данные по пользователю
    if (isset($_POST['saveProfilSettings'])) {
        $user_id = $_SESSION['user_edit_obj_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $auth->phoneReplace($_POST['phone']);
        $user_role_id = $_POST['user_role'];

        //$oldPassword = $_POST['oldPassword'];
        //$newPassword = $_POST['newPassword'];
        $conPassword = $_POST['conPassword'];

        if (strlen($first_name) == 0 && strlen($last_name) == 0) {
            //$_SESSION['errors'][] = 'Имя и фамилия должны быть заполнены';
        }
        if (strlen($email) < 2 && $auth->emailValid($email)) {
            $_SESSION['errors'][] = 'Адрес электронной почты должен быть корректен';
        }
        if (strlen($phone) == 0) {
            $_SESSION['errors'][] = 'Номер телефона должен быть заполнен';
        }

        if (count($_SESSION['errors']) == 0) {

            $updateUserInfo = "UPDATE `zay_users` SET `email`='?',`phone`='?',`first_name`='?',"
                    . "`last_name`='?' WHERE id='?' ";
            if (!$user->query($updateUserInfo, array($email, $phone, $first_name, $last_name, $user_id))) {
                $_SESSION['errors'][] = 'Обновление не выполнено';
            } else {
                $user->edit_user_role($user_id, $user_role_id);
            }

            if (strlen($conPassword) > 3) {
                $auth->updateUserPassword($conPassword, $user_id);
            }
//        if (strlen($oldPassword) > 0) {
//            $obj = $user->getSelectArray("SELECT * FROM `zay_users` WHERE id='?' ", array($id))[0];
//
//            if ($oldPassword == $obj['u_pass']) {
//
//                if (strlen($newPassword) > 3) {
//                    if ($newPassword == $conPassword) {
//                        //$updatePassword
//                        $auth->updateUserPassword($newPassword, $user_id);
//                    } else {
//                        $_SESSION['errors'][] = 'Пароли не совпадают с корректирующим';
//                    }
//                } else {
//                    $_SESSION['errors'][] = 'Новый пароль слишком короткий';
//                }
//            } else {
//                $_SESSION['errors'][] = 'Старый пароль не совпадает';
//            }
//        }

            if (count($_SESSION['errors']) == 0) {
                $result = array('success' => 1, 'success_text' => 'Данные обновлены');
            }
        }
    }

// Удалить пользователя
    if (isset($_POST['userDelete'])) {
        $user_id = $_POST['system_user_id'];

        $querySelect = "SELECT u.*, r.* FROM `zay_users` u "
                . "left join `zay_roles_users` ru on ru.user_id=u.id  "
                . "left join `zay_roles` r on r.id=ru.role_id "
                . "WHERE u.`id`='?'";
        $u = $user->getSelectArray($querySelect, array($user_id))[0];
        if ($u['role_privilege'] > $_SESSION['user']['info']['role_privilege']) {
            $_SESSION['errors'][] = 'У вас нет прав на удаление этого пользователя';
        } else {
            if ($user->deleteUsed($user_id)) {
                $result = array('success' => 1, 'success_text' => 'Упешно удалено');
                $_SESSION['message'][] = 'Упешно удалено';
            } else {
                $_SESSION['errors'][] = 'Ошибка при удалении';
            }
        }
    }

    if (isset($_POST['sortable'])) {
        $json_data = json_decode($_POST['json_data']);
        for ($i = 0; $i < count($json_data->data); $i++) {
            //echo "P: {$json_data->data[$i]->content_id} \n";
            $p->contentSorted($json_data->data[$i]->content_id, $json_data->data[$i]->sort);
        }
    }

// пулучить доступные роли
    if (isset($_POST['get_roles_array'])) {
        $data = $user->get_roles_array();
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    }

// отправить email сообщение 
    if (isset($_POST['userSendActivateEmail'])) {
        if ($_POST['userSendActivateEmail'] > 0) {
            $user_id = $_POST['userSendActivateEmail'];
            $obj = $user->getSelectArray("SELECT * FROM `zay_users` where id='?'", array($user_id))[0];

            //$pass_hash = $obj['u_pass'];//$auth->passHash($obj['u_pass']);

            $activate_code = $auth->passHash(PRIVATE_CODE . $obj['email'] . time());
            $activate_codeBase64 = base64_encode($activate_code);


            $query = "UPDATE `zay_users` SET `active_code`='?' "
                    . "WHERE `id`='?' ";
            $user->query($query, array($activate_code, $user_id));
            if ($auth->sendActivateEmail($obj['email'], $activate_codeBase64, 'mail_activate_account')) {
                $result = array('success' => 1, 'success_text' => 'Сообщение отправлено');
            } else {
                $result = array('success' => 0, 'success_text' => 'Ошибка!');
            }
            return $result;
        }
    }
    /*
     * Авторизация под другим пользователем
     */
    if (isset($_POST['userAuth']) && $_POST['userAuth'] > 0) {
        $_SESSION['user']['other'] = 1;
        $user_id = $_POST['userAuth'];
        $data = $user->getUserInfo($user_id);
        $_SESSION['user']['other_info'] = $_SESSION['user']['info'];
        $_SESSION['user']['info'] = $data;
        if (strlen($_SESSION['user']['info']['avatar']) == 0) {
            // Аватар по умолчанию
            $_SESSION['user']['info']['avatar'] = '/assets/img/user/user.jpg';
        }
        if (\project\user::isAdmin() || \project\user::isEditor()) {
            $url = '/admin/';
            $r = 1;
        }
        if (\project\user::isClient()) {
            $url = '/office/?katalog';
            $r = 1;
        }
        if ($r == 0) {
            $url = '/';
        }
        $result = array('success' => 1, 'success_text' => 'Успешно авторизирован', 'action' => $url, 'action_time' => '0');
    }
}