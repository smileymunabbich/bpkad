<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/W-Home/view-home.php";
		break;
	
	case "2":
		include "../pages/W-Home/view-home.php";
		break;
	
	case "3":
		include "../pages/W-Home/view-home.php";
		break;
	
	case "4":
		include "../pages/W-Home/view-home.php";
		break;
	
	case "5":
		include "../pages/W-Home/view-home.php";
		break;

	default:
		break;


}

?>