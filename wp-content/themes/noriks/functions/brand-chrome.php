<?php
/**
 * Glava, zgornji trak in noga v slogu znamke.
 *
 *  - css/brand-chrome.css + pisave znamke (iste kot na domaci strani); nalozeno
 *    za brand.css, da velja zadnje.
 *  - Noga: fotografija znamke v ozadju, slogan in opis z domace strani (isti
 *    prevodi), pod logotipom "Powered by Noriks".
 *  - Ikona strani (favicon) in ikona racuna v glavi.
 *  - Izbirnik jezika: jezikovne razlicice so samostojne namestitve WordPressa na
 *    isti domeni (anglescina na korenu, ostale v mapah /hr, /hu, /pl ...).
 *    Dokler mape niso postavljene, je izbirnik skrit; vklop:
 *    add_filter( 'brand_prikazi_jezike', '__return_true' );
 *  - Meni cez celo sirino: kategorija v glavnem meniju pokaze svoje izdelke
 *    (podatki iz baze, predpomnjeni eno uro).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', function () {
	$d = get_template_directory();
	wp_enqueue_style( 'bz-chrome-fonts', 'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700;800&display=swap', array(), null );
	if ( file_exists( $d . '/css/brand-chrome.css' ) ) {
		wp_enqueue_style( 'bz-chrome', get_template_directory_uri() . '/css/brand-chrome.css', array(), filemtime( $d . '/css/brand-chrome.css' ) );
	}
}, 100 );

/* ---------- noga ---------- */

/** Nastavitve domace strani znamke (slogan, opis); prazno, ce jih ni. */
function brand_chrome_domaca() {
	static $c = null;
	if ( null === $c ) {
		$c = function_exists( 'brand_home_nastavitve' ) ? brand_home_nastavitve() : array(
			'hero'    => array( 'naslov' => 'Тениската, която решава всички проблеми.', 'besedilo' => '' ),
			'izdelki' => array( 'gumb' => 'Пазарувай сега' ),
		);
	}
	return $c;
}

/** Slogan znamke: naslov uvodnega razdelka domace strani. */
function brand_noga_geslo() {
	$c = brand_chrome_domaca();
	if ( empty( $c['hero']['naslov'] ) ) {
		return '';
	}
	return trim( preg_replace( '/\s+/u', ' ', wp_strip_all_tags( str_replace( array( '<br>', '<br/>', '<br />' ), ' ', $c['hero']['naslov'] ) ) ) );
}

/** Opis znamke: besedilo uvodnega razdelka domace strani. */
function brand_noga_opis() {
	$c = brand_chrome_domaca();
	return empty( $c['hero']['besedilo'] ) ? '' : (string) $c['hero']['besedilo'];
}

/** Fotografija v ozadju noge (img/brand/noga.jpg), ce v nastavitvah ni druge. */
function brand_noga_slika() {
	$f = '/img/brand/noga.jpg';
	return file_exists( get_template_directory() . $f ) ? get_template_directory_uri() . $f : '';
}

/* ---------- glava: ikona racuna ---------- */

function brand_chrome_racun() {
	if ( ! function_exists( 'wc_get_page_permalink' ) || ! function_exists( 'wc_get_page_id' ) ) {
		return;
	}
	$id    = (int) wc_get_page_id( 'myaccount' );
	$napis = $id > 0 ? get_the_title( $id ) : '';
	printf(
		'<a class="ch-racun" href="%s" aria-label="%s"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.7"/><path d="M4.6 20.2c.9-3.7 3.9-5.7 7.4-5.7s6.5 2 7.4 5.7"/></svg></a>',
		esc_url( wc_get_page_permalink( 'myaccount' ) ),
		esc_attr( $napis )
	);
}

/* ---------- izbirnik jezika ---------- */

/** koda trga => ( zastava, ime v jeziku trga, mapa na domeni ) */
function brand_jeziki() {
	return apply_filters( 'brand_jeziki', array(
		'en' => array( 'eu.svg', 'English', '' ),
		'hr' => array( 'hr.svg', 'Hrvatska', 'hr' ),
		'hu' => array( 'hu.svg', 'Magyarország', 'hu' ),
		'pl' => array( 'pl.svg', 'Polska', 'pl' ),
		'sk' => array( 'sk.svg', 'Slovensko', 'sk' ),
		'cz' => array( 'cz.svg', 'Česko', 'cz' ),
		'ro' => array( 'ro.svg', 'România', 'ro' ),
		'gr' => array( 'gr.svg', 'Ελλάδα', 'gr' ),
	) );
}

