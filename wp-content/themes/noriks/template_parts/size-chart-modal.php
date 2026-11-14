<!-- Size Chart Modal Styles -->
<style>
/* --- Base UI bits you already had --- */
#size-suggestion-result { border: 1px solid #ccc; }
.body-type-options { display: flex; justify-content: space-between; gap: 5px; }
.body-type-option {
  display: flex; flex-direction: column; align-items: center; cursor: pointer;
  padding: 5px; border: 1px solid #ccc; border-radius: 2px; width: auto; text-align: center;
  transition: all 0.2s ease;
}
.body-type-option input { display: none; }
.body-type-option img { width: 100px; height: 100px; margin-bottom: 5px; }
.body-type-option:hover { background-color: #e0e0e0; }
.body-type-option.selected { border: 2px solid #f39c13; background-color: #fff3d6; }
.slike-mobile-only { display: flex; }

/* --- Modal backdrop (dark overlay behind modal) --- */
#custom-size-chart-backdrop {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.78);
  z-index: 9999998;
}
#custom-size-chart-backdrop.show { display: block; }

/* --- Modal base --- */
#custom-size-chart-modal {
  display: none;              /* hidden by default; shown via .show */
  position: fixed;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  width: 95%;
  max-width: 1100px;
  max-height: min(720px, 78vh);
  background: #fff;
  border-radius: 3px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.35);
  z-index: 9999999;
  overflow: hidden;
  flex-direction: column;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}
#custom-size-chart-modal.show { display: flex; }

/* Title bar */
.size-chart-titlebar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 22px;
  border-bottom: 1px solid #eee;
  flex: 0 0 auto;
}
.size-chart-titlebar h2 {
  margin: 0;
  font-size: 19px;
  font-weight: 700;
  color: #111;
}

/* Inner scroll container so modal stays bounded by max-height */
.size-chart-body {
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
  flex: 1 1 auto;
}

/* MOBILE: VERY visible Y scrollbar on modal body — forced always-on, fat + orange */
@media (max-width: 768px) {
  .size-chart-body {
    overflow-y: scroll !important;
    scrollbar-width: auto;
    scrollbar-color: #f39c13 rgba(0,0,0,0.10);
    scrollbar-gutter: stable;
  }
  .size-chart-body::-webkit-scrollbar {
    width: 12px !important;
    -webkit-appearance: none;
    background: rgba(0,0,0,0.10);
  }
  .size-chart-body::-webkit-scrollbar-track {
    background: rgba(0,0,0,0.10);
    border-radius: 6px;
    border: 1px solid rgba(0,0,0,0.15);
  }
  .size-chart-body::-webkit-scrollbar-thumb {
    background: #f39c13;
    border-radius: 6px;
    border: 2px solid rgba(0,0,0,0.10);
    min-height: 40px;
  }
  .size-chart-body::-webkit-scrollbar-thumb:active,
  .size-chart-body::-webkit-scrollbar-thumb:hover {
    background: #d97f00;
  }
}

/* Single-column content wrapper (only image) */
.size-chart-left {
  display: flex;              /* center the image inside */
  align-items: center;        /* vertical center */
  justify-content: center;    /* horizontal center */
  background: white;
  padding: 0;
}

/* Image fills modal width, keeps aspect ratio */
.size-chart-left img {
  display: block;
  width: 100%;
  height: auto;
  object-fit: contain;
  margin: 0;                  /* ensure no offsets */
}

/* --- Mobile tweaks --- */
@media (max-width: 768px) {
  .info-box-desktop { display: none !important; }
  .second-one, .third-one { display: inline-block; width: 49%; }
  #size-suggestion-result { padding-top: 3px; padding-bottom: 3px; }
  .form-title { margin-top: 4px; text-align: left; padding-left: 10px; font-size: 15px; }
  .size-chart-field { margin-top: 10px; text-align: left; }
  .size-chart-field label { text-align: left; }

  #custom-size-chart-modal {
    width: 92%;
    max-width: 92%;
    max-height: 80vh;          /* breathing room top+bottom */
    border-radius: 6px;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
  }
  .size-chart-titlebar { padding: 12px 14px; }
  .size-chart-titlebar h2 { font-size: 15px; }
  .size-chart-body { padding-top: 0; padding-bottom: 10px; }

  /* Image-based charts (boxers/socks/etc) — keep horizontal scroll */
  .size-chart-left {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    justify-content: flex-start;
    scrollbar-width: thin;
    padding-bottom: 6px;
  }
  .size-chart-left img {
    width: auto !important;
    max-width: none !important;
    min-width: 720px;
    height: auto !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    object-fit: initial;
  }
  .size-chart-left::-webkit-scrollbar { height: 6px; }
  .size-chart-left::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.25); border-radius: 3px; }
}

