<?php 

require_once ("cDefaultTable.php");

class cSale extends cDefaultTable {
	
	public function __construct(){
		$this->tableName = 'sale';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('SaleID','CustomerID','EmployeeID','ItemID','TransactionID','Date','Quantity','Discount','TotalValue');
		$this->fieldList['SaleID'] = array('pkey' => 'y');
	}
	
	

	
}

?>
