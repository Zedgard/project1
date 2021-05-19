<?php

namespace project;

defined('__CMS__') or die;

class utm extends \project\extension {

    public function __construct() {
        parent::__construct();
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

}
