<?php require_once 'core/init.php'; ?>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/styles.css">
	<script type="text/javascript" src="<?php echo root(); ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>
<?php include 'includes/parts/header.php'; ?>

<?php
if(Session::exists('home')){
	echo '<p class="alert alert-success">' . Session::flash('home') . '</p>';
}

if($username = Input::get('user')){
	$user_profile = new User($username);
	if(!$user_profile->exists()){
		Redirect::to('404');
	}else{
		echo '<h1>This is: ' . $user_profile->data()->name . '</h1>';
	}
}else{
	echo '<h1>Hello ' . $user->data()->name . '</h1>';
}

/*if($user->isLoggedIn()){
	echo '<h1>Hello ' . $user->data()->name . '</h1>';
	echo '<br>You can <a href="update.php">update your profile!</a>';
}*/
?>

<?php include 'includes/parts/footer.php'; ?>