<?php

require_once dbConnect.php

class Transactions {
	public $db_con;
	
	public $transData;
	
	
	public function __construct(mysqli db_con, $transData){		
		//connect to dbConnect class
		$this->db_con = get_connection();
		$this->transData = $transData;
		
	}
	
	public function dnGetAllTransactions(){
		$sql = "SELECT * FROM transaction WHERE name=?";
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		
		return false;
	}
	
	public function fnGetTransaction($transaction){
		$sql = "SELECT * FROM transaction WHERE name=" . $transaction;
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		
		return false;
	}
	
	
	
}