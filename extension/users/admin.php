<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

include_once 'inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include 'lang.php';

$user = new \project\user();
$auth = new \project\auth();

$show = 0;
if (isset($_GET['user_roles'])) {
    include 'tmpl/admin_user_roles.php';
    $show = 1;
}

if (isset($_GET['edit_user'])) {
    include 'tmpl/edit_user.php';
    $show = 1;
}

if ($show == 0) {
    $user_count = $user->user_count();
    include 'tmpl/admin.php';
}
