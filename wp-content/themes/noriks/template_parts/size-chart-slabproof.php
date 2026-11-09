<?php
/**
 * Tablica velicina za NORIKS SlabProof (orto-slabproof) — radne carape.
 * Izvor tabele: noriks_slabproof_sizes() v functions/product-type.php (ista kot v akordeonu).
 *
 * VAZNO: id #custom-size-chart-modal i klasa .show su ugovor koji ocekuje vticnik
 * (orto-product.php). Modal je JEDAN prekrivni sloj, bez zasebnog backdropa.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div id="custom-size-chart-modal" class="kwsc" role="dialog" aria-modal="true" aria-labelledby="kwsc-title">
  <div class="kwsc-box">
  <div class="kwsc-bar">
    <h2 id="kwsc-title">Tabuľka veľkostí</h2>
    <span id="close-size-chart-x" role="button" tabindex="0" aria-label="Zavrieť">&times;</span>
  </div>

  <div class="kwsc-body">
    <p class="kwsc-lead">Objednajte si <strong>svoje bežné číslo obuvi</strong>. Pletenina je pružná, takže každá veľkosť pokryje niekoľko čísel.</p>

    <div class="kwsc-scroll">
      <table class="kwsc-table">
        <thead>
          <tr><th scope="col">EU číslo obuvi</th></tr>
        </thead>
        <tbody>
          <?php foreach ( noriks_slabproof_sizes() as $r ) : ?>
          <tr><th scope="row"><?php echo esc_html( $r[0] ); ?></th></tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="kwsc-how">
      <h3>Ako vybrať</h3>
      <ol>
        <li><strong>Pozrite sa na číslo</strong> na pracovných čižmách alebo topánkach, ktoré bežne nosíte.</li>
        <li><strong>Nájdite ho</strong> v stĺpci EU číslo obuvi.</li>
        <li><strong>Medzi dvoma veľkosťami?</strong> Vezmite väčšiu — ponožka nebude zvierať prsty.</li>
      </ol>
      <p class="kwsc-note">Vankúšik na päte a pás okolo klenby sadnú na miesto len v správnej veľkosti.</p>
    </div>
  </div>
  </div>
</div>

<style>
#custom-size-chart-modal.kwsc {
  display: none; position: fixed; inset: 0; z-index: 9999999;
  background: rgba(20,14,18,.7); align-items: center; justify-content: center; padding: 20px;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #15140f;
}
#custom-size-chart-modal.kwsc.show { display: flex; }
#custom-size-chart-modal.kwsc * { box-sizing: border-box; }
.kwsc-box { background: #fff; border-radius: 14px; width: 100%; max-width: 640px;
  max-height: min(720px, 86vh); display: flex; flex-direction: column; overflow: hidden;
  box-shadow: 0 24px 60px rgba(0,0,0,.32); }
.kwsc-bar { display: flex; align-items: center; justify-content: space-between; padding: 15px 22px; border-bottom: 1px solid #e4decf; flex: 0 0 auto; }
.kwsc-bar h2 { margin: 0; font-size: 19px; font-weight: 800; color: #15140f; }
#close-size-chart-x { font-size: 27px; line-height: 1; font-weight: 700; cursor: pointer; color: #8a877f; padding: 0 4px; }
#close-size-chart-x:hover { color: #15140f; }
.kwsc-body { padding: 20px 22px 26px; overflow-y: auto; flex: 1 1 auto; }
.kwsc-lead { font-size: 14.5px; line-height: 1.6; color: #5c574c; margin: 0 0 16px; }
.kwsc-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.kwsc-table { width: 100%; border-collapse: collapse; font-size: 15px; }
.kwsc-table th[scope="col"] { background: #f4f0e7 !important; color: #15140f !important; font-weight: 800; text-align: left; padding: 12px 14px; white-space: nowrap; border-bottom: 2px solid #d2632e; }
.kwsc-table th[scope="col"]:first-child { border-top-left-radius: 8px; }
.kwsc-table th[scope="col"]:last-child { border-top-right-radius: 8px; }
.kwsc-table th[scope="row"] { text-align: left; font-weight: 800; padding: 12px 14px; white-space: nowrap; }
.kwsc-table td { padding: 12px 14px; color: #5c574c; white-space: nowrap; }
.kwsc-table tbody tr { border-bottom: 1px solid #e4decf; }
.kwsc-table tbody tr:nth-child(odd) { background: #faf7f0; }
.kwsc-us { display: block; font-size: 11.5px; font-weight: 600; color: #8a877f; letter-spacing: .02em; }
.kwsc-how h3 { font-size: 16px; font-weight: 800; margin: 0 0 10px; }
.kwsc-how ol { margin: 0; padding-left: 20px; }
.kwsc-how li { font-size: 14.5px; line-height: 1.6; color: #5c574c; margin-bottom: 7px; }
.kwsc-note { font-size: 13px; color: #8a877f; font-style: italic; margin: 12px 0 0; }
@media (max-width: 560px) {
  #custom-size-chart-modal.kwsc { padding: 12px; }
  .kwsc-box { max-height: 88vh; }
  .kwsc-body { padding: 16px 16px 22px; }
  .kwsc-table { font-size: 14px; }
  .kwsc-table th[scope="col"], .kwsc-table th[scope="row"], .kwsc-table td { padding: 10px 10px; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("custom-size-chart-modal");
  if (!modal) return;

  function open(e) { if (e) e.preventDefault(); modal.classList.add("show"); document.body.style.overflow = "hidden"; }
  function close() { modal.classList.remove("show"); document.body.style.overflow = ""; }

  document.addEventListener("click", function (e) {
    if (e.target.closest("#open-size-chartCustom, #open-size-chart, #open-size-chart-secondary, .js-open-size-chart, .gck-size-link")) { open(e); return; }
    if (e.target.closest("#close-size-chart-x")) { close(); }
  });
  modal.addEventListener("click", function (e) { if (e.target === modal) close(); });
  document.addEventListener("keydown", function (e) { if (e.key === "Escape") close(); });

});
</script>
