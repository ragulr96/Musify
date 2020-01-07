<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content search-content">
			<div class="modal-header search-header">
				<h3>Search User</h3>
			</div>
			<div class="modal-body">
				<?php echo form_open('searchUser/getUserProfile') ?>
				<div class="form-group">
					<label for="exampleSelect1">Choose genre</label>
					<select class="form-control" id="searchUser" name="searchUser" style="width: 420px;">
						<option value="" selected disabled>Search user by genre</option>
						<option value="Classical">Classical</option>
						<option value="Instrumental">Instrumental</option>
						<option value="Jazz">Jazz</option>
						<option value="Rock">Rock</option>
						<option value="Electronic">Electronic</option>
						<option value="Techno">Techno</option>
					</select>
					<button class="btn searchUserGenre-btn"><i class="fa fa-search fa-2x"></i></button>
					<hr>

				</div>
				<?php echo form_close(); ?>

				<?php if (!empty($output[0]) OR !empty($output[1])) { ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<?php foreach ($output[0] as $key => $value) { ?>
								<tr class="table-light">
									<td>
										<i class="fa fa-user fa-3x"></i>
										<a href="loadPublicUserProfilePage/<?php echo $key; ?>"><?php echo $value; ?></a>
									</td>
									<td>
										<a href="<?php echo site_url('/search/deleteConnection/') . $key ?>">
											<button class="btn btn-outline-danger unfollowUser-btn">Unfollow</button>
										</a>
									</td>
								</tr>
							<?php } ?>
							<?php foreach ($output[1] as $key => $value) { ?>
								<tr class="table-light">
									<td>
										<i class="fa fa-user fa-3x"></i>
										<a href="loadPublicUserProfilePage/<?php echo $key ?>"><?php echo $value; ?></a>
									</td>
									<td>
										<a href="<?php echo site_url('/search/addConnection/') . $key ?>">
											<button class="btn btn-outline-success followUser-btn">Follow</button>
										</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } elseif (!empty($output[2])) { ?>
					<div class="table-responsive">
						<table class="table table-hover table-sm">
							<tbody>
							<?php foreach ($output[2] as $out) { ?>
								<tr class="table-light">
									<td>
										<i class="fa fa-user fa-3x"></i>
										<a href="loadPublicUserProfilePage/<?php echo $out->getId(); ?>"><?php echo $out->getFirstName() . $out->getLastName(); ?></a>
									</td>
									<td>
										<a href="<?php echo site_url('/search/addConnection/') . $out->getId(); ?>">
											<button class="btn btn-outline-success followUser-btn">Follow</button>
										</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
					<h6 style="text-align: center;">No users in the selected genre</h6>
				<?php } ?>
			</div>
			<!--			<div class="modal-footer"></div>-->
		</div>
	</div>
</div>
