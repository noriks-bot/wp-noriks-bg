<?php

add_filter('gettext', 'noriks_bg_translate_attribute_labels', 20, 3);

function noriks_bg_translate_attribute_labels($translated_text, $text, $domain) {
    $translations = array(
        'Choose your size'   => 'Изберете размер',
        'Place order'        => 'Поръчай',
        'Proceed to checkout'=> 'Към плащане',
        'View cart'          => 'Виж количката',
        'Add to cart'        => 'Добави в количката',
        'Clear'              => 'Изчисти',
        'Clear options'      => 'Изчисти опциите',
        'Size'               => 'Размер',
        'Veličina'           => 'Размер',
        'Veličina majice'    => 'Размер на тениска',
        'Veličina bokseric'  => 'Размер на боксерки',
    );

    return $translations[$text] ?? $translated_text;
}

add_filter('woocommerce_checkout_fields', 'noriks_bg_customize_checkout_fields', 20);
function noriks_bg_customize_checkout_fields($fields) {
    if (isset($fields['billing']['billing_first_name'])) {
        $fields['billing']['billing_first_name']['label'] = 'Име';
        $fields['billing']['billing_first_name']['placeholder'] = 'Име';
    }

    if (isset($fields['billing']['billing_last_name'])) {
        $fields['billing']['billing_last_name']['label'] = 'Фамилия';
        $fields['billing']['billing_last_name']['placeholder'] = 'Фамилия';
    }

    if (isset($fields['billing']['billing_address_1'])) {
        $fields['billing']['billing_address_1']['label'] = 'Улица и номер';
        $fields['billing']['billing_address_1']['placeholder'] = 'Улица и номер';
    }

    if (isset($fields['billing']['billing_city'])) {
        $fields['billing']['billing_city']['label'] = 'Град';
        $fields['billing']['billing_city']['placeholder'] = 'Град';
    }

    if (isset($fields['billing']['billing_postcode'])) {
        $fields['billing']['billing_postcode']['label'] = 'Пощенски код';
        $fields['billing']['billing_postcode']['placeholder'] = 'Пощенски код';
    }

    if (isset($fields['billing']['billing_phone'])) {
        $fields['billing']['billing_phone']['label'] = 'Телефонен номер';
        $fields['billing']['billing_phone']['placeholder'] = 'Телефонен номер';
    }

    if (isset($fields['billing']['billing_email'])) {
        $fields['billing']['billing_email']['label'] = 'Имейл адрес';
        $fields['billing']['billing_email']['placeholder'] = 'Имейл адрес';
    }

    WC()->customer->set_billing_country('BG');
    WC()->customer->set_shipping_country('BG');

    unset($fields['billing']['billing_country']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['shipping']['shipping_state']);

    return $fields;
}

add_filter('woocommerce_order_number', 'noriks_bg_change_woocommerce_order_number');
function noriks_bg_change_woocommerce_order_number($order_id) {
    return 'NORIKS-BG-' . $order_id;
}

add_filter('default_checkout_billing_country', 'noriks_bg_default_country');
add_filter('default_checkout_shipping_country', 'noriks_bg_default_country');
function noriks_bg_default_country() {
    return 'BG';
}
