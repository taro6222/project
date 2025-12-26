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
	private $config;
	public $module;
	public $CI;

	/**
	 * Template::__construct()
	 *
	 * @return
	 */
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->config = self::config();

		$currentModule = $this->currentModule();

		//$this->template_dir = $this->templateDirectory($currentModule);
		//$file = $this->templateFile($currentModule);
		//$this->define($currentModule, $file);
	}

	protected static function config() {
		return array_merge(parent::config(), [
		'HtmlRoot'			=> './themes/', //$this->config['HtmlRoot']
		'HtmlScriptRoot'	=> './var/cache/',
		]);
	}

	public function display($data=[])
	{
		if ($this->isAdminModule()) {
			$frame_file = 'backend.frame.html';
		}
		else {
			$frame_file = 'layout.frame.html';
		}

		//echo $this->currentModule();+
		$path = $this->templateFile($this->currentModule());

		$page = Tpl::get($path, $data);
		$main = [
			'content'=>$page,
		];

		$source = Tpl::get($this->templateDirectory() . '/'. $frame_file, $main);

		$source = str_replace( "__assets", '/themes/' . $this->templateDirectory() . '/__assets', $source );
		$source = str_replace( "__vendors", '/themes/' . $this->templateDirectory() . '/__vendors', $source );
		$source = str_replace( "__image",  '/themes/' . $this->templateDirectory() . '/__image',  $source );
		$source = str_replace( "__style",  '/themes/' . $this->templateDirectory() . '/__style',  $source );
		$source = str_replace( "__script", '/themes/' . $this->templateDirectory() . '/__script', $source );
		$source = str_replace( "__common", '/themes/' . $this->templateDirectory() . '/__common', $source );
		$source = str_replace( "__plugin", '/themes/' . $this->templateDirectory() . '/__plugin', $source );
		$source = str_replace( "__media",  '/themes/' . $this->templateDirectory() . '/__media',  $source );
		$source = str_replace( "__manager",'/themes/' . $this->templateDirectory() . '/__manager',$source );

		echo $source;//$mainContents = $this->get($path, $data);
		//echo Modules::run('backend/'.$frame_file, $mainContents);
	}

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
				$module = $module . '/' . $this->CI->uri->segment(2);
			}
		}

		return $module;
	}

	/**
	 * Template::templateFile()
	 *
	 * @param mixed $currentModule
	 * @return
	 */
	function templateFile($currentModule)
	{
		if ($currentModule == $this->CI->router->fetch_class()) {
			$ret = env('THEME_SITE') . '/' . $currentModule . '.' . $this->CI->router->fetch_method() . '.html';
		}
		else {
			$ret = env('THEME_SITE') . '/' . $currentModule . '.' . $this->CI->router->fetch_class() . '.' . $this->CI->router->fetch_method() . '.html';
		}

		if ( $this->isAdminModule() ) {
			$ret = env('THEME_BACKEND') . '/backend.' . $this->CI->router->fetch_method() . '.html';

			if ( $this->CI->uri->segment(3) != '' ) {
				$ret = env('THEME_BACKEND').'/backend.' . $this->CI->router->fetch_class() . '.' . $this->CI->router->fetch_method() . '.html';
			}
			else if ( $this->CI->uri->segment(2) != '' ) {
				$ret = env('THEME_BACKEND').'/backend.' . $this->CI->router->fetch_method() . '.html';
			}
		}

		return $ret;
	}

	/**
	 * Template::templateDirectory()
	 *
	 * @param mixed $currentModule
	 * @return
	 */
	function templateDirectory()
	{
		//$MX = new MX_Controller();

		$theme = env('THEME_SITE');
		if ( $this->isAdminModule() ) {
			$theme = env('THEME_BACKEND');

		}

		return $theme;
	}

	/**
	 * Template::isAdminModule()
	 *
	 * @return boolean
	 */
	function isAdminModule()
	{
		$ret = false;
		if ( $this->CI->uri->segment(1) == 'backend' ) {
			$ret = true;
		}
		return $ret;
	}

}