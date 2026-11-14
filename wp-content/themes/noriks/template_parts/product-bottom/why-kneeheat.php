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
    <p class="nkh-eyebrow nkh-center">Как работи</p>
    <h2 class="nkh-h2 nkh-center">Облекчение в 3 лесни стъпки</h2>
    <p class="nkh-lead nkh-center">Без настройки, без приложение, без сложна рутина. Поставете, натиснете бутона и продължете с деня си.</p>
    <div class="nkh-steps3">
      <div class="nkh-step3">
        <?php echo $kh_vid( 'kh-step-1.mp4', 'kh-step-1.jpg', 'Поставяне на наколенката' ); ?>
        <div class="nkh-step3-txt">
          <p class="nkh-step3-h"><span>1</span> Поставете наколенката</p>
          <p>Обвийте я около коляното и затегнете лентите. Отнема 20 секунди и работи на двата крака.</p>
        </div>
      </div>
      <div class="nkh-step3">
        <?php echo $kh_vid( 'kh-step-2.mp4', 'kh-step-2.jpg', 'Пускане на сесията с един бутон' ); ?>
        <div class="nkh-step3-txt">
          <p class="nkh-step3-h"><span>2</span> Натиснете бутона</p>
          <p>Един бутон пуска и трите терапии — топлина, компресия и вибрации — точно за 12 минути.</p>
        </div>
      </div>
      <div class="nkh-step3">
        <?php echo $kh_vid( 'kh-step-3.mp4', 'kh-step-3.jpg', 'Уредът работи сам, докато си почивате' ); ?>
        <div class="nkh-step3-txt">
          <p class="nkh-step3-h"><span>3</span> Продължете с деня си</p>
          <p>Гледайте новините, изпийте кафе. Уредът работи сам и спира, когато сесията свърши.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2) Zacaran krug — video -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media"><?php echo $kh_vid( 'kh-vid-bol.mp4', 'kh-vid-bol.jpg', 'Болка и скованост в коляното' ); ?></div>
    <div class="nkh-copy">
      <h2 class="nkh-h2">Прекъснете порочния кръг. Коляното ви е готово за истинско облекчение.</h2>
      <p>Тъпа болка, скованост при изправяне, предпазлива стъпка преди слизане по стълби — това са сигнали на тъкан, която от години тихо гладува. Отговорът не е още едно хапче, а възстановяване на кръвотока в ставата.</p>
      <ul class="nkh-tri">
        <li><strong>12 минути дневно:</strong> възстановяване на кръвотока и отпускане на напрежението, без хапчета.</li>
        <li><strong>Възстановяване и регенерация:</strong> топлината разширява съдовете, компресията изтласква отока, вибрациите отпускат сковаността — всичко в една сесия.</li>
        <li><strong>Движение без изчисляване:</strong> стълби без планиране, клек в градината, внуче на ръце.</li>
      </ul>
    </div>
  </div>
</section>

<!-- Osjetite razliku — video desno -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-copy">
      <h2 class="nkh-h2">Усетете разликата: трайното облекчение започва днес</h2>
      <p>Не краткотраен покой, а промяна, която забелязвате. <strong>Повечето потребители усещат истинска разлика в рамките на първите 7 до 14 дни</strong> редовна употреба. Утринната скованост отпуска и слизането по стълби спира да е изчисление.</p>
      <ul class="nkh-tri">
        <li><strong>По-малко скованост и натиск:</strong> намалява напрежението и отока, които поддържат оплакванията.</li>
        <li><strong>По-добро кръвообращение:</strong> възстановява кръвотока в по-дълбоката тъкан на коляното — там, където проблемът всъщност възниква.</li>
        <li><strong>Всичко вкъщи:</strong> без ходене на терапии и без чакане на час.</li>
      </ul>
    </div>
    <div class="nkh-media"><?php echo $kh_vid( 'kh-vid-zglob.mp4', 'kh-vid-zglob.jpg', 'Колянна става' ); ?></div>
  </div>
</section>