function brand_jeziki_vklopljeni() {
	return (bool) apply_filters( 'brand_prikazi_jezike', true );
}

/** Koren domene (brez mape trga), npr. https://example.com */
function brand_jeziki_koren() {
	$u = wp_parse_url( home_url() );
	if ( empty( $u['host'] ) ) {
		return '';
	}
	return ( isset( $u['scheme'] ) ? $u['scheme'] : 'https' ) . '://' . $u['host'] . ( isset( $u['port'] ) ? ':' . $u['port'] : '' );
}

/** Povezave v oknu za izbiro jezika. */
function brand_jeziki_moznosti() {
	$koren = brand_jeziki_koren();
	foreach ( brand_jeziki() as $j ) {
		printf(
			'<a href="%s" class="language-option"><img src="https://static.devit.software/countries/flags/rectangle/%s" alt=""><span>%s</span></a>',
			esc_url( $koren . '/' . ( '' !== $j[2] ? $j[2] . '/' : '' ) ),
			esc_attr( $j[0] ),
			esc_html( $j[1] )
		);
	}
}

add_action( 'wp_head', function () {
	if ( ! brand_jeziki_vklopljeni() ) {
		echo '<style id="brand-jeziki-skriti">.language-selector,.nmm-lang,.nmm-foot-title--lang,#languageModal{display:none!important}</style>' . "\n";
	}
}, 100 );

/* ---------- ikona strani (favicon) ---------- */

/** Ikona znamke iz teme za zeleno velikost; prazno, ce datoteke ni. */
function brand_favicon_url( $velikost ) {
	$v = 512;
	foreach ( array( 32, 180, 192, 270, 512 ) as $k ) {
		if ( $velikost <= $k ) {
			$v = $k;
			break;
		}
	}
	$f = '/img/brand/favicon-' . $v . '.png';
	return file_exists( get_template_directory() . $f ) ? get_template_directory_uri() . $f : '';
}

// Dokler v Prilagojevalniku ni nastavljena ikona strani, WordPress uporabi ikono znamke iz teme
// (zavihek brskalnika, ikona na telefonu, admin in prijava).
add_filter( 'get_site_icon_url', function ( $url, $velikost = 512 ) {
	if ( $url ) {
		return $url;
	}
	$nasa = brand_favicon_url( (int) $velikost );
	return $nasa ? $nasa : $url;
}, 10, 2 );

/* ---------- meni cez celo sirino ---------- */

function brand_chrome_pot( $url ) {
	$p = wp_parse_url( (string) $url, PHP_URL_PATH );
	return untrailingslashit( (string) preg_replace( '#^/[a-z]{2}(?=/)#', '', is_string( $p ) ? $p : '' ) );
}

/** Slika izdelka za meni: cisti posnetek z domace strani, sicer glavna slika izdelka. */
function brand_chrome_slika( $p ) {
	if ( function_exists( 'brand_home_slika' ) ) {
		$c = brand_chrome_domaca();
		if ( ! empty( $c['slike_izdelkov'] ) && preg_match( '/src="([^"]+)"/', (string) brand_home_slika( $p, $c ), $m ) ) {
			return html_entity_decode( $m[1] );
		}
	}
	$s = $p->get_image_id() ? wp_get_attachment_image_url( $p->get_image_id(), 'woocommerce_thumbnail' ) : '';
	return $s ? $s : '';
}

