<?php
require_once('dbConfig.php');

class dbProject extends dbConfig
{
	function __construct() {
		parent::setHost('localhost');
		parent::setDbName('db_sipandawa');
		parent::setUser('root');
		parent::setPassword('');
	}

}

?>
