<?php
add_filter( 'gettext', 'translate_labels_sk', 20, 3 );
function translate_labels_sk( $translated_text, $text, $domain ) {
    $translations = array(
        'Choose your size' => 'Vyberte veľkosť',
        'Choose an option' => 'Vyberte možnosť',
        'Add to cart' => 'Pridať do košíka',
        'Select options' => 'Výber',
        'View cart' => 'Zobraziť košík',
        'Checkout' => 'Objednávka',
        'Proceed to checkout' => 'Prejsť k objednávke',
        'Update cart' => 'Aktualizovať košík',
        'Apply coupon' => 'Použiť kupón',
        'Coupon code' => 'Kód kupónu',
        'Cart totals' => 'Celkom košík',
        'Subtotal' => 'Medzisúčet',
        'Total' => 'Celkom',
        'Shipping' => 'Doručenie',
        'Free shipping' => 'Doručenie zadarmo',
    );
    if ( isset( $translations[$text] ) ) return $translations[$text];
    return $translated_text;
}

// SK: Override WC default placeholders
add_filter( 'gettext', 'noriks_sk_placeholders', 20, 3 );
function noriks_sk_placeholders( $translated, $text, $domain ) {
    $t = array(
        'House number and street name' => 'Ulica',
        'Apartment, suite, unit, etc.' => 'Číslo domu',
        'Apartment, suite, unit, etc. (optional)' => 'Číslo domu',
        'Street address' => 'Ulica',
        'Town / City' => 'Mesto',
        'Postcode / ZIP' => 'PSČ',
        'Phone' => 'Telefón',
        'Email address' => 'E-mailová adresa',
        'First name' => 'Krstné meno',
        'Last name' => 'Priezvisko',
        'Place order' => 'Objednať',
        'Country / Region' => 'Krajina',
        '(optional)' => '(nepovinné)',
    );
    return isset( $t[$text] ) ? $t[$text] : $translated;
}
