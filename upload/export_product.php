<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/upload/PHPExcel/Classes/PHPExcel.php';


//$sqlLight = new \project\sqlLight();
// Вычищает лишние пробелы в строке.
function tab_replace($v) {
    return preg_replace('/\s+/', '', $v);
}

// Чистим кавычки
function tab_tag($v) {
    return str_replace('"', '', $v);
}

/**
 * Добавление информации по товару
 * @param type $title
 * @param type $descr
 * @param type $ex_code
 * @param type $articul
 * @param type $images
 * @param type $url_file
 * @param type $active
 * @param type $lastdate
 * @param type $is_delete
 * @return boolean
 */
function product_add($title, $descr, $ex_code, $articul, $images, $url_file, $active, $creat_date, $lastdate, $is_delete, $url_old_site) {
    $sqlLight = new \project\sqlLight();
    $querySelect = "SELECT * FROM `zay_wares` WHERE `ex_code`='?'";
    $wares = $sqlLight->queryList($querySelect, array($ex_code));
    if (count($wares) > 0) {
        $qu = "UPDATE `zay_wares` SET `title`='?',`descr`='?',"
                . "`articul`='?',"
                . "`images`='?',`url_file`='?',`active`='?',"
                . "`lastdate`='?',`is_delete`='?', `url_old_site`='?'"
                . "WHERE `id`='?' and `ex_code`='?'";
        return $sqlLight->query($qu, array($title, $descr, $articul, $images, $url_file, $active, $lastdate, $is_delete, $url_old_site, $wares[0]['id'], $ex_code));
    } else {
        $qi = "INSERT INTO `zay_wares`(`title`, `descr`, `col`, `ex_code`, `articul`, `images`, `url_file`, `active`, `creat_date`, `lastdate`, `is_delete`, `url_old_site`) "
                . "VALUES ('?','?','?','?','?','?','?','?','?','?','?','?')";
        return $sqlLight->query($qi, array($title, $descr, '0', $ex_code, $articul, $images, $url_file, $active, $creat_date, $lastdate, $is_delete, $url_old_site));
    }
    return false;
}

/**
 * Загрузка файла со сороннего сайта
 * @param type $file_path
 * @return boolean
 */
function get_img_file($file_path) {
    // папка с файлами
    $url_export_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/files/image/export/';
    //$file_path = 'https://download.edgardzaitsev.com/wp-content/uploads/2020/05/1.png';
    $file_name = array_reverse(explode('/', $file_path))[0];
    //echo "file_name: {$file_name}";
    if (!is_file($url_export_dir . $file_name)) {
        return file_put_contents($url_export_dir . $file_name, file_get_contents($file_path));
    }
    return false;
}

/**
 * Загрузка файла со сороннего сайта
 * @param type $file_path
 * @return boolean
 */
function get_file($file_path) {
    // папка с файлами
    $url_export_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/files/files/';
    //$file_path = 'https://download.edgardzaitsev.com/wp-content/uploads/2020/05/1.png';
    $file_name = array_reverse(explode('/', $file_path))[0];
    echo "file_name: {$file_name} <br>\n";

    // Исключения
    $array_not_upload = array(
        'zapis-onlajn-treninga-moya-dostojnaya-zhizn.zip',
        'kejs-semejnye-stsenarii-kakih-muzhchin-ya-vybirayu-i-prityagivayu.zip',
        'audio-kniga-zanimatelnaya-psihologiya-dlya-bogatyh-i-znamenityh-i-teh-kto-hochet-stat-uspeshnym-2020.zip',
        'audio-kniga-skazka-pro-fedota-idiota-i-ivana-duraka.zip',
        'audio-kniga-molitva-zhelanij-9-shagov-na-puti-k-mechte-2020.zip',
        'kejs-besstrashnyj-zavistnik-kak-nachat-vkladyvat-v-sebya-i-perestat-razbazarivat-dengi.zip',
        'zapis-mini-treninga-bednyj-ya-bogatyj-ili-styd-byt-bogatym.zi',
        'zapis-vebinara-menya-zhdyot-uspeh-i-bogatstvo.zip'
    );
    if (!is_file($url_export_dir . $file_name) && !in_array($file_name, $array_not_upload)) {
        return file_put_contents($url_export_dir . $file_name, file_get_contents($file_path));
    }
    return false;
}

$url = $_SERVER['DOCUMENT_ROOT'] . '/upload/export_product1.xlsx';
//$file_str = fileGet($url);

