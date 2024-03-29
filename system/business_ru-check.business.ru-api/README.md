# Класс для интеграции с сервисом Бизнес.Ру "Онлайн-чеки". #

## Установка ##

1. Скопируйте файл "OpenApiConnection.php" на свой сервер.
2. Импортируйте класс в код приложения.
3. Если app_id и secret_key будет храниться на стороне вашего приложения, при создании объекта класса необходимо будет передать их параметрами, иначе измените соответствующие константы класса "STATIC_APP_ID" и "STATIC_SECRET_KEY" на свои.

## Принцип работы ##

Класс реализует следующие методы:
* openShift - Выполнить открытие смены;
* closeShift - Выполнить закрытие смены;
* printBill - Выполнить печать чека прихода;
* printRefundBill - Выполнить печать чека возврата прихода;
* getSystemStatus - Получить состояние системы.

## Примеры использования ##

### Открытие смены ###
```php
<?php

include "OpenApiConnector.php"; // Импорт файла с классом
use OpenApiConnector as CONNECTOR;

$connector = new CONNECTOR(); // Создание экземпляра класса
$connector->openShift(); // Выполнение открытия смены
```

### Закрытие смены ###
```php
<?php

include "OpenApiConnector.php"; // Импорт файла с классом
use OpenApiConnector as CONNECTOR;

$connector = new CONNECTOR(); // Создание экземпляра класса
$connector->closeShift(); // Выполнение закрытия смены
```

### Печать чека прихода ###

```php
<?php

include "OpenApiConnector.php"; // Импорт файла с классом.
use OpenApiConnector as CONNECTOR;

$connector = new CONNECTOR(); // Создание экземпляра класса.

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

$connector->printBill($billArray); // Команда на печать чека прихода.
```

### Печать чека возврата прихода ###
```php
<?php

include "OpenApiConnector.php"; // Импорт файла с классом.
use OpenApiConnector as CONNECTOR;

$connector = new CONNECTOR(); // Создание экземпляра класса.

$billArray = [ // Массив с данными чека.
    "command" => [ // Массив с данными команды.
        "author" => "Тестовй кассир", // (String) Имя кассира (Будет пробито на чеке).
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

$connector->printRefundBill($billArray); // Печать чека возврата прихода.
```
