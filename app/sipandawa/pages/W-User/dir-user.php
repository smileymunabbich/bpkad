<?php

switch($_SESSION['id_level']){
	
	//ADMIN SUPERUSER
	case "1":
		include "../pages/W-User/view-user.php";
		break;

	default:
		break;


}





?>