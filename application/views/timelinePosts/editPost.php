<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content editPost-content">
			<div class="modal-header editPost-header">
				<h3>Edit Post</h3>
			</div>
			<div class="modal-body">

				<?php foreach ($listofPosts as $post) : ?>

					<?php echo validation_errors() ?>

					<?php echo form_open('timelinePosts/updatePost') ?>

					<input type="hidden" name="postId" value="<?php echo $post->postId; ?>">
					<input type="hidden" name="slug" value="<?php echo $post->slugValue; ?>">

					<div class="form-group">
						<label>Post title</label>
						<input type="text" class="form-control" name="postTitle" placeholder="Enter Post Title"
							   value="<?php echo $post->postTitle ?>">
					</div>
					<div class="form-group">
						<label>Post Content</label>
						<textarea class="form-control" name="postContent"
								  placeholder="Enter Post Content"><?php echo $post->postContent ?></textarea>
					</div>
				<?php endforeach; ?>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Update Post</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

