<?php

defined('__CMS__') or die;


include_once 'inc.php';
include_once DOCUMENT_ROOT . '/extension/auth/inc.php';
include 'lang.php';

$user = new \project\user();
$auth = new \project\auth();


if (isset($_POST['getUsersList'])) {
    $user_id = 0;
    if (isset($_POST['system_user_id']) && $_POST['system_user_id'] > 0) {
        $user_id = $_POST['system_user_id'];
        $_SESSION['user_edit_obj_id'] = $user_id;
    }
    $data = $user->getUserInfo($user_id);
    $result = array('success' => 1, 'success_text' => 'Список пользователей получен', 'data' => $data);
}

if (isset($_POST['saveProfilSettings'])) {
    $user_id = $_SESSION['user_edit_obj_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $auth->phoneReplace($_POST['phone']);

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
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
        }

        if (strlen($oldPassword) > 0) {
            $obj = $user->getSelectArray("SELECT * FROM `zay_users` WHERE id='?' ", array($id))[0];

            if ($oldPassword == $obj['u_pass']) {

                if (strlen($newPassword) > 3) {
                    if ($newPassword == $conPassword) {
                        //$updatePassword
                        $auth->updateUserPassword($newPassword, $user_id);
                    } else {
                        $_SESSION['errors'][] = 'Пароли не совпадают с корректирующим';
                    }
                } else {
                    $_SESSION['errors'][] = 'Новый пароль слишком короткий';
                }
            } else {
                $_SESSION['errors'][] = 'Старый пароль не совпадает';
            }
        }

        if (count($_SESSION['errors']) == 0) {
            $result = array('success' => 1, 'success_text' => 'Данные обновлены');
        }
    }
}

if (isset($_POST['userDelete'])) {
    $user_id = $_POST['system_user_id'];

    if ($user->deleteUsed($user_id)) {
        $result = array('success' => 1, 'success_text' => 'Упешно удалено');
        $_SESSION['message'][] = 'Упешно удалено';
    } else {
        $_SESSION['errors'][] = 'Ошибка при удалении';
    }
}

if (isset($_POST['sortable'])) {
    $json_data = json_decode($_POST['json_data']);
    for ($i = 0; $i < count($json_data->data); $i++) {
        //echo "P: {$json_data->data[$i]->content_id} \n";
        $p->contentSorted($json_data->data[$i]->content_id, $json_data->data[$i]->sort);
    }
}