<?php

class menu {

    private $class = "nav nav-pills nav-stacked";
    private $url;
    private $arrayList;
    private $rootDir = '/';

    public function __construct() {
        return TRUE;
    }

    //показать меню
    public function show() {
        $menu = $this->generate();
        return $menu;
    }

    //стиль отображения меню
    public function setClass($v) {
        if (trim($v) != '') {
            $this->class = $v;
        }
    }

    //массив с меню array("/"=>"Главная");
    public function setMenuArray($v) {
        if (is_array($v)) {
            $this->arrayList = $v;
        }
    }

    //адрес на котором находимся
    public function setUrl($v) {
        $this->url = $v;
    }

    public function setRootDir($v) {
        $this->rootDir = $v;
    }

    //создаем меню
    private function generate() {
        $buff = array();
        $buff[] = "<ul class=\"{$this->class}\">";
        if (is_array($this->arrayList) && count($this->arrayList) > 0) {
            foreach ($this->arrayList as $key => $value) {
                $key = substr($key, 1);
                $server = "http://{$_SERVER['SERVER_NAME']}";
                $url = $_SERVER['REQUEST_URI'];
                $c = '';
                $k = str_replace("/", "", $key);
                if ($k == $this->rootDir) {
                    $buff[] = "<li><a href=\"{$this->rootDir}\">{$value}</a></li>";
                } elseif ($k == $this->url) {
                    $c = "class=\"active\"";
                    $buff[] = "<li {$c}><a href=\"{$server}{$this->rootDir}{$key}\">{$value}</a></li>";
                } else {
                    //$r = "{$key} == {$this->url}";
                    $buff[] = "<li {$c}><a href=\"{$server}{$this->rootDir}{$key}\">{$value}</a></li>";
                }
            }
        }
        $buff[] = "</ul>";
        return implode('', $buff);
    }

}