<!-- Pametna tehnologija — video lijevo -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media"><?php echo $kh_vid( 'kh-vid-led.mp4', 'kh-vid-led.jpg', 'Нагревателни елементи в наколенката' ); ?></div>
        <div class="nkh-copy">
      <h2 class="nkh-h2">Интелигентна технология за по-дълбоката тъкан</h2>
      <p>Нагласете NORIKS KneeHeat за своето коляно: <strong>3 степени на топлина</strong>, <strong>3 режима вибрации</strong> и <strong>циклична компресия</strong>. Без кабел, един бутон, дванадесет минути.</p>
      <ul class="nkh-tri">
        <li><strong>Винаги готов:</strong> безжична работа и зареждане през USB-C кабел.</li>
        <li><strong>Преносим:</strong> лек е и влиза в чанта — използвайте го, където и да сте.</li>
        <li><strong>Лесно управление:</strong> един бутон, без приложение и без настройки.</li>
      </ul>
    </div>
  </div>
</section>


<!-- 2) Trostruka metoda — slika desno -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-copy">
      <h2 class="nkh-h2">Три терапии в една сесия</h2>
      <p>Затоплянето, компресията и вибрациите не работят едно след друго, а едновременно — затова една сесия продължава само 12 минути.</p>
      <ul class="nkh-tri">
        <li><strong>Топлина до 42 °C</strong> разширява съдовете и омекотява сковаността в тъканта около ставата.</li>
        <li><strong>Въздушна компресия</strong> ритмично притиска и отпуска, изтласква събралата се течност и докарва свежа кръв.</li>
        <li><strong>Вибрационен масаж 60 Hz</strong> отпуска напрежението и сковаността, които държат коляното „заключено".</li>
      </ul>
      <p class="nkh-note">За разлика от TENS уредите, които само припокриват сигнала за болка, KneeHeat действа върху по-дълбоката тъкан.</p>
    </div>
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-04-metoda.jpg', 'Троен метод: топлина, компресия и вибрации' ); ?></div>
  </div>
</section>


<!-- 4) Značajke uređaja — slika desno -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-11-znacajke.jpg', 'Характеристики на уреда NORIKS KneeHeat' ); ?></div>
    <div class="nkh-copy">
      <h2 class="nkh-h2">Направен да се носи, не за шкафа</h2>
      <p>Панелът за управление е от външната страна, на една ръка разстояние: <strong>едно докосване сменя степента на топлина</strong>, второто — режима на вибрации. Никакво меню, нито приложение, което да търсите в тъмното.</p>
      <p>Наколенката се закопчава с две ленти, така че стегнатостта избирате сами — по-свободно, когато седите, по-стегнато, когато се движите по къщата. Така уредът остава на място и не се върти около крака.</p>
      <p class="nkh-strong">Безжичен е и се зарежда с USB-C кабел; едно зареждане стига за няколко сесии, така че идва с вас на работа и на път.</p>
    </div>
  </div>
</section>

<!-- 5) Što je u paketu — slika lijevo -->
<section class="nkh-sec nkh-light">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-copy">
      <h2 class="nkh-h2">Какво получавате в комплекта</h2>
      <ul class="nkh-pack">
        <li><strong>Уред NORIKS KneeHeat</strong> — наколенка със затопляне, компресия и вибрации</li>
        <li><strong>Плетен USB-C кабел</strong> за зареждане</li>
        <li><strong>Удължаваща лента</strong> за по-големи обиколки на крака</li>
        <li><strong>2 години гаранция за замяна</strong></li>
      </ul>
    </div>
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-07-unboxing-h.jpg', 'Obsah balenia NORIKS KneeHeat' ); ?></div>
  </div>
</section>


<!-- 7) Liječnik — slika desno -->
<section class="nkh-sec nkh-white">
  <div class="nkh-wrap nkh-row">
    <div class="nkh-media nkh-graf"><?php echo $kh_img( 'kh-02-lijecnik.jpg', 'Препоръка от ортопед' ); ?></div>
    <div class="nkh-copy">
      <h2 class="nkh-h2">Създаден за всекидневен комфорт и движение</h2>
      <p class="nkh-quote">„При хронични проблеми с коляното след 45-ата година най-много помага това, което хората могат да правят всеки ден вкъщи. Топлината, компресията и вибрациите заедно възстановяват кръвотока в тъканта — а това е основата, върху която работи всичко останало.”</p>
      <p class="nkh-sign">Д-р Марин Ковачев, ортопед</p>
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
