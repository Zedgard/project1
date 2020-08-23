<?php

/**
 * getSiteUrl
 * функция выдает нам url строку в виде массива
 * Array ( [0] => url.ru [1] => link1 [2] => link2)
 */
function getSiteUrl($url) {
    $n = 0;
    foreach ($url as $key => $value) {
        $url[$n] = $value;
        $n++;
    }
    unset($url[count($url) - 1]);
    $this->url = $url;
}

function location_href($url){
    header("Location: {$url}");
    exit();
}

/**
 * translit
 * функция транслитерации
 * $str = строка для транслитерации
 */
function translit($str) {
    $tr = array("А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e", "Ё" => "e", "Ж" => "j", "З" => "z", "И" => "i", "Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n", "О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch", "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "", "Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "j", "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y", "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya", " " => "-", "." => "", "/" => "", "\"" => "");
    return strtr($str, $tr);
}

/**
 * Строку в верхний регистр
 * @param type $str
 * @return type
 */
function strRusUpper($str) {
    $trans = array(
        "а" => "А", "б" => "Б", "в" => "В", "г" => "Г", "д" => "Д", "е" => "Е",
        "ё" => "Ё", "ж" => "Ж", "з" => "З", "и" => "И", "й" => "Й", "к" => "К",
        "л" => "Л", "м" => "М", "н" => "Н", "о" => "О", "п" => "П", "р" => "Р",
        "с" => "С", "т" => "Т", "у" => "У", "ф" => "Ф", "х" => "Х", "ц" => "Ц",
        "ч" => "Ч", "ш" => "Ш", "щ" => "Щ", "ь" => "Ь", "ы" => "Ы", "ъ" => "Ъ",
        "э" => "Э", "ю" => "Ю", "я" => "Я",
    );
    $str = strtr($str, $trans);
    return($str);
}

/**
 * noPHPcode
 * вырезает теги PHP 
 * @param type $html
 * @return type
 */
function noPHPcode($html) {
    return preg_replace('/<\?(?:php|=|\s+).*?\?>/s', '', $html);
}

/**
 * fileSet
 * функция записи в фаил
 * $file  = полный путь до файла на сервере
 * $value = текст
 */
function fileSet($file, $value) {
    @chmod($file, 0777);
    $file = @fopen($file, "w+");
    if (!$file) {
        return FALSE;
    } else {
        @fputs($file, $value);
        return TRUE;
    }
    @fclose($file);
    @chmod($file, 0755);
}

/**
 * fileGet
 * функция чтения фаила
 * $urlFile  = полный путь до файла на сервере
 */
function fileGet($urlFile) {
    @chmod($urlFile, 0777);
    $file = @fopen($urlFile, "r+");
    if (!$file) {
        @fclose($file);
        @chmod($urlFile, 0755);
        return FALSE;
    } else {
        $buffer = @fread($file, filesize($urlFile));
        @fclose($file);
        @chmod($urlFile, 0755);
        return $buffer;
    }
}

/**
 * tmpType
 * Возвращает тип файла
 * $file - имя файла
 */
function tmpType($file) {
    $type = explode('.', $file);
    foreach ($type as $key => $value) {
        $t = $value;
    }
    if ($t != '') {

        foreach ($this->tmpArr as $key => $value) {
            if ($t == $value) {
                $type = $value;
            }
        }
        return '.' . $type;
    } else {
        return FALSE;
    }
}

/**
 * deleteDirectory
 * удаление всех файлов и деректорий в заданной папке
 * $dir = полный путь до папки
 */
function directoryDelete($dir) {
    if (!file_exists($dir))
        return true;
    if (!is_dir($dir) || is_link($dir))
        return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..')
            continue;
        if (!$this->directoryDelete($dir . "/" . $item)) {
            @chmod($dir . "/" . $item, 0777);
            if (!$this->directoryDelete($dir . "/" . $item))
                return false;
        }
        ;
    }
    return @rmdir($dir);
}

/**
 * recurse_copy
 * Копирование файлов в заданную дерикторию
 * $src = откуда
 * $dst = куда
 */
function directoryCopy($src, $dst) {
    $dir = opendir($src);
//echo $dst . '<br>';
    if (@mkdir($dst, 0777)) {
        @chmod($dst, 0777);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->directoryCopy($src . '/' . $file, $dst . '/' . $file);
                    @chmod($dst . '/' . $file, 0777);
                } else {
                    if (!@copy($src . '/' . $file, $dst . '/' . $file)) {
                        echo "<br>Не удалось скопировать ...<br>";
                    }
                    @chmod($dst . '/' . $file, 0777);
                }
            }
        }
    }
    closedir($dir);
}

