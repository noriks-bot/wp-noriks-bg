<?php
/**
 * product-bottom: NORIKS KneeFix — ortopedska steznica za koljeno (orto-kneefix).
 * Sekcije i redoslijed preslikani s referentne stranice, tekst na HR,
 * slike su NORIKS kreative iz img/kneefix/. Svaka sekcija ima sliku s jedne
 * i tekst s druge strane (naizmjenično) — nema sekcija koje su samo slika.
 *   1. Keď sa každý krok stane nepríjemným   slika lijevo   kf-sk-3
 *   2. Možno nejde len o opotrebovanie   slika desno    14_zglob
 *   3. Podpora pre aktívne kolená         slika lijevo   08_aktivno
 *   4. 4 funkcie. Stabilnejší pocit.    slika desno    03_funkcije
 *   5. Pohodlná opora v 3 krokoch          slika lijevo   04_koraki
 *   6. Viac pohodlia v bežnom dni      slika desno    kf-sk-1
 *   7. Preporučeno za potporu koljena     slika lijevo   kf-sk-2
 *   8. Rozdiel je cítiť                  slika desno    07_vs
 *   9. Čo hovoria naši zákazníci                3 kartice      10/11/12
 * Recenzije i FAQ renderira zajednički reviews.php (ne ovdje).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$kf      = get_template_directory_uri() . '/img/kneefix/';
$kf_path = get_template_directory() . '/img/kneefix/';

/* Ako slika nije na serveru, prikaže se neutralni sivi placeholder. */
$kf_img = function( $file, $alt ) use ( $kf, $kf_path ) {
  if ( file_exists( $kf_path . $file ) ) {
    return '<img src="'.esc_url($kf.$file.'?v=20261026c').'" alt="'.esc_attr($alt).'" loading="lazy">';
  }
  return '<div class="kfx-ph" role="img" aria-label="'.esc_attr($alt).'"><span>'.esc_html($alt).'</span></div>';
};
?>

<!-- ============ 1) Keď sa každý krok stane nepríjemným ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('kf-sk-3.webp','Bolesť kolena pri chôdzi dolu schodmi'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Keď sa každý krok stane nepríjemným</h2>
      <p class="kfx-lead">Na začiatku je to často len mierne ťahanie.</p>
      <p>Potom prídu chvíle, keď koleno pocítite oveľa silnejšie:</p>
      <ul class="kfx-list">
        <li>Pri vstávaní</li>
        <li>Na schodoch</li>
        <li>Po dlhšom sedení</li>
        <li>Pri chôdzi alebo dlhšom státí</li>
      </ul>
      <p>Mnohí sa vtedy automaticky začnú vyhýbať pohybu. Chodia pomalšie, nevedome odľahčujú koleno alebo sa pri bežných pohyboch cítia neisto.</p>
      <p class="kfx-strong">Problém je v tom: čím opatrnejšie sa pohybujete, tým viac sa koleno stáva stredobodom vášho dňa.</p>
    </div>
  </div>
</section>

<!-- ============ 2) Možno nejde len o opotrebovanie ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">Možno nejde len o opotrebovanie</h2>
      <p>Mnohé bežné vysvetlenia hovoria len o „opotrebovaní". Bolesť kolena sa však často cíti skôr ako <strong>tlak, podráždenie alebo nestabilita</strong>.</p>
      <p>Jedným z možných dôvodov je podráždená kĺbová výstelka — citlivá vnútorná blana kolenného kĺbu. Keď sa toto tkanivo podráždi, koleno môže citlivejšie reagovať na záťaž. Prejaviť sa to môže ako:</p>
      <ul class="kfx-inline-list">
        <li>Pocit tlaku okolo jabĺčka</li>
        <li>Stuhnutosť po pokoji</li>
        <li>Neistota pri pohybe</li>
        <li>Citlivosť pri záťaži</li>
      </ul>
      <p>Mnohé klasické ortézy sa problém snažia riešiť tuhou stabilizáciou. Tvrdé ortézy však bývajú nepohodlné, kĺžu sa alebo obmedzujú prirodzený pohyb. Práve preto je <strong>NORIKS KneeFix</strong> vyvinutý inak.</p>
    </div>
    <div class="kfx-media"><?php echo $kf_img('14_zglob.jpg','Podráždená kĺbová výstelka kolenného kĺbu'); ?></div>
  </div>
</section>

