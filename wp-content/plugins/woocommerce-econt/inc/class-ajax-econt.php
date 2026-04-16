<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('Econt_Ajax')) {

	class Econt_Ajax {

public function __construct(){
 // Test #1
 add_action( 'wp_ajax_nopriv_econt_handle_ajax', array( &$this, 'econt_handle_ajax' ) );

 // Test #2 
 add_action( 'wp_ajax_econt_handle_ajax', array(&$this, 'econt_handle_ajax') ); //with and without '&' before $this

 //add the build in wordpress ajax url so we can use it in out js files var ajaxurl
 add_action('wp_head',array(&$this, 'econt_ajaxurl') );

}


		public function econt_handle_ajax(){


	global $wpdb;
	$result = array();
	$res = array();


$econt_mysql = new Econt_mySQL;


if(isset($_GET['city'])){

$city = $_GET['city'];

$country_code = isset($_GET['country_code']) ? $_GET['country_code'] : 'BG';

$results = $econt_mysql->getCityByName($city, $country_code);


foreach ($results as $row) {

	$res['text'] 		= $econt_mysql->transCityType($row['type'], $country_code).' '.$row['name'].' [ ' . __('p.c.: ', 'woocommerce-econt') . $row['post_code'] . ' ' . __('region', 'woocommerce-econt') . ': '. $row['region'] . ' ]';
	$res['id'] 			= $row['name'];
	$res['post_code'] 	= $row['post_code'];
	$res['city_id'] 	= $row['city_id'];

	$result[] = $res;

}
}

if(isset($_GET['office_city_id'])){

$city_id = $_GET['office_city_id'];
$city_name = isset($_GET['office_city_name']) ? $_GET['office_city_name'] : 'няма';
/*
* bez "delivery_type" zashtoto togava query-to machva office_code na wp_econt_office i 
* wp_econt_city_office. Primer: Vylchi Dol v wp_econt_office ( request type offices - ) e 
* 9171@9280 a v wp_econt_city_office (request type - cities) e 9171
*/
//$results = $econt_mysql->getOfficesByCityId($city_id,'',$_GET['delivery_type']);
$results = $econt_mysql->getOfficesByCityId($city_id, $city_name);

foreach ($results as $row) {

	$res['value'] = $row['name'].' ['.$row['address'].']';
	$res['id'] = $row['office_code'];
	$res['name'] = $row['name'];
	$res['description'] = $row['name'] . ' [ ' . __(' address: ', 'woocommerce-econt') . $row['address'] . __(', phone: ', 'woocommerce-econt') . $row['phone'] .' ] [ ' . __(' o.c.: ', 'woocommerce-econt') . $row['office_code'] . ' ] ';
	$res['latitude'] = (float)$row['latitude'];
	$res['longitude'] = (float)$row['longitude'];

	$result[] = $res;
	
}

}


if(isset($_GET['machine_city_id'])){

$city_id = $_GET['machine_city_id'];
$city_name = isset($_GET['machine_city_name']) ? $_GET['machine_city_name'] : 'няма';
$is_machine = 1;
$results = $econt_mysql->getOfficesByCityId($city_id, $city_name, $is_machine);

foreach ($results as $row) {

	$res['value'] = $row['name'].' ['.$row['address'].']';
	$res['id'] = $row['office_code'];
	$res['name'] = $row['name'];
	$res['description'] = $row['name'] . ' [ ' . __(' address: ', 'woocommerce-econt') . $row['address'] . __(', phone: ', 'woocommerce-econt') . $row['phone'] .' ] [ ' . __(' o.c.: ', 'woocommerce-econt') . $row['office_code'] . ' ] ';
	$res['latitude'] = (float)$row['latitude'];
	$res['longitude'] = (float)$row['longitude'];

	$result[] = $res;
	
}

}


if(isset($_GET['door_city_id']) && $_GET['type'] == 'street'){

$city_id = $_GET['door_city_id'];
$street_name = $_GET['door_street_name'];
$country_code = $_GET['country_code'];

$results = $econt_mysql->getStreetsByCityId($city_id, $street_name, $country_code);

foreach ($results as $row) {

	$res['text'] = $row['name'];
	$res['id'] = $row['name'];

	$result[] = $res;
	
}

}

if(isset($_GET['door_city_id']) && $_GET['type'] == 'quarter'){

$city_id = $_GET['door_city_id'];
$quarter_name = $_GET['door_quarter_name'];
$country_code = $_GET['country_code'];

$results = $econt_mysql->getQuartersByCityId($city_id, $quarter_name, $country_code);

foreach ($results as $row) {

	$res['text'] = $row['name'];
	$res['id'] = $row['name'];

	$result[] = $res;
	
}

}

//refresh Econt addresses database
if(isset($_GET['refresh_data'])){

$results = $econt_mysql->refreshData();
if(array_key_exists('error', $results)){
	$result['msg'] =  $results['error'];
	$result['error'] = 1;
}else{
	$result['msg'] = __('refresh data success', 'woocommerce-econt');
	$result['error'] = 0;	
}

}

//refresh Econt international addresses database
if(isset($_GET['refresh_data_intl'])){

$results = $econt_mysql->refreshDataIntl();
if(array_key_exists('error', $results)){
	$result['msg'] =  $results['error'];
	$result['error'] = 1;
}else{
	$result['msg'] = __('refresh data success', 'woocommerce-econt');
	$result['error'] = 0;	
}

}

//refresh Econt profile database
if(isset($_GET['sync_profile']) && isset($_GET['username']) && isset($_GET['password'])){

$username 		= $_GET['username'];
$password 		= $_GET['password'];
$live			= $_GET['live'];
$profile 		= $econt_mysql->getProfile($username, $password, $live);
$access_clients = $econt_mysql->getClients($username, $password, $live);

if( array_key_exists('error', $profile) || array_key_exists('error', $access_clients) ){
	$result['msg'] = 'profile Error: ' . $profile['error'] . 'access_clients Error: ' . $access_clients['error'] ;
	$result['error'] = 1;
}else{
	$profile = Econt_mySQL::xml2array($profile);
	$access_clients = Econt_mySQL::xml2array($access_clients);
	update_option('econt_profile', $profile);
	update_option('econt_access_clients', $access_clients);
	$result['msg'] = __('refresh data success', 'woocommerce-econt');	
	$result['error'] = 0;
}

}

//order loading
if(isset($_POST['action2'])){

$econt_options = get_option('econt_shipping_method_options');
if( $_POST['action2'] == 'only_calculate_loading'){
	$result = $econt_mysql->create_loading($_POST, 1);

	if($result['order_id'] > 0 && ! array_key_exists('warning', $result)){
		$order = wc_get_order( $result['order_id'] );
		if(!empty($econt_options['inc_shipping_cost'])){
			foreach( $order->get_items( 'shipping' ) as $item_id => $item ){
				if( $item->get_method_id() === 'econt_shipping_method' ) {
					$econt_total = (wc_tax_enabled()) ? Econt_mySQL::remove_vat_from_shipping_price($result['customer_shipping_cost']) : $result['customer_shipping_cost'];
					$item->set_total( $econt_total );
					$item->save();
					$order->calculate_totals();
					break; // stop the loop
				}
			}
		}

		$order->update_meta_data( 'Econt_Customer_Shipping_Cost', sanitize_text_field($result['customer_shipping_cost']) );
		$order->update_meta_data( 'Econt_Total_Shipping_Cost', sanitize_text_field($result['total_shipping_cost']) );
		$order->save();
	}

}elseif($_POST['action2'] == 'create_loading'){
	if(isset($_POST['action3']) && $_POST['action3'] == 'fast'){	
		$loading_data = $econt_mysql->default_loading_data($_POST['order_id']);
	}else{
		$loading_data = $_POST;
	}
	$result = $econt_mysql->create_loading($loading_data, 0);
	if(! array_key_exists('warning', $result)){
		$order = wc_get_order( $result['order_id'] );
		if(!empty($econt_options['inc_shipping_cost'])){
			foreach( $order->get_items( 'shipping' ) as $item_id => $item ){
				if( $item->get_method_id() === 'econt_shipping_method' ) {
					$econt_total = (wc_tax_enabled()) ? Econt_mySQL::remove_vat_from_shipping_price($result['customer_shipping_cost']) : $result['customer_shipping_cost']; 
					$item->set_total( $econt_total );
					$item->save();
					$order->calculate_totals();
					break; // stop the loop
				}
			}
		}

		$order->update_meta_data( 'Econt_Customer_Shipping_Cost', sanitize_text_field($result['customer_shipping_cost']) );
		$order->update_meta_data( 'Econt_Total_Shipping_Cost', sanitize_text_field($result['total_shipping_cost']) );
		$order->save();
		
		if(!empty($econt_options['send_tracking_email'])){
			
			$locale = 'bg_BG';
			//if WooCommerce WPML is active use order locale
			if ( class_exists('woocommerce_wpml') ) {
				$lang = get_post_meta($order->get_id(), 'wpml_language', true);
				if( !empty($lang) ){
					$locale = strtolower($lang) . '_' . strtoupper($lang);
				}
			}

			$econt_mysql->send_email(array(
				'email' => $loading_data['receiver_email'],
				'name' => $loading_data['receiver_name_person'],
				'loading_num' => $result['loading_num'],
				//'order_id' => $_POST['order_id'],
				'order_num' => $loading_data['order_num'],
				'tracking_email_from_name' => $econt_options['tracking_email_from_name'],
				'tracking_email_from_address' => $econt_options['tracking_email_from_address'],
					), $locale);
		}

	}

}elseif($_POST['action2'] == 'delete_loading'){
	$results = $econt_mysql->deleteLoading(array(
		'loading_num' => $_POST['loading_num'], 
		'username' 	  => $econt_options['username'], 
		'password'	  => $econt_options['password'], 
		'live' 		  => $econt_options['live'],
	));

	if(array_key_exists('error', $results)){
		$result['msg'] =  $results['error'];
		$result['error'] = 1;
	}else{
		$result['msg'] = __('loading is canceled', 'woocommerce-econt');
		$result['error'] = 0;	
	}
}elseif($_POST['action2'] == 'edit_receiver_address'){//end of 'action2 == delete loading' if

	$validation = $econt_mysql->receiver_address_validation($_POST);
	if($validation['valid'] === true){
		if($_POST['type'] == 'user'){
			$econt_mysql->shipping_field_update_user_meta($_POST['id'], $_POST);
			if(isset($_POST['billing_country']) && !empty($_POST['billing_country'])){
				$customer = new WC_Customer($_POST['id']);
        		$customer->set_billing_country($_POST['billing_country']);
        		$customer->save();
			}
		}elseif($_POST['type'] == 'order'){
			$econt_mysql->shipping_field_update_order_meta($_POST['id'], $_POST);
	        $econt_mysql->modify_billing_and_shipping_address_data($_POST['id']);
			$current_user = wp_get_current_user();
			$order = wc_get_order(  $_POST['id'] );
			// The text for the note
			$note = __('Econt shipping address has been changed by ', 'woocommerce-econt') . $current_user->display_name;
			// Add the note
			$order->add_order_note( $note );
			// Save the data
			$order->save();
		}
	}else{
		$result['warning'] = $validation['msg'];
	}

}elseif($_POST['action2'] == 'loading_tracking'){//end of 'action2 == edit_receiver_address' if
	$results = $econt_mysql->serviceTool(array(
		'live' =>  $econt_options['live'],
		'username' => $econt_options['username'],
		'password' => $econt_options['password'],
		'type' => 'shipments',
		'xml'  => "<shipments full_tracking='ON'><num>" . $_POST['loading_num'] . '</num></shipments>'
	));
	
	$result['tracking'] = array();
	$l = explode('_', get_locale());
	$result['lang'] = $l[0];

	if ($results) {
		if (isset($results->shipments->e->error)) {

			$result['error'] = (string)$results->shipments->e->error;

		} elseif (isset($results->error)) {

			$result['error'] = (string)$results->error->message;

		} elseif (isset($results->shipments->e)) {

			if (isset($results->shipments->e->tracking)) {
				foreach ($results->shipments->e->tracking->row as $tracking) {
					$result['tracking'][] = array(
						'time'       => $tracking->time,
						'is_receipt' => $tracking->is_receipt,
						'event'      => $tracking->event,
						'name'       => $tracking->name,
						'name_en'    => $tracking->name_en
					);
				}
			}

		}
	}
	$result['type'] = 'loading_tracking';
	$result['loading_num'] = $_POST['loading_num'];
	$result['url'] = plugins_url( 'woocommerce-econt/admin/view/html-modal-view.php' );
}//end of 'action2 == loading_tracking' if


//tracking
if($_POST['action2'] == 'loading_tracking'){
	$results = $econt_mysql->serviceTool(array(
		'live' =>  $econt_options['live'],
		'username' => $econt_options['username'],
		'password' => $econt_options['password'],
		'type' => 'shipments',
		'xml'  => "<shipments full_tracking='ON'><num>" . $_POST['loading_num'] . '</num></shipments>'
	));
	
	$result['tracking'] = array();
	$l = explode('_', get_locale());
	$result['lang'] = $l[0];
	$html = '<table class="speedy-colorbox-table">';
	if ($results) {
		if (isset($results->shipments->e->error)) {

			$result['error'] = (string)$results->shipments->e->error;
			$html .= '<tr><td><font color="red">' . __('ERROR:', 'woocommerce-econt') . '</font></td><td><font color="red">' . $result['error'] . '</font></td><tr>';

		} elseif (isset($results->error)) {

			$result['error'] = (string)$results->error->message;
			$html .= '<tr><td><font color="red">' . __('ERROR:', 'woocommerce-econt') . '</font></td><td><font color="red">' . $result['error'] . '</font></td><tr>';

		} elseif (isset($results->shipments->e)) {

			if (isset($results->shipments->e->tracking)) {
				$html .= '<thead>
					    <tr>
					      <td colspan=\'5\'><strong>' . __('Shipment tracking - waybill No:', 'woocommerce-econt') . ' ' . $_POST['loading_num'] . '</strong></td>
					    </tr>
					    <tr>
					      <td>' . __('Time', 'woocommerce-econt') . '</td>
					      <td>' . __('Is it a return receipt movement', 'woocommerce-econt') . '</td>
					      <td>' . __('Event', 'woocommerce-econt') . '</td>
					      <td>' . __('Name', 'woocommerce-econt') . '</td>
					    </tr>
					  </thead>
					  <tbody>';
				$l = explode('_', get_locale());
				$result['lang'] = $l[0];

				foreach ($results->shipments->e->tracking->row as $tracking) {
					$result['tracking'][] = array(
						'time'       => $tracking->time,
						'is_receipt' => $tracking->is_receipt,
						'event'      => $tracking->event,
						'name'       => $tracking->name,
						'name_en'    => $tracking->name_en
					);

					$name = $tracking->name_en;
				    if($result['lang'] == 'bg'){
				      $name = $tracking->name;
				    }
				    $is_receipt = __('yes', 'woocommerce-econt');
				    if(empty($tracking->is_receipt)){
				    	$is_receipt = __('no', 'woocommerce-econt');
				    }
					$html .= '<tr>
						    	<td>' . $tracking->time . '</td>
						    	<td>' . $is_receipt . '</td>
								<td>' . $tracking->event . '</td>
								<td>' . $name . '</td>
							<tr>';

				}
				$html .= '</tbody>';
			}

		}
		$html .= '</table>';
	}
	$result['type'] = 'loading_tracking';
	$result['loading_num'] = $_POST['loading_num'];
	$result['url'] = plugins_url( 'woocommerce-econt/admin/view/html-modal-view.php' );

	$result['html'] = $html;

}//end of 'action2 == loading_tracking' if
//end tracking

//fast loading form
if($_POST['action2'] == 'fast_loading_form'){
	$order = wc_get_order( $_POST['order_id'] );
	$result['type'] = 'fast_loading_form';
	$result['order_id'] = $_POST['order_id'];
	//$result['url'] = plugins_url( 'woocommerce-econt/admin/view/html-modal-view.php' );
	$html = '<html>
	<head>
	<script language="JavaScript" type="text/javascript" src="' . ECONT_PLUGIN_URL . 'inc/js/econt.js.?ver=' . ECONT_VERSION_NUM . '"></script>
	<style type="text/css">
	#econtLoader {
		display: none;
	}
	</style>
	</head>
	<body>';
	//ob_start();
	//include( ECONT_PLUGIN_DIR . '/admin/view/html-order-edit-address-view.php' );
	//$html .= ob_get_clean();
	ob_start();
	include( ECONT_PLUGIN_DIR . '/admin/view/html-order-view.php' );
	$html .= ob_get_clean();
	$html .= '</body></html>';
	$result['html'] = $html;

}//end of 'action2 == fast_loading_form' if

} //end of action2 if

$response = json_encode($result, JSON_UNESCAPED_UNICODE);
//$response = json_encode($result);

	echo $response;
	exit();


	}


	public function econt_ajaxurl() {
		?>
		<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
		<?php

	}

	private function is_receipt_text($is_receipt, $lang){
  if(empty($is_receipt)){
    return tr($lang . '_no');
  }
  return tr($lang . '_yes');
}
	private function tr($string){
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

}
}
$Econt_Ajax = new Econt_Ajax;

