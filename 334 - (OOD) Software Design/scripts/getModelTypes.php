<?php 
	

function getModelTypes(){
		
	$modelTypes;
	
	$modelTypes = '<select name="ModelTypes">';
	$modelTypes .= '<option value="display">Display</option>';
	$modelTypes .= '<option value="static">Static</option>';
	$modelTypes .= '<option value="working">Working</option>';
	$modelTypes .= '</select>';
	
	return $modelTypes;
}
	
	
	
	
	

?>