<!-- ============ 3) Podpora pre aktívne kolená ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('08_aktivni_SK.webp','Zostaňte aktívni — bez obmedzení v kolenách'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Podpora pre aktívne kolená</h2>
      <p><strong>NORIKS KneeFix</strong> spája viac funkcií v jednom flexibilnom systéme podpory pre každý deň. Namiesto ťažkej ortézy dostanete:</p>
      <ul class="kfx-check">
        <li>Kompresiu, ktorú si nastavíte sami</li>
        <li>Bočnú stabilizáciu</li>
        <li>Gélový vankúšik na odľahčenie jabĺčka</li>
        <li>Protišmykový priľnavý okraj</li>
      </ul>
      <p>Cieľom nie je znehybniť vaše koleno. KneeFix je vyvinutý tak, aby koleno príjemnejšie podoprel pri každodennom pohybe — pri chôdzi, v práci, na nákupoch či na cestách.</p>
    </div>
  </div>
</section>

<!-- ============ 4) 4 funkcie. Stabilnejší pocit. ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">4 funkcie. Stabilnejší pocit.</h2>
      <p>KneeFix nerobí len jedno — viacero systémov podpory pôsobí súčasne:</p>
      <ul class="kfx-check">
        <li><strong>Presné koliesko na kompresiu</strong> — nastaviteľná kompresia a bezpečné dosadnutie</li>
        <li><strong>Dvojité bočné stabilizátory</strong> — bočná stabilita kolena</li>
        <li><strong>Gélový vankúšik na jabĺčko</strong> — odľahčenie tlaku a tlmenie nárazov</li>
        <li><strong>Silikónový úchop proti šmýkaniu</strong> — mäkká silikónová textúra bráni skĺznutiu a rolovaniu</li>
      </ul>
    </div>
    <div class="kfx-media"><?php echo $kf_img('03_funkcie_SK.webp','Štyri funkcie ortézy NORIKS KneeFix'); ?></div>
  </div>
</section>

<!-- ============ 5) Pohodlná opora v 3 krokoch ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('04_kroky_SK.webp','Pohodlná opora v troch krokoch — natiahnite, zarovnajte, nastavte'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Pohodlná opora v 3 krokoch</h2>
      <ol class="kfx-steps">
        <li><strong>Natiahnite ortézu cez koleno.</strong> Potiahnite ju nahor pre bezpečné a pohodlné dosadnutie.</li>
        <li><strong>Zarovnajte gélový vankúšik.</strong> Umiestnite ho vycentrovane okolo jabĺčka.</li>
        <li><strong>Nastavte kompresiu.</strong> Otočením kolieska nastavíte oporu a stabilitu.</li>
      </ol>
      <p>Bez zložitých popruhov a nastavovania — pripravení ste za pár sekúnd.</p>
    </div>
  </div>
</section>

<!-- ============ 6) Viac pohodlia v bežnom dni ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">Viac pohodlia v bežnom dni</h2>
      <p>Mnohí nechcú ťažkú športovú ortézu. Chcú jednoducho:</p>
      <ul class="kfx-check">
        <li>Bezpečnejšie chodiť</li>
        <li>Uvoľnenejšie chodiť po schodoch</li>
        <li>Dlhšie stáť</li>
        <li>Voľnejšie sa pohybovať</li>
      </ul>
      <p>NORIKS KneeFix je vyvinutý tak, aby každodenné pohyby boli príjemnejšie — bez zbytočných obmedzení. Flexibilný materiál sa lepšie prispôsobí vášmu dňu a podoprie koleno tam, kde to potrebujete.</p>
      <a class="kfx-cta" href="#bundle-selector">Vyber svoju veľkosť →</a>
    </div>
    <div class="kfx-media"><?php echo $kf_img('kf-sk-1.webp','KneeFix v bežnom dni — prechádzka, bicykel, tréning'); ?></div>
  </div>
</section>

