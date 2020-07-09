<?php

class city {

    //определить город
    public function detect_city($ip = '') {
        if ($ip == '') {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $default = 'Владивосток';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U;
        Windows NT 5.1; en-US; rv:1.9.2)
        Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';

        $url = 'http://ipgeobase.ru/?address=' . urlencode($ip);
        $ch = curl_init();

        $curl_opt = array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => $curlopt_useragent,
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 1,
            CURLOPT_REFERER => 'http://' . $_SERVER['HTTP_HOST'],
        );

        curl_setopt_array($ch, $curl_opt);

        $content = curl_exec($ch);

        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }

        curl_close($ch);

        if (preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs)) {
            $city = $regs[1];
        }
        if (preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs)) {
            $state = $regs[1];
        }
        $content = iconv("windows-1251", "UTF-8", $content);
        $city = preg_match("!Город</td>(.*?)</tr>!si", $content, $matches) ? $matches[1] : '';
        $city = str_replace('<td>', '', $city);
        $city = str_replace("\n", '', $city);
        $city = str_replace("\r", '', $city);
        
        if ($city != '' && trim($city)!='UNKNOWN') {
            $location = trim($city);
            $_SESSION['city'] = $location;
            return $location;
        } else {
            return $default;
        }
    }

    public function getCityID() {
        $sql = new sql();
        $city = $sql->setSQL('city', 'city', $_SESSION['town']);
        return $city['id'];
    }

    public function getCityArr() {
        $sql = new sql();
        $where = '';
        $other = '';
        $arr = $sql->setSQLArray('city', $where, $other);
        return $arr;
    }

}
