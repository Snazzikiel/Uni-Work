<?php

require_once dbConnect.php

class cEmployee {
	
	private $EmployeeID;
	private $StoreID;
	private $FirstName;
	private $LastName;
	private $PhoneNumber;
	private $JobTitle;
	private $Password;
	private $Email;
	private $Address;
	
	//constructor
	public function __construct($EmployeeID, $StoreID, $FirstName, $LastName, $PhoneNumber,
		$JobTitle, $Password, $Email, $Address){		
			$this->$EmployeeID = $EmployeeID;
			$this->$StoreID = $StoreID;
			$this->$FirstName = $FirstName;
			$this->$LastName = $LastName;
			$this->$PhoneNumber = $PhoneNumber;
			$this->$JobTitle = $JobTitle;
			$this->$Password = $Password;
			$this->$Email = $Email;
			$this->$Address = $Address;
	}
	
	//Get methods
	public function getEmployeeID(){
		return $this->EmployeeID;
	}
	public function getStoreID(){
		return $this->StoreID;
	}
	public function getFirstName(){
		return $this->FirstName;
	}
	public function getLastName(){
		return $this->LastName;
	}
	public function getPhoneNumber(){
		return $this->PhoneNumber;
	}
	public function getJobTitle(){
		return $this->JobTitle;
	}
	public function getPassword(){
		return $this->Password;
	}
	public function getEmail(){
		return $this->Email;
	}
	public function getAddress(){
		return $this->Address;
	}
	
	//Set Methods
	public function setEmployeeID($EmployeeID){
		$this->EmployeeID = $EmployeeID;
	}
	public function setStoreID($StoreID){
		$this->StoreID = $StoreID;
	}
	public function setFirstName($FirstName){
		$this->FirstName = $FirstName;
	}
	public function setLastName($LastName){
		$this->LastName = $LastName;
	}
	public function setPhoneNumber($PhoneNumber){
		$this->PhoneNumber = $PhoneNumber;
	}
	public function setJobTitle($JobTitle){
		$this->JobTitle;
	}
	public function setPassword($Password){
		$this->Password = $Password;
	}
	public function setEmail($Email){
		$this->Email = $Email;
	}
	public function setAddress($Address){
		$this->Address = $Address;
	}
	
	
	
}



?>
