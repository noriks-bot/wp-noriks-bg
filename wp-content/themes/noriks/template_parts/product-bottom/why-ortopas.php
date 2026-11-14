<?php
/**
 * product-bottom: ORTOPEDICKÝ PÁS NA CHRBÁT (ortopas) — SK
 *
 * Dedicated bottom-nicer for the NORIKS orthopedic back belt.
 * Shown via single-product-bottom-nicer.php when noriks_is_type('ortopas').
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * MÉDIÁ podľa sekcií.
 * Videá 2, 3, 4, 6 sú v téme (git) — /img/ortopas-videos/.
 * TODO: obrázok 1 (koláž) a 5 (indikácie) sú zatiaľ HR verzie —
 *       potrebné SK (slovenské) obrázky.
 * ------------------------------------------------------------------ */
$opz_vid_dir      = get_template_directory_uri() . '/img/ortopas-videos/';
// Videi se zamenjajo pod istim imenom, zato jim dodamo verzijo - brez tega brskalnik vrti staro datoteko iz predpomnilnika.
$opz_vid_v        = '?v=20261026';
$opz_img_collage  = 'https://noriks.com/hr/wp-content/uploads/2026/10/ortopas-hr-9.webp'; // 1) spokojní zákazníci (obrázok) — TODO SK image
$opz_video_relief = $opz_vid_dir . 'relief.mp4' . $opz_vid_v;                                          // 2) prirodzená úľava (video)
$opz_video_cause  = $opz_vid_dir . 'cause.mp4' . $opz_vid_v;                                           // 3) skutočná príčina (video)
$opz_img_indik    = get_template_directory_uri() . '/img/ortopas/ortopas-indikacije.webp?v=20261027'; // lokalizirana grafika indikacij // lokalizirana grafika indikacij // 5) ako funguje (obrázok) — TODO SK image
$opz_video_feat   = $opz_vid_dir . 'features.mp4' . $opz_vid_v;                                        // 6) inovatívne vlastnosti (video)

/* Karty (kruhové videá) — 4) sekcia s 3 kartami */
$opz_cards = array(
    array(
        'video' => $opz_vid_dir . 'card-1.mp4' . $opz_vid_v,
        'title' => 'Облекчава оплакванията',
        'text'  => 'Може да осигури бързо облекчение при ишиас и болки в гърба',
    ),
    array(
        'video' => $opz_vid_dir . 'card-2.mp4' . $opz_vid_v,
        'title' => 'Разтоварване на кръстния отдел',
        'text'  => 'Стабилизира и подрежда кръста',
    ),
    array(
        'video' => $opz_vid_dir . 'card-3.mp4' . $opz_vid_v,
        'title' => 'Доказан метод',
        'text'  => 'Основан на прицелена компресионна технология',
    ),
);

/* Porovnávacia tabuľka — 7) sekcia. array( názov, NORIKS(bool), Fyzio(bool) ) */
$opz_cmp_rows = array(
    array( 'Облекчение на болката',          true,  true  ),
    array( 'Дълготраен ефект',               true,  false ),
    array( 'Изгодна цена',                   true,  false ),
    array( 'Незабавно облекчение',           true,  false ),
    array( 'Без чакане',                     true,  false ),
    array( '60-дневна гаранция за връщане',  true, false ),
    array( 'Дългосрочни разходи',            false, true  ),
);
/* Recenzie s obrázkom — 8) sekcia */
$opz_reviews = array(
    array(
        'img'   => get_template_directory_uri() . '/img/ortopas-reviews/review-1.webp?v=20261026',
        'title' => 'Голяма помощ срещу болките в кръста',
        'text'  => 'Коланът NORIKS наистина много ми облекчи живота. Работи точно както обещава. Отново мога да се навеждам без болка.',
        'name'  => 'Елисавета М.',
    ),
    array(
        'img'   => get_template_directory_uri() . '/img/ortopas-reviews/review-2.webp?v=20261026',
        'title' => 'Мек и удобен',
        'text'  => 'Моят физиотерапевт ми препоръча колан срещу болки в гърба. Преди пробвах и други колани, но този е много по-удобен за седене и навеждане. Въпреки това дава отлична опора!',
        'name'  => 'Юлия У.',
    ),
    array(
        'img'   => get_template_directory_uri() . '/img/ortopas-reviews/review-3.webp?v=20261026',
        'title' => 'Отлично!',
        'text'  => 'Помага ми да седя изправен и имам усещането, че ходя по-изправен. Болките значително намаляха и най-накрая мога да се изправя без болка и след по-дълго седене. Нося колана около 2 – 3 часа дневно – предимно на работа.',
        'name'  => 'Иван Д.',
    ),
);

