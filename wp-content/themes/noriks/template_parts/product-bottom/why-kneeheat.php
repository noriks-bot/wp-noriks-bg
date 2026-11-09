<?php
/**
 * product-bottom: NORIKS KneeHeat — grijac, kompresija i masaza koljena (orto-kneeheat) — trg SK.
 *
 * Sve sekcije su LIJEVO/DESNO (slika + tekst), po referentnoj stranici
 * (getmendable.com / Knee Triple Therapy Recovery System). Nikad slika na sredini.
 * Recenzije i FAQ renderira zajednicki reviews.php.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$kh      = get_template_directory_uri() . '/img/kneeheat/';
$kh_path = get_template_directory() . '/img/kneeheat/';

$kh_vid = function( $file, $poster, $alt ) use ( $kh, $kh_path ) {
  if ( ! file_exists( $kh_path . $file ) ) { return ''; }
  return '<video class="nkh-video" autoplay muted loop playsinline preload="metadata" '
       . 'poster="' . esc_url( $kh . $poster ) . '" aria-label="' . esc_attr( $alt ) . '">'
       . '<source src="' . esc_url( $kh . $file ) . '" type="video/mp4"></video>';
};

$kh_img = function( $file, $alt ) use ( $kh, $kh_path ) {
  if ( file_exists( $kh_path . $file ) ) {
    return '<img src="' . esc_url( $kh . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
  }
  return '<div class="nkh-ph" role="img" aria-label="' . esc_attr( $alt ) . '"><span>' . esc_html( $alt ) . '</span></div>';
};
?>

<!-- 1) Tri koraka — videi -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap">
    <p class="nkh-eyebrow nkh-center">Ako to funguje</p>
    <h2 class="nkh-h2 nkh-center">Úľava v 3 jednoduchých krokoch</h2>
    <p class="nkh-lead nkh-center">Bez nastavovania, bez aplikácie, bez zložitej rutiny. Nasaďte, stlačte tlačidlo a pokračujte v dni.</p>
    <div class="nkh-steps3">
      <div class="nkh-step3">
        <?php echo $kh_vid( 'kh-step-1.mp4', 'kh-step-1.jpg', 'Nasadenie bandáže na koleno' ); ?>
        <div class="nkh-step3-txt">
          <p class="nkh-step3-h"><span>1</span> Nasaďte bandáž</p>
          <p>Obtočte ju okolo kolena a utiahnite pásy. Trvá to 20 sekúnd a funguje na oboch nohách.</p>
        </div>
      </div>
      <div class="nkh-step3">
        <?php echo $kh_vid( 'kh-step-2.mp4', 'kh-step-2.jpg', 'Spustenie sedenia jedným tlačidlom' ); ?>
        <div class="nkh-step3-txt">
          <p class="nkh-step3-h"><span>2</span> Stlačte tlačidlo</p>
          <p>Jedno tlačidlo spustí všetky tri terapie — teplo, kompresiu a vibrácie — presne na 12 minút.</p>
        </div>
      </div>
      <div class="nkh-step3">
        <?php echo $kh_vid( 'kh-step-3.mp4', 'kh-step-3.jpg', 'Prístroj pracuje sám, kým oddychujete' ); ?>
        <div class="nkh-step3-txt">
          <p class="nkh-step3-h"><span>3</span> Pokračujte v dni</p>
          <p>Pozrite si správy, vypite kávu. Prístroj pracuje sám a zastaví sa, keď sedenie skončí.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2) Zacaran krug — video -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media"><?php echo $kh_vid( 'kh-vid-bol.mp4', 'kh-vid-bol.jpg', 'Bolesť a stuhnutosť kolena' ); ?></div>
    <div class="nkh-copy">
      <h2 class="nkh-h2">Prerušte začarovaný kruh. Vaše koleno je pripravené na skutočnú úľavu.</h2>
      <p>Tupá bolesť, stuhnutosť pri vstávaní, opatrný krok pred schádzaním zo schodov — to sú signály tkaniva, ktoré roky potichu hladuje. Odpoveďou nie je ďalšia tabletka, ale obnovenie prietoku krvi v kĺbe.</p>
      <ul class="nkh-tri">
        <li><strong>12 minút denne:</strong> obnovenie prietoku a uvoľnenie napätia, bez tabliet.</li>
        <li><strong>Obnova a regenerácia:</strong> teplo rozširuje cievy, kompresia vyplavuje opuch, vibrácie uvoľňujú stuhnutosť — všetko v jednom sedení.</li>
        <li><strong>Pohyb bez počítania:</strong> schody bez plánovania, drep v záhrade, vnúča v náručí.</li>
      </ul>
    </div>
  </div>
</section>

<!-- Osjetite razliku — video desno -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-copy">
      <h2 class="nkh-h2">Pocíťte rozdiel: trvalá úľava sa začína dnes</h2>
      <p>Nie krátkodobý pokoj, ale zmena, ktorú spozorujete. <strong>Väčšina používateľov pocíti skutočný rozdiel v priebehu prvých 7 až 14 dní</strong> pravidelného používania. Ranná stuhnutosť povoľuje a schádzanie zo schodov prestáva byť počtami.</p>
      <ul class="nkh-tri">
        <li><strong>Menej stuhnutosti a tlaku:</strong> znižuje napätie a opuch, ktoré udržiavajú ťažkosti.</li>
        <li><strong>Lepší krvný obeh:</strong> obnovuje prietok v hlbšom tkanive kolena — tam, kde problém skutočne vzniká.</li>
        <li><strong>Všetko doma:</strong> bez chodenia na terapie a bez čakania na termín.</li>
      </ul>
    </div>
    <div class="nkh-media"><?php echo $kh_vid( 'kh-vid-zglob.mp4', 'kh-vid-zglob.jpg', 'Kolenný kĺb' ); ?></div>
  </div>
</section>

<!-- Pametna tehnologija — video lijevo -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media"><?php echo $kh_vid( 'kh-vid-led.mp4', 'kh-vid-led.jpg', 'Vyhrievacie prvky v bandáži' ); ?></div>
        <div class="nkh-copy">
      <h2 class="nkh-h2">Inteligentná technológia pre hlbšie tkanivo</h2>
      <p>Prispôsobte NORIKS KneeHeat svojmu kolenu: <strong>3 stupne tepla</strong>, <strong>3 režimy vibrácií</strong> a <strong>cyklická kompresia</strong>. Bez kábla, jedno tlačidlo, dvanásť minút.</p>
      <ul class="nkh-tri">
        <li><strong>Vždy pripravený:</strong> bezdrôtová prevádzka a nabíjanie cez USB-C kábel.</li>
        <li><strong>Prenosný:</strong> je ľahký a zmestí sa do tašky — používajte ho kdekoľvek ste.</li>
        <li><strong>Jednoduché ovládanie:</strong> jedno tlačidlo, bez aplikácie a bez nastavovania.</li>
      </ul>
    </div>
  </div>
</section>


<!-- 2) Trostruka metoda — slika desno -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-copy">
      <h2 class="nkh-h2">Tri terapie v jednom sedení</h2>
      <p>Ohrievanie, kompresia a vibrácie nefungujú jedno po druhom, ale súčasne — preto jedno sedenie trvá len 12 minút.</p>
      <ul class="nkh-tri">
        <li><strong>Teplo do 42 °C</strong> rozširuje cievy a zmäkčuje stuhnuté tkanivo okolo kĺbu.</li>
        <li><strong>Vzduchová kompresia</strong> rytmicky stláča a povoľuje, vytláča nahromadenú tekutinu a privádza čerstvú krv.</li>
        <li><strong>Vibračná masáž 60 Hz</strong> uvoľňuje napätie a stuhnutosť, ktorá drží koleno „zamknuté".</li>
      </ul>
      <p class="nkh-note">Na rozdiel od prístrojov TENS, ktoré len prekrývajú signál bolesti, KneeHeat pôsobí na hlbšie tkanivo.</p>
    </div>
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-04-metoda.jpg', 'Trojitá metóda: teplo, kompresia a vibrácie' ); ?></div>
  </div>
</section>


<!-- 4) Značajke uređaja — slika desno -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-11-znacajke.jpg', 'Vlastnosti prístroja NORIKS KneeHeat' ); ?></div>
    <div class="nkh-copy">
      <h2 class="nkh-h2">Vyrobený na nosenie, nie do šuplíka</h2>
      <p>Ovládací panel je na vonkajšej strane, na dosah ruky: <strong>jeden dotyk mení stupeň tepla</strong>, druhý režim vibrácií. Žiadne menu ani aplikácia, ktorú treba hľadať v tme.</p>
      <p>Bandáž sa zapína na dva pásy, takže pevnosť si volíte sami — voľnejšie, keď sedíte, pevnejšie, keď chodíte po dome. Prístroj potom zostáva na mieste a neotáča sa okolo nohy.</p>
      <p class="nkh-strong">Je bezdrôtový a nabíja sa USB-C káblom; jedno nabitie vydrží na viac sedení, takže ide s vami do práce aj na cesty.</p>
    </div>
  </div>
</section>

<!-- 5) Što je u paketu — slika lijevo -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-copy">
      <h2 class="nkh-h2">Čo dostanete v balení</h2>
      <ul class="nkh-pack">
        <li><strong>Prístroj NORIKS KneeHeat</strong> — bandáž s ohrievaním, kompresiou a vibráciami</li>
        <li><strong>Opletený USB-C kábel</strong> na nabíjanie</li>
        <li><strong>Predlžovací pás</strong> pre väčšie obvody nohy</li>
        <li><strong>2 roky záruka na výmenu</strong></li>
      </ul>
    </div>
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-07-unboxing-h.jpg', 'Obsah balenia NORIKS KneeHeat' ); ?></div>
  </div>
</section>


<!-- 7) Liječnik — slika desno -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-02-lijecnik.jpg', 'Odporúčanie ortopéda' ); ?></div>
    <div class="nkh-copy">
      <h2 class="nkh-h2">Vytvorené pre každodenné pohodlie a pohyb</h2>
      <p class="nkh-quote">„Pri chronických ťažkostiach s kolenom po 45. roku sa najviac oplatí to, čo ľudia môžu robiť každý deň doma. Teplo, kompresia a vibrácie spolu obnovujú prietok v tkanive — a to je základ, na ktorom funguje všetko ostatné.”</p>
      <p class="nkh-sign">MUDr. Marek Kováč, ortopéd</p>
    </div>
  </div>
</section>

<!-- 8) Dodaci i jamstvo — slika lijevo -->
<!-- 9) Jamstvo — slika desno -->
<style>
.nkh-sec { padding: 46px 0; }
.nkh-light { background: #f3f0ea; color: #1f2a37; }
.nkh-white { background: #fff;    color: #1f2a37; }
.nkh-dark  { background: #12233b; color: #eef3f9; }
.nkh-dark h2, .nkh-dark h3, .nkh-dark p, .nkh-dark li, .nkh-dark strong { color: #eef3f9; }
.nkh-wrap { max-width: 1440px; margin: 0 auto; padding: 0 22px; }
.nkh-row { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
.nkh-media img { width: 100%; height: auto; display: block; border-radius: 14px; }
.nkh-eyebrow { text-transform: uppercase; letter-spacing: .14em; font-size: 12px; font-weight: 700; color: #c1601f; margin: 0 0 8px; }
.nkh-h2 { font-size: 27px; line-height: 1.22; margin: 0 0 12px; font-weight: 700; }
.nkh-sec p { font-size: 15.5px; line-height: 1.62; margin: 0 0 12px; }
.nkh-strong { font-weight: 600; }
.nkh-note { font-size: 14.5px; opacity: .85; margin: 4px 0 0; }
.nkh-quote { font-style: italic; font-size: 16.5px; }
.nkh-sign { font-size: 14px; opacity: .75; margin: 0; }
.nkh-ticks, .nkh-tri, .nkh-pack { list-style: none; padding: 0; margin: 14px 0 0; }
.nkh-ticks li { position: relative; padding-left: 24px; margin-bottom: 7px; font-size: 15px; }
.nkh-ticks li:before { content: ""; position: absolute; left: 0; top: 6px; width: 12px; height: 12px; border-radius: 50%; background: #c1601f; }
.nkh-tri li { border-left: 3px solid #c1601f; padding: 2px 0 2px 14px; margin-bottom: 12px; font-size: 15px; line-height: 1.55; }
.nkh-pack li { position: relative; padding-left: 22px; margin-bottom: 8px; font-size: 15px; line-height: 1.5; }
.nkh-pack li:before { content: "✓"; position: absolute; left: 0; top: 0; color: #1e8f4e; font-weight: 800; }
.nkh-steps { list-style: none; padding: 0; margin: 14px 0 0; }
.nkh-steps li { display: flex; gap: 12px; margin-bottom: 12px; font-size: 15px; line-height: 1.55; }
.nkh-steps span { flex: 0 0 auto; width: 28px; height: 28px; border-radius: 50%; background: #c1601f; color: #fff;
                  font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 14px; }

.nkh-three { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; align-items: start; }
.nkh-three figure { margin: 0; }
.nkh-three img { width: 100%; height: auto; display: block; border-radius: 10px; }
.nkh-three figcaption { text-align: center; font-size: 13px; margin-top: 7px; opacity: .72; }
.nkh-mini { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 14px; }
.nkh-mini figure { margin: 0; }
.nkh-mini img { width: 100%; height: auto; display: block; border-radius: 10px; }
.nkh-ph { display: flex; align-items: center; justify-content: center; min-height: 200px; background: #e3ded4; border-radius: 12px; color: #7a6a55; font-size: 14px; text-align: center; padding: 12px; }
@media (max-width: 820px) {
  .nkh-sec { padding: 22px 0; }
  .nkh-wrap { padding-left: 0; padding-right: 0; }
  .nkh-h2 { font-size: 22px; }
  .nkh-row { grid-template-columns: 1fr; gap: 18px; }
  .nkh-steps3 { grid-template-columns: 1fr; gap: 18px; }
  .nkh-three { grid-template-columns: 1fr; gap: 14px; }
  .nkh-row .nkh-media { order: -1; }
}

/* kratek opis izdelka: kljukice namesto pikic (kot pri udlagi proti hrkanju) */
.woocommerce-product-details__short-description ul,
.woocommerce div.product .woocommerce-product-details__short-description ul {
  list-style: none !important; margin: 8px 0 14px !important; padding-left: 0 !important; }
