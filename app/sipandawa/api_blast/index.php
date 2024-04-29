<?php

include 'MODEL__/model.php';
include 'MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_GET['action'];
switch ($ACTION) {
    
    case "get_akun_fb_new":
        $id_akunfb = $_GET['id_akunfb'];
        $idWhere = array(
            'sts_akunfb' => "A"
            , 'id_akunfb' => $id_akunfb
        );
        $response = $model->getData("mst_akunfb", $idWhere);
        echo json_encode($response);
        break;
        
    case "get_akun_fb":
        $id_komputer = $_GET['id_komputer'];
        $browser_akunfb = $_GET['browser_akunfb'];
        $idWhere = array(
            'sts_akunfb' => "A"
            , 'id_komputer' => $id_komputer
            , 'browser_akunfb' => $browser_akunfb
        );
        $response = $model->getData("mst_akunfb", $idWhere);
        echo json_encode($response);
        break;
        
    case "get_target":
        $id_akunfb = $_GET['id_akunfb'];
        
        $query = "SELECT vtd.*
					FROM view_target_detail vtd
					WHERE vtd.id_akunfb='$id_akunfb' AND vtd.sts_target_product='A' AND vtd.sts_target_lokasi='A'
					ORDER BY `id_akunfb` ASC  LIMIT 1";

        $response = $model->getDataQuery($query);
        echo json_encode($response);
        break;
        
    case "update_target_detail":
        date_default_timezone_set("Asia/Jakarta"); 
	    $today = date("Y-m-d");   
        $id_target = $_GET['id_target'];
        $id_target_lokasi = $_GET['id_target_lokasi'];
        $id_target_product = $_GET['id_target_product'];
        
        $fieldValue = array(
            'id_target' => $id_target
            , 'id_target_lokasi' => $id_target_lokasi
            , 'id_target_product' => $id_target_product
            , 'date_target_done' => $today
        );
        
        $response = $model->insertData("target_done", $fieldValue);
        
        echo json_encode($response);
        break;
        
    case "get_img_utama":
        $id_product = $_GET['id_product'];

        $query = "SELECT mg.*
					FROM mst_gambar mg
					WHERE mg.id_product = '$id_product' AND mg.sts_gambar = 'A'
					ORDER BY `id_gambar` ASC  LIMIT 1";

        $response = $model->getDataQuery($query);
        
        // =============================================== UPDATE GAMBAR PROSES "P"
        $id_gambar = $response[0]['id_gambar'];
        $idWhere = array(
        	'id_gambar' => $id_gambar
        );
        $fieldValue = array(
            'sts_gambar' => 'P'
        );
        $model->updateData("mst_gambar", $fieldValue, $idWhere);
        // =============================================== UPDATE GAMBAR PROSES "P" *
        
        echo json_encode($response);
        break;
        
    case "get_img_turunan":
        $id_product = $_GET['id_product'];
        $idWhere = array(
            'id_product' => $id_product
        );
        $response = $model->getData("mst_gambar_product", $idWhere);
        echo json_encode($response);
        break;
        
    case "get_lokasi":
        $idWhere = array(
            'sts_kodepos' => "A"
        );
        $response = $model->getData("mst_kodepos", $idWhere);
        echo json_encode($response);
        break;
        
    case "update_img_utama":
        $id_gambar = $_GET['id_gambar'];
        $sts_gambar = $_GET['sts_gambar'];
        $idWhere = array(
        	'id_gambar' => $id_gambar
        );
        $fieldValue = array(
            'sts_gambar' => $sts_gambar
        );
        $response = $model->updateData("mst_gambar", $fieldValue, $idWhere);
        echo json_encode($response);
        break;
        
    case "update_lokasi":
        $id_kodepos = $_GET['id_kodepos'];
        $sts_kodepos = $_GET['sts_kodepos'];
        $sts_aktif = $_GET['sts_aktif'];
        
    //     // ******************************************************************************
    //     $query_cek = "SELECT kp.*
				// 	FROM mst_kodepos kp
				// 	WHERE kp.id_kodepos = '$id_kodepos'";

    //     $response_cek = $model->getDataQuery($query_cek);
    //     $id_gambar = $response_cek[0]['id_gambar'];
        // ******************************************************************************
        
        
        $idWhere = array(
        	'id_kodepos' => $id_kodepos
        );
        $fieldValue = array(
            'sts_kodepos' => $sts_kodepos
            ,'sts_aktif' => $sts_aktif
        );
        $response = $model->updateData("mst_kodepos", $fieldValue, $idWhere);
        echo json_encode($response);
        break;
        
    case "update_akun_nonaktif":
        $id_akunfb = $_GET['id_akunfb'];
        $sts_akunfb = $_GET['sts_akunfb'];
        $desc_akunfb = $_GET['desc_akunfb'];
        
        $idWhere = array(
        	'id_akunfb' => $id_akunfb
        );
        $fieldValue = array(
            'sts_akunfb' => $sts_akunfb
            , 'desc_akunfb' => $desc_akunfb
        );
        $response = $model->updateData("mst_akunfb", $fieldValue, $idWhere);
        echo json_encode($response);
        break;
        
        
        
        
        
        
        
        
        
        
        
    

    default:
        break;
}

?>
