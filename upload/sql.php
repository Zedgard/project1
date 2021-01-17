<?php

/* 
 * Запрос на получение покупок
 */

select dd.* from (
SELECT p.ID, p.post_status, p.post_date, p.post_title, 
(select p1.meta_value from wp_postmeta p1 where p1.post_id=p.id and p1.meta_key='_transaction_id') as _transaction_id,
(select p2.meta_value from wp_postmeta p2 where p2.post_id=p.id and p2.meta_key='_payment_method' LIMIT 1) as _payment_method,
(select p3.meta_value from wp_postmeta p3 where p3.post_id=p.id and p3.meta_key='_payment_method_title' LIMIT 1) as _payment_method_title,    
(select p4.meta_value from wp_postmeta p4 where p4.post_id=p.id and p4.meta_key='_paid_date' LIMIT 1) as _paid_date,    
(select p5.meta_value from wp_postmeta p5 where p5.post_id=p.id and p5.meta_key='_completed_date' LIMIT 1) as _completed_date, 
(select p6.meta_value from wp_postmeta p6 where p6.post_id=p.id and p6.meta_key='_billing_email' LIMIT 1) as _billing_email,  
(select p7.meta_value from wp_postmeta p7 where p7.post_id=p.id and p7.meta_key='_billing_phone') as _billing_phone,  
(select p8.meta_value from wp_postmeta p8 where p8.post_id=p.id and p8.meta_key='_order_currency') as _order_currency, 
(select p9.meta_value from wp_postmeta p9 where p9.post_id=p.id and p9.meta_key='_order_total') as _order_total, 
(select p10.meta_value from wp_postmeta p10 where p10.post_id=p.id and p10.meta_key='_paypal_status') as _paypal_status
FROM wp_posts p
where p.post_type='shop_order' and p.post_date BETWEEN '2020-10-01' and '2020-11-01' and p.post_status='wc-completed'
    ) dd 
    where dd._paypal_status='completed' and dd._transaction_id is not null
    order by dd.post_date asc

        
/*
 * Покупки пользователя
 */        
SELECT DISTINCT
    p.ID,
    p.post_status,
    p.post_date,
    p.post_title,
    (select p1.meta_value from wp_postmeta p1 where p1.post_id=p.id and p1.meta_key='_transaction_id') as _transaction_id,
    (select p2.meta_value from wp_postmeta p2 where p2.post_id=p.id and p2.meta_key='_payment_method' LIMIT 1) as _payment_method,
    (select p3.meta_value from wp_postmeta p3 where p3.post_id=p.id and p3.meta_key='_payment_method_title' LIMIT 1) as _payment_method_title,    
    (select p4.meta_value from wp_postmeta p4 where p4.post_id=p.id and p4.meta_key='_paid_date' LIMIT 1) as _paid_date,    
    (select p5.meta_value from wp_postmeta p5 where p5.post_id=p.id and p5.meta_key='_completed_date' LIMIT 1) as _completed_date, 
    (select p6.meta_value from wp_postmeta p6 where p6.post_id=p.id and p6.meta_key='_billing_email' LIMIT 1) as _billing_email,  
    (select p7.meta_value from wp_postmeta p7 where p7.post_id=p.id and p7.meta_key='_billing_phone') as _billing_phone,  
    (select p8.meta_value from wp_postmeta p8 where p8.post_id=p.id and p8.meta_key='_order_currency') as _order_currency, 
    (select p9.meta_value from wp_postmeta p9 where p9.post_id=p.id and p9.meta_key='_order_total') as _order_total, 
    (select p10.meta_value from wp_postmeta p10 where p10.post_id=p.id and p10.meta_key='_paypal_status') as _paypal_status
FROM
    wp_posts p
LEFT JOIN wp_postmeta pm ON
    pm.post_id = p.ID
WHERE
    p.post_type = 'shop_order' AND p.post_status = 'wc-completed' and pm.meta_value='___Mirage___@mail.ru'        