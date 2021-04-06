<?php

include_once 'inc.php';

//$events = array(
//	'16'    => 'Заплатить ипотеку',
//	'08.04' => 'День защитника Отечества'
//);

$calendar = Calendar::getMonth(date('n'), date('Y'), $events);

$consultation_phone == '';
$consultation_email == '';
$consultation_pass == 1;
if ($_SESSION['user']['info']['id'] > 0) {
    $consultation_phone = $_SESSION['user']['info']['phone'];
    $consultation_email = $_SESSION['user']['info']['email'];
    $consultation_pass = 0;
}
include 'tmpl/index.php';
include 'tmpl/modal_pay.php';
