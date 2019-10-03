<?php

require_once("dbConnect.php");

//Parent of Model-View-Controller design pattern
class cDefaultTable {
	
	//public $dbCon;
	public $tableName;
	public $fieldList;
	public $tableData;
	public $pageCount;
	public $pageTotal;
	public $error;
	public $rowCount;
	public $rowTotal;
	
	public function __construct(){
		
		//$db = dbConnect::startDB();
		//$this->dbCon = $db->getConnection();
		$this->tableName = 'blankName';
		$this->rowCount = 0;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->rowTotal = 0;
		$this->fieldList = array('one','two','three');
		$this->fieldList['one'] = array('pkey' => 'y');
	}
	
	public function addData($constraint){
		$db = dbConnect::startDB();

		//query the table for data wanted
		//$SQLquery = "SELECT * FROM " . $this->tableName . $constraint;
		
		$result = $db->dbQuery($constraint);
		if (!$result) {
			return "getSQL Error: " . mysqli_error($db->getConnection());
		}
	}
	public function getTableData($constraint){
		
		if ($constraint != ""){
			$constraint = " WHERE " . $constraint;
		}
		
		$this->tableData = array();
		$pageCount = $this->pageCount;
		$rowCount = $this->rowCount;
		
		$this->pageTotal = 0;
		$this->rowTotal = 0;
		
		$db = dbConnect::startDB();

		//query the table for data wanted
		$SQLquery = "SELECT * FROM " . $this->tableName . $constraint;
		
		$result = $db->dbQuery($SQLquery);
		if (!$result) {
			return "getSQL Error: " . mysqli_error($db->getConnection());
		}
		
		$data = mysqli_fetch_row($result);
		
		//get total Page and Row numbers from query
		$this->pageTotal = $data[0];
		if ($this->pageTotal <= 0){
			$this->pageCount = 0;
			return;
		}
		if ($rowCount > 0){
			$this->rowTotal = ceil($this->pageTotal/$rowCount);
		} else {
			$this->rowTotal = 1;
		}
		
		if ($pageCount == '' || $pageCount <= '1'){
			$pageCount = 1;
		} elseif ($pageCount > $this->rowTotal) {
			$pageCount = $this->rowTotal;
		}
		
		//get correct data after rows have been calculated
		if ($rowCount > 0){
			$addLimit = 'LIMIT ' . ($pageCount - 1) * $rowCount . ',' . $rowCount;
		} else {
			$addLimit = NULL;
		}
		
		$SQLquery .= " " .$addLimit;
		$result = $db->dbQuery($SQLquery);
		if (!$result) {
			return "getSQL Error: " . mysqli_error($db->getConnection());
		}
		
		//while($row = mysql_fetch_assoc($result)){
		while($row = $result->fetch_assoc()){
			$this->tableData[] = $row;
		}
		
		return $this->tableData;
	}
	
	public function insertTableData($fieldData){
		$this->error = array();
		$fieldList = $this->fieldList;
		$db = dbConnect::startDB();
		
		//add only fields that exist in the table
		foreach ($fieldData as $field => $fieldvalue){
			if (!in_array($field, $fieldList)){
				unset ($fieldData[$field]);
			}
		}
		
		$SQLquery = "INSERT INTO " . $this->tableName . " SET ";
		foreach ($fieldData as $colItem => $value){
			$SQLquery .= $colItem . " = '" . $value . "', ";
		}
		$SQLquery = rtrim($SQLquery, ', ');
		
		$result = $db->dbQuery($SQLquery);
		if (!$result) {
			return "InsertSQL Error: " . mysqli_error($db->getConnection());
		}		
		return;
	}

	public function updateTableData($fieldData){
		$this->errors = array();
		$db = dbConnect::startDB();
		$fieldList = $this->fieldList;
		
		//add only fields that exist in the table
		foreach ($fieldData as $field => $fieldvalue){
			if (!in_array($field, $fieldList)){
				unset ($fieldData[$field]);
			}
		}
		$whereConstraint = NULL;
		$update = NULL;
		foreach ($fieldData as $colItem => $value) {
			if (isset($fieldList[$colItem]['pkey'])) {
				$whereConstraint .= $colItem . " = '" . $value . "' AND ";
			} else {
				$update .= $colItem . " = '" . $value . "', ";
			} 
		}
		
		$whereConstraint = rtrim($whereConstraint, ' AND ');
		$update = rtrim($update, ', ');
		
		$SQLquery = "UPDATE " . $this->tableName . " SET " . $update . " WHERE " . $whereConstraint;
		$result = $db->dbQuery($SQLquery);
		if (!$result) {
			return "<br /><br />UpdateSQL Error: " . mysqli_error($db->getConnection());
		}
		return;
		
	}
	
	public function deleteTableData($fieldData){
		$this->errors = array();
		//$fieldData = $this->fieldData;
		$fieldList = $this->fieldList;
		$whereConstraint = NULL;
		$db = dbConnect::startDB();
		
		foreach ($fieldData as $colItem => $value){
			if (isset($fieldList[$colItem]['pkey'])) {
				$whereConstraint .= $colItem . " = '" . $value . "' AND ";
			}
		}
		$whereConstraint = rtrim($whereConstraint, ' AND ');
		
		$SQLquery = "DELETE FROM " . $this->tableName . " WHERE " . $whereConstraint;
		echo $SQLquery;
		$result = $db->dbQuery($SQLquery);
		if (!$result) {
			return "DeleteSQL Error: " . mysqli_error($db->getConnection());
		}
	}
		
}