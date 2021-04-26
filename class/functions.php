<?php
if (!function_exists('getSiteUrl')) {

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

}

function location_href($url) {
    header("Location: {$url}");
    exit();
}

if (!function_exists('translit')) {

    /**
     * translit
     * функция транслитерации
     * $str = строка для транслитерации
     */
    function translit($str) {
        $tr = array("А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e", "Ё" => "e", "Ж" => "j", "З" => "z", "И" => "i", "Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n", "О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch", "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "", "Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "j", "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y", "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya", " " => "-", "." => "", "/" => "", "\"" => "");
        return strtr($str, $tr);
    }

}

if (!function_exists('strRusUpper')) {

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

if (!function_exists('fileSet')) {

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

}

if (!function_exists('fileGet')) {

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

}

if (!function_exists('tmpType')) {

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

}

if (!function_exists('directoryDelete')) {

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

}

if (!function_exists('directoryCopy')) {

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

}

if (!function_exists('directoryListDirArray')) {

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

}

if (!function_exists('inc')) {

    /**
     * inc($filename)
     * Буферизация include
     * $filename = полный путь до файла
     * $obj = массив объектов используеммые файлом как параметров
     */
    function inc($filename, $obj = null) {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }

}

if (!function_exists('run')) {

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

}

/**
 * tinymce
 */
$GLOBALS["ImportWisiwyng"] = 0;
if (!function_exists('importWisiwyng')) {

    function importWisiwyng($elm_id = '', $height = 300) {
        if (strlen($elm_id) > 0) {
            $elm_id = "#{$elm_id}";
        }
        if ($GLOBALS["ImportWisiwyng"] == 0) {
            ?>
            <script src="/assets/plugins/tinymce/tinymce.js?v=1"></script>
            <?
        }
        ?>
        <script>
            var tinymce_init = 0;
            tinymce.init({
                selector: 'textarea' + "<?= $elm_id ?>",
                height: <?= $height ?>,
                theme: 'modern',
                directionality: 'ltr',
                language: 'ru',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
                ],
                toolbar1: 'undo redo | pageembed template | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | insert link image media',
                toolbar2: 'formatselect fontselect fontsizeselect | removeformat | pagebreak | charmap | forecolor backcolor emoticons | codesample | preview fullscreen |',
                image_advtab: true,
                templates: [
                    {title: 'Блок Container расположение по середине', content: '<div class="container"><div class="row"><div class="col-12">Container 1</div></div></div>'},
                    {title: 'Блок row', content: '<div class="row"><div class="col-12">row 1</div></div>'}
                ],
                content_css: [
                    '/assets/css/sleek.min.css',
                    '/assets/plugins/bootstrap/css/bootstrap.css',
                    '/themes/site1/css/style.css',
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                ],
                file_browser_callback: function (callback, value, meta) {
                    tinyMCE.activeEditor.windowManager.open({
                        file: "/system/elfinder/elfinder.php", //"/system/elfinder/php/connector.minimal.php?cmd=open&target=l1_aW1hZ2U&init=1&tree=1&_=1617026792779",
                        title: 'elFinder',
                        width: 800,
                        height: 600,
                        resizable: true,
                        inline: true,
                        close_previous: false,
                        popup_css: false
                    }, {
                        my_insert: function (url) {
                            document.getElementById(callback).value = url;
                        }
                    });
                },
                init_instance_callback: function (editor) {
                    // признак готовности
                    tinymce_init = 1;
                },
                setup: function (ed) {
                    ed.on('keyup', function (e) {
        //                        console.log('the event object ', e);
        //                        console.log('the editor object ', ed);
        //                        console.log('the content ', ed.getContent());
                    });
                }
            });

            $(document).on('focusin', function (e) {
                if ($(e.target).closest(".mce-window").length)
                    e.stopImmediatePropagation();
            });
        </script>
        <?
        $GLOBALS["ImportWisiwyng"] = 1;
    }

}

if (!function_exists('importStyle')) {

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

}

if (!function_exists('importJquery')) {

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

}

