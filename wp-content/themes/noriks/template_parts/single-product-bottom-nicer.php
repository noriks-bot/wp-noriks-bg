
<?php
/* Bunion / ortopas / fisiorest: vlastné why-sekcie (bez return — potom beží
   spoločný systém recenzií). Ostatné produkty sa nedotknú. */
if ( function_exists( 'noriks_is_type' ) ) {
    if ( noriks_is_type( 'bunion' ) ) {
        get_template_part( 'template_parts/product-bottom/why-bunion' );
    } elseif ( noriks_is_type( 'ortopas' ) ) {
        get_template_part( 'template_parts/product-bottom/why-ortopas' );
    } elseif ( noriks_is_type( 'fisiorest' ) ) {
        get_template_part( 'template_parts/product-bottom/why-fisiorest' );
    } elseif ( noriks_is_type( 'norikshers' ) ) {
        get_template_part( 'template_parts/product-bottom/why-norikshers' );
    } elseif ( noriks_is_type( 'leakboxers' ) ) {
        get_template_part( 'template_parts/product-bottom/why-leakboxers' );
    } elseif ( noriks_is_type( 'kompresijske-majice' ) ) {
        get_template_part( 'template_parts/product-bottom/why-kompresijske-majice' );
    } elseif ( noriks_is_type( 'ortopedski-jastuk' ) ) {
        // ERGOSIT ORTOPEDICKY VANKUS (orto-ortopedski-jastuk) — novy produkt, why-sekcie
        get_template_part( 'template_parts/product-bottom/why-ortopedski-jastuk' );
    } elseif ( noriks_is_type( 'kneefix' ) ) {
        get_template_part( 'template_parts/product-bottom/why-kneefix' );
    } elseif ( noriks_is_type( 'controlpro' ) ) {
        get_template_part( 'template_parts/product-bottom/why-controlpro' );
    } elseif ( noriks_is_type( 'kidsnest' ) ) {
        get_template_part( 'template_parts/product-bottom/why-kidsnest' );
    } elseif ( noriks_is_type( 'kompresijske-nogavice' ) ) {
        get_template_part( 'template_parts/product-bottom/why-kompresijske' );
    } elseif ( noriks_is_type( 'cloath' ) ) {
        get_template_part( 'template_parts/product-bottom/why-cloath' );
    } elseif ( noriks_is_type( 'cloud' ) ) {
        get_template_part( 'template_parts/product-bottom/why-cloud' );
    } elseif ( noriks_is_type( 'hyd' ) ) {
        get_template_part( 'template_parts/product-bottom/why-hyd' );
    } elseif ( noriks_is_type( 'snug' ) ) {
        get_template_part( 'template_parts/product-bottom/why-snug' );
    } elseif ( noriks_is_type( 'kompwom' ) ) {
        get_template_part( 'template_parts/product-bottom/why-kompwom' );
    } elseif ( noriks_is_type( 'bowl' ) ) {
        get_template_part( 'template_parts/product-bottom/why-bowl' );
    } elseif ( noriks_is_type( 'winecooler' ) ) {
        get_template_part( 'template_parts/product-bottom/why-winecooler' );
    } elseif ( noriks_is_type( 'pal' ) ) {
        get_template_part( 'template_parts/product-bottom/why-pal' );
    } elseif ( noriks_is_type( 'red' ) ) {
        get_template_part( 'template_parts/product-bottom/why-red' );
    } elseif ( noriks_is_type( 'kneeheat' ) ) {
        get_template_part( 'template_parts/product-bottom/why-kneeheat' );
    } elseif ( noriks_is_type( 'slabproof' ) ) {
        get_template_part( 'template_parts/product-bottom/why-slabproof' );
    } elseif ( noriks_is_type( 'tradesman' ) ) {
        get_template_part( 'template_parts/product-bottom/why-tradesman' );
    } elseif ( noriks_is_type( 'slim' ) ) {
        get_template_part( 'template_parts/product-bottom/why-slim' );
    }
}
?>
<?php
if (  has_term( array( 'startovi-paketi', 'startovaci-balicek','orto-starter' ), 'product_cat', get_the_id() )  )   :
?>



<section  class="why-section">
  <div style="max-width: 1440px;" class="container why-container">

    <!-- Left Video -->
    <div class="why-col">
      <div class="video-wrapper">
          <img style="" src="https://noriks.com/bg/wp-content/uploads/2026/02/starter-1_sk.png">
      </div>
    </div>

    <!-- Right Content -->
    <div class="why-col why-content">
      <h2 style="color: #222; text-align:left; margin-left: 20px; font-family: 'Barlow', sans-serif; color:#222223;">
ЗАЩО ХОРАТА ИЗБИРАТ СТАРТОВИЯ ПАКЕТ?
      </h2>

      <div style="margin-left: 20px;" class="why-point">
        <p  style="    font-style: italic;
    line-height: 1.2;"  ><strong>"Взех го, защото не бях сигурен дали ще ми стане." Мартин – София



</strong><span style="font-weight:normal;">Мартин – София</span></p>
        <p class="description">Много клиенти започват със стартовия пакет, за да го изпробват първо.



</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p  style="    font-style: italic;
    line-height: 1.2;" ><strong>"След първото носене веднага поръчах още."



</strong><span style="font-weight:normal;">Петър – Пловдив</span></p>
        <p class="description">Над 95 % от клиентите поръчват отново след покупката на стартовия пакет. Не защото са го планирали, а защото разликата в кройката, комфорта и качеството се усеща още първия ден.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p  style="    font-style: italic;
    line-height: 1.2;"  ><strong>"Материалът и кройката ме убедиха." 



</strong><span style="font-weight:normal;">Георги – Варна</span></p>
        <p class="description">Тениската и боксерките са меки, леки и приятни за кожата. Стартовият пакет е най-честата причина NORIKS бързо да стане част от вашия всекидневен гардероб.



</p>
      </div>
    </div>

  </div>
</section>



<section style="background: white;" class="why-section">
   <div style="max-width: 1440px;" class="container why-container">

    <!-- Left Video -->
    <div class="why-col">
      <div class="video-wrapper">
           <img style="" src="https://noriks.com/bg/wp-content/uploads/2026/02/starter-2_sk.png">
      </div>
    </div>

    <!-- Right Content -->
    <div class="why-col why-content">
      <h2 style="color: #222; text-align:left; margin-left: 20px; font-family: 'Barlow', sans-serif; color:#222223;">
КОМБИНАЦИЯТА, КОЯТО СЕ НОСИ ВСЕКИ ДЕН

      </h2>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Създадени за комфорт през целия ден


</strong></p>
        <p class="description">Тениската и боксерките са създадени така, че да се носят от сутрин до вечер, без нагласяне и без неудобство. Всичко стои на мястото си, не притиска и позволява свободно движение през целия ден.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Кройка, която се приспособява към фигурата


</strong></p>
        <p class="description">Кройката на тениската подчертава горната част на тялото, а боксерките дават достатъчно място и стабилност, без да се повдигат. Резултатът е усещане за сигурност, отпускане и елегантен вид във всяка ситуация.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Качество, което усещате веднага

</strong></p>
        <p class="description">Материалите са меки, дишащи и приятни за кожата, а след пране не губят формата си. Още от първото носене е ясно защо тази комбинация бързо става част от всекидневния ви гардероб.

</p>
      </div>
    </div>

  </div>
</section>






<section class="why-section">
   <div style="max-width: 1440px;" class="container why-container">

    <!-- Left Video -->
    <div class="why-col">
      <div class="video-wrapper">
          <img style="" src="https://noriks.com/bg/wp-content/uploads/2026/02/starter-3_sk.png">
      </div>
    </div>

    <!-- Right Content -->
    <div class="why-col why-content">
      <h2 style="color: #222; text-align:left; margin-left: 20px; font-family: 'Barlow', sans-serif; color:#222223;">
НАЙ-ЛЕСНИЯТ И НАЙ-БЕЗОПАСЕН СТАРТ
      </h2>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Най-нисък възможен риск


</strong></p>
        <p class="description">Защото ви позволява да изпитате качеството без голяма инвестиция.
Вместо да купувате няколко броя наведнъж, получавате една тениска и едни боксерки – точно колкото да разберете как стоят, как се носят и как се усеща материалът.

</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Създаден за първата стъпка


</strong></p>
        <p class="description">Стартовият пакет е предвиден като първо изживяване, не като запас.
Достъпен е само веднъж на клиент и на специална цена, така че решението е лесно и без размисъл.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Изживяване, което се повтаря


</strong></p>
        <p class="description">Повечето мъже след това продължават с NORIKS, защото разбират разликата в кройката, комфорта и качеството.
Но първата стъпка е тази – най-малък риск, най-чисто впечатление.

</p>
      </div>
    </div>

  </div>
</section>



<?php endif; ?>







<?php 
if (  has_term( array( 'teniski', 'tricka',  'orto-tricka', 'orto-majica-darila' ), 'product_cat', get_the_id() )  ||  has_term( array( 'komplekti', 'sady' ), 'product_cat', get_the_id() )) : 
?>
    <?php // Nove sekcije (2026-10-28); pogoj ostaja nespremenjen.
    include get_template_directory() . '/template_parts/product-bottom/why-majice.php'; ?>
<?php endif; ?>







<!-- here we include new file BOXERIRICE-->

<?php if ( has_term( array( 'boksarki', 'boxerky', 'orto-boxerky' ), 'product_cat', get_the_ID() )  && !has_term( 'black-friday', 'product_cat', get_the_ID() ) ): ?>
    <?php // Nove sekcije (2026-10-28); pogoj ostaja nespremenjen.
    include get_template_directory() . '/template_parts/product-bottom/why-bokserice.php'; ?>
<?php endif; ?>

<!-- end BOXERICE -->






<style>
    .most-popular {
    
        padding-top: 20px;
    
    }
</style>










<!--  BOXERICE stylee -->


















  
  
  <style>
      
      .comparison-section-gray  {
         border-radius: 5px;
        }
              
      .comparison-intro-gray  {
           margin-bottom: 0;
        }
      
  </style>
  <div  style="background: #f9f9f9; padding-top: 30px;" >
<section style="background: #f9f9f9; max-width: 1440px;" class="comparison-section comparison-section-gray">
    <div style="background: #f9f9f9;padding: 0;padding-left: 10px;
    padding-right: 10px;" class="comparison-intro comparison-intro-gray ">
      <!--<h4 style="" class="highlight"><?php echo get_field("singlepp_content_standard_reviews_t1","options"); ?></h4>-->
      <h1 style="color:black;     margin-bottom: 4px;">
          
          <?php if ( function_exists('noriks_is_type') && noriks_is_type('slim') ): ?>Не сте единствената, която търси гладка линия под облеклото.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ): ?>Не сте единственият, чиито стъпала след цяла смяна в работни обувки не могат да дочакат почивка.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ): ?>Не сте единственият, чиито стъпала горят след цяла смяна на крак.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('fisiorest') ): ?>
          
          
          
          Не сте сами в търсенето на облекчение от напрежението в шията.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bunion') ): ?>
          
          
          
          Не сте сами в търсенето на облекчение от изкривения палец.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopas') ): ?>
          
          
          
          Не сте сами в търсенето на облекчение за гърба.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ): ?>
          
          
          
          Не сте сами в търсенето на идеалните компресионни чорапи.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bokserice') ): ?>
          
          
          
          Не сте сами в търсенето на идеалните боксерки.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('norikshers') ): ?>

          Не сте сами в търсенето на гладка кожа без бръчки.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('leakboxers') ): ?>

          Не сте сами в търсенето на надеждна защита от изпускане на урина.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice') ): ?>

          Не сте сами в търсенето на по-изчистен силует и по-добра стойка.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk') ): ?>

          Не сте сами в търсенето на седене без болка.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ): ?>Не сте единственият, на когото упражненията на Кегел не донесоха резултат.
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kneefix') ): ?>

           Не сте единствените, които търсят по-стабилно коляно.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ): ?>Хиляди мъже вече използват NORIKS ControlPro — истинско съпротивление вместо свиване напразно.
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kneefix') ): ?>Хиляди клиенти вече носят ортезата NORIKS KneeFix за по-стабилно коляно – по стълби, на разходка и при дълго стоене.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kidsnest') ): ?>

          Не сте сами в търсенето на спокоен детски сън.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ): ?>

          Не сте единствените, чието вино в чашата се затопля твърде бързо.

          <?php elseif ( !has_term( array( 'bokserice', 'bokserice-sastavi-paket' ), 'product_cat', get_the_ID() ) ): ?>

          <?php echo get_field("singlepp_content_standard_reviews_t2","options"); ?>

          <?php else: ?>

          Не сте сами в търсенето на идеалните боксерки.

          <?php endif; ?>
          
          
          </h1>
    <p class="note" style="color: black; margin-top: 0px; margin-bottom: 5px;"><?php if ( function_exists('noriks_is_type') && noriks_is_type('slim') ): ?>Хиляди жени вече носят NORIKS Slim – оформящо бельо, което изглажда линията и остава на място.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ): ?>Хиляди работници вече работят с чорапите NORIKS Tradesman – мека подложка, подсилена пета и лента под свода.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ): ?>Хиляди майстори вече работят с чорапите NORIKS SlabProof – зоново ватиране там, където стъпката удря най-силно, подсилени пета и пръсти и сухи стъпала през цялата смяна.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('fisiorest') ): ?>Хиляди хора вече използват NORIKS NeckRelax за по-малко болка и напрежение в шията – тракция, вибрации и топлина в един уред.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bunion') ): ?>Хиляди хора вече носят коректора NORIKS за по-малко болка и по-изправен палец – вкъщи, пред телевизора или докато спят.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopas') ): ?>Хиляди хора вече носят ортопедичния колан NORIKS за по-малко болка и по-стабилен гръб – в работата, при вдигане и при дълго седене.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ): ?>Хиляди мъже вече носят компресионните чорапи NORIKS за по-леки и по-малко уморени крака – в работата, в пътуване и при тренировка.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bokserice') ): ?>Хиляди мъже вече носят боксерките NORIKS – комфорт, който издържа целия ден.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('norikshers') ): ?>Хиляди жени вече използват силиконовите колагенови лепенки HERS за по-гладка, по-стегната и по-млада на вид кожа.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('leakboxers') ): ?>Хиляди мъже вече носят абсорбиращите боксерки NORIKS за сухота и самочувствие – без подложки и пелени.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice') ): ?>Хиляди мъже вече носят компресионната тениска NORIKS за изгладен корем, по-добра стойка и повече самочувствие.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk') ): ?>Хиляди клиенти вече използват ортопедичната възглавница NORIKS ErgoSit за седене без болка в опашната кост, гърба и бедрата – в колата, в офиса и вкъщи.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kidsnest') ): ?>Хиляди родители вече замениха обикновената възглавница с NORIKS KidsNest – по-тихи нощи, дишане през носа и сън, който наистина възстановява.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ): ?>Хиляди хора вече охлаждат виното си с NORIKS WineCooler – пръчка от неръждаема стомана с наливник, без кофичка с лед и без разводнено вино.<?php else: ?><?php echo get_field("singlepp_content_standard_reviews_t3","options"); ?><?php endif; ?></p>
    </div>
  </section>
  </div>
  
  
  <style>
      @media (max-width: 768px) {
          
          .basic-reviews-section  {
               padding-left: 0px;
               padding-right: 0px;
            }
            .review .content {
                font-size: 13px;
            }
            .review .info {
                font-size: 13px;
                line-height: 1.3;
            }
            .review {
  
                padding-bottom: 15px;
                margin-bottom: 16px;

            }
      }
  </style>
  
  
  <style>
