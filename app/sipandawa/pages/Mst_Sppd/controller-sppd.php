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
    
	case "listTable":
	    $id_user = trim($_POST['id_user']);
		$id_level = trim($_POST['id_level']);
		
		if($id_level == 1 || $id_level == 2){
		    $strQuery = "SELECT * FROM mst_sppd";    
		}else{
		    $strQuery = "SELECT * FROM mst_sppd WHERE create_by= '$id_user'";
		}
		
		$response = $model->getDataQuery($strQuery);
		echo json_encode($response);
		break;

	case "commit":
		$id_sppd = trim($_POST['id']);
		$id_level = trim($_POST['id_level']);
		$inp_sysdate = trim($_POST['inp_sysdate']);
		
		$no_sppd = trim($_POST['no_sppd']);
		$keperluan_sppd = trim($_POST['keperluan_sppd']);
		$lokasi_sppd = trim($_POST['lokasi_sppd']);
		$tgl_sppd = trim($_POST['tgl_sppd']);
		$nominal_sppd = trim($_POST['nominal_sppd_']);
		$create_by = trim($_POST['create_by']);
		$bulan = trim($_POST['bulan']);
		$tahun = trim($_POST['tahun']);
		
		if($id_level == 1 || $id_level == 2){
		    $id_user = trim($_POST['create_by']);
		}else{
		    $id_user = trim($_POST['id_user']);
		}
		
		// ================================================================ CEK DATA PEGAWAI
        $idWhere = array(
            'no_sppd' => $no_sppd
            ,'create_by' => $create_by
        );
        $cekData = $model->getData("mst_sppd",$idWhere);
        $contData = sizeof($cekData);
        // ================================================================ CEK DATA PEGAWAI
		
		$fieldValue = array(
		    'no_sppd' => $no_sppd
		    ,'keperluan_sppd' => $keperluan_sppd
			,'lokasi_sppd' => $lokasi_sppd
			,'tgl_sppd' => $tgl_sppd
			,'nominal_sppd' => $nominal_sppd
			,'create_by' => $id_user
			,'bulan' => $bulan
			,'tahun' => $tahun
		);
		
		$idWhere = array(
			'id_sppd' => $id_sppd
		);

		if($id_sppd == ''){

			if($contData == 0){
    			$response = $model->insertData("mst_sppd",$fieldValue);
    			echo json_encode($response);
		    }else{
		        echo json_encode("NO.SK : $no_sppd SUDAH DI INPUT. SULAHKAN CEK KEMBALI .... !!!");
		    }
		    
		}else{
			$response = $model->updateData("mst_sppd",$fieldValue,$idWhere);
			echo json_encode($response);
		}
		
		break;
		
	case "editData":
		$id_sppd = $_POST['id_sppd'];
		$idWhere = array(
			'id_sppd' => $id_sppd
		);
		$response = $model->getData("mst_sppd",$idWhere);
		echo json_encode($response);
		break;
		
	case "deleteData":
		$id_sppd = $_POST['id_sppd'];
		$idWhere = array(
			'id_sppd' => $id_sppd
		);
		$response = $model->deleteData("mst_sppd",$idWhere);
		echo json_encode($response);
		break;


	default:
		break;
}

