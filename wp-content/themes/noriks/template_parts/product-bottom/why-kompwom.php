<?php
/**
 * product-bottom: NORIKS FIT Woman — oblikujuca majica s 3D linijama (orto-kompwom).
 * Pravilo: svaka sekcija ima TOCNO JEDNU sliku, naizmjenicno lijevo/desno.
 * Recenzije su preslikane s originala (leonieandco): bordo pas + vodoravni klizac.
 *   1) Zagladen trbuh (lijevo)     5) Tkanina i kroj (desno)
 *   2) Mi vs drugi (desno)         6) Kako je nositi (lijevo)
 *   3) RECENZIJE — klizac          7) Boje (desno)
 *   4) Osjecajte se sigurno (lijevo)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$kw      = get_template_directory_uri() . '/img/kompwom/';
$kw_path = get_template_directory() . '/img/kompwom/';
$kw_img  = function( $file, $alt, $cls = '' ) use ( $kw, $kw_path ) {
  if ( ! file_exists( $kw_path . $file ) ) { return ''; }
  return '<img class="' . esc_attr( $cls ) . '" src="' . esc_url( $kw . $file ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy">';
};
?>

<!-- 1) ZAGLAĐEN TRBUH — slika lijevo -->
<section class="nkw-sec nkw-tint">
  <div class="nkw-wrap nkw-row2">
    <div class="nkw-media"><?php echo $kw_img( 'kwm-trbuh.jpg', 'Изгладен корем с тениската NORIKS FIT Woman' ); ?></div>
    <div class="nkw-copy">
      <p class="nkw-kicker">Веднага, от първата минута</p>
      <h2 class="nkw-h2">Изгладен корем <em>без притискане</em></h2>
      <p>Нашите 3D линии оформят тялото, като нежно прибират областта на корема и кръста и подпомагат кръвообращението — без колан, който се врязва, и без усещане за стягане.</p>
      <p>Без тениската коремът е отпуснат и гънките се виждат под облеклото. С нея коремът е веднага изгладен, а стойката — по-изправена.</p>
      <ul class="nkw-check">
        <li>Веднага изгладен корем</li>
        <li>Изправена стойка без да мислите</li>
        <li>Невидима под облеклото</li>
      </ul>
      <a class="nkw-cta" href="#bundle-selector">Изберете цвят и размер</a>
    </div>
  </div>
</section>

<!-- 2) MI VS DRUGI — slika desno -->
<section class="nkw-sec">
  <div class="nkw-wrap nkw-row2 nkw-row2--rev">
    <div class="nkw-copy">
      <p class="nkw-kicker">Разликата</p>
      <h2 class="nkw-h2">Защо обикновената компресия не работи</h2>
      <p>Класическите стягащи тениски притискат в една линия. Резултатът е издутина над ръба, гънки на раменете и ръб, който се вижда под облеклото.</p>
      <p>При нас релефът е <strong>вплетен в плата</strong> и разпределен на ширина, така че натискът се разлива, вместо да се събира.</p>
      <ul class="nkw-vs">
        <li class="is-yes">3D технология, вплетена в плетката</li>
        <li class="is-yes">Нежна 360° компресия без издутини</li>
        <li class="is-yes">Поддържа кръста</li>
        <li class="is-no">Обикновена компресия, която създава издутини</li>
        <li class="is-no">Материалът се навива през деня</li>
        <li class="is-no">Ръб, който се вижда под облеклото</li>
      </ul>
    </div>
    <div class="nkw-media"><?php echo $kw_img( 'kwm-usporedba.jpg', 'NORIKS FIT Woman в сравнение с обикновена стягаща тениска' ); ?></div>
  </div>
</section>

<!-- 3) OSJEĆAJTE SE SIGURNO — slika lijevo -->
<section class="nkw-rev">
  <div class="nkw-rev__head">
    <span class="nkw-rev__badge">★★★★★ Отлично · Оценка 4,9/5</span>
    <h2 class="nkw-rev__title">Отзиви на жени като вас</h2>
  </div>
  <div class="nkw-rev__track">
    <?php
    $kw_reviews = array(
      array( 'img' => 'kwm-ugc-1.jpg', 'name' => 'Калина Б.', 'meta' => 'Размер M · 46 · София', 'worn' => 'Носи 7 седмици',
             'text' => '„Ризите ми стоят гладко, отпред и отзад. Тези, които пробвах преди, не издържаха нито един цял ден.”' ),
      array( 'img' => 'kwm-ugc-2.jpg', 'name' => 'Daniela P.', 'meta' => 'Размер 2XL · 48 · Пловдив', 'worn' => 'Носи 5 седмици',
             'text' => '„Първата стягаща тениска, която не ми се навива нагоре. Ръбът държи, а платът е достатъчно тънък за лятото.”' ),
      array( 'img' => 'kwm-ugc-3.jpg', 'name' => 'Hana T.', 'meta' => 'Размер 3XL · 51 · Варна', 'worn' => 'Носи 6 седмици',
             'text' => '„Купих я за свадба, а сега я нося на работа. Седенето вече не променя как пада роклята.”' ),
      array( 'img' => 'kwm-ugc-4.jpg', 'name' => 'Laura D.', 'meta' => 'Размер M · 43 · Бургас', 'worn' => 'Носи 8 седмици',
             'text' => '„Обличам я след закуска и забравям, че я нося. До обяд изобщо не я усещам.”' ),
      array( 'img' => 'kwm-ugc-5.jpg', 'name' => 'Наталия А.', 'meta' => 'Размер 2XL · 37 · Русе', 'worn' => 'Носи 9 седмици',
             'text' => '„Никога не ми стоеше добре, когато прибирах тениската в панталона. С тази отдолу талията изглежда по-тясна и цял ден не се оправям.”' ),
      array( 'img' => 'kwm-ugc-6.jpg', 'name' => 'Nikoleta M.', 'meta' => 'Размер L · 48 · Стара Загора', 'worn' => 'Носи 4 седмици',
             'text' => '„Поръчах я за един тоалет, а свърши под повечето пуловери. Плетката изглежда гладка, вместо намачкана в талията.”' ),
      array( 'img' => 'kwm-ugc-7.jpg', 'name' => 'Petra J.', 'meta' => 'Размер XL · 50 · Плевен', 'worn' => 'Носи 6 седмици',
             'text' => '„На бюрото седя девет часа дневно и остава удобна. Няма шевове, които да се усещат, а блузата отзад остава гладка.”' ),
      array( 'img' => 'kwm-ugc-8.jpg', 'name' => 'Sofia K.', 'meta' => 'Размер M · 45 · Сливен', 'worn' => 'Носи 10 седмици',
             'text' => '„Гърбът ми е благодарен. Тениската нежно ми напомня да се изправя, а при това никъде не ме стяга.”' ),
    );
    foreach ( $kw_reviews as $r ) : ?>
    <article class="nkw-rev__card">
      <div class="nkw-rev__img"><?php echo $kw_img( $r['img'], 'Kupka u NORIKS FIT Woman majici' ); ?></div>
      <div class="nkw-rev__body">
        <div class="nkw-rev__top">
          <div>
            <p class="nkw-rev__name"><?php echo esc_html( $r['name'] ); ?>
              <svg width="15" height="15" viewBox="0 0 16 16" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#3aa06a"/><path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <p class="nkw-rev__meta"><?php echo esc_html( $r['meta'] ); ?></p>
          </div>
          <span class="nkw-rev__worn"><?php echo esc_html( $r['worn'] ); ?></span>
        </div>
        <p class="nkw-rev__text"><?php echo esc_html( $r['text'] ); ?></p>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
  <p class="nkw-rev__hint">Плъзнете встрани за още отзиви →</p>
</section>

<!-- 7) BOJE — slika desno -->
<section class="nkw-sec nkw-tint">
  <div class="nkw-wrap nkw-row2">
    <div class="nkw-media"><?php echo $kw_img( 'kwm-drzanje.jpg', 'По-тясна талия и изправена стойка' ); ?></div>
    <div class="nkw-copy">
      <p class="nkw-kicker">Три неща наведнъж</p>
      <h2 class="nkw-h2">Чувствайте се <em>уверени в кожата си</em></h2>
      <div class="nkw-points">
        <div class="nkw-point"><h3>По-тясна талия</h3><p>3D линиите оформят талията и изглаждат издутините над панталона или полата.</p></div>
        <div class="nkw-point"><h3>Веднага плосък корем</h3><p>Нежната компресия държи корема под всяко облекло, без натиск в една точка.</p></div>
        <div class="nkw-point"><h3>Изправена стойка</h3><p>Опората на гърба помага да стоите изправени и разтоварва кръста.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- 4) TKANINA I KROJ — slika desno -->
<section class="nkw-sec">
  <div class="nkw-wrap nkw-row2 nkw-row2--rev">
    <div class="nkw-copy">
      <p class="nkw-kicker">Плат и кройка</p>
      <h2 class="nkw-h2">Релефът е <em>вплетен</em>, а не отпечатан</h2>
      <p>Широк колан минава през корема и кръста, втори — през гърба. Затова нищо не се напуква и нищо не се отлепва.</p>
      <div class="nkw-facts">
        <div><h3>3D линии</h3><p>Структурирани, вплетени в плетката — с времето не падат.</p></div>
        <div><h3>Колан на гърба</h3><p>Вторият колан минава през гърба и подкрепя изправената стойка.</p></div>
        <div><h3>Ръкави</h3><p>Прилепнала кройка, която не се навива и не се вдига.</p></div>
        <div><h3>Материал</h3><p>Тънък, матов и дишащ — изчезва под риза или сако.</p></div>
      </div>
    </div>
    <div class="nkw-media"><?php echo $kw_img( 'kwm-detalji.jpg', 'Детайли: 3D линии, колан, ръкави, материал' ); ?></div>
  </div>
</section>

<!-- 5) KAKO JE NOSITI — slika lijevo -->
<section class="nkw-sec nkw-tint">
  <div class="nkw-wrap nkw-row2">
    <div class="nkw-media"><?php echo $kw_img( 'kwm-siva.jpg', 'NORIKS FIT Woman тъмносива' ); ?></div>
    <div class="nkw-copy">
      <p class="nkw-kicker">Как да я носите</p>
      <h2 class="nkw-h2">Облечете я сутрин и забравете за нея до вечерта</h2>
      <p>Трябва да дишате и да се храните нормално, без да мислите за тениската. Ако следата върху кожата се вижда двадесет минути след събличане, размерът е твърде малък.</p>
      <ul class="nkw-check">
        <li><strong>Цял ден</strong> — компресията е разпределена, така че нищо не се врязва</li>
        <li><strong>Под всичко</strong> — без линия и без ръб под облеклото</li>
        <li><strong>Лесна поддръжка</strong> — пране в пералня на 30 °C</li>
      </ul>
      <p class="nkw-note nkw-note--left">Изберете размер според обиколката на гърдите. Ако сте между два, вземете по-големия.</p>
    </div>
  </div>
</section>

<!-- 6) RECENZIJE (postavitev z originala — bordo pas z drsnikom) -->
<section class="nkw-sec">
  <div class="nkw-wrap nkw-row2 nkw-row2--rev">
    <div class="nkw-copy">
      <p class="nkw-kicker">Три цвята</p>
      <h2 class="nkw-h2">Черно, тъмносиво и <em>розово</em></h2>
      <p>Черно под всичко, тъмносиво за всекидневно носене, розово, когато искате нещо по-топло. И трите имат същата плетка и същия релеф.</p>
      <p>Цветът и размерът се избират на тази страница, преди добавяне в количката.</p>
      <a class="nkw-cta" href="#bundle-selector">Изберете цвят и размер</a>
    </div>
    <div class="nkw-media"><?php echo $kw_img( 'kwm-roza.jpg', 'NORIKS FIT Woman розова' ); ?></div>
  </div>
</section>

<style>
.nkw-sec { padding: 62px 0; background: #fff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #241c22; }
.nkw-sec * { box-sizing: border-box; }
.nkw-tint { background: #fbf3f4; }
.nkw-wrap { width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.nkw-kicker { font-size: 12.5px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: #a8536b; margin: 0 0 10px; }
.nkw-h2 { font-size: clamp(25px, 3.2vw, 36px); font-weight: 800; line-height: 1.18; letter-spacing: -.01em; margin: 0 0 16px; color: #241c22; }
.nkw-h2 em { font-style: italic; font-weight: 800; color: #a8536b; }
.nkw-copy p { font-size: 16px; line-height: 1.7; color: #56494f; margin: 0 0 14px; }
.nkw-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 52px; align-items: center; }
.nkw-media img { width: 100%; display: block; border-radius: 14px; box-shadow: 0 2px 4px rgba(36,28,34,.05), 0 14px 40px rgba(36,28,34,.10); }
.nkw-check { list-style: none; padding: 0; margin: 4px 0 22px; display: flex; flex-direction: column; gap: 11px; }
.nkw-check li { position: relative; padding-left: 28px; font-size: 15.5px; line-height: 1.5; }
.nkw-check li::before { content: "\2713"; position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; background: #2f9e5f; color: #fff; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nkw-vs { list-style: none; padding: 0; margin: 4px 0 0; display: flex; flex-direction: column; gap: 10px; }
.nkw-vs li { position: relative; padding-left: 28px; font-size: 15px; line-height: 1.5; }
.nkw-vs li::before { position: absolute; left: 0; top: -1px; width: 20px; height: 20px; border-radius: 50%; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.nkw-vs .is-yes::before { content: "\2713"; background: #2f9e5f; color: #fff; }
.nkw-vs .is-no { color: #8b7b83; }
.nkw-vs .is-no::before { content: "\2715"; background: #ece0e4; color: #a8949c; }
.nkw-points { display: flex; flex-direction: column; gap: 20px; }
.nkw-point h3 { font-size: 17.5px; font-weight: 800; margin: 0 0 6px; color: #a8536b; }
.nkw-point p { font-size: 15.5px; color: #56494f; line-height: 1.6; margin: 0; }
.nkw-facts { display: grid; grid-template-columns: 1fr 1fr; gap: 22px 26px; margin-top: 6px; }
.nkw-facts h3 { font-size: 16px; font-weight: 800; margin: 0 0 6px; color: #241c22; }
.nkw-facts p { font-size: 14.5px; color: #6b5f66; line-height: 1.6; margin: 0; }
.nkw-note { font-size: 13.5px; color: #8b7b83; font-style: italic; margin: 20px 0 0; }
.nkw-note--left { text-align: left; }
.nkw-cta { display: inline-block; background: #241c22; color: #fff !important; font-size: 15px; font-weight: 700; padding: 15px 30px; border-radius: 8px; text-decoration: none; }
.nkw-cta:hover { background: #a8536b; color: #fff !important; }

/* ── recenzije: bordo pas + vodoravni klizac (kot na originalu) ────── */
.nkw-rev { background: #5c2331; padding: 62px 0 54px; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }
.nkw-rev * { box-sizing: border-box; }
.nkw-rev__head { max-width: 1240px; margin: 0 auto 30px; padding: 0 24px; text-align: center; }
.nkw-rev__badge { display: inline-block; border: 1px solid rgba(255,255,255,.45); border-radius: 100px; padding: 8px 18px; font-size: 12.5px; font-weight: 700; letter-spacing: .04em; color: #fff; }
.nkw-rev__title { font-family: Georgia, 'Times New Roman', serif; font-size: clamp(27px, 3.4vw, 40px); font-weight: 400; color: #fff; margin: 16px 0 0; line-height: 1.2; }
.nkw-rev__track { display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;
  padding: 4px 24px 18px; margin: 0 auto; max-width: 1240px; scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.4) transparent; }
.nkw-rev__track::-webkit-scrollbar { height: 6px; }
.nkw-rev__track::-webkit-scrollbar-track { background: rgba(255,255,255,.12); border-radius: 100px; }
.nkw-rev__track::-webkit-scrollbar-thumb { background: rgba(255,255,255,.45); border-radius: 100px; }
.nkw-rev__card { flex: 0 0 310px; width: 310px; scroll-snap-align: start; background: #fff; border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; }
.nkw-rev__img img { width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block; }
.nkw-rev__body { padding: 16px 18px 20px; }
.nkw-rev__top { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
.nkw-rev__name { display: flex; align-items: center; gap: 6px; font-size: 15px; font-weight: 800; color: #241c22; margin: 0; }
.nkw-rev__name svg { flex: 0 0 15px; }
.nkw-rev__meta { font-size: 12.5px; color: #7b6d73; margin: 3px 0 0; }
.nkw-rev__worn { flex: 0 0 auto; background: #f3eaed; color: #5c2331; font-size: 10.5px; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; padding: 5px 9px; border-radius: 100px; white-space: nowrap; }
.nkw-rev__text { font-size: 14.5px; line-height: 1.6; color: #46393f; margin: 13px 0 0; }
.nkw-rev__hint { text-align: center; font-size: 12.5px; color: rgba(255,255,255,.6); margin: 8px 0 0; }

@media (max-width: 980px) {
  .nkw-row2 { grid-template-columns: 1fr; gap: 30px; }
  .nkw-row2--rev .nkw-media { order: -1; }
  .nkw-facts { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
  .nkw-sec { padding: 44px 0; }
  .nkw-wrap { padding: 0 16px; }
  .nkw-facts { grid-template-columns: 1fr; gap: 16px; }
  .nkw-cta { width: 100%; text-align: center; }
  .nkw-rev { padding: 46px 0 40px; }
  .nkw-rev__head { padding: 0 16px; }
  .nkw-rev__track { padding: 4px 16px 16px; gap: 14px; }
  .nkw-rev__card { flex: 0 0 300px; width: 300px; }
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
