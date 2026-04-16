<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('Econt_mySQL')) {
class Econt_mySQL {
	
	//private $delivery_type = 'to_office';
	
	private static $country_codes = array('BG' => 'BGR', 'GR' => 'GRC', 'RO' => 'ROU');

	function __construct(){
	if (get_option(ECONT_VERSION_KEY) != ECONT_VERSION_NUM) {
    	$this->econt_update_database_table();
    	//refresh data on plugin update
    	wp_schedule_single_event( time() + 30, 'econt_refresh_data_action' );
    	wp_schedule_single_event( time() + 90, 'econt_refresh_data_intl_action' );
    	update_option(ECONT_VERSION_KEY, ECONT_VERSION_NUM);
	}
		//create tables when the plugin is installed 
		register_activation_hook( __FILE__, array($this, 'createTables') );

		//plugin upgrade notice
		add_action('in_plugin_update_message-woocommerce-econt/woocommerce-econt.php', array($this, 'show_upgrade_notification'), 10, 2);

		//admin notice on plugin activation
		add_action( 'admin_notices', array($this,'econt_admin_activation_notice') );

		//Hook into that action that'll fire once on plugin update
		add_action('econt_refresh_data_action', array($this, 'refreshData'));
		add_action('econt_refresh_data_intl_action', array($this, 'refreshDataIntl'));
		
	}

	public function econt_update_database_table(){
       	//mysql tables updates for new version of the plugin
		global $wpdb;
		//since version 1.4.4
		$office_code_length1 = $wpdb->get_var("SELECT CHARACTER_MAXIMUM_LENGTH FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '" . $wpdb->prefix . "econt_city_office' AND COLUMN_NAME = 'office_code'");

		if( (int)$office_code_length1 != 32 ){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_city_office MODIFY office_code varchar(32) NOT NULL DEFAULT ''");
		}
		
		$office_code_length2 = $wpdb->get_var("SELECT CHARACTER_MAXIMUM_LENGTH FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '" . $wpdb->prefix . "econt_office' AND COLUMN_NAME = 'office_code'");	

		if( (int)$office_code_length2 != 32 ){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_office MODIFY office_code varchar(32) NOT NULL DEFAULT ''");
		}
		//since version 1.4.8
		self::createTables(); //create International addresses tables if missing
		if($wpdb->get_var("SHOW COLUMNS FROM ".$wpdb->prefix."econt_city LIKE 'region_en'") != 'region_en'){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_city ADD COLUMN region_en VARCHAR(255) NOT NULL DEFAULT '' AFTER name");
		}
		if($wpdb->get_var("SHOW COLUMNS FROM ".$wpdb->prefix."econt_city LIKE 'region'") != 'region'){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_city ADD COLUMN region VARCHAR(255) NOT NULL DEFAULT '' AFTER name");
		}
		if($wpdb->get_var("SHOW COLUMNS FROM ".$wpdb->prefix."econt_city_intl LIKE 'region_en'") != 'region_en'){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_city_intl ADD COLUMN region_en VARCHAR(255) NOT NULL DEFAULT '' AFTER name");
		}
		if($wpdb->get_var("SHOW COLUMNS FROM ".$wpdb->prefix."econt_city_intl LIKE 'region'") != 'region'){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_city_intl ADD COLUMN region VARCHAR(255) NOT NULL DEFAULT '' AFTER name");
		}
		//since version 1.5.0
		if($wpdb->get_var("SHOW COLUMNS FROM ".$wpdb->prefix."econt_office LIKE 'longitude'") != 'longitude'){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_office ADD COLUMN longitude DECIMAL(11,8) NOT NULL DEFAULT '0' AFTER address_en");
		}
		if($wpdb->get_var("SHOW COLUMNS FROM ".$wpdb->prefix."econt_office LIKE 'latitude'") != 'latitude'){
			$wpdb->query("ALTER TABLE " . $wpdb->prefix . "econt_office ADD COLUMN latitude DECIMAL(10,8) NOT NULL DEFAULT '0' AFTER address_en");
		}
		

    }

	public static function createTables() {
    global $wpdb;
	//to enable dbDelta
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

     $collate = $wpdb->get_charset_collate();


		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_city'") != $wpdb->prefix . 'econt_city'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_city (
		  city_id int(11) NOT NULL AUTO_INCREMENT,
		  post_code varchar(10) NOT NULL DEFAULT '',
		  type varchar(3) NOT NULL DEFAULT '' COMMENT '‘гр.’ или ‘с.’',
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  region varchar(255) NOT NULL DEFAULT '',
		  region_en varchar(255) NOT NULL DEFAULT '',
		  zone_id int(11) NOT NULL DEFAULT '3' COMMENT '3 - Зона В',
		  country_id int(11) NOT NULL DEFAULT '1033' COMMENT '1033 - България',
		  office_id int(11) NOT NULL DEFAULT '0' COMMENT 'главния офис',
		  country_code varchar(3) NOT NULL DEFAULT '',
		  PRIMARY KEY  (city_id),
		  KEY post_code (post_code),
		  KEY name (name),
		  KEY name_en (name_en),
		  KEY office_id (office_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_city_intl'") != $wpdb->prefix . 'econt_city_intl'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_city_intl (
		  city_id int(11) NOT NULL AUTO_INCREMENT,
		  post_code varchar(10) NOT NULL DEFAULT '',
		  type varchar(3) NOT NULL DEFAULT '' COMMENT '‘гр.’ или ‘с.’',
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  region varchar(255) NOT NULL DEFAULT '',
		  region_en varchar(255) NOT NULL DEFAULT '',
		  zone_id int(11) NOT NULL DEFAULT '0',
		  country_id int(11) NOT NULL DEFAULT '0',
		  office_id int(11) NOT NULL DEFAULT '0',
		  country_code varchar(3) NOT NULL DEFAULT '',
		  PRIMARY KEY  (city_id),
		  KEY post_code (post_code),
		  KEY name (name),
		  KEY name_en (name_en),
		  KEY office_id (office_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_city_office'") != $wpdb->prefix . 'econt_city_office'){
		
		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_city_office (
		  city_office_id int(11) NOT NULL AUTO_INCREMENT,
		  office_code varchar(32) NOT NULL DEFAULT '',
		  shipment_type varchar(32) NOT NULL DEFAULT '',
		  delivery_type varchar(32) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY  (city_office_id),
		  KEY office_code (office_code),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}


		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_country'") != $wpdb->prefix . 'econt_country'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_country (
		  country_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  zone_id int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY  (country_id),
		  KEY zone_id (zone_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}


		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_customer'") != $wpdb->prefix . 'econt_customer'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_customer (
		  customer_id int(11) NOT NULL,
		  shipping_to varchar(32) NOT NULL DEFAULT '',
		  company varchar(32) NOT NULL DEFAULT '',
		  postcode varchar(10) NOT NULL DEFAULT '',
		  city varchar(255) NOT NULL DEFAULT '',
		  quarter varchar(255) NOT NULL DEFAULT '',
		  street varchar(255) NOT NULL DEFAULT '',
		  street_num varchar(10) NOT NULL DEFAULT '',
		  other varchar(255) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  office_id int(11) NOT NULL DEFAULT '0',
		  KEY customer_id (customer_id),
		  KEY city_id (city_id),
		  KEY office_id (office_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}


		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_loading'") != $wpdb->prefix . 'econt_loading'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_loading (
		  econt_loading_id int(11) NOT NULL AUTO_INCREMENT,
		  order_id int(11) NOT NULL DEFAULT '0',
		  loading_id varchar(32) NOT NULL DEFAULT '',
		  loading_num varchar(32) NOT NULL DEFAULT '',
		  is_imported tinyint(1) NOT NULL DEFAULT '0',
		  storage varchar(255) NOT NULL DEFAULT '',
		  receiver_person varchar(255) NOT NULL DEFAULT '',
		  receiver_person_phone varchar(255) NOT NULL DEFAULT '',
		  receiver_courier varchar(255) NOT NULL DEFAULT '',
		  receiver_courier_phone varchar(255) NOT NULL DEFAULT '',
		  receiver_time datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  cd_get_sum varchar(32) NOT NULL DEFAULT '',
		  cd_get_time datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  cd_send_sum varchar(32) NOT NULL DEFAULT '',
		  cd_send_time datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  total_sum varchar(32) NOT NULL DEFAULT '',
		  order_total_sum varchar(32) NOT NULL DEFAULT '',
		  currency varchar(10) NOT NULL DEFAULT '',
		  sender_ammount_due varchar(32) NOT NULL DEFAULT '',
		  receiver_ammount_due varchar(32) NOT NULL DEFAULT '',
		  other_ammount_due varchar(32) NOT NULL DEFAULT '',
		  delivery_attempt_count varchar(10) NOT NULL DEFAULT '',
		  customer_shipping_cost float(8,2) NOT NULL DEFAULT '0.00',
		  total_shipping_cost float(8,2) NOT NULL DEFAULT '0.00',
		  pdf_url varchar(255) NOT NULL DEFAULT '',
		  prev_parcel_num varchar(32) NOT NULL DEFAULT '',
		  next_parcel_reason varchar(32) NOT NULL DEFAULT '',
		  is_returned tinyint(1) NOT NULL DEFAULT '0',
		  returned_blank_yes varchar(255) NOT NULL DEFAULT '',
		  blank_yes varchar(255) NOT NULL DEFAULT '',
		  blank_no varchar(255) NOT NULL DEFAULT '',
		  PRIMARY KEY  (econt_loading_id),
		  KEY order_id (order_id)
		) ENGINE=InnoDB " .$collate;
		
		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_loading_tracking'") != $wpdb->prefix . 'econt_loading_tracking'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_loading_tracking (
		  econt_loading_tracking_id int(11) NOT NULL AUTO_INCREMENT,
		  econt_loading_id int(11) NOT NULL DEFAULT '0',
		  loading_num varchar(32) NOT NULL DEFAULT '',
		  time datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  is_receipt tinyint(1) NOT NULL DEFAULT '0',
		  event varchar(32) NOT NULL DEFAULT '',
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  PRIMARY KEY  (econt_loading_tracking_id),
		  KEY econt_loading_id (econt_loading_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_office'") != $wpdb->prefix . 'econt_office'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_office (
		  office_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  office_code varchar(32) NOT NULL DEFAULT '',
		  is_machine varchar(10) NOT NULL DEFAULT '',
		  address varchar(255) NOT NULL DEFAULT '',
		  address_en varchar(255) NOT NULL DEFAULT '',
		  latitude DECIMAL(10,8) NOT NULL DEFAULT '0',
		  longitude DECIMAL(11,8) NOT NULL DEFAULT '0',
		  phone varchar(32) NOT NULL DEFAULT '',
		  work_begin time DEFAULT '09:00:00',
		  work_end time DEFAULT '18:00:00',
		  work_begin_saturday time DEFAULT '09:00:00',
		  work_end_saturday time DEFAULT '13:00:00',
		  time_priority time DEFAULT '12:00:00' COMMENT 'минимален приоритетен час',
		  city_id int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY  (office_id),
		  KEY office_code (office_code),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_order'") != $wpdb->prefix . 'econt_order'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_order (
		  econt_order_id int(11) NOT NULL AUTO_INCREMENT,
		  order_id int(11) NOT NULL DEFAULT '0',
		  data text NOT NULL,
		  PRIMARY KEY  (econt_order_id),
		  KEY order_id (order_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_quarter'") != $wpdb->prefix . 'econt_quarter'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_quarter (
		  quarter_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY  (quarter_id),
		  KEY name (name),
		  KEY name_en (name_en),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_quarter_intl'") != $wpdb->prefix . 'econt_quarter_intl'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_quarter_intl (
		  quarter_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  country_code varchar(3) NOT NULL DEFAULT '',
		  PRIMARY KEY  (quarter_id),
		  KEY name (name),
		  KEY name_en (name_en),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}
		
		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_region'") != $wpdb->prefix . 'econt_region'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_region (
		  region_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  code varchar(10) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY  (region_id),
		  KEY name (name),
		  KEY code (code),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_street'") != $wpdb->prefix . 'econt_street'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_street (
		  street_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY  (street_id),
		  KEY name (name),
		  KEY name_en (name_en),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_street_intl'") != $wpdb->prefix . 'econt_street_intl'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_street_intl (
		  street_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  city_id int(11) NOT NULL DEFAULT '0',
		  country_code varchar(3) NOT NULL DEFAULT '',
		  PRIMARY KEY  (street_id),
		  KEY name (name),
		  KEY name_en (name_en),
		  KEY city_id (city_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}

		if($wpdb->get_var("show tables like '".$wpdb->prefix."econt_zone'") != $wpdb->prefix . 'econt_zone'){

		$sql = "CREATE TABLE " . $wpdb->prefix . "econt_zone (
		  zone_id int(11) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL DEFAULT '',
		  name_en varchar(255) NOT NULL DEFAULT '',
		  national tinyint(1) NOT NULL DEFAULT '1',
		  is_ee tinyint(1) NOT NULL DEFAULT '1',
		  PRIMARY KEY  (zone_id)
		) ENGINE=InnoDB " .$collate;

		dbDelta($sql);
		}
	
		add_option(ECONT_VERSION_KEY, ECONT_VERSION_NUM);
	

	}


	public function deleteTables() {
		global $wpdb;
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_city`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_city_intl`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_city_office`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_country`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_customer`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_loading`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_office`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_order`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_quarter`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_region`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_street`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_zone`");
		$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "econt_loading_tracking`");
	}

	public function deleteCountries() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_country");
	}

	public function addCountry($data) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_country SET name = '" . $data['name'] . "', name_en = '" . $data['name_en'] . "', zone_id = '" . (int)$data['zone_id'] . "'");
	}

	public function deleteZones() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_zone");
	}

	public function addZone($data) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_zone SET zone_id = '" . (int)$data['zone_id'] . "', name = '" . $data['name'] . "', name_en = '" . $data['name_en'] . "', national = '" . (int)$data['national'] . "', is_ee = '" . (int)$data['is_ee'] . "'");
	}

	public function deleteRegions() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_region");
	}

	public function addRegion($data) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_region SET region_id = '" . (int)$data['region_id'] . "', name = '" . $data['name'] . "', code = '" . $data['code'] . "', city_id = '" . (int)$data['city_id'] . "'");
	}

	public function deleteQuarters() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_quarter");
	}

	public function deleteQuartersIntl() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_quarter_intl");
	}

	public function addQuarter($data) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_quarter SET quarter_id = '" . (int)$data['quarter_id'] . "', name = '" . $data['name'] . "', name_en = '" . $data['name_en'] . "', city_id = '" . (int)$data['city_id'] . "'");
	}

	public function deleteStreets() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_street");
	}

	public function deleteStreetsIntl() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_street_intl");
	}

	public function addStreet($data) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_street SET street_id = '" . (int)$data['street_id'] . "', name = '" . $data['name'] . "', name_en = '" . $data['name_en'] . "', city_id = '" . (int)$data['city_id'] . "'");
	}

	public function deleteOffices() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_office");
	}

	//public function deleteOfficesIntl() {
	//	global $wpdb;
	//	$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_office_intl");
	//}

	public function deleteCities() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_city");
	}

	public function deleteCitiesIntl() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_city_intl");
	}

	public function deleteCitiesOffices() {
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "econt_city_office");
	}

	public function getCityByNameAndPostcode($name, $postcode) {
		global $wpdb;
		$name = mb_strtolower($name);
		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}
		$sql = "SELECT *, c.name" . $suffix . " FROM " . $wpdb->prefix . "econt_city c WHERE (LCASE(TRIM(c.name)) = '" . trim($name) . "' OR LCASE(TRIM(c.name_en)) = '" . trim($name) . "') AND TRIM(c.post_code) = '" . trim($postcode) . "'";
		$results = $wpdb->get_results( $sql, ARRAY_A);

		return $results;
	}

	public function getCityByName($name, $country_code = 'BG') {
		global $wpdb;
		//$country_codes = array('GR' => 'GRC', 'RO' => 'ROU');
		$name = mb_strtolower($name);
		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
			$name = ($name == 'sofiq') ? 'sofia' : $name; //fix pri tursene na Sofiq vmesto Sofia
		} else {
			$suffix = '';
		}
		if( $country_code == 'GR' || $country_code == 'RO'){
			$sql = "SELECT *, c.name" . $suffix . " AS name, c.region" . $suffix . " AS region FROM " . $wpdb->prefix . "econt_city_intl c WHERE (LCASE(TRIM(c.name)) like '" . trim($name) . "%' OR LCASE(TRIM(c.name_en)) like '" . trim($name) . "%') AND country_code = '" . self::$country_codes[$country_code] . "'";
		}else{
			$sql = "SELECT *, c.name" . $suffix . " AS name, c.region" . $suffix . " AS region FROM " . $wpdb->prefix . "econt_city c WHERE (LCASE(TRIM(c.name)) like '" . trim($name) . "%' OR LCASE(TRIM(c.name_en)) like '" . trim($name) . "%')";
		}

		$results = $wpdb->get_results( $sql, ARRAY_A);

		return $results;
	}

	public function getQuartersByCityId($city_id, $name, $country_code = 'BG', $limit = 10) {
		global $wpdb;
		//$country_codes = array('GR' => 'GRC', 'RO' => 'ROU');
		$name = mb_strtolower($name);

		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}
		if( $country_code == 'GR' || $country_code == 'RO'){
			$sql = "SELECT *, q.name" . $suffix . " AS name FROM " . $wpdb->prefix . "econt_quarter_intl q WHERE country_code = '" . self::$country_codes[$country_code] . "'";
		}else{
			$sql = "SELECT *, q.name" . $suffix . " AS name FROM " . $wpdb->prefix . "econt_quarter q WHERE 1";
		}
		if ($name) {
			$sql .= " AND (LCASE(q.name) LIKE '%" . $name . "%' OR LCASE(q.name_en) LIKE '%" . $name . "%')";
		}

		if ($city_id) {
			$sql .= " AND q.city_id = '" . (int)$city_id . "'";
		}

		$sql .= " ORDER BY q.name" . $suffix;

		$sql .= " LIMIT " . (int)$limit;

		$query = $wpdb->get_results($sql, ARRAY_A);

		return $query;
	}

	public function getStreetsByCityId($city_id, $name, $country_code = 'BG', $limit = 10) {
		global $wpdb;
		//$country_codes = array('GR' => 'GRC', 'RO' => 'ROU');
		$name = mb_strtolower($name);

		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}
		if( $country_code == 'GR' || $country_code == 'RO'){
			$sql = "SELECT *, s.name" . $suffix . " AS name FROM " . $wpdb->prefix . "econt_street_intl s WHERE country_code = '" . self::$country_codes[$country_code] . "'";
		}else{
			$sql = "SELECT *, s.name" . $suffix . " AS name FROM " . $wpdb->prefix . "econt_street s WHERE 1";
		}
		if ($name) {
			$sql .= " AND (LCASE(s.name) LIKE '%" . $name . "%' OR LCASE(s.name_en) LIKE '%" . $name . "%')";
		}

		if ($city_id) {
			$sql .= " AND s.city_id = '" . (int)$city_id . "'";
		}

		$sql .= " ORDER BY s.name" . $suffix;

		$sql .= " LIMIT " . (int)$limit;

		$query = $wpdb->get_results($sql, ARRAY_A);

		return $query;
	}

	public function getOfficesByCityId($city_id, $name, $is_machine = '', $delivery_type = '') {
		global $wpdb;

		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}

		$sql = "SELECT *, o.name" . $suffix . " AS name, o.address" . $suffix . " AS address, o.phone AS phone, o.latitude AS latitude, o.longitude AS longitude FROM " . $wpdb->prefix . "econt_office o ";

		if ($delivery_type) {
			$sql .= " INNER JOIN " . $wpdb->prefix . "econt_city_office eco ON o.office_code = eco.office_code AND o.city_id = eco.city_id AND eco.delivery_type = '" . $delivery_type . "' ";
		}

		$sql .= " WHERE o.city_id = '" . (int)$city_id . "' ";
		
		if($is_machine) {
			$sql .= " AND o.is_machine = 1 ";
		}else{
			$sql .= " AND o.is_machine != 1 ";	
		}
		
		$sql .= " GROUP BY o.office_id ORDER BY o.name" . $suffix;

		$query = $wpdb->get_results($sql, ARRAY_A);

		return $query;
	}

	public function getCityIdByCityPostCode($city_post_code) {
		global $wpdb;
		return (int)$wpdb->get_var( "SELECT city_id FROM " . $wpdb->prefix . "econt_city WHERE post_code = '" . $city_post_code . "'" );
	}

	public function getOfficeByOfficeCode($office_code) {
		global $wpdb;

		$suffix = '';

		$sql = "SELECT *, name" . $suffix . " AS name, address" . $suffix . " AS address FROM " . $wpdb->prefix . "econt_office WHERE office_code = '" . $office_code . "' ";

		$query = $wpdb->get_row($sql, ARRAY_A);
		if ($wpdb->num_rows == 1) {
			return $query;		
		} else {
			return false;
		}
	}

	public function validateAddress($data) {
		global $wpdb;

		$sql = "SELECT COUNT(c.city_id) AS total FROM " . $wpdb->prefix . "econt_city c LEFT JOIN " . $wpdb->prefix . "econt_quarter q ON (c.city_id = q.city_id) LEFT JOIN " . $wpdb->prefix . "econt_street s ON (c.city_id = s.city_id) WHERE TRIM(c.post_code) = '". trim($data['post_code']) . "' AND (LCASE(TRIM(c.name)) = '" . mb_strtolower(trim($data['city'])) . "' OR LCASE(TRIM(c.name_en)) = '" . mb_strtolower(trim($data['city'])) . "')";

		//if ($data['quarter']) {
		if (array_key_exists('quarter', $data)) {
			$sql .= " AND (LCASE(TRIM(q.name)) = '" . mb_strtolower(trim($data['quarter'])) . "' OR LCASE(TRIM(q.name_en)) = '" . mb_strtolower(trim($data['quarter'])) . "')";
		}

		//if ($data['street']) {
		if (array_key_exists('street', $data)) {
			$sql .= " AND (LCASE(TRIM(s.name)) = '" . mb_strtolower(trim($data['street'])) . "' OR LCASE(TRIM(s.name_en)) = '" . mb_strtolower(trim($data['street'])) . "')";
		}

		$query = $wpdb->get_row($sql, ARRAY_A);

		return $query;

	}

	public function getLoading($order_id) {
		global $wpdb;
		
		$sql = "SELECT * FROM " . $wpdb->prefix . "econt_loading WHERE order_id='". $order_id . "' ORDER BY econt_loading_id DESC LIMIT 1;"  ;

		$query = $wpdb->get_row($sql, ARRAY_A);
		if ($wpdb->num_rows == 1) {
			return $query;
		} else {
			return false;
		}
	}

	public function getLoadingNextParcels($loading_num) {
		global $wpdb;
		
		$sql = "SELECT * FROM " . $wpdb->prefix . "econt_loading WHERE prev_parcel_num = '" . $loading_num . "'";
		
		$query = $wpdb->get_row($sql, ARRAY_A);

		if ($wpdb->num_rows == 1) {
			return $query;
		} else {
			return false;
		}

		//return $query->rows;
	}

	public function getLoadingTrackings($econt_loading_id) {
		global $wpdb;
		
		$sql = "SELECT * FROM " . $wpdb->prefix . "econt_loading_tracking WHERE econt_loading_id = '" . (int)$econt_loading_id . "'";
		$query = $wpdb->get_row($sql, ARRAY_A);
		if ($wpdb->num_rows == 1) {
			return $query;
		} else {
			return false;
		}
		//return $query->rows;
	}

	public function addLoading($data) {
	global $wpdb;
    $wpdb->query( "INSERT INTO " . $wpdb->prefix . "econt_loading SET order_id = '" . (int)$data['order_id'] . "', loading_id = '" . $data['loading_id'] . "', loading_num = '" . $data['loading_num'] . "', blank_yes = '" . trim($data['blank_yes']) . "', blank_no = '" . trim($data['blank_no']) . "', total_sum = '" . trim($data['total_shipping_cost']) . "', order_total_sum = '" . trim($data['total_shipping_cost']) . "', pdf_url = '" . trim($data['pdf_url']) . "'"  );
    do_action('econt_add_loading', $data);

	}
	public function deleteLoading($data) {
		global $wpdb;
		$results_data = array();
		//$data = array('loading_num' => some_number, 'live' => '0 or 1', 'username' => 'some_user', 'password' => 'some_pass');
	    $wpdb->delete($wpdb->prefix . "econt_loading", array('loading_num' => $data['loading_num']));  
	    $results = $this->serviceTool(array(
			'live'     => $data['live'],
			'username' => $data['username'],
			'password' => $data['password'],
			'type'     => 'cancel_shipments',
			'xml'	   => '<cancel_shipments><num>' . $data['loading_num'] . '</num></cancel_shipments>',
		));

		if (isset($results->cancel_shipments->e->success) && (int)$results->cancel_shipments->e->success != 1 ) {
			$results_data['error'] = __('loading is not canceled.', 'woocommerce-econt');
		}

		return apply_filters( 'econt_delete_loading_result', $results_data, $data ); 

	}

	public function updateLoading($data) {
		global $wpdb;
		$wpdb->query("UPDATE " . $wpdb->prefix . "econt_loading SET is_imported = '" . (int)$data['is_imported'] . "', storage = '" . $data['storage'] . "', receiver_person = '" . $data['receiver_person'] . "', receiver_person_phone = '" . $data['receiver_person_phone'] . "', receiver_courier = '" . $data['receiver_courier'] . "', receiver_courier_phone = '" . $data['receiver_courier_phone'] . "', receiver_time = '" . date('Y-m-d H:i:s', strtotime($data['receiver_time'])) . "', cd_get_sum = '" . $data['cd_get_sum'] . "', cd_get_time = '" . date('Y-m-d H:i:s', strtotime($data['cd_get_time'])) . "', cd_send_sum = '" . $data['cd_send_sum'] . "', cd_send_time = '" . date('Y-m-d H:i:s', strtotime($data['cd_send_time'])) . "', total_sum = '" . $data['total_sum'] . "', currency = '" . $data['currency'] . "', sender_ammount_due = '" . $data['sender_ammount_due'] . "', receiver_ammount_due = '" . $data['receiver_ammount_due'] . "', other_ammount_due = '" . $data['other_ammount_due'] . "', delivery_attempt_count = '" . $data['delivery_attempt_count'] . "', blank_yes = '" . trim($data['blank_yes']) . "', blank_no = '" . trim($data['blank_no']) . "', pdf_url = '" . trim($data['pdf_url']) . "' WHERE econt_loading_id  = '" . (int)$data['econt_loading_id'] . "'");

		if (isset($data['trackings'])) {
			foreach ($data['trackings'] as $tracking) {
				$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_loading_tracking SET econt_loading_id = '" . (int)$data['econt_loading_id'] . "', loading_num = '" . $data['loading_num'] . "', time = '" . date('Y-m-d H:i:s', strtotime($tracking['time'])) . "', is_receipt = '" . (int)$tracking['is_receipt'] . "', event = '" . $tracking['event'] . "', name = '" . $tracking['name'] . "', name_en = '" . $tracking['name_en'] . "'");
			}
		}

		if (isset($data['next_parcels'])) {
			foreach ($data['next_parcels'] as $next_parcel) {
				$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_loading SET loading_num = '" . $next_parcel['loading_num'] . "', is_imported = '" . (int)$next_parcel['is_imported'] . "', storage = '" . $next_parcel['storage'] . "', receiver_person = '" . $next_parcel['receiver_person'] . "', receiver_person_phone = '" . $next_parcel['receiver_person_phone'] . "', receiver_courier = '" . $next_parcel['receiver_courier'] . "', receiver_courier_phone = '" . $next_parcel['receiver_courier_phone'] . "', receiver_time = '" . date('Y-m-d H:i:s', strtotime($next_parcel['receiver_time'])) . "', cd_get_sum = '" . $next_parcel['cd_get_sum'] . "', cd_get_time = '" . date('Y-m-d H:i:s', strtotime($next_parcel['cd_get_time'])) . "', cd_send_sum = '" . $next_parcel['cd_send_sum'] . "', cd_send_time = '" . date('Y-m-d H:i:s', strtotime($next_parcel['cd_send_time'])) . "', total_sum = '" . $next_parcel['total_sum'] . "', currency = '" . $next_parcel['currency'] . "', sender_ammount_due = '" . $next_parcel['sender_ammount_due'] . "', receiver_ammount_due = '" . $next_parcel['receiver_ammount_due'] . "', other_ammount_due = '" . $next_parcel['other_ammount_due'] . "', delivery_attempt_count = '" . $next_parcel['delivery_attempt_count'] . "', blank_yes = '" . trim($next_parcel['blank_yes']) . "', blank_no = '" . trim($next_parcel['blank_no']) . "', pdf_url = '" . trim($next_parcel['pdf_url']) . "', prev_parcel_num = '" . trim($data['loading_num']) . "', next_parcel_reason = '" . trim($next_parcel['reason']) . "'");

				if (isset($next_parcel['trackings'])) {
					$econt_loading_next_id = $wpdb->insert_id;

					foreach ($next_parcel['trackings'] as $tracking) {
						$wpdb->query("INSERT INTO " . $wpdb->prefix . "econt_loading_tracking SET econt_loading_id = '" . (int)$econt_loading_next_id . "', loading_num = '" . $next_parcel['loading_num'] . "', time = '" . date('Y-m-d H:i:s', strtotime($tracking['time'])) . "', is_receipt = '" . (int)$tracking['is_receipt'] . "', event = '" . $tracking['event'] . "', name = '" . $tracking['name'] . "', name_en = '" . $tracking['name_en'] . "'");
					}
				}
			}
		}
	}


	//vzima dannite za profila na sobstvenika na magazina ot profila mu v econt
	public function getProfile($username, $password, $live) {

		$data = array(
			'live'     => $live,
			'username' => $username,
			'password' => $password,
			'type'     => 'profile'
		);
		$profile_data = array();

		$results = $this->serviceTool($data);
		if ($results) {
			if (isset($results->error)) {
				$profile_data['error'] = (string)$results->error->message;
			} else {
				if (isset($results->client_info)) {
					$profile_data['client_info'] = $results->client_info;

					if (!empty($results->client_info->id)) {
						if ($data['live']) {
							$instructions_form_url = 'https://ee.econt.com/load_direct.php?target=EeLoadingInstructions';
						} else {
							$instructions_form_url = 'https://demo.econt.com/ee/load_direct.php?target=EeLoadingInstructions';
						}

						$profile_data['instructions_form_url'] = $instructions_form_url . '&login_username=' . $username . '&login_password=' . md5($password) . '&target_type=client&id_target=' . (string)$results->client_info->id;
					}
				}

				if (isset($results->addresses)) {

					foreach ($results->addresses->e as $address) {

						if (isset($address->city) && isset($address->city_post_code)) {
							$city = $this->getCityByNameAndPostcode($address->city, $address->city_post_code);

							if (array_key_exists('0', $city)) {

								$address->city_id = $city[0]['city_id'];
							}
						}

						$profile_data['addresses'][] = $address;
					}
				}
			}
		} else {
			$profile_data['error'] = __('error_connect - profile data', 'woocommerce-econt');
			self::write_log('Econt Express Econt_mySQL->getProfile error!');
		}


		return $profile_data;
	}

	//tova e funkcia za vzimane na sporazumenie za nalojen platej CD
	public function getClients($username, $password, $live) {
		
		$data = array(
			'live'     => $live,
			'username' => $username,
			'password' => $password,
			'type'     => 'access_clients'
		);

		$clients_data = array();

		$results = $this->serviceTool($data);
		if ($results) {
			if (isset($results->error)) {
				$clients_data['error'] = (string)$results->error->message;
			} else {
				if (isset($results->clients)) {
					foreach ($results->clients->client as $client) {
						$clients_data['key_words'][] = (string)$client->key_word;

						if (isset($client->cd_agreements)) {
							foreach ($client->cd_agreements->cd_agreement as $cd_agreement) {
								$clients_data['cd_agreement_nums'][] = (string)$cd_agreement->num;
							}
						}

						if (isset($client->instructions)) {
							foreach ($client->instructions->e as $instruction) {
								$clients_data['instructions'][(string)$instruction->type][] = (string)$instruction->template;
							}
						}
					}
				}
			}
		} else {
			$clients_data['error'] = 'error_connect';
			self::write_log('Econt Express Econt_mySQL->getClients error!');
		}

		return $clients_data;
	}

	public function refreshData() {
		@ini_set('memory_limit', '512M');
		@ini_set('max_execution_time', 1800);

		$results_data = array();

		if (!isset($results_data['error'])) {
			$results = $this->resources_api('countries');
			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteCountries();
						$country_data = array();
						foreach ($results->results as $country) {
							$country_data[] = array(
								'name'    => (string)$country->name,
								'name_en' => (string)$country->name_en,
								'zone_id' => (string)$country->zone_id
							);

						}
						$this->insert_chunked_rows($country_data, 'econt_country');
					}

				}
			} else {
				$results_data['error'] = __('error_connect_countries', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData countries error!');
			}
		} 

		if (!isset($results_data['error'])) {
			
			$results = $this->resources_api('zones');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteZones();
						$zone_data = array();
						foreach ($results->results as $zone) {
							$zone_data[] = array(
								'zone_id'  => (string)$zone->zone_id,
								'name'     => (string)$zone->name,
								'name_en'  => (string)$zone->name_en,
								'national' => (string)$zone->national,
								'is_ee'    => (string)$zone->is_ee
							);
						}
						$this->insert_chunked_rows($zone_data, 'econt_zone');
					}

				}
			} else {
				$results_data['error'] = __('error_connect cities_zones', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData cities_zones error!');
			}
		}

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('regions');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteRegions();
						$region_data = array();
						foreach ($results->results as $region) {
							$region_data[] = array(
								'region_id' => (string)$region->region_id,
								'name'      => (string)$region->name,
								'code'      => (string)$region->code,
								'city_id'   => (string)$region->city_id
							);
						}
						$this->insert_chunked_rows($region_data, 'econt_region');
					}

				}
			} else {
				$results_data['error'] = __('error_connect_cities_regions', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData regions error!');
			}
		}

		if (!isset($results_data['error'])) {
			
			$results = $this->resources_api('quarters');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteQuarters();
						$quarter_data = array();
						foreach ($results->results as $quarter) {
							$quarter_data[] = array(
								'quarter_id'     => (string)$quarter->quarter_id,
								'name'           => (string)$quarter->name,
								'name_en'        => (string)$quarter->name_en,
								'city_id'        => (string)$quarter->city_id
							);
						}
						$this->insert_chunked_rows($quarter_data, 'econt_quarter');
					}

				}
			} else {
				$results_data['error'] = __('error_connect_cities_quarters', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData quarters error!');
			}
		}

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('streets');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error->message;
				} else {
					if (!empty($results->results)) {
						$this->deleteStreets();
						$street_data = array();
						foreach ($results->results as $street) {
							$street_data[] = array(
								'street_id'      => (string)$street->street_id,
								'name'           => (string)$street->name,
								'name_en'        => (string)$street->name_en,
								'city_id'        => (string)$street->city_id
							);
						}
						$this->insert_chunked_rows($street_data, 'econt_street');
					}
					
				}
			} else {
				$results_data['error'] = __('error_connect_cities_streets', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData streets error!');
			}
		}

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('offices');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteOffices();
						$office_data = array();
						foreach ($results->results as $office) {
							$office_data[] = array(
								'office_id'           => (string)$office->office_id,
								'name'                => (string)$office->name,
								'name_en'             => (string)$office->name_en,
								'office_code'         => (string)$office->office_code,
								'is_machine'		  => (string)$office->is_machine,
								'address'             => (string)$office->address,
								'address_en'          => (string)$office->address_en,
								'latitude'            => (float)$office->latitude,
								'longitude'           => (float)$office->longitude,
								'phone'               => (string)$office->phone,
								'work_begin'          => (string)$office->work_begin,
								'work_end'            => (string)$office->work_end,
								'work_begin_saturday' => (string)$office->work_begin_saturday,
								'work_end_saturday'   => (string)$office->work_end_saturday,
								'time_priority'       => (string)$office->time_priority,
								'city_id'             => (string)$office->city_id
							);
						}
						$this->insert_chunked_rows($office_data, 'econt_office');
					}

				}
			} else {
				$results_data['error'] = __('error_connect_offices', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData countries error!');
			}
		}

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('cities');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteCities();
						$city_data = array();
						$city_office_data = array();
						foreach ($results->results as $city) {
							$city_data[] = array(
								'city_id'    => (string)$city->city_id,
								'post_code'  => (string)$city->post_code,
								'type'       => (string)$city->type,
								'name'       => (string)$city->name,
								'name_en'    => (string)$city->name_en,
								'region'     => (string)$city->region,
								'region_en'  => (string)$city->region_en,
								'zone_id'    => (string)$city->zone_id,
								'country_id' => (string)$city->country_id,
								'office_id'  => (string)$city->office_id
							);

						}
						$this->insert_chunked_rows($city_data, 'econt_city');

					}
				}
			} else {
				$results_data['error'] = __('error_connect_cities', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData cities error!');
			}
		}

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('city_offices');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteCitiesOffices();
						$city_data = array();
						$city_office_data = array();
						foreach ($results->results as $city_offices) {
							$city_office_data[] = array(
								'office_code' => (string)$city_offices->office_code,
								'shipment_type' => (string)$city_offices->shipment_type,
								'delivery_type' => (string)$city_offices->delivery_type,
								'city_id' => (string)$city_offices->city_id
							);


						}
						$this->insert_chunked_rows($city_office_data, 'econt_city_office');
					}
				}
			} else {
				$results_data['error'] = __('error_connect_city_offices', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData city_offices error!');
			}
		}

		return $results_data;
	}

		public function refreshDataIntl() {
		@ini_set('memory_limit', '512M');
		@ini_set('max_execution_time', 1800);

		$results_data = array();

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('cities_intl');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteCitiesIntl();
						$city_data = array();
						foreach ($results->results as $city) {
							$city_data[] = array(
								'city_id'    => (string)$city->city_id,
								'post_code'  => (string)$city->post_code,
								'type'       => (string)$city->type,
								'name'       => (string)$city->name,
								'name_en'    => (string)$city->name_en,
								'region'     => (string)$city->region,
								'region_en'  => (string)$city->region_en,
								'zone_id'    => (string)$city->zone_id,
								'country_id' => (string)$city->country_id,
								'office_id'  => (string)$city->office_id,
								'country_code' => (string)$city->country_code,
							);

						}
						$this->insert_chunked_rows($city_data, 'econt_city_intl');

					}
				}
			} else {
				$results_data['error'] = __('error_connect_cities_intl', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData cities_intl error!');
			}
		}

				if (!isset($results_data['error'])) {
			
			$results = $this->resources_api('quarters_intl');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error;
				} else {
					if (!empty($results->results)) {
						$this->deleteQuartersIntl();
						$quarter_data = array();
						foreach ($results->results as $quarter) {
							$quarter_data[] = array(
								'quarter_id'     => (string)$quarter->quarter_id,
								'name'           => (string)$quarter->name,
								'name_en'        => (string)$quarter->name_en,
								'city_id'        => (string)$quarter->city_id,
								'country_code' 	 => (string)$quarter->country_code,
							);
						}
						$this->insert_chunked_rows($quarter_data, 'econt_quarter_intl');
					}

				}
			} else {
				$results_data['error'] = __('error_connect_cities_quarters_intl', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData quarters_intl error!');
			}
		}

		if (!isset($results_data['error'])) {

			$results = $this->resources_api('streets_intl');

			if ($results) {
				if (!empty($results->error)) {
					$results_data['error'] = (string)$results->error->message;
				} else {
					if (!empty($results->results)) {
						$this->deleteStreetsIntl();
						$street_data = array();
						foreach ($results->results as $street) {
							$street_data[] = array(
								'street_id'      => (string)$street->street_id,
								'name'           => (string)$street->name,
								'name_en'        => (string)$street->name_en,
								'city_id'        => (string)$street->city_id,
								'country_code'   => (string)$street->country_code,
							);
						}
						$this->insert_chunked_rows($street_data, 'econt_street_intl');
					}
					
				}
			} else {
				$results_data['error'] = __('error_connect_cities_streets_intl', 'woocommerce-econt');
				self::write_log('Econt Express Econt_mySQL->refreshData streets_intl error!');
			}
		}


		return $results_data;
	}

	public function serviceTool($data) {
		if ($data['live']) {
			$url = 'https://www.econt.com/e-econt/xml_service_tool.php';
		} else {
			$url = 'https://demo.econt.com/e-econt/xml_service_tool.php';
		}

		$request = '<?xml version="1.0" ?>
					<request>
						<client>
							<username>' . $data['username'] . '</username>
							<password>' . $data['password'] . '</password>
						</client>
						<request_type>' . $data['type'] . '</request_type>
						<mediator>mrejanet</mediator>';

		if (isset($data['xml'])) {
			$request .= $data['xml'];
		}

		$request .= '</request>';
		//za debug na service tool
		//self::write_log($request);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('xml' => $request));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		
		$response = curl_exec($ch);
		//self::write_log('$response');		
		//self::write_log($response);
		curl_close($ch);

		libxml_use_internal_errors(true);
		return simplexml_load_string($response);
	}

	public function parcelImport($data) {
		if ($data['live']) {
			$url = 'https://www.econt.com/e-econt/xml_parcel_import2.php';
		} else {
			$url = 'https://demo.econt.com/e-econt/xml_parcel_import2.php';
		}
		unset($data['live']);

		$data['loadings']['row']['mediator'] = 'mrejanet';

		$request = '<?xml version="1.0" ?>';
		$request .= '<parcels>';
		$request .= $this->prepareXML($data);
		$request .= '</parcels>';
		//za debug na loading request
		//self::write_log($request);
		//self::write_log($data);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('xml' => $request));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		
		$response = curl_exec($ch);
		//self::write_log($response);
		curl_close($ch);

		libxml_use_internal_errors(TRUE);
		
		return simplexml_load_string($response);
	}


	private function prepareXML($data) {
		$xml = '';

		foreach ($data as $key => $value) {
			if ($key && $key == 'error') {
				continue;
			}

			if ($key && ($key == 'p' || $key == 'cd')) {
				$xml .= '<' . $key . ' type="' . $value['type'] . '">' . $value['value'] . '</' . $key . '>' . "\r\n";
			} else {
				if (!is_numeric($key)) {
					$xml .= '<' . $key . '>';
				}

				if (is_array($value)) {
					$xml .= "\r\n" . $this->prepareXML($value);
				} else {
					$xml .= htmlspecialchars($value ?? '',ENT_QUOTES);
				}

				if (!is_numeric($key)) {
					$xml .= '</' . $key . '>' . "\r\n";
				}
			}
		}

		return $xml;
	}


    public static function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }

    public static function license_check(){

        $cookie_name = "econt_license";
        if(false === get_transient( $cookie_name )){
            $api_get_params = array(
                            'plugin' => 'esm',
                            'hostname' => $_SERVER['HTTP_HOST'],
                            'email' => get_bloginfo('admin_email'),
                        );

            $license_api_call = wp_remote_get(add_query_arg($api_get_params, ECONT_LICENSE_SERVER), array('timeout' => 20, 'sslverify' => false));

            if (is_wp_error($license_api_call)){
                $error_message = $license_api_call->get_error_message();
                $response = (object) array('licensed' => 'error', 'error' => $error_message);
            }else{
                $response = json_decode(wp_remote_retrieve_body($license_api_call));
            }

            $cookie_value = $response;
            
            switch ($response->licensed) {
            	case 'yes':
            		$expiration =  86400; //един ден
            		break;
            	case 'trail':
            		$expiration =  7200; //два часа
            		break;
            	case 'no':
            		$expiration =  1800; //половин час
            		break;
            	case 'error':
            		$expiration =  1800; //половин час
            		break;
            	
            	default:
            		$expiration =  3600; //един час
            		break;
            }
            set_transient($cookie_name, $cookie_value, $expiration);

            return $response;
        }

        return get_transient($cookie_name);

    }

    public static function xml2array ( $xmlObject, $out = array () ){
    	foreach ( (array) $xmlObject as $index => $node )
        	$out[$index] = ( is_object ( $node ) ||  is_array ( $node ) ) ? self::xml2array ( $node ) : $node;

    	return $out;
	}
	
    public function delivery_days($username, $password, $live){


            //delivery days
            $data = array();
            $data['error_delivery_day'] = '';
            $data['delivery_days'] = array();
            $data['priority_date'] = '';
            $delivery_days = array();

            $delivery_days_data = array(
                'live'     => $live,
                'username' => htmlspecialchars_decode($username),
                'password' => htmlspecialchars_decode($password),
                'type'     => 'delivery_days',
                'xml'      => '<delivery_days>' . date('Y-m-d') . '</delivery_days>',
            );

            $delivery_days_results = $this->serviceTool($delivery_days_data);

            if ($delivery_days_results) {
                if (isset($delivery_days_results->error)) {
                    $data['error_delivery_day'] = (string)$delivery_days_results->error->message;
                } else {
                    if (isset($delivery_days_results->delivery_days)) {
                        foreach ($delivery_days_results->delivery_days->e as $delivery_day) {

                            $delivery_days[(string)$delivery_day->date] = date("D, d M y",strtotime($delivery_day->date));

                            if (date('w', strtotime($delivery_day->date)) == 6) {
                            $delivery_days[(string)$delivery_day->date] = __('with priority: ', 'woocommerce-econt') . date("D, d M y",strtotime($delivery_day->date));

                            } 

                        }
                    }
                }
            } else {
                $data['error_delivery_day'] = __('error_connect', 'woocommerce-econt');
                $delivery_days['error'] = __('error_connect', 'woocommerce-econt');
                self::write_log('Econt Express Econt_mySQL->delivery_days error!');
            }

            return $delivery_days;



    }

     /**
     * Calculate size
     */

     public function size_under_60cm() {
     	$result = array();
     	$length = 0;
     	$width  = 0;
     	$height = 0;
     	$volume_weight = 0;

        foreach(WC()->cart->get_cart() as $item => $values) { 
            $_product =  wc_get_product( $values['data']->get_id()); 
            $length = ($_product->get_length() > $length) ? $_product->get_length() : $length;
            $width = ($_product->get_width() > $width) ? $_product->get_width() : $width;
            $height += (float)$_product->get_height() * $values['quantity'];
            $volume_weight += self::volume_weight_calc((float)$_product->get_length(), (float)$_product->get_width(), (float)$_product->get_height())* $values['quantity'];
        } 
        
        $result['size_under_60cm'] = ( max($length, $width, $height) < 60 ) ? 1 : 0;
        $result['volume_weight'] = $volume_weight;
        $result['length'] = $length;
		$result['width'] = $width;
		$result['height'] = $height;
		
        return $result;
        //return 0;

     }

	/**
     * Validate shipping fields in checkout and order details page
     */
    public function receiver_address_validation($data) {

    	$user = '';
    	if(array_key_exists('econt_user_address', $data) && $data['econt_user_address'] == '1'){
    		$user = '_user';
    	}

        if ($data['econt_shipping_to' . $user] == 'OFFICE') {
                    
            if (empty($data['econt_offices_town' . $user]) || empty($data['econt_offices' . $user]) || empty($data['econt_offices_postcode' . $user])) {
                        

                return array('valid' => false ,'msg' =>__('Please fill all Econt Express office fields.', 'woocommerce-econt'));

            }
        } 
        elseif ($data['econt_shipping_to' . $user] == 'MACHINE') {
                    
            if (empty($data['econt_machines_town' . $user]) || empty($data['econt_machines']) || empty($data['econt_machines_postcode' . $user])) {
                        
                return array('valid' => false ,'msg' =>__('Please fill all Econt Express APS fields.', 'woocommerce-econt'));
            }
        } 
        elseif ($data['econt_shipping_to' . $user] == 'DOOR') {

			$intl_delivery = ($data['billing_country'] == 'RO' || $data['billing_country'] == 'GR') ? true : false;

            if (empty($data['econt_door_town' . $user]) || empty($data['econt_door_postcode' . $user]) ) {
                        
                return array('valid' => false ,'msg' =>__('Please fill atleast Econt Express town, street name and street number fields.', 'woocommerce-econt'));
                        
            }elseif($intl_delivery == false){

            if( (empty($data['econt_door_street' . $user]) && empty($data['econt_door_quarter' . $user])) || (empty($data['econt_door_street_num' . $user]) && empty($data['econt_door_street_bl' . $user])) ){
                        
                if(empty($data['econt_door_other' . $user])){
                        
                    return array('valid' => false ,'msg' =>__('Please fill atleast Econt Express town, street name and street number fields.', 'woocommerce-econt'));
                        
                }
                        
            }
            }elseif($intl_delivery == true){
            	if( (empty($data['econt_door_street_intl' . $user]) && empty($data['econt_door_quarter_intl' . $user])) || (empty($data['econt_door_street_num' . $user]) && empty($data['econt_door_street_bl' . $user])) ){
	                        
	                if(empty($data['econt_door_other' . $user])){
	                        
	                    return array('valid' => false ,'msg' =>__('Please fill atleast Econt Express town, street name and street number fields.', 'woocommerce-econt'));
	                        
	                }
                        
            	}
            }
                        
    		//proverka za grad, ulica i kvartal suvpadenie s bazata danni na econt
        	$address               = array();

        	$address['city']       = $data['econt_door_town' . $user];
        	$address['post_code']  = $data['econt_door_postcode' . $user];
        	if(!empty($data['econt_door_street' . $user])){
            	$address['street']     = $data['econt_door_street' . $user];
        	}
        	if(!empty($data['econt_door_quarter' . $user])){
            	$address['quarter']    = $data['econt_door_quarter' . $user];
        	}
                    
        	$validate_address   = $this->validateAddress($address);

        	if($validate_address['total'] == 0 && $intl_delivery == false){

              	return array('valid' => false ,'msg' => __('Invalid city name, street name or quarter name. Please start typing in the box , wait until the list appear and select city name, street name or quarter name from the list.', 'woocommerce-econt'));
        	}


        }elseif (empty($data['econt_shipping_to'])) {

            return array('valid' => false ,'msg' => __('Please fill Econt Express fields.', 'woocommerce-econt'));
        }

        return array('valid' => true, 'msg' => '');
           
    }

    /**
     * Update shipping fields from checkout and order details page
     */
    public function shipping_field_update_order_meta($order_id, $data) {
    	$order = wc_get_order($order_id);
    	$user = '';
    	if(array_key_exists('econt_user_address', $data) && $data['econt_user_address'] == '1'){
    		$user = '_user';
    	}

    	$door_meta_keys = array(
    		'Econt_Door_Town' => 'econt_door_town', 
    		'Econt_Door_Postcode' => 'econt_door_postcode', 
    		'Econt_Door_Street' => 'econt_door_street',
    		'Econt_Door_Street_Intl' => 'econt_door_street_intl', 
    		'Econt_Door_Quarter' => 'econt_door_quarter',
    		'Econt_Door_Quarter_Intl' => 'econt_door_quarter_intl', 
    		'Econt_Door_street_num' => 'econt_door_street_num', 
    		'Econt_Door_building_num' => 'econt_door_street_bl', 
    		'Econt_Door_Entrance_num' => 'econt_door_street_vh', 
    		'Econt_Door_Floor_num' => 'econt_door_street_et', 
    		'Econt_Door_Apartment_num' => 'econt_door_street_ap', 
    		'Econt_Door_Other' => 'econt_door_other',
    		'Econt_City_Courier' => 'econt_city_courier',
    		'Econt_Delivery_Days' => 'econt_delivery_days',
    		'Econt_Priority_Time_Type' => 'econt_priority_time_type',
    		'Econt_Priority_Time_Hour' => 'econt_priority_time_hour',

    	);
    	$office_meta_keys = array(
    		'Econt_Office_Town' => 'econt_offices_town', 
    		'Econt_Office' => 'econt_offices', 
    		'Econt_Office_Postcode' => 'econt_offices_postcode'
    	);
    	$machine_meta_keys = array(
    		'Econt_Machine_Town' => 'econt_machines_town', 
    		'Econt_Machine' => 'econt_machines', 
    		'Econt_Machine_Postcode' => 'econt_machines_postcode'
    	);

    	foreach ($door_meta_keys as $key => $value) {
    		if (!empty($data[$value])) {
                $order->update_meta_data( $key, sanitize_text_field($data[$value]) );
            }else{
            	$order->update_meta_data( $key, '');
            }
    	}
            
        if (!empty($data['econt_shipping_to' . $user])) {
            $order->update_meta_data( 'Econt_Shipping_To', sanitize_text_field($data['econt_shipping_to' . $user]) );
        }
        if($data['econt_shipping_to' . $user] == 'OFFICE'){

         	foreach ($office_meta_keys as $key => $value) {
	    		if (!empty($data[$value . $user])) {
	                $order->update_meta_data( $key, sanitize_text_field($data[$value . $user]) );

	            }else{
	            	$order->update_meta_data( $key, '');
	            }
    		}

    		foreach ($machine_meta_keys as $key => $value) {
    			$order->update_meta_data( $key, '');
    		}

    		foreach ($door_meta_keys as $key => $value) {
    			$order->update_meta_data( $key, '');
    		}


        }elseif($data['econt_shipping_to' . $user] == 'MACHINE'){ 

         	foreach ($machine_meta_keys as $key => $value) {
	    		if (!empty($data[$value . $user])) {
	                $order->update_meta_data( $key, sanitize_text_field($data[$value . $user]) );
	            }else{
	            	$order->update_meta_data( $key, '');
	            }
    		}

    		foreach ($office_meta_keys as $key => $value) {
    			$order->update_meta_data( $key, '');
    		}

    		foreach ($door_meta_keys as $key => $value) {
    			$order->update_meta_data( $key, '');
    		}


        }elseif($data['econt_shipping_to' . $user] == 'DOOR'){

        	foreach ($door_meta_keys as $key => $value) {
	    		if (!empty($data[$value . $user])) {
	                $order->update_meta_data( $key, sanitize_text_field($data[$value . $user]) );
	            }else{
	            	$order->update_meta_data( $key, '');
	            }
    		}

    		foreach ($office_meta_keys as $key => $value) {
    			$order->update_meta_data( $key, '');
    		}

    		foreach ($machine_meta_keys as $key => $value) {
    			$order->update_meta_data( $key, '');
    		}
                
        }

        if (!empty($data['econt_customer_shipping_cost'])) {
            $order->update_meta_data( 'Econt_Customer_Shipping_Cost', sanitize_text_field($data['econt_customer_shipping_cost']) );
            $econt_options = get_option('econt_shipping_method_options');
	        if( !empty($econt_options['inc_shipping_cost']) ){
            	//updateva shipping costa na econt express shipping method
	            foreach( $order->get_items( 'shipping' ) as $item_id => $item ){
					if( $item->get_method_id() === 'econt_shipping_method' ) {
						$econt_total = (wc_tax_enabled()) ? self::remove_vat_from_shipping_price($data['econt_customer_shipping_cost']) : $data['econt_customer_shipping_cost'];
						$item->set_total( $econt_total );
						$item->save();
						$order->calculate_totals();
						break; // stop the loop
					}
				}
			}
        }

        if (!empty($data['econt_total_shipping_cost'])) {
            $order->update_meta_data( 'Econt_Total_Shipping_Cost', sanitize_text_field($data['econt_total_shipping_cost']) );
        }

        $order->save();


    }

    /**
     * Update shipping fileds from checkout and user shipping address
     */
    public function shipping_field_update_user_meta($user_id, $data) {

    	$user = '';
    	if(array_key_exists('econt_user_address', $data) && $data['econt_user_address'] == '1'){
    		$user = '_user';
    	}

    	$door_meta_keys = array(
    		'Econt_Door_Town' => 'econt_door_town', 
    		'Econt_Door_Postcode' => 'econt_door_postcode', 
    		'Econt_Door_Street' => 'econt_door_street', 
    		'Econt_Door_Quarter' => 'econt_door_quarter',
    		'Econt_Door_Street_Intl' => 'econt_door_street_intl', 
    		'Econt_Door_Quarter' => 'econt_door_quarter',
    		'Econt_Door_Quarter_Intl' => 'econt_door_quarter_intl', 
    		'Econt_Door_street_num' => 'econt_door_street_num', 
    		'Econt_Door_building_num' => 'econt_door_street_bl', 
    		'Econt_Door_Entrance_num' => 'econt_door_street_vh', 
    		'Econt_Door_Floor_num' => 'econt_door_street_et', 
    		'Econt_Door_Apartment_num' => 'econt_door_street_ap', 
    		'Econt_Door_Other' => 'econt_door_other',
    		'Econt_City_Courier' => 'econt_city_courier',
    		'Econt_Delivery_Days' => 'econt_delivery_days',
    	);
    	$office_meta_keys = array(
    		'Econt_Office_Town' => 'econt_offices_town', 
    		'Econt_Office' => 'econt_offices', 
    		'Econt_Office_Postcode' => 'econt_offices_postcode'
    	);
    	$machine_meta_keys = array(
    		'Econt_Machine_Town' => 'econt_machines_town', 
    		'Econt_Machine' => 'econt_machines', 
    		'Econt_Machine_Postcode' => 'econt_machines_postcode'
    	);

    	foreach ($door_meta_keys as $key => $value) {
    		if (!empty($data[$value . $user])) {
                update_user_meta($user_id, $key, sanitize_text_field($data[$value . $user]));
            }else{
            	update_user_meta($user_id, $key, '');
            }
    	}
            
        if (!empty($data['econt_shipping_to' . $user])) {
            update_user_meta($user_id, 'Econt_Shipping_To', sanitize_text_field($data['econt_shipping_to' . $user]));
        }
        if($data['econt_shipping_to' . $user] == 'OFFICE'){

         	foreach ($office_meta_keys as $key => $value) {
	    		if (!empty($data[$value . $user])) {
	                update_user_meta($user_id, $key, sanitize_text_field($data[$value . $user]));
	            }else{
	            	update_user_meta($user_id, $key, '');
	            }
    		}

    		foreach ($machine_meta_keys as $key => $value) {
    			update_user_meta($user_id, $key, '');
    		}

    		foreach ($door_meta_keys as $key => $value) {
    			update_user_meta($user_id, $key, '');
    		}


        }elseif($data['econt_shipping_to' . $user] == 'MACHINE'){ 

         	foreach ($machine_meta_keys as $key => $value) {
	    		if (!empty($data[$value . $user])) {
	                update_user_meta($user_id, $key, sanitize_text_field($data[$value . $user]));
	            }else{
	            	update_user_meta($user_id, $key, '');
	            }
    		}

    		foreach ($office_meta_keys as $key => $value) {
    			update_user_meta($user_id, $key, '');
    		}

    		foreach ($door_meta_keys as $key => $value) {
    			update_user_meta($user_id, $key, '');
    		}


        }elseif($data['econt_shipping_to' . $user] == 'DOOR'){
        	foreach ($door_meta_keys as $key => $value) {
	    		if (!empty($data[$value . $user])) {
	                update_user_meta($user_id, $key, sanitize_text_field($data[$value . $user]));
	            }else{
	            	update_user_meta($user_id, $key, '');
	            }
    		}

    		foreach ($office_meta_keys as $key => $value) {
    			update_user_meta($user_id, $key, '');
    		}

    		foreach ($machine_meta_keys as $key => $value) {
    			update_user_meta($user_id, $key, '');
    		}
                
        }


    }

    /**
    * A method for inserting multiple rows at the same time into the specified table
    */
	//private function wp_insert_rows($row_arrays = array(), $wp_table_name, $update = false, $primary_key = null) {
	private function wp_insert_rows($row_arrays, $wp_table_name, $update = false, $primary_key = null) {
		global $wpdb;
		$wp_table_name = $wpdb->prefix . esc_sql($wp_table_name);
		// Setup arrays for Actual Values, and Placeholders
		$values        = array();
		$place_holders = array();
		$query         = "";
		$query_columns = "";
		
		$query .= "INSERT INTO `{$wp_table_name}` (";
		foreach ($row_arrays as $count => $row_array) {
			foreach ($row_array as $key => $value) {
				if ($count == 0) {
					if ($query_columns) {
						$query_columns .= ", " . $key . "";
					} else {
						$query_columns .= "" . $key . "";
					}
				}
				
				$values[] = $value;
				
				$symbol = "%s";
				if (is_numeric($value)) {
					if (is_float($value)) {
						$symbol = "%f";
					} else {
						$symbol = "%d";
					}
				}
				if (isset($place_holders[$count])) {
					$place_holders[$count] .= ", '$symbol'";
				} else {
					$place_holders[$count] = "( '$symbol'";
				}
			}
			// mind closing the GAP
			$place_holders[$count] .= ")";
		}
		
		$query .= " $query_columns ) VALUES ";
		
		$query .= implode(', ', $place_holders);
		
		if ($update) {
			$update = " ON DUPLICATE KEY UPDATE $primary_key=VALUES( $primary_key ),";
			$cnt    = 0;
			foreach ($row_arrays[0] as $key => $value) {
				if ($cnt == 0) {
					$update .= "$key=VALUES($key)";
					$cnt = 1;
				} else {
					$update .= ", $key=VALUES($key)";
				}
			}
			$query .= $update;
		}
		
		$sql = $wpdb->prepare($query, $values);
		if ($wpdb->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	/**
    * Breack array into chunks and insert them in sql
    */
    //private function insert_chunked_rows($rows_array = array(), $table_name){
	private function insert_chunked_rows($rows_array, $table_name){
		$chunk_size = 10000; //change it if you need it
		$chunked_array = array_chunk($rows_array, $chunk_size);
		foreach ($chunked_array as $key => $value) {
			$this->wp_insert_rows($value, $table_name);
		}

	}

	/*
	* volume weight calc
	* formula  (обща ширина в см Х дължина в см Х височина в см) /6000
	* резултатът е в килограми
	*/ 
	public static function volume_weight_calc($length, $width, $height){
		return round(($length * $width * $height) / 6000, 2); 
	}

	//limit words in a string (used for limiting the loading description length)
	public static function substrwords($text, $maxchar, $end=' ...') {
	    if (mb_strlen($text) > $maxchar || $text == '') {
	        $words = preg_split('/\s/', $text);
	        $output = '';
	        $i      = 0;
	        while (1) {
	            $length = mb_strlen($output)+mb_strlen($words[$i]);
	            if ($length > $maxchar) {
	                break;
	            }
	            else {
	                $output .= " " . $words[$i];
	                ++$i;
	            }
	        }
	        $output .= $end;
	    }
	    else {
	        $output = $text;
	    }
	    return $output;
	}

     //checking for lamers
     public static function lamers_check(){
     	return (defined('ECONT_LICENSE_SERVER') && ECONT_LICENSE_SERVER == 'http://licensing.mreja.net/license_check.php')? false : true; 
     }

     public function resources_api($resource){
     	
     	$results = array('results' => '', 'error' => '');
     	$api_get_params = array(
                            'plugin' => 'esm',
                            'hostname' => $_SERVER['HTTP_HOST'],
                            'email' => get_bloginfo('admin_email'),
                            'q' => $resource,
                        );

        $resources_api_call = wp_remote_get(add_query_arg($api_get_params, ECONT_RESOURCES_SERVER), array('timeout' => 30, 'sslverify' => false));
        if (is_wp_error($resources_api_call)){
            $error_message = $license_api_call->get_error_message();
            $results = (object) array('results' => '', 'error' => $error_message);
        }else{
            $results = json_decode(wp_remote_retrieve_body($resources_api_call));
        }
        return $results;
     }

    /**
     * Executed when the plugin is deactivated
     */
    public function plugin_deactivation() {
        delete_option('econt_profile');
   		delete_option('econt_access_clients');

    }

   	/**
     * Executed when the plugin is activated
     */
	public static function plugin_activation() {
	    set_transient( 'econt-admin-activation-notice', true, 5 );
	    self::license_check();
	}



	public function econt_admin_activation_notice(){
		if(get_transient( 'econt-admin-activation-notice' )){
				$license_data = self::license_check();
	        ?>
	        
	        <div class="updated notice is-dismissible">
	        	<?php echo $license_data->activation_msg; ?>
	        </div>

	        <?php
	        /* Delete transient, only display this notice once. */
	        delete_transient( 'econt-admin-activation-notice' );
	    }
	}

    // add plugin upgrade notification
	public function show_upgrade_notification($currentPluginMetadata, $newPluginMetadata){
	   // check "upgrade_notice"
	   if (isset($newPluginMetadata->upgrade_notice) && strlen(trim($newPluginMetadata->upgrade_notice)) > 0){
	        echo '<p style="background-color: #d54e21; padding: 10px; color: #f9f9f9; margin-top: 10px"><strong>' . __('Important Upgrade Notice:', 'woocommerce-econt') . '</strong> ';
	        //echo esc_html($newPluginMetadata->upgrade_notice), '</p>';
	        echo $newPluginMetadata->upgrade_notice . '</p>';
	   }
	}
	
	//send way-bill tracking email to the customer
	public static function send_email($data, $locale) {
		switch_to_locale($locale);
		$from_name = ($data['tracking_email_from_name']) ? $data['tracking_email_from_name'] : get_bloginfo( 'name' );
    	$from_address = filter_var($data['tracking_email_from_address'], FILTER_VALIDATE_EMAIL) ? $data['tracking_email_from_address'] : get_bloginfo('admin_email');
		$title = __('Email for shipment tracking details', 'woocommerce-econt');
		/* translators: order number, loading number  */
    	$placeholder = sprintf( __( '<p>Your order #%1$s is ready to be sent with a way-bill number <strong>%2$s</strong> with the courier company Econt Express. You can track the movement of the shipment by clicking the button below.</p>', 'woocommerce-econt' ), $data['order_num'], $data['loading_num']);
    	/* translators: name, order number, loading number  */
    	$content = sprintf( __( '<p>Hi %1$s,</p><p>Your order #%2$s is ready to be sent with a way-bill number <strong>%3$s</strong> with the courier company Econt Express. You can track the movement of the shipment from the button below.</p>', 'woocommerce-econt' ), $data['name'], $data['order_num'], $data['loading_num']);
    	$button = __('Track shipment', 'woocommerce-econt');
    	/* translators: site url  */
    	$footer = sprintf( __( 'Thanks for using %s', 'woocommerce-econt' ), get_site_url());
    	$shopname = get_bloginfo( 'name' );

    	if(file_exists ( get_stylesheet_directory() . '/woocommerce-econt/html-loading-tracking-email.php')){
    		include_once( get_stylesheet_directory() . '/woocommerce-econt/html-loading-tracking-email.php' );
    	}else{
    		include_once( ECONT_PLUGIN_DIR . '/admin/view/html-loading-tracking-email.php' );
        }
        $attachments = '';
        $subject = get_bloginfo( 'name' ) . ' - ' . __('shipment tracking for order #', 'woocommerce-econt') . $data['order_num'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: "' . $from_name . '" <'. $from_address . '>'. "\r\n";

        wp_mail($data['email'], $subject, $tracking_email, $headers, $attachments);
    }

   	public function default_loading_data($order_id){

   		$econt_options = get_option('econt_shipping_method_options');
	    $order = wc_get_order( $order_id );
	    $intl_delivery = ($order->get_billing_country() == 'RO' || $order->get_billing_country() == 'GR') ? true : false;
		$loading_data = array();
		$loading_data['receiver_city'] = '';
		$loading_data['receiver_post_code'] = '';
		$loading_data['order_id'] = $order_id;
		$loading_data['order_num'] = $order->get_order_number();
		$loading_data['payment_method'] = $order->get_payment_method();
		$loading_data['payment_token'] = $order->get_transaction_id();
		$loading_data['order_cd'] = ($loading_data['payment_method'] == 'cod' || $loading_data['payment_method'] == 'econt_payment') ? 1 : 0;
		$loading_data['payment_side'] = (empty($loading_data['order_cd']) && !empty($econt_options['inc_shipping_cost'])) ? 'SENDER' : $econt_options['payment_side'];
		$loading_data['delivery_day_id'] = $order->get_meta( 'Econt_Delivery_Days', true );
                
	    if( $order->get_meta( 'Econt_Door_Town', true ) ){
	                    
	        $loading_data['receiver_city'] = $order->get_meta( 'Econt_Door_Town', true );
	                    
	    }elseif( $order->get_meta( 'Econt_Office_Town', true ) ){
	                    
	        $loading_data['receiver_city'] = $order->get_meta( 'Econt_Office_Town', true );
	                    
	    }elseif( $order->get_meta( 'Econt_Machine_Town', true ) ){

	        $loading_data['receiver_city'] = $order->get_meta( 'Econt_Machine_Town', true );
	    }
	                    
	    if( $order->get_meta( 'Econt_Door_Postcode', true ) ){
	                        
	        $loading_data['receiver_post_code'] = $order->get_meta( 'Econt_Door_Postcode', true );
	                    
	    }elseif( $order->get_meta( 'Econt_Office_Postcode', true ) ){

	        $loading_data['receiver_post_code'] = $order->get_meta( 'Econt_Office_Postcode', true );
	                    
	    }elseif( $order->get_meta( 'Econt_Machine_Postcode', true ) ){

	        $loading_data['receiver_post_code'] = $order->get_meta( 'Econt_Machine_Postcode', true );
	    }
	    $loading_data['receiver_office_code'] = '';
	    if( $order->get_meta( 'Econt_Office', true ) ){

	        $loading_data['receiver_office_code'] = $order->get_meta( 'Econt_Office', true );
	                    
	    }elseif( $order->get_meta( 'Econt_Machine', true ) ){

	        $loading_data['receiver_office_code'] = $order->get_meta( 'Econt_Machine', true );
	    }

	    if( $order->get_billing_company() ) { 
	                    
	        $loading_data['receiver_name'] = $order->get_billing_company();
	                    
	    }else{
	                    
	        $loading_data['receiver_name'] = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();

	    }
	                    
		$loading_data['receiver_name_person'] = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
		$loading_data['receiver_email'] = $order->get_billing_email();
		$loading_data['receiver_street'] = ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Street_Intl', true ) : $order->get_meta( 'Econt_Door_Street', true );
		//$loading_data['receiver_street_intl'] = $order->get_meta( 'Econt_Door_Street_Intl', true );
		$loading_data['receiver_quarter'] = ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Quarter_Intl', true ) : $order->get_meta( 'Econt_Door_Quarter', true );
		//$loading_data['receiver_quarter_intl'] = $order->get_meta( 'Econt_Door_Quarter_Intl', true );
		$loading_data['receiver_street_num'] = $order->get_meta( 'Econt_Door_street_num', true );
		$loading_data['receiver_street_bl'] = $order->get_meta( 'Econt_Door_building_num', true );
		$loading_data['receiver_street_vh'] = $order->get_meta( 'Econt_Door_Entrance_num', true );
		$loading_data['receiver_street_et'] = $order->get_meta( 'Econt_Door_Floor_num', true );
		$loading_data['receiver_street_ap'] = $order->get_meta( 'Econt_Door_Apartment_num', true );
		$loading_data['receiver_street_other'] = $order->get_meta( 'Econt_Door_Other', true );
		$loading_data['receiver_phone_num'] = $order->get_billing_phone();
		$loading_data['receiver_shipping_to'] = $order->get_meta( 'Econt_Shipping_To', true );

		$loading_data['currency'] = $order->get_currency();
		$loading_data['currency_symbol'] = get_woocommerce_currency_symbol($loading_data['currency']);

		return $loading_data;

	}

public function create_loading($loading_data, $only_calculate = 0){

    $econt_options = get_option('econt_shipping_method_options');

    $econt_order = new Econt_Admin_Order;
    $result = array(
            'order_id'                  => '',
            'total_shipping_cost'       => '',
            'customer_shipping_cost'    => '',
            'currency_symbol'           => '',
            'currency'                  => '',
            'blank_yes'					=> '',
            'blank_no'					=> '',
            'loading_id'				=> '',
            'loading_num'				=> '',
            'pdf_url' 					=> '',
        );
    
    //$country_codes = array('RO' => 'ROU', 'GR' => 'GRC');

	(array_key_exists('order_id', $loading_data) ?: $loading_data['order_id'] = -1);

	if( $loading_data['order_id'] > 0 ){

	    $wpc = $econt_order->econt_order_products($loading_data['order_id']);
	    $loading_data['order_cd_amount'] = $this->getIfSet($loading_data['order_cd_amount'], $wpc['price']);
	    $loading_data['shipping_tax'] = $this->getIfSet($loading_data['shipping_tax'], $wpc['shipping_tax']);
	    $loading_data['weight']          = $this->getIfSet($loading_data['weight'], $wpc['weight']);
	    $loading_data['height']          = $this->getIfSet($loading_data['height'], $wpc['height']);
	    $loading_data['width']           = $this->getIfSet($loading_data['width'], $wpc['width']);
	    $loading_data['length']          = $this->getIfSet($loading_data['length'], $wpc['length']);
	    $loading_data['count']           = $this->getIfSet($loading_data['count'], $wpc['count']);
	    $loading_data['size_under_60cm'] = $this->getIfSet($loading_data['size_under_60cm'], $wpc['size_under_60cm']);
	    $loading_data['products'] 	     = isset($loading_data['products']) ? $loading_data['products'] : $wpc['products'];
	    $loading_data['description'] = isset($loading_data['description']) ? $loading_data['description'] : (array_key_exists('product_name', $wpc ) ? self::substrwords(implode(', ', $wpc['product_name']), 100) : '');
	    $loading_data['currency'] = $wpc['currency'];
		$loading_data['currency_symbol'] = $wpc['currency_symbol'];
		$loading_data['payment_method'] = $wpc['payment_method'];

		$loading_data['receiver_country_code'] = ($wpc['billing_country'] == 'RO' || $wpc['billing_country'] == 'GR') ? self::$country_codes[$wpc['billing_country']] : 'BGR';
	}else{


	    if ( ! WC()->cart->prices_include_tax ) {
			$loading_data['order_cd_amount'] = WC()->cart->cart_contents_total;
		} else {
			$loading_data['order_cd_amount'] = WC()->cart->cart_contents_total + WC()->cart->tax_total;
		}

		$size_under_60cm = $this->size_under_60cm();
		$loading_data['weight'] = WC()->cart->cart_contents_weight;
		$loading_data['height'] = $size_under_60cm['height'];
		$loading_data['width'] = $size_under_60cm['width'];
		$loading_data['length'] = $size_under_60cm['length'];
		$loading_data['count'] = WC()->cart->cart_contents_count;
		$loading_data['size_under_60cm'] = $size_under_60cm['size_under_60cm'];
		$loading_data['description'] = 'goods';
		$loading_data['currency'] = get_woocommerce_currency();
		$loading_data['currency_symbol'] = get_woocommerce_currency_symbol();
		$loading_data['order_cd'] = ($loading_data['payment_method'] == 'cod' || $loading_data['payment_method'] == 'econt_payment') ? 1 : 0;
		//$loading_data['receiver_country_code'] = ($loading_data['billing_country'] == 'RO' || $loading_data['billing_country'] == 'GR') ? $country_codes[$loading_data['billing_country']] : 'BGR';
		
	}



    $loading_data['order_cd'] = $this->getIfSet($loading_data['order_cd'], $econt_options['cd']);

	$loading_data['weight'] = apply_filters( 'econt_cart_weight', $loading_data['weight'], $loading_data['order_id'] );

    if($loading_data['weight'] == 0){

        $result = array(
            'order_id' => $loading_data['order_id'],
            'total_shipping_cost' => '',
            'customer_shipping_cost' => __('calculating', 'woocommerce-econt'),
            'currency_symbol' => '',
            'currency' => '',
        );

        return apply_filters( 'econt_create_loading_result', $result, $loading_data );  

    }

    $data = array();

    $data['client']['username']                         = $this->getIfSet($loading_data['username'], $econt_options['username']);
    $data['client']['password']                         = $this->getIfSet($loading_data['password'], $econt_options['password']);
    $data['live']                                       = $this->getIfSet($loading_data['live'], $econt_options['live']);

    $data['system']['request_type']                     = 'shipping';
    $data['system']['response_type']                    = 'XML';

    $data['loadings']['row']['sender']['name']          = $this->getIfSet($loading_data['sender_name'], $econt_options['company']);
    $data['loadings']['row']['sender']['name_person']   = $this->getIfSet($loading_data['sender_name_person'], $econt_options['name']);
    $data['loadings']['row']['sender']['phone_num']     = $this->getIfSet($loading_data['sender_phone_num'], $econt_options['phone']);
    $data['loadings']['row']['sender']['email'] 		= $this->getIfSet($loading_data['sender_email'], $econt_options['email']);

    $loading_data['sender_door_or_office'] 	= $this->getIfSet($loading_data['sender_door_or_office'], $econt_options['send_from']);

    if($loading_data['sender_door_or_office'] == 'DOOR' || $loading_data['sender_door_or_office'] == 'DOOR2'){
        $address = ($loading_data['sender_door_or_office'] == 'DOOR2') ? explode(';', $loading_data['sender_door2']) : explode(';', $econt_options['address']);

        $data['loadings']['row']['sender']['city']          = $this->getIfSet($loading_data['sender_city'], $address[1]);
        $data['loadings']['row']['sender']['post_code']     = $this->getIfSet($loading_data['sender_post_code'], $address[0]);
        $data['loadings']['row']['sender']['street']        = $this->getIfSet($loading_data['sender_street'], $address[3]);
        $data['loadings']['row']['sender']['quarter']       = $this->getIfSet($loading_data['sender_quarter'], $address[2]);
        $data['loadings']['row']['sender']['street_num']    = $this->getIfSet($loading_data['sender_street_num'], $address[4]);
        $data['loadings']['row']['sender']['street_bl']     = $this->getIfSet($loading_data['sender_street_bl']);
        $data['loadings']['row']['sender']['street_vh']     = $this->getIfSet($loading_data['sender_street_vh']);
        $data['loadings']['row']['sender']['street_et']     = $this->getIfSet($loading_data['sender_street_et']);
        $data['loadings']['row']['sender']['street_ap']     = $this->getIfSet($loading_data['sender_street_ap']);
        $data['loadings']['row']['sender']['street_other']  = $this->getIfSet($loading_data['sender_street_other'], $address[5]);

    }elseif($loading_data['sender_door_or_office'] == 'OFFICE' || $loading_data['sender_door_or_office'] == 'OFFICE2'){

        $data['loadings']['row']['sender']['city']          = $this->getIfSet($loading_data['sender_city'], $econt_options['office_town']);
        $data['loadings']['row']['sender']['post_code']     = $this->getIfSet($loading_data['sender_post_code'], $econt_options['office_postcode']);
        $data['loadings']['row']['sender']['office_code']   = $this->getIfSet($loading_data['sender_office_code'], $econt_options['office_code']);

    }elseif($loading_data['sender_door_or_office'] == 'MACHINE'){

        $data['loadings']['row']['sender']['city']          = $this->getIfSet($loading_data['sender_city'], $econt_options['machine_town']);
        $data['loadings']['row']['sender']['post_code']     = $this->getIfSet($loading_data['sender_post_code'], $econt_options['machine_postcode']);
        $data['loadings']['row']['sender']['office_code']   = $this->getIfSet($loading_data['sender_office_code'], $econt_options['machine_code']);

    }


    $data['loadings']['row']['receiver']['name'] = $loading_data['receiver_name'];
    $data['loadings']['row']['receiver']['name_person'] = $loading_data['receiver_name_person'];
    $data['loadings']['row']['receiver']['phone_num'] = $loading_data['receiver_phone_num'];
    $data['loadings']['row']['receiver']['email'] = $loading_data['receiver_email'];
    $data['loadings']['row']['receiver']['city'] = $loading_data['receiver_city'];
    $data['loadings']['row']['receiver']['post_code'] = $loading_data['receiver_post_code'];
	$data['loadings']['row']['receiver']['country_code'] = $this->getIfSet($loading_data['receiver_country_code'], 'BGR');

    if($loading_data['receiver_shipping_to'] == 'DOOR'){

        $data['loadings']['row']['receiver']['office_code']  = '';
        $data['loadings']['row']['receiver']['street']       = $loading_data['receiver_street'];
        $data['loadings']['row']['receiver']['quarter']      = $loading_data['receiver_quarter'];
        $data['loadings']['row']['receiver']['street_num']   = $loading_data['receiver_street_num'];
        $data['loadings']['row']['receiver']['street_bl']    = $loading_data['receiver_street_bl'];
        $data['loadings']['row']['receiver']['street_vh']    = $loading_data['receiver_street_vh'];
        $data['loadings']['row']['receiver']['street_et']    = $loading_data['receiver_street_et'];
        $data['loadings']['row']['receiver']['street_ap']    = $loading_data['receiver_street_ap'];
        $data['loadings']['row']['receiver']['street_other'] = $loading_data['receiver_street_other'];

    }elseif($loading_data['receiver_shipping_to'] == 'OFFICE' || $loading_data['receiver_shipping_to'] == 'MACHINE'){

        $data['loadings']['row']['receiver']['office_code']         = $loading_data['receiver_office_code'];
        $data['loadings']['row']['receiver']['street']              = '';
        $data['loadings']['row']['receiver']['quarter']             = '';
        $data['loadings']['row']['receiver']['street_num']          = '';
        $data['loadings']['row']['receiver']['street_bl']           = '';
        $data['loadings']['row']['receiver']['street_vh']           = '';
        $data['loadings']['row']['receiver']['street_et']           = '';
        $data['loadings']['row']['receiver']['street_ap']           = '';
        $data['loadings']['row']['receiver']['street_other']        = '';

    }

    //ako tegloto e pod 50gr se ravnqva na 50gr. za da ne dava greshka API na Econt
    $loading_data['weight'] = ((float)$loading_data['weight'] > 0 && (float)$loading_data['weight'] < 0.05) ? 0.05 : $loading_data['weight']; 

    $loading_data['sms_notification'] = $this->getIfSet($loading_data['sms_notification'], $econt_options['sms_notification']);
    if ((int)$loading_data['sms_notification'] == 1) {
        $data['loadings']['row']['services']['sms_notification'] = 'ON';
    }

	$loading_data['sms_no'] = $this->getIfSet($loading_data['sms_no'], $econt_options['sms_no']);
    if ($loading_data['sms_no']) {
        $sms_no = $econt_options['sms_no'];
        $data['loadings']['row']['receiver']['sms_no'] = $sms_no;
    }

    if((float)$loading_data['weight'] <= 100){
        $data['loadings']['row']['shipment']['shipment_type']       = 'PACK';
    }else{
        $data['loadings']['row']['shipment']['shipment_type']       = 'CARGO';
        $data['loadings']['row']['shipment']['cargo_code']          = 81;   
    }

    if($data['loadings']['row']['shipment']['shipment_type'] == 'PACK' && !empty($loading_data['envelope_num'])){
        $data['loadings']['row']['shipment']['envelope_num'] = $loading_data['envelope_num'];
    }

    if($data['loadings']['row']['shipment']['shipment_type'] == 'PACK' && !empty($loading_data['order_num_user_input'])){
		$data['loadings']['row']['shipment']['order_num'] = $loading_data['order_num_user_input'];
	}

    $tariff_sub_code = preg_replace('/\d/','',$loading_data['sender_door_or_office']).'_'.$loading_data['receiver_shipping_to'];
    $tariff_sub_code = str_replace('MACHINE', 'OFFICE', $tariff_sub_code);

    $tariff_code = 0;

    if ($loading_data['receiver_shipping_to'] == 'DOOR') {
            	$tariff_code = 1;
    } elseif ($tariff_sub_code == 'OFFICE_OFFICE') {
        $tariff_code = 2;
    } elseif ($tariff_sub_code == 'OFFICE_DOOR' || $tariff_sub_code == 'DOOR_OFFICE') {
        $tariff_code = 3;
    } elseif ($tariff_sub_code == 'DOOR_DOOR') {
        $tariff_code = 4;
    }

    $data['loadings']['row']['shipment']['description']         = $loading_data['description'];
    $data['loadings']['row']['shipment']['pack_count']          = $this->getIfSet($loading_data['pack_count'], 1);
    $data['loadings']['row']['shipment']['weight']              = $loading_data['weight'];

    if($loading_data['sender_door_or_office'] == 'MACHINE' || $loading_data['receiver_shipping_to'] == 'MACHINE'){
        if((float)$loading_data['weight'] <= 5){
            $data['loadings']['row']['shipment']['aps_box_size']        = 'Small';
        }elseif((float)$loading_data['weight'] > 5 && $loading_data['weight'] <= 10){
            $data['loadings']['row']['shipment']['aps_box_size']        = 'Medium';
        }elseif((float)$loading_data['weight'] > 10 && $loading_data['weight'] <= 50){
            $data['loadings']['row']['shipment']['aps_box_size']        = 'Large';
        }
    }

    $data['loadings']['row']['shipment']['tariff_code']         = $tariff_code;
    $data['loadings']['row']['shipment']['tariff_sub_code']     = $tariff_sub_code;
    $loading_data['order_pay_after'] = $this->getIfSet($loading_data['order_pay_after'], $econt_options['pay_after']);
    if($loading_data['order_pay_after'] == 'accept' && $loading_data['receiver_shipping_to'] != 'MACHINE'){ 
        $data['loadings']['row']['shipment']['pay_after_accept']    = 1;
        $data['loadings']['row']['shipment']['pay_after_test']      = 0;
    }elseif($loading_data['order_pay_after'] == 'test' && $loading_data['receiver_shipping_to'] != 'MACHINE'){
        $data['loadings']['row']['shipment']['pay_after_accept']    = 0;
        $data['loadings']['row']['shipment']['pay_after_test']      = 1;
    }elseif($loading_data['order_pay_after'] == 0 || $loading_data['receiver_shipping_to'] == 'MACHINE'){
        $data['loadings']['row']['shipment']['pay_after_accept']    = 0;
        $data['loadings']['row']['shipment']['pay_after_test']      = 0;
    }

    $data['loadings']['row']['shipment']['instruction_returns'] = $this->getIfSet($loading_data['instruction_returns'], $econt_options['instruction_returns']);
    $data['loadings']['row']['shipment']['invoice_before_pay_CD'] = $this->getIfSet($loading_data['invoice'], $econt_options['invoice']);
    if($loading_data['receiver_shipping_to'] == 'MACHINE'){
    	$data['loadings']['row']['shipment']['invoice_before_pay_CD'] = 0;
    }


    $data['loadings']['row']['shipment']['delivery_day']    = $this->getIfSet($loading_data['delivery_day_id']);
    $data['loadings']['row']['shipment']['size_under_60cm'] = $loading_data['size_under_60cm'];
    $data['loadings']['row']['shipment']['shipment_pack_dimensions_l']	= $loading_data['length'];
	$data['loadings']['row']['shipment']['shipment_pack_dimensions_w']	= $loading_data['width'];
	$data['loadings']['row']['shipment']['shipment_pack_dimensions_h']	= $loading_data['height'];


    $data['loadings']['row']['services']['p'] = array('type' => $this->getIfSet($loading_data['priority_time_type']), 'value' => $this->getIfSet($loading_data['priority_time_hour']));


    $data['loadings']['row']['services']['e1'] = $this->getIfSet($loading_data['city_courier_e1']);
    $data['loadings']['row']['services']['e2'] = $this->getIfSet($loading_data['city_courier_e2']);
    $data['loadings']['row']['services']['e3'] = $this->getIfSet($loading_data['city_courier_e3']);

    $loading_data['dc_cp'] = $this->getIfSet($loading_data['dc_cp'], $econt_options['dc_cp']);
            
    if((int)$loading_data['dc_cp'] == 1) {
        $dc = 'ON';
    } else {
        $dc = '';
    }

    $data['loadings']['row']['services']['dc'] = $dc;

    if ((int)$econt_options['dc_cp'] == 1) {
        $dc_cp = 'ON';
    } else {
        $dc_cp = '';
    }

    $data['loadings']['row']['services']['dc_cp'] = $dc_cp;

    $loading_data['partial_delivery'] = $this->getIfSet($loading_data['partial_delivery'], $econt_options['partial_delivery']);

    if ((int)$loading_data['count'] > 1 && (int)$loading_data['partial_delivery'] == 1) {
        $data['loadings']['row']['packing_list']['partial_delivery'] = $loading_data['partial_delivery'];
    }

    $loading_data['inventory'] = $this->getIfSet($loading_data['inventory'], $econt_options['inventory']);
            
    if ($loading_data['inventory'] != '0') {
        $data['loadings']['row']['packing_list']['type'] = $loading_data['inventory'];

        if ($loading_data['inventory'] == 'DIGITAL' && isset($loading_data['products'])) { 
            foreach ($loading_data['products'] as $product) {
                $data['loadings']['row']['packing_list']['row'][]['e'] = array(
                    'inventory_num' => $product['product_id'],
                    'description'   => $product['name'],
                    'weight'        => $product['weight'],
                    'price'         => $product['price']
                );
            }
        }
    }
    
    //instructions
    if($loading_data['receiver_shipping_to'] != 'MACHINE'){
        $loading_data['instructions_take'] = $this->getIfSet($loading_data['instructions_take'], $econt_options['instructions_take']);
        if ($loading_data['instructions_take']) {
            $data['loadings']['row']['instructions'][]['e'] = array(
                'type'     => 'take',
                'template' => $loading_data['instructions_take']
            );
        }
        $loading_data['instructions_give'] = $this->getIfSet($loading_data['instructions_give'], $econt_options['instructions_give']);
        if ($loading_data['instructions_give']) {
            $data['loadings']['row']['instructions'][]['e'] = array(
                'type'     => 'give',
                'template' => $loading_data['instructions_give']
            );
        }
        $loading_data['instructions_return'] = $this->getIfSet($loading_data['instructions_return'], $econt_options['instructions_return']);
        if ($loading_data['instructions_return']) {
            $data['loadings']['row']['instructions'][]['e'] = array(
                'type'     => 'return',
                'template' => $loading_data['instructions_return']
            );
        }
        $loading_data['instructions_services'] = $this->getIfSet($loading_data['instructions_services'], $econt_options['instructions_services']);
        if ($loading_data['instructions_services']) {
            $data['loadings']['row']['instructions'][]['e'] = array(
                'type'     => 'services',
                'template' => $loading_data['instructions_services']
            );
        }
    }

    if((int)$loading_data['order_cd'] == 1){

    $data['loadings']['row']['services']['cd']                  = array('type' => 'GET', 'value' => $loading_data['order_cd_amount']);
    $data['loadings']['row']['services']['cd_currency']         = $loading_data['currency'];
    $loading_data['cd_agreement_num'] = $this->getIfSet($loading_data['cd_agreement_num'], $econt_options['client_cd_num']);
    $data['loadings']['row']['services']['cd_agreement_num']    = $loading_data['cd_agreement_num'];

    }

    $data['loadings']['row']['services']['invoice_num'] = $this->getIfSet($loading_data['invoice_num']);
            
    $loading_data['order_oc'] = $this->getIfSet($loading_data['order_oc'], $econt_options['oc']);

    if( ($loading_data['order_oc'] == 1 && $loading_data['sender_door_or_office'] != 'MACHINE' && $loading_data['receiver_shipping_to'] != 'MACHINE') || ($loading_data['order_oc'] > 1 && $loading_data['order_cd_amount'] > $loading_data['order_oc'] && $loading_data['sender_door_or_office'] != 'MACHINE' && $loading_data['receiver_shipping_to'] != 'MACHINE')){
        $data['loadings']['row']['services']['oc']                  = $this->getIfSet($loading_data['order_oc_amount'], $loading_data['order_cd_amount']); //$oc_amount;
        $data['loadings']['row']['services']['oc_currency']         = $loading_data['currency'];

    }

    $data['loadings']['row']['payment']['side']                 = $this->getIfSet($loading_data['payment_side'], $econt_options['payment_side']);

    $loading_data['sender_payment_method'] = $this->getIfSet($loading_data['sender_payment_method'], $econt_options['client_payment_type']);

    if($loading_data['sender_payment_method'] == 'CASH' || $loading_data['sender_payment_method'] == 'BONUS' || $loading_data['sender_payment_method'] == 'VOUCHER' ) {
        $data['loadings']['row']['payment']['method']               = $loading_data['sender_payment_method'];
    }else{
        $data['loadings']['row']['payment']['method']               = 'CREDIT';
        $data['loadings']['row']['payment']['key_word']             = $loading_data['sender_payment_method'];   
    }

    if( $only_calculate == 0 && $loading_data['payment_method'] == 'econt_payment' && !empty($loading_data['payment_token']) ){
		$data['loadings']['row']['payment']['payment_token'] 		= $loading_data['payment_token'];	
	}

    $receiver_share_sum = '';
    $receiver_share_sum_door = '';
    $receiver_share_sum_office = '';
    $receiver_incod_sum = '';
    $receiver_incod_sum_door = '';
    $receiver_incod_sum_office = '';
    $free_shipping = '';

    $loading_data['free_shipping_sum'] = $this->getIfSet($loading_data['free_shipping_sum'], $econt_options['free_shipping_sum']);
    $loading_data['free_shipping_sum_to_office'] 		= $this->getIfSet($loading_data['free_shipping_sum_to_office'], $econt_options['free_shipping_sum_to_office']);
    $loading_data['free_shipping_count'] = $this->getIfSet($loading_data['free_shipping_count'], $econt_options['free_shipping_count']);
    $loading_data['free_shipping_weight'] = $this->getIfSet($loading_data['free_shipping_weight'], $econt_options['free_shipping_weight']);
    $loading_data['free_shipping_to_office'] = $this->getIfSet($loading_data['free_shipping_to_office'], $econt_options['free_shipping_to_office']);
    $loading_data['shipping_payments'] = $this->getIfSet($loading_data['shipping_payments'], $econt_options['shipping_payments']);

    if ((float)$loading_data['free_shipping_sum'] && ((float)$loading_data['order_cd_amount'] >= (float)$loading_data['free_shipping_sum']) && ($loading_data['free_shipping_sum_to_office'] != 'on') || (float)$loading_data['free_shipping_sum'] && ((float)$loading_data['order_cd_amount'] >= (float)$loading_data['free_shipping_sum']) && ($loading_data['free_shipping_sum_to_office'] == 'on') && ($loading_data['receiver_shipping_to'] == 'OFFICE' || $loading_data['receiver_shipping_to'] == 'MACHINE') || (int)$loading_data['free_shipping_count'] && ($loading_data['count'] >  $loading_data['free_shipping_count']) || (float)$loading_data['free_shipping_weight'] && ($loading_data['weight'] >= $loading_data['free_shipping_weight']) || ($loading_data['free_shipping_to_office'] == '1' && ($loading_data['receiver_shipping_to'] == 'OFFICE' || $loading_data['receiver_shipping_to'] == 'MACHINE') )) {
                
        $data['loadings']['row']['payment']['side'] = 'SENDER';
                //if(1 == $only_calculate){ 
        $free_shipping = 1;
                //}

    }elseif (!empty($loading_data['shipping_payments'])){
        $shipping_payments = $loading_data['shipping_payments'];
        $order_amount = 0;
        foreach ($shipping_payments as $shipping_payment) {
	        if ($loading_data['order_cd_amount'] >= $shipping_payment['order_amount'] && $shipping_payment['order_amount'] >= $order_amount && 
					($shipping_payment['country_id'] == $loading_data['receiver_country_code'] ||
					 empty($shipping_payment['country_id']))) {
	            $order_amount = $shipping_payment['order_amount'];
	        	if( !isset($shipping_payment['type']) || $shipping_payment['type'] == 'shared'){
	            	$receiver_share_sum_door = (float)$shipping_payment['receiver_amount'];
	            	$receiver_share_sum_office = (float)$shipping_payment['receiver_amount_office'];
	        	}else{
	        		$receiver_incod_sum_door = (float)$shipping_payment['receiver_amount'];
	            	$receiver_incod_sum_office = (float)$shipping_payment['receiver_amount_office'];
	        	}
	        }
        }
    }

    if ($loading_data['receiver_shipping_to'] == 'OFFICE' || $loading_data['receiver_shipping_to'] == 'MACHINE') {
    	if(is_float($receiver_share_sum_office)){
        	$receiver_share_sum = (float)$receiver_share_sum_office;
    	}
    	if(is_float($receiver_incod_sum_office)){
        	$receiver_incod_sum = (float)$receiver_incod_sum_office;
    	}
    } else {
    	if(is_float($receiver_share_sum_door)){
        	$receiver_share_sum = (float)$receiver_share_sum_door;
        }
        if(is_float($receiver_incod_sum_door)){
        	$receiver_incod_sum = (float)$receiver_incod_sum_door;
    	}
    }

    if (is_float($receiver_share_sum)) {
        $data['loadings']['row']['payment']['side'] = 'SENDER';
        if($receiver_share_sum == 0){
        	$free_shipping = 1;
        }
    }
	if (is_float($receiver_incod_sum)) {
        $data['loadings']['row']['payment']['side'] = 'SENDER';
  		if($receiver_incod_sum == 0){
        	$free_shipping = 1;
        }
	    /*if ($loading_data['inventory'] == 'DIGITAL' && isset($loading_data['products'])) { 
	    	$size = count($data['loadings']['row']['packing_list']['row'])+1;
	        $data['loadings']['row']['packing_list']['row'][$size]['e'] = array(
	            'inventory_num' => 'Econt',
	            'description'   => __('Econt Shipping', 'woocommerce-econt'),
	            'weight'        => '0.00',
	            'price'         => $receiver_incod_sum+$loading_data['shipping_tax'],
	        );

	  	}*/

	  	if((int)$loading_data['order_cd'] == 1){
	    	$data['loadings']['row']['services']['cd'] = array('type' => 'GET', 'value' => number_format($loading_data['order_cd_amount'], 2, '.', ''));

	    }

	}

    if((int)$loading_data['order_cd'] == 0 && !empty($econt_options['inc_shipping_cost'])){
		$data['loadings']['row']['payment']['receiver_share_sum'] = '0.00';
	}else{
		$data['loadings']['row']['payment']['receiver_share_sum'] = $receiver_share_sum;	
	}
    $data['loadings']['row']['payment']['share_percent'] = '';

    if ($data['loadings']['row']['payment']['side'] == 'RECEIVER') {
        $data['loadings']['row']['payment']['method'] = 'CASH';
    }

    $data['system']['only_calculate'] = $only_calculate;
    $data['system']['validate'] = 0;

    if( $loading_data['payment_method'] == 'econt_payment' && $only_calculate == 1 ){
		$data['system']['calculate_with_block'] = 1;
				 
		if($loading_data['order_id'] == -1){
			$items = WC()->cart->get_cart();
			$products_names = array();
		    foreach($items as $item => $values) { 
		        $_product =  wc_get_product( $values['data']->get_id()); 
		        $products_names[] = $_product->get_title();
		    } 
			$data['loadings']['row']['shipment']['description'] = $this->substrwords(implode(', ', $products_names), 100);
		}

		if( $loading_data['receiver_shipping_to'] == 'DOOR' && (empty($loading_data['receiver_street']) || empty($loading_data['receiver_street_num'])) ){

			$data['loadings']['row']['receiver']['street'] = $loading_data['receiver_city'];
			$data['loadings']['row']['receiver']['quarter'] = ''; 
			$data['loadings']['row']['receiver']['street_num'] = '13';
			$data['loadings']['row']['receiver']['street_bl'] = '';
			$data['loadings']['row']['receiver']['street_vh'] = '';
			$data['loadings']['row']['receiver']['street_et'] = '';
			$data['loadings']['row']['receiver']['street_ap'] = '';
			$data['loadings']['row']['receiver']['street_other'] = $loading_data['receiver_city'];
		}
		//vuv vruzka s bug na garantirano ot Ekont s absurdno visoka taksa za vrushtane
		if(empty($loading_data['length'])){
			unset($data['loadings']['row']['shipment']['shipment_pack_dimensions_l']);
		}
		if(empty($loading_data['width'])){
			unset($data['loadings']['row']['shipment']['shipment_pack_dimensions_w']);
		}
		if(empty($loading_data['height'])){
			unset($data['loadings']['row']['shipment']['shipment_pack_dimensions_h']);
		}


	}
	if(!empty($data['loadings']['row']['receiver']['city'])){
		$loading_exists = false;
		if($only_calculate == 0){
			$loading_exists = $this->getLoading($loading_data['order_id']);
		}
		if($loading_exists === false){
			$data = apply_filters( 'econt_create_loading_data', $data, $loading_data );
    		$results = $this->parcelImport($data);
    	}
	}else{
		$results = false;
	}

    if ($results) {
    if (!empty($results->result->e->error)) {
        $result['warning'] = (string)$results->result->e->error;
    }elseif (!empty($results->result->e->warnings)) {
    	$result['warning'] = (string)$results->result->e->warnings;
    } elseif (isset($results->result->e->loading_price->total)) {

        $order_total_sum = number_format((float)$results->result->e->loading_price->total, 2, '.', '');

        $result = array(
            'order_id'                  => $loading_data['order_id'],
            'total_shipping_cost'       => $order_total_sum,
            'customer_shipping_cost'    => $order_total_sum,
            'currency_symbol'           => $loading_data['currency_symbol'],
            'currency'                  => $loading_data['currency'],
        );

        if($receiver_share_sum > 0){

            $result['customer_shipping_cost']   = $receiver_share_sum;
        }

        if($receiver_incod_sum > 0){

            $result['customer_shipping_cost']   = $receiver_incod_sum;
        }

        if($free_shipping == 1){ 
                        
            //$result['customer_shipping_cost']   = 0;
            $result['customer_shipping_cost'] = __('free shipping', 'woocommerce-econt');
                        
        }

        if( $loading_data['payment_method'] == 'econt_payment' && $only_calculate == 1 ){
            if(!isset($_SESSION)) {
				session_start();
			}
			
	        $_SESSION['econt_payment_url'] = (string) $results->result->e->payment_url;
	    }

	    if( $loading_data['order_id'] < 0 && $only_calculate == 1 ){
	    	if(!isset($_SESSION)) {
				session_start();
			}
			$_SESSION['econt_shipping_cost'] = $result['customer_shipping_cost'];
	    }

        if($only_calculate == 0){
            $result['blank_yes'] = '';
	        $result['blank_no'] = '';
	        if (isset($results->pdf)) {
	                            
	            $result['blank_yes'] = (string) $results->pdf->blank_yes;
	            $result['blank_no'] = (string) $results->pdf->blank_no;
	                        
	        }
	        $result['loading_id'] = (string) $results->result->e->loading_id;
	        $result['loading_num'] =  (string) $results->result->e->loading_num;
	        $result['pdf_url'] = (string) $results->result->e->pdf_url;    
	                                                
	        $this->addLoading($result);
	 

        }         
            
    }


    } elseif( $results !== false ){
        $result['warning'] = __('error_connect', 'woocommerce-econt');
    }

    return apply_filters( 'econt_create_loading_result', $result, $loading_data );

}

public static function fixed_price_incod($order_price, $order, $econt_options){

    $shipping_payments = $econt_options['shipping_payments'];
    $billing_country = $order->get_billing_country();
    $receiver_country_code = ($billing_country == 'RO' || $billing_country == 'GR') ? self::$country_codes[$billing_country] : 'BGR';
    $fixed_price_incod = false;
    $order_amount = 0;
    foreach ($shipping_payments as $shipping_payment) {
	    if ($order_price >= $shipping_payment['order_amount'] && $shipping_payment['order_amount'] >= $order_amount && ($shipping_payment['country_id'] == $receiver_country_code || empty($shipping_payment['country_id']))) {
	        $order_amount = $shipping_payment['order_amount'];
	        if( $shipping_payment['type'] == 'incod'){
	        	$fixed_price_incod = true;
	        	break;
	      	}
	    }
    }

    return $fixed_price_incod;
    
}

private function getIfSet(&$value, $default = null){
    return isset($value) && strlen($value) > 0 ? $value : $default;
}

public function transCityType($type, $country_code){
	$translations = array(
		'RO' => array(
			'гр.' => 'oraș',
			'с.' => 'sat',
		),
		'GR' => array(
			'гр.' => 'πόλη',
			'с.' => 'χωριό',
		),
	);
	if($country_code == 'RO' || $country_code == 'GR'){
		$type = $translations[$country_code][trim($type)];
	}

	return $type;
}


public function modify_billing_and_shipping_address_data($order_id){

    $order = wc_get_order( $order_id );
    $intl_delivery = ($order->get_billing_country() == 'RO' || $order->get_billing_country() == 'GR') ? true : false;
    foreach( $order->get_items( 'shipping' ) as $item_id => $item ){

        if( $item->get_method_id() === 'econt_shipping_method' ) {
                   
            if($item->get_method_id() === 'econt_shipping_method'){
                        
                $address_1 = '';
                $address_2 = '';
                $city = '';
                $postcode = '';
                $state = '';
                $country_code = 'BG';

                if ($order->get_meta('Econt_Shipping_To') == 'OFFICE') {
                    $econt_mysql = new Econt_mySQL;
                    $office_code = $order->get_meta('Econt_Office');
                    $office = $econt_mysql->getOfficeByOfficeCode($office_code);

                    $city = $order->get_meta('Econt_Office_Town');
                    $address_1 = __('Econt office: ', 'woocommerce-econt') . $office['name'] . ', ' . __(' address: ', 'woocommerce-econt') . $office['address'];
                    $postcode = $order->get_meta('Econt_Office_Postcode');
                } elseif ($order->get_meta('Econt_Shipping_To') == 'MACHINE') {
                    $econt_mysql = new Econt_mySQL;
                    $machine_code = $order->get_meta('Econt_Machine');
                    $machine = $econt_mysql->getOfficeByOfficeCode($machine_code);
                            
                    $city = $order->get_meta('Econt_Machine_Town');
                    $address_1 = __('Econt APS: ', 'woocommerce-econt') . $machine['name'] . ', ' . __(' address: ', 'woocommerce-econt') . $machine['address'];
                    $postcode = $order->get_meta('Econt_Machine_Postcode');
                } elseif ($order->get_meta('Econt_Shipping_To') == 'DOOR') {
                    $city = $order->get_meta('Econt_Door_Town');
                    $postcode = $order->get_meta('Econt_Door_Postcode');
                    if(!empty($order->get_meta('Econt_Door_Quarter')) || !empty($order->get_meta('Econt_Door_Quarter_Intl'))){
                    $econt_door_quarter = ($intl_delivery == true) ? $order->get_meta('Econt_Door_Quarter_Intl') : $order->get_meta('Econt_Door_Quarter');
                    $address_1 .= __('quarter:', 'woocommerce-econt') . ' ' . $econt_door_quarter . ', ';
                	}
                    if(!empty($order->get_meta('Econt_Door_building_num'))){
                    $address_1 .= __('num.:', 'woocommerce-econt') . ' ' . $order->get_meta('Econt_Door_building_num') . ', ';
                    }
                    if(!empty($order->get_meta('Econt_Door_Street')) || !empty($order->get_meta('Econt_Door_Street_Intl'))){
                    $econt_door_street = ($intl_delivery == true) ? $order->get_meta('Econt_Door_Street_Intl') : $order->get_meta('Econt_Door_Street');
                    $address_1 .= __('street:', 'woocommerce-econt') . ' ' . $econt_door_street . ', ';
                    }
                    if(!empty($order->get_meta('Econt_Door_street_num'))){
                    $address_1 .= __('num.:', 'woocommerce-econt') . ' ' . $order->get_meta('Econt_Door_street_num') . ', ';
                    }
                    if(!empty($order->get_meta('Econt_Door_Entrance_num'))){
                    $address_2 .= __('entrance:', 'woocommerce-econt') . ' ' . $order->get_meta('Econt_Door_Entrance_num') . ', ';
                    }
                    if(!empty($order->get_meta('Econt_Door_Floor_num'))){
                    $address_2 .= __('floor:', 'woocommerce-econt') . ' ' . $order->get_meta('Econt_Door_Floor_num') . ', ';
                    }
                    if(!empty($order->get_meta('Econt_Door_Apartment_num'))){
                    $address_2 .= __('apartment:', 'woocommerce-econt') . ' ' . $order->get_meta('Econt_Door_Apartment_num');
                    }
                    if(!empty($order->get_meta('Econt_Door_Other'))){
                    $address_1 .= __('notes:', 'woocommerce-econt') . ' ' . $order->get_meta('Econt_Door_Other');
                    }

                    rtrim($address_1, ', ');
                    rtrim($address_2, ', ');

            	}
                    

                $order->set_billing_address_1( $address_1 );
                $order->set_billing_address_2( $address_2 );
                $order->set_billing_city( $city );
                $order->set_billing_postcode( $postcode );
                $order->set_billing_state( $state );
                if($intl_delivery == false){
                    $order->set_billing_country( $country_code );
                }
                $order->set_shipping_address_1( $address_1 );
                $order->set_shipping_address_2( $address_2 );
                $order->set_shipping_city( $city );
                $order->set_shipping_postcode( $postcode );
                $order->set_shipping_state( $state );
                if($intl_delivery == false){
                    $order->set_shipping_country( $country_code );
                }

                $order->save();

            }
      
        }
    }        

}

public static function remove_vat_from_shipping_price($price, $vat_percentage = 20){
	return number_format(((float)$price/(100+(float)$vat_percentage))*100, 2, '.', '');
}


 }
 }

$Econt_mySQL = new Econt_mySQL;