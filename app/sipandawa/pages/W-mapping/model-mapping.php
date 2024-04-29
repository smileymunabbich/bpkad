<?php
require_once('../../config/dbProject.php');
$con = new dbProject();

$ACTION = $_POST['action'];

switch($ACTION){
	
	case "selectLevel":
		
		$arrayHasil = $con->selectFrom("w_level");

		echo json_encode($arrayHasil);
		break;
		
	case "selectMenuParent":
	
		$idWhere = array(
			'id_parent' => '0'
		);
		
		$orderBy = array(
			'letak_menu','urutan_menu'
		);
		
		$arrayHasil = $con->selectFrom('w_menu','*',$idWhere,$orderBy);

		echo json_encode($arrayHasil);
		break;
		
	case "selectMenuChild":
		$idParent = $_POST['idParent'];
		
		$idWhere = array(
			'id_parent' => $idParent
		);
		
		$orderBy = array(
			'urutan_menu'
		);
		
		$arrayHasil = $con->selectFrom('w_menu','*',$idWhere,$orderBy);

		echo json_encode($arrayHasil);
		break;
		
	case "cekMapping":
		$idLevel = $_POST['level'];
		$idMenu = $_POST['menu'];
		
		$idWhere = array(
			'id_level' => $idLevel,
			'id_menu' => $idMenu
		);
		
		$arrayHasil = $con->selectFrom('w_mapping','*',$idWhere);
		
		if(empty($arrayHasil)){
			echo json_encode('0');
		}
		else{
			echo json_encode('1');
		}
		break;
		
	case "saveMapping":
		$arrayMapping = $_POST['dataMapping'];
		$idLevel = $_POST['dataLevel'];
		
		$idWhere = array(
			'id_level' => $idLevel
		);
		
		$con->delete('w_mapping',$idWhere);
		foreach($arrayMapping as $mapping){
			$field = array(
				'id_menu' => $mapping['idMenu'],
				'id_level' => $mapping['idLevel']
			);
			$con->insert('w_mapping',$field);
		}
		//$hasil = $con->logQuery();
		if($con->commitQuery()){
			$hasil = "Query Berhasil";
		}
		else{
			$hasil = "Query Gagal";
		}
		echo json_encode($hasil);
		break;
		
	/*
	case "selectMenu":
		
		$arrayHasil = $con->selectFrom("w_menu");

		echo json_encode($arrayHasil);
		break;
		
	case "selectParent":
		
		$subLevel = $_POST['subLevel'];
		$subLevel--;
		
		if($subLevel == '0'){
			$dataBalik = false;
		}
		else{
			$idWhere = array(
				'sub_level' => $subLevel
			);
			
			$dataBalik = $con->selectFrom('w_menu','*',$idWhere);
		}
		echo json_encode($dataBalik);
		break;
		
	case "selectAllMenu":
		
		$dataBalik = $con->selectFrom('w_menu');

		echo json_encode($dataBalik);
		break;
		
	case "commit":
		
		$idMenu = $_POST['idMenu'];
		$subLevel = $_POST['subLevel'];
		$menuParent = $_POST['menuParent'];
		$namaMenu = $_POST['namaMenu'];
		$url = $_POST['url'];
		$icon = $_POST['icon'];
		$letakMenu = $_POST['letakMenu'];
		$urutanMenu = $_POST['urutanMenu'];
		
		$fieldValue = array(
			'id_parent' => $menuParent
			,'sub_level' => $subLevel
			,'nama_menu' => $namaMenu
			,'url' => $url
			,'icon' => $icon
			,'letak_menu' => $letakMenu
			,'urutan_menu' => $urutanMenu
		);
		
		$idWhere = array(
			'id_menu' => $idMenu
		);
		
		if($idMenu == ''){//INSERT
			$con->insert("w_menu",$fieldValue);
		}
		else{//UPDATE
			$con->update("w_menu",$fieldValue,$idWhere);
		}
	
		if($con->commitQuery()){
			$dataBalik = "Query berhasil";
		}
		else{
			$dataBalik = "Query gagal";
		};

		echo json_encode($dataBalik);
		break;
		
	case "selectEdit":
		$id = $_POST['id'];
		
		$idWhere = array(
			'id_menu' => $id
		);
		
		$dataBalik = $con->selectFrom("w_menu","*",$idWhere);
		
		echo json_encode($dataBalik);
		break;
		
	case "delete":
		$id = $_POST['id'];
		
		$idWhere = array(
			'id_menu' => $id
		);
		
		$con->delete("w_menu",$idWhere);
		
		if($con->commitQuery()){
			$dataBalik = "Query berhasil";
		}
		else{
			$dataBalik = "Query gagal";
		};
		echo json_encode($dataBalik);
		break;
		*/

	default:
		break;
}


?>