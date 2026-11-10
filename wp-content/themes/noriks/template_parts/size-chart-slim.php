<?php
/**
 * Tablica velicina za NORIKS Slim (orto-slim) — oblikujuce gacice visokog struka — trg SK.
 * Podatki iz slike tablice (slm-15-tablica-velicina.jpg): Velicina / EU velicina / Opseg struka,
 * izvor tabele je noriks_slim_sizes() v functions/product-type.php (isti kot v akordeonu).
 *
 * VAZNO: id #custom-size-chart-modal i klasa .show su ugovor koji ocekuje vticnik
 * (orto-product.php: openBtn -> modal.classList.add("show"), zatvaranje na
 * #close-size-chart-x, na Escape i na klik kad je e.target === modal).
 * Zato je modal JEDAN prekrivni sloj (bez zasebnog backdropa) — klik na tamnu
 * pozadinu zadene sam modal, pa ga zatvore oba handlera.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div id="custom-size-chart-modal" class="kwsc" role="dialog" aria-modal="true" aria-labelledby="kwsc-title">
  <div class="kwsc-box">
  <div class="kwsc-bar">
    <h2 id="kwsc-title">Таблица с размери</h2>
    <span id="close-size-chart-x" role="button" tabindex="0" aria-label="Затвори">&times;</span>
  </div>

  <div class="kwsc-body">
    <p class="kwsc-lead">Изберете размер според <strong>обиколката на талията</strong>, а не според обичайния размер облекло — след бременност или промяна в теглото тези два размера често не съвпадат. Ако сте между два размера, вземете <strong>по-големия</strong>.</p>

    <div class="kwsc-scroll">
      <table class="kwsc-table">
        <thead>
          <tr><th scope="col">Размер</th><th scope="col">EU размер</th><th scope="col">Обиколка на талията</th></tr>
        </thead>
        <tbody>
          <?php foreach ( noriks_slim_sizes() as $r ) : ?>
          <tr><th scope="row"><?php echo esc_html( $r[0] ); ?></th>
              <td><?php echo esc_html( $r[1] ); ?></td>
              <td><?php echo esc_html( $r[2] ); ?></td></tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="kwsc-how">
      <h3>Как да се измерите</h3>
      <ol>
        <li><strong>Намерете най-тясното място на тялото</strong> — обикновено малко над пъпа.</li>
        <li><strong>Обвийте метъра</strong> хоризонтално около тялото, прилепнало, но не стегнато.</li>
        <li><strong>Изберете реда</strong>, в който е вашата обиколка; ако сте между два реда, вземете по-големия размер.</li>
      </ol>
      <p class="kwsc-note">След раждане мерете над корема, не през най-широката му част.</p>
    </div>
  </div>
  </div>
</div>

<style>
#custom-size-chart-modal.kwsc {
  display: none; position: fixed; inset: 0; z-index: 9999999;
  background: rgba(20,14,18,.7); align-items: center; justify-content: center; padding: 20px;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #241c22;
}
#custom-size-chart-modal.kwsc.show { display: flex; }
#custom-size-chart-modal.kwsc * { box-sizing: border-box; }
.kwsc-box { background: #fff; border-radius: 14px; width: 100%; max-width: 640px;
  max-height: min(720px, 86vh); display: flex; flex-direction: column; overflow: hidden;
  box-shadow: 0 24px 60px rgba(0,0,0,.32); }
.kwsc-bar { display: flex; align-items: center; justify-content: space-between; padding: 15px 22px; border-bottom: 1px solid #f1e3ea; flex: 0 0 auto; }
.kwsc-bar h2 { margin: 0; font-size: 19px; font-weight: 800; color: #241c22; }
#close-size-chart-x { font-size: 27px; line-height: 1; font-weight: 700; cursor: pointer; color: #8b7b83; padding: 0 4px; }
#close-size-chart-x:hover { color: #241c22; }
.kwsc-body { padding: 20px 22px 26px; overflow-y: auto; flex: 1 1 auto; }
.kwsc-lead { font-size: 14.5px; line-height: 1.6; color: #6b5f66; margin: 0 0 16px; }
.kwsc-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.kwsc-table { width: 100%; border-collapse: collapse; font-size: 15px; }
.kwsc-table th[scope="col"] { background: #a3336b; color: #fff; font-weight: 700; text-align: left; padding: 12px 14px; white-space: nowrap; }
.kwsc-table th[scope="col"]:first-child { border-top-left-radius: 8px; }
.kwsc-table th[scope="col"]:last-child { border-top-right-radius: 8px; }
.kwsc-table th[scope="row"] { text-align: left; font-weight: 800; padding: 12px 14px; white-space: nowrap; }
.kwsc-table td { padding: 12px 14px; color: #46393f; white-space: nowrap; }
.kwsc-table tbody tr { border-bottom: 1px solid #f1e3ea; }
.kwsc-table tbody tr:nth-child(odd) { background: #fbf2f6; }
.kwsc-us { display: block; font-size: 11.5px; font-weight: 600; color: #a08d95; letter-spacing: .02em; }
.kwsc-how h3 { font-size: 16px; font-weight: 800; margin: 0 0 10px; }
.kwsc-how ol { margin: 0; padding-left: 20px; }
.kwsc-how li { font-size: 14.5px; line-height: 1.6; color: #56494f; margin-bottom: 7px; }
.kwsc-note { font-size: 13px; color: #8b7b83; font-style: italic; margin: 12px 0 0; }
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
