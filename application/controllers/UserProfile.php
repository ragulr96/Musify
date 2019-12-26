<?php

class UserProfile extends CI_Controller
{

	/**
	 * Function for creating a new user
	 */
	public function signUp()
	{
		// set validation rules
		$this->form_validation->set_rules('firstName', 'FirstName', 'required');

		$this->form_validation->set_rules('lastName', 'LastName', 'required');

		$this->form_validation->set_rules('userName', 'UserName', 'trim|required|min_length[6]|max_length[13]|callback_validate_existing_username');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_validate_existing_email');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		$this->form_validation->set_rules('confirmedPassword', 'ConfirmedPassword', 'trim|required|matches[password]');

		// check for any validation errors
		if ($this->form_validation->run() === FALSE) {

			$this->load->view('templates/header');
			$this->load->view('users/signup');
			$this->load->view('templates/footer');

		} else {

			// load the UserManager model
			$this->load->model('UserManager', 'userManager');

			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$userName = $this->input->post('userName');
			$email = $this->input->post('email');
			$encryptedPassword = $this->input->post('password', true);

			// hashed encrypted password
			$encryptedPassword = password_hash($encryptedPassword, PASSWORD_BCRYPT);

			// function to register a new user
			$this->userManager->registerUser($firstName, $lastName, $userName, $email, $encryptedPassword);

			// set alert messages
			$this->session->set_flashdata('signup_passed', 'Account created successfully!');

			redirect('users/signin');
		}

	}

	/**
	 * Function for logging in
	 */
	public function signIn()
	{
		// set validation rules
		$this->form_validation->set_rules('userName', 'UserName', 'required');

		$this->form_validation->set_rules('password', 'Password', 'required');

		// check for any validation errors
		if ($this->form_validation->run() === FALSE) {

			// set alert messages
			$this->session->set_flashdata('signIn_failed', validation_errors());

			// load the views
			$this->load->view('templates/header');
			$this->load->view('users/signin');
			$this->load->view('templates/footer');

		} else {

			// load the userManager model
			$this->load->model('UserManager', 'userManager');

			$userName = $this->input->post('userName');
			$password = $this->input->post('password');

			// verify user
			$userToken = $this->userManager->verifyUser($userName, $password);
			$userId = $this->userManager->getUserAccountId($userName);

			if ($userToken) {
				$userData = array(
					'userId' => $userId,
					'userName' => $userName,
					'loginStatus' => true
				);

				// set user to session
				$this->session->set_userdata($userData);

				// set alert message
				$this->session->set_flashdata('login_passed', 'Login Successful!');

				redirect('userProfile');

			} else {
				// set alert message
				$this->session->set_flashdata('login_failed', 'Incorrect username or password entered. Try Again!');
				redirect('users/signin');
			}
		}

	}

	/**
	 * Function to log out a user
	 */
	public function signOut()
	{
		// unset the user session
		$this->session->unset_userdata('loginStatus');
		$this->session->unset_userdata('userId');
		$this->session->unset_userdata('userName');

		// set alert message
		$this->session->set_flashdata('logout_passed', 'Signed out successfully!');

		redirect('users/signin');
	}

