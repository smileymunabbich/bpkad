<?php
session_start();
require_once('../config/dbSistem.php');
$con = new dbSistem();

$pass = md5($_POST['password']);

$query = "SELECT * FROM view_user_sistem WHERE id_user_sistem='$_POST[username]' AND password_sistem='$pass'";
$data = $con->execQuery($query);
$status = false;
if(empty($data)){
	$status = false;
	echo json_encode($status);
}
else{
	$status = true;
	
	$_SESSION['id_user'] = $data[0]['id_user_sistem'];
	$_SESSION['password'] = $data[0]['password_sistem'];
	$_SESSION['nama_user'] = $data[0]['nama_user_sistem'];
	$_SESSION['singkatan'] = $data[0]['singkatan'];
	
	date_default_timezone_set("Asia/Jakarta"); 
	$today = date("Y-m-d H:i:s");   
	
	$field = array(
		'last_login' => $today,
	);
	
	$idWhere = array(
		'id_user' => $_SESSION['id_user'],
	);

	$con->update('w_user',$field,$idWhere);
	$con->commitQuery();
	

	echo json_encode($data);
}


?>