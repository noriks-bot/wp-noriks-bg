<?php
add_filter( 'gettext', 'translate_labels_bg', 20, 3 );
function translate_labels_bg( $translated_text, $text, $domain ) {
    $translations = array(
        'Choose your size' => 'Изберете размер',
        'Choose an option' => 'Изберете опция',
        'Add to cart' => 'Добави в количката',
        'Select options' => 'Избор',
        'View cart' => 'Виж количката',
        'Checkout' => 'Поръчка',
        'Proceed to checkout' => 'Към поръчката',
        'Update cart' => 'Обнови количката',
        'Apply coupon' => 'Приложи купон',
        'Coupon code' => 'Код на купон',
        'Cart totals' => 'Общо за количката',
        'Subtotal' => 'Междинна сума',
        'Total' => 'Общо',
        'Shipping' => 'Доставка',
        'Free shipping' => 'Безплатна доставка',
    );
    if ( isset( $translations[$text] ) ) return $translations[$text];
    return $translated_text;
}

// BG: Override WC default placeholders
add_filter( 'gettext', 'noriks_bg_placeholders', 20, 3 );
function noriks_bg_placeholders( $translated, $text, $domain ) {
    $t = array(
        'House number and street name' => 'Улица',
        'Apartment, suite, unit, etc.' => 'Номер на сграда',
        'Apartment, suite, unit, etc. (optional)' => 'Номер на сграда',
        'Street address' => 'Улица',
        'Town / City' => 'Град',
        'Postcode / ZIP' => 'Пощенски код',
        'Phone' => 'Телефон',
        'Email address' => 'Имейл адрес',
        'First name' => 'Име',
        'Last name' => 'Фамилия',
        'Place order' => 'Поръчай',
        'Country / Region' => 'Държава',
        '(optional)' => '(по избор)',
    );
    return isset( $t[$text] ) ? $t[$text] : $translated;
}
