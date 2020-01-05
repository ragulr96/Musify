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

	public function updateContactData($firstName, $lastName, $email, $telephoneNo, $displayPictureUrl, $userId)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->telephoneNo = $telephoneNo;
		$this->displayPictureUrl = $displayPictureUrl;
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

	public function addContactDetails($firstName, $lastName, $email, $telephoneNo, $displayPictureUrl, $userId)
	{
		// create new UserContact object
		$contact = new UserContactManager();

		// update contact object
		$contact->updateContactData($firstName, $lastName, $email, $telephoneNo, $displayPictureUrl, $userId);

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
		$this->db->delete('tag', array('contactId' => $contactId)); // delete tag table row
		$this->db->delete('user_contact', array('contactId' => $contactId));  // delete user_contact table row

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

	public function getContactDetailsByTag($tag)
	{

		// active record query to get contact and tag data
		$this->db->select('user_contact.contactId, user_contact.userId, user_contact.firstName, user_contact.lastName, user_contact.email, user_contact.telephoneNo, user_contact.displayPictureUrl, tag.contactId, tag.contactTags');
		$this->db->from('user_contact');

		// join tag and user_contact table
		$this->db->join('tag', 'tag.contactId = user_contact.contactId');

		// get matching results from selected tag
		$this->db->like('tag.contactTags', $tag);

		$contactTagDataQuery = $this->db->get();

		if ($contactTagDataQuery->num_rows() > 0) {

			// assign returned value to UserModel object
			$contactTagData = $contactTagDataQuery->custom_result_object('UserContactModel');

			return $contactTagData;
		}
	}

	public function getContactDetailsByLastName($lastName)
	{
		$arr = array();
		// active record query to get contact and tag data
		$this->db->select('user_contact.contactId, user_contact.userId, user_contact.firstName, user_contact.lastName, user_contact.email, user_contact.telephoneNo, user_contact.displayPictureUrl, tag.contactId, tag.contactTags');
		$this->db->from('user_contact');

		// join tag and user_contact table
		$this->db->join('tag', 'tag.contactId = user_contact.contactId');

		// get matching results from selected lastName
		$this->db->where('user_contact.lastName', $lastName);

		$contactLastNameDataQuery = $this->db->get();

		if ($contactLastNameDataQuery->num_rows() > 0) {

			// assign returned value to UserModel object
			$contactLastNameData = $contactLastNameDataQuery->custom_result_object('UserContactModel');

			return $contactLastNameData;
		}
	}

	public function getContactDetailsByTagNLastName($tag, $lastName)
	{

		// active record query to get contact and tag data
		$this->db->select('user_contact.contactId, user_contact.userId, user_contact.firstName, user_contact.lastName, user_contact.email, user_contact.telephoneNo, user_contact.displayPictureUrl, tag.contactId, tag.contactTags');
		$this->db->from('user_contact');

		// join tag and user_contact table
		$this->db->join('tag', 'tag.contactId = user_contact.contactId');

		// get matching results from selected tag
		$this->db->where('user_contact.lastName', $lastName);

		$this->db->like('tag.contactTags', $tag);

		$contactTagNLastNameDataQuery = $this->db->get();

		if ($contactTagNLastNameDataQuery->num_rows() > 0) {

			// assign returned value to UserModel object
			$contactTagNLastNameData = $contactTagNLastNameDataQuery->custom_result_object('UserContactModel');

			return $contactTagNLastNameData;
		}
	}

	public function updateContactDetails($contactId, $firstName, $lastName, $email, $telephoneNo, $displayPictureUrl)
	{
		$data = array(
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
			'telephoneNo' => $telephoneNo,
			'displayPictureUrl' => $displayPictureUrl
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
