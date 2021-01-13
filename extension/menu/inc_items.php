<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';

class menu_item extends \project\extension {

    private $menu_item;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список всех пунктов выбранного меню
     * @return array
     */
    public function menu_items_list($menu_id) {
        $data = array();
        if ($menu_id > 0) {
            $querySelect = "SELECT * FROM `zay_menu_items` it WHERE it.`menu_id`='?' and it.`parent_id`='0' order by it.`position` ASC";
            $data = $this->getSelectArray($querySelect, array($menu_id));
            if (count($data) > 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['parent_items'] = $this->menu_items_parent_list($menu_id, $data[$i]['id']);
                }
            }
        }
        return $data;
    }

    private function menu_items_parent_list($menu_id, $parent_id) {
        $data = array();
        if ($menu_id > 0) {
            $querySelect = "SELECT * FROM `zay_menu_items` it WHERE it.`menu_id`='?' and it.`parent_id`='?' order by it.`position` ASC";
            $data = $this->getSelectArray($querySelect, array($menu_id, $parent_id));
            if (count($data) > 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['parent_items'] = $this->menu_items_parent_list($menu_id, $data[$i]['id']);
                }
            }
        }
        return $data;
    }

    /**
     * Список всех пунктов меню
     * @return type
     */
    public function get_menu_items_list() {
        $data = array();
        $querySelect = "SELECT * FROM `zay_menu_items` it ORDER BY it.`title` ASC";
        $data = $this->getSelectArray($querySelect, array());
        return $data;
    }

    /**
     * Получим данные по меню
     * @param type $menu_item_id
     * @return type
     */
    public function get_menu_item($menu_item_id) {
        $data = array();
        if ($menu_item_id > 0) {
            $querySelect = "SELECT * FROM `zay_menu_items` WHERE `id`='?'";
            $data = $this->getSelectArray($querySelect, array($menu_item_id))[0];
            $this->menu_item = $data;
        }
        return $data;
    }

    /**
     * Редактирование меню
     * @param type $menu_item_id
     * @param type $menu_id
     * @param type $title
     * @param type $link
     * @param type $position
     * @param type $role
     * @return boolean
     */
    public function edit_menu_item($menu_item_id, $menu_id, $parent_id, $title, $link, $css, $position, $role) {
        if ($menu_item_id > 0) {
            $query = "UPDATE `zay_menu_items` SET `menu_id`='?', `parent_id`='?',`title`='?',`link`='?', `css`='?',`role`='?' "
                    . "WHERE `id`='?'";
            return $this->query($query, array($menu_id, $parent_id, $title, $link, $css, $role, $menu_item_id));
        } else {
            $query = "INSERT INTO `zay_menu_items`(`menu_id`, `parent_id`, `title`, `link`, `css`, `position`, `role`) "
                    . "VALUES ('?','?','?','?','?','?','?')";
            return $this->query($query, array($menu_id, $parent_id, $title, $link, $css, $position, $role));
        }
        return false;
    }

    /**
     * Колличество елементов
     * @param type $menu_id
     * @return type
     */
    public function items_count($menu_id) {
        $query = "SELECT count(*) col FROM `zay_menu_items` WHERE `menu_id`='?'";
        return $this->getSelectArray($query, array($menu_id))[0]['col'];
    }

    /**
     * Удаление пункта
     * @param type $menu_item_id
     * @return type
     */
    public function delete_menu_item($menu_item_id) {
        if ($menu_item_id > 0) {
            $query = "DELETE FROM `zay_menu_items` WHERE `id`='?'";
            return $this->query($query, array($menu_item_id));
        } else {
            return false;
        }
    }

    /**
     * Обновить позицию
     * @param type $menu_id
     * @param type $item_id
     * @param type $position
     * @return type
     */
    public function set_position($menu_id, $item_id, $position) {
        $q = "select * from `zay_menu_items` WHERE `menu_id`='?' and `id`='?'";
        $elem = $this->getSelectArray($q, array($menu_id, $item_id), 0)[0];
        $elem_position = $elem['position'];
        $query = "UPDATE `zay_menu_items` SET `position`='?' WHERE `menu_id`='?' and `position`='?'";
        $this->query($query, array($elem_position, $menu_id, $position), 0);
        $query = "UPDATE `zay_menu_items` SET `position`='?' WHERE `menu_id`='?' and `id`='?'";
        return $this->query($query, array($position, $menu_id, $item_id), 0);
    }

    /*
     * ------------------------------------------------------
     * INDEX
     * ------------------------------------------------------
     */

    /**
     * Список всех пунктов выбранного меню
     * @return array
     */
    public function index_menu_items_list($menu_id) {
        $buffer = array();
        if ($menu_id > 0) {
            $querySelect = "SELECT * FROM `zay_menu_items` it WHERE it.`menu_id`='?' and it.`parent_id`='0' order by it.`position` ASC";
            $data = $this->getSelectArray($querySelect, array($menu_id));
            if (count($data) > 0) {
                //$buffer[] = '<div class="header-column justify-content-end">';
                //$buffer[] = '<div class="header-row">';
                //$buffer[] = '<div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">';
                //$buffer[] = '<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">';
                $buffer[] = '<nav class="collapse"><ul class="nav nav-pills" id="mainNav">';
                for ($i = 0; $i < count($data); $i++) {
                    $buffer[] = '<li class="dropdown">';
                    $buffer[] = '<a class="dropdown-item" href="' . $data[$i]['link'] . '" style="' . $data[$i]['css'] . '">' . $data[$i]['title'] . '</a>';
                    $buffer[] = $this->index_menu_items_parent_list($menu_id, $data[$i]['id']);
                    $buffer[] = '</li>';
                }
                $buffer[] = '</ul></nav>';
                //$buffer[] = '</div>';
                //$buffer[] = '</div>';
                //$buffer[] = '</div>';
                //$buffer[] = '</div>';
            }
        }
        return implode("\n", $buffer);
    }

    private function index_menu_items_parent_list($menu_id, $parent_id) {
        $buffer = array();
        if ($menu_id > 0) {
            $querySelect = "SELECT * FROM `zay_menu_items` it WHERE it.`menu_id`='?' and it.`parent_id`='?' order by it.`position` ASC";
            $data = $this->getSelectArray($querySelect, array($menu_id, $parent_id));
            if (count($data) > 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $buffer[] = '<ul class="dropdown-menu">';
                    $buffer[] = '<li class="dropdown-submenu">';
                    $buffer[] = '<a class="dropdown-item" href="' . $data[$i]['link'] . '" style="' . $data[$i]['css'] . '">' . $data[$i]['title'] . '</a>';
                    $buffer[] = $this->index_menu_items_parent_list($menu_id, $data[$i]['id']);
                    $buffer[] = '</li>';
                    $buffer[] = '</ul>';
                }
            }
        }
        return implode("\n", $buffer);
    }

    /*
     * ------------------------------------------------------
     * INDEX END
     * ------------------------------------------------------
     */
}
