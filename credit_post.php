<?php

//echo "POST: ";
//print_r($_POST);

//echo "<br/>\n";
//echo "GET: ";
//print_r($_GET);
//echo "<br/>\n";

if (isset($_GET['constants']) && $_GET['constants'] == 'HUK') {
    ob_start();
    print_r($_GET);
    $get_str = ob_get_clean();
    
    ob_start();
    print_r($_POST);
    $post_str = ob_get_clean();

    //$str = 'Оплата тинькф HUK GET: ' . implode(' ', $_GET) . ' | POST: ' . implode(' ', $_POST) . ' |';
    echo "GET: {$get_str}\n POST: {$post_str}\n";
    mail('koman1706@gmail.com', 'Оплата тенькф HUK3', "GET: {$get_str}\n POST: {$post_str}\n");
} else {
    if (isset($_GET['constants']) && $_GET['constants'] == 'SUCCESS') {
        mail('koman1706@gmail.com', 'Оплата тенькф SUCCESS', 'Оплата тинькф SUCCESS ' . implode(' ', $_POST));
    } else {
        mail('koman1706@gmail.com', 'Оплата тенькф CANSEL', 'Оплата тинькф CANSEL' . implode(' ', $_POST));
    }
}