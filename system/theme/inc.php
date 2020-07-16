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
    public function getTemplateFile($file_name, $type = '') {
        $html = '';
        if (strlen($file_name) > 0 && $type != 'E') {
            ob_start();

            if (isset($_SESSION['page']['info']['id']) && $_SESSION['page']['info']['id'] > 0) {
                //echo "gg: {$_SESSION['page']['info']['id']} <br/>\n";
                $this->getBlocksContents($_SESSION['page']['info']['id']);
                
            }
            global $lang;
            include $_SERVER['DOCUMENT_ROOT'] . '/themes/' . $file_name . '/index_' . $_SESSION['lang'] . '.php';
            $html = ob_get_clean();
        } else {
            ob_start();
            global $lang;
            include $_SERVER['DOCUMENT_ROOT'] . '/themes/site1/error_' . $_SESSION['lang'] . '.php';
            $html = ob_get_clean();
        }
        return $html;
    }

    public function getBlocksContents($page_id) {
        $blocks = array();
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
                if (strlen($value['extension']) == 0) {
                    // Обычный контент
                    $elems[] = $value['content_descr'];
                } else {
                    // Выводим расширение
                    $extension = new \project\extension();
                    $e = $extension->getExtensionListArray($value['extension']);
                    //print_r($e);
                    ob_start();
                    include DOCUMENT_ROOT . $e[0]['url'];
                    $html_extension = ob_get_clean();
                    $elems[] = $html_extension;
                }
                $_SESSION['page'][$value['block_code']] = implode("\n", $elems);
            }
        }
    }

}
