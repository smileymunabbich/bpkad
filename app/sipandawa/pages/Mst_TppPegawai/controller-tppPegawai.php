<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_POST['action'];
switch ($ACTION) {

    case "listTable":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        if($id_level==1||$id_level==2){
            $response = $model->getAllData("mst_tpp");
        } else {
            $idWhere = array(
                'nip' => $id_user
            );

            $response = $model->getData("mst_tpp",$idWhere);
        }
        
        echo json_encode($response);

    default:
        break;
}