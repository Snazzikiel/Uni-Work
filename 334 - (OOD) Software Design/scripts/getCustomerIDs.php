<?php 
	

function getCustomerIDs(){
	
	require_once(".\classes\cContact.php");
		
	$sql = "";
	$objContact = new cContact();
	$tempCon = $objContact->getTableData($sql);	
	
	
	$selectState;
	$selectState = '<select name="CustomerID">';
	foreach ($tempCon as $row){
		$selectState .= '<option value="' . $row["ContactID"] . '">';
		$selectState .= $row["ContactID"] . " - " . $row["FirstName"] . " " . $row["LastName"];
		$selectState .= '</option>';
	}
	$selectState .= '</select>';
	
	return $selectState;
}
	
	
	
	
	

?>