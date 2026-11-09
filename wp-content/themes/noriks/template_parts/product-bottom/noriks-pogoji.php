<?php
/**
 * Skupna sekcija "Uz NORIKS kupujete bez rizika" za vse izdelke.
 * Vkljuci jo why-<izdelek>.php znotraj svoje <section> (ozadje doloci why datoteka):
 *   <?php $npg = array( 'izdelek' => 'NORIKS X', 'barva' => '#rrggbb' ); include __DIR__ . '/noriks-pogoji.php'; ?>
 * barva = BARVA ORIGINALA izdelka; svetel ton kroga ikone in temnejsi ton poudarka se izracunata sama.
 */
if ( ! function_exists( 'noriks_pogoji_mesaj' ) ) {
	function noriks_pogoji_mesaj( $hex, $cilj, $delez ) {
		$hex = ltrim( $hex, '#' );
		$out = '#';
		for ( $i = 0; $i < 3; $i++ ) {
			$v    = hexdec( substr( $hex, $i * 2, 2 ) );
			$out .= sprintf( '%02x', (int) round( $v + ( $cilj - $v ) * $delez ) );
		}
		return $out;
	}
}

$npg         = isset( $npg ) && is_array( $npg ) ? $npg : array();
$npg_izdelek = ! empty( $npg['izdelek'] ) ? $npg['izdelek'] : 'NORIKS';
$npg_barva   = ! empty( $npg['barva'] ) && preg_match( '/^#[0-9a-fA-F]{6}$/', $npg['barva'] ) ? strtolower( $npg['barva'] ) : '#7b766f';
$npg_rgb     = array_map( 'hexdec', str_split( ltrim( $npg_barva, '#' ), 2 ) );
$npg_svetlo  = ( 0.2126 * $npg_rgb[0] + 0.7152 * $npg_rgb[1] + 0.0722 * $npg_rgb[2] ) / 255;
// svetle barve (rumena, bez) potemnimo, da sta ikona in poudarek berljiva
$npg_ink     = $npg_svetlo > 0.5 ? noriks_pogoji_mesaj( $npg_barva, 0, 0.45 ) : $npg_barva;
$npg_krog    = noriks_pogoji_mesaj( $npg_barva, 255, 0.86 );
$npg_svg     = '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">';
$npg_el      = array(
	array( '<path d="M4 12a8 8 0 1 0 2.4-5.7"/><path d="M4 4v4.5h4.5"/><path d="M12 8v4l2.6 2"/>', '30 dní', 'na vrátenie peňazí' ),
	array( '<path d="M2.5 6.5h11v9h-11z"/><path d="M13.5 9.5h4l3 3.2v2.8h-7"/><circle cx="7" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>', 'Doprava zadarmo', 'nad 70 €' ),
	array( '<rect x="2.5" y="6" width="19" height="12" rx="2"/><circle cx="12" cy="12" r="2.6"/><path d="M6 9.5v5M18 9.5v5"/>', 'Platba na dobierku', 'zaplatíte, keď príde balík' ),
	array( '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.6"/><path d="M16 14.2c2.9.3 5 2.8 5 5.8"/>', '120 000 zákazníkov', 'priemerné hodnotenie 4,8' ),
);
?>
<div class="npg" style="--npg-ink:<?php echo esc_attr( $npg_ink ); ?>;--npg-krog:<?php echo esc_attr( $npg_krog ); ?>">
	<div class="npg__kicker">Nakupujte bez obáv</div>
	<h2 class="npg__h2">S NORIKS nakupujete <em>bez rizika</em></h2>
	<p class="npg__p">Vyskúšajte <?php echo esc_html( $npg_izdelek ); ?> doma – 30 dní na vrátenie, bez otázok.</p>
	<div class="npg__red">
		<?php foreach ( $npg_el as $e ) : ?>
		<div class="npg__k"><span class="npg__i"><?php echo $npg_svg . $e[0]; ?></svg></span><strong><?php echo esc_html( $e[1] ); ?></strong><span class="npg__s"><?php echo esc_html( $e[2] ); ?></span></div>
		<?php endforeach; ?>
	</div>
</div>
<?php if ( empty( $GLOBALS['noriks_pogoji_css'] ) ) : $GLOBALS['noriks_pogoji_css'] = true; ?>
<style>
section.npg-s{padding:52px 0 !important}
.npg{width:100%;max-width:1240px;margin:0 auto;padding:0 24px;box-sizing:border-box;text-align:center}
.npg__kicker{display:inline-flex;align-items:center;gap:10px;font-size:12.5px;font-weight:700;letter-spacing:1.8px;text-transform:uppercase;color:#6b6b6b;margin:0 0 8px}
.npg__kicker::before{content:"";width:22px;height:2px;border-radius:2px;background:var(--npg-ink)}
.npg__h2{font-size:clamp(24px,3vw,32px);font-weight:800;line-height:1.2;margin:0 0 10px;color:#1c1c1c}
.npg__h2 em{font-style:italic;color:var(--npg-ink)}
.npg__p{font-size:15.5px;line-height:1.6;color:#444;margin:0 auto 26px;max-width:60ch}section.npg-s .npg__p{margin:0 auto 26px !important;text-align:center}
.npg__red{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:18px}
.npg__k{background:#fff;border-radius:16px;box-shadow:0 6px 20px rgba(0,0,0,.07);padding:22px 14px;display:flex;flex-direction:column;align-items:center;gap:4px;transition:transform .2s,box-shadow .2s;min-width:0}
.npg__k:hover{transform:translateY(-3px);box-shadow:0 12px 26px rgba(0,0,0,.10)}
.npg__i{width:46px;height:46px;border-radius:50%;background:var(--npg-krog);color:var(--npg-ink);display:flex;align-items:center;justify-content:center;margin:0 0 8px}
.npg__i svg{width:22px;height:22px}
.npg__k strong{font-size:16px;font-weight:800;color:#1c1c1c;line-height:1.3}
.npg__s{font-size:13.5px;color:#6b6b6b;line-height:1.4}
@media (max-width:767px){section.npg-s{padding:40px 0 !important}.npg{padding:0 16px}.npg__red{grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}.npg__k{padding:18px 10px}.npg__k strong{font-size:15px}}
</style>
<?php endif; ?>
