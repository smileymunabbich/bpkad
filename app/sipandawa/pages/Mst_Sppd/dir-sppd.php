<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/Mst_Sppd/view-sppd.php";
		break;
		
	//ADMIN
	case "2":
		include "../pages/Mst_Sppd/view-sppd.php";
		break;
		
	//USER
	case "3":
		include "../pages/Mst_Sppd/view-sppd.php";
		break;

	default:
		break;

}
?>