<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content connection-content">
			<div class="modal-header connection-header">
				<h3>Connections</h3>
			</div>
			<div class="modal-body">

				<?php if ($listOfFollowers != NULL AND $listOfFriends != NULL) : ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th>
								<!--								Followers --><?php //echo '(' . (count((array)$listOfFollowers)) . ')' ?>
								Followers
							</th>
							<th></th>
							<?php foreach ($listOfFollowers as $follower) : ?>
								<?php if (in_array($follower, $listOfFriends)) : ?>
									<tr class="table-light">
										<td>
											<h6 style="text-align: center;">You don't have any followers.</h6>
										</td>
									</tr>
								<?php else: ?>
									<tr class="table-light">
										<td>
											<img class="connectionDisplayPicture" style="height: 50px; width: 50px;"
												 src="<?php echo $follower->getDisplayPictureUrl() ?>"/>
											<a href="searchUser/loadPublicUserProfilePage/<?php echo $follower->getId(); ?>"><?php echo $follower->getFirstName() . ' ' . $follower->getLastName(); ?>
											</a>
										</td>
									</tr>
								<?php endif; ?>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
				<?php elseif ($listOfFollowers != NULL) : ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th>
								<!--								Followers --><?php //echo '(' . (count((array)$listOfFollowers)) . ')' ?>
								Followers
							</th>
							<th></th>
							<?php foreach ($listOfFollowers as $follower) : ?>
								<tr class="table-light">
									<td>
										<img class="connectionDisplayPicture" style="height: 50px; width: 50px;"
											 src="<?php echo $follower->getDisplayPictureUrl() ?>"/>
										<a href="searchUser/loadPublicUserProfilePage/<?php echo $follower->getId(); ?>"><?php echo $follower->getFirstName() . ' ' . $follower->getLastName(); ?>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th> Followers</th>
							<th></th>
							<tr class="table-light">
								<td>
									<h6 style="text-align: center;">You don't have any followers.</h6>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

				<?php if ($listOfFollowee != NULL AND $listOfFriends != NULL) : ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th>
								<!--								Following --><?php //echo '(' . (count((array)$listOfFollowee)) . ')' ?>
								Following
							</th>
							<th></th>
							<?php foreach ($listOfFollowee as $followee) : ?>
								<?php if (in_array($followee, $listOfFriends)) : ?>
									<tr class="table-light">
										<td>
											<h6 style="text-align: center;">You are not following any users.</h6>
										</td>
									</tr>
								<?php else : ?>
									<tr class="table-light">
										<td>
											<img class="connectionDisplayPicture" style="height: 50px; width: 50px;"
												 src="<?php echo $followee->getDisplayPictureUrl() ?>"/>
											<a href="searchUser/loadPublicUserProfilePage/<?php echo $followee->getId(); ?>"><?php echo $followee->getFirstName() . ' ' . $followee->getLastName(); ?>
											</a>
										</td>
									</tr>
								<?php endif ?>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
				<?php elseif ($listOfFollowee != NULL) : ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th>
								<!--								Following --><?php //echo '(' . (count((array)$listOfFollowee)) . ')' ?>
								Following
							</th>
							<th></th>
							<?php foreach ($listOfFollowee as $followee) : ?>
								<tr class="table-light">
									<td>
										<img class="connectionDisplayPicture" style="height: 50px; width: 50px;"
											 src="<?php echo $followee->getDisplayPictureUrl() ?>"/>
										<a href="searchUser/loadPublicUserProfilePage/<?php echo $followee->getId(); ?>"><?php echo $followee->getFirstName() . ' ' . $followee->getLastName(); ?>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th> Following</th>
							<th></th>
							<tr class="table-light">
								<td>
									<h6 style="text-align: center;">You are not following any users.</h6>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

				<?php if ($listOfFriends != NULL) : ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th>
								<!--								Friends --><?php //echo '(' . (count((array)$listOfFriends)) . ')' ?>
								Friends
							</th>
							<th></th>
							<?php foreach ($listOfFriends as $friend) : ?>
								<tr class="table-light">
									<td>
										<img class="connectionDisplayPicture" style="height: 50px; width: 50px;"
											 src="<?php echo $friend->getDisplayPictureUrl() ?>"/>
										<a href="searchUser/loadPublicUserProfilePage/<?php echo $friend->getId(); ?>"><?php echo $friend->getFirstName() . ' ' . $friend->getLastName(); ?>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<th> Friends</th>
							<th></th>
							<tr class="table-light">
								<td>
									<h6 style="text-align: center;">You don't have any friends.</h6>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>


