<?php

include_once 'UserModel.php';
include_once 'TimelinePostModel.php';
include_once 'GenreModel.php';

class UserManager extends CI_Model
{
	/**
	 * UserManager constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Update user object
	 * @param $firstName
	 * @param $lastName
	 * @param $userName
	 * @param $email
	 * @param $password
	 */
	public function updateUserData($firstName, $lastName, $userName, $email, $password)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->userName = $userName;
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Function to regiter a new user
	 * @param $firstName
	 * @param $lastName
	 * @param $userName
	 * @param $email
	 * @param $encryptedPassword
	 */
	public function registerUser($firstName, $lastName, $userName, $email, $encryptedPassword)
	{
		// create new UserManger object
		$user = new UserManager();

		// update user object
		$user->updateUserData($firstName, $lastName, $userName, $email, $encryptedPassword);

		// active record query to register a new user
		$addUserQuery = $this->db->insert('user_account', $user);
		$this->db->where('userName', $userName);
		$getUserDataQuery = $this->db->get('user_account');

		// check for returned value
		if ($getUserDataQuery->num_rows() == 1) {

			$userId = $getUserDataQuery->row(0)->id;

			// create new GenreModel object
			$genreObject = new GenreModel();
			// set favorite genres to null on registration
			$genreObject->setFavoriteGenresOnReg($userId, NULL);

			// // active record query to insert genres
			$addGenreQuery = $this->db->insert('genre', $genreObject);
		}

	}

	/**
	 * Function to verify user on login
	 * @param $userName
	 * @param $password
	 * @return bool
	 */
	public function verifyUser($userName, $password)
	{
		// active record query to validate login
		$this->db->where('userName', $userName);

		$verifyUserQuery = $this->db->get('user_account')->row();

		return $verifyUserQuery ? password_verify($password, $verifyUserQuery->password) : false;
	}

	/**
	 * Function to get userId using userName
	 * @param $userName
	 * @return mixed
	 */
	public function getUserAccountId($userName)
	{
		// active record query to ger account id from username
		$fetchedUserId = $this->db->get_where('user_account', array('userName' => $userName));

		if ($fetchedUserId->num_rows() > 0) {
			return $fetchedUserId->row(0)->id;
		}
	}

	/**
	 * Function to get favorite genres of the user
	 * @param $userId
	 * @return mixed
	 */
	public function getUserGenreDetails($userId)
	{
		// active record query to get genre details of a user
		$getUserGenreDetailsQuery = $this->db->get_where('genre', array('userId' => $userId));

		// check for returned value
		if ($getUserGenreDetailsQuery->num_rows() != 1) {

			// assign return value GenreModel object
			$fetchAccountDetails = $getUserGenreDetailsQuery->custom_result_object('GenreModel');

			return $fetchAccountDetails;
		}
	}

	/**
	 * Function to get account details of the user
	 * @param $userId
	 * @return mixed
	 */
	public function getUserAccountDetails($userId)
	{
		// active record query to get a user's account details
		$getUserAccountDetailsQuery = $this->db->get_where('user_account', array('id' => $userId));

		// assign returned value to UserModel object
		$fetchAccountDetails = $getUserAccountDetailsQuery->custom_result_object('UserModel');

		return $fetchAccountDetails;
	}

	/**
	 * Function to update a user profile
	 * @param $firstName
	 * @param $lastName
	 * @param $displayPictureUrl
	 * @return mixed
	 */
	public function updateProfileDetails($firstName, $lastName, $displayPictureUrl)
	{
		// get the userId from session
		$userId = $this->session->userData('userId');

		// get account details
		$fetchAccountDetails = $this->getUserAccountDetails($userId);

		$profileObj = $fetchAccountDetails[0];

		// update profile object
		$profileObj->updateProfileData($firstName, $lastName, $displayPictureUrl);

		// active record query to update profile details
		$this->db->where('id', $userId);
		return $this->db->update('user_account', $profileObj);

	}

