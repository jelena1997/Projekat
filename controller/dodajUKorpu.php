<?php
 include("../model/konekcija.php");
 $id=intval($_GET['id']);

 if(isset($_SESSION['cart'][$id])){

           header("Location: ../viewer/cart.php");

}else{

              include("../controller/proizvod.php");
              $proizvod = new Proizvod($mysqli);
              $proizvod->vratiProizvodPoIDu($id);
              $proizvodiIzBaze = $proizvod->getResult();

           if(count($proizvodiIzBaze) >0){
             $pr = $proizvodiIzBaze[0];
               $_SESSION['cart'][$pr['id']]=array(
                       "kolicina" => 1,
                       "cena" => $pr['cena']
                   );

                   header("Location:../viewer/welcome.php");

           }else{

               die("Nema proizvoda sa tim id-em");

           }

       }
  ?>
