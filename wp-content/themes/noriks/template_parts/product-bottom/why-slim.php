<?php
/**
 * product-bottom: NORIKS Slim — oblikujuce gacice visokog struka (orto-slim).
 * Original: saybeam.com/products/saybeam-sculpt-brief. Slike: img/slim/ (s namizja NORIKS-SLIMY/SPLETNA STRAN).
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno, nikoli na sredini;
 * slike su omejene na max-height 430px.
 *   1) BEZ / S NORIKS SLIM — slika lijevo
 *   2) ONE GOVORE SAME — videi
 *   3) LIJEPO I SAMOUVJERENO — slika desno
 *   4) TEHNOLOGIJA PLETIVA — slika lijevo
 *   5) VISOKOELASTIČNO OBLIKOVANJE — slika desno
 *   6) NAKON PORODA — slika lijevo
 *   7) ŠEST BOJA — slika desno
 *   8) TABLICA VELIČINA — slika lijevo
 *   9) USPOREDBA — tablica
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$sl      = get_template_directory_uri() . '/img/slim/';
$sl_path = get_template_directory() . '/img/slim/';
$sl_img  = function( $file, $alt ) use ( $sl, $sl_path ) {
  if ( ! file_exists( $sl_path . $file ) ) { return ''; }
  return '<img src="' . esc_url( $sl . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="eager">';
};
?>

<!-- 1) BEZ / S NORIKS SLIM — slika lijevo -->
<section class="nsl-sec nsl-tint">
  <div class="nsl-wrap nsl-row2">
    <div class="nsl-media"><?php echo $sl_img( 'slm-05-usporedba.jpg', 'Bez a s tvarujúcimi nohavičkami NORIKS Slim' ); ?></div>
    <div class="nsl-copy">
      <p class="nsl-kicker">Rozdiel vidieť hneď</p>
      <h2 class="nsl-h2">Tvarujúca bielizeň, v ktorej <em>oblečenie padne oveľa lepšie</em></h2>
      <p>Bežné nohavičky nedržia nič a klasické sťahovacie prádlo stlačí v jednej línii — nad okrajom sa tak urobí vydutina a samotný okraj vidno pod oblečením.</p>
      <ul class="nsl-vs">
        <li class="is-yes">Viditeľne hladšia silueta</li>
        <li class="is-yes">Brucho dobre podopreté celý deň</li>
        <li class="is-yes">Oblečenie padne rovnejšie</li>
        <li class="is-no">Záhyby pod úzkym tričkom</li>
        <li class="is-no">Okraj, ktorý sa roluje a zarezáva pri sedení</li>
        <li class="is-no">Skrývanie pod širokými tričkami</li>
      </ul>
      <a class="nsl-cta" href="#bundle-selector">Vybrať farbu a veľkosť</a>
    </div>
  </div>
</section>

<!-- 2) ONE GOVORE SAME — videi -->
<section class="nsl-sec nsl-vids">
  <div class="nsl-wrap">
    <h2 class="nsl-h2" style="text-align:center">Hovoria <em>samy za seba</em></h2>
    <div class="nsl-vids__strip">
      <figure class="nsl-vids__card">
        <video src="<?php echo esc_url( $sl . 'slm-vid-1.mp4' ); ?>" poster="<?php echo esc_url( $sl . 'slm-vid-1.jpg' ); ?>"
               muted autoplay loop playsinline preload="none" aria-label="Zákazníčka ukazuje nohavičky NORIKS Slim"></video>
      </figure>
      <figure class="nsl-vids__card">
        <video src="<?php echo esc_url( $sl . 'slm-vid-2.mp4' ); ?>" poster="<?php echo esc_url( $sl . 'slm-vid-2.jpg' ); ?>"
               muted autoplay loop playsinline preload="none" aria-label="Zákazníčka ukazuje, ako NORIKS Slim tvaruje pás"></video>
      </figure>
    </div>
  </div>
</section>

<!-- 3) LIJEPO I SAMOUVJERENO — slika desno -->
<section class="nsl-sec nsl-tint">
  <div class="nsl-wrap nsl-row2 nsl-row2--rev">
    <div class="nsl-copy">
      <p class="nsl-kicker">Od rána do večera</p>
      <h2 class="nsl-h2">Cíťte sa krásne <em>a sebavedomo</em></h2>
      <div class="nsl-points">
        <div class="nsl-point"><h3>Bez záhybov</h3><p>Prekrížený pás vyhladí brucho a neposúva sa, keď si sadnete, vstanete alebo sa zohnete.</p></div>
        <div class="nsl-point"><h3>Tvarovaný pás a zadok</h3><p>Anatomický strih kopíruje líniu tela — pás vyzerá užší a zadok zdvihnutejší.</p></div>
        <div class="nsl-point"><h3>Pohodlie celý deň</h3><p>Bezšvová, mäkká látka, na ktorú zabudnete hneď, ako si ju oblečiete.</p></div>
      </div>
    </div>
    <div class="nsl-media"><?php echo $sl_img( 'slm-06-samouvjereno.jpg', 'Žena v nohavičkách NORIKS Slim' ); ?></div>
  </div>
</section>

<!-- 4) TEHNOLOGIJA PLETIVA — slika lijevo -->
<section class="nsl-sec">
  <div class="nsl-wrap nsl-row2">
    <div class="nsl-media"><?php echo $sl_img( 'slm-07-pletivo.jpg', 'Prekrížený pás a úplet nohavičiek NORIKS Slim' ); ?></div>
    <div class="nsl-copy">
      <p class="nsl-kicker">Inteligentný úplet</p>
      <h2 class="nsl-h2">Vyhladí a podoprie, <em>bez pocitu sťahovania</em></h2>
      <p>Pás prechádza krížom cez brucho a pokračuje na boky a chrbát. Tlak sa tak rozloží okolo celého pása — 360° — namiesto toho, aby stláčal v jednom bode.</p>
      <div class="nsl-facts">
        <div><h3>Prekrížený pás 360°</h3><p>Spredu, zboku aj zozadu — drží brucho rovnomerne.</p></div>
        <div><h3>Vysoký pás</h3><p>Horný okraj siaha nad pupok a neroluje sa nadol.</p></div>
        <div><h3>Sieťované vsadky</h3><p>Prepúšťajú vzduch, takže nie je teplo ani v lete.</p></div>
        <div><h3>Bavlnená vložka</h3><p>Mäkká a hygienická — nosia sa aj namiesto bežných nohavičiek.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 5) VISOKOELASTIČNO OBLIKOVANJE — slika desno -->
<section class="nsl-sec nsl-tint">
  <div class="nsl-wrap nsl-row2 nsl-row2--rev">
    <div class="nsl-copy">
      <p class="nsl-kicker">Elastická kompresia</p>
      <h2 class="nsl-h2">Vysokoelastické <em>tvarovanie</em></h2>
      <p>Látka sa naťahuje vo všetkých smeroch a vracia sa do tvaru — drží pevne, a pritom sa hýbe s vami, keď sedíte, chodíte alebo dvíhate dieťa.</p>
      <ul class="nsl-check">
        <li><strong>Kontrola brucha</strong> — brucho je podopreté celý deň</li>
        <li><strong>Hladký pás</strong> — bez vydutiny nad nohavicami alebo sukňou</li>
        <li><strong>Nešmýka sa</strong> — zostáva na mieste, aj keď si sadnete</li>
        <li><strong>Neviditeľné</strong> — pod priliehavými šatami, džínsami aj legínami</li>
      </ul>
    </div>
    <div class="nsl-media"><?php echo $sl_img( 'slm-09-oblikovanje.jpg', 'Vysokoelastické tvarovanie pása' ); ?></div>
  </div>
</section>

<!-- 6) NAKON PORODA — slika lijevo -->
<section class="nsl-sec">
  <div class="nsl-wrap nsl-row2">
    <div class="nsl-media"><?php echo $sl_img( 'slm-11-oblikovanje-nakon-poroda.jpg', 'Mamičky v nohavičkách NORIKS Slim' ); ?></div>
    <div class="nsl-copy">
      <p class="nsl-kicker">Aj po tehotenstve</p>
      <h2 class="nsl-h2">Tvarovanie, ktoré pracuje <em>s vaším telom</em>, nie proti nemu</h2>
      <p>Po tehotenstve sa brucho a pás často hneď nevrátia do pôvodnej línie. NORIKS Slim ich jemne podoprie, takže oblečenie opäť lepšie padne — bez sťahovania a bez rolovania.</p>
      <ul class="nsl-check">
        <li><strong>Mäkká a priedušná</strong> látka na citlivej pokožke</li>
        <li><strong>Horný okraj nad pupkom</strong> — nezarezáva sa do spodnej časti brucha</li>
        <li><strong>Veľkosti do 5XL</strong> — vyberáte podľa obvodu pása</li>
      </ul>
      <p class="nsl-note">Po cisárskom reze alebo ak si nie ste istá, poraďte sa pred nosením so svojím lekárom.</p>
    </div>
  </div>
</section>

<!-- 7) ŠEST BOJA — slika desno -->
<section class="nsl-sec nsl-tint">
  <div class="nsl-wrap nsl-row2 nsl-row2--rev">
    <div class="nsl-copy">
      <p class="nsl-kicker">Šesť farieb</p>
      <h2 class="nsl-h2">Na každý deň <em>a ku každému oblečeniu</em></h2>
      <p>Telová a čierna pod všetko, tmavomodrá na každý deň a fialová, fuchsiová a slivková, keď chcete niečo svoje. Všetky farby majú rovnaký úplet aj rovnaký strih.</p>
      <ul class="nsl-colors">
        <li><span style="background:#17161a"></span>Čierna</li>
        <li><span style="background:#ecd9bd"></span>Telová</li>
        <li><span style="background:#232b52"></span>Tmavomodrá</li>
        <li><span style="background:#d8c1ee"></span>Fialová</li>
        <li><span style="background:#d81b72"></span>Fuchsiová</li>
        <li><span style="background:#5b2147"></span>Slivková</li>
      </ul>
      <a class="nsl-cta" href="#bundle-selector">Vybrať farbu a veľkosť</a>
    </div>
    <div class="nsl-media"><?php echo $sl_img( 'slm-12-boje-v2.jpg', 'NORIKS Slim v šiestich farbách' ); ?></div>
  </div>
</section>

<!-- 8) TABLICA VELIČINA — slika lijevo -->
<section class="nsl-sec">
  <div class="nsl-wrap nsl-row2">
    <div class="nsl-media"><?php echo $sl_img( 'slm-15-tablica-velicina.jpg', 'Tabuľka veľkostí NORIKS Slim' ); ?></div>
    <div class="nsl-copy">
      <p class="nsl-kicker">Správna veľkosť na prvýkrát</p>
      <h2 class="nsl-h2">Veľkosť vyberajte <em>podľa obvodu pása</em></h2>
      <p>Nie podľa bežnej veľkosti oblečenia — po tehotenstve alebo zmene hmotnosti sa tieto dve veľkosti často nezhodujú.</p>
      <ol class="nsl-steps">
        <li>Nájdite najužšie miesto trupu, kúsok nad pupkom.</li>
        <li>Oviňte krajčírsky meter vodorovne, priliehavo, ale nie natesno.</li>
        <li>Nájdite svoj obvod v tabuľke. Ste medzi dvoma veľkosťami? Vezmite si <strong>väčšiu</strong>.</li>
      </ol>
      <a class="nsl-cta nsl-cta--line js-open-size-chart" href="#">Otvoriť tabuľku veľkostí</a>
    </div>
  </div>
</section>

<!-- 9) USPOREDBA — tablica -->
<section class="nsl-sec nsl-tint nsl-cmp">
  <div class="nsl-wrap">
    <h2 class="nsl-h2" style="text-align:center">Prečo sú nohavičky NORIKS Slim <em>iné</em></h2>
    <div class="nsl-cmp__box">
      <table class="nsl-cmp__table">
        <thead><tr><td>&nbsp;</td><th scope="col">Cvičenie</th><th scope="col">Diéta</th><th scope="col">Klasické sťahovanie</th><th scope="col">Operácia</th><th scope="col" class="is-us">NORIKS Slim</th></tr></thead>
        <tbody>
          <tr><th scope="row">Pôsobí na skutočnú príčinu</th><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__pol">–</td><td class="nsl-cmp__da is-us">✓</td></tr>
          <tr><th scope="row">Oblečiete ich za pár sekúnd</th><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__pol">–</td><td class="nsl-cmp__da">✓</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__da is-us">✓</td></tr>
          <tr><th scope="row">Lacnejšie ako operácia</th><td class="nsl-cmp__da">✓</td><td class="nsl-cmp__da">✓</td><td class="nsl-cmp__da">✓</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__da is-us">✓</td></tr>
          <tr><th scope="row">Pohodlné celý deň</th><td class="nsl-cmp__pol">–</td><td class="nsl-cmp__da">✓</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__da is-us">✓</td></tr>
          <tr><th scope="row">Účinok už prvý deň</th><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__pol">–</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__da is-us">✓</td></tr>
          <tr><th scope="row">Podopiera brucho v 360°</th><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__ne">✕</td><td class="nsl-cmp__pol">–</td><td class="nsl-cmp__da is-us">✓</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<style>
.nsl-sec { padding: 60px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #2b1622; }
.nsl-sec * { box-sizing: border-box; }
.nsl-tint { background: #fbf1f6; }
.nsl-wrap { width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 24px; }
.nsl-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #a3336b; margin: 0 0 10px; }
.nsl-h2 { font-size: clamp(25px, 3.1vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; color: #2b1622; }
.nsl-h2 em { font-style: italic; font-weight: 800; color: #a3336b; }
.nsl-copy p { font-size: 16px; line-height: 1.7; color: #5a4550; margin: 0 0 14px; }
.nsl-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
.nsl-media { text-align: left; }
.nsl-media img { display: block; width: 100%; max-width: 100%; max-height: none; height: auto; object-fit: cover;
  border-radius: 14px; box-shadow: 0 2px 4px rgba(40,20,35,.05), 0 14px 40px rgba(40,20,35,.10); }
.nsl-check { list-style: none; padding: 0; margin: 4px 0 22px; display: flex; flex-direction: column; gap: 11px; }
.nsl-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; color: #3f2a35; }
.nsl-check li::before { content: "\2713"; position: absolute; left: 0; top: 0; width: 20px; height: 20px; border-radius: 50%; background: #2f9e5f; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nsl-vs { list-style: none; padding: 0; margin: 4px 0 22px; display: flex; flex-direction: column; gap: 10px; }
.nsl-vs li { position: relative; padding-left: 28px; font-size: 15px; line-height: 1.5; color: #3f2a35; }
.nsl-vs li::before { position: absolute; left: 0; top: 0; width: 20px; height: 20px; border-radius: 50%; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nsl-vs .is-yes::before { content: "\2713"; background: #2f9e5f; color: #fff; }
.nsl-vs .is-no { color: #8e7883; }
.nsl-vs .is-no::before { content: "\2715"; background: #f0dfe7; color: #b0909f; }
.nsl-points { display: flex; flex-direction: column; gap: 20px; }
.nsl-point h3 { font-size: 17.5px; font-weight: 800; margin: 0 0 6px; color: #a3336b; }
.nsl-point p { font-size: 15.5px; color: #5a4550; line-height: 1.6; margin: 0; }
.nsl-facts { display: grid; grid-template-columns: 1fr 1fr; gap: 22px 26px; margin-top: 6px; }
.nsl-facts h3 { font-size: 16px; font-weight: 800; margin: 0 0 6px; color: #2b1622; }
.nsl-facts p { font-size: 14.5px; color: #6d5863; line-height: 1.6; margin: 0; }
.nsl-colors { list-style: none; padding: 0; margin: 14px 0 26px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 10px; }
.nsl-colors li { display: flex; align-items: center; gap: 11px; font-size: 14.5px; font-weight: 700; color: #3f2a35;
  background: #fff; border: 1px solid #f1dfe9; border-radius: 12px; padding: 10px 14px;
  box-shadow: 0 1px 2px rgba(40,20,35,.04), 0 6px 16px rgba(40,20,35,.05); }
.nsl-colors span { flex: 0 0 24px; width: 24px; height: 24px; border-radius: 50%;
  box-shadow: inset 0 0 0 1px rgba(0,0,0,.14), 0 0 0 3px #fff, 0 0 0 4px rgba(164,85,127,.22); }
.nsl-steps { margin: 4px 0 22px; padding-left: 22px; }
.nsl-steps li { font-size: 15.5px; line-height: 1.6; color: #3f2a35; margin-bottom: 8px; }
.nsl-note { font-size: 13.5px !important; color: #8e7883 !important; font-style: italic; margin: 6px 0 0 !important; }
.nsl-guarantee { font-size: 14.5px !important; background: #fff; border: 1px solid #f0dfe7; border-radius: 10px; padding: 12px 16px; }
.nsl-cta { display: inline-block; background: #a3336b; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.nsl-cta:hover { background: #82254f; color: #fff !important; }
.nsl-cta--line { background: #fff; color: #a3336b !important; border: 2px solid #a3336b; padding: 13px 28px; }
.nsl-cta--line:hover { background: #a3336b; color: #fff !important; }

.nsl-vids__strip { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 20px; max-width: 760px; margin: 22px auto 0; }
.nsl-vids__card { margin: 0; border-radius: 14px; overflow: hidden; background: #000;
  box-shadow: 0 2px 4px rgba(40,20,35,.06), 0 14px 34px rgba(40,20,35,.12); }
.nsl-vids__card video { display: block; width: 100%; height: 100%; aspect-ratio: 9 / 16; object-fit: cover; }
.nsl-cmp__box { background: #fff; border-radius: 16px; overflow-x: auto; margin-top: 22px;
  box-shadow: 0 2px 4px rgba(40,20,35,.05), 0 16px 40px rgba(40,20,35,.10); }
.nsl-cmp__table { width: 100%; min-width: 620px; border-collapse: collapse; border-spacing: 0; margin: 0 !important; border: 0 !important; }
.nsl-cmp__table tr, .nsl-cmp__table thead, .nsl-cmp__table tbody { background: transparent !important; border: 0 !important; }
.nsl-cmp__table thead th { font-size: 12.5px; font-weight: 800; letter-spacing: .06em; text-transform: uppercase;
  color: #6b5566; text-align: center; padding: 16px 10px; border-bottom: 1px solid #f0e2ea; }
.nsl-cmp__table thead th.is-us { color: #a4557f; background: #fdf4f8; }
.nsl-cmp__table th[scope="row"] { background: #fbf1f6; color: #3a2030; font-size: 14.5px; font-weight: 800;
  text-align: left; padding: 14px 16px; border-bottom: 1px solid #fff; width: 27%; }
.nsl-cmp__table td { text-align: center; font-size: 19px; font-weight: 800; padding: 14px 10px; border-bottom: 1px solid #f6ecf1; }
.nsl-cmp__table tbody tr:last-child td, .nsl-cmp__table tbody tr:last-child th[scope="row"] { border-bottom: 0; }
.nsl-cmp__table td.is-us { background: #fdf4f8; }
.nsl-cmp__table td.nsl-cmp__da { color: #2f9e5f; }
.nsl-cmp__table td.nsl-cmp__ne { color: #d05353; }
.nsl-cmp__table td.nsl-cmp__pol { color: #b3a3ad; }

@media (max-width: 980px) {
  .nsl-row2 { grid-template-columns: 1fr; gap: 28px; }
  .nsl-row2--rev .nsl-media { order: -1; }
}
@media (max-width: 560px) {
  .nsl-vids__strip { gap: 12px; }
  .nsl-cmp__table th[scope="row"] { font-size: 13.5px; padding: 12px 12px; }
  .nsl-sec { padding: 42px 0; }
  .nsl-wrap { padding: 0 16px; }
  .nsl-facts { grid-template-columns: 1fr; gap: 16px; }
  .nsl-colors { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .nsl-cta { width: 100%; text-align: center; }
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
.woocommerce-product-details__short-description .nsl-tick {
  position: absolute !important; left: 0 !important; top: 1px !important;
  width: 21px; height: 21px; border-radius: 50%;
  background: #a3336b !important; color: #fff !important;
  font-size: 12px !important; font-weight: 800 !important; line-height: 21px !important;
  text-align: center !important; display: inline-block !important; }
.woocommerce-product-details__short-description p:first-of-type { font-size: 16px; line-height: 1.55; }
</style>
