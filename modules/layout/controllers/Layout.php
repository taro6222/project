<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	/**
	 * index
	 *
	 * @return void
	 */
	function index()
	{
		echo memory_get_usage();
		//echo date("Y-m-d", strtotime(date("Y-m-d")." -2 day"));
		$this->load->library('auth');

		//Template -------------------------------------------
		$this->load->library('template');
		$this->template->module = 'index';
		$data = [
			//'IS_LOGON', $this->auth->loggedin()
		];
		$this->template->display('default/layout.index.html', $data);
	}


	/**
	 * frame
	 *
	 * @param [type] $mainContents
	 * @return void
	 */
	function frame( $mainContents )
	{

		$this->load->library('template');
		$this->template->module = 'layout';

		$data = [
			'MAIN_CONTENTS', $mainContents,
		];

		$this->template->display('default/layout.frame.html', $data);
	}


	// --------------------------------------------------------------------

	function recently_image()
	{
		$imageKey = ( $this->uri->segment(3) != '' ) ? $this->uri->segment(3) : 0;

		$gifFolder = "var/cache/" . substr($imageKey, 0, 1);
		$gifFile = $gifFolder . "/" . $imageKey . ".gif";

		header('Content-Type: image/gif');
		readfile($gifFile);
	}





}
