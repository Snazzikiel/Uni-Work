<?php 
	

function getItems(){
	
	require_once(".\classes\cModelItem.php");
	
	$sql = "";
	$objModel = new cModelItem();
	$temp = $objModel->getTableData($sql);	

	
	$selectState;
	
	$selectState = '<select name="ItemID">';
	foreach ($temp as $row){
		$selectState .= '<option value="' . $row["ItemID"] . '">';
		$selectState .= $row["ItemID"] . " - " . $row["Name"];
		$selectState .= '</option>';
	}
	$selectState .= '</select>';
	
	return $selectState;
}
	
	
	
	
	

?>