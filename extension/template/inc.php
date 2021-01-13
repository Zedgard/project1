<?php

namespace project;

defined('__CMS__') or die;

class template extends \project\extension {

    private $dir;

    public function __construct() {
        parent::__construct();
        $this->dir = $_SERVER['DOCUMENT_ROOT'] . '/themes';
    }

    /**
     * Список дизайнов
     * @return type
     */
    public function getThemesAll() {
        $files = array();
        if ($handle = opendir($this->dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $files[] = array('file' => $file, 'title' => $file);
                }
            }
        }
        return $files;
    }

    /**
     * Список файлов выбранного дизайна
     * @return type
     */
    public function getThemesFilesAll($theme_dir) {
        $files = array();
        if ($handle = opendir($this->dir . '/' . $theme_dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $files[] = array('file' => $file, 'title' => $file);
                }
            }
        }
        return $files;
    }

    /**
     * HTML данны с файла
     * @return type
     */
    public function getFileText($theme_dir, $file_name) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
        //echo $this->dir . '/' . $theme_dir . '/' . $file_name . "\n";
        $html = fileGet($this->dir . '/' . $theme_dir . '/' . $file_name);
        return $html;
    }

    /**
     * HTML данны зафиксируем в файл
     * @return type
     */
    public function setFileText($theme_dir, $file_name, $fileText) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
        return fileSet($this->dir . '/' . $theme_dir . '/' . $file_name, $fileText);
    }

}
