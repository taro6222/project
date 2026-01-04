<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	/**
	 * index layout
	 *
	 * @return void
	 */
	function index()
	{
		//echo date("Y-m-d", strtotime(date("Y-m-d")." -2 day"));
		$this->load->library('auth');

		//Template -------------------------------------------
		$this->load->library('template');

		$data = [
			//'IS_LOGON', $this->auth->loggedin()
		];
		$this->template->display($data);
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

		$data = [
			"content" => $mainContents,
			"title" => "ok",
		];

		$this->template->framePrint($data);
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
