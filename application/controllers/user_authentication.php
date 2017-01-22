<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//session_start();


class user_authentication extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_database');
		
    }   

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	// Show login page
	public function index() {
		$this->load->view('login_view');
	}



	public function login()
	{	
		$this->load->view('login_view');
	}

	public function login_check()
	{
		$account = $_POST['acct'];
		$password = $_POST['pswd'];

		$flag = $this->login_database->login($account, $password);//進入新資料庫

		if ($flag == 1) {
			redirect('/show_db_controller/show_db/', 'refresh');
		}
		else {
			redirect('/user_authentication/login/', 'refresh');

		}
		
	}



}
