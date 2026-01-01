<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends MX_Controller
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
		redirect('/admin');
	}

	function adminConfig()
	{
		$this->load->library('template');
		$this->template->adminDisplay();
	}

	// --------------------------------------------------------------------

	function getAdminConfigMenuJson()
	{
	}

	// --------------------------------------------------------------------

	function menu()
	{

		//관리자페이지 네비게이션
		$menuLoop = array();
		//$menuArray = $this->config->load('backend_menu', true);

		$this->load->model('config/configAdminModel', 'menu');
		$menuArray = $this->menu->getBackendMenu();
/*

		$i = 0;
		foreach($menuArray as $key => $value) {

			$menuLoop[] = array(
				'key'		=> $key,
				'name'		=> $value['name'],
				'link'		=> $value['link'],
				'icon'		=> $value['icon'],
				'label'		=> $value['label'],
			);
			if ($key != 'dashboard') {
				$subMenu = &$menuLoop[$i]['하위메뉴'];
				foreach($value['menu'] as $key2 => $val2) {
					$linkStr = explode('/', $val2['link']);
					$subMenu[] = array(
						'key'		=> $key2,
						'name'		=> $val2['name'],
						'link'		=> $val2['link'],
						'label'		=> $val2['label'],
					);
				}
			}
			$i++;
		}
*/
		$this->load->library('template');

		// 메뉴
		$this->template->assign('menuJSON', $menuArray);
		$this->template->assign('사이드메뉴', $menuLoop);

		$this->template->adminDisplay();
	}

	// --------------------------------------------------------------------

	function adminConfigMenuSave()
	{
		$this->load->model('config/configAdminModel', 'menu');
		$this->menu->saveBackendMenu( $this->input->post('jsonOutput') );
		print '{ "result": "ok" }';
	}

	// --------------------------------------------------------------------

	function general()
	{
		$this->load->library('template');
		$this->template->assign('test', 'oops');
		$this->template->adminDisplay();
	}

	// --------------------------------------------------------------------

	function writing()
	{
		$this->load->library('template');
		$this->template->assign('test', 'oops');
		$this->template->adminDisplay();
	}

	// --------------------------------------------------------------------

	function reading()
	{
		$this->load->library('template');
		$this->template->assign('test', 'oops');
		$this->template->adminDisplay();
	}

	// --------------------------------------------------------------------

	function media()
	{
		$this->load->library('template');
		$this->template->assign('test', 'oops');
		$this->template->adminDisplay();
	}

}