// add the shipping packages filter 
add_filter( 'woocommerce_cart_shipping_packages', 'econt_filter_woocommerce_cart_shipping_packages', 10, 1 ); 

function econt_filter_woocommerce_cart_shipping_packages( $array ) { 
	$econt_options = get_option('econt_shipping_method_options');

	if ( is_checkout() && (bool)$econt_options['inc_shipping_cost'] == true ) {
    	if(!isset($_SESSION)){ 
        	session_start(); 
    	}  
    	if(array_key_exists ( 'econt_shipping_cost' , $_SESSION )){
    		$array[0]['econt_customer_shipping_cost'] = $_SESSION['econt_shipping_cost'];
    	}
	}

	return $array; 
}

//disable COD for shipping to APS 
/*add_filter( 'woocommerce_available_payment_gateways', 'econt_disable_cod_for_aps');
  
function econt_disable_cod_for_aps( $available_gateways ) {
   if ( is_checkout() ) {
      $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
      $chosen_shipping = $chosen_methods[0];
      if(!isset($_SESSION)){ 
        session_start(); 
      }
      $econt_receiver_shipping_to = '';
      if(array_key_exists ( 'econt_receiver_shipping_to' , $_SESSION )){
    		$econt_receiver_shipping_to = $_SESSION['econt_receiver_shipping_to'];
    	}

      if ( isset( $available_gateways['cod'] ) && 0 === strpos( $chosen_shipping, 'econt_shipping_method' ) && $econt_receiver_shipping_to == 'MACHINE' ) {
         unset( $available_gateways['cod'] );
      }
   }
   return $available_gateways;
}*/

