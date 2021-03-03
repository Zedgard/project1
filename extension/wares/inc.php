<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';

class wares extends \project\extension {

    private $wares_categorys = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     * Сохраним данные для обработки по категориям
     * @param array $wares_categorys
     */
    function setWaresCategory($wares_categorys = array()) {
        if (is_array($wares_categorys)) {
            $this->wares_categorys = $wares_categorys;
        }
    }

    /**
     * Список товаров с реализацией поиска
     * @param string $searchStr
     * @return array
     */
    public function getWaresArray($searchStr, $visible) {

        $search = array();
        $search_row = array();
        // Строка поиска
        if (strlen($searchStr) > 0) {
            $search_row[] = "(`title` like '%?%' OR `articul` like '%?%')";
            $search[] = $searchStr;
            $search[] = $searchStr;
        }

        // выбор select
        if ($visible == '0' || $visible == '1') {
            $search_row[] = "`active`='?'";
            $search[] = $visible;
            //echo "v: {$visible}\n";
        }
        // Отобразим удаленные
        if ($visible == '9') {
            $search_row[] = "`is_delete`='1'";
        } else {
            $search_row[] = "`is_delete`='0'";
        }

        // Готовим запрос
        if (count($search_row) > 0) {
            $where = 'WHERE ' . implode(' and ', $search_row);
        } else {
            $where = '';
        }
        //print_r($search);
        //echo "{$where} \n";
        $querySelect = "SELECT * FROM `zay_wares` {$where} order by id desc ";
        //echo "w: {$querySelect} \n";
        return $this->getSelectArray($querySelect, $search, 0);

        //    $querySelect = "SELECT * FROM `zay_wares` where `is_delete`='0'";
        //   return $this->getSelectArray($querySelect, array());
    }

    /**
     * Данные по товару
     * @param type $id
     * @return array
     */
    public function getWaresElem($id) {
        if ($id > 0) {
            $querySelect = "SELECT * FROM `zay_wares` WHERE id='?' ";
            $obj = $this->getSelectArray($querySelect, array($id))[0];
            $obj['wares_category'] = $this->getWaresCategory($obj['id']);
            $category = new category();

            if (count($obj['wares_category']) > 0) {
                $category = new category();
                foreach ($obj['wares_category'] as $value) {
                    $obj['wares_categorys_list'][] = $category->getCategoryElem($value)[0]['title'];
                }
            }

            return $obj;
        }
        return array();
    }

    /**
     * Создание изменение товара
     * 
     * @param type $id
     * @param type $title
     * @param type $descr
     * @param type $col
     * @param type $ex_code
     * @param type $articul
     * @return boolean
     */
    public function insertOrUpdateWares($id, $title, $descr, $wares_url_file, $col, $ex_code, $articul, $wares_images, $active) {
        if (strlen($col) == 0) {
            $col = 0;
        }
        if ($id > 0) {
            $query = "UPDATE `zay_wares` "
                    . "SET `title`='?', `descr`='?', `url_file`='?', `col`='?', `ex_code`='?', `articul`='?', `images`='?', `active`='?', "
                    . "is_delete='0', "
                    . "`lastdate`=NOW() "
                    . "WHERE `id`='?' ";
            if ($this->query($query, array($title, $descr, $wares_url_file, $col, $ex_code, $articul, $wares_images, $active, $id), 0)) {
                $this->insertWaresCategory($id, $this->wares_categorys);
                return true;
            }
        } else {
            $query = "INSERT INTO `zay_wares` "
                    . "(`title`, `descr`, `url_file`, `col`, `ex_code`, `articul`, `images`,`active`, `is_delete`, `creat_date`, `lastdate`) "
                    . "VALUES ('?','?','?','?','?','?','?','?','0', NOW(), NOW()) " // (DATE_ADD(NOW(), INTERVAL {$_SESSION['HOUR']} HOUR))
                    . "";
            if ($this->query($query, array($title, $descr, $wares_url_file, $col, $ex_code, $articul, $wares_images, $active), 0)) {
                $this->insertWaresCategory($id, $this->wares_categorys);
                return true;
            }
        }
        /*
         * INSERT INTO `zay_wares` (
         * `title`, 
         * `descr`, 
         * `url_file`, 
         * `col`, 
         * `ex_code`, 
         * `articul`, 
         * `images`,
         * `active`, 
         * `is_delete`, 
         * `creat_date`, 
         * `lastdate`
         * ) VALUES (
         * 'www',
         * '<p>&nbsp;1111</p>',
         * '',
         * '1',
         * '53335',
         * 'A-53335',
         * '',
         * '1', 
         * (DATE_ADD(NOW(), INTERVAL 7 HOUR)), 
         * (DATE_ADD(NOW(), INTERVAL 7 HOUR)) 
         * )
         * 
         */
        return false;
    }

