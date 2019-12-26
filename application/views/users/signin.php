<?php if(validation_errors()) : ?>
	<div class="alert alert-dismissible alert-danger">
		<?php echo validation_errors() ?>
	</div>
<?php endif; ?>

<?php echo form_open('users/signin'); ?>
<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content login-content">
			<div class="modal-header login-header">
				<h3>Login</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" name="userName" class="form-control"
						   placeholder="Username" required autofocus>
				</div>

				<div class="form-group">
					<input type="password" name="password" class="form-control"
						   placeholder="Password" required autofocus>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</div>
			<div class="modal-footer">
				<p>Don't have an account?
					<a href="signup">Sign Up for MusiFY</a>
				</p>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

