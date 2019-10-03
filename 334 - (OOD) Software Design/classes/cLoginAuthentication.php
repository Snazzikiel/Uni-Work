<?php

require_once ("cEmployee.php");
require_once ("cContact.php");

class cLoginAuthentication {
	public $db;
	public $employeeID;
	public $password;
	public $userData;
	
	public function __construct($employeeID, $password){
		$this->employeeID = $employeeID;
		$this->password = $password;
		$this->userData = "";
	}
	
	public function fnLogin() {
		$user = $this->fnVerifyDetails();
		
		if ($user) {
			$this->userData = $user;
			$_SESSION['userData'] = $user;
			$_SESSION["observerMsg"] = "";
			$_SESSION["userName"] = $user["userName"];
			return $user;
		}
		
		return false;
	}
	
	protected function fnVerifyDetails() {
		
		$employee = new cEmployee();
		$sql = "EmployeeID = " . $this->employeeID;
		
		if ($dbData = $employee->getTableData($sql)){
			$contact = new cContact();
			$sql = "ContactID = " . $dbData[0]["ContactID"];
			//add imagelocation and name so it is easy to find later for the user
			if ($contactData = $contact->getTableData($sql)){
					$dbData[0]["userName"] = $contactData[0]["FirstName"] . " " . $contactData[0]["LastName"];
					$dbData[0]["ImageLocation"] = $contactData[0]["ImageLocation"];
			}
			
			if ($dbData[0]["Password"] == $this->password){
				return $dbData[0];
			}
		}
		
		return false;
	}
	
	public function fnGetUser(){
		return $this->userData;
	}
}

?>