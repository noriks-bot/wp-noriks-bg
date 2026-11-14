<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" style="padding-top: 0 !important;" class="site-main" role="main">

			<?php
			/**
			 * Functions hooked in to homepage action
			 *
			 * @hooked storefront_homepage_content      - 10
			 * @hooked storefront_product_categories    - 20
			 * @hooked storefront_recent_products       - 30
			 * @hooked storefront_featured_products     - 40
			 * @hooked storefront_popular_products      - 50
			 * @hooked storefront_on_sale_products      - 60
			 * @hooked storefront_best_selling_products - 70
			 */
			//do_action( 'homepage' );
			?>
			
			
			
			<section class="hero nb-hero">
  <div class="hero__media" aria-hidden="true">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/brand/hero.jpg" alt="" fetchpriority="high" />
  </div>
  <div class="hero__overlay" aria-hidden="true"></div>
  <div class="hero__content">
    <p class="nb-nadnaslov">Създадени за истински мъже</p>
    <h1 class="hero__title">Тениската, която решава всички проблеми.</h1>
    <p class="nb-hero__pod">Тениска, която най-накрая стои добре. От сутрин до вечер.</p>
    <div class="nb-hero__gumbi">
      <a class="hero__btn" href="/bg/shop">Пазарувай сега</a>
      <a class="nb-hero__drugi" href="/bg/product-category/komplekti/">Комплекти</a>
    </div>
    <ul class="nb-hero__dejstva">
      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>Безплатна доставка за поръчки над 70 €</li>
      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>30 дни без риск</li>
      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>Размери S–4XL</li>
    </ul>
  </div>
</section>

<section class="nb nb-razlike">
  <div class="nb-ovoj">
    <div class="nb-razlike__glava">
      <p class="nb-nadnaslov">NORIKS</p>
      <h2 class="nb-h2">4 разлики, които забелязваш веднага</h2>
    </div>
    <div class="nb-razlike__mreza">
      <div class="nb-razlika"><div class="nb-razlika__vrh"><span class="nb-razlika__ik"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v18M8 7l4-4 4 4M8 17l4 4 4-4"/></svg></span><span class="nb-razlika__st">01</span></div><h3>Коремът остава покрит</h3><p>По-дълга кройка — коремът остава покрит, дори когато се наведеш или вдигнеш ръце.</p></div>
      <div class="nb-razlika"><div class="nb-razlika__vrh"><span class="nb-razlika__ik"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12h18M7 8l-4 4 4 4M17 8l4 4-4 4"/></svg></span><span class="nb-razlika__st">02</span></div><h3>Рамене без стягане</h3><p>По-широка кройка в гърдите и раменете подчертава фигурата без опъване под мишниците.</p></div>
      <div class="nb-razlika"><div class="nb-razlika__vrh"><span class="nb-razlika__ik"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 11a8 8 0 1 0-2.3 6.3M20 5v6h-6"/></svg></span><span class="nb-razlika__st">03</span></div><h3>Форма и след пране</h3><p>Не се свива и не се разтяга, деколтето остава право.</p></div>
      <div class="nb-razlika"><div class="nb-razlika__vrh"><span class="nb-razlika__ik"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.2 3.8a5.5 5.5 0 0 0-7.8 0L5 11.2V19h7.8l7.4-7.4a5.5 5.5 0 0 0 0-7.8zM16 8L3 21M17.5 15H9"/></svg></span><span class="nb-razlika__st">04</span></div><h3>Нищо не драска</h3><p>Отпечатан етикет вместо зашит, нежно за кожата цял ден.</p></div>
    </div>
  </div>
</section>


<style>
    .hero {
  position: relative;
  width: 100%;
  min-height: clamp(360px, 42vw, 560px);
  overflow: hidden;
  background: #111;
    display: flex;
  align-items: center; /* vertical centering */
}

/* Background image */
.hero__media {
  position: absolute;
  inset: 0;
}

.hero__media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transform: scale(1.02);
}

