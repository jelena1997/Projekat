<?php
 include("../model/konekcija.php");
 include("../controller/proizvod.php");

$poruka = '';
 if(isset($_POST['noviProizvod'])) {
   $naziv = mysqli_real_escape_string($mysqli,$_POST['naziv']);
   $kategorija = mysqli_real_escape_string($mysqli,$_POST['kategorija']);
   $opis = mysqli_real_escape_string($mysqli,$_POST['opis']);
   $cena = mysqli_real_escape_string($mysqli,$_POST['cena']);

   $sql = "INSERT INTO proizvodi (naziv,opis,cena, kategorijaID) VALUES ('$naziv','$opis',$cena, $kategorija)";

     if(mysqli_query($mysqli, $sql)){
       $poruka="Uspesno uneto putovanje";
     }else{
       $poruka="Neuspesno uneto putovanje";
     };

  }

  if(isset($_POST['izmena'])) {
    $proizvodID = mysqli_real_escape_string($mysqli,$_POST['izmenaProizvod']);
    $cena = mysqli_real_escape_string($mysqli,$_POST['cenaizmena']);


    $sql = "UPDATE proizvodi set cena = $cena where id=$proizvodID";

      if(mysqli_query($mysqli, $sql)){
        $poruka="Uspesno izmenjena cena proizvoda";
      }else{
        $poruka="Neuspesna izmena cene";
      };

   }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Travelapp</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet"> 
<link href="css/flexslider.css" rel="stylesheet" /> 
<link href="css/style.css" rel="stylesheet" />
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper" class="home-page">
<div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">     
        <p class="pull-left hidden-xs"><i class="fa fa-clock-o"></i><span>Ponedeljak - Subota 8.00 - 18.00.</span></p>
        <p class="pull-right"><i class="fa fa-phone"></i>011 2589 147</p>
      </div>
    </div>
  </div>
</div>
  <!-- start header -->
  <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../viewer/index.php"><img src="img/logo.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../viewer/index.php">Pocetna</a></li>
                        <li class="active"><a href="../viewer/logout.php">Izlogujte se</a></li>
                        <li class="active"><a href="../viewer/cart.php">Vasa korpa</a></li>
                        <li class="active"><a href="../viewer/service.php">Privatni servis</a></li>
                    </ul>
                </div>
            </div>
        </div>
  </header>
    
  
  
  <section id="content">
  
  <section id="services" class="section pad-bot5 bg-white">
    <div class="container">
      <h2>Parametri servisa</h2>
<form method="GET" action="">
<p>Format ulaznih podataka: <select name="ulaz"><option value="xml">XML</option><option value="json">JSON</option></select></p>
<p>Poredak sortiranja: <select name="sort"><option value="ASC">Rastuci</option><option value="DESC">Opadajuci</option></select></p>
<p>Format izlaznih podataka: <select name="izlaz"><option value="xml">XML</option><option value="json">JSON</option></select></p>
<input type = "submit" value = "Pošalji" />
</form>
<?php if (isset ($_GET['ulaz']) && isset ($_GET['sort']) && isset ($_GET['izlaz'])){?>
<h2>Zahtev:</h2>
<?php 
switch ($_GET['ulaz']){
case "xml":
$ulaz = '<?xml version="1.0" encoding="utf-8"?>
<opcije>
<sortiranje>'.$_GET['sort'].'</sortiranje>
</opcije>';
break;
case "json":
$ulaz = '{
"opcije":{
"sortiranje": "'.$_GET['sort'].'"
}
}';
break;
}
?>
<textarea cols="50" rows="10"><?php echo $ulaz;?></textarea>
<h2>Odgovor:</h2>
<?php
//Zameniti URL putanjom serverskog dela REST servisa
$url = 'http://localhost/agencija/controller/server.php';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/'.$_GET['izlaz'], 'Content-Type: application/'.$_GET['ulaz']));
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $ulaz);
$curl_odgovor = curl_exec($curl);
curl_close($curl);
?>
<textarea cols="50" rows="10"><?php echo $curl_odgovor;?></textarea>
<h2>Parsiran odgovor:</h2>
<?php
switch ($_GET['izlaz']){
case "xml":
// ucitavanje SimpleXML objekta
// prvi parametar se odnosi na XML koji se ucitava, drugi parametar prosleduje dodatne opcije, a treci parametar je true ako se XML uzima
// iz URL-a (eksterni XML fajl), a false ukoliko se XML uzima iz string promenljive
$proizvodi = new SimpleXMLElement($curl_odgovor,null,false);
if (property_exists($proizvodi,"greska")){
echo ($proizvodi->greska);
} else {
// ako nema greske, generise se tabela
?>
<table>
<tr>
<td>Id</td>
<td>Naziv</td>
</tr>
<?php
foreach ($proizvodi as $p){
// prolazi se kroz cvorove XML dokumenta i cvorovi se prikazuju u tabeli
?>
<tr>
<td><?php echo $p->id;?></td>
<td><?php echo $p->naziv;?></td>
</tr>
<?php
}
?>
</table>
<?php
}
break;
case "json":
$json_objekat=json_decode($curl_odgovor);
?>
<table>
<tr>
<td>Id</td>
<td>Naziv</td>
</tr>
<?php
foreach($json_objekat->proizvodi as $vrednost){
?>
<tr>
<td><?php echo $vrednost->id;?></td>
<td><?php echo $vrednost->naziv;?></td>
</tr>
<?php
}
?>
</table>
<?php
break;
}
}
?>
        </div>
    </section>
  
  
  

          
          

  <footer>
  
  <div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>
							<span>&copy; Jelena, Aleksa i Ilija </span>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="https://www.facebook.com/oktopodtravel/" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/oktopod_travel?lang=en" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://rs.linkedin.com/in/nenad-vilotic-058534b6" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="https://www.pinterest.com/oktopodtravel/" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="http://www.oktopod.rs/" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
  </footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>  
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<!-- Vendor Scripts -->
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>

<script>wow = new WOW({}).init();</script> 
<script src="js/dt.js"></script>
<script>
  $(document).ready(function(){
    $('#tabela').DataTable();
    });
  </script>

  
</body>
</html>