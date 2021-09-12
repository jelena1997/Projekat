<?php

class Proizvod {

	private $conn;
	private $result;


	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function getResult(){
		return $this->result;
	}

	public function setResult($res){
			$this->result = $res;
	}

	public function vratiProizvode() {

		$curl_zahtev = curl_init("http://localhost/agencija/api/proizvodi.json");

		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);
		$this->setResult($json_objekat);
	}
  public function vratiPorudzbine() {

		$curl_zahtev = curl_init("http://localhost/agencija/api/porudzbine.json");

		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);
		$this->setResult($json_objekat);
	}

  public function vratiKategorije() {

		$curl_zahtev = curl_init("http://localhost/agencija/api/kategorije.json");

		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);
		$this->setResult($json_objekat);
	}

  public function vratiProizvodPoIDu($id) {

		$curl_zahtev = curl_init("http://localhost/agencija/api/proizvodi/".$id.".json");

		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);
		$this->setResult($json_objekat);
	}

	public function noviProizvod($eventID,$typeID,$ime,$phone) {

			$eventID = mysqli_real_escape_string($this->conn,$eventID);
			$typeID = mysqli_real_escape_string($this->conn,$typeID);
			$ime = mysqli_real_escape_string($this->conn,$ime);
			$phone = mysqli_real_escape_string($this->conn,$phone);
			$userID=$_SESSION["user"]["userID"];
			$now =date("Y-m-d H:i:s");
			$sql = "INSERT INTO reservation (typeID,eventID,userID, reservationOnName,phoneNumber,dateOfReservation) VALUES ($typeID,$eventID,$userID, '$ime','$phone','$now')";

		if(mysqli_query($this->conn, $sql)){
			$this->setResult(true);
		}else{
			$this->setResult(false);
		};

	}


	public function izmenaImena($eventID,$ime) {

		$eventID = mysqli_real_escape_string($this->conn,$eventID);
		$ime = mysqli_real_escape_string($this->conn,$ime);

		if(mysqli_query($this->conn, "UPDATE event SET eventName='$ime' where eventID=$eventID")){
			$this->setResult(true);
		}else{
			$this->setResult(false);
		};

	}



}

?>
