<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set("display_errors", 0);

include __DIR__ . '/class-mysqli-econt.php';

class EcontFastAjax {
	
	public $db;
	public $db_prefix;
	public $lang;
	
	public function __construct(){
		$this->db = New EcontMysqli();
		$this->db_prefix = $this->db->wp_config['table_prefix'];
		$this->lang = 'bg';
		if(isset($_GET['office_city_id'])){
			$lang = explode('-', $_GET['office_city_id']);
			if(isset($lang[0])){
				$this->lang = $lang[0];
			}
		}

		if(isset($_GET['city'])){
			$this->getEcontCity();
		}

		if(isset($_GET['office_city_id'])){
			$city_name = isset($_GET['office_city_name']) ? $_GET['office_city_name'] : 'няма';
			$is_machine = '';
			$this->getEcontOffices($_GET['office_city_id'], $city_name, $is_machine);
		}

		if(isset($_GET['machine_city_id'])){
			$city_name = isset($_GET['machine_city_name']) ? $_GET['machine_city_name'] : 'няма';
			$is_machine = 1;
			$this->getEcontOffices($_GET['machine_city_id'], $city_name, $is_machine);
		}

		if(isset($_GET['door_city_id']) && $_GET['type'] == 'street'){
			$this->getEcontStreets();
		}

		if(isset($_GET['door_city_id']) && $_GET['type'] == 'quarter'){
			$this->getEcontQuarters();
		}
	}

	public function getEcontCity(){

		$response = array();

		$city = $this->db->escape($_GET['city']);

		$country_code = isset($_GET['country_code']) ? $_GET['country_code'] : 'BG';
		$country_code = $this->db->escape($country_code);

		$results = $this->getCityByName($city, $country_code);


		foreach ($results as $row) {

			$res['text'] 		= $this->transCityType($row['type'], $country_code).' '.$row['name'].' [ ' . $this->tr($this->lang .'_pc') . ': ' . $row['post_code'] . ' ' . $this->tr($this->lang .'_region') . ': '. $row['region'] . ' ]';
			$res['id'] 			= $row['name'];
			$res['post_code'] 	= $row['post_code'];
			$res['city_id'] 	= $row['city_id'];

			$response[] = $res;

		}
		
		$this->send_json( $response );
	}


	public function getCityByName($name, $country_code = 'BG') {

		$country_codes = array('GR' => 'GRC', 'RO' => 'ROU');
		$name = mb_strtolower($name);
		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
			$name = ($name == 'sofiq') ? 'sofia' : $name; //fix pri tursene na Sofiq vmesto Sofia
		} else {
			$suffix = '';
		}
		if( $country_code == 'GR' || $country_code == 'RO'){
			$sql = "SELECT *, c.name" . $suffix . " AS name, c.region" . $suffix . " AS region FROM " . $this->db_prefix . "econt_city_intl c WHERE (LCASE(TRIM(c.name)) like '" . trim($name) . "%' OR LCASE(TRIM(c.name_en)) like '" . trim($name) . "%') AND country_code = '" . $country_codes[$country_code] . "'";
		}else{
			$sql = "SELECT *, c.name" . $suffix . " AS name, c.region" . $suffix . " AS region FROM " . $this->db_prefix . "econt_city c WHERE (LCASE(TRIM(c.name)) like '" . trim($name) . "%' OR LCASE(TRIM(c.name_en)) like '" . trim($name) . "%')";
		}

		$results = $this->db->query($sql)->rows;

