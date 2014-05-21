<?php
require_once(dirname(__FILE__) . "/bootstrap.php");

$file = $_GET['file'];
$line = $_GET['line'];
$uri = urldecode($_GET['uri']);
$method = $_GET['method'];

$error = new MySQLErrorRecord($config);
$error->removeErrorsByGroup($file, $line, $uri, $method);

header("Location: ./listErrors.php?file=".urlencode($file)."&line={$line}");