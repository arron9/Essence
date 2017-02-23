<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * 在apps中的app名必须要与域名中做匹配
 * 每个app中可以自我构建不懂的module
 * 所有静态类的文件全部放在public中。
 */
call_user_func(function() {
	function throwNotFound() {
		header("HTTP/1.1 404 NOT FOUND");
	}

	$app_dir = dirname(__DIR__).DIRECTORY_SEPARATOR."app";
	
	$app_bootstrap_file = $app_dir.DIRECTORY_SEPARATOR."bootstrap.php";

	if (is_file($app_bootstrap_file)) {
		include $app_bootstrap_file;
	} else {
		return throwNotFound();
	}
});

?>

