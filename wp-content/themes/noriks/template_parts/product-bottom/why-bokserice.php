<?php
/**
 * product-bottom: BOKSERICE — nove sekcije (SK)
 *
 * Struktura, razredi in poti so enaki kot na HR; razlikuje se samo besedilo.
 * Mediji: img/boksarice, img/boksarice-videos, img/boksarice-icons, img/boksarice-barve.
 */
$bx_ver = '?v=20261028d';
$bx_img = get_template_directory_uri() . '/img/boksarice/';
$bx_vid = get_template_directory_uri() . '/img/boksarice-videos/';
$bx_ico = get_template_directory_uri() . '/img/boksarice-icons/';
$bx_col = get_template_directory_uri() . '/img/boksarice-barve/';
?>
<section class="fis-science"><div class="fis-wrap"><div class="fis-box"><h2 class="fis-title">Stvorené pre skutočných chlapov: 4 rozdiely, ktoré si všimneš hneď</h2><div class="fis-grid">
<div class="fis-card"><h3 class="fis-card-title">Nezapáchajú</h3><p class="fis-card-text">Modal <strong>brzdí množenie baktérií</strong>, takže zostanú svieže aj po dlhom dni.</p></div>
<div class="fis-card"><h3 class="fis-card-title">Nevyhŕňajú sa</h3><p class="fis-card-text">Nohavičky <strong>zostanú na mieste</strong>, aj pri chôdzi, drepe či cvičení.</p></div>
<div class="fis-card"><h3 class="fis-card-title">Pás neškrtí</h3><p class="fis-card-text">Mäkká guma <strong>drží, ale netlačí</strong> a po praní nestráca pružnosť.</p></div>
<div class="fis-card"><h3 class="fis-card-title">Nič neškriabe</h3><p class="fis-card-text">Potlačená etiketa a ploché švy, <strong>jemné na pokožke</strong> celý deň.</p></div>
</div></div></div></section>

<section class="fis-hero"><video class="fis-hero-vid" src="<?php echo esc_url( $bx_vid . 'boksarice-hero.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-hero-overlay"></div><div class="fis-hero-inner"><h2 class="fis-hero-title">Boxerky, na ktoré zabudneš. Od rána do večera.</h2></div></section>

<section class="fis-experts"><div class="fis-wrap fis-exp-grid"><div class="fis-exp-quote"><h2 class="fis-h2">Modal, ktorý pocítiš</h2>
<p>Vyrobené z <strong>prémiového modalu</strong>, ktorý je mäkší ako bavlna, lepšie odvádza vlhkosť a rýchlejšie schne. Látka sa naťahuje s každým pohybom a vracia sa do tvaru.</p>
<p>✔ Hodvábne jemné na pokožke<br>✔ Dýchajú a nezadržiavajú pot<br>✔ Po praní nestrácajú tvar</p>
<p class="fis-exp-author"><strong>Látka zblízka</strong><br>Pozri sa, ako sú boxerky vyrobené.</p></div>
<div class="fis-exp-cards">
<div class="fis-exp-card nk-media"><video src="<?php echo esc_url( $bx_vid . 'boksarice-fabric.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-exp-cap"><div class="fis-exp-name">Mäkký modal</div><div class="fis-exp-role">Mäkší ako bavlna</div></div></div>
<div class="fis-exp-card nk-media"><video src="<?php echo esc_url( $bx_vid . 'boksarice-stretch.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-exp-cap"><div class="fis-exp-name">Vracia sa do tvaru</div><div class="fis-exp-role">Nosením sa nevytiahne</div></div></div>
<div class="fis-exp-card nk-media"><video src="<?php echo esc_url( $bx_vid . 'boksarice-waist.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-exp-cap"><div class="fis-exp-name">Mäkký pás</div><div class="fis-exp-role">Drží, ale neškrtí</div></div></div>
</div></div></section>

