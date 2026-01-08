<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ShopReport extends MX_Controller
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

	function products()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function sales()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function returns()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function orders()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}

	function shipping()
	{
		$this->load->library('template');
		//$this->template->assign('community_name', $community_name);
		$this->template->display();
	}





}