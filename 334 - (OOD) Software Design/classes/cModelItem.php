<?php 

require_once ("cDefaultTable.php");

class cModelItem extends cDefaultTable {
	
	public function __construct(){
		$this->tableName = 'modelitem';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('ItemID','Name','ModelType','SubjectArea','SellPrice','BuyPrice','DateOfIntroduction','Description','ItemAvailability','SupplierID');
		$this->fieldList['ItemID'] = array('pkey' => 'y');
		
	}
}

?>
