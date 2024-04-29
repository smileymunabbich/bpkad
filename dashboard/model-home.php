<?php
session_start();
require_once('../config/dbSistem.php');
$con = new dbSistem();

$dataWhere = array(
	"id_user_sistem" => $_POST['username'],
);

$data = $con->selectFrom("view_user_sistem", "*", $dataWhere);

echo json_encode($data);

?>