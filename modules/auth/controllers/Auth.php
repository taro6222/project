<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		echo "hello manager..............";
		exit;
	}


	/**
	 * login display function
	 *
	 * @return void
	 */
	function login()
	{
		//$this->load->library('authentication');
		//echo $this->authentication->passwd_encode( 'pass1122' );

		//Template -------------------------------------------
		$this->load->library('template');
		$this->template->module = 'auth';
		$this->template->file();
		$this->template->define('auth', 'auth.login.html');
		//$this->template->assign('CONTENTS_LISTS', $newPostArray);
		$this->template->print_('auth');
		exit;
	}


	function logon()
	{
		//라이브러리
		$this->load->helper('url');
		$this->load->library('authentication');
		//auth model
		$this->load->model('auth/authModel', 'authModel');

		//$hash = $this->authentication->passwd_encode( $this->input->post('user_passwd') );
		//echo $hash;

		$ret = $this->authModel->userCheck( $this->input->post('user_email') );

		if ( $this->authentication->password_check( $this->input->post('user_passwd'), $ret->user_passwd ) ) {
			$this->authentication->login($ret->user_key, $ret->user_email, $ret->user_name, $ret->user_adult, $ret->user_admin);
			$this->authModel->userLogonUpdate($ret->user_key);
			print 'ok';
		}
		//echo $this->authentication->userid();
		exit;
	}


	function logout()
	{
		//라이브러리
		$this->load->helper('url');
		$this->load->library('authentication');

		$this->authentication->logout();

		redirect('/vod/list/movie');
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */