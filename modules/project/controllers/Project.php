<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Project extends MX_Controller
{

	// --------------------------------------------------------------------

	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	function index()
	{
		$this->load->helper('url');
		redirect('/project/list');
	}

	function list()
	{
		$this->load->library('template');
		//$this->template->assign('menuJSON', $menuArray);
		$this->template->display();
	}

}
