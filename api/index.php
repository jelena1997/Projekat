<?php
require 'flight/Flight.php';
require 'jsonindent.php';


Flight::route('/', function(){

});

Flight::register('db', 'Database', array('niz'));

Flight::route('GET /proizvodi.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->vratiProizvode();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});

Flight::route('GET /kategorije.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->vratiKategorije();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});

Flight::route('GET /proizvodi/@id.json', function($id){
	header ("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->vratiProizvod($id);
	$niz=array();
	while ($red=$db->getResult()->fetch_object()){
		$niz[] = $red;
	}
	$json_niz = json_encode ($niz);
	echo indent($json_niz);

});

Flight::route('GET /porudzbine.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->vratiPorudzbine();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});


Flight::route('POST /noviKorisnik', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->noviKorisnik($json_data);
	if($db->getResult())
	{
		$response = "OK!";
	}
	else
	{
		$response = "ERROR!";

	}

	echo indent(json_encode($response));

});

Flight::start();
?>
