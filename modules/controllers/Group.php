<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MX_Controller
{

	// --------------------------------------------------------------------

	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	function index()
	{
		echo '-->user';
	}

	function list()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function info()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function permissions()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}



}