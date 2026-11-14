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
	foreach ( wc_get_products( $args + array( 'status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC', 'exclude' => function_exists( 'noriks_bg_skriti' ) ? noriks_bg_skriti() : array() ) ) as $p ) {
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
	$ven = get_transient( 'brand_chrome_meni_v4' );
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
	set_transient( 'brand_chrome_meni_v4', $ven, HOUR_IN_SECONDS );
	return $ven;
}

foreach ( array( 'save_post_product', 'woocommerce_update_product', 'edited_product_cat', 'created_product_cat', 'after_switch_theme' ) as $brand_chrome_kavelj ) {
	add_action( $brand_chrome_kavelj, function () {
		delete_transient( 'brand_chrome_meni_v4' );
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

/* =====================================================================
 * NORIKS BG: glava trgovine in kategorij, filtri, drobtinice, izdelki po
 * kategorijah na domaci strani. Vse funkcije so varne: ce WooCommerce ali
 * podatkov ni, ne izpisejo nicesar.
 * ===================================================================== */

// Povezave v temi in meniju so pisane za produkcijo (noriks.com/bg/...). Kjer WordPress tece v korenu
// domene (razvojna stran), predpona /bg ne obstaja in bi povezava vrnila 404: preusmeri na isto pot brez nje.
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$dom = trim( (string) wp_parse_url( home_url(), PHP_URL_PATH ), '/' );
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	if ( '' === $dom && preg_match( '#^/bg(/.*)?$#', $uri, $m ) ) {
		wp_safe_redirect( home_url( isset( $m[1] ) && '' !== $m[1] ? $m[1] : '/' ), 301 );
		exit;
	}
}, 1 );

/** Kategorije, ki so filtri celotne trgovine (niso v glavnem meniju). */
function noriks_bg_skupine_trgovine() {
	return array( 'nai-prodavani', 'startovi-paketi', 'golemi-paketi' );
}

/** Postavke glavnega menija (ACF): array( link, text ). */
function noriks_bg_meni() {
	$m = function_exists( 'get_field' ) ? get_field( 'mainheader_menu', 'option' ) : array();
	return is_array( $m ) ? $m : array();
}

/** Slug kategorije iz povezave menija; '' ce povezava ni kategorija. */
function noriks_bg_slug_povezave( $link ) {
	return preg_match( '#product-category/([^/?]+)/?$#', (string) $link, $m ) ? $m[1] : '';
}

/** Najvisji prednik kategorije. */
function noriks_bg_vrh( $term ) {
	$n = 0;
	while ( $term && ! is_wp_error( $term ) && ! empty( $term->parent ) && $n++ < 6 ) {
		$term = get_term( $term->parent, 'product_cat' );
	}
	return ( $term && ! is_wp_error( $term ) ) ? $term : null;
}

/** Napis in povezava trgovine: prva postavka menija, ki kaze na /shop. */
function noriks_bg_trgovina() {
	$url  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
	$ime  = '';
	foreach ( noriks_bg_meni() as $el ) {
		if ( ! empty( $el['link'] ) && preg_match( '#/shop/?$#', (string) $el['link'] ) ) {
			$ime = isset( $el['text'] ) ? (string) $el['text'] : '';
			break;
		}
	}
	if ( '' === $ime && function_exists( 'wc_get_page_id' ) ) {
		$ime = (string) get_the_title( wc_get_page_id( 'shop' ) );
	}
	return array( $ime, $url );
}

/** Drobtinice: array( array( napis, url ali '' ) ). */
function noriks_bg_drobtine( $deli, $razred = '' ) {
	$deli = array_values( array_filter( $deli, function ( $d ) {
		return is_array( $d ) && isset( $d[0] ) && '' !== trim( (string) $d[0] );
	} ) );
	if ( count( $deli ) < 2 ) {
		return;
	}
	echo '<nav class="nb nb-drobtine' . ( $razred ? ' ' . esc_attr( $razred ) : '' ) . '" aria-label="breadcrumb">';
	$zadnji = count( $deli ) - 1;
	foreach ( $deli as $i => $d ) {
		if ( $i ) {
			echo '<span class="nb-drobtine__loc" aria-hidden="true">/</span>';
		}
		if ( $i < $zadnji && ! empty( $d[1] ) ) {
			echo '<a href="' . esc_url( $d[1] ) . '">' . esc_html( $d[0] ) . '</a>';
		} else {
			echo '<span' . ( $i === $zadnji ? ' aria-current="page"' : '' ) . '>' . esc_html( $d[0] ) . '</span>';
		}
	}
	echo '</nav>';
}

/** Glava trgovine / kategorije: fotografija, drobtinice, naslov, podnaslov, zavihki kategorij. */
function noriks_bg_glava_trgovine() {
	if ( ! function_exists( 'is_product_category' ) ) {
		return;
	}
	// Podnaslovi so besedila s kartic kolekcij na domaci strani.
	$podnaslovi = array(
		'teniski'   => 'Комфорт през целия ден. Без стягане.',
		'boksarki'  => 'Меки. Дишащи. Надеждни.',
		'komplekti' => 'Най-добра стойност в пакет.',
	);
	list( $trg_ime, $trg_url ) = noriks_bg_trgovina();
	$term   = is_product_category() ? get_queried_object() : null;
	$vrh    = $term ? noriks_bg_vrh( $term ) : null;
	$naslov = $term && ! empty( $term->name ) ? $term->name : $trg_ime;
	$pod    = '';
	$slika  = 'kat-shop';
	$drob   = array( array( 'NORIKS', home_url( '/' ) ), array( $trg_ime, $trg_url ) );
	if ( $term && $vrh ) {
		$pod = isset( $podnaslovi[ $vrh->slug ] ) ? $podnaslovi[ $vrh->slug ] : trim( wp_strip_all_tags( (string) $vrh->description ) );
		if ( file_exists( get_template_directory() . '/img/brand/kat-' . $vrh->slug . '.jpg' ) ) {
			$slika = 'kat-' . $vrh->slug;
		}
		if ( $vrh->term_id !== $term->term_id ) {
			$l      = get_term_link( $vrh );
			$drob[] = array( $vrh->name, is_wp_error( $l ) ? '' : $l );
		}
		$drob[] = array( $term->name, '' );
	}
	$vrh_slug = $vrh ? $vrh->slug : '';
	$v_meniju = false;
	foreach ( noriks_bg_meni() as $el ) {
		if ( '' !== $vrh_slug && isset( $el['link'] ) && noriks_bg_slug_povezave( $el['link'] ) === $vrh_slug ) {
			$v_meniju = true;
		}
	}
	?>
<section class="nb nb-kat">
	<div class="nb-kat__slika" aria-hidden="true"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/brand/' . $slika . '.jpg' ); ?>" alt=""></div>
	<div class="nb-kat__in">
		<?php noriks_bg_drobtine( $drob ); ?>
		<h1 class="nb-kat__naslov"><?php echo esc_html( $naslov ); ?></h1>
		<?php if ( '' !== $pod ) : ?><p class="nb-kat__pod"><?php echo esc_html( $pod ); ?></p><?php endif; ?>
		<div class="nb-kat__zavihki">
			<?php
			foreach ( noriks_bg_meni() as $el ) {
				if ( empty( $el['link'] ) || empty( $el['text'] ) ) {
					continue;
				}
				$s      = noriks_bg_slug_povezave( $el['link'] );
				$je_trg = ( '' === $s && preg_match( '#/shop/?$#', (string) $el['link'] ) );
				$izbran = ( $term && $v_meniju ) ? ( '' !== $s && $s === $vrh_slug ) : $je_trg;
				echo '<a href="' . esc_url( $el['link'] ) . '"' . ( $izbran ? ' class="je-izbran" aria-current="true"' : '' ) . '>' . esc_html( $el['text'] ) . '</a>';
			}
			?>
		</div>
	</div>
</section>
	<?php
}

/** Vrstni red podkategorij: najprej paketi po stevilu kosov (1, 3, 6, 9 ...), nato ostale. */
function noriks_bg_uredi_podkategorije( $a, $b ) {
	$na = preg_match( '/^(\d+)/', $a->name, $ma ) ? (int) $ma[1] : 100000;
	$nb = preg_match( '/^(\d+)/', $b->name, $mb ) ? (int) $mb[1] : 100000;
	if ( $na !== $nb ) {
		return $na < $nb ? -1 : 1;
	}
	return strcmp( $a->name, $b->name );
}

/** Vrstica filtrov pod glavo: cipi podkategorij, stevilo izdelkov, razvrscanje. */
function noriks_bg_filtri() {
	if ( ! function_exists( 'is_product_category' ) ) {
		return;
	}
	$cipi = array();
	$term = is_product_category() ? get_queried_object() : null;
	$vrh  = $term ? noriks_bg_vrh( $term ) : null;
	if ( $vrh && ! in_array( $vrh->slug, noriks_bg_skupine_trgovine(), true ) ) {
		$otroci = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => $vrh->term_id, 'hide_empty' => true ) );
		if ( is_array( $otroci ) && $otroci ) {
			$l = get_term_link( $vrh );
			if ( ! is_wp_error( $l ) ) {
				$cipi[] = array( $vrh->name, $l, $vrh->term_id === $term->term_id );
			}
			usort( $otroci, 'noriks_bg_uredi_podkategorije' );
			foreach ( $otroci as $o ) {
				$l = get_term_link( $o );
				if ( ! is_wp_error( $l ) ) {
					$cipi[] = array( $o->name, $l, $o->term_id === $term->term_id || (int) $term->parent === (int) $o->term_id );
				}
			}
		}
	}
	if ( ! $cipi ) {
		// trgovina in kategorije brez podkategorij: vse + skupine trgovine
		list( $trg_ime, $trg_url ) = noriks_bg_trgovina();
		$cipi[] = array( $trg_ime, $trg_url, ! $term );
		foreach ( noriks_bg_skupine_trgovine() as $slug ) {
			$t = get_term_by( 'slug', $slug, 'product_cat' );
			if ( $t && ! is_wp_error( $t ) && ! empty( $t->count ) ) {
				$l = get_term_link( $t );
				if ( ! is_wp_error( $l ) ) {
					$cipi[] = array( $t->name, $l, $vrh && $vrh->term_id === $t->term_id );
				}
			}
		}
	}
	$stevilo = isset( $GLOBALS['wp_query'] ) && isset( $GLOBALS['wp_query']->found_posts ) ? (int) $GLOBALS['wp_query']->found_posts : 0;
	?>
