<?php 

require_once ("cDefaultTable.php");

class cClubMember extends cDefaultTable {

	
	public function __construct(){
		$this->tableName = 'clubmember';
		$this->rowCount = 20;
		$this->pageCount = 0;
		$this->pageTotal = 0;
		$this->RowTotal = 0;
		$this->fieldList = array('ClubMemberID','CustomerID','DateOfJoining', 'MemberStatus');
		$this->fieldList['ClubMemberID'] = array('pkey' => 'y');
	
	}
}

?>
