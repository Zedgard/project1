<?php

/*
 * Процедура импорта пользователей, можно запускать по крон заданию или вручную
 */
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
$sqlLight = new \project\sqlLight();


//$_SESSION['external_code'] = 30000;
if (!isset($_SESSION['external_code'])) {
    $_SESSION['external_code'] = 0;
}
/*
 * Получим начальное значение последнего импорта
 */
$queryInsertImport = "select i.val from `zay_import` i WHERE i.`code`='wp_products' ";
$obj_imports = $sqlLight->queryList($queryInsertImport, array());
if (count($obj_imports) > 0) {
    $_SESSION['external_code'] = $obj_imports[0]['val'];
}

unset($sqlLight);
include $_SERVER['DOCUMENT_ROOT'] . '/config_old.php';
$sqlLight = new \project\sqlLight();

/*
 * Импортируем данные из другой базы
 */
//echo "external_code: {$_SESSION['external_code']} <br/>\n";
$wp_posts = $sqlLight->queryList("SELECT ddd.`ID`, ddd.`post_author`, ddd.`post_date`, "
        . "ddd.`post_content`, ddd.`post_title`, ddd.`post_excerpt`, ddd.`post_status`, ddd.`comment_status`, "
        . "ddd.`ping_status`, ddd.`post_password`, ddd.`post_name`, ddd.`post_modified`, "
        . "ddd.`post_modified_gmt`, ddd.`post_content_filtered`, ddd.`post_parent`, ddd.`guid`, ddd.`menu_order`, "
        . "ddd.`post_type`, ddd.`post_mime_type`, ddd.`comment_count`, ddd.`price`, ddd.`_product_image_gallery`, ddd.`_thumbnail_id`, "
        . "ddd.`_downloadable_files`, "
        . "(SELECT pm4.`meta_value` FROM `wp_postmeta` pm4 WHERE pm4.`post_id` = pp.`ID` and pm4.`meta_key`='_wp_attached_file' ) as image_url "
        //. "(select pp.`ID` from `wp_posts` pp WHERE pp.`ID`=ddd.`_thumbnail_id`) as image_url"
        //. "* " // (SELECT pm4.`meta_value` FROM `wp_postmeta` pm4 WHERE pm4.`post_id` = pp.`ID` and pm4.`meta_key`='_wp_attached_file' )
        //. "from `wp_posts` pp WHERE pp.ID=ddd.`_thumbnail_id`) as image_url"
        . "from (SELECT p.`ID`, p.`post_author`, p.`post_date`, "
        . "p.`post_content`, p.`post_title`, p.`post_excerpt`, p.`post_status`, p.`comment_status`, "
        . "p.`ping_status`, p.`post_password`, p.`post_name`, p.`post_modified`, "
        . "p.`post_modified_gmt`, p.`post_content_filtered`, p.`post_parent`, p.`guid`, p.`menu_order`, "
        . "p.`post_type`, p.`post_mime_type`, p.`comment_count`, "
        . "(SELECT pm1.`meta_value` FROM `wp_postmeta` pm1 WHERE pm1.`post_id` = p.`ID` and pm1.`meta_key`='_regular_price' ) as price, "
        . "(SELECT pm2.`meta_value` FROM `wp_postmeta` pm2 WHERE pm2.`post_id` = p.`ID` and pm2.`meta_key`='_product_image_gallery' ) as _product_image_gallery, "
        . "(SELECT pm3.`meta_value` FROM `wp_postmeta` pm3 WHERE pm3.`post_id` = p.`ID` and pm3.`meta_key`='_thumbnail_id' ) as _thumbnail_id,"
        . "(SELECT pm5.`meta_value` FROM `wp_postmeta` pm5 WHERE pm5.`post_id` = p.`ID` and pm5.`meta_key`='_downloadable_files' ) as _downloadable_files  "
        . "FROM `wp_posts` p where p.`post_type`='product' ORDER BY p.`ID` ASC limit 10000) ddd "
        . "left join `wp_posts` pp on pp.`ID`=ddd.`_thumbnail_id` ", array(), 1);

//print_r($wp_posts);
exit();
unset($sqlLight);
// новое подключение
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$sqlLight = new \project\sqlLight();

/*
 * Сохраним данные в нашу базу
 */

//$query = "SELECT * FROM `zay_users` ORDER BY `id` ASC";
//$objs = $sqlLight->queryList($query);
//print_r($objs);

/**
 * Получим ссылку на фаил
 * @param type $text
 * @return string
 */
