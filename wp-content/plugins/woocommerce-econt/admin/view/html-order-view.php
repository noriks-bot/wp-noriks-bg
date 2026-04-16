<?php

      $econt_options = get_option('econt_shipping_method_options');
      $econt_mysql = new Econt_mySQL;
      $econt_admin_order = new Econt_Admin_Order;
      $intl_delivery = ($order->get_billing_country() == 'RO' || $order->get_billing_country() == 'GR') ? true : false;

      $order_num = $order->get_order_number();
      
      $order_shipping_method_id = '';

          $shipping_items = $order->get_items( 'shipping' );

          foreach($shipping_items as $el){
              $order_shipping_method_id = $el['method_id'] ;
          }

      if($order_shipping_method_id != 'econt_shipping_method'){
        ?>
        <script type="text/javascript">
          (function() {
            var element = document.getElementById("econt-order");
              element.classList.add("closed");
            })();
        </script>
        <?php
      }

      //get ordered products info
      $order_wp = $econt_admin_order->econt_order_products($order->get_id()); 
      //get loading details from sql
      $loading = $econt_mysql->getLoading($order->get_id());

      //license

      $license = Econt_mySQL::license_check();
      
      //license end

      //tracking

      if ($loading) {
        $error = array();

        if ($loading['cd_send_sum'] && (strtotime($loading['cd_send_time']) > 0)) {
          $loading['trackings'] = $econt_mysql->getLoadingTrackings($loading['econt_loading_id']);

          $loading['next_parcels'] = $econt_mysql->getLoadingNextParcels($loading['loading_num']);
          if (is_array($loading['next_parcels']) || is_object($loading['next_parcels'])){
            foreach ($loading['next_parcels'] as $key => $next_parcel) {
              if(isset($next_parcel['econt_loading_id'])){
                $loading['next_parcels'][$key]['trackings'] = $econt_mysql->getLoadingTrackings($next_parcel['econt_loading_id']);
              }
            }
          }
        } else {
          $data = array(
            'live' =>  $econt_options['live'],
            'username' => $econt_options['username'],
            'password' => $econt_options['password'],
            'type' => 'shipments',
            'xml'  => "<shipments full_tracking='ON'><num>" . $loading['loading_num'] . '</num></shipments>'
          );

          $results = $econt_mysql->serviceTool($data);

          $loading['trackings'] = array();
          $loading['next_parcels'] = array();

          if ($results) {
            if (isset($results->shipments->e->error)) {
              $error['warning'] = (string)$results->shipments->e->error;
            } elseif (isset($results->error)) {
              $error['warning'] = (string)$results->error->message;
            } elseif (isset($results->shipments->e)) {
              $loading['is_imported'] = $results->shipments->e->is_imported;
              $loading['storage'] = $results->shipments->e->storage;
              $loading['receiver_person'] = $results->shipments->e->receiver_person;
              $loading['receiver_person_phone'] = $results->shipments->e->receiver_person_phone;
              $loading['receiver_courier'] = $results->shipments->e->receiver_courier;
              $loading['receiver_courier_phone'] = $results->shipments->e->receiver_courier_phone;
              $loading['receiver_time'] = $results->shipments->e->receiver_time;
              $loading['cd_get_sum'] = $results->shipments->e->CD_get_sum;
              $loading['cd_get_time'] = $results->shipments->e->CD_get_time;
              $loading['cd_send_sum'] = $results->shipments->e->CD_send_sum;
              $loading['cd_send_time'] = $results->shipments->e->CD_send_time;
              $loading['total_sum'] = $results->shipments->e->total_sum;
              $loading['currency'] = $results->shipments->e->currency;
              $loading['sender_ammount_due'] = $results->shipments->e->sender_ammount_due;
              $loading['receiver_ammount_due'] = $results->shipments->e->receiver_ammount_due;
              $loading['other_ammount_due'] = $results->shipments->e->other_ammount_due;
              $loading['delivery_attempt_count'] = $results->shipments->e->delivery_attempt_count;
              $loading['blank_yes'] = $results->shipments->e->blank_yes;
              $loading['blank_no'] = $results->shipments->e->blank_no;

              if (isset($results->shipments->e->tracking)) {
                foreach ($results->shipments->e->tracking->row as $tracking) {
                  $loading['trackings'][] = array(
                    'time'       => $tracking->time,
                    'is_receipt' => $tracking->is_receipt,
                    'event'      => $tracking->event,
                    'name'       => $tracking->name,
                    'name_en'    => $tracking->name_en
                  );
                }
              }

              if (isset($results->shipments->e->next_parcels)) {
                foreach ($results->shipments->e->next_parcels->e as $next_parcel) {
                  $data_next_parcel = array(
                    'live' =>  $econt_options['live'],
                    'username' => $econt_options['username'],
                    'password' => $econt_options['password'],
                    'type' => 'shipments',
                    'xml'  => "<shipments full_tracking='ON'><num>" . $next_parcel->num . '</num></shipments>'
                  );

                  $results_next_parcel = $econt_mysql->serviceTool($data_next_parcel);

                  if ($results_next_parcel) {
                    if (isset($results_next_parcel->shipments->e->error)) {
                      $error['warning'] = (string)$results_next_parcel->shipments->e->error;
                    } elseif (isset($results_next_parcel->error)) {
                      $error['warning'] = (string)$results_next_parcel->error->message;
                    } elseif (isset($results_next_parcel->shipments->e)) {
                      $trackings_next_parcel = array();

                      if (isset($results_next_parcel->shipments->e->tracking)) {
                        foreach ($results_next_parcel->shipments->e->tracking->row as $tracking) {
                          $trackings_next_parcel[] = array(
                            'time'       => $tracking->time,
                            'is_receipt' => $tracking->is_receipt,
                            'event'      => $tracking->event,
                            'name'       => $tracking->name,
                            'name_en'    => $tracking->name_en
                          );
                        }
                      }

                      $loading['next_parcels'][] = array(
                        'loading_num'            => $results_next_parcel->shipments->e->loading_num,
                        'is_imported'            => $results_next_parcel->shipments->e->is_imported,
                        'storage'                => $results_next_parcel->shipments->e->storage,
                        'receiver_person'        => $results_next_parcel->shipments->e->receiver_person,
                        'receiver_person_phone'  => $results_next_parcel->shipments->e->receiver_person_phone,
                        'receiver_courier'       => $results_next_parcel->shipments->e->receiver_courier,
                        'receiver_courier_phone' => $results_next_parcel->shipments->e->receiver_courier_phone,
                        'receiver_time'          => $results_next_parcel->shipments->e->receiver_time,
                        'cd_get_sum'             => $results_next_parcel->shipments->e->CD_get_sum,
                        'cd_get_time'            => $results_next_parcel->shipments->e->CD_get_time,
                        'cd_send_sum'            => $results_next_parcel->shipments->e->CD_send_sum,
                        'cd_send_time'           => $results_next_parcel->shipments->e->CD_send_time,
                        'total_sum'              => $results_next_parcel->shipments->e->total_sum,
                        'currency'               => $results_next_parcel->shipments->e->currency,
                        'sender_ammount_due'     => $results_next_parcel->shipments->e->sender_ammount_due,
                        'receiver_ammount_due'   => $results_next_parcel->shipments->e->receiver_ammount_due,
                        'other_ammount_due'      => $results_next_parcel->shipments->e->other_ammount_due,
                        'delivery_attempt_count' => $results_next_parcel->shipments->e->delivery_attempt_count,
                        'blank_yes'              => $results_next_parcel->shipments->e->blank_yes,
                        'blank_no'               => $results_next_parcel->shipments->e->blank_no,
                        'pdf_url'                => $next_parcel->pdf_url,
                        'reason'                 => $next_parcel->reason,
                        'trackings'              => $trackings_next_parcel
                      );
                    }
                  } else {
                    $error['warning'] = __('error_connect', 'woocommerce-econt');
                  }
                }
              }

              if (!$error) {
                $econt_mysql->updateLoading($loading);
              }
            }
          } else {
            $error['warning'] = __('error_connect', 'woocommerce-econt');
          }
        }

        if (isset($error['warning'])) {
          $data['error_warning'] = $error['warning'];
        } else {
          $data['error_warning'] = '';
        }

        $loading['receiver_time'] = (strtotime($loading['receiver_time']) > 0 ? date("d.m.Y G:i:s", strtotime($loading['receiver_time'])) : '');
                $loading['cd_get_time'] = (strtotime($loading['cd_get_time']) > 0 ? date("d.m.Y G:i:s", strtotime($loading['cd_get_time'])) : '');
                $loading['cd_send_time'] = (strtotime($loading['cd_send_time']) > 0 ? date("d.m.Y G:i:s", strtotime($loading['cd_send_time'])) : '');
        if (is_array($loading['trackings']) || is_object($loading['trackings'])){
          foreach ($loading['trackings'] as $key => $tracking) {        
            $loading['trackings'][$key] = array(
              
              'time'       => date("d.m.Y G:i:s", strtotime($tracking['time'])),
              'is_receipt' => ((int)$tracking['is_receipt'] ? __('yes', 'woocommerce-econt') : __('no', 'woocommerce-econt')),
              'event'      => $econt_admin_order->tracking_event_text($tracking['event']),
              'name'       => (get_locale() == 'bg_BG' ? $tracking['name'] : $tracking['name_en'])
            );
          }
        }

      if (is_array($loading['next_parcels']) || is_object($loading['next_parcels'])){
        foreach ($loading['next_parcels'] as $key => $next_parcel) {
          $loading['next_parcels'][$key]['receiver_time'] = (strtotime($loading['receiver_time']) > 0 ? date("d.m.Y G:i:s", strtotime($loading['receiver_time'])) : '');
          $loading['next_parcels'][$key]['cd_get_time'] = (strtotime($loading['cd_get_time']) > 0 ? date("d.m.Y G:i:s", strtotime($loading['cd_get_time'])) : '');
          $loading['next_parcels'][$key]['cd_send_time'] = (strtotime($loading['cd_send_time']) > 0 ? date("d.m.Y G:i:s", strtotime($loading['cd_send_time'])) : '');

          foreach ($next_parcel['trackings'] as $key2 => $tracking) {
            $loading['next_parcels'][$key]['trackings'][$key2] = array(
              //'time'       => date(__('d/m/Y', 'woocommerce-econt') . ' ' . __('hh:mm:ss', 'woocommerce-econt'), strtotime($tracking['time'])),
              'time'       => date("d.m.Y G:i:s", strtotime($tracking['time'])),
              'is_receipt' => ((int)$tracking['is_receipt'] ? __('yes', 'woocommerce-econt') : __('no', 'woocommerce-econt')),
              'event'      => $econt_admin_order->tracking_event_text($tracking['event']),
              'name'       => (get_locale() == 'bg_BG' ? $tracking['name'] : $tracking['name_en'])
            );
          }
        }
      }
   }
      //tracking end


        //delivery days
      if($order_shipping_method_id == 'econt_shipping_method'){
              $delivery_days = $econt_mysql->delivery_days($econt_options['username'], $econt_options['password'], $econt_options['live']);
      }else{
          $delivery_days = array();
      }

              //Priority time
              $priority_time_types = array(
          array('id' => 'BEFORE', 'name' => __('before', 'woocommerce-econt'), 'hours' => array(10, 11, 12, 13, 14, 15, 16, 17, 18)),
          array('id' => 'IN', 'name' => __('in', 'woocommerce-econt'), 'hours' => array(9, 10, 11, 12, 13, 14, 15, 16, 17, 18)),
          array('id' => 'AFTER', 'name' => __('after', 'woocommerce-econt'), 'hours' => array(9, 10, 11, 12, 13, 14, 15, 16, 17))
        );

              //access_clients

        $access_clients = get_option('econt_access_clients');

        //instructions
        $instructions_give      = array();
              $instructions_take      = array();
              $instruction_return     = array();
              $instruction_services   = array();

        $instructions_take[0] = __('No', 'woocommerce-econt');
              if(isset($access_clients['instructions']['take'])){
                foreach ($access_clients['instructions']['take'] as $key => $value) {
                $instructions_take[$value] = $value;
                  }
              }

              $instructions_give[0] = __('No', 'woocommerce-econt');
              if(isset($access_clients['instructions']['give'])){
                  foreach ($access_clients['instructions']['give'] as $key => $value) {
                  $instructions_give[$value] = $value;
                  }
              }

              $instructions_return[0] = __('No', 'woocommerce-econt');
              if(isset($access_clients['instructions']['return'])){
                  foreach ($access_clients['instructions']['return'] as $key => $value) {
                  $instructions_return[$value] = $value;
                  }
              }

              $instructions_services[0] = __('No', 'woocommerce-econt');
              if(isset($access_clients['instructions']['services'])){
                  foreach ($access_clients['instructions']['services'] as $key => $value) {
                  $instructions_services[$value] = $value;
                  }
              }

              //default sender addresses
              $sender_addresses = array();
        $profile = get_option('econt_profile');
        if(!array_key_exists('error', $profile)){
          $name       = $profile['client_info']['mol'];
          $address_ready = array();
                    $address_components = array('city_post_code', 'city', 'quarter', 'street', 'street_num', 'other', 'city_id');
                
          foreach ($profile['addresses'] as $key => $value) {

          foreach ($address_components as $address_component) {
            if(array_key_exists($address_component, $value)){
                          if(is_array($value[$address_component])){
                              $address_ready[$address_component] = implode(', ', array_map(
                              function ($v, $k) { return sprintf("%s: %s", $k, $v); },
                              $value[$address_component],
                              array_keys($value[$address_component])
                              ));
                          }else{
                              if(isset($value[$address_component])){
                                  $address_ready[$address_component] = $value[$address_component];
                              }else{
                                  $address_ready[$address_component] = '';
                              }
                          }
                      }
                    }

                    $sender_addresses[implode(";", $address_ready)] = __('p.c. ', 'woocommerce-econt').$address_ready['city_post_code'].__(', t./v. ', 'woocommerce-econt').$address_ready['city'].__(', q.: ', 'woocommerce-econt').$address_ready['quarter'].', '.$address_ready['street'].', №: '.$address_ready['street_num'].__(', other: ', 'woocommerce-econt').$address_ready['other'];


          }

        }else{
          Econt_mySQL::write_log($profile['error']);
        }

        //receiver details
        $receiver_city = '';
        $receiver_post_code = '';
        
        if($order->get_meta( 'Econt_Door_Town', true )){
        
          $receiver_city      = $order->get_meta( 'Econt_Door_Town', true );
        
        }elseif($order->get_meta( 'Econt_Office_Town', true )){
        
          $receiver_city      = $order->get_meta( 'Econt_Office_Town', true );
        
        }elseif($order->get_meta( 'Econt_Machine_Town', true )){

          $receiver_city      = $order->get_meta( 'Econt_Machine_Town', true );
        }
        
        if($order->get_meta( 'Econt_Door_Postcode', true )){
          
          $receiver_post_code   = $order->get_meta( 'Econt_Door_Postcode', true );
        
        }elseif($order->get_meta( 'Econt_Office_Postcode', true )){

          $receiver_post_code   = $order->get_meta( 'Econt_Office_Postcode', true );
        
        }elseif($order->get_meta( 'Econt_Machine_Postcode', true )){

          $receiver_post_code   = $order->get_meta( 'Econt_Machine_Postcode', true );
        }
        $receiver_office_code = '';
        if($order->get_meta( 'Econt_Office', true )){

          $receiver_office_code     = $order->get_meta( 'Econt_Office', true );
        
        }elseif($order->get_meta( 'Econt_Machine', true )){

          $receiver_office_code     = $order->get_meta( 'Econt_Machine', true );
        }

        if( $order->get_billing_company() ) { 
        
          $receiver_name      = $order->get_billing_company();
        
        }else{
        
          $receiver_name      = $order->get_billing_first_name() . ' ' .  $order->get_billing_last_name();

        }
        
        $receiver_name_person     = $order->get_billing_first_name() . ' ' .  $order->get_billing_last_name();
        $receiver_email       = $order->get_billing_email();
        $receiver_street      = ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Street_Intl', true ) : $order->get_meta( 'Econt_Door_Street', true );
        $receiver_street_intl     = $order->get_meta( 'Econt_Door_Street_Intl', true );
        $receiver_quarter       = ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Quarter_Intl', true ) : $order->get_meta( 'Econt_Door_Quarter', true );
        $receiver_quarter_intl    = $order->get_meta( 'Econt_Door_Quarter_Intl', true );
        $receiver_street_num    = $order->get_meta( 'Econt_Door_street_num', true );
        $receiver_street_bl     = $order->get_meta( 'Econt_Door_building_num', true );
        $receiver_street_vh     = $order->get_meta( 'Econt_Door_Entrance_num', true );
        $receiver_street_et     = $order->get_meta( 'Econt_Door_Floor_num', true );
        $receiver_street_ap     = $order->get_meta( 'Econt_Door_Apartment_num', true );
        $receiver_street_other    = $order->get_meta( 'Econt_Door_Other', true );
        $receiver_phone_num     = $order->get_billing_phone();
        $receiver_email       = $order->get_billing_email();
        $receiver_shipping_to   = $order->get_meta( 'Econt_Shipping_To', true );


        $description        = array_key_exists('product_name', $order_wp ) ? $econt_mysql->substrwords(implode(', ', $order_wp['product_name']), 100) : '';
        
        $currency           = $order->get_currency();
        $currency_symbol      = get_woocommerce_currency_symbol($currency); 
        $access_clients = get_option('econt_access_clients');
                
                $cd_agreement_nums = array();            
        $cd_agreement_nums[0] = __('No', 'woocommerce-econt');
        if(isset($access_clients['cd_agreement_nums'])){
          foreach ($access_clients['cd_agreement_nums'] as $key => $value) {
            $cd_agreement_nums[$value] = $value;
          }
        }
        $key_words = array();
        $key_words['CASH']    = __('Cash', 'woocommerce-econt');
        if(isset($access_clients['key_words'])){
          foreach ($access_clients['key_words'] as $key => $value) {
            $key_words[$value] = $value;
          }
        }
                $key_words['VOUCHER']   = __('Voucher', 'woocommerce-econt');
                $key_words['BONUS']     = __('Bonus points', 'woocommerce-econt');

                $sender_payment_method    = $econt_options['client_payment_type'];
        $cd_agreement_num     = $econt_options['client_cd_num'];

        $customer_shipping_cost   = $order->get_meta( 'Econt_Customer_Shipping_Cost', true );
        $total_shipping_cost    = $order->get_meta( 'Econt_Total_Shipping_Cost', true );

        $priority_time_type_id    = $order->get_meta( 'Econt_Priority_Time_Type', true );
        $priority_time_hour_id    = $order->get_meta( 'Econt_Priority_Time_Hour', true );

        $payment_method_cod = ($order->get_payment_method() == 'cod') ? 1 : 0;
        $payment_method_econt_payment = ($order->get_payment_method() == 'econt_payment') ? 1 : 0;
        $order_cd = ($order->get_payment_method() == 'cod' || $order->get_payment_method() == 'econt_payment') ? 1 : 0;

        $payment_token = $order->get_transaction_id();

        $license = Econt_mySQL::license_check();
  ?>
  <script>
  //license
  jQuery(document).ready(function() {
    var licensed = <?php echo "'" . $license->licensed ."';" ?>;
    //console.log('licensed', licensed);
     
    if(licensed == 'trail' || licensed == 'no'){
      jQuery.colorbox({title:'Лицензионно съобщение',width:'700px',height:'700px', html: '<?php echo $license->msg; ?>'}); 
    }
  });
  </script> 