if (!function_exists('urlRequestAddLink')) {

    /**
     * Получить правильную ссылку
     * @param type $urlValueStr добавить новый параметр к ссылки
     * @return string ссылка
     */
    function urlRequestAddLink($urlValueStr) {
        $url = '';
        if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
            $urlExp = explode('?', $_SERVER['REQUEST_URI']);
            $address = $urlExp[0];
            $reqUrl = $urlExp[1];

            $reqUrlExp = explode('&', $reqUrl);

            $url = $address . '?' . $reqUrl;
            if (count($reqUrlExp) > 0) {
                $url .= '&' . $urlValueStr;
            }
        } else {
            $url = $_SERVER['REQUEST_URI'] . '?' . $urlValueStr;
        }

        return $url;
    }

}

if (!function_exists('urlRequestAddLinkArray')) {

    /**
     * Получить правильную ссылку из массива ссылок
     * @param type $urls array Массив ссылок
     * @return string
     */
    function urlRequestAddLinkArray($urls = array()) {
        if (count($urls) > 0) {
            return $url = '?' . implode('&', $urls);
        }
        return '';
    }

}

if (!function_exists('linkBack')) {

    /**
     * Показать ссылку перехода назад по истории
     * Прейти на адрес через 3 сек.
     */
    function linkBack() {
        echo "<a href=\"javascript:history.go(-1)\" mce_href=\"javascript:history.go(-1)\" class=\"btn btn-link\"><i class=\"icon-arrow-left\"></i> назад</a>";
    }

}

if (!function_exists('goBack')) {

    /**
     * goBack
     * @param type $url
     * @param type $time
     */
    function goBack($url = './', $time = '3') {
        echo '<script type="text/javascript">setTimeout(function() { document.location.href = "' . $url . '" }, ' . $time . ');</script>';
    }

}

/**
 * Время Владивосток
 * @return type
 */
//function time() {
//    return time() + 25200; // Владивосток
//}

if (!function_exists('alertForm')) {

    /**
     * alertForm
     * @param type $text
     * @return type
     */
    function alertForm($text) {
        $obj['alert'] = $text;
        return $this->inc($_SERVER['DOCUMENT_ROOT'] . '/admin/tpl/alert.php', $obj);
    }

}

