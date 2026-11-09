<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

<style>

      .features2 {
    margin-top: 12px;
    margin-bottom: 12px;
      }

      .features__row {
        display: flex;
        justify-content: space-between;
        gap: 28px;
      }

      .feature {
        flex: 1 1 0;
        text-align: center;
      }

      .feature__icon {
 
        margin: 0 auto 0px;
        display: block;
        margin-bottom: 0 !important;
      }

      .feature__text {
        margin: 0;
        line-height: 1.1;
    font-size: 14px;
    margin: 0;
        font-family: 'Barlow', sans-serif;
      }

      /* Responsive: stack nicely on small screens */
      @media (max-width: 640px) {
        .features__row {
     
        }
      }
    </style>


 <section class=" features2" aria-label="Prednosti">
      <div class="features__row">
        <!-- 1) Truck -->
        
        
          <div class="feature">
          
  <img src="<?php echo get_template_directory_uri(); ?>/img/cod_icon_.png" alt="Customer Support Icon" class="feature__icon info-icon">
          <p class="feature__text">Platba na dobierku</p>
        </div>
        
        
        <div class="feature">
      <img src="https://noriks.com/hr/wp-content/uploads/2025/07/footer_icon1-1.png" alt="Shirt Icon" class="feature__icon info-icon">
          <p class="feature__text">Vyskúšajte 30 dní, bez rizika</p>
        </div>
        
        

        <!-- 2) Smiley -->
        <div class="feature">
     
       
        <img src="https://noriks.com/hr/wp-content/uploads/2025/07/footer_icon3-1.png" alt="Shipping Icon" class="feature__icon info-icon">
          <p class="feature__text">Doprava zadarmo pre objednávky nad 70 €</p>
        </div>

    
    
      </div>
    </section>




<?php if ( noriks_is_type( 'ortopas' ) ) : ?>
<!-- Ortopas: kartica "preverjeno s strani zdravnika" (slika) -->
<div class="ortopas-doctor-card" style="margin:14px 0;">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/img/ortopas/ortopas-zdravnik.png' ); ?>"
       alt="Overené lekárom — ortopedický pás NORIKS"
       style="width:100%; height:auto; display:block; border-radius:10px;"
       loading="lazy" decoding="async">
</div>
<?php endif; ?>

<!-- date and countdown section -->

<div class="shipping-box">
  <h2 id="shipping-window" class="shipping-title"></h2>
  <p class="shipping-sub">
    Objednajte v nasledujúcich <span id="midnight-countdown" class="countdown"></span>
  </p>
</div>

