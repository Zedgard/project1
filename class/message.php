<?php

/*
 * Всплывающие сообщения
 */

class message {

    private $text;
    private $count = 0;

    /*
     * creatMessage($text, $action)
     * Создаем сообщение где
     * $text - текст сообщение
     * $type - тип сообщение
     * n = нейтральное (по умолчанию)
     * y = положительное
     * e = отрицательное
     */

    public function getCount(){
        return $this->count;
    }
    public function setMessage($text, $type) {
        $this->creatMessage($text, $type);
    }

    public function creatMessage($text, $type) {
        if ($type == '') {
            $type = 'n';
        }
        if ($type == 'n') {
            $style = 'class="alert alert-info"';
        }
        if ($type == 'e') {
            $style = 'class="alert alert-error"';
        }
        if ($type == 'y') {
            $style = 'class="alert alert-success"';
        }
        if ($this->text == '') {
            $this->text = "<div style=\"margin: 2px;padding: 5px;\" {$style}><a class=\"close\" data-dismiss=\"alert\">×</a>{$text}</div>";
        } else {
            $this->text = $this->text . "<div style=\"margin: 2px;padding: 5px;\" {$style}><a class=\"close\" data-dismiss=\"alert\">×</a>{$text}</div>";
        }
        if ($this->text != '') {
            $this->count = $this->count + 1;
        }
        $_SESSION['message'] = $this->text;
    }

    public function showMessage() {
        if ($_SESSION['message'] != '') {
            $message = $_SESSION['message'];
        }
        $this->destroyMessage();
        return $message;
    }

    private function destroyMessage() {
        $this->text = '';
        $this->count = 0;
        $_SESSION['message'] = '';
        unset($_SESSION['message']);
    }

}