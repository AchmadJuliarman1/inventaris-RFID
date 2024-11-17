<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/inventaris RFID/class/Database.php'); 

$db = new Database("localhost", "root", "", "tubes_iot");
$url = explode("/", $_GET["url"]);


if(strtolower($url[0]) == "post-rfid"){
	$data = json_decode(file_get_contents('php://input'), true);
	
}else{
	echo 'end-point NOT FOUND';
}
