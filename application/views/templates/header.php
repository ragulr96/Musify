<html>
<head>
	<title>MusiFY</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min 2.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/generic.css">
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
	<script src="https://use.fontawesome.com/7d1e8c9e66.js"></script>
<!--	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul>
			<?php if (!$this->session->userdata('loginStatus')) : ?>
				<div>
					<img src="<?php echo base_url(); ?>assets/images/Logo.png" class="app-logo">
				</div>
			<?endif;?>
		</ul>
		<ul class="navbar-nav mr-auto">
			<?php if ($this->session->userdata('loginStatus')) : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/userProfile">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/timelinePosts/viewPosts">Timeline</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/search">Search</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/connection">Connections</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/userContact">Contacts</a>
				</li>
			<?php endif; ?>
		</ul>
		<ul class="nav navbar-nav navbar-right">

			<?php if (!$this->session->userdata('loginStatus')) : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/users/signup">Sign Up</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/users/signin">Sign In</a>
				</li>
			<?php endif; ?>
			<?php if ($this->session->userdata('loginStatus')) : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url() ?>/users/signout">Sign Out</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>

<div class="container">
<!--	Set alert messages-->
	<?php if($this->session->flashdata('login_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('login_failed')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('signup_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('signup_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('logout_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('logout_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('updatePost_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('updatePost_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('removePost_passed')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('removePost_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('addPost_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('addPost_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('updateProfile_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('updateProfile_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('signIn_failed')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('signIn_failed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('login_required')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_required').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('postData_required')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('postData_required').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('unfollow_passed')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('unfollow_passed').'</p>' ?>
	<? endif;?>

	<?php if($this->session->flashdata('follow_passed')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('follow_passed').'</p>' ?>
	<? endif;?>
