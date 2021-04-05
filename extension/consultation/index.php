<?php

include_once 'inc.php';

//$events = array(
//	'16'    => 'Заплатить ипотеку',
//	'08.04' => 'День защитника Отечества'
//);

$calendar =  Calendar::getMonth(date('n'), date('Y'), $events);

include 'tmpl/index.php';