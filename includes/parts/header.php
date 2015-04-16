<?php
$user = new User();

?>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo root(); ?>/assets/css/styles.css">
	<script type="text/javascript" src="<?php echo root(); ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>

<nav class="nav navbar-inverse">
	<div class="container-fluid">
		<a href="<?php echo root(); ?>/index.php" class="navbar-brand">System Seed</a>
		<ul class="nav navbar-nav">
			<li class=""><a href="#">Link</a></li>
			<?php
			if($user->isLoggedIn()){
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $user->data()->name; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo root(); ?>/profile.php">Profile</a></li>
						<li><a href="<?php echo root(); ?>/changepassword.php">Change Password</a></li>
						<li><a href="<?php echo root(); ?>/update.php">Edit Sittings</a></li>
						<?php if($user->hasPermission('admin') || $user->hasPermission('moderator')){ ?>
						<li class="divider"></li>
						<li><a href="<?php echo root(); ?>/administ/">Control Panel</a></li>
						<?php } ?>
						<?php if($user->hasPermission('admin')){ ?>
						<li><a href="<?php echo root(); ?>/administ/editusers.php">Edit Users</a></li>
						<?php } ?>
						<li class="divider"></li>
						<li><a href="<?php echo root(); ?>/logout.php">Logout</a></li>
					</ul>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
</nav>