.woocommerce-product-details__short-description ul li,
.woocommerce div.product .woocommerce-product-details__short-description ul li {
  list-style: none !important; list-style-type: none !important; padding-left: 24px !important;
  text-indent: -24px !important; margin-left: 0 !important; line-height: 1.55 !important; margin-bottom: 8px !important; }
.woocommerce-product-details__short-description ul li::marker { content: "" !important; }
.woocommerce-product-details__short-description ul li::before { content: none !important; }
.woocommerce-product-details__short-description .nkh-tick {
  display: inline-block !important; width: 24px !important; text-indent: 0 !important;
  color: #c1601f !important; font-weight: 800 !important; }
/* slika naj bo poravnana na rob kontejnerja, ne na sredino stolpca */
.nkh-center { text-align: center; }

.nkh-steps3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.nkh-step3 { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.07); }
.nkh-step3 .nkh-video { width: 100%; height: auto; display: block; }
.nkh-step3-txt { padding: 16px 18px 20px; }
.nkh-step3-h { display: flex; align-items: center; gap: 10px; font-size: 17px; font-weight: 700; margin: 0 0 6px !important; }
.nkh-step3-h span { flex: 0 0 auto; width: 27px; height: 27px; border-radius: 50%; background: #c1601f; color: #fff;
                    font-size: 13px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nkh-step3-txt p:last-child { font-size: 14.5px; margin: 0 !important; }
.nkh-media .nkh-video { width: 100%; height: auto; display: block; border-radius: 14px; }
.nkh-sec p.nkh-lead { max-width: 720px; margin: 0 auto 22px !important; opacity: .85; text-align: center; }
.nkh-sec .nkh-center { text-align: center; }
.nkh-sec .nkh-lead-copy { max-width: 820px; margin: 0 auto 22px !important; text-align: center; }
.nkh-sec .nkh-lead-copy p { margin-left: auto !important; margin-right: auto !important; }
.nkh-sec .nkh-lead-copy h2 { text-align: center; }
</style>
