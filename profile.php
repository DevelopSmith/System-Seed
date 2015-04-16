<?php
require_once 'core/init.php';

if($username = Input::get('user')){
	$user_profile = new User($username);

	if(!$user_profile->exists()){
		Redirect::to('404');
	}else{
		
	}
	get_header($user_profile->data()->name . ' Profile');
}else{
	$username = null;
	$user = new User();
	get_header($user->data()->name . ' Profile');
}
?>

<div class="container container-after">
	<div class="row">
		<?php
		if(Session::exists('home')){
			echo '<p class="alert alert-success">' . Session::flash('home') . '</p>';
		}

		if($username){
			echo '<h1>This is: ' . $user_profile->data()->name . '</h1>';
		}elseif($user){
			echo '<h1>Hello ' . $user->data()->name . '</h1>';
		}

		?>	
	</div>
</div>

<?php include 'includes/parts/footer.php'; ?>