<?php

class UserContact extends CI_Controller
{
	public function contactCard()
	{

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$email = $this->input->post('email');
			$telephoneNo = $this->input->post('telephoneNo');
			$userId = $this->session->userData('userId');

			// load the UserContactManager model
			$this->load->model('UserContactManager', 'userContactManager');

			$contactData = $this->userContactManager->addContactDetails($firstName, $lastName, $email, $telephoneNo, $userId);
			echo json_encode($contactData);
		} elseif ($this->input->server('REQUEST_METHOD') == 'GET') {


			$contactId = $this->input->get('contactId');

			// load the UserContactManager model
			$this->load->model('UserContactManager', 'userContactManager');

			$contactData = $this->userContactManager->deleteContact($contactId);
			echo json_encode($contactData);
		}
	}

	public function updateContactCard()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$email = $this->input->post('email');
			$telephoneNo = $this->input->post('telephoneNo');
			$userId = $this->session->userData('userId');
			$contactId = $this->input->post('contactId');

			// load the UserContactManager model
			$this->load->model('UserContactManager', 'userContactManager');

			$contactData = $this->userContactManager->updateContactDetails($firstName, $lastName, $email, $telephoneNo, $userId, $contactId);
			echo json_encode($contactData);

		} elseif ($this->input->server('REQUEST_METHOD') == 'GET') {

			$contactId = $this->input->get('contactId');

			// load the UserContactManager model
			$this->load->model('UserContactManager', 'userContactManager');

			$editContactData = $this->userContactManager->getSingleContact($contactId);
			echo json_encode($editContactData);
		}

	}

	public function getContacts()
	{

		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		// get timeline post of the logged user
		$contactData = $this->userContactManager->getContactDetails($this->session->userData('userId'));

		return $contactData;
	}

	public function loadContact()
	{
		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		$contactData = $this->getContacts();

		$bagOfDataVal = array(
			'listOfContacts' => $contactData
		);

		// load the views
		$this->load->view('templates/header');
		$this->load->view('contacts/contactCard', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

}
