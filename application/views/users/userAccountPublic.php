<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content account-content">
			<div class="modal-header account-header">
				<h3>Profile</h3>
			</div>
			<div class="modal-body">
				<?php foreach ($userDetails as $user) : ?>
					<div class="">
						<img style="height: 150px; width: 160px; border-radius: 80%;"
							 src="<?php echo $user->getDisplayPictureUrl() ?>"
					</div>

					<div class="accountDetails">
						<h5><?php echo '<br>' . $user->getFirstName() . ' ' . $user->getLastName() ?></h5>
						<label><i>#<?php echo $user->getUserName() ?></i></label>
					</div>
				<?php endforeach; ?>

				<?php foreach ($listOfGenres as $genre) : ?>
					<span class="badge badge-pill badge-info genre-label">
						<label class="genre-label"><?php echo $genre->getFavoriteGenres() ?></label>
						</span>
				<?php endforeach; ?>
				<br>

				<?php if ($this->session->userdata('userId') == $user->getId()) : ?>
					<a class="editProfile-btn" href="<?php echo site_url('/users/editProfile') ?>"
					   style="margin-top: -250px;"><i
							class="fa fa-edit fa-2x"></i></a>
				<?php else : ?>
					<?php if (!$isFollowing) : ?>
						<br>
						<a class=""
						   href="<?php echo site_url('/search/addConnectionFromProfile/') . $user->getId(); ?>">
							<button class="btn btn-outline-success followUserProfile-btn">Follow</button>
						</a>
					<?php else : ?>
						<br>
						<a class=""
						   href="<?php echo site_url('/search/deleteConnectionFromProfile/') . $user->getId() ?>">
							<button class="btn btn-outline-danger unfollowUserProfile-btn">Unfollow</button>
						</a>
					<?php endif; ?>
				<?php endif; ?>
				<br>
				<br>
			</div>
			<!--			<div class="modal-footer">-->
		</div>
	</div>
</div>
