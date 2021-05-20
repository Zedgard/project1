<?php

namespace project;

defined('__CMS__') or die;

class utm extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список utm
     * @return type
     */
    public function utm_list() {
        $q = "SELECT * FROM zay_utm ORDER BY title ASC";
        return $this->getSelectArray($q, array(), 0);
    }

    /**
     * Добавить utm
     * @return type
     */
    public function utm_insert() {
        $next_id = $this->queryNextId('zay_utm');
        $query = "INSERT INTO `zay_utm`(`title`) 
            VALUES ('?')";
        return $this->query($query, array(
                    'Метка ' . $next_id
        ));
    }

    /**
     * Удалить utm
     * @param type $id
     * @return type
     */
    public function utm_delete($id) {
        $query = "DELETE FROM `zay_utm` WHERE id='?'";
        return $this->query($query, array($id));
    }

    /**
     * Список всех тегов
     * @return type
     */
    public function utm_tags_list() {
        $q = "SELECT * FROM zay_utm_tags ORDER BY code ASC";
        return $this->getSelectArray($q, array(), 0);
    }

    /**
     * Добавить новый тег
     * @return type
     */
    public function utm_tag_insert() {
        $next_id = $this->queryNextId('zay_utm_tags');
        $query = "INSERT INTO `zay_utm_tags`(`title`, `code`, `descr`) 
            VALUES ('?','?','?')";
        return $this->query($query, array(
                    'Новый тег ' . $next_id,
                    'new_tag_' . $next_id,
                    ''), 0);
    }

    /**
     * Удалить тег
     * @param type $id
     * @return type
     */
    public function utm_tag_delete($id) {
        $query = "DELETE FROM `zay_utm_tags` WHERE id='?'";
        return $this->query($query, array($id));
    }

    /*
     * Управление значениями меток
     */

    /**
     * Список значений тегов
     * @param type $utm_id
     * @return type
     */
    public function utm_tag_values_list($utm_id) {
        $tags = $this->utm_tags_list();
        foreach ($tags as $value) {
            $this->utm_tag_values_insert($utm_id, $value['id']);
        }
        $query_select = "SELECT utv.*, ut.title, ut.code, ut.descr FROM zay_utm_tag_values utv 
            left join zay_utm_tags ut on ut.id=utv.tag_id
            WHERE utv.utm_id='?'";
        return $this->getSelectArray($query_select, array($utm_id));
    }

    /**
     * Добавление нового тега если такой отсутствует
     * @param type $utm_id
     * @param type $tag_id
     * @return boolean
     */
    public function utm_tag_values_insert($utm_id, $tag_id) {
        $return = false;
        if ($utm_id > 0 && $tag_id > 0) {
            $select_count = "SELECT * FROM zay_utm_tag_values utv WHERE utv.utm_id='?' and utv.tag_id='?'";
            $data_elems = $this->getSelectArray($select_count, array($utm_id, $tag_id));
            if (count($data_elems) == 0) {
                $query = "INSERT INTO `zay_utm_tag_values` (`utm_id`, `tag_id`, `val`) 
                   VALUES ('?','?','?')";
                $return = $this->query($query, array($utm_id, $tag_id, ''));
            }
        }

        return $return;
    }

}