function brand_chrome_izdelki( $args, &$vsi ) {
	$ids = array();
	foreach ( wc_get_products( $args + array( 'status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ) ) as $p ) {
		$id = (int) $p->get_id();
		if ( ! isset( $vsi[ $id ] ) ) {
			$vsi[ $id ] = array(
				'n' => trim( preg_replace( '/\\s*\\|.*$/u', '', $p->get_name() ) ),
				'u' => $p->get_permalink(),
				'i' => brand_chrome_slika( $p ),
				'c' => $p->get_price_html(),
			);
		}
		$ids[] = $id;
	}
	return $ids;
}

/** i: izdelki po ID, m: pot povezave v meniju => ID-ji izdelkov, v: vsi izdelki (za dopolnitev) */
function brand_chrome_meni() {
	if ( ! function_exists( 'wc_get_products' ) || ! taxonomy_exists( 'product_cat' ) ) {
		return array();
	}
	$ven = get_transient( 'brand_chrome_meni_v3' );
	if ( is_array( $ven ) ) {
		return $ven;
	}
	$izd = array();
	$m   = array();
	$t   = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
	) );
	if ( is_wp_error( $t ) || ! $t ) {
		$t = array();
	}
	$v_meniju = array();
	$meni     = function_exists( 'get_field' ) ? get_field( 'mainheader_menu', 'option' ) : array();
	foreach ( (array) $meni as $m_el ) {
		if ( ! empty( $m_el['link'] ) && preg_match( '#product-category/([^/?]+)/?$#', (string) $m_el['link'], $mm ) ) {
			$v_meniju[] = $mm[1];
		}
	}
	foreach ( $t as $k ) {
		if ( 'orto' === $k->slug || 0 === strpos( $k->slug, 'orto-' ) || ( $v_meniju && ! in_array( $k->slug, $v_meniju, true ) ) ) {
			continue;
		}
		$url = get_term_link( $k );
		if ( is_wp_error( $url ) ) {
			continue;
		}
		$ids = brand_chrome_izdelki( array( 'limit' => 5, 'category' => array( $k->slug ) ), $izd );
		if ( $ids ) {
			$m[ brand_chrome_pot( $url ) ] = $ids;
		}
	}
	$v = brand_chrome_izdelki( array( 'limit' => 8 ), $izd );
	if ( $v && function_exists( 'wc_get_page_permalink' ) ) {
		$m[ brand_chrome_pot( wc_get_page_permalink( 'shop' ) ) ] = $v;
	}
	$ven = $m ? array( 'i' => $izd, 'm' => $m, 'v' => $v ) : array();
	set_transient( 'brand_chrome_meni_v3', $ven, HOUR_IN_SECONDS );
	return $ven;
}

foreach ( array( 'save_post_product', 'woocommerce_update_product', 'edited_product_cat', 'created_product_cat', 'after_switch_theme' ) as $brand_chrome_kavelj ) {
	add_action( $brand_chrome_kavelj, function () {
		delete_transient( 'brand_chrome_meni_v3' );
	} );
}

/* ---------- kartice izdelkov v trgovini ---------- */

/** Ali smo sredi izrisa kartice izdelka v zanki trgovine. */
function brand_chrome_v_kartici() {
	return did_action( 'woocommerce_before_shop_loop_item' ) > did_action( 'woocommerce_after_shop_loop_item' );
}

// Cisti posnetek izdelka (img/home/prod-*.jpg) namesto oglasne slike iz galerije; samo v karticah.
add_filter( 'woocommerce_product_get_image', function ( $slika, $izdelek = null ) {
	static $v_teku = false;
	if ( $v_teku || is_admin() || ! $izdelek || ! brand_chrome_v_kartici() || ! function_exists( 'brand_home_slika' ) ) {
		return $slika;
	}
	$c = brand_chrome_domaca();
	if ( empty( $c['slike_izdelkov'] ) ) {
		return $slika;
	}
	$v_teku = true;
	$nova   = (string) brand_home_slika( $izdelek, $c );
	$v_teku = false;
	return false !== strpos( $nova, '/img/home/' ) ? $nova : $slika;
}, 10, 2 );

// Pod imenom en stavek opisa.
add_action( 'woocommerce_after_shop_loop_item_title', function () {
	global $product;
	if ( ! $product || ! function_exists( 'brand_home_kratek_opis' ) ) {
		return;
	}
	$o = trim( (string) brand_home_kratek_opis( $product ) );
	if ( '' !== $o ) {
		echo '<span class="ch-opis">' . esc_html( $o ) . '</span>';
	}
}, 4 );

// Na dnu kartice povabilo (isti napis kot na karticah domace strani).
add_action( 'woocommerce_after_shop_loop_item', function () {
	$c = brand_chrome_domaca();
	$g = isset( $c['izdelki']['gumb'] ) ? (string) $c['izdelki']['gumb'] : '';
	if ( '' !== $g ) {
		echo '<span class="ch-vec">' . esc_html( $g ) . ' <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>';
	}
}, 4 );

/* ---------- gumb "Add to cart" brez stranske kosarice ---------- */

// Stranska kosarica (placljiv vticnik) tece samo z aktivirano licenco na domeni. Dokler je ni,
// obrazec izdelek doda in stran se le osvezi - kupec ne vidi, da se je kaj zgodilo. Zato ga po
// dodajanju odpeljemo na stran kosarice. Ko je licenca aktivna, vticnik dodajanje prevzame sam.
add_filter( 'woocommerce_add_to_cart_redirect', function ( $url ) {
	if ( class_exists( 'Xoo_Wsc_Frontend' ) || ! function_exists( 'wc_get_cart_url' ) ) {
		return $url;
	}
	return wc_get_cart_url();
} );