if (!function_exists('importELFinder')) {

    /**
     * Блок с загрузкой изображений
     * @param type $add_max доступное максимальное колличство 
     */
    function importELFinder($add_max = 1) {
        // <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1743a1068b1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1743a1068b1%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2299.1171875%22%20y%3D%2296.3%22%3EImage%20cap%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
        ?>
        <style>
            .elfinder_model {
                background-color: #FFFFFF;
                border: 1px solid #CCCCCC;
                position: fixed;
                width: 90%;
                height: 500px;
                top: 100px;
                left: 5%;
                z-index: 5;
                padding: 1%;
                padding-top: 0;
            }
        </style>
        <!-- Imeges -->
        <div class="form-group block_images">
            <div class="row">
                <div class="col-12">
                    <label for="wares_images">Изображения <span class="btn btn-primary image_btn_add" style="margin-left: 20px;" title="Добавить изображение"><i class="mdi mdi-image-plus"></i></span></label>
                </div>
            </div>    
            <div class="row">
                <div class="col-12">
                    <div class="images">

                    </div>
                </div>
            </div>
        </div>

        <!-- Center small Modal -->
        <div id="form_elfinder_modal" class="elfinder_model" style="display: none;" >
            <div class="modal-header">
                <div>Файловый менеджер</div>
                <button type="button" class="close close_elfinder_modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="elfinder"></div>
        </div>

        <!-- jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="/system/elfinder/css/elfinder.full.css?v=<?= rand() ?>">
        <link rel="stylesheet" type="text/css" href="/system/elfinder/css/theme.css?v=<?= rand() ?>">
        <!--<![endif]-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js?v=<?= rand() ?>"></script>
        <!-- elFinder JS (REQUIRED) -->
        <script src="/system/elfinder/js/elfinder.min.js?v=<?= rand() ?>"></script>
        <!-- Extra contents editors (OPTIONAL) -->
        <script src="/system/elfinder/js/extras/editors.default.js?v=<?= rand() ?>"></script>
        <script> 
            function get_html_images_block(v, i) { 
                let html = '<div class="image_elm image_id_' + i + '">\n\
                            <img src="' + v + '" class="image_elm_img" style="width: 50%;max-width: 200px;margin: 0 auto;display: block;"/>\n\
                            <div style="clear: both;height: 20px;width: 100%;">&nbsp;</div>\n\
                            <div>\n\
                                <input type="text" name="image_obj_value" value="' + v + '" class="form-control image_obj_value" style="width: 80%;float: left;">\n\
                                <span class="btn btn-danger btn_image_elm_delete" style="float: left;margin-left: 3%;"><i class="mdi mdi-delete"></i></span>\n\
                            </div>\n\
                            <div style="clear: both;height: 20px;width: 100%;">&nbsp;</div>\n\
                        </div>';
                setTimeout(function () {
                    init_elfinder();
                    init_click_delete();
                    var col = $(".image_elm").length;
                    if (col >= Number(<?= $add_max ?>)) {
                        $(".image_btn_add").hide();
                    }
                }, 1000);
                return html;
            }
            $(document).ready(function () {
                $(".elfinder_model").draggable();
                //$(".block_images").append('<br/><div class="btn btn-primary"><i class="mdi mdi-image-plus" style="font-size: 30px;"></i></div>');

                $(".image_btn_add").click(function () {

                    $(".images").append('<div class="image_elm image_id_' + col + '">\n\
                        <img src="" class="image_elm_img" style="width: 50%;margin: 0 auto;display: none;"/>\n\
                        <div style="clear: both;height: 20px;width: 100%;">&nbsp;</div>\n\
                        <div>\n\
                            <input type="text" value="" class="form-control image_obj_value" style="width: 80%;float: left;">\n\
                            <span class="btn btn-danger btn_image_elm_delete" style="float: left;margin-left: 3%;"><i class="mdi mdi-delete"></i></span>\n\
                        </div>\n\
                        <div style="clear: both;height: 20px;width: 100%;">&nbsp;</div>\n\
                    </div>');
                    init_elfinder();
                    init_click_delete();

                    var col = $(".image_elm").length;
                    if (col >= Number(<?= $add_max ?>)) {
                        $(".image_btn_add").hide();
                    }

                });
                init_elfinder();
                init_click_delete();
                $('.close_elfinder_modal').click(function () {
                    $('#form_elfinder_modal').hide(200);
                });

                var col = $(".image_elm").length;
                if (col >= Number(<?= $add_max ?>)) {
                    $(".image_btn_add").hide();
                }

            });

            function init_elfinder() {
                $(".image_obj_value").unbind('click').click(function () {
                    obj = this;
                    $('#form_elfinder_modal').show(200);
                    $('#elfinder').elfinder(
                            // 1st Arg - options
                                    {
                                        cssAutoLoad: false, // Disable CSS auto loading
                                        baseUrl: './', // Base URL to css/*, js/*
                                        url: '/system/elfinder/php/connector.minimal.php', // connector URL (REQUIRED)
                                        // , lang: 'ru'                    // language (OPTIONAL)
                                        getFileCallback: function (file) { // editor callback
                                            //console.log(file.url); // pass selected file path to TinyMCE
                                            $(obj).val(file.url);
                                            $('#elfinder').elfinder('destroy');
                                            $('#form_elfinder_modal').hide(200);
                                            //let img_val = file.url; //$(obj).closest(".form-group").find(".image_obj_value").val();
                                            //console.log(file.url);
                                            $(obj).closest(".image_elm").find(".image_elm_img").attr("src", file.url);
                                            $(obj).closest(".image_elm").find(".image_elm_img").show(200);
                                        }
                                    },
                                    // 2nd Arg - before boot up function
                                            function (fm, extraObj) {
                                                // `init` event callback function
                                                fm.bind('init', function () {
                                                    // Optional for Japanese decoder "encoding-japanese.js"
                                                    if (fm.lang === 'ja') {
                                                        fm.loadScript(
                                                                ['//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js'],
                                                                function () {
                                                                    if (window.Encoding && Encoding.convert) {
                                                                        fm.registRawStringDecoder(function (s) {
                                                                            return Encoding.convert(s, {to: 'UNICODE', type: 'string'});
                                                                        });
                                                                    }
                                                                },
                                                                {loadType: 'tag'}
                                                        );
                                                    }
                                                });
                                                // Optional for set document.title dynamically.
                                                var title = document.title;
                                                fm.bind('open', function () {
                                                    var path = '',
                                                            cwd = fm.cwd();
                                                    if (cwd) {
                                                        path = fm.path(cwd.hash) || null;
                                                    }
                                                    document.title = path ? path + ':' + title : title;
                                                }).bind('destroy', function () {
                                                    document.title = title;
                                                });
                                            }
                                    );
                                });
                    }

            function init_click_delete() {
                $(".btn_image_elm_delete").click(function () {
                    $(this).closest(".image_elm").remove();
                    var col = $(".image_elm").length;
                    //console.log("col: " + col);
                    if (col < Number(<?= $add_max ?>)) {
                        $(".image_btn_add").show();
                    }
                });
            }
        </script>
        <?
    }

}


