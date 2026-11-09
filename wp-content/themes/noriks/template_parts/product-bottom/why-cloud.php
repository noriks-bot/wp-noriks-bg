<?php
/**
 * product-bottom: NORIKS Cloud — ortopedski jastuk za koljena (orto-cloud).
 *
 * Redoslijed prati referentnu stranicu (Cellsius), tekst na HR, mediji su NORIKS
 * kreative iz img/cloud/. Tamna shema jer su i kreative tamne.
 *   1. Získajte späť rána, ktoré ste považovali za stratené   11_jutra
 *   2. Bez Noriksa / S Noriksom                              01
 *   3. Poravnanje koje se vidi (prije/poslije)               02
 *   4. Osmisljeno za ono sto vas sprjecava da spavate        06
 *   5. Ostaje na mjestu. Cijelu noc.                         12
 *   6. Stvoreno da dise                                      09
 *   7. Nie všetky vankúše medzi kolená sú rovnaké                      05
 *   8. Izradeno prema strogim standardima                    04
 *   9. Preporucuju ga strucnjaci                             hf_
 *  10. 60 noci isprobavanja                                  07
 * Recenzije i FAQ renderira zajednicki reviews.php (ne ovdje).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$cd      = get_template_directory_uri() . '/img/cloud/';
$cd_path = get_template_directory() . '/img/cloud/';

$cd_vid = function( $mp4, $fallback, $alt ) use ( $cd, $cd_path ) {
  if ( file_exists( $cd_path . $mp4 ) ) {
    $poster = str_replace( '.mp4', '-poster.webp', $mp4 );
    return '<video class="ncd-video" src="'.esc_url($cd.$mp4).'" poster="'.esc_url($cd.$poster).'"'
         . ' autoplay muted loop playsinline preload="metadata" aria-label="'.esc_attr($alt).'"></video>';
  }
  return '<img src="'.esc_url($cd.$fallback).'" alt="'.esc_attr($alt).'" loading="lazy">';
};
$cd_img = function( $file, $alt ) use ( $cd, $cd_path ) {
  if ( file_exists( $cd_path . $file ) ) {
    return '<img src="'.esc_url($cd.$file).'" alt="'.esc_attr($alt).'" loading="lazy">';
  }
  return '<div class="ncd-ph" role="img" aria-label="'.esc_attr($alt).'"><span>'.esc_html($alt).'</span></div>';
};
?>

<!-- ============ 2) Bez Noriksa / S Noriksom ============ -->
<section class="ncd-sec ncd-dark">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-media"><?php echo $cd_vid('cld-vid-razlika.mp4','cld-bez-s-noriksom.webp','Spánok bez vankúša a s vankúšom NORIKS Cloud'); ?></div>
    <div class="ncd-copy">
      <h2 class="ncd-h2">Rozdiel, ktorý spoznáte hneď prvú noc</h2>
      <p><strong>Bez vankúša:</strong> vrchná noha padá cez spodnú, panva sa krúti a tlak ide do krížov a do kolien.</p>
      <p><strong>S NORIKS Cloudom:</strong> nohy zostanú v línii s bedrami, hmotnosť sa rozloží a tlakové body zmiznú.</p>
      <ul class="ncd-check">
        <li>Bedrá a kolená v prirodzenej línii</li>
        <li>Menší tlak na kríže</li>
        <li>Menej otáčania počas noci</li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ B) Koraci — pocnite bolje spavati vec veceras ============ -->
<?php
$cd_steps = array(
  array( 'cld-korak1.webp', 'Rozopnite pásik a vložte vankúš', 'Stlačte patentku, uvoľnite pásik a vložte vankúš medzi kolená.' ),
  array( 'cld-korak2.webp', 'Nastavte pásik podľa svojej nohy',       'Utiahnite pásik okolo nohy v jednej z dvoch polôh — pevne, ale bez tlaku.' ),
  array( 'cld-korak3.webp', 'Spite v správnom postavení',    'Vankúš udržiava nohy v rozstupe, chrbtica zostáva vyrovnaná a tlak povolí.' ),
  array( 'cld-korak4.webp', 'Zobuďte sa bez stuhnutosti',         'Bez prevaľovania pol noci a bez hľadania polohy, ktorá nebolí.' ),
);
?>
<section class="ncd-sec">
  <div class="ncd-wrap ncd-center">
    <h2 class="ncd-h2">Začnite lepšie spať už dnes večer</h2>
    <p class="ncd-sub">Jednoduché na použitie. <strong>Lepší spánok</strong> od prvej noci.</p>
  </div>
  <div class="ncd-wrap">
    <div class="ncd-steps4">
      <?php foreach ( $cd_steps as $i => $st ) : ?>
        <div class="ncd-step4">
          <div class="ncd-step4-ic">
            <?php echo $cd_img( $st[0], $st[1] ); ?>
            <span class="ncd-step4-b">Krok <?php echo (int) $i + 1; ?></span>
          </div>
          <h3 class="ncd-step4-t"><?php echo esc_html( $st[1] ); ?></h3>
          <p class="ncd-step4-p"><?php echo esc_html( $st[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ A) Recenzije kupaca — vrtuljak (kao prva sekcija na referenci) ============ -->
<?php
$cd_revs = array(
  array( 5, 'Konečne spím celú noc',      'Spím na boku celý život a vždy som sa budila so stuhnutým chrbtom. Prvé ráno s vankúšom — nič. Neverila som, že je to také jednoduché.', 'Martina T.' ),
  array( 5, 'Pásik je to, čo ho odlišuje', 'Predtým mi obyčajný vankúš vypadol po pol hodine. Tento zostáva medzi kolenami až do rána, aj keď sa otočím na druhý bok.', 'Dávid K.' ),
  array( 5, 'Záchrana v tehotenstve',               'Kúpila som si ho v siedmom mesiaci. Konečne môžem ležať na ľavom boku bez tlaku v bedre a bez vrtenia pol noci.', 'Ivana P.' ),
  array( 5, 'Bedrá ma ráno už nebolia', 'Bola som skeptická, veď je to len vankúš. Rozdiel je však skutočný — vstávam bez tej stuhnutosti v panve.', 'Lucia H.' ),
);
?>
<section class="ncd-sec ncd-dark">
  <div class="ncd-wrap ncd-center">
    <h2 class="ncd-h2">Prečo sa s NORIKS Cloudom budíte inak</h2>
    <p class="ncd-sub ncd-rate"><span class="ncd-stars">★★★★★</span> Hodnotenie <strong>4,8/5</strong> tisíc spokojných zákazníkov</p>
  </div>
  <div class="ncd-wrap">
    <div class="ncd-revs">
      <?php foreach ( $cd_revs as $r ) : ?>
        <article class="ncd-rev">
          <div class="ncd-rev-stars"><?php echo str_repeat( '★', (int) $r[0] ); ?></div>
          <h3 class="ncd-rev-t"><?php echo esc_html( $r[1] ); ?></h3>
          <p class="ncd-rev-p"><?php echo esc_html( $r[2] ); ?></p>
          <div class="ncd-rev-a">
            <strong><?php echo esc_html( $r[3] ); ?></strong>
            <span class="ncd-rev-v">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2f6fd0" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
              Overený zákazník
            </span>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    
  </div>
</section>

<!-- ============ 1) Vratite jutra ============ -->
<section class="ncd-sec">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-copy">
      <p class="ncd-eyebrow">Spánok na boku</p>
      <h2 class="ncd-h2">Získajte späť rána, ktoré ste považovali za stratené</h2>
      <p>Poznáte ten pocit: zobudíte sa stuhnutí, celú noc hľadáte polohu, ktorá nebolí, alebo sa niekoľkokrát zobudíte bez dôvodu.</p>
      <p>Problém nie ste vy. Keď spíte na boku bez opory medzi kolenami, bedrá sa stáčajú, krížová oblasť zostáva napätá a svaly celú noc pracujú, aby vás stabilizovali.</p>
      <p class="ncd-strong">NORIKS Cloud drží nohy presne tak ďaleko od seba, ako treba — chrbtica zostáva vyrovnaná a telo sa konečne uvoľní.</p>
    </div>
    <div class="ncd-media"><?php echo $cd_vid('cld-vid-jutra.mp4','cld-jutra.webp','Ráno bez bolesti chrbta'); ?></div>
  </div>
</section>

<!-- ============ 3) Poravnanje ============ -->
<section class="ncd-sec ncd-dark">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-copy">
      <h2 class="ncd-h2">Zarovnanie, ktoré pocítite ráno</h2>
      <p>Keď je rozstup nôh správny, chrbtica prestane byť skrútená, panva sa vyrovná a kolená sa už netlačia o seba.</p>
      <ul class="ncd-check">
        <li>Vyrovnaná chrbtica namiesto skrútenej</li>
        <li>Vyrovnaná panva bez krútenia</li>
        <li>Oddelené kolená, bez tlaku</li>
      </ul>
    </div>
    <div class="ncd-media"><?php echo $cd_img('cld-prije-poslije.webp','Pred a po — vyrovnanie chrbtice'); ?></div>
  </div>
</section>

<!-- ============ 4) Za koga je — krugovi s naslovom i tekstom (kao na referenci) ============ -->
<?php
$cd_cases = array(
  array( 'cld-case-bok.webp',       'Spánok na boku', 'Prispôsobené vašej prirodzenej polohe.' ),
  array( 'cld-case-ledja.webp',     'Bolesť chrbta',     'Bráni nočnému stáčaniu krížov.' ),
  array( 'cld-case-kukovi.webp',    'Bolesť bedier',   'Drží bedrá vyrovnané namiesto skrútené.' ),
  array( 'cld-case-koljena.webp',   'Bolesť kolien',  'Koniec tlaku kolena o koleno.' ),
  array( 'cld-case-trudnoca.webp',  'Tehotenstvo',         'Podopiera bedrá a bruško počas tehotenstva.' ),
  array( 'cld-case-operacija.webp', 'Po operácii',  'Šetrí bedro a koleno počas rekonvalescencie.' ),
);
?>
<section class="ncd-sec">
  <div class="ncd-wrap ncd-center">
    <h2 class="ncd-h2">Navrhnuté pre to, čo vám bráni spať</h2>
    <p class="ncd-sub">Šesť situácií, kde vankúš medzi kolená prinesie najväčší rozdiel.</p>
  </div>
  <div class="ncd-wrap">
    <div class="ncd-cases">
      <?php foreach ( $cd_cases as $c ) : ?>
        <div class="ncd-case">
          <div class="ncd-case-ic"><?php echo $cd_img( $c[0], $c[1] ); ?></div>
          <h3 class="ncd-case-t"><?php echo esc_html( $c[1] ); ?></h3>
          <p class="ncd-case-p"><?php echo esc_html( $c[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 6) Stvoreno da dise ============ -->
<section class="ncd-sec ncd-dark">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-copy">
      <h2 class="ncd-h2">Vytvorený, aby dýchal</h2>
      <p>Pamäťová pena medicínskej kvality so zabudovanými perforáciami — dosť pevná, aby držala odstup, dosť mäkká, aby sa prispôsobila telu.</p>
      <ul class="ncd-check">
        <li><strong>Prateľný poťah</strong> — priedušná tkanina, šetrná k pokožke</li>
        <li><strong>Perforácie</strong> udržujú penu sviežu celú noc</li>
        <li><strong>Udrží tvar</strong> roky, nesplasne</li>
      </ul>
    </div>
    <div class="ncd-media"><?php echo $cd_img('cld-pjena.webp','Priedušná pamäťová pena s perforáciami'); ?></div>
  </div>
</section>

<!-- ============ 7) Usporedba ============ -->
<section class="ncd-sec">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-media"><?php echo $cd_img('cld-usporedba.webp','NORIKS Cloud v porovnaní s bežnými vankúšmi'); ?></div>
    <div class="ncd-copy">
      <h2 class="ncd-h2">Nie všetky vankúše medzi kolená sú rovnaké</h2>
      <ul class="ncd-vs">
        <li class="is-no"><strong>Bez pásky</strong><span>vypadne hneď, ako sa otočíte</span></li>
        <li class="is-no"><strong>Stredový otvor</strong><span>bráni cirkulácii</span></li>
        <li class="is-no"><strong>Splasne</strong><span>za pár týždňov</span></li>
        <li class="is-yes"><strong>Nastaviteľná páska</strong><span>zostane presne tam, kde má</span></li>
        <li class="is-yes"><strong>Plný, ergonomický tvar</strong><span>bez dier a prázdnych miest</span></li>
        <li class="is-yes"><strong>Pena medicínskej kvality</strong><span>udrží tvar roky</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 8) Standardi ============ -->
<section class="ncd-sec ncd-dark">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-copy">
      <h2 class="ncd-h2">Vyrobené podľa prísnych noriem</h2>
      <p>Materiály sú testované na škodlivé látky a pena je certifikovaná. Dizajn vznikol podľa švajčiarskych noriem kvality.</p>
      <ul class="ncd-check">
        <li><strong>OEKO-TEX® STANDARD 100</strong> — bez škodlivých látok</li>
        <li><strong>CertiPUR-EU</strong> — certifikovaná pamäťová pena</li>
        <li><strong>Navrhnuté vo Švajčiarsku</strong>, vyrobené podľa európskych noriem</li>
      </ul>
    </div>
    <div class="ncd-media"><?php echo $cd_img('cld-certifikati.webp','OEKO-TEX i CertiPUR-EU certifikati'); ?></div>
  </div>
</section>

<!-- ============ 10) 60 noci ============ -->
<section class="ncd-sec">
  <div class="ncd-wrap ncd-row2">
    <div class="ncd-copy">
      <p class="ncd-eyebrow">Bez rizika</p>
      <h2 class="ncd-h2">60 nocí na vyskúšanie</h2>
      <p>Vyskúšajte ho sami. Ak NORIKS Cloud nie je pre vás, vrátime vám celú sumu — bez podmienok a bez papierovania.</p>
      <a class="ncd-cta" href="#bundle-selector">Objednať NORIKS Cloud</a>
    </div>
    <div class="ncd-media"><?php echo $cd_img('cld-60-noci.webp','60 nocí na vyskúšanie'); ?></div>
  </div>
</section>

<style>
  .ncd-sec { padding: 46px 0; background: #fff; }
  .ncd-dark { background: #0e1a33; }
  .ncd-wrap { max-width: 1180px; margin: 0 auto; padding: 0 18px; }
  .ncd-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
  .ncd-h2 { font-size: clamp(24px,3.1vw,34px); font-weight: 800; color: #0e1a33; line-height: 1.2; margin: 0 0 16px; }
  .ncd-eyebrow { font-size: 12.5px; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; color: #6a86b8; margin: 0 0 8px; }
  .ncd-center { text-align: center; }
  .ncd-copy p, .ncd-sub { font-size: 16px; line-height: 1.7; color: #3a3a3a; margin: 0 0 14px; }
  .ncd-sub { max-width: 820px; margin: 0 auto 24px; }
  .ncd-strong { font-weight: 700; color: #0e1a33 !important; }
  .ncd-note { font-size: 14px !important; color: #6b6b6b !important; }
  .ncd-media img, .ncd-video { width: 100%; height: auto; display: block; border-radius: 16px; }

  /* tamne sekcije */
  .ncd-dark .ncd-h2, .ncd-dark .ncd-strong { color: #fff !important; }
  .ncd-dark .ncd-copy p, .ncd-dark .ncd-sub { color: #c6d2e6; }
  .ncd-dark .ncd-note { color: #8fa2c2 !important; }
  .ncd-dark .ncd-check li { color: #eaf0fb; }
  .ncd-dark .ncd-steps li { color: #c6d2e6; }
  .ncd-dark .ncd-vs strong { color: #fff; }
  .ncd-dark .ncd-vs span { color: #a9bad6; }
  .ncd-dark .ncd-vs li { border-bottom-color: #23324f; }

  .ncd-ph { width: 100%; aspect-ratio: 1/1; background: #e8edf6; border: 1px dashed #c9d4e6; border-radius: 16px;
            display: flex; align-items: center; justify-content: center; padding: 18px; box-sizing: border-box; }
  .ncd-ph span { font-size: 13px; line-height: 1.45; color: #8ba0c0; text-align: center; }

  /* recenzije — vrtuljak (referenca) */
  .ncd-rate { display: flex; align-items: center; justify-content: center; gap: 7px; font-size: 14.5px; }
  .ncd-stars { color: #f5a623; letter-spacing: 1px; }
  .ncd-revs { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 26px; }
  .ncd-rev { border: 1px solid #e6e6e6; border-radius: 12px; padding: 18px 18px 16px;
             background: #fff; display: flex; flex-direction: column; }
  .ncd-rev-stars { color: #f5a623; font-size: 15px; letter-spacing: 1px; margin-bottom: 8px; }
  .ncd-rev-t { font-size: 15.5px; font-weight: 800; color: #0e1a33; margin: 0 0 7px; line-height: 1.3; }
  .ncd-rev-p { font-size: 14.5px; line-height: 1.6; color: #4a4a4a; margin: 0 0 14px; flex: 1 1 auto; }
  .ncd-rev-a { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; font-size: 13.5px; color: #0e1a33; }
  .ncd-rev-v { display: inline-flex; align-items: center; gap: 4px; color: #5c6b7f; }

  /* koraci — krugovi s oznakom (referenca) */
  .ncd-steps4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px 24px; margin-top: 30px; }
  .ncd-step4 { text-align: center; }
  .ncd-step4-ic { position: relative; width: 100%; max-width: 190px; margin: 0 auto 26px; aspect-ratio: 1 / 1;
                  border-radius: 50%; overflow: visible; }
  .ncd-step4-ic img { width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%; }
  .ncd-step4-b { position: absolute; left: 50%; bottom: -12px; transform: translateX(-50%);
                 background: #2f6fd0; color: #fff; font-size: 12px; font-weight: 700; letter-spacing: .01em;
                 padding: 3px 12px; border-radius: 999px; white-space: nowrap; }
  .ncd-step4-t { font-size: clamp(15px, 1.4vw, 17px); font-weight: 800; color: #0e1a33; margin: 0 0 6px; line-height: 1.3; }
  .ncd-step4-p { font-size: 14px; line-height: 1.55; color: #40505f; margin: 0; }
  .ncd-dark .ncd-step4-t { color: #fff; }
  .ncd-dark .ncd-step4-p { color: #a9bad6; }

  /* krugovi sa slucajevima — po uzoru na referentnu stranicu */
  .ncd-cases { display: grid; grid-template-columns: repeat(3, 1fr); gap: 34px 24px; margin-top: 30px; }
  .ncd-case { text-align: center; }
  .ncd-case-ic { width: 100%; max-width: 190px; margin: 0 auto 16px; aspect-ratio: 1 / 1;
                 border-radius: 50%; overflow: hidden; }
  .ncd-case-ic img { width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%; }
  .ncd-case-t { font-size: clamp(16px, 1.5vw, 19px); font-weight: 800; color: #0e1a33; margin: 0 0 6px; line-height: 1.25; }
  .ncd-case-p { font-size: 14.5px; line-height: 1.55; color: #40505f; margin: 0; }
  .ncd-dark .ncd-case-t { color: #fff; }
  .ncd-dark .ncd-case-p { color: #a9bad6; }

  .ncd-check { list-style: none; margin: 0 0 16px; padding: 0; }
  .ncd-check li { position: relative; padding: 0 0 11px 30px; font-size: 15.5px; color: #0e1a33; line-height: 1.5; }
  .ncd-check li:before { content: "✓"; position: absolute; left: 0; top: 0; width: 20px; height: 20px; background: #2f6fd0; color: #fff; border-radius: 50%; font-size: 12px; text-align: center; line-height: 20px; }

  .ncd-steps { list-style: none; counter-reset: ncd; margin: 0 0 16px; padding: 0; }
  .ncd-steps li { counter-increment: ncd; position: relative; padding: 0 0 14px 40px; font-size: 15.5px; line-height: 1.55; color: #3a3a3a; }
  .ncd-steps li:before { content: counter(ncd); position: absolute; left: 0; top: 0; width: 26px; height: 26px; background: #2f6fd0; color: #fff; border-radius: 50%; font-size: 13px; font-weight: 700; text-align: center; line-height: 26px; }

  .ncd-vs { list-style: none; margin: 0; padding: 0; }
  .ncd-vs li { position: relative; padding: 11px 0 11px 34px; border-bottom: 1px solid #e2e8f2; }
  .ncd-vs li:last-child { border-bottom: 0; }
  .ncd-vs li:before { position: absolute; left: 0; top: 12px; width: 22px; height: 22px; border-radius: 50%; font-size: 12px; text-align: center; line-height: 22px; color: #fff; }
  .ncd-vs li.is-yes:before { content: "✓"; background: #2f6fd0; }
  .ncd-vs li.is-no:before  { content: "✕"; background: #93a3bd; }
  .ncd-vs strong { display: block; font-size: 15.5px; color: #0e1a33; }
  .ncd-vs span { display: block; font-size: 14px; color: #5a5a5a; }

  .ncd-stat { margin-top: 8px; }
  .ncd-stat strong { display: block; font-size: clamp(30px,4vw,44px); font-weight: 800; color: #fff; line-height: 1.05; }
  .ncd-stat span { display: block; font-size: 14.5px; line-height: 1.55; color: #a9bad6; margin-top: 4px; }

  .ncd-cta { display: inline-block; margin-top: 8px; background: #0e1a33; color: #fff; font-weight: 700; font-size: 16px; padding: 14px 30px; border-radius: 10px; text-decoration: none; }
  .ncd-cta:hover { background: #2f6fd0; color: #fff; }
  .ncd-dark .ncd-cta { background: #fff; color: #0e1a33; }
  .ncd-dark .ncd-cta:hover { background: #2f6fd0; color: #fff; }

  @media (max-width: 820px) {
    .ncd-revs { grid-template-columns: repeat(2, 1fr); gap: 12px; margin-top: 18px; }
    .ncd-steps4 { grid-template-columns: repeat(2, 1fr); gap: 26px 16px; margin-top: 20px; }
    .ncd-step4-ic { max-width: 140px; margin-bottom: 22px; }
    .ncd-step4-p { font-size: 13.5px; }
    .ncd-cases { grid-template-columns: repeat(2, 1fr); gap: 26px 16px; margin-top: 20px; }
    .ncd-case-ic { max-width: 140px; margin-bottom: 12px; }
    .ncd-case-p { font-size: 13.5px; }
    .ncd-sec { padding: 30px 0; }
    .ncd-row2 { grid-template-columns: 1fr; gap: 20px; }
    .ncd-row2 .ncd-media { order: -1; }
    .ncd-h2 { font-size: 1.75rem; }
    .ncd-wrap { padding: 0 9px; }
  }

  /* jastuk nema velicina */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  .woocommerce-product-details__short-description ul { list-style: none; margin: 8px 0 14px; padding-left: 0; }
  .woocommerce-product-details__short-description .ncd-tick { display: inline-block; width: 17px; text-indent: 0; color: #2f6fd0; font-weight: 800; }
  .woocommerce-product-details__short-description ul li { list-style: none; padding-left: 17px; text-indent: -17px; margin-left: 0; line-height: 1.55; margin-bottom: 7px; }
  .woocommerce-product-details__short-description p:has(+ ul) { margin-top: 20px; margin-bottom: 4px; }
</style>

<script>
(function(){
  document.querySelectorAll('a.ncd-cta[href="#bundle-selector"]').forEach(function(a){
    a.addEventListener('click', function(e){
      e.preventDefault();
      var t = document.getElementById('bundle-selector') || document.querySelector('.single_add_to_cart_button');
      if (t) t.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  });
})();
</script>