<style>
.nk-colors{padding:36px 0;background:#fff}
.nk-colors .fis-h2{margin-bottom:6px}
.nk-colors-sub{text-align:center;color:#444;font-size:15px;margin:0 0 22px}
.nk-col-grid{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:12px;max-width:900px;margin:0 auto}
.nk-col{display:flex;flex-direction:column;align-items:center;gap:6px;background:#f4f4f4;border-radius:12px;padding:14px 6px 12px}
.nk-col img{width:100%;aspect-ratio:1/1;object-fit:cover;border-radius:8px;display:block}
.nk-col svg{width:64px;height:64px}
.nk-col span{font-size:13px;font-weight:700;color:#1c1c1c}
.nk-col-note{display:flex;justify-content:center;gap:22px;flex-wrap:wrap;margin-top:18px;font-size:14px;font-weight:600;color:#1c1c1c}
@media (max-width:760px){.nk-col-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
</style>
<section class="nk-colors"><div class="fis-wrap"><h2 class="fis-h2 fis-center">5 farieb na každý deň</h2><p class="nk-colors-sub">Farby nevyblednú a nevyperú sa ani po mnohých praniach.</p>
<div class="nk-col-grid"><div class="nk-col"><img src="<?php echo esc_url( $bx_col . 'boksarice-barva-crna.jpg' . $bx_ver ); ?>" alt="NORIKS boxerky čierne" loading="lazy"><span>Čierna</span></div><div class="nk-col"><img src="<?php echo esc_url( $bx_col . 'boksarice-barva-temnomodra.jpg' . $bx_ver ); ?>" alt="NORIKS boxerky tmavomodré" loading="lazy"><span>Tmavomodrá</span></div><div class="nk-col"><img src="<?php echo esc_url( $bx_col . 'boksarice-barva-rdeca.jpg' . $bx_ver ); ?>" alt="NORIKS boxerky červené" loading="lazy"><span>Červená</span></div><div class="nk-col"><img src="<?php echo esc_url( $bx_col . 'boksarice-barva-siva.jpg' . $bx_ver ); ?>" alt="NORIKS boxerky sivé" loading="lazy"><span>Sivá</span></div><div class="nk-col"><img src="<?php echo esc_url( $bx_col . 'boksarice-barva-zelena.jpg' . $bx_ver ); ?>" alt="NORIKS boxerky zelené" loading="lazy"><span>Zelená</span></div></div>
<div class="nk-col-note"><span>✔ Farba nevybledne</span><span>✔ Pás zostane čierny</span><span>✔ Všetky veľkosti S–5XL</span></div>

</div></section>

<section class="fis-ugc"><div class="fis-wrap"><div class="fis-ugc-grid">
<div class="fis-ugc-card"><div class="fis-ugc-media nk-media"><img src="<?php echo esc_url( $bx_img . 'boksarice-kupec-1.jpg' . $bx_ver ); ?>" alt="" loading="lazy"></div><p class="fis-ugc-cap">„Netlačia, ani keď cvičím.“</p></div>
<div class="fis-ugc-card"><div class="fis-ugc-media nk-media"><img src="<?php echo esc_url( $bx_img . 'boksarice-kupec-2.jpg' . $bx_ver ); ?>" alt="" loading="lazy"></div><p class="fis-ugc-cap">„Nešmýkajú sa dole, celý deň držia v páse.“</p></div>
<div class="fis-ugc-card"><div class="fis-ugc-media nk-media"><img src="<?php echo esc_url( $bx_img . 'boksarice-kupec-3.jpg' . $bx_ver ); ?>" alt="" loading="lazy"></div><p class="fis-ugc-cap">„Guma je pevná, ale netlačí.“</p></div>
<div class="fis-ugc-card"><div class="fis-ugc-media nk-media"><img src="<?php echo esc_url( $bx_img . 'boksarice-kupec-4.jpg' . $bx_ver ); ?>" alt="" loading="lazy"></div><p class="fis-ugc-cap">„Najlepšie boxerky pre moju postavu.“</p></div>
</div></div></section>

<section class="fis-thermo"><div class="fis-wrap"><p class="fis-eyebrow"><strong>NORIKS</strong> strih</p><h2 class="fis-h2 fis-center">3 veci, ktoré robia rozdiel</h2><div class="fis-thermo-grid">
<div class="fis-thermo-card nk-media"><video src="<?php echo esc_url( $bx_vid . 'boksarice-squat.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-thermo-label">Držia na mieste</div></div>
<div class="fis-thermo-card nk-media"><video src="<?php echo esc_url( $bx_vid . 'boksarice-pouch.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-thermo-label">Priestor, kde ho potrebuješ</div></div>
<div class="fis-thermo-card nk-media"><video src="<?php echo esc_url( $bx_vid . 'boksarice-wash.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video><div class="fis-thermo-label">Rýchlo schnú</div></div>
</div></div></section>

<section class="fis-upg"><div class="fis-wrap"><h2 class="fis-h2 fis-center">Štyri detaily, na ktorých záleží</h2><div class="fis-upg-grid">
<div class="fis-upg-card"><img class="fis-upg-ico" alt="" src="<?php echo esc_url( $bx_ico . 'ikona-1.svg' . $bx_ver ); ?>"><div class="fis-upg-title">Prémiový modal</div><p class="fis-upg-text">Mäkší ako bavlna, odvádza vlhkosť a brzdí množenie baktérií.</p></div>
<div class="fis-upg-card"><img class="fis-upg-ico" alt="" src="<?php echo esc_url( $bx_ico . 'ikona-2.svg' . $bx_ver ); ?>"><div class="fis-upg-title">Bez všitej etikety</div><p class="fis-upg-text">Potlačené označenie, ktoré neškriabe.</p></div>
<div class="fis-upg-card"><img class="fis-upg-ico" alt="" src="<?php echo esc_url( $bx_ico . 'ikona-3.svg' . $bx_ver ); ?>"><div class="fis-upg-title">Ploché švy</div><p class="fis-upg-text">Nedrú na stehnách a nezanechávajú odtlačky na pokožke.</p></div>
<div class="fis-upg-card"><img class="fis-upg-ico" alt="" src="<?php echo esc_url( $bx_ico . 'ikona-4.svg' . $bx_ver ); ?>"><div class="fis-upg-title">Veľkosti S–5XL</div><p class="fis-upg-text">Stále veľkosti a výmena zadarmo do 30 dní.</p></div>
</div></div></section>

<section class="fis-eng"><div class="fis-wrap fis-row2"><div class="fis-row2-copy"><h2 class="fis-h2">Vyvinuté na každý deň. Vyskúšané na mužoch všetkých postáv.</h2><p>Strih sme dolaďovali na mužoch všetkých postáv, od S po 5XL, kým neboli pohodlné od rána do večera: pás neškrtí, nohavičky zostanú na mieste. Každú objednávku pred odoslaním skontrolujeme, aby prišla bez chyby.</p></div><div class="fis-row2-media nk-media nk-wide"><video src="<?php echo esc_url( $bx_vid . 'boksarice-pack.mp4' . $bx_ver ); ?>" muted autoplay loop playsinline preload="metadata"></video></div></div></section>

<section class="fis-cheaper"><div class="fis-wrap fis-row2"><div class="fis-row2-media nk-media"><img src="<?php echo esc_url( $bx_img . 'boksarice-8-za-ceno-3.jpg' . $bx_ver ); ?>" alt="" loading="lazy"></div><div class="fis-row2-copy"><p class="fis-eyebrow">MÚDRY NÁKUP</p><h2 class="fis-h2">8 boxeriek za cenu troch z obchodu</h2><p>Jedny kvalitné modalové boxerky stoja v obchode 15–20 €. V NORIKS balení 4+4 GRATIS dostaneš osem boxeriek za 59,99 €, teda 7,50 € za kus. Bez kompromisov v strihu či materiáli a s 30 dňami na výmenu veľkosti.</p></div></div></section>

<style>
.nk-cmp{padding:48px 0;background:#fff}
.nk-cmp .fis-h2{margin-bottom:8px}
.nk-cmp-sub{text-align:center;color:#444;font-size:15.5px;margin:0 auto 26px;max-width:620px}
.nk-cmp-card{max-width:900px;margin:0 auto;border-radius:16px;overflow:hidden;border:1px solid #e6e6e6;box-shadow:0 2px 14px rgba(0,0,0,.06)}
.nk-cmp-row{display:grid;grid-template-columns:minmax(0,1.6fr) minmax(0,1fr) minmax(0,1fr);align-items:center;border-top:1px solid #ececec}
.nk-cmp-row:first-child{border-top:0}
.nk-cmp-row>div{padding:14px 18px;font-size:15px;color:#1c1c1c}
.nk-cmp-row>div:nth-child(2){background:#fffbe0;text-align:center}
.nk-cmp-row>div:nth-child(3){text-align:center;color:#8a8a8a}
.nk-cmp-head>div{padding:20px 18px}
.nk-cmp-head>div:nth-child(2){background:#1c1c1c;color:#fff}
.nk-cmp-head>div:nth-child(3){background:#f4f4f4}
.nk-cmp-brand{font-weight:800;font-size:15px;letter-spacing:.5px;text-transform:uppercase}
.nk-cmp-price{font-weight:800;font-size:22px;margin-top:4px;font-variant-numeric:tabular-nums}
.nk-cmp-head>div:nth-child(2) .nk-cmp-price{color:#F5D900}
.nk-cmp-note{font-size:12px;opacity:.8;margin-top:2px}
.nk-yes,.nk-no{display:inline-grid;place-items:center;width:28px;height:28px;border-radius:50%;font-weight:800;font-size:15px}
.nk-yes{background:#1c1c1c;color:#F5D900}
.nk-no{background:#ececec;color:#9a9a9a}
.nk-cmp-foot{text-align:center;font-size:13px;color:#666;margin-top:14px}
@media (max-width:600px){.nk-cmp-row>div{padding:12px 10px;font-size:13.5px}.nk-cmp-price{font-size:17px}}</style>
<section class="nk-cmp"><div class="fis-wrap"><h2 class="fis-h2 fis-center">NORIKS vs. ostatné značky</h2><p class="nk-cmp-sub">Nie všetky boxerky sú rovnaké. Tu je dôvod, prečo sa tie naše oplatia.</p>
<div class="nk-cmp-card">
<div class="nk-cmp-row nk-cmp-head"><div></div><div><div class="nk-cmp-brand">NORIKS</div><div class="nk-cmp-price">7,50–11,25 €</div><div class="nk-cmp-note">za kus, podľa balenia</div></div><div><div class="nk-cmp-brand">Ostatné značky</div><div class="nk-cmp-price">15–20 €</div><div class="nk-cmp-note">za kus</div></div></div>
<div class="nk-cmp-row"><div>Prémiový modal namiesto bežnej bavlny</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
<div class="nk-cmp-row"><div>Nezapáchajú ani po dlhom dni</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
<div class="nk-cmp-row"><div>Nohavičky zostanú na mieste</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
<div class="nk-cmp-row"><div>Pás, ktorý neškrtí</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
<div class="nk-cmp-row"><div>Stále veľkosti od S po 5XL</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
<div class="nk-cmp-row"><div>Bez škriabajúcej etikety</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
<div class="nk-cmp-row"><div>30 dní na výmenu veľkosti zadarmo</div><div><span class="nk-yes">✓</span></div><div><span class="nk-no">✕</span></div></div>
</div>
<p class="nk-cmp-foot">Najnižšia cena 7,50 € za kus v balení 4+4 GRATIS.</p>
</div></section>

<style>
/* Enakomeren ritem 12 px v zgornjem delu strani. Ta datoteka se izrise samo pri
   majicah in boksericah, zato pravila ne morejo uiti na druge izdelke. */
.gck-benefits-list{margin-bottom:12px!important}
.gck-countdown{margin:12px 0!important}
.gck-size-link-wrap{margin:12px 0!important}
#bundle-selector{margin-top:12px!important}


/* --- skupno --- */
.fis-wrap{max-width:1180px;margin:0 auto;padding:0 16px}
.fis-h2{font-size:clamp(24px,3vw,34px);font-weight:800;color:#1c1c1c;line-height:1.2;margin:0 0 18px}
.fis-center{text-align:center}
.fis-eyebrow{font-size:13px;letter-spacing:1px;text-transform:uppercase;color:#555;margin:0 0 8px}

/* 1) 4 razlike */
.fis-science{background:#f9f9f9;padding:44px 0}
.fis-box{background:transparent;border-radius:0;padding:0}
.fis-title{font-size:clamp(23px,2.9vw,32px);font-weight:800;color:#1c1c1c;line-height:1.2;margin:0 0 26px}
.fis-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:0}
.fis-card{padding:0 22px;border-left:1px solid #dcdcdc}
.fis-card:first-child{border-left:0;padding-left:0}
.fis-card-title{font-size:17px;font-weight:800;color:#1c1c1c;margin:0 0 10px}
.fis-card-text{font-size:15px;line-height:1.55;color:#333;margin:0}

/* 2) hero video */
.fis-hero{position:relative;width:100%;min-height:520px;display:flex;align-items:center;overflow:hidden}
.fis-hero-vid{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
.fis-hero-overlay{position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,0,0,.5),rgba(0,0,0,.05) 55%)}
.fis-hero-inner{position:relative;z-index:2;max-width:1180px;margin:0 auto;padding:0 40px;width:100%;box-sizing:border-box}
.fis-hero-title{color:#fff;font-weight:800;font-size:clamp(27px,4vw,46px);line-height:1.15;max-width:640px;margin:0;text-shadow:0 2px 14px rgba(0,0,0,.4)}

/* 3) materijal */
.fis-experts{padding:44px 0}
.fis-exp-grid{display:grid;grid-template-columns:1fr 2fr;gap:40px;align-items:start}
.fis-exp-quote p{font-size:15.5px;line-height:1.6;color:#333;margin:0 0 14px}
.fis-exp-author{color:#1c1c1c}
.fis-exp-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.fis-exp-card{position:relative;border-radius:8px;overflow:hidden;aspect-ratio:3/4;background:#222}
.fis-exp-card video,.fis-exp-card img{width:100%;height:100%;object-fit:cover;display:block}
.fis-exp-cap{position:absolute;left:0;right:0;bottom:0;padding:14px;color:#fff;background:linear-gradient(0deg,rgba(0,0,0,.75),rgba(0,0,0,0))}
.fis-exp-name{font-weight:800;font-size:18px}
.fis-exp-role{font-size:13px}

/* 4) boje */
.nk-colors{padding:36px 0;background:#fff}
.nk-colors .fis-h2{margin-bottom:6px}
.nk-colors-sub{text-align:center;color:#444;font-size:15px;margin:0 0 22px}
.nk-col-grid{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:12px}
.nk-col{display:flex;flex-direction:column;align-items:center;gap:6px;background:#f9f9f9;border-radius:8px;padding:10px 8px 12px}
.nk-col img{width:100%;aspect-ratio:1/1;object-fit:cover;display:block}
.nk-col span{font-size:13px;font-weight:700;color:#1c1c1c}
.nk-col-note{display:flex;justify-content:center;gap:22px;flex-wrap:wrap;margin-top:18px;font-size:14px;font-weight:600;color:#1c1c1c}

/* 5) mnenja kupcev */
.fis-ugc{background:#223047;padding:40px 0}
.fis-ugc-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.fis-ugc-media{border-radius:8px;overflow:hidden;aspect-ratio:3/4;background:#000}
.fis-ugc-media video,.fis-ugc-media img{width:100%;height:100%;object-fit:cover;display:block}
.fis-ugc-cap{color:#eee;font-size:14px;line-height:1.5;margin:10px 0 0}

/* 6) 3 stvari */
.fis-thermo{background:#f9f9f9;padding:44px 0}
.fis-thermo-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.fis-thermo-card{position:relative;border-radius:8px;overflow:hidden;aspect-ratio:4/3;background:#111}
.fis-thermo-card video{width:100%;height:100%;object-fit:cover;display:block}
.fis-thermo-label{position:absolute;left:16px;bottom:14px;color:#fff;font-weight:800;font-size:18px;text-shadow:0 1px 8px rgba(0,0,0,.6)}

/* 7) 4 detalja */
.fis-upg{padding:44px 0}
.fis-upg-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;text-align:center}
.fis-upg-ico{width:56px;height:56px;object-fit:contain;display:block;margin:0 auto 14px}
.fis-upg-title{font-weight:800;color:#1c1c1c;margin:0 0 8px;font-size:16px}
.fis-upg-text{font-size:14px;line-height:1.5;color:#444;margin:0}

/* 8 + 9) dvostolpna bloka */
.fis-eng,.fis-cheaper{padding:40px 0}
.fis-cheaper{background:#f9f9f9}
.fis-row2{display:grid;grid-template-columns:1fr 1fr;gap:44px;align-items:center}
.fis-row2-copy p{font-size:15.5px;line-height:1.65;color:#333}
.fis-row2-media{border-radius:8px;overflow:hidden}
.fis-row2-media video,.fis-row2-media img{width:100%;height:auto;display:block}
.fis-cheaper .fis-row2-media{aspect-ratio:4/3}
.fis-cheaper .fis-row2-media video,.fis-cheaper .fis-row2-media img{height:100%;object-fit:cover}

/* mediji, ki polnijo okvir */
.nk-media{position:relative;overflow:hidden;background:#eee}
.nk-media>video,.nk-media>img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.nk-wide{aspect-ratio:4/3}

/* 10) primerjava */
.nk-cmp{padding:48px 0;background:#fff}
.nk-cmp .fis-h2{margin-bottom:8px}
.nk-cmp-sub{text-align:center;color:#444;font-size:15.5px;margin:0 auto 26px;max-width:620px}
.nk-cmp-card{max-width:900px;margin:0 auto;border-radius:16px;overflow:hidden;border:1px solid #e6e6e6;box-shadow:0 2px 14px rgba(0,0,0,.06)}
.nk-cmp-row{display:grid;grid-template-columns:minmax(0,1.6fr) minmax(0,1fr) minmax(0,1fr);align-items:stretch;border-top:1px solid #ececec}
/* celice se raztegnejo cez celo visino vrstice (sicer pri dvovrsticnem besedilu
   obarvan stolpec ne sega do roba), vsebina ostane navpicno na sredini */
.nk-cmp-row>div{display:flex;flex-direction:column;justify-content:center}
.nk-cmp-row>div:nth-child(2),.nk-cmp-row>div:nth-child(3){align-items:center}
.nk-cmp-row:first-child{border-top:0}
.nk-cmp-row>div{padding:14px 18px;font-size:15px;color:#1c1c1c}
.nk-cmp-row>div:nth-child(2){background:#f39c1217;text-align:center}
.nk-cmp-row>div:nth-child(3){text-align:center;color:#8a8a8a}
.nk-cmp-head>div{padding:20px 18px}
.nk-cmp-head>div:nth-child(2){background:#1c1c1c;color:#fff}
.nk-cmp-head>div:nth-child(3){background:#f4f4f4}
.nk-cmp-brand{font-weight:800;font-size:15px;letter-spacing:.5px;text-transform:uppercase}
.nk-cmp-price{font-weight:800;font-size:22px;margin-top:4px;font-variant-numeric:tabular-nums}
.nk-cmp-head>div:nth-child(2) .nk-cmp-price{color:#f39c12}
.nk-cmp-note{font-size:12px;opacity:.8;margin-top:2px}
.nk-yes,.nk-no{display:inline-grid;place-items:center;width:28px;height:28px;border-radius:50%;font-weight:800;font-size:15px}
.nk-yes{background:#1c1c1c;color:#f39c12}
.nk-no{background:#ececec;color:#9a9a9a}
.nk-cmp-foot{text-align:center;font-size:13px;font-style:italic;color:#666;margin-top:14px}

@media (max-width:900px){
  .fis-exp-grid{grid-template-columns:1fr;gap:24px}
  .fis-ugc-grid{grid-template-columns:1fr 1fr}
  .fis-thermo-grid{grid-template-columns:1fr}
  .fis-upg-grid{grid-template-columns:1fr 1fr;gap:22px}
  .fis-row2{grid-template-columns:1fr;gap:22px}
  .fis-cheaper .fis-row2-media{order:2}
}
@media (max-width:820px){
  .fis-grid{grid-template-columns:1fr 1fr;gap:22px 0}
  .fis-card:nth-child(odd){border-left:0;padding-left:0}
}
@media (max-width:768px){.fis-hero{min-height:380px}.fis-hero-inner{padding:0 22px}}
@media (max-width:760px){.nk-col-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
@media (max-width:600px){.nk-cmp-row>div{padding:12px 10px;font-size:13.5px}.nk-cmp-price{font-size:17px}}
@media (max-width:560px){.fis-exp-cards{grid-template-columns:1fr 1fr}.fis-ugc-grid{grid-template-columns:1fr}}
@media (max-width:480px){.fis-grid{grid-template-columns:1fr}.fis-card{border-left:0;padding-left:0}}

/* ===== NORIKS – mobilna prilagoditev sekcij (telefon, do 767 px) =====
   Velja za majico in boksarice (isti razredi). Dodaj na KONEC sekcije.css. */
@media (max-width:767px){
  /* 1) 4 razlike: kartice 2 x 2 namesto dolgega seznama */
  .fis-science{padding:30px 0!important}
  .fis-science .fis-title{font-size:22px!important;line-height:1.25!important;margin-bottom:16px!important}
  .fis-science .fis-grid{grid-template-columns:1fr 1fr!important;gap:10px!important}
  .fis-science .fis-card{background:#fff;border:0!important;border-radius:14px;padding:14px 12px!important}
  .fis-science .fis-card-title{font-size:15px!important;line-height:1.25;margin:0 0 6px!important}
  .fis-science .fis-card-text{font-size:13.5px!important;line-height:1.45!important}

  /* 2) hero video: višji, besedilo spodaj */
  .fis-hero{min-height:62vh!important;align-items:flex-end!important;padding-bottom:28px}
  .fis-hero-overlay{background:linear-gradient(0deg,rgba(0,0,0,.6),rgba(0,0,0,0) 60%)!important}
  .fis-hero-title{font-size:clamp(24px,7.4vw,32px)!important}

  /* 3) vrstice, ki se drsajo vstran (videi materiala, mnenja kupcev, 3 stvari) */
  .fis-exp-cards,.fis-ugc-grid,.fis-thermo-grid{display:flex!important;gap:12px!important;overflow-x:auto;scroll-snap-type:x mandatory;-webkit-overflow-scrolling:touch;scrollbar-width:none;margin:0 -16px!important;padding:0 16px 4px!important;scroll-padding-left:16px}
  .fis-exp-cards::-webkit-scrollbar,.fis-ugc-grid::-webkit-scrollbar,.fis-thermo-grid::-webkit-scrollbar{display:none}
  .fis-exp-card{flex:0 0 64%!important;scroll-snap-align:start}
  .fis-ugc-card{flex:0 0 76%!important;scroll-snap-align:start}
  .fis-thermo-card{flex:0 0 80%!important;scroll-snap-align:start;aspect-ratio:4/5!important}
  .fis-ugc-cap{font-size:14px!important;line-height:1.4}
  .fis-exp-grid{gap:18px!important}

  /* 4) barve: polne vrstice, zadnja na sredini */
  .nk-col-grid{display:flex!important;flex-wrap:wrap;justify-content:center;gap:10px!important}
  .nk-col{flex:0 0 calc((100% - 30px)/4);box-sizing:border-box;padding:6px!important}
  .nk-col-grid:has(> .nk-col:nth-child(5):last-child) .nk-col,
  .nk-col-grid:has(> .nk-col:nth-child(6):last-child) .nk-col{flex-basis:calc((100% - 20px)/3)}
  .nk-col{min-width:0}
  .nk-col span{font-size:clamp(10px,3.1vw,12px)!important;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block}
  .nk-col-note{gap:6px 14px!important;font-size:13.5px}

  /* 5) primerjalna tabela: ozki stolpci, brez lomljenja besed */
  .nk-cmp-row{grid-template-columns:minmax(0,1fr) 96px 84px!important}
  .nk-cmp-row>div{padding:12px 8px!important;font-size:13.5px!important;line-height:1.35}
  .nk-cmp-head>div{padding:14px 6px!important}
  .nk-cmp-brand{font-size:12px!important;letter-spacing:0!important;line-height:1.2;word-break:keep-all;overflow-wrap:normal;hyphens:none}
  .nk-cmp-price{font-size:15px!important;line-height:1.2}
  .nk-cmp-note{font-size:11px!important;line-height:1.25}

  /* 6) splošno: manj praznega prostora, berljivi naslovi */
  .fis-h2{font-size:clamp(21px,6.4vw,26px)!important;line-height:1.2!important}
  .fis-thermo,.fis-ugc,.fis-experts,.nk-colors,.fis-upg,.fis-eng,.fis-cheaper,.nk-cmp{padding-top:22px!important;padding-bottom:22px!important}

  /* 7) sekcija ocen */
  .nk-rev .nk-sum{gap:10px!important}
  .nk-rev .nk-sum .nk-box{padding:16px!important}
  .nk-rev .nk-feat{display:flex!important;gap:12px!important;overflow-x:auto;scroll-snap-type:x mandatory;-webkit-overflow-scrolling:touch;scrollbar-width:none;margin:0 -16px!important;padding:0 16px 4px!important;scroll-padding-left:16px}
  .nk-rev .nk-feat::-webkit-scrollbar,.nk-rev .nk-chips::-webkit-scrollbar{display:none}
  .nk-rev .nk-feat>.nk-box{flex:0 0 80%;scroll-snap-align:start}
  .nk-rev .nk-chips{flex-wrap:nowrap!important;overflow-x:auto;scrollbar-width:none;margin-left:-16px!important;margin-right:-16px!important;padding:0 16px!important}
  .nk-rev .nk-chip{flex:none;white-space:nowrap}
  .nk-rev .nk-list .nk-card:nth-child(n+4){display:none}  /* na telefonu prve 3, ostale z gumbom »Več ocen« */
}

/* zelo ozki telefoni (320–374 px, npr. iPhone SE 1. gen., manjši Android) */
@media (max-width:374px){
  .fis-wrap{padding-left:12px!important;padding-right:12px!important}
  .fis-science .fis-grid{gap:8px!important}
  .fis-science .fis-card{padding:12px 10px!important}
  .fis-science .fis-card-title{font-size:14px!important}
  .fis-science .fis-card-text{font-size:12.5px!important}
  .fis-exp-cards,.fis-ugc-grid,.fis-thermo-grid,.nk-rev .nk-feat{margin:0 -12px!important;padding:0 12px 4px!important;scroll-padding-left:12px}
  .fis-exp-card{flex-basis:72%!important}.fis-ugc-card{flex-basis:82%!important}.fis-thermo-card{flex-basis:86%!important}.nk-rev .nk-feat>.nk-box{flex-basis:86%}
  .nk-col-grid{gap:6px!important}.nk-col{flex-basis:calc((100% - 18px)/4);padding:4px!important}
  .nk-col-grid:has(> .nk-col:nth-child(5):last-child) .nk-col,.nk-col-grid:has(> .nk-col:nth-child(6):last-child) .nk-col{flex-basis:calc((100% - 12px)/3)}
  .nk-cmp-row{grid-template-columns:minmax(0,1fr) 86px 72px!important}
  .nk-cmp-row>div{font-size:12.5px!important;padding:10px 6px!important}
  .nk-cmp-price{font-size:13.5px!important}
}
/* veliki telefoni (430–767 px, npr. Pro Max, Galaxy Ultra, zložljivi): več kartic naenkrat */
@media (min-width:430px) and (max-width:767px){
  .fis-exp-card{flex-basis:46%!important}.fis-ugc-card{flex-basis:58%!important}.fis-thermo-card{flex-basis:64%!important}.nk-rev .nk-feat>.nk-box{flex-basis:62%}
}
@media (min-width:560px) and (max-width:767px){
  .fis-exp-card{flex-basis:36%!important}.fis-ugc-card{flex-basis:40%!important}.fis-thermo-card{flex-basis:46%!important;aspect-ratio:3/4!important}.nk-rev .nk-feat>.nk-box{flex-basis:46%}
  .fis-science .fis-grid{grid-template-columns:repeat(4,1fr)!important}
  .nk-col{flex-basis:calc((100% - 60px)/7)!important}
}

/* Krmilo pod vrstico, ki se drsa vstran (samo telefon): puscici + tanek drsnik. */
.nk-sc{display:none}
@media (max-width:767px){
  /* width:100% - v .fis-exp-grid je krmilo mrezni element in se skrci na vsebino */
  .nk-sc{display:flex;align-items:center;justify-content:center;gap:12px;margin:10px auto 0;
    width:100%;box-sizing:border-box}
  .nk-sc-btn{flex:none;width:30px;height:30px;padding:0;border-radius:50%;cursor:pointer;
    border:1px solid rgba(0,0,0,.08);background:#fff;display:grid;place-items:center;
    box-shadow:0 1px 5px rgba(0,0,0,.06);transition:opacity .2s,transform .12s;
    -webkit-tap-highlight-color:transparent}
  .nk-sc-btn:active{transform:scale(.92)}
  .nk-sc-btn[disabled]{opacity:.22;box-shadow:none}
  .nk-sc-btn svg{width:13px;height:13px;display:block;stroke:#1c1c1c}
  .nk-sc-bar{position:relative;flex:0 0 72px;height:3px;border-radius:999px;background:rgba(0,0,0,.14)}
  .nk-sc-bar i{position:absolute;top:0;bottom:0;left:0;border-radius:999px;background:#1c1c1c;
    transition:left .22s ease,width .22s ease}
  .fis-ugc .nk-sc-btn{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.3);box-shadow:none}
  .fis-ugc .nk-sc-btn svg{stroke:#fff}
  .fis-ugc .nk-sc-bar{background:rgba(255,255,255,.3)}
  .fis-ugc .nk-sc-bar i{background:#fff}
}
</style>
<script>
(function(){
  if (window.nkScReady) return;
  window.nkScReady = true;
  var CH = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 4.5L7.5 12 15 19.5"/></svg>';
  function init(){
    var rows = document.querySelectorAll('.fis-exp-cards, .fis-ugc-grid, .fis-thermo-grid');
    Array.prototype.forEach.call(rows, function(row){
      if (row.nextElementSibling && row.nextElementSibling.classList.contains('nk-sc')) return;
      if (row.children.length < 2) return;

      var ctl = document.createElement('div');
      ctl.className = 'nk-sc';
      ctl.innerHTML =
        '<button type="button" class="nk-sc-btn" data-dir="-1" aria-label="Predchádzajúce">' + CH + '</button>' +
        '<div class="nk-sc-bar"><i></i></div>' +
        '<button type="button" class="nk-sc-btn" data-dir="1" aria-label="Ďalšie">' +
          CH.replace('<svg ', '<svg style="transform:rotate(180deg)" ') + '</button>';
      row.parentNode.insertBefore(ctl, row.nextSibling);

      var thumb = ctl.querySelector('.nk-sc-bar i');
      var btns  = ctl.querySelectorAll('.nk-sc-btn');

      function step(){
        var first = row.firstElementChild;
        if (!first) return row.clientWidth;
        var cs = getComputedStyle(row);
        var gap = parseFloat(cs.columnGap || cs.gap) || 0;
        return first.getBoundingClientRect().width + gap;
      }
      function update(){
        var vis = row.clientWidth, all = row.scrollWidth, max = all - vis;
        if (max <= 4) { ctl.style.display = 'none'; return; }
        ctl.style.display = '';
        var w = Math.max(20, vis / all * 100);
        thumb.style.width = w + '%';
        thumb.style.left = (row.scrollLeft / max) * (100 - w) + '%';
        btns[0].disabled = row.scrollLeft <= 1;
        btns[1].disabled = row.scrollLeft >= max - 1;
      }
      Array.prototype.forEach.call(btns, function(b){
        b.addEventListener('click', function(){
          row.scrollBy({ left: step() * parseInt(b.dataset.dir, 10), behavior: 'smooth' });
        });
      });
      row.addEventListener('scroll', update, { passive: true });
      window.addEventListener('resize', update);
      update();
    });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
</script>
