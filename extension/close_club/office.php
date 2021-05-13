<?php

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
include_once 'inc.php';

$c_user = new \project\user();
$close_club = new \project\close_club();

$c_products = new \project\products();

if ($c_user->isClient() || $c_user->isEditor()) {
    $close_club_info = $close_club->get_club_user_info($_SESSION['user']['info']['id']);
    //print_r($close_club_info);

    /*
     * Заморозить абонемент кнопки
     */
    $class = 'default';
    $button_class = 'freeze_user_active';
    if ($close_club_info[0]['freeze_day'] < 10) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 10,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );
    if ($close_club_info[0]['freeze_day'] < 20) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 20,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );
    if ($close_club_info[0]['freeze_day'] < 30) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 30,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );
    if ($close_club_info[0]['freeze_day'] < 40) {
        $class = 'lock';
        $button_class = 'lock';
    }
    $freeze_day_buttons[] = array(
        'title_sum' => 40,
        'title_name' => 'дней',
        'button_text' => 'добавить',
        'class' => $class,
        'button_class' => $button_class
    );


    $waresClub = $c_products->getProductsClubArray();
    include 'tmpl/office.php';
}
// Для загрузки активных пользователей
// Запрос в WP
// SELECT
//	dd.*,
//    (SELECT u.user_pass FROM wp_users u WHERE u.user_email=dd._billing_email ) as user_pass
//FROM
//    (
//    SELECT
//        woi.order_id,
//        (SELECT pm.meta_value FROM wp_postmeta pm WHERE pm.post_id=woi.order_id AND pm.meta_key='_billing_email') as _billing_email,
//        (SELECT ww.meta_value FROM wp_woocommerce_order_itemmeta ww WHERE ww.order_item_id=woi.order_item_id and ww.meta_key like '%Instagram%' and ww.meta_value is not null LIMIT 1 ) as Instagram,
//        (select pm.meta_value from wp_postmeta pm WHERE pm.post_id=woi.order_id and pm.meta_key='_billing_phone')  as _billing_phone,
//        (select pm.meta_value from wp_postmeta pm WHERE pm.post_id=woi.order_id and pm.meta_key='_schedule_next_payment')  as _schedule_next_payment,
//        (select pm1.meta_value from wp_postmeta pm1 WHERE pm1.post_id=woi.order_id and pm1.meta_key='_schedule_end')  as _schedule_end
//    FROM
//        wp_woocommerce_order_itemmeta woim
//    LEFT JOIN wp_woocommerce_order_items woi ON
//        woi.order_item_id = woim.order_item_id
//    WHERE
//        woim.meta_key = '_product_id' AND (woim.meta_value = '207431' or woim.meta_value = '374197')
//) dd
//WHERE dd._schedule_next_payment is not null 
//and dd._schedule_end is not null  
//and (dd._schedule_next_payment > NOW() or dd._schedule_end > NOW())
//order by dd.order_id desc
//
//if ($c_user->isAdmin()) {
//    $dd = array(
//        array('order_id' => '532455', '_billing_email' => 'r28jenya@mail.ru', 'Instagram' => 'evgeniy_kurinniy', '_billing_phone' => '79098033701', '_schedule_next_payment' => '2021-06-12 04:25:35', '_schedule_end' => '0', 'user_pass' => '$P$BhtJed/V82vwWq.0Lx9j8HZmq5OcNI/'),
//        array('order_id' => '532290', '_billing_email' => 'diana@bartosevich.lt', 'Instagram' => 'diabartosevic', '_billing_phone' => '+37062614909', '_schedule_next_payment' => '2021-06-11 15:15:46', '_schedule_end' => '0', 'user_pass' => '$P$BuEmKMIAhMiA94QiwCQACWUNY57cfq.'),
//        array('order_id' => '532254', '_billing_email' => 'elena1313@inbox.ru', 'Instagram' => 'elenapogrebnova', '_billing_phone' => '+79824168959', '_schedule_next_payment' => '2021-06-11 13:27:56', '_schedule_end' => '0', 'user_pass' => '$P$BS7CEccO5UC9PphzBbd4LYWN2KAen51'),
//        array('order_id' => '532187', '_billing_email' => 'timofeevich2007@mail.ru', 'Instagram' => 'yulia.happy81', '_billing_phone' => '+79260385044', '_schedule_next_payment' => '2021-06-11 09:49:11', '_schedule_end' => '0', 'user_pass' => '$P$BmG6m2/rfMI9Kdnpw6ICn30SHQqU0d1'),
//        array('order_id' => '532180', '_billing_email' => '271402@mail.ru', 'Instagram' => 'svetlana_tka4uk', '_billing_phone' => '+79213309225', '_schedule_next_payment' => '2021-06-11 09:27:40', '_schedule_end' => '0', 'user_pass' => '$P$Bgi7kzzd3jlR.Eo5nRzRJUPSTP4s5J1'),
//        array('order_id' => '532172', '_billing_email' => 'katya.romantica@rambler.ru', 'Instagram' => '@katya_romantica1', '_billing_phone' => '89631280017', '_schedule_next_payment' => '2021-06-11 08:50:20', '_schedule_end' => '0', 'user_pass' => '$P$BiN.0uPhBLHkUCTQhYAtGa6Kfi5Mnd.'),
//        array('order_id' => '532096', '_billing_email' => 'irishkirov@gmail.com', 'Instagram' => 'irishka_4471', '_billing_phone' => '+7 (925) 110-36-77', '_schedule_next_payment' => '2021-06-11 03:37:50', '_schedule_end' => '0', 'user_pass' => '$P$B4X2Zqmzf1HXgLHGMwcC3qxB.dvsZ5/'),
//        array('order_id' => '532000', '_billing_email' => 'kov3095@yandex.ru', 'Instagram' => 'eloyan.ofelia', '_billing_phone' => '+79038471748', '_schedule_next_payment' => '2021-06-10 19:35:01', '_schedule_end' => '0', 'user_pass' => '$P$BIa5fG8ktESILr6mrkghfN/.bl0JYH.'),
//        array('order_id' => '531969', '_billing_email' => 'cebanma@mail.ru', 'Instagram' => 'Cebanma', '_billing_phone' => '+37378442222', '_schedule_next_payment' => '0', '_schedule_end' => '2021-11-10 17:10:47', 'user_pass' => '$P$BljcyReRvtqM5IZRGqddfAnyqtU.3X/'),
//        array('order_id' => '531924', '_billing_email' => 'stasyashpenkova@yandex.ru', 'Instagram' => 'Anastasyashpenkova', '_billing_phone' => '89288427645', '_schedule_next_payment' => '0', '_schedule_end' => '2021-11-10 13:56:48', 'user_pass' => '$P$BqgTxkWlrgvXON2BiHUAgbXiR.c1od/'),
//        array('order_id' => '531565', '_billing_email' => 'shnirko@mail.ru', 'Instagram' => 'evgeniishnyrko', '_billing_phone' => '+375333562344', '_schedule_next_payment' => '2021-06-09 08:31:17', '_schedule_end' => '0', 'user_pass' => '$P$BHM8L/.2esccVHzWrRdSFO0yljaRpY.'),
//        array('order_id' => '531399', '_billing_email' => 'irina5105@mail.ru', 'Instagram' => 'iantoshkina1', '_billing_phone' => '89153987344', '_schedule_next_payment' => '2021-06-08 20:09:41', '_schedule_end' => '0', 'user_pass' => '$P$BlTS9HC8/V9I9PBpNeKsiRcF1zMQeB/'),
//        array('order_id' => '530168', '_billing_email' => 'n.babyshka55@gmail.com', 'Instagram' => 'nataliia.bro', '_billing_phone' => '+7(968)045-67-73', '_schedule_next_payment' => '2021-06-04 19:28:59', '_schedule_end' => '0', 'user_pass' => '$P$BHRK/SzXif/efmEJt9z.atGTgwTpLM0'),
//        array('order_id' => '529996', '_billing_email' => 'vladin76@mail.ru', 'Instagram' => 'in_best_world', '_billing_phone' => '+77784220611', '_schedule_next_payment' => '2021-06-04 08:36:14', '_schedule_end' => '0', 'user_pass' => '$P$Bpr8/gtm0VkNgrHY2hlNM3bsVWwVu3/'),
//        array('order_id' => '529711', '_billing_email' => 'olgaguza@mail.ru', 'Instagram' => 'olgaguz23', '_billing_phone' => '+79041578085', '_schedule_next_payment' => '2021-06-03 08:31:34', '_schedule_end' => '0', 'user_pass' => '$P$ByutNSIM3QItXHbItAjuYb0nZFxf6l.'),
//        array('order_id' => '529693', '_billing_email' => 'ilinasp@mail.ru', 'Instagram' => 'svet_bogatyreva', '_billing_phone' => '89098580075', '_schedule_next_payment' => '2021-06-03 07:59:41', '_schedule_end' => '0', 'user_pass' => '$P$B/A5CkjRq2f7z1pKxwGuEW07QEJDFk.'),
//        array('order_id' => '529464', '_billing_email' => 'zatolokinas20@gmail.com', 'Instagram' => '@sveta_v_clube', '_billing_phone' => '+380501636987', '_schedule_next_payment' => '2021-06-02 12:28:24', '_schedule_end' => '0', 'user_pass' => '$P$Bl8liHZT/wi2buAXZB59WYK8KnW5Fm/'),
//        array('order_id' => '528619', '_billing_email' => 'savich_m@mail.ru', 'Instagram' => 'mariha_888', '_billing_phone' => '+79168378893', '_schedule_next_payment' => '2021-05-29 11:19:41', '_schedule_end' => '0', 'user_pass' => '$P$BGWK4teXtEECZ.RedpQS1OqpIKtvxu0'),
//        array('order_id' => '527933', '_billing_email' => 'meatdv25@gmail.com', 'Instagram' => 'iraidakov', '_billing_phone' => '79025252089', '_schedule_next_payment' => '2021-05-26 22:43:12', '_schedule_end' => '0', 'user_pass' => '$P$B593dzm7YySvgjgJqVkdAtM03MSyMS0'),
//        array('order_id' => '527746', '_billing_email' => 'alena070276@yandex.ru', 'Instagram' => 'julia_club11', '_billing_phone' => '+79122827124', '_schedule_next_payment' => '0', '_schedule_end' => '2021-05-26 08:44:56', 'user_pass' => '$P$BGvzcGLFx0vDxbvmOM3i1hU3cBsMfk0'),
//        array('order_id' => '526369', '_billing_email' => 'mavari1978@bk.ru', 'Instagram' => 'sveta_krasnoyarsk0611', '_billing_phone' => '+7 983 265-64-34', '_schedule_next_payment' => '2021-05-21 13:21:14', '_schedule_end' => '0', 'user_pass' => '$P$Bd2Jyu0KTItR/YAJOBa5fzqA2M0iCF/'),
//        array('order_id' => '526291', '_billing_email' => 'marina-ls@yandex.ru', 'Instagram' => 'mari.80shka', '_billing_phone' => '+79262163905', '_schedule_next_payment' => '2021-05-21 09:19:35', '_schedule_end' => '0', 'user_pass' => '$P$B2xIcHvJrbZJjBnOn/QAWMTS8UciDw1'),
//        array('order_id' => '526004', '_billing_email' => 'trukhachev_valeriy@mail.ru', 'Instagram' => 'valeron_44', '_billing_phone' => '89856358989', '_schedule_next_payment' => '2021-05-20 08:55:23', '_schedule_end' => '0', 'user_pass' => '$P$BRXQPy9MHZxctYGEzc4rQKoSu3Zn8H0'),
//        array('order_id' => '525877', '_billing_email' => 'matisse-ricco@mail.ru', 'Instagram' => '@denis_tsvetkov1', '_billing_phone' => '89084763852', '_schedule_next_payment' => '2021-05-19 22:59:07', '_schedule_end' => '0', 'user_pass' => '$P$BJkOZoZvqRbuJwQu9hqdZG1qCVK7cP0'),
//        array('order_id' => '525696', '_billing_email' => 'tvtmim@yandex.ru', 'Instagram' => 'nushatanusha87', '_billing_phone' => '89990729245', '_schedule_next_payment' => '2021-05-19 08:57:20', '_schedule_end' => '0', 'user_pass' => '$P$B7Ni9sHUOkHNjg2RdaPrRgw6j5yGiH1'),
//        array('order_id' => '524905', '_billing_email' => 'n.shmelina@gmail.com', 'Instagram' => 'nata_v_klube', '_billing_phone' => '89166704423', '_schedule_next_payment' => '2021-05-16 14:41:12', '_schedule_end' => '0', 'user_pass' => '$P$BiWB2i7o8Si22AeVaMpx5AGh6GtEte/'),
//        array('order_id' => '524852', '_billing_email' => 'ludmilagalashcuk@gmail.com', 'Instagram' => 'liudmilagalashchuk', '_billing_phone' => '9147005450', '_schedule_next_payment' => '2021-05-16 11:25:57', '_schedule_end' => '0', 'user_pass' => '$P$BzqJNxyaHet2NM4eVSrlGEqSt3OYfE0'),
//        array('order_id' => '524462', '_billing_email' => 'nestorsdorov@gmail.com', 'Instagram' => '2021nesterov2021', '_billing_phone' => '89256819060', '_schedule_next_payment' => '2021-05-15 07:10:30', '_schedule_end' => '0', 'user_pass' => '$P$Bg7f9uIb9cBCF9dNUNPaA0dsyi.U041'),
//        array('order_id' => '524444', '_billing_email' => 'tejnatasha@mail.ru', 'Instagram' => 'vozlyublennaya ', '_billing_phone' => '89535255513', '_schedule_next_payment' => '2021-05-15 06:03:44', '_schedule_end' => '0', 'user_pass' => '$P$BNRkpN2sOE2vx4ibITFXTSJsUTLkfC/'),
//        array('order_id' => '524205', '_billing_email' => 'almira_eldorado@mail.ru', 'Instagram' => 'ishberdinaalmira', '_billing_phone' => '9279202354', '_schedule_next_payment' => '2021-05-14 11:28:23', '_schedule_end' => '0', 'user_pass' => '$P$BUcuynqfEUQKRJH1jOzRutD3AJfuIx0'),
//        array('order_id' => '519254', '_billing_email' => 'alexander-rese@yandex.ru', 'Instagram' => 'alexander_1985___', '_billing_phone' => '+4917655614068', '_schedule_next_payment' => '2021-05-31 18:52:23', '_schedule_end' => '0', 'user_pass' => '$P$BEN6pRDfioKT6mW1rlCnwIpM.Zi3YL.'),
//        array('order_id' => '519226', '_billing_email' => 'Kalaeva.83@mail.ru', 'Instagram' => 'tanya_v_klube', '_billing_phone' => '79373967997', '_schedule_next_payment' => '2021-06-07 13:24:31', '_schedule_end' => '0', 'user_pass' => '$P$BC7iXGucB0dRIleSd67Z5kFARHp4Ao0'),
//        array('order_id' => '517259', '_billing_email' => 'nataliatarabarina@mail.ru', 'Instagram' => 'Nataliatarabarina', '_billing_phone' => '+79519031111', '_schedule_next_payment' => '0', '_schedule_end' => '2021-09-23 11:29:25', 'user_pass' => '$P$BhtuseoVHEuK8UhUMtnyw0DHSW4HiI0'),
//        array('order_id' => '515930', '_billing_email' => 'liliya.zakirova.2012@mail.ru', 'Instagram' => 'happiness_and_prosperity777', '_billing_phone' => '89276707223', '_schedule_next_payment' => '2021-05-20 10:37:32', '_schedule_end' => '0', 'user_pass' => '$P$BKT3Hdb7XcWgaNUxASNMpeK0y6A2oS/'),
//        array('order_id' => '514895', '_billing_email' => 'jul88wdesign@mail.ru', 'Instagram' => '@Juliya9390', '_billing_phone' => '+79244848519', '_schedule_next_payment' => '2021-05-16 21:58:44', '_schedule_end' => '0', 'user_pass' => '$P$BMKutW9ij0VVMANkQnuPpE/N4CuFgT/'),
//        array('order_id' => '514269', '_billing_email' => 'irina-sor2008@yandex.ru', 'Instagram' => 'Sorokamir', '_billing_phone' => '+79031460506', '_schedule_next_payment' => '2021-05-14 17:53:37', '_schedule_end' => '0', 'user_pass' => '$P$BXbjonybVEU9WjpOruxd3rrUtIsuGA/'),
//        array('order_id' => '514250', '_billing_email' => 'sp_nadia@mail.ru', 'Instagram' => 'nadya_111447', '_billing_phone' => '89082053034', '_schedule_next_payment' => '2021-05-16 09:01:40', '_schedule_end' => '0', 'user_pass' => '$P$Bp3lCGjEiFDJlbiLAYgvgpqy3uS49F.'),
//        array('order_id' => '512558', '_billing_email' => 'martita00720@gmail.com', 'Instagram' => 'Martamasyuk ', '_billing_phone' => '0953666377', '_schedule_next_payment' => '0', '_schedule_end' => '2021-09-10 09:38:53', 'user_pass' => '$P$B4QhIsvus7dEE29SECUMM0kRKPI11r.'),
//        array('order_id' => '510962', '_billing_email' => 'adelgeym18@mail.ru', 'Instagram' => 'iren.blooming', '_billing_phone' => '9633150235', '_schedule_next_payment' => '2021-06-06 07:01:07', '_schedule_end' => '0', 'user_pass' => '$P$BGr5EUoRs5S5hIe76ZG.caVn8jgTyA/'),
//        array('order_id' => '510873', '_billing_email' => 'olednevok@yandex.ru', 'Instagram' => 'psykvantum', '_billing_phone' => '89586434822', '_schedule_next_payment' => '2021-06-11 19:09:43', '_schedule_end' => '0', 'user_pass' => '$P$BXozforwbbcDqwKxaIyldTnoyOG8gV0'),
//        array('order_id' => '510860', '_billing_email' => 'taranenkoel@mail.ru', 'Instagram' => 'elena__sokolova_26', '_billing_phone' => '89170158669', '_schedule_next_payment' => '2021-06-07 16:53:50', '_schedule_end' => '0', 'user_pass' => '$P$Bhf4b1p6ID/sq/uBIyu.IOcfZBa8U9.'),
//        array('order_id' => '509654', '_billing_email' => 'lora.vasilevska@gmail.com', 'Instagram' => 'lora_eleonora_club', '_billing_phone' => '37129446943', '_schedule_next_payment' => '2021-06-02 04:43:41', '_schedule_end' => '0', 'user_pass' => '$P$ByBWnWF16hRJunBDAcp22JWWadZsuy/'),
//        array('order_id' => '508220', '_billing_email' => 'meela@yandex.ru', 'Instagram' => 'meela.go', '_billing_phone' => '9165737973', '_schedule_next_payment' => '2021-07-25 20:59:08', '_schedule_end' => '0', 'user_pass' => '$P$BAoVSenLdr7vPSDY/hlImiCJw6VY8I1'),
//        array('order_id' => '507984', '_billing_email' => 'mary1234510@yandex.ru', 'Instagram' => 'mar_v_clube', '_billing_phone' => '89897057525', '_schedule_next_payment' => '2021-05-27 19:29:55', '_schedule_end' => '0', 'user_pass' => '$P$BipcGu0Mnb.AL0ynexEkwspk37at2K1'),
//        array('order_id' => '506670', '_billing_email' => 'adil.bagrova@yandex.ruru', 'Instagram' => '9adila ', '_billing_phone' => '+79092866087', '_schedule_next_payment' => '2021-06-10 08:41:18', '_schedule_end' => '0', 'user_pass' => NULL),
//        array('order_id' => '498798', '_billing_email' => 'Bogy807@mail.ru', 'Instagram' => 'Olga_bogy ', '_billing_phone' => '89505112700', '_schedule_next_payment' => '2021-05-28 15:09:43', '_schedule_end' => '0', 'user_pass' => '$P$BJYLeLvzTye8jv9/8JLVzurXM1ShSj/'),
//        array('order_id' => '497378', '_billing_email' => 'irina_iv2000@mail.ru', 'Instagram' => 'irina_kotsyuba', '_billing_phone' => '79169023505', '_schedule_next_payment' => '0', '_schedule_end' => '2021-07-24 17:08:11', 'user_pass' => '$P$BXQ4DJI6gtPd3fi9FzT2OxbB2NG1mU/'),
//        array('order_id' => '496975', '_billing_email' => 'mynameis_yana@mail.ru', 'Instagram' => 'yanochka.club', '_billing_phone' => '+79622575932', '_schedule_next_payment' => '2021-05-24 06:18:30', '_schedule_end' => '0', 'user_pass' => '$P$BQlud.wGPyiivf56APhevHw8QdULF91'),
//        array('order_id' => '496874', '_billing_email' => 'polischuck.cat@ya.ru', 'Instagram' => 'katena16_06', '_billing_phone' => '+79261779280', '_schedule_next_payment' => '2021-05-23 18:50:42', '_schedule_end' => '0', 'user_pass' => '$P$BR2bw827eUkYJpy4B9DFNZd4hDnP7S0'),
//        array('order_id' => '495522', '_billing_email' => 'innafatina30@gmail.com', 'Instagram' => 'imya_inna_petrovna', '_billing_phone' => '9187924035', '_schedule_next_payment' => '2021-05-21 13:16:28', '_schedule_end' => '0', 'user_pass' => '$P$BdhecaGjBCm4ifazwGWhjZ6181MbxG.'),
//        array('order_id' => '494307', '_billing_email' => 'vesipeto@mail.ru', 'Instagram' => 'Julia_vesipeto', '_billing_phone' => '+3580400833823', '_schedule_next_payment' => '2021-06-07 10:23:11', '_schedule_end' => '0', 'user_pass' => '$P$BC/7f6wZBgn2TbyRkyGbt6p2TkdT1a1'),
//        array('order_id' => '492765', '_billing_email' => 'natal2217@yandex.ru', 'Instagram' => 'Na_ta_li7887', '_billing_phone' => '+79271430766', '_schedule_next_payment' => '2021-05-31 19:37:06', '_schedule_end' => '0', 'user_pass' => '$P$BB08OwcThoVacMCr.aiTwOkJ5108Ap/'),
//        array('order_id' => '492655', '_billing_email' => 'onega57@mail.ru', 'Instagram' => ' onega57', '_billing_phone' => '79144005834', '_schedule_next_payment' => '2021-05-13 21:28:50', '_schedule_end' => '0', 'user_pass' => '$P$BC26g0lP73NN0.y6sgDQ.s7iHRRz2F.'),
//        array('order_id' => '489723', '_billing_email' => 'yana.gudovskaya@mail.ru', 'Instagram' => 'Jannaclub', '_billing_phone' => '9307129025', '_schedule_next_payment' => '2021-05-22 06:41:56', '_schedule_end' => '0', 'user_pass' => '$P$BytEcPcFoxWQNZp/CZ4m./WxoAGLeZ.'),
//        array('order_id' => '489497', '_billing_email' => 'fazlyeva.ilnara@mail.ru', 'Instagram' => 'ilnara_club', '_billing_phone' => '89631316969', '_schedule_next_payment' => '2021-06-11 04:02:17', '_schedule_end' => '0', 'user_pass' => '$P$BAomNU9.9F6w5I3wxnJO/9ToDOOUMS/'),
//        array('order_id' => '488707', '_billing_email' => 'anastasiiakolos@gmail.com', 'Instagram' => 'anastasia_v_clube', '_billing_phone' => '+380674163437', '_schedule_next_payment' => '2021-06-11 01:02:24', '_schedule_end' => '0', 'user_pass' => '$P$Bhs/g5r0rEEeFl2N6R7dksBD5yJnHV1'),
//        array('order_id' => '487956', '_billing_email' => 'guliya100@list.ru', 'Instagram' => 'guliya_sher', '_billing_phone' => '89147554632', '_schedule_next_payment' => '0', '_schedule_end' => '2021-06-30 21:18:27', 'user_pass' => '$P$BL08ymQ1nq2PoY9OOZwYSb2aPfO885/'),
//        array('order_id' => '484467', '_billing_email' => 'innulichka11@yahoo.com', 'Instagram' => 'Inna_idet_v_zhizn', '_billing_phone' => '0064211802914', '_schedule_next_payment' => '2021-05-28 12:42:04', '_schedule_end' => '0', 'user_pass' => '$P$BENDHV4w4Eek2bI31rvV.vPThZ46I0.'),
//        array('order_id' => '483026', '_billing_email' => 'onfs@bk.ru', 'Instagram' => 'moya_doroga_k_osoznaniyu', '_billing_phone' => '89166412730', '_schedule_next_payment' => '2021-05-29 14:38:36', '_schedule_end' => '0', 'user_pass' => '$P$Bj1yQQIgwNeNOY4AFoNdt6g5Lm.Ztg0'),
//        array('order_id' => '482854', '_billing_email' => 'svetlana1969.ivanova@yandex.ru', 'Instagram' => 'svetlanagr556', '_billing_phone' => '89811467530', '_schedule_next_payment' => '2021-06-05 10:59:05', '_schedule_end' => '0', 'user_pass' => '$P$Bp9gXN7nP8SUMeqOmVm0il//TrLMXe/'),
//        array('order_id' => '481904', '_billing_email' => 'zumarumba2357@gmail.com', 'Instagram' => 'panfilovaelena1313', '_billing_phone' => '89222226056', '_schedule_next_payment' => '2021-05-19 13:59:25', '_schedule_end' => '0', 'user_pass' => '$P$B9N4Ax7.h9CwKDHQ0DDd.G7rq0OGUf/'),
//        array('order_id' => '479112', '_billing_email' => 'ledy290385@gmail.com', 'Instagram' => 'reginalaishevskaia', '_billing_phone' => '+79274372626', '_schedule_next_payment' => '2021-05-15 19:48:16', '_schedule_end' => '0', 'user_pass' => '$P$BlRmQdrB4Wdh.3kht/T4.7BJfpB5mj0'),
//        array('order_id' => '478793', '_billing_email' => 'salnikov_posledniy_rubezh@mail.ru', 'Instagram' => 'mr_gri1987', '_billing_phone' => '+79117007778', '_schedule_next_payment' => '2021-05-14 17:51:24', '_schedule_end' => '0', 'user_pass' => '$P$BBHqQYdyR1S4BkBaYT/GbRfDLhRRsy1'),
//        array('order_id' => '473887', '_billing_email' => 'ponka_ataka@mail.ru', 'Instagram' => '_polina_2281_', '_billing_phone' => '+4915754041036', '_schedule_next_payment' => '2021-06-09 15:54:37', '_schedule_end' => '0', 'user_pass' => '$P$BoRn6JLVLkP4Zm847K8GTdQ.2JMZx40'),
//        array('order_id' => '472665', '_billing_email' => 'o-v-kovalenko1503@mail.ru', 'Instagram' => '@kovalenko2579', '_billing_phone' => '89146813737', '_schedule_next_payment' => '2021-06-04 01:57:33', '_schedule_end' => '0', 'user_pass' => '$P$BdBxJUg/G1yDAdOt1E2s4MkuzYI.ID1'),
//        array('order_id' => '472513', '_billing_email' => 'kalinkina.ev2018@gmail.com', 'Instagram' => ' katya.kali', '_billing_phone' => '89159564309', '_schedule_next_payment' => '2021-05-21 09:33:29', '_schedule_end' => '0', 'user_pass' => '$P$BMLtdk5Wdx5ZvH9B4Y9x5Q9uy3S3.C/'),
//        array('order_id' => '472494', '_billing_email' => 'smotrov78sl@yandex.ru', 'Instagram' => 'iana.smotrova', '_billing_phone' => '89135637807', '_schedule_next_payment' => '2021-05-23 04:41:12', '_schedule_end' => '0', 'user_pass' => '$P$BO/OvfGI3rQ51jG2BnoOeDDQX0sYuv0'),
//        array('order_id' => '472075', '_billing_email' => 'semidetko1984@mail.ru', 'Instagram' => 'raisazemlianskaia1', '_billing_phone' => '79853380427', '_schedule_next_payment' => '2021-06-02 19:16:22', '_schedule_end' => '0', 'user_pass' => '$P$B0QJHVfqOSyJlFlYsVE21bt.Rtu6Zd/'),
//        array('order_id' => '471998', '_billing_email' => 'kutlubaevaviktoria@gmail.com', 'Instagram' => 'viktoriyakutlubaeva', '_billing_phone' => '89145680676', '_schedule_next_payment' => '2021-06-02 12:28:06', '_schedule_end' => '0', 'user_pass' => '$P$BimSqcQGuRGelnbf1SWFgj89h8Tgh90'),
//        array('order_id' => '469402', '_billing_email' => 'mestkris93@gmail.com', 'Instagram' => 'Prinkris', '_billing_phone' => '79215933747', '_schedule_next_payment' => '2021-05-19 10:25:22', '_schedule_end' => '0', 'user_pass' => '$P$B7qW36qlUY34m/nLmElvE/OrG2.HnB0'),
//        array('order_id' => '468320', '_billing_email' => 'gaildou2@gmail.com', 'Instagram' => 'gala070861', '_billing_phone' => '89298137280', '_schedule_next_payment' => '2021-06-11 12:36:53', '_schedule_end' => '0', 'user_pass' => '$P$Be6GnjYYqKXkLk0Gq3pHyVkyDroYhH1'),
//        array('order_id' => '468137', '_billing_email' => 'dogs-galina@mail.ru', 'Instagram' => 'galinagorch', '_billing_phone' => '89152363784', '_schedule_next_payment' => '2021-06-11 08:28:07', '_schedule_end' => '0', 'user_pass' => '$P$BZnvrmoV986L5.bj2YtEVpujIj/0cJ0'),
//        array('order_id' => '467834', '_billing_email' => 'bocharovakate29@gmail.com', 'Instagram' => 'kate.calde', '_billing_phone' => '+18183920535', '_schedule_next_payment' => '0', '_schedule_end' => '2021-05-23 05:13:12', 'user_pass' => '$P$BFyK6XqDwSgWwmSWBH7TUerumOyTpL1'),
//        array('order_id' => '466030', '_billing_email' => 'chernikova_elena@list.ru', 'Instagram' => 'Oresshkina', '_billing_phone' => '+79099014343', '_schedule_next_payment' => '2021-05-25 15:58:52', '_schedule_end' => '0', 'user_pass' => '$P$BIgi.NEieoiuYChVY.3ceGoSZssZaD0'),
//        array('order_id' => '464946', '_billing_email' => 'tatyana_0487@mail.ru', 'Instagram' => 'tatyana87love', '_billing_phone' => '+79059052932', '_schedule_next_payment' => '2021-05-29 01:11:19', '_schedule_end' => '0', 'user_pass' => '$P$BQNWL7VE90uUcPnAZf00gLQxs0WYuA.'),
//        array('order_id' => '463972', '_billing_email' => 'imanis@bk.ru', 'Instagram' => 'imana_aliyeva11', '_billing_phone' => '89514400258', '_schedule_next_payment' => '2021-05-18 15:04:12', '_schedule_end' => '0', 'user_pass' => '$P$B.QZ60TtQNJ/nlzojIVPQj9twFAqVs/'),
//        array('order_id' => '463197', '_billing_email' => 'iulya.shishkova@yandex.ru', 'Instagram' => 'yulyashall', '_billing_phone' => '8(916)4622705', '_schedule_next_payment' => '0', '_schedule_end' => '2021-05-22 18:56:42', 'user_pass' => '$P$B0LHZnx.X5MzqG0GYBXTa18irCIkER0'),
//        array('order_id' => '463166', '_billing_email' => 'rouz.09@mail.ru', 'Instagram' => 'Irish.ka02', '_billing_phone' => '+972548052343', '_schedule_next_payment' => '0', '_schedule_end' => '2021-05-27 18:05:19', 'user_pass' => '$P$BDIElemL8zrC4nG0Gx3ZXGkUikDSek.'),
//        array('order_id' => '463129', '_billing_email' => 'r2i2n@mail.ru', 'Instagram' => 'liliya.club', '_billing_phone' => '+79063232724', '_schedule_next_payment' => '0', '_schedule_end' => '2021-05-31 17:37:53', 'user_pass' => '$P$BTdU1euyi1PMc67loRdhNo//nRcrMu1'),
//        array('order_id' => '463036', '_billing_email' => 'shannon.stepanova@gmail.com', 'Instagram' => 'anna_anutaclub', '_billing_phone' => '89035969310', '_schedule_next_payment' => '0', '_schedule_end' => '2021-06-11 14:51:52', 'user_pass' => '$P$ByenCUL1KwyvtlTVQnUy7nwubsv0HW0'),
//        array('order_id' => '462160', '_billing_email' => 'azana78@yandex.ru', 'Instagram' => 'nata.lia.nata123', '_billing_phone' => '+79192380038', '_schedule_next_payment' => '0', '_schedule_end' => '2021-05-29 12:46:34', 'user_pass' => '$P$BqNyo6hvnq.Cuqpc70p8adX53fS9Tr1'),
//        array('order_id' => '438728', '_billing_email' => 'bamboocha1104@mail.ru', 'Instagram' => 'mariya__klub', '_billing_phone' => '77023688813', '_schedule_next_payment' => '2021-05-26 15:38:34', '_schedule_end' => '0', 'user_pass' => '$P$BC/aglMzaT6.BROc0pZrxHjhdyzmdS0'),
//        array('order_id' => '435098', '_billing_email' => 'olesea.prodan1983@gmail.com', 'Instagram' => 'oleseaprodan', '_billing_phone' => '0037369197710', '_schedule_next_payment' => '0', '_schedule_end' => '2021-06-23 20:54:50', 'user_pass' => '$P$BxkTZbi0sJTk80q7NypoTDdyMRLIPa0'),
//        array('order_id' => '427758', '_billing_email' => 'annafoss@yandex.ru', 'Instagram' => 'schastlivaya_koldunya', '_billing_phone' => '89296185049', '_schedule_next_payment' => '0', '_schedule_end' => '2021-06-23 12:00:12', 'user_pass' => '$P$BsZqG7ux7nNe5D5fO8vdMIQAsdWe5B1'),
//        array('order_id' => '398322', '_billing_email' => 'zacharenok@mail.ru', 'Instagram' => 'anna_zaharova2029', '_billing_phone' => '+79117230333', '_schedule_next_payment' => '2021-05-12 12:02:46', '_schedule_end' => '0', 'user_pass' => '$P$BJ277Qg/lYarfC5qWw.7hdGUdrGF901')
//    );
//
//    foreach ($dd as $value) {
//        $close_club->import_club_data($value);
//    }
//}