<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/inventaris RFID/class/Database.php'); 
require_once($_SERVER['DOCUMENT_ROOT'].'/inventaris RFID/class/RFID.php'); 

$db = new Database("localhost", "root", "", "inventaris");
$url = explode("/", $_GET["url"]);
$rfid = new RFID($db);

if(strtolower($url[0]) == "post-rfid"){
	$data = json_decode(file_get_contents('php://input'), true);
	$rfid->inputRFID($data['no-aset']);
}else{
	echo 'end-point NOT FOUND';
}
