
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
if (  has_term( array( 'startovaci-balicek','orto-starter' ), 'product_cat', get_the_id() )  )   :
?>



<section  class="why-section">
  <div style="max-width: 1440px;" class="container why-container">

    <!-- Left Video -->
    <div class="why-col">
      <div class="video-wrapper">
          <img style="" src="https://noriks.com/sk/wp-content/uploads/2026/02/starter-1_sk.png">
      </div>
    </div>

    <!-- Right Content -->
    <div class="why-col why-content">
      <h2 style="color: #222; text-align:left; margin-left: 20px; font-family: 'Barlow', sans-serif; color:#222223;">
PREČO SI ĽUDIA VYBERAJÚ ŠTARTOVACÍ BALÍČEK?
      </h2>

      <div style="margin-left: 20px;" class="why-point">
        <p  style="    font-style: italic;
    line-height: 1.2;"  ><strong>"Vzal som si ho, lebo som si nebol istý, či mi bude sedieť." Marko - Záhreb



</strong><span style="font-weight:normal;">Marko - Zagreb</span></p>
        <p class="description">Mnohí zákazníci začínajú so štartovacím balíčkom, aby to najprv vyskúšali.



</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p  style="    font-style: italic;
    line-height: 1.2;" ><strong>"Po prvom nosení som hneď objednal ďalšie."



</strong><span style="font-weight:normal;">Pavle - Split</span></p>
        <p class="description">Viac ako 95 % zákazníkov si po zakúpení štartovacieho balíčka objedná znova. Nie preto, že by to plánovali, ale preto, že rozdiel v strihu, pohodlí a kvalite pocítia už prvý deň.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p  style="    font-style: italic;
    line-height: 1.2;"  ><strong>"Materiál a strih ma presvedčili." 



</strong><span style="font-weight:normal;">Ante - Pula</span></p>
        <p class="description">Tričko a boxerky sú mäkké, ľahké a príjemné na pokožku. Štartovací balíček je najčastejším dôvodom, prečo sa NORIKS rýchlo stane súčasťou vášho každodenného šatníka.



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
           <img style="" src="https://noriks.com/sk/wp-content/uploads/2026/02/starter-2_sk.png">
      </div>
    </div>

    <!-- Right Content -->
    <div class="why-col why-content">
      <h2 style="color: #222; text-align:left; margin-left: 20px; font-family: 'Barlow', sans-serif; color:#222223;">
KOMBINÁCIA, KTORÁ SA NOSÍ KAŽDÝ DEŇ

      </h2>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Navrhnuté pre celodenné pohodlie


</strong></p>
        <p class="description">Tričko a boxerky sú navrhnuté tak, aby sa dali nosiť od rána do večera, bez nastavovania alebo nepohodlia. Všetko drží na svojom mieste, netlačí a umožňuje voľný pohyb počas celého dňa.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Strih, ktorý sa prispôsobí postave


</strong></p>
        <p class="description">Strih trička zdôrazňuje hornú časť tela, zatiaľ čo boxerky poskytujú dostatok priestoru a stability bez dvíhania. Výsledkom je pocit bezpečia, uvoľnenia a elegantný vzhľad v každej situácii.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Kvalita, ktorú pocítite okamžite

</strong></p>
        <p class="description">Materiály sú mäkké, priedušné a príjemné na pokožku, pričom po vypraní nestrácajú svoj tvar. Už od prvého nosenia je jasné, prečo sa táto kombinácia rýchlo stane súčasťou vášho každodenného šatníka.

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
          <img style="" src="https://noriks.com/sk/wp-content/uploads/2026/02/starter-3_sk.png">
      </div>
    </div>

    <!-- Right Content -->
    <div class="why-col why-content">
      <h2 style="color: #222; text-align:left; margin-left: 20px; font-family: 'Barlow', sans-serif; color:#222223;">
NAJJEDNODUCHŠÍ A NAJBEZPEČNEJŠÍ ŠTART
      </h2>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Najnižšie možné riziko


</strong></p>
        <p class="description">Pretože vám to umožňuje zažiť kvalitu bez veľkej investície.
Namiesto toho, aby ste si kupovali viac kusov naraz, dostanete jedno tričko a jedny boxerky – len toľko, aby ste zistili, ako sedia, ako sa nosia a ako sa materiál cíti.

</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Navrhnuté pre prvý krok


</strong></p>
        <p class="description">Štartovací balíček je určený ako prvá skúsenosť, nie ako zásoba.
Je k dispozícii iba raz na zákazníka a za špeciálnu cenu, takže rozhodnutie je jednoduché a bez premýšľania.


</p>
      </div>

      <div style="margin-left: 20px;" class="why-point">
        <p><strong>Opakujúca sa skúsenosť


</strong></p>
        <p class="description">Väčšina mužov potom pokračuje s NORIKS, pretože chápu rozdiel v strihu, pohodlí a kvalite.
Ale prvým krokom je toto – najmenšie riziko, najčistejší dojem.

</p>
      </div>
    </div>

  </div>
</section>



<?php endif; ?>







<?php 
if (  has_term( array( 'tricka',  'orto-tricka', 'orto-majica-darila' ), 'product_cat', get_the_id() )  ||  has_term( 'sady', 'product_cat', get_the_id() )) : 
?>
    <?php // Nove sekcije (2026-10-28); pogoj ostaja nespremenjen.
    include get_template_directory() . '/template_parts/product-bottom/why-majice.php'; ?>
<?php endif; ?>







<!-- here we include new file BOXERIRICE-->

<?php if ( has_term( array( 'boxerky', 'orto-boxerky' ), 'product_cat', get_the_ID() )  && !has_term( 'black-friday', 'product_cat', get_the_ID() ) ): ?>
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
          
          <?php if ( function_exists('noriks_is_type') && noriks_is_type('slim') ): ?>Nie ste jediná, kto hľadá hladkú líniu pod oblečením.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ): ?>Nie ste jediný, komu sa chodidlá po celej zmene v pracovných čižmách nevedia dočkať oddychu.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ): ?>Nie ste jediný, koho po celej zmene na nohách pália chodidlá.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('fisiorest') ): ?>
          
          
          
          Nie si sám v hľadaní úľavy od napätia v krku.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bunion') ): ?>
          
          
          
          Nie si sám v hľadaní úľavy od vybočeného palca.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopas') ): ?>
          
          
          
          Nie si sám v hľadaní odľahčenia chrbta.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ): ?>
          
          
          
          Nie si sám v hľadaní dokonalých kompresných ponožiek.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bokserice') ): ?>
          
          
          
          Nie si sám v hľadaní dokonalých boxeriek.
          
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('norikshers') ): ?>

          Nie ste sami v hľadaní hladkej pleti bez vrások.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('leakboxers') ): ?>

          Nie ste sami v hľadaní spoľahlivej ochrany pred únikom moču.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice') ): ?>

          Nie ste sami v hľadaní ostrejšej siluety a lepšieho držania tela.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk') ): ?>

          Nie ste sami v hľadaní sedenia bez bolesti.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ): ?>Nie ste jediný, komu Kegelove cviky nepriniesli výsledok.
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kneefix') ): ?>

           Nie ste jediní, kto hľadá stabilnejšie koleno.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ): ?>Tisíce mužov už používajú NORIKS ControlPro — skutočný odpor namiesto stláčania naprázdno.
          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kneefix') ): ?>Tisíce zákazníkov už nosia ortézu NORIKS KneeFix pre stabilnejšie koleno – na schodoch, na prechádzke aj počas dlhého státia.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kidsnest') ): ?>

          Nie ste sami v hľadaní pokojného detského spánku.

          <?php elseif ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ): ?>

          Nie ste jediní, komu sa víno v pohári príliš rýchlo zohreje.

          <?php elseif ( !has_term( array( 'bokserice', 'bokserice-sastavi-paket' ), 'product_cat', get_the_ID() ) ): ?>

          <?php echo get_field("singlepp_content_standard_reviews_t2","options"); ?>

          <?php else: ?>

          Nisi sam u potrazi za savršenim boksericama.

          <?php endif; ?>
          
          
          </h1>
    <p class="note" style="color: black; margin-top: 0px; margin-bottom: 5px;"><?php if ( function_exists('noriks_is_type') && noriks_is_type('slim') ): ?>Tisíce žien už nosia NORIKS Slim – tvarujúcu bielizeň, ktorá vyhladí líniu a zostáva na mieste.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ): ?>Tisíce robotníkov už pracujú v ponožkách NORIKS Tradesman – mäkký vankúšik, zosilnená päta a pásik pod klenbou.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ): ?>Tisíce majstrov už pracujú v ponožkách NORIKS SlabProof – zónové polstrovanie tam, kde krok udiera najsilnejšie, zosilnená päta a prsty a suché chodidlá celú zmenu.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('fisiorest') ): ?>Tisíce ľudí už používa NORIKS NeckRelax na menšiu bolesť a napätie v krku – trakcia, vibrácie a teplo v jednom prístroji.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bunion') ): ?>Tisíce ľudí už nosí korektor NORIKS na menšiu bolesť a rovnejšie postavenie palca – doma, pri telke alebo počas spánku.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopas') ): ?>Tisíce ľudí už nosí ortopedický pás NORIKS na menšiu bolesť a stabilnejší chrbát – v práci, pri dvíhaní a dlhom sedení.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ): ?>Tisíce mužov už nosí kompresné ponožky NORIKS pre ľahšie a menej unavené nohy – v práci, na cestách aj pri tréningu.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('bokserice') ): ?>Tisíce mužov už nosí boxerky NORIKS – pohodlie, ktoré vydrží celý deň.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('norikshers') ): ?>Tisíce žien už používajú HERS silikónové kolagénové pásiky pre hladšiu, pevnejšiu a mladšie vyzerajúcu pleť.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('leakboxers') ): ?>Tisíce mužov už nosia absorpčné boxerky NORIKS pre suchosť a sebavedomie – bez vložiek a plienok.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice') ): ?>Tisíce mužov už nosia kompresné tričko NORIKS pre vyhladené brucho, lepšie držanie tela a viac sebavedomia.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('ortopedski-jastuk') ): ?>Tisíce zákazníkov už používajú ortopedický vankúš NORIKS ErgoSit na sedenie bez bolesti kostrče, chrbta a bokov – v aute, v kancelárii aj doma.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('kidsnest') ): ?>Tisíce rodičov už vymenili obyčajný vankúš za NORIKS KidsNest – tichšie noci, dýchanie nosom a spánok, ktorý skutočne regeneruje.<?php elseif ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ): ?>Tisíce ľudí už chladí víno s NORIKS WineCooler – tyčinkou z nehrdzavejúcej ocele s nalievačom, bez vedierka s ľadom a bez rozriedeného vína.<?php else: ?><?php echo get_field("singlepp_content_standard_reviews_t3","options"); ?><?php endif; ?></p>
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
  
  
  $reviews_language = "SK";

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
  $rv_fallback_title = ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ) ? 'Kompresné ponožky NORIKS'
                     : ( $is_ortopas_page ? 'Ortopedický pás NORIKS'
                     : ( $is_bunion_page ? 'Korektor palca NORIKS'
                     : ( $is_fisiorest_page ? 'NORIKS NeckRelax'
                     : ( $is_kneefix_page ? 'NORIKS KneeFix kolenná ortéza'
                     : ( $is_kidsnest_page ? 'NORIKS KidsNest vankúš'
                     : ( $is_jastuk_page ? 'NORIKS ErgoSit ortopedický vankúš'
                     : ( $is_leakboxers_page ? 'NORIKS absorpčné boxerky'
                     : ( $is_kompmajice_page ? 'NORIKS FIT kompresné tričko'
                     : ( $is_norikshers_review_page ? 'NORIKS HERS' : 'Jedno sivé tričko' ) ) ) ) ) ) ) ) );
  if ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ) { $rv_fallback_title = 'NORIKS ControlPro tréner panvového dna'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('hyd') ) { $rv_fallback_title = 'NORIKS HYD'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('cloud') ) { $rv_fallback_title = 'NORIKS Cloud'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('cloath') ) { $rv_fallback_title = 'Polar NORIKS Cloth XXL'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('snug') ) { $rv_fallback_title = 'NORIKS Snug vankúš na celé telo'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('kompwom') ) { $rv_fallback_title = 'NORIKS FIT Woman tvarujúce tričko'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('pal') ) { $rv_fallback_title = 'NORIKS Pal vychádzková palica'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('bowl') ) { $rv_fallback_title = 'NORIKS Bowl ortopedická miska pre psa'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ) { $rv_fallback_title = 'NORIKS WineCooler chladič vína'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('red') ) { $rv_fallback_title = 'NORIKS RedRelief terapia červeným svetlom'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('kneeheat') ) { $rv_fallback_title = 'NORIKS KneeHeat ohrievač a masážny prístroj na koleno'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ) { $rv_fallback_title = 'NORIKS SlabProof™ Pracovné ponožky'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ) { $rv_fallback_title = 'Pracovné ponožky NORIKS Tradesman'; }
  if ( function_exists('noriks_is_type') && noriks_is_type('slim') ) { $rv_fallback_title = 'NORIKS Slim tvarujúce nohavičky'; }

  // Include review pools (own pool per product group)
