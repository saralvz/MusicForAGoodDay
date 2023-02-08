<?php
class Songs{   
    
    private $songsTable = "songs";      
    public $id;
    public $songName;
    public $artistName;
    public $songGender;
    public $youtubeUrl;   
    public $imgUrl; 
	public $listened; 
	public $users_id;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->songsTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->songsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->songsTable."(`songName`, `artistName`, `songGender`, `youtubeUrl`, `imgUrl`, `listened`, `users_id`)
			VALUES(?,?,?,?,?,?,?)");
		
		$this->songName = htmlspecialchars(strip_tags($this->songName));
		$this->artistName = htmlspecialchars(strip_tags($this->artistName));
		$this->songGender = htmlspecialchars(strip_tags($this->songGender));
		$this->youtubeUrl = htmlspecialchars(strip_tags($this->youtubeUrl));
		$this->imgUrl = htmlspecialchars(strip_tags($this->imgUrl));
		$this->listened = htmlspecialchars(strip_tags($this->listened));
		$this->users_id = htmlspecialchars(strip_tags($this->users_id));
		
		
		$stmt->bind_param("sssss", $this->songName, $this->artistName, $this->songGender, $this->youtubeUrl, $this->imgUrl);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->songsTable." 
			SET songName= ?, artistName = ?, songGender = ?, youtubeUrl = ?, imgUrl = ?, listened = ?, users_id = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->songName = htmlspecialchars(strip_tags($this->songName));
		$this->artistName = htmlspecialchars(strip_tags($this->artistName));
		$this->songGender = htmlspecialchars(strip_tags($this->songGender));
		$this->youtubeUrl = htmlspecialchars(strip_tags($this->youtubeUrl));
		$this->imgUrl = htmlspecialchars(strip_tags($this->imgUrl));
		$this->listened = htmlspecialchars(strip_tags($this->listened));
		$this->users_id = htmlspecialchars(strip_tags($this->users_id));
	 
		$stmt->bind_param("sssssiii", $this->songName, $this->artistName, $this->songGender, $this->youtubeUrl, $this->imgUrl, $this->listened, $this->users_id, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->songsTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>