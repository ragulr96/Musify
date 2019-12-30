<?php

include_once 'UserContactModel.php';
include_once 'TagModel.php';

class UserContactManager extends CI_Model
{

	/**
	 * UserContactManager constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	public function updateContactData($firstName, $lastName, $email, $telephoneNo, $userId)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->telephoneNo = $telephoneNo;
		$this->userId = $userId;
	}

	public function getContactDetails($userId)
	{
		// active record query to get a user's contact details
		$getUserContactDetailsQuery = $this->db->get_where('user_contact', array('userId' => $userId));

		if ($getUserContactDetailsQuery->num_rows() > 0) {

			// assign returned value to UserModel object
			$fetchContactDetails = $getUserContactDetailsQuery->custom_result_object('UserContactModel');

			return $fetchContactDetails;
		}
	}

	public function addContactDetails($firstName, $lastName, $email, $telephoneNo, $userId)
	{
		// create new UserContact object
		$contact = new UserContactManager();

		// update contact object
		$contact->updateContactData($firstName, $lastName, $email, $telephoneNo, $userId);

		// active record query to create a new contact
		$addContactQuery = $this->db->insert('user_contact', $contact);

		$this->db->where('email', $email);
		$getContactDataQuery = $this->db->get('user_contact');

		// check for returned value
		if ($getContactDataQuery->num_rows() == 1) {

			$contactId = $getContactDataQuery->row(0)->contactId;

			// create new TagModel object
			$tagObject = new TagModel();

			// set contact tags to null on contact creation
			$tagObject->setContactTagsOnReg($contactId, NULL);

			// // active record query to insert tags
			$addTagQuery = $this->db->insert('tag', $tagObject);
		}

		return $addContactQuery;
	}

	public function deleteContact($contactId)
	{
		// active record query to remove a contact card
		$this->db->delete('user_contact', array('contactId' => $contactId));
	}

	public function getSingleContact($contactId)
	{
		$getUserContactDetailsQuery = $this->db->get_where('user_contact', array('contactId' => $contactId));

		if ($getUserContactDetailsQuery->result()) {

			$contactDetail = $getUserContactDetailsQuery->result();

			foreach ($contactDetail as $contact) {
				$contacts[$contact->contactId] = array($contact->userId, $contact->firstName, $contact->lastName, $contact->email, $contact->telephoneNo, $contact->displayPictureUrl);
			}
			return $contacts;
		}

	}

	public function updateContactDetails($contactId, $firstName, $lastName, $email, $telephoneNo)
	{
		$data = array(
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
			'telephoneNo' => $telephoneNo
		);

		// active record query to update profile details
		$this->db->where('contactId', $contactId);
		return $this->db->update('user_contact', $data);

	}

	public function getContactTagDetails($contactId)
	{
		// active record query to get tag detail
		$getContactTagDetailsQuery = $this->db->get_where('tag', array('contactId' => $contactId));

		// check for returned value
		if ($getContactTagDetailsQuery->num_rows() > 0) {

			// sets value to GenreModel
			$fetchTagDetails = $getContactTagDetailsQuery->custom_result_object('TagModel');
			print_r($fetchTagDetails);

			return $fetchTagDetails;
		}
	}

	public function updateTagDetails($contactTags, $contactId)
	{
		// get tag details
		$fetchTagDetails = $this->getContactTagDetails($contactId);

		$tagObj = $fetchTagDetails[0];

		// update genre details
		$tagObj->updateTagData($contactId, $contactTags);

		// active record query to update genre details
		$this->db->where('contactId', $contactId);
		return $this->db->update('tag', $tagObj);
	}
}
