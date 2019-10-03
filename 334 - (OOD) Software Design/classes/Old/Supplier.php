<?php

require_once dbConnect.php

//Need function to ADD supplier to Database
class Supplier {
	public $db_con;
	
	public $name;
	public $contact;
	public $telephone;
	public $creditLine = false;
	public $balance;
	public $products;
	
	public function __construct(mysqli db_con, $name, $contact, $telephone, $creditLine, $balance, $products){		
		$this->db_con = db_con;
		
		$this->name = name;
		$this->contact = contact;
		$this->telephone = telephone;
		$this->creditLine = creditLine;
		$this->balance = balance;
		
		$counter = 0;
		foreach ($products as $prod){
			$this->products[$counter] = $prod;
			$counter++;
		}
	}
	
	public function fnGetAllSuppliers(){
		$sql = "SELECT * FROM supplier WHERE name=?";
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		return false;
	}
	
	public function fnGetSup($supplierName){
		$sql = "SELECT * FROM supplier WHERE name=" . $supplierName;
		if ($dbData = dbQuery(sql)){
			if ($dbData->rowCount() > 0){
				return $dbData;
			}
		}
		return false;
	}
	
}