<?php


class UserConnectionModel extends CI_Model
{
	public $userId;
	public $userFollowingId;

	/**
	 * gets the userId
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * sets the userId
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	/**
	 * gets the userFollowingId
	 * @return mixed
	 */
	public function getUserFollowingId()
	{
		return $this->userFollowingId;
	}

	/**
	 * sets the userFollowingId
	 * @param mixed $userFollowingId
	 */
	public function setUserFollowingId($userFollowingId)
	{
		$this->userFollowingId = $userFollowingId;
	}
}
