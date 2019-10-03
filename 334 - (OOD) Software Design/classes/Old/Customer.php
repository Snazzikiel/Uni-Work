<?php

require_once dbConnect.php

class Customer {
	public $db_con;
	
	public $customerData;
	
	
	public function __construct(mysqli db_con, $customerData){		
		//connect to dbConnect class
		$this->db_con = get_connection();
		$this->customerData = $customerData;
		
	}
	
	public function fnGetAllCustomers(){
		$sql = "SELECT * FROM customer WHERE name=?";
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		return false;
	}
	
	public function fnGetCust($customerID){
		$sql = "SELECT * FROM customer WHERE name=" . $customerID;
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		return false;
	}
	
	public function fnGetCustName($custName){
		return customerData->name;
	}
	
	
	
}



?>
