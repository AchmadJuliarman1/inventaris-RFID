<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
session_unset();
session_destroy();
 ?>

<script>
Swal.fire({
  title: "LogOut!",
  text: "success log out!",
  icon: "success"
});
setTimeout(function (){
	window.location.href = "login.php";
}, 1500);
</script>