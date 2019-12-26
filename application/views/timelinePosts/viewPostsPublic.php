<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content post-content">
			<div class="modal-header post-header">
				<h3>Posts</h3>
			</div>
			<div class="modal-body">
				<?php if ($listOfPosts != NULL) : ?>
					<?php foreach ($listOfPosts as $post) : ?>

						<img class="postOwner" src="<?php echo $post->displayPictureUrl; ?>"/>
						<div class="postOwnerTime">
							<small>@<a
									href="<?php echo site_url() ?>/searchUser/loadPublicUserProfilePage/<?php echo $post->id; ?>"><?php echo $post->firstName; ?><?php echo ' ' . $post->lastName; ?></a></small><br>
							<small><?php echo date_format(new DateTime($post->createdTime), 'd/m/Y'); ?> </small>
						</div>

						<div class="privatePostContent">
							<label class="lead" style="font-size: 25px"><?php echo $post->postTitle; ?></label><br>
							<label><i>
									<?php
									$imageRegex = '/https?:\/\/[^ ]+?(?:\.jpg|\.png|\.gif)/';
									$hyperlinkRegex = '~(?<!src=\')https?://\S+\b~';

									$result = $post->postContent;

									$result = preg_replace($imageRegex, "<br><br><img src='\\0'><br><br>", $result);
									$result = preg_replace($hyperlinkRegex, "<a href='\\0'>\\0</a>", $result);

									echo $result;
									?>
								</i>
							</label>
						</div>

						<p><a class="btn btn-primary" href="<?php echo site_url('/userProfile/') . $post->slugValue ?>">
								Read More </a>
						</p>
						<hr><br>
					<?php endforeach; ?>

				<?php else: ?>
					<h5>No Posts Available</h5>
					<hr>
				<?php endif; ?>
			</div>
			<!--			<div class="modal-footer"></div>-->
		</div>
	</div>
</div>
