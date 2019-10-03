<?php 

require_once ("cDefaultTable.php");

class cStore extends cDefaultTable {
	
	public function __construct(){
		$this->tableName = 'store';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('StoreID','ContactID');
		//$this->fieldList['one'] = array('pkey' => 'y');

	}
}

?>
