<?php
/**
 * product-bottom: NORIKS KneeFix — ortopedska steznica za koljeno (orto-kneefix).
 * Sekcije i redoslijed preslikani s referentne stranice, tekst na HR,
 * slike su NORIKS kreative iz img/kneefix/. Svaka sekcija ima sliku s jedne
 * i tekst s druge strane (naizmjenično) — nema sekcija koje su samo slika.
 *   1. Когато всяка стъпка стане неприятна   slika lijevo   kf-sk-3
 *   2. Може да не е само износване   slika desno    14_zglob
 *   3. Опора за активни колене         slika lijevo   08_aktivno
 *   4. 4 функции. По-стабилно усещане.    slika desno    03_funkcije
 *   5. Удобна опора в 3 стъпки          slika lijevo   04_koraki
 *   6. Повече комфорт в обикновения ден      slika desno    kf-sk-1
 *   7. Preporučeno za potporu koljena     slika lijevo   kf-sk-2
 *   8. Разликата се усеща                  slika desno    07_vs
 *   9. Какво казват нашите клиенти                3 kartice      10/11/12
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

<!-- ============ 1) Когато всяка стъпка стане неприятна ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('kf-sk-3.webp','Болка в коляното при слизане по стълби'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Когато всяка стъпка стане неприятна</h2>
      <p class="kfx-lead">В началото често е само леко опъване.</p>
      <p>После идват моменти, в които усещате коляното много по-силно:</p>
      <ul class="kfx-list">
        <li>При изправяне</li>
        <li>Na schodoch</li>
        <li>След по-дълго седене</li>
        <li>При ходене или по-дълго стоене</li>
      </ul>
      <p>Мнозина тогава автоматично започват да избягват движението. Ходят по-бавно, несъзнателно разтоварват коляното или при обичайни движения се чувстват неуверени.</p>
      <p class="kfx-strong">Проблемът е в това: колкото по-предпазливо се движите, толкова повече коляното става център на деня ви.</p>
    </div>
  </div>
</section>

<!-- ============ 2) Може да не е само износване ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">Може да не е само износване</h2>
      <p>Много обичайни обяснения говорят само за „износване". Болката в коляното обаче често се усеща по-скоро като <strong>натиск, раздразнение или нестабилност</strong>.</p>
      <p>Една от възможните причини е раздразнена синовиална обвивка — чувствителната вътрешна мембрана на колянната става. Когато тази тъкан се раздразни, коляното може да реагира по-чувствително на натоварване. Това може да се прояви като:</p>
      <ul class="kfx-inline-list">
        <li>Усещане за натиск около капачката</li>
        <li>Скованост след покой</li>
        <li>Neistota pri pohybe</li>
        <li>Чувствителност при натоварване</li>
      </ul>
      <p>Много класически ортези се опитват да решат проблема с твърда стабилизация. Твърдите ортези обаче обикновено са неудобни, плъзгат се или ограничават естественото движение. Точно затова е <strong>NORIKS KneeFix</strong> разработена различно.</p>
    </div>
    <div class="kfx-media"><?php echo $kf_img('14_zglob.jpg','Раздразнена синовиална обвивка на колянната става'); ?></div>
  </div>
</section>

<!-- ============ 3) Опора за активни колене ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('08_aktivni_SK.webp','Останете активни — без ограничения в коленете'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Опора за активни колене</h2>
      <p><strong>NORIKS KneeFix</strong> съчетава няколко функции в една гъвкава система за опора за всеки ден. Вместо тежка ортеза получавате:</p>
      <ul class="kfx-check">
        <li>Компресия, която настройвате сами</li>
        <li>Странична стабилизация</li>
        <li>Гелна подложка за разтоварване на капачката</li>
        <li>Противоплъзгащ прилепващ ръб</li>
      </ul>
      <p>Целта не е да обездвижи коляното ви. KneeFix е разработена така, че да поддържа коляното по-приятно при всекидневното движение — при ходене, на работа, на пазар или в пътуване.</p>
    </div>
  </div>
</section>

<!-- ============ 4) 4 функции. По-стабилно усещане. ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">4 функции. По-стабилно усещане.</h2>
      <p>KneeFix не прави само едно — няколко системи за опора действат едновременно:</p>
      <ul class="kfx-check">
        <li><strong>Прецизно колелце за компресия</strong> — регулируема компресия и сигурно прилягане</li>
        <li><strong>Двойни странични стабилизатори</strong> — странична стабилност на коляното</li>
        <li><strong>Гелна подложка за капачката</strong> — разтоварване на натиска и омекотяване на ударите</li>
        <li><strong>Силиконов захват срещу плъзгане</strong> — мека силиконова текстура пречи на свличането и навиването</li>
      </ul>
    </div>
    <div class="kfx-media"><?php echo $kf_img('03_funkcie_SK.webp','Четири функции на ортезата NORIKS KneeFix'); ?></div>
  </div>
</section>

<!-- ============ 5) Удобна опора в 3 стъпки ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('04_kroky_SK.webp','Удобна опора в три стъпки — изтеглете, подравнете, настройте'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Удобна опора в 3 стъпки</h2>
      <ol class="kfx-steps">
        <li><strong>Изтеглете ортезата през коляното.</strong> Издърпайте я нагоре за сигурно и удобно прилягане.</li>
        <li><strong>Подравнете гелната подложка.</strong> Разположете я центрирано около капачката.</li>
        <li><strong>Nastavte kompresiu.</strong> С въртене на колелцето настройвате опората и стабилността.</li>
      </ol>
      <p>Без сложни ремъци и настройки — готови сте за няколко секунди.</p>
    </div>
  </div>
</section>

<!-- ============ 6) Повече комфорт в обикновения ден ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">Повече комфорт в обикновения ден</h2>
      <p>Мнозина не искат тежка спортна ортеза. Искат просто:</p>
      <ul class="kfx-check">
        <li>Да ходят по-уверено</li>
        <li>По-спокойно да се качват по стълби</li>
        <li>Да стоят по-дълго</li>
        <li>Да се движат по-свободно</li>
      </ul>
      <p>NORIKS KneeFix е разработена така, че всекидневните движения да са по-приятни — без излишни ограничения. Гъвкавият материал се приспособява по-добре към деня ви и поддържа коляното там, където е нужно.</p>
      <a class="kfx-cta" href="#bundle-selector">Избери своя размер →</a>
    </div>
    <div class="kfx-media"><?php echo $kf_img('kf-sk-1.webp','KneeFix в обикновения ден — разходка, колело, тренировка'); ?></div>
  </div>
</section>

<!-- ============ 7) Препоръчана за всекидневна опора на коляното ============ -->
<section class="kfx-sec">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-media"><?php echo $kf_img('kf-sk-2.webp','Препоръчана за всекидневна опора на коляното'); ?></div>
    <div class="kfx-copy">
      <h2 class="kfx-h2">Препоръчана за всекидневна опора на коляното</h2>
      <ul class="kfx-check">
        <li>Регулируема компресионна опора</li>
        <li>Стабилизира и пази коляното</li>
        <li>Удобна за всекидневно носене</li>
      </ul>
      <p>KneeFix е предвидена като всекидневна опора, не като лечение. Ако имате остра травма или трайни оплаквания, консултирайте се с лекаря си за носенето.</p>
    </div>
  </div>
</section>

<!-- ============ 8) Разликата се усеща ============ -->
<section class="kfx-sec kfx-alt">
  <div class="kfx-wrap kfx-row2">
    <div class="kfx-copy">
      <h2 class="kfx-h2">Разликата се усеща</h2>
      <p>Традиционните ортези често решават проблема, като обездвижват коляното. KneeFix върви по друг път — подкрепя движението, вместо да го блокира.</p>
      <ul class="kfx-check">
        <li>Естествено ходене вместо скованост при движение</li>
        <li>Отпусната стойка вместо неудобно положение</li>
        <li>Свобода на движение и комфорт вместо видимо натоварване на коляното</li>
      </ul>
      <a class="kfx-cta" href="#bundle-selector">Поръчай KneeFix</a>
    </div>
    <div class="kfx-media"><?php echo $kf_img('07_vs_SK.webp','Ортеза за коляно NORIKS в сравнение с традиционна ортеза'); ?></div>
  </div>
</section>

<!-- ============ 9) Какво казват нашите клиенти ============ -->
<section class="kfx-sec kfx-revs">
  <div class="kfx-wrap">
    <h2 class="kfx-h2 kfx-center">Какво казват нашите клиенти</h2>
    <p class="kfx-sub kfx-center"><strong>Хиляди клиенти вече носят NORIKS KneeFix всеки ден</strong> защото е разработена така, че да поддържа коляното прицелено — вместо излишно да ограничава движението или краткотрайно да прикрива оплакванията.</p>
    <div class="kfx-rev-grid">
      <?php foreach ( array(
        array( '10_review-1.jpg', 'Най-накрая по-стабилно ходене', 'Пробвал съм вече няколко ортези, но бяха или твърде твърди, или постоянно се плъзгаха. Тази стои усетимо по-удобно и дава на коляното много повече стабилност при ходене и по стълби.', 'Damir P.' ),
        array( '11_review-3.jpg', 'Viac istoty na schodoch', 'Стълбите бяха за мен години мъчение, защото коляното ми се струваше нестабилно. Откакто нося KneeFix, се чувствам много по-уверен. Почти не се плъзга дори при по-дълги разходки.', 'Sanja M.' ),
        array( '12_review-6.jpg', 'Приятна в обикновения ден', 'Нося я на работа и не мислех, че ще е толкова удобна. Материалът е гъвкав, компресията се настройва лесно, а под панталона почти не се вижда.', 'Vesna N.' ),
      ) as $rv ) : ?>
        <article class="kfx-rev">
          <div class="kfx-rev-img"><?php echo $kf_img( $rv[0], 'Клиент носи ортезата NORIKS KneeFix' ); ?></div>
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
