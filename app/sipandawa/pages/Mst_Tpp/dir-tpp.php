<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/Mst_Tpp/view-tpp.php";
		break;
		
	//ADMIN
	case "2":
		include "../pages/Mst_Tpp/view-tpp.php";
		break;
		
	//USER
	case "3":
		include "../pages/Mst_Tpp/view-tpp.php";
		break;

	default:
		break;


}





?>