<?php
/**
 * product-bottom: FISIOREST (orto-fisiorest) — SK
 * Shown via single-product-bottom-nicer.php when noriks_is_type('fisiorest').
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1) "Vedecky podložené" — 4 karty.
$fis_science = array(
    array( 'title' => 'Hrb na krku',       'text' => 'Trakcia <strong>uvoľní tlak a obnoví správne držanie tela</strong>, aby zmiernila hrb spôsobený technologickým krkom.' ),
    array( 'title' => 'Bolesti krku',      'text' => '<strong>Zmierňuje svalové uzly a stuhnutosť</strong> a <strong>opäť zarovnáva krivku krku</strong> pre rýchlu úľavu od bolesti.' ),
    array( 'title' => 'Kvalitný spánok',   'text' => 'Upokojujúca terapia <strong>uvoľní krk a chrbticu</strong> pre hlboký a osviežujúci spánok.' ),
    array( 'title' => 'Uvoľnenie stresu',  'text' => 'Teplá masáž a naťahovanie <strong>uvoľnia nahromadené napätie</strong> pre väčšie pohodlie.' ),
);
$fis_v = get_template_directory_uri() . '/img/fisiorest-videos/';
$fis_i = get_template_directory_uri() . '/img/fisiorest/';
$fis_ver = '?v=20261027c';
$fis_hero_video = $fis_v . 'hero-v2.mp4' . $fis_ver;

// 3) Odporúčajú odborníci
$fis_experts = array(
    array( 'img' => $fis_i.'fis-strucnjak-1.jpg', 'name' => 'Martina Nováková', 'role' => 'Certifikovaná masážna terapeutka', 'org' => '' ),
    array( 'img' => $fis_i.'fis-strucnjak-2.jpg', 'name' => 'Anna Kováčová', 'role' => 'Fyzioterapeutka', 'org' => '' ),
    array( 'img' => $fis_i.'fis-strucnjak-3.jpg', 'name' => 'Jana Horváthová', 'role' => 'Chiropraktička', 'org' => '' ),
);
// 4) Skúsenosti používateľov
$fis_ugc = array(
    array( 'img' => $fis_i.'fis-uporaba-1.jpg', 'cap' => '„Prvýkrát po dlhom čase som konečne bez bolesti…"' ),
    array( 'img' => $fis_i.'fis-uporaba-2.jpg', 'cap' => '„Vankúš NORIKS je moja nová každodenná nevyhnutnosť…"' ),
    array( 'img' => $fis_i.'fis-uporaba-3.jpg', 'cap' => '„Ak ste sa práve stali mamou, toto by mohlo byť presne to, čo potrebujete…"' ),
    array( 'img' => $fis_i.'fis-uporaba-4.jpg', 'cap' => '„Veľmi mi pomáha zmierniť napätie v krku a ramenách."' ),
);
// 5) ThermoTrac 3-v-1
$fis_thermo = array(
    array( 'vid' => $fis_v.'v10.mp4' . $fis_ver, 'title' => 'Terapia trakciou' ),
    array( 'vid' => $fis_v.'v07.mp4' . $fis_ver, 'title' => 'Terapia vibráciou' ),
    array( 'vid' => $fis_v.'v05.mp4' . $fis_ver, 'title' => 'Terapia teplom' ),
);
// 6) Štyri vylepšenia
$fis_upgrades = array(
    array( 't' => 'Nabíjateľná batéria',    'd' => 'Vezmite ho kamkoľvek — batéria 2500 mAh vydrží až 2 hodiny.' , 'ico' => 'battery-v2.png?v=20261027' ),
    array( 't' => 'Poťah z morušového hodvábu', 'd' => 'Zabalený do chladivého hodvábu pre mäkký, luxusný pocit.' , 'ico' => 'silk-v2.png?v=20261027' ),
    array( 't' => 'Vypnutie po 30 min',     'd' => 'Štyri sedenia po 30 minútach na jedno nabitie, bez starostí.' , 'ico' => 'timer-v2.png?v=20261027' ),
    array( 't' => 'Regulované teplo',        'd' => 'Ohrev na 50 °C s pokročilou technológiou ThermoTrac.' , 'ico' => 'heat-v2.png?v=20261027' ),
);
?>

<!-- ============ 1) Vedecky podložené ============ -->
<section class="fis-science">
  <div class="fis-wrap">
    <div class="fis-box">
      <h2 class="fis-title">Vedecky podložené: preukázaná úľava pri starostlivosti o krk</h2>
      <div class="fis-grid">
        <?php foreach ( $fis_science as $fis_c ) : ?>
          <div class="fis-card">
            <h3 class="fis-card-title"><?php echo esc_html( $fis_c['title'] ); ?></h3>
            <p class="fis-card-text"><?php echo wp_kses_post( $fis_c['text'] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ 2) Video hero + nadpis ============ -->
<section class="fis-hero">
  <video class="fis-hero-vid" src="<?php echo esc_url( $fis_hero_video ); ?>" muted autoplay loop playsinline preload="metadata"></video>
  <div class="fis-hero-overlay"></div>
  <div class="fis-hero-inner">
    <h2 class="fis-hero-title">Odomknite hlboký reset spojenou silou zarovnania a uvoľnenia</h2>
  </div>
</section>

<!-- ============ 3) Odporúčajú odborníci ============ -->
<section class="fis-experts">
  <div class="fis-wrap fis-exp-grid">
    <div class="fis-exp-quote">
      <h2 class="fis-h2">Odporúčajú odborníci</h2>
      <p>„NORIKS je jeden z najlepších vankúšov na krk, aké sú momentálne na trhu. Keďže som vo wellness komunite už viac ako 25 rokov, vyskúšala som rôzne vankúše na krk a to, čím NORIKS vyniká, je funkcia trakcie…</p>
      <p>Ak máte predsunutú hlavu alebo „zhrbené držanie tela", trakcia môže pomôcť opäť zarovnať stavce a plne podoprieť telo. Sama ho používam a odporúčam svojim klientom!"</p>
      <p class="fis-exp-author"><strong>Martina Nováková</strong><br>Certifikovaná masážna terapeutka</p>
    </div>
    <div class="fis-exp-cards">
      <?php foreach ( $fis_experts as $e ) : ?>
        <div class="fis-exp-card">
          <img src="<?php echo esc_url( $e['img'] ); ?>" alt="<?php echo esc_attr( $e['name'] . ' — ' . $e['role'] ); ?>" loading="lazy">
          <div class="fis-exp-cap">
            <div class="fis-exp-name"><?php echo esc_html( $e['name'] ); ?></div>
            <div class="fis-exp-role"><?php echo esc_html( $e['role'] ); ?></div>
            <?php if ( $e['org'] ) : ?><div class="fis-exp-org"><?php echo esc_html( $e['org'] ); ?></div><?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 4) Skúsenosti používateľov ============ -->
<section class="fis-ugc">
  <div class="fis-wrap">
    <div class="fis-ugc-grid">
      <?php foreach ( $fis_ugc as $u ) : ?>
        <div class="fis-ugc-card">
          <div class="fis-ugc-media"><img src="<?php echo esc_url( $u['img'] ); ?>" alt="<?php echo esc_attr( $u['cap'] ); ?>" loading="lazy"></div>
          <p class="fis-ugc-cap"><?php echo esc_html( $u['cap'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 5) ThermoTrac 3-v-1 ============ -->
<section class="fis-thermo">
  <div class="fis-wrap">
    <p class="fis-eyebrow"><strong>ThermoTrac™</strong> technológia</p>
    <h2 class="fis-h2 fis-center">Zažite 3-v-1 terapiu pre krk</h2>
    <div class="fis-thermo-grid">
      <?php foreach ( $fis_thermo as $t ) : ?>
        <div class="fis-thermo-card">
          <video src="<?php echo esc_url( $t['vid'] ); ?>" muted autoplay loop playsinline preload="metadata"></video>
          <div class="fis-thermo-label"><?php echo esc_html( $t['title'] ); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 6) Štyri vylepšenia ============ -->
<section class="fis-upg">
  <div class="fis-wrap">
    <h2 class="fis-h2 fis-center">Štyri veľké vylepšenia</h2>
    <div class="fis-upg-grid">
      <?php foreach ( $fis_upgrades as $g ) : ?>
        <div class="fis-upg-card">
          <img class="fis-upg-ico" src="<?php echo esc_url( get_template_directory_uri() . '/img/fisiorest-icons/' . $g['ico'] ); ?>" alt="" loading="lazy" width="120" height="120">
          <div class="fis-upg-title"><?php echo esc_html( $g['t'] ); ?></div>
          <p class="fis-upg-text"><?php echo esc_html( $g['d'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 7) Navrhnuté inžiniermi ============ -->
<section class="fis-eng">
  <div class="fis-wrap fis-row2">
    <div class="fis-row2-copy">
      <h2 class="fis-h2">Navrhnuté inžiniermi. Vyrobené podľa štandardov fyzioterapie</h2>
      <p>Investovali sme viac ako 50 000 € a 2 roky vývoja, aby NORIKS nebol len masážny prístroj na krk. Je to komplexné zariadenie na terapiu krku, ktoré skutočne lieči príčinu. Každá objednávka prechádza dôkladnou kontrolou kvality, aby dorazila v perfektnom stave.</p>
    </div>
    <div class="fis-row2-media"><video src="<?php echo esc_url( $fis_v.'hero-v2.mp4' . $fis_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video></div>
  </div>
</section>

<!-- ============ 8) 14x lacnejšie ============ -->
<section class="fis-cheaper">
  <div class="fis-wrap fis-row2">
    <div class="fis-row2-media"><img src="<?php echo esc_url( $fis_i.'fis-produkt-kvadrat.jpg' . $fis_ver ); ?>" alt="NORIKS NeckRelax" loading="lazy"></div>
    <div class="fis-row2-copy">
      <p class="fis-eyebrow">BEZPEČNÁ A UVOĽŇUJÚCA TERAPIA</p>
      <h2 class="fis-h2">14× lacnejšie ako týždenné sedenia</h2>
      <p>NORIKS sa oplatí v dňoch, nie v mesiacoch. Odporúčaný terapeutmi, poskytuje jemnú úľavu bez hrubého tlaku alebo rizikových zákrokov. Používajte ho každý večer. Bez objednávania. Bez cestovania. Bez opakovaných nákladov — len bezpečná, dôsledná starostlivosť o krk, kedykoľvek ju potrebujete.</p>
    </div>
  </div>
</section>

<style>
  .fis-hero { position: relative; width: 100vw; left: 50%; margin-left: -50vw; min-height: 520px; display: flex; align-items: center; overflow: hidden; }
  .fis-hero-vid { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .fis-hero-overlay { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(0,0,0,0.5), rgba(0,0,0,0.05) 55%); }
  .fis-hero-inner { position: relative; z-index: 2; max-width: 1180px; margin: 0 auto; padding: 0 40px; width: 100%; box-sizing: border-box; }
  .fis-hero-title { color: #fff; font-weight: 800; font-size: clamp(27px,4vw,46px); line-height: 1.15; max-width: 640px; margin: 0; text-shadow: 0 2px 14px rgba(0,0,0,0.4); }
  @media (max-width: 768px) { .fis-hero { min-height: 380px; } .fis-hero-inner { padding: 0 22px; } }
  .fis-h2 { font-size: clamp(24px,3vw,34px); font-weight: 800; color: #1c1c1c; line-height: 1.2; margin: 0 0 18px; }
  .fis-center { text-align: center; }
  .fis-eyebrow { font-size: 13px; letter-spacing: 1px; text-transform: uppercase; color: #555; margin: 0 0 8px; }
  .fis-experts { padding: 44px 0; }
  .fis-exp-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 40px; align-items: start; }
  .fis-exp-quote p { font-size: 15.5px; line-height: 1.6; color: #333; margin: 0 0 14px; }
  .fis-exp-author { color: #1c1c1c; }
  .fis-exp-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
  .fis-exp-card { position: relative; border-radius: 14px; overflow: hidden; aspect-ratio: 3/4; background: #222; }
  .fis-exp-card video,
  .fis-exp-card img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .fis-exp-cap { position: absolute; left: 0; right: 0; bottom: 0; padding: 14px; color: #fff; background: linear-gradient(0deg, rgba(0,0,0,.75), rgba(0,0,0,0)); }
  .fis-exp-name { font-weight: 800; font-size: 18px; }
  .fis-exp-role { font-size: 13px; }
  .fis-exp-org { font-size: 12px; font-style: italic; opacity: .9; }
  .fis-ugc { background: #223047; padding: 40px 0; }
  .fis-ugc-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
  .fis-ugc-media { border-radius: 12px; overflow: hidden; aspect-ratio: 3/4; background: #000; }
  .fis-ugc-media video,
  .fis-ugc-media img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .fis-ugc-cap { color: #eee; font-size: 14px; line-height: 1.5; margin: 10px 0 0; }
  .fis-thermo { background: #f0efe9; padding: 44px 0; }
  .fis-thermo-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .fis-thermo-card { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 4/3; background: #111; }
  .fis-thermo-card video { width: 100%; height: 100%; object-fit: cover; display: block; }
  .fis-thermo-label { position: absolute; left: 16px; bottom: 14px; color: #fff; font-weight: 800; font-size: 18px; text-shadow: 0 1px 8px rgba(0,0,0,.6); }
  .fis-upg { padding: 44px 0; }
  .fis-upg-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; text-align: center; }
  .fis-upg-ico { width: 56px; height: 56px; object-fit: contain; display: block; margin: 0 auto 14px; }
  .fis-upg-title { font-weight: 800; color: #1c1c1c; margin: 0 0 8px; font-size: 16px; }
  .fis-upg-text { font-size: 14px; line-height: 1.5; color: #444; margin: 0; }
  .fis-eng, .fis-cheaper { padding: 40px 0; }
  .fis-cheaper { background: #f4f4f4; }
  .fis-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 44px; align-items: center; }
  .fis-row2-copy p { font-size: 15.5px; line-height: 1.65; color: #333; }
  .fis-row2-media { border-radius: 16px; overflow: hidden; }
  .fis-row2-media video,
  .fis-row2-media img { width: 100%; height: auto; display: block; }
  .fis-cheaper .fis-row2-media { aspect-ratio: 1 / 1; }
  .fis-cheaper .fis-row2-media video,
  .fis-cheaper .fis-row2-media img { height: 100%; object-fit: cover; }
  @media (max-width: 900px) {
    .fis-exp-grid { grid-template-columns: 1fr; gap: 24px; }
    .fis-ugc-grid { grid-template-columns: 1fr 1fr; }
    .fis-thermo-grid { grid-template-columns: 1fr; }
    .fis-upg-grid { grid-template-columns: 1fr 1fr; gap: 22px; }
    .fis-row2 { grid-template-columns: 1fr; gap: 22px; }
    .fis-cheaper .fis-row2-media { order: 2; }
  }
  @media (max-width: 560px) {
    .fis-exp-cards { grid-template-columns: 1fr 1fr; }
    .fis-ugc-grid { grid-template-columns: 1fr; }
  }
  .fis-science { background: #f4f4f4; padding: 44px 0; }
  .fis-wrap { max-width: 1180px; margin: 0 auto; padding: 0 16px; }
  .fis-box { background: transparent; border-radius: 0; padding: 0; }
  .fis-title { font-size: clamp(23px,2.9vw,32px); font-weight: 800; color: #1c1c1c; line-height: 1.2; margin: 0 0 26px; }
  .fis-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0; }
  .fis-card { padding: 0 22px; border-left: 1px solid #dcdcdc; }
  .fis-card:first-child { border-left: 0; padding-left: 0; }
  .fis-card-title { font-size: 17px; font-weight: 800; color: #1c1c1c; margin: 0 0 10px; }
  .fis-card-text { font-size: 15px; line-height: 1.55; color: #333; margin: 0; }
  @media (max-width: 820px) {
    .fis-grid { grid-template-columns: 1fr 1fr; gap: 22px 0; }
    .fis-card:nth-child(odd) { border-left: 0; padding-left: 0; }
  }
  @media (max-width: 480px) {
    .fis-grid { grid-template-columns: 1fr; }
    .fis-card { border-left: 0; padding-left: 0; }
  }
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }
  .woocommerce-product-details__short-description ul { list-style: none; margin: 8px 0 26px; padding-left: 0; }
  .woocommerce-product-details__short-description ul li { list-style: none; padding-left: 0; margin-left: 0; }
  .woocommerce-product-details__short-description p:has(+ ul) { margin-top: 20px; margin-bottom: 4px; }
</style>

<script>
(function(){
  function paintOrto(){
    var sel = document.getElementById('bundle-selector');
    if(!sel) return;
    sel.querySelectorAll('.bundle-option').forEach(function(c){ c.style.removeProperty('border-color'); c.style.removeProperty('background'); });
    var checked = sel.querySelector('input[name="bundle_option"]:checked');
    var card = checked ? checked.closest('.bundle-option')
             : (sel.querySelector('.bundle-option.active') || sel.querySelector('.bundle-option'));
    if(card){ card.style.setProperty('border-color','#f39c12','important'); card.style.setProperty('background','#f39c1217','important'); }
  }
  function bindOrto(){
    var sel = document.getElementById('bundle-selector');
    if(!sel) return;
    paintOrto();
    sel.querySelectorAll('input[name="bundle_option"]').forEach(function(r){ r.addEventListener('change', paintOrto); });
  }
  if(document.readyState==='loading'){ document.addEventListener('DOMContentLoaded', bindOrto); } else { bindOrto(); }
})();
</script>
