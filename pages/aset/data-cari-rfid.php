<?php
include_once "../../app/config.php";
include_once "../../class/Database.php";
include_once "../../class/RFID.php";
include_once "../../class/Aset.php";
include_once "../../class/Kategori.php";

$db = new Database("localhost", "root", "", "inventaris");
$rfid = new RFID($db);
$rfid = $rfid->getRFID()[0]["no_aset"];


if($rfid != ''){
	$aset = new Aset($db);

	if(isset($aset->getAsetByKode($rfid)[0])){
		$aset = $aset->getAsetByKode($rfid)[0];
		$kategori = new Kategori($db);
		$kategori = $kategori->cariKategoriByID($aset['id_kategori'])[0]['nama_kategori'];
		$aset[] = $kategori;
		$aset = implode(',', $aset);
		echo $aset;
	}else{
		echo '';
	}

}

 ?>
