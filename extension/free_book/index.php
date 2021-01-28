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



$free_book_col = count($free_books)-1;
//echo "free_book_col: {$free_book_col}<br/>\n";
$elm_1 = rand_number(0, $free_book_col);
$elm_2 = rand_number(0, $free_book_col);
//$elm_3 = rand_number(0, $free_book_col);

include 'tmpl/index.php';
