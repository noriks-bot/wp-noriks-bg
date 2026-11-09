<?php
/**
 * product-bottom: NORIKS Bowl — povisena zdjelica za pse s nagibom 15° (orto-bowl).
 * Prevod s HR (SK). Slike: img/bowl/ — lokalizirane.
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno, nikoli na sredini;
 * slike su omejene na max-height 430px.
 *   1) Pre šťastnejšieho a zdravšieho psa (lijevo)   4) Za male pasmine (desno)
 *   2) Specifikacije (desno)                     5) Nehrdajuci celik (lijevo)
 *   3) Tri prednosti (lijevo)                    6) Izjava + jamstvo (desno)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$bw      = get_template_directory_uri() . '/img/bowl/';
$bw_path = get_template_directory() . '/img/bowl/';
$bw_img  = function( $file, $alt ) use ( $bw, $bw_path ) {
  if ( ! file_exists( $bw_path . $file ) ) { return ''; }
  return '<img src="' . esc_url( $bw . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
?>

<!-- 1) ZA SRETNIJEG I ZDRAVIJEG PSA — slika lijevo -->
<section class="nbw-sec nbw-tint">
  <div class="nbw-wrap nbw-row2">
    <div class="nbw-media"><?php echo $bw_img( 'bwl-05-naslov-kuhinja.jpg', 'Francúzsky buldoček pri miske NORIKS Bowl' ); ?></div>
    <div class="nbw-copy">
      <p class="nbw-kicker">Jedlo bez ohýbania krku</p>
      <h2 class="nbw-h2">Pre šťastnejšieho <em>a zdravšieho psa</em></h2>
      <p>Z bežnej misky na podlahe pes je zhrbený, s krkom ohnutým nadol. Krmivo sa tlačí k okraju a menšie psy ňufákom lovia posledné granule po rohoch.</p>
      <p>NORIKS Bowl zdvihne misku na 11 cm a nakloní ju o 15° smerom k psovi — krmivo sa zosúva k nemu a hlava zostáva v prirodzenejšej polohe.</p>
      <ul class="nbw-check">
        <li><strong>Menej ohýbania krku</strong> počas jedenia</li>
        <li><strong>Pokojnejšie jedlo</strong> — krmivo neuteká po podlahe</li>
        <li><strong>Príjemnejšie pre staršie psy</strong>, ktorým je zohýbanie namáhavé</li>
      </ul>
      <a class="nbw-cta" href="#bundle-selector">Objednať NORIKS Bowl</a>
    </div>
  </div>
</section>

<!-- 2) SPECIFIKACIJE — slika desno -->
<section class="nbw-sec">
  <div class="nbw-wrap nbw-row2 nbw-row2--rev">
    <div class="nbw-copy">
      <p class="nbw-kicker">Každý detail má svoj účel</p>
      <h2 class="nbw-h2">Navrhnutá <em>podľa toho, ako pes je</em></h2>
      <div class="nbw-facts">
        <div><span class="nbw-num">15°</span><h3>Sklon misky</h3><p>Pre lepšie držanie hlavy a krku pri jedení.</p></div>
        <div><span class="nbw-num">11 cm</span><h3>Výška podstavca</h3><p>Menej napätia v krku než pri miske na podlahe.</p></div>
        <div><span class="nbw-num">5 cm</span><h3>Plytká miska</h3><p>Fúzy nenarážajú o okraj a krmivo je ľahko dostupné.</p></div>
        <div><span class="nbw-num">430 ml</span><h3>Objem</h3><p>Priemer 15 cm — dosť na porciu alebo vodu pre malého psa.</p></div>
      </div>
    </div>
    <div class="nbw-media"><?php echo $bw_img( 'bwl-10-specifikacije.jpg', 'Špecifikácie NORIKS Bowl: sklon 15°, výška 11 cm, hĺbka 5 cm' ); ?></div>
  </div>
</section>

<!-- 3) TRI PREDNOSTI — slika lijevo -->
<section class="nbw-sec nbw-tint">
  <div class="nbw-wrap nbw-row2">
    <div class="nbw-media"><?php echo $bw_img( 'bwl-09-prednosti.jpg', 'Knírač je z misky NORIKS Bowl' ); ?></div>
    <div class="nbw-copy">
      <p class="nbw-kicker">Tri dôvody</p>
      <h2 class="nbw-h2">Prečo psy jedia <em>pohodlnejšie</em></h2>
      <div class="nbw-points">
        <div class="nbw-point"><h3>Prirodzenejšia poloha</h3><p>Sklon 15° podporuje prirodzenejšiu a pohodlnejšiu polohu pri jedení — pes nemusí tlačiť ňufák na dno misky.</p></div>
        <div class="nbw-point"><h3>Hygienická oceľ</h3><p>Prvotriedna nehrdzavejúca oceľ zostáva hygienická a svieža a ľahko sa čistí.</p></div>
        <div class="nbw-point"><h3>Hladký povrch</h3><p>Zvyšky krmiva sa nelepia, takže čistenie je rýchlejšie než pri plastovej miske.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 4) ZA MALE PASMINE — slika desno -->
<section class="nbw-sec">
  <div class="nbw-wrap nbw-row2 nbw-row2--rev">
    <div class="nbw-copy">
      <p class="nbw-kicker">Veľkosť</p>
      <h2 class="nbw-h2">Vytvorená <em>pre malé plemená</em></h2>
      <p>Výška podstavca a veľkosť misky sú prispôsobené psom nízkeho vzrastu, pre ktorých je miska na podlahe priďaleko a bežná zvýšená miska privysoká.</p>
      <ul class="nbw-breeds">
        <li>Jazvečík</li>
        <li>Francúzsky buldoček</li>
        <li>Miniatúrny knírač</li>
        <li>Mops</li>
        <li>Maltézsky psík</li>
        <li>Jack Russell teriér</li>
      </ul>
      <p class="nbw-note">Rozmery misky: priemer 15 cm, hĺbka 5 cm, objem približne 430 ml.</p>
    </div>
    <div class="nbw-media"><?php echo $bw_img( 'bwl-03-francuski-buldog.jpg', 'Francúzsky buldoček pri miske NORIKS Bowl' ); ?></div>
  </div>
</section>

<!-- 5) NEHRĐAJUĆI ČELIK — slika lijevo -->
<section class="nbw-sec nbw-tint">
  <div class="nbw-wrap nbw-row2">
    <div class="nbw-media"><?php echo $bw_img( 'bwl-06-celik.jpg', 'NORIKS Bowl z nehrdzavejúcej ocele' ); ?></div>
    <div class="nbw-copy">
      <p class="nbw-kicker">Materiál</p>
      <h2 class="nbw-h2">Oceľ namiesto <em>plastu</em></h2>
      <p>Plastové misky časom dostanú drobné škrabance, v ktorých zostávajú zvyšky krmiva a zápach. Oceľ zostáva hladká roky.</p>
      <ul class="nbw-vs">
        <li class="is-yes">Nehrdzavejúca oceľ — miska aj podstavec</li>
        <li class="is-yes">Nenasáva pachy a nemení farbu</li>
        <li class="is-yes">Opláchne sa teplou vodou za pár sekúnd</li>
        <li class="is-no">Plast, ktorý sa poškriabe a drží zvyšky</li>
        <li class="is-no">Keramika, ktorá sa po páde odštiepi</li>
      </ul>
    </div>
  </div>
</section>

<!-- 6) VOLE JE VLASNICI PASA — fotografije kupaca -->
<section class="nbw-sec nbw-rev">
  <div class="nbw-wrap">
    <h2 class="nbw-h2" style="text-align:center">Majú ju radi <em>majitelia psov</em></h2>
    <p class="nbw-rev__lead">Lepšie držanie tela. Pokojnejšie jedlá.</p>
    <p class="nbw-rev__rate"><span class="nbw-rev__stars">★★★★★</span> Hodnotenie <strong>4,8/5</strong> na základe <strong>1 081 recenzií</strong></p>
    <div class="nbw-rev__strip">
        <figure class="nbw-rev__card">
          <?php echo $bw_img( 'bwl-02-jazavcar.jpg', 'Jazvečík, 6 rokov pri miske NORIKS Bowl' ); ?>
          <figcaption><span class="nbw-rev__stars">★★★★★</span><strong>Jazvečík, 6 rokov</strong><span>„Už neje v drepe. Miska je akurát taká vysoká, aby mu hlava zostala rovno."</span></figcaption>
        </figure>
        <figure class="nbw-rev__card">
          <?php echo $bw_img( 'bwl-03-francuski-buldog.jpg', 'Francúzsky buldoček, 3 roky pri miske NORIKS Bowl' ); ?>
          <figcaption><span class="nbw-rev__stars">★★★★★</span><strong>Francúzsky buldoček, 3 roky</strong><span>„Pre psa s krátkym ňufákom je to najväčší rozdiel — je pokojnejšie a bez dusenia."</span></figcaption>
        </figure>
        <figure class="nbw-rev__card">
          <?php echo $bw_img( 'bwl-04-snaucer.jpg', 'Knírač, 8 rokov pri miske NORIKS Bowl' ); ?>
          <figcaption><span class="nbw-rev__stars">★★★★★</span><strong>Knírač, 8 rokov</strong><span>„Starší pes so stuhnutým krkom. Sklon 15° mu viditeľne uľahčil jedlo."</span></figcaption>
        </figure>
    </div>
  </div>
</section>

<!-- 7) IZJAVA + JAMSTVO — slika desno -->
<section class="nbw-sec nbw-tint">
  <div class="nbw-wrap nbw-row2 nbw-row2--rev">
    <div class="nbw-copy">
      <p class="nbw-kicker">NORIKS Bowl</p>
      <h2 class="nbw-h2">Stabilná, elegantná <em>a naozaj pohodlná</em></h2>
      <p>Podstavec stojí pevne, aj keď je pes nemotorný, oceľ sa umyje za pár sekúnd a v kuchyni vyzerá ako súčasť nábytku, nie ako plastová miska na podlahe.</p>
      <ul class="nbw-check">
        <li>Na krmivo aj na vodu — mnohí berú dve</li>
        <li>Rýchle doručenie domov</li>
        <li><strong>30 dní</strong> na vrátenie peňazí</li>
      </ul>
      <a class="nbw-cta" href="#bundle-selector">Objednať NORIKS Bowl</a>
    </div>
    <div class="nbw-media"><?php echo $bw_img( 'bwl-08-izjava.jpg', 'Jazvečík pri miske NORIKS Bowl' ); ?></div>
  </div>
</section>

<style>
.nbw-sec { padding: 60px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #1c2b44; }
.nbw-sec * { box-sizing: border-box; }
.nbw-tint { background: #eef3fa; }
.nbw-wrap { width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 24px; }
.nbw-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #2f5b9a; margin: 0 0 10px; }
.nbw-h2 { font-size: clamp(25px, 3.1vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; color: #1c2b44; }
.nbw-h2 em { font-style: italic; font-weight: 800; color: #2f5b9a; }
.nbw-copy p { font-size: 16px; line-height: 1.7; color: #4b5a70; margin: 0 0 14px; }
.nbw-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
.nbw-media { text-align: left; }
.nbw-media img { display: block; width: 100%; max-width: 100%; max-height: none; height: auto; object-fit: cover;
  border-radius: 14px; box-shadow: 0 2px 4px rgba(20,25,40,.05), 0 14px 40px rgba(20,25,40,.10); }
.nbw-check { list-style: none; padding: 0; margin: 4px 0 22px; display: flex; flex-direction: column; gap: 11px; }
.nbw-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; color: #2c3b52; }
.nbw-check li::before { content: "\2713"; position: absolute; left: 0; top: 0; width: 20px; height: 20px; border-radius: 50%; background: #2f9e5f; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nbw-vs { list-style: none; padding: 0; margin: 4px 0 0; display: flex; flex-direction: column; gap: 10px; }
.nbw-vs li { position: relative; padding-left: 28px; font-size: 15px; line-height: 1.5; color: #2c3b52; }
.nbw-vs li::before { position: absolute; left: 0; top: 0; width: 20px; height: 20px; border-radius: 50%; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nbw-vs .is-yes::before { content: "\2713"; background: #2f9e5f; color: #fff; }
.nbw-vs .is-no { color: #7d8898; }
.nbw-vs .is-no::before { content: "\2715"; background: #dfe6f0; color: #8f9bab; }
.nbw-points { display: flex; flex-direction: column; gap: 20px; }
.nbw-point h3 { font-size: 17.5px; font-weight: 800; margin: 0 0 6px; color: #2f5b9a; }
.nbw-point p { font-size: 15.5px; color: #4b5a70; line-height: 1.6; margin: 0; }
.nbw-facts { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 6px; }
.nbw-facts > div { background: #eef3fa; border-radius: 12px; padding: 16px 18px; }
.nbw-num { display: block; font-size: 26px; font-weight: 800; color: #2f5b9a; line-height: 1.1; margin-bottom: 6px; }
.nbw-facts h3 { font-size: 15.5px; font-weight: 800; margin: 0 0 4px; color: #1c2b44; }
.nbw-facts p { font-size: 14px !important; color: #5c6a7e !important; line-height: 1.5 !important; margin: 0 !important; }
.nbw-breeds { list-style: none; padding: 0; margin: 6px 0 18px; display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px 16px; }
.nbw-breeds li { position: relative; padding-left: 24px; font-size: 15.5px; font-weight: 600; color: #2c3b52; }
.nbw-breeds li::before { content: ""; position: absolute; left: 0; top: 6px; width: 12px; height: 12px; border-radius: 50%; background: #2f5b9a; }
.nbw-note { font-size: 13.5px !important; color: #7d8898 !important; font-style: italic; margin: 6px 0 0 !important; }
.nbw-cta { display: inline-block; background: #2f5b9a; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.nbw-cta:hover { background: #22477c; color: #fff !important; }

.nbw-rev__lead { text-align: center; font-size: 16px; color: #5a6b85; margin: 0 0 8px; }
.nbw-rev__rate { text-align: center; font-size: 15.5px; color: #1c2b44; margin: 0 0 22px; }
.nbw-rev__stars { color: #f5a623; letter-spacing: 2px; }
.nbw-rev__strip { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 20px; }
.nbw-rev__card { margin: 0; background: #fff; border-radius: 14px; overflow: hidden;
  box-shadow: 0 2px 4px rgba(20,25,40,.05), 0 12px 30px rgba(20,25,40,.10); }
.nbw-rev__card img { width: 100%; max-width: none; max-height: none; aspect-ratio: 3 / 4; object-fit: cover;
  border-radius: 0; box-shadow: none; display: block; }
.nbw-rev__card figcaption { padding: 14px 16px 18px; }
.nbw-rev__card figcaption strong { display: block; font-size: 15.5px; font-weight: 800; color: #1c2b44; margin: 6px 0 5px; }
.nbw-rev__card figcaption span:last-child { display: block; font-size: 14.5px; line-height: 1.6; color: #4c5a71; }

@media (max-width: 980px) {
  .nbw-rev__strip { grid-template-columns: 1fr 1fr; }
  .nbw-row2 { grid-template-columns: 1fr; gap: 28px; }
  .nbw-row2--rev .nbw-media { text-align: right; }
}
@media (max-width: 560px) {
  .nbw-rev__strip { grid-auto-flow: column; grid-template-columns: none; grid-auto-columns: 78%;
    overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 6px; }
  .nbw-rev__card { scroll-snap-align: center; }
  .nbw-sec { padding: 42px 0; }
  .nbw-wrap { padding: 0 16px; }
  .nbw-cta { width: 100%; text-align: center; }
  .nbw-num { font-size: 23px; }
}

/* ── kratek opis izdelka: kljukice namesto pik (REST pobrise inline slog) ── */
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
.woocommerce-product-details__short-description .nbw-tick {
  position: absolute !important; left: 0 !important; top: 1px !important;
  width: 21px; height: 21px; border-radius: 50%;
  background: #2f5b9a !important; color: #fff !important;
  font-size: 12px !important; font-weight: 800 !important; line-height: 21px !important;
  text-align: center !important; display: inline-block !important; }
.woocommerce-product-details__short-description p:first-of-type { font-size: 16px; line-height: 1.55; }
</style>