/* Subtle dark overlay for readability (stronger on left) */
.hero__overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0.38) 0%,
    rgba(0, 0, 0, 0.20) 38%,
    rgba(0, 0, 0, 0.06) 70%,
    rgba(0, 0, 0, 0.00) 100%
  );
}

/* Content */
.hero__content {
  position: relative;
  z-index: 1;

  padding: clamp(24px, 4vw, 70px);
  display: flex;
  flex-direction: column;
  justify-content: center;
  max-width: 40%; /* keeps text block like screenshot */
}

.hero__eyebrow {
  margin: 0 0 10px;
  color: rgba(255, 255, 255, 0.9);
  font-size: 14px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  font-weight: 700;
}

.hero__title {
  margin: 0 0 18px;
  color: #fff;
  font-weight: 900;
  letter-spacing: -0.02em;
  line-height: 1.05;
  font-size: clamp(34px, 4.2vw, 52px);
}

.hero__btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: fit-content;
  padding: 12px 18px;
  border: 2px solid rgba(255, 255, 255, 0.85);
  color: #fff;
  text-decoration: none;
  font-weight: 800;
  letter-spacing: 0.08em;
  font-size: 12px;
  text-transform: uppercase;
  background: transparent;
}

.hero__btn:hover {
  background: rgba(255, 255, 255, 0.12);
}

/* Optional: make it truly edge-to-edge */
.hero--fullbleed {
  border-radius: 0;
}

/* Mobile tweaks */
@media (max-width: 640px) {
  .hero__overlay {
    background: linear-gradient(
      180deg,
      rgba(0, 0, 0, 0.35) 0%,
      rgba(0, 0, 0, 0.15) 55%,
      rgba(0, 0, 0, 0.05) 100%
    );
  }

  .hero__content {
    max-width: 100%;
  }
}

</style>
			
  
  
  
  
  <section class="collections">
  <div class="collections__header">
    <h2 class="collections__title">Пазарувайте по колекция</h2>

    <a class="collections__cta" href="/bg/shop">
      Всички продукти<span aria-hidden="true">›</span>
    </a>
  </div>

  <div class="collections__grid">
    <!-- Card 1 -->
    <a class="collection-card" href="/bg/product-category/teniski/">
      <div class="collection-card__media">
        <img
          src="<?php echo get_template_directory_uri(); ?>/img/noriks-majice.jpeg"
          alt="Crew neck t-shirt"
        />
      </div>

      <div class="collection-card__body">
        <div class="collection-card__text">
          <div class="collection-card__topline">
            <h3 class="collection-card__name">Тениски</h3>
          </div>
          <p class="collection-card__desc">
           Комфорт през целия ден. Без стягане.
          </p>
        </div>

        <span class="collection-card__arrow" aria-hidden="true">›</span>
      </div>
    </a>

    <!-- Card 2 -->
    <a class="collection-card" href="/bg/product-category/boksarki/">
      <div class="collection-card__media">
        <img
          src="<?php echo get_template_directory_uri(); ?>/img/noriks-boksarice.jpeg"
          alt="V-neck t-shirt"
        />
      </div>

      <div class="collection-card__body">
        <div class="collection-card__text">
          <div class="collection-card__topline">
            <h3 class="collection-card__name">Боксерки</h3>
          </div>
          <p class="collection-card__desc">
          Меки. Дишащи. Надеждни.

          </p>
        </div>

        <span class="collection-card__arrow" aria-hidden="true">›</span>
      </div>
    </a>

    <!-- Card 3 -->
    <a class="collection-card" href="/bg/product-category/komplekti/">
      <div class="collection-card__media">
        <img
          src="<?php echo get_template_directory_uri(); ?>/img/noriks-kompleti.jpeg"
          alt="Long sleeve shirt"
        />
      </div>

      <div class="collection-card__body">
        <div class="collection-card__text">
          <div class="collection-card__topline">
            <h3 class="collection-card__name">Комплекти</h3>
       
          </div>
          <p class="collection-card__desc">
