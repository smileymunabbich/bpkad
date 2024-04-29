<?php
require_once('dbConfigSistem.php');
class dbSistem extends dbConfigSistem
{
	function __construct() {
		parent::setHost('localhost');
		parent::setDbName('db_sistem');
		parent::setUser('root');
		parent::setPassword('');
	}
}

?>
