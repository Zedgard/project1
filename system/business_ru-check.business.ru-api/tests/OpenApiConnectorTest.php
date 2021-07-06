<?php
/**
 * @author Kirill Silianov <kirill.silianov@gmail.com>
 * Date: 28.08.2017
 * Time: 9:53
 *
 * @version 0.2.3
 */

namespace test;

include "../OpenApiConnector.php";

use PHPUnit\Framework\TestCase;
use OpenApiConnector as CONNECTOR;

/**
 * Class OpenApiConnectorTest
 *
 * Набор для тестирования класса для интеграции с openAPI сервиса "Чеки-онлайн".
 */
class OpenApiConnectorTest extends TestCase
{
    /**
     * @var string APP_ID Идентификатор интеграции из личного кабинета.
     */
    const APP_ID = "d78c7aa5-9edb-4d99-8159-a5655c3a4d1f";

    /**
     * @var string SECRET_KEY Секретный ключ интеграции из личного кабинета.
     */
    const SECRET_KEY = "fMBRGdACY6LyqDKuk24wS7pv1cIgjE8n";

    /**
     * @var array $print_bill_data Тестовые данные для печати чека прихода и возврата прихода.
     */
    private $print_bill_data = [
        "command" => [
            "author" => "Тестовый кассир",
            "smsEmail54FZ" => "+79173446170",
            "c_num" => 1111222333,
            "payed_cash" => 0.00,
            "payed_cashless" => 1500.10,
            "goods" => [
                [
                    "count" => 2,
                    "price" => 500,
                    "sum" => 1000,
                    "name" => "Товар 1",
                    "nds_value" => 18,
                    "nds_not_aply" => false
                ],
                [
                    "count" => 1,
                    "price" => 500.10,
                    "sum" => 500.10,
                    "name" => "Товар 2",
                    "nds_value" => 18,
                    "nds_not_aply" => false
                ]
            ]
        ]
    ];

    /**
     * @var string $token Токен API.
     */
    private $token = "7e02ed6c-286b-4514-a7a7-9a75c6c9681e";

    /**
     * @var OpenApiConnector $connector Экземпляр тестируемого класса.
     */
    private $connector;

    /**
     * Метод, выполняемый перед всем тестовым набором.
     */
    public static function setUpBeforeClass()
    {
        print("Серия тестов началась.\n\n");
    }

    /**
     * Метод, выполняемый перед каждым тестом.
     * Создает экземпляр тестируемого класса.
     */
    public function setUp()
    {
        print("Новый тест начат.\n");

        $this->connector = new CONNECTOR();
    }

    /**
     * Метод для проверки работы PHPUnit.
     */
    public function testPHPUnit()
    {
        print("Проверка работы PHPUnit\n");
        self::assertTrue(true);
    }

    /**
     * Метод тестирует работу создаваемого класса.
     */
    public function testClassCreation()
    {
        print("Проверка работы конструктора\n");

        self::assertEquals($this->connector->getAppID(), self::APP_ID);
        self::assertEquals($this->connector->getSecretKey(), self::SECRET_KEY);
    }

    /**
     * Метод тестирует получение теокена API.
     */
    public function testGetToken()
    {
        print("Проверка получения нового токена\n");

        $token = $this->connector->getToken();

        self::assertFalse($this->token == $token);
        self::assertTrue(boolval($token));

        $this->token = $token;
    }

    /**
     * Метод тестирует открытие смены.
     */
    public function testOpenShift()
    {
        print("Проверка открытия смены\n");

        $request = json_decode($this->connector->openShift(), true);
        var_dump($request);

        self::assertTrue(isset($request["command_id"]) && is_integer($request["command_id"]));
    }

    /**
     * Метод тестирует выполнение печати чека.
     */
    public function testPrintBill()
    {
        print("Проверка печати чека\n");

        $request = json_decode($this->connector->printBill($this->print_bill_data), true);

        var_dump($request);

        self::assertTrue(isset($request["command_id"]) && is_integer($request["command_id"]));
    }

    /**
     * Метод тестирует выполнение печати чека возврата прихода.
     */
    public function testPrintRefundBill()
    {
        print("Проверка печати чека возврата прихода\n");

        $request = json_decode($this->connector->printRefundBill($this->print_bill_data), true);

        var_dump($request);

        self::assertTrue(isset($request["command_id"]) && is_integer($request["command_id"]));
    }

    /**
     * Метод тестирует получение состояния системы.
     */
    public function testGetSystemStatus()
    {
        print("Проверка функции получения информации о системе\n");

        $request = json_decode($this->connector->getSystemStatus(), true);
        var_dump($request);

        self::assertTrue(is_array($request) && isset($request["date_last_connect_app"]) && $request["date_last_connect_app"] != null);
    }

    /**
     * Метод теститрует выполнение закрытия смены.
     */
    public function testCloseShift()
    {
        print("Проверка закрытия смены\n");

        $request = json_decode($this->connector->closeShift(), true);

        var_dump($request);

        self::assertTrue(isset($request["command_id"]) && is_integer($request["command_id"]));
    }

    /**
     * Метод выполняется перед каждым тестом.
     */
    public function tearDown()
    {
        print("Тест закончен.\n\n");
    }

    /**
     * Метод выполняется после выполнения всего тестового набора.
     */
    public static function tearDownAfterClass()
    {
        print("Очередь тестов закончена\n");
    }
}
