<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_POST['action'];
switch ($ACTION) {

    case "dataGaji":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        if ($id_level == 1 || $id_level == 2) {
            $strQuery = "SELECT SUM(jumlah_ditransfer) 
                         AS dataGaji 
                         FROM mst_pegawai";
        } else {
            $strQuery = "SELECT SUM(jumlah_ditransfer) 
                         AS dataGaji 
                         FROM mst_pegawai 
                         WHERE nip= '$id_user' 
                         GROUP BY nip";
        }
        $response = $model->getDataQuery($strQuery);
        echo json_encode($response);
        break;

    case "dataTpp":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        if ($id_level == 1 || $id_level == 2) {
            $strQuery = "SELECT SUM(tpp_diterima) 
                         AS dataTpp 
                         FROM mst_tpp";
        } else {
            $strQuery = "SELECT SUM(tpp_diterima) 
                         AS dataTpp 
                         FROM mst_tpp 
                         WHERE nip= '$id_user' 
                         GROUP BY nip";
        }

        $response = $model->getDataQuery($strQuery);
        echo json_encode($response);
        break;

    case "dataHonor":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        if ($id_level == 1 || $id_level == 2) {
            $strQuery = "SELECT SUM(total_honor) 
                         AS dataHonor 
                         FROM mst_honor";
        } else {
            $strQuery = "SELECT SUM(total_honor) 
                         AS dataHonor 
                         FROM mst_honor 
                         WHERE create_by= '$id_user' 
                         GROUP BY create_by";
        }

        $response = $model->getDataQuery($strQuery);
        echo json_encode($response);
        break;

    case "dataSppd":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        if ($id_level == 1 || $id_level == 2) {
            $strQuery = "SELECT SUM(nominal_sppd) 
                         AS dataSppd 
                         FROM mst_sppd";
        } else {
            $strQuery = "SELECT SUM(nominal_sppd) 
                         AS dataSppd 
                         FROM mst_sppd 
                         WHERE create_by= '$id_user' 
                         GROUP BY create_by";
        }

        $response = $model->getDataQuery($strQuery);
        echo json_encode($response);
        break;

    case "dataLembur":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        if ($id_level == 1 || $id_level == 2) {
            $strQuery = "SELECT SUM(total_lembur) 
                         AS dataLembur 
                         FROM mst_lembur";
        } else {
            $strQuery = "SELECT SUM(total_lembur) 
                         AS dataLembur 
                         FROM mst_lembur 
                         WHERE create_by= '$id_user' 
                         GROUP BY create_by";
        }

        $response = $model->getDataQuery($strQuery);
        echo json_encode($response);
        break;

    case "grafikPendapatan":
          $getData = "SELECT bulan, SUM(total_honor) AS totalHonor
                     FROM mst_honor GROUP BY bulan";

        $response = $model->getDataQuery($getData);
        echo json_encode($response);
        break;    

    default:
        break;
}