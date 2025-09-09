<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{

	// --------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	public function index()
	{
		echo '-->user';
	}

	public function list()
	{

		$this->load->library('template');

		$data = [
			//'user_list' => '00000',
		];

		$this->template->display($data);
	}

}