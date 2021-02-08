<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/topic/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once 'inc.php';

$c_free_book = new \project\free_book();
$free_books = $c_free_book->getFreeBookArray($searchStr);
//foreach ($free_books as $value) {
//    echo "{$value['title']}<br/>\n";
//} 
if (count($free_books) > 1) {
    $elm_1 = 0;
    $elm_2 = 1;
//$elm_3 = rand_number(0, $free_book_col);

    include 'tmpl/index.php';
}