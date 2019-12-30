<?php

require BASEPATH . 'libraries/chriskacerguis/Restserver/RestController.php';
require BASEPATH . 'libraries/chriskacerguis/Restserver/Format.php';

class ContactApi extends \chriskacerguis\RestServer\RestController
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * function to load the initial page
	 */
	public function index_get()
	{

		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		// get contact data
		$contactData = $this->contact_get();

		$bagOfDataVal = array(
			'listOfContacts' => $contactData
		);

		$this->load->view('templates/header');
		$this->load->view('contacts/contactCard', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	/**
	 * function to get contact details
	 * @return mixed
	 */
	public function contact_get()
	{

		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');

		} else {

			$contactId = $this->uri->segment(3, false);

			if ($contactId === false) {

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get contact details of the logged user
				$contactData = $this->userContactManager->getContactDetails($this->session->userData('userId'));

				// echo json_encode($contactData);
				return $contactData;
			} else {

				$contactId = urldecode($contactId);

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get details of the contact to be edited
				$editContactData = $this->userContactManager->getSingleContact($contactId);

				echo json_encode($editContactData);
				return $editContactData;

			}
		}
	}

	/**
	 * function to add a new contact
	 */
	public function contact_post()
	{
		// input values
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$email = $this->input->post('email');
		$telephoneNo = $this->input->post('telephoneNo');
		$userId = $this->session->userData('userId');

		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		$contactData = $this->userContactManager->addContactDetails($firstName, $lastName, $email, $telephoneNo, $userId);
		echo json_encode($contactData);
	}

	/**
	 * function to update an existing contact
	 */
	public function contact_put()
	{
		$contactId = $this->uri->segment(3, false);
		$contactId = urldecode($contactId);


		$firstName = $this->put('firstName');
		$lastName = $this->put('lastName');
		$email = $this->put('email');
		$telephoneNo = $this->put('telephoneNo');

		$contactTags = $this->put('contactTags');

		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		// update contact data
		$contactData = $this->userContactManager->updateContactDetails($contactId, $firstName, $lastName, $email, $telephoneNo);

		// update tag data
		$tagData = $this->userContactManager->updateTagDetails($contactTags, $contactId);

		echo json_encode($contactData);
	}

	/**
	 * function to delete an existing contact
	 */
	public function contact_delete()
	{

		$contactId = $this->uri->segment(3, false);

		$contactId = urldecode($contactId);
		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		$contactData = $this->userContactManager->deleteContact($contactId);
		echo json_encode($contactData);
	}
}
