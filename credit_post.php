<?php

echo "POST: ";
print_r($_POST);

echo "<br/>\n";
echo "GET: ";
print_r($_GET);
echo "<br/>\n";

if (isset($_GET['constants']) && $_GET['constants'] == 'HUK') {
    mail('koman1706@gmail.com', 'Оплата тенькф HUK2', 'Оплата тинькф HUK GET: ' . implode(' ', $_GET) . ' | POST: ' . implode(' ', $_POST) . ' |');
} else {
    if (isset($_GET['constants']) && $_GET['constants'] == 'SUCCESS') {
        mail('koman1706@gmail.com', 'Оплата тенькф SUCCESS', 'Оплата тинькф SUCCESS ' . implode(' ', $_POST));
    } else {
        mail('koman1706@gmail.com', 'Оплата тенькф CANSEL', 'Оплата тинькф CANSEL' . implode(' ', $_POST));
    }
}