<?php
include("../model/konekcija.php");

$id = $_GET['id'];

$sql = "delete from porudzbina where porudzbinaID=$id";

if(mysqli_query($mysqli, $sql)){
  echo 'Porudzbina uspesno obrisana. Ucitajte ponovo stranicu da bi videli promene.';
}else{
    echo 'Greska prilikom brisanja porudzbine';
}
 ?>