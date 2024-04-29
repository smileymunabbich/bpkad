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
		    	$response = $model->getAllData("mst_honor");
		} else {
		     $idWhere = array(
			    'create_by' => $id_user
		    );
		    $response = $model->getData("mst_honor",$idWhere);
		}
		
		echo json_encode($response);
		break;

	case "commit":
		$id_honor = trim($_POST['id']);
		$id_level = trim($_POST['id_level']);
		$inp_sysdate = trim($_POST['inp_sysdate']);
		
		$sk_honor = trim($_POST['sk_honor']);
		$jabatan_honor = trim($_POST['jabatan_honor']);
		$tgl_honor = trim($_POST['tgl_honor']);
		$nominal_honor = trim($_POST['nominal_honor_']);
		$potongan_honor = trim($_POST['potongan_honor_']);
		$total_honor = trim($_POST['total_honor_']);
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
            'sk_honor' => $sk_honor
            ,'create_by' => $create_by
        );
        $cekData = $model->getData("mst_honor",$idWhere);
        $contData = sizeof($cekData);
        // ================================================================ CEK DATA PEGAWAI
		
		$fieldValue = array(
			'sk_honor' => $sk_honor
			,'jabatan_honor' => $jabatan_honor
			,'tgl_honor' => $tgl_honor
			,'nominal_honor' => $nominal_honor
			,'potongan_honor' => $potongan_honor
			,'total_honor' => $total_honor
			,'create_by' => $id_user
			,'bulan' => $bulan
			,'tahun' => $tahun
		);
		
		$idWhere = array(
			'id_honor' => $id_honor
		);

		if($id_honor == ''){
		    
		    if($contData == 0){
    			$response = $model->insertData("mst_honor",$fieldValue);
    			echo json_encode($response);
		    }else{
		        echo json_encode("NO.SK : $sk_honor Sudah di masukkan. mohon cek kembali..!!");
		    }
			
		}else{
			$response = $model->updateData("mst_honor",$fieldValue,$idWhere);
		    echo json_encode($response);
		}

		
		break;
		
	case "editData":
		$id_honor = $_POST['id_honor'];
		$idWhere = array(
			'id_honor' => $id_honor
		);
		$response = $model->getData("mst_honor",$idWhere);
		echo json_encode($response);
		break;
		
	case "deleteData":
		$id_honor = $_POST['id_honor'];
		$idWhere = array(
			'id_honor' => $id_honor
		);
		$response = $model->deleteData("mst_honor",$idWhere);
		echo json_encode($response);
		break;


	default:
		break;
}