		return $results;
	}

	public function getEcontOffices($city_id, $name, $is_machine = ''){
		$response = array();
		$city_id = (int)($this->db->escape($city_id));
		$results = $this->getOfficesByCityId($city_id, $name, $is_machine);

		foreach ($results as $row) {

			$res['value'] = $row['name'].' ['.$row['address'].']';
			$res['id'] = $row['office_code'];
			$res['name'] = $row['name'];
			$res['description'] = $row['name'] . ' [  ' . $this->tr($this->lang .'_address') . ': ' . $row['address'] . ', ' . $this->tr($this->lang .'_phone') . ': ' . $row['phone'] .' ] [ ' . ' ' . $this->tr($this->lang .'_oc') . ': ' . $row['office_code'] . ' ] ';
			$res['latitude'] = (float)$row['latitude'];
			$res['longitude'] = (float)$row['longitude'];

			$response[] = $res;
			
		}

		$this->send_json($response);
	}

	public function getOfficesByCityId($city_id, $name, $is_machine = '') {

		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}

		$sql = "SELECT *, o.name" . $suffix . " AS name, o.address" . $suffix . " AS address, o.phone AS phone, o.latitude AS latitude, o.longitude AS longitude FROM " . $this->db_prefix . "econt_office o ";

		$sql .= " WHERE o.city_id = '" . (int)$city_id . "' ";
		
		if($is_machine) {
			$sql .= " AND o.is_machine = 1 ";
		}else{
			$sql .= " AND o.is_machine != 1 ";	
		}
		
		$sql .= " GROUP BY o.office_id ORDER BY o.name" . $suffix;

		$query = $this->db->query($sql)->rows;

		return $query;
	}

	public function getEcontQuarters(){
		$response = array();		
		$city_id = (int)($this->db->escape($_GET['door_city_id']));
		$quarter_name = $this->db->escape($_GET['door_quarter_name']);
		$country_code = $this->db->escape($_GET['country_code']);

		$results = $this->getQuartersByCityId($city_id, $quarter_name, $country_code);

		foreach ($results as $row) {

			$res['text'] = $row['name'];
			$res['id'] = $row['name'];

			$response[] = $res;
			
		}

		$this->send_json($response);
	}


	public function getQuartersByCityId($city_id, $name, $country_code = 'BG', $limit = 10) {

		$country_codes = array('GR' => 'GRC', 'RO' => 'ROU');
		$name = mb_strtolower($name);

		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}
		if( $country_code == 'GR' || $country_code == 'RO'){
			$sql = "SELECT *, q.name" . $suffix . " AS name FROM " . $this->db_prefix . "econt_quarter_intl q WHERE country_code = '" . $country_codes[$country_code] . "'";
		}else{
			$sql = "SELECT *, q.name" . $suffix . " AS name FROM " . $this->db_prefix . "econt_quarter q WHERE 1";
		}
		if ($name) {
			$sql .= " AND (LCASE(q.name) LIKE '%" . $name . "%' OR LCASE(q.name_en) LIKE '%" . $name . "%')";
		}

		if ($city_id) {
			$sql .= " AND q.city_id = '" . (int)$city_id . "'";
		}

		$sql .= " ORDER BY q.name" . $suffix;

		$sql .= " LIMIT " . (int)$limit;

		$query = $this->db->query($sql)->rows;

		return $query;
	}

	public function getEcontStreets(){
		$response = array();
		$city_id = (int)($this->db->escape($_GET['door_city_id']));
		$street_name = $this->db->escape($_GET['door_street_name']);
		$country_code = $this->db->escape($_GET['country_code']);

		$results = $this->getStreetsByCityId($city_id, $street_name, $country_code);

		foreach ($results as $row) {

			$res['text'] = $row['name'];
			$res['id'] = $row['name'];

			$response[] = $res;
			
		}

		$this->send_json($response);
	}

	public function getStreetsByCityId($city_id, $name, $country_code = 'BG', $limit = 10) {
		$country_codes = array('GR' => 'GRC', 'RO' => 'ROU');
		$name = mb_strtolower($name);

		if (preg_match("/^[\w\d\s.,-]*$/", $name)) {
			$suffix = '_en';
		} else {
			$suffix = '';
		}
		if( $country_code == 'GR' || $country_code == 'RO'){
			$sql = "SELECT *, s.name" . $suffix . " AS name FROM " . $this->db_prefix . "econt_street_intl s WHERE country_code = '" . $country_codes[$country_code] . "'";
		}else{
			$sql = "SELECT *, s.name" . $suffix . " AS name FROM " . $this->db_prefix . "econt_street s WHERE 1";
		}
		if ($name) {
			$sql .= " AND (LCASE(s.name) LIKE '%" . $name . "%' OR LCASE(s.name_en) LIKE '%" . $name . "%')";
		}

		if ($city_id) {
			$sql .= " AND s.city_id = '" . (int)$city_id . "'";
		}

		$sql .= " ORDER BY s.name" . $suffix;

		$sql .= " LIMIT " . (int)$limit;

		$query = $this->db->query($sql)->rows;

		return $query;
	}

	public function tr($string){
    	$translations = array(
			//Bulgarian
			'bg_pc' => 'п.к.',
			'bg_region' => 'област',
			'bg_address' => 'адрес',
			'bg_phone' => 'телефон',
			'bg_oc' => 'о.к.',

		    //Greek
		    'el_pc' => 'ταχυδρομικός κώδικας',
		    'el_region' => 'περιοχή',
		    'el_address' => 'διεύθυνση',
		    'el_phone' => 'τηλέφωνο',
		    'el_oc' => 'κωδικός γραφείου',

			//English
			'en_pc' => 'p.c.',
			'en_region' => 'region',
			'en_address' => 'address',
			'en_phone' => 'phone',
			'en_oc' => 'o.c.',

		    //Romanian
		    'ro_pc' => 'cod poștal',
		    'ro_region' => 'zonă',
		    'ro_address' => 'abordare',
		    'ro_phone' => 'telefon',
		    'ro_oc' => 'cod poștal',
      
		);

		if(!empty($translations[$string])){
			$translated_string = $translations[$string];
		}else{
			$s = explode('_', $string);
			$translated_string = $translations['bg_' . $s[1]];
		}

		return $translated_string;

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
	
	public function send_json( $data ) {
		if ( ! headers_sent() ) {
			header( 'Content-Type: application/json; charset=utf8' );
		}

		echo json_encode( $data, JSON_UNESCAPED_UNICODE );
		
		die;
	}
}

New EcontFastAjax();
