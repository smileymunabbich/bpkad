
<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$w_user = "w_user";
$w_user_sistem = "w_user_sistem";
$ACTION = $_POST['action'];

switch($ACTION){
		
	case "commit":
		
		$id_user = $_POST['user'];
		$pass = md5($_POST['password2']);
		
        $fieldValue_WUser = array(
			'password' => $pass
		);
		
		$fieldValue_WUserSystem = array(
			'password_sistem' => $pass
		);

		$idWhere = array(
			'id_user' => $id_user
		);
		
		$idWhere_UserSystem = array(
			'id_user_sistem' => $id_user
		);

		$response = $model->updateData($w_user,$fieldValue_WUser,$idWhere);
		$model_sistem->updateData_Sistem($w_user_sistem,$fieldValue_WUserSystem,$idWhere_UserSystem);
		
		echo json_encode($response);
		break;
		

	default:
		break;
}


?>