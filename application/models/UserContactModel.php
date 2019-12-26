<?php

class UserContactModel extends CI_Model
{

	public $contactId;
	public $userId;
	public $firstName = '';
	public $lastName = '';
	public $email = '';
	public $telephoneNo;
	public $displayPictureUrl = '';

	/**
	 * @return mixed
	 */
	public function getContactId()
	{
		return $this->contactId;
	}

	/**
	 * @param mixed $contactId
	 */
	public function setContactId($contactId)
	{
		$this->contactId = $contactId;
	}

	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getTelephoneNo()
	{
		return $this->telephoneNo;
	}

	/**
	 * @param mixed $telephoneNo
	 */
	public function setTelephoneNo($telephoneNo)
	{
		$this->telephoneNo = $telephoneNo;
	}

	/**
	 * @return string
	 */
	public function getDisplayPictureUrl()
	{
		return $this->displayPictureUrl;
	}

	/**
	 * @param string $displayPictureUrl
	 */
	public function setDisplayPictureUrl($displayPictureUrl)
	{
		$this->displayPictureUrl = $displayPictureUrl;
	}

	public function updateContactData($firstName, $lastName, $email, $telephoneNo)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->telephoneNo = $telephoneNo;
	}
}
