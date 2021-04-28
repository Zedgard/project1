<?php

session_start();
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once 'inc.php';

$pr_wares = new \project\wares();

$result = array('success' => 0, 'success_text' => 'Ошибка!');


// Все товары с фильром
if (isset($_POST['getWaresArray'])) {
    $searchStr = (strlen($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $visible = (strlen($_POST['visible']) > 0) ? $_POST['visible'] : '';

    $_SESSION['wares']['searchStr'] = $searchStr;
    $_SESSION['wares']['visible'] = $visible;
    $data = $pr_wares->getWaresArray($searchStr, $visible);

    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Получить элемент
if (isset($_POST['getWaresElemId'])) {
    $id = $_POST['getWaresElemId'];
    $data = $pr_wares->getWaresElem($id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Смена активности
if (isset($_POST['setWaresActive'])) {
    $id = $_POST['setWaresActive'];
    $active = $_POST['active'];
    if ($pr_wares->setWaresActive($id, $active)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

// Редактирование товара
if (isset($_POST['edit_wares'])) {
    //echo "edit_wares \n";
    //echo "wares_images: {$_POST['wares_images']}\n";
    $wares_id = $_POST['edit_wares'];
    $wares_title = (isset($_POST['wares_title'])) ? $_POST['wares_title'] : '';
    $wares_ex_code = (isset($_POST['wares_ex_code'])) ? $_POST['wares_ex_code'] : '';
    $wares_articul = (isset($_POST['wares_articul'])) ? $_POST['wares_articul'] : '';
    $wares_col = (isset($_POST['wares_col'])) ? $_POST['wares_col'] : '';
    $club_month_period = $_POST['club_month_period'];
    $wares_descr = (isset($_POST['wares_descr'])) ? $_POST['wares_descr'] : '';
    $wares_url_file = (isset($_POST['wares_url_file'])) ? $_POST['wares_url_file'] : '';
    $wares_active = (isset($_POST['wares_active'])) ? $_POST['wares_active'] : '1';
    $wares_images = (isset($_POST['wares_images'])) ? $_POST['wares_images'] : '';
    $wares_categorys = (isset($_POST['wares_categorys'])) ? $_POST['wares_categorys'] : '';

    if (!is_numeric($wares_ex_code)) {
        $_SESSION['errors'][] = 'Код товара не число!';
    }

    $pr_wares->setWaresCategory($wares_categorys);

    if (count($_SESSION['errors']) == 0) {
        if ($pr_wares->insertOrUpdateWares($wares_id, $wares_title, $wares_descr, $wares_url_file, $wares_col, $club_month_period, $wares_ex_code, $wares_articul, $wares_images, $wares_active)) {
            $result = array('success' => 1, 'success_text' => 'Выполнено');
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка!');
        }
    }
}

// Удаление товара
if (isset($_POST['deleteWares'])) {
    $id = $_POST['deleteWares'];
    if ($pr_wares->deleteWares($id, 1)) {
        $result = array('success' => 1, 'success_text' => 'Удалено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}




// Редактипрование полей zay_wares_material
if (isset($_POST['editMaterials'])) {
    $row_db = $_POST['row_db'];
    $obj_id = $_POST['obj_id'];
    $val = $_POST['val'];
    if ($pr_wares->editTableRowValue('zay_wares_material', $obj_id, $row_db, $val)) {
        $result = array('success' => 1, 'success_text' => 'Изменено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}


// Редактипрование полей video
if (isset($_POST['editMaterial'])) {
    $row_db = $_POST['row_db'];
    $obj_id = $_POST['obj_id'];
    $val = $_POST['val'];
    if ($pr_wares->editTableRowValue('zay_wares_video', $obj_id, $row_db, $val)) {
        $result = array('success' => 1, 'success_text' => 'Изменено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

/**
 * Редактирование серии
 */
if (isset($_POST['editSeries'])) {
    $row_db = $_POST['row_db'];
    $obj_id = $_POST['obj_id'];
    $obj_format = $_POST['obj_format'];
    $val = trim($_POST['val']);
    if ($obj_format == 'date') {
        $val = date_sql_format($val);
    }

    if ($pr_wares->editTableRowValue('zay_wares_video_series', $obj_id, $row_db, $val)) {
        $result = array('success' => 1, 'success_text' => 'Изменено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

/**
 * Перемещение серии
 */
if (isset($_POST['setPositionVideoSeries'])) {
    $series_id = $_POST['series_id'];
    $position = $_POST['position'];
    $metod = $_POST['metod'];
    if ($pr_wares->setPositionVideoSeries($series_id, $position, $metod)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

/**
 * Перемещение серии
 */
if (isset($_POST['material_position_set'])) {
    $material_id = $_POST['material_id'];
    $series_id = $_POST['series_id'];
    $position = $_POST['position'];
    $metod = $_POST['metod'];
    if ($pr_wares->material_position_set($material_id, $series_id, $position, $metod)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

// Продукты купленные клиентом кроме вебинаров
if (isset($_POST['getClientProducts'])) {
    $category_id = (isset($_POST['category_id']) && $_POST['category_id'] > 0) ? $_POST['category_id'] : 0;
    $data = $pr_wares->getClientProducts(0, $category_id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['getClientWebinarsProducts'])) {
    $data = $pr_wares->getClientWebinarsProducts();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['getClientMarathonsProducts'])) {
    $data = $pr_wares->getClientMarathonsProducts();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['waresVideoSee'])) {
    if ($_POST['waresVideoSee'] > 0) {
        if ($pr_wares->insertWaresVideoSee($_POST['waresVideoSee'])) {
            
        }
    }
    $result = array('success' => 1, 'success_text' => '');
}

if (isset($_POST['waresVideoSeriesSee'])) {
    $data = array('bonus_open' => '0');
    if ($_POST['waresVideoSeriesSee'] > 0) {
        if ($pr_wares->insertWaresVideoSeriesSee($_POST['waresVideoSeriesSee'])) {
            
        }
        if (isset($_POST['wares_id'])) {
            $wares_id = $_POST['wares_id'];
            if ($pr_wares->getWaresSeriesSeeBonusOpen($wares_id, $_SESSION['user']['info']['id'])) {
                $data = array('bonus_open' => '1');
            }
        }
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}


// Купленные колличество товаров в категориях
if (isset($_POST['init_office_list_categorys_col'])) {
    $data = $pr_wares->getClientWaresCol();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if (isset($_POST['ajax_metod'])) {
    // Сортировка материалов
    if ($_POST['ajax_metod'] == 'material_update_positions') {
        $db_table = trim($_POST['db_table']);
        $db_row = trim($_POST['db_row']);
        $result = array('success' => 1, 'success_text' => '');
        if (count($_POST['ids']) > 0) {
            $i = 0;
            foreach ($_POST['ids'] as $value) {
                $pr_wares->material_position_update($db_table, $db_row, $value, $i);
                $i++;
            }
        }
    }
}