if (!function_exists('initELFinderSelectFile')) {

    /**
     * Input для выбора файла
     * @param type $elem_name Наименование
     * @param type $elm_id идентификатор
     * @param type $value значеиние поля value
     * @param type $row_db поле редактируемой таблицы
     * @param type $extensionUrl модуль куда посылать измененные данные
     * @param type $editParam переменная обратываемая jpost файлом
     */
    function initELFinderSelectFile($elm_class) {
        // <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1743a1068b1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1743a1068b1%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2299.1171875%22%20y%3D%2296.3%22%3EImage%20cap%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
        ?>
        <style>
            .elfinder_model {
                background-color: #FFFFFF;
                border: 1px solid #CCCCCC;
                position: fixed;
                width: 90%;
                height: 500px;
                top: 100px;
                left: 5%;
                z-index: 5;
                padding: 1%;
                padding-top: 0;
            }
        </style>

        <!-- Center small Modal -->
        <div id="form_elfinder_modal" class="elfinder_model" style="display: none;" >
            <div class="modal-header">
                <div>Файловый менеджер</div>
                <button type="button" class="close close_elfinder_modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="elfinder"></div>
        </div>

        <!-- jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="/system/elfinder/css/elfinder.full.css?v=<?= rand() ?>">
        <link rel="stylesheet" type="text/css" href="/system/elfinder/css/theme.css?v=<?= rand() ?>">
        <!--<![endif]-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js?v=<?= rand() ?>"></script>
        <!-- elFinder JS (REQUIRED) -->
        <script src="/system/elfinder/js/elfinder.min.js?v=<?= rand() ?>"></script>
        <!-- Extra contents editors (OPTIONAL) -->
        <script src="/system/elfinder/js/extras/editors.default.js?v=<?= rand() ?>"></script>
        <script>
            $(document).ready(function () {
                $(".elfinder_model").draggable();
                //$(".block_images").append('<br/><div class="btn btn-primary"><i class="mdi mdi-image-plus" style="font-size: 30px;"></i></div>');

                //            $(".video_obj_value").click(function () {
                //                init_elfinder();
                //
                //                var col = $(".video_elm").length;
                //
                //            });
                init_elfinder();
                $('.close_elfinder_modal').click(function () {
                    $('#form_elfinder_modal').hide(200);
                });

                var col = $(".image_elm").length;
                if (col >= Number(<?= $add_max ?>)) {
                    $(".image_btn_add").hide();
                }

            });

            function init_elfinder() {
                $(".<?= $elm_class ?>").unbind('click').click(function () {
                    obj = this;
                    $('#form_elfinder_modal').show(200);
                    $('#elfinder').elfinder(
                            // 1st Arg - options
                                    {
                                        cssAutoLoad: false, // Disable CSS auto loading
                                        baseUrl: './', // Base URL to css/*, js/*
                                        url: '/system/elfinder/php/connector.minimal.php', // connector URL (REQUIRED)
                                        // , lang: 'ru'                    // language (OPTIONAL)
                                        getFileCallback: function (file) { // editor callback
                                            //console.log(file.url); // pass selected file path to TinyMCE
                                            $(obj).val(file.url);
                                            $(obj).focus();
                                            $('#elfinder').elfinder('destroy');
                                            $('#form_elfinder_modal').hide(200);

                                        }
                                    },
                                    // 2nd Arg - before boot up function
                                            function (fm, extraObj) {
                                                // `init` event callback function
                                                fm.bind('init', function () {
                                                    // Optional for Japanese decoder "encoding-japanese.js"
                                                    if (fm.lang === 'ja') {
                                                        fm.loadScript(
                                                                ['//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js'],
                                                                function () {
                                                                    if (window.Encoding && Encoding.convert) {
                                                                        fm.registRawStringDecoder(function (s) {
                                                                            return Encoding.convert(s, {to: 'UNICODE', type: 'string'});
                                                                        });
                                                                    }
                                                                },
                                                                {loadType: 'tag'}
                                                        );
                                                    }
                                                });
                                                // Optional for set document.title dynamically.
                                                var title = document.title;
                                                fm.bind('open', function () {
                                                    var path = '',
                                                            cwd = fm.cwd();
                                                    if (cwd) {
                                                        path = fm.path(cwd.hash) || null;
                                                    }
                                                    document.title = path ? path + ':' + title : title;
                                                }).bind('destroy', function () {
                                                    document.title = title;
                                                });
                                            }
                                    );
                                });
                    }


        </script>
        <?
    }

}

