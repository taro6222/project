<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

// ------------------------------------------------------------------------

class Common extends MX_Controller
{
	var $folder = "e:/vod/";
	var $config = array();


	/**
	 * __construct
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
	}


	/**
	 * get_page_config
	 *
	 * @param  mixed $movie_segment1
	 * @param  mixed $movie_segment2
	 * @param  mixed $movie_type
	 * @param  mixed $total_rows
	 * @param  mixed $per_page
	 * @return void
	 */
	function get_pagination_config($uri, $total_rows, $per_page)
	{
		$config['base_url'] = $uri;
		$config['total_rows'] = $total_rows;
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['display_pages'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		if ($this->mobileCheck()) {
			$config['num_links'] = 2;
			$config['per_page'] = 10;
			$config['first_tag_open'] = '<li class="page-item m-1">';
			$config['first_tag_close'] = '</li>';
			$config['first_link'] = 'F';
			$config['last_tag_open'] = '<li class="page-item m-1">';
			$config['last_tag_close'] = '</li>';
			$config['last_link'] = 'L';
		} else {
			$config['per_page'] = $per_page;
			$config['num_links'] = 4;
			$config['first_tag_open'] = '<li class="page-item m-1">';
			$config['first_tag_close'] = '</li>';
			$config['first_link'] = 'First';
			$config['last_tag_open'] = '<li class="page-item m-1">';
			$config['last_tag_close'] = '</li>';
			$config['last_link'] = 'Last';
			$config['prev_tag_open'] = '<li class="page-item previous m-1">';
			$config['prev_tag_close'] = '</li>';
			$config['prev_link'] = '<i class="previous"></i>';
			$config['next_tag_open'] = '<li class="page-item next m-1">';
			$config['next_tag_close'] = '</li>';
			$config['next_link'] = '<i class="next"></i>';
		}
		$config['cur_tag_open'] = '<li class="page-item active m-1"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item m-1">';
		$config['num_tag_close'] = '</li>';

		return $config;
	}

	function creat_public_key($number)
	{
		$ret = FALSE;
		$keyCount = mb_strlen($number);
		if ($keyCount != 10) {
			$count = 10 - $keyCount;

			$count_own = "1";
			$count_two = "9";
			for ($i = 1; $i <= $count; $i++) {
				$count_own .= "0";
				$count_two .= "9";
			}
			$rand_key = mt_rand($count_own, $count_two);

			$ret = $rand_key . $number . mt_rand(1000, 9999);
		}

		return $ret;
	}





	function folder()
	{
		return $this->folder;
	}

	// --------------------------------------------------------------------

	function loadModule2($module)
	{
		$obj = '';
		$file_path = 'modules/' . $module . '/controllers/' . $module . '.php';

		if (file_exists($file_path)) {
			include_once($file_path);
			$obj = new $module;
		}

		return $obj;
	}

	function LoadTheme($theme)
	{
		$this->db->select("config");
		$this->db->from('nb_options');
		$this->db->where('module', 'theme');

		$get = $this->db->get();
		$row = $get->row();
		$row = unserialize($row->config);
		$configTheme = $row[$theme];
		if ($theme == 'backend') {
			if (is_dir('themes/backend/' . $configTheme)) {
				$ret = 'themes/backend/' . $configTheme;
			}
			$ret = 'themes/backend/default';
		} else {
			if (is_dir('themes/' . $configTheme)) {
				$ret = 'themes/' . $configTheme;
			}
			$ret = 'themes/default';
		}
		return $ret;
	}

	// --------------------------------------------------------------------

	function config($module, $file)
	{
		$file = ($file == '') ? 'config' : str_replace('.xml', '', $file);
		$file_path = 'modules/' . $module . '/config/' . $file . '.xml';

		if (file_exists($file_path)) {
			$this->load->library('simplexml');
			$this->config = $this->simplexml->parse($file_path);
		}

		return $this->config;
	}

	// --------------------------------------------------------------------

	function config_item($item, $index = '')
	{
		if ($index == '') {
			if (!isset($this->config[$item])) {
				return FALSE;
			}

			$pref = $this->config[$item];
		} else {
			if (!isset($this->config[$index])) {
				return FALSE;
			}

			if (!isset($this->config[$index][$item])) {
				return FALSE;
			}

			$pref = $this->config[$index][$item];
		}

		return $pref;
	}

	function date_at_timezone($format, $locale, $timestamp = null)
	{

		if (is_null($timestamp))
			$timestamp = time();

		//Prepare to calculate the time zone offset
		$current = time();

		//Switch to new time zone locale
		$tz = date_default_timezone_get();
		date_default_timezone_set($locale);

		//Calculate the offset
		$offset = time() - $current;

		//Get the date in the new locale
		$output = date($format, $timestamp - $offset);

		//Restore the previous time zone
		date_default_timezone_set($tz);

		return $output;
	}


	/**
	 * 날짜 지난일 변환함수
	 *
	 * @param [type] $datetime
	 * @return void
	 */
	function passing_time($datetime, $granularity = 1)
	{
		$difference = time() - strtotime($datetime);

		$periods = array(
			'년' => 31536000,
			'개월' => 2628000,
			'주' => 604800,
			'일' => 86400,
			'시간' => 3600,
			'분' => 60,
			'초' => 1,
		);

		$retval = '';

		foreach ($periods as $key => $value) {
			if ($difference >= $value) {
				$time = floor($difference / $value);
				$difference %= $value;
				$retval .= ($retval ? ' ' : '') . $time;
				$retval .= (($time > 1) ? $key : $key);
				$granularity--;
			}
			if ($granularity == '0') {
				break;
			}
		}

		if (!$retval) {
			$retval = '방금';
		}

		return $retval . ' 전';
	}


	/**
	 * 배열을 객체로 변환(내부함수))
	 *
	 * @param [type] $array
	 * @param [type] $obj
	 * @return void
	 */
	function array_to_obj($array, &$obj)
	{
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$obj->$key = new stdClass();
				$this->array_to_obj($value, $obj->$key);
			} else {
				$obj->$key = $value;
			}
		}
		return $obj;
	}


	/**
	 * 배열을 객체로 변환
	 *
	 * @param [type] $array
	 * @return void
	 */
	function arrayToObject($array)
	{
		$object = new stdClass();
		return $this->array_to_obj($array, $object);
	}

	// --------------------------------------------------------------------

	function listdir($folder, $mode = 0) //폴더리스트 구하는 함수
	{
		$listdir = array();
		if (is_dir($folder)) {
			$handle = opendir($folder);
			while ($file = readdir($handle)) {
				if ($mode == 4) {
					if (is_dir($folder . "/" . $file) && $file != "." && $file != "..") { //만약 .이나 ..이면 제거. 폴더만 챙기기
						$listdir[] = $file;
					}
				} else {
					if (is_dir($folder . "/" . $file) && $file != "." && $file != ".." && !preg_match("/#/", $file) && !preg_match("/common/", $file) && !preg_match("/\[/", $file)) { //만약 .이나 ..이면 제거. 폴더만 챙기기
						$listdir[] = $file;
					}
				}
			}
			closedir($handle);
		}

		return $listdir;
	}


	// --------------------------------------------------------------------

	function folderSearch($name) //폴더리스트 구하는 함수
	{
		$ret = false;
		if (is_dir($name)) {
			$ret = true;
		}

		return $ret;
	}


	// --------------------------------------------------------------------

	function listOne($folder) //폴더리스트 구하는 함수
	{
		$listdir = '';
		if (is_dir($folder)) {
			$handle = opendir($folder);
			while ($file = readdir($handle)) {
				if (is_dir($folder . "/" . $file) && $file != "." && $file != ".." && !preg_match("/#/", $file) && !preg_match("/common/", $file) && !preg_match("/\[/", $file)) { //만약 .이나 ..이면 제거. 폴더만 챙기기
					$listdir = $file;
					break;
				}
			}
			closedir($handle);
		}

		return $listdir;
	}

	/**
	 * 폴더 내 .mp4 파일 가져오기
	 *
	 * @param [type] $dir
	 * @return void
	 */
	function listmp4($dir) //파일리스트 구하는 함수
	{
		$listfile = array();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if ($file != "." && $file != ".." && preg_match("/mp4/", $file)) { //만약 .이나 ..이면 제거. 파일만 챙기기
						//if ( $file != "." && $file != ".." ) {   //만약 .이나 ..이면 제거. 파일만 챙기기
						//echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
						$listfile[] = $file;
					}
				}
				closedir($dh);
			}
		}
		sort($listfile);
		return $listfile;
	}


	function trailermp4($dir) //파일리스트 구하는 함수
	{
		$listfile = '';
		$dir = $dir . '/video';
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if ($file != "." && $file != ".." && preg_match("/mp4/", $file)) { //만약 .이나 ..이면 제거. 파일만 챙기기
						//if ( $file != "." && $file != ".." ) {   //만약 .이나 ..이면 제거. 파일만 챙기기
						//echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
						$listfile = $file;
						break;
					}
				}
				closedir($dh);
			}
		}
		return $listfile;
	}


	// --------------------------------------------------------------------

	function listfile($dir, $limit = 'all') //파일리스트 구하는 함수
	{
		$listfile = array();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				$count = 0;
				while (($file = readdir($dh)) !== false) {
					if ($file != "." && $file != "..") { //만약 .이나 ..이면 제거. 파일만 챙기기
						//echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
						$listfile[] = $file;
						if ($limit != 'all' && $limit == $count) {
							break;
						}
						$count++;
					}
				}
				closedir($dh);
			}
		}
		return $listfile;
	}

	// --------------------------------------------------------------------

	function detectEncodeing($str, $enc)
	{
		foreach ($enc as $v) {
			$tmp = @iconv($v, $v, $str);
			if (md5($tmp) == md5($str)) {
				return true;
			}
		}
		return false;
	}


	// --------------------------------------------------------------------

	function toUTF8($txt_content)
	{
		if (mb_detect_encoding($txt_content) == 'UTF-8') {
		} else if ($this->detectEncodeing($txt_content, array("CP949"))) {
			$txt_content = @iconv("CP949", "UTF-8//IGNORE", $txt_content);
		} else if ($this->detectEncodeing($txt_content, array("ASCII"))) {
			$txt_content = @iconv("ASCII", "UTF-8//IGNORE", $txt_content);
		} else if ($this->detectEncodeing($txt_content, array("EUC-KR"))) {
			$txt_content = @iconv("EUC-KR", "UTF-8//IGNORE", $txt_content);
		} else if ($this->detectEncodeing($txt_content, array("ISO8859-1"))) {
			$txt_content = @iconv("UTF-16", "UTF-8//IGNORE", $txt_content);
		}

		/*
					$bom = pack("CCC", 0xef, 0xbb, 0xbf);
					if (0 === strncmp($txt_content, $bom, 3)) {
						$txt_content = substr($txt_content, 3);
					}
					*/

		return $txt_content;
	}


	function makeTime($smiTime)
	{
		$time = intval($smiTime);
		$second = $time / 1000;
		$milisec = $time % 1000;
		$mark = gmdate("H:i:s", $second);
		return sprintf("%s.%03d", $mark, $milisec);
	}


	function ffmpegTime($mp4_file)
	{
		exec("ffprobe -show_streams \"$mp4_file\"", $ffprobe);

		$ffinfo = array();
		foreach ($ffprobe as $value) {
			$exp = explode("=", $value);
			$ffinfo[$exp[0]] = @$exp[1];
		}

		$time = explode(".", $ffinfo['duration']);

		return $time[0];
	}


	function ffmpegQuality($mp4_file)
	{
		exec("ffprobe -show_streams \"$mp4_file\"", $ffprobe);

		$ffinfo = array();
		foreach ($ffprobe as $value) {
			$exp = explode("=", $value);
			$ffinfo[$exp[0]] = @$exp[1];
		}

		$ret = '720P';
		if (@$ffinfo['width'] > 0) {
			if ($ffinfo['width'] > 1900) {
				$ret = '1080P';
			}
			if ($ffinfo['width'] < 1900) {
				$ret = '720P';
			}
			if ($ffinfo['width'] < 720) {
				$ret = '480P';
			}
			if ($ffinfo['width'] < 480) {
				$ret = '360P';
			}
		}

		return $ret;
	}

	function ffmpeg($folder, $file, $time)
	{
		$md5_file = md5($file);
		$tFolder = 'var/thumbnail/' . substr($md5_file, 0, 1);
		if (!is_dir($tFolder)) {
			mkdir($tFolder, 0777);
		}

		$gif_file = $tFolder . '/' . $md5_file . '.gif';

		if (is_file($gif_file)) {
			unlink("$gif_file");
		}

		$mp4_file = $folder . $file;
		exec("/bin/ffmpeg -v warning -ss $time -t 10 -i \"$mp4_file\" -vf fps=15,scale=360:-1:flags=lanczos $gif_file", $out);

		return;
	}


	function mobileCheck()
	{
		$ret = false;
		$mobilechk = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/i';

		// 모바일 접속인지 PC로 접속했는지 체크합니다.
		if (preg_match($mobilechk, $_SERVER['HTTP_USER_AGENT'])) {
			$ret = true;
		}

		return $ret;
	}

	function convertImage($filename, $destination, $th_width, $th_height, $forcefill)
	{
		if (is_file($filename) && !is_file($destination)) {
			//$output = shell_exec('rm -rf /tmp/magick*');
			$output = exec("\"magick\" -size {$th_width}x{$th_height} -density 200 {$filename} -quality 100 -sharpen 0x1.0 {$destination} > /dev/null 2>&1 & echo $!");

			//magick -size 600x400 -density 200 $jpg_file -quality 100 -sharpen 0x1.0 png_file
			//echo "magick -size {$th_width}x{$th_height} xc:white -verbose -density 200 -trim {$filename} -quality 100 -sharpen 0x1.0 {$destination}";
			// 2481x3508 사이즈로
			// quality 100 --> 최대 품질
			// density 200 --> 압축율은 적당히
			// sharpen --> 이미지는 원본 수준으로
		}
		return true;
	}

	function GDRealImageResize($filename, $destination, $th_width, $th_height)
	{
		if (is_file($filename) && !is_file($destination)) {
			//기본이미지
			list($width, $height, $type) = getimagesize($filename);

			switch ($type) {
				case "1":
					@$source = imagecreatefromgif($filename);
					break;
				case "2":
					@$source = imagecreatefromjpeg($filename);
					break;
				case "3":
					@$source = imagecreatefrompng($filename);
					break;
				default:
					@$source = imagecreatefromjpeg($filename);
			}

			$thumb = @imagecreatetruecolor($th_width, $th_height);
			//imagecopyresized($thumb, $source, 0, 0, 0, 0, $th_width, $th_height, $width, $height);
			imagecopyresampled($thumb, $source, 0, 0, 0, 0, $th_width, $th_height, $width, $height);
			imagejpeg($thumb, $destination, 75);
		}

		return $destination;
	}

	function make_thumbnail($source_path, $thumbnail_path, $width, $height)
	{
		list($img_width, $img_height, $type) = getimagesize($source_path);
		if ($type != 1 && $type != 2 && $type != 3 && $type != 15)
			return;
		if ($type == 1)
			$img_sour = imagecreatefromgif($source_path);
		else if ($type == 2)
			$img_sour = imagecreatefromjpeg($source_path);
		else if ($type == 3)
			$img_sour = imagecreatefrompng($source_path);
		else if ($type == 15)
			$img_sour = imagecreatefromwbmp($source_path);
		if ($img_width > $img_height) {
			$w = round($height * $img_width / $img_height);
			$h = $height;
			$x_last = round(($w - $width) / 2);
			$y_last = 0;
		} else {
			$w = $width;
			$h = round($width * $img_height / $img_width);
			$x_last = 0;
			$y_last = round(($h - $height) / 2);
		}
		if ($img_width < $width && $img_height < $height) {
			$img_last = imagecreatetruecolor($width, $height);
			$x_last = round(($width - $img_width) / 2);
			$y_last = round(($height - $img_height) / 2);

			imagecopy($img_last, $img_sour, $x_last, $y_last, 0, 0, $w, $h);
			imagedestroy($img_sour);
			$white = imagecolorallocate($img_last, 255, 255, 255);
			imagefill($img_last, 0, 0, $white);
		} else {
			$img_dest = imagecreatetruecolor($w, $h);
			imagecopyresampled($img_dest, $img_sour, 0, 0, 0, 0, $w, $h, $img_width, $img_height);
			$img_last = imagecreatetruecolor($width, $height);
			imagecopy($img_last, $img_dest, 0, 0, $x_last, $y_last, $w, $h);
			imagedestroy($img_dest);
		}
		if ($thumbnail_path) {
			if ($type == 1)
				imagegif($img_last, $thumbnail_path, 100);
			else if ($type == 2)
				imagejpeg($img_last, $thumbnail_path, 100);
			else if ($type == 3)
				imagepng($img_last, $thumbnail_path, 100);
			else if ($type == 15)
				imagebmp($img_last, $thumbnail_path, 100);
		} else {
			if ($type == 1)
				imagegif($img_last);
			else if ($type == 2)
				imagejpeg($img_last);
			else if ($type == 3)
				imagepng($img_last);
			else if ($type == 15)
				imagebmp($img_last);
		}
		imagedestroy($img_last);

		return $thumbnail_path;
	}


	function languageCheck($str)
	{
		if (preg_match_all('![' . '\x{0030}-\x{0039}' . ']+!u', $str, $match)) {
			return 'int';
		}
		if (preg_match_all('![' . '\x{0061}-\x{007a}|\x{0041}-\x{005a}' . ']+!u', $str, $match)) {
			return 'eng';
		}
		if (preg_match_all('![' . '\x{1100}-\x{11ff}\x{3130}-\x{318f}\x{ac00}-\x{d7af}' . ']+!u', $str, $match)) {
			return 'kor';
		}
		if (preg_match_all('![' . '\x{2E80}-\x{2EFF}' . '\x{31C0}-\x{31EF}\x{3200}-\x{32FF}' . '\x{3400}-\x{4DBF}\x{4E00}-\x{9FBF}\x{F900}-\x{FAFF}' . '\x{20000}-\x{2A6DF}\x{2F800}-\x{2FA1F}' . ']+!u', $str, $match)) {
			return 'cha';
		}
		if (preg_match_all('![' . '\x{2E80}-\x{2EFF}' . '\x{31C0}-\x{31EF}\x{3200}-\x{32FF}' . '\x{3400}-\x{4DBF}\x{4E00}-\x{9FBF}\x{F900}-\x{FAFF}' . '\x{20000}-\x{2A6DF}\x{2F800}-\x{2FA1F}' . ']+!u', $str, $match)) {
			return 'jpa';
		}
	}

	function folder_size($dir)
	{
		static $size, $cnt;
		$fp = opendir($dir);
		while (false !== ($entry = readdir($fp))) {
			if (($entry != ".") && ($entry != "..")) {
				if (is_dir($dir . '/' . $entry)) {
					clearstatcache();
					dirsize($dir . '/' . $entry);
				} else if (is_file($dir . '/' . $entry)) {
					$size += filesize($dir . '/' . $entry);
					clearstatcache();
					$cnt++;
				}
			}
		}
		closedir($fp);

		$stat = array(
			'size' => $size,
			'cnt' => $cnt
		);
		return $size;
	}

	function format_size($bytes)
	{
		//$si_prefix = array("", "Kilobytes", "Megabytes", "Gigabytes", "Terabytes", "Petabytes", "Exabytes", "Zettabytes", "Yottabytes");
		$si_prefix = array("", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
		$base = 1024;
		$class = min((int) log($bytes, $base), count($si_prefix) - 1);
		return sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
	}
}