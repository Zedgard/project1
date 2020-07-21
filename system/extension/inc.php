<?php

namespace project;

defined('__CMS__') or die;

/*
 * Управление расширениями на сайте
 */

class extension {

    public function __construct() {
        $this->init();
    } 

    /**
     * Заполение данных о расширениях
     */
    public function init() {
        if (!isset($_SESSION['extension_init']))
            $_SESSION['extension_init'] = 0;
        if ($_SESSION['extension_init'] == 0) {
            $sqlLight = new \project\sqlLight();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

            // Получим список доступных расширений
            $dirs = directoryListDirArray(DOCUMENT_ROOT . '/extension');

            if (count($dirs) > 0) {
                foreach ($dirs as $value) {

                    // конфиг расширения
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $value . '/lang.php';
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $value . '/conf.php';

                    $querySelect = "SELECT `id`, `extension_url`, `version` FROM `zay_extension` e WHERE e.extension_url='?'";
                    $e = $sqlLight->queryList($querySelect, array($value));

                    // Добавим в список если его небыло
                    if (count($e) == 0) {
                        $queryInsert = "INSERT INTO `zay_extension`(`extension_url`, `version`) "
                                . "VALUES ('?','?')";
                        if ($sqlLight->query($queryInsert, array($value, $config['version']))) {
                            $querySelect = "SELECT `id`, `extension_url`, `version` FROM `zay_extension` e WHERE e.extension_url='?'";
                            $e = $sqlLight->queryList($querySelect, array($value));
                            // Добавим ссылки для вставки 
                            if (count($e) > 0) {
                                $this->setExtensionUrls($e[0]['id'], $config);
                            }
                        }
                    }

                    // обновим версию расширения
                    if ($e[0]['version'] != $config['version']) {
                        $queryUpdate = "UPDATE `zay_extension` SET `version`='?' WHERE e.extension_url='?'";
                        $sqlLight->query($queryInsert, array($config['version'], $value));
                    }
                }
            }
            $_SESSION['extension_init'] = 1;
        }
    }

    /**
     * Рабочие ссылки расширений создаем здесь<br/>
     * Данные из файла конфигурации
     * @param type $extension_id
     * @param type $config
     */
    private function setExtensionUrls($extension_id, $config) {
        $sqlLight = new \project\sqlLight();
        if ($extension_id > 0) {
            foreach ($config['urls'] as $key => $value) {
                $querySelect = "SELECT * FROM `zay_extension_urls` WHERE extension_id='?' and url='?'";
                $e = $sqlLight->queryList($querySelect, array($extension_id, $value));
                if (count($e) > 0) {
                    $queryUpdate = "UPDATE `zay_extension_urls` set extension_id='?', url='?' ";
                    $sqlLight->query($queryInsert, array($extension_id, $value));
                } else {
                    $queryInsert = "INSERT INTO `zay_extension_urls`(`extension_id`, `url`) "
                            . "VALUES ('?','?')";
                    $sqlLight->query($queryInsert, array($extension_id, $value));
                }
            }
        }
    }

    /**
     * Данные по расширению
     * @param type $eu_id id ссылки на расширение
     * @return type array
     */
    public function getExtensionListArray($eu_id = 0) {
        $sqlLight = new \project\sqlLight();
        $data = array();
        if ($eu_id > 0) {
            $querySelect = "SELECT  e.`id`, e.`extension_url`, e.`version`, eu.`id` as eu_id, eu.`url` "
                    . "FROM `zay_extension` e "
                    . "left join `zay_extension_urls` eu on eu.extension_id=e.id "
                    . "WHERE eu.`id`='?'";
            $data = $sqlLight->queryList($querySelect, array($eu_id));
        } else {
            $querySelect = "SELECT  e.`id`, e.`extension_url`, e.`version`, eu.`id` as eu_id, eu.`url` "
                    . "FROM `zay_extension` e "
                    . "left join `zay_extension_urls` eu on eu.extension_id=e.id ";
            $data = $sqlLight->queryList($querySelect, array());
        }

        return $data;
    }

}