Най-добра стойност в пакет.
          </p>
        </div>

        <span class="collection-card__arrow" aria-hidden="true">›</span>
      </div>
    </a>
    
    <!-- Card 3 -->
    <a class="collection-card" href="/bg/product-category/startovi-paketi/">
      <div class="collection-card__media">
        <img
          src="<?php echo get_template_directory_uri(); ?>/img/starter-paket_.jpeg"
          alt="Long sleeve shirt"
        />
      </div>

      <div class="collection-card__body">
        <div class="collection-card__text">
          <div class="collection-card__topline">
            <h3 class="collection-card__name">Стартов пакет</h3>
           
           
          </div>
          <p class="collection-card__desc">
Опитайте NORIKS на по-изгодна цена.

          </p>
        </div>

        <span class="collection-card__arrow" aria-hidden="true">›</span>
      </div>
    </a>

   
  </div>
</section>


<style>/* ---- Section ---- */
.collections {
  background: #fff;
  padding: 20px 15px 0 15px;
  max-width: 1800px;
  display: block;
  margin: 0 auto;
}

.collections__header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 13px;
}

.collections__title {
  margin: 0;
  font-size: clamp(28px, 2.5vw, 40px);
  line-height: 1.1;
  font-weight: 800;
  letter-spacing: -0.02em;
}

.collections__cta {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border: 1px solid #111;
  border-radius: 0px;
  color: #111;
  text-decoration: none;
  font-weight: 700;
  font-size: 14px;
  white-space: nowrap;
}

.collections__cta:hover {
  background: #111;
  color: #fff;
}

/* ---- Grid ---- */
.collections__grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 10px;
}

/* ---- Card ---- */
.collection-card {
  display: grid;
  grid-template-rows: 1fr auto;
  background: #fff;
  border-radius: 5px;
  text-decoration: none;
  color: inherit;
  overflow: hidden;
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
  
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    will-change: transform;
}

.collection-card__media {
  background: #f2f2f2;
  aspect-ratio: 4 / 5;
  overflow: hidden;
}

.collection-card__media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.collection-card__body {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 14px;
  align-items: center;
  padding: 14px 14px 16px;
  background: #fff;
}

.collection-card__topline {
  display: inline-flex;
  align-items: center;
  gap: 10px;
}

.collection-card__name {
  margin: 0;
  font-size: 18px;
  line-height: 1.15;
  font-weight: 800;
  color: black; /* deep navy-ish like screenshot */
}

.collection-card__desc {
  margin: 6px 0 0;
  font-size: 14px;
  line-height: 1.35;
  color: #2b2b2b;
  max-width: 38ch;
}

.badge {


}

.collection-card__arrow {
  width: 34px;
  height: 34px;
  display: grid;
  place-items: center;
  border-radius: 3px;
  background: #f3f5f7;
  border: 1px solid #e6e9ee;
  font-size: 22px;
  line-height: 1;
  color: #111;
}

/* Hover/focus */
.collection-card:hover {
 transform: scale(1.02);
   box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08) !important;

}

.collection-card:focus-visible {
  outline: 3px solid rgba(17, 17, 17, 0.35);
  outline-offset: 4px;
}

