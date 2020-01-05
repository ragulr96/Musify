<?php

require BASEPATH . 'libraries/chriskacerguis/Restserver/RestController.php';
require BASEPATH . 'libraries/chriskacerguis/Restserver/Format.php';

class ContactApi extends \chriskacerguis\RestServer\RestController
{

	public function __construct()
	{
		parent::__construct();
	}

//	/**
//	 * function to load the initial page
//	 */
//	public function index_get()
//	{
//
//		// checks if a user is logged in
//		if (!$this->session->userdata('loginStatus')) {
//			$this->session->set_flashdata('login_required', 'Please Login first!');
//			redirect('users/signin');
//		}
//
//		// get contact data
//		$contactData = $this->contact_get();
//
//		$bagOfDataVal = array(
//			'listOfContacts' => $contactData
//		);
//
//		$this->load->view('templates/header');
//		$this->load->view('contacts/contactCard', $bagOfDataVal);
//		$this->load->view('templates/footer');
//	}

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

		$this->load->view('templates/header');
		$this->load->view('contacts/contactCardView');
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

//			$contactId = $this->uri->segment(3, false);
			$tag = $this->input->get('tag');
			$lastName = $this->input->get('lastName');

			if (!empty($tag) && !empty($lastName)) {

				$tag = urldecode($tag);
				$lastName = urldecode($lastName);

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get contact details by lastName and tag
				$contactDataByTagNLastName = $this->userContactManager->getContactDetailsByTagNLastName($tag, $lastName);

				echo json_encode($contactDataByTagNLastName);
				return $contactDataByTagNLastName;

			} elseif (!empty($lastName) && empty($tag)) {

				$lastName = urldecode($lastName);

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get contact details by lastName
				$contactDataByLastName = $this->userContactManager->getContactDetailsByLastName($lastName);

				echo json_encode($contactDataByLastName);
				return $contactDataByLastName;

			} elseif (!empty($tag) && empty($lastName)) {

				$tag = urldecode($tag);

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get contact details by tag
				$contactDataByTag = $this->userContactManager->getContactDetailsByTag($tag);

				echo json_encode($contactDataByTag);
				return $contactDataByTag;

			}  else {

				// load the UserContactManager model
				$this->load->model('UserContactManager', 'userContactManager');

				// get contact details of the logged user
				$contactData = $this->userContactManager->getContactDetails($this->session->userData('userId'));

				echo json_encode($contactData);
				return $contactData;
			}
		}
	}

	/**
	 * function to add a new contact
	 */
	public function contact_post()
	{
		// input values
		$firstName = $this->post('firstName');
		$lastName = $this->post('lastName');
		$email = $this->post('email');
		$telephoneNo = $this->post('telephoneNo');
		$displayPictureUrl = "https://www.linkkar.com/assets/default/images/default-user.png";
		$userId = $this->session->userData('userId');

		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		$contactData = $this->userContactManager->addContactDetails($firstName, $lastName, $email, $telephoneNo, $displayPictureUrl, $userId);
		echo json_encode($contactData);
	}

	/**
	 * function to update an existing contact
	 */
	public function contact_put()
	{
//		$contactId = $this->uri->segment(3, false);
//		$contactId = urldecode($contactId);

		$firstName = $this->put('firstName');
		$lastName = $this->put('lastName');
		$email = $this->put('email');
		$telephoneNo = $this->put('telephoneNo');
		$displayPictureUrl = $this->put('displayPictureUrl');
		$contactId = $this->put('contactId');

		$contactTags = $this->put('contactTags');

		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		// update contact data
		$contactData = $this->userContactManager->updateContactDetails($contactId, $firstName, $lastName, $email, $telephoneNo, $displayPictureUrl);

		// update tag data
		$tagData = $this->userContactManager->updateTagDetails($contactTags, $contactId);

		echo json_encode($contactData);
		echo json_encode($tagData);
	}

	/**
	 * function to delete an existing contact
	 */
	public function contact_delete()
	{
		header('Content-type: application/json');
		$contactId = $this->uri->segment(3);

		$contactId = urldecode($contactId);
		// load the UserContactManager model
		$this->load->model('UserContactManager', 'userContactManager');

		$contactData = $this->userContactManager->deleteContact($contactId);
		echo json_encode($contactData);
	}
}
