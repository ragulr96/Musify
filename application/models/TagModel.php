<?php

class TagModel extends CI_Model
{

	public $contactId;
	public $contactTags = '';

	/**
	 * gets the contactId
	 * @return mixed
	 */
	public function getContactId()
	{
		return $this->contactId;
	}

	/**
	 * sets the contactId
	 * @param mixed $contactId
	 */
	public function setContactId($contactId)
	{
		$this->contactId = $contactId;
	}

	/**
	 * gets the contactTags
	 * @return string
	 */
	public function getContactTags()
	{
		return $this->contactTags;
	}

	/**
	 * sets the contactTags
	 * @param string $contactTags
	 */
	public function setContactTags($contactTags)
	{
		$this->contactTags = $contactTags;
	}

	/**
	 * Function to set contact tag details on contact creation
	 * @param $contactId
	 * @param $contactTags
	 */
	public function setContactTagsOnReg($contactId,$contactTags)
	{
		$this->contactId = $contactId;
		$this->contactTags = $contactTags;
	}

	/**
	 * Function to update contact tag data object
	 * @param $contactId
	 * @param $contactTags
	 */
	public function updateTagData($contactId,$contactTags)
	{
		$this->contactId = $contactId;
		$this->contactTags = implode(',', $contactTags);
	}

}