/* ---- Responsive ---- */
@media (max-width: 1100px) {
  .collections__grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (max-width: 640px) {
  .collections {
    padding: 22px 16px;
  }

  .collections__grid {
    grid-template-columns: 1fr;
  }

  .collections__cta {
    padding: 9px 12px;
  }
}


@media (max-width: 991px) {


.collections__grid {
  grid-template-columns: repeat(2, minmax(0, 1fr));
}
.collection-card__arrow {
    display:none;

}

.products-grid {
  grid-template-columns: repeat(2, minmax(0, 1fr));
}
.product-name  {
        LINE-HEIGHT: 1.1;
        font-size: 0.9rem;
}

.product-info {
    padding: 15px 15px 5px 15px;
}



}







</style>
  		







<?php
/************ get products by category homepage  ************/
$products = array();

// Check if the repeater field has rows
if ( have_rows('homepage_section_2_product_list') ) {
  while ( have_rows('homepage_section_2_product_list') ) {
    the_row();

    // Get the product field (post object)
    $product_post = get_sub_field('product');

    if ( $product_post && $product_post instanceof WP_Post ) {
      $product = wc_get_product( $product_post->ID );
      if ( $product instanceof WC_Product ) {
        $products[] = $product;
      }
    }
  }
}
/************ get products by category homepage  ************/
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Initialize Slick Carousel (Mobile only) for PRODUCT CARDS (not images)
  if (window.innerWidth <= 768) {
    jQuery('.slider-mobile').not('.slick-initialized').slick({
      slidesToShow: 1,
      centerMode: true,
      centerPadding: '60px',
      arrows: false,
      dots: true,
      infinite: false
    });
  }

  // REMOVED: Glide init (no more image slider)
});
</script>

<style>
.slider-mobile .slick-list {
  padding-left: 0 !important;
  margin-left: 0px;
}

.slider-mobile {
  overflow: visible;
  width: 100%;
}

.slick-slide {
  transition: all 0.3s ease;
  margin-right: 20px !important;
  margin-left: -1px;
}

.slick-list {
  overflow: visible; /* important! */
}

/* Full-width horizontal dot container */
.slick-dots {
  display: flex !important;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  margin: 10px 0 0;
  padding: 0;
  list-style: none;
}

.slick-dots li {
  flex: 1;
  text-align: center;
}

/* Square dots */
.slick-dots li button {
  width: 95%;
  height: 7px;
  border-radius: 1px;
  background: #ccc;
  border: none;
  padding: 0;
  cursor: pointer;
  font-size: 0;
  margin: 0 auto;
}

/* Active dot style */
.slick-dots li.slick-active button {
  background: #333;
}
</style>

<style>
/* Ensure each grid item (product card) behaves correctly */
.product-card {
  display: flex;
  flex-direction: column;
  height: 100%;
  background: #fff;
}

.image-wrapper {
  width: 100%;
  overflow: hidden;
  position: relative;
}

/* Primary + hover swap */
.product-image-swap {
  position: relative;
}

.product-image-swap .product-img {
  display: block;
  width: 100%;
  height: auto;
}

/* second image on top, hidden */
.product-image-swap .hover-img {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  transition: opacity 0.25s ease;
}

/* swap on hover (desktop) */
.product-card:hover .product-image-swap .hover-img {
  opacity: 1;
}

.product-card:hover .product-image-swap .primary-img {
  opacity: 0;
  transition: opacity 0.25s ease;
}

/* Keep your existing link-to-pp and focus styles */
.link-to-pp {
  position: absolute;
  right: 10px;
  bottom: 41px;
  z-index: 99;
  background: #f5a622;
  width: 40px;
  height: 40px;
  z-index: 999999999;
}

a:focus,
a:hover {
  outline: none !important;
  box-shadow: none !important;
  color: inherit !important;
}
</style>

<?php if ( function_exists( 'noriks_bg_po_kategorijah' ) ) { noriks_bg_po_kategorijah(); } ?>

<section class="most-popular">
  <div style="max-width: 1800px;" class="container">

 
    
    
      <div class="collections__header">
   
    <h2 style="text-align: left; margin-bottom:0px;" class="collections__title">
      <?php echo get_field("homepage_section_2_t1"); ?>
    </h2>

    <a class="collections__cta" href="/bg/shop">
      Всички продукти  <span aria-hidden="true">›</span>
    </a>
  </div>

    <div class="nb nb-priljubljeni__nav"><button type="button" class="nb-pusc nb-pusc--temna" data-trak=".most-popular .products-grid" data-smer="-1" aria-label="Назад"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6"/></svg></button><button type="button" class="nb-pusc nb-pusc--temna" data-trak=".most-popular .products-grid" data-smer="1" aria-label="Напред"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg></button></div>
    <div class="products-grid slider-mobile2 nb-trak"><?php if ( function_exists( 'noriks_bg_kartice' ) ) { echo noriks_bg_kartice( $products ); } ?></div>