.loader {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #f5a623;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 0.8s linear infinite;
  margin: 0 auto;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.extra-review-group {
  opacity: 0;
  transition: opacity 0.5s ease;
}

.extra-review-group.show {
  opacity: 1;
}
</style>







<?php 
  // ===== CONFIG: LANGUAGE & DATA =====
  $reviews_language = get_field("webshop_language", "options");
  if (!$reviews_language) { $reviews_language = "EN"; }
  
  
  $reviews_language = "BG";

  // Detect if current product belongs to bokserice group
  $current_product_id = (function_exists('is_product') && is_product()) ? get_queried_object_id() : get_the_id();
  $is_bokserice_page = ( function_exists('noriks_is_type') && noriks_is_type('bokserice') );
  $is_ortopas_page    = ( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) );
  $is_bunion_page     = ( function_exists('noriks_is_type') && noriks_is_type('bunion', $current_product_id) );
  $is_fisiorest_page  = ( function_exists('noriks_is_type') && noriks_is_type('fisiorest', $current_product_id) );
  $is_norikshers_review_page = ( function_exists('noriks_is_type') && noriks_is_type('norikshers', $current_product_id) );
  $is_leakboxers_page = ( function_exists('noriks_is_type') && noriks_is_type('leakboxers', $current_product_id) );
  $is_kompmajice_page = ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice', $current_product_id) );
  $is_kidsnest_page   = ( function_exists('noriks_is_type') && noriks_is_type('kidsnest', $current_product_id) );
  $is_kneefix_page    = ( function_exists('noriks_is_type') && noriks_is_type('kneefix', $current_product_id) );
  $is_jastuk_page     = ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk', $current_product_id) );

  // Fallback product name shown in review cards.
  $rv_fallback_title = ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ) ? 'Компресионни чорапи NORIKS'
                     : ( $is_ortopas_page ? 'Ортопедичен колан NORIKS'
                     : ( $is_bunion_page ? 'Коректор за палец NORIKS'
                     : ( $is_fisiorest_page ? 'NORIKS NeckRelax'
                     : ( $is_kneefix_page ? 'NORIKS KneeFix ортеза за коляно'
                     : ( $is_kidsnest_page ? 'NORIKS KidsNest възглавница'
                     : ( $is_jastuk_page ? 'NORIKS ErgoSit ортопедична възглавница'
                     : ( $is_leakboxers_page ? 'NORIKS абсорбиращи боксерки'
                     : ( $is_kompmajice_page ? 'NORIKS FIT компресионна тениска'
                     : ( $is_norikshers_review_page ? 'NORIKS HERS' : 'Една сива тениска' ) ) ) ) ) ) ) ) );
  if ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ) { $rv_fallback_title = 'NORIKS ControlPro тренажор за тазово дъно'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('hyd') ) { $rv_fallback_title = 'NORIKS HYD'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('cloud') ) { $rv_fallback_title = 'NORIKS Cloud'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('cloath') ) { $rv_fallback_title = 'Polar NORIKS Cloth XXL'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('snug') ) { $rv_fallback_title = 'NORIKS Snug възглавница за цяло тяло'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('kompwom') ) { $rv_fallback_title = 'NORIKS FIT Woman оформяща тениска'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('pal') ) { $rv_fallback_title = 'NORIKS Pal бастун'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('bowl') ) { $rv_fallback_title = 'NORIKS Bowl ортопедична купа за куче'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ) { $rv_fallback_title = 'NORIKS WineCooler охладител за вино'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('red') ) { $rv_fallback_title = 'NORIKS RedRelief терапия с червена светлина'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('kneeheat') ) { $rv_fallback_title = 'NORIKS KneeHeat уред за затопляне и масаж на коляното'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ) { $rv_fallback_title = 'NORIKS SlabProof™ работни чорапи'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ) { $rv_fallback_title = 'Работни чорапи NORIKS Tradesman'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('slim') ) { $rv_fallback_title = 'NORIKS Slim оформящи бикини'; }

  // Include review pools (own pool per product group)
