<?php
include("../model/konekcija.php");

$sql="SELECT * FROM proizvodi WHERE id IN (";

        foreach($_SESSION['cart'] as $id => $value) {
            $sql.=$id.",";
        }

        $sql=substr($sql, 0, -1).") ORDER BY naziv ASC";
        $q = mysqli_query($mysqli, $sql);
        $totalprice=0;
        while($red = mysqli_fetch_assoc($q)) {
            $subtotal=$_SESSION['cart'][$red['id']]['kolicina']*$red['cena'];
            $totalprice+=$subtotal;
        }
        $now =date("Y-m-d H:i:s");
        $korisnikID = $_SESSION['korisnik']['korisnikID'];

        $sql = "INSERT INTO porudzbina (datumPorudzbine,ukupanIznos,korisnikID) VALUES ('$now',$totalprice,$korisnikID)";

  		if(mysqli_query($mysqli, $sql)){
        $idPor = $mysqli->insert_id;
        $sql="SELECT * FROM proizvodi WHERE id IN (";

                foreach($_SESSION['cart'] as $id => $value) {
                    $sql.=$id.",";
                }

                $sql=substr($sql, 0, -1).") ORDER BY naziv ASC";
                $q = mysqli_query($mysqli, $sql);
                $totalprice=0;
                while($red = mysqli_fetch_assoc($q)) {
                  $kolicina = $_SESSION['cart'][$red['id']]['kolicina'];
                    $subtotal=$_SESSION['cart'][$red['id']]['kolicina']*$red['cena'];
                    $id = $red['id'];
                    $upit = "INSERT INTO stavkaPorudzbine (porudzbinaID,proizvodID,kolicina,iznos) VALUES ($idPor,$id,$kolicina,$subtotal)";
                    if(!mysqli_query($mysqli, $upit)){
                      die("GRESKA");
                    }
                }

                $_SESSION['cart'] = array();

                echo('Rezervacija je uspesna.');
  		}else{
  			echo('Neuspesna rezervacija');
  		};
?>
