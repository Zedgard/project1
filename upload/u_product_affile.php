<?php

/*
 * /upload/u_product_affile.php
 */
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
//$sqlLight = new \project\sqlLight();


include $_SERVER['DOCUMENT_ROOT'] . '/config_old.php';
$sqlLight = new \project\sqlLight();

$wp_posts = $sqlLight->queryList("SELECT p.`ID`, p.`post_author`, p.`post_date`, "
        . "p.`post_content`, p.`post_title`, p.`post_excerpt`, p.`post_status`, p.`comment_status`, "
        . "p.`ping_status`, p.`post_password`, p.`post_name`, p.`post_modified`, "
        . "p.`post_modified_gmt`, p.`post_content_filtered`, p.`post_parent`, p.`guid`, p.`menu_order`, "
        . "p.`post_type`, p.`post_mime_type`, p.`comment_count`, "
        . "(SELECT pm1.`meta_value` FROM `wp_postmeta` pm1 WHERE pm1.`post_id` = p.`ID` and pm1.`meta_key`='_regular_price' ) as price "
        . "FROM `wp_posts` p where p.`post_type`='product' and p.`post_status`='publish' ORDER BY p.`ID` ASC  ");
// limit 100
//print_r($wp_posts);
// отключил
if (1 == 1) {
    foreach ($wp_posts as $key => $value) {
        include $_SERVER['DOCUMENT_ROOT'] . '/config_old_affile.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
        $sqlLight = new \project\sqlLight();
        $obj = $sqlLight->queryList("SELECT * FROM product p WHERE p.product_sku='{$value['ID']}'");
        if (count($obj) > 0) {
            $product_slug = "{$obj[0]['product_sku']}-{$obj[0]['product_id']}";
            $upQuery ="UPDATE `product` SET product_slug='?' WHERE product_id='?'";
            if ($sqlLight->query($upQuery, array($product_slug, $obj[0]['product_id']), 0)) {
                echo "id: {$obj[0]['product_id']} up true<br/>\n";
            } else {
                echo "id: {$obj[0]['product_id']} up false<br/>\n";
            }
        } else {
            $query = "INSERT INTO `product` "
                    . "(`product_name`, `product_description`, `product_short_description`, `product_price`, `product_sku`, `product_slug`, `product_share_count`, `product_click_count`, `product_view_count`, `product_sales_count`, `product_featured_image`, `product_banner`, `product_video`, `product_type`, `product_commision_type`, `product_commision_value`, `product_status`, `product_ipaddress`, `product_created_date`, `product_updated_date`, `product_created_by`, `product_updated_by`, `product_click_commision_type`, `product_click_commision_ppc`, `product_click_commision_per`, `product_total_commission`, `product_recursion_type`, `product_recursion`, `recursion_custom_time`, `recursion_endtime`, `view`, `on_store`, `downloadable_files`, `allow_shipping`, `allow_upload_file`, `allow_comment`, `state_id`) "
                    . "VALUES ('?', '?', '?', '?', '?', '?', '', 0, 0, 0, '', '', '', 'virtual', 'default', 0, 1, '172.69.10.188', '2020-10-14 14:42:01', '0000-00-00 00:00:00', 1, 0, 'default', 0, 0, '0', '', '', 0, NULL, 2, 0, '[]', 0, 0, 0, 0);";
            $sqlLight->setHtmlspecialchars(0);
            if ($sqlLight->query($query, array($value['post_title'], $value['post_content'], $value['post_title'], $value['price'], $value['ID']), 0)) {
                echo "id: {$value['ID']} true<br/>\n";
            } else {
                echo "id: {$value['ID']} false<br/>\n";
            }
        }
    }
} else {
    print_r($wp_posts);
}

/* 
INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_short_description`, `product_price`, `product_sku`, `product_slug`, `product_share_count`, `product_click_count`, `product_view_count`, `product_sales_count`, `product_featured_image`, `product_banner`, `product_video`, `product_type`, `product_commision_type`, `product_commision_value`, `product_status`, `product_ipaddress`, `product_created_date`, `product_updated_date`, `product_created_by`, `product_updated_by`, `product_click_commision_type`, `product_click_commision_ppc`, `product_click_commision_per`, `product_total_commission`, `product_recursion_type`, `product_recursion`, `recursion_custom_time`, `recursion_endtime`, `view`, `on_store`, `downloadable_files`, `allow_shipping`, `allow_upload_file`, `allow_comment`, `state_id`) VALUES
(1, 'test 2', '<p>test 2<br></p>', 'test 2', 1000, '546465465', 'test-2-546465465-1', '', 0, 0, 0, 'xO7F1zGsirlfqpKQgUmZHIkXdbeYS8nE.jpg', '', '', 'virtual', 'default', 0, 1, '172.69.10.188', '2020-10-14 14:42:01', '0000-00-00 00:00:00', 1, 0, 'default', 0, 0, '0', '', '', 0, NULL, 2, 0, '[]', 0, 0, 0, 0);

 */

