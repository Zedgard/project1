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
        /*
         * Если это консультация 
         */
        if (isset($_SESSION['consultation']['your_master_id']) && $_SESSION['consultation']['your_master_id'] > 0) {
            $_SESSION['consultation']['pay_id'] = $pay_id;
            $sign_up_consultation->add_consultation($_SESSION['consultation']);
        }
        
        // Зафиксируем покупку по закрытому клубу
        $close_club->register_ispay_club_month_period($pay_id);
        
        // Регистрируем чек
        $this->register_business_check($pay_id, $_SESSION['cart']['itms']);

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
    public function register_business_check($pay_id, $itms) {
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

        // Получим покупку
        $query = "SELECT * FROM zay_pay WHERE id='?'";
        $pay_data = $this->getSelectArray($query, array($pay_id));


        $query_pay_type = "SELECT * FROM zay_pay_type WHERE pay_type_code='?'";
        $pay_type = $this->getSelectArray($query_pay_type, array($pay_data[0]['pay_type']))[0]['pay_type_title'];

        if (count($pay_data) > 0 && $pay_data[0]['pay_sum'] > 0 && $pay_data[0]['pay_status'] == 'succeeded') {
            $query_products = "SELECT pp.product_price, pp.creat_date, pr.* FROM zay_pay_products pp 
                                LEFT JOIN zay_product pr on pr.id=pp.product_id
                                WHERE pp.pay_id='?'";
            $products = $this->getSelectArray($query_products, array($pay_data[0]['id']));

            /*
             * Работа с кассой
             */
            $connector = new CONNECTOR($business_check_appID, $business_check_secret);  //Создание экземпляра класса

            $connector->openShift(); // Выполнение открытия смены
            //var_dump($connector);
            //echo "<br/>\n";
            $goods = array();
            $total = 0;
            foreach ($itms as $value) {
                //$price = $value['product_price'];
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                } else {
                    $price = $value['price'];
                }
                $total += $price;
                foreach ($products as $p_value) {
                    if ($p_value['id'] == $value['id']) {
                        if ($p_value['tax'] > 0) {
                            $business_check_nds = $p_value['tax'];
                        }
                    }
                }

                $item_type = 4; // УСЛУГА по умолчанию
                $pay_descr = (strlen($itms['pay_descr']) > 0) ? $itms['pay_descr'] : ''; // это консультация
                if (strlen($pay_descr) > 0) {
                    $title = $itms['pay_descr'];
                    //$item_type = 4; // УСЛУГА
                } else {
                    //$item_type = 1; // Товар
                    $title = $value['title'];
                }

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

            //print_r($goods);
            //echo "billArray<br/>\n";
            $billArray = [// Массив с данными чека.
                "command" => [// Массив с данными команды.
                    "author" => "{$pay_type}", // (String) Имя кассира (Будет пробито на чеке). // Платеж через {$pay_type} на сайте {$_SERVER['SERVER_NAME']}
                    "smsEmail54FZ" => $_SESSION['user']['info']['email'], // (String) Телефон или e-mail покупателя.
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

            $connector->printBill($billArray); // Команда на печать чека прихода.

            $connector->closeShift(); // Выполнение закрытия смены
        }
    }

}
