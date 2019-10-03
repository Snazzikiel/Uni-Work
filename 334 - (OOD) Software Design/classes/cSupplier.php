<?php 

require_once ("cDefaultTable.php");

class cSupplier extends cDefaultTable {

	public function __construct(){
		$this->tableName = 'supplier';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('SupplierID','Name','CreditLine','ContactID');
		$this->fieldList['SupplierID'] = array('pkey' => 'y');

	}
}

?>
