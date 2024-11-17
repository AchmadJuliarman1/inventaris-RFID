<?php
include_once "../../class/Database.php";
$db = new Database("localhost", "root", "", "inventaris");
$sql = "SELECT * FROM rfid";
$result = mysqli_query($db->conn, $sql);
$no_aset = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["no_aset"];

echo $no_aset;
 ?>
