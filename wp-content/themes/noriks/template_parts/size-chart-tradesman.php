<?php
/**
 * Tablica velicina (modal) za NORIKS Tradesman (orto-tradesman) — SK. Kopija HR size-chart-tabela.php, podatki iz noriks_tradesman_sizes().
 *
 * VAZNO: id #custom-size-chart-modal i klasa .show su ugovor koji ocekuje vticnik (orto-product.php).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$noriks_st = array(
    'uvod'    => 'Veľkosť vyberte podľa svojej <strong>veľkosti obuvi (EU)</strong>.',
    'glava'   => array( 'Veľkosť obuvi (EU)' ),
    'vrstice' => function_exists( 'noriks_tradesman_sizes' ) ? noriks_tradesman_sizes() : array(),
    'opomba'  => 'Ste medzi dvoma veľkosťami? Zoberte väčšiu.',
);
?>
<div id="custom-size-chart-modal" class="kwsc" role="dialog" aria-modal="true" aria-labelledby="kwsc-title">
  <div class="kwsc-box">
  <div class="kwsc-bar">
    <h2 id="kwsc-title">Tabuľka veľkostí</h2>
    <span id="close-size-chart-x" role="button" tabindex="0" aria-label="Zavrieť">&times;</span>
  </div>

  <div class="kwsc-body">
    <p class="kwsc-lead"><?php echo wp_kses_post( $noriks_st['uvod'] ); ?></p>

    <div class="kwsc-scroll">
      <table class="kwsc-table">
        <thead>
          <tr><?php foreach ( $noriks_st['glava'] as $h ) : ?><th scope="col"><?php echo esc_html( $h ); ?></th><?php endforeach; ?></tr>
        </thead>
        <tbody>
          <?php foreach ( $noriks_st['vrstice'] as $r ) : $r = array_slice( array_values( $r ), 0, count( $noriks_st['glava'] ) ); ?>
          <tr><th scope="row"><?php echo esc_html( array_shift( $r ) ); ?></th>
              <?php foreach ( $r as $c ) : ?><td><?php echo esc_html( $c ); ?></td><?php endforeach; ?></tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="kwsc-how">
      <?php if ( $noriks_st['opomba'] ) : ?><p class="kwsc-note"><?php echo esc_html( $noriks_st['opomba'] ); ?></p><?php endif; ?>
      <p class="kwsc-note">Ak vám veľkosť nesedí, máte 30 dní na vrátenie alebo výmenu.</p>
    </div>
  </div>
  </div>
</div>

<style>
#custom-size-chart-modal.kwsc {
  display: none; position: fixed; inset: 0; z-index: 9999999;
  background: rgba(30,22,14,.7); align-items: center; justify-content: center; padding: 20px;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; color: #2e241c;
}
#custom-size-chart-modal.kwsc.show { display: flex; }
#custom-size-chart-modal.kwsc * { box-sizing: border-box; }
.kwsc-box { background: #fff; border-radius: 14px; width: 100%; max-width: 720px;
  max-height: min(800px, 88vh); display: flex; flex-direction: column; overflow: hidden;
  box-shadow: 0 24px 60px rgba(0,0,0,.32); }
.kwsc-bar { display: flex; align-items: center; justify-content: space-between; padding: 15px 22px; border-bottom: 1px solid #eadccb; flex: 0 0 auto; }
.kwsc-bar h2 { margin: 0; font-size: 19px; font-weight: 700; color: #2e241c; }
#close-size-chart-x { font-size: 27px; line-height: 1; font-weight: 700; cursor: pointer; color: #7a6b5e; padding: 0 4px; }
#close-size-chart-x:hover { color: #2e241c; }
.kwsc-body { padding: 20px 22px 26px; overflow-y: auto; flex: 1 1 auto; }
.kwsc-img { display: block; width: 100%; max-width: 420px; height: auto; margin: 0 auto 14px; border-radius: 8px; }
.kwsc-lead { font-size: 14.5px; line-height: 1.6; color: #54483e; margin: 0 0 16px; }
.kwsc-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 20px; }
.kwsc-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.kwsc-table th[scope="col"] { background: #f5ebdf !important; color: #2e241c !important; font-weight: 700; text-align: left; padding: 12px 12px; white-space: nowrap; border-bottom: 2px solid #9e7446; }
.kwsc-table th[scope="col"]:first-child { border-top-left-radius: 8px; }
.kwsc-table th[scope="col"]:last-child { border-top-right-radius: 8px; }
.kwsc-table th[scope="row"] { text-align: left; font-weight: 700; padding: 11px 12px; white-space: nowrap; vertical-align: top; }
.kwsc-table td { padding: 11px 12px; color: #54483e; vertical-align: top; line-height: 1.5; }
.kwsc-table td.kwsc-nw { white-space: nowrap; font-weight: 600; color: #2e241c; }
.kwsc-table tbody tr { border-bottom: 1px solid #eadccb; }
.kwsc-table tbody tr:nth-child(odd) { background: #fcf8f3; }
.kwsc-how h3 { font-size: 16px; font-weight: 700; margin: 0 0 10px; }
.kwsc-how ol { margin: 0; padding-left: 20px; }
.kwsc-how li { font-size: 14.5px; line-height: 1.6; color: #54483e; margin-bottom: 7px; }
.kwsc-note { font-size: 13px; color: #7a6b5e; font-style: italic; margin: 12px 0 0; }
@media (max-width: 560px) {
  #custom-size-chart-modal.kwsc { padding: 12px; }
  .kwsc-box { max-height: 88vh; }
  .kwsc-body { padding: 16px 16px 22px; }
  .kwsc-table { font-size: 13px; }
  .kwsc-table th[scope="col"], .kwsc-table th[scope="row"], .kwsc-table td { padding: 9px 8px; }
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
