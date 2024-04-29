<?php

include '../MODEL__/model.php';
$model = new model();

$ACTION = $_POST['action'];

switch ($ACTION) {

	case "selectMenu":

		$response = $model->getAllData("w_menu");
		echo json_encode($response);
		break;

	case "selectParent":

		$subLevel = $_POST['subLevel'];
		$subLevel--;

		if ($subLevel == '0') {
			$response = false;
		} else {
			$idWhere = array(
				'sub_level' => $subLevel
			);

			$response = $model->getData("w_menu", $idWhere);
		}
		echo json_encode($response);
		break;

	case "selectAllMenu":
		$response = $model->getAllData("w_menu");
		echo json_encode($response);
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
			'id_parent' => $menuParent,
			'sub_level' => $subLevel,
			'nama_menu' => $namaMenu,
			'url' => $url,
			'icon' => $icon,
			'letak_menu' => $letakMenu,
			'urutan_menu' => $urutanMenu
		);

		$idWhere = array(
			'id_menu' => $idMenu
		);

		if ($idMenu == '') { //INSERT
			$response = $model->insertData("w_menu", $fieldValue);
		} else { //UPDATE
			$response = $model->updateData("w_menu", $fieldValue, $idWhere);
		}

		echo json_encode($response);
		break;

	case "selectEdit":
		$id = $_POST['id'];

		$idWhere = array(
			'id_menu' => $id
		);
		$response = $model->getData("w_menu", $idWhere);
		echo json_encode($response);
		break;

	case "delete":
		$id = $_POST['id'];

		$idWhere = array(
			'id_menu' => $id
		);
		$response = $model->deleteData("w_menu", $idWhere);
		echo json_encode($response);
		break;

	default:
		break;
}


?>