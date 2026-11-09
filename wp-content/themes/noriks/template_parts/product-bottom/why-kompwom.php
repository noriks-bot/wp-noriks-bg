<?php
/**
 * product-bottom: NORIKS FIT Woman — oblikujuca majica s 3D linijama (orto-kompwom).
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno.
 * Recenzije su preslikane s originala (leonieandco): bordo pas + vodoravni klizac.
 *   1) Zagladen trbuh (lijevo)     5) Tkanina i kroj (desno)
 *   2) Mi vs drugi (desno)         6) Kako je nositi (lijevo)
 *   3) RECENZIJE — klizac          7) Boje (desno)
 *   4) Osjecajte se sigurno (lijevo)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$kw      = get_template_directory_uri() . '/img/kompwom/';
$kw_path = get_template_directory() . '/img/kompwom/';
$kw_img  = function( $file, $alt, $cls = '' ) use ( $kw, $kw_path ) {
  if ( ! file_exists( $kw_path . $file ) ) { return ''; }
  return '<img class="' . esc_attr( $cls ) . '" src="' . esc_url( $kw . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
?>

<!-- 1) ZAGLAĐEN TRBUH — slika lijevo -->
<section class="nkw-sec nkw-tint">
  <div class="nkw-wrap nkw-row2">
    <div class="nkw-media"><?php echo $kw_img( 'kwm-trbuh.jpg', 'Vyhladené brucho v tričku NORIKS FIT Woman' ); ?></div>
    <div class="nkw-copy">
      <p class="nkw-kicker">Hneď, od prvej minúty</p>
      <h2 class="nkw-h2">Vyhladené brucho <em>bez stláčania</em></h2>
      <p>Naše 3D línie formujú telo tak, že jemne stiahnu oblasť brucha a bokov a podporujú cirkuláciu — bez pásu, ktorý sa zarezáva, a bez pocitu stiahnutia.</p>
      <p>Bez trička je brucho ochabnuté a záhyby vidno pod oblečením. S ním je brucho hneď vyhladené a držanie vzpriamenejšie.</p>
      <ul class="nkw-check">
        <li>Hneď vyhladené brucho</li>
        <li>Vzpriamené držanie bez rozmýšľania</li>
        <li>Neviditeľné pod oblečením</li>
      </ul>
      <a class="nkw-cta" href="#bundle-selector">Vyberte farbu a veľkosť</a>
    </div>
  </div>
</section>

<!-- 2) MI VS DRUGI — slika desno -->
<section class="nkw-sec">
  <div class="nkw-wrap nkw-row2 nkw-row2--rev">
    <div class="nkw-copy">
      <p class="nkw-kicker">Rozdiel</p>
      <h2 class="nkw-h2">Prečo bežná kompresia nefunguje</h2>
      <p>Klasické sťahovacie tričká tlačia v jednej línii. Výsledkom je vyduté miesto nad okrajom, záhyby na ramenách a okraj, ktorý vidno pod oblečením.</p>
      <p>U nás je reliéf <strong>vpletený do tkaniny</strong> a rozložený do šírky, takže sa tlak rozleje namiesto toho, aby sa nazbieral.</p>
      <ul class="nkw-vs">
        <li class="is-yes">3D technológia vpletená do úpletu</li>
        <li class="is-yes">Jemná 360° kompresia bez vydutín</li>
        <li class="is-yes">Podopiera driek</li>
        <li class="is-no">Bežná kompresia, ktorá vytvára vydutiny</li>
        <li class="is-no">Materiál sa počas dňa roluje</li>
        <li class="is-no">Okraj, ktorý vidno pod oblečením</li>
      </ul>
    </div>
    <div class="nkw-media"><?php echo $kw_img( 'kwm-usporedba.jpg', 'NORIKS FIT Woman v porovnaní s bežným sťahovacím tričkom' ); ?></div>
  </div>
</section>

<!-- 3) OSJEĆAJTE SE SIGURNO — slika lijevo -->
<section class="nkw-rev">
  <div class="nkw-rev__head">
    <span class="nkw-rev__badge">★★★★★ Vynikajúce · Hodnotenie 4,9/5</span>
    <h2 class="nkw-rev__title">Recenzie žien ako ste vy</h2>
  </div>
  <div class="nkw-rev__track">
    <?php
    $kw_reviews = array(
      array( 'img' => 'kwm-ugc-1.jpg', 'name' => 'Karolína B.', 'meta' => 'Veľkosť M · 46 · Bratislava', 'worn' => 'Nosí 7 týždňov',
             'text' => '„Košele mi sedia rovno, spredu aj zozadu. Tie, ktoré som skúšala predtým, nevydržali ani jeden celý deň.”' ),
      array( 'img' => 'kwm-ugc-2.jpg', 'name' => 'Daniela P.', 'meta' => 'Veľkosť 2XL · 48 · Košice', 'worn' => 'Nosí 5 týždňov',
             'text' => '„Prvé sťahovacie tričko, ktoré sa mi neroluje nahor. Okraj drží a látka je dosť tenká na leto.”' ),
      array( 'img' => 'kwm-ugc-3.jpg', 'name' => 'Hana T.', 'meta' => 'Veľkosť 3XL · 51 · Žilina', 'worn' => 'Nosí 6 týždňov',
             'text' => '„Kúpila som ho na svadbu a teraz ho nosím do práce. Sedenie už nemení to, ako šaty padnú.”' ),
      array( 'img' => 'kwm-ugc-4.jpg', 'name' => 'Laura D.', 'meta' => 'Veľkosť M · 43 · Nitra', 'worn' => 'Nosí 8 týždňov',
             'text' => '„Oblečiem si ho po raňajkách a zabudnem, že ho mám. Do obeda si ho vôbec nevšimnem.”' ),
      array( 'img' => 'kwm-ugc-5.jpg', 'name' => 'Natália A.', 'meta' => 'Veľkosť 2XL · 37 · Trnava', 'worn' => 'Nosí 9 týždňov',
             'text' => '„Nikdy mi to nesedelo, keď som si tričko zastrčila do nohavíc. S týmto pod tým vyzerá pás užší a celý deň sa neupravujem.”' ),
      array( 'img' => 'kwm-ugc-6.jpg', 'name' => 'Nikoleta M.', 'meta' => 'Veľkosť L · 48 · Prešov', 'worn' => 'Nosí 4 týždne',
             'text' => '„Objednala som si ho na jeden outfit a skončilo pod väčšinou svetrov. Úplet vyzerá hladko namiesto pokrčene v páse.”' ),
      array( 'img' => 'kwm-ugc-7.jpg', 'name' => 'Petra J.', 'meta' => 'Veľkosť XL · 50 · Banská Bystrica', 'worn' => 'Nosí 6 týždňov',
             'text' => '„Pri stole sedím deväť hodín denne a ostáva pohodlné. Nie sú tam švy, ktoré by bolo cítiť, a blúzka vzadu ostáva hladká.”' ),
      array( 'img' => 'kwm-ugc-8.jpg', 'name' => 'Sofia K.', 'meta' => 'Veľkosť M · 45 · Trenčín', 'worn' => 'Nosí 10 týždňov',
             'text' => '„Chrbát je mi vďačný. Tričko ma jemne pripomína, aby som sa vystrela, a pritom ma nikde nesťahuje.”' ),
    );
    foreach ( $kw_reviews as $r ) : ?>
    <article class="nkw-rev__card">
      <div class="nkw-rev__img"><?php echo $kw_img( $r['img'], 'Kupka u NORIKS FIT Woman majici' ); ?></div>
      <div class="nkw-rev__body">
        <div class="nkw-rev__top">
          <div>
            <p class="nkw-rev__name"><?php echo esc_html( $r['name'] ); ?>
              <svg width="15" height="15" viewBox="0 0 16 16" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#3aa06a"/><path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <p class="nkw-rev__meta"><?php echo esc_html( $r['meta'] ); ?></p>
          </div>
          <span class="nkw-rev__worn"><?php echo esc_html( $r['worn'] ); ?></span>
        </div>
        <p class="nkw-rev__text"><?php echo esc_html( $r['text'] ); ?></p>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
  <p class="nkw-rev__hint">Potiahnite do strany pre ďalšie recenzie →</p>
</section>

<!-- 7) BOJE — slika desno -->
<section class="nkw-sec nkw-tint">
  <div class="nkw-wrap nkw-row2">
    <div class="nkw-media"><?php echo $kw_img( 'kwm-drzanje.jpg', 'Užší pás a vzpriamené držanie' ); ?></div>
    <div class="nkw-copy">
      <p class="nkw-kicker">Tri veci naraz</p>
      <h2 class="nkw-h2">Cíťte sa <em>isto vo svojej koži</em></h2>
      <div class="nkw-points">
        <div class="nkw-point"><h3>Užší pás</h3><p>3D línie formujú pás a vyhládzajú vydutiny nad nohavicami alebo sukňou.</p></div>
        <div class="nkw-point"><h3>Hneď ploché brucho</h3><p>Jemná kompresia drží brucho pod každým oblečením, bez tlaku do jedného bodu.</p></div>
        <div class="nkw-point"><h3>Vzpriamené držanie</h3><p>Opora na chrbte pomáha stáť vzpriamene a odľahčuje driek.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 4) TKANINA I KROJ — slika desno -->
<section class="nkw-sec">
  <div class="nkw-wrap nkw-row2 nkw-row2--rev">
    <div class="nkw-copy">
      <p class="nkw-kicker">Látka a strih</p>
      <h2 class="nkw-h2">Reliéf je <em>vpletený</em>, nie potlačený</h2>
      <p>Široký pás prechádza cez brucho a boky, druhý ide cez chrbát. Preto nič nepraská a nič sa neodlupuje.</p>
      <div class="nkw-facts">
        <div><h3>3D línie</h3><p>Štruktúrované, vpletené do úpletu — časom neodpadnú.</p></div>
        <div><h3>Pás na chrbte</h3><p>Druhý pás prechádza cez chrbát a podporuje vzpriamené držanie.</p></div>
        <div><h3>Rukávy</h3><p>Priliehavý strih, ktorý sa neroluje a nesťahuje nahor.</p></div>
        <div><h3>Materiál</h3><p>Tenký, matný a priedušný — zmizne pod košeľou alebo sakom.</p></div>
      </div>
    </div>
    <div class="nkw-media"><?php echo $kw_img( 'kwm-detalji.jpg', 'Detaily: 3D línie, pás, rukávy, materiál' ); ?></div>
  </div>
</section>

<!-- 5) KAKO JE NOSITI — slika lijevo -->
<section class="nkw-sec nkw-tint">
  <div class="nkw-wrap nkw-row2">
    <div class="nkw-media"><?php echo $kw_img( 'kwm-siva.jpg', 'NORIKS FIT Woman tmavosivá' ); ?></div>
    <div class="nkw-copy">
      <p class="nkw-kicker">Ako ho nosiť</p>
      <h2 class="nkw-h2">Oblečte si ho ráno a zabudnite naň do večera</h2>
      <p>Musíte normálne dýchať a jesť bez toho, aby ste mysleli na tričko. Ak je stopa na koži viditeľná dvadsať minút po vyzlečení, veľkosť je primalá.</p>
      <ul class="nkw-check">
        <li><strong>Celý deň</strong> — kompresia je rozložená, takže nič sa nezarezáva</li>
        <li><strong>Pod všetko</strong> — bez línie a bez okraja pod oblečením</li>
        <li><strong>Jednoduchá starostlivosť</strong> — pranie v práčke na 30 °C</li>
      </ul>
      <p class="nkw-note nkw-note--left">Veľkosť vyberajte podľa obvodu hrudníka. Ak ste medzi dvoma, vezmite väčšiu.</p>
    </div>
  </div>
</section>

<!-- 6) RECENZIJE (postavitev z originala — bordo pas z drsnikom) -->
<section class="nkw-sec">
  <div class="nkw-wrap nkw-row2 nkw-row2--rev">
    <div class="nkw-copy">
      <p class="nkw-kicker">Tri farby</p>
      <h2 class="nkw-h2">Čierna, tmavosivá a <em>ružová</em></h2>
      <p>Čierna pod všetko, tmavosivá na bežné nosenie, ružová, keď chcete niečo teplejšie. Všetky tri majú rovnaký úplet a rovnaký reliéf.</p>
      <p>Farbu a veľkosť vyberáte na tejto stránke, pred pridaním do košíka.</p>
      <a class="nkw-cta" href="#bundle-selector">Vyberte farbu a veľkosť</a>
    </div>
    <div class="nkw-media"><?php echo $kw_img( 'kwm-roza.jpg', 'NORIKS FIT Woman ružová' ); ?></div>
  </div>
</section>

<style>
.nkw-sec { padding: 62px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #241c22; }
.nkw-sec * { box-sizing: border-box; }
.nkw-tint { background: #fbf3f4; }
.nkw-wrap { width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.nkw-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #a8536b; margin: 0 0 10px; }
.nkw-h2 { font-size: clamp(25px, 3.2vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; color: #241c22; }
.nkw-h2 em { font-style: italic; font-weight: 800; color: #a8536b; }
.nkw-copy p { font-size: 16px; line-height: 1.7; color: #56494f; margin: 0 0 14px; }
.nkw-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 52px; align-items: center; }
.nkw-media img { width: 100%; display: block; border-radius: 14px; box-shadow: 0 2px 4px rgba(36,28,34,.05), 0 14px 40px rgba(36,28,34,.10); }
.nkw-check { list-style: none; padding: 0; margin: 4px 0 22px; display: flex; flex-direction: column; gap: 11px; }
.nkw-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; }
.nkw-check li::before { content: "\2713"; position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; background: #2f9e5f; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nkw-vs { list-style: none; padding: 0; margin: 4px 0 0; display: flex; flex-direction: column; gap: 10px; }
.nkw-vs li { position: relative; padding-left: 28px; font-size: 15px; line-height: 1.5; }
.nkw-vs li::before { position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nkw-vs .is-yes::before { content: "\2713"; background: #2f9e5f; color: #fff; }
.nkw-vs .is-no { color: #8b7b83; }
.nkw-vs .is-no::before { content: "\2715"; background: #ece0e4; color: #a8949c; }
.nkw-points { display: flex; flex-direction: column; gap: 20px; }
.nkw-point h3 { font-size: 17.5px; font-weight: 800; margin: 0 0 6px; color: #a8536b; }
.nkw-point p { font-size: 15.5px; color: #56494f; line-height: 1.6; margin: 0; }
.nkw-facts { display: grid; grid-template-columns: 1fr 1fr; gap: 22px 26px; margin-top: 6px; }
.nkw-facts h3 { font-size: 16px; font-weight: 800; margin: 0 0 6px; color: #241c22; }
.nkw-facts p { font-size: 14.5px; color: #6b5f66; line-height: 1.6; margin: 0; }
.nkw-note { font-size: 13.5px; color: #8b7b83; font-style: italic; margin: 20px 0 0; }
.nkw-note--left { text-align: left; }
.nkw-cta { display: inline-block; background: #241c22; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.nkw-cta:hover { background: #a8536b; color: #fff !important; }

/* ── recenzije: bordo pas + vodoravni klizac (kot na originalu) ────── */
.nkw-rev { background: #5c2331; padding: 62px 0 54px; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }
.nkw-rev * { box-sizing: border-box; }
.nkw-rev__head { max-width: 1240px; margin: 0 auto 30px; padding: 0 24px; text-align: center; }
.nkw-rev__badge { display: inline-block; border: 1px solid rgba(255,255,255,.45); border-radius: 100px; padding: 8px 18px; font-size: 12.5px; font-weight: 700; letter-spacing: .04em; color: #fff; }
.nkw-rev__title { font-family: Georgia, 'Times New Roman', serif; font-size: clamp(27px, 3.4vw, 40px); font-weight: 400; color: #fff; margin: 16px 0 0; line-height: 1.2; }
.nkw-rev__track { display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;
  padding: 4px 24px 18px; margin: 0 auto; max-width: 1240px; scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.4) transparent; }
.nkw-rev__track::-webkit-scrollbar { height: 6px; }
.nkw-rev__track::-webkit-scrollbar-track { background: rgba(255,255,255,.12); border-radius: 100px; }
.nkw-rev__track::-webkit-scrollbar-thumb { background: rgba(255,255,255,.45); border-radius: 100px; }
.nkw-rev__card { flex: 0 0 310px; width: 310px; scroll-snap-align: start; background: #fff; border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; }
.nkw-rev__img img { width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block; }
.nkw-rev__body { padding: 16px 18px 20px; }
.nkw-rev__top { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
.nkw-rev__name { display: flex; align-items: center; gap: 6px; font-size: 15px; font-weight: 800; color: #241c22; margin: 0; }
.nkw-rev__name svg { flex: 0 0 15px; }
.nkw-rev__meta { font-size: 12.5px; color: #7b6d73; margin: 3px 0 0; }
.nkw-rev__worn { flex: 0 0 auto; background: #f3eaed; color: #5c2331; font-size: 10.5px; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; padding: 5px 9px; border-radius: 100px; white-space: nowrap; }
.nkw-rev__text { font-size: 14.5px; line-height: 1.6; color: #46393f; margin: 13px 0 0; }
.nkw-rev__hint { text-align: center; font-size: 12.5px; color: rgba(255,255,255,.6); margin: 8px 0 0; }

@media (max-width: 980px) {
  .nkw-row2 { grid-template-columns: 1fr; gap: 30px; }
  .nkw-row2--rev .nkw-media { order: -1; }
  .nkw-facts { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
  .nkw-sec { padding: 44px 0; }
  .nkw-wrap { padding: 0 16px; }
  .nkw-facts { grid-template-columns: 1fr; gap: 16px; }
  .nkw-cta { width: 100%; text-align: center; }
  .nkw-rev { padding: 46px 0 40px; }
  .nkw-rev__head { padding: 0 16px; }
  .nkw-rev__track { padding: 4px 16px 16px; gap: 14px; }
  .nkw-rev__card { flex: 0 0 300px; width: 300px; }
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
