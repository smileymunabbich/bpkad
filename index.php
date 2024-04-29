<?php 
session_start();

if(isset($_GET['page'])){
	$page = $_GET['page'];
	
	$_USER = $_SESSION['id_user'];
	$_PASSWORD = $_SESSION['password'];
	$_NAMA_USER = $_SESSION['nama_user'];
}
else{
	$page = "login";
}

switch($page){
	
	case "login":
		include "login/view-login.php";
		break;
		
	case "dashboard":
		include "dashboard/view-home.php";
		break;
		
	default:
		break;
	
}

?>