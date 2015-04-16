<?php require_once 'core/init.php'; ?>
<html>
<head>
	<title>System Seed</title>
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

if(!$user->isLoggedIn()){
	echo 'You need to <a href="login.php">login</a> or <a href="register.php">register</a>!';
}

?>

<?php include 'includes/parts/footer.php'; ?>