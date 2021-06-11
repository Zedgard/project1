<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

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

    public function get_list_utms($tags_line) {
        $query = "SELECT * FROM (SELECT
                    u.id, 
                    u.title,
                    GROUP_CONCAT(CONCAT(ut.code , '=' , utv.val)) as utm_all_tags_line
                FROM
                    zay_utm u
                LEFT JOIN zay_utm_tag_values utv ON
                    utv.utm_id = u.id
                LEFT JOIN zay_utm_tags ut ON
                    ut.id = utv.tag_id
                GROUP BY u.id, u.title
                ORDER BY ut.code ASC) dd
                WHERE dd.utm_all_tags_line='?'";
        return $this->getSelectArray($query, array($tags_line), 0);
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

    /**
     * Фиксируем переход по UTM ссылки
     * @param type $url_params
     */
    public function utm_insert_href($url_params) {
        $ex_url = explode('&', $url_params);
        unset($ex_url[0]);
        $utm = false;
        foreach ($ex_url as $value) {
            $ex = explode('=', $value);
            if ($ex[0] == 'utm_source') {
                $utm = true;
                break;
            }
        }

        if ($utm) {
            $tags = $this->utm_tags_list();
            $qyery_select = "SELECT u.id, u.title, ut.code, utv.tag_id, utv.val
                                FROM zay_utm u
                                left join zay_utm_tag_values utv on utv.utm_id=u.id
                                left join zay_utm_tags ut on ut.id=utv.tag_id
                                where u.id is not null";
            $data = $this->getSelectArray($qyery_select, array());

            $url = $_SERVER['REQUEST_URI'];
            $params = array();
            foreach ($tags as $value) {
                if (isset($_GET[$value['code']])) {
                    $params[$value['code']] = "{$value['code']}={$_GET[$value['code']]}";
                    $url = str_replace('?' . $value['code'] . '=' . $_GET[$value['code']], '', $url);
                    $url = str_replace('&' . $value['code'] . '=' . $_GET[$value['code']], '', $url);
                }
            }
            $params_line = implode(',', $params);
            $utms = $this->get_list_utms($params_line);
            //echo "------<br/>\n";
            $id = 0;
            if ($utms > 0) {
                $id = $utms[0]['id'];
            }

            if ($id > 0) {
                $_SESSION['utm_tag_href_id'] = $this->queryNextId('zay_utm_href');
                $query_utm_href = "INSERT INTO `zay_utm_href`(`utm_id`,`url`) VALUES ('?','?')";
                $this->query($query_utm_href, array($id, $url));

                foreach ($tags as $value) {
                    if (isset($_GET[$value['code']])) {
                        $this->utm_utm_tag_href_insert($id, $value['id']);
                    }
                }
                location_href($url);
            }
        }
    }

    /**
     * Фиксируем теги по которым перешли
     * @param type $utm_id
     * @param type $tag_id
     * @return type
     */
    private function utm_utm_tag_href_insert($utm_id, $tag_id) {
        $query = "INSERT INTO `zay_utm_tag_href`(`utm_id`, `tag_id`) VALUES ('?','?')";
        return $this->query($query, array($utm_id, $tag_id));
    }

    /*
     * Отчеты
     */

    /**
     * Данные по меткам
     * @param type $date_start
     * @param type $date_end
     * @return type
     */
    public function utm_href_list($utm_id, $date_start, $date_end, $tag_id) {
        // 2021-05-25
        $w = array();
        $array = array();

        if ($tag_id == 0) {

            if (strlen($date_start) > 0 && strlen($date_end) > 0) {
                $w[] = "uh.lastdate BETWEEN '? 00:00:00.000000' AND '? 23:59:59.000000'";
                $array[] = $date_start;
                $array[] = $date_end;
            }
            if ($utm_id > 0) {
                $w[] = "u.id='?'";
                $array[] = $utm_id;
            }
            $where = '';
            if (count($w) > 0) {
                $where = "WHERE " . implode(' and ', $w);
            }
            $query_select = "SELECT u.title, uh.id, uh.url, uh.lastdate, utbp.pay_id, (select p.pay_sum from zay_pay p where p.id=utbp.pay_id) as pay_summ
                FROM zay_utm_href uh 
                left join zay_utm u on u.id=uh.utm_id
                left join zay_utm_buy_products utbp on utbp.utm_id=uh.id
                {$where} 
                ORDER BY uh.lastdate DESC";
            return $this->getSelectArray($query_select, $array, 0);
        } else {
            if (strlen($date_start) > 0 && strlen($date_end) > 0) {
                $w[] = "uth.lastdate BETWEEN '? 00:00:00.000000' AND '? 23:59:59.000000'";
                $array[] = $date_start;
                $array[] = $date_end;
            }
            if ($utm_id > 0) {
                $w[] = "u.id='?'";
                $array[] = $utm_id;
            }
            if ($tag_id > 0) {
                $w[] = "uth.tag_id='?'";
                $array[] = $tag_id;
            }
            $where = '';
            if (count($w) > 0) {
                $where = "WHERE " . implode(' and ', $w);
            }
            $query_select = "SELECT u.title, uh.id, uh.url, uh.lastdate, utbp.pay_id, (select p.pay_sum from zay_pay p where p.id=utbp.pay_id) as pay_summ
                FROM zay_utm_tag_href uth 
                left join zay_utm u on u.id=uth.utm_id
                left join zay_utm_href uh on u.id=uh.utm_id
                left join zay_utm_tags ut on ut.id=uth.tag_id
                left join zay_utm_buy_products utbp on utbp.utm_id=uh.id
                {$where} 
                ORDER BY uth.lastdate DESC";
            return $this->getSelectArray($query_select, $array, 0);
        }
    }

    /**
     * Фиксируем покупки клиента по этому ID 
     * @param type $product_id
     * @return boolean
     */
    public function utm_product_bay($pay_id) {
        if (isset($_SESSION['utm_tag_href_id']) && $_SESSION['utm_tag_href_id'] > 0 && $pay_id > 0) {
            $query = "INSERT INTO `zay_utm_buy_products`(`utm_id`, `pay_id`) "
                    . "VALUES ('?','?')";
            return $this->query($query, array($_SESSION['utm_tag_href_id'], $pay_id));
        }
        return false;
    }

}
