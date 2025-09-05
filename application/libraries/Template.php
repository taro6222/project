<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

require_once (APPPATH . 'libraries/Tplus/Tpl-dist.php');

/**
 * Template
 *
 * @package Taro Frameworks Project
 * @author CHUN CHANGHOON <chun.chang.hoon@gmail.com>
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class Template extends Tpl
{
	public $compile_check = true;
	public $compile_dir = '_compile';
	public $compile_ext = 'php';
	public $skin = '';
	public $notice = false;
	public $path_digest = true;

	public $prefilter = 'common';
	public $postfilter = 'removeTmpCode | arrangeSpace';
	public $permission = 0777;
	public $safe_mode = true;
	public $auto_constant = false;

	public $caching = false;
	public $cache_dir = '_cache';
	public $cache_expire = 3600;

	public $template_dir = '';

	public $CI;

	// --------------------------------------------------------------------

	/**
	 * Template::__construct()
	 *
	 * @return
	 */
	function __construct()
	{
		$this->CI = &get_instance();
		$this->compile_dir = 'var/_compile';
        if (!is_dir($this->compile_dir)) {
            mkdir($this->compile_dir, 0777);
        }

		$currentModule = $this->currentModule();

		$this->template_dir = $this->templateDirectory($currentModule);
		$file = $this->templateFile($currentModule);
		$this->define($currentModule, $file);
	}

	// --------------------------------------------------------------------

	function file( $data=false, $path='' )
	{
		$currentModule = $this->currentModule();
		$this->template_dir = $this->templateDirectory($currentModule);

		if (is_array($data)) {
			foreach ($data as $key => $var)
			{
				$fid  = ($key == 'this') ? $currentModule : $key;
				$file = ($var == 'this') ? $this->templateFile($currentModule) : $var;
				$this->define($fid, $file);
			}
		}
		else {
			$this->define($currentModule, $this->templateFile($currentModule));
		}
	}

	/**
	 * Template::view()
	 *
	 * @param mixed $template
	 * @param mixed $data
	 * @param bool $return
	 * @return
	 */
	function view($template, $data = array(), $return = FALSE)
	{
		foreach ($data as $key => $val)
		{
			$this->assign($key, $val);
		}

		if ($return == FALSE)
		{
			if (method_exists( $this->CI->output, 'set_output' ))
			{
				$CI->output->set_output( $this->fetch($template) );
			}
			else
			{
				$CI->output->final_output = $this->fetch($template);
			}
			return;
		}
		else
		{
			return $this->fetch($template);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Template::display()
	 *
	 * @param bool $defineName
	 * @return
	 */
	function display($defineName = false)
	{
		if (ENVIRONMENT != 'production') {
			$this->CI->output->enable_profiler(true);
		}

		if ($defineName) {
			$currentModule = $defineName;
		}
		else {
			$currentModule = $this->currentModule();
		}

		$currentModule = $this->currentModule();
		$mainContents = $this->fetch($currentModule);

		echo Modules::run('layout/frame', $mainContents);
	}

	// --------------------------------------------------------------------

	/**
	 * Template::adminDisplay()
	 *
	 * @return void
	 */
	function adminDisplay()
	{
		if (ENVIRONMENT != 'production') {
			$this->CI->output->enable_profiler(true);
		}

		$currentModule = $this->currentModule();
		$mainContents = $this->fetch($currentModule);

		echo Modules::run('backend/frame', $mainContents);
	}

	// --------------------------------------------------------------------

	/**
	 * Template::templateDirectory()
	 *
	 * @param mixed $currentModule
	 * @return
	 */
	function templateDirectory($currentModule)
	{
		//$MX = new MX_Controller();

		$theme = 'themes/default';
		if ( $this->CI->uri->segment(1) == 'backend' ) {
			$currentModule = 'backend';
			$theme = 'themes/backend';

		}
		else {
			//$theme = $MX->common->LoadTheme('site');
		}

		$ret = $theme;

		return $ret;
	}

	// --------------------------------------------------------------------

	/**
	 * Template::templateFile()
	 *
	 * @param mixed $currentModule
	 * @return
	 */
	function templateFile($currentModule)
	{
		if ($currentModule == $this->CI->router->fetch_class()) {
			$ret = $currentModule . '.' . $this->CI->router->fetch_method() . '.html';
		}
		else {
			$ret = $currentModule . '.' . $this->CI->router->fetch_class() . '.' . $this->CI->router->fetch_method() . '.html';
		}

		if ( $this->isAdminModule() ) {
			$ret = 'backend.' . $this->CI->router->fetch_method() . '.html';

			if ( $this->CI->uri->segment(2) != '' ) {
				$ret = $currentModule . '.' . $this->CI->router->fetch_method() . '.html';
			}
		}

		return $ret;
	}

	// --------------------------------------------------------------------

	/**
	 * Template::currentModule()
	 *
	 * @return
	 */
	function currentModule()
	{
		$module = ($this->CI->uri->segment(1) == '') ? $this->CI->uri->rsegment(1) : $this->CI->uri->segment(1);

		if ( $this->isAdminModule() ) {
			$module = 'backend';

			if ( $this->CI->uri->segment(2) != '' ) {
				$module = $this->CI->uri->segment(2);
			}
		}

		return $module;
	}

	// --------------------------------------------------------------------

	function isAdminModule()
	{
		$ret = false;
		if ( $this->CI->uri->segment(1) == 'admin' ) {
			$ret = true;
		}
		return $ret;
	}
}