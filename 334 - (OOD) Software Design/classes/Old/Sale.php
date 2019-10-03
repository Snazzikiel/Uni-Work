<?php

require_once dbConnect.php

class Sale {
	public $db_con;
	
	public $saleData;
	
	
	public function __construct(mysqli db_con, $saleData){		
		//connect to dbConnect class
		$this->db_con = get_connection();
		$this->customerData = $customerData;
		
	}
	
	public function fnGetAllSale(){
		$sql = "SELECT * FROM sale WHERE name=?";
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		return false;
	}
	
	public function fnGetSale($saleID){
		$sql = "SELECT * FROM sale WHERE name=" . $saleID;
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		return false;
	}
	
}