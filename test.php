<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0", false);
header("Cache-Control: max-age=0", false);
header("Pragma: no-cache");

/*
  Предположим, что перед нами стоит задача обработать HTTP запрос или ответ от стороннего API, содержащий данные в формате JSON.
  Нужно написать библиотеку "санитайзер", которая занимается валидацией и нормализацией данных в соответствии с переданной спецификацией.


  Требования:

  - Самостоятельное выполнение задания без оглядки на существующие решения

  - Язык PHP 7.1+ без сторонних библиотек (кроме библиотек для тестирования)

  - Поддержка следующих типов данных:
  - Строка
  - Целое число
  - Число с плавающей точкой
  - Российский федеральный номер телефона
  - Массив с элементами одного фиксированного поддерживаемого типа
  - Структура (ассоциативный массив с заранее известными ключами)

  - Возможность расширения путём добавления поддержки новых типов

  - Генерация списка всех ошибок для некорректных значений. Формат описания ошибок должен предоставлять возможность сопоставить каждую ошибку с исходным значением.
  Например, если входные данные были сгенерированы на основе HTML-формы с вложенными (табличными) полями,
  должно быть технически возможно сопоставить каждую ошибку конкретному полю формы.

  - Тесты


  Примеры:

  1. из JSON '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23"}'
  при указанных программистом типах полей "целое число", "строка" и
  "номер телефона" соответственно должен получиться ассоциативный массив с тремя полями:
  целочисленным foo = 123, строковым bar = "asd" и строковым "baz" = "79502885623".

  2. при указании для строки "123абв" типа "целое число" должна быть сгенерирована ошибка

  3. при указании для строки "260557" типа "номер телефона" должна быть сгенерирована ошибка
 */

/*
 * ---------------------------------- CLASS ------------------------------------
 */
class json_parse {

    private $json;
    private $main_json;
    private $result_json = array();
    private $errors = array();
    private $_types = array(
        'string' => '/^[\W_-]+$/',
        'integer' => '/^\d+$/',
        'double' => '/^\-?\d+(\.\d{0,})?$/',
        'phone' => '/^\d{1,3}\s?\(\d{3}\)\s?\d{3}(-\d{2}){2}$/',
        'array' => '/^_array/',
        'struct' => '/^_struct/',
    );
    private $type;

    /**
     * Example:<br>
     * $json = new json_parse($main_json, $json_str);<br>
     * $data = $json->parse();<br>
     * @param type $main_json
     * @param type $str
     */
    public function __construct($main_json, $str) {
        $this->result_json = array();
        $this->errors = array();
        if ($this->isJson($str)) {
            $this->json = json_decode($str);
            $this->main_json = $main_json;
        } else {
            $this->set_errors('Json строка не корректна!');
        }
    }

    /**
     * Parse
     * @return type
     */
    public function parse() {
        if (count($this->errors) == 0) {
            foreach ($this->json as $key => $value) {
                foreach ($this->main_json as $k => $v) {
                    if ($key == $v['row']) {
                        if ($this->check_type($v['type'], $value)) {
                            switch ($this->type) {
                                // processing hard 
                                case 'array':
                                    $this->result_json[$k] = $this->parse_row_array($value);
                                    break;
                                case 'struct':
                                    $this->result_json[$k] = $this->parse_row_struct($value);
                                    break;
                                // processing simple
                                default:
                                    $this->result_json[$k] = $value;
                                    break;
                            }
                        } else {
                            $this->set_errors("Проблема в поле \"{$key}\", не верные данные!");
                        }
                    }
                }
            }
        }

        return $this->result_json;
    }

    /**
     * Parse row array
     * @param type $v
     * @return type
     */
    private function parse_row_array($v) {
        $ret = array();
        $str = preg_replace('/^_array\[|\]/', '', $v);
        try {
            $exp = explode(',', $str);
            foreach ($exp as $value) {
                $ret[] = $this->replace_apostrof($value);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ret;
    }

    /**
     * Parse row struct
     * @param type $v
     * @return type
     */
    private function parse_row_struct($v) {
        $ret = array();
        $str = preg_replace('/^_struct\[|\]/', '', $v);
        try {
            $exp1 = explode(',', $str);
            for ($i = 0; $i < count($exp1); $i++) {
                $exp2 = explode(':', $exp1[$i]);
                $ret[] = array($this->replace_apostrof($exp2[0]) => $this->replace_apostrof($exp2[1]));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ret;
    }

    /**
     * Replace apostrof
     * @param type $v
     * @return type
     */
    private function replace_apostrof($v) {
        return str_replace("'", '', trim($v));
    }

    /**
     * Check type
     * @param type $type
     * @param type $val
     * @return boolean
     */
    private function check_type($type, $val) {
        foreach ($this->_types as $key => $value) {
            if ($type == $key) {
                if (preg_match($value, $val)) {
                    $this->type = $key;
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Test json
     */
    private function isJson($str) {
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Set error
     * @param type $t
     */
    private function set_errors($t) {
        $this->errors[] = $t;
    }

    /**
     * Get errors
     * @return type
     */
    public function get_errors() {
        return $this->errors;
    }

    /**
     * Show errors
     */
    public function show_error() {
        if (count($this->get_errors()) > 0) {
            foreach ($this->get_errors() as $value) {
                echo "{$value}<br/>\n";
            }
        }
    }

}

/*
 * --------------------------------- EXECUTE -----------------------------------
 */

/*
 * Исходный json
 */
$json_str = '{"First_name": "Виктор", "Last_name": "Караваев", "Total": "123", "Phone": "8 (950) 288-56-23", '
        . '"array_data":"_array[\'9\',8,7,6,5, 4,3,2,1]", '
        . '"struct_data":"_struct[\'key_1\':\'val_1\',\'key_2\':\'val_2\']"}';

/*
 * Нужный нам формат данных
 */
$main_json = array(
    'Фамилия' => array(
        'row' => 'Last_name',
        'type' => 'string',
    ),
    'Зарплата' => array(
        'row' => 'Total',
        'type' => 'integer',
    ),
    'Телефон' => array(
        'row' => 'Phone',
        'type' => 'phone',
    ),
    'массив' => array(
        'row' => 'array_data',
        'type' => 'array',
    ),
    'структура' => array(
        'row' => 'struct_data',
        'type' => 'struct',
    )
);

/*
 * Обработка
 */
$json = new json_parse($main_json, $json_str);
$data = $json->parse();

/*
 * Результат
 */
if (count($json->get_errors()) == 0) {
    ?>
    <div>Необходимо позвонить '<?= $data['Фамилия'] ?>' по трудоустроиству по номеру телефона: <strong><?= $data['Телефон'] ?></strong> <br/></div>
    <div>Массив: <? print_r($data['массив']) ?></div>
    <div>Труктура: <? print_r($data['структура']) ?></div>
    <div>Данные со структуры: <?= $data['структура'][0]['key_1'] ?></div>
    <?
} else {
    ?>
    <div>Ошибки:</div>
    <div style="color: red;"><? $json->show_error() ?></div>
    <?
}

//print_r($data);