if ( function_exists('noriks_is_type') && noriks_is_type('snug') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_snug.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('kompwom') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_kompwom.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('bowl') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_bowl.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_winecooler.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('pal') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_pal.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('red') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_red.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('kneeheat') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_kneeheat.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_slabproof.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_tradesman.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('slim') ) {
  include get_stylesheet_directory() . '/auto_reviews/BG_slim.php';
} else
if ( function_exists('noriks_is_type') && noriks_is_type('hyd') ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_hyd.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('cloud') ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_cloud.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('cloath') ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_cloath.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_controlpro.php';
  } elseif ( $is_kneefix_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_kneefix.php';
  } elseif ( $is_kidsnest_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_kidsnest.php';
  } elseif ( $is_jastuk_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_ortopedski_jastuk.php';
  } elseif ( $is_leakboxers_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_leakboxers.php';
  } elseif ( $is_kompmajice_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_kompresijske-majice.php';
  } elseif ( $is_norikshers_review_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_norikshers.php';
  } elseif ( $is_fisiorest_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_fisiorest.php';
  } elseif ( $is_bunion_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_bunion.php';
  } elseif ( $is_ortopas_page ) {
    include get_stylesheet_directory() . '/auto_reviews/BG_ortopas.php';
  } elseif ( ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ) ) {
      include get_stylesheet_directory() . '/auto_reviews/BG_nogavice.php';
  } elseif ( ! $is_bokserice_page )  {
    include get_stylesheet_directory() . '/auto_reviews/'.$reviews_language.'.php';
  } else {
    include get_stylesheet_directory() . '/auto_reviews/BG_bokserice.php';
  }

  include get_stylesheet_directory() . '/auto_reviews/'.$reviews_language.'-2.php';

  // Ensure arrays exist
  $auto_reviews_en   = is_array($auto_reviews_en)   ? $auto_reviews_en   : [];
  $auto_reviews_ship = isset($auto_reviews_ship) && is_array($auto_reviews_ship) ? $auto_reviews_ship : [];

  // ===== HELPERS: STABLE DAILY RANDOMIZATION =====

  /**
   * Get WP/Woo timezone (fallback Europe/Ljubljana).
   */
  function reviews_wp_tz(): DateTimeZone {
    $tz_string = function_exists('wp_timezone_string') ? wp_timezone_string() : (get_option('timezone_string') ?: 'Europe/Ljubljana');
    return new DateTimeZone($tz_string ?: 'Europe/Ljubljana');
  }

  /**
   * Deterministic "random" integer in [0, $mod-1] from a seed string.
   */
  function stable_mod_index(string $seed, int $mod): int {
    if ($mod <= 0) return 0;
    $h = substr(sha1($seed), 0, 8); // 32-bit slice
    $n = hexdec($h);
    return (int) ($n % $mod);
  }

  /**
   * Deterministic shuffle based on a seed string. (Stable for a given seed.)
   */
  function shuffle_with_seed(array $arr, string $seed): array {
    if (empty($arr)) return $arr;
    $keys = array_keys($arr);
    usort($keys, function($a, $b) use ($seed) {
      $ha = sha1($seed . ':' . $a);
      $hb = sha1($seed . ':' . $b);
      return strcmp($ha, $hb);
    });
    $out = [];
    foreach ($keys as $k) { $out[] = $arr[$k]; }
    return $out;
  }

  /**
   * Build/caches a pool of products: [['title'=>..., 'url'=>...], ...]
   */
  function get_wc_product_pool(
      $transient_key = 'reviews_product_pool_cache_v4_bg2',
      $ttl = 12 * HOUR_IN_SECONDS
  ) {
      if ( ! function_exists( 'wc_get_products' ) ) {
          return [];
      }

      $product_id = 0;
      if ( function_exists( 'is_product' ) && is_product() ) {
          $product_id = get_queried_object_id();
      }

      $is_bokserice = false;
      $is_norikshers = false;
      $is_kidsnest  = false;
      $is_jastuk    = false;
      $is_fisiorest = false;
      $is_bunion = false;
      $is_ortopas = false;
      $is_nogavice = false;
      if ( $product_id ) {
          $is_bokserice = ( function_exists('noriks_is_type') && noriks_is_type('bokserice', $product_id) );
          $is_norikshers = ( function_exists('noriks_is_type') && noriks_is_type('norikshers', $product_id) );
          $is_kidsnest  = ( function_exists('noriks_is_type') && noriks_is_type('kidsnest', $product_id) );
          $is_jastuk    = ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk', $product_id) );
          $is_fisiorest = ( function_exists('noriks_is_type') && noriks_is_type('fisiorest', $product_id) );
          $is_bunion = ( function_exists('noriks_is_type') && noriks_is_type('bunion', $product_id) );
          $is_ortopas = ( function_exists('noriks_is_type') && noriks_is_type('ortopas', $product_id) );
          $is_nogavice = ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice', $product_id) );
      }

      /* Kljuc se izpelje iz tipa izdelka — rocni seznam zastavic je zaostajal
         za vejami in je npr. KneeFixu stregel predpomnjeni bazen majic. */
      $noriks_key_type = 'all';
      if ( function_exists( 'noriks_is_type' ) ) {
          foreach ( array( 'kneefix', 'kidsnest', 'ortopedski-jastuk', 'leakboxers', 'kompresijske-majice', 'norikshers', 'fisiorest', 'bunion', 'ortopas', 'kompresijske-nogavice', 'nosilka', 'controlpro', 'dental', 'hairmagic', 'norikshersbrush', 'noriks-cards', 'cloath', 'bra', 'hyd', 'snore', 'cloud', 'bokserice' ) as $t ) {
              if ( noriks_is_type( $t, $product_id ) ) { $noriks_key_type = $t; break; }
          }
      }
      $cache_key = $transient_key . '_' . $noriks_key_type;

      if ( function_exists( 'get_transient' ) ) {
          $cached = get_transient( $cache_key );
          if ( ! empty( $cached ) && is_array( $cached ) ) {
              return $cached;
          }
      }

      $args = [
          'status'  => 'publish',
          'limit'   => -1,
          'return'  => 'ids',
          'orderby' => 'date',
          'order'   => 'DESC',
      ];

      if ( $is_kidsnest ) {
          $args['category'] = [ 'orto-kidsnest' ];
      } elseif ( $is_jastuk ) {
          $args['category'] = [ 'orto-ortopedski-jastuk' ];
      } elseif ( $is_norikshers ) {
          $args['category'] = [ 'orto-norikshers', 'orto-noriks-hers' ];
      } elseif ( $is_bokserice ) {
          $args['category'] = [ 'boksarki', 'boxerky' ];
      } elseif ( $is_fisiorest ) {
        $args['category'] = [ 'orto-fisiorest', 'fisiorest' ];
    } elseif ( $is_bunion ) {
        $args['category'] = [ 'orto-bunion', 'bunion' ];
    } elseif ( $is_ortopas ) {
        $args['category'] = [ 'orto-ortopas', 'ortopas' ];
    } elseif ( $is_nogavice ) {
        $args['category'] = [ 'chorapi', 'ponozky', 'orto-kompresijske-carape' ];
    } elseif ( function_exists('noriks_is_type') && noriks_is_type('kneefix', $product_id) ) {
        $args['category'] = [ 'orto-kneefix' ];
      } elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro', $product_id) ) {
        $args['category'] = [ 'orto-controlpro' ];
    } elseif ( function_exists('noriks_is_type') && noriks_is_type('leakboxers', $product_id) ) {
        $args['category'] = [ 'orto-leak-boxers', 'leak-boxers' ];
    } elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice', $product_id) ) {
        $args['category'] = [ 'orto-kompresijske-majice', 'kompresijske-majice' ];
    } else {
          // Stranice majica: bazen SAMO iz kategorije majica (s podkategorijama).
          // Prije je uzimao sve osim bokserica, pa su recenzije o majicama
          // zavrsavale pod orto proizvodima (Cloth XXL, Cool Curl…).
          $args['category'] = [ 'teniski', 'tricka' ];
      }

      // BG: izdelki, ki so samo dodatna ponudba (Mystery), ne sodijo med imena izdelkov v mnenjih
      if ( function_exists( 'noriks_bg_skriti' ) ) { $args['exclude'] = noriks_bg_skriti(); }
      $ids = wc_get_products( $args );

      $pool = [];
      if ( ! empty( $ids ) ) {
          foreach ( $ids as $pid ) {
              $title = get_the_title( $pid );
              $url   = get_permalink( $pid );
              if ( $title && $url ) {
                  $pool[] = [
                      'title' => $title,
                      'url'   => $url,
                  ];
              }
          }
      }

      if ( function_exists( 'set_transient' ) ) {
          set_transient( $cache_key, $pool, $ttl );
      }

      return $pool;
  }

  /**
   * Load avatar images from theme folder and return URLs.
   * Expected folders:
   *  - /auto_reviews/bokserice-slike/
   *  - /auto_reviews/majice-slike/
   */
  function get_review_avatar_pool(string $type = 'majice'): array {
    $type = ($type === 'boxerky') ? 'bokserice' : 'majice';

    $dir_path = trailingslashit(get_stylesheet_directory()) . 'auto_reviews/' . $type . '-slike/';
    $dir_url  = trailingslashit(get_stylesheet_directory_uri()) . 'auto_reviews/' . $type . '-slike/';

    if ( ! is_dir($dir_path) ) return [];

    $files = glob($dir_path . '*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
    if (empty($files)) return [];

    $urls = [];
    foreach ($files as $f) {
      $base = basename($f);
      if ($base && $base[0] !== '.') {
        $urls[] = $dir_url . rawurlencode($base);
      }
    }
    return $urls;
  }

  /**
   * Assign avatars (some real, some placeholder) deterministically per day + review index.
   * If real image is chosen, sets $r['avatar_url'].
   */
  function assign_avatars_stable(array $reviews, array $avatar_pool, string $daily_seed, string $context_seed = 'product', int $real_probability_percent = 60): array {
    $count = count($avatar_pool);
    foreach ($reviews as $i => &$r) {
      $r['avatar_url'] = '';

      if ($count <= 0) continue;

      $roll = stable_mod_index($daily_seed . ':avatar-roll:' . $context_seed . ':' . $i, 100);
      if ($roll < max(0, min(100, $real_probability_percent))) {
        $pick_i = stable_mod_index($daily_seed . ':avatar-pick:' . $context_seed . ':' . $i, $count);
        $r['avatar_url'] = $avatar_pool[$pick_i] ?? '';
      }
    }
    return $reviews;
  }
  
  
  
  /**
 * Avatar images rules:
 * - First $first_n reviews ALWAYS get an image (if available)
 * - Remaining images (unique) are placed randomly within reviews [$range_start .. $range_end]
 * - Each image can appear ONLY once
 * - Deterministic per day (stable daily seed)
 */
function assign_unique_avatars_first3_then_random_until30(
  array $reviews,
  array $avatar_pool,
  string $daily_seed,
  string $context_seed = 'product',
  int $first_n = 3,
  int $range_start = 3,   // 0-based index: review #4
  int $range_end = 30     // 1-based count: up to review #30 -> last index 29
): array {
  $total = count($reviews);
  if ($total <= 0) return $reviews;

  // Ensure key exists and default is placeholder
  foreach ($reviews as &$r) { $r['avatar_url'] = ''; }
  unset($r);

  if (empty($avatar_pool)) return $reviews;

  // Deterministic shuffle of images (stable per day)
  $pool = shuffle_with_seed($avatar_pool, 'avatar-pool:' . $daily_seed . ':' . $context_seed);
  $pool_count = count($pool);

  // 1) First N reviews always get images (as many as available)
  $first_n = max(0, min($first_n, $total, $pool_count));
  for ($i = 0; $i < $first_n; $i++) {
    $reviews[$i]['avatar_url'] = $pool[$i] ?? '';
  }

  // If no more images left, finish
  if ($pool_count <= $first_n) return $reviews;

  // 2) Randomly place remaining images from review #4 to #30 (indexes 3..29)
  $last_index = min($total - 1, $range_end - 1);
  if ($last_index < $range_start) return $reviews;

  $eligible = range($range_start, $last_index);

  // Deterministic shuffle of eligible positions (stable per day)
  $eligible = shuffle_with_seed($eligible, 'avatar-positions:' . $daily_seed . ':' . $context_seed);

  $remaining_images = array_slice($pool, $first_n);
  $take = min(count($remaining_images), count($eligible));

  for ($j = 0; $j < $take; $j++) {
    $pos = $eligible[$j];
    $reviews[$pos]['avatar_url'] = $remaining_images[$j] ?? '';
  }

  return $reviews;
}
  
  
  
  /**
 * Assign avatars for first N reviews:
 * - Use each real image at most once (no repeats).
 * - Only apply to first $use_first_n reviews.
 * - After that (or if pool runs out), use placeholder (avatar_url = '').
 * Deterministic per day.
 */
function assign_unique_avatars_first_n(array $reviews, array $avatar_pool, string $daily_seed, string $context_seed = 'product', int $use_first_n = 10): array {
  $total = count($reviews);
  if ($total <= 0) return $reviews;

  // Ensure every review has the key
  foreach ($reviews as &$r) { $r['avatar_url'] = ''; }
  unset($r);

  if (empty($avatar_pool)) return $reviews;

  // Deterministic shuffled image order for the day + context
  $shuffled_pool = shuffle_with_seed($avatar_pool, 'avatar-pool:' . $daily_seed . ':' . $context_seed);

  // We can only place as many images as we have, and only in first N reviews
  $limit = min($use_first_n, $total, count($shuffled_pool));

  for ($i = 0; $i < $limit; $i++) {
    $reviews[$i]['avatar_url'] = $shuffled_pool[$i] ?? '';
  }

  return $reviews;
}

  /**
   * Assign a deterministic product (title+url) to each review for the day.
   * Stable per day AND per review index.
   */
  function assign_products_stable(array $reviews, array $product_pool, string $daily_seed): array {
    $count = count($product_pool);
    foreach ($reviews as $i => &$r) {
      if ($count > 0) {
        $pick = $product_pool[ stable_mod_index($daily_seed . ':prod:' . $i, $count) ];
        $r['product_title'] = $pick['title'];
        $r['product_url']   = $pick['url'];
      } else {
        $r['product_title'] = $r['product_title'] ?? '';
        $r['product_url']   = $r['product_url']   ?? '';
      }
    }
    return $reviews;
  }

  /**
   * Distribute review dates backward from today to a cutoff date (inclusive),
   * with a deterministic per-day count using the daily seed.
   */
  function assign_dates_stable(array $reviews, string $cutoff_date_string = '20.6.2025', int $min_per_day = 2, int $max_per_day = 9, string $display_format = 'j.n.Y'): array {
    if (empty($reviews)) return $reviews;

    $tz      = reviews_wp_tz();
    $today   = new DateTime('today', $tz);
    $today->modify('-7 days'); // newest review date = today - 7 days
    $cutoff  = DateTime::createFromFormat('j.n.Y', $cutoff_date_string, $tz) ?: new DateTime('20.6.2025', $tz);
    if ($cutoff > $today) $cutoff = clone $today;

    $daily_seed = $today->format('Y-m-d');
    $reviews    = shuffle_with_seed($reviews, 'reviews-order:' . $daily_seed);

    $total    = count($reviews);
    $assigned = 0;
    $day_off  = 0;

    while ($assigned < $total) {
      $date = (clone $today)->modify("-{$day_off} days");
      if ($date < $cutoff) $date = clone $cutoff;

      $span   = max(0, $max_per_day - $min_per_day);
      $add    = ($span > 0) ? (stable_mod_index('perday:'.$daily_seed.':'.$day_off, $span + 1)) : 0;
      $perday = $min_per_day + $add;

      $take = min($perday, $total - $assigned);
      for ($i = 0; $i < $take; $i++) {
        $reviews[$assigned]['assigned_date'] = $date->format($display_format);
        $assigned++;
      }

      $day_off++;
      if ($date == $cutoff && $assigned >= $total) break;
    }

    foreach ($reviews as &$r) {
      if (empty($r['assigned_date'])) $r['assigned_date'] = $cutoff->format($display_format);
    }
    return $reviews;
  }

  // ===== BUILD FOR TODAY =====
  $tz         = reviews_wp_tz();
  $today_obj  = new DateTime('today', $tz);
  $daily_seed = $today_obj->format('Y-m-d');

  // Avatar pools based on page category
  $avatar_type = $is_bokserice_page ? 'bokserice' : 'majice';
  // Belt + bunion + fisiorest + norikshers + leak boxers + kompresijske majice + jastuk + kidsnest: text-only reviews (no avatar images).
  $noriks_no_photos = function_exists('noriks_is_type') && (
        noriks_is_type('kompresijske-nogavice') ||
        noriks_is_type('ortopas') ||
        noriks_is_type('bunion') ||
        noriks_is_type('fisiorest') ||
        noriks_is_type('kneefix') ||
        noriks_is_type('kidsnest') ||
        noriks_is_type('ortopedski-jastuk') ||
        noriks_is_type('leakboxers') ||
        noriks_is_type('kompresijske-majice') ||
        noriks_is_type('norikshers') ||
        noriks_is_type('nosilka') ||
        noriks_is_type('controlpro') ||
        noriks_is_type('dental') ||
        noriks_is_type('hairmagic') ||
        noriks_is_type('norikshersbrush') ||
        noriks_is_type('noriks-cards') ||
        noriks_is_type('cloath') ||
        noriks_is_type('bra') ||
        noriks_is_type('hyd') ||
        noriks_is_type('snore') ||
        noriks_is_type('cloud') ||
        noriks_is_type('snug') ||
        noriks_is_type('kompwom') ||
        ( noriks_is_type('bowl') || noriks_is_type('winecooler') ) ||
        noriks_is_type('pal') ||
        noriks_is_type('red') ||
        noriks_is_type('kneeheat') ||
        noriks_is_type('slabproof') ||
        noriks_is_type('tradesman') ||
        noriks_is_type('slim')
  );
  // fotografije osoba: samo na odjeci (majice, bokserice, kompleti), ne na ortopedskim pomagalima
  // MAJICE i BOKSERICE: recenzije BEZ fotografija - isti uvjet kao nove why sekcije.
  $noriks_no_photos = $noriks_no_photos
    || has_term( array( 'teniski', 'tricka', 'orto-tricka', 'orto-majica-darila' ), 'product_cat', get_the_ID() )
    || has_term( array( 'komplekti', 'sady' ), 'product_cat', get_the_ID() )
    || has_term( array( 'boksarki', 'boxerky', 'orto-boxerky' ), 'product_cat', get_the_ID() );
  $avatar_pool = $noriks_no_photos ? array() : get_review_avatar_pool($avatar_type);

  // On single-product landing pages (leak boxers / kompresijske majice) the cards should
  // reference THIS product (via $rv_fallback_title), not random pool products.
    // Izdelki z lastnim imenom v karticah mnenj ne smejo dobiti nakljucnega izdelka iz kataloga.
  $rv_own_name = ( function_exists('noriks_is_type') && (
      noriks_is_type('cloud') || noriks_is_type('cloath') || noriks_is_type('hyd') || noriks_is_type('snug')
   || noriks_is_type('kompwom') || ( noriks_is_type('bowl') || noriks_is_type('winecooler') ) || noriks_is_type('pal') || noriks_is_type('red') || noriks_is_type('kneeheat') || noriks_is_type('slabproof') || noriks_is_type('tradesman') || noriks_is_type('slim')
   || noriks_is_type('controlpro') || noriks_is_type('kidsnest') || noriks_is_type('ortopedski-jastuk')
   || noriks_is_type('bunion') || noriks_is_type('fisiorest') || noriks_is_type('ortopas')
   || noriks_is_type('norikshers') || noriks_is_type('kompresijske-nogavice') ) );
  $product_pool = ( $is_leakboxers_page || $is_kompmajice_page || $is_kneefix_page || $rv_own_name ) ? array() : get_wc_product_pool();

  // 1) Stable daily shuffle of review pools
  $auto_reviews_en   = shuffle_with_seed($auto_reviews_en,   'pool-en:'   . $daily_seed);
  $auto_reviews_ship = shuffle_with_seed($auto_reviews_ship, 'pool-ship:' . $daily_seed);

  // 2) Stable product assignment for the day
  $auto_reviews_en   = assign_products_stable($auto_reviews_en,   $product_pool, $daily_seed);
  $auto_reviews_ship = assign_products_stable($auto_reviews_ship, $product_pool, $daily_seed);

  // 3) Deterministic date distribution back to cutoff 20.06.2025
  $auto_reviews_en   = assign_dates_stable($auto_reviews_en,   '20.6.2025', 2, 9, 'j.n.Y');
  $auto_reviews_ship = assign_dates_stable($auto_reviews_ship, '20.6.2025', 2, 9, 'j.n.Y');


  // 4) Deterministic avatars (some real, some placeholder)
$auto_reviews_en   = assign_unique_avatars_first3_then_random_until30($auto_reviews_en,   $avatar_pool, $daily_seed, 'product', 3, 3, 30);

$auto_reviews_ship = assign_unique_avatars_first_n($auto_reviews_ship, $avatar_pool, $daily_seed, 'shipping', 0);

  
  

  // ===== PAGINATION CHUNKS =====
  $initial_count = 18;   // show on load
  $load_count    = 9;    // per "load more"

  $initial_product   = array_slice($auto_reviews_en, 0, $initial_count);
  $remaining_product = array_slice($auto_reviews_en, $initial_count);
  $chunks_product    = array_chunk($remaining_product, $load_count);

  $initial_ship   = array_slice($auto_reviews_ship, 0, $initial_count);
  $remaining_ship = array_slice($auto_reviews_ship, $initial_count);
  $chunks_ship    = array_chunk($remaining_ship, $load_count);

  // Dynamic counts
  $prod_count = count($auto_reviews_en);
  $ship_count = count($auto_reviews_ship);
?>

<?php if ( $is_ortopas_page || $is_bunion_page || $is_fisiorest_page || $is_norikshers_review_page || $is_jastuk_page || $is_kidsnest_page || $is_kneefix_page ) : ?>
<style>/* belt + bunion + fisiorest + norikshers + jastuk + kidsnest: text-only reviews, no avatar */ #reviews-section .avatar { display: none !important; }</style>
<?php endif; ?>

<section id="reviews-section" class="basic-reviews-section" style="margin-bottom:40px!important;padding-bottom:40px!important;">
  <div class="container basic-reviews-section-container" style="width:100%;max-width:1440px;padding-top:20px!important;margin:0 auto;padding-left: 10px; padding-right: 10px;">

    <!-- Tabs -->
    <div class="reviews-tabs" style="display:flex;gap:18px;border-bottom:1px solid #cbc8c8;margin-bottom:18px;">
      <button type="button" class="reviews-tab is-active" data-tab="product"
        style="appearance:none;background:#00000008;border:1px solid #cbc8c8;border-bottom:0;padding:8px 14px;border-radius:0;font-weight:700;">
        <?php echo esc_html__('Отзиви за продукта', 'your-textdomain'); ?> (692)
      </button>
      <button type="button" class="reviews-tab" data-tab="shipping"
        style="appearance:none;background:transparent;border:1px solid transparent;border-bottom:0;padding:8px 14px;border-radius:0;font-weight:700;">
        <?php echo esc_html__('Отзиви за доставката', 'your-textdomain'); ?> (389)
      </button>
    </div>

    <!-- PRODUCT GRID (default visible) -->
    <div class="reviews-grid" id="reviews-grid-product">
      <?php if (!empty($initial_product)) : foreach ($initial_product as $review) :
        $name  = $review['name'] ?? 'Анонимен';
        $text  = $review['text'] ?? '';
        $title = !empty($review['product_title']) ? $review['product_title'] : $rv_fallback_title;
        $url   = !empty($review['product_url'])   ? $review['product_url']   : '#';
        $stars = '★★★★★';
        $date_display = $review['assigned_date'] ?? '';
        $avatar_url   = !empty($review['avatar_url']) ? $review['avatar_url'] : '';
      ?>
        <article class="review-card">
          <div class="card-top">
            <h3 class="product-title"><a href="<?php echo esc_url($url); ?>">
              <?php echo esc_html($title); ?>
            </a></h3>
            <div class="date">
              <?php echo esc_html($date_display); ?>
            </div>
          </div>
          <div class="stars"><?php echo $stars; ?></div>
          <div class="identity">
            <?php if ($avatar_url) : ?>
              <div class="avatar"><img src="<?php echo esc_url($avatar_url); ?>" alt="" loading="lazy" /></div>
            <?php else : ?>
              <div class="avatar">👤</div>
            <?php endif; ?>
            <div class="name"><?php echo esc_html($name); ?></div>
            <span class="verified"><?php _e('Потвърдено','your-textdomain'); ?></span>
          </div>
          <div class="content"><?php echo esc_html($text); ?></div>
        </article>
      <?php endforeach; endif; ?>
    </div>

    <!-- SHIPPING GRID (hidden initially) -->
    <div class="reviews-grid" id="reviews-grid-shipping" style="display:none;">
      <?php if (!empty($initial_ship)) : foreach ($initial_ship as $review) :
        $name  = $review['name'] ?? 'Анонимен';
        $text  = $review['text'] ?? '';
        $title = !empty($review['product_title']) ? $review['product_title'] : $rv_fallback_title;
        $url   = !empty($review['product_url'])   ? $review['product_url']   : '#';
        $stars = '★★★★★';
        $date_display = $review['assigned_date'] ?? '';
        $avatar_url   = !empty($review['avatar_url']) ? $review['avatar_url'] : '';
      ?>
        <article class="review-card">
          <div class="card-top">
            <h3 class="product-title">
              <a href="<?php echo esc_url($url); ?>">
                <?php echo esc_html($title); ?>
              </a>
            </h3>
            <div class="date">
              <?php echo esc_html($date_display); ?>
            </div>
          </div>
          <div class="stars"><?php echo $stars; ?></div>
          <div class="identity">
            <?php if ($avatar_url) : ?>
              <div class="avatar"><img src="<?php echo esc_url($avatar_url); ?>" alt="" loading="lazy" /></div>
            <?php else : ?>
              <div class="avatar">👤</div>
            <?php endif; ?>
            <div class="name"><?php echo esc_html($name); ?></div>
            <span class="verified"><?php _e('Потвърдено','your-textdomain'); ?></span>
          </div>
          <?php if (!empty($review['headline'])) : ?>
            <div class="headline"><?php echo esc_html($review['headline']); ?></div>
          <?php endif; ?>
          <div class="content"><?php echo esc_html($text); ?></div>
        </article>
      <?php endforeach; endif; ?>
    </div>

  </div>

  <!-- Controls: one CTA row, reused per tab -->
  <div class="container basic-reviews-section-container" style="width:100%;max-width:1100px;margin-top:30px!important;margin:0 auto;">
    <div class="cta-button" style="background:transparent;padding:0;justify-content:left;">
      <a class="cta-button2 button button--xl"
         style="margin:0 auto;text-align:left;background:black;font-family:'Roboto',sans-serif;color:#fff;text-transform:none;font-size:15px;padding:10px 25px;"
         href="#"><?php echo get_field("singlepp_content_standard_reviews_seemore_button","options"); ?></a>
    </div>
    <div id="reviews-loading" style="display:none;text-align:center;padding:15px;">
      <div class="loader"></div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    // Data from PHP (already include product_title/product_url/assigned_date/avatar_url)
    const chunksProduct = <?php echo json_encode($chunks_product); ?>;
    const chunksShip    = <?php echo json_encode($chunks_ship); ?>;

    let nextProduct = 0;
    let nextShip    = 0;

    const tabs    = document.querySelectorAll('.reviews-tab');
    const gridP   = document.getElementById('reviews-grid-product');
    const gridS   = document.getElementById('reviews-grid-shipping');
    const seeMore = document.querySelector('.cta-button2');
    const loader  = document.getElementById('reviews-loading');

    let activeTab = 'product';

    function setTab(tab){
      activeTab = tab;
      tabs.forEach(t=>{
        if(t.dataset.tab === tab){ t.classList.add('is-active'); t.style.background='#00000008'; t.style.borderColor='#e6e6e6'; }
        else{ t.classList.remove('is-active'); t.style.background='transparent'; t.style.borderColor='transparent'; }
      });
      if(tab === 'product'){ gridP.style.display='grid'; gridS.style.display='none'; }
      else{ gridP.style.display='none'; gridS.style.display='grid'; }

      const moreAvail = tab === 'product'
        ? (nextProduct < (chunksProduct?.length || 0))
        : (nextShip < (chunksShip?.length || 0));
      if (seeMore) seeMore.style.display = moreAvail ? 'inline-block' : 'none';
    }

    setTab('product');
    tabs.forEach(btn => btn.addEventListener('click', ()=> setTab(btn.dataset.tab)));

    // Escape helper
    const esc = (str) => String(str ?? '').replace(/[&<>"']/g, s => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'
    }[s]));

    function avatarHtml(avatarUrl){
      if(avatarUrl){
        return `<div class="avatar"><img src="${esc(avatarUrl)}" alt="" loading="lazy" /></div>`;
      }
      return `<div class="avatar">👤</div>`;
    }

    // Append a chunk of cards into a grid
    function appendChunk(grid, chunk){
      chunk.forEach(function(review){
        const article = document.createElement('article');
        article.className = 'review-card is-new';

        const url       = review.product_url   || '#';
        const title     = review.product_title || '<?php echo esc_js($rv_fallback_title); ?>';
        const name      = review.name          || 'Анонимен';
        const text      = review.text          || '';
        const headline  = review.headline      || '';
        const date      = review.assigned_date || '';
        const avatarUrl = review.avatar_url    || '';

        article.innerHTML = `
          <div class="card-top">
            <h3 class="product-title"><a href="${esc(url)}">${esc(title)}</a></h3>
            <div class="date">${esc(date)}</div>
          </div>
          <div class="stars">★★★★★</div>
          <div class="identity">
            ${avatarHtml(avatarUrl)}
            <div class="name">${esc(name)}</div>
            <span class="verified"><?php _e('Потвърдено','your-textdomain'); ?></span>
          </div>
          ${headline ? `<div class="headline">${esc(headline)}</div>` : ''}
          <div class="content">${esc(text)}</div>
        `;
        grid.appendChild(article);
      });
    }

    seeMore && seeMore.addEventListener('click', function(e){
      e.preventDefault();
      seeMore.style.display='none';
      loader.style.display='block';

      setTimeout(function(){
        if(activeTab === 'product' && nextProduct < (chunksProduct?.length || 0)){
          appendChunk(gridP, chunksProduct[nextProduct]);
          nextProduct++;
        }else if(activeTab === 'shipping' && nextShip < (chunksShip?.length || 0)){
          appendChunk(gridS, chunksShip[nextShip]);
          nextShip++;
        }
        loader.style.display='none';
        const moreAvail = activeTab === 'product'
          ? (nextProduct < (chunksProduct?.length || 0))
          : (nextShip < (chunksShip?.length || 0));
        if(moreAvail) seeMore.style.display='inline-block';
      }, 400);
    });
  });
