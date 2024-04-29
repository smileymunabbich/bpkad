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
		
		if($id_level==1 ||$id_level==2 ){
		    	$response = $model->getAllData("mst_lembur");
		} else {
		     $idWhere = array(
			    'create_by' => $id_user
		    );
		    $response = $model->getData("mst_lembur",$idWhere);
		}
		
		echo json_encode($response);
		break;

	case "commit":
		$id_lembur = trim($_POST['id']);
		$id_level = trim($_POST['id_level']);
		$inp_sysdate = trim($_POST['inp_sysdate']);
		
		$sk_lembur = trim($_POST['sk_lembur']);
		$kegiatan_lembur = trim($_POST['kegiatan_lembur']);
		$tgl_lembur = trim($_POST['tgl_lembur']);
		$jam_lembur = trim($_POST['jam_lembur']);
		$nominal_lembur = trim($_POST['nominal_lembur_']);
		$potongan_lembur = trim($_POST['potongan_lembur_']);
		$total_lembur = trim($_POST['total_lembur_']);
		$create_by = trim($_POST['create_by']);
		$bulan = trim($_POST['bulan']);
		$tahun = trim($_POST['tahun']);
		
		if($id_level == 1 || $id_level == 2){
		    $id_user = trim($_POST['create_by']);
		}else{
		    $id_user = trim($_POST['id_user']);
		}
		
		$fieldValue = array(
		    'sk_lembur' => $sk_lembur
			,'kegiatan_lembur' => $kegiatan_lembur
			,'tgl_lembur' => $tgl_lembur
			,'jam_lembur' => $jam_lembur
			,'nominal_lembur' => $nominal_lembur
			,'potongan_lembur' => $potongan_lembur
			,'total_lembur' => $total_lembur
			,'create_by' => $id_user
			,'bulan' => $bulan
			,'tahun' => $tahun
		);
		
		if($id_level == 1 || $id_level == 2){
		    $id_user = trim($_POST['create_by']);
		}else{
		    $id_user = trim($_POST['id_user']);
		}
		
        // ================================================================ CEK DATA PEGAWAI
        $idWhere = array(
            'sk_lembur' => $sk_lembur
            ,'create_by' => $create_by
        );
        $cekData = $model->getData("mst_lembur",$idWhere);
        $contData = sizeof($cekData);
        // ================================================================ CEK DATA PEGAWAI
        
		$idWhere = array(
			'id_lembur' => $id_lembur
		);

		if($id_lembur == ''){
		    
		    if($contData == 0){
    			$response = $model->insertData("mst_lembur",$fieldValue);
    			echo json_encode($response);
		    }else{
		        echo json_encode("NO.SPT : $sk_lembur SUDAH DI INPUT. SULAHKAN CEK KEMBALI .... !!!");
		    }
			
		}else{
			$response = $model->updateData("mst_lembur",$fieldValue,$idWhere);
		    echo json_encode($response);
		}

		
		break;
		
	case "editData":
		$id_lembur = $_POST['id_lembur'];
		$idWhere = array(
			'id_lembur' => $id_lembur
		);
		$response = $model->getData("mst_lembur",$idWhere);
		echo json_encode($response);
		break;
		
	case "deleteData":
		$id_lembur = $_POST['id_lembur'];
		$idWhere = array(
			'id_lembur' => $id_lembur
		);
		$response = $model->deleteData("mst_lembur",$idWhere);
		echo json_encode($response);
		break;


	default:
		break;
}