/**
 * Список папок в дирректории
 * @param type $dir_url
 */
function directoryListDirArray($dir_url) {
    $dirs = array();
    if (is_dir($dir_url)) {
        if ($dh = opendir($dir_url)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    //echo "папка: $file \n";
                    $dirs[] = $file;
                }
            }
            closedir($dh);
        }
    }
    return $dirs;
}

/**
 * inc($filename)
 * Буферизация include
 * $filename = полный путь до файла
 * $obj = массив объектов используеммые файлом как параметров
 */
function inc($filename, $obj = null) {
    if (is_file($filename)) {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/load.php';
        include $filename;
        return ob_get_clean();
    }
    return false;
}

/**
 * run($file)
 * Выполняет фаил
 * $file - фаил include
 */
function run($file) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        ob_get_clean();
    }
}
/**
 * tinymce
 */
function importWisiwyng($elm_id = '') {
    if(strlen($elm_id)>0){
        $elm_id = "#{$elm_id}";
    }
    ?>
    <script src="/assets/plugins/tinymce/tinymce.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea' + "<?= $elm_id ?>",
            height: 500,
            theme: 'modern',
            directionality: 'ltr',
            language: 'ru',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            file_browser_callback: function (field, url, type, win) {
                tinyMCE.activeEditor.windowManager.open({
                    file: '/assets/plugins/tinymce/kcfinder/browse.php?opener=tinymce4&field=' + field + '&dir=' + field + '/public&type=' + type + '&lang=ru',
                    title: 'KCFinder',
                    width: 700,
                    height: 500,
                    inline: true,
                    close_previous: false
                }, {
                    window: win,
                    input: field
                });
                return false;
            }
        });
        function openKCFinder(field, url, type, win) {
            tinyMCE.activeEditor.windowManager.open({
                file: '/assets/plugins/tinymce/kcfinder/browse.php?opener=tinymce&type=' + type,
                title: 'KCFinder',
                width: 700,
                height: 500,
                resizable: true,
                inline: true,
                close_previous: false,
                popup_css: false
            }, {
                window: win,
                input: field
            });
            return false;
        }
    </script>
    <?

}

/**
 * импортируем основные стили
 * импортируем javascript библиотеки
 * импортируем html редактор
 */
function importStyle() {
    echo "<link rel=\"stylesheet\" href=\"/admin/bootstrap/css/bootstrap.min.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"/enter/css/main.css\" type=\"text/css\">\n";
//echo "<script type=\"text/javascript\" src=\"/admin/style/bootstrap/js/bootstrap.js\" ></script>\n";
}

/**
 * importJquery
 */
function importJquery() {
    echo "<script type=\"text/javascript\" src=\"/js/jquery.js\" ></script>\n";
    echo "<script type=\"text/javascript\" src=\"/js/main.js\" ></script>\n";
    echo '<!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="/js/fancybox/source/jquery.fancybox.js?v=2.0.6"></script>
        <link rel="stylesheet" type="text/css" href="/js/fancybox/source/jquery.fancybox.css?v=2.0.6" media="screen" />

        <!-- Add Button helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2" />
        <script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>

        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2" />
        <script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2"></script>

        <!-- Add Media helper (this is optional) -->
        <script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.0"></script>';
}

/**
 * Показать ссылку перехода назад по истории
 * Прейти на адрес через 3 сек.
 */
function linkBack() {
    echo "<a href=\"javascript:history.go(-1)\" mce_href=\"javascript:history.go(-1)\" class=\"btn\"><i class=\"icon-arrow-left\"></i> назад</a>";
}

/**
 * goBack
 * @param type $url
 * @param type $time
 */
function goBack($url = './', $time = '3') {
    echo '<script type="text/javascript">setTimeout(function() { document.location.href = "' . $url . '" }, ' . $time . ');</script>';
}

/**
 * Время Владивосток
 * @return type
 */
//function time() {
//    return time() + 25200; // Владивосток
//}

/**
 * alertForm
 * @param type $text
 * @return type
 */
function alertForm($text) {
    $obj['alert'] = $text;
    return $this->inc($_SERVER['DOCUMENT_ROOT'] . '/admin/tpl/alert.php', $obj);
}
