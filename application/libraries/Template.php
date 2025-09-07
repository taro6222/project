<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

require_once (APPPATH . 'libraries/Tplus/Tpl.php');

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
	public $module;
	public $CI;

	protected static function config() {
		return array_merge(parent::config(), [
		   'HtmlRoot'			=>'./themes/',
		   'HtmlScriptRoot'	=>'./var/cache/',
		  ]);
   }
 

	// --------------------------------------------------------------------

	/**
	 * Template::__construct()
	 *
	 * @return
	 */
	function __construct()
	{
		$this->CI = &get_instance();


		$currentModule = $this->currentModule();

		//$this->template_dir = $this->templateDirectory($currentModule);
		//$file = $this->templateFile($currentModule);
		//$this->define($currentModule, $file);
	}

	public static function display($path=false, $data=[])
	{
		$page = Tpl::get($path, $data);
		$main = [
			'title'=>'News',
			'content'=>$page,
		];

		$source = Tpl::get('default/layout.frame.html', $main);

		$source = str_replace( "__assets", '/themes/default' . '/__assets',  $source );
		$source = str_replace( "__image", '/themes/default' . '/__image',  $source );
		$source = str_replace( "__style",  '/themes/default' . '/__style',  $source  );
		$source = str_replace( "__script", '/themes/default' . '/__script', $source  );
		$source = str_replace( "__common", '/themes/default' . '/__common', $source  );
		$source = str_replace( "__plugin", '/themes/default' . '/__plugin', $source  );
		$source = str_replace( "__media", '/themes/default' . '/__media', $source  );
		$source = str_replace( "__manager", '/themes/default' . '/__manager', $source  );

		echo $source;//$mainContents = $this->get($path, $data);
		//echo Modules::run('layout/frame', $mainContents);
	}




	function file( $data=false, $path='' )
	{
		$currentModule = $this->currentModule();
		$this->template_dir = $this->templateDirectory($currentModule);

		if (is_array($data)) {
			foreach ($data as $key => $var)
			{
				$fid  = ($key == 'this') ? $currentModule : $key;
				$file = ($var == 'this') ? $this->templateFile($currentModule) : $var;
				//$this->define($fid, $file);
			}
		}
		else {
			//$this->define($currentModule, $this->templateFile($currentModule));
		}
	}

	function display2($path=false, $data=[])
	{
		if (ENVIRONMENT != 'production') {
			$this->CI->output->enable_profiler(true);
		}

		if ($path) {
			$currentModule = $path;
		}
		else {
			$currentModule = $this->currentModule();
		}

		$currentModule = $this->currentModule();
		$mainContents = $this->get($currentModule, $data);

		echo Modules::run('layout/frame', $mainContents);
	}

	function assigns($keyOrArray, $val=null)
	{
			$tplus = Tpl::_();
			$tplus->assign($keyOrArray, $val=null);
	}

	/**
	 * Templa0te::view()
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
	public function currentModule()
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

	public function isAdminModule()
	{
		$ret = false;
		if ( $this->CI->uri->segment(1) == 'admin' ) {
			$ret = true;
		}
		return $ret;
	}
}