	/**
	 * Function to validate existing username on sign up
	 * @param $userName
	 * @return bool
	 */
	public function validate_existing_username($userName)
	{

		// load the userManager model
		$this->load->model('UserManager', 'userManager');

		// set message
		$this->form_validation->set_message('validate_existing_username', 'Username is already taken. Please try again with a new username!');

		if ($this->userManager->validate_existing_username($userName)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Function to validate existing email on sign up
	 * @param $email
	 * @return bool
	 */
	public function validate_existing_email($email)
	{

		// load the userManager model
		$this->load->model('UserManager', 'userManager');

		// set alert
		$this->form_validation->set_message('validate_existing_email', 'Email is already taken. Please try again with a new email!');

		if ($this->userManager->validate_existing_email($email)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Function to add a new post
	 */
	public function addPost()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// set validation rules
		$this->form_validation->set_rules('postTitle', 'PostTitle', 'required');
		$this->form_validation->set_rules('postContent', 'PostContent', 'required');

		// check for validation errors
		if ($this->form_validation->run() === FALSE) {

			$this->session->set_flashdata('postData_required', 'Update post title and content to upload post!');
			redirect('userProfile');

		} else {
			// load the TimelinePostManager model
			$this->load->model('TimelinePostManager', 'timelinePostManager');

			// get post data from form input
			$userId = $this->session->userData('userId');
			$postTitle = $this->input->post('postTitle');
			$postContent = $this->input->post('postContent');
			$slugValue = url_title($this->input->post('postTitle'));

			// create a new post
			$this->timelinePostManager->createTimelinePosts($userId, $postTitle, $postContent, $slugValue);

			// set alert messages
			$this->session->set_flashdata('addPost_passed', 'Post uploaded successfully!');

			redirect('userProfile');
		}
	}

	/**
	 * Function to remove a post
	 * @param $id
	 */
	public function removePost($id)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// delete a post using the post id
		$this->timelinePostManager->removeTimelinePost($id);

		// set alert message
		$this->session->set_flashdata('removePost_passed', 'Post removed!');

		redirect('userProfile');
	}

	/**
	 * Function to edit an existing post
	 * @param $slugValue
	 */
	public function editPost($slugValue)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// gets the post owner
		$userIdBySlugVal = $this->timelinePostManager->getUserIdBySlugValue($slugValue);

		// check post owner is the logged user
		if ($this->session->userdata('userId') != $userIdBySlugVal) {
			redirect('userProfile/' . $slugValue);
		}

		// get post data
		$postData = $this->timelinePostManager->getTimelineSinglePosts($slugValue);

		$bagOfDataVal = array(
			'listofPosts' => $postData
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('timelinePosts/editPost', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	/**
	 * Function to update an existing post
	 */
	public function updatePost()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// get post data from form
		$postTitle = $this->input->post('postTitle');
		$postContent = $this->input->post('postContent');
		$slugValue = url_title($this->input->post('postTitle'));
		$postId = $this->input->post('postId');

		// update post
		$this->timelinePostManager->updateTimelinePosts($postTitle, $postContent, $slugValue, $postId);

		// set alert messages
		$this->session->set_flashdata('updatePost_passed', 'Post updated successfully!');

		redirect('userProfile');
	}

	/**
	 * Function to get posts of logged user
	 * @return mixed
	 */
	public function getPosts()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// get timeline post of the logged user
		$postsData = $this->timelinePostManager->getTimelinePosts($this->session->userData('userId'));

		return $postsData;
	}

	/**
	 * Function to get posts of a public user
	 * @param $userId | Id of the user
	 * @return mixed
	 */
	public function getPostsByUserId($userId)
	{
		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// get posts of a public user profile
		$postData = $this->timelinePostManager->getTimelinePosts($userId);

		return $postData;
	}

	/**
	 * Function to get post using slug value
	 * @param null $slugValue
	 */
	public function getPostBySlugValue($slugValue = NULL)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}
		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// get single posts data
		$postData = $this->timelinePostManager->getTimelineSinglePosts($slugValue);

		$bagOfDataVal = array(
			'listofPosts' => $postData
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('timelinePosts/viewSinglePost', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	/**
	 * Function to get posts of a follower use
	 * @param $userId | Id of the follower
	 * @return mixed
	 */
	public function getFollowersPostsByUserId($userId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the TimelinePostManager model
		$this->load->model('TimelinePostManager', 'timelinePostManager');

		// get posts of the follower account
		$postData = $this->timelinePostManager->getFollowersTimelinePosts($userId);

		return $postData;
	}

	/**
	 * checks the status of the connection
	 * @param $userId | Id of the user
	 * @return mixed
	 */
	public function isFollowing($userId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		$userProfileDetails = $this->userConnectionManager->isFollowingStatus($userId);

		return $userProfileDetails;

	}

	/**
	 * Function to get a user accounts details
	 * @param $userId | Id of the user
	 * @return userProfileDetails | Account details
	 */
	public function getUserAccount($userId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');

		// get user account details
		$userProfileDetails = $this->userManager->getUserAccountDetails($userId);

		return $userProfileDetails;
	}

	/**
	 * Function to get public user profile details
	 * @param $userId | Id of the user
	 * @return mixed
	 */
	public function getPublicUserAccount($userId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');

		// get the public profile details
		$userProfileDetails = $this->userManager->getUserAccountDetails($userId);

		return $userProfileDetails;
	}

	/**
	 * Function to edit profile details
	 */
	public function editProfile()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// set userId to session
		$userId = $this->session->userdata('userId');

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');
		// load the GenreManager model
		$this->load->model('GenreManager', 'genreManager');

		// get profile data
		$profileData = $this->userManager->getUserAccountDetails($userId);
		// get genre data
		$genreData = $this->genreManager->getUserGenreDetails($userId);

		$bagOfDataVal = array(
			'userDetails' => $profileData,
			'genreDetails' => $genreData
		);

		// load the view for edit
		$this->load->view('templates/header');
		$this->load->view('users/editProfile', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	/**
	 * Function to update edited profile
	 */
	public function updateProfile()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// get values from form
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$favoriteGenres = $this->input->post('favoriteGenres');
		$displayPictureUrl = $this->input->post('displayPictureUrl');
		$userId = $this->session->userdata('userId');

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');
		// load the GenreManager model
		$this->load->model('GenreManager', 'genreManager');

		// update profile data
		$profileData = $this->userManager->updateProfileDetails($firstName, $lastName, $displayPictureUrl);
		// update genre data
		$genreData = $this->genreManager->updateGenreDetails($favoriteGenres, $userId);

		// set alert messages
		$this->session->set_flashdata('updateProfile_passed', 'Profile updated successfully!');

		redirect('userProfile');
	}

	/**
	 * Function to load the Timeline page with posts
	 */
	public function loadTimelinePage()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');

		// get the timeline page details
		$profileTimelineData = $this->userManager->getPublicProfileData($this->session->userdata('userId'));

		$bagOfDataVal = array(
			'listOfPosts' => $profileTimelineData
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('timelinePosts/viewPosts', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	/**
	 * Function to load the logged user profile page
	 */
	public function loadUserProfilePage()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');
		// load the GenreManager model
		$this->load->model('GenreManager', 'genreManager');

		// get profile data
		$profileUserData = $this->getUserAccount($this->session->userdata('userId'));
		$profilePostData = $this->getPostsByUserId($this->session->userdata('userId'));
		$profileGenreData = $this->genreManager->getUserGenreDetails($this->session->userdata('userId'));

		$bagOfDataVal = array(
			'userDetails' => $profileUserData,
			'listOfPosts' => $profilePostData,
			'listOfGenres' => $profileGenreData
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('users/userAccount', $bagOfDataVal);
		$this->load->view('timelinePosts/addPost');
		$this->load->view('timelinePosts/viewPosts', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	/**
	 * Function to load the public user profile page
	 */
	public function loadPublicUserProfilePage($userId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserManager model
		$this->load->model('UserManager', 'userManager');
		// load the GenreManager model
		$this->load->model('GenreManager', 'genreManager');

		// get profile data
		$profileUserData = $this->getUserAccount($userId);
		$profilePostData = $this->getPostsByUserId($userId);
		$profileGenreData = $this->genreManager->getUserGenreDetails($userId);
		$isFollowing = $this->isFollowing($userId);

		$bagOfDataVal = array(
			'userDetails' => $profileUserData,
			'listOfPosts' => $profilePostData,
			'listOfGenres' => $profileGenreData,
			'isFollowing' => $isFollowing
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('users/userAccountPublic', $bagOfDataVal);
		$this->load->view('timelinePosts/viewPosts', $bagOfDataVal);
		$this->load->view('templates/footer');
	}
}
