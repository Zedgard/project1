<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

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
     * Инициализировать страницу на сайте
     * @param string $page_url
     * @return type
     */
    public function init() {
        $sqlLight = new \project\sqlLight();
        if ($_SESSION['url'][0] == $_SESSION['url'][1]) {
            $page_url = $_SESSION['url'][1];
        } else {
            $page_url = $_SESSION['url'][0];
        }
        $_SESSION['page_url'] = $page_url;

        // По умолчанию загрузим основную страницу сайта
        if (strlen($page_url) == 0) {
            $page_url = 'index';
        }

        $page = $this->getPageInfoOrUrl($page_url);
        //echo "\n page: {$page['id']} \n";

        if ($page['id'] > 0) {
            $queryRole = "SELECT * FROM `zay_pages_roles` WHERE page_id='?' ";
            $roles = $sqlLight->queryList($queryRole, array($page['id']));
            /*
             * Если страница открыта только для определенной роли то необходима авторизация
             */
            $user_role = 0;
            $role_count = count($roles);
            if ($role_count > 0) {
                $r = array();
                for ($i = 0; $i < $role_count; $i++) {
                    if ($_SESSION['user']['info']['role_id'] == $roles[$i]['role_id']) {
                        $user_role = 1;
                    }
                    $r[] = $roles[$i]['role_id'];
                }
                $_SESSION['page']['roles'] = $r;
                if ($user_role == 0) {
                    // отправим на страницу авторизации
                    $page = $this->getPageInfoOrUrl('auth');
                }
            }
            $_SESSION['page']['info'] = $page;
            $_SESSION['site_title'] = $_SESSION['site_title'] . ' - ' . $_SESSION['page']['info']['page_title'];
        } else {
            $_SESSION['site_title'] = $_SESSION['site_title'];
            $_SESSION['page'] = array();
        }

        return $page;
    }

    private function getPageInfoOrUrl($page_url) {
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, t.theme_title, t.server_name, p.visible "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id "
                . "where p.url='?' ";
        return $sqlLight->queryList($query, array($page_url))[0];
    }

    public function adminList($page_id) {
        $pages = array();
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, t.theme_title, t.server_name "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id ";
        if ($page_id > 0) {
            $query .= "where p.id='?' ";
        }
        $pages = $sqlLight->queryList($query, array($page_id));
        return $pages;
    }

    public function themesListArray() {
        $themes = array();
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_themes` ";
        $themes = $sqlLight->queryList($querySelect, array());
        return $themes;
    }

    /**
     * Редактирование
     * @param type $id
     * @param type $url
     * @param type $page_title
     * @param type $theme_id
     * @param type $visible
     * @return type
     */
    public function edit($id, $url, $page_title, $theme_id, $visible) {
        $sqlLight = new \project\sqlLight();

        if ($id == 0 || $id == '') {
            $querySelect = "SELECT * FROM `zay_pages` WHERE url='?'";
            $page = $sqlLight->queryList($querySelect, array($url));

            if (count($page) > 0) {
                $_SESSION['errors'][] = 'Такая ссылка на страницу уже существует';
            }
            if (count($_SESSION['errors']) == 0) {
                $query = "INSERT INTO `zay_pages`(`url`, `page_title`, `theme_id`, `visible`, `higter`) "
                        . "VALUES ('?','?','?','?', '0')";
                return $sqlLight->query($query, array($url, $page_title, $theme_id, $visible));
            }
        } else {
            $query = "UPDATE `zay_pages` SET "
                    . "`theme_id`='?',`visible`='?' "
                    . "WHERE `id`='?' ";
            return $sqlLight->query($query, array($theme_id, $visible, $id));
        }
        return false;
    }

    /**
     * Удаление
     * @param type $id
     * @return boolean
     */
    public function delete($id) {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_pages` ";
        $page = $sqlLight->queryList($querySelect, array())[0];
        if ($page['url'] == 'index') {
            $_SESSION['errors'][] = 'Нельзя удалять главную страницу';
            return false;
        } else {
            $queryDelete = "DELETE FROM `zay_pages` WHERE id='?' ";
            return $sqlLight->query($queryDelete, array($id));
        }
    }

    /**
     * Получить блоки
     * @param type $id
     * @return type
     */
    public function bloksListArray($id = 0) {
        $bloks = array();
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_pages_blocks` ";
        if ($id > 0) {
            $querySelect .= "where id='?' ";
        }
        $querySelect .= "ORDER BY `block_name` ASC ";
        $bloks = $sqlLight->queryList($querySelect, array($id));
        return $bloks;
    }

    /**
     * Получить блоки
     * @param type $id
     * @return type
     */
    public function contentsListArray($page_id) {
        $contents = array();
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_page_block_contents` "
                . "where page_id='?' "
                . "ORDER BY `zay_page_block_contents`.`sort` ASC ";

        $contents = $sqlLight->queryList($querySelect, array($page_id));
        return $contents;
    }

    public function pageBlockContentsListArray($id) {
        $pageBlockContents = array();
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_page_block_contents` where id='?' ";
        $pageBlockContents = $sqlLight->queryList($querySelect, array($id));
        return $pageBlockContents;
    }

    /**
     * Сохранить сортировку
     * @param type $contents_is
     * @param type $sort
     * @return type
     */
    public function contentSorted($content_id, $sort) {
        $sqlLight = new \project\sqlLight();
        $query = "UPDATE `zay_page_block_contents` SET `sort`='?' WHERE `id`='?'";
        return $sqlLight->query($query, array($sort, $content_id));
    }

    /**
     * Редактирование контента
     * @param type $id
     * @param type $content_title
     * @param type $page_id
     * @param type $block_id
     * @param type $content_descr
     * @param type $extension
     * @return boolean
     */
    public function contentEdit($id, $content_title, $page_id, $block_id, $content_descr, $extension) {
        $sqlLight = new \project\sqlLight();

        if ($extension == '0') {
            $extension = '';
        }
        if ($id == 0 || $id == '') {
            $querySelect = "SELECT * FROM `zay_page_block_contents` WHERE content_title='?'";
            $content = $sqlLight->queryList($querySelect, array($content_title));

            if (count($content) > 0) {
                $_SESSION['errors'][] = 'Материал с таким наименованием уже существует';
            }
            if (count($_SESSION['errors']) == 0) {
                $query = "INSERT INTO `zay_page_block_contents`(`content_title`, `page_id`, `block_id`, `content_descr`, `extension`, `sort`) "
                        . "VALUES ('?','?','?','?','?','0') ";
                return $sqlLight->query($query, array($content_title, $page_id, $block_id, $content_descr, $extension));
            }
        } else {
            $query = "UPDATE `zay_page_block_contents` SET "
                    . "`content_descr`='?',`extension`='?' "
                    . "WHERE `id`='?' ";
            return $sqlLight->query($query, array($content_descr, $extension, $id));
        }
        return false;
    }

    /**
     * Удаление контента
     * @param type $id
     * @return type
     */
    public function materialDelete($id) {
        $sqlLight = new \project\sqlLight();
        $query = "DELETE FROM `zay_page_block_contents` WHERE `id`='?' ";
        return $sqlLight->query($query, array($id));
    }

}
