<?php
require_once(dirname(__FILE__) . "/bootstrap.php");

$file = $_GET['file'];
$line = $_GET['line'];

$error = new MySQLErrorRecord($config);
$error->removeErrorsByFileAndLine($file, $line);

header("Location: ./");