<?php




echo "POST: ";
print_r($_POST);

echo "<br/>\n";
echo "GET: ";
print_r($_GET);
echo "<br/>\n";

if (isset($_GET['constants']) && $_GET['constants'] == 'SUCCESS') {
    mail('koman1706@gmail.com', 'Оплата тенькф SUCCESS', 'Оплата тенькф SUCCESS');
} else {
    mail('koman1706@gmail.com', 'Оплата тенькф SUCCESS', 'Оплата тенькф CANSEL');
}