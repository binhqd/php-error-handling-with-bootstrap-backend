<?php
function dump($obj) {
	echo "<pre>";
	var_dump($obj);exit;
}

$config = require(dirname(__FILE__) . "/config.php");

$sourceDir = $config['sourceDir'];
$errorLogConfigs = require($sourceDir . "/config.php");

/**
 * Method for autoload class of ErrorHandling
 * @param unknown_type $class_name
 */
function __autoload($class_name) {
	global $sourceDir;
	$path = "{$sourceDir}/{$class_name}.php"; 
	if (is_file($path)) {
		include $path;
	} else {
		$path = "{$sourceDir}/components/{$class_name}.php";
		if (is_file($path)) {
			include $path;
		} else {
			$path = "{$sourceDir}/connector/{$class_name}.php";
			if (is_file($path)) {
				include $path;
			}
		}
	}
}