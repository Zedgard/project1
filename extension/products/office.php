<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once 'inc.php';

// user_office_top_message
$config = new \project\config();

$pr_wares = new \project\wares();
$user = new \project\user();
if ($user->isClient() || $user->isEditor()) {
    // для клиентов

    if (isset($_GET['wares_id'])) {
        $series = $pr_wares->getWaresVideoSeries($_GET['wares_id']);
        $wares_info = $pr_wares->getWaresElem($_GET['wares_id'])[0];
        $wares = $pr_wares->getClientProducts($_GET['wares_id']);
        $video_materials = $pr_wares->listClientMaterials($wares['id']);

        $wares_img = '';
        if (is_file($_SERVER['DOCUMENT_ROOT'] . $wares['images'])) {
            $wares_img = '<img src="' . $wares['images'] . '" style="width: 80px;max-height: 80px;"/>';
        }
        include 'tmpl/office_product.php';
    } else {
        include 'tmpl/office.php';
    }
}