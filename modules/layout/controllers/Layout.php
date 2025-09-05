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
		//echo date("Y-m-d", strtotime(date("Y-m-d")." -2 day"));
		$this->load->library('auth');

		//Template -------------------------------------------
		$this->load->library('template');
		$this->template->file();


		$this->template->assign('IS_LOGON', $this->auth->loggedin());

		$this->template->display();
	}


	/**
	 * frame
	 *
	 * @param [type] $mainContents
	 * @return void
	 */
	function frame( $mainContents )
	{
		$this->load->library('common');
		$this->load->library('auth', 'auth');
		$this->load->helper('current_url');
		$this->load->library('user_agent');
		//$this->load->library('ipinfo');
		$this->load->model('layout/logModel', 'logs');

		$this->ipinfo = json_decode(file_get_contents("http://ipinfo.io/")); // 받음

		$data = array(
			'user_key' => $this->session->userdata('user_key'),
			'log_uri' => $_SERVER['REQUEST_URI'],
			'log_source_ip' => $this->ipinfo->ip,
			'log_country ' => $this->ipinfo->country,
			'log_region ' => $this->ipinfo->region,
			'log_city ' => $this->ipinfo->city,
			'log_loc ' => $this->ipinfo->loc,
			'log_timezone ' => $this->ipinfo->timezone,
			'log_browser ' => $this->agent->browser(),
			'log_browser_version ' => $this->agent->version(),
			'log_mobile ' => ($this->agent->is_mobile()) ? $this->agent->mobile() : null,
			'log_robot ' => ($this->agent->is_robot()) ? $this->agent->robot() : null,
			'log_platform ' => $this->agent->platform(),
			'log_ip' => $_SERVER['REMOTE_ADDR'],
			'log_referrer' => ($this->agent->is_referral()) ? $this->agent->referrer() : null,
			'log_agent' => $this->agent->agent_string(),
			'log_action' => null,
			'log_datetime ' => date('Y-m-d H:i:s'),
		);
		$this->logs->add($data);

		//인증처리
		if (!$this->auth->loggedin()) {
			//redirect('/auth/login');
		}
		else if ( !$this->auth->isadmin() ) {
			//redirect('/vod/list/movie');
		}

		$this->load->library('template');
		$this->template->file();
		$this->template->module = 'layout';
		$this->template->define('layout', 'layout.frame.html');

		$this->template->assign('IS_MOBILE', $this->common->mobileCheck());
		$this->template->assign('IS_ADULT', $this->auth->isadult());
		$this->template->assign('IS_ADMIN', $this->auth->isadmin());
		$this->template->assign('IS_LOGON', $this->auth->loggedin());

		$this->template->assign('CURRENT_LOCATION', '/'.$this->uri->uri_string() );
		$this->template->assign('CURRENT_ITEM_LOCATION', $this->uri->segment(1) . '/' . $this->uri->segment(2));

		$this->template->assign( 'MAIN_CONTENTS', $mainContents );

		$this->template->assign('SERVER_PLATFORM', $this->db->version());

		$this->template->print_('layout');
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
