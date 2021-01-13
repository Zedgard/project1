<?php

/** This file is part of KCFinder project
 *
 *      @desc Browser calling script
 *   @package KCFinder
 *   @version 3.12
 *    @author Pavel Tzonkov <sunhater@sunhater.com>
 * @copyright 2010-2014 KCFinder Project
 *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
 *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
 *      @link http://kcfinder.sunhater.com
 */

session_start();

define('__CMS__', 1);

include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

$user = new \project\user();
if ($user->isAdmin() || isEditor()) {
    require "core/bootstrap.php";
    $browser = "kcfinder\\browser"; // To execute core/bootstrap.php on older
    $browser = new $browser();      // PHP versions (even PHP 4)
    $browser->action();
}else{
    echo 'Error!';
} 

