<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MX_Controller
{

	// --------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	public function index()
	{
		echo '-->user';
	}

	public function list()
	{
		// library
		$this->load->library('common');
		$this->load->library('pagination');
		// model
		$this->load->model('user/userModel', 'user');

		$per_page = ($this->input->get('per') != '') ? $this->input->get('per', true) : 10;
		$current_page = ($this->input->get('page') != '') ? $this->input->get('page', true) : 1;
		$search_name = ($this->input->get('q') != '') ? urldecode(trim($this->input->get('q'))) : null;

		// pagination
		$total_rows = $this->user->get_user_list_count(trim($search_name)); //전체 사용자 수
		$config = $this->common->get_pagination_config('/user/list', $total_rows, $per_page); //페이지 설정
		//$total_Page = ceil($total_rows / $per_page); //전체 페이지 수
		$this->pagination->initialize($config); //페이지 초기화
		$limit = $per_page;
		$offset = ($current_page - 1) * $per_page;

		$array_user = $this->user->get_user_list($limit, $offset, $search_name);
		$loop_user = array();
		foreach ($array_user as $user) {
			$user_avatar = ($user->user_avatar == null) ? mb_substr($user->user_name, 0, 1, 'utf-8') : $user->user_avatar;
			$loop_user[] = array(
				'user_key' => $user->user_key,
				'user_userid' => $user->user_userid,
				'user_email' => $user->user_email,
				'user_name' => $user->user_name,
				'user_nickname' => $user->user_nickname,
				//'user_register_datetitme' => date('Y-m-d', strtotime($user->user_register_datetitme)),
				'user_register_datetitme' => $user->user_register_datetitme,
				'user_register_passing' => $this->common->passing_time($user->user_register_datetitme),
				'user_avatar' => $user->user_avatar,
				'user_avatar_image' => $user_avatar,
			);
		}

		$this->load->library('template');
		$this->template->assign('CURRENT_PAGE', $current_page);
		$this->template->assign('SEARCH_NAME', $search_name);
		$this->template->assign('LOOP_USER', $loop_user);
		$this->template->assign('PER_PAGE', $per_page);
		$this->template->assign('TOTAL_SEARCH', $total_rows);
		$this->template->assign('PAGINATION', $this->pagination->create_links());
		$this->template->display();
	}

	public function info()
	{
		$this->load->model('user/userModel', 'user');

		$key = $this->input->get('key', true);

		try {
			$user = $this->user->info($this->input->get('key', true));
			$user_avatar = ($user->user_avatar == null) ? mb_substr($user->user_name, 0, 1, 'utf-8') : $user->user_avatar;

			if (!$user) {
				$this->load->helper('url');
				redirect('/error');
				exit();
			}

			$this->load->library('template');
			$this->template->assign('user_key', $user->user_key);
			$this->template->assign('user_id', date('Ymd', strtotime($user->user_register_datetitme)) . $user->user_key);
			$this->template->assign('user_email', $user->user_email);
			$this->template->assign('user_name', $user->user_name);
			$this->template->assign('user_avatar', $user->user_avatar);
			$this->template->assign('user_avatar_image', $user_avatar);
			$this->template->assign('user_lastlogin_datetime', $user->user_lastlogin_datetime);
			$this->template->assign('user_address1', $user->user_address1);
			$this->template->assign('user_address2', $user->user_address2);
			$this->template->display();
		} catch (Exception $e) {
			// this will not catch DB related `enter code here`errors. But it will include them, because this is more general. 
			log_message('error', $e->getMessage());
			return;
		}
	}

	public function add()
	{
		//echo "<img src='data:image/gif;base64, $data'>"; 
		$this->load->library('auth');
		$this->load->library('validation');
		$this->load->model('user/userModel', 'user');

		if (!empty($_POST)) {
			$this->validation->name('user_email')->value($this->input->post('user_email'))->pattern('email')->required();
			$this->validation->name('user_passwd')->value($this->input->post('user_passwd'))->required();
			//$this->validation->name('user_name')->value($this->input->post('user_name'))->pattern('alpha')->required();
		}

		$ret = false;
		if ($this->validation->isSuccess()) {
			$user_avatar = null;

			if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
				if ($_FILES['avatar']['type'] == 'image/gif') {
					$this->load->library('gif');
					$user_avatar = 'data:' . $_FILES['avatar']['type'] . ';base64,' . base64_encode($this->gif->resize($_FILES['avatar']['tmp_name']));
				} else {
					$config['image_library'] = 'gd2';
					$config['source_image'] = $_FILES['avatar']['tmp_name'];
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 100;
					$config['height'] = 100;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$user_avatar = 'data:' . $_FILES['avatar']['type'] . ';base64,' . base64_encode(file_get_contents($_FILES['avatar']['tmp_name']));
					$this->image_lib->clear();
					//$user_avatar = file_get_contents($_FILES['avatar']['tmp_name']);
				}
			}
			date_default_timezone_set('UTC');
			$data = array(
				'user_userid' => $this->input->post('user_email'),
				'user_email' => $this->input->post('user_email'),
				'user_passwd' => $this->auth->passwd_encode($this->input->post('user_passwd')),
				'user_name' => $this->input->post('user_name'),
				'user_avatar' => $user_avatar,
				'user_avatar_type' => $_FILES['avatar']['type'],
				'user_register_datetitme' => date('Y-m-d H:i:s'),
			);

			if ($this->user->user_add($data)) {
				$ret = true;
			}
		}

		echo $ret;
		exit();
	}

	public function delete()
	{
		$key = $this->input->post('key');
		//$key = [1,2,3,4,5];

		$this->load->model('user/userModel', 'user');

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)) {
			$_POST = json_decode(file_get_contents('php://input'), true);

			foreach ($_POST['key'] as $var) {
				$this->user->delete($var);
				//echo '===>'.$var;
			}
		}

		//echo var_dump(json_decode($key, true));
		//echo var_dump($key);
		//$this->user->delete($key);
		//log_message('info', '======>'.$key);
		//echo "<script>console.log('===> " . $key . "');</script>";
		//$this->console_log('===0'.$key);
		exit();
	}

	private function console_log($output, $with_script_tags = true)
	{
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
		if ($with_script_tags) {
			$js_code = urldecode('<script>' . $js_code . '</script>');
		}
		echo $js_code;
	}
}