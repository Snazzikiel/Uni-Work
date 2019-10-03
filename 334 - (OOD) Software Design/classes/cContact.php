<?php 

require_once ("cDefaultTable.php");

class cContact extends cDefaultTable {
	
	public function __construct(){
		$this->tableName = 'contact';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('ContactID','FirstName','LastName','Address','PhoneNumber','Email','Fax','ImageLocation');
		$this->fieldList['ContactID'] = array('pkey' => 'y');
		

	}
}

?>
