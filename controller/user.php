<?php

class User {

	private $mysqli;
	private $result;


	public function __construct($mysqli) {
		$this->mysqli = $mysqli;
	}

	public function getResult(){
		return $this->result;
	}

	public function setResult($res){
			$this->result = $res;
	}

	
	public function login($username,$password) {

		$username = mysqli_real_escape_string($this->mysqli,$username);
		$password = mysqli_real_escape_string($this->mysqli,$password);
		$q = mysqli_query($this->mysqli, "select * from korisnik where  kime='$username' and lozinka='$password' limit 1");

		if(mysqli_num_rows($q)>0){
			 while($red = mysqli_fetch_assoc($q)) {
				 $_SESSION['korisnik'] = $red;
			 }
			$this->setResult(true);
		}else{
			$this->setResult(false);
		};

	}
	public function loginAdmin($username,$password) {

		$username = mysqli_real_escape_string($this->mysqli,$username);
		$password = mysqli_real_escape_string($this->mysqli,$password);
		$q = mysqli_query($this->mysqli, "select * from korisnik where  kime='$username' and lozinka='$password' and administrator=1 limit 1");

		if(mysqli_num_rows($q)>0){
			 while($red = mysqli_fetch_assoc($q)) {
				 $_SESSION['korisnik'] = $red;
			 }
			$this->setResult(true);
		}else{
			$this->setResult(false);
		};

	}

}

?>
