<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_POST['action'];
switch($ACTION){
    
    case "listPegawai":
	    $id_user = trim($_POST['id_user']);
		$id_level = trim($_POST['id_level']);
		
		if($id_level == 1 || $id_level == 2){
		    $strQuery = "SELECT * FROM mst_pegawai GROUP BY nip";    
		}else{
		    $strQuery = "SELECT * FROM mst_pegawai WHERE nip= '$id_user' GROUP BY nip";
		}
	    
		
        $response = $model->getDataQuery($strQuery);
		echo json_encode($response);
		break;


	default:
		break;
}

