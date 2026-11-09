<?php
/**
 * product-bottom: NORIKS WineCooler — štapić za hlađenje vina s izljevom (orto-winecooler).
 * Original: lindnerco.nl/products/wijnkoeler-geen-lauwe-wijn-meer — vsebina 1:1 z originalom
 * (isti vrstni red, ista besedila, prevedena v hrvascino), oblika po NORIKS stilu (kot why-hands.php):
 *   1) Videi kupaca (3 videa, preprosta mreza)
 *   2) Recite zbogom toplom vinu + 4 prednosti (harmonike originala kot kartice z besedilom)
 *   3) Za ljubitelje vina — slika levo, besedilo desno
 *   4) Higijena i vrhunska kvaliteta — 6 mnenj v preprosti mrezi (brez tekocega traku)
 *   5) Odlično 4,8 / 5
 *   6) NORIKS pogoji (30 dana za povrat, besplatna dostava iznad 70 EUR) — besedilo levo, slika desno
 * Brez promo pasice, tekocega traku, valovitih razdelilnikov, animacij in dodatkov v nakupni skatli.
 * FAQ originala je v reviews.php ($winecooler_faq), mnenja v auto_reviews/HR_winecooler.php
 * (tja so prestavljeni tudi 3 citati iz okvirja "Poslušajte naše kupce" iz nakupne skatle originala).
 * Slike: img/winecooler/ (logotip konkurenta na skatli zamenjan z NORIKS, napisi prevedeni v hrvascino).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$nwc      = get_template_directory_uri() . '/img/winecooler/';
$nwc_path = get_template_directory() . '/img/winecooler/';
$nwc_img  = function( $file, $alt ) use ( $nwc, $nwc_path ) {
  if ( ! file_exists( $nwc_path . $file ) ) { return ''; }
  return '<img src="' . esc_url( $nwc . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="eager">';
};
$nwc_video = function( $n, $label ) use ( $nwc, $nwc_path ) {
  $file = 'wc-video-' . $n . '.mp4'; $poster = 'wc-video-' . $n . '-poster.webp';
  if ( ! file_exists( $nwc_path . $file ) ) { return ''; }
  return '<div class="nwc-vid"><video src="' . esc_url( $nwc . $file ) . '"'
    . ( file_exists( $nwc_path . $poster ) ? ' poster="' . esc_url( $nwc . $poster ) . '"' : '' )
    . ' playsinline preload="metadata" aria-label="' . esc_attr( $label ) . '"></video>'
    . '<button type="button" class="nwc-play" aria-label="' . esc_attr( 'Prehrať video: ' . $label ) . '"></button></div>';
};

/* 2) prednosti — 1:1 z originala (harmonike) */
$nwc_feat = array(
  array( 'Vysoká kvalita', 'Vyrobený z vysokokvalitnej nehrdzavejúcej ocele vhodnej na styk s potravinami, tento výrobok ponúka trvalú kvalitu a spoľahlivosť pri každodennom používaní.' ),
  array( 'Okamžitý pôžitok', 'Jednoducho sa používa, rýchlo sa nasadí a je neuveriteľne praktický — ľahké riešenie, ako si vychutnať víno bez akejkoľvek námahy.' ),
  array( 'Dokonalé nalievanie', 'Rozlúčte sa s rozliatym vínom. Tento nalievač zakaždým zaistí rovnomerné nalievanie bez kvapkania a udrží vaše víno aj stôl dokonale čisté.' ),
  array( 'Odomknite plnú chuť', 'Zabudované prevzdušňovanie umožní, aby sa arómy vína naplno rozvinuli, čím sa zlepší chuť a zážitok z vína je bohatší.' ),
);

/* 4) mnenja — 1:1 z originala (isti vrstni red, ista imena) */
$nwc_testimonials = array(
  array( 'Skvelá vec', 'Skvelá vec, rovnomerne chladí a nalieva bez rozliatia.', 'Emma Molenaar' ),
  array( 'Praktické', 'Praktické je, že zátka zároveň uzatvára; žiadne kvapky na obruse.', 'Lars van Dam' ),
  array( 'Používam ho', 'Používam ho hlavne na rosé — zostane svieže až do posledného pohára.', 'Julian Rietveld' ),
  array( 'Chladí lepšie', 'Chladí lepšie ako samostatné chladiace vložky, ktoré som mala. ✨', 'Nina Mulder' ),
  array( 'Funguje rýchlo', 'Funguje rýchlo; za desať minút citeľne chladnejšie.', 'Sara Smits' ),
  array( 'Praktický', 'Praktický a pevný, presne to, čo som hľadal.', 'Jesse de Bruin' ),
);
?>