<!-- ============ 7) Odporúčané na každodennú podporu kolena ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('kf-sk-2.webp','Odporúčané na každodennú podporu kolena'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Odporúčané na každodennú podporu kolena</h2>
      <ul class="kfx-check">
        <li>Nastaviteľná kompresná podpora</li>
        <li>Stabilizuje a chráni koleno</li>
        <li>Pohodlné na každodenné nosenie</li>
      </ul>
      <p>KneeFix je určený ako každodenná podpora, nie ako liečba. Ak máte akútne zranenie alebo trvalé ťažkosti, o nosení sa poraďte so svojím lekárom.</p>
    </div>
  </div>
</section>

<!-- ============ 8) Rozdiel je cítiť ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">Rozdiel je cítiť</h2>
      <p>Tradičné ortézy problém často riešia tak, že koleno znehybnia. KneeFix ide inou cestou — pohyb podporuje namiesto toho, aby ho blokoval.</p>
      <ul class="kfx-check">
        <li>Prirodzená chôdza namiesto stuhnutosti pri pohybe</li>
        <li>Uvoľnené držanie tela namiesto nepohodlnej polohy</li>
        <li>Sloboda pohybu a pohodlie namiesto viditeľného zaťaženia kolena</li>
      </ul>
      <a class="kfx-cta" href="#bundle-selector">Objednať KneeFix</a>
    </div>
    <div class="kfx-media"><?php echo $kf_img('07_vs_SK.webp','Kolenná ortéza NORIKS v porovnaní s tradičnou ortézou'); ?></div>
  </div>
</section>

