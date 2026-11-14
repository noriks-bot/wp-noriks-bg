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


 <section class=" features2" aria-label="Предимства">
      <div class="features__row">
        <!-- 1) Truck -->
        
        
          <div class="feature">
          
  <img src="<?php echo get_template_directory_uri(); ?>/img/cod_icon_.png" alt="Customer Support Icon" class="feature__icon info-icon">
          <p class="feature__text">Плащане при доставка</p>
        </div>
        
        
        <div class="feature">
      <img src="https://noriks.com/hr/wp-content/uploads/2025/07/footer_icon1-1.png" alt="Shirt Icon" class="feature__icon info-icon">
          <p class="feature__text">Опитайте 30 дни без риск</p>
        </div>
        
        

        <!-- 2) Smiley -->
        <div class="feature">
     
       
        <img src="https://noriks.com/hr/wp-content/uploads/2025/07/footer_icon3-1.png" alt="Shipping Icon" class="feature__icon info-icon">
          <p class="feature__text">Безплатна доставка над 70 €</p>
        </div>

    
    
      </div>
    </section>




<?php if ( noriks_is_type( 'ortopas' ) ) : ?>
<!-- Ortopas: kartica "preverjeno s strani zdravnika" (slika) -->
<div class="ortopas-doctor-card" style="margin:14px 0;">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/img/ortopas/ortopas-zdravnik.png' ); ?>"
       alt="Одобрен от лекар — ортопедичен колан NORIKS"
       style="width:100%; height:auto; display:block; border-radius:10px;"
       loading="lazy" decoding="async">
</div>
<?php endif; ?>

<!-- date and countdown section -->

<div class="shipping-box">
  <h2 id="shipping-window" class="shipping-title"></h2>
  <p class="shipping-sub">
    Поръчайте в следващите <span id="midnight-countdown" class="countdown"></span>
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
    const weekdays = ['неделя','понеделник','вторник','сряда','четвъртък','петък','събота'];


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
    windowEl.textContent = `Доставка от ${weekdays[first.getDay()]}  ${formatDayMonth(first)} до ${weekdays[second.getDay()]}, ${formatDayMonth(second)}`;

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

$is_boxers = has_term( array( 'boksarki','1-broy-boksarki','komplekt-3-boksarki','komplekt-5-boksarki','boxerky','1-ks-boxerky','orto-bokserice','balicek-3-ks-boxerky','balicek-5-ks-boxerky' ), 'product_cat', $current_product_id ) && ! has_term( array( 'black-friday' ), 'product_cat', $current_product_id );

$is_carape = has_term( array( 'chorapi', 'ponozky' ), 'product_cat', $current_product_id );