$opz_yes = '<svg class="opz-yes" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M5 12.5l4 4 10-10" fill="none" stroke="#22a45d" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$opz_no  = '<svg class="opz-no" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M7 7l10 10M17 7L7 17" fill="none" stroke="#dc3545" stroke-width="2.4" stroke-linecap="round"/></svg>';
?>

<!-- ============ 1) Над 14 000 доволни клиенти ============ -->
<section class="opz-why opz-customers">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <img loading="lazy" decoding="async" src="<?php echo esc_url( $opz_img_collage ); ?>" alt="Доволни клиенти на ортопедичния колан NORIKS" />
    </div>
    <div class="opz-col opz-copy">
      <div class="opz-stars" aria-hidden="true">★★★★★</div>
      <h2 class="opz-title">Над 14 000 доволни клиенти</h2>
      <p class="opz-sub">Хиляди хора вече замениха всекидневната болка в гърба за стабилност и облекчение — на работа, зад волана и вкъщи.</p>
    </div>
  </div>
</section>

<!-- ============ 2) Естествено облекчение на болката ============ -->
<section class="opz-why">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <video src="<?php echo esc_url( $opz_video_relief ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Естествено облекчение на болката</h2>
      <p>Когато поставите колана NORIKS, усъвършенстваната технология с <strong>две компресионни зони</strong> осигурява правилно подреждане на бедрата и кръста ви. Това може да стабилизира гръбнака ви и да разтовари седалищния нерв.</p>
      <p>Обикновено би трябвало да минете през дълга физиотерапия, за да постигнете това облекчение. Коланът NORIKS позволява <strong>да усетите облекчението в реално време</strong> — докато работите или сте в движение с близките си.</p>
      <p>Веднага щом кръстът и бедрата ви са правилно подкрепени, натискът върху седалищния нерв може да намалее. Това може да означава <strong>по-малко болка и по-голяма подвижност</strong>.</p>
    </div>
  </div>
</section>

<!-- ============ 3) Истинската причина за болките в гърба и ишиаса ============ -->
<section class="opz-why opz-cause">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <video src="<?php echo esc_url( $opz_video_cause ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Истинската причина за болките в гърба и ишиаса</h2>
      <p>Часовете, прекарани на бюро, повтарящите се движения или тежката физическа работа могат да създадат <strong>неравномерен натиск върху междупрешленните дискове</strong>. В комбинация с неправилна стойка това може в рамките на години да причини значително увреждане на гръбнака.</p>
      <p>В резултат дисковете може да се изместят от положението си и да притиснат седалищния нерв, което причинява <strong>пареща болка, бодежи и дори слабост</strong>, които се разпространяват от кръста надолу по краката.</p>
    </div>
  </div>
</section>

