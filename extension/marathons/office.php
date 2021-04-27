<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/chat/inc.php';
include_once 'inc.php';

// user_office_top_message
$config = new \project\config();

$pr_wares = new \project\wares();
$user = new \project\user();
if ($user->isClient() || $user->isEditor()) {
    // для клиентов

    if (isset($_GET['wares_id'])) {

        $wares = $pr_wares->getClientMarathonsProducts($_GET['wares_id']);
        $series = $pr_wares->getWaresVideoSeries($wares['id']);
        $materials = $pr_wares->list_materials($wares['id']);

        $wares_img = '';
        if (is_file($_SERVER['DOCUMENT_ROOT'] . $wares['images'])) {
            $wares_img = '<img src="' . $wares['images'] . '" style="width: 80px;max-height: 80px;"/>';
        }

        $chat = new \project\chat();
        $chat->chat_init('webinar_' . $wares['id']);
        //$r = $chat->chat_get_messages();
        //print_r($wares_info);

        foreach ($series as $series_value) {
            if ($series_value['series_enable'] == 1) {
                $bonus_btn_style = 'display:none;';
                if (mb_strtoupper($series_value['title']) == 'БОНУС') {
                    $bonus_btn_style = 'display:block;';
                }
            }
        }


        include 'tmpl/office_product.php';
    } else {
        include 'tmpl/office.php';
    }
}    