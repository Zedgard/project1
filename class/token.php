<?php

namespace project;

/*
 * Создание и проверка токена
 */

// Для проверки
if ($_SESSION['DEBUG'] == 1) {
//echo "token_hash: {$_SESSION['token_hash']} <br/>\n";
    if (isset($_GET['token_kill'])) {
        $_SESSION['token_hash'] = '';
        $_SESSION['token_data'] = '';
    }
}

/**
 * Встроеный токен 
 */
class token {

    private $token_key;
    private $token_hash;
    private $token_data;

    /**
     * Токен системы
     */
    public function __construct() {
        $this->token_data = $_SESSION['token_data'];
        return true;
    }

    /**
     * Получить сгенерированный токен системы
     * @return type
     */
    public function register() {
        $timer = time();
//echo "session_time: {$_SESSION['site_time']} \n";
        $t_start = ($_SESSION['site_time'] + 3);
//echo ' ' . $t_start .' < ' . $timer . "\n";
        if ($t_start < $timer) {
            $this->token_key = random_int(1000, 9999) . uniqid();
            $this->token_hash = md5($this->token_key);
            if (strlen($this->token_hash) > 0) {
                $_SESSION['token_hash'] = $this->token_hash;
                return true;
            }
        }
        return false;
    }

    /**
     * Получить сгенерированный токен системы
     * @return type
     */
    public function get() {
        return $this->token_hash;
    }

    /**
     * Занести значение в токен
     * @param type $token_hash
     * @param type $data_key
     * @param type $data_value
     * @return boolean
     */
    public function setData($token_hash, $data_key, $data_value) {
        if ($token_hash == $this->token_hash) {
            $this->token_data[$data_key] = $data_value;
            $_SESSION['token_data'] = $this->token_data;
            return true;
        }
        return false;
    }

    /**
     * Получить массив значений токена
     * @param type $token_hash
     * @return type
     */
    public function getDataArray($token_hash) {
        if ($token_hash == $this->token_hash) {
            return $this->token_data;
        }
        return array();
    }

    /**
     * Получить значение из токена по ключу
     * @param type $token_hash
     * @param type $data_key
     * @return string
     */
    public function getDataKey($token_hash, $data_key) {
        if ($token_hash == $this->token_hash) {
            if (strlen($data_key) > 0) {
                return $this->token_data[$data_key];
            }
        }
        return '';
    }

    /**
     * Колличество зарегистрированных данных
     * @param type $token_hash
     * @return int
     */
    public function count($token_hash) {
        if ($token_hash == $this->token_hash) {
            return count($this->token_data);
        }
        return 0;
    }

    /**
     * Javascript скрипт 
     * @return type
     */
    public function javascript() {
        ob_start();
        if (!isset($_SESSION['token_hash']) || strlen($_SESSION['token_hash']) == 0) {
            ?>
            <script>
                var token = 0;
                $(document).ready(function () {
                    setTimeout(function () {
                        var h = window.screen.availHeight;
                        var w = window.screen.availWidth;
                        $.ajax({
                            url: '/jpost.php',
                            method: 'POST',
                            dataType: 'json',
                            data: {t: '1', 'h': h, 'w': w},
                            success: function (data) {
                                //console.log(data['t']);
                                token = 1;
                            }
                        });
                    }, 1000);
                });
            </script>
            <?

        } else {
            ?>
            <script>
                var token = 1;
            </script>
            <?
        }
        return ob_get_clean();
    }
}
