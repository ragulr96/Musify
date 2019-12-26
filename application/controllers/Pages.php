<?php

class Pages extends CI_Controller{

	/**
	 * Function to load the inial page
	 * @param string $pageName | page name of the application
	 */
	public function view($pageName = 'signin'){
		if(!file_exists(APPPATH.'views/users/'.$pageName.'.php')){
			show_404();
		}
		$dataArray['pageTitle'] = ucfirst($pageName);

		$this->load->view('templates/header');
		$this->load->view('users/'.$pageName, $dataArray);
		$this->load->view('templates/footer');
	}
}
