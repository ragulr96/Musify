<?php foreach ($listofPosts as $post) : ?>
<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content singlePost-content">
			<div class="modal-header singlePost-header">
				<h3>View Post</h3>
			</div>
			<div class="modal-body">
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
							$result = preg_replace($hyperlinkRegex, "<a href='\\0'>\\0</a>", $result);

							echo $result;
							?>
						</i>
					</label>
				</div>
			</div>
			<div class="modal-footer">
				<?php if ($this->session->userdata('userId') == $post->userId) : ?>
					<?php echo form_open('/userProfile/removePost/' . $post->postId); ?>
					<div class="editOptions-btn">
						<a class="btn btn-primary" href="editPost/<?php echo $post->slugValue ?>">Edit Post</a>
						<input class="btn btn-danger" type="submit" value="Delete Post">
					</div>
					<?php echo form_close() ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