function get_fale_str($text) {
    // распарсим данные и выделим ссылки
    $find_zip = preg_replace('~(https?://\S+.zip)|.~su', '$1', $text);
    if (strlen($find_zip) == 0) {
        $find_pdf = preg_replace('~(https?://\S+.pdf)|.~su', '$1', $text);
        if (strlen($find_pdf) > 0) {
            return $find_pdf;
        }
    } else {
        return $find_zip;
    }
    return '';
}

/**
 * Добавление информации по товару
 * @param type $title
 * @param type $descr
 * @param type $ex_code
 * @param type $articul
 * @param type $images
 * @param type $url_file
 * @param type $active
 * @param type $lastdate
 * @param type $is_delete
 * @return boolean
 */
function product_add($title, $descr, $ex_code, $articul, $images, $url_file, $active, $creat_date, $lastdate, $is_delete, $url_old_site) {
    $sqlLight = new \project\sqlLight();
    $querySelect = "SELECT * FROM `zay_wares` WHERE `ex_code`='?'";
    $wares = $sqlLight->queryList($querySelect, array($ex_code));
    if (count($wares) > 0) {
        $qu = "UPDATE `zay_wares` SET `title`='?',`descr`='?',"
                . "`articul`='?',"
                . "`images`='?',`url_file`='?',`active`='?',"
                . "`lastdate`='?',`is_delete`='?', `url_old_site`='?'"
                . "WHERE `id`='?' and `ex_code`='?'";
        return $sqlLight->query($qu, array($title, $descr, $articul, $images, $url_file, $active, $lastdate, $is_delete, $url_old_site, $wares[0]['id'], $ex_code));
    } else {
        $qi = "INSERT INTO `zay_wares`(`title`, `descr`, `col`, `ex_code`, `articul`, `images`, `url_file`, `active`, `creat_date`, `lastdate`, `is_delete`, `url_old_site`) "
                . "VALUES ('?','?','?','?','?','?','?','?','?','?','?','?')";
        return $sqlLight->query($qi, array($title, $descr, '0', $ex_code, $articul, $images, $url_file, $active, $creat_date, $lastdate, $is_delete, $url_old_site), 0);
    }
    return false;
}

/**
 * Добавим удалим продукты
 * @param type $table
 * @param array $params
 */
