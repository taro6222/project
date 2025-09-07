<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		// Tplus 템플릿 시스템 사용
		require_once APPPATH . 'libraries/Tplus/Tpl.php';
		
		// 템플릿에 전달할 데이터
		$data = [
			'title' => 'Welcome to CodeIgniter',
			'elapsed_time' => $this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end'),
			'ci_version' => CI_VERSION,
			'environment' => ENVIRONMENT
		];
		
		// Tplus 템플릿 렌더링
		echo Tpl::get('default/welcome_message', $data);
	}
}
