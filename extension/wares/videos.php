<?php

session_start();

/*
 * Админка управление видео материалами
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$wares = new \project\wares();
$user = new \project\user();

$errors = array();
// Только редактор и выше может управлять видео материалами 
if ($user->isEditor()) {
    /*
     * Добавление видео
     */
    if (isset($_GET['add_video'])) {
        if ($wares->addWaresVideo($_GET['wares_id'])) {
            header('Location: /extension/wares/videos.php?wares_id=' . $_GET['wares_id']);
            exit();
        } else {
            echo "Ошибка добавления видео!";
        }
    }

    /*
     * Добавление нового материала
     */
    if (isset($_GET['add_material'])) {
        if (isset($_POST['material_type'])) {
            if (strlen($_POST['material_type']) > 0) {
                $data = array();
                $data['wares_id'] = $_GET['wares_id'];
                $data['series_id'] = (isset($_GET['series_id']) && $_GET['series_id'] > 0) ? $_GET['series_id'] : 0;
                $data['material_type'] = trim($_POST['material_type']);
                $data['material_title'] = '';
                $data['material_descr'] = '';
                $data['video_youtube'] = '';
                $data['video_time'] = '';
                $data['audio_file'] = '';
                $data['material_file'] = '';
                if ($wares->insert_material($data)) {
                    header('Location: /extension/wares/videos.php?wares_id=' . $_GET['wares_id']);
                    exit();
                } else {
                    $errors = $_SESSION['errors'];
                }
            } else {
                $errors[] = 'Не задан тип материала';
            }
        }
        include 'tmpl/add_material_new.php';
        exit();
    }

    /*
     * Удаление материала
     */
    if (isset($_GET['delete_material'])) {
        if ($wares->delete_material($_GET['wares_id'], $_GET['delete_material'])) {
            header('Location: /extension/wares/videos.php?wares_id=' . $_GET['wares_id']);
            exit();
        } else {
            echo "Ошибка удаления видео!";
        }
    }

    /*
     * Удаление видео
     */
    if (isset($_GET['delete_video'])) {
        if ($wares->deleteWaresVideo($_GET['wares_id'], $_GET['delete_video'])) {
            header('Location: /extension/wares/videos.php?wares_id=' . $_GET['wares_id']);
            exit();
        } else {
            echo "Ошибка удаления видео!";
        }
    }

    /*
     * Добавление новой серии видео уроков
     */
    if (isset($_GET['add_series'])) {
        $series = $wares->getWaresVideoSeries($_GET['wares_id']);
        $col_series = count($series) + 1;
        if ($wares->addWaresVideoSeries($_GET['wares_id'], 'Новая серия ' . $col_series, $col_series)) {
            header('Location: /extension/wares/videos.php?wares_id=' . $_GET['wares_id']);
            exit();
        } else {
            echo "Ошибка добавления серии!";
        }
    }

    /*
     * Удаление серии видео уроков
     */
    if (isset($_GET['delete_series'])) {
        if ($wares->deleteWaresVideoSeries($_GET['wares_id'], $_GET['delete_series'])) {
            header('Location: /extension/wares/videos.php?wares_id=' . $_GET['wares_id']);
            exit();
        } else {
            echo "Ошибка удаления серии!";
        }
    }

    /*
     * Отображение материалов
     */
    if (isset($_GET['wares_id'])) {
        $wares_id = $_GET['wares_id'];
        $wares_info = $wares->getWaresElem($wares_id);
        //$videos = $wares->listMaterials($_GET['wares_id']);
        $series = $wares->getWaresVideoSeries($_GET['wares_id']);
        $materials = $wares->list_materials($_GET['wares_id']);
        
        //print_r($wares_info);
        include __DIR__ . '/tmpl/edit_videos.php';
    }
}