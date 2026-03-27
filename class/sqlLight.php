<?php

namespace project;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

/**
 * Запросы к базе данных
 * 
 * $sqlLight = new \project\sqlLight();<br/>
 * <br/>
 * $query = "SELECT * FROM `table`";<br/>
 * $objs = $sqlLight->queryList($query);<br/>
 * if ($sqlLight->getCount() > 0) {<br/>
 *  <br/>
 * }<br/>
 */
class sqlLight {

    public $db_prefix;
    private $errArr = array();
    private $count = 0;
    private $htmlspecialchars_true = 1;
    /* @var $mysqli new mysqli */
    private $mysqli;
    private $MYSQLI_TYPE = MYSQLI_ASSOC; // MYSQLI_BOTH MYSQLI_ASSOC

    public function __construct() {
        $this->conect();
    }

    public function conect() {

        global $lang;
        global $cfg_db_prefix, $cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name;
        //include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
        $this->db_prefix = $cfg_db_prefix;
        $this->mysqli = new \mysqli('p:'.$cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name);

        /* проверка соединения */
        if ($this->mysqli->connect_errno) {
            printf("{$lang['sql_connect_error']} %s\n", $mysqli->connect_error);
            $this->errArr[] = $lang['sql_connect_error'];
            exit();
        }

        if (!$this->mysqli) {
            $this->errArr[] = $lang['sql_connect_error'];
        }

        //mysql_query("SET NAMES 'cp1251' ", $conn);
        if ($this->mysqli->query("SET NAMES 'utf8'") === FALSE) {
            echo "{$lang['sql_set_names_true']}\n";
        }

        return $this->mysqli;
    }

    public function getCount() {
        return $this->count;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    /**
     * Отключить преобразование HTML сущности, передать 0
     * @param type $v = 1 по умолчанию
     */
    public function setHtmlspecialchars($v = 1) {
        $this->htmlspecialchars_true = $v;
    }

    /**
     * Замена по очереди вхождений строки
     * @param type $search
     * @param type $replace
     * @param type $text
     * @return type
     */
    private function str_replace_once($search, $replace, $text) {
        //echo "text: {$text} \n";
        $pos = strpos($text, $search);
        return $pos !== false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
    }

    /**
     * Отправим запроса к DB
     * @param string $query
     * @return boolian
     */
    public function query($query, $values = array(), $see = 0) {
        $ret = false;
        $log_file = $_SERVER['DOCUMENT_ROOT'] . '/logs/query.log';
        if (strlen($query) > 0) {
            global $lang;

            // Защитим от иньекций
            foreach ($values as $value) {
                $value = $this->mysqli->real_escape_string($value);
                $query = $this->str_replace_once('?', '|^^^|', $query);
            }
            if (count($values) > 0) {
                foreach ($values as $value) {
                    $value = $this->mysqli->real_escape_string($value);
                    if ($this->htmlspecialchars_true == 1) {
                        $value = htmlspecialchars($value, ENT_QUOTES);
                    }
                    $query = $this->str_replace_once('|^^^|', $value, $query);
                }
            }

            /* Включить режим фиксации */
            $this->mysqli->autocommit(TRUE);
            //echo "query: {$query} <br/>\n";
            if ($see != 0) {
                echo "query: {$query} <br/>\n";
            } else {
                //$_SESSION['errors'][] = $query;
            }
            if ($this->mysqli->query($query) === FALSE) {
                $time = date("d-m-Y H:i:s");
                fileSet($log_file, "{$time} {$this->mysqli->errno}\n{$this->mysqli->error}\n{$query}\n", 'a+');
                if ($_SESSION['DEBUG'] == 1) {
                    $_SESSION['errors'][] = "{$this->mysqli->errno} {$this->mysqli->error}<br/>\n{$query}<br/>\n";
                } else {
                    $this->errArr[] = $lang['sql_query_false'];
                }
            } else {
                /* Фиксировать транзакцию */
                if (!$this->mysqli->commit()) {
                    if ($_SESSION['DEBUG'] == 1) {
                        $_SESSION['errors'][] = "{$this->mysqli->errno} {$this->mysqli->error}\n";
                    } else {
                        $this->errArr[] = $lang['sql_query_commit_false'];
                    }
                } else {
                    $ret = true;
                }
            }
        }
        return $ret;
    }

    /**
     * Получить массив с данными из DB
     * @param string $query
     * @return boolian
     */
    public function queryList($query, $values = array(), $see = 0) {
        global $lang;
        $this->setCount(0);
        $buffer = array();
        $i = 0;

        // Защитим от инъекций

        if (count($values) > 0) {
            foreach ($values as $v) {
                $v = $this->mysqli->real_escape_string($v);
                $query = $this->str_replace_once('?', $v, $query);
            }
        }

        if ($see != 0) {
            echo "query: {$query} <br/>\n";
        } else {
            //$_SESSION['errors'][] = $query;
        }
        /* Select запросы возвращают результирующий набор */
        try {
            if ($result = $this->mysqli->query($query)) {
                $this->count = $result->num_rows;
                while ($row = $result->fetch_array($this->MYSQLI_TYPE)) {
                    $bufferRow = array();
                    $i++;
                    foreach ($row as $key => $value) {
                        if ($this->htmlspecialchars_true == 1) {
                            $bufferRow[$key] = htmlspecialchars_decode($value, ENT_QUOTES);
                        } else {
                            $bufferRow[$key] = $value;
                        }
                    }
                    $buffer[] = $bufferRow;
                }
                $result->free();
            } else {
                if ($_SESSION['DEBUG'] == 1) {
                    //echo "{$this->mysqli->errno} {$this->mysqli->error}\n";
                    $_SESSION['errors'][] = "{$this->mysqli->errno} {$this->mysqli->error}\n query: {$query} <br/>\n";
                } else {
                    echo $lang['sql_query_commit_false'];
                }
            }
        } catch (Exception $exc) {
            $_SESSION['errors'][] = $exc->getTraceAsString();
        }

        $this->setCount($i);
        return $buffer;
    }

    public function queryNextId($table_name) {
        global $cfg_db_name;
        $query = "SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_SCHEMA='?' AND table_name = '?'";
        return $this->queryList($query, array($cfg_db_name, $table_name))[0]['AUTO_INCREMENT'];
    }

    /**
     * Возвращаем html тэги
     * @param type $str
     * @return type
     */
    public function getNormalHTML($str) {
        return htmlspecialchars_decode($str, ENT_QUOTES);
    }

    /**
     * Преобразует строку в спец символы
     * @param type $str
     * @return type
     */
    public function setSpecialcharsHtml($str) {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    // MYSQLI_ASSOC вернуть без нумераций
    public function setMysqliAssos() {
        $this->MYSQLI_TYPE = MYSQLI_ASSOC;
    }

    public function close() {
        $this->setCount(0);
        $this->mysqli->close();
    }

    public function __destruct() {
        $this->close();
    }

    /**
     * Получить массив ошибок
     * @return array
     */
    public function errors() {
        return $this->errArr;
    }

}
