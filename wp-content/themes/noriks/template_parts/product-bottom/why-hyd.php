<?php
/**
 * product-bottom: NORIKS HYD — boca za vodikovu vodu s PEM/SPE elektrolizom (orto-hyd).
 *
 * Redoslijed sekcija preslikan s referentne stranice (hydrah2):
 *   1. Pokretna traka (marquee)             "3 000 ppb · trajni filter · omiljena…"
 *   2. Karusel recenzija                     3 kratke izjave s fotografijama
 *   3. Watch It Fizz                         01_hidracija
 *   4. Antioxidant Power, Less Inflammation  03_prednosti
 *   5. Real User Stories                     3 kartice + 06_pravi-ljudi
 *   6. Perks of Hydrogen Water               4 prednosti
 *   7. Advanced Hydrogen Generation          04_kako-radi
 *   8. Ready to Elevate Hydration?           07_lifestyle + CTA
 * FAQ i recenzije renderira zajednicki reviews.php (ne ovdje).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$nh      = get_template_directory_uri() . '/img/hyd/';
$nh_path = get_template_directory() . '/img/hyd/';

$nh_has = function( $file ) use ( $nh_path ) { return file_exists( $nh_path . $file ); };
$nh_img = function( $file, $alt ) use ( $nh, $nh_path ) {
  if ( file_exists( $nh_path . $file ) ) {
    return '<img src="'.esc_url($nh.$file).'" alt="'.esc_attr($alt).'" loading="lazy">';
  }
  return '<div class="nhy-ph" role="img" aria-label="'.esc_attr($alt).'"><span>'.esc_html($alt).'</span></div>';
};

/* Pokretna traka — kao na referenci (bijeli tekst na plavoj, sporo), uz ikonu ispred teksta. */
$nhy_icon = array(
  'kap'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.7s6 6.4 6 10.4a6 6 0 0 1-12 0c0-4 6-10.4 6-10.4z"/></svg>',
  'beskraj'=> '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><path d="M6.8 8.2a3.8 3.8 0 1 0 0 7.6c3.4 0 4.6-7.6 8-7.6a3.8 3.8 0 1 1 0 7.6c-3.4 0-4.6-7.6-8-7.6z"/></svg>',
  'srce'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20s-7-4.4-7-9.1A3.9 3.9 0 0 1 12 8a3.9 3.9 0 0 1 7 2.9C19 15.6 12 20 12 20z"/></svg>',
);
$nhy_marquee = array(
  array( 'kap',     '3 000 ppb maksimalna infuzija' ),
  array( 'beskraj', 'Trvalý filter, bez zamjena' ),
  array( 'srce',    'Omiljena među ljubiteljima wellnessa' ),
);
?>

<!-- ============ 1) Pokretna traka ============ -->
<section class="nhy-sec nhy-sec-flush">
  <div class="nhy-marquee" aria-hidden="true">
    <div class="nhy-marquee-track">
      <?php for ( $r = 0; $r < 4; $r++ ) : foreach ( $nhy_marquee as $m ) : ?>
        <span class="nhy-marquee-item"><?php echo $nhy_icon[ $m[0] ]; ?><?php echo esc_html( $m[1] ); ?></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>
</section>

<!-- ============ 2) Pozrite, ako perlí ============ -->
<section class="nhy-sec">
  <div class="nhy-wrap">
    <h2 class="nhy-h2 nhy-center">Pozrite, ako perlí</h2>
    <p class="nhy-fizz-text">Pozrite si silné bublinky, ktoré vznikajú počas elektrolýzy — to je čistá infúzia vodíka v najlepšej podobe. Voda pritom zostáva číra a osviežujúca po každom cykle.</p>
    <div class="nhy-fizz">
      <div class="nhy-fizz-item">
        <?php if ( $nh_has('hyd-fizz-1.mp4') ) : ?>
          <video src="<?php echo esc_url($nh.'hyd-fizz-1.mp4'); ?>" poster="<?php echo esc_url($nh.'hyd-fizz-1-poster.webp'); ?>" autoplay muted loop playsinline preload="metadata"></video>
        <?php else : echo $nh_img('hyd-01-hidracija.webp','Mjehurići vodika tijekom elektrolize'); endif; ?>
      </div>
      <div class="nhy-fizz-item"><?php echo $nh_img('hyd-fizz-2.webp','Korisnica s NORIKS HYD bocom'); ?></div>
      <div class="nhy-fizz-item"><?php echo $nh_img('hyd-fizz-3.webp','Korisnik s NORIKS HYD bocom'); ?></div>
    </div>
  </div>