<!-- 1) VIDEI KUPACA -->
<section class="nwc-sec nwc-tint">
  <div class="nwc-wrap">
    <p class="nwc-kicker nwc-kicker--c">Videá zákazníkov</p>
    <h2 class="nwc-h2 nwc-h2--c">Vypočujte si <em>našich zákazníkov</em> <span class="nwc-stars">★★★★★</span></h2>
    <div class="nwc-vids">
      <?php echo $nwc_video( 1, 'Video zákazníka 1 — NORIKS WineCooler' ); ?>
      <?php echo $nwc_video( 2, 'Video zákazníka 2 — NORIKS WineCooler' ); ?>
      <?php echo $nwc_video( 3, 'Video zákazníka 3 — NORIKS WineCooler' ); ?>
    </div>
  </div>
</section>

<!-- 2) RECITE ZBOGOM TOPLOM VINU + prednosti -->
<section class="nwc-sec">
  <div class="nwc-wrap">
    <h2 class="nwc-h2 nwc-h2--c">Rozlúčte sa s <em>teplým vínom</em></h2>
    <p class="nwc-sub">Teraz si môžete zakaždým vychutnať dokonale vychladené víno, bez obáv z horúčavy!</p>
    <div class="nwc-feat">
      <?php foreach ( $nwc_feat as $f ) : ?>
      <article class="nwc-feat__card">
        <h3><?php echo esc_html( $f[0] ); ?></h3>
        <p><?php echo esc_html( $f[1] ); ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 3) ZA LJUBITELJE VINA — slika lijevo -->
<section class="nwc-sec nwc-tint">
  <div class="nwc-wrap nwc-row2">
    <div class="nwc-media"><?php echo $nwc_img( 'wc-ljubitelji-vina.webp', 'Nalievanie vychladeného vína cez nalievač NORIKS WineCooler na pláži' ); ?></div>
    <div class="nwc-copy">
      <p class="nwc-kicker">Chladenie</p>
      <h2 class="nwc-h2">Pre <em>milovníkov vína</em></h2>
      <p>Otvorená fľaša na stole sa za pol hodiny zohreje a vedierko s ľadom víno rozriedi a nechá na obruse mláku. Tyčinka vyrieši oboje: vychladíte ju v mrazničke, vsuniete do fľaše a chladí víno <strong>zvnútra</strong>.</p>
      <p>Už za <strong>10–15 minút</strong> privedie víno na teplotu podávania a udrží ho studené <strong>až 3 hodiny</strong> — dosť na celý večer na terase.</p>
      <p>Vďaka zabudovanému nalievaču zostáva tyčinka vo fľaši aj počas nalievania: nevyťahujete ju, nekvapká a víno sa medzi dvoma pohármi nestihne zohriať.</p>
      <p class="nwc-big">S touto chladiacou tyčinkou zostane vaše víno dokonale vychladené od prvého naliatia až po posledný dúšok.</p>
    </div>
  </div>
</section>

<!-- 4) HIGIJENA I VRHUNSKA KVALITETA — slika desno -->
<section class="nwc-sec">
  <div class="nwc-wrap nwc-row2 nwc-row2--rev">
    <div class="nwc-copy">
      <p class="nwc-kicker">Kvalita</p>
      <h2 class="nwc-h2">Hygiena a <em>špičková kvalita</em></h2>
      <p>Staviame na špičkovú nehrdzavejúcu oceľ vhodnú na styk s potravinami pre neprekonateľnú kvalitu a odolnosť, aby vám chladiaca tyčinka na víno spoľahlivo slúžila celé roky.</p>
      <p>Chladiaca tyčinka na víno má odnímateľný nalievač, takže sa dá ľahko a dôkladne umyť teplou vodou.</p>
      <p class="nwc-big">Môžete ju umývať v umývačke riadu.</p>
    </div>
    <div class="nwc-media"><?php echo $nwc_img( 'wc-higijena.webp', 'Chladiaca tyčinka NORIKS WineCooler a fľaša vína' ); ?></div>
  </div>
