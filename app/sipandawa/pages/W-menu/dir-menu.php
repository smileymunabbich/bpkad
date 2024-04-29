<?php

switch ($_SESSION['id_level']) {

	//ADMIN SUPERUSER
	case "1":
		include "../pages/W-menu/view-menu.php";
		break;

	default:
		break;
}

?>