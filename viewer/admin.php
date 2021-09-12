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
   $sql2 = "SELECT p.id,p.naziv, p.opis,p.cena,p.kategorijaID,k.nazivKategorije FROM proizvodi p join kategorija k on p.kategorijaID=k.kategorijaID";
  $result2 = $mysqli->query($sql2);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
#myTable {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#myTable td, #myTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#myTable tr:nth-child(even){background-color: #f2f2f2;}

#myTable tr:hover {background-color: #ddd;}

#myTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<meta charset="utf-8">
<title>Oktopod</title>
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
                    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Početna</a></li>
                        <li class="active"><a href="logout.php">Izlogujte se</a></li>
                        <li><a href="service.php">Privatni servis</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
		
	
	
	<section id="content">
	
	<section id="services" class="section pad-bot5 bg-white">
    <div class="container">
        <div class="row mar-bot5">
          <div class=" col-md-12">
            <div class="section-header">
            <div >

             
             
              <h4><?php if($poruka!='') echo($poruka); ?></h4>

            <h2>Putovanja</h2>
            
            <table id="myTable">
              <thead>
              <tr>
              <th><strong>Br.</strong></th>
              <th><strong>Naziv</strong></th> 
              <th><strong>Opis</strong></th>
              <th><strong>Cena</strong></th>
              <th><strong>Kategorija</strong></th>
             
              <th><strong>Obrisi</strong></th>
              </tr>
              </thead>
              <tbody>
              <?php
              $count=1;
              
              while($row2 = mysqli_fetch_assoc($result2)) { ?>
              <tr><td><?php echo $count; ?></td>
              
              <td ><?php echo $row2["naziv"]; ?></td>
              <td ><?php echo $row2["opis"]; ?></td>
              <td ><?php echo $row2["cena"]; ?></td>
             
              <td ><?php echo $row2["nazivKategorije"]; ?></td>
              
              <td>
              <a href="delete.php?id=<?php echo $row2["id"]; ?>">Obriši</a>
             
              </td>
              </tr>
              <?php $count++; } ?>
              </tbody>
              </table>

                  


            </div>
            </div>
          </div>
        </div>

        <div id="tabelaSearch" > </div>
        <h1> Novo putovanje</h1>
        <form name="formaProizvod" method="post" action="">

                <div class="form-group">
                  <label for="naziv" class="cols-md-2 control-label">Naziv</label>
                    <div class="cols-md-10">
                        <input type="text" class="form-control" name="naziv" id="naziv"  placeholder="Naziv prozivoda"/>
                    </div>
                </div>

                <div class="form-group">
                  <label for="username" class="cols-md-2 control-label">Opis</label>
                    <div class="cols-md-10">
                        <textarea cols="50" rows="11"  class="form-control" name="opis" id="opis"  placeholder="Opis"></textarea>
                    </div>
                </div>

                <div class="form-group">
                  <label for="cena" class="cols-md-2 control-label">Cena</label>
                    <div class="cols-md-10">
                        <input id="cena" type="number" class="form-control" name="cena" id="cena"  placeholder="Cena"/>
                    </div>
                </div>
                <div class="form-group ">
                  <label for="kategorija" class="cols-md-2 control-label">Kategorija</label>
                    <div class="cols-md-10">
                <?php
                  $proizvod = new Proizvod($mysqli);
                  $proizvod->vratiKategorije();
                  $kategorije = $proizvod->getResult();
                   if(count($kategorije) >0) {

                     ?>
                     <select class="form-control" id="kategorija" name="kategorija">

                     <?php

                     foreach ($kategorije as $red ) {
                          ?>
                          <option value="<?php echo $red['kategorijaID'] ?>"><?php echo $red['nazivKategorije'] ?></option>

                          <?php

                   }
                 }

                   ?>
                 </select>
               </div>
              </div>
                <div class="form-group ">
                  <input type="submit" name="noviProizvod" class="btn btn-info btn-lg " value="Novo putovanje">
                </div>
              </form>

            
                


              <h1> Izmena cene putovanja</h1>
              <form name="formaIzmena" method="post" action="">

                <?php
                  //include("proizvod.php");
                  $proizvod = new Proizvod($mysqli);
                  $proizvod->vratiProizvode();
                  $proizvodiIzBaze = $proizvod->getResult();

                   if(count($proizvodiIzBaze) >0) {

                     ?>
                     <select class="form-control" id="izmenasel" name="izmenaProizvod">

                     <?php

                     foreach ($proizvodiIzBaze as $red ) {
                          ?>
                          <option value="<?php echo $red['id'] ?>" > <?php echo $red['naziv'] ?></option>
                          <?php

                   }
              ?>
                </select>

          <?php
              }

              ?>

                <div class="form-group">
                  <label for="cenaizmena" class="cols-md-2 control-label">Cena</label>
                    <div class="cols-md-10">
                        <input id="cenaizmena" type="number" class="form-control" name="cenaizmena" id="cenaizmena"  placeholder="Cena"/>
                    </div>
                </div>

                <div class="form-group ">
                  <input type="submit" name="izmena" class="btn btn-info btn-lg " value="Izmeni cenu putovanja">
                </div>
              </form>



      </div>

    </div>
    </section>
	
	
	

					
					

	<footer>
	
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>
							<span>&copy; FON </span>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
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