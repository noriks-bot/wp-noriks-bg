<?php
//mrejanet mod
$user_id = get_current_user_id();

$getoffice = new Econt_mySQL;
$office_code = get_user_meta($user_id, 'Econt_Office', true);
$office = $getoffice->getOfficeByOfficeCode($office_code);
                
$machine_code = get_user_meta($user_id, 'Econt_Machine', true);
$machine = $getoffice->getOfficeByOfficeCode($machine_code);

$econt_user_address = '0';


if(get_user_meta($user_id, 'Econt_Shipping_To', true)){
	$econt_user_address = '1';

echo '<div id="econt_user_checkout_field">';
if($econt_options['title_type'] == 'image'){
    echo '<img id="econt-title-image" src="' . $econt_options['title_image'] . '"><a href="#" id="edit_econt_address_user_checkout">' . __('Edit', 'woocommerce-econt') . '</a>';
}else{
    echo '<h3 id="econt-title-text">' . $econt_options['title'] . '<a href="#" id="edit_econt_address_user_checkout">' . __('Edit', 'woocommerce-econt') . '</a></h3>'; 
}

if(!empty($econt_options['description'])){
    echo '<p>'. $econt_options['description'] .'</p>';
}

if (get_user_meta($user_id, 'Econt_Shipping_To', true) == 'OFFICE') { 
    echo __('Econt Town:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Office_Town', true) . '<br/>';
    if(isset($office['name']) && isset($office['address'])){
        echo __('Econt office:', 'woocommerce-econt') . ' ' . $office['name'] . ', ' . $office['address'] . '<br/>';
    }else{
        echo __('The office is closed or it\'s identifier is changed. Please select office.', 'woocommerce-econt');
    } 
} elseif (get_user_meta($user_id, 'Econt_Shipping_To', true) == 'MACHINE') {
    echo __('Econt Town:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Machine_Town', true) . '<br/>';
    if(isset($machine['name']) && isset($machine['address'])){
        echo __('Econt APS:', 'woocommerce-econt') . ' ' .  $machine['name']  . ', ' . $machine['address'] . '<br/>';
    }else{
        echo __('The APS is closed or it\'s identifier is changed. Please select office.', 'woocommerce-econt');
    } 
}elseif (get_user_meta($user_id, 'Econt_Shipping_To', true) == 'DOOR') {
    echo __('Econt Town:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Town', true) . '<br/>';
    echo __('Econt Postcode:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Postcode', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Street', true)) 
        echo __('Econt Street:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Street', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Street_Intl', true)) 
        echo __('Econt Street:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Street_Intl', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Quarter', true))
        echo __('Econt Quarter:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Quarter', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_Quarter_Intl', true))
        echo __('Econt Quarter:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_Quarter_Intl', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_street_num', true))
        echo __('Econt Street Num.:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_street_num', true) . '<br/>';
    if(get_user_meta($user_id, 'Econt_Door_building_num', true))
        echo __('Econt Building Num.:', 'woocommerce-econt') . ' ' . get_user_meta($user_id, 'Econt_Door_building_num', true) . '<br/>';
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

<input type="hidden" name="econt_shipping_to_user" id="econt_shipping_to_user" value="<?php echo get_user_meta($user_id, 'Econt_Shipping_To', true); ?>">
<input type="hidden" name="econt_offices_town_user" id="econt_offices_town_user" value="<?php echo get_user_meta($user_id, 'Econt_Office_Town', true); ?>">
<input type="hidden" name="econt_offices_postcode_user" id="econt_offices_postcode_user" value="<?php echo get_user_meta($user_id, 'Econt_Office_Postcode', true); ?>">
<input type="hidden" name="econt_offices_user" id="econt_offices_user" value="<?php echo get_user_meta($user_id, 'Econt_Office', true); ?>">
<input type="hidden" name="econt_machines_town_user" id="econt_machines_town_user" value="<?php echo get_user_meta($user_id, 'Econt_Machine_Town', true); ?>">
<input type="hidden" name="econt_machines_postcode_user" id="econt_machines_postcode_user" value="<?php echo get_user_meta($user_id, 'Econt_Machine_Postcode', true); ?>">
<input type="hidden" name="econt_machines_user" id="econt_machines_user" value="<?php echo get_user_meta($user_id, 'Econt_Machine', true); ?>">
<input type="hidden" name="econt_door_town_user" id="econt_door_town_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Town', true); ?>">
<input type="hidden" name="econt_door_postcode_user" id="econt_door_postcode_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Postcode', true); ?>">
<input type="hidden" name="econt_door_street_user" id="econt_door_street_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Street', true); ?>">
<input type="hidden" name="econt_door_street_intl_user" id="econt_door_street_intl_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Street_Intl', true); ?>">
<input type="hidden" name="econt_door_quarter_user" id="econt_door_quarter_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Quarter', true); ?>">
<input type="hidden" name="econt_door_quarter_intl_user" id="econt_door_quarter_intl_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Quarter_Intl', true); ?>">
<input type="hidden" name="econt_door_street_num_user" id="econt_door_street_num_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_street_num', true); ?>">
<input type="hidden" name="econt_door_street_bl_user" id="econt_door_street_bl_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_building_num', true); ?>">
<input type="hidden" name="econt_door_street_vh_user" id="econt_door_street_vh_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Entrance_num', true); ?>">
<input type="hidden" name="econt_door_street_et_user" id="econt_door_street_et_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Floor_num', true); ?>">
<input type="hidden" name="econt_door_street_ap_user" id="econt_door_street_ap_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Apartment_num', true); ?>">
<input type="hidden" name="econt_door_other_user" id="econt_door_other_user" value="<?php echo get_user_meta($user_id, 'Econt_Door_Other', true); ?>">
<?php } ?>
<input type="hidden" name="econt_user_address" id="econt_user_address" value="<?php echo $econt_user_address; ?>">