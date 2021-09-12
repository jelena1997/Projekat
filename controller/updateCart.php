<?php
include("../model/konekcija.php");
if(isset($_POST['submit'])){

foreach($_POST['kolicina'] as $key => $val) {
    if($val==0) {
        unset($_SESSION['cart'][$key]);
    }else{
        $_SESSION['cart'][$key]['kolicina']=$val;
    }
}

header("Location: ../viewer/cart.php");

}



 ?>
