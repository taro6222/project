<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends MX_Controller
{

	// --------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function error()
	{
		$this->load->library('template');
		$this->template->adminDisplay();
	}

	public function index()
	{
		//* Template --
		//? Template --
		//! Template --
		//@ Template --
		//$this->load->library('validation');
		$this->load->library('template');
		$this->template->display();

		//echo $this->uri->uri_string();

		//$this->validation->name('user_email')->value($this->input->get('user_email'))->pattern('email')->required();
		//$this->validation->name('user_passwd')->value($this->input->get('user_passwd'))->required();
		//echo '====> ' . $this->validation->isSuccess();
	}

	public function frame( $mainContents )
	{
		$this->load->helper('current_url');
		$this->load->library('user_agent');
		//$this->load->library('ipinfo');
		$this->load->model('backend/logModel', 'logs');

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

		//
		$this->load->library('template');
		$this->template->module = 'backend';
		$this->template->define('backend', 'backend.frame.html');
		//
		$this->template->assign('CURRENT_LOCATION', '/'.$this->uri->uri_string() );
		$this->template->assign('CURRENT_ITEM_LOCATION', $this->uri->segment(2) . '/' . $this->uri->segment(3));
		$this->template->assign('MAIN_CONTENTS', $mainContents );
		//
		$this->template->assign('SERVER_PLATFORM', $this->db->version());
		$this->template->print_('backend');
	}

}