$is_mixed_bundle = has_term( array( 'komplekti','startovi-paketi','sady','orto-starter','orto-majica-bokserica','startovaci-balicek' ), 'product_cat', $current_product_id );

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
        <h3>Лицето на детето ви се оформя точно сега — а имате време до 9-ата година</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <p>Изследователи на дихателните пътища и детски стоматолози от години предупреждават за един и същ модел — а повечето родители никога не са чували за него. Нарича се <strong>синдром на удълженото лице</strong> (аденоидно лице).</p>
        <p>Всяка нощ, когато детето спи с отворена уста върху неподходяща възглавница, се случват четири неща наведнъж: езикът пада назад, долната челюст се прибира, небцето се стеснява във висока дъга и лицето започва да расте вертикално вместо хоризонтално. След хиляди такива нощи между 3-ата и 9-ата година промените се затвърждават.</p>
        <p>Затова днес 9-годишни деца идват при ортодонта с прибрана брадичка, кръгове под очите, разместени зъби — и скъпа сметка за шина. Начинът, по който детето диша между 3-ата и 9-ата година, силно влияе върху лицето, което ще носи цял живот.</p>
        <p>NORIKS <strong>KidsNest</strong> е създаден така, че да действа върху основната причина — неправилното положение на главата и челюстта през 9 часа сън — с <strong>3-зонова ергономична структура</strong>, която държи главата, шията и челюстта в правилна позиция от първата нощ.</p>
        <p><strong>Какво ще видите при детето си:</strong></p>
        <ul style="margin:6px 0 12px;padding-left:18px;">
          <li style="margin:0 0 7px;"><strong>По-малко дишане през устата:</strong> затворени устни през нощта, връщане на носовото дишане, край на сухата уста сутрин.</li>
          <li style="margin:0 0 7px;"><strong>По-тихи нощи:</strong> хъркането при повечето деца се успокоява в рамките на 1 – 2 седмици.</li>
          <li style="margin:0 0 7px;"><strong>Опора за развиващата се челюст:</strong> правилна позиция нощ след нощ, в годините, когато това има най-голямо значение.</li>
          <li style="margin:0 0 7px;"><strong>Умна превенция:</strong> една възглавница днес — вместо скъпи корекции утре.</li>
        </ul>
        <p><strong>Една възглавница тази вечер. Или хиляди по-късно.</strong></p>
      </div>
    </div>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Над 9 години? Прозорецът се затваря. Увреждането не спира.</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <p>Съветът, който сте чували, е верен само наполовина. Да, горното небце се укрепва около 9-ата година. Но лицето се развива до 20-ата година, долната челюст расте до 17-ата, а дихателните пътища непрекъснато се приспособяват.</p>
        <p>Затова всяка нощ дишане през устата след 9-ата година добавя ново увреждане към старото: стискане на зъби, главоболие, сън, който не освежава, спад в концентрацията — и умора, която всички бъркат с лентяйство. Вашият тийнейджър не е ленив. Всяка нощ шест часа едва диша.</p>
        <p>KidsNest в размер <strong>9 – 14 години</strong> е направен за по-голяма глава, шия и рамене. Друг контур, друга височина, друга опора. Същият основен механизъм: правилно подреждане на главата, шията и челюстта, цяла нощ, върху тяло, което още расте.</p>
        <p>Какво забелязват родителите: хъркането се успокоява за 7 до 14 нощи, връща се истинската утринна енергия, главоболията намаляват, концентрацията се връща.</p>
        <p>Най-добрият прозорец е все още от 3-ата до 9-ата година. Силният прозорец е от 8-ата до 18-ата. Никой не е напълно затворен — но всяка нощ изчакване добавя тежест на тяло, което се опитва да се възстанови.</p>
        <p><strong>Вчера отмина. Тази вечер все още е ваша.</strong></p>
      </div>
    </div>
    <?php endif; ?>


    <!-- ErgoSit ortopedska blazina: prvi dve accordion mesti (kopija originala, BG) -->
    <?php if ( function_exists('noriks_is_type') && noriks_is_type( 'ortopedski-jastuk', $current_product_id ) ) : ?>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Спецификации на продукта</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <ul style="margin:8px 0 12px; padding-left:18px;">
          <li style="margin:0 0 8px;"><strong>Външен калъф:</strong> Дишаща плетка, сваля се и се пере в пералня, хипоалергенен</li>
          <li style="margin:0 0 8px;"><strong>Ядро:</strong> Адаптивна пяна OrthoFlex™ | Нетоксична, сертифицирана OEKO-TEX® | Създадена за разтоварване на натиска + правилна стойка</li>
        </ul>
      </div>
    </div>
    <div class="accordion-item">
      <div class="accordion-header" onclick="toggleAccordion(this)">
        <h3>Какво го прави толкова специален?</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">
        <ul style="margin:8px 0 12px; padding-left:18px;">
          <li style="margin:0 0 10px;"><strong>Пяна с памет OrthoFlex™:</strong> Пяна с висока плътност, която разтоварва натиска и се нагажда, без да се сплесква — поддържа опашната кост, бедрата и гръбнака за комфорт през целия ден.</li>
          <li style="margin:0 0 10px;"><strong>Калъф BreatheEase™:</strong> Мек, дишащ и нежен към кожата. Сваля се и се пере в пералня, за да остава възглавницата винаги свежа.</li>
          <li style="margin:0 0 10px;"><strong>Балансирана опора:</strong> Нито твърде мека, нито твърде твърда. Създадена да изправи стойката и да облекчи болезнените точки от дълги часове седене.</li>
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

                <strong>NORIKS Snug</strong> е възглавница за цяло тяло във формата на буквата S. Повечето възглавници за тяло са прави — вашето тяло не е. Затова Snug следва линията на тялото и поддържа раменете, бедрата и коленете едновременно.<br><br>Когато спите на една страна без опора, рамото понася цялата тежест, бедрото се спуска, а гръбнакът се извива. Три опорни точки разпределят тежестта, така че никое място не понася целия товар.<br><br>Размерите са 105 cm дължина и 30 cm широчина — достатъчно, за да ви поддържа от рамото до коленете, без да заема цялото легло. Пълнежът е от хиляди фини еластични влакна, които се връщат във формата си и не се сплескват дори след месеци употреба.<br><br>Хладният калъф се сваля и се пере в пералня на 40 °C, а платът пропуска въздух цяла нощ. Предлага се в шест цвята: синьо, розово, сиво, зелено, лилаво и тъмносиньо.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kompwom', $current_product_id) ): ?>

                <strong>NORIKS FIT Woman</strong> е оформяща тениска, при която релефът е втъкан директно в плата, а не отпечатан върху него. Широк колан минава през корема и бедрата, а втори — през гърба.<br><br>Компресията е разпределена на ширина, а не стегната в една точка, така че нищо не се врязва. Коремът остава изгладен, талията — по-тясна, а гърбът получава опора, която помага да стоите по-изправени.<br><br>Плетката е безшевна, тънка и матова — изчезва под риза, сако или прилепнала рокля. През деня не се навива и не се очертава под облеклото.<br><br>Перете в пералня на 30 °C, без белина, гладене и сушилня. Предлага се в три цвята (черно, тъмносиво, розово) и в размери от S до 3XL. Ако сте между два размера, вземете по-големия.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slim', $current_product_id) ): ?>

                <strong>NORIKS Slim</strong> са оформящи бикини с висока талия. Широкият колан минава напречно през корема и продължава към бедрата и гърба, така че компресията е разпределена около цялата талия, а не стегната в една линия.<br><br>Коремът е изгладен, талията изглежда по-тясна и облеклото пада по-гладко — без гънки над панталона и без ръб, който се вижда под роклята.<br><br>Плетката е тънка, мека и дишаща, с еластични мрежести вставки и памучна подплата. Бикините не се навиват надолу и през деня не се свличат, така че ги обличате сутрин и до вечерта забравяте за тях.<br><br>Предлагат се в шест цвята (черно, телесно, тъмносиньо, лилаво, фуксия и сливово) и в размери от XS до 5XL. Изберете размер според обиколката на талията; ако сте между два размера, вземете по-големия.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('tradesman', $current_product_id) ): ?>

                NORIKS Tradesman са плътни работни чорапи от бамбук за всички, които цял ден стоят и ходят с работни обувки – на строежа, в склада, в сервиза или навън през зимата. Меката подложка омекотява всяка стъпка по бетон и замръзнала земя, подсилените пета и пръсти издържат на твърди обувки, а лентата под свода с двоен ластик държи чорапа на място през цялата смяна.<br><br><strong>Състав:</strong> 56 % бамбуков лиосел, 38 % найлон, 6 % еластан – естествено устойчиви на неприятна миризма, отвеждат влагата и са много меки върху кожата. <strong>Изпълнение:</strong> 360° опора на глезена, лента под свода, подложка, мрежеста вентилация, двоен ластик с халка, подсилена пета. Височина: класическа, около 18 cm от петата до ръба.<br><br><strong>Размери (размер обувки EU):</strong> 39–42, 43–45, 46–49. Цвят: черен. <strong>Поддръжка:</strong> перете на студено, сушете на въздух.<br><br>С NORIKS имате 30 дни за връщане на парите, безплатна доставка над 70 € и плащане при доставка.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slabproof', $current_product_id) ): ?>

                <strong>NORIKS SlabProof</strong> са работни чорапи, направени за хора, които цял ден работят на крак — на строежа, в склада, сервиза, магазина или кухнята. Работните обувки защитават стъпалото, но не го омекотяват — твърдият под не връща нищо, така че всяка стъпка отива в петите, коленете и гърба. Единственото, което може да омекоти този удар, е чорапът.<br><br>Затова имат <strong>зоново ватиране</strong>: плътни подложки под петата и под предната част на стъпалото, точно там, където стъпката удря най-силно, и тънка плетка навсякъде другаде, за да не стяга обувката. Петата и пръстите са подсилени с двойно плетен найлон — на двете места, където чорапите се скъсват първи.<br><br>Въздушна мрежа върху горната част на стъпалото и плетка, която отвежда потта, държат краката сухи през цялата смяна. Сместа е без вълна, така че нищо не драска и кракът не се прегрява.<br><br>Широкият ластичен ръб държи чорапа горе, без да стяга прасеца, дълбокият джоб за петата с езиче не позволява да се свлече в обувката, а лентата около свода държи стъпалото да не се плъзга.<br><br>Предлагат се в черен цвят, в размери 39–42, 43–45 и 46–49. Важи <strong>30 дни за връщане на парите</strong>, а доставката е безплатна при поръчки над 70 €.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('winecooler', $current_product_id) ): ?>

                <strong>NORIKS WineCooler</strong> е охлаждаща пръчка за вино от неръждаема стомана с вграден наливник. Поставете пръчката във фризера за поне 1 час и след това я пъхнете в бутилката — за 10–15 минути виното достига идеалната температура за сервиране и остава студено до 3 часа, от първата глътка до последната.<br><br>Изработена е от висококачествена неръждаема стомана, подходяща за контакт с храни. За разлика от кубчетата лед не разводнява виното, а за разлика от съд с лед бутилката на масата остава суха.<br><br>Наливникът осигурява равномерно наливане без капки, така че виното и покривката остават чисти. Вграденото аериране помага ароматите на виното да се разгърнат напълно за по-богат вкус.<br><br>Наливникът се сваля и пръчката може да се мие в съдомиялна или да се измие обилно с топла вода. Пасва на повечето стандартни бутилки вино — идеална за бяло вино, розе и пенливи вина, за вечери, седенки на балкона и като подарък за любителите на виното.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('bowl', $current_product_id) ): ?>

                <strong>NORIKS Bowl</strong> е повдигната купа за храна и вода, предназначена за малки кучета. Купата стои на стоманена поставка с височина 11 cm и е наклонена на 15°, така че кучето яде изправено, с глава в по-естествено положение, вместо да извива шията си до пода.<br><br>Купата е плитка (5 cm), така че мустаците не опират в ръба и храната не се избутва навън. Диаметърът е 15 cm, а обемът — около 430 ml, достатъчно за една порция или вода за малко куче.<br><br>Купата и поставката са от неръждаема стомана. Гладката повърхност не поема миризми и не задържа остатъци от храна като пластмасата; достатъчно е да се изплакне с топла вода и препарат за съдове.<br><br>Подходяща е за малки породи като дакел, френски булдог, шнауцер, мопс и малтийско болонче.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('pal', $current_product_id) ): ?>

                <strong>NORIKS Pal</strong> е бастун, създаден около един проблем: изправянето. Освен горната ръкохватка има и втора, по-долу, за която се хващате, когато се изправяте от фотьойл, от леглото или от нисък стол — без да се навеждате и без чужда помощ.<br><br>Четири гумени крачета държат бастуна изправен, когато го пуснете. Не пада на пода, така че не се налага да се навеждате за него. Основата е противоплъзгаща и остава стабилна на плочки, паркет и на неравен терен.<br><br>В ръкохватката е вградено осветление, което осветява пътя пред вас — за път до банята през нощта или за разходка по тъмно. До него има и звукова аларма, която предупреждава близките, ако паднете или ви е нужна помощ.<br><br>Бастунът се сгъва и влиза в чанта или в жабката на колата, а височината се настройва за няколко секунди, без инструменти, за всяка фигура.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kneeheat', $current_product_id) ): ?>

                <strong>NORIKS KneeHeat</strong> е наколенка, която в една сесия съчетава три терапии: топлина до 42 °C, въздушна компресия и вибрационен масаж 60 Hz. Топлината разширява съдовете и улеснява притока на кръв към по-дълбоките тъкани, ритмичната компресия изтласква събралата се течност, а вибрациите отпускат сковаността около ставата.<br><br>Сесията продължава 12 минути и се пуска с един бутон — без приложение, без настройки и без кабел. Налични са 3 степени топлина и 3 режима вибрация, така че нагласяте интензивността според деня и оплакванията.<br><br>Наколенката е с ергономична форма и се държи с регулируеми ленти; пасва на лявото и на дясното коляно, а в комплекта има и удължаваща лента за по-големи обиколки. Платът до кожата е мек и дишащ.<br><br>Устройството се зарежда с включения USB-C кабел и едно зареждане стига за няколко сесии. Към уреда получавате 2 години гаранция за замяна.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('red', $current_product_id) ): ?>

                <strong>NORIKS RedRelief</strong> е лента за китка, която съчетава двете най-изследвани дължини на вълната в терапията с червена светлина: червена светлина 660 nm успокоява повърхностното възпаление, а инфрачервената 850 nm прониква по-дълбоко, до тъканта около средния нерв.<br><br>Светлината се превръща в тъканта в клетъчна енергия (ATP) и подтиква местното кръвообращение — два процеса, които са част от естественото възстановяване на тялото. Затова се използва при синдром на карпалния тунел, възпаление на сухожилията, артрит и болки в ръката и китката.<br><br>В лентата са вградени 48 двойни LED диода, разположени по цялата вътрешна страна, така че светлината покрива цялата китка, а не само една точка. Налични са 4 режима и 3 степени на мощност.<br><br>Устройството е безжично и се зарежда с USB-C кабел — едно зареждане стига за до 4 процедури. Тежи само 126 g, има отвор за палеца и регулируема каишка, така че пасва и на лявата, и на дясната ръка. Препоръчва се една 15-минутна процедура дневно; устройството се изключва само в края.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kidsnest', $current_product_id ) ): ?>

                NORIKS KidsNest е изработен от хипоалергенна пяна с памет със сертификат OEKO-TEX® — без формалдехид, тежки метали и BPA — с дишащ плетен калъф.<br><br>Неговата 3-зонова ергономична структура нежно поема главата, поддържа шията и помага да задържи гръбнака в естествено положение — дори когато детето се върти много през нощта. Така подкрепя дишането през носа и по-спокойния, по-дълбок сън.<br><br>Предлага се в три размера (1 – 3, 3 – 9 и 9 – 14 години), расте с вашето дете и осигурява правилната височина на опора на всеки етап от развитието.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('controlpro', $current_product_id) ): ?>

                NORIKS ControlPro е механичен тренажор за мускулите на тазовото дъно с истинско физическо съпротивление. Вместо да свивате напразно, получавате нещо, срещу което да натискате — същият принцип на постепенно натоварване, с който се укрепва всеки друг мускул в тялото.<br><br>Използва се седнали: поставяте уреда между коленете и натискате срещу съпротивлението — 3 серии по 10 повторения дневно, около пет минути. Без сонди и въвеждане, без кабели, гел, батерии и приложения. Вграденият брояч на повторения показва колко сте направили.<br><br>Конструкцията е здрава, с меки подложки на опорите, които не притискат дори след няколко серии. Съпротивлението се увеличава постепенно, докато мускулите се укрепват.<br><br>Предназначен е за мъже, които искат да си върнат контрола над мехура — след операция на простатата, при изпускане при натоварване или след дълги месеци упражнения на Кегел без резултат. Доставката е дискретна, в неутрална кутия без надписи.


         <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kneefix', $current_product_id) || noriks_is_type('controlpro', $current_product_id) ): ?>

                NORIKS KneeFix е гъвкава ортеза за коляно, която съчетава четири функции в една система за поддръжка: регулируема компресия с прецизно колелце, двойни странични стабилизатори, гелна вложка, която разтоварва капачката, и силиконов противоплъзгащ ръб, който държи ортезата на място.<br><br>За разлика от твърдите ортези KneeFix не обездвижва коляното — поддържа го по време на естественото движение. Компресията се настройва за секунда: сутрин по-стегнато, следобед по-свободно, според това колко сте на крак. Така коляното получава стабилност при изправяне, по стълби, при ходене и при по-дълго стоене.<br><br>Платът е лек, дишащ и отвежда влагата, така че можете да носите ортезата часове без потене и без да се врязва. Тънка и дискретна е — под панталон почти не се вижда.<br><br>Налична е в размери от S до 2XL според телесното тегло и във версия за лявото и за дясното коляно, така че пасва точно.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

                Боксерките при инконтиненция NORIKS са изработени от мек антибактериален бамбуков влакнест материал с водоотблъскващ външен слой. В средата е 7-слойното ядро PureDry™, което веднага поема и заключва до 300 ml течност, така че кожата остава суха, а изпускането остава вътре.<br><br>Кройката е тънка и дискретна — изглежда и се усеща като обикновено бельо, без обем и без усещане за „пелена“. Защитата при крачолите предотвратява странично преливане, а контролът на миризмата поддържа свежест през целия ден.<br><br>Перат се и се използват многократно — запазват поемащата си способност през стотици пранета, като екологична и изгодна алтернатива на еднократните подложки и пелени.

         <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

                NORIKS FIT е изработена от усъвършенстван йонен компресионен плат, който осигурява прилепнала, поддържаща кройка. Целенасочената компресия равномерно прибира корема и кръста, изглажда силуета и подкрепя изправената стойка — без стягане, което ограничава дишането или движението.<br><br>Микротканите влакна подпомагат кръвообращението и ви помагат през деня да стоите по-изправени и да се чувствате по-уверени. Платът е лек, дишащ и отвежда влагата, така че оставате сухи и в комфорт.<br><br>Тънката и дискретна кройка я прави невидима под всяка риза, а в същото време може да служи и като спортна тениска. Резултатът: по-изчистен външен вид, по-добра стойка и самочувствие — още щом я облечете.

         <?php elseif( !$is_boxers &&  !$is_carape &&   !$is_mixed_bundle && ! ( function_exists('noriks_is_type') && ( noriks_is_type('fisiorest', $current_product_id) || noriks_is_type('bunion', $current_product_id) || noriks_is_type('ortopas', $current_product_id) ) ) ): ?>



        <?php echo get_field("singlepp_acc_t_1","options"); ?>


        <?php elseif(  has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', $current_product_id )  ): ?>



               Нашите премиум тениски са изработени от премиум смес от 60 % пръстеновидно предена памук и 40 % полиестер, което гарантира изключително мек и неизмачкващ се плат. <br>Боксерките NORIKS са изработени от премиум смес от 95 % модал и 5 % еластан, което гарантира изключително мек и еластичен плат, който се приспособява идеално към тялото. Еластичният колан е създаден за оптимално прилягане, комфорт без стягане и перфектен вид под облеклото. <br>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('fisiorest', $current_product_id) ): ?>

                NORIKS NeckRelax е терапевтична възглавница за шия, която съчетава тракция, топлина и вибрационен масаж в ергономична конструкция от пяна с памет. Нежно разтяга шията под правилния ъгъл, разтоварва шийния отдел на гръбнака и с топлина и масаж отпуска мускулното напрежение. Безжична, презареждаща се и обвита в мек, хладен сатен – безопасна и за сън.

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('bunion', $current_product_id) ): ?>

                Коректорът за изкривен палец NORIKS с усъвършенствана терапия за изправяне и патентован шарнирен механизъм нежно връща палеца в естественото му положение, облекчава дискомфорта и предотвратява по-нататъшния растеж на израстъка. Гъвкавата конструкция позволява да ходите с него. Пасва на всички размери стъпала, без лява или дясна страна. За употреба в покой – докато си почивате, гледате телевизия, четете или спите.

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) ): ?>

                Ортопедичният колан NORIKS целенасочено стабилизира кръстната част на гърба с прицелена компресия, изправя правилно таза и разтоварва седалищния нерв. Тънък и незабележим под облеклото, с регулируема степен на опора. Подходящ при болки в кръста, ишиас, мускулно напрежение и проблеми със сакроилиачната става.

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
        <h3>Таблици с размери</h3>
        <div class="toggle">+</div>
      </div>
      <div class="accordion-content">

           <?php if( function_exists('noriks_is_type') && noriks_is_type('kidsnest', $current_product_id) ): ?>

          <div class="kn-size">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kidsnest/tablica-velicine-sk.webp" alt="KidsNest размери според възрастта" style="width:100%;height:auto;border-radius:10px;display:block;margin:0 0 12px;" loading="lazy">
            <p style="margin:0;line-height:1.6;"><strong>Детето е между два размера?</strong> Винаги избирайте по-големия. Възглавницата е създадена да подкрепя здравото подреждане, докато детето расте — по-големият размер дава повече място и по-дълъг период на употреба.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('leakboxers', $current_product_id) ): ?>

          <div class="lbx-size">
            <p style="margin:0 0 6px;font-weight:700;">Как да измерите бедрата</p>
            <p style="margin:0 0 14px;line-height:1.6;">Обвийте шивашкия метър около най-широката част на бедрата (през седалището), без да стягате. Застанете отпуснато и изправено и запишете мярката в сантиметри.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#12233b;color:#fff;">
                  <th style="padding:8px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Размер</th>
                  <th style="padding:8px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Бедра (cm)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $lbx_sizes = array(
                  array('S','до 76 cm','до 30"'),
                  array('M','77 – 85 cm','30 – 33"'),
                  array('L','86 – 94 cm','34 – 37"'),
                  array('XL','95 – 102 cm','37 – 40"'),
                  array('2XL','103 – 114 cm','41 – 45"'),
                  array('3XL','115 – 121 cm','45 – 48"'),
                  array('4XL','122 – 129 cm','48 – 51"'),
                  array('5XL','130 – 137 cm','51 – 54"'),
                  array('6XL','138 – 145 cm','54 – 57"'),
                  array('7XL','146 – 153 cm','57 – 60"'),
                  array('8XL','154 cm и повече','61" и повече'),
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
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Между два размера?</strong> Винаги препоръчваме по-голямото число за оптимален комфорт и максимална поемаемост.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kompresijske-majice', $current_product_id) ): ?>

          <div class="kmf-size">
            <table style="width:100%;border-collapse:collapse;font-size:15px;">
              <thead>
                <tr style="background:#111;color:#fff;">
                  <th style="padding:9px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Размер</th>
                  <th style="padding:9px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Съответстващо тегло</th>
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
            <p style="margin:12px 0 0;line-height:1.6;">Изберете размер според теглото си. Между два размера? За по-силна компресия изберете по-малкото число.</p>
          </div>

        <?php elseif( function_exists('noriks_is_type') && noriks_is_type('ortopas', $current_product_id) ): ?>

          <div style="line-height:1.9;">
            <strong>S/M</strong> : обиколка на бедрата 75 – 110 cm<br>
            <strong>L/XL</strong> : обиколка на бедрата 110 – 140 cm<br><br>
            Моля, измерете обиколката на бедрата си, за да намерите своя размер.
          </div>

        <?php elseif( $is_boxers ): ?>



          <?php include get_template_directory() . '/template_parts/size-chart-boksarki.php'; ?>



        <?php elseif( noriks_is_type( 'kompresijske-nogavice', $current_product_id ) ): ?>

          <div style="line-height:1.9;">
            <strong>S/M</strong> : размер обувки 36–40 / обиколка на прасеца : 23–36 cm<br>
            <strong>L/XL</strong> : размер обувки 40–44 / обиколка на прасеца : 36–45 cm<br>
            <strong>2XL</strong> : размер обувки 44–48 / обиколка на прасеца : 45–56 cm<br><br>
            Моля, измерете обиколката на прасеца на най-широкото място, за да определите своя размер.<br><br>
            Препоръчваме да изберете размер според обиколката на прасеца, а не според обичайния размер обувки.
          </div>

        <?php elseif(  $is_carape ): ?>


                  <?php include get_template_directory() . '/template_parts/size-chart-chorapi.php'; ?>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slim', $current_product_id) ): ?>

          <div class="slm-size">
            <p style="margin:0 0 14px;line-height:1.6;">Изберете размер според <strong>обиколката на талията</strong>, а не според обичайния размер облекло. Ако сте между два размера, вземете <strong>по-големия</strong>.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#a3336b;color:#fff;">
                  <th style="padding:9px 10px;text-align:left;">Размер</th>
                  <th style="padding:9px 10px;text-align:left;">EU размер</th>
                  <th style="padding:9px 10px;text-align:left;">Обиколка на талията</th>
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
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Как да се измерите:</strong> обвийте шивашкия метър около най-тясното място на тялото, малко над пъпа. Метърът трябва да е хоризонтален и прилепнал, но не стегнат.</p>
          </div>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('tradesman', $current_product_id) ): ?>

          <div class="noriks-size">
            <p style="margin:0 0 14px;line-height:1.6;">Изберете размер според своя <strong>размер обувки (EU)</strong>.</p>
            <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#a9683f;color:#fff;">
                  <th style="padding:9px 8px;text-align:left;">Размер обувки (EU)</th>
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
            <p style="margin:12px 0 0;line-height:1.6;">Между два размера сте? Вземете по-големия.</p>
            <p style="margin:14px 0 0;line-height:1.6;">Ако размерът не ви стане, имате 30 дни за връщане или замяна.</p>
          </div>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('slabproof', $current_product_id) ): ?>

          <div class="noriks-size">
            <p style="margin:0 0 14px;line-height:1.6;">Поръчайте <strong>обичайното си число обувки</strong>. Плетката е еластична, така че всеки размер покрива няколко номера.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#d2632e;color:#fff;">
                  <th style="padding:9px 10px;text-align:left;">EU номер обувки</th>
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
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Между два размера?</strong> Вземете по-големия — подложката на петата и лентата около свода застават на място само когато чорапът не е твърде малък.</p>
          </div>

    <?php elseif( function_exists('noriks_is_type') && noriks_is_type('kompwom', $current_product_id) ): ?>

          <div class="kwm-size">
            <p style="margin:0 0 14px;line-height:1.6;">Изберете размер според <strong>обиколката на гърдите</strong> — тя определя как тениската ще седне на гърдите и раменете. Ако сте между два размера, вземете <strong>по-големия</strong>.</p>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
              <thead>
                <tr style="background:#a8536b;color:#fff;">
                  <th style="padding:9px 10px;text-align:left;">Размер</th>
                  <th style="padding:9px 10px;text-align:left;">Обиколка на гърдите</th>
                  <th style="padding:9px 10px;text-align:left;">Обиколка на талията</th>
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
            <p style="margin:14px 0 0;line-height:1.6;"><strong>Как да мерите:</strong> гърдите през най-широкото място, талията на най-тясното. Мерете през бельото, лентата да е прилепнала, но не стегната.</p>
          </div>

        <?php elseif(  $is_mixed_bundle ): ?>

     <?php include get_template_directory() . '/template_parts/size-chart-majice.php'; ?>

        <?php include get_template_directory() . '/template_parts/size-chart-boksarki.php'; ?>

          <?php else: ?>


       <?php include get_template_directory() . '/template_parts/size-chart-majice.php'; ?>


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

                Пране в пералня на студено, заедно с работното облекло. Сушене в сушилня на ниска температура. Без ръчно пране, сушене на простор и специален перилен препарат.

             <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers', $current_product_id ) ): ?>

                Перете на 30 – 40 °C, на програма за фино пране. Без омекотител и белина. Сушете на въздух. Запазват поемащата си способност през стотици пранета.

             <?php elseif( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice', $current_product_id ) ): ?>

                Перете в пералня в студена вода на деликатна програма. Без белина и омекотител. Не сушете в сушилня — сушете на въздух, за да се запазят компресията и формата.

             <?php elseif( !$is_boxers &&  !$is_carape &&   !$is_mixed_bundle ): ?>
        <?php echo get_field("singlepp_acc_t_2","options"); ?>


        <?php elseif(  has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', $current_product_id )  ): ?>



                       Перете цветно с цветно. Деликатна програма в студена вода. Сушете хоризонтално или в сушилня на ниска температура. Не използвайте белина.


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
      Толкова сме сигурни, че ще се влюбите в NORIKS, че имате <b data-stringify-type="bold">30 дни</b> да го върнете или замените.
Без документи, без стрес – решаваме го с няколко клика.</p>
<p>
    



  <a href="mailto:info@noriks.com" style="display: flex; align-items: center; text-decoration: none; color: #333;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#333" style="margin-right: 6px;" viewBox="0 0 16 16">
      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.083 0 4.217V4zm0 1.383v6.234l5.803-3.122L0 5.383zM6.761 8.83 0 12.383V12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.383l-6.761-3.553L8 9.917l-1.239-.653zM16 5.383l-5.803 3.112L16 11.617V5.383z"/>
    </svg>
    info@noriks.com
  </a>
</p>

<p>Достатъчно е да ни изпратите имейл, че искате замяна, и <b data-stringify-type="bold">ние веднага ще се погрижим.</b></p>
       
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
        'kidsnest' => array( 'noriks-kidsnest.pdf', 'NORIKS KidsNest — детска ортопедична възглавница' ),
        'kneefix' => array( 'noriks-kneefix.pdf', 'NORIKS KneeFix — ортопедична ортеза за коляно' ),
        'ortopedski-jastuk' => array( 'noriks-ergosit.pdf', 'NORIKS ErgoSit — ортопедична възглавница за сядане' ),
        'fisiorest' => array( 'noriks-fisiorest.pdf', 'NORIKS NeckRelax — уред за шия' ),
        'bunion' => array( 'noriks-bunion-fix.pdf', 'NORIKS Bunion Fix — коректор за изкривен палец' ),
        'ortopas' => array( 'noriks-ortopas.pdf', 'NORIKS ортопедичен колан за гърба' ),
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
        <h3>Инструкции за употреба</h3>
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
            <small>PDF · отваря се в нов таб</small>
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