	/**
	 * Function to search user from genres
	 * @param $userId
	 * @param $genreSelected
	 * @return array
	 */
	public function getSearchUserProfile($userId, $genreSelected)
	{
		// array of following users
		$listOfFollowingUser = array();
		// array of not following users
		$listOfNotFollowingUser = array();
		// genre object
		$genreObject = null;

		// check for existing favorite genres
		if ($genreSelected !== null) {

			// active record query to get user and genre data
			$this->db->select('user_account.id, user_account.firstName, user_account.lastName, genre.userId, genre.favoriteGenres');
			$this->db->from('user_account');

			// exclude current user
			$this->db->where_not_in('user_account.id', $userId);

			// join genre and user_account table
			$this->db->join('genre', 'genre.userId = user_account.id');

			//get matching results from selected genre
			$this->db->like('genre.favoriteGenres', $genreSelected);

			$genreData = $this->db->get();

			// check for returned value
			if ($genreData->num_rows() > 0) {

				// assign returned value to UserModel object
				$genreObject = $genreData->custom_result_object('UserModel');

				// active record query to get following user data
				$this->db->select('user_account.id, user_account.firstName, user_account.lastName, user_connection.userFollowingId');
				$this->db->from('user_connection');
				$this->db->where('user_connection.userId', $userId);
				$this->db->join('user_account', 'user_account.id = user_connection.userFollowingId');
				$followerData = $this->db->get();

				// check for returned value
				if ($followerData->num_rows() > 0) {

					// assign returned follower data to UserModel object
					$followerObject = $followerData->custom_result_object('UserModel');

					// initialise follower object array
					$followObjectArray = array();

					foreach ($followerObject as $follower) {

						// push returned values to follower object array
						array_push($followObjectArray, $follower->getId());
					}


					foreach ($genreObject as $genre) {

						// check for users with selected genre
						if (in_array($genre->getId(), $followObjectArray)) {
							$listOfFollowingUser[$genre->getId()] = $genre->getFirstName() . ' ' . $genre->getLastName();
						} else {
							$listOfNotFollowingUser[$genre->getId()] = $genre->getFirstName() . ' ' . $genre->getLastName();
						}
					}
				}
			}
		}
		return array($listOfFollowingUser, $listOfNotFollowingUser, $genreObject);
	}

	/**
	 * Function to get public profile details
	 * @param $userId
	 * @return array|null
	 */
	public function getPublicProfileData($userId)
	{

		// active record query to get posts of logged user
		$this->db->select('user_post.id, user_post.postTitle, user_post.slugValue, user_post.postContent, user_account.id, user_account.displayPictureUrl, user_account.firstName, user_account.lastName, user_post.createdTime');
		$this->db->from('user_post');
		$this->db->join('user_account', 'user_account.id = user_post.userId');
		$this->db->where('user_account.id', $userId);
		$this->db->order_by('user_post.createdTime', 'desc');
		$userResult = $this->db->get();

		$ownUserPosts = array();

		// check for returned value
		if ($userResult->num_rows() > 0) {
			$ownUserPosts = $userResult->result();
		}

		// active record query to get posts of follower user
		$this->db->select('user_post.id, user_post.postTitle, user_post.slugValue, user_post.postContent, user_account.id, user_account.displayPictureUrl, user_account.firstName, user_account.lastName, user_post.createdTime');
		$this->db->from('user_post');
		$this->db->join('user_connection', 'user_post.userId = user_connection.userFollowingId');
		$this->db->join('user_account', 'user_connection.userFollowingId = user_account.id');
		$this->db->where("user_connection.userId = $userId");
		$this->db->order_by('user_post.createdTime', 'desc');
		$followerResult = $this->db->get();

		$followerPosts = array();

		// check for returned value
		if ($followerResult->num_rows() > 0) {
			$followerPosts = $followerResult->result();
		}

		// check for post count and differentiate post by owners
		if (count($ownUserPosts) != 0 AND count($followerPosts) == 0) {
			return $ownUserPosts;
		} elseif (count($ownUserPosts) == 0 AND count($followerPosts) != 0) {
			return $followerPosts;
		} elseif (count($ownUserPosts) != 0 AND count($followerPosts) != 0) {
			$finalPosts = array_merge($ownUserPosts, $followerPosts);

			// order post by createdTime
			usort($finalPosts, function ($u, $f) {
				return strtotime($f->createdTime) - strtotime($u->createdTime);
			});
			return $finalPosts;
		} else {
			return null;
		}
	}

	/**
	 * Function to validate existing username
	 * @param $userName
	 * @return bool
	 */
	public function validate_existing_username($userName)
	{
		// active record query to validate existing username
		$validateUsernameQuery = $this->db->get_where('user_account', array('userName' => $userName));

		if (empty($validateUsernameQuery->row_array())) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Function to validate existing username
	 * @param $email
	 * @return bool
	 */
	public function validate_existing_email($email)
	{
		// active record query to validate existing email
		$validateEmailQuery = $this->db->get_where('user_account', array('email' => $email));

		if (empty($validateEmailQuery->row_array())) {
			return true;
		} else {
			return false;
		}
	}
}
