<?php 

require_once ("cDefaultTable.php");

class cInterest extends cDefaultTable {

	public function __construct(){
		$this->tableName = 'interest';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('CustomerID','SubjectArea','Display');
		$this->fieldList['CustomerID'] = array('pkey' => 'y');

	}
}

?>
