<?php

/*
 * Данные о пользователе сайта
 */

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';

class statistic extends \project\extension {

    private $SERVER;

    public function __construct() {
        $this->SERVER = $_SERVER;
    }

    /**
     * Инициализируем работу
     * @param type $visitor_id
     */
    public function visitorInit() {
        if (!isset($_SESSION['visitor']) || count($_SESSION['visitor']) == 0) {
            $_SESSION['visitor']['hash'] = $_SESSION['token_hash'];
            $_SESSION['visitor']['id'] = $this->register($_SESSION['visitor']['hash']);
        } else {
            //echo 'NO visitorInit: ' . count($_SESSION['visitor']) . "<br/>\n" ;
        }
    }

    /**
     * Регистрация посетителя
     * @param type $hash
     * @return int
     */
    private function register($hash) {
        echo "hash {$hash}<br/>\n";
        $query = "INSERT INTO `zay_visitors`(`visitor_id`, `http_user_agent`, `remote_addr`, "
                . "`request_uri_last`, `request_uri`, `http_referer`, `user`, `height`, `width`, `last_time`, `start_time`) "
                . "VALUES ('?','?','?','?','?','?','?','?','?',NOW(),NOW())";
        if ($this->query($query, array($hash,
                    $this->SERVER['HTTP_USER_AGENT'],
                    $this->SERVER['REMOTE_ADDR'],
                    $_SESSION['REFERER'],
                    $this->SERVER['REQUEST_URI'],
                    $this->SERVER['HTTP_REFERER'],
                    $this->SERVER['USER'],
                    $_SESSION['browser']['height'],
                    $_SESSION['browser']['width']))) {
            $querySelect = "SELECT * FROM `zay_visitors` WHERE `last_time`> (NOW() - INTERVAL 1 DAY) "
                    . "and `visitor_id`='?' ";
            $visitor = $this->getSelectArray($querySelect, array($hash))[0];
            return $visitor['id'];
        }

        return 0;
    }

    /**
     * Обновим время пребываня
     * иместо посещения
     * @return boolean
     */
    public function updateLastTime() {
        if (isset($_SESSION['visitor']['id']) && $_SESSION['visitor']['id'] > 0) {
            $request_uri_last = $this->SERVER['REQUEST_URI'];
            $query = "UPDATE `zay_visitors` SET `request_uri_last`='?', `last_time`=NOW() "
                    . "WHERE `id`='?'";
            if ($this->query($query, array($request_uri_last, $_SESSION['visitor']['id']))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Статистика по дням
     * @param type $start_date
     * @param type $end_date
     * @return type
     */
    public function getStatDaysDataArray($start_date, $end_date) {
        $querySelect = "SELECT count(v.`start_time`) as col, "
                . "date(`start_time`) as day "
                . "FROM `zay_visitors` v "
                . "WHERE `start_time` >= '?' and `start_time` <= '?' "
                . "GROUP by date(`start_time`)";
        return $this->getSelectArray($querySelect, array($start_date . ' 00:00:00', $end_date . ' 23:59:59'));
    }

    /**
     * Статистика по дням
     * @param type $start_date
     * @param type $end_date
     * @return type
     */
    public function getWaresVideoSeeData($start_date, $end_date) {
        $querySelect = "SELECT sum(vs.`count_see`) as col, "
                . "date(vs.`video_see_date`) as day "
                . "FROM `zay_wares_video_see` vs "
                . "WHERE vs.`video_see_date` >= '?' and vs.`video_see_date` <= '?' "
                . "GROUP by date(`video_see_date`)";
        return $this->getSelectArray($querySelect, array($start_date . ' 00:00:00', $end_date . ' 23:59:59'));
    }

    /**
     * Статистика за выбранный год по месецам
     * @param type $year
     * @return type
     */
    public function getStatMonsDataArray($year) {
        $querySelect = "SELECT count(v.`start_time`) as col, "
                . "MONTH(`start_time`) as mon "
                . "FROM `zay_visitors` v "
                . "WHERE `start_time` > YEAR('?') "
                . "GROUP by MONTH(`start_time`) ";
        return $this->getSelectArray($querySelect, array($year));
    }

}