<!--
    <div class="container container--my-button">
      <div style="background: transparent; padding: 0; justify-content: left;" class="cta-button">
        <a class="cta-button2 button button--xl"
           style="margin: 0 auto; text-align: left; background: black; font-family: 'Roboto', sans-serif; color: white; text-transform: none; font-size: 15px; padding: 10px 25px 10px 25px;"
           href="<?php echo esc_url( get_field("homepage_section_2_b1_link") ); ?>">
          <?php echo esc_html( get_field("homepage_section_2_b1_text") ); ?>
        </a>
      </div>
    </div>
    -->

  </div>
</section>






	
<section class="nb nb-zgodba">
  <div class="nb-ovoj nb-zgodba__mreza">
    <div class="nb-zgodba__slika"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/noriks-hero.jpeg" alt="" loading="lazy" /></div>
    <div class="nb-zgodba__besedilo">
      <p class="nb-nadnaslov">NORIKS</p>
      <h2 class="nb-h2">Разработени за мъжката фигура. Изпробвани в ежедневието.</h2>
      <p>Доработвахме кройката върху мъже с всякакви фигури, от S до 4XL, докато започна да стои без опъване на гърдите и без да се вдига над талията. Всяка поръчка проверяваме преди изпращане, за да пристигне без дефект.</p>
      <ul class="nb-zgodba__tri">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>По-дълга кройка</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>По-широки рамене</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>Не се мачка</li>
      </ul>
      <a class="nb-gumb" href="/bg/product-category/teniski/">Тениски</a>
    </div>
  </div>
</section>

<section class="nb nb-zgodba nb-zgodba--temna">
  <div class="nb-ovoj nb-zgodba__mreza">
    <div class="nb-zgodba__slika"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/noriks-boksarice.jpeg" alt="" loading="lazy" /></div>
    <div class="nb-zgodba__besedilo">
      <p class="nb-nadnaslov">NORIKS</p>
      <h2 class="nb-h2">Боксерки, за които забравяш. От сутрин до вечер.</h2>
      <ul class="nb-tocke">
        <li><b>Не миришат</b><span>Modal забавя размножаването на бактерии, така че остават свежи и след дълъг ден.</span></li>
        <li><b>Не се набират</b><span>Крачолите остават на място, и при ходене, клек или тренировка.</span></li>
        <li><b>Коланът не стяга</b><span>Мекият ластик държи, но не притиска и след пране не губи еластичност.</span></li>
        <li><b>Нищо не драска</b><span>Отпечатан етикет и плоски шевове, нежни за кожата цял ден.</span></li>
      </ul>
      <a class="nb-gumb nb-gumb--svetel" href="/bg/product-category/boksarki/">Боксерки</a>
    </div>
  </div>
</section>

