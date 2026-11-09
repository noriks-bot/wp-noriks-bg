<?php
/**
 * product-bottom: NORIKS RedRelief — terapija crvenim svjetlom za zapešće (orto-red).
 * Sekcije prate original (kovaria.com/products/therawrap) u istom redoslijedu:
 *   1) Upoznajte NORIKS RedRelief + statistike
 *   2) Tri jednostavna koraka (tri videa, kao na originalu)
 *   3) Dvije valne duljine / 48 LED dioda (slika lijevo-desno)
 *   4) Za koje tegobe (slika + popis)
 *   5) Što možete očekivati — vremenska crta (Tjedan 1 / 2-3 / 4-6 / 8+)
 *   6) Zašto odabrati NORIKS RedRelief — usporedba s drugim uređajima
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rd      = get_template_directory_uri() . '/img/red/';
$rd_path = get_template_directory() . '/img/red/';

$rd_img = function( $file, $alt, $cls = '' ) use ( $rd, $rd_path ) {
  if ( ! file_exists( $rd_path . $file ) ) { return ''; }
  return '<img class="' . esc_attr( $cls ) . '" src="' . esc_url( $rd . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
$rd_vid = function( $file, $poster, $alt ) use ( $rd, $rd_path ) {
  if ( ! file_exists( $rd_path . $file ) ) { return ''; }
  return '<video class="nrd-video" autoplay muted loop playsinline preload="metadata" '
       . 'poster="' . esc_url( $rd . $poster ) . '" aria-label="' . esc_attr( $alt ) . '">'
       . '<source src="' . esc_url( $rd . $file ) . '" type="video/mp4"></video>';
};
?>

<!-- 1) UPOZNAJTE NORIKS RedRelief -->
<section class="nrd-intro">
  <div class="nrd-wrap">
    <div class="nrd-intro__top">
      <div class="nrd-intro__img"><?php echo $rd_img( 'red-meet.jpg', 'Zápästný pás NORIKS RedRelief s červeným svetlom' ); ?></div>
      <div class="nrd-intro__text">
        <p class="nrd-kicker">Spoznajte NORIKS RedRelief</p>
        <h2 class="nrd-h2">Pomoc, ktorá mieri na príčinu, nielen na príznak.</h2>
        <p>NORIKS RedRelief privádza červené a infračervené svetlo dvojitej vlnovej dĺžky presne do oblasti stredného nervu — tam, kde vzniká zápal stojaci za bolesťou zápästia.</p>
        <p>Tá istá terapia červeným svetlom bola skúmaná z hľadiska podpory tvorby bunkovej energie (ATP), obnovy prietoku krvi a prísunu kyslíka do tkaniva — aby telo mohlo robiť svoju prácu.</p>
      </div>
    </div>

    <div class="nrd-stats">
      <div class="nrd-stat"><div class="nrd-stat__big">87%</div><div class="nrd-stat__lab">Menej mravčenia a tŕpnutia</div><div class="nrd-stat__sub">Do prvých 30 dní*</div></div>
      <div class="nrd-stat"><div class="nrd-stat__big">92%</div><div class="nrd-stat__lab">Lepší spánok celú noc</div><div class="nrd-stat__sub">Po 4+ týždňoch každodenného používania*</div></div>
      <div class="nrd-stat"><div class="nrd-stat__big">94%</div><div class="nrd-stat__lab">Odporučilo by NORIKS RedRelief</div><div class="nrd-stat__sub">Priateľom a rodine*</div></div>
      <div class="nrd-stat"><div class="nrd-stat__big">71%</div><div class="nrd-stat__lab">Odložilo alebo sa vyhlo zákroku</div><div class="nrd-stat__sub">Pre syndróm karpálneho tunela*</div></div>
    </div>
    <p class="nrd-foot">*Podľa skúseností zákazníkov, ktorí NORIKS RedRelief používajú pravidelne. Výsledky sa líšia od človeka k človeku.</p>
  </div>
</section>

<!-- 2) TRI JEDNOSTAVNA KORAKA (videi) -->
<section class="nrd-steps">
  <div class="nrd-wrap">
    <p class="nrd-kicker nrd-center">Jednoduchšie to už nejde</p>
    <h2 class="nrd-h2 nrd-center">Tri kroky k sedeniu</h2>
    <p class="nrd-sub">Bez objednávania a bez nastavovania. Len nasadíte, stlačíte a uvoľníte sa.</p>
    <div class="nrd-steps__grid">
      <div class="nrd-steps__step">
        <div class="nrd-steps__media"><span class="nrd-steps__num">1</span><?php echo $rd_vid( 'red-vid-1.mp4', 'red-vid-1.jpg', 'Nasadenie pásu na zápästie' ); ?></div>
        <h4>Nasaďte pás</h4>
        <p>Prevlečte palec cez otvor a pripevnite pásik cez chrbát ruky.</p>
      </div>
      <div class="nrd-steps__step">
        <div class="nrd-steps__media"><span class="nrd-steps__num">2</span><?php echo $rd_vid( 'red-vid-2.mp4', 'red-vid-2.jpg', 'Spustenie sedenia jedným tlačidlom' ); ?></div>
        <h4>Stlačte tlačidlo</h4>
        <p>Jedno stlačenie spustí 15-minútové sedenie. Vyberte úroveň výkonu a režim.</p>
      </div>
      <div class="nrd-steps__step">
        <div class="nrd-steps__media"><span class="nrd-steps__num">3</span><?php echo $rd_vid( 'red-vid-3.mp4', 'red-vid-3.jpg', 'Uvoľnenie počas terapie' ); ?></div>
        <h4>Uvoľnite sa</h4>
        <p>Nechajte svetlo pracovať. Raz denne — výsledok prináša pravidelnosť.</p>
      </div>
    </div>
  </div>
</section>

<!-- 3) DVIJE VALNE DULJINE / 48 LED DIODA -->
<section class="nrd-why">
  <div class="nrd-wrap">

  <div class="nrd-why__row nrd-why__row--reverse">
    <div class="nrd-why__imgwrap"><?php echo $rd_img( 'red-valne.jpg', 'Vnútro pásu so svietiacimi červenými LED diódami', 'nrd-why__img' ); ?></div>
    <div class="nrd-why__content">
      <h2 class="nrd-h2">Dve vlnové dĺžky. Dvojitý dosah.</h2>
      <p class="nrd-why__body">NORIKS RedRelief spája dve najviac skúmané vlnové dĺžky v terapii červeným svetlom, takže jedno sedenie pokryje povrch aj hĺbku.</p>
      <ul class="nrd-checks">
        <li><span class="nrd-ck"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><span><strong>Červené svetlo 660 nm</strong> — upokojuje povrchový zápal</span></li>
        <li><span class="nrd-ck"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><span><strong>Infračervené 850 nm</strong> — dosiahne stredný nerv</span></li>
      </ul>
    </div>
  </div>

  <div class="nrd-why__row">
    <div class="nrd-why__imgwrap"><?php echo $rd_img( 'red-led.jpg', '48 dvojitých LED diód v páse', 'nrd-why__img' ); ?></div>
    <div class="nrd-why__content">
      <h2 class="nrd-h2">48 dvojitých LED diód.</h2>
      <p class="nrd-why__body">Diódy sú rozmiestnené po celej vnútornej strane ľahkého pásu, ktorý kopíruje tvar zápästia — takže každé sedenie pokryje celú oblasť, nie len jeden bod.</p>
      <ul class="nrd-checks">
        <li><span class="nrd-ck"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><span><strong>48 LED diód</strong> (červené + infračervené)</span></li>
        <li><span class="nrd-ck"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><span><strong>3 úrovne výkonu</strong> · 4 režimy</span></li>
        <li><span class="nrd-ck"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><span><strong>Iba 126 g</strong> — dosť ľahký na každý deň</span></li>
      </ul>
    </div>
  </div>

  </div>
</section>

<!-- 4) ZA KOJE TEGOBE -->
<section class="nrd-pain">
  <div class="nrd-wrap nrd-pain__wrap">
    <div class="nrd-pain__text">
      <p class="nrd-kicker">Pre koho je NORIKS RedRelief</p>
      <h2 class="nrd-h2">Pre ruky, ktoré pracujú celý deň.</h2>
      <p class="nrd-pain__body">Bolesť zápästia málokedy prichádza sama. NORIKS RedRelief je určený tým, ktorí každý deň zaťažujú ruku a zápästie — pri klávesnici, za volantom, v kaderníctve, na stavbe alebo v záhrade.</p>
      <ul class="nrd-pills">
        <li>Syndróm karpálneho tunela</li><li>Zápal šliach</li><li>Artritída</li><li>Bolesti ruky a zápästia</li>
      </ul>
      <p class="nrd-pain__note">Prístroj nenahrádza lekárske vyšetrenie ani predpísanú liečbu.</p>
    </div>
    <div class="nrd-pain__img"><?php echo $rd_img( 'red-bolovi.jpg', 'Terapia červeným svetlom na zápästí' ); ?></div>
  </div>
</section>

<!-- 5) ŠTO MOŽETE OČEKIVATI -->
<section class="nrd-tl">
  <div class="nrd-wrap">
  <h2 class="nrd-h2 nrd-center">Čo môžete očakávať</h2>
  <p class="nrd-sub">Výsledky si vyžadujú čas. Touto cestou ide väčšina používateľov.</p>

  <div class="nrd-tl__wrap">
    <div class="nrd-tl__rail"><div class="nrd-tl__fill"></div></div>

    <div class="nrd-tl__step nrd-tl__step--right">
      <div class="nrd-tl__node"><svg viewBox="0 0 24 24" fill="none"><path d="M5 12.5l4.5 4.5L19 7.5" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
      <div class="nrd-tl__content">
        <div class="nrd-tl__eyebrow">1. týždeň</div>
        <h3 class="nrd-tl__name">Prvé známky úľavy</h3>
        <ul><li>Zápal okolo stredného nervu začína ustupovať</li><li>Zápästie pôsobí ľahšie a odľahčene</li><li>Menej rannej stuhnutosti</li><li>Ľahšie uchopenie šálky alebo volantu</li></ul>
      </div>
    </div>

    <div class="nrd-tl__step nrd-tl__step--left">
      <div class="nrd-tl__node"><svg viewBox="0 0 24 24" fill="none"><path d="M5 12.5l4.5 4.5L19 7.5" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
      <div class="nrd-tl__content">
        <div class="nrd-tl__eyebrow">2. – 3. týždeň</div>
        <h3 class="nrd-tl__name">Denná bolesť ustupuje</h3>
        <ul><li>Mravčenie a tŕpnutie sa citeľne zmierňujú</li><li>Sila stisku sa zlepšuje</li><li>Písanie a otváranie pohárov idú ľahšie</li><li>Menej siahania po tabletkách proti bolesti</li></ul>
      </div>
    </div>

    <div class="nrd-tl__step nrd-tl__step--right">
      <div class="nrd-tl__node"><svg viewBox="0 0 24 24" fill="none"><path d="M5 12.5l4.5 4.5L19 7.5" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
      <div class="nrd-tl__content">
        <div class="nrd-tl__eyebrow">4. – 6. týždeň</div>
        <h3 class="nrd-tl__name">Spánok celú noc</h3>
        <ul><li>Stŕpnuté ruky vás už nebudia</li><li>Prebudenie bez stuhnutých prstov</li><li>Návrat k záľubám — gitara, pletenie, záhrada</li><li>Vracia sa dôvera vo vlastné ruky</li></ul>
      </div>
    </div>

    <div class="nrd-tl__step nrd-tl__step--left">
      <div class="nrd-tl__node"><svg viewBox="0 0 24 24" fill="none"><path d="M5 12.5l4.5 4.5L19 7.5" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
      <div class="nrd-tl__content">
        <div class="nrd-tl__eyebrow">8.+ týždeň</div>
        <h3 class="nrd-tl__name">Dlhodobé zdravie ruky</h3>
        <ul><li>Funkcia zápästia sa naďalej zlepšuje</li><li>Bolesť sa stáva spomienkou, nie každodennosťou</li><li>Terapia bez tabliet a bez zákroku</li><li>15-minútové sedenie ostáva súčasťou dňa</li></ul>
      </div>
    </div>
  </div>
  </div>
</section>


<!-- 6) ZAŠTO ODABRATI NORIKS RedRelief -->
<section class="nrd-vs">
  <div class="nrd-wrap nrd-vs__inner">

    <h2 class="nrd-vs__title-mobile">Prečo NORIKS RedRelief<sup>&reg;</sup>?</h2>

    <div class="nrd-vs__cards">

      <div class="nrd-vs__card nrd-vs__card--us">
        <div class="nrd-vs__imgwrap"><?php echo $rd_img( 'red-vs.jpg', 'NORIKS RedRelief', 'nrd-vs__img' ); ?></div>
        <div class="nrd-vs__card-title">NORIKS RedRelief</div>
        <div class="nrd-vs__list">
          <div class="nrd-vs__row"><span class="nrd-vs__ic nrd-vs__ic--yes">&#10003;</span>Dvojitá vlnová dĺžka</div>
          <div class="nrd-vs__row"><span class="nrd-vs__ic nrd-vs__ic--yes">&#10003;</span>48 dvojitých LED diód</div>
          <div class="nrd-vs__row"><span class="nrd-vs__ic nrd-vs__ic--yes">&#10003;</span>3 úrovne výkonu, 4 režimy</div>
          <div class="nrd-vs__row"><span class="nrd-vs__ic nrd-vs__ic--yes">&#10003;</span>Bezdrôtový a nabíjateľný</div>
          <div class="nrd-vs__row"><span class="nrd-vs__ic nrd-vs__ic--yes">&#10003;</span>Tvarovaný na ruku</div>
        </div>
      </div>

      <div class="nrd-vs__card nrd-vs__card--them">
        <div class="nrd-vs__card-title nrd-vs__card-title--dark">Iné prístroje</div>
        <div class="nrd-vs__list">
          <div class="nrd-vs__row nrd-vs__row--dark"><span class="nrd-vs__ic nrd-vs__ic--no">&#10007;</span>Len jedna vlnová dĺžka</div>
          <div class="nrd-vs__row nrd-vs__row--dark"><span class="nrd-vs__ic nrd-vs__ic--no">&#10007;</span>Menej diód a pokrytia</div>
          <div class="nrd-vs__row nrd-vs__row--dark"><span class="nrd-vs__ic nrd-vs__ic--no">&#10007;</span>Pevná intenzita</div>
          <div class="nrd-vs__row nrd-vs__row--dark"><span class="nrd-vs__ic nrd-vs__ic--no">&#10007;</span>Závislé od zásuvky</div>
          <div class="nrd-vs__row nrd-vs__row--dark"><span class="nrd-vs__ic nrd-vs__ic--no">&#10007;</span>Univerzálny strih</div>
        </div>
      </div>

    </div>

    <div class="nrd-vs__copy">
      <h2 class="nrd-vs__title">Prečo NORIKS RedRelief<sup>&reg;</sup>?</h2>
      <div class="nrd-vs__bullets">
        <div class="nrd-vs__bullet"><span class="nrd-vs__bc">&#10003;</span><span>Tvarovaný priamo na ruku a zápästie</span></div>
        <div class="nrd-vs__bullet"><span class="nrd-vs__bc">&#10003;</span><span>Dvojitá vlnová dĺžka v jednom sedení</span></div>
        <div class="nrd-vs__bullet"><span class="nrd-vs__bc">&#10003;</span><span>Bezdrôtovo, kdekoľvek, 15 minút denne</span></div>
        <div class="nrd-vs__bullet"><span class="nrd-vs__bc">&#10003;</span><span>Až 4 ošetrenia na jedno nabitie</span></div>
      </div>
      <a class="nrd-vs__cta" href="#bundle-selector">Vyskúšajte bez rizika</a>
      <div class="nrd-vs__guar"><span class="nrd-vs__shield">&#128737;</span> 30 dní na vrátenie peňazí</div>
    </div>

  </div>
</section>


<style>
/* ===== NORIKS RedRelief — why sekcije (paleta preuzeta s originala) ===== */
.nrd-intro,.nrd-why,.nrd-pain,.nrd-tl,.nrd-steps,.nrd-vs{
  font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Arial,sans-serif;
  color:#231b16; box-sizing:border-box;
}
.nrd-intro *,.nrd-why *,.nrd-pain *,.nrd-tl *,.nrd-steps *,.nrd-vs *{ box-sizing:border-box; }
.nrd-wrap{ width:100%; max-width:1240px; margin:0 auto; padding:0 24px; }
/* enak navpicni ritem za vse sekcije */
.nrd-intro,.nrd-why,.nrd-pain,.nrd-tl,.nrd-steps,.nrd-vs{ padding:78px 0; }
/* enak videz slik v vseh sekcijah */
.nrd-intro__img,.nrd-pain__img,.nrd-why__img,.nrd-steps__media,.nrd-vs__imgwrap{
  border-radius:12px; overflow:hidden;
  box-shadow:0 1px 2px rgba(28,24,23,.04),0 10px 34px rgba(28,24,23,.07);
}
.nrd-h2{ font-size:clamp(26px,3.4vw,40px); font-weight:800; line-height:1.12; letter-spacing:-.01em; margin:0 0 14px; color:#231b16; }
.nrd-kicker{ font-size:13px; font-weight:800; letter-spacing:.14em; text-transform:uppercase; color:#c3192a; margin:0 0 12px; }
.nrd-center{ text-align:center; }
.nrd-sub{ text-align:center; font-size:16px; color:#6b625d; max-width:56ch; margin:0 auto 46px; line-height:1.55; }

/* 1) intro */
.nrd-intro{ background:#f0e9db; }
.nrd-intro__top{ display:grid; grid-template-columns:1fr 1.08fr; gap:50px; align-items:center; }
.nrd-intro__img{ aspect-ratio:4/3.4; background:#e8ddd4; }
.nrd-intro__img img{ width:100%; height:100%; object-fit:cover; display:block; }
.nrd-intro__text p{ font-size:16px; color:#6b625d; margin:0 0 10px; line-height:1.6; }
.nrd-stats{ display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-top:54px; border-top:1px solid #d4c9bc; padding-top:40px; }
.nrd-stat{ text-align:center; }
.nrd-stat__big{ font-size:44px; font-weight:800; color:#c3192a; line-height:1; }
.nrd-stat__lab{ font-size:14px; font-weight:700; margin-top:8px; }
.nrd-stat__sub{ font-size:12px; color:#6b625d; margin-top:3px; }
.nrd-foot{ font-size:11.5px; color:#9a8e86; font-style:italic; margin-top:20px; text-align:center; }

/* 2) why */
.nrd-why{ background:#f0e9db; }
.nrd-why__row{ display:grid; grid-template-columns:1fr 1fr; gap:50px; align-items:center; }
.nrd-why__row + .nrd-why__row{ margin-top:64px; }
.nrd-why__row--reverse{ direction:rtl; }
.nrd-why__row--reverse > *{ direction:ltr; }
.nrd-why__imgwrap{ background:#efe9e2; }
.nrd-why__img{ width:100%; aspect-ratio:4/3.4; object-fit:cover; display:block; }
.nrd-why__body{ font-size:15px; color:#6b625d; line-height:1.7; margin:0 0 24px; }
.nrd-checks{ list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:14px; }
.nrd-checks li{ display:flex; align-items:flex-start; gap:10px; font-size:15px; line-height:1.5; }
.nrd-ck{ flex:none; width:22px; height:22px; border-radius:50%; background:#c3192a; color:#fff; display:flex; align-items:center; justify-content:center; margin-top:1px; }
.nrd-ck svg{ width:12px; height:12px; }

/* 3) tegobe */
.nrd-pain{ background:#faf7f3; }
.nrd-pain__wrap{ display:grid; grid-template-columns:1fr 1fr; gap:50px; align-items:center; }
.nrd-pain__body{ font-size:16px; color:#6b625d; line-height:1.6; margin:0 0 22px; max-width:48ch; }
.nrd-pills{ list-style:none; padding:0; margin:0 0 18px; display:flex; flex-wrap:wrap; gap:10px; }
.nrd-pills li{ background:#fff; border:1px solid #d4c9bc; border-radius:999px; padding:9px 16px; font-size:14px; font-weight:700; }
.nrd-pills li::before{ content:'●'; color:#c3192a; font-size:10px; margin-right:8px; vertical-align:middle; }
.nrd-pain__note{ font-size:12px; color:#9a8e86; font-style:italic; margin:0; }
.nrd-pain__img{ background:#e8ddd4; }
.nrd-pain__img img{ width:100%; aspect-ratio:4/3.4; object-fit:cover; display:block; }

/* 4) vremenska crta */
.nrd-tl{ background:radial-gradient(circle,#d4c9bc 1px,transparent 1px) 0 0/20px 20px,#f0e9db; }
.nrd-tl__wrap{ position:relative; margin:0 auto; }
.nrd-tl__rail{ position:absolute; top:0; bottom:0; left:50%; width:3px; background:#d4c9bc; transform:translateX(-50%); border-radius:2px; overflow:hidden; }
.nrd-tl__fill{ position:absolute; top:0; left:0; right:0; height:0; background:#c3192a; border-radius:2px; transition:height .15s linear; }
.nrd-tl__step{ position:relative; display:grid; grid-template-columns:1fr 56px 1fr; align-items:start; margin-bottom:56px; }
.nrd-tl__step:last-child{ margin-bottom:0; }
.nrd-tl__node{ grid-column:2; grid-row:1; width:44px; height:44px; border-radius:50%; background:#d4c9bc; display:flex; align-items:center; justify-content:center; margin:0 auto; z-index:2; box-shadow:0 0 0 6px #f0e9db; transition:background .4s ease,transform .4s cubic-bezier(.34,1.56,.64,1); }
.nrd-tl__node svg{ width:22px; height:22px; opacity:.7; transition:opacity .4s ease; }
.nrd-tl__step.is-active .nrd-tl__node{ background:#c3192a; transform:scale(1.08); }
.nrd-tl__step.is-active .nrd-tl__node svg{ opacity:1; }
.nrd-tl__content{ padding:0 8px; opacity:.55; transition:opacity .4s ease; }
.nrd-tl__step.is-active .nrd-tl__content{ opacity:1; }
.nrd-tl__step--right .nrd-tl__content{ grid-column:3; grid-row:1; padding-left:24px; text-align:left; }
.nrd-tl__step--left  .nrd-tl__content{ grid-column:1; grid-row:1; padding-right:24px; text-align:right; }
.nrd-tl__eyebrow{ font-size:12px; color:#c3192a; font-weight:800; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:4px; }
.nrd-tl__name{ font-size:19px; font-weight:800; margin:0 0 10px; }
.nrd-tl__content ul{ list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:6px; }
.nrd-tl__content li{ font-size:14.5px; color:#6b625d; line-height:1.5; }

/* 5) koraci */
.nrd-steps{ background:#faf7f3; }
.nrd-steps__grid{ display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
.nrd-steps__step{ text-align:center; }
.nrd-steps__media{ position:relative; aspect-ratio:1/1; background:#e8ddd0; margin-bottom:18px; }
.nrd-steps__media .nrd-video{ width:100%; height:100%; object-fit:cover; display:block; pointer-events:none; }
.nrd-steps__num{ position:absolute; top:14px; left:14px; width:38px; height:38px; border-radius:50%; background:#c3192a; color:#fff; font-size:18px; font-weight:800; display:flex; align-items:center; justify-content:center; z-index:2; }
.nrd-steps__step h4{ font-size:18px; font-weight:800; margin:0 0 6px; }
.nrd-steps__step p{ font-size:14.5px; color:#6b625d; max-width:34ch; margin:0 auto; line-height:1.5; }

/* 6) usporedba (postavitev kot na originalu) */
.nrd-vs{ background:#faf7f3; }
.nrd-vs__inner{ display:grid; grid-template-columns:auto auto; gap:64px; align-items:center; justify-content:center; }
.nrd-vs__title-mobile{ display:none; }
.nrd-vs__cards{ display:grid; grid-template-columns:200px 190px; gap:14px; align-items:start; }
.nrd-vs__card{ border-radius:14px; }
.nrd-vs__card--us{ position:relative; background:#241C16; color:#fff; padding:52px 18px 20px; box-shadow:0 18px 44px rgba(28,24,23,.18); }
.nrd-vs__card--them{ background:#fff; border:1px solid #e6ddd3; padding:20px 18px; margin-top:34px; }
.nrd-vs__imgwrap{ position:absolute; top:-30px; left:50%; transform:translateX(-50%); width:82px; height:82px;
  border-radius:10px; overflow:hidden; background:#fff; border:5px solid #fff; box-shadow:0 6px 18px rgba(28,24,23,.18); }
.nrd-vs__img{ width:100%; height:100%; object-fit:cover; display:block; }
.nrd-vs__card-title{ font-size:15px; font-weight:800; text-align:center; margin:0 0 6px; letter-spacing:-.01em; }
.nrd-vs__card-title--dark{ color:#241C16; }
.nrd-vs__list{ display:flex; flex-direction:column; }
.nrd-vs__row{ display:flex; align-items:center; gap:9px; font-size:12.5px; font-weight:700; line-height:1.35;
  padding:11px 0; border-bottom:1px solid rgba(255,255,255,.09); }
.nrd-vs__row:last-child{ border-bottom:0; padding-bottom:2px; }
.nrd-vs__row--dark{ color:#6b625d; font-weight:700; border-bottom:1px solid #efe7dd; }
.nrd-vs__ic{ flex:none; width:19px; height:19px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:10px; }
.nrd-vs__ic--yes{ background:#c3192a; color:#fff; }
.nrd-vs__ic--no{ background:#f1e9df; color:#b4a79a; }
.nrd-vs__copy{ width:100%; max-width:440px; }
.nrd-vs__title{ font-size:clamp(26px,3vw,34px); font-weight:800; letter-spacing:-.01em; margin:0 0 20px; color:#241C16; }
.nrd-vs__title sup{ font-size:.4em; top:-1.05em; margin-left:3px; }
.nrd-vs__bullets{ display:flex; flex-direction:column; gap:13px; margin:0 0 26px; }
.nrd-vs__bullet{ display:flex; align-items:flex-start; gap:10px; font-size:14.5px; color:#241C16; line-height:1.45; }
.nrd-vs__bc{ flex:none; color:#c3192a; font-weight:800; font-size:15px; line-height:1.35; }
.nrd-vs__cta{ display:block; width:100%; text-align:center; background:#b32d19; color:#fff !important;
  font-size:15px; font-weight:800; letter-spacing:.01em; padding:16px 20px; border-radius:6px; border:0;
  text-decoration:none; cursor:pointer; transition:background .18s ease; }
.nrd-vs__cta:hover{ background:#9c2614; color:#fff !important; }
.nrd-vs__guar{ display:flex; align-items:center; gap:8px; font-size:12.5px; font-weight:700; color:#6b625d; margin-top:12px; }
.nrd-vs__shield{ font-size:14px; }


/* ===== mobilno ===== */
@media (max-width:880px){
  .nrd-intro__top{ grid-template-columns:1fr; gap:30px; }
  .nrd-pain__wrap{ grid-template-columns:1fr; gap:28px; }
  .nrd-vs__inner{ grid-template-columns:1fr; gap:30px; justify-items:center; }
  .nrd-vs__title-mobile{ display:block; text-align:center; font-size:clamp(24px,6vw,30px); font-weight:800; letter-spacing:-.01em; margin:0 0 4px; }
  .nrd-vs__title-mobile sup{ font-size:.4em; top:-1.05em; margin-left:3px; }
  .nrd-vs__title{ display:none; }
  .nrd-vs__copy{ max-width:420px; width:100%; }
}
@media (max-width:760px){
  .nrd-intro,.nrd-why,.nrd-pain,.nrd-tl,.nrd-steps,.nrd-vs{ padding:52px 0; }
  .nrd-stats{ grid-template-columns:repeat(2,1fr); gap:28px 18px; margin-top:40px; padding-top:32px; }
  .nrd-why__row{ grid-template-columns:1fr; gap:24px; }
  .nrd-why__row + .nrd-why__row{ margin-top:44px; }
  .nrd-why__row--reverse{ direction:ltr; }
  .nrd-tl__rail{ left:22px; }
  .nrd-tl__step{ grid-template-columns:44px 1fr; margin-bottom:34px; }
  .nrd-tl__node{ grid-column:1; }
  .nrd-tl__step--right .nrd-tl__content,
  .nrd-tl__step--left  .nrd-tl__content{ grid-column:2; grid-row:1; text-align:left; padding:0 0 0 18px; }
  .nrd-steps__grid{ grid-template-columns:1fr; gap:32px; }
  .nrd-vs .nrd-wrap{ padding-left:14px; padding-right:14px; }
  .nrd-vs__cards{ grid-template-columns:1fr 1fr; gap:10px; width:100%; max-width:none; }
  .nrd-vs__card--us{ padding:46px 12px 14px; }
  .nrd-vs__card--them{ padding:14px 12px; margin-top:26px; }
  .nrd-vs__row{ font-size:12px; padding:9px 0; gap:8px; }
  .nrd-vs__copy{ max-width:none; }
}

/* kratek opis izdelka: kljukice namesto pik */
.woocommerce div.product .woocommerce-product-details__short-description ul,
.woocommerce-product-details__short-description ul{
  list-style:none !important; margin:6px 0 12px !important; padding-left:0 !important; }
.woocommerce div.product .woocommerce-product-details__short-description ul li,
.woocommerce-product-details__short-description ul li{
  list-style:none !important; padding-left:0 !important; text-indent:0 !important; margin:0 0 4px !important;
  line-height:1.4 !important; display:flex !important; align-items:flex-start; gap:8px; }
.woocommerce-product-details__short-description ul li::marker{ content:"" !important; }
.woocommerce-product-details__short-description ul li::before{ content:none !important; }
.woocommerce-product-details__short-description .nhm-tick{
  flex:0 0 auto !important; display:inline-block !important; color:#22c55e !important;
  font-weight:800 !important; font-size:17px !important; line-height:1.3 !important; }
.woocommerce-product-details__short-description .nhm-red{
  color:#c3192a !important; font-weight:700 !important; font-size:15px !important; margin:8px 0 12px !important; }
</style>

<script>
(function(){
  var tl = document.querySelector('.nrd-tl__wrap');
  if(!tl) return;
  var fill  = tl.querySelector('.nrd-tl__fill');
  var steps = [].slice.call(tl.querySelectorAll('.nrd-tl__step'));
  function upd(){
    var r = tl.getBoundingClientRect();
    var mid = window.innerHeight * 0.62;
    var p = (mid - r.top) / r.height;
    p = Math.max(0, Math.min(1, p));
    fill.style.height = (p * 100) + '%';
    steps.forEach(function(s){
      var n = s.querySelector('.nrd-tl__node').getBoundingClientRect();
      s.classList.toggle('is-active', n.top + n.height / 2 <= mid);
    });
  }
  window.addEventListener('scroll', upd, {passive:true});
  window.addEventListener('resize', upd);
  upd();
})();
</script>