$list = array(
    'ProductID', // 0
    'ProductSKU', // 1
    'ProductName', // 2
    'Permalink', // 3
    'Description', // 4
    'Visibility', // 5
    'Price', // 6
    'SalePrice', // 7
    'NetPrice', // 8
    'FeaturedImageTitle', // 9
    'DownloadFileURLPath', // 10
    'ProductStatus', // 11
    'EnableReviews', // 12
    'ProductPublished'
);



$Excel = PHPExcel_IOFactory::load($url);


$iter = 30;
$start = 0;
//$_SESSION['export_end'] = 0;
//$_SESSION['export_start'] = $start;
if (!isset($_SESSION['export_start'])) {
    $_SESSION['export_start'] = $start;
}
if (isset($_SESSION['export_end']) && $_SESSION['export_end'] > 0) {
    $_SESSION['export_start'] = $_SESSION['export_end'];
    $_SESSION['export_end'] = $iter + $_SESSION['export_end'];
} else {
    $_SESSION['export_end'] = $iter;
}

echo "export_start: {$_SESSION['export_start']} export_end:{$_SESSION['export_end']} <br/>\n";


$res = array();
$a = 0;
$iter_i = 0;
for ($i = $_SESSION['export_start']; $i <= $_SESSION['export_end']; $i++) {
    //$Row = new stdClass();
    // $Row->id = $i;
    // $title, $descr, $ex_code, $articul, $images, $url_file, $active, $creat_date, $lastdate, $is_delete, $url_old_site
    echo $i . "<br/>\n";
    $res[$a]['ex_code'] = $Excel->getActiveSheet()->getCell('C' . $i)->getValue();
    $res[$a]['articul'] = $Excel->getActiveSheet()->getCell('D' . $i)->getValue();
    $res[$a]['title'] = $Excel->getActiveSheet()->getCell('F' . $i)->getValue();
    $res[$a]['url_old_site'] = $Excel->getActiveSheet()->getCell('I' . $i)->getValue();
    $res[$a]['descr'] = $Excel->getActiveSheet()->getCell('J' . $i)->getValue();
    $c_date = $Excel->getActiveSheet()->getCell('L' . $i)->getValue();
    $c_date_ex = explode('/', $c_date);
    $res[$a]['creat_date'] = $c_date_ex[2] . '-' . $c_date_ex[1] . '-' . $c_date_ex[0];

    $l_date = $Excel->getActiveSheet()->getCell('M' . $i)->getValue();
    $l_date_ex = explode('/', $l_date);
    $res[$a]['lastdate'] = $l_date_ex[2] . '-' . $l_date_ex[1] . '-' . $l_date_ex[0];

//    if (trim($Excel->getActiveSheet()->getCell('O' . $i)->getValue()) == '') {
//        $res[$a]['active'] = 1;
//    } else {
//        $res[$a]['active'] = 0;
//    }
    
    if (trim($Excel->getActiveSheet()->getCell('BP' . $i)->getValue()) == 'Publish') {
        $res[$a]['active'] = 1;
    } else {
        $res[$a]['active'] = 0;
    }
    
    
    $res[$a]['price'] = $Excel->getActiveSheet()->getCell('S' . $i)->getValue();
    $res[$a]['url_file'] = trim($Excel->getActiveSheet()->getCell('AZ' . $i)->getValue());
    if (strlen($res[$a]['url_file']) > 0) {
        get_file($res[$a]['url_file']);
    }
    //$res[$a]['title'] = $Excel->getActiveSheet()->getCell('BP' . $i)->getValue();
//    if ($Excel->getActiveSheet()->getCell('BP' . $i)->getValue() == 'Publish') {
//        $res[$a]['active'] = 1;
//    } else {
//        $res[$a]['active'] = 0;
//    }
    $images_str = trim($Excel->getActiveSheet()->getCell('AO' . $i)->getValue());
    if (strlen($images_str) > 0) {
        $imgs = explode('|', $images_str);
        foreach ($imgs as $value) {
            get_img_file($value);
        }
    }
    $res[$a]['images'] = $imgs[0];

    if (product_add($res[$a]['title'], $res[$a]['descr'], $res[$a]['ex_code'], $res[$a]['articul'], $res[$a]['images'], $res[$a]['url_file'], $res[$a]['active'],
                    $res[$a]['creat_date'], $res[$a]['lastdate'], '0', $res[$a]['url_old_site'])) {
        echo "code: {$ex_code} ok <br/>\n";
    } else {
        echo "code: {$ex_code} not <br/>\n";
    }

    $a++;

    $iter_i = $i;
}
$_SESSION['export_start'] = $iter_i;
$_SESSION['export_end'] = $iter_i;


// SELECT * FROM `wp_posts` WHERE `post_type`='product' ORDER BY `wp_posts`.`ID` ASC