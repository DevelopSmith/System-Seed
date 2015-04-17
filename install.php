<?php
require_once 'core/init.php';
get_header('System Seed Installation');
?>
<div class="container container-after">

<?php
$errors = array();
$db = DB::getInstance();

if(!$db->create('groups', array(
	'`id` int(11) NOT NULL AUTO_INCREMENT',
	'`name` varchar(20) NOT NULL',
	'`permissions` text NOT NULL'
), 'id', 1)){
	array_push($errors, 'An error happened while creating the <strong>groups</strong> table!');
}

if(!$db->create('users', array(
  '`id` int(11) NOT NULL AUTO_INCREMENT',
  '`username` varchar(20) NOT NULL',
  '`password` varchar(64) NOT NULL',
  '`salt` varchar(32) NOT NULL',
  '`name` varchar(50) NOT NULL',
  '`joined` datetime NOT NULL',
  '`group` int(11) NOT NULL',
), 'id', 1)){
	array_push($errors, 'An error happened while creating the <strong>users</strong> table!');
}

if(!$db->create('users_session', array(
  '`id` int(11) NOT NULL AUTO_INCREMENT',
  '`user_id` int(11) NOT NULL',
  '`hash` varchar(64) NOT NULL',
), 'id', 1)){
	array_push($errors, 'An error happened while creating the <strong>users_session</strong> table!');
}

if(!$db->insert('groups', array(
	'name' => 'Adminstrator',
	'permissions' => '{"admin": 1,"moderator": 1}'
))){
	array_push($errors, 'An error happened while inserting the <strong>Adminstrator</strong> record!');
}
if(!$db->insert('groups', array(
	'name' => 'Moderator',
	'permissions' => '{"admin": 0,"moderator": 1}'
))){
	array_push($errors, 'An error happened while inserting the <strong>Moderator</strong> record!');
}
if(!$db->insert('groups', array(
	'name' => 'Standard',
	'permissions' => '{"admin": 0,"moderator": 0}'
))){
	array_push($errors, 'An error happened while inserting the <strong>Standard</strong> record!');
}

if(count($errors)){
?>
	<div class="row">
		<h3>The following errors happened:</h3>
		<ul class="alert alert-danger" style="padding-left: 40px;">
	
			<?php
			foreach ($errors as $error) {
				echo '<li>'. $error .'</li>';
			}
			?>
		</ul>
	</div>

<?php
}else{
	echo '<div class="alert alert-success">Database tables and records were created successfully!</div>';
}
?>
</div>

<?php include 'includes/parts/footer.php'; ?>
