<?php 
	

function getItemSubjectArea(){
	
	require_once(".\classes\cModelItem.php");
	
	$sql = "";
	$objModel = new cModelItem();
	$temp = $objModel->getTableData($sql);	

	
	$modelTypes;
	
	$modelTypes = '<select name="SubjectArea">';
	$modelTypes .= '<option value="Trains">Train</option>';
	$modelTypes .= '<option value="Cars">Car</option>';
	$modelTypes .= '<option value="Boats">Boat</option>';
	$modelTypes .= '<option value="Aircraft">Aircraft</option>';
	$modelTypes .= '<option value="Other">Other</option>';
	$modelTypes .= '</select>';
	
	return $modelTypes;
}
	
	
	
	
	

?>