<style>
  .shipping-box { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; color:#222; margin-top: 13px;
    margin-bottom: 13px; 
      
    background: #f4f4f4;
    padding: 8px 6px 8px 12px;
    border-radius: 5px;
          text-align: center;
      
      
      
  }
  .shipping-title { font-family: 'Roboto', sans-serif;
    font-size: 14px !important;
    font-weight: 700 !important;
    line-height: 1.4 !important; margin-bottom: 0px;
    color: #222 !important; }
  .shipping-sub { font-size: 14px; margin: 0; }
  .countdown { color: #22a155; font-weight: 700; }
</style>

<script>
  (function () {
    const weekdays = ['nedeľa','pondelok','utorok','streda','štvrtok','piatok','sobota'];


    // Helper to add business days (skip Saturday/Sunday)
    function addBusinessDays(date, days) {
      let result = new Date(date);
      let added = 0;
      while (added < days) {
        result.setDate(result.getDate() + 1);
        const day = result.getDay();
        if (day !== 0 && day !== 6) { // skip Sunday(0) + Saturday(6)
          added++;
        }
      }
      return result;
    }

    // Get shipping days: today +2 business days, today +3 business days
    const today = new Date();
    const first  = addBusinessDays(today, 2);
    const second = addBusinessDays(today, 5);

    function formatDayMonth(d) {
      return `${d.getDate()}.${d.getMonth()+1}.`; // e.g. 21.8.
    }

    const windowEl = document.getElementById('shipping-window');
    windowEl.textContent = `Doručenie od ${weekdays[first.getDay()]}  ${formatDayMonth(first)} do ${weekdays[second.getDay()]}, ${formatDayMonth(second)}`;

    // Countdown to midnight
    const cdEl = document.getElementById('midnight-countdown');

    function nextMidnight(now) {
      const n = new Date(now);
      n.setHours(24, 0, 0, 0);
      return n;
    }

    function updateCountdown() {
      const now = new Date();
      const end = nextMidnight(now);
      let diff = Math.max(0, end - now);

      const h = Math.floor(diff / 3_600_000); diff -= h * 3_600_000;
      const m = Math.floor(diff / 60_000);    diff -= m * 60_000;
      const s = Math.floor(diff / 1000);

      cdEl.textContent = `${h}h ${m}min ${s}s`;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
  })();
</script>


<!-- date and countdown section -->





<?php 

$is_singles_boxers = has_term( 'singles-boxers', 'product_cat', $current_product_id );

$is_boxers = has_term( array( 'boxerky','1-ks-boxerky','orto-bokserice','balicek-3-ks-boxerky','balicek-5-ks-boxerky' ), 'product_cat', $current_product_id ) && ! has_term( array( 'black-friday' ), 'product_cat', $current_product_id );

$is_carape = has_term( array( 'ponozky' ), 'product_cat', $current_product_id );

$is_mixed_bundle = has_term( array( 'sady','orto-starter','orto-majica-bokserica','startovaci-balicek' ), 'product_cat', $current_product_id );

?>



<?php if( !$is_boxers && !$is_carape ): ?>


<!-- my thre icons content -->


<div class="features">
    <div class="feature-card">
      <img src="<?php echo get_field("singlepp_icon_img1","option"); ?>" alt="Perfect Fit">
      <p><?php echo get_field("singlepp_icon_t1","option"); ?></p>
    </div>
    <div class="feature-card">
      <img src="<?php echo get_field("singlepp_icon_img2","option"); ?>" alt="Hides Dad Bod">
      <p><?php echo get_field("singlepp_icon_t2","option"); ?></p>
    </div>
    <div class="feature-card">
      <img src="<?php echo get_field("singlepp_icon_img3","option"); ?>" alt="Breathes">
       <p><?php echo get_field("singlepp_icon_t3","option"); ?></p>
    </div>
  </div>


<style>


    .features {
      display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-top: 15px;
    margin-bottom: 15px;
    }

    .feature-card {
    display: flex
;
    flex-direction: column;
    align-items: center;
    flex: 1;
    gap: 8px;
    border-radius: 5px;
    background: #F4F4F4;
    padding: 16px;
    font-size: 14px;
    font-weight: 400;
    color: #111213;
    line-height: 1.2;
    text-align: center;
    }

    .feature-card img {
      width: 32px;
      height: 32px;
      margin-bottom: 0px;
    }

    .feature-card p {
      margin: 0;
      font-weight: 500;
      font-size: 14px;
      color: #222;
       letter-spacing: -0.5px !important;
    }
  </style>
  
 <?php endif; ?>


<!--
<div style="margin-bottom: 15px;" class="woocommerce-product-details__short-description">
    
    
	<?php echo apply_filters( 'the_content', $product->get_description() );  ?>
	
	
</div>
-->



 <!-- icons -->
 
 <!--
 <div class="info-section">

    <div class="info-box">
     
     
     
      

     <img src="<?php echo get_field("singlepp_bottomicons_img1","options"); ?>" alt="" width="25" height="25">
     <?php echo get_field("singlepp_bottomicons_t1","options"); ?>

    
     
     
    </div>
    
    
    
     <div class="info-box">
    
         <a href="tel:+38517776471" style="
    color: #7b8a9b;
    font-weight: 500;
    font-size: 14px;
    font-family: 'Roboto', sans-serif; display: flex; align-items: center; text-decoration: none; ">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right: 6px;    width: 17px;
    height: 17px;" viewBox="0 0 16 16">
    <path d="M3.654 1.328a.678.678 0 0 1 .737-.07l2.547 1.272a.678.678 0 0 1 .291.901L6.29 5.72a.678.678 0 0 0 .145.776l2.457 2.457a.678.678 0 0 0 .776.145l2.29-1.24a.678.678 0 0 1 .901.291l1.272 2.547a.678.678 0 0 1-.07.737l-1.175 1.769c-.46.692-1.232 1.043-2.036.964-2.322-.238-4.96-2.223-6.856-4.12C1.77 7.667-.214 5.03.024 2.707c.079-.804.272-1.577.964-2.036L3.654 1.33z"/>
  </svg>
  01 777 64 71
</a>

<a href="mailto:info@noriks.com" style="
    color: #7b8a9b;
    font-weight: 500;
    font-size: 14px;
    font-family: 'Roboto', sans-serif; display: flex; align-items: center; text-decoration: none;">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right: 6px;    width: 17px;
    height: 17px;" viewBox="0 0 16 16">
    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.083 0 4.217V4zm0 1.383v6.234l5.803-3.122L0 5.383zM6.761 8.83 0 12.383V12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.383l-6.761-3.553L8 9.917l-1.239-.653zM16 5.383l-5.803 3.112L16 11.617V5.383z"/>
  </svg>
  info@noriks.com
</a>
         
   
     </div>
     

    <div class="info-grid">
      
      
      
      
      <div class="info-box">
       <img src="<?php echo get_field("singlepp_bottomicons_img2","options"); ?>" alt=""  width="25" height="25">
        <?php echo get_field("singlepp_bottomicons_t2","options"); ?>
      </div>
      <div class="info-box">
  
<img src="<?php echo get_field("singlepp_bottomicons_img3","options"); ?>" alt=""  width="25" height="25">
<?php echo get_field("singlepp_bottomicons_t3","options"); ?>
      </div>
    </div>

  </div>
  -->
  
  <style>


    .info-section {
      display: flex;
      flex-direction: column;
      gap: 7px;
      max-width: 800px;
      margin: auto;
      margin-bottom: 25px;
    }
    
    .info-section img {
      width: 25px;
    }


    .info-box {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background-color: #f5f6f8;
      border-radius: 3px;
      padding: 16px;
      color: #7b8a9b;
      font-weight: 500;
      font-size: 14px;
          font-family: 'Roboto', sans-serif; 
      text-align: center;
    }

    .info-grid {
      display: flex;
      gap: 7px;
    }

    .info-grid .info-box {
      flex: 1;
    }

    .info-box svg {
      width: 24px;
      height: 24px;
      fill: #7b8a9b;
    }
  </style>









 <!-- icons -->


 <div class="accordion">


    <!-- KidsNest: prve dve accordion miesta (dlhy obsah zo summary) -->
    <?php if ( function_exists('noriks_is_type') && noriks_is_type( 'kidsnest', $current_product_id ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Tvár vášho dieťaťa sa formuje práve teraz — a čas máte do 9. roku</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <p>Výskumníci dýchacích ciest a detskí zubní lekári roky upozorňujú na rovnaký vzorec — a väčšina rodičov o ňom nikdy nepočula. Volá sa <strong>syndróm predĺženej tváre</strong> (adenoidná tvár).</p>
        <p>Každú noc, keď dieťa spí s otvorenými ústami na nesprávnom vankúši, sa dejú štyri veci naraz: jazyk padá dozadu, čeľusť sa sťahuje, podnebie sa zužuje do vysokého oblúka a tvár začína rásť vertikálne namiesto horizontálne. Po tisíckach takýchto nocí medzi 3. a 9. rokom sa zmeny upevnia.</p>
        <p>Preto dnes 9-ročné deti prichádzajú k ortodontovi so stiahnutou bradou, kruhmi pod očami, natlačenými zubami — a drahým účtom za strojček. Spôsob, akým dieťa dýcha medzi 3. a 9. rokom, výrazne ovplyvňuje tvár, ktorú bude nosiť celý život.</p>
        <p>NORIKS <strong>KidsNest</strong> je navrhnutý tak, aby pôsobil na základnú príčinu — nesprávnu polohu hlavy a čeľuste počas 9 hodín spánku — s <strong>3-zónovou ergonomickou štruktúrou</strong>, ktorá drží hlavu, krk a čeľusť v správnom zarovnaní od prvej noci.</p>
        <p><strong>Čo uvidíte u svojho dieťaťa:</strong></p>
        <ul style="margin:6px 0 12px;padding-left:18px;">
          <li style="margin:0 0 7px;"><strong>Menej dýchania ústami:</strong> pery zatvorené počas noci, návrat dýchania nosom, koniec suchých úst ráno.</li>
          <li style="margin:0 0 7px;"><strong>Tichšie noci:</strong> chrápanie sa u väčšiny detí upokojí do 1 – 2 týždňov.</li>
          <li style="margin:0 0 7px;"><strong>Opora pre vyvíjajúcu sa čeľusť:</strong> správna poloha noc čo noc, v rokoch, keď na tom najviac záleží.</li>
          <li style="margin:0 0 7px;"><strong>Múdra prevencia:</strong> jeden vankúš dnes — namiesto drahých korekcií zajtra.</li>
        </ul>
        <p><strong>Jeden vankúš dnes večer. Alebo tisíce neskôr.</strong></p>
      </div>
    </div>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Staršie ako 9? Okno sa zužuje. Poškodenie sa nezastaví.</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <p>Rada, ktorú ste počuli, je pravdivá len spolovice. Áno, horné podnebie sa spevní okolo 9. roku. Ale tvár sa vyvíja do 20. roku, dolná čeľusť rastie do 17. a dýchacie cesty sa neustále prispôsobujú.</p>
        <p>Preto každá noc dýchania ústami po 9. roku pridáva nové poškodenie k starému: škrípanie zubami, bolesti hlavy, spánok, ktorý neoddýchne, pokles koncentrácie — a únava, ktorú si všetci mýlia s lenivosťou. Váš tínedžer nie je lenivý. Každú noc šesť hodín sotva dýcha.</p>
        <p>KidsNest vo veľkosti <strong>9 – 14 rokov</strong> je vyrobený pre staršiu hlavu, krk a ramená. Iná kontúra, iná výška, iná opora. Rovnaký základný mechanizmus: správne zarovnanie hlavy, krku a čeľuste, celú noc, na tele, ktoré ešte rastie.</p>
        <p>Čo si rodičia všímajú: chrápanie sa upokojí za 7 až 14 nocí, vracia sa skutočná ranná energia, bolesti hlavy slabnú, sústredenie sa vracia.</p>
        <p>Najlepšie okno je stále od 3. do 9. roku. Silné okno je od 8. do 18. Žiadne nie je úplne zatvorené — ale každá noc čakania pridáva záťaž telu, ktoré sa snaží zotaviť.</p>
        <p><strong>Včera je preč. Dnešný večer je stále váš.</strong></p>
      </div>
    </div>
    <?php endif; ?>


    <!-- ErgoSit ortopedický vankúš: prvé dve accordion miesta (kópia originálu, SK) -->
    <?php if ( function_exists('noriks_is_type') && noriks_is_type( 'ortopedski-jastuk', $current_product_id ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Špecifikácie produktu</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <ul style="margin:8px 0 12px; padding-left:18px;">
          <li style="margin:0 0 8px;"><strong>Vonkajší poťah:</strong> Priedušná pletenina, sťahuje sa a perie v práčke, hypoalergénna</li>
          <li style="margin:0 0 8px;"><strong>Jadro:</strong> Adaptívna pena OrthoFlex™ | Netoxická, certifikovaná OEKO-TEX® | Navrhnutá na odľahčenie tlaku + zarovnanie držania tela</li>
        </ul>
      </div>
    </div>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Čím je taký výnimočný?</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <ul style="margin:8px 0 12px; padding-left:18px;">
          <li style="margin:0 0 10px;"><strong>Pamäťová pena OrthoFlex™:</strong> Pena s vysokou hustotou, ktorá odľahčuje tlak a prispôsobí sa bez sploštenia — podopiera kostrč, boky a chrbticu pre celodenné pohodlie.</li>
          <li style="margin:0 0 10px;"><strong>Poťah BreatheEase™:</strong> Mäkký, priedušný a jemný k pokožke. Sťahuje sa a perie v práčke, aby vankúš vždy zostal svieži.</li>
          <li style="margin:0 0 10px;"><strong>Vyvážená opora:</strong> Ani primäkká, ani pritvrdá. Navrhnutá tak, aby zarovnala držanie tela a zmiernila boľavé body z dlhých hodín sedenia.</li>
        </ul>
      </div>
    </div>
    <?php endif; ?>


    <!-- 1 - detajli --> <!-- skryté na norikshers (no-attrs) + ortopedický vankúš -->
    <?php if ( ! ( function_exists('noriks_is_type') && ( noriks_is_type('norikshers', $current_product_id) || noriks_is_type('ortopedski-jastuk', $current_product_id) ) ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo get_field("singlepp_acc_h_1","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">

                  <?php if( function_exists('noriks_is_type') && noriks_is_type('snug', $current_product_id) ): ?>

                <strong>NORIKS Snug</strong> je vankúš na celé telo v tvare písmena S. Väčšina telových vankúšov je rovná — vaše telo nie je. Preto Snug kopíruje líniu tela a podopiera ramená, boky aj kolená naraz.<br><br>Keď spíte na boku bez opory, rameno nesie celú váhu, bok klesá a chrbtica sa krúti. Tri body opory rozložia váhu, takže žiadne miesto nenesie celé zaťaženie.<br><br>Rozmery sú 105 cm dĺžky a 30 cm šírky — dosť na to, aby vás podopieral od ramena po kolená, a pritom nezaberie celú posteľ. Výplň tvoria tisíce jemných pružných vlákien, ktoré sa vracajú do tvaru a nesplasnú ani po mesiacoch používania.<br><br>Chladivá obliečka sa dá zložiť a vyprať v práčke na 40 °C a látka prepúšťa vzduch celú noc. Dostupný je v šiestich farbách: modrá, ružová, sivá, zelená, fialová a tmavomodrá.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kompwom', $current_product_id) ): ?>

                <strong>NORIKS FIT Woman</strong> je tvarujúce tričko, v ktorom je reliéf votkaný priamo do látky, nie na ňu potlačený. Široký pás prechádza cez brucho a boky, druhý ide cez chrbát.<br><br>Kompresia je rozložená do šírky, nie stlačená do jedného bodu, takže nič nezareže. Brucho zostáva vyhladené, pás užší a chrbát dostáva oporu, ktorá pomáha stáť vzpriamenejšie.<br><br>Úplet je bezšvový, tenký a matný — zmizne pod košeľou, sakom alebo priliehavými šatami. Cez deň sa neroluje a nečrtá sa pod oblečením.<br><br>Perte v práčke na 30 °C, bez bielidiel, žehlenia a sušičky. Dostupné je v troch farbách (čierna, tmavosivá, ružová) a vo veľkostiach od S po 3XL. Ak ste medzi dvomi veľkosťami, vezmite väčšiu.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slim', $current_product_id) ): ?>

                <strong>NORIKS Slim</strong> sú tvarujúce nohavičky s vysokým pásom. Široký pás prechádza krížom cez brucho a pokračuje na boky a chrbát, takže kompresia je rozložená okolo celého pása, a nie stlačená do jednej línie.<br><br>Brucho je vyhladené, pás vyzerá užší a oblečenie padne rovnejšie — bez záhybov nad nohavicami a bez okraja, ktorý vidno pod šatami.<br><br>Úplet je tenký, mäkký a priedušný, s elastickými sieťovanými vsadkami a bavlnenou vložkou. Nohavičky sa nerolujú nadol a počas dňa sa nešmýkajú, takže si ich ráno oblečiete a do večera na ne zabudnete.<br><br>Dostupné sú v šiestich farbách (čierna, telová, tmavomodrá, fialová, fuchsiová a slivková) a vo veľkostiach od XS do 5XL. Veľkosť vyberajte podľa obvodu pása; ak ste medzi dvoma veľkosťami, vezmite si väčšiu.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('tradesman', $current_product_id) ): ?>

                NORIKS Tradesman sú hrubé pracovné ponožky z bambusu pre všetkých, ktorí celý deň stoja a chodia v pracovných čižmách – na stavbe, v sklade, v dielni alebo vonku v zime. Mäkký vankúšik tlmí každý krok na betóne aj zamrznutej zemi, zosilnená päta a prsty vydržia tuhé čižmy a pásik pod klenbou s dvojitou manžetou drží ponožku na mieste celú zmenu.<br><br><strong>Zloženie:</strong> 56 % bambusového lyocelu, 38 % nylonu, 6 % elastanu – prirodzene odolné voči nepríjemnému zápachu, odvádzajú vlhkosť a sú veľmi mäkké na koži. <strong>Prevedenie:</strong> 360° opora členka, pásik pod klenbou, vankúšik, sieťované vetranie, dvojitá manžeta s pútkom, zosilnená päta. Výška: klasická, asi 18 cm od päty po okraj.<br><br><strong>Veľkosti (veľkosť obuvi EU):</strong> 39–42, 43–45, 46–49. Farba: čierna. <strong>Starostlivosť:</strong> perte nastudeno, sušte na vzduchu.<br><br>S NORIKS máte 30 dní na vrátenie peňazí, dopravu zadarmo nad 70 € a platbu na dobierku.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slabproof', $current_product_id) ): ?>

                <strong>NORIKS SlabProof</strong> sú pracovné ponožky urobené pre ľudí, ktorí celý deň pracujú na nohách — na stavbe, v sklade, dielni, obchode alebo kuchyni. Pracovné čižmy chodidlo chránia, ale netlmia ho — tvrdá podlaha nič nevráti, takže každý krok ide do piat, kolien a chrbta. Jediné, čo ten náraz môže zmierniť, je ponožka.<br><br>Preto majú <strong>zónové polstrovanie</strong>: husté vankúšiky pod pätou a prednou časťou chodidla, presne tam, kde krok udiera najsilnejšie, a tenkú pleteninu všade inde, takže čižma nebude pritesná. Päta a prsty sú zosilnené dvojito pleteným nylonom, na dvoch miestach, kde ponožky povolia ako prvé.<br><br>Vzdušná sieťka cez vrchnú časť chodidla a pletenina, ktorá odvádza pot, udržia chodidlá suché celú zmenu. Zmes je bez vlny, takže nič neškriabe a noha sa neprehrieva.<br><br>Široký rebrovaný lem drží ponožku hore bez zvierania lýtka, hlboké vrecko na pätu s jazýčkom nedovolí, aby sa zošmykla do čižmy, a pás okolo klenby drží chodidlo, aby sa nešmýkalo.<br><br>Dostupné sú v čiernej farbe, vo veľkostiach 39–42, 43–45 a 46–49. Platí <strong>30 dní na vrátenie peňazí</strong> a doprava je zadarmo pri objednávkach nad 70 €.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('winecooler', $current_product_id) ): ?>

                <strong>NORIKS WineCooler</strong> je chladiaca tyčinka na víno z nehrdzavejúcej ocele so zabudovaným nalievačom. Tyčinku vložte do mrazničky aspoň na 1 hodinu a potom ju vsuňte do fľaše — za 10–15 minút dosiahne víno ideálnu teplotu podávania a zostane studené až 3 hodiny, od prvého naliatia až po posledný dúšok.<br><br>Je vyrobená z vysokokvalitnej nehrdzavejúcej ocele vhodnej na styk s potravinami. Na rozdiel od kociek ľadu víno neriedi a na rozdiel od nádoby s ľadom zostáva fľaša na stole suchá.<br><br>Nalievač zaistí rovnomerné nalievanie bez kvapkania, takže víno aj obrus zostanú čisté. Zabudované prevzdušňovanie pomáha, aby sa arómy vína naplno rozvinuli pre bohatšiu chuť.<br><br>Nalievač sa dá odňať a tyčinku môžete umývať v umývačke riadu alebo dôkladne umyť teplou vodou. Hodí sa do väčšiny štandardných fliaš vína — ideálna na biele víno, rosé a šumivé vína, na večere, posedenia na balkóne a ako darček pre milovníkov vína.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('bowl', $current_product_id) ): ?>

                <strong>NORIKS Bowl</strong> je zvýšená miska na krmivo a vodu určená pre malé psy. Miska stojí na oceľovom podstavci s výškou 11 cm a je naklonená o 15°, takže pes je postojačky, s hlavou v prirodzenejšej polohe namiesto toho, aby ohýbal krk až k podlahe.<br><br>Miska je plytká (5 cm), takže fúzy nenarážajú o okraj a krmivo sa netlačí von. Priemer je 15 cm a objem približne 430 ml — dosť na porciu alebo vodu pre malého psa.<br><br>Miska aj podstavec sú vyrobené z nehrdzavejúcej ocele. Hladký povrch nenasáva pachy a nedrží zvyšky krmiva ako plast; stačí ju opláchnuť teplou vodou s prostriedkom na riad.<br><br>Vhodná je pre malé plemená, ako sú jazvečík, francúzsky buldoček, knírač, mops a maltézsky psík.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('pal', $current_product_id) ): ?>

                <strong>NORIKS Pal</strong> je vychádzková palica navrhnutá okolo jedného problému: vstávania. Okrem hornej rukoväte má aj druhú, nižšie, ktorej sa chytíte, keď vstávate z kresla, z postele alebo z nízkej stoličky — bez predklonu a bez cudzej pomoci.<br><br>Štyri gumené nožičky držia palicu vzpriamene, keď ju pustíte. Nepadne na zem, takže sa po nej nemusíte zohýnať. Základňa je protišmyková a zostáva stabilná na dlažbe, parketách aj na nerovnom teréne.<br><br>V rukoväti je zabudované svetlo, ktoré osvetlí cestu pred vami — na cestu do kúpeľne v noci alebo na prechádzku za súmraku. Popri ňom je aj zvukový alarm, ktorý upozorní domácich, ak spadnete alebo potrebujete pomoc.<br><br>Palica je skladacia a zmestí sa do tašky alebo do priehradky v aute, výška sa nastaví za pár sekúnd, bez náradia, pre každú postavu.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kneeheat', $current_product_id) ): ?>

                <strong>NORIKS KneeHeat</strong> je bandáž na koleno, ktorá v jednom sedení spája tri terapie: teplo do 42 °C, vzduchovú kompresiu a vibračnú masáž 60 Hz. Teplo rozširuje cievy a uľahčuje prísun krvi do hlbšieho tkaniva, rytmická kompresia vytláča nahromadenú tekutinu a vibrácie uvoľňujú stuhnutosť okolo kĺbu.<br><br>Sedenie trvá 12 minút a spúšťa sa jedným tlačidlom — bez aplikácie, bez nastavovania a bez kábla. K dispozícii sú 3 stupne tepla a 3 režimy vibrácií, takže intenzitu prispôsobíte dňu a ťažkostiam.<br><br>Bandáž má ergonomický tvar a drží nastaviteľnými pásmi; sedí na ľavé aj pravé koleno a v balení je aj predlžovací pás pre väčšie obvody. Látka na koži je mäkká a priedušná.<br><br>Prístroj sa nabíja priloženým USB-C káblom a jedno nabitie vydrží na viac sedení. K prístroju dostanete 2 roky záruku na výmenu.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('red', $current_product_id) ): ?>

                <strong>NORIKS RedRelief</strong> je pás na zápästie, ktorý spája dve najpreskúmanejšie vlnové dĺžky v terapii červeným svetlom: červené svetlo 660 nm upokojuje povrchový zápal a infračervené 850 nm preniká hlbšie, k tkanivu okolo stredového nervu.<br><br>Svetlo sa v tkanive mení na bunkovú energiu (ATP) a podnecuje miestne prekrvenie — dva procesy, ktoré sú súčasťou prirodzenej regenerácie tela. Preto sa používa pri syndróme karpálneho tunela, zápale šliach, artritíde a bolestiach ruky a zápästia.<br><br>V páse je zabudovaných 48 dvojitých LED diód rozložených po celej vnútornej strane, takže svetlo pokryje celé zápästie, nie len jeden bod. K dispozícii sú 4 režimy a 3 úrovne výkonu.<br><br>Zariadenie je bezdrôtové a nabíja sa cez kábel USB-C — jedno nabitie stačí na až 4 ošetrenia. Váži iba 126 g, má otvor na palec a nastaviteľný remienok, takže sadne na ľavú aj pravú ruku. Odporúča sa jedno 15-minútové ošetrenie denne; zariadenie sa na konci samo vypne.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kidsnest', $current_product_id ) ): ?>

                NORIKS KidsNest je vyrobený z hypoalergénnej pamäťovej peny s certifikátom OEKO-TEX® — bez formaldehydu, ťažkých kovov a BPA — s priedušným pleteným poťahom.<br><br>Jeho 3-zónová ergonomická štruktúra jemne prijíma hlavu, podopiera krk a pomáha udržať chrbticu v prirodzenom zarovnaní — aj keď sa dieťa počas noci veľa otáča. Tým podporuje dýchanie nosom a pokojnejší, hlbší spánok.<br><br>Dostupný v troch veľkostiach (1 – 3, 3 – 9 a 9 – 14 rokov), rastie s vaším dieťaťom a poskytuje správnu výšku opory v každej fáze vývoja.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('controlpro', $current_product_id) ): ?>

                NORIKS ControlPro je mechanický tréner panvového dna so skutočným fyzickým odporom. Namiesto stláčania naprázdno dostanete niečo, proti čomu môžete tlačiť — rovnaký princíp postupného zaťaženia, ktorým posilňuje každý iný sval v tele.<br><br>Používa sa v sede: prístroj vložíte medzi kolená a stláčate proti odporu — 3 série po 10 opakovaní denne, približne päť minút. Bez sond a zavádzania, bez káblov, gélu, batérií a aplikácií. Zabudované počítadlo opakovaní ukazuje, koľko ste odcvičili.<br><br>Konštrukcia je pevná, s mäkkými podložkami na opierkach, ktoré netlačia ani po viacerých sériách. Odpor sa postupne zvyšuje, ako svaly silnejú.<br><br>Je určený mužom, ktorí chcú získať späť kontrolu nad mechúrom — po operácii prostaty, pri úniku počas námahy alebo po dlhých mesiacoch Kegelových cvikov bez výsledku. Doručenie je diskrétne, v neutrálnej krabici bez označenia.


         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kneefix', $current_product_id) || noriks_is_type('controlpro', $current_product_id) ): ?>

                NORIKS KneeFix je flexibilná ortéza na koleno, ktorá spája štyri funkcie v jednom systéme podpory: nastaviteľnú kompresiu pomocou presného kolieska, dvojité bočné stabilizátory, gélovú vložku, ktorá odľahčuje jabĺčko, a silikónový protišmykový okraj, ktorý ortézu udrží na mieste.<br><br>Na rozdiel od tuhých ortéz KneeFix koleno neznehybní — podopiera ho počas prirodzeného pohybu. Kompresiu nastavíte za sekundu: ráno pevnejšie, popoludní voľnejšie, podľa toho, koľko ste na nohách. Koleno tak získa stabilitu pri vstávaní, na schodoch, pri chôdzi aj pri dlhšom státí.<br><br>Látka je ľahká, priedušná a odvádza vlhkosť, takže ortézu môžete nosiť hodiny bez potenia a bez zarezávania. Je tenká a diskrétna — pod nohavicami ju takmer nevidno.<br><br>K dispozícii je vo veľkostiach od S po 2XL podľa telesnej hmotnosti a vo verzii na ľavé aj pravé koleno, takže padne presne.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

                Inkontinenčné boxerky NORIKS sú vyrobené z mäkkého antibakteriálneho bambusového vlákna s vodoodpudivou vonkajšou vrstvou. V strede je 7-vrstvové jadro PureDry™, ktoré okamžite absorbuje a uzamkne až 300 ml tekutiny, takže pokožka zostáva suchá a únik zostáva vo vnútri.<br><br>Strih je tenký a diskrétny — vyzerá a pôsobí ako bežná bielizeň, bez objemnosti a bez pocitu „plienky“. Ochrana pri nohách zabraňuje bočnému pretečeniu a kontrola pachu udržiava sviežosť počas celého dňa.<br><br>Sú prateľné a opakovane použiteľné — absorpčnú schopnosť si udržia počas stoviek praní, ako ekologická a výhodná alternatíva jednorazových vložiek a plienok.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

                NORIKS FIT je vyrobený z pokročilej iónovej kompresnej tkaniny, ktorá poskytuje priliehavý, podporný strih. Cielená kompresia rovnomerne sťahuje brucho a boky, vyhladzuje siluetu a podporuje vzpriamené držanie tela — bez sťahovania, ktoré obmedzuje dýchanie či pohyb.<br><br>Mikrotkané vlákna podporujú cirkuláciu a pomáhajú vám počas dňa stáť vzpriamenejšie a cítiť sa istejšie. Tkanina je ľahká, priedušná a odvádza vlhkosť, takže zostávate suchý a v pohodlí.<br><br>Tenký a diskrétny strih ho robí neviditeľným pod akoukoľvek košeľou a zároveň môže slúžiť aj ako športové tričko. Výsledok: ostrejší vzhľad, lepšie držanie tela a sebavedomie — len čo si ho oblečiete.

         <?php elseif( !$is_boxers &&  !$is_carape &&   !$is_mixed_bundle && ! ( function_exists('noriks_is_type') && ( noriks_is_type('fisiorest', $current_product_id) || noriks_is_type('bunion', $current_product_id) || noriks_is_type('ortopas', $current_product_id) ) ) ): ?>



        <?php echo get_field("singlepp_acc_t_1","options"); ?>


        <?php elseif(  has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', $current_product_id )  ): ?>



               Naše prémiové tričká sú vyrobené z prémiovej zmesi 60 % bavlny pradenej metódou prstencového pradenia a 40 % polyesteru, čo zaručuje mimoriadne mäkkú a nekrčivú látku. <br>Boxerky NORIKS sú vyrobené z prémiovej zmesi 95 % modalu a 5 % elastanu, čo zaručuje mimoriadne mäkkú a elastickú látku, ktorá sa dokonale prispôsobí telu. Elastický pás je navrhnutý pre optimálne prispôsobenie, pohodlie bez stiahnutia a perfektný vzhľad pod oblečením. <br>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('fisiorest', $current_product_id) ): ?>

                NORIKS NeckRelax je terapeutický vankúš na krk, ktorý spája trakciu, teplo a vibračnú masáž v ergonomickej konštrukcii z pamäťovej peny. Jemne naťahuje krk pod správnym uhlom, odľahčuje krčnú chrbticu a teplom a masážou uvoľňuje svalové napätie. Bezdrôtový, nabíjateľný a obalený v mäkkom chladivom hodvábe – bezpečný aj na spánok.

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('bunion', $current_product_id) ): ?>

                Korektor vbočeného palca NORIKS s pokročilou terapiou zarovnania a patentovaným kĺbovým mechanizmom jemne vracia palec do prirodzenej polohy, zmierňuje nepohodlie a zabraňuje ďalšiemu rastu výrastku. Pružná konštrukcia umožňuje, aby ste v ňom aj chodili. Padne na všetky veľkosti chodidiel, bez ľavej alebo pravej strany. Na použitie v pokoji – počas oddychu, pozerania TV, čítania alebo spánku.

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) ): ?>

                Ortopedický pás NORIKS cielene stabilizuje driekovú časť chrbta pomocou cielenej kompresie, správne zarovná panvu a odľahčí sedací nerv. Tenký a nenápadný pod oblečením, s nastaviteľnou mierou opory. Vhodný pri bolestiach krížov, išiase, svalovom napätí a problémoch so SI kĺbom.

        <?php else: ?>
        
        
        
            <?php echo get_field("__overwrite_sekcije_bellow_1"); ?>
            
            
        <?php endif; ?>
        
        
        
      </div>
    </div>
    <?php endif; /* koniec skrytia detailov na norikshers */ ?>



     <!-- 2 - slika tablica velicina -->
     <?php if ( ! ( function_exists('noriks_is_type') && ( noriks_is_type('bunion', $current_product_id) || noriks_is_type('fisiorest', $current_product_id) || noriks_is_type('norikshers', $current_product_id) || noriks_is_type('ortopedski-jastuk', $current_product_id) ) )  && ! ( function_exists('noriks_is_type') && noriks_is_type('kneefix', $current_product_id) || noriks_is_type('controlpro', $current_product_id) ) && ! ( function_exists('noriks_is_type') && noriks_is_type('snug', $current_product_id) ) && ! ( function_exists('noriks_is_type') && noriks_is_type('pal', $current_product_id) ) && ! ( function_exists('noriks_is_type') && ( noriks_is_type('bowl', $current_product_id) || noriks_is_type('winecooler', $current_product_id) ) ) && ! ( function_exists('noriks_is_type') && noriks_is_type('red', $current_product_id) || noriks_is_type('kneeheat', $current_product_id) ) && ! ( function_exists('noriks_is_type') && ( noriks_is_type('cloud', $current_product_id) || noriks_is_type('cloath', $current_product_id) || noriks_is_type('hyd', $current_product_id) ) )) : // žiadna tabuľka veľkostí pre bunion + fisiorest + norikshers + ortopedický vankúš ?>
     <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Tabuľky veľkostí</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">

           <?php if( function_exists('noriks_is_type') && noriks_is_type('kidsnest', $current_product_id) ): ?>

          <div class="kn-size">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kidsnest/tablica-velicine-sk.webp" alt="KidsNest veľkosti podľa veku" style="width:100%;height:auto;border-radius:10px;display:block;margin:0 0 12px;" loading="lazy">
            <p style="margin:0;line-height:1.6;"><strong>Dieťa je medzi dvoma veľkosťami?</strong> Vždy vyberte väčšiu. Vankúš je navrhnutý tak, aby podporoval zdravé zarovnanie počas rastu dieťaťa — väčšia veľkosť poskytuje viac priestoru a dlhšie obdobie používania.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('leakboxers', $current_product_id) ): ?>

          <div class="lbx-size">
            <p style="margin:0 0 6px;font-weight:700;">Ako si zmerať boky</p>
            <p style="margin:0 0 14px;line-height:1.6;">Omotajte krajčírsky meter okolo najširšej časti bokov (cez zadok), bez sťahovania. Stojte uvoľnene a vzpriamene a zapíšte si mieru v centimetroch.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#12233b;color:#fff;">
                  <th style="padding:8px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Veľkosť</th>
                  <th style="padding:8px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Boky (cm)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $lbx_sizes = array(
                  array('S','do 76 cm','do 30"'),
                  array('M','77 – 85 cm','30 – 33"'),
                  array('L','86 – 94 cm','34 – 37"'),
                  array('XL','95 – 102 cm','37 – 40"'),
                  array('2XL','103 – 114 cm','41 – 45"'),
                  array('3XL','115 – 121 cm','45 – 48"'),
                  array('4XL','122 – 129 cm','48 – 51"'),
                  array('5XL','130 – 137 cm','51 – 54"'),
                  array('6XL','138 – 145 cm','54 – 57"'),
                  array('7XL','146 – 153 cm','57 – 60"'),
                  array('8XL','154 cm a viac','61" a viac'),
                );
                foreach ( $lbx_sizes as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#f7fafb' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #eee;">
                    <td style="padding:8px 10px;font-weight:700;"><?php echo esc_html($r[0]); ?></td>
                    <td style="padding:8px 10px;"><?php echo esc_html($r[1]); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Medzi dvoma veľkosťami?</strong> Vždy odporúčame väčšie číslo pre optimálne pohodlie a maximálnu absorpciu.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice', $current_product_id) ): ?>

          <div class="kmf-size">
            <table style="width:100%;border-collapse:collapse;font-size:15px;">
              <thead>
                <tr style="background:#111;color:#fff;">
                  <th style="padding:9px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Veľkosť</th>
                  <th style="padding:9px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Zodpovedajúca hmotnosť</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kmf_sizes = array(
                  array('S','50 – 70 kg'), array('M','70 – 90 kg'), array('L','90 – 110 kg'), array('XL','110 – 130 kg'),
                  array('2XL','130 – 150 kg'), array('3XL','150 – 170 kg'), array('4XL','170 – 190 kg'), array('5XL','190 – 210 kg'),
                );
                foreach ( $kmf_sizes as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#f4f4f4' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #eaeaea;">
                    <td style="padding:9px 12px;font-weight:800;"><?php echo esc_html($r[0]); ?></td>
                    <td style="padding:9px 12px;font-weight:700;"><?php echo esc_html($r[1]); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <p style="margin:12px 0 0;line-height:1.6;">Vyberte veľkosť podľa svojej hmotnosti. Medzi dvoma veľkosťami? Pre silnejšiu kompresiu vyberte menšie číslo.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) ): ?>

          <div style="line-height:1.9;">
            <strong>S/M</strong> : obvod bokov 75 – 110 cm<br>
            <strong>L/XL</strong> : obvod bokov 110 – 140 cm<br><br>
            Prosím, zmerajte si obvod bokov, aby ste našli svoju veľkosť.
          </div>

        <?php elseif( $is_boxers ): ?>



          <img class="js-open-size-chart" style="cursor:pointer;" src="https://noriks.com/sk/wp-content/uploads/2026/02/boxers_size_sk.png">



        <?php elseif( noriks_is_type( 'kompresijske-nogavice', $current_product_id ) ): ?>

          <div style="line-height:1.9;">
            <strong>S/M</strong> : veľkosť obuvi 36–40 / obvod lýtka : 23–36 cm<br>
            <strong>L/XL</strong> : veľkosť obuvi 40–44 / obvod lýtka : 36–45 cm<br>
            <strong>2XL</strong> : veľkosť obuvi 44–48 / obvod lýtka : 45–56 cm<br><br>
            Zmerajte prosím obvod lýtka na najširšom mieste, aby ste zistili svoju veľkosť.<br><br>
            Odporúčame vybrať veľkosť podľa obvodu lýtka, nie podľa bežnej veľkosti obuvi.
          </div>

        <?php elseif(  $is_carape ): ?>


                  <img class="js-open-size-chart" style="cursor:pointer;" src="https://noriks.com/sk/wp-content/uploads/2026/02/Nogavice_tabela_velikosti_sk.png">

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slim', $current_product_id) ): ?>

          <div class="slm-size">
            <p style="margin:0 0 14px;line-height:1.6;">Veľkosť vyberajte podľa <strong>obvodu pása</strong>, nie podľa bežnej veľkosti oblečenia. Ak ste medzi dvoma veľkosťami, vezmite si <strong>väčšiu</strong>.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#a3336b;color:#fff;">
                  <th style="padding:9px 10px;text-align:left;">Veľkosť</th>
                  <th style="padding:9px 10px;text-align:left;">EU veľkosť</th>
                  <th style="padding:9px 10px;text-align:left;">Obvod pása</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ( noriks_slim_sizes() as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#fbf2f6' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #f1e3ea;">
                    <td style="padding:9px 10px;font-weight:700;"><?php echo esc_html( $r[0] ); ?></td>
                    <td style="padding:9px 10px;"><?php echo esc_html( $r[1] ); ?></td>
                    <td style="padding:9px 10px;"><?php echo esc_html( $r[2] ); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Ako sa odmerať:</strong> krajčírsky meter oviňte okolo najužšieho miesta trupu, kúsok nad pupkom. Meter má byť vodorovný a priliehavý, ale nie natesno.</p>
          </div>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('tradesman', $current_product_id) ): ?>

          <div class="noriks-size">
            <p style="margin:0 0 14px;line-height:1.6;">Veľkosť vyberte podľa svojej <strong>veľkosti obuvi (EU)</strong>.</p>
            <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#a9683f;color:#fff;">
                  <th style="padding:9px 8px;text-align:left;">Veľkosť obuvi (EU)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( noriks_tradesman_sizes() as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#fdf8f5' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #eee;">
                    <?php foreach ( $r as $j => $c ) : ?>
                    <td style="padding:9px 8px;<?php echo $j ? '' : 'font-weight:700;white-space:nowrap;'; ?>"><?php echo esc_html( $c ); ?></td>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </div>
            <p style="margin:12px 0 0;line-height:1.6;">Ste medzi dvoma veľkosťami? Zoberte väčšiu.</p>
            <p style="margin:14px 0 0;line-height:1.6;">Ak vám veľkosť nesedí, máte 30 dní na vrátenie alebo výmenu.</p>
          </div>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slabproof', $current_product_id) ): ?>

          <div class="noriks-size">
            <p style="margin:0 0 14px;line-height:1.6;">Objednajte si <strong>svoje bežné číslo obuvi</strong>. Pletenina je pružná, takže každá veľkosť pokryje niekoľko čísel.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#d2632e;color:#fff;">
                  <th style="padding:9px 10px;text-align:left;">EU číslo obuvi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ( noriks_slabproof_sizes() as $i => $r ) :
                  $bg = ( $i % 2 ) ? '#faf7f0' : '#fff'; ?>
                  <tr style="background:<?php echo $bg; ?>;border-bottom:1px solid #eee;">
                    <td style="padding:9px 10px;font-weight:700;"><?php echo esc_html( $r[0] ); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Medzi dvoma veľkosťami?</strong> Vezmite väčšiu — vankúšik na päte a pás okolo klenby sadnú na miesto, len keď ponožka nie je primalá.</p>
          </div>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kompwom', $current_product_id) ): ?>

          <div class="kwm-size">
            <p style="margin:0 0 14px;line-height:1.6;">Veľkosť vyberajte podľa <strong>obvodu hrudníka</strong> — ten určuje, ako tričko sadne na prsia a ramená. Ak ste medzi dvomi veľkosťami, vezmite <strong>väčšiu</strong>.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#a8536b;color:#fff;">
                  <th style="padding:9px 10px;text-align:left;">Veľkosť</th>
                  <th style="padding:9px 10px;text-align:left;">Obvod hrudníka</th>
                  <th style="padding:9px 10px;text-align:left;">Obvod pása</th>
                </tr>
              </thead>
              <tbody>
                  <tr style="background:#fff;border-bottom:1px solid #f0e6ea;">
                    <td style="padding:9px 10px;font-weight:700;">S<span style="display:block;font-size:11.5px;font-weight:600;color:#a08d95;">US 0–4</span></td>
                    <td style="padding:9px 10px;">78 – 83 cm</td>
                    <td style="padding:9px 10px;">65 – 71 cm</td>
                  </tr>
                  <tr style="background:#fbf7f8;border-bottom:1px solid #f0e6ea;">
                    <td style="padding:9px 10px;font-weight:700;">M<span style="display:block;font-size:11.5px;font-weight:600;color:#a08d95;">US 6–8</span></td>
                    <td style="padding:9px 10px;">83 – 89 cm</td>
                    <td style="padding:9px 10px;">71 – 77 cm</td>
                  </tr>
                  <tr style="background:#fff;border-bottom:1px solid #f0e6ea;">
                    <td style="padding:9px 10px;font-weight:700;">L<span style="display:block;font-size:11.5px;font-weight:600;color:#a08d95;">US 10–12</span></td>
                    <td style="padding:9px 10px;">89 – 95 cm</td>
                    <td style="padding:9px 10px;">77 – 83 cm</td>
                  </tr>
                  <tr style="background:#fbf7f8;border-bottom:1px solid #f0e6ea;">
                    <td style="padding:9px 10px;font-weight:700;">XL<span style="display:block;font-size:11.5px;font-weight:600;color:#a08d95;">US 14</span></td>
                    <td style="padding:9px 10px;">95 – 102 cm</td>
                    <td style="padding:9px 10px;">83 – 88 cm</td>
                  </tr>
                  <tr style="background:#fff;border-bottom:1px solid #f0e6ea;">
                    <td style="padding:9px 10px;font-weight:700;">2XL<span style="display:block;font-size:11.5px;font-weight:600;color:#a08d95;">US 16–18</span></td>
                    <td style="padding:9px 10px;">102 – 108 cm</td>
                    <td style="padding:9px 10px;">88 – 94 cm</td>
                  </tr>
                  <tr style="background:#fbf7f8;border-bottom:1px solid #f0e6ea;">
                    <td style="padding:9px 10px;font-weight:700;">3XL<span style="display:block;font-size:11.5px;font-weight:600;color:#a08d95;">US 20</span></td>
                    <td style="padding:9px 10px;">108 – 115 cm</td>
                    <td style="padding:9px 10px;">94 – 100 cm</td>
                  </tr>
              </tbody>
            </table>
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Ako merať:</strong> hrudník cez najširšie miesto, pás na najužšom mieste. Merajte cez spodnú bielizeň, páska priliehavá, ale nie stiahnutá.</p>
          </div>

        <?php elseif(  $is_mixed_bundle ): ?>

     <img class="js-open-size-chart" style="cursor:pointer;" src="<?php echo get_template_directory_uri(); ?>/img/tabela-velikosti-majice.jpg">

        <img class="js-open-size-chart" style="cursor:pointer;" src="https://noriks.com/sk/wp-content/uploads/2026/02/boxers_size_sk.png">

          <?php else: ?>


       <img class="js-open-size-chart" style="cursor:pointer;" src="<?php echo get_template_directory_uri(); ?>/img/tabela-velikosti-majice.jpg">


        <?php endif; ?>
      </div>
    </div>
    <?php endif; // /žiadna tabuľka veľkostí pre bunion + fisiorest ?>


    <!-- 3 - savjeti za pranje-->
    <?php if ( ( ! ( function_exists('noriks_is_type') && ( noriks_is_type('ortopas', $current_product_id) || noriks_is_type('bunion', $current_product_id) || noriks_is_type('fisiorest', $current_product_id) || noriks_is_type('norikshers', $current_product_id) || noriks_is_type('ortopedski-jastuk', $current_product_id) || noriks_is_type('kidsnest', $current_product_id) ) )  && ! ( function_exists('noriks_is_type') && noriks_is_type('kneefix', $current_product_id) || noriks_is_type('controlpro', $current_product_id) ) ) && ! ( function_exists('noriks_is_type') && noriks_is_type('tradesman', $current_product_id) ) ) : // žiadne tipy na pranie pre pás/bunion/fisiorest/norikshers/jastuk/kidsnest ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo get_field("singlepp_acc_h_2","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
             <?php if( function_exists('noriks_is_type') && noriks_is_type('slabproof', $current_product_id) ): ?>

                Pranie v práčke nastudeno, spolu s pracovným oblečením. Sušenie v sušičke pri nízkej teplote. Bez ručného prania, sušenia na šnúre a špeciálneho pracieho prostriedku.

             <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

                Perte na 30 – 40 °C, na programe pre jemnú bielizeň. Bez aviváže a bielidla. Sušte na vzduchu. Absorpčnú schopnosť si udržia počas stoviek praní.

             <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

                Perte v práčke v studenej vode na jemnom programe. Bez bielidla a aviváže. Nesušiť v sušičke — sušte na vzduchu, aby sa zachovala kompresia a tvar.

             <?php elseif( !$is_boxers &&  !$is_carape &&   !$is_mixed_bundle ): ?>
        <?php echo get_field("singlepp_acc_t_2","options"); ?>


        <?php elseif(  has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', $current_product_id )  ): ?>



                       Perte farby s farbami. Jemný cyklus v studenej vode. Sušte vodorovne alebo v sušičke pri nízkej teplote. Nebieliť.


          <?php else: ?>
            <?php echo get_field("__overwrite_sekcije_bellow_3"); ?>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; // /žiadne tipy na pranie pre pás/bunion/fisiorest ?>



    <!-- 4 povrati in menjave -->
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo function_exists('noriks_strip_free') ? noriks_strip_free( get_field("singlepp_acc_h_3","options") ) : get_field("singlepp_acc_h_3","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
       <p></p>
      Sme si takí istí, že si NORIKS zamilujete, že máte <b data-stringify-type="bold">30 dní</b> na jeho vrátenie alebo výmenu.
Žiadne papierovačky, žiadny stres – vyriešime to niekoľkými kliknutiami.</p>
<p>
    



  <a href="mailto:info@noriks.com" style="display: flex; align-items: center; text-decoration: none; color: #333;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#333" style="margin-right: 6px;" viewBox="0 0 16 16">
      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.083 0 4.217V4zm0 1.383v6.234l5.803-3.122L0 5.383zM6.761 8.83 0 12.383V12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.383l-6.761-3.553L8 9.917l-1.239-.653zM16 5.383l-5.803 3.112L16 11.617V5.383z"/>
    </svg>
    info@noriks.com
  </a>
</p>

<p>Stačí nám poslať e-mail s informáciou, že chcete náhradu a <b data-stringify-type="bold">my sa o to hneď postaráme.</b></p>
       
      </div>
    </div>



    <!-- 5 - infomraicje o dostavi -->
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3><?php echo get_field("singlepp_acc_h_4","options"); ?></h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <?php echo get_field("singlepp_acc_t_4","options"); ?>
      </div>
    </div>
    
    
        <!-- 6 - navodila za uporabo (PDF) -->
    <?php
    $noriks_manuals = array(
        'kidsnest' => array( 'noriks-kidsnest.pdf', 'NORIKS KidsNest — detský ortopedický vankúš' ),
        'kneefix' => array( 'noriks-kneefix.pdf', 'NORIKS KneeFix — ortopedická kolenná ortéza' ),
        'ortopedski-jastuk' => array( 'noriks-ergosit.pdf', 'NORIKS ErgoSit — ortopedický sedací vankúš' ),
        'fisiorest' => array( 'noriks-fisiorest.pdf', 'NORIKS NeckRelax — prístroj na krk' ),
        'bunion' => array( 'noriks-bunion-fix.pdf', 'NORIKS Bunion Fix — korektor vybočeného palca' ),
        'ortopas' => array( 'noriks-ortopas.pdf', 'NORIKS ortopedický pás na chrbát' ),
    );
    $noriks_manual = null;
    if ( function_exists('noriks_is_type') ) {
        foreach ( $noriks_manuals as $noriks_t => $noriks_m ) {
            if ( noriks_is_type( $noriks_t, $current_product_id ) ) { $noriks_manual = $noriks_m; break; }
        }
    }
    if ( $noriks_manual && file_exists( get_template_directory() . '/manuals/' . $noriks_manual[0] ) ) : ?>
    <div class="accordion-item noriks-manual-acc">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Návod na použitie</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <a class="noriks-manual-link" href="<?php echo esc_url( get_template_directory_uri() . '/manuals/' . $noriks_manual[0] ); ?>" target="_blank" rel="noopener">
          <span class="noriks-manual-ico" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-5z" fill="#e53935"/>
              <path d="M14 2v5h5" fill="#b71c1c"/>
              <text x="12" y="17" text-anchor="middle" font-family="Arial, sans-serif" font-size="6.5" font-weight="700" fill="#fff">PDF</text>
            </svg>
          </span>
          <span class="noriks-manual-txt">
            <strong><?php echo esc_html( $noriks_manual[1] ); ?></strong>
            <small>PDF · otvorí sa na novej karte</small>
          </span>
          <span class="noriks-manual-dl" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
          </span>
        </a>
        <style>
        .noriks-manual-acc { border-bottom: none !important; }
        .noriks-manual-acc .accordion-content { padding-bottom: 0 !important; }
        .noriks-manual-link { display:flex; align-items:center; gap:12px; padding:10px 12px; margin:0 0 2px;
          border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; background:#fafafa; color:#12233b;
          cursor:pointer; transition:background .15s ease, border-color .15s ease, transform .15s ease; }
        .noriks-manual-link:hover { background:#eef2f7; border-color:#c2cddd; transform:translateY(-1px); }
        .noriks-manual-link:active { transform:none; }
        .noriks-manual-ico { flex:0 0 auto; display:flex; }
        .noriks-manual-txt { display:flex; flex-direction:column; gap:1px; min-width:0; }
        .noriks-manual-txt strong { font-size:14px; line-height:1.25; font-weight:600; }
        .noriks-manual-txt small { color:#6b7280; font-size:12px; }
        .noriks-manual-dl { margin-left:auto; flex:0 0 auto; display:flex; color:#6b7280; transition:color .15s ease; }
        .noriks-manual-link:hover .noriks-manual-dl { color:#12233b; }
        </style>
      </div>
    </div>
    <?php endif; ?>

    <!-- konec 5 acrodinov -->

  </div>

  <script>
    function toggleAccordion(header) {
      const item = header.parentElement;
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.accordion-item').forEach(el => el.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    }
  </script>
  
  
  <style>
      
       .accordion {
      border-top: 1px solid #ddd;
    }

    .accordion-item {
      border-bottom: 1px solid #ddd;
    }

    .accordion-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 5px 5px 0px;
      cursor: pointer;
    }

    .accordion-header h3 {
      display: flex;
      align-items: center;
      font-weight: 500;
      font-size: 16px;
      margin: 0;
      gap: 2px;
      font-family: 'Roboto', sans-serif;  
    }

    .accordion-content {
      padding: 0 0 0 0;
      display: none;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;  
      line-height: 1.6;
      color: black;
    }

    .accordion-item.open .accordion-content {
      display: block;
    }

    .icon {
      width: 24px;
      height: 24px;
      display: inline-block;
      background-size: contain;
      background-repeat: no-repeat;

    }
    
    .icon-details {
   
      margin: 0 0px 0 10px !important;
    }
    
    .icon-size {
   
      margin: 0 0px 0 10px !important;
    }

    /* Placeholder icons using emojis 
    
    .icon.details::before { content: "📝"; }
     .icon.size::before { content: "👕"; }
    .icon.laundry::before { content: "🧺"; }
    .icon.returns::before { content: "↩️"; }
    .icon.shipping::before { content: "📦"; }
*/
    .toggle {
      font-size: 24px;
      transition: transform 0.3s ease;
    }

    .accordion-item.open .toggle {
      transform: rotate(45deg);
    }
  </style>








<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