<!-- ============ 9) Čo hovoria naši zákazníci ============ -->
<section class="kfx-sec kfx-revs">
  <div class="kfx-wrap">
    <h2 class="kfx-h2 kfx-center">Čo hovoria naši zákazníci</h2>
    <p class="kfx-sub kfx-center"><strong>Tisíce zákazníkov už denne nosia NORIKS KneeFix</strong> pretože je vyvinutý tak, aby koleno cielene podoprel — namiesto zbytočného obmedzovania pohybu alebo krátkodobého prekrytia ťažkostí.</p>
    <div class="kfx-rev-grid">
      <?php foreach ( array(
        array( '10_review-1.jpg', 'Konečne stabilnejšia chôdza', 'Vyskúšal som už niekoľko ortéz, ale boli buď príliš tuhé, alebo sa neustále šmýkali. Táto sedí citeľne pohodlnejšie a kolenu pri chôdzi aj na schodoch dáva oveľa viac stability.', 'Damir P.' ),
        array( '11_review-3.jpg', 'Viac istoty na schodoch', 'Schody boli pre mňa roky utrpením, pretože sa mi koleno zdalo nestabilné. Odkedy nosím KneeFix, cítim sa oveľa istejšie. Takmer sa nešmýka ani na dlhších prechádzkach.', 'Sanja M.' ),
        array( '12_review-6.jpg', 'Príjemné v bežnom dni', 'Nosím ju v práci a nemyslela som si, že bude taká pohodlná. Materiál je flexibilný, kompresia sa ľahko nastaví a pod nohavicami ju takmer nevidno.', 'Vesna N.' ),
      ) as $rv ) : ?>
        <article class="kfx-rev">
          <div class="kfx-rev-img"><?php echo $kf_img( $rv[0], 'Zákazník nosí ortézu NORIKS KneeFix' ); ?></div>
          <div class="kfx-rev-body">
            <div class="kfx-stars" aria-label="Ocjena 5 od 5">★★★★★</div>
            <p class="kfx-rev-title"><?php echo esc_html( $rv[1] ); ?></p>
            <p class="kfx-rev-text"><?php echo esc_html( $rv[2] ); ?></p>
            <p class="kfx-rev-name"><?php echo esc_html( $rv[3] ); ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  .kfx-sec { padding: 48px 0; }
  .kfx-alt { background: #f5f6f7; }
  .kfx-wrap { max-width: 1180px; margin: 0 auto; padding: 0 18px; }
  .kfx-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
  .kfx-h2 { font-size: clamp(24px,3.1vw,36px); font-weight: 800; color: #141414; line-height: 1.15; margin: 0 0 16px; }
  .kfx-center { text-align: center; }
  .kfx-copy p, .kfx-sub { font-size: 16px; line-height: 1.65; color: #3a3a3a; margin: 0 0 14px; }
  .kfx-sub { max-width: 820px; margin: 0 auto 26px; }
  .kfx-lead { font-weight: 700; color: #141414; }
  .kfx-strong { font-weight: 700; color: #141414; }
  .kfx-media img { width: 100%; height: auto; display: block; border-radius: 16px; }

  .kfx-ph { width: 100%; aspect-ratio: 1/1; background: #ededed; border: 1px dashed #d3d3d3; border-radius: 16px;
            display: flex; align-items: center; justify-content: center; padding: 18px; box-sizing: border-box; }
  .kfx-ph span { font-size: 13px; line-height: 1.45; color: #9a9a9a; text-align: center; }

  .kfx-list { margin: 0 0 16px; padding-left: 20px; }
  .kfx-list li { font-size: 16px; line-height: 1.6; color: #3a3a3a; margin: 0 0 6px; }
  .kfx-inline-list { list-style: none; display: flex; flex-wrap: wrap; gap: 8px 10px; margin: 0 0 16px; padding: 0; }
  .kfx-inline-list li { background: #fff; border: 1px solid #e4e4e4; border-radius: 999px; padding: 8px 16px; font-size: 14px; color: #141414; }
  .kfx-check { list-style: none; margin: 0 0 16px; padding: 0; }
  .kfx-check li { position: relative; padding: 0 0 11px 30px; font-size: 15.5px; color: #141414; line-height: 1.5; }
  .kfx-check li:before { content: "✓"; position: absolute; left: 0; top: 0; width: 20px; height: 20px; background: #141414; color: #fff; border-radius: 50%; font-size: 12px; text-align: center; line-height: 20px; }
  .kfx-steps { list-style: none; counter-reset: kfxstep; margin: 0 0 16px; padding: 0; }
  .kfx-steps li { counter-increment: kfxstep; position: relative; padding: 0 0 14px 40px; font-size: 15.5px; line-height: 1.55; color: #3a3a3a; }
  .kfx-steps li:before { content: counter(kfxstep); position: absolute; left: 0; top: 0; width: 26px; height: 26px; background: #141414; color: #fff; border-radius: 50%; font-size: 13px; font-weight: 700; text-align: center; line-height: 26px; }

  .kfx-cta { display: inline-block; margin-top: 8px; background: #141414; color: #fff; font-weight: 700; font-size: 16px; padding: 14px 30px; border-radius: 10px; text-decoration: none; }
  .kfx-cta:hover { background: #E8450E; color: #fff; }

  /* 9) recenzije s fotografijama kupaca */
  .kfx-rev-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; }
  .kfx-rev { background: #fff; border: 1px solid #e8e8e8; border-radius: 14px; overflow: hidden; }
  .kfx-rev-img img { width: 100%; height: 100%; aspect-ratio: 3/4; object-fit: cover; display: block; border-radius: 0; }
  .kfx-rev-body { padding: 16px 18px 18px; text-align: center; }
  .kfx-stars { color: #f5a623; font-size: 15px; letter-spacing: 1px; }
  .kfx-rev-title { font-weight: 700; color: #141414; font-size: 15px; margin: 8px 0 8px; }
  .kfx-rev-text { font-size: 14px; line-height: 1.6; color: #4a4a4a; margin: 0 0 12px; }
  .kfx-rev-name { font-size: 13px; font-style: italic; font-weight: 700; color: #6b6b6b; margin: 0; padding-top: 10px; border-top: 1px solid #ededed; }

  @media (max-width: 820px) {
    .kfx-sec { padding: 30px 0; }
    .kfx-row2 { grid-template-columns: 1fr; gap: 20px; }
    .kfx-row2 .kfx-media { order: -1; }
    .kfx-h2 { font-size: 2rem; }
    .kfx-rev-grid { grid-template-columns: 1fr; }
    .kfx-rev-img img { aspect-ratio: 4/3; }
  }

  /* Nema "Tablica veličina" linka na KneeFixu (ni plugin ni globalni). */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  /* Kratki opis (short description): sakrij standardne točke (•), ostaje samo ✅
     iz teksta; razmak između "Prednosti:" i liste te ispod liste.
     (Ovaj se predložak učitava samo na orto-kneefix stranicama.) */
  .woocommerce-product-details__short-description ul {
      list-style: none;
      margin: 8px 0 26px;
      padding-left: 0;
  }
  .woocommerce-product-details__short-description ul li {
      list-style: none;
      padding-left: 0;
      margin-left: 0;
      line-height: 1.55;
      margin-bottom: 6px;
  }
  /* razmak iznad "Prednosti:" (paragraf neposredno prije liste) */
  .woocommerce-product-details__short-description p:has(+ ul) {
      margin-top: 20px;
      margin-bottom: 4px;
  }
</style>

<script>
(function(){
  document.querySelectorAll('a.kfx-cta[href="#bundle-selector"]').forEach(function(a){
    a.addEventListener('click', function(e){ e.preventDefault(); var t=document.getElementById('bundle-selector')||document.querySelector('.single_add_to_cart_button'); if(t) t.scrollIntoView({behavior:'smooth',block:'center'}); });
  });
})();
</script>
