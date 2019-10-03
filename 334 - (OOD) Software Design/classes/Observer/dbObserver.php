<?php 

include_once("stockWatch.php");

class dbObserver implements stockObserver
{
    private $userID;
    
    public function __construct($userID) {
        $this->userID = $userID;
    }
    
    public function update(stockSubject $subject) {
        $_SESSION["observerMsg"] = $this->userID.' just made a transaction! <b>'.$subject->getContent().'</b>';
    }
}

?>