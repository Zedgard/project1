<?php
defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/page/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/theme/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

include 'lang.php';

$user = new \project\user();
if ($user->isAdmin()) {

    $p = new \project\page();

    if (isset($_GET['content'])) {
        $theme = new \project\theme();
        $blocks = $p->bloksListArray();
        $contents = $p->contentsListArray($_GET['content']);

        if (isset($_GET['edit_material'])) {
            $extension_url_id = $_GET['edit_material'];
            $e = new \project\extension();

            $content = $p->pageBlockContentsListArray($extension_url_id)[0];
            //print_r($content);
            $extensions = $e->getExtensionListArray(0);
            for ($i = 0; $i < count($extensions); $i++) {
                $f = DOCUMENT_ROOT . '/extension/' . $extensions[$i]['extension_url'] . '/conf.php';
                //echo "f: {$f} <br/>\n";
                $config = array();
                if (is_file($f)) {
                    include DOCUMENT_ROOT . '/extension/' . $extensions[$i]['extension_url'] . '/lang.php';
                    include $f;
                    //echo "f: {$f}<br/>\n";
                    //print_r($config);
                    //echo "<br/>\n";
                    $extensions[$i]['conf'] = $config;
                }
            }
            //print_r($extensions);
            include 'tmpl/edit_material.php';
        } else {
            include 'tmpl/content.php';
        }
    } elseif (isset($_GET['bloks'])) {
        $blocks = $p->bloksListArray();
        include 'tmpl/bloks.php';
    } else {
        $pages = $p->adminList(0);
        if (isset($_GET['edit'])) {
            if ($_GET['edit'] > 0) {
                $obj = $p->adminList($_GET['edit'])[0];
            }
            $themes = $p->themesListArray();
            include 'tmpl/edit.php';
        } else {
            include 'tmpl/admin.php';
        }
    }
} else {
    ?>
    <div>Нет доступа для просмотра данной страницы</div>
    <?
}