<?php

session_start();
defined('__CMS__') or die;

include_once 'inc.php';

$pr_template = new \project\template();

if(isset($_POST['getThemesAll'])){
    $data = $pr_template->getThemesAll();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if(isset($_POST['getThemesFilesAll'])){
    $data = $pr_template->getThemesFilesAll($_POST['getThemesFilesAll']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if(isset($_POST['getFileText'])){
    $template = $_POST['template'];
    $file_edit = $_POST['file_edit'];
    $data = $pr_template->getFileText($template, $file_edit);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}

if(isset($_POST['setFileText'])){
    $fileText = $_POST['fileText'];
    $template = $_POST['template'];
    $file_edit = $_POST['file_edit'];
    if ($pr_template->setFileText($template, $file_edit, $fileText)) {
        $result = array('success' => 1, 'success_text' => 'Выполнено');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}