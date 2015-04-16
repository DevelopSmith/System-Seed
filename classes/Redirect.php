<?php

/**
* Class Redirect
*/
class Redirect{
	public static function to($location = null){
		if($location){
			if($location == '404'){
				header('HTTP/1.0 404 Not Found');
				include 'includes/errors/404.php';
				exit();
			}
			
			header('Location: ' . $location);
			exit();
		}
	}
}


?>