<?php require_once 'core/init.php'; ?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/styles.css">
	<script type="text/javascript" src="<?php echo root(); ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>
<?php
include 'includes/parts/header.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));

		if($validation->passed()){
			$user = new User();
			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login){
				Session::flash('home', 'You have logged in successfully!');
				Redirect::to('index.php');
			}else{
				echo "Failed!";
			}
		}else{
			foreach($validation->error() as $error){
				echo $error . "<br>";
			}
		}
	}
}

?>
<html>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<form accept="" method="post">
		<div class="field">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
		</div>
		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" value="">
		</div>
		<div class="field">
			<label for="remember">
				<input type="checkbox" name="remember" id="remember">
				Remember me
			</label>
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

		<input type="submit" value="Login">
	</form>

<?php include 'includes/parts/footer.php'; ?>