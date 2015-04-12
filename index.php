<html>
<head>
	<title>System Seed</title>
</head>
<body>
<?php
require_once 'core/init.php';

$user = DB::getInstance()->update('users', 2, array(
	'username' => 'rody',
	'password' => 'newpassword',
	'salt'     => 'salt'
	));

/*if(!$user->count()){
	echo 'No user!';
}else{
	echo $user->first()->username;
}*/
?>

</body>
</html>