<!DOCTYPE HTML>
<html>
<head>
<title>Snow shop</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<!--<script src="js/jquery.easydropdown.js"></script>-->
<!--start slider -->
<link rel="stylesheet" href="css/fwslider.css" media="all">
<script src="js/jquery-ui.min.js"></script>
<script src="js/fwslider.js"></script>
<!--end slider -->
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<a href="index.php"><img src="images/logo.png" alt=""/></a>
					 </div>
					 <div class="menu">
						  <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
						    <ul class="nav" id="nav">
						    	<li><a href="shop.php">Shop</a></li>
						    	<li><a href="admin.php">Admin</a></li>
						    								
								<div class="clear"></div>
							</ul>
							<script type="text/javascript" src="js/responsive-nav.js"></script>
				    </div>							
	    		    <div class="clear"></div>
	    	    </div>
	            
	      </div>
		 </div>
	    </div>
	</div>
	<div class="banner">
	<!-- start slider -->
       <div id="fwslider">
         <div class="slider_container">
            <div class="slide"> 
                <!-- Slide image -->
               <img src="images/slider1.jpg" class="img-responsive" alt=""/>
                <!-- /Slide image -->
                <!-- Texts container -->
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <!-- Text title -->
                        <h1 class="title">Run Over<br>Everything</h1>
                        <!-- /Text title -->
                        <div class="button"><a href="#">See Details</a></div>
                    </div>
                </div>
               <!-- /Texts container -->
            </div>
            <!-- /Duplicate to create more slides -->
            <div class="slide">
               <img src="images/slider2.jpg" class="img-responsive" alt=""/>
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <h1 class="title">Run Over<br>Everything</h1>
                       	<div class="button"><a href="#">See Details</a></div>
                    </div>
                </div>
            </div>
            <!--/slide -->
        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
       </div>
       <!--/slider -->
      </div>
	  <div class="main">
		<div class="content-top">
			<div class="wow bounceIn"data-animation-delay="7.8s">

							<h2 class="section-heading animated" > Products</h2>
              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by name">
              

                    <?php
                      include("../controller/proizvod.php");
                      $proizvod = new Proizvod($mysqli);
                      $proizvod->vratiProizvode();
                      $proizvodiIzBaze = $proizvod->getResult();

                       if(count($proizvodiIzBaze) >0) {

                         ?>
                         <table id="tabela" class="table table-hover">
                           <thead>
                             <th>Product id</th>
                             <th>Name</th>
                             <th>Description</th>
                             <th>Price</th>
                             <th>Category</th>
                             <th>Cart</th>
                           </thead>
                           <tbody>
                         <?php

                         foreach ($proizvodiIzBaze as $red ) {
                              ?>

                              <tr>
                                  <td><?php echo $red['id'] ?></td>
                                  <td><?php echo $red['naziv'] ?></td>
                                  <td><?php echo $red['opis'] ?></td>
                                  <td><?php echo $red['cena'] ?>$</td>
                                  <td><?php echo $red['nazivKategorije'] ?></td>
                                   <td><a class="btn btn-info btn-md" href="../controller/dodajUKorpu.php?id=<?php echo$red['id'] ?>">Add</a></td>
                              </tr>

                              <?php

                       }
                  ?>
                </tbody>
              </table>

              <?php
                  }else{
                     ?>
                     <h1> Empty table </h1>
                    <?php
                  }

                  ?>
						</div>
						</div>
		</div>
	</div>
	
		
				<div class="row footer_bottom">
				    <div class="copy" style="text-align: center;">
			           <p style="text-align: center;">© 2020 Template by FON</p>
		            </div>
					  
   				</div>
			</div>
		</div>
    <script>wow = new WOW({}).init();</script> 
<script src="js/dt.js"></script>
<script>
  $(document).ready(function(){
    $('#tabela').DataTable();
    });
  </script>
  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabela");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>	
</html>