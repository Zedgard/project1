<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once 'inc.php';

$pr_products = new \project\products();

// Все товары с фильром
if (isset($_POST['getProductsArray'])) {
    $searchStr = (isset($_POST['searchStr']) > 0) ? $_POST['searchStr'] : '';
    $active = (isset($_POST['visible_products'])) ? $_POST['visible_products'] : '1';
    $product_edit = (isset($_POST['product_edit'])) ? $_POST['product_edit'] : '0';

    $_SESSION['product']['searchStr'] = $searchStr;
    $_SESSION['product']['active'] = $active;

    $data = $pr_products->getProductsArray($active, $searchStr, $product_edit);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Получить элемент
if (isset($_POST['getProductElemId'])) {
    $data = $pr_products->getProductElem($_POST['getProductElemId'], 1);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Смена активности
if (isset($_POST['setProductsActive'])) {
    $id = $_POST['setProductsActive'];
    $active = $_POST['active'];
    if ($pr_products->setProductsActive($id, $active)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено');
    } else {
        $_SESSION['errors'][] = 'Ошибка операции';
    }
}

// Редактирование товара
if (isset($_POST['edit_products'])) {
//echo 1;
    $products_id = $_POST['edit_products'];
    $products_title = (isset($_POST['products_title'])) ? $_POST['products_title'] : '';
    $products_wares = (isset($_POST['products_wares'])) ? $_POST['products_wares'] : '';
    if (isset($_POST['products_category'])) {
        if (is_array($_POST['products_category'])) {
            $products_category = $_POST['products_category'];
        } else {
            $products_category[] = $_POST['products_category'];
        }
    }
    //$products_category[] = (isset($_POST['products_category'])) ? $_POST['products_category'] : '';// old
    $products_account = (isset($_POST['products_account'])) ? $_POST['products_account'] : '';//kaijean
    $products_tax = (isset($_POST['products_tax']) && $_POST['products_tax'] > 0) ? $_POST['products_tax'] : '0';
    $products_theme = (isset($_POST['products_theme'])) ? $_POST['products_theme'] : '';
    $products_topic = (isset($_POST['products_topic'])) ? $_POST['products_topic'] : '';
    $products_desc_minimal = (isset($_POST['products_desc_minimal'])) ? $_POST['products_desc_minimal'] : '';
    $products_desc = (isset($_POST['products_desc'])) ? $_POST['products_desc'] : '';
    $products_sold = (isset($_POST['products_sold']) && $_POST['products_sold'] > 0) ? $_POST['products_sold'] : '0';
    $products_active = (isset($_POST['products_active'])) ? $_POST['products_active'] : '0';
    $product_new = (isset($_POST['product_new'])) ? $_POST['product_new'] : '0';
    $products_price = (isset($_POST['products_price']) && $_POST['products_price'] > 0) ? $_POST['products_price'] : '0';
    $products_price_promo = (isset($_POST['products_price_promo']) && $_POST['products_price_promo'] > 0) ? $_POST['products_price_promo'] : '0';
    $products_period_open = (isset($_POST['products_period_open']) && $_POST['products_period_open'] > 0) ? $_POST['products_period_open'] : '0';
    $product_content = (isset($_POST['product_content'])) ? $_POST['product_content'] : '';
    $images_str = (isset($_POST['images_str'])) ? $_POST['images_str'] : '';

    $pr_products->setProducts_wares($products_wares);
    $pr_products->setProducts_category($products_category);
    $pr_products->setProducts_account($products_account);//kaijean
    $pr_products->setProducts_topic($products_topic);
    $pr_products->setProducts_theme($products_theme);
    //kaijean
    if ($pr_products->insertOrUpdateProducts($products_id, $products_account, $products_title, $products_desc_minimal,
                    $products_price, $products_price_promo, $products_period_open, $products_desc, $products_sold, $product_content, $images_str, $product_new, $products_tax, $products_active)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено');
        $_SESSION['product']['searchStr'] = '';
        $_SESSION['message'][] = 'Успешно выполнено';
    } else {
        $_SESSION['errors'][] = 'Ошибка операции';
    }
}

// Удаление продукта
if (isset($_POST['deleteProducts'])) {
    $id = $_POST['deleteProducts'];
    if ($pr_products->deleteProducts($id, 1)) {
        $result = array('success' => 1, 'success_text' => 'Удалено');
    } else {
        $_SESSION['errors'][] = 'Ошибка операции';
    }
}

if (isset($_POST['getProducts'])) {
//    ob_start();
//    include 'tmpl/category.php';
//    $result = array('success' => 1, 'success_text' => '', 'data' => ob_get_clean() );
    $searchStr = $_POST['searchStr'];
    $data = $pr_products->getProductsIndex($searchStr);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Сохраним данные по фильтрам
if (isset($_POST['productSearchString'])) {
    $_SESSION['product']['filter']['productSearchString'] = $_POST['productSearchString'];
    $result = array('success' => 1, 'success_text' => '');
}
if (isset($_POST['checkedProductNew'])) {
    $_SESSION['product']['filter']['ProductNew'] = $_POST['checkedProductNew'];
    $result = array('success' => 1, 'success_text' => '');
}
if (isset($_POST['checkedProductPromo'])) {
    $_SESSION['product']['filter']['ProductPromo'] = $_POST['checkedProductPromo'];
    $result = array('success' => 1, 'success_text' => '');
}
if (isset($_POST['check_categorys'])) {
    if ($_POST['checked'] == 1) {
        $_SESSION['product']['filter']['check_categorys'][] = $_POST['check_categorys'];
    } else {
        foreach ($_SESSION['product']['filter']['check_categorys'] as $key => $value) {
            if ($value == $_POST['check_categorys']) {
                unset($_SESSION['product']['filter']['check_categorys'][$key]);
            }
        }
    }
    $result = array('success' => 1, 'success_text' => '');
}
if (isset($_POST['click_product_theme'])) {
    if ($_SESSION['product']['filter']['product_theme'] == $_POST['click_product_theme']) {
        $_SESSION['product']['filter']['product_theme'] = '';
    } else {
        $_SESSION['product']['filter']['product_theme'] = $_POST['click_product_theme'];
    }
    $result = array('success' => 1, 'success_text' => '');
}

if (isset($_POST['category_controll'])) {
    if ($_POST['category_controll'] > 0) {
        $_SESSION['product']['filter']['category_controll'] = $_POST['category_controll'];
    } else {
        $_SESSION['product']['filter']['category_controll'] = '';
    }
    $result = array('success' => 1, 'success_text' => '');
}

if (isset($_POST['filter_clear'])) {
    $_SESSION['product']['filter']['productSearchString'] = '';
    $_SESSION['product']['filter']['ProductNew'] = '0';
    $_SESSION['product']['filter']['ProductPromo'] = '0';
    $_SESSION['product']['filter']['check_categorys'] = array();
    $_SESSION['product']['filter']['product_theme'] = '';
    $_SESSION['product']['filter']['category_controll'] = '';
    $result = array('success' => 1, 'success_text' => '');
}

/* Рейтинг */
if (isset($_POST['product_reviews'])) {
    $product_id = $_POST['product_id'];
    $first_name = $_POST['first_name'];
    $reviews_text = $_POST['reviews_text'];
    $rating = $_POST['rating'];
    $user_id = $_SESSION['user']['info']['id'];
    if ($product_id > 0 && $user_id > 0) {
        if ($pr_products->setProductReviews(0, $product_id, $rating, $first_name, $reviews_text, 0)) {
            $result = array('success' => 1, 'success_text' => '');
        }
    }
}
if (isset($_POST['get_reviews']) && $_POST['get_reviews'] > 0) {
    $data = $pr_products->getProductReviewsArray($_POST['get_reviews']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

/* ---------------------------------------------------------------------------- */

// Отображение блоков
if (isset($_POST['block_show'])) {
    $products_id = $_POST['products_id'];
    $block = $_POST['block'];
    $show = $_POST['show'];
    if (!$pr_products->blockShow($products_id, $block, $show)) {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    } else {
        $result = array('success' => 1, 'success_text' => '');
    }
}

// Данные по блоку
if (isset($_POST['block_data_array'])) {
    $products_id = $_POST['products_id'];
    $block_type = $_POST['block_type'];
    $row = $_POST['row'];
    $data = $pr_products->blockDataArray($products_id, $block_type, $row);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Получим данные к блоку условия
if (isset($_POST['block_condition_data_array'])) {
    $products_id = $_POST['products_id'];
    $data = $pr_products->blockConditionDataArray($products_id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Блок "block_profit" добавление кому подходит
if (isset($_POST['block_data_edit'])) {
    $id = (isset($_POST['block_id'])) ? $_POST['block_id'] : 0;
    $products_id = $_POST['products_id'];
    $block_type = $_POST['block_type'];
    $row = $_POST['row'];
    $val = $_POST['val'];
    $parent = (isset($_POST['parent'])) ? $_POST['parent'] : 0;

    if ($block_type == 'block_trailer') {
        $ex = array_reverse(explode('/', $val));
        $val = 'http://www.youtube.com/embed/' . $ex[0];
    }

    if (!$pr_products->blockDataEdit($id, $products_id, $block_type, $row, $val, $parent)) {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    } else {
        if ($id == 0) {
            $id = $pr_products->queryNextId('zay_product_block_data') - 1;
        }
        $result = array('success' => 1, 'success_text' => '', 'data' => $id);
    }
}

if (isset($_POST['block_data_delete'])) {
    $id = $_POST['block_id'];
    if (!$pr_products->blockDataDelete($id)) {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    } else {
        $result = array('success' => 1, 'success_text' => '');
    }
}

if (isset($_POST['block_condition_data_delete'])) {
    $id = $_POST['block_id'];
    if (!$pr_products->blockConditionDataDelete($id)) {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    } else {
        $result = array('success' => 1, 'success_text' => '');
    }
}

/* --------  ПРОМО ПРОДУКТЫ НА ГЛАВНОЙ  ------- */
// Добавление промо товара на главную
if (isset($_POST['add_promo_product'])) {
    $elmid = (strlen($_POST['elmid']) > 0) ? $_POST['elmid'] : 0;
    if ($elmid > 0) {

        $querySelect = "SELECT * FROM `zay_index_promo` WHERE `product_id`='?'";
        $objs = $pr_products->getSelectArray($querySelect, array($elmid));

        if (count($objs) == 0) {
            $querySelectCol = "SELECT count(*) col FROM `zay_index_promo`";
            $col = $pr_products->getSelectArray($querySelectCol, array())[0]['col'];
            $position = $col + 1;

            $query = "INSERT INTO `zay_index_promo`(`product_id`, `position`) VALUES ('?','?')";
            if ($pr_products->query($query, array($elmid, $position))) {
                $result = array('success' => 1, 'success_text' => '');
            } else {
                $result = array('success' => 0, 'success_text' => 'Ошибка добавления!');
            }
        } else {
            $result = array('success' => 0, 'success_text' => 'Продукт уже добавлен!');
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка данных!');
    }
}

// Список продуктов
if (isset($_POST['list_promo_product'])) {
    $querySelect = "SELECT ip.id as ip_id, ip.position as position, p.* FROM zay_index_promo ip "
            . "left join zay_product p on p.id=ip.product_id "
            . "ORDER BY ip.position ASC";
    $data = $pr_products->getSelectArray($querySelect, array());
    if (count($data) > 0) {
        $i = 1;
        foreach ($data as $value) {
            $query = "UPDATE zay_index_promo ip "
                    . "set position='?'"
                    . "WHERE ip.id='?'";
            $pr_products->query($query, array($i, $value['ip_id']));
            $i++;
        }
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

// Обновить позицию
if (isset($_POST['set_position_promo'])) {

    function set_position($item_id, $position) {
        $pr_products = new \project\products();
        $q = "select * from `zay_index_promo` WHERE `id`='?'";
        $elem = $pr_products->getSelectArray($q, array($item_id), 0)[0];
        $elem_position = $elem['position'];
        $query = "UPDATE `zay_index_promo` SET `position`='?' WHERE `position`='?'";
        $pr_products->query($query, array($elem_position, $position), 0);
        $query = "UPDATE `zay_index_promo` SET `position`='?' WHERE `id`='?'";
        return $pr_products->query($query, array($position, $item_id), 0);
    }

    $item_id = $_POST['item_id'];
    $position = $_POST['set_position_promo'];

    if (set_position($item_id, $position)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка перемещения!');
    }
}

// Удаление промо
if (isset($_POST['delete_promo_product'])) {
    if ($_POST['delete_promo_product'] > 0) {
        $query = "DELETE FROM `zay_index_promo` WHERE id='?'";
        if ($pr_products->query($query, array($_POST['delete_promo_product']))) {
            $result = array('success' => 1, 'success_text' => '');
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка удаления!');
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка не передано промо!');
    }
}

if (isset($_POST['general'])) {
    $pr_wares = new \project\wares();
    $wares_info = $pr_wares->getWaresElem($_POST['wares_id']);
    $wares = $pr_wares->getClientProducts($_POST['wares_id']);

    $wares_img = '';
    if (is_file($_SERVER['DOCUMENT_ROOT'] . $wares['images'])) {
        $wares_img = '<img src="' . $wares['images'] . '" style="width: 80px;max-height: 80px;"/>';
    }
    include 'tmpl/general.php';
}

// Получим все иконки из awesome
if (isset($_POST['fontawesome_icons'])) {
    $dir1 = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/fontawesome/svgs/regular/';
    $dir2 = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/fontawesome/svgs/solid/';
    $data = array();
    foreach (scandir($dir2) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        $data[] = 'fa fa-' . str_replace('.svg', '', $item);
    }
    foreach (scandir($dir1) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        $data[] = 'fa fa-' . str_replace('.svg', '', $item);
    }

    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}