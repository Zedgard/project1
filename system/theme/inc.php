<?php

namespace project;

defined('__CMS__') or die;

include_once DOCUMENT_ROOT . '/system/extension/inc.php';

/*
 * Шаблон
 */

class theme {

    public function __construct() {
        
    }

    /**
     * Отображение шаблонов
     * @param type $file_name имя темы на сервере
     * @param type $type передать E = страница с ошибкой
     * @return type
     */
    public function getTemplateFile($theme_name, $type = '') {
        $html = '';
        $run = 0;
        if ($type == 'E') {
            $run = 1;
            ob_start();
            header("HTTP/1.0 404 Not Found");
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            global $lang;
            include DOCUMENT_ROOT . '/themes/site1/error_' . $_SESSION['lang'] . '.php';
            $html = ob_get_clean();
        }

        if (strlen($theme_name) > 0 && $run == 0) {
            ob_start();
            if (isset($_SESSION['page']['info']['id']) && $_SESSION['page']['info']['id'] > 0) {
                //echo "gg: {$_SESSION['page']['info']['id']} <br/>\n";
                $page_bloks = $this->getPagesBlocks();
                for ($i = 0; $i < count($page_bloks); $i++) {
                    $this->getBlocksContents($_SESSION['page']['info']['id'], $page_bloks[$i]['id'], $page_bloks[$i]['block_code']);
                }
                //echo 'page' . "<br/>\n";
                //print_r($_SESSION['page']);
                //echo "<br/>\n";
            }
            
            global $lang;
            include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
            $config = new \project\config();
            include DOCUMENT_ROOT . '/themes/' . $theme_name . '/index_' . $_SESSION['lang'] . '.php';
            $html = ob_get_clean();
        }

        return $html;
    }

    /**
     * Отображение материалов на странице
     * @global type $lang
     * @param type $page_id
     */
    public function getBlocksContents($page_id, $block_id, $block_code) {
        include_once DOCUMENT_ROOT . '/system/page/inc.php';
        //$blocks = array();
        global $lang;
        $sqlLight = new \project\sqlLight();
        $p = new \project\page();
        $roles = $p->blok_select_roles_list($block_id);
        $querySelect = "SELECT pbc.content_title, pbc.content_descr, pbc.extension, 
            eu.url
          FROM `zay_page_block_contents` pbc 
          left join `zay_extension_urls` eu on eu.id=pbc.extension
          where pbc.page_id=? and pbc.block_id=?
          ORDER BY pbc.`sort` ASC ";

        $block_extension = $sqlLight->queryList($querySelect, array($page_id, $block_id));
        $_SESSION['page'][$block_code] = '';

        if (count($roles) > 0) {
            // Признак отображения блока
            $block_see = 0;
            // проверим на роли
            foreach ($roles as $value) {
                if ($value['role_privilege'] == 0) {
                    $block_see = 1;
                }
                if ($block_see == 0 && count($_SESSION['user']) > 0 && $_SESSION['user']['info']['role_privilege'] >= $value['role_privilege']) {
                    $block_see = 1;
                }
            }
        }

        if (count($block_extension) > 0 && $block_see > 0) {
            $html_extension = array();
            foreach ($block_extension as $key => $value) {
                $elems = array();
                if (strlen($value['extension']) == 0) {
                    // Обычный контент
                    $elems[] = $value['content_descr'];
                } else {
                    $ext_url = $value['url'];
                    //echo "ext_url: {$ext_url} <br/>\n";
                    if (is_file(DOCUMENT_ROOT . $ext_url)) {
                        ob_start();
                        include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';
                        $config = new \project\config();
                        include DOCUMENT_ROOT . $ext_url;
                        $html_extension[] = ob_get_clean();
                    } else {
                        $html_extension[] = $lang['not_find_extension'];
                    }
                    $elems[] = implode("\n", $html_extension);
                }
                $_SESSION['page'][$block_code] = implode("\n", $elems);
            }
        }
    }

    /**
     * Получить расширение
     * @global \project\type $lang
     * @param type $extension_id
     * @return type
     */
    public function getExtensionContentsReturn($extension_id) {
        global $lang;
        $blocks = array();
        $extension = new \project\extension();
        $e = $extension->getExtensionListArray($extension_id);
        //print_r($e);
        ob_start();
        include DOCUMENT_ROOT . $e[0]['url'];
        $html_extension = ob_get_clean();
        return $html_extension;
    }

    /**
     * Получить список имеющийхся блоков
     * @return type
     */
    public function getPagesBlocks() {
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT * FROM `zay_pages_blocks`";

        return $sqlLight->queryList($querySelect, array());
    }

}
