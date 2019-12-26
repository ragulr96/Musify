<?php

include_once 'UserContactModel.php';
include_once 'UserContactModel.php';

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

		return $addContactQuery;
	}

	public function deleteContact($contactId)
	{
		// active record query to remove a contact card
		$this->db->delete('user_contact', array('contactId' => $contactId));
	}

	public function getSingleContact($contactId)
	{
//		// active record query to get a user's signle contact details
//		$getUserContactDetailsQuery = $this->db->get_where('user_contact', array('contactId' => $contactId));
//
//		if ($getUserContactDetailsQuery->num_rows() > 0) {
//
//			// assign returned value to UserModel object
//			$fetchContactDetails = $getUserContactDetailsQuery->custom_result_object('UserContactModel');
//
//			return $fetchContactDetails;
//		}

		$getUserContactDetailsQuery = $this->db->get_where('user_contact', array('contactId' => $contactId));

		if ($getUserContactDetailsQuery->result()) {

			$contactDetail = $getUserContactDetailsQuery->result();

			foreach ($contactDetail as $contact) {
				$contacts[$contact->contactId] = array($contact->userId, $contact->firstName, $contact->lastName, $contact->email, $contact->telephoneNo, $contact->displayPictureUrl);
			}
			return $contacts;
		}

	}

	public function updateContactDetails($firstName, $lastName, $email, $telephoneNo, $userId, $contactId) {

//		// get the userId from session
//		$userId = $this->session->userData('userId');
//
//		// get contact details
//		$fetchContactDetails = $this->getSingleContact($contactId);
//
//		$contactObj = $fetchContactDetails[0];
//
//		// update contact object
//		$contactObj->updateContactData($firstName, $lastName, $email, $telephoneNo);

		// active record query to update profile details
		$this->db->where('contactId', $contactId);
		$this->db->set('firstName', $firstName);
		$this->db->set('lastName', $lastName);
		$this->db->set('email', $email);
		$this->db->set('telephoneNo', $telephoneNo);
		return $this->db->update('user_contact');

	}
}
