<?php
require_once 'core/init.php';
get_header('Update Profile');

$user = new User();
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
<div class="container container-after">
	<div class="row">
		<form accept="" method="post" class="col-xs-4">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo escape($user->data()->name); ?>" autocomplete="off">
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			<input type="submit" value="Update" class="btn btn-primary" />
		</form>
	</div>
</div>

<?php include 'includes/parts/footer.php'; ?>