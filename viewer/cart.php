<?php
 include("../model/konekcija.php");
 $poruka = '';


    if(isset($_POST['login'])) {
    		require('../controller/user.php');
    		$user = new User($mysqli);
    		$user->login(trim($_POST['username']),trim($_POST['password']));
        if($user->getResult()){
          header('Location: ../viewer/welcome.php');
        }else{
          $poruka="Neuspesno logovanje korisnika. Proverite korisnicko ime i sifru";
        }
     }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Travellapp</title>
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
        <p class="pull-right"><i class="fa fa-phone"></i>+381114144284</p>
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
                    </ul>
                </div>
            </div>
        </div>
	</header>
		
	
	
	<section id="content">
	
	<section id="services" class="section pad-bot5 bg-white">
    <div class="container">
        <div class="row mar-bot5">
          <div class="col-md-12">
            <div class="section-header">
            <div class="wow bounceIn"data-animation-delay="7.8s">

              <h2 class="section-heading animated" > Korpa</h2>
              <h4>Vasi proizvodi</h4>

              <form method="post" action="../controller/updateCart.php">

                  <table class="table">

                          <tr>
                              <th class="text-center">Prozivod</th>
                              <th class="text-center">Kolicina</th>
                              <th class="text-center">Cena</th>
                              <th class="text-center">Ukupno</th>
                          </tr>

        <?php

            $sql="SELECT * FROM proizvodi WHERE id IN (";

                    foreach($_SESSION['cart'] as $id => $value) {
                        $sql.=$id.",";
                    }

                    //select * from proizvodi where id in (1,3,4)

                    $sql=substr($sql, 0, -1).") ORDER BY naziv ASC";
                    $q = mysqli_query($mysqli, $sql);
                    $totalprice=0;
                    while($red = mysqli_fetch_assoc($q)) {
                        $subtotal=$_SESSION['cart'][$red['id']]['kolicina']*$red['cena'];
                        $totalprice+=$subtotal;
                    ?>
                        <tr>
                            <td><?php echo $red['naziv'] ?></td>
                            <td><input type="text" name="kolicina[<?php echo $red['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$red['id']]['kolicina'] ?>" /></td>
                            <td><?php echo $red['cena'] ?>$</td>
                            <td><?php echo $_SESSION['cart'][$red['id']]['kolicina']*$red['cena'] ?>$</td>
                        </tr>
                    <?php

                    }
                    ?>
                    <tr>
                        <td colspan="4">Sve ukupno: <?php echo $totalprice ?>$</td>
                    </tr>

                  </table>
                  <br />
                  <button type="submit" name="submit">Promeni kolicine</button>
                  <br>
                  <br>
                  <a style="text-decoration: none;padding: 3px;background-color: #F0F0F0 ;border: 1px solid #656565;border-radius: 1px !important; color: #656565;" href="../viewer/zavrsiKupovinu.php">Rezervisi putovanje</a>
              </form>
              
            </div>
            </div>
          </div>
        </div>


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
							<span>&copy; Jelena, Aleksa i Ilija </span>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
          <li><a href="https://www.facebook.com/WayoutBeograd/" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.instagram.com/wayout.rs/" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a></li>
						<li><a href="https://www.wayout.rs/" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
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