<section class="nb nb-filtri">
	<div class="nb-filtri__in">
		<div class="nb-filtri__cipi">
			<?php
			if ( count( $cipi ) > 1 ) {
				foreach ( $cipi as $c ) {
					echo '<a class="nb-cip' . ( $c[2] ? ' je-izbran' : '' ) . '" href="' . esc_url( $c[1] ) . '">' . esc_html( $c[0] ) . '</a>';
				}
			}
			?>
		</div>
		<div class="nb-filtri__desno">
			<?php if ( $stevilo > 0 ) : ?><span class="nb-filtri__st"><b><?php echo (int) $stevilo; ?></b> продукта</span><?php endif; ?>
			<?php
			if ( function_exists( 'woocommerce_catalog_ordering' ) ) {
				woocommerce_catalog_ordering();
			}
			?>
		</div>
	</div>
</section>
	<?php
}

// Razvrscanje v bolgarscini (WooCommerce na tej strani nima prevoda teh napisov).
add_filter( 'woocommerce_catalog_orderby', function ( $moznosti ) {
	$bg = array(
		'menu_order' => 'По подразбиране',
		'popularity' => 'Най-популярни',
		'rating'     => 'Най-висока оценка',
		'date'       => 'Най-нови',
		'price'      => 'Цена: ниска към висока',
		'price-desc' => 'Цена: висока към ниска',
	);
	foreach ( (array) $moznosti as $k => $v ) {
		if ( isset( $bg[ $k ] ) ) {
			$moznosti[ $k ] = $bg[ $k ];
		}
	}
	return $moznosti;
}, 20 );

