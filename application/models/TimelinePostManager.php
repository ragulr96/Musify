<?php

include_once 'TimelinePostModel.php';

class TimelinePostManager extends CI_Model
{
	/**
	 * TimelinePostManager constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Update timeline post object
	 * @param $userId
	 * @param $postTitle
	 * @param $postContent
	 * @param $slugValue
	 */
	public function updateTimeLinePostData($userId, $postTitle, $postContent, $slugValue)
	{
		$this->userId = $userId;
		$this->postTitle = $postTitle;
		$this->postContent = $postContent;
		$this->slugValue = $slugValue;
	}

	/**
	 * Update edited timeline post object
	 * @param $postTitle
	 * @param $postContent
	 */
	public function updateEditedTimeLinePostData($postTitle, $postContent)
	{
		$this->postTitle = $postTitle;
		$this->postContent = $postContent;
	}

	/**
	 * Function to create a new post
	 * @param $userId
	 * @param $postTitle
	 * @param $postContent
	 * @param $slugValue
	 * @return mixed
	 */
	public function createTimelinePosts($userId, $postTitle, $postContent, $slugValue)
	{
		// active record query to create a new post
		$this->db->select('COUNT(*) count');
		$this->db->from('user_post');
		$this->db->like('slugValue', $slugValue);
		$results = $this->db->get();

		// check for existing post with same slug
		$count = $results->row()->count;

		// append slug if existing
		if ($count > 0) {
			$slugValue = $slugValue . '-' . $count;
		}

		// new TimelinePostManager object
		$timelinePost = new TimelinePostManager();

		// create new post
		$timelinePost->updateTimeLinePostData($userId, $postTitle, $postContent, $slugValue);

		return $this->db->insert('user_post', $timelinePost);

	}

	/**
	 * Function to update an existing post
	 * @param $postTitle
	 * @param $postContent
	 * @param $slugValue
	 * @param $postId
	 * @return mixed
	 */
	public function updateTimelinePosts($postTitle, $postContent, $slugValue, $postId)
	{
		// active record query to get post using postId
		$fetchPostDetailsQuery = $this->db->get_where('user_post', array('id' => $postId));

		// assign returned value to TimelinePostModel
		$fetchPostDetails = $fetchPostDetailsQuery->custom_result_object('TimelinePostModel');

		$postObj = $fetchPostDetails[0];

		// update edited post
		$postObj->updateEditedTimeLinePostData($postTitle, $postContent);

		// active record query to update post
		$this->db->where('id', $postId);
		return $this->db->update('user_post', $postObj);

	}

	/**
	 * Funciton to get post details
	 * @param $userId
	 * @return mixed
	 */
	public function getTimelinePosts($userId)
	{
		// order post by createdTime of the posts
		$this->db->order_by('createdTime', 'DESC');

		// active record query to get timeline posts
		$this->db->select('user_post.postTitle, user_post.postContent, user_post.createdTime, user_post.slugValue, user_post.userId, user_account.id, user_account.userName, user_account.firstName, user_account.lastName, user_account.displayPictureUrl');
		$this->db->from('user_post');
		$this->db->join('user_account', 'user_post.userId = user_account.id');
		$this->db->where('user_post.userId', $userId);
		$this->db->order_by('user_post.createdTime', 'DESC');
		$userPostData = $this->db->get();

		// check for returned value
		if ($userPostData->num_rows() > 0) {
			return $userPostData->result();
		}
	}

	/**
	 * Function to get posts of followers
	 * @param $userId
	 * @return mixed
	 */
	public function getFollowersTimelinePosts($userId)
	{
		// active record query to get timeline post of followers
		$this->db->select('user_post.postTitle, user_post.postContent, user_post.createdTime, user_post.slugValue, user_account.userName, user_account.firstName, user_account.lastName');
		$this->db->from('user_post');
		$this->db->join('user_connection', 'user_post.userId = user_connection.userFollowingId');
		$this->db->join('user_account', 'user_connection.userFollowingId = user_account.id');
		$this->db->where("user_connection.userId = $userId OR user_post.userId = $userId");
		$this->db->order_by('user_post.createdTime', 'DESC');
		$followerPostData = $this->db->get();

		// check for returned value
		if ($followerPostData->num_rows() > 0) {
			return $followerPostData->result();
		}
	}

	/**
	 * Function to get a single post details
	 * @param $slug
	 * @return mixed
	 */
	public function getTimelineSinglePosts($slug)
	{
		// active record query to get a single post details using slug
		$this->db->select('user_post.id postId, user_post.postTitle, user_post.postContent, user_post.createdTime, user_post.slugValue, user_post.userId, user_account.id, user_account.userName, user_account.firstName, user_account.lastName, user_account.displayPictureUrl');
		$this->db->from('user_post');
		$this->db->join('user_account', 'user_post.userId = user_account.id');
		$this->db->where('user_post.slugValue', $slug);
		$singlePostData = $this->db->get();

		// check for returned value
		if ($singlePostData->num_rows() > 0) {
			return $singlePostData->result();
		}
	}

	/**
	 * Function to get userId using post slug
	 * @param $slug
	 * @return mixed
	 */
	public function getUserIdBySlugValue($slug)
	{
		// active record query to get userId using its slug
		$getPostBySlugValQuery = $this->db->get_where('user_post', array('slugValue' => $slug));

		return $getPostBySlugValQuery->row()->userId;
	}

	/**
	 * Function to remove a post
	 * @param $id
	 * @return bool
	 */
	public function removeTimelinePost($id)
	{
		// active record query to remove a post
		$this->db->delete('user_post', array('id' => $id));
		return true;
	}
}
