<?php
//definiše se mime type
header("Content-type: application/xml");
//konekcija ka bazi
include("../model/konekcija.php");
//priprema upita
$sql="SELECT * FROM proizvodi ORDER BY id ASC";
//kreiranje XMLDOM dokumenta
$dom = new DomDocument('1.0','utf-8');

//dodaje se koreni element
 $proizvodi = $dom->appendChild($dom->createElement('proizvodi'));

//izvršavanje upita
if (!$q=$mysqli->query($sql)){
//ako se upit ne izvrši
  //dodaje se element <greska> u korenom elementu <proizvodi>
 $greska = $proizvodi->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Došlo je do greške pri izvršavanju upita"));
} else {
//ako je upit u redu
if ($q->num_rows>0){
//ako ima rezultata u bazi
$niz = array();
while ($red=$q->fetch_object()){
  //dodaje se element <proizvod> u korenom elementu <proizvodi>
 $proizvod = $proizvodi->appendChild($dom->createElement('proizvod'));

 //dodaje  se <id> element u <proizvod>
 $id = $proizvod->appendChild($dom->createElement('id'));
 //dodaje se elementu <id> sadrzaj cvora
 $id->appendChild($dom->createTextNode($red->id));

 //dodaje  se <naziv> element u <proizvod>
 $naziv = $proizvod->appendChild($dom->createElement('naziv'));
 //dodaje se elementu <naziv> sadrzaj cvora
 $naziv->appendChild($dom->createTextNode($red->naziv));
}
} else {
//ako nema rezultata u bazi
  //dodaje se element <greska> u korenom elementu <proizvodi>
 $greska = $proizvodi->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Nema unetih proizvoda"));
}
}
//cuvanje XML-a
$xml_string = $dom->saveXML(); 
echo $xml_string;
//zatvaranje konekcije
$mysqli->close()
?>