// Drobtinice na strani izdelka.
add_action( 'woocommerce_before_single_product', function () {
	global $product;
	if ( ! $product || ! is_object( $product ) || ! method_exists( $product, 'get_id' ) ) {
		return;
	}
	list( $trg_ime, $trg_url ) = noriks_bg_trgovina();
	$drob = array( array( 'NORIKS', home_url( '/' ) ), array( $trg_ime, $trg_url ) );
	foreach ( noriks_bg_meni() as $el ) {
		$s = isset( $el['link'] ) ? noriks_bg_slug_povezave( $el['link'] ) : '';
		if ( '' !== $s && has_term( $s, 'product_cat', $product->get_id() ) ) {
			$drob[] = array( isset( $el['text'] ) ? $el['text'] : '', $el['link'] );
			break;
		}
	}
	$drob[] = array( trim( (string) preg_replace( '/\s*\|.*$/u', '', $product->get_name() ) ), '' );
	noriks_bg_drobtine( $drob, 'nb-drobtine--izdelek' );
}, 4 );

/** Izdelki, ki so samo dodatna ponudba (Mystery majica) in ne sodijo v prikaze. */
function noriks_bg_skriti() {
	$ids = get_transient( 'noriks_bg_skriti_v1' );
	if ( is_array( $ids ) ) {
		return $ids;
	}
	$ids = array();
	foreach ( get_posts( array( 'post_type' => 'product', 'post_status' => 'publish', 's' => 'Mystery', 'fields' => 'ids', 'posts_per_page' => 30 ) ) as $id ) {
		if ( false !== stripos( (string) get_the_title( $id ), 'mystery' ) ) {
			$ids[] = (int) $id;
		}
	}
	set_transient( 'noriks_bg_skriti_v1', $ids, HOUR_IN_SECONDS );
	return $ids;
}
add_action( 'save_post_product', function () {
	delete_transient( 'noriks_bg_skriti_v1' );
} );
// Tudi v mrezi trgovine in kategorij.
add_action( 'woocommerce_product_query', function ( $q ) {
	$skriti = noriks_bg_skriti();
	if ( $skriti && is_object( $q ) && method_exists( $q, 'set' ) ) {
		$q->set( 'post__not_in', array_merge( (array) $q->get( 'post__not_in' ), $skriti ) );
	}
} );

