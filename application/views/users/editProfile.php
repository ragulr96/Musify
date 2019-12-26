<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content editProfile-content">
			<div class="modal-header editProfile-header">
				<h3>Edit Profile</h3>
			</div>
			<div class="modal-body">
				<?php foreach ($userDetails as $user) : ?>

				<?php echo validation_errors() ?>

				<?php echo form_open('users/updateProfile'); ?>


				<div class="form-group">
					<label>First Name</label>
					<input type="text" class="form-control" name="firstName" placeholder="First Name"
						   value="<?php echo $user->getFirstName() ?>">
				</div>

				<div class="form-group">
					<label>Last Name</label>
					<input type="text" class="form-control" name="lastName" placeholder="Last Name"
						   value="<?php echo $user->getLastName() ?>">
				</div>

				<div class="form-group">
					<label>Display Picture URL</label>
					<input type="text" class="form-control" name="displayPictureUrl" placeholder="DP url"
						   value="<?php echo $user->getDisplayPictureUrl() ?>">
				</div>

				<div class="form-group">
					<label>Favorite Genres</label>
					<select multiple="multiple" class="form-control" name="favoriteGenres[]"
							id="favoriteGenres[]">
						<option value="classical">Classical</option>
						<option value="instrumental">Instrumental</option>
						<option value="jazz">Jazz</option>
						<option value="rock">Rock</option>
						<option value="electronic">Electronic</option>
						<option value="techno">Techno</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-block">Update Profile</button>
				<?php echo form_close(); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