if (!function_exists('importELFinderSelectFile')) {

    /**
     * Input для выбора файла
     * @param type $elem_name Наименование
     * @param type $elm_id идентификатор
     * @param type $value значеиние поля value
     * @param type $row_db поле редактируемой таблицы
     * @param type $extensionUrl модуль куда посылать измененные данные
     * @param type $editParam переменная обратываемая jpost файлом
     */
    function importELFinderSelectFile($elem_name, $elm_id, $value, $row_db = '', $extensionUrl = '', $editParam = '') {
        // <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1743a1068b1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1743a1068b1%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2299.1171875%22%20y%3D%2296.3%22%3EImage%20cap%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
        ?>
        <style>
            .elfinder_model {
                background-color: #FFFFFF;
                border: 1px solid #CCCCCC;
                position: fixed;
                width: 90%;
                height: 500px;
                top: 100px;
                left: 5%;
                z-index: 5;
                padding: 1%;
                padding-top: 0;
            }
        </style>
        <!-- Videos -->
        <input type="text" name="<?= $elem_name ?>" class="form-control <?= $elem_name ?> element_obj_value w-100" row_db="<?= $row_db ?>" obj_id="<?= $elm_id ?>" value="<?= $value ?>" />

        <!-- Center small Modal -->
        <div id="form_elfinder_modal" class="elfinder_model" style="display: none;" >
            <div class="modal-header">
                <div>Файловый менеджер</div>
                <button type="button" class="close close_elfinder_modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="elfinder"></div>
        </div>

        <!-- jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="/system/elfinder/css/elfinder.full.css?v=<?= rand() ?>">
        <link rel="stylesheet" type="text/css" href="/system/elfinder/css/theme.css?v=<?= rand() ?>">
        <!--<![endif]-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js?v=<?= rand() ?>"></script>
        <!-- elFinder JS (REQUIRED) -->
        <script src="/system/elfinder/js/elfinder.min.js?v=<?= rand() ?>"></script>
        <!-- Extra contents editors (OPTIONAL) -->
        <script src="/system/elfinder/js/extras/editors.default.js?v=<?= rand() ?>"></script>
        <script>
            $(document).ready(function () {
                $(".elfinder_model").draggable();
                //$(".block_images").append('<br/><div class="btn btn-primary"><i class="mdi mdi-image-plus" style="font-size: 30px;"></i></div>');

                //            $(".video_obj_value").click(function () {
                //                init_elfinder();
                //
                //                var col = $(".video_elm").length;
                //
                //            });
                init_elfinder();
                $('.close_elfinder_modal').click(function () {
                    $('#form_elfinder_modal').hide(200);
                });

                var col = $(".image_elm").length;
                if (col >= Number(<?= $add_max ?>)) {
                    $(".image_btn_add").hide();
                }

            });

            function init_elfinder() {
                $(".element_obj_value").unbind('click').click(function () {
                    obj = this;
                    $('#form_elfinder_modal').show(200);
                    $('#elfinder').elfinder(
                            // 1st Arg - options
                                    {
                                        cssAutoLoad: false, // Disable CSS auto loading
                                        baseUrl: './', // Base URL to css/*, js/*
                                        url: '/system/elfinder/php/connector.minimal.php', // connector URL (REQUIRED)
                                        // , lang: 'ru'                    // language (OPTIONAL)
                                        getFileCallback: function (file) { // editor callback
                                            //console.log(file.url); // pass selected file path to TinyMCE
                                            $(obj).val(file.url);

                                            // сохраниение поля
                                            console.log('row_dbrow_dbrow_db');
                                            if (!!$(obj).attr('row_db') && !!$(obj).attr('obj_id')) {
                                                var row_db = $(obj).attr('row_db');
                                                var obj_id = $(obj).attr('obj_id');
                                                var val = $(obj).val();
                                                console.log('sendPostLigth');
                                                sendPostLigth('/jpost.php?extension=<?= $extensionUrl ?>',
                                                        {
                                                            "<?= $editParam ?>": 1,
                                                            "row_db": row_db,
                                                            "obj_id": obj_id,
                                                            "val": val
                                                        },
                                                        function (e) {
                                                            if (e['success'] == '1') {

                                                            } else {
                                                                alert('Ошибка сохранения!');
                                                            }
                                                        });
                                            }
                                            $('#elfinder').elfinder('destroy');
                                            $('#form_elfinder_modal').hide(200);

                                        }
                                    },
                                    // 2nd Arg - before boot up function
                                            function (fm, extraObj) {
                                                // `init` event callback function
                                                fm.bind('init', function () {
                                                    // Optional for Japanese decoder "encoding-japanese.js"
                                                    if (fm.lang === 'ja') {
                                                        fm.loadScript(
                                                                ['//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js'],
                                                                function () {
                                                                    if (window.Encoding && Encoding.convert) {
                                                                        fm.registRawStringDecoder(function (s) {
                                                                            return Encoding.convert(s, {to: 'UNICODE', type: 'string'});
                                                                        });
                                                                    }
                                                                },
                                                                {loadType: 'tag'}
                                                        );
                                                    }
                                                });
                                                // Optional for set document.title dynamically.
                                                var title = document.title;
                                                fm.bind('open', function () {
                                                    var path = '',
                                                            cwd = fm.cwd();
                                                    if (cwd) {
                                                        path = fm.path(cwd.hash) || null;
                                                    }
                                                    document.title = path ? path + ':' + title : title;
                                                }).bind('destroy', function () {
                                                    document.title = title;
                                                });
                                            }
                                    );
                                });
                    }


        </script>
        <?
    }

}

