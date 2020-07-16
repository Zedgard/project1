<?php

namespace project;

defined('__CMS__') or die;

/*
 * Страницы сайта
 */

class page {

    public function __construct() {
        ;
    }

    public function list() {
        $pages = array();
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, t.theme_title, t.server_name "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id "
                . "where p.url='?' and p.visible=1 ";
        $pages = $sqlLight->queryList($query, array($page_url));
        return $pages;
    }

    /**
     * Отобразить страницу на сайте
     * @param string $page_url
     * @return type
     */
    public function show() {
        if ($_SESSION['url'][0] == $_SESSION['url'][1]) {
            $page_url = $_SESSION['url'][1];
        } else {
            $page_url = $_SESSION['url'][0];
        }

        $_SESSION['page_url'] = $page_url;


        if (strlen($page_url) == 0) {
            $page_url = 'index';
        }
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, t.theme_title, t.server_name "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id "
                . "where p.url='?' and p.visible=1 ";
        $page = $sqlLight->queryList($query, array($page_url))[0];
        $_SESSION['page']['info'] = $page;
        $_SESSION['site_title'] = $_SESSION['site_title'] . ' - ' . $_SESSION['page']['info']['page_title'];
        return $page;
    }

    public function adminList($page_id) {
        $pages = array();
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, t.theme_title, t.server_name "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id ";
        if ($page_id > 0) {
            $query .= "where p.url='?' ";
        }
        $pages = $sqlLight->queryList($query, array($page_id));
        return $pages;
    }

}