add_action( 'wp_footer', function () {
	$m = brand_chrome_meni();
	if ( ! $m ) {
		return;
	}
	echo '<script type="application/json" id="ch-meni">' . wp_json_encode( $m ) . '</script>' . "\n";
	?>
<script>
(function () {
	var el = document.getElementById('ch-meni'), glava = document.querySelector('header.navbar.header');
	if (!el || !glava || !window.matchMedia || !window.matchMedia('(min-width:769px)').matches) { return; }
	var data;
	try { data = JSON.parse(el.textContent); } catch (e) { return; }
	if (!data || !data.m || !data.i) { return; }
	function pot(h) { try { return new URL(h, location.href).pathname.replace(/^\/[a-z]{2}(?=\/)/, '').replace(/\/+$/, ''); } catch (e) { return ''; } }
	function el_(t, c) { var x = document.createElement(t); if (c) { x.className = c; } return x; }
	function kartica(id) {
		var p = data.i[id]; if (!p) { return null; }
		var x = el_('a', 'ch-dd__i'); x.href = p.u;
		var s = el_('span', 'ch-dd__s'); if (p.i) { var im = el_('img'); im.src = p.i; im.alt = ''; im.loading = 'lazy'; s.appendChild(im); } x.appendChild(s);
		var t = el_('span', 'ch-dd__t'), b = el_('b'); b.textContent = p.n; t.appendChild(b);
		var c = el_('span', 'ch-dd__p'); c.innerHTML = p.c; t.appendChild(c); x.appendChild(t); return x;
	}
	var povezave = glava.querySelectorAll('.navbar-center a'), gumb = glava.querySelector('.navbar-center a.nav-link--pill');
	var odprt = null, cas = null;
	function zapri() { if (odprt) { odprt.a.classList.remove('ch-odprt'); odprt.d.classList.remove('ch-odprt'); odprt.a.setAttribute('aria-expanded', 'false'); odprt = null; } }
	function odpri(par) { clearTimeout(cas); if (odprt === par) { return; } zapri(); par.a.classList.add('ch-odprt'); par.d.classList.add('ch-odprt'); par.a.setAttribute('aria-expanded', 'true'); odprt = par; }
	Array.prototype.forEach.call(povezave, function (a) {
		var ids = data.m[pot(a.getAttribute('href') || '')];
		if (!ids || !ids.length) { a.addEventListener('mouseenter', zapri); return; }
		var d = el_('div', 'ch-dd'), v = el_('div', 'ch-dd__in'), g = el_('div', 'ch-dd__glava'), telo = el_('div', 'ch-dd__telo'), m = el_('div', 'ch-dd__mreza');
		var n = el_('a', 'ch-dd__naslov'); n.href = a.href; n.textContent = a.textContent.trim(); g.appendChild(n);
		var vse = el_('a', 'ch-dd__vse'); vse.href = a.href; vse.setAttribute('aria-label', n.textContent);
		vse.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>'; g.appendChild(vse);
		ids.forEach(function (id) { var k = kartica(id); if (k) { m.appendChild(k); } });
		telo.appendChild(m);
		// malo izdelkov v kategoriji: pod njimi se ostali izdelki trgovine
		var ostali = (data.v || []).filter(function (id) { return ids.indexOf(id) === -1; });
		if (ids.length <= 3 && ostali.length && gumb && gumb !== a) {
			if (ids.length <= 2) { m.classList.add('ch-dd__mreza--velika'); }
			var o = el_('div', 'ch-dd__ostali'), on = el_('a', 'ch-dd__ostali-n'); on.href = gumb.href; on.textContent = gumb.textContent.trim(); o.appendChild(on);
			var om = el_('div', 'ch-dd__mreza ch-dd__mreza--mala');
			ostali.slice(0, 5).forEach(function (id) { var k = kartica(id); if (k) { om.appendChild(k); } });
			o.appendChild(om); telo.appendChild(o);
		}
		v.appendChild(g); v.appendChild(telo); d.appendChild(v); glava.appendChild(d);
		var par = { a: a, d: d };
		a.classList.add('ch-ima'); a.setAttribute('aria-haspopup', 'true'); a.setAttribute('aria-expanded', 'false');
		a.addEventListener('mouseenter', function () { odpri(par); });
		a.addEventListener('focus', function () { odpri(par); });
	});
	glava.addEventListener('mouseleave', function () { cas = setTimeout(zapri, 140); });
	glava.addEventListener('mouseenter', function () { clearTimeout(cas); });
	document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { zapri(); } });
})();
</script>
	<?php
}, 30 );