if (!function_exists('images_db_edit')) {

    /**
     * Изображения изменение данных в ДБ
     * @param type $url
     * @param type $title
     * @param type $descr
     * @param type $obj_name
     * @param type $id_elm
     * @param type $id
     * @return type
     */
    function images_db_edit($url, $title, $descr, $obj_name, $id_elm, $id = 0) {
        include_once 'sqlLight.php';
        $sqlLight = new project\sqlLight();

        for ($i = 0; $i < count($images); $i++) {
            if ($id > 0) {
                $query = "UPDATE `zay_images` SET `url`='?',`title`='?',`descr`='?',`obj`='?',`obj_id`='?' "
                        . "where `id`='?'";
                return $sqlLight->query($query, array($url, $title, $descr, $obj_name, $id_elm, $id));
            } else {
                $query = "INSERT INTO `zay_images`(`url`, `title`, `descr`, `obj`, `obj_id`) "
                        . "VALUES ('?','?','?','?','?')";
                return $sqlLight->query($query, array($url, $title, $descr, $obj_name, $id_elm));
            }
        }
    }

}

if (!function_exists('images_db_delete')) {

    /**
     * Изображение удаление в ДБ
     * @param type $id
     * @return type
     */
    function images_db_delete($id) {
        include_once 'sqlLight.php';
        $sqlLight = new project\sqlLight();

        if ($id > 0) {
            $query = "DELETE FROM `zay_images` WHERE `id`='?'";
            return $sqlLight->query($query, array($id));
        }
    }

}

if (!function_exists('randomColor')) {

    /**
     * Случайный цвет
     * @return string
     */
    function randomColor() {
        $str = '#';
        for ($i = 0; $i < 6; $i++) {
            $randNum = rand(0, 15);
            switch ($randNum) {
                case 10: $randNum = 'A';
                    break;
                case 11: $randNum = 'B';
                    break;
                case 12: $randNum = 'C';
                    break;
                case 13: $randNum = 'D';
                    break;
                case 14: $randNum = 'E';
                    break;
                case 15: $randNum = 'F';
                    break;
            }
            $str .= $randNum;
        }
        return $str;
    }

}


