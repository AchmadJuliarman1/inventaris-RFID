<?php
include_once "../../app/config.php";
include_once "../../class/Database.php";
include_once "../../class/RFID.php";
include_once "../../class/Aset.php";

$db = new Database("localhost", "root", "", "inventaris");
$rfid = new RFID($db);
$no_aset = $rfid->getRFID()[0]['no_aset']; // dari tabel rfid

$aset = new Aset($db);
if($aset->getAsetByKode($no_aset) != null){
	if($aset->getAsetByKode($no_aset)[0]['kode_aset'] == 'INV-'.$no_aset){
		echo 'RFID tersebut sudah tersedia';
		$rfid->hapusRFID();
	}
}else{
	echo $no_aset;
	$rfid->hapusRFID();
}
?>
