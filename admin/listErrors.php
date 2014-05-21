<?php
require_once(dirname(__FILE__) . "/bootstrap.php");

$error = new MySQLErrorRecord($config);
		
$file = urldecode($_GET['file']);
$line = $_GET['line'];

$groups = $error->listErrorsByFileAndLine($file, $line);

include('views/listErrors.php');