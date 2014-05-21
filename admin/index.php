<?php
require_once(dirname(__FILE__) . "/bootstrap.php");

$error = new MySQLErrorRecord($config);
		
$groups = $error->groupErrorsByFileAndLine();
include('views/index.php');