<?php
$user_id = get_current_user_id();
?>
<div class="econt_user_address">
<?php
$econt_options = get_option('econt_shipping_method_options');

if($econt_options['title_type'] == 'image'){
    echo '<img id="econt-title-image" src=' . $econt_options['title_image'] . '><a href="#" class="edit_econt_address">' . __('Edit', 'woocommerce-econt') . '</a>';
}else{
    echo '<h3 id="econt-title-text">' . $econt_options['title'] . '<a href="#" class="edit_econt_address">' . __('Edit', 'woocommerce-econt') . '</a></h3>'; 
}

$getoffice = new Econt_mySQL;
$office_code = get_user_meta($user_id, 'Econt_Office', true);
$office = $getoffice->getOfficeByOfficeCode($office_code);
                
$machine_code = get_user_meta($user_id, 'Econt_Machine', true);
$machine = $getoffice->getOfficeByOfficeCode($machine_code);

if (get_user_meta($user_id, 'Econt_Shipping_To', true) == 'OFFICE') { 
    echo __('Econt Town:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Office_Town', true) . '<br/>';
    echo __('Econt office:', 'woocommerce-econt') . ' ' . $office['name'] . ', ' . $office['address'] . '<br/>'; 
} elseif (get_user_meta($user_id, 'Econt_Shipping_To', true) == 'MACHINE') {
    echo __('Econt Town:', 'woocommerce-econt') . ' ' .get_user_meta($user_id, 'Econt_Machine_Town', true) . '<br/>';
    echo __('Econt APS:', 'woocommerce-econt') . ' ' .  $machine['name']  . ', ' . $machine['address']. '<br/>'; 
}elseif (get_user_meta($user_id, 'Econt_Shipping_To', true) == 'DOOR') {
    echo __('Econt Town:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Town', true) . '<br/>';
    echo __('Econt Postcode:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Postcode', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Quarter', true))
        echo __('Econt Quarter:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Quarter', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Street', true)) 
        echo __('Econt Street:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Street', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_building_num', true))
        echo __('Econt Building Num.:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_building_num', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_street_num', true))
        echo __('Econt Street Num.:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_street_num', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Entrance_num', true))
         echo __('Econt Entrance:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Entrance_num', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Floor_num', true))
        echo __('Econt Floor:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Floor_num', true) . '<br/>'; 
    if(get_user_meta($user_id, 'Econt_Door_Apartment_num', true))
        echo __('Econt Apartment:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Apartment_num', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Other', true))
        echo __('Econt Other:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Other', true) . '<br/>';
}
//end of mrejanet mod 
?>
</div>
<div id="econt_edit_user_address" style="display: none;">
    <?php
    if($econt_options['title_type'] == 'image'){
        echo '<img id="econt-title-image" src="' . $econt_options['title_image'] . '"><a href="#" class="edit_econt_address">' . __('Edit', 'woocommerce-econt') . '</a>';
    }else{
        echo '<h3 id="econt-title-text">' . $econt_options['title'] . '<a href="#" class="edit_econt_address">' . __('Edit', 'woocommerce-econt') . '</a></h3>'; 
    }
    if($econt_options['show_checkout_country_field'] == 1){
        $customer = new WC_Customer( $user_id );
        $customer_billing_country_code = $customer->get_billing_country();
        woocommerce_form_field( '_billing_country', array( 'name' => '_billing_country', 'type' => 'country', 'default' => $customer_billing_country_code ) );
    }
    ?>

    <?php
    $hide_shipping_to_select = '';
    if($econt_options['shipping_to_style'] == 'buttons' || $econt_options['shipping_to_style'] == 'icons'){
        $hide_shipping_to_select = 'econt_hide';
    ?>
    <p class="form-row econt_shipping_to form-row-wide validate-required" id="econt_shipping_to_buttons_field" data-priority=""><label for="econt_shipping_to_buttons_DOOR" class=""><?php echo __('Shipping to', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper">
        <?php if($econt_options['send_to_door'] == 1){ ?>
            <input type="radio" class="input-radio speedy_shipping_to_input" value="DOOR" name="econt_shipping_to_buttons" id="econt_shipping_to_buttons_DOOR"><label for="econt_shipping_to_buttons_DOOR" class="radio "><?php echo __('to door', 'woocommerce-econt') ?></label>
        <?php }

        if($econt_options['send_to_office'] == 1){ ?>
            <input type="radio" class="input-radio speedy_shipping_to_input" value="OFFICE" name="econt_shipping_to_buttons" id="econt_shipping_to_buttons_OFFICE"><label for="econt_shipping_to_buttons_OFFICE" class="radio "><?php echo __('to office', 'woocommerce-econt') ?></label>
        <?php }  

        if($econt_options['send_to_door'] == 1){ ?>
            <input type="radio" class="input-radio speedy_shipping_to_input" value="MACHINE" name="econt_shipping_to_buttons" id="econt_shipping_to_buttons_MACHINE"><label for="econt_shipping_to_buttons_MACHINE" class="radio "><?php echo __('to APS', 'woocommerce-econt') ?></label>
        <?php } ?>
    </span></p>

    <?php } 
    ?>

    <p class="form-row econt_shipping_to <?php echo $hide_shipping_to_select;?> form-row-wide validate-required" id="econt_shipping_to_field" data-priority=""><label for="econt_shipping_to" class=""><?php echo __('Shipping to', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_shipping_to" id="econt_shipping_to" class="select " data-placeholder="Изпращане до">
    <option value="0"><?php echo __('please select...', 'woocommerce-econt') ?></option>
    <?php if($econt_options['send_to_door'] == 1){ ?>
    <option value="DOOR"><?php echo __('to door', 'woocommerce-econt') ?></option>
    <?php 
    }
    if($econt_options['send_to_office'] == 1){
    ?>
    <option value="OFFICE"><?php echo __('to office', 'woocommerce-econt') ?></option>
    <?php 
    }
    if($econt_options['send_to_machine'] == 1){
    ?>
    <option value="MACHINE"><?php echo __('to APS', 'woocommerce-econt') ?></option>
    <?php } ?>
    </select></p>

    <p class="form-row econt_shipping_to_office form-row-wide validate-required tooltipstered" id="econt_offices_town_field" data-priority=""><label for="econt_offices_town" class=""><?php echo __('Town (Please, start typing and select from results.)', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_offices_town" id="econt_offices_town" class="select select2-hidden-accessible" data-placeholder="<?php echo __('Enter your town', 'woocommerce-econt') ?>" data-select2-id="econt_offices_town" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="4"><?php echo __('Enter your town', 'woocommerce-econt') ?></option>
    </select></p>
    <p class="form-row econt_shipping_post_code form-row-wide validate-required" id="econt_offices_postcode_field" data-priority=""><label for="econt_offices_postcode" class="">п.к.&nbsp;<abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_offices_postcode" id="econt_offices_postcode" placeholder="п.к." value=""></span></p>
    <p class="form-row econt_shipping_to_office form-row-wide validate-required" id="econt_offices_field" data-priority=""><label for="econt_offices" class=""><?php echo __('Office', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_offices" id="econt_offices" class="select select2-hidden-accessible" data-placeholder="Изберете Офис" data-select2-id="econt_offices" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="2"><?php echo __('please select...', 'woocommerce-econt') ?></option>
    </select></p>
    <div class="econt_office_locator_map" id="econt_offices_map"></div>
    <p class="form-row econt_shipping_to_machine form-row-wide validate-required tooltipstered" id="econt_machines_town_field" data-priority=""><label for="econt_machines_town" class=""><?php echo __('Town (Please, start typing and select from results.)', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_machines_town" id="econt_machines_town" class="select select2-hidden-accessible" data-placeholder="<?php echo __('Enter your town', 'woocommerce-econt') ?>" data-select2-id="econt_machines_town" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="8"><?php echo __('Enter your town', 'woocommerce-econt') ?></option>
    </select></p>
    <p class="form-row econt_shipping_post_code form-row-wide validate-required" id="econt_machines_postcode_field" data-priority=""><label for="econt_machines_postcode" class=""><?php echo __('p.c.', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_machines_postcode" id="econt_machines_postcode" placeholder="<?php echo __('p.c.', 'woocommerce-econt') ?>" value=""></span></p><p class="form-row econt_shipping_to_machine form-row-wide validate-required" id="econt_machines_field" data-priority=""><label for="econt_machines" class=""><?php echo __('APS', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_machines" id="econt_machines" class="select select2-hidden-accessible" data-placeholder="<?php echo __('Select APS', 'woocommerce-econt') ?>" data-select2-id="econt_machines" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="6"><?php echo __('please select...', 'woocommerce-econt') ?></option>
    </select></p>            
    <div class="econt_office_locator_map" id="econt_machines_map"></div>
    <p class="form-row econt_shipping_to_door form-row-wide validate-required tooltipstered" id="econt_door_town_field" data-priority=""><label for="econt_door_town" class=""><?php echo __('Town (Please, start typing and select from results.)', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_door_town" id="econt_door_town" class="select select2-hidden-accessible" data-placeholder="<?php echo __('Enter your town', 'woocommerce-econt') ?>" data-select2-id="econt_door_town" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="10"><?php echo __('Enter your town', 'woocommerce-econt') ?></option>
    </select></p>
    <p class="form-row econt_shipping_post_code form-row-wide validate-required" id="econt_door_postcode_field" data-priority=""><label for="econt_door_postcode" class=""><?php echo __('p.c.', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_postcode" id="econt_door_postcode" placeholder="<?php echo __('p.c.', 'woocommerce-econt') ?>" value=""></span></p><p class="form-row econt_shipping_to_door form-row-first validate-required tooltipstered" id="econt_door_street_field" data-priority=""><label for="econt_door_street" class=""><?php echo __('Street (Please, start typing and select from results.)', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><select name="econt_door_street" id="econt_door_street" class="select select2-hidden-accessible" data-placeholder="<?php echo __('Enter your street', 'woocommerce-econt') ?>" data-select2-id="econt_door_street" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="12"><?php echo __('Enter your street', 'woocommerce-econt') ?></option>
    </select></p>
    <p class="form-row econt_shipping_to_door form-row-first validate-required" id="econt_door_street_intl_field" data-priority=""><label for="econt_door_street_intl" class=""><?php echo __('Street name', 'woocommerce-econt') ?><abbr class="required" title="<?php echo __('required', 'woocommerce-econt') ?>">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text ui-autocomplete-input" name="econt_door_street_intl" id="econt_door_street_intl" placeholder="<?php echo __('Enter your street name', 'woocommerce-econt') ?>" value="" autocomplete="off"></span></p>
    <p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_num_field" data-priority=""><label for="econt_door_street_num" class=""><?php echo __('str. num.', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_num" id="econt_door_street_num" placeholder="<?php echo __('street num', 'woocommerce-econt') ?>" value="" autocomplete="disabled"></span></p>
    <p class="form-row econt_shipping_to_door form-row-first tooltipstered" id="econt_door_quarter_field" data-priority=""><label for="econt_door_quarter" class=""><?php echo __('Quarter (Please, start typing and select from results.)', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><select name="econt_door_quarter" id="econt_door_quarter" class="select select2-hidden-accessible" data-placeholder="<?php echo __('Enter your quarter', 'woocommerce-econt') ?>" data-select2-id="econt_door_quarter" tabindex="-1" aria-hidden="true">
    <option value="0" data-select2-id="14"><?php echo __('Econt Quarter:', 'woocommerce-econt') ?></option>
    </select></p>
    <p class="form-row econt_shipping_to_door form-row-first" id="econt_door_quarter_intl_field" data-priority=""><label for="econt_door_quarter_intl" class=""><?php echo __('Quarter name', 'woocommerce-econt') ?><span class="optional"><?php echo __('optional', 'woocommerce-econt') ?></span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text ui-autocomplete-input" name="econt_door_quarter_intl" id="econt_door_quarter_intl" placeholder="<?php echo __('Enter your quarter name', 'woocommerce-econt') ?>" value="" autocomplete="off"></span></p>
    <p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_bl_field" data-priority=""><label for="econt_door_street_bl" class=""><?php echo __('bl. num.', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_bl" id="econt_door_street_bl" placeholder="<?php echo __('blok num', 'woocommerce-econt') ?>" value="" autocomplete="disabled"></span></p>
    <p class="form-row econt_shipping_to_door form-row-first" id="econt_door_street_vh_field" data-priority=""><label for="econt_door_street_vh" class=""><?php echo __('entr. num.', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_vh" id="econt_door_street_vh" placeholder="<?php echo __('entr. num', 'woocommerce-econt') ?>" value="" autocomplete="disabled"></span></p>
    <p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_et_field" data-priority=""><label for="econt_door_street_et" class=""><?php echo __('fl. num.', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_et" id="econt_door_street_et" placeholder="<?php echo __('fl. num', 'woocommerce-econt') ?>" value="" autocomplete="disabled"></span></p>
    <p class="form-row econt_shipping_to_door form-row-last" id="econt_door_street_ap_field" data-priority=""><label for="econt_door_street_ap" class=""><?php echo __('ap. num.', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_street_ap" id="econt_door_street_ap" placeholder="ap. num" value="" autocomplete="disabled"></span></p>
    <p class="form-row econt_shipping_to_door form-row-wide" id="econt_door_other_field" data-priority=""><label for="econt_door_other" class=""><?php echo __('If your address is not in the list please type it here:', 'woocommerce-econt') ?></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="econt_door_other" id="econt_door_other" placeholder="<?php echo __('Enter other adress info', 'woocommerce-econt') ?>" value="" autocomplete="disabled"></span></p>
    <input type="hidden" class="" name="econt_total_shipping_cost" id="econt_total_shipping_cost" placeholder="" value="">
    <input type="hidden" class="" name="econt_customer_shipping_cost" id="econt_customer_shipping_cost" placeholder="" value="">
    <br>
    <p class="form-row form-row-wide"><a href="javascript:void(0);" class="econt_save_receiver_address button-primary button" id="save_user_address" title="<?php echo __('update address','woocommerce-econt') ?>"><?php echo __('update address','woocommerce-econt'); ?></a></p>
</div>

<style type="text/css">
    .econt_user_address { cursor: pointer; }
</style>
<script type="text/javascript">
var sender_city_id = "";
var loading_is_imported = "0";
var user_id = "<?php echo $user_id; ?>";
jQuery(document).ready(function(){ 
    jQuery("a.edit_econt_address, .econt_user_address").click(function(e){
        e.preventDefault();
        jQuery('.econt_user_address').hide();
        jQuery('#econt_edit_user_address').show();
        jQuery(".select2-container").css("width", "100%");
    });
    jQuery('.econt_shipping_to_door').hide();
    jQuery('.econt_shipping_to_office').hide();
    jQuery('.econt_shipping_to_machine').hide();
    jQuery('.econt_shipping_cost').hide();
    jQuery('#econt_city_courier_field').hide();
    jQuery('.econt_shipping_post_code').hide();
    jQuery('.econt_office_locator_map').hide();

});
jQuery(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
});
</script>