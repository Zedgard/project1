<?php

$br = "<br/>\n";
echo date('c') . $br;

/**
 * Получить номер первой недели месяца
 */
function getWeekNow($m = 0) {
    if ($m == 0) {
        $m = date('m');
    }
    $date = new DateTime();
    for ($i = 2; $i < 51; $i++) {
        $date->setISODate(date('Y'), $i);
        if ($date->format('n') == $m) {
            return $i;
            break;
        }
    }
    return 0;
}

$date = new DateTime();

$date->setDate(2020, 9, 10);
$date->setTime(14, 55);
echo $date->format('Y-m-d\TH:i:s+00:00') . $br;


echo 'getWeekNow: ' . getWeekNow();
