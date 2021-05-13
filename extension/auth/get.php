<?php

/*
 * Обработка запросов GET
 */

defined('__CMS__') or die;

include_once 'inc.php';

$auth = new \project\auth();

/*
 * Активация учетной записи пользователя
 */
if (isset($_GET['activation']) && strlen($_GET['activation']) > 0) {
    if ($auth->activate($_GET['activation'])) {
        $_SESSION['message'] = array('type' => 'success', 'text' => $lang['user_activate_true']);
    } else {
        $_SESSION['errors'][] = $lang['user_activate_false'];
    }
}




if (isset($_GET['kill_token'])) {
    $_SESSION['token_hash'] = '';
    $_SESSION['visitor'] = array();
    $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    header("Location: ".$ref);
    exit;
}