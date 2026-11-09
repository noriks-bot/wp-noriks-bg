<?php
/**
 * NORIKS — brez zelene vrstice "Izdelek je bil dodan v kosarico".
 *
 * Stranska kosarica se odpre sama in pokaze vsebino, zato je WooCommercovo
 * obvestilo odvec. Tema ga je doslej skrivala s CSS na kosarici, blagajni in
 * strani izdelka (css/cart.css, css/checkout.css, css/product.css), na
 * trgovini in v kategorijah pa je ostalo vidno.
 *
 * Sporocilo izpraznimo pri viru: wc_add_notice() praznega sporocila ne shrani,
 * zato zelene vrstice sploh ni — v HTML ne ostane niti prazen okvir.
 *
 * POZOR: obvestila o NAPAKAH ostanejo nedotaknjena (npr. "Izberite velikost"),
 * ker gredo skozi svoj filter in ne skozi wc_add_to_cart_message_html.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'wc_add_to_cart_message_html', '__return_empty_string', 99 );