</script>

<!-- new review styling -->
<style>
/* ===== Reviews: Full corrected CSS ===== */

/* Section + container */
#reviews-section{
  font-family: "Roboto", system-ui, -apple-system, Segoe UI, Arial, sans-serif;
  background:#f9f9f9;
}
.basic-reviews-section-container{
  max-width:1440px;
  margin:0 auto;
  padding:0 0px;
}

/* Tabs */
.reviews-tabs{ display:flex; gap:18px; border-bottom:1px solid #eee; margin-bottom:18px; }
.reviews-tab{
  appearance:none; background:transparent; border:1px solid transparent; border-bottom:0;
  padding:8px 14px; font-weight:700; cursor:pointer;
}
.reviews-tab.is-active{ background:#00000008; border-color:#e6e6e6; }

/* Grid */
.reviews-grid{
  display:grid;
  grid-template-columns:repeat(3, 1fr);
  gap:10px;
  width:100%;
}
@media (max-width:1100px){
  .reviews-grid{ grid-template-columns:repeat(2, 1fr); }
}
@media (max-width:640px){
  .reviews-grid{ grid-template-columns:1fr; }
}

/* Card */
.review-card{
  width:100%;
  height:100%;
  background:#fff;
  border:1px solid #efefef;
  border-radius:4px;
  box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
  padding:18px 20px;
  display:flex;
  flex-direction:column;
}

/* Card top */
.review-card .card-top{
  display:flex; align-items:flex-start; justify-content:space-between; gap:12px;
  margin:-2px 0 6px;
}
.review-card .product-title{
  margin:0; font-weight:800; font-size:16px; line-height:1.25;
}
.review-card .product-title a{
  color:#0e0e0e; text-decoration:underline; text-underline-offset:2px;
}
.review-card .date{
  color:#8c8c8c; font-size:13px; white-space:nowrap; margin-top:2px;
}

/* Stars */
.review-card .stars{
  letter-spacing:3px; font-size:18px; color:#0f0f0f; margin:2px 0 10px;
}

/* Identity */
.review-card .identity{
    
  display:flex;
  align-items:flex-start;   /* ⬅️ top-align items */
  gap:12px;
  margin:2px 0 12px;
  
  
}
.review-card .avatar{
  width:32px; height:32px;
  border:1px solid #dfdfdf;
  border-radius:0px;
  display:flex; align-items:center; justify-content:center;
  font-size:18px; color:#000; background:#fff;
  overflow:hidden;
}
.review-card .avatar img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
}
.review-card .name{ font-weight:700; color:#111; font-size:15px; }
.review-card .verified{
  display:inline-block; background:#0f0f0f; color:#fff;
  font-size:12px; font-weight:700; line-height:1;
  padding:5px 8px 4px; border-radius:3px; margin-left:6px;
}

/* Headline + body */
.review-card .headline{ font-weight:800; font-size:16px; color:#111; margin:6px 0 6px; }
.review-card .content{ color:#2b2b2b; font-size:15px; line-height:1.7; }

/* Reveal for appended cards */
.review-card.is-new{ animation:rv-fade .28s ease-out both; }
@keyframes rv-fade{ from{opacity:0; transform:translateY(6px);} to{opacity:1; transform:none;} }

/* Loader */
#reviews-loading .loader{
  width:28px; height:28px; border:3px solid #e6e6e6; border-top-color:#111; border-radius:50%;
  margin:0 auto; animation:rv-spin .75s linear infinite;
}
@keyframes rv-spin{ to{ transform:rotate(360deg);} }



/* Default avatar (placeholder) stays 32x32 */
.review-card .avatar{
  width:32px;
  height:32px;
  border:1px solid #dfdfdf;
  border-radius:0px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:18px;
  color:#000;
  background:#fff;
  overflow:hidden;
}

/* If avatar contains a real image -> make it 80x80 */
.review-card .avatar:has(img){
  width:250px;
  height:250px;
  font-size:0; /* hide any accidental text spacing */
  align-items:stretch;
  justify-content:stretch;
}

.review-card .avatar img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
}

/* ONLY reviews with real image */
.review-card .identity:has(.avatar img){
  display:block;              /* ⬅️ image gets own row */
}

/* Real image wrapper */
.review-card .avatar:has(img){
  width:100%;
  height:auto;
  border:none;
  margin-bottom:10px;
}

/* Real image itself */
.review-card .avatar img{
  width:100%;
  max-width:320px;
  height:auto;
  display:block;
  object-fit:cover;
  border:1px solid #dfdfdf;
  border-radius:4px;
}

/* Name + verified BELOW image */
.review-card .identity:has(.avatar img) .name,
.review-card .identity:has(.avatar img) .verified{
  display:inline-block;
  vertical-align:middle;
}


@media (max-width: 991px){

  /* ONLY reviews with real image */
  .review-card .avatar:has(img){
    max-width:100%;
  }

  .review-card .avatar img{
    width:100%;        /* ✅ full width on mobile */
    max-width:100%;
    height:auto;
  }

}


</style>






<?php
$faq_list = get_field('faq_list', 'option');
$faq_list2 = get_field('faq_list_2', 'option');
$faq_list3 = get_field('faq_list_3', 'option');

$is_ortopas_faq   = ( function_exists('noriks_is_type') && noriks_is_type('ortopas') );
$is_controlpro_faq = ( function_exists('noriks_is_type') && noriks_is_type('controlpro') );
$is_bunion_faq    = ( function_exists('noriks_is_type') && noriks_is_type('bunion') );
$is_fisiorest_faq = ( function_exists('noriks_is_type') && noriks_is_type('fisiorest') );
$is_norikshers_faq = ( function_exists('noriks_is_type') && noriks_is_type('norikshers') );
$is_leakboxers_faq = ( function_exists('noriks_is_type') && noriks_is_type('leakboxers') );
$is_kompmajice_faq = ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice') );
$is_kidsnest_faq   = ( function_exists('noriks_is_type') && noriks_is_type('kidsnest') );
$is_kneefix_faq   = ( function_exists('noriks_is_type') && noriks_is_type('kneefix') );
$is_jastuk_faq     = ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk') );

// ErgoSit ortopedický vankúš — FAQ o produkte (NORIKS).
$jastuk_faq = array(
  array( 'questioon' => 'Как NORIKS ErgoSit облекчава болката при седене?', 'answer' => 'ErgoSit има изрез за опашната кост, който премахва директния натиск върху опашната кост и седалищния нерв, а анатомичната форма от пяна с памет с висока плътност разпределя тежестта равномерно върху бедрата. Така се разтоварват чувствителните точки и се подкрепя здрава, изправена стойка.' ),
  array( 'questioon' => 'Къде мога да използвам възглавницата?', 'answer' => 'Навсякъде, където седите — в колата, на офис стол, на стол за хранене, в инвалидна количка или вкъщи. Стабилната противоплъзгаща основа я държи на място, така че комфортът ви следва през целия ден.' ),
  array( 'questioon' => 'Ще се сплеска ли пяната с времето?', 'answer' => 'Не. ErgoSit използва пяна с памет с висока плътност, която запазва формата и стабилността си и след дълга всекидневна употреба, за разлика от евтините възглавници, които бързо се сплескват.' ),
  array( 'questioon' => 'Може ли калъфът да се пере?', 'answer' => 'Да. Калъфът се сваля и се пере в пералня, така че възглавницата остава свежа и чиста. Платът е дишащ, хипоалергенен и сертифициран OEKO-TEX®.' ),
  array( 'questioon' => 'Ще пасне ли на моя стол или седалка?', 'answer' => 'ErgoSit има универсална форма и пасва на повечето автомобилни седалки, офис и кухненски столове, както и на инвалидни колички. Няма размери — един модел пасва на всички.' ),
  array( 'questioon' => 'След колко време ще усетя разлика?', 'answer' => 'Повечето потребители усещат по-малък натиск върху опашната кост и по-удобно седене още от първия ден. По-добрата стойка и по-малко болки в гърба се подобряват допълнително при редовна употреба.' ),
  array( 'questioon' => 'Има ли гаранция за връщане на парите?', 'answer' => 'Да, всеки NORIKS ErgoSit идва с 60-дневна гаранция за комфорт. Ако не усетите по-малко болка и повече комфорт, свържете се с нас и ще го решим.' ),
);

// NORIKS FIT (kompresné/tvarujúce tričko) — FAQ o produkte (preklad, NORIKS FIT).
$kompmajice_faq = array(
  array( 'questioon' => 'За кого е предназначена NORIKS FIT?', 'answer' => 'NORIKS FIT е създадена за мъже, които искат по-стегнат външен вид, да си върнат увереността в собственото тяло, да коригират стойката си, да се чувстват по-енергични през деня и да изглеждат по-слаби под всяко облекло.' ),
  array( 'questioon' => 'Как всъщност работи тениската NORIKS FIT?', 'answer' => 'NORIKS FIT използва усъвършенстван йонен компресионен плат, който задейства естествената реакция на тялото. Микротканите влакна подпомагат здравото кръвообращение и помагат да задържите изправена стойка от сутрин до вечер. При редовно носене резултатът е видимо по-оформен торс, по-добро подреждане на гръбнака и повече самочувствие.' ),
  array( 'questioon' => 'Колко бързо ще забележа резултати?', 'answer' => 'Всяко тяло е различно, но повечето клиенти съобщават за видима промяна през първите 30 дни. За най-добър ефект носете NORIKS FIT всеки ден и я комбинирайте с балансирано хранене и редовно движение.' ),
  array( 'questioon' => 'Вижда ли се под риза?', 'answer' => 'Не. NORIKS FIT е тънка, дискретна и невидима под всяка риза, като в същото време оформя корема и гърдите и подкрепя стойката.' ),
  array( 'questioon' => 'Как се пере и от какво е изработена?', 'answer' => 'Изработена е от 80 % найлон и 20 % еластан. Перете я в студена вода на деликатна програма, за да запазите компресията и да удължите живота на плата.' ),
);

// NORIKS LEAK BOXERS (inkontinenčné boxerky) — FAQ o produkte (preklad, NORIKS).
$leakboxers_faq = array(
  array( 'questioon' => 'Защо NORIKS избраха над 123 000 мъже?', 'answer' => 'NORIKS са най-абсорбиращите перящи се боксерки при мъжко изпускане на урина: поемат до 300 ml, имат сертификат Oeko-Tex® и не съдържат вредни вещества, перат се и се използват многократно (екологична алтернатива на еднократните подложки), създадени са за комфорт и самочувствие през целия ден. До 87 % от клиентите поръчват отново след първата покупка.' ),
  array( 'questioon' => 'Колко поемат?', 'answer' => 'До 300 ml — почти 3 пъти повече от повечето продукти на пазара. Благодарение на 7-слойното ядро PureDry™ течността се поема веднага и се заключва дълбоко вътре, така че кожата остава суха, а външният слой е водоотблъскващ.' ),
  array( 'questioon' => 'Виждат ли се под облеклото?', 'answer' => 'Не. Боксерките NORIKS са тънки, дискретни и гъвкави — изглеждат и се усещат като обикновено бельо, без обем и без усещане за „пелена“.' ),
  array( 'questioon' => 'Как се перат?', 'answer' => 'Перете на 30 – 40 °C, без омекотител и белина, сушете на въздух. Запазват поемащата си способност през стотици пранета.' ),
  array( 'questioon' => 'Дискретна ли е доставката?', 'answer' => 'Да. Всички поръчки изпращаме в неутрална, дискретна опаковка без видими обозначения на съдържанието, за да защитим вашата поверителност.' ),
  array( 'questioon' => 'От какво са изработени?', 'answer' => 'Външен слой от бамбуково влакно с еластан, 7-слойно абсорбиращо ядро от технически микрофибри и водоотблъскваща дишаща мембрана.' ),
);

// KidsNest детска възглавница — FAQ за продукта (NORIKS, omiljene trditve).
$kneefix_faq = array(
  array(
    'questioon' => 'Подходяща ли е KneeFix за всекидневно носене?',
    'answer'    => 'Да. NORIKS KneeFix е разработена точно за обичайните движения — ходене, работа, качване по стълби или по-дълго стоене.',
  ),
  array(
    'questioon' => 'Мога ли сам да настроя компресията?',
    'answer'    => 'Да. С вграденото прецизно колелце настройвате компресията сами — толкова опора, колкото ви е приятно.',
  ),
  array(
    'questioon' => 'Плъзга ли се ортезата при ходене?',
    'answer'    => 'KneeFix има противоплъзгащ силиконов ръб, който помага да се ограничи плъзгането и навиването на ортезата при носене.',
  ),
  array(
    'questioon' => 'Мога ли да нося ортезата под облеклото?',
    'answer'    => 'Да. Еластичната и тънка кройка позволява удобно носене под повечето обикновени дрехи.',
  ),
  array(
    'questioon' => 'Подходяща ли е ортезата за двете колена?',
    'answer'    => 'При поръчката избирате страната (лява или дясна), така че ортезата пасва точно на коляното, което искате да подкрепите.',
  ),
  array(
    'questioon' => 'Мога ли да нося ортезата по-дълго време?',
    'answer'    => 'Ортезата е разработена за всекидневно носене. Много клиенти я носят на работа, на разходка и при обичайни дейности.',
  ),
  array(
    'questioon' => 'Как да избера размер?',
    'answer'    => 'Размерите се определят според телесното тегло: M (50–75 kg), L (76–90 kg), XL (91–110 kg) и 2XL (110 kg+).',
  ),
);

$kidsnest_faq = array(
  array( 'questioon' => 'Колко бързо ще видя, че дишането през устата спира?', 'answer' => 'Повечето родители забелязват по-тихо дишане и по-малко събуждания с отворена уста през първите 5 – 7 нощи. До 14-ата нощ при повечето деца хъркането се успокоява и устните остават затворени. Пълната разлика — видимо по-добро положение и по-спокоен сън — родителите най-често описват около 21-ия до 30-ия ден. Използвайте я всяка нощ.' ),
  array( 'questioon' => 'За каква възраст е KidsNest?', 'answer' => 'KidsNest се предлага в три размера: 1 – 3, 3 – 9 и 9 – 14 години. Най-важният прозорец е между 3-ата и 9-ата година, когато небцето и челюстта се развиват най-интензивно — но всяка възраст има своя размер и своята полза.' ),
  array( 'questioon' => 'Безопасна ли е? Какво има вътре?', 'answer' => 'KidsNest е изработена от хипоалергенна пяна с памет със сертификат OEKO-TEX® — без формалдехид, тежки метали и BPA. Устойчива е на акари и е дишаща, а калъфът се сваля и се пере в пералня.' ),
  array( 'questioon' => 'Ще я използва ли наистина детето ми?', 'answer' => 'Да. Ергономичната форма се усеща като опора, не като нещо странно — повечето деца свикват за 1 – 2 нощи. Родителите често съобщават, че след първата седмица децата не искат да спят без нея. 3-зоновата структура поема главата естествено — няма „правилен начин“, няма борба преди лягане.' ),
  array( 'questioon' => 'Работи ли, ако детето ми вече диша през устата?', 'answer' => 'Да — точно за такива деца е създадена. 3-зоновата структура помага да се предотврати отмятането на главата назад, заради което устата се отваря в съня. При повечето деца в рамките на 7 – 14 нощи устните се затварят естествено и носовото дишане се връща.' ),
  array( 'questioon' => 'А ако на детето ми не помогне?', 'answer' => 'Оставете детето да спи върху KidsNest 30 нощи. Ако не видите разлика — по-малко дишане през устата, по-тихи нощи, по-спокоен сън — пишете ни и ще ви върнем парите. Без въпроси и без дребен шрифт.' ),
);

// NORIKS HERS — силиконови колагенови лепенки за бръчки и белези — FAQ за продукта (NORIKS).
$norikshers_faq = array(
  array( 'questioon' => 'По какво се различава от обикновените лепенки за бръчки или кремовете за белези?', 'answer' => 'Повечето лепенки за бръчки са от хартия или хидроколоид, а кремовете за белези често остават само на повърхността на кожата. NORIKS HERS използва силикон с клинично качество, на който дерматолозите разчитат от години за видимо подобряване на текстурата на белезите и еластичността на кожата — а сега се използва и за намаляване на бръчките.' ),
  array( 'questioon' => 'Може ли една лепенка наистина да действа и върху бръчки, и върху белези?', 'answer' => 'Да, защото и бръчките, и белезите са проява на разпад на колаген или слабо възстановяване на кожата. Силиконът подпомага задържането на влага, възстановяването на колагена и изглаждането на текстурата на кожата, което е от полза за двете.' ),
  array( 'questioon' => 'След колко време ще видя резултати?', 'answer' => 'Повечето потребители забелязват видимо изглаждане на фините бръчки още след 1 – 3 употреби, а видът на белезите се подобрява за 2 – 3 седмици редовна употреба. По-дълбоките белези и бръчки може да отнемат повече време, но резултатите се натрупват.' ),
  array( 'questioon' => 'Безопасна ли е за чувствителна или склонна към акне кожа?', 'answer' => 'Определено. NORIKS HERS е хипоалергенна, без латекс и достатъчно нежна за чувствителни зони като около очите и устата, и дори за заздравяващи следи от акне. Ако кожата ви е много реактивна, винаги тествайте първо на малък участък.' ),
  array( 'questioon' => 'Колко дълго мога да я нося?', 'answer' => 'За най-добри резултати препоръчваме да носите NORIKS HERS 6 – 8 часа, през нощта. Може да я използвате и през деня — само се погрижете кожата под нея да е чиста и без масла или серуми.' ),
  array( 'questioon' => 'Колко време стига едно руло?', 'answer' => 'В зависимост от това колко често и къде я използвате, едно руло стига за 3 – 6 седмици. Тъй като е многократна, е много по-икономична от еднократните лепенки или кремове.' ),
  array( 'questioon' => 'Ще остане ли на място, докато спя?', 'answer' => 'Да! NORIKS HERS е направена с приятелско към кожата, издръжливо лепило, което следва движенията ви. Дишаща е и остава на място дори при хора, които спят на една страна.' ),
  array( 'questioon' => 'На кои зони мога да я използвам?', 'answer' => 'Навсякъде! Повечето клиенти използват NORIKS HERS за: бръчки на челото, бръчки между веждите, бръчки от усмивка, бръчки на шията, следи от акне, белези от цезарово сечение, стрии, хирургични или следтравмени белези.' ),
  array( 'questioon' => 'Защо NORIKS HERS е по-добра от евтините лепенки онлайн?', 'answer' => 'Много лепенки, продавани онлайн, са с ниско качество, тънки или с лошо лепило. NORIKS HERS използва премиум силикон, тестван в лаборатория за безопасност и издръжливост, и държи на място цяла нощ. Освен това предлагаме отделна клиентска поддръжка и по-бърза замяна, ако ви е нужна помощ.' ),
  array( 'questioon' => 'Има ли гаранция за връщане на парите?', 'answer' => 'Да, предлагаме 30-дневна гаранция без риск. Ако не сте доволни, просто се свържете с нас и ще го решим.' ),
);

// Коректор за изкривен палец — FAQ за продукта (NORIKS).
$bunion_faq = array(
  array( 'questioon' => 'Колко бързо ще се почувствам по-добре?', 'answer' => 'Около 30 минути — толкова време е нужно за облекчаване на дискомфорта. При редовна употреба в рамките на две седмици ще усетите значително облекчение при всекидневни дейности като ходене, стоене или сън.' ),
  array( 'questioon' => 'Колко бързо ще забележа разлика в изкривения палец?', 'answer' => 'В зависимост от тежестта на изкривяването повечето клиенти забелязват видимо подобрение след 4 – 8 седмици. Леко изкривяване: 4 седмици. Средно изкривяване: 4 седмици. По-тежко изкривяване: 8 седмици.' ),
  array( 'questioon' => 'Може ли да се носи в обувки? Мога ли да ходя с него?', 'answer' => 'Не, в обувка не влиза. Да, може да ходите с него. Предназначен е обаче за почивка — когато лежите на дивана, гледате телевизия, четете или спите.' ),
  array( 'questioon' => 'А ако ми е неприятно?', 'answer' => 'Това е напълно нормално! Коректорът NORIKS е създаден достатъчно стабилен, за да изправи ставата на палеца, да спре възпалението и да облекчи дискомфорта. Може да са ви нужни 1 – 2 сесии, за да свикнете, но след това ще се чувствате много по-добре!' ),
  array( 'questioon' => 'Колко дълго да го използвам?', 'answer' => 'Препоръчваме да започнете с 30 минути дневно и постепенно да удължавате до сесия от 1 до 3 часа. Когато ви стане удобно, може да започнете да го носите и докато спите. Носете го по време на почивка — на дивана, пред телевизора, при четене или сън.' ),
  array( 'questioon' => 'Ще помогне ли при моето конкретно състояние?', 'answer' => 'Коректорът NORIKS е идеален за: облекчаване на дискомфорта, който пречи на всекидневни дейности като ходене или стоене; облекчение от дискомфорта, причинен от изкривен палец, по време на почивка или сън; овладяване на изкривен палец в ранна фаза, който може да напредне; изкривен палец, който се е върнал след операция; помощ при по-тежко изкривяване, готово за операция; и като ефективна нехирургична възможност.' ),
  array( 'questioon' => 'Ще пасне ли на моето стъпало? Има ли лява и дясна страна?', 'answer' => 'Независимо от размера на стъпалото — от най-малкото детско до голямо стъпало на възрастен — коректорът NORIKS пасва удобно. Няма страни! Благодарение на нагласящата се конструкция се приспособява еднакво лесно към лявото и към дясното стъпало.' ),
);

// Ортопедичен колан — FAQ за продукта (NORIKS).
$ortopas_faq = array(
  array( 'questioon' => 'Колко бързо ще усетя облекчение на болката?', 'answer' => 'Много потребители усещат забележимо облекчение на ишиаса и болките в кръста веднага след поставянето на колана NORIKS. Прицелената му компресия дава незабавна опора, стабилизира гръбнака и намалява натиска върху нервите. За траен ефект препоръчваме да носите колана последователно според указанията поне две седмици. С времето, при правилна употреба и здрави навици, може да усетите трайно облекчение и по-добра подвижност.' ),
  array( 'questioon' => 'Как се поставя коланът правилно?', 'answer' => 'Носете колана NORIKS около бедрата, точно под линията на талията. Трябва да се намира над кръстната област (долната част на гърба, точно над седалището) и под гребена на таза (горната част на страничните бедра). За повече информация вижте инструкциите за употреба.' ),
  array( 'questioon' => 'Ще отслаби ли коланът мускулите ми?', 'answer' => 'Не, коланът NORIKS не отслабва мускулите като корсет за гърба. Той само помага да задържи сакроилиачните стави заедно и възстановява нормалното напрежение на връзките. Може да го носите седмици или месеци без опасения от мускулна атрофия.' ),
  array( 'questioon' => 'Мога ли да нося колана и докато спя?', 'answer' => 'Да, може да носите колана и през нощта. Продължителността на носене не е ограничена и по-дългото носене няма отрицателни ефекти.' ),
  array( 'questioon' => 'Колко стегнато да го поставя?', 'answer' => 'Коланът трябва да прилепва плътно, но не прекалено стегнато, за да избегнете дискомфорт. Трябва да можете да се движите без проблем, без коланът да се врязва или да се плъзга. Напрежението се настройва лесно с еластичните ленти.' ),
  array( 'questioon' => 'На кого го препоръчвате?', 'answer' => 'На всички, които се борят с болки в кръста, ишиас, мускулно напрежение, дискова херния, болки в бедрата или таза и проблеми със сакроилиачната става. Независимо от възраст, пол, височина и тегло.' ),
  array( 'questioon' => 'Има ли гаранция за връщане на парите?', 'answer' => 'Предлагаме гаранция за удовлетвореност! Ако не сте доволни от колана NORIKS, свържете се с нас на info@noriks.com за връщане и възстановяване в рамките на 30 дни. Срокът се брои от получаването на колана.' ),
);

// NeckRelax — FAQ за продукта (NORIKS).
$fisiorest_faq = array(
  array( 'questioon' => 'Как работи NORIKS NeckRelax?', 'answer' => 'NeckRelax съчетава тракция, топлина и вибрационен масаж с ергономична конструкция от пяна с памет. Тази технология разтяга шията под точно правилния ъгъл и разтоварва шийния отдел на гръбнака. След това успокояващият топъл масаж подпомага притока на богата на кислород и хранителни вещества кръв към мускулите и така помага при възстановяването на тъканите.' ),
  array( 'questioon' => 'С какво NeckRelax е по-добър от други устройства?', 'answer' => 'NORIKS NeckRelax е изключителен, защото съчетава <strong>три терапии в една</strong> — топлина, масаж и лека тракция — които отпускат мускулите и отново подреждат шията за трайно облекчение. Освен това е <strong>безжичен, безопасен за сън и обвит в хладен сатен</strong> за комфорт, какъвто другаде няма да намерите.' ),
  array( 'questioon' => 'Как се използва NeckRelax?', 'answer' => '1. Заредете го с включения USB-C кабел и зарядно за около 4 до 6 часа. 2. Задръжте бутона за масаж или топлина 5 секунди, докато светне индикаторът. 3. С повторно натискане на бутоните сменяте скоростта на масажа и настройките на топлината. 4. Насладете се на отпускащия масаж!' ),
  array( 'questioon' => 'Колко дълго да използвам NeckRelax?', 'answer' => 'Препоръчваме да започнете с 15 минути, за да свикне шията. С времето може да преминете към пълна сесия. За ориентир: цикълът с лека топлина, масаж и тракция продължава 30 минути, което обикновено е идеалното време шията да се отпусне и да възстанови естествената си кривина.' ),
  array( 'questioon' => 'Безжичен ли е NeckRelax?', 'answer' => 'Да! NORIKS NeckRelax е напълно безжичен и презареждащ се за всекидневна употреба.' ),
  array( 'questioon' => 'Как се чисти NeckRelax?', 'answer' => 'Платът е устойчив на масла и прах, но препоръчваме да избършете NeckRelax след употреба с дезинфекцираща кърпичка, тъй като калъфът на възглавницата не може да се пере.' ),
  array( 'questioon' => 'Безопасен ли е за всеки?', 'answer' => 'NORIKS NeckRelax е създаден така, че да е подходящ за всеки, независимо от възраст или пол. Всяка ситуация обаче е различна. За подробни указания според вашите нужди препоръчваме консултация с лекар.' ),
  array( 'questioon' => 'Мога ли да го върна, ако не виждам резултати?', 'answer' => 'Разбира се! Даваме пълна гаранция за връщане на парите в рамките на 30 дни от доставката, ако не сте доволни от продукта. Пишете ни на info@noriks.com и ще отговорим в рамките на 12 часа от получаване на съобщението!' ),
);

// Nahrádza LEN kontajner FAQ o produkte pre 3 orto-produkty;
// kontajnery doručenia/vrátenia zostávajú nedotknuté.
$controlpro_faq = array(
  array( 'questioon' => 'Как се използва?', 'answer' => 'Седнете на стол, поставете уреда <strong>между коленете</strong> и натискайте срещу съпротивлението. Препоръчваме <strong>3 серии по 10 повторения дневно</strong>, което отнема около пет минути.' ),
  array( 'questioon' => 'Трябва ли да се въвежда нещо?', 'answer' => 'Не. Никакви сонди, никакво въвеждане. Уредът работи <strong>извън тялото</strong>.' ),
  array( 'questioon' => 'Кога да очаквам резултати?', 'answer' => 'Повечето потребители съобщават за първи промени след <strong>3 до 6 седмици</strong> редовни упражнения.' ),
  array( 'questioon' => 'Нужни ли са батерии или приложение?', 'answer' => 'Не. Уредът е напълно механичен — без батерии, кабели и приложение. Има само <strong>брояч на повторения</strong>.' ),
  array( 'questioon' => 'С какво се различава от EMS уредите?', 'answer' => 'EMS уредите свиват мускула вместо вас. ControlPro изисква <strong>вие да свършите работата</strong> срещу истинско съпротивление.' ),
  array( 'questioon' => 'Подходящ ли е след операция на простатата?', 'answer' => 'Да, мнозина го използват точно след операция на простатата. Ако сте във възстановителен период, консултирайте се първо с лекар.' ),
  array( 'questioon' => 'Как се чисти?', 'answer' => 'Избършете с влажна кърпа и мек почистващ препарат. Не потапяйте във вода.' ),
  array( 'questioon' => 'Каква е доставката?', 'answer' => 'Доставката е <strong>дискретна</strong>, в неутрална кутия без обозначение на съдържанието.' ),
  array( 'questioon' => 'Мога ли да го върна?', 'answer' => 'Да, имате <strong>30 дни</strong> за връщане на парите. Достатъчен е имейл, без формуляри.' ),
);

$is_cloath_faq = ( function_exists('noriks_is_type') && noriks_is_type('cloath') );
$cloath_faq = array(
  array(
    'questioon' => 'А ако не съм доволен от покупката?',
    'answer'    => 'Имате 30 дни да изпробвате кърпата без риск. Ако не сте доволни от резултата, пишете на нашата поддръжка и ще ви върнем парите — без документи и без обяснения.',
  ),
  array(
    'questioon' => 'От какво е изработена кърпата?',
    'answer'    => 'От плътен микрофибърен плат с двустранен дизайн: влакнестата страна събира мръсотията и водата, а мрежестата полира до блясък. Ръбът е подсилен с мек кант, който не драска.',
  ),
  array(
    'questioon' => 'Защо е по-скъпа от обикновените кърпи?',
    'answer'    => 'Защото е по-плътна и по-тежка от стандартния микрофибър — поема многократно повече вода, не пуска влакна и издържа стотици пранета. Една заменя цяла редица евтини, които след няколко пранета започват да се разнищват.',
  ),
  array(
    'questioon' => 'Колко дълго издържа в сравнение с обикновените?',
    'answer'    => 'При правилна грижа издържа стотици употреби. Кърпите от магазина обикновено след около 20 пранета губят плътност и започват да оставят следи.',
  ),
  array(
    'questioon' => 'Оставя ли следи или петна?',
    'answer'    => 'Не. Благодарение на плътността и двустранния дизайн водата се поема, вместо да се размазва, така че стъклата и огледалата остават без следи — и без влакна.',
  ),
  array(
    'questioon' => 'Как е най-добре да се пере?',
    'answer'    => 'В пералня на 40 °C, с перилен препарат без омекотител (омекотителят запушва влакната и намалява поемаемостта). Не използвайте белина и не сушете в сушилня — сушете на въздух.',
  ),
  array(
    'questioon' => 'Защо на някои снимки кърпата изглежда по-тъмна?',
    'answer'    => 'Заради осветлението. Кърпата е тъмносива с черен кант; при силна светлина изглежда по-светла, а на закрито по-тъмна.',
  ),
  array(
    'questioon' => 'Подходяща ли е за подарък?',
    'answer'    => 'Да — пакетите 3+3 и 8+4 са сред най-честите подаръци за нов дом и за празници. Кърпата идва прегъната и готова за подаряване.',
  ),
);

$is_cloud_faq = ( function_exists('noriks_is_type') && noriks_is_type('cloud') );
$cloud_faq = array(
  array(
    'questioon' => 'А ако възглавницата не ми е удобна?',
    'answer'    => 'Имате 60 нощи за изпробване. Ако не сте доволни, пишете на нашата поддръжка и ще ви върнем цялата сума — без условия и без документи.',
  ),
  array(
    'questioon' => 'Как се използва възглавницата правилно?',
    'answer'    => 'Легнете на една страна, поставете възглавницата между коленете и затегнете лентата около горния крак. Бедрата, тазът и гръбнакът трябва да са в една линия. Лентата може да се свали и възглавницата да се използва под глезените или под шията.',
  ),
  array(
    'questioon' => 'Наистина ли остава на място, когато се обърна?',
    'answer'    => 'Да. Регулируемата лента с тик-так копчета минава около крака и държи възглавницата при коляното, така че не пада като обикновена възглавница. Лентата има две позиции на затягане според обиколката на крака.',
  ),
  array(
    'questioon' => 'От какво е изработена възглавницата?',
    'answer'    => 'Ядрото е от пяна с памет с медицинско качество с перфорации, които осигуряват движение на въздуха. Калъфът е от дишащ плат, сваля се и се пере. Материалите са сертифицирани по OEKO-TEX® STANDARD 100 и CertiPUR-EU.',
  ),
  array(
    'questioon' => 'Твърде твърда ли е или твърде мека?',
    'answer'    => 'Има средна твърдост — достатъчна, за да държи краката разделени цяла нощ, но под натиск се нагажда към формата на коляното. Не се сплесква и след ставане се връща във формата си.',
  ),
  array(
    'questioon' => 'Как се пере?',
    'answer'    => 'Свалете калъфа и го перете в пералня на 40 °C, без омекотител и без белина, сушете на въздух. Не перете пяната в пералня — при нужда я избършете с влажна кърпа и оставете да изсъхне.',
  ),
  array(
    'questioon' => 'Колко време отнема да свикна?',
    'answer'    => 'Повечето потребители усещат разлика още първата или втората нощ. Ако сте свикнали да спите със събрани колене, първите няколко нощи разстоянието може да е необичайно — тялото обикновено се приспособява в рамките на седмица.',
  ),
  array(
    'questioon' => 'Подходяща ли е при бременност?',
    'answer'    => 'Да. При бременност се препоръчва сън на лявата страна, а възглавница между коленете разтоварва бедрата и кръста. При здравословни усложнения се консултирайте с лекар преди употреба.',
  ),
);

$is_hyd_faq = ( function_exists('noriks_is_type') && noriks_is_type('hyd') );
$hyd_faq = array(
  array(
    'questioon' => 'Какво е водородна вода?',
    'answer'    => 'Това е обикновена питейна вода, в която е разтворен молекулярен водород (H₂). Водородът е най-малката молекула, а изследванията го свързват със селективен антиоксидантен ефект.',
  ),
  array(
    'questioon' => 'Колко продължава един цикъл?',
    'answer'    => 'Кратък цикъл продължава 3 минути и дава около 1 600 ppb водород, дълъг — 10 минути и до 3 000 ppb. Цикълът се избира с натискане на бутона.',
  ),
  array(
    'questioon' => 'Влиза ли водата в контакт с пластмаса?',
    'answer'    => 'Не. Бутилката е от боросиликатно стъкло с основа от неръждаема стомана, така че във водата няма вкус на пластмаса, нито частици.',
  ),
  array(
    'questioon' => 'Каква вода мога да използвам?',
    'answer'    => 'Всякаква питейна вода — от чешмата, филтрирана, бутилирана или дестилирана. Благодарение на PEM/SPE мембраната устройството не се нуждае от минерали.',
  ),
  array(
    'questioon' => 'Трябва ли да се сменя филтър?',
    'answer'    => 'Не. Генераторът има постоянен филтър, така че няма консумативи и допълнителни разходи.',
  ),
  array(
    'questioon' => 'Как се зарежда?',
    'answer'    => 'С USB кабел; пълното зареждане отнема 30 до 60 минути и стига за няколко цикъла. Не зареждайте бутилката, докато в нея има вода.',
  ),
  array(
    'questioon' => 'Кога да изпием водата?',
    'answer'    => 'Най-добре веднага след цикъла, в рамките на около 30 минути, защото концентрацията на водород спада с времето.',
  ),
  array(
    'questioon' => 'А ако не съм доволен?',
    'answer'    => 'Имате 30 дни за връщане на парите. Освен това за устройството получавате 1 година гаранция.',
  ),
);

$is_snug = ( function_exists('noriks_is_type') && noriks_is_type('snug') );
$snug_faq = array(
  array(
    'questioon' => 'Какви са размерите на възглавницата?',
    'answer'    => 'Един размер: <strong>105 cm дължина и 30 cm широчина</strong>. Поддържа от рамото до коленете, но не заема цялото легло — затова се държи лесно и лесно се обръщате с нея.',
  ),
  array(
    'questioon' => 'Ще се сплеска ли с времето?',
    'answer'    => 'Не. Пълнежът е от хиляди фини еластични влакна, които се връщат във формата си. Опората, която усещате първата нощ, е същата и след деветдесет нощи.',
  ),
  array(
    'questioon' => 'С какво е пълна?',
    'answer'    => 'С високоеластичен влакнест пълнеж — отвън мек и приятен, отвътре стабилен и поддържащ. Без пяна с памет, която се нагрява.',
  ),
  array(
    'questioon' => 'Как се пере?',
    'answer'    => 'Калъфът се сваля и се пере в пералня на 40 °C. Самата възглавница не перете в пералня — при нужда я проветрете и оставете да изсъхне на въздух.',
  ),
  array(
    'questioon' => 'Подходяща ли е при бременност?',
    'answer'    => 'Да. Формата S поддържа корема отпред и гърба отзад, а препоръчваното положение при бременност е сън на лявата страна. При здравословни усложнения се консултирайте с лекар.',
  ),
  array(
    'questioon' => 'Колко време отнема да свикна?',
    'answer'    => 'Повечето хора намират своето положение до втората нощ. Формата S е различна от права възглавница, така че първите нощи тялото се учи как да легне.',
  ),
  array(
    'questioon' => 'Какви цветове се предлагат?',
    'answer'    => 'Шест цвята: синьо, розово, сиво, зелено, лилаво и тъмносиньо. Цветът се избира на тази страница преди добавяне в количката.',
  ),
  array(
    'questioon' => 'Мога ли да я върна?',
    'answer'    => 'Да, имате <strong>30 дни</strong> за връщане на парите или замяна. Достатъчен е имейл, без формуляри.',
  ),
);

$is_kompwom = ( function_exists('noriks_is_type') && noriks_is_type('kompwom') );
$kompwom_faq = array(
  array(
    'questioon' => 'Как да избера размер?',
    'answer'    => 'Според обиколката на гърдите — тя определя как тениската ще седне на гърдите и раменете. Ако сте между два размера, вземете <strong>по-големия</strong>. Предлагат се размери от S до 3XL.',
  ),
  array(
    'questioon' => 'Вижда ли се под облеклото?',
    'answer'    => 'Не. Плетката е безшевна, тънка и матова, така че изчезва под риза, сако или прилепнала рокля. Няма ръб, който да се очертава.',
  ),
  array(
    'questioon' => 'Навива ли се през деня?',
    'answer'    => 'Не. Компресията се разпределя на ширина, вместо да притиска в една точка, така че тениската остава на място и след цял ден.',
  ),
  array(
    'questioon' => 'Отпечатани ли са 3D линиите?',
    'answer'    => 'Не. Плетката е <strong>втъкана директно в плата</strong>, така че нищо не се напуква и нищо не се отлепва с времето, независимо от броя пранета.',
  ),
  array(
    'questioon' => 'Колко силно стяга?',
    'answer'    => 'Решително, но никога стегнато. Трябва да дишате нормално и да се храните, без да мислите за тениската. Ако следата върху кожата се вижда двадесет минути след събличане, размерът е твърде малък.',
  ),
  array(
    'questioon' => 'Как се пере?',
    'answer'    => 'В пералня на <strong>30 °C</strong>. Без белина, без гладене и без сушилня — оставете да изсъхне на въздух.',
  ),
  array(
    'questioon' => 'Какви цветове се предлагат?',
    'answer'    => 'Три цвята: черно, тъмносиво и розово. Цветът и размерът се избират на тази страница преди добавяне в количката.',
  ),
  array(
    'questioon' => 'Мога ли да я върна?',
    'answer'    => 'Да, имате <strong>30 дни</strong> за връщане на парите или замяна на размера. Достатъчен е имейл, без формуляри.',
  ),
);

$is_slim = ( function_exists('noriks_is_type') && noriks_is_type('slim') );
$slim_faq = array(
  array('questioon' => 'Как да избера размер?',
    'answer'    => 'Измерете <strong>обиколката на талията</strong> на най-тясното място на тялото, малко над пъпа, и я сравнете с таблицата с размери (XS до 5XL). Ако сте между два размера, вземете <strong>по-големия</strong>.'),
  array('questioon' => 'Навиват ли се надолу?',
    'answer'    => 'Не. Широкият кръстосан колан минава около цялата талия — отпред, отстрани и отзад — така че натискът се разпределя, вместо да притиска в една линия. Бикините остават на място и когато седите.'),
  array('questioon' => 'Виждат ли се под облеклото?',
    'answer'    => 'Не. Плетката е тънка и гладка, без плътни шевове, така че изчезват под прилепнали рокли, дънки и клинове.'),
  array('questioon' => 'Носят се вместо бикини или върху тях?',
    'answer'    => 'Както ви е по-удобно. Повечето жени ги носят самостоятелно, като обикновено бельо, но може да ги носите и върху тънки бикини.'),
  array('questioon' => 'Мога ли да ги нося след раждане?',
    'answer'    => 'Много майки ги носят след раждане, защото са меки и дишащи. След цезарово сечение или ако не сте сигурна, консултирайте се с лекаря си преди носене.'),
  array('questioon' => 'Колко стегнато притискат?',
    'answer'    => 'Стабилно, но не стегнато. Трябва да дишате и да седите нормално. Ако някъде притискат или оставят дълбока следа, вземете по-голям размер.'),
  array('questioon' => 'Как се перат?',
    'answer'    => 'На ръка или в пералня на <strong>30 °C</strong> в торбичка за пране. Без белина, гладене и сушилня — сушете на въздух.'),
  array('questioon' => 'Какви цветове се предлагат?',
    'answer'    => 'Шест цвята: черно, телесно, тъмносиньо, лилаво, фуксия и сливово. Цветът и размерът се избират на тази страница преди добавяне в количката.'),
  array('questioon' => 'Мога ли да ги върна?',
    'answer'    => 'Да, имате <strong>30 дни</strong> за връщане на парите или замяна на размера. Достатъчен е имейл, без формуляри.'),
);

$is_tradesman = ( function_exists('noriks_is_type') && noriks_is_type('tradesman') );
$tradesman_faq = array(
  array('questioon' => 'От какво са изработени?',
    'answer'    => '56 % бамбуков лиосел, 38 % найлон и 6 % еластан. Без памук – найлонът е подсилен на петата и пръстите, където чорапите се износват най-много. Естествено устойчиви са на неприятна миризма, отвеждат влагата и са много меки върху кожата.'),
  array('questioon' => 'Какъв размер да избера?',
    'answer'    => 'Според размера обувки (EU): 39–42, 43–45, 46–49. Между два размера сте? Вземете по-големия.'),
  array('questioon' => 'Ще останат ли краката ми сухи?',
    'answer'    => 'Бамбукът отвежда влагата от кожата през цялата смяна, а мрежестата вентилация изпуска потта навън. Няма да спрат потенето, но го държат под контрол – дори в тежки работни обувки.'),
  array('questioon' => 'Няма ли да се свлекат в обувките?',
    'answer'    => 'Не. Двойният ластик с халка за обуване и лентата под свода държат чорапа на място – без събиране и плъзгане през цялата смяна.'),
  array('questioon' => 'Издържат ли дълги смени?',
    'answer'    => 'Да. Меката подложка и подсилената пета омекотяват всяка стъпка – за тези, които са 8–12 часа на крак по бетон, чакъл или неравен терен.'),
  array('questioon' => 'Колко са високи?',
    'answer'    => 'Класическа височина – около 18 cm от петата до ръба на ластика.'),
  array('questioon' => 'Как да ги перем?',
    'answer'    => 'Перете на студено и сушете на въздух. Бамбуковият плат запазва мекотата и формата си и след много пранета.'),
  array('questioon' => 'Мога ли да ги върна?',
    'answer'    => 'Да. Имате 30 дни за връщане на парите. Доставката е безплатна при поръчка над 70 €, а плащате при доставка, когато дойде пратката.'),
);

$is_slabproof = ( function_exists('noriks_is_type') && noriks_is_type('slabproof') );
$slabproof_faq = array(
  array('questioon' => 'Какъв размер да поръчам? Имам голям крак.',
    'answer'    => 'Три размера според размера обувки (EU): <strong>39–42</strong>, <strong>43–45</strong> и <strong>46–49</strong>. Поръчайте обичайното си число обувки.'),
  array('questioon' => 'От вълна ли са? Не понасям, когато драска.',
    'answer'    => 'Никаква вълна, нито едно влакно. Нищо не драска, няма обриви и кракът не се вари в жегата. Плетката отвежда потта от кожата, вместо да го задържа.'),
  array('questioon' => 'Няма ли краката ми да плуват в пот?',
    'answer'    => 'Точно затова са направени така. Въздушната мрежа върху горната част на стъпалото и плетката, която отвежда влагата, изтеглят потта от кожата.'),
  array('questioon' => 'Как да ги перем? Трябва ли да внимавам?',
    'answer'    => 'В пералня на студено, в сушилня на ниска температура, заедно с работното облекло. Без ръчно пране, сушене на простор и специален перилен препарат.'),
  array('questioon' => 'Наистина ли ще издържат, или ще се продупчат като всички останали?',
    'answer'    => 'Петата и пръстите са подсилени с двойно плетен найлон, точно там, където чорапите се скъсват първи. Ако все пак не ви харесат, имате <strong>30 дни за връщане на парите</strong>.'),
  array('questioon' => 'Кога ще усетя разликата?',
    'answer'    => 'Ватирането веднага, когато за първи път се изправите с тях. Това, че не се свличат и остават сухи — по време на смяната. Повечето го забелязват още по пътя към дома на първия ден, а истинският знак е, когато на другата сутрин ги обуете отново.'),
  array('questioon' => 'Колко струва доставката и как се плаща?',
    'answer'    => 'Доставката е <strong>безплатна при поръчки над 70 €</strong>, а плащате при получаване на пратката.'),
  array('questioon' => 'А ако просто не ми харесат?',
    'answer'    => 'Имате <strong>30 дни за връщане на парите</strong>. Ако не сте доволни, пишете ни и ще ви върнем парите.'),
);

$is_bowl = ( function_exists('noriks_is_type') && noriks_is_type('bowl') );
$bowl_faq = array(
  array('questioon' => 'За кои кучета е подходяща купата?',
    'answer'    => 'За <strong>малки породи</strong> — дакел, френски булдог, шнауцер, мопс, малтийско болонче и подобни. Купата има диаметър 15 cm и обем около 430 ml.'),
  array('questioon' => 'За какво служи наклонът 15°?',
    'answer'    => 'Купата е наклонена към кучето, така че храната се свлича към него, а главата и шията са в по-естествено положение. Кучето не трябва да бута муцуната си в ъгъла на купата, нито да извива шия до пода.'),
  array('questioon' => 'Защо е повдигната?',
    'answer'    => 'Поставката с височина 11 cm вдига купата по-близо до височината на кучето, така че то яде изправено, с по-малко извиване на шията и гърба. Това е особено приятно за по-старите кучета.'),
  array('questioon' => 'Мога ли да я използвам за вода?',
    'answer'    => 'Да. Купата е от неръждаема стомана и е подходяща както за храна, така и за вода. Много собственици вземат две — една за храна, една за вода.'),
  array('questioon' => 'Как се чисти?',
    'answer'    => 'Изплакнете купата с топла вода и препарат за съдове. Гладката стомана не поема миризми и не задържа остатъци от храна като пластмасата.'),
  array('questioon' => 'Плъзга ли се по пода?',
    'answer'    => 'Поставката е стабилна и не се обръща, когато кучето яде. На много гладки подове препоръчваме подложка под поставката.'),
  array('questioon' => 'Мога ли да я върна?',
    'answer'    => 'Да, имате <strong>30 дни</strong> за връщане на парите. Достатъчен е имейл, без формуляри.'),
);

$is_pal = ( function_exists('noriks_is_type') && noriks_is_type('pal') );
$pal_faq = array(
  array(
    'questioon' => 'За какво служи втората ръкохватка?',
    'answer'    => 'За <strong>изправяне</strong>. Хващате долната ръкохватка, когато се изправяте от фотьойл, от леглото или от нисък стол — натискът отива вертикално надолу, така че не се налага да се навеждате, нито да молите някого за помощ.',
  ),
  array(
    'questioon' => 'Наистина ли стои сама?',
    'answer'    => 'Да. Основата има <strong>четири гумени крачета</strong>, които държат бастуна изправен, когато го пуснете. Не пада на пода, така че не се налага да се навеждате за него.',
  ),
  array(
    'questioon' => 'Плъзга ли се на гладък под?',
    'answer'    => 'Не. Крачетата са от противоплъзгаща гума и държат на плочки, паркет и ламинат. Основата се приспособява и към неравен терен навън.',
  ),
  array(
    'questioon' => 'Как работи осветлението?',
    'answer'    => 'Осветлението е вградено в ръкохватката и се включва с бутон. Осветява пътя пред вас — за нощен път до банята или за разходка по тъмно.',
  ),
  array(
    'questioon' => 'Какво прави алармата?',
    'answer'    => 'С натискане на бутона се пуска <strong>силен звуков сигнал</strong>, който предупреждава близките, ако паднете или имате нужда от помощ.',
  ),
  array(
    'questioon' => 'Може ли да се настрои височината?',
    'answer'    => 'Да. Височината се настройва за няколко секунди, без инструменти, така че бастунът пасва на всяка фигура.',
  ),
  array(
    'questioon' => 'Сгъва ли се?',
    'answer'    => 'Да. Сгъва се на няколко части и влиза в чанта или в жабката на колата — практично за пътуване и посещения при лекар.',
  ),
  array(
    'questioon' => 'Мога ли да го върна?',
    'answer'    => 'Да, имате <strong>30 дни</strong> за връщане на парите или замяна. Достатъчен е имейл, без формуляри.',
  ),
);

$is_red = ( function_exists('noriks_is_type') && noriks_is_type('red') );
$red_faq = array(
  array(
    'questioon' => 'Как терапията с червена светлина помага при синдром на карпалния тунел?',
    'answer'    => 'Червената и инфрачервената светлина проникват в тъканта и стимулират <strong>производството на клетъчна енергия (ATP)</strong>, което помага да се потуши възпалението около средния нерв, да се подобри кръвообращението и да се подпомогне естественото заздравяване.',
  ),
  array(
    'questioon' => 'След колко време са първите резултати?',
    'answer'    => 'Повечето потребители усещат по-малко нощно изтръпване в рамките на <strong>1 – 2 седмици</strong>. По-забележима промяна в силата на хвата обикновено идва около четвъртата седмица. Препоръчваме редовна всекидневна употреба поне осем седмици.',
  ),
  array(
    'questioon' => 'Безопасно ли е да се използва всеки ден?',
    'answer'    => 'Да. Устройството е предвидено за <strong>всекидневни 15-минутни процедури</strong>. Светлината при тези дози не загрява тъканта. Устройството се изключва само в края на процедурата.',
  ),
  array(
    'questioon' => 'Работи ли и на двете ръце?',
    'answer'    => 'Да, лентата може да се постави <strong>на лявата и на дясната ръка</strong>. Ако имате проблем и на двете ръце, направете две процедури по 15 минути една след друга или изберете пакет с две устройства.',
  ),
  array(
    'questioon' => 'За какви размери ръка е подходяща?',
    'answer'    => 'Еластичната лента с регулируема каишка пасва на <strong>повечето размери ръка на възрастен</strong>, включително по-големите. Отворът за палеца държи устройството на място през цялата процедура.',
  ),
  array(
    'questioon' => 'Какво има в комплекта?',
    'answer'    => '1× лента NORIKS RED, <strong>1× зареждащ кабел USB-C</strong> и инструкция с препоръчан протокол на терапията.',
  ),
  array(
    'questioon' => 'Колко издържа батерията?',
    'answer'    => 'Едно зареждане стига за <strong>до 4 процедури</strong>. Устройството се зарежда през USB-C кабел, така че го зареждате от зарядно за телефон или от лаптоп.',
  ),
  array(
    'questioon' => 'Замества ли лекар?',
    'answer'    => 'Не. NORIKS RED е устройство за домашна употреба и <strong>не замества лекарски преглед</strong>, нито предписано лечение. При трайни или силни оплаквания потърсете лекар.',
  ),
  array(
    'questioon' => 'Мога ли да го върна?',
    'answer'    => 'Да, имате <strong>30 дни</strong> за връщане на парите или замяна. Достатъчен е имейл, без формуляри.',
  ),
);

$is_kneeheat = ( function_exists('noriks_is_type') && noriks_is_type('kneeheat') );
$kneeheat_faq = array(
  array(
    'questioon' => 'Как всъщност работи уредът?',
    'answer'    => 'Топлината до <strong>42 °C</strong> разширява съдовете и улеснява притока на кръв към по-дълбоката тъкан. Ритмичната въздушна компресия изтласква събралата се течност и докарва свежа кръв, а вибрациите <strong>60 Hz</strong> отпускат сковаността около ставата. И трите терапии работят едновременно.',
  ),
  array(
    'questioon' => 'За какви оплаквания е предназначен?',
    'answer'    => 'За хронични, постепенно възникнали оплаквания — сковано, болезнено или подуто коляно, което се появява с възрастта и натоварването. При свежа травма, скорошна операция или нарушения на кръвообращението се консултирайте първо с лекар.',
  ),
  array(
    'questioon' => 'Колко продължава една сесия?',
    'answer'    => '<strong>12 минути.</strong> Уредът се пуска с един бутон и в края на сесията спира сам.',
  ),
  array(
    'questioon' => 'Кога ще усетя разлика?',
    'answer'    => 'Мнозина усещат коляното по-отпуснато още след първата сесия. По-забележима промяна обикновено идва след <strong>7 до 14 дни</strong> всекидневна употреба.',
  ),
  array(
    'questioon' => 'Мога ли да го използвам на двете колена?',
    'answer'    => 'Да. Наколенката пасва на левия и на десния крак — ако и двете ви създават проблеми, пуснете сесия на всяко.',
  ),
  array(
    'questioon' => 'С какво се различава от TENS уред или термофор?',
    'answer'    => 'TENS припокрива сигнала за болка, а термофорът загрява само повърхността и след няколко минути изстива. KneeHeat съчетава продължителна топлина, компресия и вибрации, за да действа върху по-дълбоката тъкан.',
  ),
  array(
    'questioon' => 'Трябва ли да се зарежда?',
    'answer'    => 'Да, уредът е безжичен и се зарежда с включения USB-C кабел. Едно зареждане стига за няколко сесии.',
  ),
  array(
    'questioon' => 'Пасва ли на всеки размер крак?',
    'answer'    => 'Лентите са регулируеми, а в комплекта има и удължаваща лента за по-големи обиколки на крака.',
  ),
);

$is_winecooler = ( function_exists('noriks_is_type') && noriks_is_type('winecooler') );
$winecooler_faq = array(
  array('questioon' => 'Как работи офертата за повече бройки?',
    'answer'    => 'Просто изберете офертата <strong>1x бр.</strong>, <strong>2x бр.</strong> или <strong>3x бр.</strong> — в количката се добавя избраният брой охладители за вино, а отстъпката се начислява автоматично.'),
  array('questioon' => 'Какви начини на плащане мога да използвам?',
    'answer'    => 'При нас може да плащате с Apple Pay, Google Pay, Mastercard и Visa.'),
  array('questioon' => 'Как работи?',
    'answer'    => 'Поставете охлаждащата пръчка във фризера за поне 1 час. Пъхнете изстудената пръчка в бутилката вино. Пийнете глътка, за да направите малко място, и се насладете на идеално изстудено вино при всяко наливане.'),
  array('questioon' => 'Информация за доставката',
    'answer'    => 'Безплатна доставка при поръчки над 70 €. Времето за доставка е 5–12 работни дни от изпращането.'),
  array('questioon' => 'Правила за връщане',
    'answer'    => 'Право на връщане в рамките на 30 дни. Ако не сте напълно доволни от покупката, пишете ни в рамките на 30 дни от получаване на поръчката и с радост ще ви помогнем с връщането на стоката или на парите.'),
);

$faq_pick = function( $title, $list ) use ( $is_winecooler, $winecooler_faq, $is_slim, $slim_faq, $is_tradesman, $tradesman_faq, $is_slabproof, $slabproof_faq, $is_bowl, $bowl_faq, $is_snug, $snug_faq, $is_kompwom, $kompwom_faq, $is_pal, $pal_faq, $is_red, $red_faq, $is_kneeheat, $kneeheat_faq, $is_hyd_faq, $hyd_faq, $is_cloud_faq, $cloud_faq, $is_cloath_faq, $cloath_faq, $is_controlpro_faq, $controlpro_faq, $is_ortopas_faq, $ortopas_faq, $is_bunion_faq, $bunion_faq, $is_fisiorest_faq, $fisiorest_faq, $is_norikshers_faq, $norikshers_faq, $is_leakboxers_faq, $leakboxers_faq, $is_kompmajice_faq, $kompmajice_faq, $is_jastuk_faq, $jastuk_faq, $is_kidsnest_faq, $kidsnest_faq, $is_kneefix_faq, $kneefix_faq ) {
  $t = (string) $title;
  $is_info = ( stripos( $t, 'produkt' ) !== false ) || ( stripos( $t, 'продукт' ) !== false ) || ( stripos( $t, 'издели' ) !== false ) || ( stripos( $t, 'výrobk' ) !== false );
  if ( $is_snug && $is_info ) { return $snug_faq; }
  if ( $is_kompwom && $is_info ) { return $kompwom_faq; }
  if ( $is_tradesman && $is_info ) { return $tradesman_faq; }
  if ( $is_slim && $is_info ) { return $slim_faq; }
  if ( $is_slabproof && $is_info ) { return $slabproof_faq; }
  if ( $is_bowl && $is_info ) { return $bowl_faq; }
  if ( $is_winecooler && $is_info ) { return $winecooler_faq; }
  if ( $is_pal && $is_info ) { return $pal_faq; }
  if ( $is_red && $is_info ) { return $red_faq; }
  if ( $is_kneeheat && $is_info ) { return $kneeheat_faq; }
  if ( $is_hyd_faq && $is_info ) { return $hyd_faq; }
  if ( $is_cloud_faq && $is_info ) { return $cloud_faq; }
  if ( $is_cloath_faq && $is_info ) { return $cloath_faq; }
  if ( $is_kneefix_faq && $is_info )    { return $kneefix_faq; }
  if ( $is_controlpro_faq && $is_info ) { return $controlpro_faq; }
  if ( $is_kidsnest_faq && $is_info )  { return $kidsnest_faq; }
  if ( $is_jastuk_faq && $is_info )    { return $jastuk_faq; }
  if ( $is_leakboxers_faq && $is_info ) { return $leakboxers_faq; }
  if ( $is_kompmajice_faq && $is_info ) { return $kompmajice_faq; }
  if ( $is_norikshers_faq && $is_info ) { return $norikshers_faq; }
  if ( $is_fisiorest_faq && $is_info ) { return $fisiorest_faq; }
  if ( $is_bunion_faq && $is_info )    { return $bunion_faq; }
  if ( $is_ortopas_faq && $is_info )   { return $ortopas_faq; }
  return $list;
};
?>





<section class="faq-section">
  <h2>Често задавани въпроси</h2>
  

   <!-- first faq container --> 
      <div class="faq-container">
         <h4 style="text-align:left; font-size: 1rem;
            font-weight: 700;
            color: #222223;
            margin-bottom: 10px; "><?php echo get_field('faq_title_1', 'option'); ?></h4>
            <?php
              $faq_list = $faq_pick( get_field('faq_title_1', 'option'), $faq_list );
              if( $faq_list && is_array($faq_list) ):
                      foreach( $faq_list as $faq_item ):
              ?>
                    <div class="faq-item">
                      <button class="faq-question">
                         <?php echo function_exists('noriks_no_free_exchange') ? noriks_no_free_exchange( $faq_item["questioon"] ) : $faq_item["questioon"]; ?>
                        <span class="arrow">&#9660;</span>
                      </button>
                      <div class="faq-answer">
                        <p>  <?php echo $faq_item["answer"]; ?></p>
                      </div>
                    </div>
          <?php endforeach;
            endif;
            ?>
      </div>
    <!-- first faq container --> 
  
     <!-- 2 faq container --> 
      <div class="faq-container">
          <br/>
         <h4 style="text-align:left; font-size: 1rem;
            font-weight: 700;
            color: #001e36;
            margin-bottom: 10px; "><?php echo get_field('faq_title_2', 'option'); ?></h4>
            <?php
              $faq_list2 = $faq_pick( get_field('faq_title_2', 'option'), $faq_list2 );
              if( $faq_list2 && is_array($faq_list2) ):
                      foreach( $faq_list2 as $faq_item ):
              ?>
                    <div class="faq-item">
                      <button class="faq-question">
                         <?php echo function_exists('noriks_no_free_exchange') ? noriks_no_free_exchange( $faq_item["questioon"] ) : $faq_item["questioon"]; ?>
                        <span class="arrow">&#9660;</span>
                      </button>
                      <div class="faq-answer">
                        <p>  <?php echo $faq_item["answer"]; ?></p>
                      </div>
                    </div>
          <?php endforeach;
            endif;
            ?>
      </div>
        <!-- 2 faq container --> 
  
     <!-- 3 faq container --> 
      <div class="faq-container">
          <br/>
         <h4 style="text-align:left; font-size: 1rem;
            font-weight: 700;
            color: #001e36;
            margin-bottom: 10px; "><?php echo get_field('faq_title_3', 'option'); ?></h4>
            <?php
              $faq_list3 = $faq_pick( get_field('faq_title_3', 'option'), $faq_list3 );
              if( $faq_list3 && is_array($faq_list3) ):
                      foreach( $faq_list3 as $faq_item ):
              ?>
                    <div class="faq-item">
                      <button class="faq-question">
                         <?php echo function_exists('noriks_no_free_exchange') ? noriks_no_free_exchange( $faq_item["questioon"] ) : $faq_item["questioon"]; ?>
                        <span class="arrow">&#9660;</span>
                      </button>
                      <div class="faq-answer">
                        <p>  <?php echo $faq_item["answer"]; ?></p>
                      </div>
                    </div>
          <?php endforeach;
            endif;
            ?>
      </div>
  <!-- 3 faq container --> 
  
</section>

<script>
  document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
      const faqAnswer = button.nextElementSibling;
      const arrow = button.querySelector('.arrow');

      if (faqAnswer.style.maxHeight) {
        faqAnswer.style.maxHeight = null;
        arrow.style.transform = 'rotate(0deg)';
      } else {
        document.querySelectorAll('.faq-answer').forEach(item => {
          item.style.maxHeight = null;
        });
        document.querySelectorAll('.arrow').forEach(item => {
          item.style.transform = 'rotate(0deg)';
        });
        faqAnswer.style.maxHeight = faqAnswer.scrollHeight + 'px';
        arrow.style.transform = 'rotate(180deg)';
      }
    });
  });
</script>
		


