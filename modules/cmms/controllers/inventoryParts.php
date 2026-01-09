<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class InventoryParts extends MX_Controller
{

	// --------------------------------------------------------------------

	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	function index()
	{
		//라이브러리
		$this->load->helper('url');
		redirect('/cmms/inventoryParts/list');
	}

	function list()
	{
		//Template -------------------------------------------
		$this->load->library('template');

		$data = [
			//'IS_LOGON', $this->auth->loggedin()
		];
		$this->template->display($data);
	}

	function card()
	{
		//Template -------------------------------------------
		$this->load->library('template');

		$data = [
			//'IS_LOGON', $this->auth->loggedin()
		];
		$this->template->display($data);
	}







}