</section>

<!-- 5) ODLIČNO 4,8 / 5 -->
<section class="nwc-sec nwc-tint">
  <div class="nwc-wrap">
    <h2 class="nwc-h2 nwc-h2--c">Výborné <em>4,8 / 5</em></h2>
    <p class="nwc-rate"><span class="nwc-rate__stars">★★★★★</span> Na základe <strong>1 081</strong> recenzií</p>
    <div class="nwc-rev">
      <?php foreach ( $nwc_testimonials as $t ) : ?>
      <article class="nwc-rev__card">
        <span class="nwc-rate__stars" aria-label="5 z 5 hviezdičiek">★★★★★</span>
        <h3><?php echo esc_html( $t[0] ); ?></h3>
        <p><?php echo esc_html( $t[1] ); ?></p>
        <cite><?php echo esc_html( $t[2] ); ?></cite>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- 6) NORIKS pogoji -->
<section class="nwc-sec">
  <div class="nwc-wrap nwc-c">
    <h2 class="nwc-h2 nwc-h2--c">Vyskúšajte ho <em>bez obáv.</em></h2>
    <p class="nwc-sub">Vychlaďte prvú fľašu a presvedčte sa o rozdiele. Ak nebudete spokojní, máte <strong>30 dní na vrátenie peňazí</strong>.</p>
    <p class="nwc-trust"><span>30 dní na vrátenie</span><span>Doprava zadarmo nad 70 €</span><span>Platba na dobierku</span></p>
  </div>
</section>

<style>
/* videi kupcev: sirsi okvir in lastni gumb za predvajanje na sredini */
.nwc-vids { margin: 0; gap: 22px; }
.nwc-vid { position: relative; }
.nwc-vid > video { width: 100%; display: block; }
.nwc-play { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%);
  width: 76px; height: 76px; border: 0; border-radius: 50%; background: rgba(255,255,255,.94);
  box-shadow: 0 10px 28px rgba(40,20,10,.28); cursor: pointer; display: grid; place-items: center; padding: 0; }
