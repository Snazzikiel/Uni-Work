<?php 
	

function getJobTitle(){
	
	
	$selectJob;
	$selectJob = '<select name="JobTitle">';
	$selectJob .= '<option value="Admin">Admin</option>';
	$selectJob .= '<option value="Backend Staff">Backend Staff</option>';
	$selectJob .= '<option value="Frontend Staff">Frontend Staff</option>';
	$selectJob .= '</select>';
	
	return $selectJob;
}
	
	
	
	
	

?>