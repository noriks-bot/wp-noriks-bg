<?php

class EcontMysqli {
	
	private $link;
	public $config_path;
	public $wp_config;
	
	public function __construct() {

		$this->config_path = __DIR__ . '/../../../../../wp-config.php';
		$this->wp_config = $this->get_wp_config();
		
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		
		try {

			$this->link = @new \mysqli($this->wp_config['DB_HOST'], $this->wp_config['DB_USER'], $this->wp_config['DB_PASSWORD'], $this->wp_config['DB_NAME']);
		
			if ($this->link->connect_error) {
			
				trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);

			}

			$this->link->set_charset($this->wp_config['DB_CHARSET']);
			$this->link->query("SET SQL_MODE = ''");
			
		} catch (\mysqli_sql_exception $e) {
			
			throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
	
		}

	}

	public function query($sql) {
		$query = $this->link->query($sql);

		if (!$this->link->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();

				return $result;
			} else {
				return true;
			}
		} else {
			trigger_error('Error: ' . $this->link->error  . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
		}
	}
	
	public function escape($value) {
		return $this->link->real_escape_string($value);
	}

	public function __destruct() {
		$this->link->close();
	}
	
	public function get_wp_config() {
		
		$config_content = file_get_contents($this->config_path);

		$config_lines = explode("\n", $config_content);
		foreach ($config_lines as $line) {
			if (strpos($line, '$table_prefix') !== false ||
				strpos($line, 'DB_USER') !== false ||
				strpos($line, 'DB_PASSWORD') !== false ||
				strpos($line, 'DB_HOST') !== false ||
				strpos($line, 'DB_CHARSET') !== false ||
				strpos($line, 'DB_NAME') !== false){
				eval($line);
			}
		}
		
		$config_values = array(
			'table_prefix' => $table_prefix,
			'DB_USER' => DB_USER,
			'DB_PASSWORD' => DB_PASSWORD,
			'DB_HOST' => DB_HOST,
			'DB_CHARSET' => DB_CHARSET,
			'DB_NAME' => DB_NAME,
		);

		return $config_values;
	}
}