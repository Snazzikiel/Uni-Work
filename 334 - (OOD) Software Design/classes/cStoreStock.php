<?php 

require_once ("cDefaultTable.php");

class cStoreStock extends cDefaultTable {
	
	public function __construct(){
		$this->tableName = 'storestock';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('StoreID','ItemID','Quantity','ItemLOcation');
		$this->fieldList['ItemID'] = array('pkey' => 'y');
		
	}
}

?>

