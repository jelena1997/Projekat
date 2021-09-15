<!DOCTYPE html>
<html>
<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../viewer/index.php">Početna</a></li>
                        <li class="active"><a href="../viewer/login.php">Ulogujte se</a></li>
                        <li class="active"><a href="../viewer/loginA.php">Admin</a></li>
                        <li class="active"><a href="../viewer/klijent.php">Putovanja</a></li>

                        <li><a href="../viewer/contact.html">Kontakt</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
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
	<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>


<meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
<title>Tipovi pregleda</title>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: green; color: white}

#customers tr:hover {background-color: yellow; color: black}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: black;
  color: white;
}
</style>
</head>
<body>
<?php
//Zameniti URL putanjom serverskog dela REST servisa
$url = 'http://localhost/agencija/controller/server.php';  //klijent prikazuje, a server komunicira sa bazom i izvlaci iz nje. Baza je javni servis, jer se nalazi na netu. Server ide u bazu, cita i prikazuje. 
//privatni servisi su: izvlacenje  nacina placanja iz baze; skidanje PDF sajta
// koji se nalazi na internetu
//privatni jer ulazi u moju bazu i izvlaci nacin placanja 
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
curl_close($curl);
// ucitavanje SimpleXML objekta
// prvi parametar se odnosi na XML koji se ucitava, drugi parametar prosleduje dodatne opcije, a treci parametar je true ako se XML uzima
// iz URL-a (eksterni XML fajl), a false ukoliko se XML uzima iz string promenljive
$pregledi = new SimpleXMLElement($curl_odgovor,null,false);
if (property_exists($pregledi,"greska")){
echo ($pregledi->greska);
} else {
// ako nema greske, generise se tabela
?>
<h2>Tipovi pregleda</h2>
<table id="customers">
<tr>
<td>Id</td>
<td>Naziv</td>
</tr>
<?php
foreach ($pregledi as $p){
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
?>
</body>
</html>