if ( function_exists('noriks_is_type') && noriks_is_type('snug') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_snug.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('kompwom') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_kompwom.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('bowl') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_bowl.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('winecooler') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_winecooler.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('pal') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_pal.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('red') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_red.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('kneeheat') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_kneeheat.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('slabproof') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_slabproof.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('tradesman') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_tradesman.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('slim') ) {
  include get_stylesheet_directory() . '/auto_reviews/SK_slim.php';
} else
if ( function_exists('noriks_is_type') && noriks_is_type('hyd') ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_hyd.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('cloud') ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_cloud.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('cloath') ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_cloath.php';
} elseif ( function_exists('noriks_is_type') && noriks_is_type('controlpro') ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_controlpro.php';
  } elseif ( $is_kneefix_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_kneefix.php';
  } elseif ( $is_kidsnest_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_kidsnest.php';
  } elseif ( $is_jastuk_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_ortopedski_jastuk.php';
  } elseif ( $is_leakboxers_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_leakboxers.php';
  } elseif ( $is_kompmajice_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_kompresijske-majice.php';
  } elseif ( $is_norikshers_review_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_norikshers.php';
  } elseif ( $is_fisiorest_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_fisiorest.php';
  } elseif ( $is_bunion_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_bunion.php';
  } elseif ( $is_ortopas_page ) {
    include get_stylesheet_directory() . '/auto_reviews/SK_ortopas.php';
  } elseif ( ( function_exists('noriks_is_type') && noriks_is_type('kompresijske-nogavice') ) ) {
      include get_stylesheet_directory() . '/auto_reviews/SK_nogavice.php';
  } elseif ( ! $is_bokserice_page )  {
    include get_stylesheet_directory() . '/auto_reviews/'.$reviews_language.'.php';
  } else {
    include get_stylesheet_directory() . '/auto_reviews/SK_bokserice.php';
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
      $transient_key = 'reviews_product_pool_cache_v4',
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
          $args['category'] = [ 'boxerky' ];
      } elseif ( $is_fisiorest ) {
        $args['category'] = [ 'orto-fisiorest', 'fisiorest' ];
    } elseif ( $is_bunion ) {
        $args['category'] = [ 'orto-bunion', 'bunion' ];
    } elseif ( $is_ortopas ) {
        $args['category'] = [ 'orto-ortopas', 'ortopas' ];
    } elseif ( $is_nogavice ) {
        $args['category'] = [ 'ponozky', 'orto-kompresijske-carape' ];
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
          $args['category'] = [ 'tricka' ];
      }

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
    || has_term( array( 'tricka', 'orto-tricka', 'orto-majica-darila' ), 'product_cat', get_the_ID() )
    || has_term( 'sady', 'product_cat', get_the_ID() )
    || has_term( array( 'boxerky', 'orto-boxerky' ), 'product_cat', get_the_ID() );
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
        <?php echo esc_html__('Recenzie produktu', 'your-textdomain'); ?> (692)
      </button>
      <button type="button" class="reviews-tab" data-tab="shipping"
        style="appearance:none;background:transparent;border:1px solid transparent;border-bottom:0;padding:8px 14px;border-radius:0;font-weight:700;">
        <?php echo esc_html__('Recenzie doručenia', 'your-textdomain'); ?> (389)
      </button>
    </div>

    <!-- PRODUCT GRID (default visible) -->
    <div class="reviews-grid" id="reviews-grid-product">
      <?php if (!empty($initial_product)) : foreach ($initial_product as $review) :
        $name  = $review['name'] ?? 'Anonymní';
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
            <span class="verified"><?php _e('Potvrdené','your-textdomain'); ?></span>
          </div>
          <div class="content"><?php echo esc_html($text); ?></div>
        </article>
      <?php endforeach; endif; ?>
    </div>

    <!-- SHIPPING GRID (hidden initially) -->
    <div class="reviews-grid" id="reviews-grid-shipping" style="display:none;">
      <?php if (!empty($initial_ship)) : foreach ($initial_ship as $review) :
        $name  = $review['name'] ?? 'Anonymní';
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
            <span class="verified"><?php _e('Potvrdené','your-textdomain'); ?></span>
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
        const name      = review.name          || 'Anonymní';
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
            <span class="verified"><?php _e('Potvrdené','your-textdomain'); ?></span>
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
  array( 'questioon' => 'Ako NORIKS ErgoSit zmierňuje bolesť pri sedení?', 'answer' => 'ErgoSit má výrez pre kostrč, ktorý odstraňuje priamy tlak na kostrčovú kosť a sedací nerv, zatiaľ čo anatomický tvar z pamäťovej peny s vysokou hustotou rovnomerne rozkladá váhu na boky a stehná. Tým sa odľahčujú citlivé body a podporuje zdravé, vzpriamené držanie tela.' ),
  array( 'questioon' => 'Kde všade môžem vankúš používať?', 'answer' => 'Kdekoľvek, kde sedíte — v aute, na kancelárskej stoličke, jedálenskej stoličke, invalidnom vozíku alebo doma. Stabilná protišmyková základňa ho drží na mieste, takže pohodlie ide s vami celý deň.' ),
  array( 'questioon' => 'Sploští sa pena časom?', 'answer' => 'Nie. ErgoSit používa pamäťovú penu s vysokou hustotou, ktorá si udrží tvar a pevnosť aj po dlhodobom každodennom používaní, na rozdiel od lacných vankúšov, ktoré sa rýchlo sploštia.' ),
  array( 'questioon' => 'Dá sa poťah prať?', 'answer' => 'Áno. Poťah sa dá stiahnuť a prať v práčke, takže vankúš zostáva svieži a čistý. Tkanina je priedušná, hypoalergénna a certifikovaná OEKO-TEX®.' ),
  array( 'questioon' => 'Sadne na moju stoličku alebo sedadlo?', 'answer' => 'ErgoSit má univerzálny tvar a sadne na väčšinu autosedadiel, kancelárskych a kuchynských stoličiek aj invalidných vozíkov. Nemá veľkosti — jeden model sadne každému.' ),
  array( 'questioon' => 'Za aký čas pocítim rozdiel?', 'answer' => 'Väčšina používateľov pocíti menší tlak na kostrč a pohodlnejšie sedenie už od prvého dňa. Lepšie držanie tela a menej bolestí chrbta sa pri pravidelnom používaní ďalej stupňujú.' ),
  array( 'questioon' => 'Existuje záruka vrátenia peňazí?', 'answer' => 'Áno, každý NORIKS ErgoSit prichádza so 60-dňovou zárukou pohodlia. Ak nepocítite menej bolesti a viac pohodlia, kontaktujte nás a vyriešime to.' ),
);

