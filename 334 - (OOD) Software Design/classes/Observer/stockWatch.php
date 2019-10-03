><?php

interface stockSubject {
	public function attach(stockObserver $observer);
	public function detach(stockObserver $observer);
	public function notifyUser();
}

interface stockObserver {
	public function update(stockSubject $stock);
}


class cLowStockLevel implements stockSubject {
	
    protected $observers = array();
    protected $userID;
    protected $notice;


    public function __construct($userID){
        $this->userID = $userID;
    }

    public function attach(stockObserver $observer){
        $this->observers[] = $observer;
    }

    public function detach(stockObserver $observer){
        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    public function notifyUser(){
        foreach ($this->observers as $value) {
            $value->update($this);
        }
		
    }
	
	public function getContent() {
        return $this->notice." ({$this->userID})";
    }
	
	public function lowStock($message){
		$this->notice = $message;
		$this->notifyUser();
	}
	
	
	public function getMessage(){
		return $this->notice;
	}

}


?>