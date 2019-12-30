<?php

require BASEPATH . 'libraries/chriskacerguis/Restserver/RestController.php';
require BASEPATH . 'libraries/chriskacerguis/Restserver/Format.php';


class ContactApi extends \chriskacerguis\RestServer\RestController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{

		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');
		}

		$contactData = $this->contact_get();

		$bagOfDataVal = array(
			'listOfContacts' => $contactData
		);
		$this->load->view('templates/header');
		$this->load->view('contacts/contactCard', $bagOfDataVal);
		$this->load->view('templates/footer');
	}

	public function contact_get($contactId)
	{

		// checks if a user is logged in
		if (!$this->session->userdata('loginStatus')) {
			$this->session->set_flashdata('login_required', 'Please Login first!');
			redirect('users/signin');

			if ($contactId) {
				$contactId = $this->input->get('contactId');

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get details of the contact to be edited
				$editContactData = $this->userContactManager->getSingleContact($contactId);

				echo json_encode($editContactData);
				return $editContactData;
			} else {

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get contact details of the logged user
				$contactData = $this->userContactManager->getContactDetails($this->session->userData('userId'));

				// echo json_encode($contactData);

				return $contactData;
			}
		}
	}

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

	public function contact_put()
	{
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
	}

}
