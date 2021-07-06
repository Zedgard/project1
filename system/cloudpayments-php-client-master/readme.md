# CloudPayments PHP Client Library

Клиент для платежного сервиса [CloudPayments](http://cloudpayments.ru/).
Позволяет обращаться к [API CloudPayments](http://cloudpayments.ru/Docs/Api) из кода на PHP.

## Установка
```bash
composer require cloudpayments/cloudpayments-php-client
```

## Использование
```php
$client = new \CloudPayments\Manager($publicKey, $privateKey);
$transaction = $client->chargeToken($amount, $currency, $accountId, $cardToken);

echo $transaction->getId();
```

## Передача чека в онлайн-кассу
```php
$items[] = array(
            "label" => 'Товар реальный', //наименование товара
            "price" => 30.00, //цена
            "quantity" => 3.00, //количество
            "amount" => 90.00, //сумма
            "vat" => 18, //ставка НДС
            "ean13" => '460123456789' //штрих-код, необязательный
);
$client->sendReceipt($inn, $invoiceId, $accountId, $items, $taxationSystem, $email, $phone);
```