<?php

class UserConnection extends CI_Controller
{
	/**
	 * Function to get follower details
	 * @return getUserFollowersResult | Follower details
	 */
	public function getUserFollowers()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// get the userId from session
		$userId = $this->session->userData('userId');

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// call function to get follower connection details
		$getUserFollowersResult = $this->userConnectionManager->getFollowerUserConnections($userId);

		return $getUserFollowersResult;
	}

	/**
	 * Function to get followee details
	 * @return getUserFolloweeResult | Followee details
	 */
	public function getUserFollowee()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// get the userId from session
		$userId = $this->session->userData('userId');

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// call function to get followee connection details
		$getUserFolloweeResult = $this->userConnectionManager->getFolloweeUserConnections($userId);

		return $getUserFolloweeResult;
	}

	/**
	 * Function to get friend details
	 * @return getUserFriendsResult | Friends details
	 */
	public function getUserFriends()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// get the userId from session
		$userId = $this->session->userData('userId');

		// load the UserConnectionManager model
		$this->load->model('UserConnectionManager', 'userConnectionManager');

		// call function to get friends connection details
		$getUserFriendsResult = $this->userConnectionManager->getFriendsUserConnections($userId);

		return $getUserFriendsResult;

	}

	/**
	 * Function to get all connection related details
	 */
	public function getConnectionDetails()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load all connection results
		$getUserFollowersResult = $this->getUserFollowers();
		$getUserFolloweeResult = $this->getUserFollowee();
		$getUserFriendsResult = $this->getUserFriends();


		$bagOfDataVal = array(
			'listOfFollowers' => $getUserFollowersResult,
			'listOfFollowee' => $getUserFolloweeResult,
			'listOfFriends' => $getUserFriendsResult
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('userConnections/viewConnections', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

}
