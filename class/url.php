<?php

/*
 * Зазбираемся с URL адресом на сайте
 * $url = new url();
 * $url->request();
 * $url->getUrl(1); //получем данные
 * $url->getUrlId("_objID="); //получем id 
 */

/**
 * Description of url
 *
 * @author Victor Karavaev
 */
class url {

    //put your code here
    private $url = array();

    public function __construct() {
        
    }

    //фспомогательная функция
    private function RegexpEscape($str) {
        return preg_quote($str, '/');
    }

    //формируем url
    private function request() {
        $GetPage = array();
        $mRequestUri = $_SERVER["REQUEST_URI"];
        if ($mRequestUri == '/') {
            $mPageUrl = $mRequestUri;
        } else {
            if ($_SERVER['QUERY_STRING']) {
                $mPageUrl = preg_replace(array('/^\//', '/\/?\?' . $this->RegexpEscape($_SERVER['QUERY_STRING']) . '$/'), array('', ''), $mRequestUri) . '/';
            } else {
                $mPageUrl = preg_replace(array('/^\//', '/\/?\??$/'), array('', ''), $mRequestUri) . '/';
            }
        }
        
        $mPageUrl = explode('/', $mRequestUri);
        $GetPage[0] = $_SERVER['SERVER_NAME'];
        for ($i = 1; $i < count($mPageUrl); $i++) {
            $pageStr = $mPageUrl[$i];
            $pos = strripos($pageStr, '?');
            if ($pos !== false) {
                $getExp = explode('=', $pageStr);
                //print_r($getExp);
                //echo "--<br/>";
                $GetPage[$i] = $getExp[1];
            } 

        }
        
        // если нет заданных страниц то покажем главную Index
        if($GetPage[1] == ''){
            $GetPage[1] = 'index';
        }

        $this->url = $GetPage;
    }

    //получаем адрес $r - количественная
    public function getUrl($r = 0) {
        $this->request();
        //print_r($this->url);
        if (is_numeric($r)) {
            return $this->url[$r];
        }
        return FALSE;
    }

    //получить ID из URl где $drob - Разделитель, $r - количественная 
    public function getUrlId($drob, $r = 2) {
        $this->request();
        $id = @explode($drob, $this->getUrl($r));
        if (is_numeric($id[1])) {
            return $id[1];
        }
        return FALSE;
    }

}