</section>

<!-- ============ 3) Sila antioxidantov, menej zápalov ============ -->
<section class="nhy-sec nhy-alt">
  <div class="nhy-wrap nhy-row2">
    <div class="nhy-copy">
      <h2 class="nhy-h2">Sila antioxidantov, menej zápalov</h2>
      <p>Vodíková voda je známa silným antioxidačným a protizápalovým účinkom, ktorý vedecké výskumy spájajú s prínosmi pri viac než 150 stavoch.</p>
      <p>Klinické štúdie ukázali aj to, že vypitie troch fliaš vodíkovej vody môže mať antioxidačný účinok porovnateľný s konzumáciou stoviek kusov ovocia a zeleniny.</p>
      <p class="nhy-note">Vodíková voda je doplnok každodennej hydratácie, nie náhrada lekárskej liečby.</p>
    </div>
    <div class="nhy-media"><?php echo $nh_img('hyd-03-prednosti.webp','Antioksidativno djelovanje vodikove vode'); ?></div>
  </div>
</section>

<!-- ============ 4) Prave price korisnika ============ -->
<section class="nhy-sec">
  <div class="nhy-wrap nhy-center">
    <h2 class="nhy-h2">Skutočné príbehy používateľov</h2>
  </div>
  <div class="nhy-wrap nhy-row2">
    <div class="nhy-media nhy-media-shadow"><?php echo $nh_img('hyd-06-pravi-ljudi.webp','Korisnici NORIKS HYD boce'); ?></div>
    <div class="nhy-copy">
      <ul class="nhy-stories">
        <li><strong>Regenerácia s viac energiou</strong><span>„Nakon svakog treninga osjećam manje umora u mišićima. HydraH₂ mi je oporavak učinio jednostavnim."</span></li>
        <li><strong>Hydratácia, ktorú vidieť</strong><span>„Koža mi je punija i bolje hidrirana. Savršeno za svakodnevnu rutinu."</span></li>
        <li><strong>Praktické a čisté</strong><span>„Nema okusa plastike, punjenje preko USB-a je jednostavno. Moja svakodnevna boca."</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 5) Výhody vodíkovej vody ============ -->
<section class="nhy-sec nhy-alt">
  <div class="nhy-wrap nhy-center">
    <h2 class="nhy-h2">Výhody vodíkovej vody</h2>
  </div>
  <div class="nhy-wrap">
    <div class="nhy-perks">
      <div class="nhy-perk"><strong>Lepšia hydratácia</strong><span>Obohacuje vodu vodíkom vysokej koncentrácie pre optimálnu hydratáciu.</span></div>
      <div class="nhy-perk"><strong>Nabíjateľná batéria</strong><span>USB nabíjanie za menej než 60 minút udrží fľašu pripravenú celý deň.</span></div>
      <div class="nhy-perk"><strong>Trvalý filter</strong><span>Zabudovaný filter netreba meniť — šetrí vám čas aj peniaze.</span></div>
      <div class="nhy-perk"><strong>Rýchle cykly</strong><span>Vyberte si cyklus 3 alebo 10 minút pre prispôsobenú dávku vodíka.</span></div>
    </div>
  </div>
</section>

<!-- ============ 6) Pokročilá výroba vodíka ============ -->
<section class="nhy-sec">
  <div class="nhy-wrap nhy-row2">
    <div class="nhy-media"><?php echo $nh_img('hyd-04-kako-radi.webp','PEM i SPE elektroliza — proizvodnja vodika'); ?></div>
    <div class="nhy-copy">
      <h2 class="nhy-h2">Pokročilá výroba vodíka</h2>
      <p>Vďaka špičkovej <strong>PEM a SPE elektrolýze</strong> NORIKS HYD vytvára až <strong>3 000 ppb</strong> molekulárneho vodíka vo vode. Sklenená fľaša so základňou z nehrdzavejúcej ocele zaisťuje, že voda nikdy nepríde do kontaktu s plastom, a trvalý filter generátora odstraňuje starosti s údržbou. Automatické odvzdušnenie odvedie zvyškové plyny pre čisté a bezpečné pitie.</p>
      <ul class="nhy-check">
        <li>Titánové elektródy s platinovou vrstvou</li>
        <li>99,99 % čistý vodík, vedľajšie produkty odchádzajú cez odvzdušnenie</li>
        <li>Funguje s akoukoľvek pitnou vodou, aj s destilovanou</li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 7) Spremni podici hidraciju? ============ -->
