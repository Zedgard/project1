<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$user = new \project\user();
$userprofile = new \project\userprofile();

// Данные по пользователю
$user_data = $userprofile->get_user_info($_SESSION['user']['info']['id']);

/**
 * Загрузка файла
 */
if (isset($_FILES['upload_file']) && strlen($_FILES['upload_file']['name']) > 0) {
    //подключаем файл
    include($_SERVER['DOCUMENT_ROOT'] . '/class/image.php');

    if (strlen($user_data['avatar']) > 0 && is_file($_SERVER['DOCUMENT_ROOT'] . $user_data['avatar'])) {
        @unlink($_SERVER['DOCUMENT_ROOT'] . $user_data['avatar']);
    }

    $avatar_type = get_image_type($_FILES['upload_file']['type']);
    $rand = mt_rand(1000, 9999);
    $avatar_file_name = 'avatar_' . $rand . '_' . $user->isClientId(); // . $rand . '_' 

    $handle = new \project\upload($_FILES['upload_file']);

    if ($handle->uploaded) {
        if (is_file($_SERVER['DOCUMENT_ROOT'] . '/assets/avatars/' . $avatar_file_name . $avatar_type)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/avatars/' . $avatar_file_name . $avatar_type);
            $userprofile->upload_avatar($user->isClientId(), '');
        }
        //переименовываем изображение
        $handle->file_new_name_body = $avatar_file_name;
        //разрешаем изменять размер изображения
        $handle->image_resize = true;
        //ширина изображения будет 150px
        $handle->image_x = 150;
        //сохраняем соотношение сторон в зависимости от ширины
        $handle->image_ratio_y = true;
        //указываем путь к водяному знаку для изображения
        //$handle->image_watermark = $_SERVER['DOCUMENT_ROOT'].'/path/to/watermark/watermark.png';
        //загружаем изображение в папку images
        $handle->process($_SERVER['DOCUMENT_ROOT'] . '/assets/avatars');
        if ($handle->processed) {

            if ($userprofile->upload_avatar($user->isClientId(), '/assets/avatars/' . $avatar_file_name . $avatar_type)) {
                location_href($_SERVER['REQUEST_URI']);
            } else {
                echo 'Error: фото не обновлено!';
            }
            $handle->clean();
        } else {
            echo 'Error : ' . $handle->error;
        }
    }
}

if ($user->isClient() || $user->isEditor()) {
    //$pr_products = new \project\products();

    $user_phone_disabled = 'disabled="disabled"';
    $user_phone_disabled_title = 'title="Чтобы изменить номер телефона обратитесть в поддержку!"';
    if ($user->isEditor()) {
        $user_phone_disabled = '';
        $user_phone_disabled_title = '';
    }
    $avatar = (strlen($user_data['avatar']) > 0) ? $user_data['avatar'] : '/assets/img/user/user.jpg';
    include 'tmpl/admin.php';
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
    goBack('/admin/', 3);
}