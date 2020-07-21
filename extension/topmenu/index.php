<?php

defined('__CMS__') or die;

include 'lang.php';
include 'inc.php';

$topmenu = new \project\topmenu();

echo $topmenu->getTemplateInc();
