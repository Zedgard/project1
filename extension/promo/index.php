<?php
session_start();

defined('__CMS__') or die;

include_once 'inc.php';


// Если не авторизирован
//if (!isset($_SESSION['user']['info']['id'])) {
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/promo/inc.php';
$c_promo = new \project\promo();
$promo_data = $c_promo->promo_get_modal_data();
if (!isset($_COOKIE['edgard_cookie_promo_' . $promo_data[0]['id']]) || $_COOKIE['edgard_cookie_promo_' . $promo_data[0]['id']] == 0) {
    $c_promo->promo_get_modal_windows($promo_data[0]['id']);
}
?>
<script>
    var promo_modal_active = "<?= ($promo_data[0]['active'] == 1) ? 1 : 0 ?>";
    $(document).ready(function () {
        setTimeout(function () {
            if (promo_modal_active === "1") {
                $("#promo_modal_" + <?= $promo_data[0]['id'] ?>).modal('show');
                $(".modal_close_btn").unbind("click").click(function () {
                    var elm_id = $(this).attr('elm_id');
                    var cookie_date = new Date();
                    cookie_date.setYear(cookie_date.getFullYear() + 5);
                    setCookie('edgard_cookie_promo_' + elm_id, '1', {secure: true, path: '/', expires: cookie_date.toUTCString()});
                });
            }
        }, 300);

        $(".promo_product_go").unbind("click").click(function () {
            var elm_id = $(this).attr('elm_id');
            var href_data = $(this).attr('href_data');
            setCookie('edgard_cookie_promo_' + elm_id, '1', {secure: true, path: '/', expires: cookie_date.toUTCString()});
            location.href = href_data;
        });
    });
</script>    
    <?
//}    