<?php
/**
 * Bulgarian (BG) Language Configuration
 * Noriks Bulgaria Store
 */

// Translate WooCommerce attribute labels
add_filter( 'gettext', 'translate_attribute_labels_bg', 20, 3 );
function translate_attribute_labels_bg( $translated_text, $text, $domain ) {
    $translations = array(
        'Choose your size' => 'Изберете размер',
        'Choose an option' => 'Изберете опция',
        'Add to cart' => 'Добави в кошницата',
        'Select options' => 'Избор',
        'View cart' => 'Преглед на кошницата',
        'Checkout' => 'Плащане',
        'Proceed to checkout' => 'Продължи към плащане',
        'Update cart' => 'Обнови кошницата',
        'Apply coupon' => 'Приложи купон',
        'Coupon code' => 'Код на купон',
        'Cart totals' => 'Общо в кошницата',
        'Subtotal' => 'Междинна сума',
        'Total' => 'Общо',
        'Shipping' => 'Доставка',
        'Free shipping' => 'Безплатна доставка',
    );
    
    if ( isset( $translations[$text] ) ) {
        return $translations[$text];
    }
    return $translated_text;
}

// Checkout phone placeholder
add_filter( 'woocommerce_checkout_fields', 'custom_billing_phone_placeholder_bg' );
function custom_billing_phone_placeholder_bg( $fields ) {
    $fields['billing']['billing_phone']['placeholder'] = 'Мобилен (пример: 0888123456)';
    return $fields;
}

// Order number prefix
add_filter( 'woocommerce_order_number', 'change_woocommerce_order_number_bg' );
function change_woocommerce_order_number_bg( $order_id ) {
    $prefix = 'NORIKS-BG-';
    return $prefix . $order_id;
}

// Force country to Bulgaria
add_filter( 'default_checkout_billing_country', '__return_bg' );
add_filter( 'default_checkout_shipping_country', '__return_bg' );
function __return_bg() {
    return 'BG';
}

// Force country to Bulgaria and hide country fields
add_filter( 'woocommerce_checkout_fields', 'fix_country_to_bulgaria_and_hide' );
function fix_country_to_bulgaria_and_hide( $fields ) {
    WC()->customer->set_billing_country( 'BG' );
    WC()->customer->set_shipping_country( 'BG' );
    
    unset( $fields['billing']['billing_country'] );
    unset( $fields['shipping']['shipping_country'] );
    
    return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'hide_checkout_fields_bg' );
function hide_checkout_fields_bg( $fields ) {
    unset( $fields['billing']['billing_state'] );
    unset( $fields['shipping']['shipping_state'] );
    unset( $fields['shipping']['shipping_address_2'] );
    return $fields;
}

/**
 * Bulgarian translations for hardcoded strings
 */
function noriks_bg_translations() {
    return array(
        // Hero section
        'Tričko, které řeší všechny problémy.' => 'Тениската, която решава всички проблеми.',
        'KOUPIT TEĎ' => 'КУПИ СЕГА',
        
        // Collections
        'Nakupujte podle kolekce' => 'Пазарувайте по колекция',
        'Všechny produkty' => 'Всички продукти',
        
        // Category names
        'Trička' => 'Тениски',
        'Boxerky' => 'Боксерки',
        'Sady' => 'Комплекти',
        'Startovací balíček' => 'Стартов пакет',
        
        // Category descriptions
        'Pohodlí po celý den. Bez vytahování.' => 'Комфорт цял ден. Без издърпване.',
        'Měkké. Prodyšné. Spolehlivé.' => 'Меки. Дишащи. Надеждни.',
        'Nejlepší poměr ceny a kvality v setu.' => 'Най-добро съотношение цена-качество в комплект.',
        'Vyzkoušej NORIKS výhodněji.' => 'Опитайте NORIKS на по-добра цена.',
        
        // Header marquee
        'Doprava zdarma pro objednávky nad 1700 Kč' => 'Безплатна доставка за поръчки над 70 лв',
        'Doprava zdarma při objednávkách nad 1700 Kč' => 'Безплатна доставка за поръчки над 70 лв',
        '30 dní bez rizika – vyzkoušej bez obav' => '30 дни без риск – опитайте без притеснения',
        
        // Product page features
        'Platba na dobírku' => 'Наложен платеж',
        'Vyzkoušejte 30 dní, bez rizika' => 'Опитайте 30 дни, без риск',
        
        // Shipping/delivery
        'Objednejte během následujících' => 'Поръчайте в рамките на',
        'Doručení od' => 'Доставка от',
        'do' => 'до',
        
        // Cart
        'Prosím, pospěš si! Někdo si právě objednal jeden z produktů ve tvém košíku. Rezervace platí už jen' => 'Моля, побързайте! Някой току-що поръча един от продуктите във вашата кошница. Резервацията е валидна за',
        'minut' => 'минути',
    );
}

/**
 * Bulgarian weekday names
 */
function noriks_bg_weekdays() {
    return array(
        'Неделя',
        'Понеделник',
        'Вторник',
        'Сряда',
        'Четвъртък',
        'Петък',
        'Събота'
    );
}