// NORIKS FIT (kompresné/tvarujúce tričko) — FAQ o produkte (preklad, NORIKS FIT).
$kompmajice_faq = array(
  array( 'questioon' => 'Pre koho je NORIKS FIT určený?', 'answer' => 'NORIKS FIT je stvorený pre mužov, ktorí chcú štíhlejší vzhľad, vrátiť si sebavedomie vo vlastné telo, napraviť držanie tela, cítiť sa počas dňa energickejšie a vyzerať štíhlejšie pod akýmkoľvek oblečením.' ),
  array( 'questioon' => 'Ako tričko NORIKS FIT vlastne funguje?', 'answer' => 'NORIKS FIT používa pokročilú iónovú kompresnú tkaninu, ktorá aktivuje prirodzenú odozvu tela. Mikrotkané vlákna podporujú zdravú cirkuláciu a pomáhajú vám udržať vzpriamené držanie tela od rána do večera. Pri pravidelnom nosení prináša viditeľne tvarovanejší trup, lepšie zarovnanie chrbtice a viac sebavedomia.' ),
  array( 'questioon' => 'Ako rýchlo si všimnem výsledky?', 'answer' => 'Každé telo je iné, ale väčšina zákazníkov hlási viditeľnú zmenu počas prvých 30 dní. Pre najlepší účinok noste NORIKS FIT každý deň a kombinujte ho s vyváženou stravou a pravidelným pohybom.' ),
  array( 'questioon' => 'Vidno ho pod košeľou?', 'answer' => 'Nie. NORIKS FIT je tenký, diskrétny a neviditeľný pod akoukoľvek košeľou a zároveň tvaruje brucho a hrudník a podporuje držanie tela.' ),
  array( 'questioon' => 'Ako sa perie a z čoho je vyrobený?', 'answer' => 'Je vyrobený z 80 % nylonu a 20 % elastanu. Perte ho v studenej vode na jemnom programe, aby ste zachovali kompresiu a predĺžili životnosť tkaniny.' ),
);

// NORIKS LEAK BOXERS (inkontinenčné boxerky) — FAQ o produkte (preklad, NORIKS).
$leakboxers_faq = array(
  array( 'questioon' => 'Prečo si NORIKS vybralo viac ako 123 000 mužov?', 'answer' => 'NORIKS sú najabsorpčnejšie prateľné boxerky pre mužský únik moču: udržia až 300 ml, majú certifikát Oeko-Tex® a neobsahujú škodlivé látky, sú prateľné a opakovane použiteľné (ekologická alternatíva jednorazových vložiek), navrhnuté pre celodenné pohodlie a sebavedomie. Až 87 % zákazníkov si po prvom nákupe objedná znova.' ),
  array( 'questioon' => 'Koľko absorbujú?', 'answer' => 'Až 300 ml — takmer 3-krát viac ako väčšina produktov na trhu. Vďaka 7-vrstvovému jadru PureDry™ sa tekutina okamžite absorbuje a uzamkne hlboko vo vnútri, takže pokožka zostáva suchá a vonkajšia vrstva je vodoodpudivá.' ),
  array( 'questioon' => 'Vidno ich pod oblečením?', 'answer' => 'Nie. Boxerky NORIKS sú tenké, diskrétne a flexibilné — vyzerajú a pôsobia ako bežná spodná bielizeň, bez objemnosti a bez pocitu „plienky“.' ),
  array( 'questioon' => 'Ako sa perú?', 'answer' => 'Perte na 30 – 40 °C, bez aviváže a bielidla, sušte na vzduchu. Absorpčnú schopnosť si udržia počas stoviek praní.' ),
  array( 'questioon' => 'Je doručenie diskrétne?', 'answer' => 'Áno. Všetky objednávky posielame v neutrálnom, diskrétnom balení bez viditeľných označení obsahu, aby sme chránili vaše súkromie.' ),
  array( 'questioon' => 'Z čoho sú vyrobené?', 'answer' => 'Vonkajšia vrstva z bambusového vlákna s elastanom, 7-vrstvové absorpčné jadro z technických mikrovlákien a vodoodpudivá priedušná membrána.' ),
);

// KidsNest detský vankúš — FAQ o produkte (NORIKS, zmiernené tvrdenia).
$kneefix_faq = array(
  array(
    'questioon' => 'Je KneeFix vhodný na každodenné nosenie?',
    'answer'    => 'Áno. NORIKS KneeFix je vyvinutý práve pre bežné pohyby — chôdzu, prácu, chodenie po schodoch či dlhšie státie.',
  ),
  array(
    'questioon' => 'Môžem si kompresiu nastaviť sám?',
    'answer'    => 'Áno. Vstavaným presným kolieskom si kompresiu nastavíte sami — toľko opory, koľko je vám príjemné.',
  ),
  array(
    'questioon' => 'Šmýka sa ortéza pri chôdzi?',
    'answer'    => 'KneeFix má protišmykový silikónový okraj, ktorý pomáha obmedziť šmýkanie a rolovanie ortézy počas nosenia.',
  ),
  array(
    'questioon' => 'Môžem ortézu nosiť pod oblečením?',
    'answer'    => 'Áno. Pružný a tenký strih umožňuje pohodlné nosenie pod väčšinou bežného oblečenia.',
  ),
  array(
    'questioon' => 'Je ortéza vhodná na obe kolená?',
    'answer'    => 'Pri objednávke si vyberiete stranu (ľavá alebo pravá), takže ortéza sadne presne tomu kolenu, ktoré chcete podoprieť.',
  ),
  array(
    'questioon' => 'Môžem ortézu nosiť dlhší čas?',
    'answer'    => 'Ortéza je vyvinutá na každodenné nosenie. Mnohí zákazníci ju nosia v práci, na prechádzke aj pri bežných činnostiach.',
  ),
  array(
    'questioon' => 'Ako si vybrať veľkosť?',
    'answer'    => 'Veľkosti sú určené podľa telesnej hmotnosti: M (50–75 kg), L (76–90 kg), XL (91–110 kg) a 2XL (110 kg+).',
  ),
);

$kidsnest_faq = array(
  array( 'questioon' => 'Ako rýchlo uvidím, že dýchanie ústami prestáva?', 'answer' => 'Väčšina rodičov si všimne tichšie dýchanie a menej prebúdzaní s otvorenými ústami počas prvých 5 – 7 nocí. Do 14. noci sa u väčšiny detí chrápanie upokojí a pery zostávajú zatvorené. Plný rozdiel — viditeľne lepšiu polohu a pokojnejší spánok — rodičia najčastejšie opisujú okolo 21. až 30. dňa. Používajte ho každú noc.' ),
  array( 'questioon' => 'Pre aký vek je KidsNest určený?', 'answer' => 'KidsNest prichádza v troch veľkostiach: 1 – 3, 3 – 9 a 9 – 14 rokov. Najdôležitejšie okno je medzi 3. a 9. rokom, keď sa podnebie a čeľusť vyvíjajú najintenzívnejšie — no každý vek má svoju veľkosť a svoj prínos.' ),
  array( 'questioon' => 'Je bezpečný? Čo je vo vnútri?', 'answer' => 'KidsNest je vyrobený z hypoalergénnej pamäťovej peny s certifikátom OEKO-TEX® — bez formaldehydu, ťažkých kovov a BPA. Je odolný voči roztočom a priedušný a poťah sa dá stiahnuť a prať v práčke.' ),
  array( 'questioon' => 'Bude ho moje dieťa naozaj používať?', 'answer' => 'Áno. Ergonomický tvar pôsobí ako opora, nie ako niečo zvláštne — väčšina detí si zvykne za 1 – 2 noci. Rodičia často hlásia, že deti po prvom týždni nechcú spať bez neho. 3-zónová štruktúra prirodzene prijíma hlavu — neexistuje „správny spôsob“, žiadny boj pred spaním.' ),
  array( 'questioon' => 'Funguje, ak moje dieťa už dýcha ústami?', 'answer' => 'Áno — presne pre takéto deti je navrhnutý. 3-zónová štruktúra pomáha zabrániť zakláňaniu hlavy dozadu, kvôli ktorému sa ústa v spánku otvárajú. U väčšiny detí sa počas 7 – 14 nocí pery prirodzene zatvárajú a dýchanie nosom sa vracia.' ),
  array( 'questioon' => 'Čo ak môjmu dieťaťu nepomôže?', 'answer' => 'Nechajte dieťa spať na KidsNest 30 nocí. Ak nevidíte rozdiel — menej dýchania ústami, tichšie noci, pokojnejší spánok — ozvite sa nám a vrátime vám peniaze. Bez otázok a bez drobných písmen.' ),
);

