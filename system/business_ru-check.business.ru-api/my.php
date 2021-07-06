<?php

include "OpenApiConnector.php"; // Импорт файла с классом

use OpenApiConnector as CONNECTOR;

$connector = new CONNECTOR('4568eed4-987a-4e63-9cfb-48d10c8e742e','gUY41wbScaoMvkZNl3OmxTChBz2pALWn'); //  '874980db-1b77-4839-808f-14678cd3b4ed','2anLPvopbtfdHSMmgIKeDwlqXFjQyAEc' //Создание экземпляра класса

echo "connector: <br/>\n";
var_dump($connector);
echo "<br/>\n";
echo "getSystemStatus: <br/>\n";
var_dump($connector->getSystemStatus());
echo "<br/>\n";
$connector->openShift(); // Выполнение открытия смены
//
$billArray = [ // Массив с данными чека.
    "command" => [ // Массив с данными команды.
        "author" => "Тестовый кассир", // (String) Имя кассира (Будет пробито на чеке).
        "smsEmail54FZ" => "+79173446170", // (String) Телефон или e-mail покупателя.
        "c_num" => 1111222333, // (int) Номер чека.
        "payed_cash" => 0.00, // (float) Сумма оплаты наличными (Не более 2-х знаков после точки).
        "payed_cashless" => 1500.10 , // (float) Сумма оплаты безаличным рассчетом (Не более 2-х знаков после точки).
        "goods" => [ // Массив с позициями в чеке.
            [
                "count" => 2, // (float) Количество товара (Не более 3-х знаков после точки).
                "price" => 500, // (float) Стоимость товара (Не более 2-х знаков после точки).
                "sum" => 1000, // (float) Сумма товарной позиции (Не более 2-х знаков после точки).
                "name" => "Товар 1", // (String) Наименование товара (Будет пробито на чеке).
                "nds_value" => 18, // (int) Значение налога.
                "nds_not_apply" => false // (bool) Используется ли НДС для товара.
            ],
            [
                "count" => 1,
                "price" => 500.10,
                "sum" => 500.10,
                "name" => "Товар 2",
                "nds_value" => 18,
                "nds_not_apply" => true
            ]
        ]
    ]
];
echo "<br/>\nprintBill:  ";
var_dump($connector->printBill($billArray)); // Команда на печать чека прихода.
//
$connector->closeShift(); // Выполнение закрытия смены