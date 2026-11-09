<?php
/**
 * product-bottom: NORIKS KidsNest — detsky vankus pre spravne dychanie (orto-kidsnest).
 * Kopija tryneedo.com/products/kids-pillow sekcii, SK preklad (zmiernene med. tvrdenia).
 * Redoslijed:
 *   1. Trust marquee (plava)  2. "Zacnite uz dnes vecer..." (slika L / tekst D, plavi naslov)
 *   3. "Spravna opora..." (tekst L / slika D)  4. Statistika 94/60/98 (svijetlo-plava, 3 kartice s krugovima)
 *   5. "#1 detsky vankus 2026" + zvjezdice + drseca foto traka
 * Plava: #2b3fb0, svijetla: #eef1fb, navy: #1b2450. Slike: img/kidsnest/
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$kn = get_template_directory_uri() . '/img/kidsnest/';
?>

<!-- ============ 1) Trust marquee (plava traka, vrti se) ============ -->
<div class="kn-marquee" aria-hidden="true">
  <div class="kn-marquee-track">
    <?php $kn_ticker = array('ODPORÚČANÉ PEDIATRAMI','OEKO-TEX® PAMÄŤOVÁ PENA','3-ZÓNOVÁ ŠTRUKTÚRA','90 NOCÍ NA VYSKÚŠANIE','HYPOALERGÉNNE','PRIEDUŠNÁ PLETENINA');
    for ( $r = 0; $r < 2; $r++ ) { foreach ( $kn_ticker as $t ) { echo '<span class="kn-tick">'.esc_html($t).'</span><span class="kn-dot">•</span>'; } } ?>
  </div>
</div>

<!-- ============ 2) Pocnite veceras — slika LIJEVO, tekst DESNO ============ -->
<section class="kn-sec">
  <div class="kn-wrap kn-row2">
    <div class="kn-media"><img src="<?php echo esc_url( $kn.'01-poravnan-sk.webp' ); ?>" alt="Dokonale zarovnané — hlava, krk a chrbtica počas spánku" loading="lazy" onerror="this.style.display='none'"></div>
    <div class="kn-copy">
      <p class="kn-eyebrow">Vyvinuté so zubnými lekármi pre detské dýchacie cesty</p>
      <h2 class="kn-h2 kn-h2-blue">Začnite už dnes večer naprávať skryté poškodenie.</h2>
      <p>Detskí zubní lekári zameraní na dýchacie cesty upozorňujú rodičov na rovnaký tichý problém: deti, ktoré chrápu a dýchajú ústami, „nespia len horšie“. Ich čeľusť, podnebie a štruktúra tváre sa môžu pomaly vyvíjať nesprávnym smerom.</p>
      <p><strong>A okno na nápravu nezostáva otvorené navždy.</strong></p>
      <p>NORIKS <strong>vankúš KidsNest</strong> je navrhnutý tak, aby <strong>podopieral hlavu, čeľusť a dýchacie cesty v správnej polohe počas spánku</strong> — a podporoval dýchanie nosom a zdravší vývoj tváre, kým na tom ešte záleží.</p>
      <p><strong>Toto nie je len vankúš.<br>Je to nočná opora dýchacích ciest v rokoch, ktoré formujú tvár vášho dieťaťa.</strong></p>
    </div>
  </div>
</section>

<!-- ============ 3) Pravilna potpora — tekst LIJEVO, slika DESNO ============ -->
<section class="kn-sec">
  <div class="kn-wrap kn-row2">
    <div class="kn-copy">
      <h2 class="kn-h2 kn-h2-blue">Správna opora hlavy a krku je kľúčová pre zdravý spánok.</h2>
      <p>Ergonomický detský vankúš drží <strong>hlavu a krk v prirodzenom zarovnaní a pomáha zabrániť nakláňaniu hlavy</strong> počas noci. Chrbtica tak zostáva správne zarovnaná — aj keď sa dieťa v spánku veľa prevaľuje.</p>
      <p><strong>Výsledkom je pokojnejší spánok a lepšia regenerácia.</strong></p>
    </div>
    <div class="kn-media"><img src="<?php echo esc_url( $kn.'kn-sk-2.webp' ); ?>" alt="Dieťa pokojne spí na vankúši KidsNest" loading="lazy" onerror="this.style.display='none'"></div>
  </div>
</section>

<!-- ============ 4) Statistika — svijetlo-plava, 3 kartice s krugovima ============ -->
<section class="kn-sec kn-stats-sec">
  <div class="kn-wrap">
    <h2 class="kn-h2 kn-h2-blue kn-center">Stvorený, aby chránil vyvíjajúcu sa tvár vášho dieťaťa</h2>
    <p class="kn-sub kn-center"><strong>Spánok s otvorenými ústami v detstve môže pretvarovať rastúcu tvár. KidsNest drží hlavu vášho dieťaťa zarovnanú, aby dýchalo nosom.</strong></p>
    <div class="kn-stats">
      <?php
      $kn_stats = array(
        array('94','165.3','rodičov si všimne, že dieťa spí <strong>so zatvorenými ústami</strong> do 2 týždňov'),
        array('60','105.5','vývoja tváre vášho <strong>dieťaťa</strong> sa formuje do 6. roku — toto okno sa už znova neotvorí'),
        array('98','172.3','rodičov by odporučilo <strong>KidsNest</strong>, aby ochránili úsmev ďalšieho dieťaťa'),
      );
      foreach ( $kn_stats as $st ) : ?>
      <div class="kn-stat-card">
        <svg class="kn-ring" viewBox="0 0 64 64" aria-hidden="true">
          <circle cx="32" cy="32" r="28" fill="none" stroke="#dfe5f5" stroke-width="5"/>
          <circle cx="32" cy="32" r="28" fill="none" stroke="#2b3fb0" stroke-width="5" stroke-linecap="round" stroke-dasharray="<?php echo esc_attr($st[1]); ?> 175.9" transform="rotate(-90 32 32)"/>
          <text x="32" y="38" text-anchor="middle" class="kn-ring-t"><?php echo esc_html($st[0]); ?>%</text>
        </svg>
        <p><?php echo wp_kses_post($st[2]); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 5) #1 djecji jastuk + zvjezdice + drseca foto traka ============ -->
<section class="kn-sec kn-rated-sec">
  <div class="kn-wrap">
    <h2 class="kn-h2 kn-h2-blue kn-center">Vyhodnotený ako detský vankúš na spanie #1 v roku 2026.</h2>
    <p class="kn-sub kn-center">Podporte ich spánok — podporte roky vyrastania.</p>
    <p class="kn-stars kn-center"><span aria-hidden="true">★★★★★</span> Hodnotenie 4,8/5 na základe 140+ recenzií</p>
  </div>
  <div class="kn-strip">
    <div class="kn-strip-track">
      <?php for ( $r = 0; $r < 2; $r++ ) : for ( $i = 1; $i <= 5; $i++ ) : ?>
        <img src="<?php echo esc_url( $kn.'traka/t'.$i.'.webp' ); ?>" alt="NORIKS KidsNest — deti a rodičia" loading="lazy" onerror="this.style.display='none'">
      <?php endfor; endfor; ?>
    </div>
  </div>
</section>

<!-- ============ 6) Kvaliteta materijala — slika LIJEVO, tekst DESNO ============ -->
<section class="kn-sec">
  <div class="kn-wrap kn-row2">
    <div class="kn-media"><img src="<?php echo esc_url( $kn.'kn-sk-6.webp' ); ?>" alt="KidsNest — 3-zónová štruktúra a priedušná tkanina zblízka" loading="lazy" onerror="this.style.display='none'"></div>
    <div class="kn-copy">
      <h2 class="kn-h2 kn-h2-blue">Kvalita, ktorú cítiť — noc čo noc.</h2>
      <p>Hustá, priedušná pletenina a starostlivo tvarovaný povrch tu nie sú kvôli vzhľadu — <strong>každá zóna má svoju úlohu</strong>. Stred jemne prijíma hlavu, okraje podopierajú krk a štruktúra si drží tvar aj po mesiacoch každodenného používania.</p>
      <p>Pletenina je priedušná a pena je <strong>hypoalergénna a odolná voči roztočom</strong> — vankúš tak zostáva svieži, čistý a pripravený na každú noc. Bez priehlbín, bez sploštenia, bez kompromisov.</p>
      <p><strong>Vankúš, ktorý aj po roku vyzerá — a podopiera — ako v prvý deň.</strong></p>
    </div>
  </div>
</section>

<style>
  .kn-wrap { max-width: 1440px; margin: 0 auto; padding: 0 22px; } /* isti container kao gornji .product */
  .kn-sec { padding: 60px 0; }
  .kn-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
  .kn-h2 { font-size: clamp(26px,3.2vw,40px); font-weight: 800; color: #1b2450; line-height: 1.14; margin: 0 0 16px; }
  .kn-h2-blue { color: #2b3fb0; }
  .kn-center { text-align: center; }
  .kn-eyebrow { font-size: 13px; font-weight: 800; letter-spacing: .02em; color: #1b2450; margin: 0 0 6px; }
  .kn-copy p { font-size: 15.5px; line-height: 1.65; color: #33394f; margin: 0 0 14px; }
  .kn-sub { font-size: 16px; line-height: 1.55; color: #33394f; max-width: 680px; margin: 0 auto 10px; }
  .kn-media img { width: 100%; height: auto; display: block; border-radius: 18px; box-shadow: 0 14px 40px rgba(27,36,80,.10); }

  /* 1) marquee */
  .kn-marquee { background: #2b3fb0; overflow: hidden; white-space: nowrap; margin-top: 26px; }
  @media (min-width: 861px) { .kn-marquee { margin-top: -20px; } } /* desktop: prepolovljen razmik do vsebine zgoraj */
  .kn-marquee + .kn-sec { padding-top: 26px; }
  .kn-marquee-track { display: inline-block; padding: 13px 0; animation: knScroll 28s linear infinite; }
  .kn-tick { color: #fff; font-weight: 800; font-style: italic; font-size: 15px; letter-spacing: .06em; text-transform: uppercase; }
  .kn-dot { color: #aebafe; margin: 0 22px; font-weight: 800; }
  @keyframes knScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

  /* 4) statistika */
  .kn-stats-sec { background: #eef1fb; }
  .kn-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; max-width: 1180px; margin: 30px auto 0; }
  .kn-stat-card { background: #fff; border-radius: 16px; padding: 34px 26px; text-align: center; box-shadow: 0 10px 28px rgba(27,36,80,.07); }
  .kn-ring { width: 150px; height: 150px; margin: 0 auto 18px; display: block; }
  .kn-ring-t { font-size: 15px; font-weight: 800; fill: #2b3fb0; }
  .kn-stat-card p { font-size: 15px; line-height: 1.5; color: #33394f; margin: 0; }
  .kn-stat-card p strong { color: #2b3fb0; }

  /* 5) rated + strip */
  .kn-rated-sec { background: #eef1fb; padding-bottom: 0; }
  .kn-stars { font-size: 16px; color: #1b2450; font-weight: 600; margin: 6px 0 26px; }
  .kn-stars span { color: #f5a623; letter-spacing: 2px; margin-right: 8px; }
  .kn-strip { overflow: hidden; width: 100vw; margin-left: calc(50% - 50vw); padding-bottom: 34px; }
  .kn-strip-track { display: flex; gap: 8px; width: max-content; animation: knScroll 60s linear infinite; }
  .kn-strip:hover .kn-strip-track { animation-play-state: paused; }
  .kn-strip-track img { width: 350px; aspect-ratio: 1/1; object-fit: cover; border-radius: 10px; display: block; flex: 0 0 auto; }

  @media (max-width: 860px) {
    .kn-sec { padding: 30px 0; }
    .kn-row2 { grid-template-columns: 1fr; gap: 18px; }
    .kn-row2 .kn-media { order: -1; }
    .kn-h2 { font-size: 2rem; }
    .kn-stats { grid-template-columns: 1fr; gap: 14px; margin-top: 18px; }
    .kn-ring { width: 120px; height: 120px; }
    .kn-strip-track img { width: 240px; }
  }
</style>
