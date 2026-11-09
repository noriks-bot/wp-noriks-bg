<?php
/**
 * product-bottom: NORIKS Snug — jastuk za cijelo tijelo u S-obliku (orto-snug).
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno,
 * pozadine se izmjenjuju (prva tonirana).
 *   1) Galerija u krevetu            5) Dimenzije (desno)
 *   2) Problem — VIDEO (lijevo)      6) Preporucuju kiroprakticari
 *   3) Kako radi (desno)             7) Punjenje (lijevo)
 *   4) Tri potpore (lijevo)          8) Boje (desno)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$sg      = get_template_directory_uri() . '/img/snug/';
$sg_path = get_template_directory() . '/img/snug/';
$sg_vid  = function( $file, $poster, $alt ) use ( $sg, $sg_path ) {
  if ( ! file_exists( $sg_path . $file ) ) { return ''; }
  return '<video class="nsg-video" autoplay muted loop playsinline preload="metadata" poster="'
       . esc_url( $sg . $poster ) . '" aria-label="' . esc_attr( $alt ) . '">'
       . '<source src="' . esc_url( $sg . $file ) . '" type="video/mp4"></video>';
};
$sg_img  = function( $file, $alt, $cls = '' ) use ( $sg, $sg_path ) {
  if ( ! file_exists( $sg_path . $file ) ) { return ''; }
  return '<img class="' . esc_attr( $cls ) . '" src="' . esc_url( $sg . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
?>

<!-- 1) KAKO IZGLEDA U KREVETU (galerija) -->
<section class="nsg-sec nsg-tint">
  <div class="nsg-wrap">
    <p class="nsg-kicker nsg-center">V skutočnej spálni</p>
    <h2 class="nsg-h2 nsg-center">Objatie, ktoré vydrží celú noc</h2>
    <p class="nsg-sub">Objímte ho spredu, oprite sa oň chrbtom — vankúš funguje z oboch strán.</p>
    <div class="nsg-gallery">
      <figure><?php echo $sg_vid( 'sng-gal-1.mp4', 'sng-gal-1.jpg', 'Vankúš omotaný okolo nôh počas spánku' ); ?></figure>
      <figure><?php echo $sg_vid( 'sng-gal-2.mp4', 'sng-gal-2.jpg', 'Ako sa NORIKS Snug používa' ); ?></figure>
      <figure><?php echo $sg_vid( 'sng-gal-3.mp4', 'sng-gal-3.jpg', 'Spánok na boku s NORIKS Snug' ); ?></figure>
      <figure><?php echo $sg_vid( 'sng-gal-4.mp4', 'sng-gal-4.jpg', 'NORIKS Snug v posteli' ); ?></figure>
    </div>
  </div>
</section>

<!-- 2) PROBLEM — slika lijevo -->
<section class="nsg-sec">
  <div class="nsg-wrap nsg-row2">
    <div class="nsg-media"><?php echo $sg_vid( 'sng-video.mp4', 'sng-video.jpg', 'NORIKS Snug pri používaní' ); ?></div>
    <div class="nsg-copy">
      <p class="nsg-kicker">Problém</p>
      <h2 class="nsg-h2">Prečo sa nikdy nezobudíte <em>oddýchnutí</em></h2>
      <div class="nsg-pain__list">
        <div class="nsg-pain__row">
          <span class="nsg-pain__num">01</span>
          <div class="nsg-pain__copy">
            <h3>Rameno nesie celú váhu.</h3>
            <p>Bez opory hornej časti tela sa vrchné rameno preklopí dopredu a prevezme celú vašu váhu. To je tá tŕpnutosť, s ktorou sa budíte každé ráno.</p>
          </div>
        </div>
        <div class="nsg-pain__row">
          <span class="nsg-pain__num">02</span>
          <div class="nsg-pain__copy">
            <h3>Bedro klesá, chrbtica ho nasleduje.</h3>
            <p>Nič vám nedrží bedrá v jednej rovine, takže ich gravitácia stiahne nadol a driek sa skrúti, aby to vyrovnal. To je budenie o tretej ráno.</p>
          </div>
        </div>
        <div class="nsg-pain__row">
          <span class="nsg-pain__num">03</span>
          <div class="nsg-pain__copy">
            <h3>Kolená sa kladú na seba a šúchajú sa.</h3>
            <p>Tlak kosti o kosť rastie celú noc. Do rána kolená bolia a nohy sú ťažké ešte skôr, ako vstanete z postele.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 3) KAKO RADI — slika desno -->
<section class="nsg-sec nsg-tint">
  <div class="nsg-wrap nsg-row2 nsg-row2--rev">
    <div class="nsg-copy">
      <p class="nsg-kicker">Ako to funguje</p>
      <h2 class="nsg-h2">Tvar S drží tri body naraz</h2>
      <p>Zakrivenie kopíruje líniu tela: horná časť podopiera rameno, stred vypĺňa priestor pri páse a spodné rameno oddeľuje kolená.</p>
      <p>Váha sa rozloží po celej dĺžke namiesto toho, aby sa nazbierala na jednom mieste. Telo prestane vysielať signály, ktoré vás budia.</p>
      <ul class="nsg-check">
        <li>Odľahčené ramená, bez tlaku na jednu stranu</li>
        <li>Bedrá a panva v prirodzenej línii</li>
        <li>Oddelené kolená, bez kontaktu kosti o kosť</li>
      </ul>
      <a class="nsg-cta" href="#bundle-selector">Vyberte si svoju farbu</a>
    </div>
    <div class="nsg-media"><?php echo $sg_img( 'sng-usporedba.jpg', 'NORIKS Snug v porovnaní s bežným vankúšom' ); ?></div>
  </div>
</section>

<!-- 4) TRI KLJUČNE POTPORE — slika lijevo -->
<section class="nsg-sec nsg-trust">
  <div class="nsg-trust__head">
    <p class="nsg-trust__eyebrow">Dôvera odborníkov</p>
    <h2 class="nsg-trust__title">Odporúčajú <em>chiropraktici.</em></h2>
  </div>
  <div class="nsg-wrap">
    <div class="nsg-docs">
      <article class="nsg-doc">
        <div class="nsg-doc__img"><?php echo $sg_img( 'sng-doc-1.jpg', 'Chiropraktička s vankúšom NORIKS Snug' ); ?></div>
        <div class="nsg-doc__body">
          <p class="nsg-doc__lead">„Snug odporúčam pacientom, ktorí v noci bojujú s bolesťami bedier a drieku.”</p>
          <p class="nsg-doc__p">„Tvar S drží chrbticu v neutrálnej polohe, pretože súčasne podopiera ramená, bedrá aj kolená. Väčšina vankúšov na telo rieši len jedno z toho. Tento rieši všetky tri, a preto ho pacienti naozaj používajú ďalej.”</p>
          <div class="nsg-doc__who">
            <p class="nsg-doc__name">Chiropraktička<svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#5b7fa6"/><path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <p class="nsg-doc__role">12 rokov praxe</p>
          </div>
        </div>
      </article>
      <article class="nsg-doc">
        <div class="nsg-doc__img"><?php echo $sg_img( 'sng-doc-2.jpg', 'Chiropraktik s vankúšom NORIKS Snug' ); ?></div>
        <div class="nsg-doc__body">
          <p class="nsg-doc__lead">„U pacientov, ktorí spia na boku, je problém vždy rovnaký: prázdny priestor medzi ramenom a kolenami.”</p>
          <p class="nsg-doc__p">„Snug je jeden z mála produktov, ktoré to naozaj riešia. Podopiera celú dĺžku trupu, nielen jeden tlakový bod. Pacienti sa po dvoch týždňoch vracajú a hovoria, že ranná stuhnutosť je preč.”</p>
          <div class="nsg-doc__who">
            <p class="nsg-doc__name">Chiropraktik<svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#5b7fa6"/><path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <p class="nsg-doc__role">18 rokov praxe</p>
          </div>
        </div>
      </article>
    </div>
    <p class="nsg-note">Názory odborníkov nenahrádzajú lekárske vyšetrenie ani predpísanú liečbu.</p>
  </div>
</section>

<!-- 7) PUNJENJE — slika lijevo -->
<section class="nsg-sec nsg-tint">
  <div class="nsg-wrap nsg-row2">
    <div class="nsg-media"><?php echo $sg_img( 'sng-potpore.jpg', 'Tri kľúčové opory: ruky, bedrá, kolená' ); ?></div>
    <div class="nsg-copy">
      <p class="nsg-kicker">Tri body opory</p>
      <h2 class="nsg-h2">Jeden vankúš namiesto troch</h2>
      <p>Väčšina ľudí poskladá dva alebo tri bežné vankúše, aby získali oporu, ktorú Snug dáva sám — a potom ich celú noc prekladá.</p>
      <p>Snug drží všetky tri body naraz, takže sa nemusíte budiť, aby ste ho poprávali.</p>
      <ul class="nsg-check">
        <li>Opora rúk — predchádza tŕpnutiu počas noci</li>
        <li>Zarovnanie bedier — chrbtica ostáva neutrálna</li>
        <li>Vypodloženie kolien — sníma tlak z drieku</li>
      </ul>
    </div>
  </div>
</section>

<!-- 5) DIMENZIJE — slika desno -->
<section class="nsg-sec">
  <div class="nsg-wrap nsg-row2 nsg-row2--rev">
    <div class="nsg-copy">
      <p class="nsg-kicker">Správna veľkosť</p>
      <h2 class="nsg-h2">105 × 30 cm — dosť, ale nie priveľa</h2>
      <p>Podopiera vás od ramena po kolená, ale nezaberie celú posteľ a neprekáža partnerovi.</p>
      <p>Práve táto dĺžka je dôvod, prečo sa ľahko drží a ľahko sa s ním otáča — bez prekladania a bez budenia.</p>
      <ul class="nsg-check">
        <li>Dĺžka 105 cm, šírka 30 cm</li>
        <li>Vyhovuje všetkým výškam</li>
        <li>Ľahký, preložíte ho jednou rukou</li>
      </ul>
    </div>
    <div class="nsg-media"><?php echo $sg_img( 'sng-dimenzije.jpg', 'Rozmery: 105 × 30 cm' ); ?></div>
  </div>
</section>

<!-- 6) PREPORUČUJU STRUČNJACI (postavitev z originala) -->
<section class="nsg-sec nsg-tint">
  <div class="nsg-wrap nsg-row2">
    <div class="nsg-media"><?php echo $sg_img( 'sng-boje.jpg', 'Šesť dostupných farieb' ); ?></div>
    <div class="nsg-copy">
      <p class="nsg-kicker">Vyberte farbu</p>
      <h2 class="nsg-h2">Šesť farieb do každej spálne</h2>
      <p>Modrá, ružová, sivá, zelená, fialová a tmavomodrá — farbu si vyberiete na tejto stránke, pred pridaním do košíka.</p>
      <p>Všetky odtiene majú rovnakú chladivú tkaninu a rovnakú výplň; líši sa len farba obliečky.</p>
      <a class="nsg-cta" href="#bundle-selector">Vyberte si svoju farbu</a>
    </div>
  </div>
</section>

<!-- 10) ŠTO MOŽETE OČEKIVATI -->
<style>
.nsg-sec { padding: 62px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #1f2a37; }
.nsg-sec * { box-sizing: border-box; }
.nsg-tint { background: #f2f5f9; }
.nsg-wrap { width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.nsg-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #5b7fa6; margin: 0 0 10px; }
.nsg-h2 { font-size: clamp(25px, 3.2vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; color: #1f2a37; }
.nsg-center { text-align: center; }
.nsg-sub { text-align: center; font-size: 16px; color: #5c6b7a; max-width: 60ch; margin: 0 auto 40px; line-height: 1.6; }
.nsg-copy p { font-size: 16px; line-height: 1.7; color: #4a5765; margin: 0 0 14px; }
.nsg-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 52px; align-items: center; }
.nsg-media img { width: 100%; display: block; border-radius: 14px; box-shadow: 0 2px 4px rgba(31,42,55,.05), 0 14px 40px rgba(31,42,55,.09); }
.nsg-three { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
.nsg-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 26px 22px; }
.nsg-num { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 50%; background: #5b7fa6; color: #fff; font-weight: 800; font-size: 16px; margin-bottom: 14px; }
.nsg-card h3 { font-size: 17.5px; font-weight: 800; margin: 0 0 8px; line-height: 1.3; }
.nsg-card p { font-size: 15px; color: #5c6b7a; line-height: 1.6; margin: 0; }
.nsg-check { list-style: none; padding: 0; margin: 4px 0 22px; display: flex; flex-direction: column; gap: 11px; }
.nsg-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; }
.nsg-check li::before { content: "✓"; position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; background: #5b7fa6; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nsg-cta { display: inline-block; background: #1f2a37; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.nsg-cta:hover { background: #33445a; color: #fff !important; }
.nsg-cta--center { display: block; width: fit-content; margin: 40px auto 0; }
.nsg-trust__head { padding: 0 22px; text-align: center; margin-bottom: 34px; }
.nsg-trust__eyebrow { font-size: 12px; letter-spacing: .14em; text-transform: uppercase; font-weight: 700; color: #5b7fa6; margin: 0 0 8px; }
.nsg-trust__title { font-size: clamp(22px, 3vw, 30px); line-height: 1.15; font-weight: 800; color: #12202c; margin: 0; }
.nsg-trust__title em { font-style: italic; font-weight: 800; color: #5b7fa6; }
.nsg-docs { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 960px; margin: 0 auto; }
.nsg-doc { background: #fff; border: 1px solid #e0d6d6; border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; }
.nsg-doc__img { width: 100%; aspect-ratio: 4/5; overflow: hidden; }
.nsg-doc__img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.nsg-doc__body { padding: 22px 20px 24px; display: flex; flex-direction: column; flex: 1; }
.nsg-doc__lead { font-size: clamp(17px, 2.2vw, 19px); font-weight: 700; font-style: italic; color: #12202c; line-height: 1.45; margin: 0 0 14px; }
.nsg-doc__p { font-size: 15px; color: #3d4a57; line-height: 1.62; margin: 0 0 18px; }
.nsg-doc__who { border-top: 1px solid #e0d6d6; padding-top: 15px; margin-top: auto; }
.nsg-doc__name { margin: 0; font-size: 15px; font-weight: 700; color: #12202c; line-height: 1.3; display: flex; align-items: center; gap: 6px; }
.nsg-doc__role { margin: 4px 0 0; font-size: 13px; color: #6b7a88; line-height: 1.3; }
.nsg-note { text-align: center; font-size: 12px; color: #93a1b0; font-style: italic; margin: 22px 0 0; }
.nsg-tl { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
.nsg-tl__item { background: #f2f5f9; border-radius: 14px; padding: 26px 22px; }
.nsg-tl__when { font-size: 12.5px; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; color: #5b7fa6; margin-bottom: 8px; }
.nsg-tl__item h3 { font-size: 18px; font-weight: 800; margin: 0 0 8px; line-height: 1.3; }
.nsg-tl__item p { font-size: 15px; color: #5c6b7a; line-height: 1.6; margin: 0; }
.nsg-row2--tight { gap: 44px; align-items: center; }
.nsg-pain__list { display: flex; flex-direction: column; }
.nsg-pain__row { display: flex; gap: 18px; padding: 22px 0; border-top: 1px solid #dbe2ea; }
.nsg-pain__row:last-child { border-bottom: 1px solid #dbe2ea; }
.nsg-pain__num { flex: none; font-size: 17px; font-weight: 800; color: #5b7fa6; letter-spacing: .04em; padding-top: 5px; }
.nsg-pain__copy { flex: 1; }
.nsg-pain__copy h3 { font-size: clamp(18px, 2vw, 21px); font-weight: 800; line-height: 1.25; margin: 0 0 7px; letter-spacing: -.01em; }
.nsg-pain__copy p { font-size: 15px; line-height: 1.6; color: #5c6b7a; margin: 0; }
.nsg-h2 em { font-style: normal; color: #5b7fa6; }
.nsg-gallery { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; align-items: stretch; }
.nsg-gallery figure { margin: 0; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 4px rgba(31,42,55,.05), 0 14px 40px rgba(31,42,55,.09); }
.nsg-gallery img, .nsg-video { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; aspect-ratio: 3/4; }
.nsg-boje { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 34px; }
.nsg-media--stack { display: grid; gap: 16px; }
.nsg-boje figure { margin: 0; border-radius: 14px; overflow: hidden; }
.nsg-boje img { width: 100%; display: block; }
@media (max-width: 980px) {
  .nsg-docs { grid-template-columns: 1fr; gap: 18px; max-width: 520px; }
  .nsg-boje { grid-template-columns: 1fr 1fr; }
  .nsg-gallery { grid-template-columns: 1fr 1fr; }
  .nsg-row2 { grid-template-columns: 1fr; gap: 30px; }
  .nsg-row2--rev .nsg-media { order: -1; }
  .nsg-three, .nsg-tl, .nsg-docs { grid-template-columns: 1fr; gap: 16px; }
}
@media (max-width: 560px) {
  .nsg-gallery { grid-template-columns: 1fr; gap: 14px; }
  .nsg-gallery img, .nsg-video { aspect-ratio: 3/4; }
  .nsg-sec { padding: 44px 0; }
  .nsg-pain__row { gap: 14px; padding: 20px 0; }
  .nsg-wrap { padding: 0 16px; }
  .nsg-sub { margin-bottom: 28px; }
  .nsg-card, .nsg-tl__item { padding: 22px 18px; }
  .nsg-cta { width: 100%; text-align: center; }
}

/* ── kratek opis izdelka: kljukice namesto pik ─────────────────────── */
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
.woocommerce-product-details__short-description .nsg-tick {
  position: absolute !important; left: 0 !important; top: 1px !important;
  width: 21px; height: 21px; border-radius: 50%;
  background: #2f9e5f !important; color: #fff !important;
  font-size: 12px !important; font-weight: 800 !important; line-height: 21px !important;
  text-align: center !important; display: inline-block !important; }
.woocommerce-product-details__short-description p:first-of-type { font-size: 16px; line-height: 1.55; }
</style>
