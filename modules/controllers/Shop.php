<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends MX_Controller
{

	// --------------------------------------------------------------------

	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	function index()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function config()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}







}