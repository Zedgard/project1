<?php

namespace project;

defined('__CMS__') or die;

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

            include $_SERVER['DOCUMENT_ROOT'] . '/themes/' . $file_name . '/index_' . $_SESSION['lang'] . '.php';
            $html = ob_get_clean();
        } else {
            ob_start();
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
          where pbc.page_id='?' ";
        $blocks = $sqlLight->queryList($querySelect, array($page_id));

        if (count($blocks) > 0) {
            foreach ($blocks as $key => $value) {
                if (strlen($value['extension']) == 0) {
                    $_SESSION['page'][$value['block_code']] = $value['content_descr'];
                } else {
                    $_SESSION['page'][$value['block_code']] = $value['extension'];
                }
            }
        }
    }

}
