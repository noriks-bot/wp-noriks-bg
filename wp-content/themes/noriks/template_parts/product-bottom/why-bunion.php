<?php
/**
 * product-bottom: KOREKTOR VBOČENÉHO PALCA (bunion / hallux valgus) — SK
 *
 * Dedicated bottom-nicer for the NORIKS bunion corrector.
 * Shown via single-product-bottom-nicer.php when noriks_is_type('bunion').
 *
 * Médiá sú v téme (git), relatívne cez get_template_directory_uri():
 *   img/bunion-videos/section-1.mp4, funkcionira.mp4, step-1..3.mp4
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$bun_vid_dir = get_template_directory_uri() . '/img/bunion-videos/';
$bun_video_1 = $bun_vid_dir . 'section-1.mp4'; // 1) One foot away
$bun_video_2 = $bun_vid_dir . 'funkcionira.mp4'; // 2) Ako to funguje

$bun_img_features = get_template_directory_uri() . '/img/bunion/why-2026.webp';

// Skutočné výsledky — percentá
$bun_results = array(
    array( 'pct' => 91, 'text' => 'používateľov uviedlo zmiernenie bolesti spôsobenej vbočeným palcom už od 2. sedenia' ),
    array( 'pct' => 90, 'text' => 'používateľov úplne odstránilo bolesť spôsobenú vbočeným palcom už po 14 dňoch dôsledného používania (30 min/deň)' ),
    array( 'pct' => 88, 'text' => 'používateľov si všimlo viditeľné zlepšenie zarovnania prstov už po 30 dňoch dôsledného používania (30 min/deň)' ),
);

// Prečo si vybrať nás — porovnanie (rovnaký štýl ako knc-table na ponožkách so zipsom)
$bun_cmp = array(
    '90-dňová záruka vrátenia peňazí',
    'Zmierňuje nepohodlie',
    'Zabraňuje rastu vbočeného palca',
    'Postupom času zlepšuje stav vbočeného palca',
    'Pružná konštrukcia — môžete v ňom chodiť',
    'Odolný a dlhotrvajúci',
);

// Ako sa používa — 3 kroky (video + opis)
$bun_steps = array(
    array( 'video' => $bun_vid_dir . 'step-1.mp4', 'caption' => 'Pripevnite korektor NORIKS na palec a chodidlo' ),
    array( 'video' => $bun_vid_dir . 'step-2.mp4', 'caption' => 'Nastavte intenzitu naťahovania podľa potreby' ),
    array( 'video' => $bun_vid_dir . 'step-3.mp4', 'caption' => 'Uvoľnite sa a nechajte korektor NORIKS vykonať svoju prácu' ),
);
?>

<!-- ============ 1) Ste len krok… ============ -->
<section class="bun-why bun-intro">
  <div class="bun-wrap bun-row">
    <div class="bun-col bun-media">
      <video src="<?php echo esc_url( $bun_video_1 ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="bun-col bun-copy">
      <h2 class="bun-title">Ste len krok od toho, aby ste sa zbavili <span class="bun-hl">nepohodlia spôsobeného vbočeným palcom</span>, opuchnutých prstov a bolesti chodidiel…</h2>
      <p>Ak toto čítate, je veľká pravdepodobnosť, že trpíte pretrvávajúcim <strong class="bun-red">nepohodlím spôsobeným vbočeným palcom</strong>.</p>
      <p>Výsledok? Bolesť a nepohodlie ovplyvňujú vaše každodenné činnosti.</p>
      <p>Ak sa neliečia, môžu sa zhoršiť. Prsty sa prekrížia, môžu sa vyvinúť kladivkové prsty a kostné výrastky.</p>
      <p>Vbočený palec je <strong class="bun-red">postupujúci problém</strong> a sám od seba nezmizne.</p>
      <p>Postupom času môže viesť k vážnejším problémom, ako sú <u>invazívna operácia, problémy s bedrami, kolenami a driekovou časťou chrbta a dokonca aj nehybnosť</u>.</p>
      <p>Pomocou klinicky overenej pokročilej terapie zarovnania a patentovaného kĺbového mechanizmu <strong>korektor vbočeného palca NORIKS</strong> účinne zmierňuje nepohodlie na postihnutej časti chodidla a obnovuje zdravie vášho chodidla len s 30 minútami denného používania.</p>
      <p class="bun-stat"><span class="bun-check" aria-hidden="true">✔</span> <em>91 % používateľov uviedlo <strong>zmiernenie bolesti chodidiel</strong> už v prvom týždni</em></p>
    </div>
  </div>
</section>

<!-- ============ 2) Ako to funguje? ============ -->
<section class="bun-why">
  <div class="bun-wrap bun-row bun-reverse">
    <div class="bun-col bun-media">
      <video src="<?php echo esc_url( $bun_video_2 ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="bun-col bun-copy">
      <h2 class="bun-title">Ako to funguje?</h2>
      <p><strong>Korektor vbočeného palca NORIKS</strong> využíva pokročilú terapiu zarovnania. Je navrhnutý tak, aby <strong class="bun-red">podporil opätovné zarovnanie</strong> palca a postupne zmiernil zápal pomocou silného patentovaného kĺbového mechanizmu.</p>
      <p>Pomáha uvoľniť svalové napätie tým, že jemne vracia palec do jeho prirodzenej polohy, čo postupom času vedie k bezbolestnému prirodzenému zarovnaniu kĺbu prsta.</p>
      <p>Takto sa uvoľní roky nahromadené napätie, výrastok sa upraví a zmenší, bolesť sa zmierni a zabráni sa ďalšiemu rastu — aby ste sa opäť postavili na nohy, vzpriamene a sebavedomo.</p>
      <p>Niektorí používatelia môžu potrebovať jedno alebo dve sedenia, aby si zvykli, keďže <strong class="bun-red">pocit môže byť výraznejší</strong> v porovnaní s inými metódami.</p>
      <p>Je to prirodzený a neinvazívny spôsob, ako obnoviť prirodzenú polohu prsta a chodidla a napraviť škody spôsobené nevhodnou obuvou alebo genetikou.</p>
      <p>Bez ohľadu na to, či ide o malé detské chodidlo alebo veľké chodidlo dospelého, je <u>korektor vyrobený tak, aby pohodlne padol na všetky veľkosti chodidiel</u>.</p>
      <p class="bun-stat"><span class="bun-check" aria-hidden="true">✔</span> <em>87 % používateľov uviedlo <strong>viditeľné zlepšenie</strong> už v prvom mesiaci</em></p>
    </div>
  </div>
</section>

<!-- ============ 3) Ako sa používa (sivé, 3 kroky) ============ -->
<section class="bun-why bun-howto">
  <div class="bun-wrap">
    <h2 class="bun-howto-title">Ako sa používa</h2>
    <div class="bun-howto-intro">
      <p>Odporúčame začať s 30 minútami denne a postupne predlžovať až na sedenie 1 až 3 hodiny.</p>
      <p>Keď sa budete cítiť pohodlne, môžete ho začať nosiť aj počas spánku každú noc.</p>
      <p>Najlepší je na oddych — keď ležíte na gauči, pozeráte TV, čítate alebo spíte.</p>
      <p>Na rozdiel od iných produktov na trhu sa však môžete aj hýbať bez toho, aby vás korektor NORIKS obmedzoval v pohybe, vďaka svojej pružnej konštrukcii.</p>
    </div>
    <div class="bun-steps-grid">
      <?php $bun_n = 0; foreach ( $bun_steps as $bun_step ) : $bun_n++; ?>
        <div class="bun-step">
          <div class="bun-step-media">
            <video src="<?php echo esc_url( $bun_step['video'] ); ?>" muted autoplay loop playsinline preload="metadata"></video>
          </div>
          <div class="bun-step-num"><?php echo (int) $bun_n; ?></div>
          <p class="bun-step-caption"><?php echo esc_html( $bun_step['caption'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 4) 8 dôvodov, prečo si ho zamilujete ============ -->
<section class="bun-why">
  <div class="bun-wrap bun-row">
    <div class="bun-col bun-copy">
      <h2 class="bun-title">8 dôvodov, prečo si ho zamilujete</h2>
      <ul class="bun-reasons">
        <li><strong>Úľava od nepohodlia</strong> pri chôdzi, cvičení, státí a spánku</li>
        <li><strong>Zabraňuje</strong> ďalšiemu rastu vbočeného palca</li>
        <li><strong>Nechirurgická možnosť</strong> úľavy</li>
        <li>Pevné zarovnanie kĺbu, ktoré <strong>skutočne zlepší váš stav</strong></li>
        <li><strong>Nastaviteľná</strong> intenzita naťahovania</li>
        <li>Navrhnutý a odporúčaný <strong>zdravotníckymi odborníkmi</strong></li>
        <li><strong>Jednoduchý na použitie</strong> a prenosný</li>
        <li><strong>90-dňová záruka vrátenia peňazí</strong> („výsledky alebo plné vrátenie peňazí"), pretože sme si natoľko istí naším produktom a vieme, že vám pomôže</li>
      </ul>
    </div>
    <div class="bun-col bun-media">
      <img loading="lazy" decoding="async" src="<?php echo esc_url( $bun_img_features ); ?>" alt="Prečo je korektor vbočeného palca NORIKS iný" />
    </div>
  </div>
</section>

<!-- ============ 5) Skutočné výsledky, skutoční ľudia ============ -->
<section class="bun-why bun-results-sec">
  <div class="bun-wrap bun-row">
    <div class="bun-col bun-copy">
      <h2 class="bun-title">Skutočné <span class="bun-hl">výsledky</span>, skutoční ľudia</h2>
      <p>Vykonali sme spotrebiteľský test, v ktorom sme korektor vbočeného palca NORIKS poslali do viac ako <strong>37 podiatrických ambulancií</strong>. Celkovo ho vyskúšalo <strong>432 pacientov</strong> s vbočeným palcom. Tu sú výsledky.</p>
    </div>
    <div class="bun-col">
      <div class="bun-results">
        <?php foreach ( $bun_results as $bun_r ) : $bun_dash = round( $bun_r['pct'] * 1.6336, 1 ); ?>
          <div class="bun-result">
            <svg class="bun-ring" viewBox="0 0 60 60" aria-hidden="true">
              <circle cx="30" cy="30" r="26" fill="none" stroke="#dfe6ee" stroke-width="5"/>
              <circle cx="30" cy="30" r="26" fill="none" stroke="#1a86d0" stroke-width="5" stroke-linecap="round"
                      stroke-dasharray="<?php echo esc_attr( $bun_dash ); ?> 163.4" transform="rotate(-90 30 30)"/>
              <text x="30" y="34" text-anchor="middle" class="bun-ring-txt"><?php echo (int) $bun_r['pct']; ?>%</text>
            </svg>
            <p class="bun-result-text"><?php echo esc_html( $bun_r['text'] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ 6) Prečo si vybrať nás? (porovnávacia tabuľka, knc štýl) ============ -->
<section class="bun-cmp-section">
  <div class="bun-cmp-wrap">
    <h2 class="bun-cmp-title">Prečo si vybrať nás?</h2>
    <p class="bun-cmp-lead">Nenaleťte na <span class="bun-hl">LACNÉ imitácie</span></p>
    <p class="bun-cmp-sub">Ako sa <strong>korektor vbočeného palca NORIKS</strong> porovnáva s ostatnými:</p>
    <div class="bun-cmp-scroll">
      <table class="bun-cmp-table">
        <thead>
          <tr>
            <th></th>
            <th class="bun-us">NORIKS</th>
            <th class="bun-comp">Ostatné korektory</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $bun_cmp as $bun_row ) : ?>
            <tr>
              <td><?php echo esc_html( $bun_row ); ?></td>
              <td class="us ok">✓</td>
              <td class="no">✕</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<style>
  /* Žiadny odkaz "Tabuľka veľkostí" na korektore vbočeného palca (ani plugin, ani globálny). */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  /* Krátky opis (short description): skry štandardné odrážky (•), zostane len ✅;
     odsadenie nad "Prednosti:" a viac priestoru pod zoznamom.
     (Táto šablóna sa načíta len na orto-bunion stránkach.) */
  .woocommerce-product-details__short-description ul {
      list-style: none;
      margin: 8px 0 26px;
      padding-left: 0;
  }
  .woocommerce-product-details__short-description ul li {
      list-style: none;
      padding-left: 0;
      margin-left: 0;
  }
  .woocommerce-product-details__short-description p:has(+ ul) {
      margin-top: 20px;
      margin-bottom: 4px;
  }

  .bun-why { padding: 44px 0; }
  .bun-why.bun-intro { background: #fbf9f4; }
  .bun-wrap { max-width: 1180px; margin: 0 auto; padding: 0 16px; }
  .bun-row { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
  .bun-media video { width: 100%; height: auto; border-radius: 12px; display: block; }
  .bun-title { font-size: clamp(24px,2.9vw,34px); font-weight: 800; color: #1c1c1c; line-height: 1.2; margin: 0 0 18px; }
  .bun-hl { color: #1a86d0; }
  .bun-red { color: #e0563f; }
  .bun-copy p { font-size: 16px; line-height: 1.7; color: #333; margin: 0 0 12px; }
  .bun-stat { display: flex; align-items: flex-start; gap: 8px; margin-top: 6px !important; }
  .bun-check { color: #1a86d0; font-weight: 800; }
  .bun-stat em { font-style: italic; color: #333; }

  /* section 2: media on the right */
  .bun-reverse .bun-media { order: 2; }
  .bun-reverse .bun-copy { order: 1; }

  /* 3) Ako sa používa (sivé ozadie) */
  .bun-why.bun-howto { background: #f0f2f5; }
  .bun-howto-title { text-align: center; font-size: clamp(24px,2.9vw,34px); font-weight: 800; color: #1c1c1c; margin: 0 0 18px; }
  .bun-howto-intro { max-width: 820px; margin: 0 auto 34px; text-align: center; }
  .bun-howto-intro p { font-size: 16px; line-height: 1.6; color: #333; margin: 0 0 12px; }
  .bun-steps-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
  .bun-step { text-align: center; }
  .bun-step-media { width: 100%; aspect-ratio: 1 / 1; border-radius: 14px; overflow: hidden; background: #e6e9ee; }
  .bun-step-media video { width: 100%; height: 100%; object-fit: cover; display: block; }
  .bun-step-num { font-size: 22px; font-weight: 800; color: #1c1c1c; margin: 14px 0 6px; }
  .bun-step-caption { font-size: 15px; line-height: 1.5; color: #333; margin: 0 8px; }

  /* 4) 8 dôvodov */
  .bun-media img { width: 100%; height: auto; border-radius: 12px; display: block; }
  .bun-reasons { list-style: none; margin: 0; padding: 0; }
  .bun-reasons li { position: relative; padding: 0 0 16px 34px; font-size: 15.5px; line-height: 1.5; color: #333; }
  .bun-reasons li:before {
      content: ""; position: absolute; left: 0; top: 1px; width: 22px; height: 22px; border-radius: 50%;
      background: #1a86d0 url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M6 12.5l4 4 8-8' fill='none' stroke='white' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'/></svg>") center/15px no-repeat;
  }

  /* 5) Skutočné výsledky */
  .bun-results { display: flex; flex-direction: column; gap: 18px; }
  .bun-result { display: flex; align-items: center; gap: 16px; border-bottom: 1px solid #e6e6e6; padding-bottom: 16px; }
  .bun-result:last-child { border-bottom: 0; padding-bottom: 0; }
  .bun-ring { width: 70px; height: 70px; flex: 0 0 70px; }
  .bun-ring-txt { font-size: 16px; font-weight: 800; fill: #1a86d0; }
  .bun-result-text { font-size: 14.5px; line-height: 1.5; color: #333; margin: 0; }

  /* 6) Prečo si vybrať nás — porovnávacia tabuľka (rovnaký štýl ako knc-table) */
  .bun-cmp-section { background:#fff; padding:44px 0; }
  .bun-cmp-wrap { max-width:940px; margin:0 auto; padding:0 16px; }
  .bun-cmp-title { text-align:center; font-size:clamp(24px,3vw,34px); font-weight:800; color:#111; margin:0 0 8px; }
  .bun-cmp-lead { text-align:center; font-size:18px; font-weight:800; color:#111; margin:0 0 6px; }
  .bun-cmp-sub { text-align:center; font-size:14px; color:#444; margin:0 0 24px; }
  .bun-cmp-scroll { border-radius:16px; overflow:hidden; box-shadow:0 12px 34px rgba(18,48,90,.12); border:1px solid #edf0f4; }
  .bun-cmp-table { width:100%; border-collapse:collapse; table-layout:fixed; margin:0 !important; }
  .bun-cmp-table th, .bun-cmp-table td { padding:15px 12px; text-align:center; font-size:15px; }
  .bun-cmp-table thead th { color:#fff; font-weight:700; vertical-align:middle; font-size:14px; }
  .bun-cmp-table thead th:first-child { width:52%; background:#fff; }
  .bun-cmp-table .bun-comp { background:#767676; }
  .bun-cmp-table .bun-us { background:#111; }
  .bun-cmp-table tbody td:first-child { text-align:left; font-weight:600; color:#111; font-size:14px; line-height:1.3; padding-left:18px; }
  .bun-cmp-table tbody tr { border-bottom:1px solid #eef0f4; }
  .bun-cmp-table tbody tr:nth-child(even) { background:#fafbfc; }
  .bun-cmp-table td.ok { color:#1a9e5f; font-size:19px; font-weight:700; }
  .bun-cmp-table td.no { color:#d64545; font-size:18px; font-weight:700; }
  .bun-cmp-table td.us { background:#f3f3f3 !important; }
  .bun-cmp-table td.us.ok { color:#1a9e5f; }
  @media (max-width:600px) {
    .bun-cmp-table th, .bun-cmp-table td { padding:12px 6px; font-size:13px; }
    .bun-cmp-table thead th { font-size:12px; }
    .bun-cmp-table tbody td:first-child { font-size:12px; padding-left:10px; }
  }

  @media (max-width: 820px) {
    .bun-row { grid-template-columns: 1fr; gap: 22px; }
    .bun-reverse .bun-media { order: 0; }
    .bun-reverse .bun-copy { order: 0; }
    .bun-steps-grid { grid-template-columns: 1fr; gap: 18px; }
  }
</style>
