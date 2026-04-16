<?php
	if( isset($_GET['type']) && $_GET['type'] == 'loading_tracking' ) {
?>
	<table class="econt-colorbox-table">
	<?php if(isset($_GET['error'])){ ?>
	<tr><td><font color="red"><?php echo tr($_GET['lang'] . '_error'); ?></font></td><td><font color="red"><?php echo $_GET['error'] ?></font></td><tr>
	<?php }else{ ?>
  <thead>
    <tr>
      <td colspan='5'><strong><?php echo tr($_GET['lang'] . '_trackingloadinnum'); ?> <?php echo $_GET['loading_num'];?></strong></td>
    </tr>
    <tr>
      <td><?php echo tr($_GET['lang'] . '_time'); ?></td>
      <td><?php echo tr($_GET['lang'] . '_isreceipt'); ?></td>
      <td><?php echo tr($_GET['lang'] . '_event'); ?></td>
      <td><?php echo tr($_GET['lang'] . '_name'); ?></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $lang_sufix = '_en';
    if($_GET['lang'] == 'bg'){
      $lang_sufix = '';
    }
	$i = 0;
	while($i < 50){
    	if(!isset($_GET['tracking'][$i]))
    		break;
    	?>
    <tr>
    	<td><?php echo $_GET['tracking'][$i]['time'][0]; ?></td>
    	<td><?php echo is_receipt_text($_GET['tracking'][$i]['is_receipt'][0], $_GET['lang']); ?></td>
		<td><?php echo $_GET['tracking'][$i]['event'][0]; ?></td>
		<td><?php echo $_GET['tracking'][$i]['name' . $lang_sufix][0]; ?></td>
	<tr>
	<?php 
	$i++;
	} ?>
  </tbody>
</table>
<?php } ?>

<?php }else{ ?>
<h1><?php echo tr($_GET['lang'] . '_invaliddata'); ?></h1>
<?php } 

function is_receipt_text($is_receipt, $lang){
  if(empty($is_receipt)){
    return tr($lang . '_no');
  }
  return tr($lang . '_yes');
}
function tr($string){
      $translations = array(
      //Bulgarian
      'bg_error' => 'ГРЕШКА:',
      'bg_trackingloadinnum' => 'Проследяване на пратка №:',
      'bg_time' => 'Време на събитието',
      'bg_isreceipt' => 'Движение на обратна разписка ли е',
      'bg_event' => 'Събитие',
      'bg_name' => 'Име',
      'bg_invaliddata' => 'Невалидни данни!',
      'bg_yes' => 'Да',
      'bg_no' => 'Не',

      //English
      'en_error' => 'ERROR:',
      'en_trackingloadinnum' => 'Shipment tracking - waybill No:',
      'en_time' => 'Time',
      'en_isreceipt' => 'Is it a return receipt movement',
      'en_event' => 'Event',
      'en_name' => 'Name',
      'en_invaliddata' => 'Invalid data!',
      'en_yes' => 'Yes',
      'en_no' => 'No',

    );

    if(!empty($translations[$string])){
      $translated_string = $translations[$string];
    }else{
      $s = explode('_', $string);
      $translated_string = $translations['bg_' . $s[1]];
    }

    return $translated_string;

    }