// NORIKS HERS — silikónové kolagénové pásiky na vrásky a jazvy — FAQ o produkte (preklad, NORIKS).
$norikshers_faq = array(
  array( 'questioon' => 'Čím sa líši od klasických náplastí na vrásky alebo krémov na jazvy?', 'answer' => 'Väčšina náplastí na vrásky je z papiera alebo hydrokoloidu a krémy na jazvy často zostanú len na povrchu pokožky. NORIKS HERS používa silikón klinickej kvality, ktorému dermatológovia dôverujú už roky pri viditeľnom zlepšovaní textúry jaziev a pružnosti pokožky — a teraz sa využíva aj na zmiernenie vrások.' ),
  array( 'questioon' => 'Môže jediný pásik naozaj pôsobiť na vrásky aj jazvy?', 'answer' => 'Áno, pretože vrásky aj jazvy sú prejavom rozpadu kolagénu alebo slabej regenerácie pokožky. Silikón podporuje udržanie vlhkosti, obnovu kolagénu a vyhladenie textúry pokožky, čo prospieva obom.' ),
  array( 'questioon' => 'Za aký čas uvidím výsledky?', 'answer' => 'Väčšina používateľov spozoruje viditeľné vyhladenie jemných vrások už po 1 – 3 použitiach a vzhľad jaziev sa zlepší za 2 – 3 týždne pravidelného používania. Hlbšie jazvy a vrásky môžu trvať dlhšie, no výsledky sa časom stupňujú.' ),
  array( 'questioon' => 'Je bezpečný pre citlivú pleť alebo pleť náchylnú na akné?', 'answer' => 'Určite. NORIKS HERS je hypoalergénny, bez latexu a dostatočne jemný na citlivé oblasti, ako je okolie očí či úst, a dokonca aj na hojace sa stopy po akné. Ak máte veľmi reaktívnu pokožku, vždy najprv otestujte na malej ploche.' ),
  array( 'questioon' => 'Ako dlho ho môžem nosiť?', 'answer' => 'Pre najlepšie výsledky odporúčame nosiť NORIKS HERS 6 – 8 hodín, cez noc. Môžete ho použiť aj cez deň — len dbajte na to, aby bola pokožka pod ním čistá a bez olejov či sér.' ),
  array( 'questioon' => 'Ako dlho vydrží jedna rolka?', 'answer' => 'V závislosti od toho, ako často a kde ho používate, jedna rolka vydrží 3 – 6 týždňov. Keďže je opakovane použiteľný, je oveľa hospodárnejší ako jednorazové náplasti alebo krémy.' ),
  array( 'questioon' => 'Zostane na mieste, kým spím?', 'answer' => 'Áno! NORIKS HERS je vyrobený s pokožke priateľským, odolným lepidlom, ktoré kopíruje vaše pohyby. Je priedušný a zostane na mieste aj u ľudí, ktorí spia na boku.' ),
  array( 'questioon' => 'Na ktorých oblastiach ho môžem používať?', 'answer' => 'Kdekoľvek! Väčšina zákazníkov používa NORIKS HERS na: vrásky na čele, vrásky medzi obočím, vrásky od úsmevu, vrásky na krku, stopy po akné, jazvy po cisárskom reze, strie, chirurgické alebo poúrazové jazvy.' ),
  array( 'questioon' => 'Prečo je NORIKS HERS lepší ako lacné online náplasti?', 'answer' => 'Mnohé náplasti predávané online sú nekvalitné, tenké alebo majú zlé lepidlo. NORIKS HERS používa prémiový silikón, testovaný v laboratóriu na bezpečnosť a odolnosť, a drží na mieste celú noc. Navyše ponúkame dedikovanú zákaznícku podporu a rýchlejšiu výmenu, ak potrebujete pomoc.' ),
  array( 'questioon' => 'Je k dispozícii záruka vrátenia peňazí?', 'answer' => 'Áno, ponúkame 30-dňovú záruku bez rizika. Ak nie ste spokojní, stačí nás kontaktovať a vyriešime to.' ),
);

// Korektor vbočeného palca — FAQ o produkte (preklad, NORIKS).
$bunion_faq = array(
  array( 'questioon' => 'Ako rýchlo sa budem cítiť lepšie?', 'answer' => 'Približne 30 minút — toľko času je potrebné na zmiernenie nepohodlia. Pri pravidelnom používaní počas dvoch týždňov pocítite výrazné uľavenie pri každodenných činnostiach, ako sú chôdza, státie alebo spánok.' ),
  array( 'questioon' => 'Ako rýchlo si všimnem rozdiel na vbočenom palci?', 'answer' => 'V závislosti od závažnosti vbočeného palca si väčšina zákazníkov všimne viditeľné zlepšenie po 4 – 8 týždňoch. Mierny vbočený palec: 4 týždne. Stredný vbočený palec: 4 týždne. Ťažší vbočený palec: 8 týždňov.' ),
  array( 'questioon' => 'Dá sa nosiť v topánkach? Môžem v ňom chodiť?', 'answer' => 'Nie, do topánky sa nezmestí. Áno, môžete v ňom chodiť. Je však určený na oddych — keď ležíte na gauči, pozeráte TV, čítate alebo spíte.' ),
  array( 'questioon' => 'Čo ak mi to bude nepríjemné?', 'answer' => 'To je úplne normálne! Korektor NORIKS je navrhnutý dostatočne pevne na to, aby zarovnal kĺb palca, zastavil zápal a zmiernil nepohodlie. Možno budete potrebovať 1 – 2 sedenia, aby ste si zvykli, potom sa však budete cítiť oveľa lepšie!' ),
  array( 'questioon' => 'Ako dlho ho mám používať?', 'answer' => 'Odporúčame začať s 30 minútami denne a postupne predlžovať až na sedenie 1 až 3 hodiny. Keď vám to bude pohodlné, môžete ho začať nosiť aj počas spánku. Noste ho počas oddychu — na gauči, pri TV, čítaní alebo spánku.' ),
  array( 'questioon' => 'Pomôže pri mojom konkrétnom stave?', 'answer' => 'Korektor NORIKS je ideálny na: zmiernenie nepohodlia, ktoré ovplyvňuje každodenné činnosti ako chôdza alebo státie; úľavu od nepohodlia spôsobeného vbočeným palcom počas oddychu alebo spánku; riešenie vbočeného palca v skorej fáze, ktorý môže postupovať; vbočený palec, ktorý sa vrátil po operácii; pomoc pri ťažšom vbočenom palci pripravenom na operáciu; a ako účinnú nechirurgickú možnosť.' ),
  array( 'questioon' => 'Bude vyhovovať môjmu chodidlu? Existuje ľavá a pravá strana?', 'answer' => 'Bez ohľadu na veľkosť chodidla — od najmenšieho detského po veľké chodidlo dospelého — korektor NORIKS pohodlne padne. Nie sú strany! Vďaka prispôsobiteľnej konštrukcii sa rovnako ľahko prispôsobí ľavému aj pravému chodidlu.' ),
);

// Ortopedický pás — FAQ o produkte (preklad, NORIKS).
$ortopas_faq = array(
  array( 'questioon' => 'Ako rýchlo pocítim úľavu od bolesti?', 'answer' => 'Mnohí používatelia pocítia badateľnú úľavu od išiasu a bolestí krížov hneď po nasadení pásu NORIKS. Jeho cielená kompresia poskytuje okamžitú oporu, stabilizuje chrbticu a znižuje tlak na nervy. Pre dlhotrvajúci účinok odporúčame nosiť pás dôsledne podľa návodu aspoň dva týždne. Postupom času môžete pri správnom používaní a zdravých návykoch pocítiť trvalú úľavu a lepšiu pohyblivosť.' ),
  array( 'questioon' => 'Ako pás správne nasadiť?', 'answer' => 'Pás NORIKS noste okolo bokov, tesne pod líniou pása. Mal by sa nachádzať nad krížovou oblasťou (drieková časť chrbta, tesne nad zadkom) a pod hrebeňom panvy (horná časť bočných bokov). Pre viac informácií si pozrite návod na použitie.' ),
  array( 'questioon' => 'Oslabí pás moje svaly?', 'answer' => 'Nie, pás NORIKS neoslabuje svaly ako korzet na chrbát. Len pomáha držať SI kĺby pohromade a obnovuje normálne napätie väzov. Môžete ho nosiť týždne alebo mesiace bez obáv zo svalovej atrofie.' ),
  array( 'questioon' => 'Môžem pás nosiť aj počas spánku?', 'answer' => 'Áno, pás môžete nosiť aj v noci. Dĺžka nosenia nie je obmedzená a dlhšie nosenie nemá negatívne účinky.' ),
  array( 'questioon' => 'Ako tesne ho mám nasadiť?', 'answer' => 'Pás by mal tesne priliehať, ale nie príliš tesne, aby ste sa vyhli nepohodliu. Mali by ste sa bez problémov hýbať bez toho, aby sa pás zarezával alebo šmýkal. Napätie sa jednoducho nastavuje elastickými pásikmi.' ),
  array( 'questioon' => 'Komu ho odporúčate?', 'answer' => 'Všetkým, ktorí zápasia s bolesťami krížov, išiasom, svalovým napätím, prietržou medzistavcovej platničky, bolesťami bokov alebo panvy a problémami so SI kĺbom. Bez ohľadu na vek, pohlavie, výšku a hmotnosť.' ),
  array( 'questioon' => 'Existuje záruka vrátenia peňazí?', 'answer' => 'Ponúkame záruku spokojnosti! Ak nie ste s pásom NORIKS spokojní, kontaktujte nás na info@noriks.com za účelom vrátenia a preplatenia do 30 dní. Lehota sa počíta od prevzatia pásu.' ),
);

