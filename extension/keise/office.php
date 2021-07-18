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

        $wares = $pr_wares->getClientCategoryProducts($_GET['wares_id'], 'Кейсы');
        $series = $pr_wares->getWaresVideoSeriesOffice($wares['id'], $wares['pay_id']);
        $materials = $pr_wares->list_materials($wares['id']);
        //echo "pay_id: {$wares['pay_id']} <br/>\n";
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
                $bonus_material_id = '0';
                $bonus_lock_content = '<i class="fas fa-lock"></i>';
                $bonus_lock = 1;
                if (mb_strtoupper($series_value['title']) == 'БОНУС') {
                    $bonus_btn_style = 'display:block;';
                    $bonus_material_id = $series_value['id'];
                    //$bonus_lock_content = '<i class="fas fa-lock"></i>';
                    if ($pr_wares->getWaresSeriesSeeBonusOpen($_GET['wares_id'], $_SESSION['user']['info']['id'])) {
                        $bonus_lock = 0;
                        $bonus_lock_content = '';
                    }
                }
            }
        }

//        print_r($_SESSION['wares_video_see']);
//        echo "<br/>\n";
//        echo 'in_array: ';
//        echo (in_array(12, $_SESSION['wares_video_see'])) ? 'true' : 'false';

        include 'tmpl/office_product.php';
    } else {
        include 'tmpl/office.php';
    }
}    