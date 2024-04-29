<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/W-mapping/view-mapping.php";
		break;

	default:
		break;


}





?>