/** Cena na kos za pakete - isti izracun in napisi kot na strani izdelka. */
function noriks_bg_cena_na_kos( $p, $cena ) {
	if ( ! function_exists( 'get_field' ) || $cena <= 0 ) {
		return '';
	}
	$n = (int) get_field( 'number_of_shirts_in_this_product', $p->get_id() );
	if ( $n < 2 ) {
		return '';
	}
	$pred = trim( (string) get_field( 'singlepp_priceper_before', 'options' ) );
	$po   = trim( (string) get_field( 'singlepp_priceper_after', 'options' ) );
	if ( '' === $pred && '' === $po ) {
		return '';
	}
	$kos = ceil( $cena / $n * 100 ) / 100;
	return trim( $pred . ' ' . number_format( $kos, 2, ',', '.' ) . ' ' . $po );
}

/** Kartica izdelka (drsniki na domaci strani): slika z drugo sliko ob prehodu, popust, stevilo kosov, cena, prihranek, cena na kos, gumb. */
function noriks_bg_kartica( $p ) {
	if ( ! $p || ! is_object( $p ) || ! method_exists( $p, 'get_id' ) ) {
		return '';
	}
	$id  = (int) $p->get_id();
	$ime = trim( (string) preg_replace( '/\s*\|.*$/u', '', $p->get_name() ) );
	if ( $p->is_type( 'variable' ) ) {
		$redna  = (float) $p->get_variation_regular_price( 'min', true );
		$znizan = (float) $p->get_variation_sale_price( 'min', true );
	} else {
		$redna  = (float) $p->get_regular_price();
		$znizan = (float) $p->get_sale_price();
	}
	$popust = ( $znizan > 0 && $redna > $znizan ) ? (int) round( ( $redna - $znizan ) / $redna * 100 ) : 0;
	$cena   = $popust ? $znizan : $redna;
	$prva   = $p->get_image_id() ? wp_get_attachment_image_url( $p->get_image_id(), 'woocommerce_thumbnail' ) : '';
	$gal    = $p->get_gallery_image_ids();
	$druga  = ! empty( $gal ) ? wp_get_attachment_image_url( $gal[0], 'woocommerce_thumbnail' ) : '';
	$gumb   = function_exists( 'brand_chrome_domaca' ) ? brand_chrome_domaca() : array();
	$gumb   = isset( $gumb['izdelki']['gumb'] ) ? (string) $gumb['izdelki']['gumb'] : '';
	$kosov  = function_exists( 'get_field' ) ? (int) get_field( 'number_of_shirts_in_this_product', $id ) : 0;
	$na_kos = noriks_bg_cena_na_kos( $p, $cena );
	$pusc   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';

	$h  = '<a class="nb-izd" href="' . esc_url( get_permalink( $id ) ) . '">';
	$h .= '<span class="nb-izd__slika">';
	if ( $popust ) {
		$h .= '<span class="nb-izd__popust">-' . $popust . '%</span>';
	}
	if ( $kosov > 1 ) {
		$h .= '<span class="nb-izd__kosov">' . $kosov . ' бр.</span>';
	}
	if ( $prva ) {
		$h .= '<img src="' . esc_url( $prva ) . '" alt="' . esc_attr( $ime ) . '" loading="lazy">';
	}
	if ( $druga && $druga !== $prva ) {
		$h .= '<img class="nb-izd__druga" src="' . esc_url( $druga ) . '" alt="" loading="lazy">';
	}
	$h .= '</span>';
	$h .= '<span class="nb-izd__telo">';
	$h .= '<span class="nb-izd__ime">' . esc_html( $ime ) . '</span>';
	$h .= '<span class="nb-izd__cena">';
	if ( $popust ) {
		$h .= '<b>' . wc_price( $znizan ) . '</b><s>' . wc_price( $redna ) . '</s><em>-' . wc_price( $redna - $znizan ) . '</em>';
	} elseif ( $redna > 0 ) {
		$h .= '<b>' . wc_price( $redna ) . '</b>';
	} else {
		$h .= '<b>' . $p->get_price_html() . '</b>';
	}
	$h .= '</span>';
	$h .= '<span class="nb-izd__kos">' . ( '' !== $na_kos ? esc_html( $na_kos ) : '&nbsp;' ) . '</span>';
	if ( '' !== $gumb ) {
		$h .= '<span class="nb-izd__gumb">' . esc_html( $gumb ) . $pusc . '</span>';
	}
	$h .= '</span></a>';
	return $h;
}

