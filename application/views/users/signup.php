<?php echo form_open('users/signup'); ?>
<?php if (validation_errors()) : ?>
	<div class="alert alert-dismissible alert-danger">
		<?php echo validation_errors() ?>
	</div>
<?php endif; ?>

<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content signup-content">
			<div class="modal-header signup-header">
				<h3>Create Account</h3>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<div class="col-md-5">
						<input type="text" class="form-control" name="firstName" placeholder="First name">
					</div>

					<div class="col-md-7">
						<input type="text" class="form-control" name="lastName" placeholder="Last name">
					</div>
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Email">
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="userName" placeholder="Username">
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<input type="password" class="form-control" name="password" placeholder="Enter password">
					</div>

					<div class="col-md-6">
						<input type="password" class="form-control" name="confirmedPassword"
							   placeholder="Confirm password">
					</div>
				</div>

				<button type="submit" class="btn btn-primary btn-block">Create Account</button>
			</div>
			<div class="modal-footer">
				<p>Already have an account?
					<a href="signin">Sign In for MusiFY</a>
				</p>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
