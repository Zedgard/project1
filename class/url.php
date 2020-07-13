<?php

namespace project;

/**
 * Работа с URL строкой
 * $url = new \project\url();<br>
 * $url->request();<br>
 *
 * echo $url->getParam(2);<br>
 * echo $url->getTag('id');<br>
 * print_r($_SESSION['url']);<br>
 */
class url {

    //put your code here
    private $url = array();

    public function __construct() {
        
    }

    /**
     * Вспомогательная функция
     * @param type $str
     * @return type
     */
    private function RegexpEscape($str) {
        return preg_quote($str, '/');
    }

    /**
     * формируем url
     */
    public function request() {
        $_SESSION['url'] = array();
        $GetPage = array();
        $mRequestUri = $_SERVER["REQUEST_URI"];
        if ($mRequestUri == '/') {
            $mPageUrl = $mRequestUri;
        } else {
            if ($_SERVER['QUERY_STRING']) {
                preg_replace(array('/^\//', '/\/?\?' . $this->RegexpEscape($_SERVER['QUERY_STRING']) . '$/'), array('', ''), $mRequestUri) . '/';
            } else {
                preg_replace(array('/^\//', '/\/?\??$/'), array('', ''), $mRequestUri) . '/';
            }
        }

        $mPageUrl = explode('/', $mRequestUri);
        //print_r($mPageUrl);
        //echo "<br>\n";
        $mPageUrl[0] = $_SERVER['SERVER_NAME'];

        for ($i = 1; $i < count($mPageUrl); $i++) {
            $pageStr = $mPageUrl[$i];
            //echo "{$pageStr} <br>\n";

            $pos = strpos($pageStr, '?');
            if ($pos !== false) {
                $post = array();
                //echo "ok {$pos}<br>\n";
                $getExp = explode('=', $pageStr);
                $getExp[0] = str_replace('?', '', $getExp[0]);
                //print_r($getExp);
                //echo "getExp: {$getExp} <br>\n";
                //$post[$getExp[0]] = $getExp[1];
                $mPageUrl[$i] = array($getExp[0] => $getExp[1]);
            }
        }
        $_SESSION['url'] = $mPageUrl;

        // если нет заданных страниц то покажем главную Index
        if ($GetPage[1] == '') {
            $GetPage[1] = 'index';
        }

        $this->url = $GetPage;
    }

    /**
     * Получить массив ссылок
     * @param type $r
     * @return array
     */
    public function getArray($r = 0) {
        return $_SESSION['url'][$r];
    }

    /**
     * Получить значение по номеру
     * @param type $r
     * @return string
     */
    public function getParam($r = 0) {
        if (is_numeric($r)) {
            return $_SESSION['url'][$r];
        }
        return '';
    }

    /**
     * Получить значение GET тэга
     * @param type $tag
     * @return string
     */
    public function getTag($tag) {
        foreach ($_SESSION['url'] as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $tagKey => $tagValue) {
                    if ($tagKey == $tag) {
                        return $tagValue;
                    }
                }
            }
        }
        return '';
    }

}
