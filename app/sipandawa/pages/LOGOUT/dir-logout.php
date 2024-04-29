<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/LOGOUT/view-logout.php";
		break;
		
	case "2":
		include "../pages/LOGOUT/view-logout.php";
		break;
	
	case "3":
		include "../pages/LOGOUT/view-logout.php";
		break;
		
	case "4":
		include "../pages/LOGOUT/view-logout.php";
		break;
		
	case "5":
		include "../pages/LOGOUT/view-logout.php";
		break;
		
	case "6":
		include "../pages/LOGOUT/view-logout.php";
		break;
		
	case "7":
		include "../pages/LOGOUT/view-logout.php";
		break;

	default:
		break;


}





?>