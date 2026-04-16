<?php 
switch ($order->get_meta( 'Econt_Shipping_To', true )) {
    case 'DOOR':
        $shipping_to_text = __('Door', 'woocommerce-econt');
        break;
    case 'OFFICE':
        $shipping_to_text = __('Office', 'woocommerce-econt');
        break;
    case 'MACHINE':
        $shipping_to_text = __('APS', 'woocommerce-econt');
        break;
    
    default:
        $shipping_to_text = '';
        break;
}
?>

<table class="econt-table">

 <caption><a href="#" class="edit_econt_address">Edit</a></caption>
<thead>
    <tr>
    <th scope="col" colspan="2"><?php 
    /* translators: shipping to text  */
    printf( __( 'Econt Express shipping to %s', 'woocommerce-econt' ), $shipping_to_text ); 
    ?></th>
    </tr>
    </thead>
    <tbody>

<?php if($order->get_meta( 'Econt_Shipping_To', true ) == 'OFFICE') { ?>
<!--//Econt Express Office-->
    <tr><td data-label=""><strong><?php _e('Town', 'woocommerce-econt') ?>:</strong></td><td data-label=" "> <?php echo $order->get_meta( 'Econt_Office_Town', true ) ?></td></tr>
<tr><td data-label=""><strong><?php _e('Office', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $office['name'] . __(' address: ', 'woocommerce-econt') . $office['address'] ?></td></tr>
 <tr><td data-label=""><strong><?php _e('Postcode', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Office_Postcode', true ) ?></td></tr>

<?php }elseif($order->get_meta( 'Econt_Shipping_To', true ) == 'MACHINE'){ ?>
 <!--//Econt Express APS-->
	<tr><td data-label=""><strong><?php _e('Town', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Machine_Town', true ) ?></td></tr>
    <tr><td data-label=""><strong><?php _e('APS', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $machine['name'] . __(' address: ', 'woocommerce-econt') . $machine['address'] ?></td></tr>
    <tr><td data-label=""><strong><?php _e('Postcode', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Machine_Postcode', true ) ?></td></tr>
  
    <?php }elseif($order->get_meta( 'Econt_Shipping_To', true ) == 'DOOR') { ?>    
    <!--//Econt Express Door-->
    <tr><td data-label=""><strong><?php _e('Town', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_Town', true ) ?> </td></tr>
    <tr><td data-label=""><strong><?php _e('Postcode', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_Postcode', true ) ?> </td></tr>
    <?php if(!empty($order->get_meta( 'Econt_Door_Quarter', true )) || !empty($order->get_meta( 'Econt_Door_Quarter_Intl', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Quarter', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Quarter_Intl', true ) : $order->get_meta( 'Econt_Door_Quarter', true ) ?></td></tr>
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_building_num', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Building num', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_building_num', true ) ?> </td></tr>
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_Street', true )) || !empty($order->get_meta( 'Econt_Door_Street_Intl', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Street', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Street_Intl', true ) : $order->get_meta( 'Econt_Door_Street', true ) ?> </td></tr> 
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_street_num', true ))){ ?>  
    <tr><td data-label=""><strong><?php _e('Street num', 'woocommerce-econt') ?>:</strong></strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_street_num', true ) ?></td></tr>
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_Entrance_num', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Entrance num', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_Entrance_num', true ) ?></td></tr>
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_Apartment_num', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Floor num', 'woocommerce-econt') ?>':</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_Floor_num', true ) ?></td></tr>
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_Apartment_num', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Apartment num', 'woocommerce-econt') ?>':</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_Apartment_num', true ) ?></td></tr>
    <?php } ?>
    <?php if(!empty($order->get_meta( 'Econt_Door_Other', true ))){ ?>
    <tr><td data-label=""><strong><?php _e('Notes', 'woocommerce-econt') ?>:</strong></td><td data-label=""><?php echo $order->get_meta( 'Econt_Door_Other', true ) ?></td></tr>
    <?php } ?>

    <?php  } ?>
    </tbody></table>





<div id="econt_edit_receiver_address" style="display: none;">
<script type="text/javascript"> 
	var sender_city_id = "";
	var order_id = "<?php echo $order->get_id(); ?>"; 
	var loading_is_imported = "<?php echo $loading_is_imported; ?>";
</script>
<p class="form-row econt_shipping_to form-row-wide validate-required woocommerce-validated" id="econt_shipping_to_field" data-priority=""><label for="econt_shipping_to" class=""><strong><?php _e('Shipping to', 'woocommerce-econt') ?></strong><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_shipping_to" id="econt_shipping_to" class="select " data-placeholder="<?php _e('Shipping to', 'woocommerce-econt') ?>">
<option value="0"><?php _e('please select...', 'woocommerce-econt') ?></option>
<?php if($econt_options['send_to_door'] == 1){ ?>
<option value="DOOR"><?php _e('to door', 'woocommerce-econt') ?></option>
<?php }
if($econt_options['send_to_office'] == 1){ ?>
<option value="OFFICE"><?php _e('to office', 'woocommerce-econt') ?></option>
<?php }
if($econt_options['send_to_machine'] == 1){ ?>
<option value="MACHINE"><?php _e('to APS', 'woocommerce-econt') ?></option>
<?php } ?>
</select>
</span></p>
<p class="form-row econt_shipping_to_office form-row-wide validate-required" id="econt_offices_town_field" data-priority=""><label for="econt_offices_town" class=""><?php _e('Town', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select class="select "  name="econt_offices_town" id="econt_offices_town" data-placeholder="<?php _e('Enter your town', 'woocommerce-econt') ?>"></select>
</span></p>
<p class="form-row econt_shipping_post_code validate-required" id="econt_offices_postcode_field" data-priority=""><label for="econt_offices_postcode" class=""><?php _e('p.c.', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_offices_postcode" id="econt_offices_postcode" placeholder="<?php _e('p.c.', 'woocommerce-econt') ?>" value="">
</span></p>
<p class="form-row econt_shipping_to_office form-row-wide validate-required" id="econt_offices_field" data-priority=""><label for="econt_offices" class=""><?php  _e('Office', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_offices" id="econt_offices" class="select " data-placeholder="<?php _e('Select office', 'woocommerce-econt') ?>">
<option value="0"><?php _e('please select...', 'woocommerce-econt') ?></option>
</select></span></p>
<div class="econt_office_locator_map" id="econt_offices_map" style="height: 400px;"></div>
<p class="form-row econt_shipping_to_machine form-row-wide validate-required" id="econt_machines_town_field" data-priority=""><label for="econt_machines_town" class=""><?php _e('Town', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select class="select " name="econt_machines_town" id="econt_machines_town" data-placeholder="<?php _e('Enter your town', 'woocommerce-econt') ?>"></select>
</span></p>
<p class="form-row econt_shipping_post_code validate-required" id="econt_machines_postcode_field" data-priority=""><label for="econt_machines_postcode" class=""><?php _e('p.c.', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_machines_postcode" id="econt_machines_postcode" placeholder="<?php _e('p.c.', 'woocommerce-econt') ?>" value=""></span></p>
<p class="form-row econt_shipping_to_machine form-row-wide validate-required" id="econt_machines_field" data-priority=""><label for="econt_machines" class=""><?php _e('Office', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper">
<select name="econt_machines" id="econt_machines" class="select " data-placeholder="<?php _e('Select office', 'woocommerce-econt') ?>">
<option value="0"><?php _e('please select...', 'woocommerce-econt') ?></option>
</select>
</span></p>
<div class="econt_office_locator_map" id="econt_machines_map" style="height: 400px;"></div>
<p class="form-row econt_shipping_to_door form-row-wide validate-required woocommerce-validated" id="econt_door_town_field" data-priority=""><label for="econt_door_town" class=""><?php _e('Town', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select class="select " name="econt_door_town" id="econt_door_town" data-placeholder="<?php _e('Enter your town', 'woocommerce-econt') ?>"></select>
</span></p>

<p class="form-row econt_shipping_post_code validate-required" id="econt_door_postcode_field" data-priority=""><label for="econt_door_postcode" class=""><?php _e('p.c.', 'woocommerce-econt') ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_postcode" id="econt_door_postcode" placeholder="<?php _e('p.c.', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row econt_shipping_to_door form-row-first" id="econt_door_street_field" data-priority=""><label for="econt_door_street" class=""><?php _e('Street', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><select class="select " name="econt_door_street" id="econt_door_street" data-placeholder="<?php _e('Enter your street', 'woocommerce-econt') ?>"></select>
</span></p>
<p class="form-row econt_shipping_to_door form-row-first" id="econt_door_street_intl_field" data-priority=""><label for="econt_door_street_intl" class=""><?php _e('Street', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_intl" id="econt_door_street_intl" placeholder="<?php _e('Enter your street', 'woocommerce-econt') ?>"></span></p>
<p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_num_field" data-priority=""><label for="econt_door_street_num" class=""><?php _e('str. num.:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_num" id="econt_door_street_num" placeholder="<?php _e('street num', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row econt_shipping_to_door form-row-first" id="econt_door_quarter_field" data-priority=""><label for="econt_door_quarter" class=""><?php _e('Quarter (Please, start typing and select from results.)', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><select class="select " name="econt_door_quarter" id="econt_door_quarter" data-placeholder="<?php _e('Enter your quarter', 'woocommerce-econt') ?>"></select>
</span></p>
<p class="form-row econt_shipping_to_door form-row-first" id="econt_door_quarter_intl_field" data-priority=""><label for="econt_door_quarter_intl" class=""><?php _e('Quarter', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_quarter_intl" id="econt_door_quarter_intl" placeholder="<?php _e('Enter your quarter', 'woocommerce-econt') ?>"></span></p>
<p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_bl_field" data-priority=""><label for="econt_door_street_bl" class=""><?php _e('bl. num.:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_bl" id="econt_door_street_bl" placeholder="<?php _e('blok num', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row econt_shipping_to_door form-row-first" id="econt_door_street_vh_field" data-priority=""><label for="econt_door_street_vh" class=""><?php _e('entr. num.:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_vh" id="econt_door_street_vh" placeholder="<?php _e('entr. num', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_et_field" data-priority=""><label for="econt_door_street_et" class=""><?php _e('fl. num.:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_et" id="econt_door_street_et" placeholder="<?php _e('fl. num', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_ap_field" data-priority=""><label for="econt_door_street_ap" class=""><?php _e('ap. num.:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_ap" id="econt_door_street_ap" placeholder="<?php _e('ap. num', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row econt_shipping_to_door form-row-wide" id="econt_door_other_field" data-priority=""><label for="econt_door_other" class=""><?php _e('If your address is not in the list please type it here:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_other" id="econt_door_other" placeholder="<?php _e('Enter other adress info', 'woocommerce-econt') ?>">
</span></p>
<p class="form-row form-row-wide econt_clear">
<input type="hidden" class="" name="econt_total_shipping_cost" id="econt_total_shipping_cost" placeholder="" value="">
<input type="hidden" class="" name="econt_customer_shipping_cost" id="econt_customer_shipping_cost" placeholder="" value="">
<a href="javascript:void(0);" class="econt_save_receiver_address button-primary button" id="save_receiver_address" title="<?php _e('save address','woocommerce-econt') ?>"><?php _e('update address','woocommerce-econt') ?></a>
</p>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        setTimeout(function(){
            jQuery(".select2-container").css("width", "100%");
        }, 500);
        jQuery('.econt_office_locator_map').hide();
    });
</script>