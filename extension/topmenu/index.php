<?php

defined('__CMS__') or die;

include 'lang.php';
include_once 'inc.php';

$topmenu = new \project\topmenu();

echo $topmenu->getTemplateInc();