    /**
     * Удаление товара
     * 
     * @param type $id
     * @param type $dell
     * @return boolean
     */
    public function deleteWares($id, $is_delete = 1) {
        $querySelect = "select * from zay_wares where id='?'";
        $obj = $this->getSelectArray($querySelect, array($id))[0];
        // Окончательное удаление
        if ($obj['is_delete'] == '1') {
            $query = "delete from `zay_wares` WHERE `id`='?' ";
            if ($this->query($query, array($id))) {
                return true;
            }
        } else {
            $query = "UPDATE `zay_wares` set `is_delete`='?' WHERE `id`='?' ";
            if ($this->query($query, array($is_delete, $id))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Смена активности
     * @param type $id
     * @param type $val
     * @return type
     */
    public function setWaresActive($id, $val) {
        if ($id > 0) {
            $querySelect = "UPDATE `zay_wares` set `active`='?' WHERE `id`='?' ";
            return $this->query($querySelect, array($val, $id));
        }
        return array();
    }

    /**
     * Список всех материалов товара
     * @param type $wares_id
     * @return type
     */
    public function listMaterials($wares_id) {
        if ($wares_id > 0) {
            $querySelect = "SELECT v.* FROM `zay_wares_video` v "
                    . "WHERE v.`wares_id`='?' order by v.`video_position_n` asc ";
            return $this->getSelectArray($querySelect, array($wares_id), 0);
        }
        return array();
    }

    /**
     * Список всех материалов товара для пользователя
     * @param type $wares_id
     * @return type
     */
    public function listClientMaterials($wares_id = 0) {
        if ($wares_id > 0) {
            $product = $this->getClientProducts($wares_id);
            if ($product['id'] > 0) {
                $querySelect = "SELECT * FROM `zay_wares_video` v WHERE v.`wares_id`='?' order by v.`video_position_n` asc ";
                return $this->getSelectArray($querySelect, array($wares_id));
            }
        }
        return 1;
    }

    /**
     * Список всех материалов товара для пользователя
     * @param type $wares_id
     * @return type
     */
    public function listClientWebinarsMaterials($wares_id = 0) {
        if ($wares_id > 0) {
            $product = $this->getClientWebinarsProducts($wares_id);
            if ($product['id'] > 0) {
                $querySelect = "SELECT * FROM `zay_wares_video` v WHERE v.`wares_id`='?' order by v.`video_position_n` asc ";
                return $this->getSelectArray($querySelect, array($wares_id));
            }
        }
        return 1;
    }

    /**
     * Добавить новый материал
     * @param type $wares_id
     * @return type
     */
    public function addWaresVideo($wares_id) {
        if ($wares_id > 0) {
            $count = $this->getWaresVideoCount($wares_id);
            $count++;
            $queryInsert = "INSERT INTO `zay_wares_video`(`wares_id`, `video_title`, `video_descr`, `video_mp4`, `video_ogv`, `video_webm`, `video_youtube`, `video_position_n`) "
                    . "VALUES ('?','?','?','?','?','?','?','?')";
            return $this->query($queryInsert, array($wares_id, 'Новое видео №' . $count, '', '', '', '', '', $count));
        }
        return array();
    }

    /**
     * Удаление новый материал
     * @param type $wares_id
     * @return type
     */
    public function deleteWaresVideo($wares_id, $video_id) {
        if ($wares_id > 0) {
            $queryDelete = "DELETE FROM `zay_wares_video` WHERE wares_id='?' AND id='?' ";
            return $this->query($queryDelete, array($wares_id, $video_id), 1);
        }
        return array();
    }

    /**
     * Получить список всех серий для видео
     * @param type $wares_id
     * @return type
     */
    public function getWaresVideoSeries($wares_id) {
        $query_select = "SELECT * FROM `zay_wares_video_series` vs where vs.wares_id='?' order by vs.position asc ";
        return $this->getSelectArray($query_select, array($wares_id));
    }

    /**
     * Добавить новую серию
     * @param type $wares_id
     * @param type $title
     * @param type $position
     * @return type
     */
    public function addWaresVideoSeries($wares_id, $title, $position) {
        $query_insert = "INSERT INTO `zay_wares_video_series`(`wares_id`, `title`, `position`) "
                . "VALUES ('?','?','?')";
        return $this->query($query_insert, array($wares_id, $title, $position));
    }

    /**
     * Удалить серию
     * @param type $wares_id
     * @param type $series_id
     * @return type
     */
    public function deleteWaresVideoSeries($wares_id, $series_id) {
        $query_delete = "DELETE FROM `zay_wares_video_series` WHERE `wares_id`='?' and `id`='?'";
        return $this->query($query_delete, array($wares_id, $series_id));
    }

    /**
     * Обновить позицию серии
     * @param type $menu_id
     * @param type $item_id
     * @param type $position
     * @return type
     */
    public function setPositionVideoSeries($series_id, $position, $metod) {
        if ($position <= 0) {
            return true;
        }

        if ($metod == "up") {
            $q1 = "select * from `zay_wares_video_series` WHERE `id`='?'";
            $elem1 = $this->getSelectArray($q1, array(($series_id)), 0)[0];
            $q2 = "select * from `zay_wares_video_series` WHERE `position`='?'";
            $elem2 = $this->getSelectArray($q2, array(($elem1['position'] - 1)), 0)[0];
        }

        if ($metod == "down") {
            $q1 = "select * from `zay_wares_video_series` WHERE `id`='?'";
            $elem1 = $this->getSelectArray($q1, array(($series_id)), 0)[0];
            $q2 = "select * from `zay_wares_video_series` WHERE `position`='?'";
            $elem2 = $this->getSelectArray($q2, array(($elem1['position'] + 1)), 0)[0];
        }

        $query = "UPDATE `zay_wares_video_series` SET `position`='?' WHERE `id`='?'";
        $this->query($query, array($elem2['position'], $elem1['id']), 0);
        $query = "UPDATE `zay_wares_video_series` SET `position`='?' WHERE `id`='?'";
        $this->query($query, array($elem1['position'], $elem2['id']), 0);
        return true;
    }

    /**
     * Получить колличество материалов по товару
     * @param type $wares_id
     * @return type
     */
    public function getWaresVideoCount($wares_id) {
        $querySelect = "SELECT * FROM `zay_wares_video` v WHERE v.`wares_id`='?' ";
        $data = $this->getSelectArray($querySelect, array($wares_id));
        return count($data);
    }

    /**
     * Купленные продукты клиента
     */
    public function getClientProducts($wares_id = 0, $category_id = 0) {
        if ($_SESSION['user']['info']['id'] > 0) {
            $category_sql = "";
            $vals[] = $_SESSION['user']['info']['id'];
            if ($category_id > 0) {
                $category_sql = " and wcat.category_id='?' ";
                $vals[] = $category_id;
            }
            if ($wares_id == 0) {
                $querySelect = "SELECT DISTINCT w.*, "
                        . "pr.id as product_id, "
                        . "pr.title as product_title "
                        . "FROM `zay_pay` p "
                        . "left join `zay_pay_products` pp on pp.`pay_id`=p.`id` "
                        . "left join `zay_product` pr on pr.`id`=pp.`product_id` "
                        . "left join `zay_product_wares` pw on pw.`product_id`=pr.`id` "
                        . "left join `zay_wares` w on w.`id`=pw.`wares_id` "
                        . "left join zay_wares_category wcat on wcat.wares_id=w.id "
                        . "left join `zay_product_category` pcat on pcat.`product_id`=pr.`id` "
                        . "where p.`user_id`='?' and p.`pay_status`='succeeded' and w.`id` > 0 "
                        . "{$category_sql} "
                        . "and (pcat.category_id<>2 or pcat.category_id is null) "
                        . "order by w.`title` asc ";
                //echo "{$querySelect}\n\n";
                $objs = $this->getSelectArray($querySelect, $vals, 0);
                return $objs;
            } else {
                $querySelect = "SELECT DISTINCT w.*, pr.id as product_id, "
                        . "pr.title as product_title "
                        . "FROM `zay_pay` p "
                        . "left join `zay_pay_products` pp on pp.`pay_id`=p.`id` "
                        . "left join `zay_product` pr on pr.`id`=pp.`product_id` "
                        . "left join `zay_product_wares` pw on pw.`product_id`=pr.`id` "
                        . "left join `zay_wares` w on w.`id`=pw.`wares_id` "
                        . "left join zay_wares_category wcat on wcat.wares_id=w.id "
                        . "left join `zay_product_category` pcat on pcat.`product_id`=pr.`id` "
                        . "where p.`user_id`='?' and p.`pay_status`='succeeded' and w.`id`='?' "
                        . "and (pcat.category_id<>2 or pcat.category_id is null) " // Отбросим вебинары"
                        . "order by w.`title` asc ";
                return $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id'], $wares_id))[0];
            }
        }
        return array();
    }

    /**
     * Купленные вебинары клиента
     */
    public function getClientWebinarsProducts($wares_id = 0) {
        if ($_SESSION['user']['info']['id'] > 0) {

            if ($wares_id == 0) {
                $querySelect = "SELECT DISTINCT w.*, wcat.category_id FROM `zay_pay` p "
                        . "left join `zay_pay_products` pp on pp.`pay_id`=p.`id` "
                        . "left join `zay_product` pr on pr.`id`=pp.`product_id` "
                        . "left join `zay_product_wares` pw on pw.`product_id`=pr.`id` "
                        . "left join `zay_wares` w on w.`id`=pw.`wares_id` "
                        . "left join zay_wares_category wcat on wcat.wares_id=w.id "
                        . "left join `zay_product_category` pcat on pcat.`product_id`=pr.`id` "
                        . "where p.`user_id`='?' and p.`pay_status`='succeeded' and w.`id` > 0 "
                        . "and pcat.`category_id`=2 " // вебинары
                        . "order by pp.`id` DESC ";
                $objs = $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id']), 0);

                return $objs;
            } else {
                $querySelect = "SELECT DISTINCT w.*, wcat.category_id FROM `zay_pay` p "
                        . "left join `zay_pay_products` pp on pp.`pay_id`=p.`id` "
                        . "left join `zay_product` pr on pr.`id`=pp.`product_id` "
                        . "left join `zay_product_wares` pw on pw.`product_id`=pr.`id` "
                        . "left join `zay_wares` w on w.`id`=pw.`wares_id` "
                        . "left join zay_wares_category wcat on wcat.wares_id=w.id "
                        . "left join `zay_product_category` pcat on pcat.`product_id`=pr.`id` "
                        . "where p.`user_id`='?' and p.`pay_status`='succeeded' and w.`id`='?' "
                        . "and pcat.`category_id`=2 " //  вебинары
                        . "order by pp.`id` DESC ";
                //echo "{$querySelect}\n";
                return $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id'], $wares_id, 0))[0];
            }
        }
        return array();
    }

    /**
     * Получить колличество купоеллных продуктов данной категории
     * @return type
     */
    public function getClientWaresCol() {
        if ($_SESSION['user']['info']['id'] > 0) {
            $querySelect = "SELECT
                                dd.category_id,
                                COUNT(1) AS col
                            FROM
                                (
                                SELECT DISTINCT
                                    wcat.category_id,
                                    w.id
                                FROM
                                    `zay_pay` p
                                LEFT JOIN `zay_pay_products` pp ON
                                    pp.`pay_id` = p.`id`
                                LEFT JOIN `zay_product` pr ON
                                    pr.`id` = pp.`product_id`
                                LEFT JOIN `zay_product_wares` pw ON
                                    pw.`product_id` = pr.`id`
                                LEFT JOIN zay_wares w ON
                                    w.id = pw.wares_id
                                LEFT JOIN zay_wares_category wcat ON
                                    wcat.wares_id = w.id
                                WHERE
                                    p.`user_id` = '?' AND p.`pay_status` = 'succeeded' AND w.`id` > 0 AND(
                                        wcat.category_id <> 2 OR wcat.category_id IS NULL
                                    )
                                ORDER BY
                                    `w`.`id` ASC
                            ) dd
                            GROUP BY
                                dd.category_id";
            $objs = $this->getSelectArray($querySelect, array($_SESSION['user']['info']['id']), 0);
            return $objs;
        }
        return array();
    }

    /**
     * Зафиксировать 
     * @param type $wares_video_id
     * @return boolean
     */
    public function insertWaresVideoSee($wares_video_id) {
        $t = 0;
        if (!isset($_SESSION['wares_video_see'])) {
            $_SESSION['wares_video_see'][] = $wares_video_id;
            $t = 1;
        } else {
            if (!in_array($wares_video_id, $_SESSION['wares_video_see'])) {
                $t = 1;
            }
        }
        if ($t == 1) {
            $_SESSION['wares_video_see'][] = $wares_video_id;
            $count_see = 0;
            $querySelect = "select * from `zay_wares_video_see` wvs where wvs.`wares_video_id`='?' and wvs.`user_id`='?' ";
            $wares_video_see = $this->getSelectArray($querySelect, array($wares_video_id, $_SESSION['user']['info']['id']), 1);
            if (count($wares_video_see) > 0) {
                $count_see = $wares_video_see['count_see'];
            }
            $count_see++;
            $query = "INSERT INTO `zay_wares_video_see` (`wares_video_id`, `user_id`, `count_see`) "
                    . "VALUES ('?','?','?')";
            return $this->query($query, array($wares_video_id, $_SESSION['user']['info']['id'], $count_see));
        }
        return true;
    }

    /**
     * Получить данные по колличеству просмотров видео
     * @param type $wares_video_id
     * @param int $user_id
     * @return int
     */
    public function getWaresVideoSee($wares_video_id = 0, $user_id = 0) {
        if ($user_id > 0) {
            // колличество просмотров по видео
            if ($wares_video_id > 0 && $user_id = 0) {
                $querySelect = "select * from `zay_wares_video_see` wvs where wvs.`wares_video_id`='?' ";
                $wares_video_see = $this->getSelectArray($querySelect, array($wares_video_id), 1);
            }
            // колличество просмотров по пользователю
            if ($wares_video_id = 0 && $user_id > 0) {
                $querySelect = "select * from `zay_wares_video_see` wvs where wvs.`user_id`='?' ";
                $wares_video_see = $this->getSelectArray($querySelect, array($user_id), 1);
            }
            // колличество просмотров конкретного видео пользователем
            if ($wares_video_id > 0 && $user_id > 0) {
                $querySelect = "select * from `zay_wares_video_see` wvs where wvs.`wares_video_id`='?' and wvs.`user_id`='?' ";
                $wares_video_see = $this->getSelectArray($querySelect, array($wares_video_id, $user_id), 1);
            }
        }
        return 0;
    }

    /**
     * Список ID связанных категорий 
     * @param type $product_id
     * @return type
     */
    function getWaresCategory($wares_id) {
        $querySelect = "SELECT c.wares_id, GROUP_CONCAT(c.category_id) as category_ids FROM `zay_wares_category` c WHERE c.`wares_id`='?'  GROUP BY c.wares_id ";
        $this->wares_categorys = explode(',', $this->getSelectArray($querySelect, array($wares_id))[0]['category_ids']);
        return $this->wares_categorys;
    }

    /**
     * Привязка категорий
     * @param type $wares_id товара ид
     * @param type $category_ids массив категорий
     */
    public function insertWaresCategory($wares_id, $category_ids_array) {
        if ($wares_id > 0) {
            $query = "DELETE FROM `zay_wares_category` WHERE `wares_id`='?' ";
            $this->query($query, array($wares_id));
            $col = count($category_ids_array);
            if ($col > 0) {
                foreach ($category_ids_array as $value) {
                    $query = "INSERT INTO `zay_wares_category`(`wares_id`, `category_id`) VALUES ('?','?') ";
                    $this->query($query, array($wares_id, $value), 0);
                }
            }
        }
    }

    /**
     * Добавим недостающий записи в позиции материала
     * @param type $wares_id
     * @param type $series_id
     * @param type $material_type
     * @param type $material_id
     * @param type $material_position
     */
    public function set_wares_material_position($wares_id, $series_id, $material_type, $material_id, $material_position = 0) {
        $select = "SELECT * FROM `zay_wares_material_position` WHERE wares_id='?' AND series_id='?' AND material_id='?'";
        $objs = $this->getSelectArray($query, array($wares_id, $series_id, $material_id));
        if (count($objs) == 0) {
            if ($material_position > 0) {
                $position = $material_position;
            } else {
                $position = $this->count_wares_material_position($wares_id, $series_id) + 1;
            }
            $query = "INSERT INTO `zay_wares_material_position`(`wares_id`, `series_id`, `material_type`, `material_id`, `material_position`) "
                    . "VALUES ('?','?','?','?','?')";
            $this->query($query, array($wares_id, $series_id, $material_type, $material_id, $position), 0);
        }
    }

    /**
     * Колличество элементов в wares_material_position
     * @param type $wares_id
     * @param type $series_id
     * @return type
     */
    public function count_wares_material_position($wares_id, $series_id) {
        $select = "SELECT count(*) col FROM `zay_wares_material_position` WHERE wares_id='?' AND series_id='?'";
        return $this->getSelectArray($query, array($wares_id, $series_id))[0];
    }

    /**
     * Получить материалы по товару
     * @param type $wares_id
     * @return type
     */
    public function list_materials($wares_id) {
        $select = "SELECT * FROM `zay_wares_material` WHERE `wares_id`='?' order BY `position` asc";
        return $this->getSelectArray($select, array($wares_id));
    }

    /**
     * Добавление нового материала
     * @param array $data
     * @return type
     */
    public function insert_material($data) {
        $data['position'] = $this->count_material($data['wares_id'], $data['series_id']);
//        if ($data['position'] > 1) {
//            $data['position'] = $data['position'] + 1;
//        }
        $query_insert = "INSERT INTO `zay_wares_material`(`wares_id`, `series_id`, `material_type`, `material_title`, `material_descr`, `video_youtube`, `video_time`, `audio_file`, `material_file`, `position`) "
                . "VALUES ('?','?','?','?','?','?','?','?','?')";
        print_r($data);
        echo "<br/>\n";
        return $this->query($query_insert,
                        array(
                            $data['wares_id'],
                            $data['series_id'],
                            $data['material_type'],
                            $data['material_title'],
                            $data['material_descr'],
                            $data['video_youtube'],
                            $data['video_time'],
                            $data['audio_file'],
                            $data['material_file'],
                            $data['position']
                        ), 0);
    }
    
    /**
     * Удалить материал
     * @param type $wares_id
     * @return type
     */
    public function delete_material($wares_id, $material_id) {
        if ($wares_id > 0) {
            $queryDelete = "DELETE FROM `zay_wares_material` WHERE wares_id='?' AND id='?' ";
            return $this->query($queryDelete, array($wares_id, $material_id), 1);
        }
        return array();
    }

    /**
     * Вернуть колличество материалов
     * @param type $wares_id
     * @param type $series_id
     * @return type
     */
    public function count_material($wares_id, $series_id) {
        $select = "SELECT count(*) as col FROM `zay_wares_material` WHERE `wares_id`='?' and `series_id`='?'";
        return $this->getSelectArray($select, array($wares_id, $series_id))[0]['col'];
    }

    /**
     * Получить название типа материала
     * @param type $type_material код материала из DB
     * @return string
     */
    public function type_material_is_name($type_material) {
        switch ($type_material) {
            case 'material_type_text':
                $v = 'Текст';
                break;
            case 'material_type_video':
                $v = 'Видео';
                break;
            case 'material_type_audio':
                $v = 'Аудио';
                break;
            case 'material_type_file':
                $v = 'Фаил';
                break;
            default:
                $v = 'Не определен';
                break;
        }
        return $v;
    }
    
    /**
     * Обновить позицию серии
     * @param type $menu_id
     * @param type $item_id
     * @param type $position
     * @return type
     */
    public function material_position_set($material_id, $series_id, $position, $metod) {
//        if ($position <= 0) {
//            return true;
//        }

        if ($metod == "up") {
            $q1 = "select * from `zay_wares_material` WHERE `series_id`='?' and `id`='?'";
            $elem1 = $this->getSelectArray($q1, array($series_id, $material_id), 0)[0];
            $q2 = "select * from `zay_wares_material` WHERE `series_id`='?' and `position`='?'";
            $elem2 = $this->getSelectArray($q2, array($series_id, ($elem1['position'] - 1)), 0)[0];
        }
            
        if ($metod == "down") {
            $q1 = "select * from `zay_wares_material` WHERE `series_id`='?' and `id`='?'";
            $elem1 = $this->getSelectArray($q1, array($series_id, $material_id), 0)[0];
            $q2 = "select * from `zay_wares_material` WHERE `series_id`='?' and `position`='?'";
            $elem2 = $this->getSelectArray($q2, array($series_id, ($elem1['position'] + 1)), 0)[0];
        }

        $query = "UPDATE `zay_wares_material` SET `position`='?' WHERE `id`='?'";
        $this->query($query, array($elem2['position'], $elem1['id']), 0);
        $query = "UPDATE `zay_wares_material` SET `position`='?' WHERE `id`='?'";
        $this->query($query, array($elem1['position'], $elem2['id']), 0);
        return true;
    }

}
