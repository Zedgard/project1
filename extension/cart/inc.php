<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/send_emails/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/sign_up_consultation/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/close_club/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/promo/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/utm/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/business_ru-check.business.ru-api/OpenApiConnector.php'; // Импорт файла с классом

use OpenApiConnector as CONNECTOR;

class cart extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Покупки пользователя
     * @return type
     */
    public function get_pay_user_list() {
        $query = "select distinct p.id, p.pay_date, p.pay_sum, p.pay_descr, "
                . "(select GROUP_CONCAT(w.title SEPARATOR ',') from "
                . "zay_pay_products pp "
                . "left join zay_product_wares pw on pw.product_id=pp.product_id "
                . "left join zay_wares w on w.id=pw.wares_id "
                . "where pp.pay_id=p.id) as wares_title "
                . "from zay_pay p "
                . "where p.user_id='?' and p.pay_status='succeeded' ORDER BY p.pay_date DESC";
        $data = $this->getSelectArray($query, array($_SESSION['user']['info']['id']), 0);
        return $data;
    }

    /**
     * Связи покупки и продукта
     * @param type $pay_id
     * @param type $itms
     */
    public function pay_insert_pay_products($pay_id, $itms) {
        $pr_products = new \project\products();
        foreach ($itms as $value) {
            //$product_id = $max_id;
            $product_id = $value['id'];
            $where_period_open = "NULL";
            if ($value['period_open'] > 0) {
                $where_period_open = "DATE_ADD(NOW(), INTERVAL ({$value['period_open']}+1) DAY)";
            }
            if ($product_id > 0) {
                $price = $value['price'];
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                }
                $queryProductRegister = "INSERT INTO `zay_pay_products`(`pay_id`, `product_id`, `product_price`, `close_date`) 
                    VALUES ('?','?','?', {$where_period_open})";
                $this->query($queryProductRegister, array($pay_id, $product_id, $price, $where_period_open));

                // Зафиксируем продажу
                $pr_products->setSoldProducts($product_id);
            }
        }
        // Связи покупки и консультации
        $this->pay_insert_pay_consultation($pay_id, $itms);
    }

    /**
     * Связи покупки и консультации
     * @param type $pay_id
     * @param type $itms
     */
    public function pay_insert_pay_consultation($pay_id, $itms) {
        $pr_products = new \project\products();

        foreach ($itms as $value) {
            //$product_id = $max_id;
            $product_id = $value['id'];
            $your_master_id = $value['your_master_id'];
            //$user_id = $value['user_id'];
            $title = $value['title'];
            //$images_str = $value['images_str'];
            $first_name = $value['first_name'];
            $user_phone = $value['user_phone'];
            $user_email = $value['user_email'];
            $pay_descr = $value['pay_descr'];
            $date_consultation = $value['date'];
            $time_consultation = $value['time'];
            $price = $value['price'];
            $period_id = $value['period_id'];
            /*
             *  Данные из сесии покупки консультации
              [id] => 0
              [your_master_id] => 1
              [user_id] => 15
              [title] => Консультация "Эдгард Зайцев" Дата: 20.07.2021 04:00:00
              [images_str] => /assets/img/products/consultation.jpg
              [first_name] => Виктор
              [user_phone] => 89143720027
              [user_email] => koman1706@gmail.com
              [pay_descr] => <div>Консультация с Виктор</div><div>Телефон: 89143720027</div><div>Email: koman1706@gmail.com</div><div>Консультант: Эдгард Зайцев</div><div>Дата и время: 20.07.2021 04:00:00</div><div>Цена: 11000</div>
              [date] => 2021-07-20
              [time] => 04:00:00
              [price] => 11000
              [period_id] => 65
             */
            if ($product_id == 0 && $your_master_id > 0) {
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                }
                $queryProductRegister = "INSERT INTO `zay_pay_consultation` 
                    (`pay_id`, `title`, `descr`, `period_id`, `master_id`, `user_first_name`, `user_phone`, `user_email`, `date_consultation`, `time_consultation`) 
                    VALUES ('?','?','?','?','?','?','?','?','?','?')";
                $this->query($queryProductRegister, array($pay_id, $title, $pay_descr, $period_id, $your_master_id, $first_name, $user_phone, $user_email, $date_consultation, $time_consultation));
            }
        }
    }

    /**
     * Регистрация покупки
     * @param type $pay_id
     */
    public function register_pay($pay_id) {
        // Еще есть массив $_SESSION['cart']['itms']
        $sign_up_consultation = new \project\sign_up_consultation();
        $close_club = new \project\close_club();
        $promo = new \project\promo();
        $utm = new \project\utm();
        $products = new \project\products();
        /*
         * Если клиент перешел по utm метки то фиксируем покупку реферала 
         */
        $utm->utm_product_bay($pay_id);

        // Получим покупку
        $query = "SELECT * FROM zay_pay WHERE id='?'";
        $pay_data = $this->getSelectArray($query, array($pay_id))[0];

        // Если это консультация 
        if (strlen($pay_data['pay_descr']) > 0) {
            //$_SESSION['consultation']['pay_id'] = $pay_id;
            $sign_up_consultation->add_consultation($pay_data);
        }

        // Зафиксируем покупку по закрытому клубу
        $close_club->register_ispay_club_month_period($pay_id);

        // Регистрируем чек
        $this->register_business_check($pay_id);

        // Применили промо то отметим что промо использовано
        if (count($_SESSION['promos']) > 0) {
            foreach ($_SESSION['promos'] as $key => $value) {
                $promo->sale_promo_code($key);
            }
        }

        // Зафиксируем продажу товара
        $query_products = "SELECT pp.* FROM zay_pay p 
                            left join zay_pay_products pp on pp.pay_id=p.id
                            WHERE p.id='?'";
        $products_data = $this->getSelectArray($query_products, array($pay_id));
        foreach ($products_data as $v) {
            $products->setSoldAdd($v['product_id']);
        }
    }

    /**
     * Регистрация чека <br/>
     * https://check-dev.business.ru/checks <br/>
     * https://check.business.ru/checks <br/>
     * @param type $pay_id
     * @param type $itms
     */
    public function register_business_check($pay_id) {
        if ($pay_id > 0) {
            $config = new \project\config();
            // Настройка
            // appID
            $business_check_appID = $config->getConfigParam('business_check_appID');
            // secret
            $business_check_secret = $config->getConfigParam('business_check_secret');
            // ндс
            $business_check_nds = $config->getConfigParam('business_check_nds');
            if ($business_check_nds == '') {
                $business_check_nds = 0; // По умолчанию 20%
            }
            // Адрес сервиса
            $business_check_base_url = $config->getConfigParam('business_check_base_url');

            // Получим покупку
            $query = "SELECT * FROM zay_pay WHERE id='?'";
            $pay_data = $this->getSelectArray($query, array($pay_id));


            $query_pay_type = "SELECT * FROM zay_pay_type WHERE pay_type_code='?'";
            $pay_type = $this->getSelectArray($query_pay_type, array($pay_data[0]['pay_type']))[0]['pay_type_title'];

            $query_user_info = "SELECT * FROM `zay_users` WHERE `id`='?'";
            $user_info = $this->getSelectArray($query_user_info, array($pay_data[0]['user_id']))[0];

            if (count($pay_data) > 0 && $pay_data[0]['pay_sum'] > 0 && $pay_data[0]['pay_status'] == 'succeeded') {
                $query_products = "SELECT pp.product_price, pp.creat_date, pr.* FROM zay_pay_products pp 
                                LEFT JOIN zay_product pr on pr.id=pp.product_id
                                WHERE pp.pay_id='?'";
                $products = $this->getSelectArray($query_products, array($pay_data[0]['id']));


                /*
                 * Получаем информацию о продуктах из базы а не из сессии покупателя
                 */
                $goods = array();
                $total = 0;
                // Обычный продукт
                if (count($products) > 0) {
                    foreach ($products as $value) {
                        $price = $value['product_price'];
                        $total += $price;
                        if (strlen($value['tax']) > 0) {
                            $business_check_nds = $value['tax'];
                        }
                        $item_type = 4; // УСЛУГА по умолчанию
                        $title = $value['title'];

                        $goods[] = array(
                            "count" => 1, // (float) Количество товара (Не более 3-х знаков после точки).
                            "price" => $price, // (float) Стоимость товара (Не более 2-х знаков после точки).
                            "sum" => $price, // (float) Сумма товарной позиции (Не более 2-х знаков после точки).
                            "name" => $title, // (String) Наименование товара (Будет пробито на чеке).
                            "nds_value" => $business_check_nds, // (int) Значение налога.
                            "nds_not_apply" => true, // (bool) Используется ли НДС для товара.
                            "payment_mode" => 4, // Признак способа расчёта 
                            "item_type" => $item_type// Признак предмета расчёта
                        );
                    }
                }



                // Это консультация
                if (strlen($pay_data[0]['pay_descr']) > 0) {
                    $queryConsultation = "SELECT cp.period_price, cp.text_type, cp.period_time, 
                            cm.master_name, 
                            c.*     
                            FROM zay_consultation c 
                            left join zay_consultation_periods cp on cp.id=c.period_id
                            left join zay_consultation_master cm on cm.id=c.master_id
                            WHERE c.pay_id='?' ";

                    $consultation = $this->getSelectArray($queryConsultation, array($pay_id));
                    if (count($consultation) > 0) {
                        foreach ($consultation as $value) {
                            $price = $value['period_price'];
                            $total += $price;
                            $business_check_nds = 0;
                            $item_type = 4; // УСЛУГА по умолчанию
                            $title = $value['text_type'] . ' консультация с ' . $value['master_name'];

                            $goods[] = array(
                                "count" => 1, // (float) Количество товара (Не более 3-х знаков после точки).
                                "price" => $price, // (float) Стоимость товара (Не более 2-х знаков после точки).
                                "sum" => $price, // (float) Сумма товарной позиции (Не более 2-х знаков после точки).
                                "name" => $title, // (String) Наименование товара (Будет пробито на чеке).
                                "nds_value" => $business_check_nds, // (int) Значение налога.
                                "nds_not_apply" => true, // (bool) Используется ли НДС для товара.
                                "payment_mode" => 4, // Признак способа расчёта 
                                "item_type" => $item_type// Признак предмета расчёта
                            );
                        }
                    }
                }

                /*
                 * Работа с кассой
                 */
                $connector = new CONNECTOR($business_check_appID, $business_check_secret, $business_check_base_url);  //Создание экземпляра класса
                //$connector->openShift(); // Выполнение открытия смены
                //var_dump($connector);
                //echo "<br/>\n";
//            $goods = array();
//            $total = 0;
                /*
                 * Старая обработка из сессии не используем
                 */
//            if (count($itms) > 0) {
//                foreach ($itms as $value) {
//                    //$price = $value['product_price'];
//                    if ($value['price_promo'] > 0) {
//                        $price = $value['price_promo'];
//                    } else {
//                        $price = $value['price'];
//                    }
//                    $total += $price;
//                    foreach ($products as $p_value) {
//                        if ($p_value['id'] == $value['id']) {
//                            if ($p_value['tax'] > 0) {
//                                $business_check_nds = $p_value['tax'];
//                            }
//                        }
//                    }
//
//                    $item_type = 4; // УСЛУГА по умолчанию
//                    $pay_descr = (strlen($itms['pay_descr']) > 0) ? $itms['pay_descr'] : ''; // это консультация
//                    if (strlen($pay_descr) > 0) {
//                        $title = $itms['pay_descr'];
//                        //$item_type = 4; // УСЛУГА
//                    } else {
//                        //$item_type = 1; // Товар
//                        $title = $value['title'];
//                    }
//
//                    $goods[] = array(
//                        "count" => 1, // (float) Количество товара (Не более 3-х знаков после точки).
//                        "price" => $price, // (float) Стоимость товара (Не более 2-х знаков после точки).
//                        "sum" => $price, // (float) Сумма товарной позиции (Не более 2-х знаков после точки).
//                        "name" => $title, // (String) Наименование товара (Будет пробито на чеке).
//                        "nds_value" => $business_check_nds, // (int) Значение налога.
//                        "nds_not_apply" => true, // (bool) Используется ли НДС для товара.
//                        "payment_mode" => 4, // Признак способа расчёта 
//                        "item_type" => $item_type// Признак предмета расчёта
//                    );
//                }
//            }
                //print_r($goods);
                //echo "billArray<br/>\n";
                $billArray = [// Массив с данными чека.
                    "command" => [// Массив с данными команды.
                        "author" => "{$pay_type}", // (String) Имя кассира (Будет пробито на чеке). // Платеж через {$pay_type} на сайте {$_SERVER['SERVER_NAME']}
                        "smsEmail54FZ" => $user_info['email'], //$_SESSION['user']['info']['email'], // (String) Телефон или e-mail покупателя.
                        "c_num" => $pay_id, // (int) Номер чека.
                        "payed_cash" => 0.00, // (float) Сумма оплаты наличными (Не более 2-х знаков после точки).
                        "payed_cashless" => $total . '.00', // (float) Сумма оплаты безаличным рассчетом (Не более 2-х знаков после точки).
                        "tag1055" => 32, //  Применяемая система налогообложения для текущего чека\n
//                                              указывается числом: 1  - ОСН,\n 
//                                                                  2  - УСН,\n
//                                                                  4  - УСН доход-расход,\n
//                                                                  8  - ЕНВД,\n
//                                                                  16 - ЕСХН,\n 
//                                                                  32 - ПСН\n\n
//                    "goods" => [// Массив с позициями в чеке.
//                        [
//                            "count" => 2, // (float) Количество товара (Не более 3-х знаков после точки).
//                            "price" => 500, // (float) Стоимость товара (Не более 2-х знаков после точки).
//                            "sum" => 1000, // (float) Сумма товарной позиции (Не более 2-х знаков после точки).
//                            "name" => "Товар 1", // (String) Наименование товара (Будет пробито на чеке).
//                            "nds_value" => 18, // (int) Значение налога.
//                            "nds_not_apply" => false // (bool) Используется ли НДС для товара.
//                        ],
//                        [
//                            "count" => 1,
//                            "price" => 500.10,
//                            "sum" => 500.10,
//                            "name" => "Товар 2",
//                            "nds_value" => 18,
//                            "nds_not_apply" => true
//                        ]
//                    ]
                        "goods" => $goods
                    ]
                ];
                //echo "billArray<br/>\n";
                //print_r($billArray);
                //echo "<br/>\n";

                $result = $connector->printBill($billArray); // Команда на печать чека прихода.
                $obj = json_decode($result);
                //print_r($obj);
                //echo "result: {$obj->command_id} <br/>\n";
                // Если придет код запроса сформированного чека то чек принят
                if (isset($obj->command_id) && $obj->command_id > 0) {
                    $query = "UPDATE `zay_pay` SET `business_check`='?' WHERE `id`='?'";
                    $this->query($query, array($obj->command_id, $pay_id));
                    return true;
                } else {
                    ob_start();
                    var_dump($result);
                    $get_str = ob_get_clean();
                    $log_file = $_SERVER['DOCUMENT_ROOT'] . '/logs/business_check.log';
                    $time = date("d-m-Y H:i:s");
                    fileSet($log_file, "{$time} Покупка: {$pay_id} не сформирован чек\n{$get_str}\n", 'a+');
                }
                // $connector->closeShift(); // Выполнение закрытия смены
            }
        }
        return false;
    }

}
