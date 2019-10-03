<?php 
	

function getEmployees(){
	
	require_once(".\classes\cEmployee.php");
	require_once(".\classes\cContact.php");
	
	$sql = "";
	$objEmp = new cEmployee();
	$empData = $objEmp->getTableData($sql);	
	
	$objContact = new cContact();
	
	$selectState;
	
	$selectState = '<select name="EmployeeID">';
	foreach ($empData as $row){
		$sql = "ContactID = " . $row["ContactID"];
		$empContact = $objContact->getTableData($sql);	
		$selectState .= '<option value="' . $row["EmployeeID"] . '">';
		$selectState .= $row["EmployeeID"] . " - " . $empContact[0]["FirstName"] . " " . $empContact[0]["LastName"];
		$selectState .= '</option>';
	}
	$selectState .= '</select>';
	
	return $selectState;
}
	
	
	
	
	

?>