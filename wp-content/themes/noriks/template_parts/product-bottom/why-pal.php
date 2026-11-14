<?php
/**
 * product-bottom: NORIKS Pal — stap s dvije rucke, svjetiljkom i alarmom (orto-pal).
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno,
 * pozadine se izmjenjuju (prva tonirana). Iznimka je galerija kupaca (12).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pl      = get_template_directory_uri() . '/img/pal/';
$pl_path = get_template_directory() . '/img/pal/';
$pl_vid  = function( $file, $poster, $alt ) use ( $pl, $pl_path ) {
  if ( ! file_exists( $pl_path . $file ) ) { return ''; }
  return '<video class="npl-video" autoplay muted loop playsinline preload="metadata" poster="'
       . esc_url( $pl . $poster ) . '" aria-label="' . esc_attr( $alt ) . '">'
       . '<source src="' . esc_url( $pl . $file ) . '" type="video/mp4"></video>';
};
$pl_img  = function( $file, $alt, $cls = '' ) use ( $pl, $pl_path ) {
  if ( ! file_exists( $pl_path . $file ) ) { return ''; }
  return '<img class="' . esc_attr( $cls ) . '" src="' . esc_url( $pl . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
?>

<!-- 1) USTAJANJE -->
<!-- 1) PROBLEM — slika lijevo -->
<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2">
    <div class="npl-media"><?php echo $pl_img( 'pal-rucke.jpg', 'Ортопедични ръкохватки за опора' ); ?></div>
    <div class="npl-copy">
      <p class="npl-kicker">Втората ръкохватка</p>
      <h2 class="npl-h2">Опора точно там, където ви е нужна</h2>
      <p>Освен горната ръкохватка бастунът има и <strong>втора ръкохватка по-долу</strong>. За нея се хващате, когато се изправяте от фотьойл, от леглото или от нисък стол.</p>
      <p>Натискът отива вертикално надолу, в стабилната основа — не напред, където би ви извадил от равновесие. Затова се изправяте с едно движение, без да се навеждате и без чужда помощ.</p>
      <ul class="npl-check">
        <li>Изправяне от фотьойл, легло или пейка</li>
        <li>Ръкохватките не ожулват ръката дори след по-дълго ходене</li>
        <li>Без да чакате някой да ви помогне</li>
      </ul>
      <a class="npl-cta" href="#bundle-selector">Вижте офертата</a>
    </div>
  </div>
</section>

<!-- 3) PREGLED ŠTAPA — slika lijevo -->
<section class="npl-sec">
  <div class="npl-wrap npl-row2 npl-row2--rev">
    <div class="npl-copy">
      <p class="npl-kicker">Стабилност</p>
      <h2 class="npl-h2">Стои сама — не се налага да се навеждате за бастуна</h2>
      <p>Четири гумени крачета държат бастуна изправен, когато го пуснете. Не пада на земята до дивана, до масата, нито в чакалнята, така че не се навеждате за него.</p>
      <p>Това е дребно нещо, което забелязвате още първия ден: бастунът ви чака там, където сте го оставили.</p>
    </div>
    <div class="npl-media"><?php echo $pl_vid( 'pal-video.mp4', 'pal-video.jpg', 'Бастунът стои сам на четири крачета' ); ?></div>
  </div>
</section>

<!-- 5) PROTUKLIZNA BAZA — slika lijevo -->
<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2">
    <div class="npl-media"><?php echo $pl_img( 'pal-pregled.jpg', 'Преглед на бастуна: две ръкохватки, осветление, аларма, четири крачета' ); ?></div>
    <div class="npl-copy">
      <p class="npl-kicker">Какво получавате</p>
      <h2 class="npl-h2">Пет неща в един бастун</h2>
      <div class="npl-points">
        <div class="npl-point"><h3>Две ръкохватки</h3><p>Горната за ходене, долната за изправяне.</p></div>
        <div class="npl-point"><h3>Четири крачета</h3><p>Бастунът стои сам и не пада на земята.</p></div>
        <div class="npl-point"><h3>Фенерче</h3><p>Осветява пътя пред вас в тъмното.</p></div>
        <div class="npl-point"><h3>Аларма</h3><p>Силен сигнал, който близките чуват.</p></div>
        <div class="npl-point"><h3>Сгъваема версия</h3><p>Влиза в чанта и в жабката на колата.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 4) STOJI SAM (video) — video desno -->
<section class="npl-sec">
  <div class="npl-wrap npl-row2 npl-row2--rev">
    <div class="npl-copy">
      <p class="npl-kicker">Основа</p>
      <h2 class="npl-h2">Държи на плочки, паркет и навън</h2>
      <p>Гумените крачета са <strong>противоплъзгащи</strong> и не се плъзгат по гладки подове. Навън основата се приспособява към неравен терен и остава стабилна.</p>
      <ul class="npl-check">
        <li>Не се плъзга по плочки, паркет или ламинат</li>
        <li>Приспособява се към неравен терен</li>
        <li>Крачетата се сменят, когато се износят</li>
      </ul>
    </div>
    <div class="npl-media"><?php echo $pl_img( 'pal-nozice.jpg', 'Четири противоплъзгащи гумени крачета' ); ?></div>
  </div>
</section>

<!-- 6) SVJETILJKA — slika desno -->
<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2">
    <div class="npl-media"><?php echo $pl_img( 'pal-sklopivo.jpg', 'Сгъваем и регулируем бастун' ); ?></div>
    <div class="npl-copy">
      <p class="npl-kicker">Преносимост</p>
      <h2 class="npl-h2">Сгъва се за секунда и влиза в чанта</h2>
      <p>Частите са свързани с вътрешен ластик, така че бастунът се разглобява и сгъва <strong>с едно движение</strong>, без инструменти и без чужда помощ. Сгънат влиза в чанта или в жабката на колата.</p>
      <p>Височината се настройва за няколко секунди, така че един и същ бастун е подходящ за човек от 155 cm и от 190 cm.</p>
      <ul class="npl-check">
        <li>Разглобяване и сгъване без инструменти</li>
        <li>Регулируема дължина за всички височини</li>
        <li>Частите остават свързани — нищо не се губи</li>
      </ul>
    </div>
  </div>
</section>

<section class="npl-sec npl-rev">
  <div class="npl-wrap">
    <p class="npl-kicker npl-center">При нашите клиенти</p>
    <h2 class="npl-h2 npl-center">Бастунът в истински домове</h2>
    <p class="npl-sub">Снимки и коментари на клиенти — до фотьойла, в коридора, в тъмното и сгънат за път.</p>
    <div class="npl-rev__grid">
      <?php
      $pl_reviews = array(
        array( 'img' => 'pal-ugc-1.jpg',    'name' => 'Мария К.',  'meta' => 'София · купи преди 2 месеца',
               'text' => '„Държа го до фотьойла. Преди се изправях на три опита, сега се хващам за долната ръкохватка и се изправям от първия път.”' ),
        array( 'img' => 'pal-ugc-3.jpg',    'name' => 'Zdenko P.', 'meta' => 'Пловдив · купи преди 3 месеца',
               'text' => '„Стои сам до масата и не пада. Това за мен е най-голямото нещо — не се навеждам за бастуна на всеки пет минути.”' ),
        array( 'img' => 'pal-noc.jpg',      'name' => 'Anna M.',  'meta' => 'Варна · купи преди месец',
               'text' => '„Светлината включвам, когато отивам през нощта до банята. Не будя мъжа си с голямата лампа и виждам пода пред себе си.”' ),
        array( 'img' => 'pal-ugc-baza.jpg', 'name' => 'Иван Ш.',    'meta' => 'Бургас · купи преди 6 седмици',
               'text' => '„Основата е широка и не се плъзга. Пробвах го на плочките в банята и на мокра тераса — държи.”' ),
        array( 'img' => 'pal-ugc-6.jpg',    'name' => 'Надежда Б.',    'meta' => 'Русе · купи преди 2 месеца',
               'text' => '„Купих го на мама за 78-ия ѝ рожден ден. Сама си настройва височината и сама го сгъва, без чужда помощ.”' ),
        array( 'img' => 'pal-ugc-5.jpg',    'name' => 'Стефан Л.', 'meta' => 'Стара Загора · купи преди 4 месеца',
               'text' => '„Нося го в колата, когато ходя на лекар. Сгъва се за секунда и влиза в чанта, в чакалнята не пречи.”' ),
      );
      foreach ( $pl_reviews as $r ) : ?>
      <article class="npl-rev__card">
        <div class="npl-rev__img"><?php echo $pl_img( $r['img'], 'Fotografija kupca — NORIKS Pal' ); ?></div>
        <div class="npl-rev__body">
          <div class="npl-rev__stars" aria-label="Ocjena 5 od 5">★★★★★</div>
          <p class="npl-rev__text"><?php echo esc_html( $r['text'] ); ?></p>
          <p class="npl-rev__name"><?php echo esc_html( $r['name'] ); ?>
            <svg width="15" height="15" viewBox="0 0 16 16" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#2f9e5f"/><path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </p>
          <p class="npl-rev__meta"><?php echo esc_html( $r['meta'] ); ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="npl-sec npl-tint">
  <div class="npl-wrap npl-row2 npl-row2--rev">
    <div class="npl-copy">
      <p class="npl-kicker">Разликата</p>
      <h2 class="npl-h2">От „имам нужда от помощ” към „тръгвам сам”</h2>
      <p>Разликата не е в силата на краката, а в това, че има за какво да се хванете. Втората ръкохватка носи тежестта вместо раменете и китките ви.</p>
      <p class="npl-strong">Самостоятелно изправяне, а и разходка в парка.</p>
      <a class="npl-cta" href="#bundle-selector">Поръчайте без риск — 30 дни</a>
    </div>
    <div class="npl-media"><?php echo $pl_img( 'pal-prije-poslije.jpg', 'Преди и след — самостоятелно движение' ); ?></div>
  </div>
</section>

<!-- 14) ŠEST RAZLOGA — slika desno -->
<style>
.npl-sec { padding: 62px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #12212b; }
.npl-sec * { box-sizing: border-box; }
.npl-tint { background: #eef6f8; }
.npl-wrap { width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.npl-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #2b8fa6; margin: 0 0 10px; }
.npl-h2 { font-size: clamp(25px, 3.2vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; }
.npl-center { text-align: center; }
.npl-copy p { font-size: 16px; line-height: 1.7; color: #465863; margin: 0 0 14px; }
.npl-strong { font-weight: 800; color: #12212b !important; font-size: 17px !important; }
.npl-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 52px; align-items: center; }
.npl-media img { width: 100%; display: block; border-radius: 14px; box-shadow: 0 2px 4px rgba(18,33,43,.05), 0 14px 40px rgba(18,33,43,.10); }
.npl-check { list-style: none; padding: 0; margin: 4px 0 0; display: flex; flex-direction: column; gap: 11px; }
.npl-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; }
.npl-check li::before { content: "✓"; position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; background: #2f9e5f; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.npl-points { display: flex; flex-direction: column; gap: 16px; margin-top: 4px; }
.npl-point h3 { font-size: 16.5px; font-weight: 800; margin: 0 0 4px; color: #2b8fa6; }
.npl-point p { font-size: 15px; color: #465863; line-height: 1.6; margin: 0; }
.npl-six { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 4px; }
.npl-reason { background: #fff; border: 1px solid #d9e8ec; border-radius: 12px; padding: 18px 16px; }
.npl-reason span { display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background: #2b8fa6; color: #fff; font-weight: 800; font-size: 13px; margin-bottom: 9px; }
.npl-reason h3 { font-size: 15.5px; font-weight: 800; margin: 0 0 5px; line-height: 1.3; }
.npl-reason p { font-size: 14px; color: #465863; line-height: 1.55; margin: 0; }
.npl-cta { display: inline-block; background: #12212b; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.npl-cta:hover { background: #2b8fa6; color: #fff !important; }
.npl-rev__grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.npl-rev__card { background: #fff; border: 1px solid #d9e8ec; border-radius: 14px; overflow: hidden;
  display: flex; flex-direction: column; box-shadow: 0 1px 2px rgba(18,33,43,.04), 0 8px 24px rgba(18,33,43,.06); }
.npl-rev__img img { width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block; border-radius: 0; box-shadow: none; }
.npl-rev__body { padding: 16px 18px 18px; }
.npl-rev__stars { color: #f0a020; font-size: 14px; letter-spacing: 1px; margin: 0 0 8px; }
.npl-rev__text { font-size: 14.5px; line-height: 1.6; color: #46545e; margin: 0 0 12px; }
.npl-rev__name { display: flex; align-items: center; gap: 6px; font-size: 14.5px; font-weight: 800; color: #12212b; margin: 0; }
.npl-rev__name svg { flex: 0 0 15px; }
.npl-rev__meta { font-size: 12.5px; color: #7b8b94; margin: 3px 0 0; }
.npl-sub { text-align: center; font-size: 16px; color: #5b6d78; max-width: 60ch; margin: 0 auto 34px; line-height: 1.6; }
.npl-video { width: 100%; display: block; border-radius: 14px; }
@media (max-width: 980px) {
  .npl-rev__grid { grid-template-columns: 1fr 1fr; }
    .npl-row2 { grid-template-columns: 1fr; gap: 30px; }
  .npl-row2--rev .npl-media { order: -1; }
  .npl-six { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
  .npl-rev__grid { grid-template-columns: 1fr; gap: 16px; }
  .npl-sec { padding: 44px 0; }
  .npl-wrap { padding: 0 16px; }
  .npl-six { grid-template-columns: 1fr; gap: 14px; }
  .npl-cta { width: 100%; text-align: center; }
}

/* ── kratek opis izdelka: kljukice namesto pik ─────────────────────── */
.woocommerce div.product .woocommerce-product-details__short-description ul,
.woocommerce-product-details__short-description ul {
  list-style: none !important; margin: 10px 0 14px !important; padding-left: 0 !important; }
.woocommerce div.product .woocommerce-product-details__short-description ul li,
.woocommerce-product-details__short-description ul li {
  list-style: none !important; text-indent: 0 !important; margin: 0 0 7px !important;
  line-height: 1.45 !important; font-size: 15.5px !important;
  display: block !important; position: relative !important; padding-left: 31px !important; }
.woocommerce-product-details__short-description ul li::marker { content: "" !important; }
.woocommerce-product-details__short-description ul li::before { content: none !important; }
.woocommerce-product-details__short-description .nsg-tick {
  position: absolute !important; left: 0 !important; top: 1px !important;
  width: 21px; height: 21px; border-radius: 50%;
  background: #2f9e5f !important; color: #fff !important;
  font-size: 12px !important; font-weight: 800 !important; line-height: 21px !important;
  text-align: center !important; display: inline-block !important; }
.woocommerce-product-details__short-description p:first-of-type { font-size: 16px; line-height: 1.55; }
</style>