<section class="nhy-sec nhy-alt">
  <div class="nhy-wrap nhy-row2">
    <div class="nhy-copy">
      <h2 class="nhy-h2">Pripravení posunúť hydratáciu na vyššiu úroveň?</h2>
      <p>Pridajte sa k tisíckam tých, ktorí svoju wellness rutinu vylepšili vodou bohatou na vodík. Pocíťte nával energie, lepšiu regeneráciu a hydratáciu, ktorú vidieť.</p>
      <a class="nhy-cta" href="#bundle-selector">Objednať NORIKS HYD</a>
    </div>
    <div class="nhy-media"><?php echo $nh_img('hyd-07-lifestyle.webp','NORIKS HYD u svakodnevnoj upotrebi'); ?></div>
  </div>
</section>

<style>
  .nhy-sec { padding: 46px 0; background: #fff; }
  .nhy-sec-tight { padding: 28px 0 34px; }
  .nhy-alt { background: #eef4fa; }
  .nhy-wrap { max-width: 1180px; margin: 0 auto; padding: 0 18px; }
  .nhy-wrap-sm { max-width: 820px; margin: 0 auto; padding: 0 18px; }
  .nhy-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
  .nhy-h2 { font-size: clamp(24px,3.1vw,36px); font-weight: 800; color: #0f2f5c; line-height: 1.2; margin: 0 0 16px; }
  .nhy-center { text-align: center; }
  .nhy-copy p { font-size: 16px; line-height: 1.7; color: #3a3a3a; margin: 0 0 14px; }
  .nhy-note { font-size: 14px !important; color: #6b6b6b !important; }
  .nhy-media img { width: 100%; height: auto; display: block; border-radius: 16px; }
  .nhy-media-shadow img { box-shadow: 0 10px 34px rgba(15,47,92,.12); }

  .nhy-ph { width: 100%; aspect-ratio: 1/1; background: #e6eef7; border: 1px dashed #c9d9e9; border-radius: 16px;
            display: flex; align-items: center; justify-content: center; padding: 18px; box-sizing: border-box; }
  .nhy-ph span { font-size: 13px; line-height: 1.45; color: #8ba3bd; text-align: center; }

  /* 1) pokretna traka */
  /* Traka ide preko cijele sirine ekrana, i unutar uzeg containera (full-bleed). */
  .nhy-sec-flush { padding: 0; }
  .nhy-marquee { background: #3e92cc; overflow: hidden; padding: 16px 0;
                 width: 100vw; max-width: 100vw; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); }
  .nhy-marquee-track { display: flex; align-items: center; width: max-content;
                       animation: nhyMarquee 60s linear infinite; }
  .nhy-marquee-item { display: inline-flex; align-items: center; gap: 10px; padding: 0 32px;
                      font-size: 18px; font-weight: 400; letter-spacing: .63px; color: #fff; white-space: nowrap; }
  .nhy-marquee-item svg { width: 20px; height: 20px; flex: 0 0 20px; opacity: .95; }
  @keyframes nhyMarquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
  @media (prefers-reduced-motion: reduce) { .nhy-marquee-track { animation: none; } }

  /* 2) karusel recenzija */
  .nhy-car { position: relative; display: flex; align-items: center; gap: 6px; }
  .nhy-car-track { display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth;
                   -webkit-overflow-scrolling: touch; scrollbar-width: none; flex: 1 1 auto; }
  .nhy-car-track::-webkit-scrollbar { display: none; }
  .nhy-car-slide { flex: 0 0 100%; scroll-snap-align: center; display: flex; align-items: center; gap: 18px;
                   background: #fff; border: 1px solid #e3ebf3; border-radius: 16px; padding: 18px 22px;
                   box-shadow: 0 4px 16px rgba(15,47,92,.06); box-sizing: border-box; }
  .nhy-car-av { flex: 0 0 74px; }
  .nhy-car-av img { width: 74px; height: 74px; border-radius: 50%; object-fit: cover; display: block; }
  .nhy-car-body { text-align: center; flex: 1 1 auto; }
  .nhy-car-text { font-size: 15.5px; line-height: 1.55; color: #141414; margin: 0 0 8px; }
  .nhy-car-name { font-size: 13.5px; font-style: italic; color: #6b6b6b; margin: 0 0 6px; }
  .nhy-car-stars { color: #2e7fd4; font-size: 14px; letter-spacing: 2px; }
  .nhy-car-nav { flex: 0 0 auto; width: 30px; height: 30px; border: 0; background: transparent; cursor: pointer;
                 font-size: 26px; line-height: 1; color: #8ba3bd; }
  .nhy-car-nav:hover { color: #0f2f5c; }
  .nhy-car-sub { text-align: center; font-size: 13px; color: #6b6b6b; margin: 12px 0 0; }

  .nhy-fizz { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; margin: 6px 0 0; }
  .nhy-fizz-item img, .nhy-fizz-item video { width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 16px; display: block; }
  .nhy-fizz-text { max-width: 900px; margin: 0 auto 24px; text-align: center; font-size: 16px; line-height: 1.7; color: #3a3a3a; }

  .nhy-check { list-style: none; margin: 0 0 16px; padding: 0; }
  .nhy-check li { position: relative; padding: 0 0 11px 30px; font-size: 15.5px; color: #0f2f5c; line-height: 1.5; }
  .nhy-check li:before { content: "✓"; position: absolute; left: 0; top: 0; width: 20px; height: 20px; background: #2e7fd4; color: #fff; border-radius: 50%; font-size: 12px; text-align: center; line-height: 20px; }

  .nhy-stories { list-style: none; margin: 0; padding: 0; }
  .nhy-stories li { background: #f4f8fc; border: 1px solid #dbe7f3; border-radius: 14px; padding: 14px 16px; margin-bottom: 12px; }
  .nhy-stories strong { display: block; font-size: 15.5px; color: #0f2f5c; margin-bottom: 4px; }
  .nhy-stories span { display: block; font-size: 14.5px; line-height: 1.6; color: #5a5a5a; }

  .nhy-perks { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; }
  .nhy-perk { background: #fff; border: 1px solid #dbe7f3; border-radius: 16px; padding: 20px 18px; }
  .nhy-perk strong { display: block; font-size: 16px; color: #0f2f5c; margin-bottom: 6px; }
  .nhy-perk span { display: block; font-size: 14.5px; line-height: 1.6; color: #5a5a5a; }

  .nhy-cta { display: inline-block; margin-top: 8px; background: #0f2f5c; color: #fff; font-weight: 700; font-size: 16px; padding: 14px 30px; border-radius: 10px; text-decoration: none; }
  .nhy-cta:hover { background: #2e7fd4; color: #fff; }

  @media (max-width: 980px) { .nhy-perks { grid-template-columns: repeat(2,1fr); } }
  @media (max-width: 820px) { .nhy-fizz { grid-template-columns: 1fr; gap: 14px; } }
  @media (max-width: 820px) {
    .nhy-sec { padding: 30px 0; }
    .nhy-row2 { grid-template-columns: 1fr; gap: 20px; }
    .nhy-row2 .nhy-media { order: -1; }
    .nhy-h2 { font-size: 2rem; }
    .nhy-car-slide { flex-direction: column; text-align: center; gap: 12px; padding: 18px 16px; }
  }
  @media (max-width: 560px) { .nhy-perks { grid-template-columns: 1fr; } }

  /* NORIKS HYD nema velicine — nema linka na tablicu velicina. */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  /* Kratki opis: bez standardnih tocaka, ostaju samo emotikoni iz teksta. */
  .woocommerce-product-details__short-description ul { list-style: none; margin: 8px 0 26px; padding-left: 0; }
  .woocommerce-product-details__short-description ul li { list-style: none; padding-left: 0; margin-left: 0; line-height: 1.55; margin-bottom: 6px; }
  .woocommerce-product-details__short-description p:has(+ ul) { margin-top: 20px; margin-bottom: 4px; }
</style>

<script>
(function(){
  document.querySelectorAll('a.nhy-cta[href="#bundle-selector"]').forEach(function(a){
    a.addEventListener('click', function(e){
      e.preventDefault();
      var t = document.getElementById('bundle-selector') || document.querySelector('.single_add_to_cart_button');
      if (t) t.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  });

})();
</script>
