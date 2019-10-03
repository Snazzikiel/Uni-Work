<?php 

require_once ("cDefaultTable.php");

class cEmployee extends cDefaultTable {	
	public function __construct(){
		$this->tableName = 'employee';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('EmployeeID','ContactID','StoreID','JobTitle','Password');
		$this->fieldList['EmployeeID'] = array('pkey' => 'y');

	}
}

?>
