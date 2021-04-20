<?php

echo "POST: ";
print_r($_POST);

echo "<br/>\n";
echo "GET: ";
print_r($_GET);
echo "<br/>\n";

if (isset($_GET['constants']) && $_GET['constants'] == 'HUK') {
    mail('koman1706@gmail.com', 'Оплата тенькф HUK', 'Оплата тинькф HUK');
} else {
    if (isset($_GET['constants']) && $_GET['constants'] == 'SUCCESS') {
        mail('koman1706@gmail.com', 'Оплата тенькф SUCCESS', 'Оплата тинькф SUCCESS');
    } else {
        mail('koman1706@gmail.com', 'Оплата тенькф CANSEL', 'Оплата тинькф CANSEL');
    }
}