<?php

// zay_consultation_master

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

class sign_up_consultation extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавление новой консультации
     * @param type $data
     * @return type
     */
    public function add_consultation($data) {
        $period_id = ($data['period_id'] > 0) ? $data['period_id'] : 0;

        if (!isset($_SESSION['consultation'])) {
            $querySelect = "SELECT * FROM `zay_consultation` WHERE `consultation_date`='?' AND `consultation_time`='?' and `cancel`=0 ";
            $objs = $this->getSelectArray($querySelect, array($consultation_date, $data['time']));
            if (count($objs) == 0) {
                $_SESSION['errors'][] = 'Уже есть запись на эту дату!';
            }
        }

        if (count($_SESSION['errors']) == 0) {
            $query = "INSERT INTO `zay_consultation`(`pay_id`, `master_id`, `first_name`, `user_phone`, `user_email`, `pay_descr`, `consultation_date`, `consultation_time`, `period_id`) "
                    . "VALUES ('?','?','?','?','?','?','?','?','?')";

            $return = $this->query($query, array($data['pay_id'], $data['your_master_id'], $data['first_name'], $data['user_phone'], $data['user_email'], $data['pay_descr'], $data['date'], $data['time'], $period_id), 0);
            // Отправим письмо оповещение
            if ($return) {
                $period_str = '';
                if ($period_id > 0) {
                    $periods = $this->get_master_consultation_periods($data['your_master_id'], $period_id);
                    if (count($periods) > 0) {
                        $period_str = $periods[0]['period_hour'] . ':' . $periods[0]['periods_minute'] . ' цена: ' . $periods[0]['period_price'];
                    }
                }

                $send_emails = new \project\send_emails();
                $config = new \project\config();
                $link_ed_mailto = $config->getConfigParam('link_ed_mailto');
                $send_emails->send(
                        'consultation',
                        $link_ed_mailto, array(
                    'site' => 'https://www.' . $_SERVER['SERVER_NAME'],
                    'fio' => $data['first_name'],
                    'email' => $data['user_email'],
                    'phone' => $data['user_phone'],
                    'descr' => $data['pay_descr'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'period' => $period_str
                        )
                );
                unset($_SESSION['consultation']);
            }

            return $return;
        }
        return false;
    }

    /**
     * Проверить возможность записи на консультацию
     * @param type $date
     * @param type $time
     * @return boolean
     */
    public function consultation_check($date, $time) {
        $querySelect = "SELECT * FROM zay_consultation cn "
                . "left join zay_pay p on p.id=cn.pay_id "
                . "WHERE cn.consultation_date='?' AND cn.consultation_time='?' and cn.cancel=0 "
                . "and p.pay_status='succeeded' ";
        $objs = $this->getSelectArray($querySelect, array($date, $time));
        if (count($objs) > 0) {
            $_SESSION['errors'][] = 'Уже есть запись на эту дату!';
            return false;
        } else {
            return true;
        }
    }

    /**
     * Обновлениеданных о консультации
     * @param type $data
     */
    public function update_consultation($data) {
        $query = "UPDATE `zay_consultation` 
                    SET `user_email`='?',
                    `first_name`='?',
                    `user_phone`='?',
                    `master_id`='?',
                    `pay_descr`='?',
                    `consultation_date`='?',
                    `consultation_time`='?',
                    `cancel`='?',
                    `lastdate`=CURRENT_TIMESTAMP
                  WHERE `id`='?'";
        return $this->query($query, array(
                    $data['user_email'],
                    $data['first_name'],
                    $data['user_phone'],
                    $data['your_master_id'],
                    $data['pay_descr'],
                    $data['consultation_date'],
                    $data['consultation_time'],
                    $data['consultation_cancel'],
                    $data['consultation_id']
                        ), 0);
    }

    /*
     * Мастера для консультаций
     */

    /**
     * Получить кураторов
     * @param type $id или конкретного куратора
     * @return type
     */
    public function get_consultation_master($id = 0) {
        if ($id > 0) {
            $querySelect = "SELECT * FROM `zay_consultation_master` WHERE `id`='?' ORDER BY `position` ASC";
            return $this->getSelectArray($querySelect, array($id));
        } else {
            $querySelect = "SELECT * FROM `zay_consultation_master` ORDER BY `position` ASC";
            return $this->getSelectArray($querySelect);
        }
    }

    /**
     * Определение настроек для консультаций
     * @param type $master_id
     */
    public function set_consultation_config($master_id) {
        $consultation_masters = $this->get_consultation_master($master_id);
        if (count($consultation_masters) > 0) {
            foreach ($consultation_masters as $value) {
                $_SESSION['consultation_id'] = $value['id'];
                $_SESSION['consultation_master'] = $value['master_name'];
                $_SESSION['consultation_credentials'] = $value['credentials_file_name'];
                $_SESSION['consultation_token'] = $value['token_file_name'];
                return true;
            }
        }
        return false;
    }

    /**
     * Изменение информации о консультанте
     * @param type $id
     * @param type $master_name
     * @param type $token_file_name
     * @param type $credentials_file_name
     * @return boolean
     */
    public function edit_consultation_master($id, $master_name, $token_file_name, $credentials_file_name) {
        if ($id > 0) {
            $masters = $this->get_consultation_master();
            $count_masters = count($masters) + 1;
            $query = "UPDATE `zay_consultation_master` "
                    . "SET `master_name`='?',`token_file_name`='?',`credentials_file_name`='?', `position`='?' "
                    . "WHERE `id`='?' ";
            return $this->query($query, array($master_name, $token_file_name, $credentials_file_name, $count_masters, $id));
        } else {
            $query = "INSERT INTO `zay_consultation_master`(`master_name`, `token_file_name`, `credentials_file_name`, `position`) "
                    . "VALUES ('?','?','?','?')";
            return $this->query($query, array($master_name, $token_file_name, $credentials_file_name, $count_masters));
        }
        return false;
    }

    /**
     * Удаление консультанта
     * @param type $id
     * @return boolean
     */
    public function delete_consultation_master($id) {
        if ($id > 0) {
            $query = "DELETE FROM `zay_consultation_master` WHERE `id`='?' ";
            $ret = $this->query($query, array($id));
            if ($ret) {
// Чистим периоды
                $this->delete_consultation_period_or_master($id);
            }
            return $ret;
        }
        return false;
    }

    /**
     * Добавление консультации в корзину<br/>в едином формате
     * @param type $user_id
     * @param type $first_name
     * @param type $user_phone
     * @param type $user_email
     * @param type $master_id
     * @param type $day
     * @param type $time
     * @param type $price
     * @param type $period_id
     */
    public function set_cart_consultation($user_id, $first_name, $user_phone, $user_email, $master_id, $day, $time, $price = 0, $period_id = 0) {
        $sign_up_consultation = new \project\sign_up_consultation();

        $master_name = '';
        if ($master_id > 0) {
            $master_data = $sign_up_consultation->get_consultation_master($master_id);
            $master_name = $master_data[0]['master_name'];
        }
        $c_price = $price;
        if ($period_id > 0) {
            $period_data = $sign_up_consultation->get_consultation_on_period_info($period_id);
            if ($period_data['period_price'] > 0) {
                $master_name = $period_data['master_name'];
                $c_price = $period_data['period_price'];
            }
        }

// Описание
        $descr = "<div>Консультация с {$first_name}</div>"
                . "<div>Телефон: {$user_phone}</div>"
                . "<div>Email: {$user_email}</div>"
                . "<div>Консультант: {$master_name}</div>"
                . "<div>Дата и время: {$day} {$time}</div>"
                . "<div>Цена: {$price}</div>";

// Массив данных
        $data_itm = array(
            'id' => 0,
            'your_master_id' => $master_id,
            'user_id' => $user_id,
            'title' => "Консультация \"{$master_name}\"",
            'images_str' => '/assets/img/products/consultation.jpg',
            'first_name' => $first_name,
            'user_phone' => $user_phone,
            'user_email' => $user_email,
            'pay_descr' => $descr,
            'date' => date_sql_format($day),
            'time' => $time,
            'price' => $c_price,
            'period_id' => $period_id,
        );
        $_SESSION['consultation'] = $data_itm;
        $_SESSION['cart']['itms'][] = $data_itm;
    }

    /*
     * Методы для периодов консультаций
     */

    /**
     * Получить список периодов и цен
     * @param type $master_id
     * @return type
     */
    public function get_master_consultation_periods($master_id, $date, $periods_id = 0) {
        $array = array();
        $array[] = $master_id;
        $where1 = ' or p.period_start is not null';
        if (strlen($date) > 0) {
            $array[] = $date;
            $where1 = "or (p.period_start<='?' AND p.period_end>='?')";
        }
        if ($periods_id == 0) {
            $querySelect = "SELECT * FROM zay_consultation_periods p 
                    where p.master_id='?' AND (p.period_start is null or p.period_start='' {$where1}) 
                    ORDER BY p.period_time ASC, p.periods_minute ASC";
            return $this->getSelectArray($querySelect, $array, 0);
        } else {
            $querySelect = "SELECT * FROM zay_consultation_periods p 
                    where p.master_id='?' and p.id='?'
                    ORDER BY p.period_time ASC, p.periods_minute ASC";
            return $this->getSelectArray($querySelect, array($master_id, $periods_id));
        }
    }

    /**
     * Редактирование периодов консультаций и цен
     * @param type $consultation_period
     * @param type $master_id
     * @param type $period_hour
     * @param type $periods_minute
     * @param type $period_price
     * @return type
     */
    public function edit_consultation_period($consultation_period, $master_id, $period_time, $period_hour, $periods_minute, $period_price, $period_active) {
        if ($consultation_period > 0) {
            $query = "UPDATE `zay_consultation_periods` SET `master_id`='?',`period_time`='?', "
                    . "`period_hour`='?',`periods_minute`='?',`period_price`='?', `period_active`='?' "
                    . "WHERE `id`='?'";
            return $this->query($query, array($master_id, $period_time, $period_hour, $periods_minute, $period_price, $period_active, $consultation_period));
        } else {
            $query = "INSERT INTO `zay_consultation_periods` (`master_id`, `period_time`, `period_hour`, `periods_minute`, `period_price`, `period_active`) "
                    . "VALUES ('?','?','?','?','?','?')";
            return $this->query($query, array($master_id, '00:00:00', $period_hour, $periods_minute, $period_price, '1'));
        }
    }

    /**
     * Удаление периода консультаций
     * @param type $consultation_period
     * @return type
     */
    public function delete_consultation_period($consultation_period) {
        $query = "DELETE FROM `zay_consultation_periods` WHERE `id`='?'";
        return $this->query($query, array($consultation_period));
    }

    /**
     * Удаление периодов по мастеру
     * @param type $id
     * @return boolean
     */
    public function delete_consultation_period_or_master($master_id) {
        if ($master_id > 0) {
            $queryPeriods = "DELETE FROM `zay_consultation_periods` WHERE master_id='?'";
// Чистим периоды
            return $this->query($queryPeriods, array($master_id));
        }
        return false;
    }

    /**
     * Получить список купленных консультаций
     * @param type $master_id
     * @return type
     */
    public function get_master_consultations($master_id) {
        $querySelect = "SELECT c.master_id, c.consultation_date, c.consultation_time, c.period_id 
                FROM zay_consultation c 
                left join zay_pay p on p.id=c.pay_id
                where c.master_id='?' and `consultation_date`>=CURRENT_DATE and p.pay_status='succeeded' and cancel=0 ";
        return $this->getSelectArray($querySelect, array($master_id), 0);
    }

    /**
     * Получить список купленных консультаций
     * @param type $master_id
     * @return type
     */
    public function get_master_consultations_full($master_id) {
        $querySelect = "SELECT c.* 
                FROM zay_consultation c 
                left join zay_pay p on p.id=c.pay_id
                where c.master_id='?' and (`consultation_date`>=CURRENT_DATE and p.pay_status='succeeded') or c.pay_id='0'";
        return $this->getSelectArray($querySelect, array($master_id), 0);
    }

    /**
     * Получить список консультаций
     * @param type $master_id
     * @return type
     */
    public function get_master_consultations_all($master_id) {
        $querySelect = "SELECT c.*  FROM zay_consultation c where c.master_id='?' ";
        return $this->getSelectArray($querySelect, array($master_id), 0);
    }

    /**
     * Информация по консультации
     * @param type $master_id
     * @return type
     */
    public function get_consultations_id($id) {
        $querySelect = "SELECT c.* 
                FROM zay_consultation c 
                left join zay_pay p on p.id=c.pay_id
                where c.id='?'";
        return $this->getSelectArray($querySelect, array($id), 0);
    }

    /**
     * Данные о периодах консультанта
     * @param type $master_id
     * @return type
     */
    public function get_consultation_times($master_id = 1, $day = '') {
        $day_sql = date_sql_format($day);
        $querySelect = "SELECT p.*,
(SELECT count(*) FROM zay_consultation c 
left join zay_pay pp on pp.id=c.pay_id 
WHERE c.master_id = p.master_id AND c.consultation_date = '?' AND c.consultation_time = p.period_time
and pp.pay_status='succeeded') AS is_pay,
(select count(*) from zay_consultation_rejection cr where cr.master_id=p.master_id and cr.rejection_period=0 and cr.rejection_day='?') as rejection_day,
(select count(*) from zay_consultation_rejection cr where cr.master_id=p.master_id and cr.rejection_period=p.id and cr.rejection_day='?') as rejection_period
                            FROM
                                zay_consultation_periods p
                            WHERE
                                p.master_id = '?' and (p.period_start is null or (p.period_start<='?' AND p.period_end>='?')) 
                            ORDER BY p.period_time";
        $data = $this->getSelectArray($querySelect, array($day_sql, $day_sql, $day_sql, $master_id, $day_sql, $day_sql), 0);
        return $data;
    }

    /**
     * Данные консультации по периоду
     * @param type $period_id
     * @return type
     */
    public function get_consultation_on_period_info($period_id) {
        $data = array();
        $querySelect = "SELECT
                            p.id, m.id as master_id, m.master_name, m.list_times, p.period_price, p.period_time, p.period_hour, p.periods_minute
                        FROM
                        zay_consultation_periods p
                           left join zay_consultation_master m on p.master_id=m.id
                        WHERE
                            p.id = '?'";
        $data = $this->getSelectArray($querySelect, array($period_id), 0)[0];

        return $data;
    }

    /**
     * Получить исключения
     * @param type $master_id
     * @return type
     */
    public function get_master_consultation_rejections($master_id) {
        $query = "SELECT * FROM zay_consultation_rejection cr WHERE cr.master_id='?' and cr.rejection_day >= CURRENT_DATE ORDER by cr.rejection_day ";
        return $this->getSelectArray($query, array($master_id));
    }

    /**
     * Добавление исключения
     * @param type $data
     * @return type
     */
    public function set_master_consultant_rejection($data) {
        if (is_array($data)) {
            if ($data['id'] > 0) {
                $query = "UPDATE `zay_consultation_rejection` SET `master_id`='?',`rejection_day`='?',`rejection_period`='?' "
                        . "WHERE `id`='?'";
                return $this->query($query, array($data['master_id'], $data['rejection_day'], $data['rejection_period'], $data['id']));
            } else {
                $data['rejection_day'] = date("Y-m-d");
                $query = "INSERT INTO `zay_consultation_rejection`(`master_id`, `rejection_day`, `rejection_period`) "
                        . "VALUES ('?','?','?')";
                return $this->query($query, array($data['master_id'], $data['rejection_day'], $data['rejection_period']), 0);
            }
        }
    }

    /**
     * Удаление периода исключения
     * @param type $rejection_id
     * @return type
     */
    public function delete_consultation_rejection($rejection_id) {
        $query = "DELETE FROM `zay_consultation_rejection` WHERE `id`='?'";
        return $this->query($query, array($rejection_id));
    }

}
