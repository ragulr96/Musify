<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content account-content">
			<div class="modal-header account-header">
				<h3>Profile</h3>
			</div>
			<div class="modal-body">
				<?php foreach ($userDetails as $user) : ?>

					<?php if ($this->session->userdata('userId') == $user->getId()) : ?>
						<a class="editProfile-btn" href="users/editProfile"><i class="fa fa-edit fa-2x"></i></a>
						<br><br>
					<?php endif; ?>

					<div class="displayPicture">
						<img style="height: 150px; width: 160px; border-radius: 80%;"
							 src="<?php echo $user->getDisplayPictureUrl() ?>"/>
					</div>

					<div class="accountDetails">
						<h5><?php echo '<br>' . $user->getFirstName() . ' ' . $user->getLastName() ?></h5>
						<label><i>#<?php echo $user->getUserName() ?></i></label>
					</div>
				<?php endforeach; ?>


				<?php if ($listOfGenres != NULL) : ?>

					<?php foreach ($listOfGenres as $genre) : ?>
						<span class="badge badge-pill badge-info genre-label">
						<label class="genre-label"><?php echo $genre->getFavoriteGenres() ?></label>
						</span>
						<br><br>
					<?php endforeach; ?>
				<?php endif; ?>
				<br>
			</div>
			<!--			<div class="modal-footer">-->
		</div>
	</div>
</div>

