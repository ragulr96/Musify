<?php

class  SearchUser extends CI_Controller
{
	/**
	 * SearchUser constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		// loads the database
		$this->load->database();
	}

	/**
	 * Function to ge the user profile details
	 */
	public function getUserProfile()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required','Please Login first!');
			redirect('users/signin');
		}

		// set genre input to session
		$this->session->genre = $this->input->post('searchUser');
		$genreSelected = $this->session->genre;

		// get the userId from session
		$userId = $this->session->userData('userId');

		// loads the UserManager model
		$this->load->model('UserManager', 'userManager');

		// callback profile result from user manager
		$getUserProfileResult = $this->userManager->getSearchUserProfile($userId, $genreSelected);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('search/searchUser', array('output' => $getUserProfileResult));
		$this->load->view('templates/footer');
	}

	/**
	 * Function to create a new user connection
	 * @param $userFollowingId | Id of the user to be followed
	 */
	public function addConnection($userFollowingId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required','Please Login first!');
			redirect('users/signin');
		}

		// get the userId from session
		$userId = $this->session->userdata('userId');

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// call function to add a new connection
		$this->userConnectionManager->addNewUserConnection($userId, $userFollowingId);

		// set alert message
		$this->session->set_flashdata('follow_passed','User followed successfully!');

		redirect('search');
	}

	/**
	 * Function to remove a user connection
	 * @param $userFollowingId | Id of the user to be unFollowed
	 */
	public function deleteConnection($userFollowingId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required','Please Login first!');
			redirect('users/signin');
		}

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// get the userId from session
		$userId = $this->session->userdata('userId');

		// call function to remove an existing connection
		$this->userConnectionManager->removeUserConnection($userId, $userFollowingId);

		// set alert message
		$this->session->set_flashdata('unfollow_passed','User Unfollowed!');

		redirect('search');
	}

	/**
	 * Function to create a new user connection from profile view
	 * @param $userFollowingId | Id of the user to be followed
	 */
	public function addConnectionFromProfile($userFollowingId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required','Please Login first!');
			redirect('users/signin');
		}

		// get the userId from session
		$userId = $this->session->userdata('userId');

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// call function to add a new connection from profile view
		$this->userConnectionManager->addNewUserConnection($userId, $userFollowingId);

		// set alert message
		$this->session->set_flashdata('follow_passed','User followed successfully!');

		redirect('connection');
	}

	/**
	 * Function to remove user connection from profile view
	 * @param $userFollowingId | Id of the user to be unFollowed
	 */
	public function deleteConnectionFromProfile($userFollowingId)
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required','Please Login first!');
			redirect('users/signin');
		}

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// get the userId from session
		$userId = $this->session->userdata('userId');

		// call function to remove an existing connection from profile view
		$this->userConnectionManager->removeUserConnection($userId, $userFollowingId);

		// set alert message
		$this->session->set_flashdata('unfollow_passed','User Unfollowed!');

		redirect('connection');
	}
}
