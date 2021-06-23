<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_user = new \project\user();
$c_promo = new \project\promo();

if ($c_user->isEditor()) {

    // Главная 
    if (!isset($_GET['edit']) && !isset($_GET['promo_modal'])) {
        if (isset($_GET['promo_delete'])) {
            if ($c_promo->promo_delete($_GET['promo_delete'])) {
                location_href('/admin/promo/');
            } else {
                $_SESSION['errors'][] = 'Ошибка удаления';
            }
        }
        $find_str = (isset($_SESSION['promo_find_str'])) ? $_SESSION['promo_find_str'] : '';
        if (isset($_GET['find_str'])) {
            $find_str = $_GET['find_str'];
            $_SESSION['promo_find_str'] = $find_str;
        }
        $promos = $c_promo->promos_get_array($find_str);

        include 'tmpl/admin.php';
    }

    // Редактирование акции
    if (isset($_GET['edit'])) {
        if (isset($_POST['promo_id'])) {
            $data['code'] = $_POST['promo_code'];
            $data['title'] = $_POST['promo_title'];
            $data['date_start'] = $_POST['promo_date_start'];
            $data['date_end'] = $_POST['promo_date_end'];
            $data['amount'] = $_POST['promo_amount'];
            $data['percent'] = $_POST['promo_percent'];
            $data['status'] = ($_POST['promo_status'] > 0) ? $_POST['promo_status'] : 0;
            $data['promo_alliance'] = ($_POST['promo_alliance'] > 0) ? $_POST['promo_alliance'] : 0;
            $data['promo_products'] = $_POST['promo_products'];
            $data['number_uses'] = $_POST['number_uses'];
            if ($c_promo->promo_update($_POST['promo_id'], $data)) {
                location_href('/admin/promo/');
            } else {
                $_SESSION['page_errors'][] = 'Ошибка сохранения';
            }
        }

        $promo_data = array();
        if ($_GET['edit'] > 0) {
            $promo_data = $c_promo->promo_get_id($_GET['edit']);
        }
        include 'tmpl/edit_promo.php';
    }

    if (isset($_GET['promo_modal'])) {
        $modal_data = $c_promo->promo_get_modal_data();
        include 'tmpl/edit_promo_modal.php';
        $c_promo->promo_get_modal_windows($promo_data[0]['id']);
        importWisiwyng('promo_modal_descr', 300);
    }
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}
