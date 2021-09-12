<?php
class Database {
	private $hostname = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "agencija";
	private $dblink;
	private $result = true;
	private $records;
	private $affectedRows;


	function __construct($dbname)
	{
		$this->$dbname = $dbname;
		$this->Connect();
	}

	public function getResult()
	{
		return $this->result;
	}

	function __destruct()
	{
		$this->dblink->close();
	}


	function Connect()
	{
		$this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
		if($this->dblink->connect_errno)
		{
			printf("Konekcija neuspesna: %s\n",  $mysqli->connect_error);
			exit();
		}
		$this->dblink->set_charset("utf8");
	}

		function noviKorisnik($data) {
			$mysqli = new mysqli("localhost", "root", "", "agencija");
			$cols = '(imeIPrezime, kime, lozinka, administrator)';

			$ime = mysqli_real_escape_string($mysqli,$data['ime']);
			$kime = mysqli_real_escape_string($mysqli,$data['kime']);
			$lozinka = mysqli_real_escape_string($mysqli,$data['lozinka']);


			$values = "('".$ime."','".$kime."','".$lozinka."',0)";

			$query = 'INSERT into korisnik '.$cols.' VALUES '.$values;
			
			if($mysqli->query($query))
			{
				$this ->result = true;
			}
			else
			{
				$this->result = false;
			}
			$mysqli->close();
		}

	function vratiProizvode() {
		$mysqli = new mysqli("localhost", "root", "", "agencija");
		$q = 'SELECT * FROM proizvodi p join kategorija k on p.kategorijaID = k.kategorijaID ';
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}

	function vratiProizvod($id) {
		$mysqli = new mysqli("localhost", "root", "", "agencija");
		$id= mysqli_real_escape_string($mysqli,$id);
		$q = 'SELECT * FROM proizvodi p join kategorija k on p.kategorijaID = k.kategorijaID where p.id='.$id;
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}

	function vratiPorudzbine() {
		$mysqli = new mysqli("localhost", "root", "", "agencija");
		$q = 'SELECT * FROM porudzbina ';
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}
	function vratiKategorije() {
		$mysqli = new mysqli("localhost", "root", "", "agencija");
		$q = 'SELECT * FROM kategorija ';
		$this ->result = $mysqli->query($q);
		$mysqli->close();
	}

	function ExecuteQuery($query)
	{
		if($this->result = $this->dblink->query($query)){
			if (isset($this->result->num_rows)) $this->records         = $this->result->num_rows;
				if (isset($this->dblink->affected_rows)) $this->affected        = $this->dblink->affected_rows;
					return true;
		}
		else{
			return false;
		}
	}
}
?>
