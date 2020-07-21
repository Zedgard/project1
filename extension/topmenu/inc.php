<?php

namespace project;


/**
 * Верхнее меню
 */
class topmenu {

    public function __construct() {
        ;
    }

    public function getTemplateInc() {
        $_SESSION['lang'];
        ob_start();
        if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/topmenu/tmpl/index_' . $_SESSION['lang'] . '.php')) {
            include 'lang.php';
            include 'tmpl/index_' . $_SESSION['lang'] . '.php';
        } else {
            include 'lang.php';
            include 'tmpl/index_ru.php';
        }
        $html = ob_get_clean();
        return $html;
    }

}