/** Domaca stran: kartice za rocno izbrane izdelke (ACF seznam "najbolj priljubljeni"). */
function noriks_bg_kartice( $izdelki ) {
	$skriti = noriks_bg_skriti();
	$h      = '';
	foreach ( (array) $izdelki as $p ) {
		if ( is_object( $p ) && method_exists( $p, 'get_id' ) && ! in_array( (int) $p->get_id(), $skriti, true ) ) {
			$h .= noriks_bg_kartica( $p );
		}
	}
	return $h;
}

/** Domaca stran: izdelki po kategorijah iz glavnega menija (zavihki + drsnik). */
function noriks_bg_po_kategorijah() {
	if ( ! function_exists( 'wc_get_products' ) || ! function_exists( 'wc_price' ) ) {
		return;
	}
	$zav = array();
	foreach ( noriks_bg_meni() as $el ) {
		$s = isset( $el['link'] ) ? noriks_bg_slug_povezave( $el['link'] ) : '';
		if ( '' === $s ) {
			continue;
		}
		$t = get_term_by( 'slug', $s, 'product_cat' );
		if ( ! $t || is_wp_error( $t ) ) {
			continue;
		}
		$izd = wc_get_products( array( 'status' => 'publish', 'limit' => 12, 'category' => array( $s ), 'orderby' => 'menu_order', 'order' => 'ASC', 'exclude' => noriks_bg_skriti() ) );
		if ( ! $izd ) {
			continue;
		}
		$kartice = '';
		foreach ( $izd as $p ) {
			$kartice .= noriks_bg_kartica( $p );
		}
		if ( '' !== $kartice ) {
			$zav[] = array( $t->name, $el['link'], $kartice );
		}
	}
	if ( ! $zav ) {
		return;
	}
	$pusc_l = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>';
	$pusc_d = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
	echo '<section class="nb nb-kategorije"><div class="nb-ovoj">';
	echo '<div class="nb-kategorije__glava"><div class="nb-kategorije__zavihki" role="tablist">';
	foreach ( $zav as $i => $z ) {
		echo '<button type="button" class="nb-zavihek' . ( 0 === $i ? ' je-izbran' : '' ) . '" role="tab" aria-selected="' . ( 0 === $i ? 'true' : 'false' ) . '" data-i="' . (int) $i . '">' . esc_html( $z[0] ) . '</button>';
	}
	echo '</div><div class="nb-kategorije__nav">';
	echo '<button type="button" class="nb-pusc nb-pusc--temna" data-trak=".nb-kategorije .nb-trak:not([hidden])" data-smer="-1" aria-label="Назад">' . $pusc_l . '</button>';
	echo '<button type="button" class="nb-pusc nb-pusc--temna" data-trak=".nb-kategorije .nb-trak:not([hidden])" data-smer="1" aria-label="Напред">' . $pusc_d . '</button>';
	echo '</div></div>';
	foreach ( $zav as $i => $z ) {
		echo '<div class="nb-trak" data-i="' . (int) $i . '"' . ( 0 === $i ? '' : ' hidden' ) . '>' . $z[2];
		echo '<a class="nb-izd nb-izd--vse" href="' . esc_url( $z[1] ) . '"><span class="nb-izd__vse"><b>' . esc_html( $z[0] ) . '</b>' . $pusc_d . '</span></a>';
		echo '</div>';
	}
	echo '</div></section>';
}

// Drsniki in zavihki (ena skripta za vse).
add_action( 'wp_footer', function () {
	?>
<script>
(function () {
	document.addEventListener('click', function (e) {
		if (!e.target.closest) { return; }
		var b = e.target.closest('.nb-pusc');
		if (b) {
			var g = document.querySelector(b.getAttribute('data-trak'));
			if (!g || !g.firstElementChild) { return; }
			var w = g.firstElementChild.getBoundingClientRect().width + 18;
			g.scrollBy({ left: w * 2 * parseInt(b.getAttribute('data-smer'), 10), behavior: 'smooth' });
			return;
		}
		var z = e.target.closest('.nb-zavihek');
		if (z) {
			var s = z.closest('.nb-kategorije'), i = z.getAttribute('data-i');
			Array.prototype.forEach.call(s.querySelectorAll('.nb-zavihek'), function (x) { x.classList.toggle('je-izbran', x === z); x.setAttribute('aria-selected', x === z ? 'true' : 'false'); });
			Array.prototype.forEach.call(s.querySelectorAll('.nb-trak'), function (t) { t.hidden = t.getAttribute('data-i') !== i; });
		}
	});
})();
</script>
	<?php
}, 32 );