// NeckRelax — FAQ o produkte (preklad, NORIKS).
$fisiorest_faq = array(
  array( 'questioon' => 'Ako NORIKS NeckRelax funguje?', 'answer' => 'NeckRelax spája trakciu, teplo a vibračnú masáž s ergonomickou konštrukciou z pamäťovej peny. Táto technológia naťahuje krk pod presne správnym uhlom a odľahčuje krčnú chrbticu. Následne upokojujúca teplá masáž podporí prítok krvi bohatej na kyslík a živiny do svalov a tak pomáha pri regenerácii tkanív.' ),
  array( 'questioon' => 'V čom je NeckRelax lepší ako iné zariadenia?', 'answer' => 'NORIKS NeckRelax je výnimočný, pretože spája <strong>tri terapie v jednej</strong> — teplo, masáž a jemnú trakciu — ktoré uvoľnia svaly a znovu zarovnajú krk pre dlhotrvajúcu úľavu. Navyše je <strong>bezdrôtový, bezpečný na spánok a obalený v chladivom hodvábe</strong> pre pohodlie, aké inde nenájdete.' ),
  array( 'questioon' => 'Ako sa NeckRelax používa?', 'answer' => '1. Nabite ho priloženým USB-C káblom a nabíjačkou približne 4 až 6 hodín. 2. Podržte tlačidlo masáže alebo tepla 5 sekúnd, kým sa nerozsvieti kontrolka. 3. Opätovným stláčaním tlačidiel meníte rýchlosť masáže a nastavenia tepla. 4. Užívajte si uvoľňujúcu masáž!' ),
  array( 'questioon' => 'Ako dlho mám NeckRelax používať?', 'answer' => 'Odporúčame začať s 15 minútami, aby si krk zvykol. Postupom času môžete prejsť na plné sedenie. Pre orientáciu: cyklus jemného tepla, masáže a trakcie trvá 30 minút, čo je zvyčajne ideálny čas na to, aby sa krk uvoľnil a obnovil svoju prirodzenú krivku.' ),
  array( 'questioon' => 'Je NeckRelax bezdrôtový?', 'answer' => 'Áno! NORIKS NeckRelax je úplne bezdrôtový a nabíjateľný na každodenné používanie.' ),
  array( 'questioon' => 'Ako sa NeckRelax čistí?', 'answer' => 'Látka je odolná voči olejom a prachu, no odporúčame NeckRelax po použití utrieť dezinfekčnou utierkou, keďže poťah vankúša nie je možné prať.' ),
  array( 'questioon' => 'Je bezpečný pre každého?', 'answer' => 'NORIKS NeckRelax je navrhnutý tak, aby vyhovoval každému bez ohľadu na vek alebo pohlavie. Každá situácia je však iná. Pre podrobné pokyny prispôsobené vašim potrebám odporúčame konzultáciu s lekárom.' ),
  array( 'questioon' => 'Môžem ho vrátiť, ak nevidím výsledky?', 'answer' => 'Samozrejme! Poskytujeme plnú záruku vrátenia peňazí do 30 dní od doručenia, ak nie ste s produktom spokojní. Napíšte nám na info@noriks.com a odpovieme do 12 hodín od prijatia správy!' ),
);

