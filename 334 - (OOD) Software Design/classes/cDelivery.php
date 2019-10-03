<?php 

require_once ("cDefaultTable.php");

class cDelivery extends cDefaultTable {

	
	public function __construct(){
		$this->tableName = 'delivery';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('DeliveryID','SupplierID','StoreID','ItemID','Quantity','DateOrdered','DateDelivered');
		$this->fieldList['DeliveryID'] = array('pkey' => 'y');

	}
}

?>