<section class="nb nb-primerjava">
  <div class="nb-ovoj nb-primerjava__mreza">
    <div class="nb-primerjava__levo">
      <div>
        <p class="nb-nadnaslov">NORIKS срещу другите марки</p>
        <h2 class="nb-h2">Не всички тениски са еднакви.</h2>
        <p>Ето защо нашите си заслужават.</p>
      </div>
      <div><a class="nb-gumb nb-gumb--svetel" href="/bg/shop">Пазарувай сега</a></div>
    </div>
    <div class="nb-primerjava__tabela">
      <div class="nb-vrsta nb-vrsta--glava"><span></span><span>NORIKS</span><span>Други марки</span></div>
      <div class="nb-vrsta"><span>Ласкава кройка за гърдите и раменете</span><span><i class="nb-da"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i></span><span><i class="nb-ne"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg></i></span></div>
      <div class="nb-vrsta"><span>Допълнителна дължина, за да остане коремът покрит</span><span><i class="nb-da"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i></span><span><i class="nb-ne"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg></i></span></div>
      <div class="nb-vrsta"><span>Супер мек плат — лек, дишащ и невероятно удобен</span><span><i class="nb-da"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i></span><span><i class="nb-ne"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg></i></span></div>
      <div class="nb-vrsta"><span>Запазва формата си и след много пранета</span><span><i class="nb-da"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i></span><span><i class="nb-ne"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg></i></span></div>
      <div class="nb-vrsta"><span>Без дразнещи, сърбящи етикети на шията</span><span><i class="nb-da"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i></span><span><i class="nb-ne"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg></i></span></div>
      <div class="nb-vrsta"><span>Гаранция за перфектно прилягане</span><span><i class="nb-da"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i></span><span><i class="nb-ne"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg></i></span></div>
    </div>
  </div>
</section>

  <section class="reviews-section">
      
      
      
    
     <div class="container" style="width: 100%;
    max-width: 1800px;
    margin: 0 auto;">
         
         <!--
    <div class="reviews-rating">

      <span style="color: #333;"><?php echo get_field("homepage_section_3_t1"); ?></span>
    </div>
-->

    <h2 class="collections__title" style="text-align: left;font-size: clamp(28px, 2.5vw, 40px);
    margin-bottom: 13px;"><?php echo get_field("homepage_section_3_t2"); ?></h2>

    <div class="nb nb-mnenja__nav"><button type="button" class="nb-pusc" data-trak=".reviews-grid" data-smer="-1" aria-label="Назад"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6"/></svg></button><button type="button" class="nb-pusc" data-trak=".reviews-grid" data-smer="1" aria-label="Напред"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg></button></div>
    <div class="reviews-grid">

    <?php 
    $bigreviews_reviews_fields = get_field("bigreviews_reviews_fields", "option");
      $bigreviews_reviews_fields2 = get_field("bigreviews_reviews_fields_2", "option");
    

    //var_dump($header_nav);
    ?>
    

      <?php if ($bigreviews_reviews_fields): ?>
    <?php foreach ($bigreviews_reviews_fields as $item): ?>
      <!-- Review 1 -->
      <div class="review-card">
        <img src="<?php echo $item['img']; ?>" alt="" class="review-image">
        <div class="review-content">
          <div class="review-meta">
            <div class="review-name"><?php echo $item['name']; ?></div>
            <div class="verified"><?php echo $item['t1']; ?></div>
          </div>
          <div class="review-text"><?php echo $item['t2']; ?></div>
          <div class="review-product">
            <img src="<?php echo $item['img2']; ?>" alt="Shirt Pack">
            <a href="<?php echo $item['link']; ?>"><?php echo $item['t3']; ?></a>
          </div>
        </div>
      </div>
     <?php endforeach; ?>
  <?php endif; ?>
          <?php if ($bigreviews_reviews_fields2): ?>
    <?php foreach ($bigreviews_reviews_fields2 as $item): ?>
      <!-- Review 1 -->
      <div class="review-card">
        <img src="<?php echo $item['img']; ?>" alt="" class="review-image">
        <div class="review-content">
          <div class="review-meta">
            <div class="review-name"><?php echo $item['name']; ?></div>
            <div class="verified"><?php echo $item['t1']; ?></div>
          </div>
          <div class="review-text"><?php echo $item['t2']; ?></div>
          <div class="review-product">
            <img src="<?php echo $item['img2']; ?>" alt="Shirt Pack">
            <a href="<?php echo $item['link']; ?>"><?php echo $item['t3']; ?></a>
          </div>
        </div>
      </div>
     <?php endforeach; ?>
  <?php endif; ?>
    
    

    </div>

 </div>
  </section>
  
  <style>
  .review-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    will-change: transform;
  }

  .review-card:hover {
    transform: scale(1.1);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    z-index: 2;
  }
</style>





		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();