// Nahrádza LEN kontajner FAQ o produkte pre 3 orto-produkty;
// kontajnery doručenia/vrátenia zostávajú nedotknuté.
$controlpro_faq = array(
  array( 'questioon' => 'Ako sa používa?', 'answer' => 'Sadnite si na stoličku, prístroj vložte <strong>medzi kolená</strong> a stláčajte proti odporu. Odporúčame <strong>3 série po 10 opakovaní denne</strong>, čo trvá približne päť minút.' ),
  array( 'questioon' => 'Treba niečo zavádzať?', 'answer' => 'Nie. Žiadne sondy, žiadne zavádzanie. Prístroj pracuje <strong>mimo tela</strong>.' ),
  array( 'questioon' => 'Kedy môžem čakať výsledky?', 'answer' => 'Väčšina používateľov hlási prvé zmeny po <strong>3 až 6 týždňoch</strong> pravidelného cvičenia.' ),
  array( 'questioon' => 'Potrebuje batérie alebo aplikáciu?', 'answer' => 'Nie. Prístroj je plne mechanický — bez batérií, káblov a aplikácie. Má len <strong>počítadlo opakovaní</strong>.' ),
  array( 'questioon' => 'Čím sa líši od EMS prístrojov?', 'answer' => 'EMS prístroje stiahnu sval za vás. ControlPro vyžaduje, aby ste <strong>prácu urobili sami</strong> proti skutočnému odporu.' ),
  array( 'questioon' => 'Je vhodný po operácii prostaty?', 'answer' => 'Áno, mnohí ho používajú práve po operácii prostaty. Ak ste v rekonvalescencii, poraďte sa najprv s lekárom.' ),
  array( 'questioon' => 'Ako sa čistí?', 'answer' => 'Utrite vlhkou handričkou s jemným čistiacim prostriedkom. Neponárajte do vody.' ),
  array( 'questioon' => 'Aké je doručenie?', 'answer' => 'Doručenie je <strong>diskrétne</strong>, v neutrálnej krabici bez označenia obsahu.' ),
  array( 'questioon' => 'Môžem ho vrátiť?', 'answer' => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí. Stačí e-mail, bez formulárov.' ),
);

$is_cloath_faq = ( function_exists('noriks_is_type') && noriks_is_type('cloath') );
$cloath_faq = array(
  array(
    'questioon' => 'Čo ak nebudem s nákupom spokojný?',
    'answer'    => 'Máte 30 dní na to, aby ste handričku vyskúšali bez rizika. Ak nie ste s výsledkom spokojní, napíšte našej podpore a vrátime vám peniaze — bez papierovania a bez vysvetľovania.',
  ),
  array(
    'questioon' => 'Z čoho je handrička vyrobená?',
    'answer'    => 'Z hustej mikrovláknovej tkaniny s obojstranným dizajnom: chlpatá strana zbiera nečistoty a vodu, sieťkovaná leští do lesku. Okraj je spevnený mäkkým lemom, ktorý nepoškriabe.',
  ),
  array(
    'questioon' => 'Prečo je drahšia než bežné handričky?',
    'answer'    => 'Pretože je hustejšia a ťažšia než štandardná mikrovlákna — nasaje mnohonásobne viac vody, nepúšťa vlákna a vydrží stovky praní. Jedna nahradí celý rad lacných, ktoré sa po pár praniach začnú strapkať.',
  ),
  array(
    'questioon' => 'Ako dlho vydrží v porovnaní s bežnými?',
    'answer'    => 'Pri správnej starostlivosti vydrží stovky použití. Handričky z obchodu zvyčajne po asi 20 praniach stratia hustotu a začnú zanechávať šmuhy.',
  ),
  array(
    'questioon' => 'Zanecháva šmuhy alebo škvrny?',
    'answer'    => 'Nie. Vďaka hustote a obojstrannému dizajnu sa voda nasaje namiesto rozotierania, takže sklo a zrkadlá zostanú bez šmúh — a bez vlákien.',
  ),
  array(
    'questioon' => 'Ako ju najlepšie prať?',
    'answer'    => 'V práčke na 40 °C, s pracím prostriedkom bez aviváže (aviváž upchá vlákna a zníži nasiakavosť). Nepoužívajte bielidlo a nesušte v sušičke — sušte na vzduchu.',
  ),
  array(
    'questioon' => 'Prečo handrička na niektorých záberoch vyzerá tmavšie?',
    'answer'    => 'Kvôli osvetleniu. Handrička je tmavosivá s čiernym lemom; pri silnom svetle pôsobí svetlejšie a v interiéri tmavšie.',
  ),
  array(
    'questioon' => 'Je vhodná ako darček?',
    'answer'    => 'Áno — balenia 3+3 a 8+4 patria medzi najčastejšie darčeky k nasťahovaniu a na sviatky. Handrička prichádza pekne zložená a pripravená na darovanie.',
  ),
);

$is_cloud_faq = ( function_exists('noriks_is_type') && noriks_is_type('cloud') );
$cloud_faq = array(
  array(
    'questioon' => 'Čo ak mi vankúš nevyhovuje?',
    'answer'    => 'Máte 60 nocí na vyskúšanie. Ak nebudete spokojní, napíšte našej podpore a vrátime vám celú sumu — bez podmienok a bez papierovania.',
  ),
  array(
    'questioon' => 'Ako sa vankúš správne používa?',
    'answer'    => 'Ľahnite si na bok, vložte vankúš medzi kolená a pásku utiahnite okolo vrchnej nohy. Bedrá, panva a chrbtica majú byť v priamke. Pásku môžete zložiť a vankúš používať pod členky alebo pod krk.',
  ),
  array(
    'questioon' => 'Naozaj zostane na mieste, keď sa otočím?',
    'answer'    => 'Áno. Nastaviteľná páska s patentkami ide okolo nohy a drží vankúš pri kolene, takže nevypadáva ako bežný vankúš. Páska má dve polohy utiahnutia podľa obvodu nohy.',
  ),
  array(
    'questioon' => 'Z čoho je vankúš vyrobený?',
    'answer'    => 'Jadro je z pamäťovej peny medicínskej kvality s perforáciami, ktoré zaisťujú prúdenie vzduchu. Poťah je z priedušnej tkaniny, dá sa zložiť a vyprať. Materiály sú certifikované podľa OEKO-TEX® STANDARD 100 a CertiPUR-EU.',
  ),
  array(
    'questioon' => 'Je príliš tvrdý alebo príliš mäkký?',
    'answer'    => 'Má strednú tuhosť — dosť na to, aby držal odstup nôh celú noc, ale pod tlakom sa prispôsobí tvaru kolena. Nesplasne a po vstaní sa vráti do tvaru.',
  ),
  array(
    'questioon' => 'Ako sa perie?',
    'answer'    => 'Poťah zložte a perte v práčke na 40 °C, bez aviváže a bez bielidla, sušte na vzduchu. Penu neperte v práčke — v prípade potreby ju utrite vlhkou handričkou a nechajte uschnúť.',
  ),
  array(
    'questioon' => 'Ako dlho trvá, kým si zvyknem?',
    'answer'    => 'Väčšina používateľov cíti rozdiel už prvú alebo druhú noc. Ak ste zvyknutí spať so spojenými kolenami, prvých pár nocí môže byť odstup nezvyčajný — telo sa zvyčajne prispôsobí do týždňa.',
  ),
  array(
    'questioon' => 'Je vhodný v tehotenstve?',
    'answer'    => 'Áno. V tehotenstve sa odporúča spánok na ľavom boku a vankúš medzi kolenami odľahčuje bedrá a kríže. Pri zdravotných komplikáciách sa pred použitím poraďte s lekárom.',
  ),
);

$is_hyd_faq = ( function_exists('noriks_is_type') && noriks_is_type('hyd') );
$hyd_faq = array(
  array(
    'questioon' => 'Čo je vodíková voda?',
    'answer'    => 'Je to bežná pitná voda, v ktorej je rozpustený molekulárny vodík (H₂). Vodík je najmenšia molekula a výskumy ho spájajú so selektívnym antioxidačným účinkom.',
  ),
  array(
    'questioon' => 'Ako dlho trvá jeden cyklus?',
    'answer'    => 'Krátky cyklus trvá 3 minúty a dáva približne 1 600 ppb vodíka, dlhý 10 minút a až 3 000 ppb. Cyklus si vyberiete stlačením tlačidla.',
  ),
  array(
    'questioon' => 'Prichádza voda do styku s plastom?',
    'answer'    => 'Nie. Fľaša je z borosilikátového skla so základňou z nehrdzavejúcej ocele, takže vo vode nie je chuť plastu ani častice.',
  ),
  array(
    'questioon' => 'Akú vodu môžem používať?',
    'answer'    => 'Akúkoľvek pitnú vodu — z vodovodu, filtrovanú, balenú alebo destilovanú. Vďaka PEM/SPE membráne zariadenie nepotrebuje minerály.',
  ),
  array(
    'questioon' => 'Treba meniť filter?',
    'answer'    => 'Nie. Generátor má trvalý filter, takže niet spotrebného materiálu ani ďalších nákladov.',
  ),
  array(
    'questioon' => 'Ako sa nabíja?',
    'answer'    => 'USB káblom; plné nabitie trvá 30 až 60 minút a stačí na viac cyklov. Fľašu nenabíjajte, kým je v nej voda.',
  ),
  array(
    'questioon' => 'Kedy vodu vypiť?',
    'answer'    => 'Najlepšie hneď po cykle, do zhruba 30 minút, pretože koncentrácia vodíka časom klesá.',
  ),
  array(
    'questioon' => 'Čo ak nebudem spokojný?',
    'answer'    => 'Máte 30 dní na vrátenie peňazí. Navyše na zariadenie dostávate 1 rok záruky.',
  ),
);

$is_snug = ( function_exists('noriks_is_type') && noriks_is_type('snug') );
$snug_faq = array(
  array(
    'questioon' => 'Aké sú rozmery vankúša?',
    'answer'    => 'Jedna veľkosť: <strong>105 cm dĺžky a 30 cm šírky</strong>. Podopiera od ramena po kolená, ale nezaberie celú posteľ — preto sa ľahko drží a ľahko sa s ním otočíte.',
  ),
  array(
    'questioon' => 'Časom sa sploští?',
    'answer'    => 'Nie. Výplň tvoria tisíce jemných pružných vlákien, ktoré sa vracajú do tvaru. Opora, ktorú cítite prvú noc, je rovnaká aj po deväťdesiatich nociach.',
  ),
  array(
    'questioon' => 'Čím je vyplnený?',
    'answer'    => 'Vysoko pružnou vláknitou výplňou — zvonku mäkkou a príjemnou, vnútri pevnou a podopierajúcou. Bez pamäťovej peny, ktorá sa zahrieva.',
  ),
  array(
    'questioon' => 'Ako sa perie?',
    'answer'    => 'Obliečka sa dá zložiť a vyprať v práčke na 40 °C. Samotný vankúš neperte v práčke — v prípade potreby ho vyvetrajte a nechajte vyschnúť na vzduchu.',
  ),
  array(
    'questioon' => 'Je vhodný počas tehotenstva?',
    'answer'    => 'Áno. Tvar S podopiera brucho spredu a chrbát zozadu, pričom odporúčaná poloha v tehotenstve je spánok na ľavom boku. Pri zdravotných komplikáciách sa poraďte s lekárom.',
  ),
  array(
    'questioon' => 'Ako dlho trvá zvyknúť si?',
    'answer'    => 'Väčšina ľudí si nájde svoju polohu do druhej noci. Tvar S je iný ako rovný vankúš, takže prvé noci sa telo učí, kam si ľahnúť.',
  ),
  array(
    'questioon' => 'Aké farby sú dostupné?',
    'answer'    => 'Šesť farieb: modrá, ružová, sivá, zelená, fialová a tmavomodrá. Farbu si vyberáte na tejto stránke pred pridaním do košíka.',
  ),
  array(
    'questioon' => 'Môžem ho vrátiť?',
    'answer'    => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí alebo výmenu. Stačí e-mail, bez formulárov.',
  ),
);

$is_kompwom = ( function_exists('noriks_is_type') && noriks_is_type('kompwom') );
$kompwom_faq = array(
  array(
    'questioon' => 'Ako si vybrať veľkosť?',
    'answer'    => 'Podľa obvodu hrudníka — ten rozhoduje, ako tričko sadne na prsiach a ramenách. Ak ste medzi dvomi veľkosťami, vezmite <strong>väčšiu</strong>. Dostupné sú veľkosti od S po 3XL.',
  ),
  array(
    'questioon' => 'Vidno ho pod oblečením?',
    'answer'    => 'Nie. Úplet je bezšvový, tenký a matný, takže zmizne pod košeľou, sakom alebo priliehavými šatami. Nemá okraj, ktorý by sa črtal.',
  ),
  array(
    'questioon' => 'Roluje sa cez deň?',
    'answer'    => 'Nie. Kompresia sa rozkladá do šírky namiesto toho, aby tlačila v jednom bode, takže tričko zostane na mieste aj po celom dni.',
  ),
  array(
    'questioon' => 'Sú 3D línie potlačené?',
    'answer'    => 'Nie. Väzba je <strong>votkaná priamo do látky</strong>, takže nič nepraská a nič sa časom neodlupuje, bez ohľadu na počet praní.',
  ),
  array(
    'questioon' => 'Ako silno sťahuje?',
    'answer'    => 'Rozhodne, ale nikdy tesne. Musíte normálne dýchať a jesť bez toho, aby ste na tričko mysleli. Ak je stopa na koži viditeľná dvadsať minút po vyzlečení, veľkosť je primalá.',
  ),
  array(
    'questioon' => 'Ako sa perie?',
    'answer'    => 'V práčke na <strong>30 °C</strong>. Bez bielidiel, bez žehlenia a bez sušičky — nechajte vyschnúť na vzduchu.',
  ),
  array(
    'questioon' => 'Aké farby sú dostupné?',
    'answer'    => 'Tri farby: čierna, tmavosivá a ružová. Farbu a veľkosť si vyberáte na tejto stránke pred pridaním do košíka.',
  ),
  array(
    'questioon' => 'Môžem ho vrátiť?',
    'answer'    => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí alebo výmenu veľkosti. Stačí e-mail, bez formulárov.',
  ),
);

$is_slim = ( function_exists('noriks_is_type') && noriks_is_type('slim') );
$slim_faq = array(
  array('questioon' => 'Ako si vybrať veľkosť?',
    'answer'    => 'Odmerajte si <strong>obvod pása</strong> v najužšom mieste trupu, kúsok nad pupkom, a porovnajte ho s tabuľkou veľkostí (XS až 5XL). Ak ste medzi dvoma veľkosťami, vezmite si <strong>väčšiu</strong>.'),
  array('questioon' => 'Rolujú sa nadol?',
    'answer'    => 'Nie. Široký prekrížený pás vedie okolo celého pása — spredu, zboku aj zozadu — takže sa tlak rozloží namiesto toho, aby stláčal v jednej línii. Nohavičky zostávajú na mieste, aj keď sedíte.'),
  array('questioon' => 'Vidno ich pod oblečením?',
    'answer'    => 'Nie. Úplet je tenký a hladký, bez hrubých švov, takže zmiznú pod priliehavými šatami, džínsami aj legínami.'),
  array('questioon' => 'Nosia sa namiesto nohavičiek alebo cez ne?',
    'answer'    => 'Ako je vám to pohodlnejšie. Väčšina žien ich nosí samotné, ako bežnú spodnú bielizeň, no môžete ich nosiť aj cez tenké nohavičky.'),
  array('questioon' => 'Môžem ich nosiť po pôrode?',
    'answer'    => 'Mnohé mamičky ich nosia po pôrode, pretože sú mäkké a priedušné. Po cisárskom reze alebo ak si nie ste istá, poraďte sa pred nosením so svojím lekárom.'),
  array('questioon' => 'Ako pevne sťahujú?',
    'answer'    => 'Pevne, ale nie natesno. Mali by ste normálne dýchať aj sedieť. Ak vás niekde tlačia alebo zanechávajú hlbokú stopu, vezmite si väčšiu veľkosť.'),
  array('questioon' => 'Ako sa perú?',
    'answer'    => 'Ručne alebo v práčke na <strong>30 °C</strong> vo vrecku na bielizeň. Bez bielidla, žehlenia a sušičky — sušte na vzduchu.'),
  array('questioon' => 'Aké farby sú dostupné?',
    'answer'    => 'Šesť farieb: čierna, telová, tmavomodrá, fialová, fuchsiová a slivková. Farbu a veľkosť si vyberiete na tejto stránke pred pridaním do košíka.'),
  array('questioon' => 'Môžem ich vrátiť?',
    'answer'    => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí alebo výmenu veľkosti. Stačí e-mail, bez formulárov.'),
);

$is_tradesman = ( function_exists('noriks_is_type') && noriks_is_type('tradesman') );
$tradesman_faq = array(
  array('questioon' => 'Z čoho sú vyrobené?',
    'answer'    => '56 % bambusového lyocelu, 38 % nylonu a 6 % elastanu. Bez bavlny – nylon je zosilnený na päte a prstoch, kde sa ponožky najviac zodierajú. Sú prirodzene odolné voči nepríjemnému zápachu, odvádzajú vlhkosť a sú veľmi mäkké na koži.'),
  array('questioon' => 'Akú veľkosť si vybrať?',
    'answer'    => 'Podľa veľkosti obuvi (EU): 39–42, 43–45, 46–49. Ste medzi dvoma veľkosťami? Zoberte väčšiu.'),
  array('questioon' => 'Zostanú mi chodidlá suché?',
    'answer'    => 'Bambus celú zmenu odvádza vlhkosť z pokožky a sieťované vetranie púšťa pot von. Poteniu nezabránia, ale držia ho pod kontrolou – aj v ťažkých pracovných čižmách.'),
  array('questioon' => 'Nezošmyknú sa v čižmách?',
    'answer'    => 'Nie. Dvojitá manžeta s pútkom na natiahnutie a pásik pod klenbou držia ponožku na mieste – bez krčenia a šmýkania celú zmenu.'),
  array('questioon' => 'Vydržia dlhé zmeny?',
    'answer'    => 'Áno. Mäkký vankúšik a zosilnená päta tlmia každý krok – pre tých, čo sú 8–12 hodín na nohách na betóne, štrku alebo nerovnom teréne.'),
  array('questioon' => 'Aké sú vysoké?',
    'answer'    => 'Klasická výška – asi 18 cm od päty po okraj manžety.'),
  array('questioon' => 'Ako ich prať?',
    'answer'    => 'Perte nastudeno a sušte na vzduchu. Bambusová látka si aj po mnohých praniach zachová mäkkosť a tvar.'),
  array('questioon' => 'Môžem ich vrátiť?',
    'answer'    => 'Áno. Máte 30 dní na vrátenie peňazí. Doprava je zadarmo pri objednávke nad 70 € a platíte na dobierku, keď príde balík.'),
);

$is_slabproof = ( function_exists('noriks_is_type') && noriks_is_type('slabproof') );
$slabproof_faq = array(
  array('questioon' => 'Akú veľkosť si mám objednať? Mám veľkú nohu.',
    'answer'    => 'Tri veľkosti podľa veľkosti obuvi (EU): <strong>39–42</strong>, <strong>43–45</strong> a <strong>46–49</strong>. Objednajte si svoje bežné číslo obuvi.'),
  array('questioon' => 'Sú z vlny? Neznášam, keď škriabe.',
    'answer'    => 'Žiadna vlna, ani jedno vlákno. Nič neškriabe, žiadne vyrážky a noha sa v horúčave nevarí. Pletenina odvádza pot z pokožky namiesto toho, aby ho zadržiavala.'),
  array('questioon' => 'Nebudú sa mi chodidlá kúpať v pote?',
    'answer'    => 'Práve preto sú takto urobené. Vzdušná sieťka cez vrchnú časť chodidla a pletenina, ktorá odvádza vlhkosť, sťahujú pot z pokožky.'),
  array('questioon' => 'Ako ich prať? Musím si dávať pozor?',
    'answer'    => 'V práčke nastudeno, v sušičke pri nízkej teplote, spolu s pracovným oblečením. Bez ručného prania, sušenia na šnúre a špeciálneho pracieho prostriedku.'),
  array('questioon' => 'Naozaj vydržia, alebo sa prederavia ako všetky ostatné?',
    'answer'    => 'Päta a prsty sú zosilnené dvojito pleteným nylonom, presne tam, kde ponožky povolia ako prvé. Ak vám aj tak nebudú vyhovovať, máte <strong>30 dní na vrátenie peňazí</strong>.'),
  array('questioon' => 'Kedy pocítim rozdiel?',
    'answer'    => 'Polstrovanie hneď, keď sa v nich prvýkrát postavíte. To, že nezliezajú a zostávajú suché, počas zmeny. Väčšina si to všimne už cestou domov v prvý deň a skutočný znak je, keď si ich na druhý deň ráno zase oblečiete.'),
  array('questioon' => 'Koľko stojí doprava a ako sa platí?',
    'answer'    => 'Doprava je <strong>zadarmo pri objednávkach nad 70 €</strong> a platíte na dobierku pri prevzatí balíka.'),
  array('questioon' => 'Čo ak mi jednoducho nebudú vyhovovať?',
    'answer'    => 'Máte <strong>30 dní na vrátenie peňazí</strong>. Ak nie ste spokojní, ozvite sa nám a peniaze vám vrátime.'),
);

$is_bowl = ( function_exists('noriks_is_type') && noriks_is_type('bowl') );
$bowl_faq = array(
  array('questioon' => 'Pre ktoré psy je miska vhodná?',
    'answer'    => 'Pre <strong>malé plemená</strong> — jazvečík, francúzsky buldoček, knírač, mops, maltézsky psík a podobné. Miska má priemer 15 cm a objem približne 430 ml.'),
  array('questioon' => 'Načo slúži sklon 15°?',
    'answer'    => 'Miska je naklonená smerom k psovi, takže krmivo sa zosúva k nemu a hlava s krkom sú v prirodzenejšej polohe. Pes nemusí tlačiť ňufák do rohu misky ani ohýbať krk až k podlahe.'),
  array('questioon' => 'Prečo je zvýšená?',
    'answer'    => 'Podstavec s výškou 11 cm zdvihne misku bližšie k výške psa, takže je postojačky, s menším ohýbaním krku a chrbta. To je obzvlášť príjemné pre staršie psy.'),
  array('questioon' => 'Môžem ju použiť na vodu?',
    'answer'    => 'Áno. Miska je z nehrdzavejúcej ocele a je rovnako vhodná na krmivo aj na vodu. Mnohí majitelia berú dve — jednu na krmivo, druhú na vodu.'),
  array('questioon' => 'Ako sa čistí?',
    'answer'    => 'Misku opláchnite teplou vodou s prostriedkom na riad. Hladká oceľ nenasáva pachy a nedrží zvyšky krmiva ako plast.'),
  array('questioon' => 'Kĺže sa po podlahe?',
    'answer'    => 'Podstavec je stabilný a neprevrhne sa, keď pes je. Na veľmi hladkých podlahách odporúčame podložku pod podstavec.'),
  array('questioon' => 'Môžem ju vrátiť?',
    'answer'    => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí. Stačí e-mail, bez formulárov.'),
);

$is_pal = ( function_exists('noriks_is_type') && noriks_is_type('pal') );
$pal_faq = array(
  array(
    'questioon' => 'Na čo slúži druhá rukoväť?',
    'answer'    => 'Na <strong>vstávanie</strong>. Spodnú rukoväť chytíte, keď vstávate z kresla, z postele alebo z nízkej stoličky — tlak ide zvisle nadol, takže sa nemusíte predkláňať ani prosiť niekoho o pomoc.',
  ),
  array(
    'questioon' => 'Naozaj stojí sama?',
    'answer'    => 'Áno. Základňa má <strong>štyri gumené nožičky</strong>, ktoré držia palicu vzpriamene, keď ju pustíte. Nepadne na zem, takže sa po nej nemusíte zohýnať.',
  ),
  array(
    'questioon' => 'Kĺže sa na hladkej podlahe?',
    'answer'    => 'Nie. Nožičky sú z protišmykovej gumy a držia na dlažbe, parketách aj laminátoch. Základňa sa prispôsobí aj nerovnému terénu vonku.',
  ),
  array(
    'questioon' => 'Ako funguje svetlo?',
    'answer'    => 'Svetlo je zabudované v rukoväti a zapína sa tlačidlom. Osvetlí cestu pred vami — na nočnú cestu do kúpeľne alebo na prechádzku za súmraku.',
  ),
  array(
    'questioon' => 'Čo robí alarm?',
    'answer'    => 'Stlačením tlačidla sa spustí <strong>hlasný zvukový signál</strong>, ktorý upozorní domácich, ak spadnete alebo potrebujete pomoc.',
  ),
  array(
    'questioon' => 'Dá sa nastaviť výška?',
    'answer'    => 'Áno. Výška sa nastaví za pár sekúnd, bez náradia, takže palica sadne každej postave.',
  ),
  array(
    'questioon' => 'Dá sa zložiť?',
    'answer'    => 'Áno. Zloží sa na niekoľko častí a zmestí sa do tašky alebo do priehradky v aute — praktické na cestovanie a návštevy lekára.',
  ),
  array(
    'questioon' => 'Môžem ju vrátiť?',
    'answer'    => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí alebo výmenu. Stačí e-mail, bez formulárov.',
  ),
);

$is_red = ( function_exists('noriks_is_type') && noriks_is_type('red') );
$red_faq = array(
  array(
    'questioon' => 'Ako terapia červeným svetlom pomáha pri syndróme karpálneho tunela?',
    'answer'    => 'Červené a infračervené svetlo preniká do tkaniva a stimuluje <strong>tvorbu bunkovej energie (ATP)</strong>, čo pomáha utlmiť zápal okolo stredového nervu, zlepšiť prekrvenie a podporiť prirodzené hojenie.',
  ),
  array(
    'questioon' => 'Ako dlho do prvých výsledkov?',
    'answer'    => 'Väčšina používateľov cíti menej nočného mravčenia do <strong>1 – 2 týždňov</strong>. Badateľnejšia zmena v sile úchopu zvyčajne prichádza okolo štvrtého týždňa. Odporúčame pravidelné denné používanie aspoň osem týždňov.',
  ),
  array(
    'questioon' => 'Je bezpečné používať to každý deň?',
    'answer'    => 'Áno. Zariadenie je určené na <strong>denné 15-minútové ošetrenia</strong>. Svetlo pri týchto dávkach tkanivo nezahrieva. Zariadenie sa na konci ošetrenia samo vypne.',
  ),
  array(
    'questioon' => 'Funguje na obidve ruky?',
    'answer'    => 'Áno, pás sa dá nasadiť <strong>na ľavú aj na pravú ruku</strong>. Ak máte problém na oboch rukách, urobte dve ošetrenia po 15 minút za sebou alebo si vyberte balenie s dvomi zariadeniami.',
  ),
  array(
    'questioon' => 'Na aké veľkosti ruky sa hodí?',
    'answer'    => 'Pružný pás s nastaviteľným remienkom sadne na <strong>väčšinu veľkostí dospelej ruky</strong>, aj na tie väčšie. Otvor na palec drží zariadenie na mieste počas celého ošetrenia.',
  ),
  array(
    'questioon' => 'Čo je v balení?',
    'answer'    => '1× pás NORIKS RED, <strong>1× nabíjací kábel USB-C</strong> a návod s odporúčaným protokolom terapie.',
  ),
  array(
    'questioon' => 'Ako dlho vydrží batéria?',
    'answer'    => 'Jedno nabitie stačí na <strong>až 4 ošetrenia</strong>. Zariadenie sa nabíja cez kábel USB-C, takže ho nabijete z nabíjačky na telefón alebo z notebooku.',
  ),
  array(
    'questioon' => 'Nahrádza to lekára?',
    'answer'    => 'Nie. NORIKS RED je zariadenie na domáce použitie a <strong>nenahrádza lekárske vyšetrenie</strong> ani predpísanú liečbu. Pri pretrvávajúcich alebo silných ťažkostiach vyhľadajte lekára.',
  ),
  array(
    'questioon' => 'Môžem ho vrátiť?',
    'answer'    => 'Áno, máte <strong>30 dní</strong> na vrátenie peňazí alebo výmenu. Stačí e-mail, bez formulárov.',
  ),
);

$is_kneeheat = ( function_exists('noriks_is_type') && noriks_is_type('kneeheat') );
$kneeheat_faq = array(
  array(
    'questioon' => 'Ako prístroj vlastne funguje?',
    'answer'    => 'Teplo do <strong>42 °C</strong> rozširuje cievy a uľahčuje prísun krvi do hlbšieho tkaniva. Rytmická vzduchová kompresia vytláča nahromadenú tekutinu a privádza čerstvú krv a vibrácie <strong>60 Hz</strong> uvoľňujú stuhnutosť okolo kĺbu. Všetky tri terapie fungujú súčasne.',
  ),
  array(
    'questioon' => 'Na aké ťažkosti je určený?',
    'answer'    => 'Na chronické, postupne vzniknuté ťažkosti — stuhnuté, bolestivé alebo opuchnuté koleno, ktoré sa objavuje s vekom a záťažou. Pri čerstvom zranení, nedávnej operácii alebo poruchách krvného obehu sa najprv poraďte s lekárom.',
  ),
  array(
    'questioon' => 'Ako dlho trvá jedno sedenie?',
    'answer'    => '<strong>12 minút.</strong> Prístroj sa spúšťa jedným tlačidlom a na konci sedenia sa sám zastaví.',
  ),
  array(
    'questioon' => 'Kedy pocítim rozdiel?',
    'answer'    => 'Mnohí cítia, že je koleno uvoľnenejšie už po prvom sedení. Citeľnejšia zmena zvyčajne prichádza po <strong>7 až 14 dňoch</strong> každodenného používania.',
  ),
  array(
    'questioon' => 'Môžem ho používať na obe kolená?',
    'answer'    => 'Áno. Bandáž sedí na ľavú aj pravú nohu — ak vás trápia obe, spustite sedenie na každej.',
  ),
  array(
    'questioon' => 'Čím sa líši od prístroja TENS alebo termofóru?',
    'answer'    => 'TENS prekrýva signál bolesti a termofór zahrieva len povrch a za pár minút vychladne. KneeHeat spája dlhotrvajúce teplo, kompresiu a vibrácie, aby pôsobil na hlbšie tkanivo.',
  ),
  array(
    'questioon' => 'Treba ho nabíjať?',
    'answer'    => 'Áno, prístroj je bezdrôtový a nabíja sa priloženým USB-C káblom. Jedno nabitie vydrží na viac sedení.',
  ),
  array(
    'questioon' => 'Sedí na každú veľkosť nohy?',
    'answer'    => 'Pásy sú nastaviteľné a v balení je aj predlžovací pás pre väčšie obvody nohy.',
  ),
);

$is_winecooler = ( function_exists('noriks_is_type') && noriks_is_type('winecooler') );
$winecooler_faq = array(
  array('questioon' => 'Ako funguje ponuka na viac kusov?',
    'answer'    => 'Jednoducho vyberte ponuku <strong>1x ks</strong>, <strong>2x ks</strong> alebo <strong>3x ks</strong> — do košíka sa pridá zvolený počet chladičov vína a zľava sa započíta automaticky.'),
  array('questioon' => 'Aké spôsoby platby môžem použiť?',
    'answer'    => 'U nás môžete platiť cez Apple Pay, Google Pay, Mastercard a Visa.'),
  array('questioon' => 'Ako to funguje?',
    'answer'    => 'Vložte chladiacu tyčinku do mrazničky aspoň na 1 hodinu. Vychladenú tyčinku vsuňte do fľaše vína. Odpite si dúšok, aby ste urobili trochu miesta, a vychutnajte si dokonale vychladené víno pri každom naliatí.'),
  array('questioon' => 'Informácie o doručení',
    'answer'    => 'Doprava zadarmo pri objednávkach nad 70 €. Doba doručenia je 5–12 pracovných dní od odoslania.'),
  array('questioon' => 'Pravidlá vrátenia',
    'answer'    => 'Právo na vrátenie do 30 dní. Ak nie ste s nákupom úplne spokojní, ozvite sa nám do 30 dní od prevzatia objednávky a radi vám pomôžeme s vrátením tovaru alebo peňazí.'),
);

$faq_pick = function( $title, $list ) use ( $is_winecooler, $winecooler_faq, $is_slim, $slim_faq, $is_tradesman, $tradesman_faq, $is_slabproof, $slabproof_faq, $is_bowl, $bowl_faq, $is_snug, $snug_faq, $is_kompwom, $kompwom_faq, $is_pal, $pal_faq, $is_red, $red_faq, $is_kneeheat, $kneeheat_faq, $is_hyd_faq, $hyd_faq, $is_cloud_faq, $cloud_faq, $is_cloath_faq, $cloath_faq, $is_controlpro_faq, $controlpro_faq, $is_ortopas_faq, $ortopas_faq, $is_bunion_faq, $bunion_faq, $is_fisiorest_faq, $fisiorest_faq, $is_norikshers_faq, $norikshers_faq, $is_leakboxers_faq, $leakboxers_faq, $is_kompmajice_faq, $kompmajice_faq, $is_jastuk_faq, $jastuk_faq, $is_kidsnest_faq, $kidsnest_faq, $is_kneefix_faq, $kneefix_faq ) {
  $t = (string) $title;
  $is_info = ( stripos( $t, 'produkt' ) !== false ) || ( stripos( $t, 'výrobk' ) !== false );
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
  <h2>Často kladené otázky</h2>
  

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
		


