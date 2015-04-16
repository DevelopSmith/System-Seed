<?php require_once 'core/init.php'; ?>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/styles.css">
	<script type="text/javascript" src="<?php echo root(); ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>
<?php
include 'includes/parts/header.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true
			),
			'password_new' => array(
				'required' => true,
				'min' => 6
			),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new'
			)
		));

		if($validation->passed()){
			if(Hash::make(Input::get('password_current'), $user->data()->salt) == $user->data()->password){
				$salt = Hash::salt(32);

				$user->update(array(
					'password' => Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
				));

				Session::flash('home', 'You have updated your password successfully!');
				Redirect::to('index.php');
			}else{
				echo "You must enter the current password correctly.";
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
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<form accept="" method="post">
		<div class="field">
			<label for="password_current">Current Password</label>
			<input type="password" name="password_current" id="password_current" value="">
		</div>
		<div class="field">
			<label for="password_new">New Password</label>
			<input type="password" name="password_new" id="password_new" value="">
		</div>
		<div class="field">
			<label for="password_new_again">New Password Again</label>
			<input type="password" name="password_new_again" id="password_new_again" value="">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

		<input type="submit" value="Change">
	</form>

<?php include 'includes/parts/footer.php'; ?>