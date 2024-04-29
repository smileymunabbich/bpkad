<?php

include 'MODEL__/model.php';
include 'MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_GET['action'];
switch($ACTION){
    
    // ====================================================== API LOGIN
		case "login":
    	    $email_usaha = $_POST['email_usaha'];
    	    $password = $_POST['password'];
    	    $idWhere = array(
            	'id_user' => $email_usaha
            	,'password' => $password
            );
            $check = $model->getData("view_user",$idWhere);
            
           if(!empty($check)){ // jika data tidak kosong
                $response["value"] = 1;
                $response["message"] = "Login Ada";
                $response["resultUserLogin"] = $check;
                echo json_encode($response);
           } else {
                $response["value"] = 0;
                $response["message"] = "oops! Coba lagi!";
                $response["resultUserLogin"] = $check;
                echo json_encode($response);
           }
		break;
	// ====================================================== API LOGIN END
	
	
	// ** Insert User
	case "insertuser":
	    
		$id_user = trim($_POST['id_user']);
		$pass = md5($_POST['pass']);
		$nama_user = $_POST['nama'];
	    $level = $_POST['level'];
	    $id_product = trim($_POST['id_product']);
		$baseUrl = $_POST['baseurl'];
		
		$idWhere = array(
        	'id_user' => $id_user
        );
        $check = $model->getData("w_user",$idWhere);
        // ** Cek User
        
		$fieldValue_WUser = array(
			'id_user' => $id_user
			,'id_level' => $level
			,'id_product' => $id_product
			,'nama_user' => $nama_user
			,'base_url' => $baseUrl
			,'password' => $pass
		);
		
		$fieldValue_WUserSystem = array(
			'id_user_sistem' => $id_user
			,'password_sistem' => $pass
			,'nama_user_sistem' => $nama_user
		);
		
		$fieldValue_WMappingSystem = array(
			'id_user_sistem' => $id_user
			,'id_sistem' => "2"
		);
		
		if(empty($check)){ // kosong
    		$proses = $model->insertData("w_user",$fieldValue_WUser);
    // 		$proses = $model_sistem->insertData_Sistem("w_user_sistem",$fieldValue_WUserSystem);
    // 		$proses = $model_sistem->insertData_Sistem("w_mapping_sistem",$fieldValue_WMappingSystem);
    		$response["value"] = 1;
            $response["message"] = "Sukses mendaftar";
            echo json_encode($response);
		} else {
            $response["value"] = 0;
            $response["message"] = "oops! Coba lagi!";
            echo json_encode($response);
		}
		
	    break;
	    
	// ** Update User
	case "updateuser":
	    
		$id_user = trim($_POST['id_user']);
		$pass = md5("spg123");
		$nama_user = $_POST['nama'];
		$checkPassReset = $_POST['checkPassReset'];
		
		$idWhere_WUser = array(
        	'id_user' => $id_user
        );
        
        $idWhere_WUserSystem = array(
        	'id_user_sistem' => $id_user
        );
		
		// ********************************** Reset Password
		$fieldValue_WUser_ResetPass = array(
			'nama_user' => $nama_user
			,'password' => $pass
		);
		
		$fieldValue_WUserSystem_ResetPass = array(
			'password_sistem' => $pass
			,'nama_user_sistem' => $nama_user
		);
		
		// ********************************** Tanpa Reset Password
		$fieldValue_WUser = array(
			'nama_user' => $nama_user
		);
		
		$fieldValue_WUserSystem = array(
			'nama_user_sistem' => $nama_user
		);

		
		if($checkPassReset == 1){ // Reset Password
	    	$proses = $model->updateData("w_user",$fieldValue_WUser_ResetPass,$idWhere_WUser);
	   // 	$proses = $model_sistem->updateData_Sistem("w_user_sistem",$fieldValue_WUserSystem_ResetPass,$idWhere_WUserSystem);
    		$response["value"] = 1;
            $response["message"] = "Update Success";
            echo json_encode($response);
		} else { // Tanpa Reset Password
	        $proses = $model->updateData("w_user",$fieldValue_WUser,$idWhere_WUser);
	   // 	$proses = $model_sistem->updateData_Sistem("w_user_sistem",$fieldValue_WUserSystem,$idWhere_WUserSystem);
            $response["value"] = 1;
            $response["message"] = "Update Success";
            echo json_encode($response);
		}
		
	    break;
	    
	// ** Delete User  
	case "deleteuser":
		$id_user = trim($_POST['id_user']);
		$idWhere_WUser = array(
        	'id_user' => $id_user
        );
        
        $idWhere_WUserSystem = array(
        	'id_user_sistem' => $id_user
        );
        
		$proses = $model->deleteData("w_user",$idWhere_WUser);
// 		$proses = $model_sistem->deleteData_Sistem("w_user_sistem",$idWhere_WUserSystem);
// 		$proses = $model_sistem->deleteData_Sistem("w_mapping_sistem",$idWhere_WUserSystem);
		
		$response["value"] = 1;
        $response["message"] = "Delete Success";
        echo json_encode($response);
        
		break;


    // ** List User
	case "listuser":
	    $id_product = trim($_POST['id_product']);
	       $id_level = $_POST['id_level'];
	       $idWhere = array(
                'id_level' => $id_level
                ,'id_product' => $id_product
           );
           $response = $model->getData("view_user",$idWhere);
           echo json_encode(array("value"=>1,"resultListUser"=>$response));
		break;
		


	// ** List Location
	case "listlocation":
	       $id_product = trim($_POST['id_product']);
	       $sts_loc = $_POST['sts_loc'];
	       $idWhere = array(
	           'id_product' => $id_product
                ,'sts_loc' => $sts_loc
           );
           $response = $model->getData("mst_location",$idWhere);
           echo json_encode(array("value"=>1,"resultListLocation"=>$response));
           
		break;
		
	// ** Insert Location
	case "insertlocation":
	    
		$id_product = trim($_POST['id_product']);
		$loc_nm = trim($_POST['loc_nm']);
		$loc_lat = trim($_POST['loc_lat']);
		$loc_lng = trim($_POST['loc_lng']);
        
		$fieldValue = array(
			'id_product' => $id_product
			,'loc_nm' => $loc_nm
			,'loc_lat' => $loc_lat
			,'loc_lng' => $loc_lng
		);
		
		$proses = $model->insertData("mst_location",$fieldValue);
		$response["value"] = 1;
        $response["message"] = "Sukses mendaftar";
        echo json_encode($response);
		
	    break;
	    
	// ** Update Location
	case "updatelocation":
	    
		$id_loc = trim($_POST['id_loc']);
		$id_product = trim($_POST['id_product']);
		$loc_nm = trim($_POST['loc_nm']);
		$loc_lat = trim($_POST['loc_lat']);
		$loc_lng = trim($_POST['loc_lng']);
		
		$idWhere = array(
            'id_loc' => $id_loc
        );
        
		$fieldValue = array(
			'id_product' => $id_product
			,'loc_nm' => $loc_nm
			,'loc_lat' => $loc_lat
			,'loc_lng' => $loc_lng
		);
		
		$proses = $model->updateData("mst_location",$fieldValue,$idWhere);
		$response["value"] = 1;
        $response["message"] = "Update Success";
        echo json_encode($response);
		
	    break;
	    
    // ** Delete Location  
	case "deletelocation":
		$id_loc = trim($_POST['id_loc']);
		$idWhere = array(
            'id_loc' => $id_loc
        );
		$proses = $model->deleteData("mst_location",$idWhere);
		$response["value"] = 1;
        $response["message"] = "Delete Success";
        echo json_encode($response);
        
    
    // ** Insert Detail Location
	case "insertdetaillocation":
	    
	    $id_loc = trim($_POST['id_loc']);
		$tgl_detail_loc = trim($_POST['tgl_detail_loc']);
		$start_detail_loc = trim($_POST['start_detail_loc']);
		$end_detail_loc = trim($_POST['end_detail_loc']);
        
		$fieldValue = array(
			'id_loc' => $id_loc
			,'tgl_detail_loc' => $tgl_detail_loc
			,'start_detail_loc' => $start_detail_loc
			,'end_detail_loc' => $end_detail_loc
		);
		
		$proses = $model->insertData("detail_location",$fieldValue);
		$response["value"] = 1;
        $response["message"] = "Sukses mendaftar";
        echo json_encode($response);
		
	    break;
	    
    // ** Update Detail Location
	case "updatedetaillocation":
	    
	    $id_detail_loc = trim($_POST['id_detail_loc']);
	    $id_loc = trim($_POST['id_loc']);
		$tgl_detail_loc = trim($_POST['tgl_detail_loc']);
		$start_detail_loc = trim($_POST['start_detail_loc']);
		$end_detail_loc = trim($_POST['end_detail_loc']);
		
		$idWhere = array(
            'id_detail_loc' => $id_detail_loc
        );
        
		$fieldValue = array(
			'id_loc' => $id_loc
			,'tgl_detail_loc' => $tgl_detail_loc
			,'start_detail_loc' => $start_detail_loc
			,'end_detail_loc' => $end_detail_loc
		);
		
		$proses = $model->updateData("detail_location",$fieldValue,$idWhere);
		$response["value"] = 1;
        $response["message"] = "Sukses mendaftar";
        echo json_encode($response);
		
	    break;
	    
	// ** Insert Detail Location
	case "deletedetaillocation":
	    
	    $id_detail_loc = trim($_POST['id_detail_loc']);
		
		$idWhere = array(
            'id_detail_loc' => $id_detail_loc
        );
		
		$proses = $model->deleteData("detail_location",$idWhere);
		$response["value"] = 1;
        $response["message"] = "Sukses menghapus";
        echo json_encode($response);
		
	    break;
        
    // ** List Detail Location
	case "listdetaillocation":
        
        date_default_timezone_set("Asia/Jakarta"); 
        $date = date("Y-m-d");   
        $time = date("H:i:s");
        
        $idProduct = $_POST['id_product'];
        
        $idWhere = array(
            'tgl_detail_loc' => $date
            ,'id_product' => $idProduct
        );
        
        $orderby = array(
			'start_detail_loc asc'	
		);
        
        $response = $model->getDataOrderBy("view_detail_location",$idWhere,$orderby);
        
        echo json_encode(array("value"=>1,"resultListDetailLocation"=>$response));
           
		break;
		
	// ** List Detail Location All
	case "listdetaillocationall":
        
        $date = $_POST['tgl_detail_loc'];
        $idProduct = $_POST['id_product'];
        
        $idWhere = array(
            'tgl_detail_loc' => $date
            ,'id_product' => $idProduct
        );
        
        $proses = $model->getData("view_detail_location",$idWhere);
        
        if(!empty($proses)){ // jika data tidak kosong
            $response["value"] = 1;
            $response["message"] = "Login Ada";
            $response["resultListDetailLocationAll"] = $proses;
            echo json_encode($response);
        } else {
            $response["value"] = 0;
            $response["message"] = "oops! Coba lagi!";
            $response["resultListDetailLocationAll"] = $proses;
            echo json_encode($response);
        }
        
		break;
		

	    
	// ** Check Loc Notif
	case "checknotifdetailloc":
	    
        date_default_timezone_set("Asia/Jakarta"); 
        $date = date("Y-m-d");   
        $time = date("H:i:s");
        
        $idProduct = $_POST['id_product'];
        $notif = $_POST['loc_notif'];
        
        $idWhere = array(
            'id_product ' => $idProduct
            ,'tgl_detail_loc' => $date
            ,'notif_detai_loc' => $notif
        );
        $checkLocNotif = $model->getData("view_detail_location",$idWhere);
        
        if(empty($checkLocNotif)){ // kosong
        	$response["value"] = 0;
            $response["message"] = "Pilih Salah Satu Location";
            $response["resultCheckNotifDetailLoc"] = $checkLocNotif;
            echo json_encode($response);
        } else {
            $response["value"] = 1;
            $response["message"] = "Location Aktif";
            $response["resultCheckNotifDetailLoc"] = $checkLocNotif;
            echo json_encode($response);
        }
           
		break;
		
		
	// ** Update Loc Notif
	case "updatenotifdetailloc":
	    
		$id_loc= trim($_POST['idDetailloc']);
		$loc_notif = trim($_POST['loc_notif']);
		
		$fieldValue_Off = array(
		    'notif_detai_loc' => "false"
		);
		
		$fieldValue_True = array(
		    'notif_detai_loc' => "true"
		);
		
		$idWhere = array(
			'id_detail_loc ' => $id_loc
		);
		
		$idWhere_True = array(
			'notif_detai_loc' => "true"
		);
		
	    if($loc_notif == "true"){
	        $proses = $model->updateData("detail_location",$fieldValue_Off,$idWhere);
	        $response["value"] = 1;
            $response["message"] = "Sukses mendaftar";
            echo json_encode($response);
	    } else {
	        $proses = $model->updateData("detail_location",$fieldValue_Off,$idWhere_True);
	        $proses = $model->updateData("detail_location",$fieldValue_True,$idWhere);
	        $response["value"] = 1;
            $response["message"] = "Sukses mendaftar";
            echo json_encode($response);
	    }
		
	    break;	
		
		
	// ** Insert Customer
	case "insertcustomer":
	     
	    date_default_timezone_set("Asia/Jakarta"); 
        $today = date("Y-m-d H:i:s");   
	    
        $IdUserSistem = trim($_POST['IdUserSistem']);
        
        $IdDetailLoc = trim($_POST['IdDetailLoc']);
        $LocNm = trim($_POST['LocNm']);
        $StartTime = trim($_POST['StartTime']);
        $EndTime = trim($_POST['EndTime']);
        
        $IdCus = trim($_POST['IdCus']);
        $NamaCus = trim($_POST['NamaCus']);
        $Age = trim($_POST['Age']);
        $Gender = trim($_POST['Gender']);
        $AlamatCus = trim($_POST['AlamatCus']);
        $PekerjaanCus = trim($_POST['PekerjaanCus']);
        $TlpnCus = trim($_POST['TlpnCus']);
        $EmailCus = trim($_POST['EmailCus']);
        $LatCus = trim($_POST['LatCus']);
        $LngCus = trim($_POST['LngCus']);
        $Remark1 = trim($_POST['Remark1']);
        $Remark2 = trim($_POST['Remark2']);
        $Remark3 = trim($_POST['Remark3']);
        $Remark4 = trim($_POST['Remark4']);
        
        $fieldValue = array(
			'id_user' => $IdUserSistem
			,'id_detail_loc' => $IdDetailLoc
			,'nm_cus' => $NamaCus
			,'age_cus' => $Age
			,'gender_cus' => $Gender
			,'address_cus' => $AlamatCus
			,'job_cus' => $PekerjaanCus
			,'phone_cus' => $TlpnCus
			,'email_cus' => $EmailCus
			,'lat_cus' => $LatCus
			,'lng_cus' => $LngCus
			,'remark1' => $Remark1
			,'remark2' => $Remark2
			,'remark3' => $Remark3
			,'remark4' => $Remark4
			,'inputdate' => $today
		);
		
		$proses = $model->insertData("mst_customer",$fieldValue);
        $response["value"] = 1;
        $response["message"] = "Sukses mendaftar ";
        echo json_encode($response);
        
	break;
	
	// ** Chcek Id Customer
	case "checkidcustomer":
	    
        $IdUserSistem = trim($_POST['IdUserSistem']);
        $IdDetailLoc = trim($_POST['IdDetailLoc']);
        
        $NamaCus = trim($_POST['NamaCus']);
        $Age = trim($_POST['Age']);
        $Gender = trim($_POST['Gender']);
        $AlamatCus = trim($_POST['AlamatCus']);
        $PekerjaanCus = trim($_POST['PekerjaanCus']);
        $TlpnCus = trim($_POST['TlpnCus']);
        $EmailCus = trim($_POST['EmailCus']);
        
        $idWhere = array(
			'id_user' => $IdUserSistem
			,'id_detail_loc' => $IdDetailLoc
			,'nm_cus' => $NamaCus
			,'age_cus' => $Age
			,'gender_cus' => $Gender
			,'address_cus' => $AlamatCus
			,'job_cus' => $PekerjaanCus
			,'phone_cus' => $TlpnCus
			,'email_cus' => $EmailCus
		);
		
		
		$check = $model->getData("mst_customer",$idWhere);
            
       if(!empty($check)){ // jika data tidak kosong
            $response["value"] = 1;
            $response["message"] = "ID Ada";
            $response["resultCheckIdCustomer"] = $check;
            echo json_encode($response);
       } else {
            $response["value"] = 0;
            $response["message"] = "oops! Coba lagi!";
            $response["resultCheckIdCustomer"] = $check;
            echo json_encode($response);
       }
        
	break;
	
	
	// ** Insert Quis Customer
	case "insertquiscustomer":
	     
        $IdCus = trim($_POST['IdCus']);
        $IdPertanyaan = trim($_POST['IdPertanyaan']);
        $IdJawaban = trim($_POST['IdJawaban']);
        $Jawaban = trim($_POST['Jawaban']);
        
        $fieldValue = array(
			'id_cus' => $IdCus
			,'id_pertanyaan' => $IdPertanyaan
			,'id_jawaban' => $IdJawaban
			,'jawaban' => $Jawaban
		);
		
		$proses = $model->insertData("detail_quis_customer",$fieldValue);
        $response["value"] = 1;
        $response["message"] = "Sukses mendaftar ";
        echo json_encode($response);
        
	break;
	
	
	// ** List Performa per SPG
	case "listperformaspg":
        
        $id_user = $_POST['id_user'];
        $date = $_POST['tgl_detail_loc'];
        
        $idWhere = array(
            'id_user' => $id_user
            ,'tgl_detail_loc' => $date
        );
        
        $proses = $model->getData("view_daily_perform",$idWhere);
        
        if(!empty($proses)){ // jika data tidak kosong
            $response["value"] = 1;
            $response["message"] = "Data ada";
            $response["resultListPerformaSpg"] = $proses;
            echo json_encode($response);
        } else {
            $response["value"] = 0;
            $response["message"] = "oops! Data Kosong";
            $response["resultListPerformaSpg"] = $proses;
            echo json_encode($response);
        }
        
		break;
		
		
	// ** List Master Pertanyaan
	case "listpertanyaan":
        
        $idProduct = $_POST['id_product'];
        
        $idWhere = array(
            'id_product' => $idProduct
            ,'sts_pertanyaan' => "A"
        );
        
        $proses = $model->getData("mst_pertanyaan",$idWhere);
        
        if(!empty($proses)){ // jika data tidak kosong
            $response["value"] = 1;
            $response["message"] = "Data Ada";
            $response["resultListPertanyaan"] = $proses;
            echo json_encode($response);
        } else {
            $response["value"] = 0;
            $response["message"] = "oops! Coba lagi!";
            $response["resultListPertanyaan"] = $proses;
            echo json_encode($response);
        }
        
		break;
		
	// ** List Master Pertanyaan Body
	case "listpertanyaanbody":
        
        $idProduct = $_GET['id_product'];
        
        $idWhere = array(
            'id_product' => $idProduct
            ,'sts_pertanyaan' => "A"
        );
        
        $proses = $model->getData("mst_pertanyaan",$idWhere);
        
        if(!empty($proses)){ // jika data tidak kosong
            echo json_encode($proses);
        } else {
            echo json_encode($proses);
        }
        
		break;
		
	// ** List Master Jawaban Body
	case "listjawabanbody":
        
        $idProduct = $_GET['id_product'];
        
        $idWhere = array(
            'id_product' => $idProduct
            ,'sts_jawaban' => "A"
        );
        
        $orderby = array(
			'jenis_jawaban desc'	
		);
        
        $proses = $model->getDataOrderBy("view_jawaban",$idWhere,$orderby);
        
        if(!empty($proses)){ // jika data tidak kosong
            echo json_encode($proses);
        } else {
            echo json_encode($proses);
        }
        
		break;
	
        
	    
	    
}
	
?>