if (!function_exists('get_extension')) {

    /**
     * Получить тип изображения
     * @param type $imagetype
     * @return boolean|string
     */
    function get_image_type($imagetype) {
        if (empty($imagetype))
            return false;
        switch ($imagetype) {
            case 'image/bmp': return '.bmp';
            case 'image/cis-cod': return '.cod';
            case 'image/gif': return '.gif';
            case 'image/ief': return '.ief';
            case 'image/jpeg': return '.jpg';
            case 'image/pipeg': return '.jfif';
            case 'image/tiff': return '.tif';
            case 'image/x-cmu-raster': return '.ras';
            case 'image/x-cmx': return '.cmx';
            case 'image/x-icon': return '.ico';
            case 'image/x-portable-anymap': return '.pnm';
            case 'image/x-portable-bitmap': return '.pbm';
            case 'image/x-portable-graymap': return '.pgm';
            case 'image/x-portable-pixmap': return '.ppm';
            case 'image/x-rgb': return '.rgb';
            case 'image/x-xbitmap': return '.xbm';
            case 'image/x-xpixmap': return '.xpm';
            case 'image/x-xwindowdump': return '.xwd';
            case 'image/png': return '.png';
            case 'image/x-jps': return '.jps';
            case 'image/x-freehand': return '.fh';
            default: return false;
        }
    }

}


if (!function_exists('rand_number')) {

    /**
     * Генерация не повторяющегося случайного числа
     * @param type $min_number
     * @param type $max_number
     * @param array $array_nums
     * @param type $n
     * @return type
     */
    function rand_number($min_number, $max_number, $array_nums = array(), $n = 0) {
        $num = mt_rand($min_number, $max_number);
        //echo "num: {$num}<br/>\n";
        $array_nums[] = $num;
        //print_r($array_nums);
        if (is_array($num)) {
            if ($n > 5) {
                return $num;
            } else {
                $n++;
                return rand_number($min_number, $max_number, $array_nums, $n);
            }
        } else {
            return $num;
        }
    }

}
if (!function_exists('init_prices')) {

    /**
     * Зарегистрируем цены
     */
    function init_prices() {
        $_SESSION['cart']['prices'] = array();
        if (is_array($_SESSION['cart']['itms'])) {
            foreach ($_SESSION['cart']['itms'] as $key => $value) {
                if ($value['price_promo'] > 0) {
                    $price = $value['price_promo'];
                } else {
                    $price = $value['price'];
                }
                $_SESSION['cart']['itms'][$key]['prices'] = $price;
            }
        }
    }

}

if (!function_exists('get_param')) {

    /**
     * Получить даннные из запроса переданные каким либо образом
     */
    function get_param($param_name) {
        if (isset($_POST[$param_name])) {
            return $_POST[$param_name];
        }
        if (isset($_GET[$param_name])) {
            return $_GET[$param_name];
        }
        return null;
    }

}
if (!function_exists('date_jquery_format')) {

    /**
     * Придадим формат дате
     * @param type $date_str
     * @return type
     */
    function date_jquery_format($date_str) {
        $arr = explode('-', $date_str);
        $date_new = "{$arr[2]}.{$arr[1]}.{$arr[0]}";
        return $date_new;
    }

}
if (!function_exists('date_sql_format')) {

    /**
     * Придадим формат дате
     * @param type $date_str
     * @return type
     */
    function date_sql_format($date_str) {
        $arr = explode('.', $date_str);
        $date_new = "{$arr[2]}-{$arr[1]}-{$arr[0]}";
        return $date_new;
    }

}

if (!function_exists('fast_mysql_select_data')) {

    /**
     * Быстрое извлечение данных из базы без создания класса<br/>
     * Только для внутренних запросов так как нет ограничений
     * @param string $query
     * @return type
     */
    function fast_mysql_select_data($query) {
        include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
        $data = array();
        $conn = new mysqli($cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            if ($result = mysqli_query($conn, $query)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        }
        return $data;
    }

}