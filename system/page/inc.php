<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/pages/inc.php';

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
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, p.higter, p.description "
                . "t.theme_title, t.server_name "
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
        $pages = new \project\pages();

        // Отчистим хлебные крошки
        $this->bread_clear();

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

        // информация о странице
        $page = $this->getPageInfoOrUrl($page_url);
        //print_r($page);
        //echo "\n page: {$page['id']} \n";
        // Если существует страница
        if (is_array($page) && count($page) > 0 && isset($page['id']) && $page['id'] > 0) {
            //$r = array();
            // Роли страницы
            $queryRole = "SELECT * FROM zay_pages_roles pr 
                                left join zay_roles r on r.id=pr.role_id 
                                WHERE pr.page_id='?'";
            $roles = $sqlLight->queryList($queryRole, array($page['id']), 0);

            /*
             * Если страница открыта только для определенной роли то необходима авторизация
             */
            //print_r($roles);
            //exit();
            // Так как страница найдена то по умолчанию отправим на авторизацию
            $page_show = 2;
            if (count($roles) > 0) {
                // Зафиксируем роли страницы
                foreach ($roles as $v) {
                    $_SESSION['page']['roles'][] = $v;
                }

                //print_r($_SESSION['user']['info']);
                //echo "<br/>";
                //Если авторизированный пользователь 
                if (isset($_SESSION['user']['info']['id']) && $_SESSION['user']['info']['id'] > 0) {
                    foreach ($roles as $value) {
                        if ($_SESSION['user']['info']['role_privilege'] >= $value['role_privilege']) {
                            $page_show = 1;
                            break;
                        }
                    }

                    // если зашел админ под учеткой пользователя 
                    if ($page_show == 0 && $_SESSION['user']['other'] == 1) {
                        $page_show = 1;
                    } else {
                        foreach ($roles as $v) {
                            if ($v['role_privilege'] == 0) {
                                $page_show = 1;
                            }
                        }
                    }
                } else {
                    //echo 111;
                    // Поишем роль общедоступную
                    foreach ($roles as $v) {
                        if ($v['role_privilege'] == 0) {
                            $page_show = 1;
                        }
                        if ($v['role_privilege'] > 7) {
                            $page_show = 2;
                        }
                    }
                }
            } else { // Если не назначены права
                $page_show = 1;
            }

            //echo "p: {$_SESSION['page_url']} |{$page_show}| \n";
            //exit();
            if ($page_show == 2) {
                $page = $this->getPageInfoOrUrl('auth');
                location_href('/auth/');
            }

            /*
             * Если нет роли значит учетка не активирована
             */
            if ($page_show == 0) {
                // отправим на страницу авторизации
                //$page = $this->getPageInfoOrUrl('index');
                $_SESSION['site_title'] = $_SESSION['site_title'] . ' - cтраница не найдена ';
                $_SESSION['page'] = array();
            }

            if ($page_show == 1) {
                $_SESSION['page']['info'] = $page;
                // Поиск замены заголовков
                $title_data = $pages->title_get_url("/{$_SESSION['page_url']}/");
                //print_r($title_data);
                if (count($title_data) > 0) {
                    if (strlen($title_data[0]['title_text']) > 0) {
                        $_SESSION['site_title'] = $_SESSION['site_title'] . ' - ' . $title_data[0]['title_text'];
                        $_SESSION['site_seo_descr'] = $title_data[0]['descr_text'];
                    }
                } else {
                    //$_SESSION['site_title'] = $_SESSION['site_title'] . ' - ' . $_SESSION['page']['info']['page_title'];
                }
                //echo $_SESSION['site_title'];
            }
        } else {
            // Не существует такой страницы
            $_SESSION['site_title'] = $_SESSION['site_title'] . ' - cтраница не найдена ';
            $_SESSION['page'] = array();
        }

        // SEO Уникальные заголовки 
        if ($_SERVER['REQUEST_URI'] != "/{$_SESSION['page_url']}/") {
            $title_data = array();
            $title_data = $pages->title_get_url($_SERVER['REQUEST_URI']);
            //print_r($title_data);
            if (count($title_data) > 0) {
                if (strlen($title_data[0]['title_text']) > 0) {
                    $_SESSION['site_title'] = $_SESSION['site_title'] . ' - ' . $title_data[0]['title_text'];
                    $_SESSION['site_seo_descr'] = $title_data[0]['descr_text'];
                }
            }
        }

        return $page;
    }

    /**
     * Информация по странице для index
     * @param type $page_url
     * @return string
     */
    private function getPageInfoOrUrl($page_url) {
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, p.higter, t.theme_title, "
                . "t.server_name, p.description, p.visible "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id "
                . "where p.url='?' ";
        $page = $sqlLight->queryList($query, array($page_url))[0];
        //$pages = $this->adminList(0);

        $links = $this->get_higter_url_array($page, array());
        //print_r($links);
        //$urls = [];
        for ($i = 0; $i < count($links); $i++) {
            //$urls[] = $links[$i]['url'];
            $this->bread_add($links[$i]['url'], $links[$i]['title']);
        }
//        if (count($urls) == 0) {
//            $pages[$a]['url_a_href'] = '/';
//            $this->bread_add('/', 'Главная');
//        } else {
//            $pages[$a]['url_a_href'] = '/' . implode('/', $urls) . '/';
//            $this->bread_add('/', $urls);
//        }

        /*
         * Разберемся с ссылками
         */
//        for ($a = 0; $a < count($pages); $a++) {
//            $links = $this->get_higter_url_array($page, $pages);
//            //print_r($links);
//            $urls = [];
//            for ($i = 0; $i < count($links); $i++) {
//                $urls[] = '/' . $links[$i]['url'] . '/';
//            }
//            if (count($urls) == 0) {
//                $page['url_a_href'] = '/';
//            } else {
//                $page['url_a_href'] = '/' . implode('/', $urls) . '/';
//            }
////            if ($page['id'] == $pages[$a]['id']) {
////               print_r($links);
////                echo "<br/>\n";
////            }
//
//            $title = [];
//            $url_href = [];
//            $url_hrefs = [];
//            for ($i = 0; $i < count($urls); $i++) {
//                $title[] = $links[$i]['title'];
//            }
//
//            for ($i = 0; $i < count($title); $i++) {
//                if ($urls[$i] != '/index/') {
//                    $url_href[] = "<a href=\"{$urls[$i]}\">{$title[$i]}</a>";
//                    $url_hrefs[] = array('url' => $urls[$i], 'title' => $title[$i]);
//                } else {
//                    $url_href[] = "<a href=\"/\">{$title[$i]}</a>";
//                    $url_hrefs[] = array('url' => '/', 'title' => $title[$i]);
//                }
//            }
//
//            if (isset($_SESSION['url_href'])) {
//                $url_href[] = $_SESSION['url_href'];
//                unset($_SESSION['url_href']);
//            }
//
//            if (count($url_href) == 0) {
//                $page['url_a_href_bread'] = '<a href="/">Главная</a>';
//                //$this->bread_add('/', 'Главная');
//            } else {
//                if (count($url_hrefs) > 0) {
//                    foreach ($url_hrefs as $value) {
//                        //$this->bread_add($value['url'], $value['title']);
//                    }
//                }
//                $page['url_a_href_bread'] = implode(' / ', $url_href);
//            }
//        }
        // ----------------

        return $page;
    }

    /**
     * Информация о странице
     * необходимо прописывать все дополнительные поля ручками
     * @param type $page_id
     * @return type
     */
    public function adminList($page_id) {
        $pages = array();
        $pages_return_list = array();
        $sqlLight = new \project\sqlLight();
        $query = "SELECT p.id, p.url, p.page_title, p.theme_id, p.visible, p.higter, p.description, "
                . "t.theme_title, t.server_name "
                . "FROM `zay_pages` p "
                . "left join `zay_themes` t on t.id=p.theme_id ";
        if ($page_id > 0) {
            $query .= "where p.id='?' ";
        }
        $pages = $sqlLight->queryList($query, array($page_id));
        //print_r($pages);
        /*
         * Разберемся с ссылками
         */
        for ($a = 0; $a < count($pages); $a++) {
            $links = $this->get_higter_url_array($pages[$a], $pages);
            //print_r($links);
            $urls = [];
            for ($i = 0; $i < count($links); $i++) {
                $urls[] = $links[$i]['url'];
            }
            if (count($urls) == 0) {
                $pages[$a]['url_a_href'] = '/';
            } else {
                $pages[$a]['url_a_href'] = '/' . implode('/', $urls) . '/';
            }
//            $title = [];
//            $url_href = [];
//            for ($i = 0; $i < count($links); $i++) {
//                $title[] = $objs[$i]['title'];
//            }
//
//            for ($i = 0; $i < count($title); $i++) {
//                //echo "{$urls[$i]} {$title[$i]}<br/>\n";
//                $url_href[] = "<a href=\"{$urls[$i]}\">{$title[$i]}</a>";
//            }
//            if (count($url_href) == 0) {
//                $pages[$a]['url_a_href_bread'] = '<a href="/">Главная</a>';
//            } else {
//                $pages[$a]['url_a_href_bread'] = '<a href="/">Главная</a> / ' . implode(' / ', $url_href);
//            }
        }


        // ----------------
        //echo "role_privilege: {$_SESSION['user']['info']['role_privilege']} <br/>\n";
        if (count($pages) > 0) {
            for ($i = 0; $i < count($pages); $i++) {

                if ($_SESSION['user']['info']['role_privilege'] <= 9) {
                    if ($pages[$i]['server_name'] == 'panel') {
                        // заговнокодил :)
                    } else {
                        if ($pages[$i]['server_name'] == 'office') {
                            // заговнокодил :)
                        } else {
                            $pages_return_list[] = $pages[$i];
                        }
                    }
                } else {
                    $pages_return_list[] = $pages[$i];
                }
            }
        }

        return $pages_return_list;
    }

    /**
     * Массив полного пути ссылок
     * @param type $page информаци о страницы из базы
     * @return array 
     */
    public function get_higter_url_array($page, $pages = array()) {
        $ar = $this->higter_url_array($page, array(), $pages);
        return array_reverse($ar);
    }

    /**
     * Массив ссылко полного пути
     * @param type $page информация о страницы из базы
     * @param type $url массив ссылок
     * @param type $pages массив страниц (сам береться)
     * @return type
     */
    private function higter_url_array($page, $url = array(), $pages = array()) {
        if (count($pages) == 0) {
            $pages = $this->adminList(0);
        }

        // Исключим index
        if ($page['url'] <> 'index') {
            $url[] = array('title' => $page['page_title'], 'url' => $page['url']);
        }
        $page_higter = $page['higter'];
        if ($page_higter > 0) {
            foreach ($pages as $key => $value) {
                if ($value['id'] == $page_higter) {
                    $url[] = array('title' => $value['page_title'], 'url' => $value['url']);
                    $this->higter_url_array($value, $url, $pages);
                }
            }
        }
        return $url;
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
    public function edit($id, $url, $url_ex, $page_title, $description, $theme_id, $visible, $higter, $page_role) {
        $sqlLight = new \project\sqlLight();
        $return = false;
        if ($id > 0 || $id == '') {
            $query = "UPDATE `zay_pages` SET "
                    . "`page_title`='?' ,`url_ex`='?', `theme_id`='?',`visible`='?', `description`='?', `higter`='?' "
                    . "WHERE `id`='?' ";
            $return = $sqlLight->query($query, array($page_title, $url_ex, $theme_id, $visible, $description, $higter, $id));
        } else {
            $querySelect = "SELECT * FROM `zay_pages` WHERE url='?'";
            $page = $sqlLight->queryList($querySelect, array($url));

            if (count($page) > 0) {
                $_SESSION['errors'][] = 'Такая ссылка на страницу уже существует';
            }
            if (count($_SESSION['errors']) == 0) {
                $query = "INSERT INTO `zay_pages`(`url`, `url_ex`, `page_title`, `description`, `theme_id`, `visible`, `higter`) "
                        . "VALUES ('?','?','?','?','?','?', '?')";
                $return = $sqlLight->query($query, array($url, $url_ex, $page_title, $description, $theme_id, $visible, $higter));
                $queryMaxCount = "SELECT MAX(id) col FROM `zay_pages`";
                $id = $sqlLight->queryList($queryMaxCount)[0]['col'];
            }
        }


        $pageRoles = $this->page_select_roles_list($id);
        //print_r($pageRoles);
        //echo "{$id} \n";
        $this->insertUpdateOrDeleteRolesPage($id, $page_role, $pageRoles);

        return $return;
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
     * Получить блоки или данные по блоку
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
     * Роли доступлые для блока
     * @param type $id
     * @return type
     */
    public function page_select_roles_list($page_id) {
        $sqlLight = new \project\sqlLight(); // left join `zay_pages` p on pr.page_id=p.id
        $querySelect = "SELECT pr.* FROM `zay_pages_roles` pr where pr.page_id='?'";
        return $sqlLight->queryList($querySelect, array($page_id));
    }

    /**
     * Роли доступлые для страницы
     * @param type $id
     * @return type
     */
    public function page_select_roles($block_id) {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT r.* FROM `zay_pages_roles` pr "
                . "left join `zay_roles` r on r.id=pr.role_id  "
                . "where pr.page_id='?'";
        $querySelect .= "ORDER BY r.`role_name` ASC ";
        return $sqlLight->queryList($querySelect, array($block_id));
    }

    /**
     * Роли доступлые для блока
     * @param type $id
     * @return type
     */
    public function blok_select_roles_list($block_id) {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_pages_block_roles` br "
                . "left join `zay_roles` r on r.id=br.role_id  "
                . "where br.page_block_id='?'";
        $querySelect .= "ORDER BY r.`role_name` ASC ";
        return $sqlLight->queryList($querySelect, array($block_id));
    }

    /**
     * Сохранение данных блока
     * @param type $block_id
     * @param type $block_code
     * @param type $block_name
     * @param type $roles
     * @return type
     */
    public function set_block_info($block_id = 0, $block_code, $block_name, $roles = array()) {
        $sqlLight = new \project\sqlLight();
        $return = false;
        if ($block_id > 0) {
            $queryBlock = "UPDATE `zay_pages_blocks` SET `block_code`='?',`block_name`='?' "
                    . "WHERE `id`='?'";
            $return = $sqlLight->query($queryBlock, array($block_code, $block_name, $block_id));
        } else {
            $queryBlock = "INSERT INTO `zay_pages_blocks`(`block_code`, `block_name`) VALUES (?,?)";
            $return = $sqlLight->query($queryBlock, array($block_code, $block_name));
            $queryMaxCount = "SELECT MAX(id) col FROM `zay_pages_blocks`";
            $block_id = $sqlLight->queryList($queryMaxCount)[0]['col'];
        }
        if ($return == TRUE) {
            // Добавим или отредактируем роли
            $blockRoles = $this->blok_select_roles_list($block_id);
            $this->insertUpdateOrDeleteRolesBlock($block_id, $roles, $blockRoles);
            //if (count($roles) > 0) {
            //    
            //}
            //echo "\n roles: ";
            //print_r($blockRoles);
        }

        return $return;
    }

    /**
     * Сохранение ролей у страницы
     * @param type $block_id
     * @param type $add_roles
     * @param type $blockRoles
     */
    private function insertUpdateOrDeleteRolesPage($block_id, $add_roles, $blockRoles) {
        $sqlLight = new \project\sqlLight();
        $arrDB = $this->get_role_all();
        $arrAdd = array();

        // Найдем те которые уже добавлены
        if (count($add_roles) > 0) {
            foreach ($add_roles as $key => $value) {
                $true = 0;
                foreach ($blockRoles as $k => $v) {
                    if ($value == $v['role_id']) {
                        unset($blockRoles[$key]);
                        $true = 1;
                    }
                }
                // добавим те которые следует добавить
                if ($true == 0) {
                    $arrAdd[] = $value;
                }
            }
        }

        // Почистим добавленные из массива
        if (count($add_roles) > 0) {
            foreach ($arrDB as $key => $value) {
                foreach ($add_roles as $k => $v) {
                    if ($value['id'] == $v) {
                        unset($arrDB[$key]);
                    }
                }
            }
        }

        // Добавим необходимые
        if (count($arrAdd) > 0) {
            foreach ($arrAdd as $value) {
                $q = "INSERT INTO `zay_pages_roles` (`page_id`, `role_id`) VALUES ('?','?')";
                $sqlLight->query($q, array($block_id, $value));
            }
        }

        if (count($arrDB) > 0) {
            foreach ($arrDB as $value) {
                $qDell = "delete from `zay_pages_roles` where page_id='?' and role_id='?' ";
                $sqlLight->query($qDell, array($block_id, $value['id']));
            }
        }
    }

    /**
     * Сохранение ролей у блоков
     * @param type $block_id
     * @param type $add_roles
     * @param type $blockRoles
     */
    private function insertUpdateOrDeleteRolesBlock($block_id, $add_roles, $blockRoles) {
        $sqlLight = new \project\sqlLight();
        $arrDB = $this->get_role_all();
        $arrAdd = array();

        // Найдем те которые уже добавлены
        foreach ($add_roles as $key => $value) {
            $true = 0;
            foreach ($blockRoles as $k => $v) {
                if ($value == $v['role_id']) {
                    unset($blockRoles[$key]);
                    $true = 1;
                }
            }
            // добавим те которые следует добавить
            if ($true == 0) {
                $arrAdd[] = $value;
            }
        }

        // Почистим добавленные из массива
        if (count($add_roles) > 0) {
            foreach ($arrDB as $key => $value) {
                foreach ($add_roles as $k => $v) {
                    if ($value['id'] == $v) {
                        unset($arrDB[$key]);
                    }
                }
            }
        }

        // Добавим необходимые
        if (count($arrAdd) > 0) {
            foreach ($arrAdd as $value) {
                $q = "INSERT INTO `zay_pages_block_roles` (`page_block_id`, `role_id`) VALUES ('?','?')";
                $sqlLight->query($q, array($block_id, $value));
            }
        }

        if (count($arrDB) > 0) {
            foreach ($arrDB as $value) {
                $qDell = "delete from `zay_pages_block_roles` where page_block_id='?' and role_id='?' ";
                $sqlLight->query($qDell, array($block_id, $value['id']));
            }
        }
    }

    /**
     * Все имеющиеся роли
     * @return type
     */
    private function get_role_all() {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_roles` br";
        return $sqlLight->queryList($querySelect, array());
    }

    /**
     * Получить контент блока
     * @param type $id
     * @return type
     */
    public function contentsListArray($page_id) {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM zay_page_block_contents pbc 
                        where pbc.page_id='?' 
                        ORDER BY pbc.sort ASC ";

        return $sqlLight->queryList($querySelect, array($page_id));
    }

    public function pageBlockContentsListArray($id) {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM zay_page_block_contents pbc where pbc.id='?' ";
        return $sqlLight->queryList($querySelect, array($id), 0);
    }

    /**
     * Сохранить сортировку
     * @param type $contents_is
     * @param type $sort
     * @return type
     */
    public function contentSorted($content_id, $sort) {
        $sqlLight = new \project\sqlLight();
        $query = "UPDATE zay_page_block_contents pbc SET pbc.sort='?' WHERE pbc.id='?'";
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
        if ($id > 0) {
            $query = "UPDATE zay_page_block_contents pbc 
                        SET pbc.content_descr='?', pbc.extension='?' 
                        WHERE pbc.id='?' ";
            return $sqlLight->query($query, array($content_descr, $extension, $id));
        } else {
            $querySelect = "SELECT * FROM zay_page_block_contents pbc WHERE pbc.content_title='?'";
            $content = $sqlLight->queryList($querySelect, array($content_title));

            if (count($content) > 0) {
                $_SESSION['errors'][] = 'Материал с таким наименованием уже существует';
            }
            if (count($_SESSION['errors']) == 0) {
                $query = "INSERT INTO zay_page_block_contents (`content_title`, `page_id`, `block_id`, `content_descr`, `extension`, `sort`) "
                        . "VALUES ('?','?','?','?','?','0') ";
                return $sqlLight->query($query, array($content_title, $page_id, $block_id, $content_descr, $extension), 0);
            }
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

    public function showMessage() {
        // https://edgardzaycev.com/?activation=MmRiODAzMTNkY2U1NzliYzI5Mjk0NGFkODM4YTM2ODJiMGE5OWM2ZA==
        if (isset($_GET['activation']) && $_SESSION['message']['type'] == 'success') {
            global $lang;
            include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
            $config = new \project\config();
            ?>
            <!DOCTYPE html>
            <html lang="ru">
                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8"> 
                    <title><?= $_SESSION['site_title'] ?></title>
                    <meta name="description" content="<?= $_SESSION['page']['info']['description'] ?>" />
                    <link href="/favicon.ico<?= $_SESSION['rand'] ?>" rel="icon">
                    <!-- SLEEK CSS -->
                    <link id="sleek-css" rel="stylesheet" href="/assets/css/sleek.min.css<?= $_SESSION['rand'] ?>" />
                    <link rel="stylesheet" href="/themes/site1/css/plugins.css<?= $_SESSION['rand'] ?>">
                    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css<?= $_SESSION['rand'] ?>" 
                          integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
                          crossorigin="anonymous">

                    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css<?= $_SESSION['rand'] ?>">

                    <link href="/assets/plugins/bootstrap/css/bootstrap.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />
                    <link rel="stylesheet" href="/themes/site1/css/style.css<?= $_SESSION['rand'] ?>">
                    <link href="/assets/plugins/daterangepicker/daterangepicker.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />

                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src="/assets/plugins/jquery/jquery.js<?= $_SESSION['rand'] ?>"></script>
                    <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.css<?= $_SESSION['rand'] ?>">
                    <link rel="stylesheet" href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.theme.css<?= $_SESSION['rand'] ?>">
                    <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js<?= $_SESSION['rand'] ?>"></script>

                    <!-- timepicker -->
                    <script type="text/javascript" src="/assets/plugins/jquery/timepicker/jquery-ui-timepicker-addon.js<?= $_SESSION['rand'] ?>"></script>
                    <script type="text/javascript" src="/assets/plugins/jquery/timepicker/i18n/jquery-ui-timepicker-addon-i18n.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script type="text/javascript" src="/assets/plugins/jquery/timepicker/jquery-ui-sliderAccess.js<?= $_SESSION['rand'] ?>"></script>
                    <link rel="stylesheet" media="all" type="text/css" href="/assets/plugins/jquery/timepicker/jquery-ui-timepicker-addon.css<?= $_SESSION['rand'] ?>" />

                    <script type="text/javascript" src="/assets/plugins/mixitup/mixitup.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script type="text/javascript" src="/assets/js/init.js<?= $_SESSION['rand'] ?>"></script>
                    <script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
                </head>  
                <body>
                    <div class="container" style="margin-bottom: 50px;">
                        <div class="row mt-5 mb-5">
                            <div class="col-12">
                                <div class="card text-center" style="text-align: center;"> 
                                    <img class="w-50 mt-3 mb-3" src="/logo.svg" style="margin: 0 auto;" />
                                    <hr/>
                                    <h3 class="mt-5 mb-5" style="color: #000000;"><?= $_SESSION['message']['text'] ?></h3>
                                    <div class="mt-3 mb-5">
                                        <a href="/" class="btn btn-info goto_main_page">Перейти на главную страницу <strong></strong> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                    include $_SERVER['DOCUMENT_ROOT'] . '/themes/site1/footer_' . $_SESSION['lang'] . '.php'
                    ?>

                    <!--Bootstrap Core-->
                    <script src="/themes/site1/js/popper.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/bootstrap.min.js<?= $_SESSION['rand'] ?>"></script>

                    <!--to view items on reach-->
                    <script src="/themes/site1/js/jquery.appear.js<?= $_SESSION['rand'] ?>"></script>

                    <!--Equal-Heights-->
                    <script src="/themes/site1/js/jquery.matchHeight-min.js<?= $_SESSION['rand'] ?>"></script>

                    <!--Owl Slider-->
                    <script src="/themes/site1/js/owl.carousel.min.js<?= $_SESSION['rand'] ?>"></script>

                    <!--number counters-->
                    <script src="/themes/site1/js/jquery-countTo.js<?= $_SESSION['rand'] ?>"></script>

                    <!--Parallax Background-->
                    <script src="/themes/site1/js/parallaxie.js<?= $_SESSION['rand'] ?>"></script>

                    <!--Cubefolio Gallery-->
                    <script src="/themes/site1/js/jquery.cubeportfolio.min.js<?= $_SESSION['rand'] ?>"></script>

                    <!--FancyBox popup-->
                    <script src="/themes/site1/js/jquery.fancybox.min.js<?= $_SESSION['rand'] ?>"></script>       

                    <!-- Video Background-->
                    <script src="/themes/site1/js/jquery.background-video.js<?= $_SESSION['rand'] ?>"></script>

                    <!--TypeWriter-->
                    <script src="/themes/site1/js/typewriter.js<?= $_SESSION['rand'] ?>"></script> 

                    <!--Particles-->
                    <script src="/themes/site1/js/particles.min.js<?= $_SESSION['rand'] ?>"></script>            

                    <!--WOw animations-->
                    <script src="/themes/site1/js/wow.min.js<?= $_SESSION['rand'] ?>"></script>

                    <!--Revolution SLider-->
                    <script src="/themes/site1/js/revolution/jquery.themepunch.tools.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/jquery.themepunch.revolution.min.js<?= $_SESSION['rand'] ?>"></script>
                    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.actions.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.carousel.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.kenburn.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.layeranimation.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.migration.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.navigation.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.parallax.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.slideanims.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/themes/site1/js/revolution/extensions/revolution.extension.video.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/assets/plugins/daterangepicker/moment.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/assets/plugins/daterangepicker/daterangepicker.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/assets/plugins/select2/js/select2.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/assets/plugins/jquery-mask-input/jquery.mask.min.js<?= $_SESSION['rand'] ?>"></script>
                    <script src="/assets/js/ajax.js<?= $_SESSION['rand'] ?>"></script>   

                    <!--Google Map API-->
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk"></script>
                    <script src="/themes/site1/js/functions.js<?= $_SESSION['rand'] ?>"></script>	
                    <?
                    foreach ($_SESSION['body_javascript'] as $js) {
                        echo $js . "\n";
                    }
                    ?>
                    <script>
                        var i = 60;
                        $(document).ready(function () {
                            setTimeout(function () {
                                $(".link_ed_mailto").attr("href", "mailto:<?= $config->getConfigParam('link_ed_mailto') ?>");
                                $(".link_ed_mailto").html("<?= $config->getConfigParam('link_ed_mailto') ?>");
                            }, 2000);
                            setInterval(function () {
                                i--;
                                $(".goto_main_page").find('strong').html(i);
                                if (i <= 0) {
                                    document.location.href = '/';
                                }
                            }, 1000);
                        });
                    </script>
                </body>
            </html>
            <?
            exit();
        }
        $_SESSION['message']['text'] = '';
    }

    /*
     * Хлебные крошки 
     */

    /**
     * Добавление новой ссылки
     * @param type $url
     * @param type $title
     * @return boolean
     */
    public function bread_add($url, $title) {
        //echo "url: {$url}, {$title}<br/>\n";
        if (!isset($_SESSION['breads'])) {
            $_SESSION['breads'] = [];
            $_SESSION['bread_urls'] = [];
        }
        if ($url != '') {
            if ($url == 'index') {
                $url = '/';
            }
            if (count($_SESSION['bread_urls']) > 0) {
                $new_url = implode('/', $_SESSION['bread_urls']) . $url . '/';
            } else {
                $new_url = $url;
            }
            $_SESSION['bread_urls'][] = $url;
        } else {
            $new_url = '';
        }
        $_SESSION['breads'][] = array('url' => $new_url, 'title' => $title); // "<a href=\"{$url}\">{$title}</a>";
        return true;
    }

    /**
     * Получение строки хлебных крошек
     * @return type
     */
    public function bread_get() {
        $urls = array();
        if (isset($_SESSION['breads'])) {
            if (count($_SESSION['breads']) > 0) {
                foreach ($_SESSION['breads'] as $value) {
                    $urls[] = "<a href=\"{$value['url']}\">{$value['title']}</a>";
                }
            }
            return implode('&nbsp;&nbsp;→&nbsp;&nbsp;', $urls);
        }

        return '';
    }

    /**
     * Полное удаление
     */
    public function bread_clear() {
        unset($_SESSION['breads']);
        unset($_SESSION['bread_urls']);
        return true;
    }

    /**
     * Javascript на всех страницах
     * @return type
     */
    public function javascript() {
        $config = new \project\config();
        ob_start();
        ?>
        <script>
            var go_move = '<?= $_GET['move'] ?>';
            $(document).ready(function () {
                if (go_move.length > 0) {
                    if (!!$("#" + go_move)[0]) {
                        move("#" + go_move, 1000);
                    }
                    if (!!$("." + go_move)[0]) {
                        move("." + go_move, 1000);
                    }
                }

                setTimeout(function () {
                    $(".link_ed_mailto").attr("href", "mailto:<?= $config->getConfigParam('link_ed_mailto') ?>");
                    $(".link_ed_mailto").html("<?= $config->getConfigParam('link_ed_mailto') ?>");
                }, 2000);
            });
        </script>
        <?
        return ob_get_clean();
    }

}
