<?php 
	

function getSupplierID(){
	
	require_once(".\classes\cSupplier.php");
		
	$sql = "";
	$objSupplier = new cSupplier();
	$tempSup = $objSupplier->getTableData($sql);
		
	
	$selectSupplier;
	$selectSupplier = '<select name="SupplierID">';
	foreach ($tempSup as $row){
		$selectSupplier .= '<option value="' . $row["SupplierID"] . '">';
		$selectSupplier .= $row["SupplierID"] . " - " . $row["Name"];
		$selectSupplier .= '</option>';
	}
	$selectSupplier .= '</select>';
	
	return $selectSupplier;
}
	
	
	
	
	

?>