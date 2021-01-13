<?php

namespace project;

defined('__CMS__') or die;

class topic extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Список тем с реализацией поиска
     * @param string $searchStr
     * @return array
     */
    public function getTopicArray($searchStr) {
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT `id`, `title`, (SELECT count(*) FROM `zay_product_topic` pt where pt.topic_id=t.id) as product_col "
                    . "FROM `zay_topics` t WHERE `title` like '%?%' ";
            return $this->getSelectArray($querySelect, array($searchStr, $searchStr));
        } else {
            $querySelect = "SELECT `id`, `title`, (SELECT count(*) FROM `zay_product_topic` pt where pt.topic_id=t.id) as product_col "
                    . "FROM `zay_topics` t";
            return $this->getSelectArray($querySelect, array());
        }
    }
    
    public function getTopicElem($id) {
        if ($id > 0) {
            $querySelect = "SELECT * FROM `zay_topics` WHERE id='?' ";
            return $this->getSelectArray($querySelect, array($id))[0];
        }
        return array();
    }

}
