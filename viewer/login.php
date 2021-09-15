<?php
include('../model/konekcija.php');
 $poruka = '';


    if(isset($_POST['login'])) {
    		require('../controller/user.php');
    		$user = new User($mysqli);
    		$user->login(trim($_POST['username']),trim($_POST['password']));
        if($user->getResult()){
          header('Location: welcome.php');
        }else{
          $poruka="Neuspešno logovanje korisnika. Proverite korisničko ime i šifru";
        }
     }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Travelapp</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://webthemez.com" />
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
                        <li class="active"><a href="../viewer/index.php">Početna</a></li>
                       
                        <li><a href="../viewer/contact.html">Kontakt</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
		
	
	
	<section id="content">
	
	<section id="services" class="section pad-bot5 bg-white">
		<div class="container">
				<div class="row mar-bot5">
					<div class="col-md-offset-3 col-md-6">
						<div class="section-header">
						<div class="wow bounceIn"data-animation-delay="7.8s">

							<h2 class="section-heading animated" > Login forma</h2>
							<h4><?php if($poruka!='') echo($poruka); ?></h4>


              <form name="login" method="post" action="">

                      <div class="form-group">
                        <label for="username" class="cols-md-2 control-label">Korisničko ime</label>
                          <div class="cols-md-10">
                              <input type="text" class="form-control" name="username" id="username"  placeholder="Korisnicko ime"/>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="password" class="cols-md-2 control-label">Lozinka</label>
                          <div class="cols-md-10">
                              <input id="password" type="password" class="form-control" name="password" id="password"  placeholder="Lozinka"/>
                          </div>
                      </div>
                      <div class="form-group ">
                        <input type="submit" name="login" class="btn btn-info btn-lg " value="Uloguj se">
                      </div>
                    </form>
						</div>
						</div>
					</div>
				</div>


			</div>

		</div>
		</section>
	
	
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
</body>
</html>