<!-- ============ 4) Prirodzená úľava (3 karty) ============ -->
<section class="opz-why opz-cards">
  <div class="opz-wrap">
    <h2 class="opz-cards-title">Естествено облекчение при ишиас и болки в гърба</h2>
    <div class="opz-cards-grid">
      <?php foreach ( $opz_cards as $opz_card ) : ?>
        <div class="opz-card">
          <div class="opz-card-media">
            <video src="<?php echo esc_url( $opz_card['video'] ); ?>" muted autoplay loop playsinline preload="metadata"></video>
          </div>
          <div class="opz-card-head">
            <span class="opz-check" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="22" height="22"><circle cx="12" cy="12" r="12" fill="#28a745"/><path d="M7 12.5l3 3 7-7" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <h3 class="opz-card-title"><?php echo esc_html( $opz_card['title'] ); ?></h3>
          </div>
          <p class="opz-card-text"><?php echo esc_html( $opz_card['text'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 5) Как работи коланът NORIKS? ============ -->
<section class="opz-why">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <img loading="lazy" decoding="async" src="<?php echo esc_url( $opz_img_indik ); ?>" alt="Показания — при какво помага ортопедичният колан NORIKS" />
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Как работи коланът NORIKS?</h2>
      <p>Коланът NORIKS <strong>целенасочено стабилизира</strong> областта L5 на гръбнака с помощта на <strong>целенасочена компресия</strong>, подрежда правилно таза и връща сакроилиачната става в естествения ѝ обхват на движение.</p>
      <p><strong>Подкрепя проблемната област</strong>, може да разтовари междупрешленните дискове и така да намали натиска върху седалищния нерв.</p>
      <p>Прицелената компресия подпомага кръвообращението, с което може да се подкрепи процесът на самовъзстановяване.</p>
      <p>Тази комбинация може да осигури бързо облекчение при ишиас, болки в гърба и проблеми със сакроилиачната става, както и <strong>дълготрайно намаляване на болката</strong> при редовна употреба.</p>
    </div>
  </div>
</section>

<!-- ============ 6) Иновативни характеристики ============ -->
<section class="opz-why">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-media">
      <video src="<?php echo esc_url( $opz_video_feat ); ?>" muted autoplay loop playsinline preload="metadata"></video>
    </div>
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Иновативни характеристики</h2>
      <p><strong>Тънък и практичен:</strong> Разработен за всекидневна употреба и пасва удобно под повечето дрехи, така че никой няма да забележи, че го носите!</p>
      <p><strong>Регулируема компресия:</strong> Позволява ви да нагласите степента на опора според нуждите си и осигурява максимален комфорт.</p>
      <p>Достъпът до физиотерапевти и специалисти по болка често е ограничен и свързан с високи разходи и загуба на време. <strong>Коланът NORIKS предлага професионално решение на най-високо ниво</strong> и представлява ефективна и достъпна алтернатива.</p>
    </div>
  </div>
</section>

<!-- ============ 7) Коланът NORIKS в сравнение (tabuľka) ============ -->
<section class="opz-why opz-compare">
  <div class="opz-wrap opz-row">
    <div class="opz-col opz-copy">
      <h2 class="opz-title">Коланът NORIKS в сравнение</h2>
      <p class="opz-sub">Действа прицелено върху кръста, за да намали натоварването.</p>
    </div>
    <div class="opz-col">
      <table class="opz-table">
        <thead>
          <tr>
            <th class="opz-th-feat"></th>
            <th class="opz-th-brand">NORIKS</th>
            <th class="opz-th-alt">Физиотерапия</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $opz_cmp_rows as $opz_r ) : ?>
            <tr>
              <th class="opz-feat"><?php echo esc_html( $opz_r[0] ); ?></th>
              <td class="opz-brand"><?php echo $opz_r[1] ? $opz_yes : $opz_no; ?></td>
              <td class="opz-alt"><?php echo $opz_r[2] ? $opz_yes : $opz_no; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ 8) Recenzie zákazníkov (s obrázkom) ============ -->
