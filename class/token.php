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
        $t = time();
        //echo ' ' . $_SESSION['time'] .' < ' .$t . "\n";
        if (($_SESSION['time'] + 3) < $t) {
            $this->token_key = random_int(1000000000, 9999999999);
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
        if (strlen($_SESSION['token_hash']) == 0) {
            ob_start();
            ?>
            <script>
                $(document).ready(function () {
                    setTimeout(function () {
                        $.ajax({
                            url: '/jpost.php',
                            method: 'POST',
                            dataType: 'json',
                            data: {t: '1'},
                            success: function (data) {
                                console.log(data['t']);
                            }
                        });
                    }, 3000);
                });
            </script>
            <?

            return ob_get_clean();
        }
    }

}
