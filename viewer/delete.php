
<?php
include("../model/konekcija.php");
$id=$_REQUEST['id'];
$query = "DELETE FROM proizvodi WHERE id=$id"; 
$result = mysqli_query($mysqli,$query) or die ( mysqli_error());
header("Location: admin.php"); 
?>