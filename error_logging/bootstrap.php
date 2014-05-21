<?php
use Lyad\ErrorLogging;
function dump($obj) {
	echo "<pre>";
	var_dump($obj);exit;
}

require_once(dirname(__FILE__) . "/ErrorHandling.php");
