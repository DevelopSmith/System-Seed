<?php require_once 'core/init.php'; ?>
<html>
<head>
	<title>Update Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/styles.css">
	<script type="text/javascript" src="<?php echo root(); ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>
<?php
include 'includes/parts/header.php';

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}else{
	if(Input::exists()){
		if(Token::check(Input::get('token'))){
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
				)
			));

			if($validation->passed()){
				try{
					$user->update(array(
						'name' => Input::get('name')
					));

					Session::flash('profile', 'You have updated your profile successfully!');
					Redirect::to('profile.php');
				}catch(Exception $e){
					die($e->getMessage());
				}
			}else{
				foreach($validation->error() as $error){
					echo $error . "<br>";
				}
			}
		
		}
	}
}
?>
	<form accept="" method="post">
		<div class="field">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="<?php echo escape($user->data()->name); ?>" autocomplete="off">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

		<input type="submit" value="Update">
	</form>

<?php include 'includes/parts/footer.php'; ?>