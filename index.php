<?php
error_reporting(E_ALL);
include_once(dirname(__FILE__) . "/error_logging/bootstrap.php");

// function shutdownHandler() {
// 	$errors = $error = error_get_last();
// 	dump($errors);
// }
set_error_handler(array("ErrorHandling", "handlingError"));
// register_shutdown_function("shutdownHandler");
set_exception_handler(array("ErrorHandling", "handlingException"));

// test error: division by error
$a = 3 / 0;

// test exception
throw new Exception("This is an error");