<?php if(isset($order_wp['no_weight'])){ ?>
<H3><?php _e('Please, add weight to the products in the list then you\'ll able to create Econt Express loading.', 'woocommerce-econt'); ?></H3>
<table border='0'>
<tr><td colspan='3'><?php _e('Products without weight:', 'woocommerce-econt'); ?></td></tr>
<tr><td><?php _e('product id', 'woocommerce-econt'); ?></td><td><?php _e('product name', 'woocommerce-econt'); ?></td><td></td></tr>  
<?php foreach ($order_wp['no_weight'] as $key => $value) {
echo '<tr><td>'.$value['product_id'].'</td><td><a href="' .get_edit_post_link( $value['product_id'] ). '" target="_blank">'.$value['name'].'</a></td><td><a href="' .get_edit_post_link( $value['product_id'] ). '" target="_blank">' . __('Edit', 'woocommerce-econt'). '</a></td></tr>';
}
?>
</table>
<?php }else{ ?>


<?php if($loading == false){ ?>
<H3><?php _e('Create Loading', 'woocommerce-econt'); ?></H3>
</form>
<form id='order_loading_form' onsubmit="return false;">
<table>
<tbody>
<tr>
<td>
<?php _e('Send:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='sender_door_or_office' name='sender_door_or_office' onchange="displaySenderDoor();">
  <option value='OFFICE' <?php echo ($econt_options['send_from'] == 'OFFICE') ?  'selected="selected"' : '' ; ?>><?php _e('from default office', 'woocommerce-econt'); ?></option>
  <option value='DOOR' <?php echo ($econt_options['send_from'] == 'DOOR') ?  'selected="selected"' : '' ; ?>><?php _e('from default door', 'woocommerce-econt'); ?></option>
  <option value='MACHINE' <?php echo ($econt_options['send_from'] == 'MACHINE') ?  'selected="selected"' : '' ; ?>><?php _e('from default machine', 'woocommerce-econt'); ?></option>
  <option value='DOOR2'><?php _e('from door', 'woocommerce-econt'); ?></option>
  <option value='OFFICE2'><?php _e('from office', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>

<tr class='sender_door2' style='display:none'>
<td>
<?php _e('Sender Address:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='sender_door2' name='sender_door2'>
  <?php foreach ($sender_addresses as $key => $value) { ?>
  <option value='<?php echo $key; ?>' ><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>

<tr class='sender_office2' style='display:none'>
<td>
<?php _e('Sender Office:', 'woocommerce-econt'); ?>
</td>
<td>
<p class="form-row econt_shipping_from_office form-row-wide validate-required" id="econt_offices_town_field" data-priority=""><label for="econt_offices_town" class=""><?php _e('Town', 'woocommerce-econt'); ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select class="select "  name="sender_city" id="econt_sender_offices_town" data-placeholder="<?php _e('Enter your town', 'woocommerce-econt'); ?>"></select>
</span></p>
<input type="text" class="econt_shipping_post_code" name="sender_post_code" id="econt_sender_offices_postcode" placeholder="<?php _e('p.c.', 'woocommerce-econt'); ?>" value="">
<p class="form-row econt_shipping_from_office form-row-wide validate-required" id="econt_sender_offices_field" data-priority=""><label for="econt_sender_offices" class=""><?php  _e('Office', 'woocommerce-econt'); ?><abbr class="required" title="задължително">*</abbr></label><span class="woocommerce-input-wrapper"><select name="sender_office_code" id="econt_sender_offices" class="select " data-placeholder="<?php _e('Select office', 'woocommerce-econt'); ?>">
<option value=""><?php _e('please select...', 'woocommerce-econt'); ?></option>
</select></span></p>
</td>
</tr>

<tr id='row_payment_side'>
<td>
<?php _e('Payment Side:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='payment_side' name='payment_side'>
  <option value='RECEIVER' <?php echo (((float)$customer_shipping_cost != 0 && !empty($order_cd)) || (empty($econt_options['inc_shipping_cost']) && (float)$customer_shipping_cost != 0)) ?  'selected="selected"' : '' ; ?>><?php _e('receiver', 'woocommerce-econt'); ?></option>
  <option value='SENDER' <?php echo ((float)$customer_shipping_cost == 0 || (empty($order_cd) && !empty($econt_options['inc_shipping_cost']))) ?  'selected="selected"' : '' ; ?>><?php _e('sender', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Choose the way you pay:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='sender_payment_method' name='sender_payment_method'>
  <?php foreach ($key_words as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($sender_payment_method == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Weight:', 'woocommerce-econt'); ?>
</td>
<td>
<input type='text' name='weight' value='<?php echo $order_wp['weight']; ?>' size='4'><?php echo __('kg', 'woocommerce-econt'); ?>
</td>
</tr>
<tr>
<td>
<?php _e('Length:', 'woocommerce-econt'); ?>
</td>
<td>
<input type='text' name='length' value='<?php echo $order_wp['length']; ?>' size='4'><?php echo __('cm', 'woocommerce-econt'); ?>
</td>
</tr>
<tr>
<td>
<?php _e('Width:', 'woocommerce-econt'); ?>
</td>
<td>
<input type='text' name='width' value='<?php echo $order_wp['width']; ?>' size='4'><?php echo __('cm', 'woocommerce-econt'); ?>
</td>
</tr>
<tr>
<td>
<?php _e('Height:', 'woocommerce-econt'); ?>
</td>
<td>
<input type='text' name='height' value='<?php echo $order_wp['height']; ?>' size='4'><?php echo __('cm', 'woocommerce-econt'); ?>
</td>
</tr>
<tr id='size_under_60cm'>
<td>
<?php _e('Size under 60cm:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='size_under_60cm' name='size_under_60cm'>
  <option value='0' <?php echo ((int)$order_wp['size_under_60cm'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$order_wp['size_under_60cm'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
<tr>
<td>	
<?php _e('Pack count:', 'woocommerce-econt'); ?>
</td>
<td>
<input type='text' name='pack_count' value='1' size='3'>
</td>
</tr>
<tr>
<td>
<?php _e('Are you going to use an agreement for CD:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='cd_agreement_num' name='cd_agreement_num'>
  <?php foreach ($cd_agreement_nums as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($cd_agreement_num == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr id='row_order_cd'>
<td>
<?php _e('Cash on delivery', 'woocommerce-econt'); ?>
</td>
<td>
<select id='order_cd' name='order_cd'>
  <option value='1' <?php echo ((int)$econt_options['cd'] == 1 && ($order->get_payment_method() == 'cod' || $order->get_payment_method() == 'econt_payment')) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
  <option value='0' <?php echo ((int)$econt_options['cd'] == 0 || ($order->get_payment_method() != 'cod' && $order->get_payment_method() != 'econt_payment')) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
</select>
<?php _e('amount: ', 'woocommerce-econt'); ?>
<input type='text' id='order_cd_amount' name='order_cd_amount' value='<?php echo $order_wp['price']; ?>' size='6'><?php echo $currency_symbol; ?>
</td>
</tr>
<tr id='row_order_oc'>
<td>
<?php _e('Declared Value:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='order_oc' name='order_oc'>
  <option value='0' <?php echo ((int)$econt_options['oc'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['oc'] == 1 || (int)$econt_options['oc'] <= $order_wp['price'] && (int)$econt_options['oc'] != 0) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
<?php _e('amount: ', 'woocommerce-econt'); ?>
<input type='text' id='order_oc_amount' name='order_oc_amount' value='<?php echo $order_wp['price']; ?>' size='6'><?php echo $currency_symbol; ?>

</td>
</tr>
<tr>
<td>
<?php _e('SMS notification:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='sms_notification' name='sms_notification'>
  <option value='0' <?php echo ((int)$econt_options['sms_notification'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['sms_notification'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
<tr id='row_sms_no'>
<td>
<?php _e('SMS on delivery:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='sms_no_set' name='sms_no_set'>
  <option value='no' <?php echo (empty($econt_options['sms_no'])) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='yes' <?php echo (!empty($econt_options['sms_no'])) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
<?php _e('phone number: ', 'woocommerce-econt'); ?>
<input type='text' id='sms_no' name='sms_no' value='<?php echo $econt_options['sms_no']; ?>' size='10'>

</td>
</tr>
</tbody>
<tbody class='used_from_aps'>
<tr id='row_order_pay_after'>
<td>
<?php _e('Pay after:', 'woocommerce-econt'); ?>  
</td>
<td>
<select id='order_pay_after' name='order_pay_after'>
  <option value='0' <?php echo ((int)$econt_options['pay_after'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('None', 'woocommerce-econt'); ?></option>
  <option value='accept' <?php echo ($econt_options['pay_after'] == 'accept') ?  'selected="selected"' : '' ; ?>><?php _e('Accept', 'woocommerce-econt'); ?></option>
  <option value='test' <?php echo ($econt_options['pay_after'] == 'test') ?  'selected="selected"' : '' ; ?>><?php _e('Test', 'woocommerce-econt'); ?></option>
</select> 
</td> 
</tr>
<tr id='row_dc'>
<td>
<?php _e('Attach a service acknowledgment:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='dc' name='dc'>
  <option value='0' <?php echo ((int)$econt_options['dc'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['dc'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
</tbody>

<tbody class='priority_time'>

<?php 
//$priority_time_type_id = '11'; 
$error_priority_time = '';
$priority_time_hours = array();
?>
          <tr id="row_priority_time">
            <td><input type="checkbox" id="priority_time" name="priority_time" value="1" <?php if ((int)$econt_options['priority_time'] == 1) { ?> checked="checked"<?php } ?> onclick="checkPriorityTime();" />
              <label for="priority_time"><?php echo _e('priority time', 'woocommerce-econt'); ?></label></td>
            <td><select id="priority_time_type" name="priority_time_type" <?php if ((int)$econt_options['priority_time'] == 0) { ?> disabled="disabled"<?php } ?> onchange="setPriorityTime();">
              <option value="0"><?php _e('choose', 'woocommerce-econt'); ?></option>
              <?php foreach ($priority_time_types as $priority_time_type) { ?>
              <?php if ($priority_time_type['id'] == $priority_time_type_id) { ?>
              <?php $priority_time_hours = $priority_time_type['hours']; ?>
              <option value="<?php echo $priority_time_type['id']; ?>" selected="selected"><?php echo $priority_time_type['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $priority_time_type['id']; ?>"><?php echo $priority_time_type['name']; ?></option>
              <?php } ?>
              <?php } ?>
              </select>
              <select id="priority_time_hour" name="priority_time_hour" <?php if ((int)$econt_options['priority_time'] == 0) { ?> disabled="disabled"<?php } ?>>
              <?php foreach ($priority_time_hours as $priority_time_hour) { ?>
              <?php if ($priority_time_hour == $priority_time_hour_id) { ?>
              <option value="<?php echo $priority_time_hour; ?>" selected="selected"><?php echo $priority_time_hour; ?></option>
              <?php } else { ?>
              <option value="<?php echo $priority_time_hour; ?>"><?php echo $priority_time_hour; ?></option>
              <?php } ?>
              <?php } ?>
              </select>
              <label for="priority_time_hour"><?php _e('hour', 'woocommerce-econt'); ?></label>
              <?php if ($error_priority_time) { ?>
              <span class="error"><?php echo $error_priority_time; ?></span>
              <?php } ?></td>
          </tr>

</tbody>

<tbody class='not_used_to_aps'>

<!--<tr id='row_sms_no'>
<td>
<?php _e('SMS on delivery:', 'woocommerce-econt'); ?>  
</td> 
<td>
 <input type='text' name='description' value='<?php echo $econt_options['sms_no']; ?>' placeholder='<?php _e('write phone number', 'woocommerce-econt'); ?>'>
</td>
</tr>-->
<tr>
<td>
<?php _e('Invoice before Cash on Delivery:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='invoice' name='invoice'>
  <option value='0' <?php echo ((int)$econt_options['invoice'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['invoice'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Attach a service acknowledgment/bill of goods:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='dc_cp' name='dc_cp'>
  <option value='0' <?php echo ((int)$econt_options['dc_cp'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['dc_cp'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Instructions take:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='instructions_take' name='instructions_take'>
  <?php foreach ($instructions_take as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($econt_options['instructions_take'] == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Instructions give:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='instructions_give' name='instructions_give'>
  <?php foreach ($instructions_give as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($econt_options['instructions_give'] == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Instructions return:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='instructions_return' name='instructions_return'>
  <?php foreach ($instructions_return as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($econt_options['instructions_return'] == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Instructions Services:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='instructions_services' name='instructions_services'>
  <?php foreach ($instructions_services as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($econt_options['instructions_services'] == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Express City Courier', 'woocommerce-econt'); ?>
</td>
<td>
<select id='city_courier' name='city_courier' onchange="displayCityCourierType();">
  <option value='0' <?php echo ((int)$econt_options['city_courier'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['city_courier'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
  </select>
</td>
</tr>
<tr id='econt_city_courier' style='<?php echo ((int)$econt_options['city_courier'] == 0) ?  'display:none' : '' ; ?>'>
<td>
<?php _e('Express City Courier Type', 'woocommerce-econt'); ?>
</td>
<td>
<select id='econt_city_courier' name='econt_city_courier'>
  <option value='0' <?php echo (!$order->get_meta( 'Econt_City_Courier', true )) ?  'selected="selected"' : '' ; ?>><?php _e('choose', 'woocommerce-econt'); ?></option>
  <option value='e1' <?php echo ($order->get_meta( 'Econt_City_Courier', true ) == 'e1') ?  'selected="selected"' : '' ; ?>><?php _e('up to 60 minutes', 'woocommerce-econt'); ?></option>
  <option value='e2' <?php echo ($order->get_meta( 'Econt_City_Courier', true ) == 'e2') ?  'selected="selected"' : '' ; ?>><?php _e('up to 90 minutes', 'woocommerce-econt'); ?></option>
  <option value='e3' <?php echo ($order->get_meta( 'Econt_City_Courier', true ) == 'e3') ?  'selected="selected"' : '' ; ?>><?php _e('up to 120 minutes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Delivery Days:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='delivery_day_id' name='delivery_day_id'>
  <option value='0'><?php _e('No', 'woocommerce-econt'); ?></option>  
  <?php foreach ($delivery_days as $key => $value) { ?>
  <option value='<?php echo $key; ?>' <?php echo ($order->get_meta( 'Econt_Delivery_Days', true ) == $key) ?  'selected="selected"' : '' ; ?>><?php echo $value; ?></option>  
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<?php _e('Partial Delivery:', 'woocommerce-econt'); ?>
</td>
<td>
<!--<select id='partial_delivery' name='partial_delivery' onchange="displayInventory();">-->
<select id='partial_delivery' name='partial_delivery'>
  <option value='0' <?php echo ((int)$econt_options['partial_delivery'] == 0) ?  'selected="selected"' : '' ; ?>><?php _e('no', 'woocommerce-econt'); ?></option>
  <option value='1' <?php echo ((int)$econt_options['partial_delivery'] == 1) ?  'selected="selected"' : '' ; ?>><?php _e('yes', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
</tbody>
<tbody>
<!--<tr id='inventory' style='<?php echo ((int)$econt_options['partial_delivery'] == 0) ?  'display:none' : '' ; ?>'>-->
<tr id='inventory' style=''>
<td>
<?php _e('List Type:', 'woocommerce-econt'); ?>
</td>
<td>
<select id='inventory' name='inventory' onchange="displayInventoryType();">
  <option value='0' ><?php _e('choose', 'woocommerce-econt'); ?></option>
  <option value='DIGITAL' <?php echo ($econt_options['inventory'] == 'DIGITAL') ?  'selected="selected"' : '' ; ?>><?php _e('digital', 'woocommerce-econt'); ?></option>
  <option value='LOADING' <?php echo ($econt_options['inventory'] == 'LOADING') ?  'selected="selected"' : '' ; ?>><?php _e('loading', 'woocommerce-econt'); ?></option>
</select>
</td>
</tr>
 <tr id="inventory_type_loading" style="display: none;"><td colspan="2"><?php _e('You must print an inventory shipping list and attach it to the loading.', 'woocommerce-econt'); ?></td></tr>

<tr>
<td colspan='2'>
         <table id="inventory_type_digital" style="display:none">
              <thead>
                <tr>
                  <td class="left" style="width: 13%;"><?php _e('product id', 'woocommerce-econt'); ?></td>
                  <td class="left"><?php _e('product name', 'woocommerce-econt'); ?></td>
                  <td class="left"><?php _e('product weight', 'woocommerce-econt'); ?></td>
                  <td class="left"><?php _e('product price', 'woocommerce-econt'); ?></td>
                  <td>&nbsp;</td>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td colspan="4">&nbsp;</td>
                  <td class="left"><a onclick="addProduct();" class="button"><span><?php _e('add', 'woocommerce-econt'); ?></span></a></td>
                </tr>
              </tfoot>
              <tbody id="products">
                <?php $product_row = 0; ?>
                <?php 
                if(array_key_exists('products', $order_wp)){
                  foreach ($order_wp['products'] as $product) { ?>
                  <tr id="product_<?php echo $product_row; ?>">
                    <td class="left"><input type="text" id="product_id_<?php echo $product_row; ?>" name="products[<?php echo $product_row; ?>][product_id]" value="<?php echo $product['product_id']; ?>" size="3" /></td>
                    <td class="left"><input type="text" id="product_name_<?php echo $product_row; ?>" name="products[<?php echo $product_row; ?>][name]" value="<?php echo htmlspecialchars($product['name']) .' - '. $product['qty'] . ' ' . __('qty','woocommerce-econt'); ?>" size="50" /></td>
                    <td class="left"><input type="text" id="product_weight_<?php echo $product_row; ?>" name="products[<?php echo $product_row; ?>][weight]" value="<?php echo $product['weight']; ?>" size="10" /></td>
                    <td class="left"><input type="text" id="product_price_<?php echo $product_row; ?>" name="products[<?php echo $product_row; ?>][price]" value="<?php echo $product['price']; ?>" size="10" /></td>
                    <td class="left"><a onclick="jQuery('#product_<?php echo $product_row; ?>').remove();" class="button"><span><?php _e('remove', 'woocommerce-econt'); ?></span></a></td>
                  </tr>
                  <?php $product_row++; ?>
                  <?php } ?>
                <?php } ?>
              </tbody>
            </table>
</td>
</tr>
</tbody>

<tr id='row_envelope_num'>
<td>
<?php _e('Envelope number:', 'woocommerce-econt'); ?>  
</td> 
<td>
 <input type='text' name='envelope_num' value=''>  
</td>
</tr>
<tr id='row_order_num_user_input'>
<td>
<?php _e('Order number:', 'woocommerce-econt'); ?>  
</td> 
<td>
 <input type='text' name='order_num_user_input' value='<?php echo $order->get_order_number(); ?>'>  
</td>
</tr>
<tr id='row_invoice_num'>
<td>
<?php _e('Invoice number and date /NNNNNNNNNN dd.mm.yyyy/:', 'woocommerce-econt'); ?>  
</td> 
<td>
 <input type='text' name='invoice_num' value=''>  
</td>
</tr>
<tr id='row_description'>
<td>
<?php _e('Description:', 'woocommerce-econt'); ?>	
</td>	
<td>
 <input type='text' name='description' value='<?php echo $description; ?>'> 	
</td>
</tr>
<tr>
<td colspan='2'>
<button id='order_only_calculate_loading' class='button' type='submit' name='action2' value='only_calculate_loading' ><?php _e('Calculate Shipping Cost', 'woocommerce-econt'); ?></button>
<button id='order_create_loading' class='button button-primary' type='submit' name='action2' value='create_loading'><?php _e('Create Loading', 'woocommerce-econt'); ?></button>
<button id='button_request_of_courier' class='button' type='' name='' value=''><?php _e('Request for courier', 'woocommerce-econt'); ?></button>

</td>
</tr>
</table>
<div id="econtLoader" ></div><!-- loading spinner -->

 <input type='hidden' name='receiver_city' value='<?php echo $receiver_city; ?>'>
 <input type='hidden' name='receiver_post_code' value='<?php echo $receiver_post_code; ?>'> 
 <input type='hidden' name='receiver_office_code' value='<?php echo $receiver_office_code; ?>'>
 <input type='hidden' name='receiver_name' value='<?php echo $receiver_name ?>'> 
 <input type='hidden' name='receiver_name_person' value='<?php echo $receiver_name_person; ?>'>
 <input type='hidden' name='receiver_email' value='<?php echo $receiver_email; ?>'> 
 <input type='hidden' name='receiver_street' value='<?php echo $receiver_street; ?>'>
 <input type='hidden' name='receiver_quarter' value='<?php echo $receiver_quarter; ?>'> 
 <input type='hidden' name='receiver_street_num' value='<?php echo $receiver_street_num; ?>'>
 <input type='hidden' name='receiver_street_bl' value='<?php echo $receiver_street_bl; ?>'> 
 <input type='hidden' name='receiver_street_vh' value='<?php echo $receiver_street_vh; ?>'>
 <input type='hidden' name='receiver_street_et' value='<?php echo $receiver_street_et; ?>'> 
 <input type='hidden' name='receiver_street_ap' value='<?php echo $receiver_street_ap; ?>'>
 <input type='hidden' name='receiver_street_other' value='<?php echo $receiver_street_other; ?>'> 
 <input type='hidden' name='receiver_phone_num' value='<?php echo $receiver_phone_num; ?>'>
 <input type='hidden' name='receiver_email' value='<?php echo $receiver_email; ?>'>
 <input type='hidden' id='receiver_shipping_to' name='receiver_shipping_to' value='<?php echo $receiver_shipping_to; ?>'>

 <input type='hidden' name='order_id' value='<?php echo $order->get_id(); ?>'>
 <input type='hidden' name='order_num' value='<?php echo $order_num; ?>'>
 <input type='hidden' name='payment_method_cod' value='<?php echo $payment_method_cod; ?>'>
 <input type='hidden' name='payment_method_econt_payment' value='<?php echo $payment_method_econt_payment; ?>'>
 <input type='hidden' name='payment_token' value='<?php echo $payment_token; ?>'>

<table id='create_loading'></table>
</form>
<p></p>
<?php  }else{ //$loading == true ?>
<?php $product_row = 0; ?>
 <input type='hidden' id='loading_num' name='loading_num' value='<?php echo $loading['loading_num']; ?>'>
<table>
	
</table>

<!-- tracking -->

<div id="content">

  <?php if ($data['error_warning']) { ?>
  <div class="warning"><?php __('error_connect', 'woocommerce-econt'); ?></div>
  <?php } ?>
  <div class="box">
  <div class="content">
    <table class="form">
      <!--<tr>
        <td style="width: 300px;"><?php _e('Loading number:', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['loading_num']; ?></td>
      </tr>-->
      <tr>
        <td coolspan='2'><strong><?php _e('Loading Details', 'woocommerce-econt'); ?></strong></td>
      </tr>
      <tr>
        <td><?php _e('Loading number:', 'woocommerce-econt'); ?></td>
        <td><a href='<?php echo $loading['pdf_url']; ?>' target='_blank'><?php echo $loading['loading_num']; ?></a></td>
      </tr>
      <tr>
        <td><?php _e('Loading shipping cost:', 'woocommerce-econt'); ?></td>
        <td><strong><?php echo $total_shipping_cost . ' '. $currency; ?></strong></td></tr>
      <tr>
        <td><?php _e('Loading shipping cost to be paid by the customer:', 'woocommerce-econt'); ?></td>
        <td><strong><?php 
          if(!is_numeric($customer_shipping_cost)){
            $currency = '';
          }
          echo $customer_shipping_cost . ' '. $currency; 
        ?></strong></td>
      </tr>
      <tr>
        <td><?php _e('Is imported', 'woocommerce-econt'); ?></td>
        <td><?php if ((int)$loading['is_imported']) { ?>
          <?php  _e('yes', 'woocommerce-econt'); ?>
          <?php } else { ?>
          <?php _e('no', 'woocommerce-econt'); ?>
          <?php } ?></td>
      </tr>
      <tr>
        <td><?php _e('Storage', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['storage']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver person', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['receiver_person']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver person phone', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['receiver_person_phone']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver Courier', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['receiver_courier']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver Courier phone', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['receiver_courier_phone']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver Time', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['receiver_time']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver cd get sum', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['cd_get_sum']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver cd get time ', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['cd_get_time']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver cd send sum', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['cd_send_sum']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver cd send time', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['cd_send_time']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Total sum', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['total_sum']; ?> <?php echo $loading['currency']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Sender amount due', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['sender_ammount_due']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver amount due', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['receiver_ammount_due']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Other amount due', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['other_ammount_due']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Delivery attempt count', 'woocommerce-econt'); ?></td>
        <td><?php echo $loading['delivery_attempt_count']; ?></td>
      </tr>
      <!--<tr>
        <td><?php _e('Blank yes', 'woocommerce-econt'); ?></td>
        <td><?php if ($loading['blank_yes']) { ?>
          <a href="<?php echo $loading['blank_yes']; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td><?php _e('Blank no', 'woocommerce-econt'); ?></td>
        <td><?php if ($loading['blank_no']) { ?>
          <a href="<?php echo $loading['blank_no']; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a>
          <?php } ?></td>
      </tr>-->
      <?php if ($loading['pdf_url']) { ?>
      <tr>
        <td><?php _e('PDF URL', 'woocommerce-econt'); ?></td>
        <td><a href="<?php echo $loading['pdf_url']; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a></td>
      </tr>
      <tr>
        <td><?php _e('PDF URL 10x9', 'woocommerce-econt'); ?></td>
        <td><a href="<?php echo $loading['pdf_url'] . '&print_10x9=1'; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a></td>
      </tr>
      <tr>
        <td><?php _e('PDF URL 10x15', 'woocommerce-econt'); ?></td>
        <td><a href="<?php echo $loading['pdf_url'] . '&print_10x15=1'; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a></td>
      </tr>
      <?php } ?>
    </table>
    <?php if ($loading['trackings']) { ?>
    <b><?php _e('Tracking', 'woocommerce-econt'); ?></b>
    <!--<table class="list">-->
    <table class="econt-table">
      <thead>
        <tr>
          <td class="left"><b><?php _e('Time', 'woocommerce-econt'); ?></b></td>
          <td class="left"><b><?php _e('Is receipt', 'woocommerce-econt'); ?></b></td>
          <td class="left"><b><?php _e('Event', 'woocommerce-econt'); ?></b></td>
          <td class="left"><b><?php _e('Name', 'woocommerce-econt'); ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($loading['trackings'] as $tracking) { ?>
        <tr>
          <td class="left"><?php echo $tracking['time']; ?></td>
          <td class="left"><?php echo $tracking['is_receipt']; ?></td>
          <td class="left"><?php echo $tracking['event']; ?></td>
          <td class="left"><?php echo $tracking['name']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <?php if ($loading['next_parcels']) { ?>
    <b><?php _e('Next Parcels', 'woocommerce-econt'); ?></b>
    <?php foreach ($loading['next_parcels'] as $next_parcel) { ?>
    <table class="form">
      <tr>
        <td style="width: 300px;"><?php _e('Loading Number', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['loading_num']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Is imported', 'woocommerce-econt'); ?></td>
        <td><?php if ((int)$next_parcel['is_imported']) { ?>
          <?php _e('yes', 'woocommerce-econt'); ?>
          <?php } else { ?>
          <?php _e('no', 'woocommerce-econt'); ?>
          <?php } ?></td>
      </tr>
      <tr>
        <td><?php _e('Storage', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['storage']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver person', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['receiver_person']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver person Phone', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['receiver_person_phone']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver courier', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['receiver_courier']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver courier phone', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['receiver_courier_phone']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver time', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['receiver_time']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Cash on delivery get sum', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['cd_get_sum']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Cash on delivery get time', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['cd_get_time']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Cash on delivery send sum', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['cd_send_sum']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Cash on delivery send time', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['cd_send_time']; ?></td>
      </tr>
      <tr>
        <td><?php _e('total sum', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['total_sum']; ?> <?php echo $next_parcel['currency']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Sender amount due', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['sender_ammount_due']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Receiver amount due', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['receiver_ammount_due']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Other amount due', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['other_ammount_due']; ?></td>
      </tr>
      <tr>
        <td><?php _e('Delivery attempt count', 'woocommerce-econt'); ?></td>
        <td><?php echo $next_parcel['delivery_attempt_count']; ?></td>
      </tr>
      <tr>
        <td><?php _e('blank yes', 'woocommerce-econt'); ?></td>
        <td><?php if ($next_parcel['blank_yes']) { ?>
          <a href="<?php echo $next_parcel['blank_yes']; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a>
          <?php } ?></td>
      </tr>
      <tr>
        <td><?php _e('blank no', 'woocommerce-econt'); ?></td>
        <td><?php if ($next_parcel['blank_no']) { ?>
          <a href="<?php echo $next_parcel['blank_no']; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a>
          <?php } ?></td>
      </tr>
      <?php if ($next_parcel['pdf_url']) { ?>
      <tr>
        <td><?php _e('PDF URL', 'woocommerce-econt'); ?></td>
        <td><a href="<?php echo $next_parcel['pdf_url']; ?>" target="_blank"><?php _e('View', 'woocommerce-econt'); ?></a></td>
      </tr>
      <?php } ?>
    </table>
    <?php if ($next_parcel['trackings']) { ?>
    <b><?php _e('Tracking', 'woocommerce-econt'); ?></b>
    <!--<table class="list">-->
    <table class="econt-table">
      <thead>
        <tr>
          <td class="left"><?php _e('Time', 'woocommerce-econt'); ?></td>
          <td class="left"><?php _e('Is receipt', 'woocommerce-econt'); ?></td>
          <td class="left"><?php _e('Event', 'woocommerce-econt'); ?></td>
          <td class="left"><?php _e('Name', 'woocommerce-econt'); ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($next_parcel['trackings'] as $tracking) { ?>
        <tr>
          <td class="left"><?php echo $tracking['time']; ?></td>
          <td class="left"><?php echo $tracking['is_receipt']; ?></td>
          <td class="left"><?php echo $tracking['event']; ?></td>
          <td class="left"><?php echo $tracking['name']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    </div>
  </div>
</div>

<!--end of tracking -->
<table>
<tr><td>
<?php if ($loading['is_imported'] == 0){ ?>
<button id='delete_loading' class='button' type='button' ><?php _e('Delete loading', 'woocommerce-econt'); ?></button>
<?php } ?>
</td><td>
<button id='button_request_of_courier' class='button' type='' name='' value=''><?php _e('Request for courier', 'woocommerce-econt'); ?></button>
</td></tr>
</table>
<div id="econtLoader"></div>
<?php } //end of $loading == true

 } ?>

<script type="text/javascript">

function displaySenderDoor() {
  if (jQuery('#sender_door_or_office').val() == 'DOOR2') {
    jQuery('.sender_door2').slideDown();
    jQuery('.sender_office2').hide();
  } else if (jQuery('#sender_door_or_office').val() == 'OFFICE2') {
    jQuery('.sender_office2').slideDown();
    jQuery('.econt_shipping_from_office').slideDown();
    jQuery('#econt_sender_offices_postcode, #econt_sender_offices_field, .sender_door2').hide();
  } else {
    jQuery('.sender_door2').hide();
    jQuery('.sender_office2').hide();
  }
  jQuery('#econt_sender_offices_town, #econt_sender_offices').empty();
  jQuery('#econt_sender_offices_postcode').removeAttr('value');
}

function checkPriorityTime() {
  if (jQuery('#priority_time:checked').length) {
    jQuery('#priority_time_type').removeAttr('disabled');
    jQuery('#priority_time_hour').removeAttr('disabled');
  } else {
    jQuery('#priority_time_type').attr('disabled', 'disabled');
    jQuery('#priority_time_hour').attr('disabled', 'disabled');
  }
}

function setPriorityTime() {
  var type = jQuery('#priority_time_type').val();
  var hour = jQuery('#priority_time_hour').val();

  var html = '<option value="10">10</option>';
  html += '<option value="11">11</option>';
  html += '<option value="12">12</option>';
  html += '<option value="13">13</option>';
  html += '<option value="14">14</option>';
  html += '<option value="15">15</option>';
  html += '<option value="16">16</option>';
  html += '<option value="17">17</option>';

  if (type == 'BEFORE') {
    jQuery('#priority_time_hour').html(html + '<option value="18">18</option>');
  } else if (type == 'IN') {
    jQuery('#priority_time_hour').html('<option value="9">9</option>' + html + '<option value="18">18</option>');
  } else if (type == 'AFTER') {
    jQuery('#priority_time_hour').html('<option value="9">9</option>' + html);
  }

  jQuery('#priority_time_hour').val(hour).attr('selected', 'selected');
}

function displayCityCourierType() {
  if (jQuery('#city_courier').val() == 1) {
    //jQuery('#inventory_type_loading').hide();
    jQuery('#econt_city_courier').show();
  } else if (jQuery('#city_courier').val() == 0) {
    //jQuery('#inventory_type_loading').show();
    jQuery('#econt_city_courier').hide();
    //jQuery('#inventory_type_digital').hide();
  } else {
    //jQuery('#inventory_type_loading').hide();
    jQuery('#econt_city_courier').hide();
    //jQuery('#inventory_type_digital').hide();
  }
}


function displayInventory() {
  if (jQuery('#partial_delivery').val() == 1) {
    //jQuery('#inventory_type_loading').hide();
    jQuery('#inventory').show();
  } else if (jQuery('#partial_delivery').val() == 0) {
    //jQuery('#inventory_type_loading').show();
    jQuery('#inventory').hide();
    jQuery('#inventory_type_digital').hide();
  } else {
    //jQuery('#inventory_type_loading').hide();
    jQuery('#inventory').hide();
    jQuery('#inventory_type_digital').hide();
  }
}


function displayInventoryType() {
  //alert(jQuery('select[name="inventory"]').val() );
  if (jQuery('select[name="inventory"]').val() == 'DIGITAL') {
    //alert('d');
    jQuery('#inventory_type_loading').hide();
    jQuery('#inventory_type_digital').show();
  } else if (jQuery('select[name="inventory"]').val() == 'LOADING') {
    jQuery('#inventory_type_loading').show();
    jQuery('#inventory_type_digital').hide();
  //alert('l');
  } else {
    //alert('e');
    jQuery('#inventory_type_loading').hide();
    jQuery('#inventory_type_digital').hide();
  }
}


var product_row = '<?php echo isset($product_row) ? $product_row: 0; ?>';

function addProduct() {
  html  = '<tr id="product_' + product_row + '">';
  html += '  <td class="left"><input type="text" id="product_id_' + product_row + '" name="products[' + product_row + '][product_id]" value="" size="3" /></td>';
  html += '  <td class="left"><input type="text" id="product_name_' + product_row + '" name="products[' + product_row + '][name]" value="" size="50" /></td>';
  html += '  <td class="left"><input type="text" id="product_weight_' + product_row + '" name="products[' + product_row + '][weight]" value="" size="10" /></td>';
  html += '  <td class="left"><input type="text" id="product_price_' + product_row + '" name="products[' + product_row + '][price]" value="" size="10" /></td>';
  html += '  <td class="left"><a onclick="jQuery(\'#product_' + product_row + '\').remove();" class="button"><span><?php _e('remove', 'woocommerce-econt'); ?></span></a></td>';
  html += '</tr>';

  jQuery('#products').append(html);

  product_row++;
}

//var client_cd_agreement = <?php echo ($econt_options['client_cd_num'] == 0) ?  0 : 1 ; ?>;
var client_cd_agreement = <?php echo "'". $econt_options['client_cd_num'] . "'"; ?>;

jQuery( document ).ready(function() {
  displayInventoryType();
});

</script>