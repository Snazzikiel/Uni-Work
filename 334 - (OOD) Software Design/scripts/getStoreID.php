<?php 
	

function getStoreID(){
	
	require_once(".\classes\cStore.php");
	require_once(".\classes\cContact.php");
		
	$sql = "";
	$objStore = new cStore();
	$tempStore = $objStore->getTableData($sql);
	
	$objContact = new cContact();
	
	
	
	$selectStore;
	$selectStore = '<select name="StoreID">';
	foreach ($tempStore as $row){
		$sql = "ContactID = " . $row["ContactID"];
		$tempContact = $objContact->getTableData($sql);	
		$selectStore .= '<option value="' . $row["StoreID"] . '">';
		$selectStore .= $row["StoreID"] . " - " . $tempContact[0]["Address"];
		$selectStore .= '</option>';
	}
	$selectStore .= '</select>';
	
	return $selectStore;
}
	
	
	
	
	

?>