/* Desktop cleanups */
@media (min-width: 769px) {
  .slike-mobile-only { display: none !important; }
  .info-box-mobile  { display: none !important; }
  .size-chart-body { padding: 10px; }
}
</style>


<?php if ( has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', get_the_ID() ) ): ?>  

<style>

@media (min-width: 769px) {
  .size-chart-left  img { 
      max-width: 50% !important; 
      margin: 0 auto !important;
      
  }

}
</style>


<?php endif; ?>

<!-- Modal HTML -->
<div id="custom-size-chart-backdrop"></div>
<div id="custom-size-chart-modal" aria-modal="true" role="dialog" aria-labelledby="custom-size-chart-title">
  <div class="size-chart-titlebar">
    <h2 id="custom-size-chart-title">Таблица с размери</h2>
    <span id="close-size-chart-x" style="font-size: 26px; font-weight: bold; cursor: pointer;
      background: #000; border-radius: 2px; width: 34px; height: 34px;
      display: inline-flex; align-items: center; justify-content: center;
      color: white; line-height: 1;">&times;</span>
  </div>

  <div class="size-chart-body">
  <div  style="<?php if ( has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', get_the_ID() ) ): ?>  display: block; <?php endif; ?>"
        class="size-chart-left">
      
      <?php if ( has_term( array( 'boksarki', 'boxerky', 'orto-bokserice' , 'bokserice-sastavi-paket' ), 'product_cat', get_the_ID() )   && 
       !has_term( 'black-friday', 'product_cat', get_the_ID() )   ): ?>
      
    
      <?php include get_template_directory() . '/template_parts/size-chart-boksarki.php'; ?>
        <img class="noriks-bx-fig" src="<?php echo esc_url( get_template_directory_uri() . '/img/boxers-measure.webp' ); ?>"
             alt="Rozmery boxeriek: a, b, c, d" loading="lazy">
        <p class="noriks-bx-note"><strong>Изберете същото число, което обикновено носите.</strong><br>Размерите са в сантиметри. Размерите може да се различават с &plusmn;1&ndash;2 cm. Ако сте между два размера, изберете по-малкия &mdash; материалът е еластичен.</p>
      </div>

      
      
       
      <?php elseif ( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-nogavice' ) ): ?>

      <div style="line-height:1.9; text-align:left; margin:40px 0; padding:0 6px; font-size:15px; color:#111;">
        <strong>S/M</strong> : размер обувки 36–40 / обиколка на прасеца : 23–36 cm<br>
        <strong>L/XL</strong> : размер обувки 40–44 / обиколка на прасеца : 36–45 cm<br>
        <strong>2XL</strong> : размер обувки 44–48 / обиколка на прасеца : 45–56 cm<br><br>
        Моля, измерете обиколката на прасеца на най-широкото място, за да определите своя размер.<br><br>
        Препоръчваме да изберете размер според обиколката на прасеца, а не според обичайния размер обувки.
      </div>

      <?php elseif ( has_term( array( 'chorapi', 'zimni-chorapi', 'ponozky', 'zimske-carape	' ), 'product_cat', get_the_ID() ) ): ?>
      <?php include get_template_directory() . '/template_parts/size-chart-chorapi.php'; ?>
      
      
      <?php elseif ( has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', get_the_ID() ) ): ?>
      <?php include get_template_directory() . '/template_parts/size-chart-majice.php'; ?>
      
      
       
      <?php include get_template_directory() . '/template_parts/size-chart-boksarki.php'; ?>




      <?php elseif ( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers' ) ): ?>

      <div style="margin:30px 0;padding:0 6px;">
        <p style="margin:0 0 4px;font-weight:700;font-size:15px;">Как да измерите бедрата</p>
        <p style="margin:0 0 14px;line-height:1.6;font-size:14px;color:#333;">Обвийте шивашкия метър около най-широката част на бедрата (през седалището), без да стягате, и запишете мярката в сантиметри.</p>
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
          <thead><tr style="background:#12233b;color:#fff;">
            <th style="padding:9px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Размер</th><th style="padding:9px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Бедра (cm)</th>
          </tr></thead>
          <tbody>
          <?php foreach ( array(array('S','do 76 cm','do 30"'),array('M','77 – 85 cm','30 – 33"'),array('L','86 – 94 cm','34 – 37"'),array('XL','95 – 102 cm','37 – 40"'),array('2XL','103 – 114 cm','41 – 45"'),array('3XL','115 – 121 cm','45 – 48"'),array('4XL','122 – 129 cm','48 – 51"'),array('5XL','130 – 137 cm','51 – 54"'),array('6XL','138 – 145 cm','54 – 57"'),array('7XL','146 – 153 cm','57 – 60"'),array('8XL','154 cm и повече','61" и повече') ) as $i=>$r): ?>
            <tr style="background:<?php echo ($i%2)?'#f5f7f9':'#fff'; ?>;border-bottom:1px solid #eee;">
              <td style="padding:8px 10px;font-weight:700;"><?php echo esc_html($r[0]); ?></td><td style="padding:8px 10px;"><?php echo esc_html($r[1]); ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <p style="margin-top:12px;font-size:14px;color:#444;"><strong>Между два размера?</strong> Препоръчваме по-голямото число за оптимален комфорт и максимална поемаемост.</p>
      </div>

      <?php elseif ( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice' ) ): ?>

      <div style="margin:30px 0;padding:0 6px;">
        <table style="width:100%;border-collapse:collapse;font-size:16px;">
          <thead><tr style="background:#111;color:#fff;">
            <th style="padding:11px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Размер</th><th style="padding:11px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Съответстващо тегло</th>
          </tr></thead>
          <tbody>
          <?php foreach ( array(array('S','50 – 70 kg'),array('M','70 – 90 kg'),array('L','90 – 110 kg'),array('XL','110 – 130 kg'),array('2XL','130 – 150 kg'),array('3XL','150 – 170 kg'),array('4XL','170 – 190 kg'),array('5XL','190 – 210 kg') ) as $i=>$r): ?>
            <tr style="background:<?php echo ($i%2)?'#f2f2f2':'#fff'; ?>;border-bottom:1px solid #e6e6e6;">
              <td style="padding:11px 12px;font-weight:800;"><?php echo esc_html($r[0]); ?></td><td style="padding:11px 12px;font-weight:700;"><?php echo esc_html($r[1]); ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <p style="margin-top:12px;font-size:14px;color:#444;">Изберете размер според теглото си. Между два размера? За по-силна компресия изберете по-малкото число.</p>
      </div>

      <?php else: ?>

      <?php include get_template_directory() . '/template_parts/size-chart-majice.php'; ?>

      <?php endif; ?>



  </div>
  </div><!-- /.size-chart-body -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("custom-size-chart-modal");
  const backdrop = document.getElementById("custom-size-chart-backdrop");
  const openBtn = document.getElementById("open-size-chart");
  const closeX = document.getElementById("close-size-chart-x");

  function openModal(e) {
    if (e) e.preventDefault();
    modal.classList.add("show");
    if (backdrop) backdrop.classList.add("show");
    document.body.style.overflow = "hidden";
  }
  function closeModal() {
    modal.classList.remove("show");
    if (backdrop) backdrop.classList.remove("show");
    document.body.style.overflow = "";
  }

  openBtn?.addEventListener("click", openModal);

  /* Klik na sliku/tablicu velicina u akordeonu otvara isti modal. */
  document.addEventListener("click", function (e) {
    if (e.target.closest(".js-open-size-chart")) { openModal(e); }
  });
  closeX?.addEventListener("click", closeModal);
  backdrop?.addEventListener("click", closeModal);

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeModal();
  });
});
</script>
