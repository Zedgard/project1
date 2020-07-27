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
        if($type == 'E'){
            $run = 1;
            ob_start();
            global $lang;
            include DOCUMENT_ROOT . '/themes/site1/error_' . $_SESSION['lang'] . '.php';
            $html = ob_get_clean();
        }
        
        if (strlen($theme_name) > 0 && $run == 0) {
            ob_start();
            if (isset($_SESSION['page']['info']['id']) && $_SESSION['page']['info']['id'] > 0) {
                //echo "gg: {$_SESSION['page']['info']['id']} <br/>\n";
                $this->getBlocksContents($_SESSION['page']['info']['id']);
            }
            global $lang;
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
    public function getBlocksContents($page_id) {
        $blocks = array();
        global $lang;
        $sqlLight = new \project\sqlLight();
        $querySelect = "SELECT pbc.content_title, pbc.content_descr, pbc.extension, pb.block_code, pb.block_name
          FROM `zay_page_block_contents` pbc
          left join `zay_pages_blocks` pb on pb.id=pbc.block_id
          where pbc.page_id='?' 
          ORDER BY pbc.`sort` ASC ";

        $blocks = $sqlLight->queryList($querySelect, array($page_id));

        //echo 'blocks' . "<br/>\n";
        //print_r($blocks);
        //echo "<br/>\n";

        if (count($blocks) > 0) {
            foreach ($blocks as $key => $value) {
                $elems = array();
                if (strlen($value['extension']) == 0) {
                    // Обычный контент
                    $elems[] = $value['content_descr'];
                } else {
                    // Выводим расширение
                    $extension = new \project\extension();
                    $e = $extension->getExtensionListArray($value['extension']);
                    //echo "et: {$value['extension']} <br/>\n";
                    //print_r($e);
                    if (count($e) > 0) {
                        ob_start();
                        include DOCUMENT_ROOT . $e[0]['url'];
                        $html_extension = ob_get_clean();
                    } else {
                        $html_extension = $lang['not_find_extension'];
                    }
                    $elems[] = $html_extension;
                }
                $_SESSION['page'][$value['block_code']] = implode("\n", $elems);
            }
        }
    }

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

}
