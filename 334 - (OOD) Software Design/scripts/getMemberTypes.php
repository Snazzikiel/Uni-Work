<?php 
	

function getMemberTypes(){
		$modelTypes;
	
	$modelTypes = '<select name="MemberStatus">';
	$modelTypes .= '<option value="Gold">Gold</option>';
	$modelTypes .= '<option value="Silver">Silver</option>';
	$modelTypes .= '<option value="Bronze">Bronze</option>';
	$modelTypes .= '</select>';
	
	return $modelTypes;
}
	
	
	
	
	

?>