<?php 

//singleton Connection
class dbConnect {
	private static $db = null;
	private $conn;
	
	private $DB_SERVER = 'localhost';
	private $DB_USERNAME = 'admin1';
	private $DB_PASSWORD = 'admin1';
	private $DB_NAME = 'project334';
	
	public function __construct(){
		 $this->conn = mysqli_connect($this->DB_SERVER, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);
		 
		 if (mysqli_connect_error()){
			 trigger_error("Failed to connect to MYSQL: " . mysql_connect_error, E_USER_ERROR);
		 }
		 
	}
	
	public static function startDB(){
		if (!self::$db) {
			self::$db = new dbConnect();
		}
		return self::$db;
	}
		
	private function __clone() {} 
	
	public function getConnection(){
		return $this->conn;
	}
	
	//public function __destruct(){
	//	$this->conn->close();
	//}
	
	//run query
	public function dbQuery($sql){
		return $this->conn->query($sql);
	}
}

?>