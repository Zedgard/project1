<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once 'inc.php';

$c_marathons = new \project\online_trenings();
$user = new \project\user();
$config = new \project\config();
$pr_wares = new \project\wares();

if ($user->isClient() || $user->isEditor()) {
    //header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Origin: *');
    //header('Access-Control-Allow-Origin: https://edgardzaitsev.com');
    if (isset($_GET['marathon_series_material'])) {
        //echo "wares_id: {$_POST['wares_id']} series_id: {$_POST['series_id']}\n ";
        $materials = $pr_wares->list_materials_on_series($_GET['wares_id'], $_GET['series_id']);
        $objs['materials'] = $materials;
        $objs['wares_id'] = $_GET['wares_id'];
        $objs['series_id'] = $_GET['series_id'];
        
        $html = inc($_SERVER['DOCUMENT_ROOT'] . '/extension/marathons/tmpl/materials.php', $objs);
        $result = array('success' => 1, 'success_text' => '', 'html' => $html);
    }
} else {
    $result = array('success' => 0, 'success_text' => 'Ошибка операции!');
}