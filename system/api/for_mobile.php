<?php
/*
  Plugin Name: For Mobile
  Version: 1
 */


add_action('rest_api_init', function() {

    register_rest_route('wp/v2', '/check_user/', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_check_user_func',
            'args' => array(
                'email' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'password' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/user_update', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_update_user_func',
            'args' => array(
                'email' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/transaction', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_transaction_func',
            'args' => array(
                'order_id' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/booked', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_booked_func',
            'permission_callback' => 'is_user_logged_in',
            'args' => array(
                'user_id' => array(
                    'type' => 'string',
                    'sanitize_callback' => 'sanitize_int'
                ),
                'booked_id' => array(
                    'type' => 'string',
                    'sanitize_callback' => 'sanitize_int'
                ),
            ),
        )
    ));

    register_rest_route('wp/v2', '/ya_payment', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_ya_payment_func',
            'args' => array(
                'order_id' => array(
                    'type' => 'integer',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/appointment', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_appointment_func',
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/appointment_v2', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_appointment_func_v2',
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/appointment_employee', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_appointment_employee_func',
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/create_appointment', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_create_appointment',
            'args' => array(
                'user_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
                'name' => array(
                    'type' => 'string',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                'surname' => array(
                    'type' => 'string',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                'phone' => array(
                    'type' => 'string',
                    'required' => true,
                    'sanitize_callback' => 'wc_sanitize_phone_number'
                ),
                'date' => array(
                    'type' => 'string',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_text_field',
                    'validate_callback' => 'validate_date'
                ),
                'timeslot' => array(
                    'type' => 'string',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_text_field',
                    'validate_callback' => 'validate_timeslot'
                ),
                'uid' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/order_connecton', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_order_connecton_func',
            'args' => array(
                'booked_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
                'order_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/order_completed', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_order_completed_func',
            'args' => array(
                'order_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
                'payment_token' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'total' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/apple_pay', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_apple_pay_func',
            'args' => array(
                'order_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'sanitize_callback' => 'sanitize_int'
                ),
                'payment_data' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/update_token_firebase', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_update_token_firebase_func',
            'args' => array(
                'device_id' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'token_firebase' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    register_rest_route('wp/v2', '/get_case_products', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_get_case_products_func',
            'args' => array(
                'case_id' => array(
                    'type' => 'integer',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    /*
     * *
     * Роут добавлен Кашталап АА 08052020

     * Для получения списка продуктов без ограничений на количество.
     *

     */
    register_rest_route('wc/v3', '/products_v2', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_get_products_v2_func',
            'args' => array(
                'status' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'category' => array(
                    'type' => 'integer',
                    'required' => true,
                ),
                'per_page' => array(
                    'type' => 'integer',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    /*
     * *
     * Роут добавлен Кашталап АА 07052020

     * Данный роут возвращает массив с информацией о имеющихся категориях товара магазина.
     *

     */
    register_rest_route('wc/v2', '/list_categories', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_list_categories_func',
            'permission_callback' => null,
        )
    ));

    /*
     * *
     * Роут добавлен Кашталап АА 08052020

     * Для тестов.
     *

     */
    register_rest_route('wc/v2', '/my_list_employee', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_list_employee_func',
            'permission_callback' => null,
        )
    ));

    /*
     * * Роут для авторизации по новой схеме в мобильном приложении
     *
     *   Создал Кашталап АА. 20-05-2020
     *
     * * Параметры (обязательные):
     * login - логин или е-мейл юзера
     * type - тип (login or email)
     */
    register_rest_route('wp/v2', '/auth_v2_check_user', array(
        array(
            'methods' => 'GET',
            'callback' => 'my_auth_v2_check_user_func',
            'args' => array(
                'login' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'type' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    /*
     * * Роут для установки и отправки временного пароля по новой схеме в мобильном приложении
     *
     *   Создал Кашталап АА. 20-05-2020
     *
     * * Параметры (обязательные):
     * email - email пользователя
     */
    register_rest_route('wp/v2', '/auth_v2_send_temp_pass', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_auth_v2_send_temp_pass_func',
            'args' => array(
                'email' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));

    /*
     * * Роут для логина пользователя по новой схеме в мобильном приложении
     *
     *   Создал Кашталап АА. 20-05-2020
     *
     * * Параметры (обязательные):
     * email - email пользователя
     * password - пароль
     */
    register_rest_route('wp/v2', '/auth_v2_login', array(
        array(
            'methods' => 'POST',
            'callback' => 'my_auth_v2_login_func',
            'args' => array(
                'email' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'password' => array(
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'permission_callback' => 'is_user_logged_in',
        )
    ));
});


/*
 * * Функция для роута wp/v2/auth_v2_check_user
 */

function my_auth_v2_check_user_func($request) {

    //берем переданные параметры
    $type = $request->get_param('type');
    $login = trim($request->get_param('login'));

    //проверяем на корректность параметр тип логина
    if ($type != "login" && $type != "email") {

        return [
            'result' => 'error',
            'error' => 'incorrect_field_type',
            'error_description' => 'Field type wrong (only login or email)'
        ];
    } else {//если передадные параметры корректны
        //ищем юзера по переданному типу
        $user = get_user_by($type, $login);

        if ($user) {//нашли, возвращем успешный ответ
            return [
                'result' => 'success',
                'description' => "User $login by $type found.",
                'user_id' => $user->ID,
                'email' => $user->user_email
            ];
        } else {// не нашли, возвращем ошибку
            return [
                'result' => 'error',
                'error' => 'user_not_found',
                'error_description' => "User $login by $type not found."
            ];
        }
    }
}

/*
 * * Функция для роута wc/v3/products_v2
 */

function my_get_products_v2_func($request) {

    $args = [
        'status' => $request->get_param('status'),
        'category' => get_term_by('id', $request->get_param('category'), 'product_cat', 'ARRAY_A'),
        'limit' => $request->get_param('per_page'),
    ];

    $products = wc_get_products($args);

    $results = array();

    foreach ($products as $product) {

        $data = array(
            'id' => $product->get_id(),
            'name' => $product->get_name($context),
            'slug' => $product->get_slug($context),
            'permalink' => $product->get_permalink(),
            'date_created' => wc_rest_prepare_date_response($product->get_date_created($context), false),
            'date_created_gmt' => wc_rest_prepare_date_response($product->get_date_created($context)),
            'date_modified' => wc_rest_prepare_date_response($product->get_date_modified($context), false),
            'date_modified_gmt' => wc_rest_prepare_date_response($product->get_date_modified($context)),
            'type' => $product->get_type(),
            'status' => $product->get_status($context),
            'featured' => $product->is_featured(),
            'catalog_visibility' => $product->get_catalog_visibility($context),
            'description' => 'view' === $context ? wpautop(do_shortcode($product->get_description())) : $product->get_description($context),
            'short_description' => 'view' === $context ? apply_filters('woocommerce_short_description', $product->get_short_description()) : $product->get_short_description($context),
            'sku' => $product->get_sku($context),
            'price' => $product->get_price($context),
            'regular_price' => $product->get_regular_price($context),
            'sale_price' => $product->get_sale_price($context) ? $product->get_sale_price($context) : '',
            'date_on_sale_from' => wc_rest_prepare_date_response($product->get_date_on_sale_from($context), false),
            'date_on_sale_from_gmt' => wc_rest_prepare_date_response($product->get_date_on_sale_from($context)),
            'date_on_sale_to' => wc_rest_prepare_date_response($product->get_date_on_sale_to($context), false),
            'date_on_sale_to_gmt' => wc_rest_prepare_date_response($product->get_date_on_sale_to($context)),
            'price_html' => $product->get_price_html(),
            'on_sale' => $product->is_on_sale($context),
            'purchasable' => $product->is_purchasable(),
            'total_sales' => $product->get_total_sales($context),
            'virtual' => $product->is_virtual(),
            'downloadable' => $product->is_downloadable(),
            'downloads' => get_downloads_art($product),
            'download_limit' => $product->get_download_limit($context),
            'download_expiry' => $product->get_download_expiry($context),
            'external_url' => $product->is_type('external') ? $product->get_product_url($context) : '',
            'button_text' => $product->is_type('external') ? $product->get_button_text($context) : '',
            'tax_status' => $product->get_tax_status($context),
            'tax_class' => $product->get_tax_class($context),
            'manage_stock' => $product->managing_stock(),
            'stock_quantity' => $product->get_stock_quantity($context),
            //'in_stock'              => $product->is_in_stock(),               //иное название поля
            'stock_status' => $product->get_stock_status(), //поле вместо поля выше
            'backorders' => $product->get_backorders($context),
            'backorders_allowed' => $product->backorders_allowed(),
            'backordered' => $product->is_on_backorder(),
            'sold_individually' => $product->is_sold_individually(),
            'weight' => $product->get_weight($context),
            'dimensions' => array(
                'length' => $product->get_length($context),
                'width' => $product->get_width($context),
                'height' => $product->get_height($context),
            ),
            'shipping_required' => $product->needs_shipping(),
            'shipping_taxable' => $product->is_shipping_taxable(),
            'shipping_class' => $product->get_shipping_class(),
            'shipping_class_id' => $product->get_shipping_class_id($context),
            'reviews_allowed' => $product->get_reviews_allowed($context),
            'average_rating' => 'view' === $context ? wc_format_decimal($product->get_average_rating(), 0) : $product->get_average_rating($context), //округление до целых в ином методе
            'rating_count' => $product->get_rating_count(),
            'related_ids' => array_map('absint', array_values(wc_get_related_products($product->get_id()))),
            'upsell_ids' => array_map('absint', $product->get_upsell_ids($context)),
            'cross_sell_ids' => array_map('absint', $product->get_cross_sell_ids($context)),
            'parent_id' => $product->get_parent_id($context),
            'purchase_note' => 'view' === $context ? wpautop(do_shortcode(wp_kses_post($product->get_purchase_note()))) : $product->get_purchase_note($context),
            'categories' => get_taxonomy_terms_art($product),
            'tags' => get_taxonomy_terms_art($product, 'tag'),
            'images' => get_images_art($product), //лишнее поле в стуктуре
            'attributes' => [], //get_attributes_art( $product ),
            'default_attributes' => get_default_attributes_art($product),
            'variations' => array(),
            'grouped_products' => array(),
            'menu_order' => $product->get_menu_order($context),
            'meta_data' => $product->get_meta_data(),
            'bundle_layout' => "", //не хватает этого поля
            'bundled_by' => [], //не хватает этого поля
            'bundled_items' => [], //не хватает этого поля
            '_links' => array(
                'self' => array(array('href' => "https://edgardzaitsev.com/wp-json/wc/v3/products/" . $product->get_id())),
                'collection' => array(array('href' => "https://edgardzaitsev.com/wp-json/wc/v3/products"))
            ), //не хватает этого поля
        );

        $results[] = $data;
    }

    return $results;
}

/**
 * 
 *
 * Функция взята из файла wp-content/plugins/woocommerce/includes/api/v2/class-wc-rest-products-v2-controller.php
 * 27062020 Кашталап АА, чтобы получать больше 100 продуктов за раз
 * 
 *
 * 
 */
function get_taxonomy_terms_art($product, $taxonomy = 'cat') {
    $terms = array();

    foreach (wc_get_object_terms($product->get_id(), 'product_' . $taxonomy) as $term) {
        $terms[] = array(
            'id' => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
        );
    }

    return $terms;
}

/**
 * 
 * Функция взята из файла wp-content/plugins/woocommerce/includes/api/v2/class-wc-rest-products-v2-controller.php
 * 27062020 Кашталап АА, чтобы получать больше 100 продуктов за раз
 * 
 *
 * 
 */
function get_downloads_art($product) {
    $downloads = array();

    if ($product->is_downloadable()) {
        foreach ($product->get_downloads() as $file_id => $file) {
            $downloads[] = array(
                'id' => $file_id, // MD5 hash.
                'name' => $file['name'],
                'file' => $file['file'],
            );
        }
    }

    return $downloads;
}

/**
 * 
 * Функция взята из файла wp-content/plugins/woocommerce/includes/api/v2/class-wc-rest-products-v2-controller.php
 * 27062020 Кашталап АА, чтобы получать больше 100 продуктов за раз
 * 
 *
 * @return array
 */
function get_images_art($product) {
    $images = array();
    $attachment_ids = array();

    // Add featured image.
    if ($product->get_image_id()) {
        $attachment_ids[] = $product->get_image_id();
    }

    // Add gallery images.
    $attachment_ids = array_merge($attachment_ids, $product->get_gallery_image_ids());

    // Build image data.
    foreach ($attachment_ids as $position => $attachment_id) {
        $attachment_post = get_post($attachment_id);
        if (is_null($attachment_post)) {
            continue;
        }

        $attachment = wp_get_attachment_image_src($attachment_id, 'full');
        if (!is_array($attachment)) {
            continue;
        }

        $images[] = array(
            'id' => (int) $attachment_id,
            'date_created' => wc_rest_prepare_date_response($attachment_post->post_date, false),
            'date_created_gmt' => wc_rest_prepare_date_response(strtotime($attachment_post->post_date_gmt)),
            'date_modified' => wc_rest_prepare_date_response($attachment_post->post_modified, false),
            'date_modified_gmt' => wc_rest_prepare_date_response(strtotime($attachment_post->post_modified_gmt)),
            'src' => current($attachment),
            'name' => get_the_title($attachment_id),
            'alt' => get_post_meta($attachment_id, '_wp_attachment_image_alt', true),
                //'position'          => (int) $position,
        );
    }

    // Set a placeholder image if the product has no images set.
    if (empty($images)) {
        $images[] = array(
            'id' => 0,
            'date_created' => wc_rest_prepare_date_response(current_time('mysql'), false), // Default to now.
            'date_created_gmt' => wc_rest_prepare_date_response(current_time('timestamp', true)), // Default to now.
            'date_modified' => wc_rest_prepare_date_response(current_time('mysql'), false),
            'date_modified_gmt' => wc_rest_prepare_date_response(current_time('timestamp', true)),
            'src' => wc_placeholder_img_src(),
            'name' => __('Placeholder', 'woocommerce'),
            'alt' => __('Placeholder', 'woocommerce'),
            'position' => 0,
        );
    }

    return $images;
}

/**
 * Функция взята из файла wp-content/plugins/woocommerce/includes/api/v2/class-wc-rest-products-v2-controller.php
 * 27062020 Кашталап АА, чтобы получать больше 100 продуктов за раз
 *
 * @param WC_Product|WC_Product_Variation $product Product instance.
 *
 * @return array
 */
function get_attributes_art($product) {
    $attributes = array();
    try {
        if ($product->is_type('variation')) {
            $_product = wc_get_product($product->get_parent_id());
            foreach ($product->get_variation_attributes() as $attribute_name => $attribute) {
                $name = str_replace('attribute_', '', $attribute_name);

                if (empty($attribute) && '0' !== $attribute) {
                    continue;
                }

                // Taxonomy-based attributes are prefixed with `pa_`, otherwise simply `attribute_`.
                if (0 === strpos($attribute_name, 'attribute_pa_')) {
                    $option_term = get_term_by('slug', $attribute, $name);
                    $attributes[] = array(
                        'id' => wc_attribute_taxonomy_id_by_name($name),
                        'name' => $this->get_attribute_taxonomy_name($name, $_product),
                        'option' => $option_term && !is_wp_error($option_term) ? $option_term->name : $attribute,
                    );
                } else {
                    $attributes[] = array(
                        'id' => 0,
                        'name' => $this->get_attribute_taxonomy_name($name, $_product),
                        'option' => $attribute,
                    );
                }
            }
        } else {
            foreach ($product->get_attributes() as $attribute) {
                $attributes[] = array(
                    'id' => $attribute['is_taxonomy'] ? wc_attribute_taxonomy_id_by_name($attribute['name']) : 0,
                    'name' => $this->get_attribute_taxonomy_name($attribute['name'], $product),
                    'position' => (int) $attribute['position'],
                    'visible' => (bool) $attribute['is_visible'],
                    'variation' => (bool) $attribute['is_variation'],
                    'options' => $this->get_attribute_options($product->get_id(), $attribute),
                );
            }
        }
    } catch (Exception $e) {
        return $attributes;
    }
    return $attributes;
}

/**
 * Функция взята из файла wp-content/plugins/woocommerce/includes/api/v2/class-wc-rest-products-v2-controller.php
 * 27062020 Кашталап АА, чтобы получать больше 100 продуктов за раз
 * 
 * @param WC_Product $product Product instance.
 *
 * @return array
 */
function get_default_attributes_art($product) {
    $default = array();

    if ($product->is_type('variable')) {
        foreach (array_filter((array) $product->get_default_attributes(), 'strlen') as $key => $value) {
            if (0 === strpos($key, 'pa_')) {
                $default[] = array(
                    'id' => wc_attribute_taxonomy_id_by_name($key),
                    'name' => $this->get_attribute_taxonomy_name($key, $product),
                    'option' => $value,
                );
            } else {
                $default[] = array(
                    'id' => 0,
                    'name' => $this->get_attribute_taxonomy_name($key, $product),
                    'option' => $value,
                );
            }
        }
    }

    return $default;
}

/*
 * * Функция для роута wp/v2/auth_v2_send_temp_pass
 */

function my_auth_v2_send_temp_pass_func($request) {

    //берем переданные параметры и подготавливаем логин, если будем вставлять нового юзера
    $login = 'user_' . time() . rand(1, 9);
    $email = $request->get_param('email');

    //ищем юзера
    $user = get_user_by('email', $email);

    //если нашли, то ставим ему временный пароль и отпрвляем его по почте
    if ($user) {

        api_update_user($user->ID);

        $response = array(
            'result' => 'success',
            'description' => "Temp pass for $email was created.",
            'user_id' => $user->ID,
            'email' => $user->user_email
        );
    } else {//если не нашли, то создаем нового юзера с переданной почтой
        //ставим ему временный пароль и отпрвляем его по почте
        $user_id = wp_create_user($login, $pass, $email);

        if (is_wp_error($user_id)) {//проверяем на ошибки при создании
            $response = array(
                'result' => 'error',
                'error' => 'error_user_create',
                'error_description' => $user_id->get_error_message()
            );
        } else {

            api_update_user($user_id); //ставим новому юзеру временный пароль и отпрвляем его по почте

            $response = array(
                'result' => 'success',
                'description' => "Temp pass for $email was created.",
                'user_id' => $user->ID,
                'email' => $user->user_email
            );
        }
    }

    return $response;
}

/*
 * * Функция для роута wp/v2/auth_v2_login
 */

function my_auth_v2_login_func($request) {

    //извлекаем переданны данные
    $email = $request->get_param('email');
    $password = $request->get_param('password');

    //находим юзера
    $user = get_user_by('email', $email);

    if ($user) {

        //проверяем сначала постоянный пароль юзера
        $check = wp_check_password($password, $user->user_pass);

        //проверяем временный пароль
        $check_temp = api_check_password($user->ID, $password);

        //если постоянный пароль и временный не совпал с переданным, то вертаем ошибку
        if (!$check && !$check_temp) {

            $response = array(
                'result' => 'error',
                'error' => 'passwords_dont_match',
                'error_description' => 'Пароль введен не верно.'
            );
        } else {//иначе успешно
            $response = array(
                'result' => 'success',
                'description' => "Успешная авторизация.",
                'user_id' => $user->ID,
                'email' => $user->user_email
            );
        }
    } else {//возвращаем ошибку, если пользователь не существует
        $response = array(
            'result' => 'error',
            'error' => 'user_not_found',
            'error_description' => 'Пользователь с таким email не найден.'
        );
    }

    return $response;
}

function my_list_categories_func() {
    return get_terms(['taxonomy' => 'product_cat']);
}

function my_list_employee_func() {

    $terms = get_terms(['taxonomy' => 'booked_custom_calendars']);

    $empl = array();
    foreach ($terms as $term) {

        $empl[] = array('name' => $term->name, 'uid' => $term->term_id);
    }
    return $empl;
}

function my_check_user_func($request) {

    $email = $request->get_param('email');
    $password = $request->get_param('password');

    $user = get_user_by('email', $email);

    if ($user) {

        // $check = wp_check_password( $password, $user->user_pass );

        $check = api_check_password($user->ID, $password);

        if (!$check) {
            $response = array(
                'code' => 'passwords_dont_match',
                'message' => 'Пароль введен не верно.',
                'data' => null
            );
        } else {
            $response = array(
                'user_id' => $user->ID
            );
        }
    } else {
        $response = array(
            'code' => 'user_not_found',
            'message' => 'Пользователь с таким email не найден.',
            'data' => null
        );
    }

    return $response;
}

function my_update_user_func($request) {
    $login = 'user_' . time() . rand(1, 9);
    $email = $request->get_param('email');

    $user = get_user_by('email', $email);

    if ($user) {

        api_update_user($user->ID);

        $response = array(
            'user_id' => $user->ID
        );
    } else {
        $user_id = wp_create_user($login, $pass, $email);

        if (is_wp_error($user_id)) {
            $response = array(
                'code' => 'error_user_create',
                'message' => $user_id->get_error_message(),
                'data' => null
            );
        } else {

            api_update_user($user_id);

            $response = array(
                'user_id' => $user_id
            );
        }
    }

    /* if(isset($response['user_id'])) {
      $message = 'Ваш пароль для входа: ' . $pass;
      wp_mail($email, 'Регистрация на «Эдгард Зайцев»', $message);
      } */

    return $response;
}

function my_transaction_func($request) {
    $order = wc_get_order($request->get_param('order_id'));
    $paymentId = $order->get_transaction_id();

    return array(
        'paymentId' => $paymentId
    );
}

function my_booked_func($request) {
    $user_id = $request->get_param('user_id');
    $booked_id = $request->get_param('booked_id');

    return get_booked_func($user_id, $booked_id);
}

function get_booked_func($user_id = '', $booked_id = '', $date = '') {
    $args = [
        'numberposts' => '-1',
        'post_type' => 'booked_appointments',
        'orderby' => 'ID',
    ];

    if ($user_id) {
        $args['meta_key'] = '_appointment_user';
        $args['meta_value'] = $user_id;
    } else if ($booked_id) {
        $args['include'] = $booked_id;
    }
    /*
     * *
     * Добавил Кашталап АА
     * Для облегчения выборки при запросе записей для назначения консультаций в мобильном приложении
     * 08052020      
     */ elseif ($date) {

        $args['date_query'] = $date;
    }

    $posts = get_posts($args);

    $appointments = [];
    if ($posts) {
        foreach ($posts as $key => $post) {
            $appointment = Booked_WC_Appointment::get((int) $post->ID);
            if ($appointment) {
                $appointments[] = $appointment;
            }
        }
    }

    return $appointments;
}

function my_ya_payment_func($request) {
    $yaPaymentUrl = getYaPaymentUrl($request->get_param('order_id'));

    return array(
        'payment_url' => print_r($yaPaymentUrl, true)
    );
}

/**
 * @param  string $date - 20190801
 * @param  string $time - 1400
 * @return boolean
 */
function my_check_empty_slot($term_id, $date, $time, $full_count) {
    global $wpdb;

    $disableds = get_option('booked_disabled_timeslots');
    $datef = preg_replace('/(\d{4})(\d{2})(\d{2})/', '$1-$2-$3', $date);
    if (isset($disableds[$term_id][$datef][$time])) {
        return false;
    }

    $datef = preg_replace('/(\d{4})(\d{2})(\d{2})/', '$3.$2.$1', $date);
    $timef = preg_replace('/^(\d{2})(\d{2})(.+)/', '$1:$2', $time);
    $datetimef = $datef . ' @ ' . $timef;

    // Получаем количество сделанных заказов на время записи
    $busySlots = intval($wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->posts} WHERE post_type = 'booked_appointments' AND post_title LIKE '{$datetimef}%'"));

    if ($busySlots >= $full_count) {
        return false;
    }

    return true;
}

function my_appointment_func() {
    $terms = get_terms([
        'taxonomy' => 'booked_custom_calendars'
    ]);

    $mass = [];
    $num = 1;
    $curDate = date(Ymd);

    /*
     * *
     * Добавил Кашталап АА
     * Для отключения возможности бронить через айос, т.к. там сложности с возвратом и прочей хней
     * 09062020    
     */
    return [
        "code" => "rest_no_route",
        "message" => "Пожалуйста, попробуйте забронировать консультацию на сайте https://edgardzaitsev.com/",
        "data" => [
            "status" => 404
        ]
    ];


    /*
     * *
     * Добавил Кашталап АА
     * Для облегчения выборки при запросе записей для назначения консультаций в мобильном приложении
     * 08052020    

     * Исходная строка  
     * $bookedAppointments = get_booked_func();

     * 16052020
     * Если третим параметром для уменьшения кол-ва уже забинденных слотов передавать констукцию
     * array( 'compare' => '>=', 'after' => array( 'year'  => date( "Y" ), 'month' => date( "m" ), 'day'   => 01, ) )
     * то получаем занятые слоты для вывода в приложении
     */
    $bookedAppointments = get_booked_func('', '', array('after' => '2 months ago',));

    foreach ($terms as $key => $term) {
        $slots = getBookedTimeslots($term->term_id);
        if (is_array($slots) && !empty($slots)) {
            foreach ($slots as $date => $slot) {
                if (!preg_match('/\d{8}/', $date) || strtotime(preg_replace('/(\d{4})(\d{2})(\d{2})/', '$1-$2-$3', $date)) < strtotime(date('Y-m-d', time() + 60 * 60 * 24)))
                    continue;

                if (is_array($slot) && !empty($slot)) {
                    $datef = preg_replace('/(\d{4})(\d{2})(\d{2})/', '$1-$2-$3', $date);

                    foreach ($slot as $time => $count) {

                        $item = [];

                        $timeslotf = preg_replace('/^(\d{2})(\d{2})(.+)/', '$1:$2', $time);
                        $timestamp = strtotime($datef . ' ' . $timeslotf);

                        $appointments_array = array();
                        if ($bookedAppointments) {
                            foreach ($bookedAppointments as $key => $post) {
                                if ($post->timestamp == $timestamp) {
                                    $appointments_array[] = get_post_meta($post->post_id, '_appointment_timeslot', true);
                                }
                            }
                        }

                        $realCount = intval($count) - count($appointments_array);
                        if ($realCount <= 0)
                            continue;

                        $item['name'] = $term->name;
                        $item['count'] = $realCount;
                        $item['uid'] = $term->term_id;

                        $product_id = '';
                        $custom_fields = b_get_custom_fields($term->term_id);
                        if ($custom_fields) {
                            foreach ($custom_fields as $key => $field) {
                                if (preg_match('/^single-paid-service.+/', $field['name'])) {
                                    $product_id = $field['value'];
                                    break;
                                }
                            }
                        }
                        if ($product_id) {
                            $product = wc_get_product($product_id);
                            if ($product) {
                                $item['product_id'] = $product_id;
                                $item['product_price'] = $product->get_price();
                            }
                        }

                        // Если запись на данный слот включена, то добавляем в массив
                        if (!checkBookedDisableTimeslot($item['uid'], $datef, $time)) {
                            $mass[$date][$time][$num] = $item;
                            $num++;
                        }
                    }
                }
            }
        }
    }
    ksort($mass);
    return $mass;
}

function my_appointment_func_v2() {
    $terms = get_terms([
        'taxonomy' => 'booked_custom_calendars'
    ]);

    $mass = [];
    $num = 1;
    $curDate = date(Ymd);

    /*
     * *
     * Добавил Кашталап АА
     * Для отключения возможности бронить через айос, т.к. там сложности с возвратом и прочей хней
     * 09062020  

     * Повторно отключил Кашталап АА
     * По просьбе Евгении до запуска нового сайта
     * 21072020  
     */
    return ["error" => "Пожалуйста, попробуйте забронировать консультацию на сайте https://edgardzaitsev.com/"];


    /*
     * *
     * Добавил Кашталап АА
     * Для облегчения выборки при запросе записей для назначения консультаций в мобильном приложении
     * 08052020    

     * Исходная строка  
     * $bookedAppointments = get_booked_func();

     * 16052020
     * Если третим параметром для уменьшения кол-ва уже забинденных слотов передавать констукцию
     * array( 'compare' => '>=', 'after' => array( 'year'  => date( "Y" ), 'month' => date( "m" ), 'day'   => 01, ) )
     * то получаем занятые слоты для вывода в приложении
     */
    $bookedAppointments = get_booked_func('', '', array('after' => '2 months ago',));

    foreach ($terms as $key => $term) {
        $slots = getBookedTimeslots($term->term_id);
        if (is_array($slots) && !empty($slots)) {
            foreach ($slots as $date => $slot) {
                if (!preg_match('/\d{8}/', $date) || strtotime(preg_replace('/(\d{4})(\d{2})(\d{2})/', '$1-$2-$3', $date)) < strtotime(date('Y-m-d', time() + 60 * 60 * 24)))
                    continue;

                if (is_array($slot) && !empty($slot)) {
                    $datef = preg_replace('/(\d{4})(\d{2})(\d{2})/', '$1-$2-$3', $date);

                    foreach ($slot as $time => $count) {

                        $item = [];

                        $timeslotf = preg_replace('/^(\d{2})(\d{2})(.+)/', '$1:$2', $time);
                        $timestamp = strtotime($datef . ' ' . $timeslotf);

                        $appointments_array = array();
                        if ($bookedAppointments) {
                            foreach ($bookedAppointments as $key => $post) {
                                if ($post->timestamp == $timestamp) {
                                    $appointments_array[] = get_post_meta($post->post_id, '_appointment_timeslot', true);
                                }
                            }
                        }

                        $realCount = intval($count) - count($appointments_array);
                        if ($realCount <= 0)
                            continue;

                        $item['name'] = $term->name;
                        $item['count'] = $realCount;
                        $item['uid'] = $term->term_id;

                        $product_id = '';
                        $custom_fields = b_get_custom_fields($term->term_id);
                        if ($custom_fields) {
                            foreach ($custom_fields as $key => $field) {
                                if (preg_match('/^single-paid-service.+/', $field['name'])) {
                                    $product_id = $field['value'];
                                    break;
                                }
                            }
                        }
                        if ($product_id) {
                            $product = wc_get_product($product_id);
                            if ($product) {
                                $item['product_id'] = $product_id;
                                $item['product_price'] = $product->get_price();
                            }
                        }

                        // Если запись на данный слот включена, то добавляем в массив
                        if (!checkBookedDisableTimeslot($item['uid'], $datef, $time)) {
                            $mass[$date][$time][$num] = $item;
                            $num++;
                        }
                    }
                }
            }
        }
    }
    ksort($mass);
    return $mass;
}

function my_appointment_employee_func() {
    /* return [
      [
      'name' => 'Галина Иванова',
      'uid' => 264,
      ],
      [
      'name' => 'Ирина Антонова',
      'uid' => 260,
      ],
      [
      'name' => 'Татьяна Попова',
      'uid' => 239,
      ],
      [
      'name' => 'Эдгард Зайцев',
      'uid' => 212,
      ],
      ]; */

    /*
     * *
     * Изменен Кашталап АА

     * Для возврата корректного списка типов записей в фильтр мобильных приложений
     * 08052020

     */
    $terms = get_terms(['taxonomy' => 'booked_custom_calendars']);

    $empl = array();
    foreach ($terms as $term) {

        $empl[] = array('name' => $term->name, 'uid' => $term->term_id);
    }

    return $empl;
}

// add_action('wp_head', 'my_booked_2_func');

function getBookedTimeslots($calendar_id = '') {
    if ($calendar_id) {
        $booked_defaults = get_option('booked_defaults_' . $calendar_id);
    } else {
        $booked_defaults = get_option('booked_defaults');
    }
    return booked_apply_custom_timeslots_filter($booked_defaults, $calendar_id);
}

function my_create_appointment($request) {
    try {
        $user_id = $request->get_param('user_id');
        $name = $request->get_param('name');
        $surname = $request->get_param('surname');
        $phone = $request->get_param('phone');
        $date = $request->get_param('date');
        $datef = preg_replace('/(\d{4})(\d{2})(\d{2})/', '$1-$2-$3', $date);
        $timeslot = $request->get_param('timeslot');
        $timeslotf = preg_replace('/^(\d{2})(\d{2})(.+)/', '$1:$2', $timeslot);
        $uid = $request->get_param('uid');

        $timestamp = strtotime($datef . ' ' . $timeslotf);

        $time_format = get_option('time_format');
        $date_format = get_option('date_format');

        $title = date_i18n($date_format, $timestamp) . ' @ ' . date_i18n($time_format, $timestamp) . ' (User: ' . $user_id . ')';
        $post_date = date_i18n('Y', strtotime($datef)) . '-' . date_i18n('m', strtotime($datef)) . '-01 00:00:00';

        $booked_defaults = getBookedTimeslots($uid);

        if (!isset($booked_defaults[$date]) || !isset($booked_defaults[$date][$timeslot])) {
            throw new Exception("Не найдены слоты для записи");
        }

        if (isset($booked_defaults[$date]) && !empty($booked_defaults[$date])) {
            $todays_defaults = (is_array($booked_defaults[$date]) ? $booked_defaults[$date] : json_decode($booked_defaults[$date], true));
            $todays_defaults_details = (is_array($booked_defaults[$date . '-details']) ? $booked_defaults[$date . '-details'] : json_decode($booked_defaults[$date . '-details'], true));
        }

        if (!$todays_defaults) {
            throw new Exception("Не найдены указанные слоты для записи");
        }

        $appointments_array = array();
        $bookedAppointments = get_booked_func();

        if ($bookedAppointments) {
            foreach ($bookedAppointments as $key => $post) {
                if ($post->timestamp == $timestamp) {
                    $appointments_array[] = get_post_meta($post->post_id, '_appointment_timeslot', true);
                }
            }
        }

        if (!isset($todays_defaults[$timeslot])) {
            throw new \Exception("Не найдены слоты для записи");
        }

        $maxSlots = intval($todays_defaults[$timeslot]);
        $busySlots = count($appointments_array);

        $spots_available = $maxSlots - $busySlots;
        $no_slots = ($spots_available < 1) ? true : false;

        if ($no_slots === true) {
            throw new Exception("Нет свободных слотов для записи");
        }

        $new_post = apply_filters('booked_new_appointment_args', array(
            'post_title' => $title,
            'post_content' => '',
            'post_status' => 'publish',
            'post_date' => $post_date,
            'post_author' => $user_id,
            'post_type' => 'booked_appointments'
        ));

        $post_id = wp_insert_post($new_post);

        if (is_wp_error($post_id)) {
            throw new Exception("Не удалось сделать запись");
        }

        update_post_meta($post_id, '_appointment_timestamp', $timestamp);
        update_post_meta($post_id, '_appointment_timeslot', $timeslot);
        update_post_meta($post_id, '_appointment_user', $user_id);
        update_post_meta($post_id, '_appointment_type_create', 'API');
        wp_publish_post($post_id);

        // Связываем текущую запись с таксономией
        wp_set_object_terms($post_id, $uid, 'booked_custom_calendars');

        $product_id = '';
        $custom_fields = b_get_custom_fields($uid);
        if ($custom_fields) {
            foreach ($custom_fields as $key => $field) {
                if (preg_match('/^single-paid-service.+/', $field['name'])) {
                    $product_id = $field['value'];
                    break;
                }
            }
        }

        // Без _cf_meta_value у Booked_WC_Appointment список товаров будет пустой
        if (apply_filters('booked_update_cf_meta_value', true)) {
            $cf_meta_value .= "<p class='cf-meta-value'><strong></strong><br><!-- product_id::{$product_id} --></p>";
            update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
        }

        $appointment = Booked_WC_Appointment::get((int) $post_id);

        $response = array(
            'success' => 'true',
            'appointment' => $appointment
        );
    } catch (Exception $e) {
        return array(
            'success' => 'false',
            'message' => $e->getMessage()
        );
    }

    return $response;
}

function sanitize_int($param, $request, $key) {
    return intval($param);
}

function validate_date($param, $request, $key) {
    return preg_match('/^\d{8}$/', $param) ? true : false;
}

function validate_timeslot($param, $request, $key) {
    return preg_match('/^\d{4}\-\d{4}$/', $param) ? true : false;
}

function validate_phone($param, $request, $key) {
    return preg_match('/7\d{10}/', $param) ? true : false;
}

function b_get_custom_fields($calendar_id = '') {
    $custom_fields = array();

    if ($calendar_id) {
        $custom_fields_option_name = 'booked_custom_fields_' . $calendar_id;
        $custom_fields = json_decode(stripslashes(get_option($custom_fields_option_name)), true);
    }

    if (!$custom_fields) {
        $custom_fields = json_decode(stripslashes(get_option('booked_custom_fields')), true);
    }

    return $custom_fields;
}

function my_order_connecton_func($request) {
    $order_id = $request->get_param('order_id');
    $booked_id = $request->get_param('booked_id');

    $order = wc_get_order($order_id);
    if ($order) {
        $order->update_meta_data('api_order_connecton', true);
        $order->save();

        foreach ($order->get_items() as $item_id => $item_product) {
            $product = $item_product->get_product();
            if (!$item_product->get_meta('booked_wc_appointment_id')) {
                $item_product->add_meta_data('booked_wc_appointment_id', $booked_id);
                $item_product->save_meta_data();
            }
            if (!$item_product->get_meta('booked_wc_appointment_cal_name')) {
                $item_product->add_meta_data('booked_wc_appointment_cal_name', $product->get_name());
                $item_product->save_meta_data();
            }
        }
    }

    $result = update_post_meta($booked_id, '_booked_wc_appointment_order_id', $order_id);

    if ($result) {
        $response = array(
            'success' => true,
            'upd' => $result
        );
    } else {
        $response = array(
            'success' => false
        );
    }

    return $response;
}

function api_create_user($user_id) {
    global $wpdb;

    $user = new stdClass();

    $password = rand(11111111, 99999999);

    $wpdb->insert(
            'api_auth',
            array('user_id' => $user_id, 'password' => password_hash($password, PASSWORD_DEFAULT)),
            array('%d', '%s')
    );

    $user->id = $wpdb->insert_id;
    $user->user_id = $user_id;
    $user->password = $password;

    return $user;
}

function api_get_user($user_id) {
    global $wpdb;

    $user = new stdClass();

    $result = $wpdb->get_row("SELECT * FROM `api_auth` WHERE `user_id` = {$user_id}");

    if (!empty($wpdb->error)) {
        wp_die($wpdb->error);
    }

    if (!$result) {
        return false;
    }

    $user->id = $user_id;
    $user->user_id = $result->user_id;
    $user->password = $result->password;

    return $user;
}

function api_update_user($user_id) {
    global $wpdb;

    $user = new stdClass();

    $user = api_get_user($user_id);

    if (!$user) {
        $user = api_create_user($user_id);
    } else {
        $password = rand(11111111, 99999999);
        $wpdb->update(
                'api_auth',
                array('password' => password_hash($password, PASSWORD_DEFAULT)),
                array('user_id' => $user_id)
        );
        $user->password = $password;
    }

    $user_info = get_userdata($user_id);
    $email = $user_info->user_email;

    if ($email && $user->password) {
        api_send_new_password($email, $user->password);
    }
}

function api_send_new_password($email, $password) {
    $message = 'Ваш временный пароль для входа в приложение: ' . $password;
    wp_mail($email, 'Авторизация в мобильном приложении «Эдгард Зайцев»', $message);
}

function api_check_password($user_id, $password) {
    $user = api_get_user($user_id);

    if (!$user) {
        return false;
    }

    if (password_verify($password, $user->password)) {
        return true;
    }

    return false;
}

function my_order_completed_func($request) {
    $response = new \stdClass();

    $order_id = $request->get_param('order_id');
    $payment_token = $request->get_param('payment_token');
    $total = $request->get_param('total');

    $order = wc_get_order($order_id);
    $order->set_transaction_id($payment_token);
    $order->set_total($total);
    $order->save();
    $order->payment_complete();

    $response->order_id = $order_id;
    $response->transaction_id = $order->get_transaction_id();
    $response->status = $order->get_status();
    $response->payment_method = $order->get_payment_method();
    $response->total = $order->get_total();

    return $response;
}

function my_apple_pay_func($request) {
    $response = new \stdClass();
    try {
        $order_id = $request->get_param('order_id');
        $payment_data = $request->get_param('payment_data');

        $order = wc_get_order($order_id);

        $response->success = true;
        $response->order_id = $order_id;
        $response->order_total = $order->get_total();

        require_once __DIR__ . '/include/autoload.php';

        $client = new \YandexCheckout\Client();
        $client->setAuth(get_option('ym_api_shop_id'), get_option('ym_api_shop_password'));
        // $client->setLogger(new YandexMoneyLogger());

        $transaction_id = uniqid('', true);

        $result = $client->createPayment(
                array(
                    'amount' => array(
                        'value' => $order->get_total(),
                        'currency' => 'RUB'
                    ),
                    'payment_method_data' => array(
                        'type' => 'apple_pay',
                        'payment_data' => $payment_data
                    ),
                    'description' => 'Заказ №' . $order_id
                ),
                $transaction_id
        );

        $client->payment_id = $result->id;
        $client->payment_status = $result->status;

        $order->set_transaction_id($client->payment_id);
        $order->save();

        if ($client->payment_status === 'succeeded') {
            $order->payment_complete();
            $response->order_status = $order->get_status();
        }

        return $response;
    } catch (\Exception $e) {
        $response->success = false;
        $response->err_code = $e->getCode();
        $response->err_description = $e->getMessage();
        return $response;
    }
}

function substr_content($content, $length = 50, $end = '...') {

    $allowed_html = array(
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'p' => array()
    );

    $content = wp_kses($content, $allowed_html);

    $content = apply_filters('the_content', $content);

    $content = preg_replace(
            array("/\n+/", "/\t/", '/\<div id\=\"toc_container\" class\=\"no_bullets\">(.+)\<\/div\>/isU'),
            array(" ", "", ""),
            wp_kses(stripslashes($content), 'strip')
    );

    if (mb_strlen($content, 'UTF-8') > $length) {
        $content = mb_substr($content, 0, $length);
        $content = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ', $content) . $end; //убираем последнее слово
    }

    return $content;
}

add_action('edit_form_after_title', 'sendPushButton');

function sendPushButton($post) {
    if ($post->post_status == 'publish') {
        $title = get_post_meta($post->ID, 'push_title', true);
        $body = get_post_meta($post->ID, 'push_body', true);

        if (empty($title)) {
            $title = $post->post_title;
        }

        /*  if(empty($body)) {
          $body = substr_content($post->post_content, 180);
          } */
        ?>
        <style>
            #pushbox {
                margin: 15px 0 0;
            }
            #pushbox .inside {
                padding: 25px;
            }
            #pushbox span {
                font-weight: 700;
                font-size: 16px;
            }
            #push_title,
            #push_body {
                display: block;
                margin: 12px 0 20px;
                height: 5em;
                width: 100%;
                padding: 10px 20px;
            }
            #push_title {
                height: 35px;
            }
            .ajax_result {
                padding: 5px;
                color: goldenrod;
                font-weight: bold;
                border: 2px solid goldenrod;
                display: inline-block;
                vertical-align: top;
                cursor: default;
                position: absolute;
                bottom: 24px;
                left: 136px;
            }
        </style>
        <script>
            jQuery(document).ready(function ($) {
                $('body').on('click', '.send_push_button', function () {
                    $('.ajax_result').remove();
                    let data = {};
                    data.action = 'send_push';
                    data.id = $('#post_ID').val();
                    data.title = $('#push_title').val();
                    data.body = $('#push_body').val();
                    $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'POST',
                        data: data,
                        success: function (data) {
                            $('.send_push_button').after('<div class="ajax_result">' + data + '</div>');
                        }
                    });
                });
            });
        </script>
        <div id="pushbox" class="postbox closed">
            <button type="button" class="handlediv" aria-expanded="true">
                <span class="toggle-indicator" aria-hidden="false"></span>
            </button>
            <h2 class="hndle ui-sortable-handle"><span>Отправка пуша</span></h2>
            <div class="inside">
                <div>
                    <div><span>Заголовок</span></div>
                    <input type="text" id="push_title" value="<?= ($title) ?>">
                </div>
                <div>
                    <div><span>Текст</span></div>
                    <textarea id="push_body"><?= ($body) ?></textarea>
                </div>
                <button type="button" class="button button-small send_push_button" aria-label="Отправить пуш">Отправить пуш</button>
            </div>
        </div>
    <?php
    }
}

add_action('wp_ajax_send_push', 'send_push');

function send_push() {
    $id = isset($_POST['id']) && !empty(intval($_POST['id'])) ? intval($_POST['id']) : '';
    $title = isset($_POST['title']) && !empty($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
    $body = isset($_POST['body']) && !empty($_POST['body']) ? sanitize_textarea_field($_POST['body']) : '';

    if (!empty($id) && !empty($title) && !empty($body)) {
        update_post_meta($id, 'push_title', wp_slash($title));
        update_post_meta($id, 'push_body', wp_slash($body));

        $result = push_firebase($title, $body);

        if (isset($result->success) && $result->success > 0 || isset($result->message_id)) {
            echo 'Успешно отправлено';
        } else {
            echo 'Ошибка отправки';
        }
    }

    wp_die();
}

function push_firebase($title, $body) {
    global $wpdb;

    $result = '';

    $tokens = $wpdb->get_col("SELECT token_firebase FROM devices");

    foreach ($tokens as $key => $token) {
        $tokens[] = $token;
    }

    if (!empty($tokens)) {
        $postData = new \stdClass();
        $postData->registration_ids = $tokens;
        $postData->notification = new \stdClass();
        $postData->notification->title = $title;
        $postData->notification->body = $body;

        $service = 'https://fcm.googleapis.com/fcm/send';
        $token = 'AAAA41VEVFs:APA91bEgmO3S_BmTM8G4yCb9fAhZWFBB3mfDFXJ8wSuG441N62upKPYctE-OMpTwPPlC2lkxGusmHpNIf9t4oiQu4pdFzxXfXcsCN7nLvugKGvGAwXQaNBdKzU2Qfq_UwedPj9m0Dy9j';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $service,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                "authorization: key={$token}",
                "content-type: application/json"
            ))
        );

        $result = curl_exec($curl);
        if ($result === false) {
            $result = curl_error($curl);
        } else {
            $result = json_decode($result);
        }
    }

    return $result;
}

function my_update_token_firebase_func($request) {
    global $wpdb;

    $response = new \stdClass();

    $device_id = $request->get_param('device_id');
    $token_firebase = $request->get_param('token_firebase');

    $id = $wpdb->get_var("SELECT id FROM devices WHERE device_id = '{$device_id}'");

    if (empty($id)) {
        $result = $wpdb->insert(
                'devices',
                array('device_id' => $device_id, 'token_firebase' => $token_firebase),
                array('%s', '%s')
        );
        if ($result === false) {
            $response->operation = 'insert';
            $response->device_id = $wpdb->insert_id;
        }
    } else {
        $result = $wpdb->update(
                'devices',
                array('token_firebase' => $token_firebase),
                array('device_id' => $id),
                array('%s'),
                array('%s')
        );
        if ($result === false) {
            $response->operation = 'update';
            $response->device_id = $device_id;
        }
    }

    return $response;
}

function my_cleanup() {
    global $wpdb;

    $max_booked_wc_time_created = 60 * 15;

    $ids = $wpdb->get_col("SELECT
      p.ID AS appointmentId
    FROM
      {$wpdb->posts} p
    LEFT JOIN
      {$wpdb->postmeta} pm ON pm.post_id = p.ID
    WHERE
      p.post_type = 'booked_appointments' AND pm.meta_key = '_appointment_type_create' AND pm.meta_value = 'API'");

    foreach ($ids as $key => $id) {
        $time_created = get_post_meta($id, '_booked_wc_time_created', true);
        $order_id = get_post_meta($id, '_booked_wc_appointment_order_id', true);

        if (!$time_created || (int) $time_created < $max_booked_wc_time_created) {
            if ($order_id && $order_id != 'manual') {
                $order = wc_get_order($order_id);
                $status = $order->get_status();
                if ($status == 'pending') {
                    wp_delete_post($order_id, true);
                    wp_delete_post($id, true);
                }
            }
        }

        if (!$order_id) {
            wp_delete_post($id, true);
        }
    }
}

add_action('my_hook_cleanup', 'my_cleanup');

add_filter('cron_schedules', 'cron_add_my_time');

function cron_add_my_time($schedules) {
    $schedules['my_time'] = array(
        'interval' => 60 * 15,
        'display' => 'Каждые 15 минут'
    );
    return $schedules;
}

if (!wp_next_scheduled('my_hook_cleanup')) {
    wp_schedule_event(time(), 'my_time', 'my_hook_cleanup');
}

function product_custom_meta_box() {
    add_meta_box('blockProductAppleID', 'Настройки товара', 'callbackSettingsProduct', 'product', 'normal', 'high');
}

add_action('admin_menu', 'product_custom_meta_box');

function callbackSettingsProduct($post) {
    wp_nonce_field(basename(__FILE__), 'product_custom_metabox_nonce');

    $html = '<label>Product Apple ID&nbsp;&nbsp;&nbsp;<input type="text" name="productAppleID" value="' . get_post_meta($post->ID, 'productAppleID', true) . '" /></label> ';

    echo $html;
}

function product_save_box_data($post_id) {
    if (!isset($_POST['product_custom_metabox_nonce']) || !wp_verify_nonce($_POST['product_custom_metabox_nonce'], basename(__FILE__)))
        return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    if (!current_user_can('edit_post', $post_id))
        return $post_id;
    $post = get_post($post_id);
    if ($post->post_type == 'product') {
        update_post_meta($post_id, 'productAppleID', esc_attr($_POST['productAppleID']));
    }
    return $post_id;
}

add_action('save_post', 'product_save_box_data');

/**
 * Возвращает true, если слот записи выключен
 * 
 * @param integer calendar_id
 * @param string date - Y-m-d
 * @param string timeslot - 0000-0000
 * 
 * @return boolean
 */
function checkBookedDisableTimeslot($calendar_id = 0, $date, $timeslot) {
    $disabled_timeslots = get_option('booked_disabled_timeslots', array());

    if (
            isset($disabled_timeslots[$calendar_id][$date][$timeslot]) &&
            $disabled_timeslots[$calendar_id][$date][$timeslot]
    ) {
        return true;
    }

    return false;
}

function my_get_case_products_func($request) {
    $case_id = $request->get_param('case_id');

    $bundle_items = WC_PB_DB::query_bundled_items(array(
                'return' => 'id=>product_id',
                'bundle_id' => array($case_id)
            ));

    $products = array();
    foreach ($bundle_items as $bundle_id => $product_id) {
        $product = wc_get_product($product_id);
        $downloads = $product->get_downloads();
        foreach ($downloads as $key => $download) {
            $object = new \stdClass();
            $object->product_id = $product->get_id();
            $object->name = $product->get_name();
            $image = wp_get_attachment_image_src($product->get_image_id(), 'thumbnail');
            if (isset($image[0])) {
                $object->image = $image[0];
            }
            $object->file = $download['file'];
            switch ($download['name']) {
                case 'Скачать книгу':
                    $index = 'books';
                    break;
                case 'Скачать аудио-книгу':
                    $index = 'audio_books';
                    break;
                case 'Скачать медитацию':
                    $index = 'meditations';
                    break;
                case 'Скачать урок':
                case 'Скачать запись вебинара':
                    $index = 'video';
                    break;
                case 'Скачать инструкцию':
                    $index = 'instructions';
                    break;

                default:
                    $index = 'no_sort';
                    break;
            }
            $products[$index][] = $object;
        }
    }

    return rest_ensure_response($products);
}
