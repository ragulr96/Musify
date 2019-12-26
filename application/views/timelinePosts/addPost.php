<div class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content addPost-content">
			<div class="modal-header addPost-header">
				<h3>Write Post</h3>
			</div>
			<div class="modal-body">
				<?php echo form_open('timelinePosts/addPost') ?>

				<div class="form-group">
					<label>Post title</label>
					<input type="text" class="form-control" name="postTitle" placeholder="Enter Post Title">
				</div>
				<div class="form-group">
					<label>Post Content</label>
					<textarea class="form-control" name="postContent" placeholder="Enter Post Content"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Upload Post</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
