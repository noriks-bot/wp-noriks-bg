<?php
/**
 * product-bottom: NORIKS LEAK BOXERS (orto-leak-boxers)
 * Panska spodna bielizen pre inkontinenciu — ultra-absorpcne boxerky. (SK preklad HR predlohy)
 * Prave HTML sekcie (text + slika lavo/pravo, video, statistika, testimonialy).
 * FAQ a recenzie renderuje spolocna reviews.php sekcia (nie tu).
 * Slike: img/leakboxers/ , video: img/leakboxers-videos/
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$lb  = get_template_directory_uri() . '/img/leakboxers/';
$lbv = get_template_directory_uri() . '/img/leakboxers-videos/';
?>

<!-- ============ 1) Pravy dovod (text + slika) ============ -->
<section class="lbx-sec lbx-reason">
  <div class="lbx-wrap lbx-row2">
    <div class="lbx-copy">
      <p class="lbx-eyebrow">Върнете си достойнството</p>
      <h2 class="lbx-h2">Еднократните помощни средства са <em>унизителни</em></h2>
      <p>Подложки, които се чуват, пелени, които се виждат под облеклото, и постоянен страх от преливане. Заслужавате решение, което изглежда и се усеща като обикновено бельо.</p>
      <ul class="lbx-check">
        <li><strong>250 kg</strong> отпадък годишно на един потребител</li>
        <li>Над <strong>800 €</strong> изхвърляни всяка година</li>
        <li>Еднократните продукти са обемисти и пълни с химикали</li>
      </ul>
      <a class="lbx-cta lbx-cta-solid" href="#bundle-selector">Върнете ми самочувствието →</a>
    </div>
    <div class="lbx-media"><img src="<?php echo esc_url( $lb.'boxer-navy.jpg' ); ?>" alt="NORIKS абсорбиращи боксерки — тъмносини" loading="lazy"></div>
  </div>
</section>

<!-- ============ 1b) Brand video (preko cijele širine) ============ -->
<section class="lbx-sec lbx-alt">
  <div class="lbx-wrap">
    <h2 class="lbx-h2 lbx-center">Достойнството, което заслужавате</h2>
    <p class="lbx-sub lbx-center">Вижте защо над 123 000 мъже никога не се върнаха към еднократните помощни средства.</p>
    <div class="lbx-brandvideo">
      <video src="<?php echo esc_url( $lbv.'brand.mp4' ); ?>" autoplay muted loop playsinline preload="metadata"></video>
    </div>
  </div>
</section>

<!-- ============ 2) PureDry™ 7 slojeva (slika + tekst) ============ -->
<section class="lbx-sec">
  <div class="lbx-wrap lbx-row2 lbx-rev">
    <div class="lbx-media"><img src="<?php echo esc_url( $lb.'features.png' ); ?>" alt="NORIKS PureDry — 7-слойна абсорбираща технология" loading="lazy"></div>
    <div class="lbx-copy">
      <p class="lbx-eyebrow">Технология</p>
      <h2 class="lbx-h2">NORIKS <em>PureDry™</em> — 7 слоя защита</h2>
      <p>След над 2 години разработка създадохме плат, който веднага поема и заключва влагата дълбоко в ядрото — без обем и без усещане за влага върху кожата.</p>
      <ul class="lbx-check">
        <li>7-слойна абсорбираща технология — до <strong>300 ml</strong></li>
        <li>Антибактериално бамбуково влакно</li>
        <li>Защита от преливане при крачолите</li>
        <li>Контрол на миризмата и водоотблъскващ външен слой</li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 3) Video demo — nula curenja ============ -->
<section class="lbx-sec lbx-video lbx-alt">
  <div class="lbx-wrap lbx-row2">
    <div class="lbx-copy">
      <p class="lbx-eyebrow">Разликата NORIKS</p>
      <h2 class="lbx-h2">Вижте как <em>изчезва</em>. Нула преливания.</h2>
      <p>Външният слой е водоотблъскващ, а абсорбиращото ядро задържа течността вътре. Резултатът: оставате сухи — без петна и без неприятни моменти, на работа, в пътуване и докато спите.</p>
      <div class="lbx-chips"><span>Без преливане</span><span>Без обем</span><span>Без миризма</span></div>
    </div>
    <div class="lbx-media">
      <video src="<?php echo esc_url( $lbv.'waterpour.mp4' ); ?>" autoplay muted loop playsinline preload="metadata"></video>
    </div>
  </div>
</section>

<!-- ============ 4) 3 kartice — upijaju ============ -->
<section class="lbx-sec">
  <div class="lbx-wrap">
    <p class="lbx-eyebrow lbx-center">Ще ги обикнете</p>
    <h2 class="lbx-h2 lbx-center">Перящи се <em>боксерки при инконтиненция</em></h2>
    <div class="lbx-cards">
      <figure class="lbx-card"><img src="<?php echo esc_url( $lb.'boxer-black.jpg' ); ?>" alt="Елегантна защита" loading="lazy"><figcaption>Елегантна защита</figcaption></figure>
      <figure class="lbx-card"><img src="<?php echo esc_url( $lb.'absorption.jpg' ); ?>" alt="Ненадмината абсорбция" loading="lazy"><figcaption>Ненадмината абсорбция</figcaption></figure>
      <figure class="lbx-card"><img src="<?php echo esc_url( $lb.'hydrofuge.jpg' ); ?>" alt="Хидрофобна технология" loading="lazy"><figcaption>Хидрофобна технология</figcaption></figure>
    </div>
  </div>
</section>

<!-- ============ 6) Statistika (dark) ============ -->
<section class="lbx-sec lbx-stats">
  <div class="lbx-wrap">
    <p class="lbx-eyebrow lbx-center lbx-eyebrow-d">Доказано с данни</p>
    <h2 class="lbx-h2 lbx-center lbx-h2-d">Още ли не сте <em>убедени?</em></h2>
    <div class="lbx-rings">
      <?php
      $lbx_stats = array(
        array( 'p'=>'98', 'dash'=>'172.4', 't'=>'от мъжете казват, че <strong>никога няма да се върнат</strong> към подложки или пелени' ),
        array( 'p'=>'95', 'dash'=>'167.1', 't'=>'съобщават за <strong>нулев стрес</strong> от преливане през деня' ),
        array( 'p'=>'97', 'dash'=>'170.6', 't'=>'чувстват <strong>значително по-високо самочувствие</strong>' ),
      );
      foreach ( $lbx_stats as $s ) : ?>
        <div class="lbx-ring-item">
          <svg class="lbx-ring" viewBox="0 0 64 64" aria-hidden="true">
            <circle cx="32" cy="32" r="28" fill="none" stroke="#3a4a63" stroke-width="4"/>
            <circle cx="32" cy="32" r="28" fill="none" stroke="#f4e07a" stroke-width="4" stroke-linecap="round" stroke-dasharray="<?php echo esc_attr($s['dash']); ?> 175.9" transform="rotate(-90 32 32)"/>
            <text x="32" y="39" text-anchor="middle" class="lbx-ring-t"><?php echo esc_html($s['p']); ?>%</text>
          </svg>
          <p><?php echo wp_kses_post($s['t']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 7) Usporedna tablica ============ -->
<section class="lbx-sec">
  <div class="lbx-wrap-narrow">
    <h2 class="lbx-h2 lbx-center">По-умен избор от <em>еднократните подложки</em></h2>
    <div class="lbx-cmp-scroll">
      <table class="lbx-cmp-table">
        <thead><tr><th></th><th class="lbx-us">NORIKS</th><th>Еднократни подложки</th><th>Обикновени боксерки</th></tr></thead>
        <tbody>
          <tr><td>Поема до 300 ml</td><td class="us ok">✓</td><td class="mid">частично</td><td class="no">✕</td></tr>
          <tr><td>Дискретни под облеклото</td><td class="us ok">✓</td><td class="no">✕</td><td class="ok">✓</td></tr>
          <tr><td>Перящи се и многократни</td><td class="us ok">✓</td><td class="no">✕</td><td class="ok">✓</td></tr>
          <tr><td>Защита от миризма</td><td class="us ok">✓</td><td class="mid">химикали</td><td class="no">✕</td></tr>
          <tr><td>Годишни разходи</td><td class="us ok">✓ ниски</td><td class="mid">800 €+</td><td class="ok">ниски</td></tr>
          <tr><td>Екологични</td><td class="us ok">✓</td><td class="no">✕ 250 kg отпадъци</td><td class="ok">✓</td></tr>
        </tbody>
      </table>
    </div>
    <div class="lbx-cta-wrap"><a class="lbx-cta lbx-cta-solid" href="#bundle-selector">Изберете своя пакет</a></div>
  </div>
</section>

<!-- ============ 8) Video testimonijali ============ -->
<section class="lbx-sec lbx-alt">
  <div class="lbx-wrap">
    <p class="lbx-eyebrow lbx-center">Опит на клиентите</p>
    <h2 class="lbx-h2 lbx-center">Бельо, на което вече се доверяват <em>123 000+ мъже</em></h2>
    <div class="lbx-tst-grid">
      <video src="<?php echo esc_url( $lbv.'tst1.mp4' ); ?>" autoplay muted loop playsinline preload="metadata"></video>
      <video src="<?php echo esc_url( $lbv.'tst2.mp4' ); ?>" autoplay muted loop playsinline preload="metadata"></video>
      <video src="<?php echo esc_url( $lbv.'tst3.mp4' ); ?>" autoplay muted loop playsinline preload="metadata"></video>
    </div>
    <div class="lbx-cta-wrap"><a class="lbx-cta lbx-cta-solid" href="#bundle-selector">Поръчайте дискретно →</a></div>
  </div>
</section>

<style>
  .lbx-sec{padding:48px 0;}
  .lbx-alt{background:#f5f9fa;}
  .lbx-wrap{max-width:1120px;margin:0 auto;padding:0 18px;}
  .lbx-wrap-narrow{max-width:860px;margin:0 auto;padding:0 18px;}
  .lbx-row2{display:grid;grid-template-columns:1fr 1fr;gap:44px;align-items:center;}
  .lbx-eyebrow{font-family:inherit;font-style:italic;font-size:19px;color:#1f8a9c;margin:0 0 4px;}
  .lbx-h2{font-size:clamp(23px,3.2vw,34px);font-weight:800;color:#12233b;line-height:1.15;margin:0 0 14px;}
  .lbx-h2 em{color:#1f8a9c;font-style:normal;}
  .lbx-center{text-align:center;}
  .lbx-sub{color:#5b6b7b;font-size:16px;line-height:1.6;max-width:640px;margin:0 auto 24px;}
  .lbx-brandvideo{border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(18,35,59,.12);}
  .lbx-brandvideo video{width:100%;height:auto;display:block;background:#000;}
  .lbx-copy p{font-size:16px;line-height:1.6;color:#33465a;margin:0 0 14px;}
  .lbx-media img,.lbx-media video{width:100%;height:auto;display:block;border-radius:16px;}
  .lbx-media video{background:#000;}
  .lbx-check{list-style:none;margin:0 0 22px;padding:0;}
  .lbx-check li{position:relative;padding:0 0 11px 30px;font-size:15.5px;color:#12233b;line-height:1.5;}
  .lbx-check li:before{content:"✓";position:absolute;left:0;top:0;width:20px;height:20px;background:#1f8a9c;color:#fff;border-radius:50%;font-size:12px;text-align:center;line-height:20px;}
  .lbx-cta{display:inline-block;background:#1f8a9c;color:#fff;font-weight:700;font-size:16px;padding:14px 30px;border-radius:10px;text-decoration:none;}
  .lbx-cta-solid{background:#12233b;}
  .lbx-cta-wrap{text-align:center;margin-top:28px;}
  .lbx-chips{display:flex;flex-wrap:wrap;gap:10px;}
  .lbx-chips span{background:#e8f2f4;border:1px solid #cfe4e8;border-radius:999px;padding:8px 16px;font-size:14px;color:#1f5b66;font-style:italic;}

  /* 4) cards */
  .lbx-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:24px;}
  .lbx-card{margin:0;position:relative;border-radius:16px;overflow:hidden;}
  .lbx-card img{width:100%;height:340px;object-fit:cover;display:block;}
  .lbx-card figcaption{position:absolute;left:0;right:0;bottom:0;padding:18px 16px;font-weight:800;font-size:18px;color:#fff;background:linear-gradient(transparent,rgba(0,0,0,.72));}

  /* 5) colors */
  .lbx-colors-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:22px;}
  .lbx-colors-grid figure{margin:0;}
  .lbx-colors-grid img{width:100%;height:auto;border-radius:14px;display:block;}
  .lbx-colors-grid figcaption{text-align:center;margin-top:10px;font-weight:700;color:#12233b;font-size:15px;}

  /* 6) stats dark */
  .lbx-stats{background:#12233b;}
  .lbx-eyebrow-d{color:#f4e07a;font-style:normal;font-family:inherit;text-transform:uppercase;letter-spacing:.1em;font-size:12px;font-weight:700;}
  .lbx-h2-d{color:#fff;} .lbx-h2-d em{color:#f4e07a;}
  .lbx-rings{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;margin-top:30px;}
  .lbx-ring-item{text-align:center;}
  .lbx-ring{width:120px;height:120px;filter:drop-shadow(0 0 6px rgba(244,224,122,.5));}
  .lbx-ring-t{font-size:17px;font-weight:800;fill:#fff;}
  .lbx-ring-item p{color:#c4d4e0;font-size:14.5px;line-height:1.5;margin:10px auto 0;max-width:240px;}
  .lbx-ring-item strong{color:#fff;}

  /* 7) table */
  .lbx-cmp-scroll{overflow-x:auto;border-radius:16px;box-shadow:0 10px 30px rgba(18,35,59,.12);margin-top:8px;}
  .lbx-cmp-table{width:100%;border-collapse:collapse;min-width:560px;background:#fff;}
  .lbx-cmp-table th,.lbx-cmp-table td{padding:13px 12px;text-align:center;font-size:14px;border-bottom:1px solid #eee;}
  .lbx-cmp-table thead th{font-weight:800;color:#12233b;font-size:13px;}
  .lbx-cmp-table thead th.lbx-us{background:#12233b;color:#fff;border-radius:10px 10px 0 0;}
  .lbx-cmp-table tbody td:first-child{text-align:left;font-weight:600;color:#12233b;}
  .lbx-cmp-table td.us{background:#eef6f7;font-weight:700;}
  .lbx-cmp-table td.ok{color:#1a9e5f;font-size:17px;font-weight:700;}
  .lbx-cmp-table td.no{color:#d64545;font-size:13px;}
  .lbx-cmp-table td.mid{color:#8a94a0;font-size:12.5px;}

  /* 8) testimonials */
  .lbx-tst-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:24px;}
  .lbx-tst-grid video{width:100%;height:auto;border-radius:14px;display:block;background:#000;aspect-ratio:9/16;object-fit:cover;}

  @media(max-width:860px){
    .lbx-row2{grid-template-columns:1fr;gap:22px;}
    .lbx-rev .lbx-media{order:-1;}
    .lbx-cards,.lbx-colors-grid,.lbx-rings,.lbx-tst-grid{grid-template-columns:1fr;}
    .lbx-card img{height:300px;}
  }
</style>

<script>
(function(){
  document.querySelectorAll('a.lbx-cta[href="#bundle-selector"]').forEach(function(a){
    a.addEventListener('click',function(e){e.preventDefault();var t=document.getElementById('bundle-selector')||document.querySelector('.single_add_to_cart_button');if(t)t.scrollIntoView({behavior:'smooth',block:'center'});});
  });
})();
</script>
