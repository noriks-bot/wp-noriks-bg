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
    <h2 id="custom-size-chart-title">Tabuľka veľkostí</h2>
    <span id="close-size-chart-x" style="font-size: 26px; font-weight: bold; cursor: pointer;
      background: #000; border-radius: 2px; width: 34px; height: 34px;
      display: inline-flex; align-items: center; justify-content: center;
      color: white; line-height: 1;">&times;</span>
  </div>

  <div class="size-chart-body">
  <div  style="<?php if ( has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', get_the_ID() ) ): ?>  display: block; <?php endif; ?>"
        class="size-chart-left">
      
      <?php if ( has_term( array( 'boxerky', 'orto-bokserice' , 'bokserice-sastavi-paket' ), 'product_cat', get_the_ID() )   && 
       !has_term( 'black-friday', 'product_cat', get_the_ID() )   ): ?>
      
    
      <!-- BOXERS: HTML size table (replaces the image) -->
      <div class="noriks-bx">
        <style>
          .noriks-bx { width: 100%; box-sizing: border-box; color: #111;
                       font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
          .noriks-bx-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
          table.noriks-bx-t { width: 100%; min-width: 460px; border-collapse: collapse; font-size: 14px; }
          table.noriks-bx-t th, table.noriks-bx-t td { border: 1px solid #e3e3e3; padding: 9px 6px; text-align: center; }
          table.noriks-bx-t thead th { background: #111; color: #fff; font-weight: 800; border-color: #111; }
          table.noriks-bx-t tbody th { background: #f6f6f6; font-weight: 800; width: 54px; }
          table.noriks-bx-t tbody tr:nth-child(even) td { background: #fafafa; }
          .noriks-bx-note { margin: 14px 0 0; font-size: 13.5px; line-height: 1.6; color: #444; }
          .noriks-bx-note strong { color: #111; }
          .noriks-bx-fig { display: block !important; width: 100% !important; max-width: 340px !important;
                           height: auto !important; margin: 16px auto 0 !important; }
          @media (max-width: 600px) {
            table.noriks-bx-t { font-size: 12px; min-width: 420px; }
            table.noriks-bx-t th, table.noriks-bx-t td { padding: 7px 4px; }
            .noriks-bx-note { font-size: 12.5px; }
            /* na mobitelu je crtez bio prevelik — smanjen na trecinu */
            .noriks-bx-fig { max-width: 120px !important; margin-top: 12px !important; }
          }
        </style>
        <div class="noriks-bx-wrap">
          <table class="noriks-bx-t">
            <thead>
              <tr><th>Veľkosť</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th></tr>
            </thead>
            <tbody>
              <tr><th>a</th><td>32</td><td>34</td><td>36</td><td>38</td><td>40</td><td>42</td><td>44</td></tr>
              <tr><th>b</th><td>33,5</td><td>34,5</td><td>35,5</td><td>36,5</td><td>37,5</td><td>38,5</td><td>39,5</td></tr>
              <tr><th>c</th><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td></tr>
              <tr><th>d</th><td>29</td><td>30</td><td>31</td><td>32</td><td>33</td><td>34</td><td>35</td></tr>
            </tbody>
          </table>
        </div>
        <img class="noriks-bx-fig" src="<?php echo esc_url( get_template_directory_uri() . '/img/boxers-measure.webp' ); ?>"
             alt="Rozmery boxeriek: a, b, c, d" loading="lazy">
        <p class="noriks-bx-note"><strong>Vyberte rovnaké číslo, aké bežne nosíte.</strong><br>Rozmery sú v centimetroch. Veľkosti sa môžu líšiť o &plusmn;1&ndash;2 cm. Ak ste medzi dvoma veľkosťami, zvoľte menšiu &mdash; materiál je pružný.</p>
      </div>

      
      
       
      <?php elseif ( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-nogavice' ) ): ?>

      <div style="line-height:1.9; text-align:left; margin:40px 0; padding:0 6px; font-size:15px; color:#111;">
        <strong>S/M</strong> : veľkosť obuvi 36–40 / obvod lýtka : 23–36 cm<br>
        <strong>L/XL</strong> : veľkosť obuvi 40–44 / obvod lýtka : 36–45 cm<br>
        <strong>2XL</strong> : veľkosť obuvi 44–48 / obvod lýtka : 45–56 cm<br><br>
        Zmerajte prosím obvod lýtka na najširšom mieste, aby ste zistili svoju veľkosť.<br><br>
        Odporúčame vybrať veľkosť podľa obvodu lýtka, nie podľa bežnej veľkosti obuvi.
      </div>

      <?php elseif ( has_term( array( 'ponozky', 'zimske-carape	' ), 'product_cat', get_the_ID() ) ): ?>
      
      
       <img
    
    style="margin-top: 70px;margin-bottom: 70px;"
    
      src="https://noriks.com/sk/wp-content/uploads/2026/02/Nogavice_tabela_velikosti_sk.png"
      alt="Size Guide">
      
      
      <?php elseif ( has_term( array( 'orto-starter', 'orto-majica-bokserica' ), 'product_cat', get_the_ID() ) ): ?>
      
      
      
     <img
    
    style="margin-top: 35px;margin-bottom: 0px;"
    
      src="https://noriks.com/sk/wp-content/uploads/2026/04/sk_majice.jpeg"
      alt="Size Guide">
      
      
       
      <!-- BOXERS: HTML size table (replaces the image) -->
      <div class="noriks-bx">
        
        <div class="noriks-bx-wrap">
          <table class="noriks-bx-t">
            <thead>
              <tr><th>Veľkosť</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th></tr>
            </thead>
            <tbody>
              <tr><th>a</th><td>32</td><td>34</td><td>36</td><td>38</td><td>40</td><td>42</td><td>44</td></tr>
              <tr><th>b</th><td>33,5</td><td>34,5</td><td>35,5</td><td>36,5</td><td>37,5</td><td>38,5</td><td>39,5</td></tr>
              <tr><th>c</th><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td></tr>
              <tr><th>d</th><td>29</td><td>30</td><td>31</td><td>32</td><td>33</td><td>34</td><td>35</td></tr>
            </tbody>
          </table>
        </div>
        <img class="noriks-bx-fig" src="<?php echo esc_url( get_template_directory_uri() . '/img/boxers-measure.webp' ); ?>"
             alt="Rozmery boxeriek: a, b, c, d" loading="lazy">
        <p class="noriks-bx-note"><strong>Vyberte rovnaké číslo, aké bežne nosíte.</strong><br>Rozmery sú v centimetroch. Veľkosti sa môžu líšiť o &plusmn;1&ndash;2 cm. Ak ste medzi dvoma veľkosťami, zvoľte menšiu &mdash; materiál je pružný.</p>
      </div>




      <?php elseif ( function_exists('noriks_is_type') && noriks_is_type( 'leakboxers' ) ): ?>

      <div style="margin:30px 0;padding:0 6px;">
        <p style="margin:0 0 4px;font-weight:700;font-size:15px;">Ako si zmerať boky</p>
        <p style="margin:0 0 14px;line-height:1.6;font-size:14px;color:#333;">Omotajte krajčírsky meter okolo najširšej časti bokov (cez zadok), bez sťahovania, a zapíšte si mieru v centimetroch.</p>
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
          <thead><tr style="background:#12233b;color:#fff;">
            <th style="padding:9px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Veľkosť</th><th style="padding:9px 10px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Boky (cm)</th>
          </tr></thead>
          <tbody>
          <?php foreach ( array(array('S','do 76 cm','do 30"'),array('M','77 – 85 cm','30 – 33"'),array('L','86 – 94 cm','34 – 37"'),array('XL','95 – 102 cm','37 – 40"'),array('2XL','103 – 114 cm','41 – 45"'),array('3XL','115 – 121 cm','45 – 48"'),array('4XL','122 – 129 cm','48 – 51"'),array('5XL','130 – 137 cm','51 – 54"'),array('6XL','138 – 145 cm','54 – 57"'),array('7XL','146 – 153 cm','57 – 60"'),array('8XL','154 cm a viac','61" a viac') ) as $i=>$r): ?>
            <tr style="background:<?php echo ($i%2)?'#f5f7f9':'#fff'; ?>;border-bottom:1px solid #eee;">
              <td style="padding:8px 10px;font-weight:700;"><?php echo esc_html($r[0]); ?></td><td style="padding:8px 10px;"><?php echo esc_html($r[1]); ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <p style="margin-top:12px;font-size:14px;color:#444;"><strong>Medzi dvoma veľkosťami?</strong> Odporúčame väčšie číslo pre optimálne pohodlie a maximálnu absorpciu.</p>
      </div>

      <?php elseif ( function_exists('noriks_is_type') && noriks_is_type( 'kompresijske-majice' ) ): ?>

      <div style="margin:30px 0;padding:0 6px;">
        <table style="width:100%;border-collapse:collapse;font-size:16px;">
          <thead><tr style="background:#111;color:#fff;">
            <th style="padding:11px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Veľkosť</th><th style="padding:11px 12px;text-align:left;background:#e9e9e9 !important;color:#111 !important;">Zodpovedajúca hmotnosť</th>
          </tr></thead>
          <tbody>
          <?php foreach ( array(array('S','50 – 70 kg'),array('M','70 – 90 kg'),array('L','90 – 110 kg'),array('XL','110 – 130 kg'),array('2XL','130 – 150 kg'),array('3XL','150 – 170 kg'),array('4XL','170 – 190 kg'),array('5XL','190 – 210 kg') ) as $i=>$r): ?>
            <tr style="background:<?php echo ($i%2)?'#f2f2f2':'#fff'; ?>;border-bottom:1px solid #e6e6e6;">
              <td style="padding:11px 12px;font-weight:800;"><?php echo esc_html($r[0]); ?></td><td style="padding:11px 12px;font-weight:700;"><?php echo esc_html($r[1]); ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <p style="margin-top:12px;font-size:14px;color:#444;">Vyberte veľkosť podľa svojej hmotnosti. Medzi dvoma veľkosťami? Pre silnejšiu kompresiu vyberte menšie číslo.</p>
      </div>

      <?php else: ?>

      <!-- MAJICE: HTML size chart (visina x teza matrika) -->
      <div class="noriks-size-chart-wrap">
        <style>
          .noriks-size-chart-wrap {
            width: 100%;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #111;
          }
          .noriks-sc-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
          }
          /* MOBILE: force horizontal scrollbar to be ALWAYS visible, fat + orange */
          @media (max-width: 768px) {
            .noriks-sc-table-wrap {
              overflow-x: scroll !important;
              padding-bottom: 10px;
              scrollbar-width: auto;
              scrollbar-color: #f39c13 rgba(0,0,0,0.10);
              background:
                linear-gradient(90deg, #fff 30%, rgba(255,255,255,0)) left center / 24px 100% no-repeat,
                linear-gradient(90deg, rgba(255,255,255,0), #fff 70%) right center / 24px 100% no-repeat,
                linear-gradient(90deg, rgba(0,0,0,0.12), rgba(0,0,0,0)) left center / 18px 100% no-repeat,
                linear-gradient(90deg, rgba(0,0,0,0), rgba(0,0,0,0.12)) right center / 18px 100% no-repeat;
              background-attachment: local, local, scroll, scroll;
            }
            .noriks-sc-table-wrap::-webkit-scrollbar {
              height: 12px !important;
              -webkit-appearance: none;
              background: rgba(0,0,0,0.10);
            }
            .noriks-sc-table-wrap::-webkit-scrollbar-track {
              background: rgba(0,0,0,0.10);
              border-radius: 6px;
              border: 1px solid rgba(0,0,0,0.15);
            }
            .noriks-sc-table-wrap::-webkit-scrollbar-thumb {
              background: #f39c13;
              border-radius: 6px;
              border: 2px solid rgba(0,0,0,0.10);
              min-width: 50px;
            }
            .noriks-sc-table-wrap::-webkit-scrollbar-thumb:active,
            .noriks-sc-table-wrap::-webkit-scrollbar-thumb:hover {
              background: #d97f00;
            }
          }
          table.noriks-sc {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            font-size: 14px;
            table-layout: fixed;
          }
          /* Mobile: keep horizontal scroll with readable min-width */
          @media (max-width: 768px) {
            table.noriks-sc { min-width: 780px; font-size: 10.4px; }
          }
          /* Desktop: fit fully within modal, no horizontal scroll */
          @media (min-width: 769px) {
            table.noriks-sc { min-width: 0; font-size: 14px; }
          }
          table.noriks-sc th, table.noriks-sc td {
            border: 2px solid #fff;
            text-align: center;
            padding: 9px 2px;
            background: #ececec;
            font-weight: 600;
            color: #111;
            white-space: nowrap;
            word-break: keep-all;
          }
          @media (min-width: 769px) {
            table.noriks-sc th, table.noriks-sc td { padding: 10px 3px; }
          }
          table.noriks-sc thead th {
            background: #b8b8b8;
            color: #000;
            font-weight: 700;
          }
          table.noriks-sc thead th.noriks-sc-empty { background: #b8b8b8; }
          table.noriks-sc tbody th {
            background: #b8b8b8;
            font-weight: 700;
          }
          table.noriks-sc tbody th.noriks-sc-vis-label {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            background: #b8b8b8;
            color: #000;
            width: 32px;
            letter-spacing: 1px;
          }
          /* Sticky col 1 (Visina label) + col 2 (Velikost / height column) on horizontal scroll */
          table.noriks-sc thead th:first-child,
          table.noriks-sc tbody th.noriks-sc-vis-label {
            position: sticky;
            left: 0;
            z-index: 5;
            background: #b8b8b8;
          }
          table.noriks-sc thead th:nth-child(2),
          table.noriks-sc tbody tr > th:nth-of-type(2),
          table.noriks-sc tbody tr:not(:first-child) > th:first-of-type {
            position: sticky;
            left: 42px;
            z-index: 4;
            background: #b8b8b8;
            box-shadow: 3px 0 5px -2px rgba(0,0,0,0.18);
          }
          /* Make weight header row sticky vertically too */
          table.noriks-sc thead th {
            position: sticky;
            top: 0;
            z-index: 6;
            background: #b8b8b8;
          }
          /* Top-left sticky corners need higher z so they win */
          table.noriks-sc thead th:first-child { z-index: 9; }
          table.noriks-sc thead th:nth-child(2) { z-index: 8; }
          table.noriks-sc td.noriks-sc-empty { background: #ececec; color: transparent; }
          table.noriks-sc td.noriks-sc-size {
            background: #d9d9d9;
            color: #000;
            font-weight: 700;
            transition: background-color 0.15s ease, transform 0.15s ease;
          }
          /* Desktop hover: highlight ONLY the hovered cell */
          @media (hover: hover) and (min-width: 769px) {
            table.noriks-sc td.noriks-sc-size:hover {
              background: #f39c13 !important;
              color: #fff !important;
              transform: scale(1.06);
              box-shadow: 0 2px 10px rgba(0,0,0,0.22);
              position: relative;
              z-index: 2;
            }
          }
          .noriks-sc-steps {
            margin-top: 22px;
          }
          .noriks-sc-steps h3 {
            margin: 0 0 12px;
            font-size: 16px;
            font-weight: 800;
            color: #111;
          }
          .noriks-sc-steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
          }
          .noriks-sc-step {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            line-height: 1.4;
            color: #222;
          }
          .noriks-sc-step .noriks-sc-num {
            flex: 0 0 22px;
            width: 22px; height: 22px;
            border-radius: 50%;
            background: #111;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
          }
          .noriks-sc-pro {
            margin-top: 16px;
            border: 1.5px solid #f39c13;
            border-radius: 4px;
            padding: 10px 12px;
            background: #fff8ec;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            line-height: 1.4;
          }
          .noriks-sc-pro-tag {
            background: #f39c13;
            color: #fff;
            font-weight: 800;
            font-size: 11px;
            padding: 5px 9px;
            border-radius: 2px;
            letter-spacing: 0.5px;
            flex: 0 0 auto;
            white-space: nowrap;
          }
          .noriks-sc-guarantee {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #222;
          }
          .noriks-sc-check {
            width: 20px; height: 20px;
            border-radius: 50%;
            background: #2ecc40;
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            display: flex; align-items: center; justify-content: center;
            flex: 0 0 auto;
          }
          @media (max-width: 600px) {
            .noriks-sc-steps-grid { grid-template-columns: 1fr; }
            table.noriks-sc { font-size: 9.6px; min-width: 760px; margin: 0; }
            .noriks-sc-steps { margin-top: 5px; padding: 0 5px; }
            .noriks-size-chart-wrap { padding: 0; }
            .noriks-sc-steps h3 { font-size: 13px; }
            .noriks-sc-step { font-size: 10.4px; }
            .noriks-sc-step .noriks-sc-num { flex: 0 0 18px; width: 18px; height: 18px; font-size: 10px; }
            .noriks-sc-pro { font-size: 10.4px; padding: 8px 10px; margin-left: 5px; margin-right: 5px; }
            .noriks-sc-pro-tag { font-size: 9px; padding: 4px 7px; }
            .noriks-sc-guarantee { font-size: 10.4px; padding: 0 5px; }
            .noriks-sc-check { width: 16px; height: 16px; font-size: 10.4px; }
          }
        </style>

        <div class="noriks-sc-table-wrap">
          <table class="noriks-sc">
            <thead>
              <tr>
                <th class="noriks-sc-empty" style="width:42px;"></th>
                <th class="noriks-sc-empty" style="width:80px;">Veľkosť</th>
                <th>59-68 kg</th>
                <th>69-77 kg</th>
                <th>78-84 kg</th>
                <th>84-95 kg</th>
                <th>96-102 kg</th>
                <th>103-113 kg</th>
                <th>114-129 kg</th>
                <th>130-136 kg</th>
                <th>137-150 kg</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="noriks-sc-vis-label" rowspan="11">Výška (cm)</th>
                <th>168 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td>
              </tr>
              <tr>
                <th>170 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td>
              </tr>
              <tr>
                <th>173 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>175 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>178 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>180 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>183 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>185 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>188 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>191 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>193 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="noriks-sc-steps">
          <h3>Ako nájsť svoju veľkosť</h3>
          <div class="noriks-sc-steps-grid">
            <div class="noriks-sc-step">
              <span class="noriks-sc-num">1</span>
              <span>Nájdi svoju <strong>výšku</strong> v ľavom stĺpci.</span>
            </div>
            <div class="noriks-sc-step">
              <span class="noriks-sc-num">2</span>
              <span>Nájdi svoju <strong>hmotnosť</strong> v hornom riadku.</span>
            </div>
            <div class="noriks-sc-step">
              <span class="noriks-sc-num">3</span>
              <span>Pole, kde sa pretínajú &mdash; to je tvoja veľkosť.</span>
            </div>
          </div>
        </div>

        <div class="noriks-sc-pro">
          <span class="noriks-sc-pro-tag">PRO TIP</span>
          <span>Ak si medzi dvoma veľkosťami a chceš <strong>voľnejší strih</strong>, vezmi väčšiu. Pre <strong>priliehavejší vzhľad</strong> vezmi menšiu.</span>
        </div>

        <div class="noriks-sc-guarantee">
          <span class="noriks-sc-check">&#10003;</span>
          <span>Nie si si istý? Výmena veľkosti do 30 dní.</span>
        </div>
      </div>

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
