<?php if ($listOfPosts != NULL) : ?>
	<div id="myModal" class="modal d-block position-relative">
		<div class="modal-dialog">
			<div class="modal-content post-content">
				<div class="modal-header post-header">
					<h3>Timeline</h3>
				</div>
				<div class="modal-body">

					<?php foreach ($listOfPosts as $post) : ?>
						<a class="btn readMore-btn" href="<?php echo site_url('/userProfile/') . $post->slugValue ?>"><i
								class="fa fa-share fa-2x" title="Read more"></i></a>

						<?php if ($post->displayPictureUrl) : ?>
							<img class="postOwner" src="<?php echo $post->displayPictureUrl; ?>"/>
						<?php else : ?>
							<img class="postOwner" src="https://www.linkkar.com/assets/default/images/default-user.png"/>
						<?php endif; ?>
						<div class="postOwnerTime">
							<small>@<a
									href="<?php echo site_url() ?>/searchUser/loadPublicUserProfilePage/<?php echo $post->id; ?>"><?php echo $post->firstName; ?><?php echo ' ' . $post->lastName; ?></a></small><br>
							<small><?php echo date_format(new DateTime($post->createdTime), 'd/m/Y'); ?></small>
						</div>

						<div class="privatePostContent">
							<label class="lead" style="font-size: 25px"><?php echo $post->postTitle; ?></label><br>
							<label><i>
									<?php
									$imageRegex = '/https?:\/\/[^ ]+?(?:\.jpg|\.png|\.gif)/';
									$hyperlinkRegex = '~(?<!src=\')https?://\S+\b~';

									$result = $post->postContent;

									$result = preg_replace($imageRegex, "<br><br><img src='\\0'/><br><br>", $result);
									$result = preg_replace($hyperlinkRegex, "<a target = '_blank' href='\\0'>\\0</a>", $result);

									echo $result;
									?>
								</i>
							</label>
						</div>
						<hr>
						<br>
					<?php endforeach; ?>

				</div>
				<!--			<div class="modal-footer"></div>-->
			</div>
		</div>
	</div>
	<?php //endif; ?>

<?php else : ?>

	<div id="myModal" class="modal d-block position-relative">
		<div class="modal-dialog">
			<div class="modal-content post-content">
				<div class="modal-header post-header">
					<h3>Posts</h3>
				</div>
				<div class="modal-body">
					<h6 style="text-align: center;">No Posts Available</h6>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
<?php endif; ?>

