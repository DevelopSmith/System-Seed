<?php
require_once 'core/init.php';
get_header('System Seed');
?>
<div class="container container-after">
	<div class="row">
		<?php
		if(Session::exists('home')){
			echo '<p class="alert alert-success">' . Session::flash('home') . '</p>';
		}

		$user = new User();
		if(!$user->isLoggedIn()){
			echo 'You need to <a href="login.php">login</a> or <a href="register.php">register</a>!';
		}
		?>
	</div>
</div>
<?php include 'includes/parts/footer.php'; ?>