<section class="opz-why opz-reviews">
  <div class="opz-wrap">
    <div class="opz-reviews-grid">
      <?php foreach ( $opz_reviews as $opz_rev ) : ?>
        <div class="opz-review">
          <div class="opz-review-media">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( $opz_rev['img'] ); ?>" alt="Коланът NORIKS — отзив на клиент <?php echo esc_attr( $opz_rev['name'] ); ?>" />
          </div>
          <div class="opz-review-stars" aria-hidden="true">★★★★★</div>
          <h3 class="opz-review-title"><?php echo esc_html( $opz_rev['title'] ); ?></h3>
          <p class="opz-review-text"><?php echo esc_html( $opz_rev['text'] ); ?></p>
          <div class="opz-review-name"><?php echo esc_html( $opz_rev['name'] ); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  /* Žiadny odkaz "Tabuľka veľkostí" na páse (ani plugin, ani globálny). */
  .noriks-global-sizechart, .gck-size-link, .gck-size-link-wrap,
  #open-size-chart, #open-size-chartCustom { display: none !important; }

  /* Krátky opis (short description) pásu: skry štandardné odrážky (•),
     zostane len ✅ z textu; trochu odsadenia medzi "Prednosti:" a zoznamom.
     (Táto šablóna sa načíta len na orto-ortopas stránkach.) */
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

  .opz-why { padding: 44px 0; }
  .opz-why.opz-customers { background: #f7f7f7; }
  .opz-wrap { max-width: 1180px; margin: 0 auto; padding: 0 16px; }
  .opz-row { display: grid; grid-template-columns: 1fr 1fr; gap: 44px; align-items: center; }
  .opz-media img,
  .opz-media video { width: 100%; height: auto; border-radius: 12px; display: block; }
  .opz-stars { color: #f5a623; font-size: 24px; letter-spacing: 2px; margin-bottom: 10px; }
  .opz-title { font-size: clamp(26px,3.2vw,40px); font-weight: 800; color: #1c1c1c; line-height: 1.15; margin: 0 0 16px; }
  .opz-copy p { font-size: 16px; line-height: 1.7; color: #333; margin: 0 0 14px; }
  .opz-sub { font-size: 17px; line-height: 1.6; color: #333; margin: 0; }

  /* --- 4) sekcia s kartami (sivé ozadie / noriks štýl) --- */
  .opz-why.opz-cards { background: #f7f7f7; }
  .opz-cards-title { text-align: center; font-size: clamp(22px,2.6vw,30px); font-weight: 800; color: #1c1c1c; margin: 0 0 32px; line-height: 1.2; }
  .opz-cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
  .opz-card { background: #fff; border-radius: 14px; padding: 26px 22px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
  .opz-card-media { width: 108px; height: 108px; margin: 0 auto 18px; border-radius: 50%; overflow: hidden; }
  .opz-card-media video { width: 100%; height: 100%; object-fit: cover; display: block; }
  .opz-card-head { display: flex; align-items: center; justify-content: center; gap: 8px; margin: 0 0 10px; }
  .opz-check { flex: 0 0 auto; line-height: 0; }
  .opz-card-title { font-size: 18px; font-weight: 800; color: #1c1c1c; margin: 0; line-height: 1.2; }
  .opz-card-text { font-size: 14px; line-height: 1.55; color: #555; margin: 0; }

  /* --- porovnávacia tabuľka (noriks zelený štýl) --- */
  .opz-why.opz-compare { background: #f7f7f7; }
  .opz-table { width: 100%; border-collapse: separate; border-spacing: 0; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,0.07); }
  .opz-table th, .opz-table td { padding: 13px 14px; text-align: center; vertical-align: middle; }
  .opz-table thead th { background: #22a45d; color: #fff; font-size: 15px; font-weight: 800; }
  .opz-table thead .opz-th-feat { background: #22a45d; }
  .opz-table .opz-feat { background: #22a45d; color: #fff; font-weight: 700; text-align: left; font-size: 14px; line-height: 1.25; width: 55%; }
  .opz-table tbody tr td { border-bottom: 1px solid #eee; background: #fff; }
  .opz-table tbody tr:last-child td,
  .opz-table tbody tr:last-child .opz-feat { border-bottom: 0; }
  .opz-table .opz-brand { background: #f2fbf6; }
  .opz-yes, .opz-no { display: inline-block; vertical-align: middle; }

  /* --- 8) recenzie zákazníkov (s obrázkom) --- */
  .opz-reviews-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
  .opz-review { background: #fafafa; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; }
  .opz-review-media { width: 100%; aspect-ratio: 1 / 1; background: #eee; }
  .opz-review-media img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .opz-review-stars { color: #f5b301; font-size: 20px; letter-spacing: 2px; margin: 16px 0 8px; }
  .opz-review-title { font-size: 17px; font-weight: 800; color: #1c1c1c; margin: 0 14px 10px; line-height: 1.25; }
  .opz-review-text { font-size: 14px; line-height: 1.6; color: #444; margin: 0 16px 14px; }
  .opz-review-name { font-size: 13px; font-style: italic; font-weight: 700; color: #333; border-top: 1px solid #e6e6e6; margin: 0 16px; padding: 12px 0 18px; }

  @media (max-width: 820px) {
    .opz-row { grid-template-columns: 1fr; gap: 22px; }
    .opz-title { text-align: left; }
    .opz-cards-grid { grid-template-columns: 1fr; gap: 16px; }
    .opz-reviews-grid { grid-template-columns: 1fr; gap: 18px; }
    .opz-table th, .opz-table td { padding: 11px 10px; }
    .opz-table .opz-feat { font-size: 13px; }
    .opz-table thead th { font-size: 14px; }
  }
</style>
