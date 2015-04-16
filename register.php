<?php
require_once 'core/init.php';
get_header('Register');

$user = new User();
if($user->isLoggedIn()){
	Redirect::to('index.php');
}

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()){
			$user = new User();
			$salt = Hash::salt(32);

			try{
				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 3
				));
			}catch(Exception $e){
				die($e->getMessage());
			}

			Session::flash('home', 'You have registered successfully!');
			Redirect::to('index.php');
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
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
<div class="container container-after">
	<div class="row">
		<form accept="" method="post" class="col-xs-4">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" value="">
			</div>
			<div class="form-group">
				<label for="password_again">Repeat Password</label>
				<input type="password" class="form-control" name="password_again" id="password_again" value="">
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>">
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			<input type="submit" value="Register" class="btn btn-primary" />
		</form>
	</div>
</div>

<?php include 'includes/parts/footer.php'; ?>