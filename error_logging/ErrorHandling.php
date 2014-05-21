<?php
require_once(dirname(__FILE__) . "/connector/MySQLErrorRecord.php");
/**
 * 
 * @author BinhQD
 *
 */
class ErrorHandling {
	/**
	 * Callback function for handling errors
	 * @param code $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param int $errline
	 */
	public static function handlingError($errno, $errstr, $errfile, $errline) {
		$err = array(
			'message'	=> $errstr,
			'code'		=> $errno,
			'file'		=> $errfile,
			'line'		=> $errline
		);
		$error = self::saveError($err);
		
		self::showError($error);
		
	}
	
	/**
	 * Callback function for handling exception
	 * @param Exception $ex
	 */
	public static function handlingException($ex) {
		$err = array(
			'message'	=> $ex->getMessage(),
			'code'		=> $ex->getCode(),
			'file'		=> $ex->getFile(),
			'line'		=> $ex->getLine()
		);
		
		$error = self::saveError($err);
		
		self::showError($error);
		return;
	}
	
	/**
	 * This method is used to display error after logging it
	 * @param array $error
	 */
	protected static function showError($error) {
		/*
		if (isAjax) {
			//output with ajax
		}
		
		$errorPage = "404";
		
		$redirectUrl = "/";
		if ($error['code'] == 500 || $error['code'] == 0) {
			$errorPage = 500;
			$redirectUrl = "/error-docs/{$errorPage}";
		} else {
			$errorPage = 404;
			$redirectUrl = "/error-docs/{$errorPage}?url=" . urlencode(requestUri);
		}
		
		redirect($redirectUrl);
		end();
		*/
	}
	
	/**
	 * This method is used to save error
	 * @param array $err
	 */
	private static function saveError(array $err) {
		$config = require(dirname(__FILE__) . "/config.php");
		$error = new MySQLErrorRecord($config);
		
		$error->code = $err['code'];
		$error->message = $err['message'];
		$error->file = $err['file'];
		$error->line = $err['line'];
		
		$error->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
		$error->referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
		
		$error->ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";
		$error->user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
	
		$error->request_method = isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : "GET";
		
		if (strtoupper($error->request_method) == "POST" && !empty($_POST)) {
			$error->post_data = $_POST;
		} else {
			$error->post_data = array();
		}
		
		$error->browser = self::getBrowser($error->user_agent);
		
		$backtrace = debug_backtrace();
		$traces = array();
		$cnt = 0;
		foreach ($backtrace as $item) {
			if ($cnt == 0) {$cnt++;continue;}
			if (isset($item['file']) && isset($item['line'])) {
				$traces[] = "{$item['file']} ({$item['line']}):";
			} else {
				$traces[] = "{$item['class']}{$item['type']}{$item['function']}";
			}
			//$traces[] = $item;
		}
		
		$error->traces = $traces;
		
		try {
			$error->save();
		} catch (Exception $ex) {
			self::showError($error);
		}
		
		return $error;
	}
	
	/**
	 * This method is used to detect browser base on user-agent
	 * @param string $userAgent
	 * @return array $return
	 */
	private static function getBrowser($userAgent) {
		require_once(dirname(__FILE__) . "/browser/Browser.php");
		
		$browser = new Browser($userAgent);
		$return = array(
			'platform'	=> $browser->getBrowser(),
			'version'	=> $browser->getVersion()
		);
		
		return $return;
	}
}