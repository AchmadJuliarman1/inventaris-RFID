<?php
include_once "../../class/Database.php";
include_once "../../class/RFID.php";
$db = new Database("localhost", "root", "", "inventaris");
$rfid = new RFID($db);
$no_aset = $rfid->getRFID()[0]["no_aset"];

echo $no_aset;
 ?>