.nwc-play[hidden] { display: none; }
.nwc-play::before { content: ""; width: 0; height: 0; margin-left: 6px;
  border-top: 13px solid transparent; border-bottom: 13px solid transparent; border-left: 21px solid #8a2a3a; }
@media (max-width: 749px) { .nwc-play { width: 60px; height: 60px; } }

/* NORIKS standard: slika/video zapolni svoj stolpec v razmerju 4/5, besedilo navpicno na sredini */
.nwc-row2 { align-items: center; }
.nwc-media > img, .nwc-media > video,
.nwc-media > a > img, .nwc-media picture > img {
  width: 100%; aspect-ratio: 4 / 5; object-fit: cover; border-radius: 12px;
  box-shadow: 0 2px 4px rgba(25,20,15,.05), 0 14px 40px rgba(25,20,15,.10); }
@media (max-width: 749px) {
  .nwc-media > img, .nwc-media > video { aspect-ratio: 1 / 1; }
}

.nwc-c { text-align: center; }
.nwc-trust { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px 26px; margin: 18px 0 0; font-size: 14px; font-weight: 600; color: #6b625a; }
.nwc-trust span { position: relative; padding-left: 20px; }
.nwc-trust span::before { content: "\2713"; position: absolute; left: 0; color: #a9683f; }

.nwc-stars { color: #00b67a; letter-spacing: 2px; font-size: .8em; vertical-align: middle; }
.nwc-sec { padding: 60px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #24191b; }
.nwc-sec * { box-sizing: border-box; }
.nwc-tint { background: #f8f1ef; }
.nwc-wrap { width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.nwc-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
.nwc-media img { display: block; width: 100%; height: auto; border-radius: 0;
  box-shadow: 0 2px 4px rgba(40,20,20,.05), 0 14px 40px rgba(40,20,20,.10); }
.nwc-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #8a2c3b; margin: 0 0 10px; }
.nwc-kicker--c { text-align: center; margin-bottom: 22px; }
.nwc-h2 { font-size: clamp(25px, 3.1vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; color: #24191b; text-transform: none; }
.nwc-h2--c { text-align: center; }
.nwc-h2 em { font-style: italic; font-weight: 800; color: #8a2c3b; }
.nwc-copy p { font-size: 16px; line-height: 1.7; color: #574a4c; margin: 0 0 14px; }
.nwc-copy strong { color: #24191b; }
.nwc-big { font-size: 19px !important; font-weight: 800; color: #24191b !important; }
.nwc-sub { text-align: center; font-size: 16px; line-height: 1.6; color: #6b5a5d; max-width: 760px; margin: 0 auto 28px; }

/* 1) videi kupaca */
.nwc-vids { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; margin: 0; }
.nwc-vid { position: relative; aspect-ratio: 9 / 16; overflow: hidden; background: #f1ecea; }
.nwc-vid video { display: block; width: 100%; height: 100%; object-fit: cover; }

/* 2) prednosti */
.nwc-feat { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
.nwc-feat__card { background: #fff; border: 1px solid #eee2df; padding: 22px 20px; }
.nwc-feat__card h3 { font-size: 13px; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; color: #8a2c3b; margin: 0 0 10px; }
.nwc-feat__card p { font-size: 14.8px; line-height: 1.62; color: #574a4c; margin: 0; }

/* 4) mnenja */
.nwc-rate { text-align: center; font-size: 15px; color: #6b5a5d; margin: 0 0 24px; }
.nwc-rate__stars { color: #e0a33c; letter-spacing: 1px; }
.nwc-rev { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
.nwc-rev__card { background: #fff; border: 1px solid #eee2df; padding: 22px 20px; display: flex; flex-direction: column;
  box-shadow: 0 1px 2px rgba(40,20,20,.04), 0 10px 26px rgba(40,20,20,.06); }
.nwc-rev__card h3 { font-size: 17px; font-weight: 800; line-height: 1.3; margin: 8px 0 8px; color: #24191b; text-transform: none; }
.nwc-rev__card p { font-size: 14.6px; line-height: 1.6; color: #574a4c; margin: 0 0 14px; flex: 1 1 auto; }
.nwc-rev__card cite { font-style: normal; font-size: 14px; font-weight: 800; color: #24191b; }

/* kratek opis izdelka: zelene kljukice namesto pik */
.woocommerce div.product .woocommerce-product-details__short-description ul,
.woocommerce-product-details__short-description ul {
  list-style: none !important; margin: 10px 0 14px !important; padding-left: 0 !important; }
.woocommerce div.product .woocommerce-product-details__short-description ul li,
.woocommerce-product-details__short-description ul li {
  list-style: none !important; text-indent: 0 !important; margin: 0 0 7px !important;
  line-height: 1.45 !important; font-size: 15.5px !important;
  display: block !important; position: relative !important; padding-left: 31px !important; }
.woocommerce-product-details__short-description ul li::marker { content: "" !important; }
.woocommerce-product-details__short-description ul li::before { content: none !important; }
.woocommerce-product-details__short-description .nwc-tick {
  position: absolute !important; left: 0 !important; top: 1px !important;
  width: 21px; height: 21px; border-radius: 50%;
  background: #2f9e5f !important; color: #fff !important;
  font-size: 12px !important; font-weight: 800 !important; line-height: 21px !important;
  text-align: center !important; display: inline-block !important; }

@media (max-width: 980px) {
  .nwc-row2 { grid-template-columns: 1fr; gap: 28px; }
  .nwc-row2--rev .nwc-media { order: -1; }
  .nwc-feat { grid-template-columns: repeat(2, 1fr); }
  .nwc-rev { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .nwc-sec { padding: 42px 0; }
  .nwc-wrap { padding: 0 16px; }
  .nwc-vids { gap: 8px; }
  .nwc-feat, .nwc-rev { grid-template-columns: 1fr; }
}
</style>

<script>
(function(){
  document.querySelectorAll('.nwc-vid .nwc-play').forEach(function(b){
    b.addEventListener('click', function(){
      var v = b.parentNode.querySelector('video');
      if (!v) return;
      v.setAttribute('controls','');
      v.play(); b.hidden = true;
    });
  });
})();
</script>
