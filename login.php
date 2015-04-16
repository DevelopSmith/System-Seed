<?php
require_once 'core/init.php';
get_header('Log in');

$user = new User();
if($user->isLoggedIn()){
	Redirect::to('index.php');
}

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
				echo '<div class="alert alert-danger" role="alert">Failed!</div>';
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
<div class="container container-after">
	<div class="row">
		<form accept="" method="post" class="col-xs-4">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" value="">
			</div>
			<div  class="checkbox">
				<label for="remember">
					<input type="checkbox" name="remember" id="remember">Remember me
				</label>
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			<input type="submit" value="Login" class="btn btn-primary" />
		</form>
	</div>
</div>

<?php include 'includes/parts/footer.php'; ?>