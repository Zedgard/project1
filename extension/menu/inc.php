<?php

namespace project;

defined('__CMS__') or die;

class menu extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получить все меню
     * @return type
     */
    public function get_menu_all() {
        $querySelect = "SELECT * FROM `zay_menu` m order by m.menu_title asc";
        return $this->getSelectArray($querySelect, array());
    }

    /**
     * Получить меню данные по конкретному меню
     * @return type
     */
    public function get_menu($menu_id) {
        $querySelect = "SELECT * FROM `zay_menu` m WHERE m.id='?'";
        return $this->getSelectArray($querySelect, array($menu_id))[0];
    }

    /**
     * Добавление изменение
     * @param type $menu_id
     * @param type $menu_code
     * @param type $menu_title
     * @param type $menu_descr
     * @return type
     */
    public function edit_menu($menu_id, $menu_code, $menu_title, $menu_descr, $menu_role) {
        if ($menu_id > 0) {
            $query = "UPDATE `zay_menu` SET `menu_code`='?',`menu_title`='?',`menu_descr`='?', `menu_role`='?' WHERE `id`='?' ";
            return $this->query($query, array($menu_code, $menu_title, $menu_descr, $menu_role, $menu_id));
        } else {
            $query = "INSERT INTO `zay_menu`(`menu_code`, `menu_title`, `menu_descr`, `menu_role`) VALUES ('?','?','?','?')";
            return $this->query($query, array($menu_code, $menu_title, $menu_descr, $menu_role));
        }
    }

    /**
     * Удаление меню
     * @param type $menu_id
     * @return type
     */
    public function delete_menu($menu_id) {
        $query = "DELETE FROM `zay_menu` WHERE `id`='?' ";
        return $this->query($query, array($menu_id));
    }

}
