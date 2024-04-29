<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/Mst_TppPegawai/view-tppPegawai.php";
		break;
		
	//ADMIN
	case "2":
		include "../pages/Mst_TppPegawai/view-tppPegawai.php";
		break;
		
	//USER
	case "3":
		include "../pages/Mst_TppPegawai/view-tppPegawai.php";
		break;

	default:
		break;


}





?>