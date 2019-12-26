<?php

class UserModel extends CI_Model
{

	public $id = '';
	public $firstName = '';
	public $lastName = '';
	public $userName = '';
	public $email = '';
	public $password = null;
	public $displayPictureUrl = '';

	/**
	 * gets the id
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * sets the id
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * gets the firstName
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * sets the firstName
	 * @param string $firstName
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	/**
	 * gets the lastName
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * sets the lastName
	 * @param string $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * gets the userName
	 * @return string
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * sets the userName
	 * @param string $userName
	 */
	public function setUserName($userName)
	{
		$this->userName = $userName;
	}

	/**
	 * gets the email
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * sets the email
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * gets the password value
	 * @return null
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * sets the password value
	 * @param null $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * gets the displayPictureUrl
	 * @return string
	 */
	public function getDisplayPictureUrl()
	{
		if ($this->displayPictureUrl === '') {
			return 'https://www.linkkar.com/assets/default/images/default-user.png';
		} else {
			return $this->displayPictureUrl;
		}
	}

	/**
	 * sets the displayPictureUrl
	 * @param string $displayPictureUrl
	 */
	public function setDisplayPictureUrl($displayPictureUrl)
	{
		$this->displayPictureUrl = $displayPictureUrl;
	}

	/**
	 * Update profile data object
	 * @param $firstName
	 * @param $lastName
	 * @param $displayPictureUrl
	 */
	public function updateProfileData($firstName, $lastName, $displayPictureUrl)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->displayPictureUrl = $displayPictureUrl;
	}
}
