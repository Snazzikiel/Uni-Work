<?php 

require_once ("cDefaultTable.php");

class cCustomer extends cDefaultTable {
	
	public function __construct(){
		$this->tableName = 'customer';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('CustomerID','ClubMemberStatus', 'CreditLine', 'CreditBalance');
		$this->fieldList['CustomerID'] = array('pkey' => 'y');

	}
}

?>