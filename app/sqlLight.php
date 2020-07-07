<?php

/*
 * работа с базой данных
 */

//include $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class sqlLight {

    public $db_prefix;
    private $errArr = array();
    private $errCount;
    private $count = 0;
    private $conn;

    public function __construct() {
        return TRUE;
    }

    public function conect() {
        $url = str_replace('/app', '', dirname(__FILE__));
        include $url . '/config.php';
        $this->db_prefix = $cfg_db_prefix;
        $conn = mysqli_connect($cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name);
        $this->conn = $conn;
        //$conn = mysql_connect($cfg_db_host, $cfg_db_user, $cfg_db_pass);
        
        /* проверка соединения */
        if (mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s\n", mysqli_connect_error());
            $this->errArr[] = "Ошибка подключения к базе данных!";
            exit();
        }
        if (!$conn) {
            $this->errArr[] = "Ошибка подключения к базе данных!";
        }
        //mysql_select_db($cfg_db_name, $conn);
        //mysql_query("SET NAMES 'cp1251' ", $conn);
        mysqli_query($this->conn, "SET NAMES 'utf8'");
        return $conn;
    }

    public function getCount() {
        return $this->count;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    /**
     * Отправим запро к DB
     * @param string $query
     * @return boolian
     */
    public function query($query) {
        $ret = false;
        /* Включить режим фиксации */
        mysqli_autocommit($this->conn, FALSE);
        if (mysqli_query($this->conn, mysql_real_escape_string($query)) === TRUE){
            $ret = true;
        }
        // Commit transaction
        mysqli_commit($this->conn);
        return $ret;
    }

    /**
     * Получить массив с данными из DB
     * @param string $query
     * @return boolian
     */
    public function queryList($query) {
        $this->setCount(0);
        $r = array();
        $buffer = array();
        $i = 0;
        //echo 'Query: ' . $query . "<br/>";
        //$q = mysqli_query($this->conn, $query);
        
        $col = 0;
        if ($result = mysqli_query($this->conn, mysql_real_escape_string($query))) {
            //printf("Select вернул %d строк.\n", mysqli_num_rows($result));
            $col = mysqli_num_rows($result);
            /* очищаем результирующий набор */
            //mysqli_free_result($result);
        }


        //print_r($q); 
        //echo "G: " . count($q) .  " <br/>";
        if ($col > 0) {
            while ($r = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                $i++;
                $buffer[] = $r;
                //print_r($r);
                //echo "<br/>\n";
            } 
        }
//        if (count($q) > 0) {
//            while ($r = mysqli_fetch_array($q)) {
//                $i++;
//                $buffer[] = $r;
//            }
//        }
        
        /* очищаем результаты выборки */
        if($col > 0){
            mysqli_free_result($result);
        }
        
        $this->setCount($i);
        return $buffer;
    }

    public function queryNumRows() {
        $col = 0;
        $q = mysqli_query($this->conn, mysql_real_escape_string($query));
        $c = mysqli_num_rows($q);
        if ($c > 0) {
            $col = $c;
        }
        mysqli_free_result($q);
        mysqli_free_result($c);
        return $col;
    }

    public function close() {
        $this->setCount(0);
        //@mysql_close();
        mysqli_close($this->conn);
    }

}
