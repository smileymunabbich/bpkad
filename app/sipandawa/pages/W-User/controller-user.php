<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_POST['action'];
switch($ACTION){

	case "checkUsername":
		$id = trim($_POST['id']);
		$idWhere = array(
			'id_user' => $id
		);
		$response = $model->getData("w_user",$idWhere);
		$contArray = sizeof($response);
		
		echo json_encode($contArray);
		break;

    case "selectLevel":
        $id_level = trim($_POST['id_level']);
        
        if($id_level == 1){
            $query = "SELECT * FROM `w_level` WHERE id_level IN (2,3,4,6,7) ORDER BY id_level Asc";
        } else {
            $query = "SELECT * FROM `w_level` WHERE id_level IN (3,4) ORDER BY id_level Asc";
        }
        
        $response = $model->getDataQuery($query);
        echo json_encode($response);
        break;

	case "select":
	    $id_level = trim($_POST['id_level']);
	    $id_user = trim($_POST['id_user']);
        
        if($id_level == 1){
            $query = "SELECT * FROM `view_user` WHERE id_level IN (2,3,4,6,7) ORDER BY id_level Asc";
        } else {
            $query = "SELECT * FROM `view_user` WHERE create_by = '$id_user' AND id_level IN (3,4) ORDER BY id_level Asc";
        }
	    
        $response = $model->getDataQuery($query);
		echo json_encode($response);
		break;
		
	case "commit":
		
		$id = $_POST['id'];
		$useraktif = trim($_POST['id_user']);
		$inp_sysdate = trim($_POST['inp_sysdate']);
        
	    $pass_default = "user123"; 
        $checkPassReset = $_POST['nilai_reset']; // if value 1 password reset, and then if value 0 no reset
        
        // ======================================== w_user
		$id_user = trim($_POST['email_user']);
		$pass = md5($pass_default);
		$nama_user = trim($_POST['nama_user']);
		$id_level = trim($_POST['select_level']);
		
		$idWhere_Check = array(
        	'id_user' => $id_user
        );
        $check = $model->getData("w_user",$idWhere_Check);
        // ======================================== Check id_user END
		
        // ================================================================================  INSERT USER
        $fieldValue_WUser_Add = array( // ==== w_user
			'id_user' => $id_user
			,'password' => $pass
			,'nama_user' => $nama_user
			,'id_level' => $id_level
			,'id_product' => "1"
			,'create_on' => $inp_sysdate
			,'create_by' => $useraktif
		);
		
		$fieldValue_WUserSistem_Add = array( // ==== w_user_sistem
			'id_user_sistem' => $id_user
			,'password_sistem' => $pass
			,'nama_user_sistem' => $nama_user
			,'created_on' => $inp_sysdate
			,'created_by' => $useraktif
		);
		
		$fieldValue_WMappingSistem_Add = array( // ==== w_mapping_sistem
			'id_user_sistem' => $id_user
			,'id_sistem' => "2"
		);
		// ================================================================================  INSERT USER END
		
    	// ================================================================================  UPDATE USER
		$idWhere_WUser = array(
			'id_user' => $id
		);
		$idWhere_WUserSistem = array(
			'id_user_sistem' => $id
		);
		
		// ********************************** Reset Password 
		$fieldValue_WUser_Update_ResetPass = array( // ==== w_user
			'nama_user' => $nama_user
			,'password' => $pass
			,'update_on' => $inp_sysdate
			,'update_by' => $useraktif
		);
		
		$fieldValue_WUserSistem_Update_ResetPass = array( // ==== w_user_sistem
			'nama_user_sistem' => $nama_user
			,'password_sistem' => $pass
			,'updated_on' => $inp_sysdate
			,'updated_by' => $useraktif
		);
		
		// ********************************** Tanpa Reset Password 
		$fieldValue_WUser_Update_TanpaReset = array( // ==== w_user
			'nama_user' => $nama_user
			,'update_on' => $inp_sysdate
			,'update_by' => $useraktif
		);
		$fieldValue_WUserSistem_Update_TanpaReset = array( // ==== w_user_sistem
			'nama_user_sistem' => $nama_user
			,'updated_on' => $inp_sysdate
			,'updated_by' => $useraktif
		);
		// ================================================================================  UPDATE USER END
		
		if($id == ''){
		    if(!empty($check)) { // jika data tidak kosong
		        $response = "Email or Username Suda digunakan / 我用過的電子郵件或用戶名";
		    } else {
		        $response = $model->insertData("w_user",$fieldValue_WUser_Add);
		                    $model_sistem->insertData_Sistem("w_user_sistem",$fieldValue_WUserSistem_Add);
		                    $model_sistem->insertData_Sistem("w_mapping_sistem",$fieldValue_WMappingSistem_Add);
		    }
		} else {
		    if($checkPassReset == 1){ // Reset Password
    	    	$response = $model->updateData("w_user",$fieldValue_WUser_Update_ResetPass,$idWhere_WUser);
    	    	            $model_sistem->updateData_Sistem("w_user_sistem",$fieldValue_WUserSistem_Update_ResetPass,$idWhere_WUserSistem);
    		} else { // Tanpa Reset Password
    	        $response = $model->updateData("w_user",$fieldValue_WUser_Update_TanpaReset,$idWhere_WUser);
    	    	            $model_sistem->updateData_Sistem("w_user_sistem",$fieldValue_WUserSistem_Update_TanpaReset,$idWhere_WUserSistem);
    		}
		}
		
		echo json_encode($response);
		break;
		
	case "selectEdit":
		$id = $_POST['id'];
		$idWhere = array(
			'id_user' => $id
		);
		$response = $model->getData("w_user",$idWhere);
		echo json_encode($response);
		break;
		
	case "delete":
		$id = $_POST['id'];
		$idWhere_WUser = array(
			'id_user' => $id
		);
		$idWhere_WUserSistem = array(
			'id_user_sistem' => $id
		);
		
		$response = $model->deleteData("w_user",$idWhere_WUser);
		            $model_sistem->deleteData_Sistem("w_user_sistem",$idWhere_WUserSistem);
		            $model_sistem->deleteData_Sistem("w_mapping_sistem",$idWhere_WUserSistem);
		            
		echo json_encode($response);
		break;
	
// 	//============================================================== SELECT
    
//     case "selectStartup":
// 		$id_level = $_POST['id_level'];
// 		$id_user = $_POST['id_user'];
// 		if($id_level == 1){
// 			$response = $model->getAllData($startup);
// 		}
// 		echo json_encode($response);
// 		break;

	default:
		break;
}


?>