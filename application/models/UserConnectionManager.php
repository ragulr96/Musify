<?php

include_once 'UserConnectionModel.php';

class UserConnectionManager extends CI_Model
{
	/**
	 * UserConnectionManager constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Update user connection object
	 * @param $userId
	 * @param $userFollowingId
	 */
	public function updateUserConnectionData($userId, $userFollowingId)
	{
		$this->userId = $userId;
		$this->userFollowingId = $userFollowingId;
	}

	/**
	 * Function to add a new user connection
	 * @param $userId
	 * @param $userFollowingId
	 * @return mixed
	 */
	public function addNewUserConnection($userId, $userFollowingId)
	{
		// create new new UserConnectionManger object
		$userConnection = new UserConnectionManager();

		// update object
		$userConnection->updateUserConnectionData($userId, $userFollowingId);

		// active record query to insert new connection
		return $this->db->insert('user_connection', $userConnection);
	}

	/**
	 * Function to remove an exisitng connection
	 * @param $userId
	 * @param $userFollowingId
	 * @return mixed
	 */
	public function removeUserConnection($userId, $userFollowingId)
	{
		// active record query to delete an connection
		return $this->db->delete('user_connection', array('userId' => $userId, 'userFollowingId' => $userFollowingId));
	}

	/**
	 * Funciton to get followers of a user
	 * @param $userId
	 * @return mixed
	 */
	public function getFollowerUserConnections($userId)
	{
		// active record query to get follower connection details
		$this->db->select('user_connection.userId, user_connection.userFollowingId, user_account.id, user_account.firstName, user_account.lastName, user_account.displayPictureUrl');
		$this->db->from('user_connection');
		$this->db->where('user_connection.userFollowingId', $userId);
		$this->db->join('user_account', 'user_account.id = user_connection.userId');
		$followerData = $this->db->get();

		// checks for returned value
		if ($followerData->num_rows() > 0) {

			// assign the returned value to UserModel object
			$fetchFollowerDetails = $followerData->custom_result_object('UserModel');
			return $fetchFollowerDetails;
		}
	}

	/**
	 * Function to get followee of a user
	 * @param $userId
	 * @return mixed
	 */
	public function getFolloweeUserConnections($userId)
	{
		// active record query to get followee connection details
		$this->db->select('user_connection.userId, user_connection.userFollowingId, user_account.id, user_account.firstName, user_account.lastName, user_account.displayPictureUrl');
		$this->db->from('user_connection');
		$this->db->where('user_connection.userId', $userId);
		$this->db->join('user_account', 'user_account.id = user_connection.userFollowingId');
		$followeeData = $this->db->get();

		// check for returned value
		if ($followeeData->num_rows() > 0) {

			// assign returned value to UserModel object
			$fetchFolloweeDetails = $followeeData->custom_result_object('UserModel');
			return $fetchFolloweeDetails;
		}
	}

	/**
	 * Function to get friends of a user
	 * @param $userId
	 * @return mixed
	 */
	public function getFriendsUserConnections($userId)
	{
		// active record query to get friends details
		$this->db->select('a.userFollowingId, u.displayPictureUrl, u.id, u.firstName, u.lastName, u.displayPictureUrl');
		$this->db->from('user_connection a');
		$this->db->join('user_connection b', 'a.userId = b.userFollowingId AND b.userId = a.userFollowingId');
		$this->db->join('user_account u', 'u.id = a.userFollowingId');
		$this->db->where('a.userId', $userId);
		$friendsData = $this->db->get();

		// check for returned value
		if ($friendsData->num_rows() > 0) {

			// assign returned value to User Model object
			$fetchFriendsDetails = $friendsData->custom_result_object('UserModel');
			return $fetchFriendsDetails;
		}
	}

	/**
	 * Function to get connection status
	 * @param $userId
	 * @return bool
	 */
	public function isFollowingStatus($userId)
	{
		// active record query to get the connection status
		$status = $this->db->get_where('user_connection', array('userId' => $this->session->userdata('userId'), 'userFollowingId' => $userId));

		// check for returned value
		if ($status->num_rows() > 0) {
			// true if following
			return true;
		}
		else {
			return false;
		}
	}
}