function updateOrInsertData($external_code, $title, $desc_minimal, $price, $desc, $images_str, $file_str, $post_date, $post_modified, $wp_link) {
    $errors = array();
    $sqlLight = new \project\sqlLight();
    //echo "ext: {$external_code} <br/>\n";
    // ссылка на фаил сайта на wordpress
    $wp_upload_url = 'https://download.edgardzaitsev.com/wp-content/uploads/';

    $price = (strlen(trim($price)) > 0) ? $price : 0;
    $url_file = get_fale_str($file_str);
    $wp_link = "https://edgardzaitsev.com/katalog/{$wp_link}/";

    // Найдем сам товар
    // по коду
    $querySelect = "SELECT * FROM `zay_wares` w where w.`ex_code`='?'";
    $objs = $sqlLight->queryList($querySelect, array($external_code));
    if (count($objs) == 0) {
        // по наименованию
        $querySelect = "SELECT * FROM `zay_wares` w where w.`title` LIKE '?'";
        $objs_2 = $sqlLight->queryList($querySelect, array($title), 0);

        if (count($objs_2) == 1) {
            $objs = $objs_2;
            // если по наименование нашли товар то обновим код товара
            $queryUpdateWares1 = "UPDATE `zay_wares` w SET w.`ex_code`='?' WHERE w.`id`='?' ";
            $sqlLight->query($queryUpdateWares1, array($external_code, $objs[0]['id']));
        }
        if (count($objs_2) == 0) {
            // Добавим если все поиски в холостую
            if (product_add($title, $desc_minimal, $external_code, 'A-' . $external_code, $wp_upload_url . $images_str, $url_file, '1', $post_date, $post_modified, '0', $wp_link)) {
                $querySelect = "SELECT * FROM `zay_wares` w where w.`ex_code`='?'";
                $objs = $sqlLight->queryList($querySelect, array($external_code));
            }
        }
    }
    //print_r($objs);
    // Закончим поиски
    //exit();
    /*
     * Начнем добавление продукта
     */
    if (strlen($external_code) > 0 && $external_code > 0) {
        if (count($objs) > 0 && $objs[0]['id'] > 0) {

            // связь товара и продукта
            $querySelectProductWares1 = "SELECT count(*) FROM `zay_product_wares` pw where pw.`wares_id`='?'";
            //$productWares = $sqlLight->queryList($querySelectProductWares2, array($objs[0]['id']), 1)[0]['col'];
            //$querySelectProductWares2 = "SELECT count(*) col FROM `zay_product_wares` p "
            //        . "where p.`product_id`=(SELECT pw.product_id FROM `zay_product_wares` pw where pw.`wares_id`='?') ";
            $productWares = $sqlLight->queryList($querySelectProductWares1, array($objs[0]['id']), 0)[0]['col'];
            $product_add = 0;
            if ($productWares == 0 || $productWares > 1) {
                $product_add = 1;
            }

            // Поиск продукта
            $querySelectFindProduct = "SELECT * FROM `zay_product` w where w.`title` LIKE '?'";
            $prodict_obj = $sqlLight->queryList($querySelectFindProduct, array($title));
            if (count($prodict_obj) == 0) {
                $product_add = 1;
            } else {
                $product_add = 0;
            }

            // если нет продукта или нет одиночного  продукта, отметим флаг на добавление
            if ($product_add == 1) {


                $queryInsertProduct = "INSERT INTO `zay_product` (`title`, `desc_minimal`, `price`, `price_promo`, `desc`, `images_str`, `product_new`, `sold`, `active`, `lastdate`, `is_delete`) "
                        . "VALUES ('{$title}','{$desc_minimal}','{$price}','0','{$desc}','{$wp_upload_url}{$images_str}','0','0','1','{$post_modified}','0')";
                if (!$sqlLight->query($queryInsertProduct, array(), 0)) {
                    $sqlLight->query($queryInsertProduct, array(), 1);
                    $errors[] = 'INSERT INTO `zay_product`';
                } else {
                    $selectProductId = "SELECT max(p.`id`) as col FROM `zay_product` p";
                    $product_id = $sqlLight->queryList($selectProductId)[0]['col'];
                    // Создадим связь zay_product_wares
                    $insertProductWaresLine = "INSERT INTO `zay_product_wares`(`product_id`, `wares_id`) "
                            . "VALUES ('?','?')";
                    if ($sqlLight->query($insertProductWaresLine, array($product_id, $objs[0]['id']), 1)) {
                        $errors[] = 'INSERT INTO `zay_product_wares`';
                    }
                }
                echo "<br/><br/><br/><br/>\n\n\n\n\n";
            }

            // Обновим изображение на товаре
            if (strlen(trim($images_str)) > 0) {
                $queryUpdateWares = "UPDATE `zay_wares` w SET w.`images`='?' WHERE w.`ex_code`='?' ";
                if (!$sqlLight->query($queryUpdateWares, array($wp_upload_url . $images_str, $external_code))) {
                    $errors[] = 'UPDATE `zay_wares` SET';
                }
            }

            // обновление
//            $queryUpdate = "update `zay_users` set first_name='?', last_name='?', email='?', "
//                    . "city='?', city_code='?', phone='?', active_subscriber='?' "
//                    . "where id='?' ";
//            if ($sqlLight->query($queryUpdate, array($first_name, $last_name, $email,
//                        $city, $city_code, $phone, $active_subscriber, $objs[0]['id']), 0)) {
//                echo "-- update {$objs[0]['id']} true<br/>\n";
//            } else {
//                echo "-- update {$objs[0]['id']} false<br/>\n";
//            }
        }
        //$_SESSION['external_code'] = $external_code;
        //$queryInsert = "UPDATE `zay_import` SET `val`='?' WHERE `code`='wp_users'";
        //$sqlLight->query($queryInsert, array($_SESSION['external_code']));
    }

    if (count($errors) == 0) {
        return true;
    } else {
        print_r($errors);
        return false;
    }
}

//print_r($wp_users);
$i = 0;
foreach ($wp_posts as $key => $value) {
    $i++;
    //$date = date("m.d.Y H:m:s", $value['wc_last_active']);
    //echo "{$value['wc_last_active']} d: {$date} <br/>\n";
    //echo "ID: {$value['ID']} <br/>\n";
    //print_r($value); //  "$value";
    if (updateOrInsertData($value['ID'], $value['post_title'], $value['post_content'],
                    $value['price'], $value['post_content'], $value['image_url'],
                    $value['_downloadable_files'], $value['post_date'], $value['post_modified'], $value['post_name'])) {
        echo "{$i} - {$value['ID']} OK<br/>\n";
    } else {
        echo "{$i} - {$value['ID']} Error<br/>\n";
    }
    //echo "\n\n";
    //echo "{$value['ID']}, {$value['post_title']}, {$value['post_content']}, {$value['price']}, {$value['post_content']}, {$value['image_url']}, {$value['post_modified']}";
}

