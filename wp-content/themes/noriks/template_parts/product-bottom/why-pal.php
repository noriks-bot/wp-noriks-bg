<?php
/**
 * product-bottom: NORIKS Pal — stap s dvije rucke, svjetiljkom i alarmom (orto-pal).
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno,
 * pozadine se izmjenjuju (prva tonirana). Iznimka je galerija kupaca (12).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pl      = get_template_directory_uri() . '/img/pal/';
$pl_path = get_template_directory() . '/img/pal/';
$pl_vid  = function( $file, $poster, $alt ) use ( $pl, $pl_path ) {
  if ( ! file_exists( $pl_path . $file ) ) { return ''; }
  return '<video class="npl-video" autoplay muted loop playsinline preload="metadata" poster="'
       . esc_url( $pl . $poster ) . '" aria-label="' . esc_attr( $alt ) . '">'
       . '<source src="' . esc_url( $pl . $file ) . '" type="video/mp4"></video>';
};
$pl_img  = function( $file, $alt, $cls = '' ) use ( $pl, $pl_path ) {
  if ( ! file_exists( $pl_path . $file ) ) { return ''; }
  return '<img class="' . esc_attr( $cls ) . '" src="' . esc_url( $pl . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
?>

<!-- 1) USTAJANJE -->
<!-- 1) PROBLEM — slika lijevo -->
<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2">
    <div class="npl-media"><?php echo $pl_img( 'pal-rucke.jpg', 'Ortopedické rukoväte na oporu' ); ?></div>
    <div class="npl-copy">
      <p class="npl-kicker">Druhá rukoväť</p>
      <h2 class="npl-h2">Opora presne tam, kde ju potrebujete</h2>
      <p>Okrem hornej rukoväte má palica aj <strong>druhú rukoväť nižšie</strong>. Tej sa chytíte, keď vstávate z kresla, z postele alebo z nízkej stoličky.</p>
      <p>Tlak ide zvisle nadol, do stabilnej základne — nie dopredu, kde by vás vytiahol z rovnováhy. Preto vstanete jedným pohybom, bez predkláňania a bez cudzej pomoci.</p>
      <ul class="npl-check">
        <li>Vstávanie z kresla, postele alebo z lavičky</li>
        <li>Rukoväte neodierajú dlaň ani po dlhšej chôdzi</li>
        <li>Bez čakania, kým vám niekto pomôže</li>
      </ul>
      <a class="npl-cta" href="#bundle-selector">Pozrite si ponuku</a>
    </div>
  </div>
</section>

<!-- 3) PREGLED ŠTAPA — slika lijevo -->
<section class="npl-sec">
  <div class="npl-wrap npl-row2 npl-row2--rev">
    <div class="npl-copy">
      <p class="npl-kicker">Stabilita</p>
      <h2 class="npl-h2">Stojí sama — netreba sa zohýnať za palicou</h2>
      <p>Štyri gumené nožičky držia palicu vzpriamene, keď ju pustíte. Nespadne na zem pri gauči, pri stole ani v čakárni, takže sa po nej nemusíte zohýnať.</p>
      <p>To je maličkosť, ktorú si všimnete už prvý deň: palica vás čaká tam, kde ste ju nechali.</p>
    </div>
    <div class="npl-media"><?php echo $pl_vid( 'pal-video.mp4', 'pal-video.jpg', 'Palica stojí sama na štyroch nožičkách' ); ?></div>
  </div>
</section>

<!-- 5) PROTUKLIZNA BAZA — slika lijevo -->
<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2">
    <div class="npl-media"><?php echo $pl_img( 'pal-pregled.jpg', 'Prehľad palice: dve rukoväte, svietidlo, alarm, štyri nožičky' ); ?></div>
    <div class="npl-copy">
      <p class="npl-kicker">Čo dostanete</p>
      <h2 class="npl-h2">Päť vecí v jednej palici</h2>
      <div class="npl-points">
        <div class="npl-point"><h3>Dve rukoväte</h3><p>Horná na chôdzu, dolná na vstávanie.</p></div>
        <div class="npl-point"><h3>Štyri nožičky</h3><p>Palica stojí sama a nepadá na zem.</p></div>
        <div class="npl-point"><h3>Svietidlo</h3><p>Osvetľuje cestu pred vami v tme.</p></div>
        <div class="npl-point"><h3>Alarm</h3><p>Hlasný signál, ktorý počujú domáci.</p></div>
        <div class="npl-point"><h3>Skladacia verzia</h3><p>Zmestí sa do tašky aj do priehradky v aute.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 4) STOJI SAM (video) — video desno -->
<section class="npl-sec">
  <div class="npl-wrap npl-row2 npl-row2--rev">
    <div class="npl-copy">
      <p class="npl-kicker">Základňa</p>
      <h2 class="npl-h2">Drží na dlažbe, parkete aj vonku</h2>
      <p>Gumené nožičky sú <strong>protišmykové</strong> a nešmýkajú sa na hladkých podlahách. Vonku sa základňa prispôsobí nerovnému terénu a ostáva stabilná.</p>
      <ul class="npl-check">
        <li>Nešmýka sa na dlažbe, parkete ani laminíte</li>
        <li>Prispôsobí sa nerovnému terénu</li>
        <li>Nožičky sa dajú vymeniť, keď sa opotrebujú</li>
      </ul>
    </div>
    <div class="npl-media"><?php echo $pl_img( 'pal-nozice.jpg', 'Štyri protišmykové gumené nožičky' ); ?></div>
  </div>
</section>

<!-- 6) SVJETILJKA — slika desno -->
<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2">
    <div class="npl-media"><?php echo $pl_img( 'pal-sklopivo.jpg', 'Skladacia a nastaviteľná palica' ); ?></div>
    <div class="npl-copy">
      <p class="npl-kicker">Prenosnosť</p>
      <h2 class="npl-h2">Zloží sa za sekundu a zmestí sa do tašky</h2>
      <p>Diely sú spojené vnútornou gumou, takže sa palica rozoberá a skladá <strong>jedným pohybom</strong>, bez náradia a bez cudzej pomoci. Zložená sa zmestí do tašky alebo do priehradky v aute.</p>
      <p>Výšku nastavíte za pár sekúnd, takže tá istá palica vyhovuje človeku so 155 cm aj so 190 cm.</p>
      <ul class="npl-check">
        <li>Rozobratie a zloženie bez náradia</li>
        <li>Nastaviteľná dĺžka pre všetky výšky</li>
        <li>Diely ostávajú spojené — nič sa nestratí</li>
      </ul>
    </div>
  </div>
</section>

<section class="npl-sec npl-rev">
  <div class="npl-wrap">
    <p class="npl-kicker npl-center">U našich zákazníkov</p>
    <h2 class="npl-h2 npl-center">Palica v skutočných domácnostiach</h2>
    <p class="npl-sub">Fotografie a komentáre zákazníkov — pri kresle, v chodbe, v tme a zložená na cestu.</p>
    <div class="npl-rev__grid">
      <?php
      $pl_reviews = array(
        array( 'img' => 'pal-ugc-1.jpg',    'name' => 'Mária K.',  'meta' => 'Bratislava · kúpila pred 2 mesiacmi',
               'text' => '„Držím ju pri kresle. Predtým som vstávala na tri pokusy, teraz sa chytím dolnej rukoväte a vstanem na prvý raz.”' ),
        array( 'img' => 'pal-ugc-3.jpg',    'name' => 'Zdenko P.', 'meta' => 'Košice · kúpil pred 3 mesiacmi',
               'text' => '„Stojí sama pri stole a nepadá. To je pre mňa najväčšia vec — nezohýnam sa za palicou každých päť minút.”' ),
        array( 'img' => 'pal-noc.jpg',      'name' => 'Anna M.',  'meta' => 'Žilina · kúpila pred mesiacom',
               'text' => '„Svietidlo zapínam, keď idem v noci do kúpeľne. Nebudím manžela veľkým svetlom a vidím podlahu pred sebou.”' ),
        array( 'img' => 'pal-ugc-baza.jpg', 'name' => 'Ivan Š.',    'meta' => 'Nitra · kúpil pred 6 týždňami',
               'text' => '„Základňa je široká a nešmýka sa. Vyskúšal som ju na dlažbe v kúpeľni aj na mokrej terase — drží.”' ),
        array( 'img' => 'pal-ugc-6.jpg',    'name' => 'Nadežda B.',    'meta' => 'Trnava · kúpila pred 2 mesiacmi',
               'text' => '„Kúpila som ju mame k 78. narodeninám. Sama si nastaví výšku a sama ju zloží, bez ničej pomoci.”' ),
        array( 'img' => 'pal-ugc-5.jpg',    'name' => 'Štefan L.', 'meta' => 'Prešov · kúpil pred 4 mesiacmi',
               'text' => '„Vozím ju v aute, keď idem k lekárovi. Zloží sa za sekundu a zmestí sa do tašky, v čakárni neprekáža.”' ),
      );
      foreach ( $pl_reviews as $r ) : ?>
      <article class="npl-rev__card">
        <div class="npl-rev__img"><?php echo $pl_img( $r['img'], 'Fotografija kupca — NORIKS Pal' ); ?></div>
        <div class="npl-rev__body">
          <div class="npl-rev__stars" aria-label="Ocjena 5 od 5">★★★★★</div>
          <p class="npl-rev__text"><?php echo esc_html( $r['text'] ); ?></p>
          <p class="npl-rev__name"><?php echo esc_html( $r['name'] ); ?>
            <svg width="15" height="15" viewBox="0 0 16 16" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#2f9e5f"/><path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </p>
          <p class="npl-rev__meta"><?php echo esc_html( $r['meta'] ); ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2 npl-row2--rev">
    <div class="npl-copy">
      <p class="npl-kicker">Rozdiel</p>
      <h2 class="npl-h2">Od „potrebujem pomoc” k „idem sám”</h2>
      <p>Rozdiel nie je v sile nôh, ale v tom, že máte čoho sa chytiť. Druhá rukoväť nesie váhu namiesto vašich ramien a zápästí.</p>
      <p class="npl-strong">Samostatné vstávanie, a aj prechádzka parkom.</p>
      <a class="npl-cta" href="#bundle-selector">Objednajte bez rizika — 30 dní</a>
    </div>
    <div class="npl-media"><?php echo $pl_img( 'pal-prije-poslije.jpg', 'Predtým a potom — samostatný pohyb' ); ?></div>
  </div>
</section>

<!-- 14) ŠEST RAZLOGA — slika desno -->
<style>
.npl-sec { padding: 62px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #12212b; }
.npl-sec * { box-sizing: border-box; }
.npl-tint { background: #eef6f8; }
.npl-wrap { width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.npl-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #2b8fa6; margin: 0 0 10px; }
.npl-h2 { font-size: clamp(25px, 3.2vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; }
.npl-center { text-align: center; }
.npl-copy p { font-size: 16px; line-height: 1.7; color: #465863; margin: 0 0 14px; }
.npl-strong { font-weight: 800; color: #12212b !important; font-size: 17px !important; }
.npl-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 52px; align-items: center; }
.npl-media img { width: 100%; display: block; border-radius: 14px; box-shadow: 0 2px 4px rgba(18,33,43,.05), 0 14px 40px rgba(18,33,43,.10); }
.npl-check { list-style: none; padding: 0; margin: 4px 0 0; display: flex; flex-direction: column; gap: 11px; }
.npl-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; }
.npl-check li::before { content: "✓"; position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; background: #2f9e5f; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.npl-points { display: flex; flex-direction: column; gap: 16px; margin-top: 4px; }
.npl-point h3 { font-size: 16.5px; font-weight: 800; margin: 0 0 4px; color: #2b8fa6; }
.npl-point p { font-size: 15px; color: #465863; line-height: 1.6; margin: 0; }
.npl-six { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 4px; }
.npl-reason { background: #fff; border: 1px solid #d9e8ec; border-radius: 12px; padding: 18px 16px; }
.npl-reason span { display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background: #2b8fa6; color: #fff; font-weight: 800; font-size: 13px; margin-bottom: 9px; }
.npl-reason h3 { font-size: 15.5px; font-weight: 800; margin: 0 0 5px; line-height: 1.3; }
.npl-reason p { font-size: 14px; color: #465863; line-height: 1.55; margin: 0; }
.npl-cta { display: inline-block; background: #12212b; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.npl-cta:hover { background: #2b8fa6; color: #fff !important; }
.npl-rev__grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.npl-rev__card { background: #fff; border: 1px solid #d9e8ec; border-radius: 14px; overflow: hidden;
  display: flex; flex-direction: column; box-shadow: 0 1px 2px rgba(18,33,43,.04), 0 8px 24px rgba(18,33,43,.06); }
.npl-rev__img img { width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block; border-radius: 0; box-shadow: none; }
.npl-rev__body { padding: 16px 18px 18px; }
.npl-rev__stars { color: #f0a020; font-size: 14px; letter-spacing: 1px; margin: 0 0 8px; }
.npl-rev__text { font-size: 14.5px; line-height: 1.6; color: #46545e; margin: 0 0 12px; }
.npl-rev__name { display: flex; align-items: center; gap: 6px; font-size: 14.5px; font-weight: 800; color: #12212b; margin: 0; }
.npl-rev__name svg { flex: 0 0 15px; }
.npl-rev__meta { font-size: 12.5px; color: #7b8b94; margin: 3px 0 0; }
.npl-sub { text-align: center; font-size: 16px; color: #5b6d78; max-width: 60ch; margin: 0 auto 34px; line-height: 1.6; }
.npl-video { width: 100%; display: block; border-radius: 14px; }
@media (max-width: 980px) {
  .npl-rev__grid { grid-template-columns: 1fr 1fr; }
    .npl-row2 { grid-template-columns: 1fr; gap: 30px; }
  .npl-row2--rev .npl-media { order: -1; }
  .npl-six { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
  .npl-rev__grid { grid-template-columns: 1fr; gap: 16px; }
  .npl-sec { padding: 44px 0; }
  .npl-wrap { padding: 0 16px; }
  .npl-six { grid-template-columns: 1fr; gap: 14px; }
  .npl-cta { width: 100%; text-align: center; }
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
