<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class vodModel extends CI_Model
{

	// --------------------------------------------------------------------

    function __construct()
    {
        parent::__construct();
    }


	// --------------------------------------------------------------------

	function getContentsSlrCheck($auth_key)
	{
		//$this->db->count_all_results('my_table');  // Produces an integer, like 25
		$this->db->from('nb_contents');
		$this->db->where('contents_slk', $auth_key);
		$ret = ( $this->db->count_all_results() == 0 ) ? false : true;

		return $ret;
	}


	// --------------------------------------------------------------------

	function getTitleImage($auth_key)
	{
		$this->db->select('contents_image');
		$this->db->from('nb_contents');
		$this->db->where('contents_slk =', $auth_key);
		$this->db->limit(1);
		//$this->db->order_by('contents_date', 'desc');
		$query = $this->db->get();

		$ret = ( count($query->row()) != 0 ) ? $query->row()->contents_image : '';

		if( $ret == '' ) {
			$this->db->select('contents_image');
			$this->db->from('nb_contents');
			$this->db->where('contents_auth =', $auth_key);
			$query = $this->db->get();
			$ret = $query->row()->contents_image;
		}

		return $ret;
	}


	// --------------------------------------------------------------------

	function getContentsCountAll()
	{
		return $this->db->count_all('nb_contents');
	}


	// --------------------------------------------------------------------

	function getList($limit=0, $offset=0, $rowSet=0)
	{

		$sql = "
			U.user_key, U.user_auth_key, U.user_id, U.user_email, U.user_name, U.user_nickname, U.user_blog, U.user_registered, U.user_lastlogin, U.user_allow, U.user_admin,
			G.group_title
		";
		$this->db->select( '*' );
		$this->db->from('nb_contents');
		//$this->db->join('ci_user_group G', 'G.group_key=U.group_key', 'LEFT');
		$this->db->where('contents_slr =', 0);
		$this->db->order_by('contents_date', 'desc');
		$this->db->limit($limit, $offset);
		$ret = $this->db->get();
/*
$sql = "
			U.user_key, U.user_auth_key, U.user_id, U.user_email, U.user_name, U.user_nickname, U.user_blog, U.user_registered, U.user_lastlogin, U.user_allow, U.user_admin,
			G.group_title
		";
		$this->db->select( $sql );
		$this->db->from('ci_user U');
		$this->db->join('ci_user_group G', 'G.group_key=U.group_key');
		$this->db->where_between('U.user_key', $limit, $limit+20);
		$this->db->order_by('user_key', 'desc');
		$ret = $this->db->get();
*/
		return $ret->result_array();
	}


	// --------------------------------------------------------------------

	function getInfo($auth_key)
	{
		$this->db->select('*');
		$this->db->from('nb_contents');
		$this->db->where('contents_auth =', $auth_key);
		$query = $this->db->get();
		$ret = $query->row();

		return $ret;
	}


	// --------------------------------------------------------------------

	function getVodInfo($auth_key)
	{
		$sql = "F.*, C.*";
		$this->db->select( $sql );
		$this->db->from('nb_files F');
		$this->db->join('nb_contents C', 'C.contents_auth=F.contents_auth', 'LEFT');
		$this->db->where('F.files_auth =', $auth_key);
		$query = $this->db->get();

		return $query->row();
	}


	// --------------------------------------------------------------------

	function getVList($auth)
	{
		$this->db->select( '*' );
		$this->db->from('nb_contents');
		$this->db->where('contents_slk =', $auth);
		//$this->db->or_where('contents_slr =', 1);
		//$this->db->order_by('contents_date', 'desc');
		$ret = $this->db->get();

		return $ret->result_array();
	}


	// --------------------------------------------------------------------

	function getPlayList($auth)
	{
		$this->db->select( '*' );
		$this->db->from('nb_files');
		$this->db->where('contents_auth =', $auth);

		$ret = $this->db->get();

		return $ret->result_array();
	}


	// --------------------------------------------------------------------

	function getRecentlyKey()
	{
		$this->db->select_max('recently_key');
		$query = $this->db->get('nb_recently');
		$row = $query->row();

		$key = $row->recently_key+1;

		return $key;
	}


	// --------------------------------------------------------------------

	function saveRecentlyUpdate($row = NULL, $contents_auth)
	{
		$ret = FALSE;

		if($row !== NULL && is_array($row) && !empty($row)) {

			//기존 데이터가 있는지 검사
			$this->db->from('nb_recently');
			$this->db->where('contents_auth', $contents_auth);

			if ( $this->db->count_all_results() == 0 ) {
				$this->db->insert('nb_recently', $row);
			}
			else {
				$data = array(
					'recently_index' => $row['recently_index'],
					'recently_image' => $row['recently_image'],
					'recently_date'	=> date( 'Y-m-d H:i:s' ),
				);
				$this->db->where('contents_auth', $contents_auth);
				$this->db->update('nb_recently', $data);
			}

			$ret = TRUE;
		}

		return $ret;
	}

















	// --------------------------------------------------------------------

	function getUserCountAll()
	{
		return $this->db->count_all('ci_user');
	}


	// --------------------------------------------------------------------

	function getUserLists($limit=0, $offset=0, $rowSet=0)
	{

		$sql = "
			U.user_key, U.user_auth_key, U.user_id, U.user_email, U.user_name, U.user_nickname, U.user_blog, U.user_registered, U.user_lastlogin, U.user_allow, U.user_admin,
			G.group_title
		";
		$this->db->select( $sql );
		$this->db->from('ci_user U');
		$this->db->join('ci_user_group G', 'G.group_key=U.group_key', 'LEFT');
		$this->db->where('U.user_key >=', 1);
		$this->db->order_by('U.user_key', 'desc');
		$this->db->limit($limit, $offset);
		$ret = $this->db->get();
/*
$sql = "
			U.user_key, U.user_auth_key, U.user_id, U.user_email, U.user_name, U.user_nickname, U.user_blog, U.user_registered, U.user_lastlogin, U.user_allow, U.user_admin,
			G.group_title
		";
		$this->db->select( $sql );
		$this->db->from('ci_user U');
		$this->db->join('ci_user_group G', 'G.group_key=U.group_key');
		$this->db->where_between('U.user_key', $limit, $limit+20);
		$this->db->order_by('user_key', 'desc');
		$ret = $this->db->get();
*/
		return $ret->result_array();
	}

	// --------------------------------------------------------------------

	function getUserInfo( $userAuthKey )
	{
		/*
		$select = "
			U.user_key, U.user_auth_key, U.user_id, U.user_email, U.user_name, U.user_nick_name, U.user_blog,
			U.user_registered, U.user_last_login, U.user_is_allow, U.user_is_admin, U.user_allow_mailing, U.user_description,
			G.group_title, G.group_key
		";
		*/
		$sql = "
			U.*,
			G.group_title, G.group_key
		";
		$this->db->select( $sql );
		$this->db->from('ci_user U');
		$this->db->join('ci_user_group G', 'G.group_key=U.group_key');
		$this->db->where('U.user_auth_key', $userAuthKey);
		$get = $this->db->get();
		$ret = ( count( $get->row() ) == 0 ) ? array() : $get->row();

		return $ret;
	}

	// --------------------------------------------------------------------

	function getUserGroupAll()
	{
		$sql = "group_key, group_title, group_default";
		$this->db->select( $sql );
		$this->db->from('ci_user_group');
		$this->db->order_by('group_order', 'desc');
		$ret = $this->db->get();

		return $ret->result_array();
	}



	// --------------------------------------------------------------------

	function getCheckNickname($user_auth_key, $user_nickname)
	{
		$this->db->select('user_nickname');
		$this->db->from('ci_user');
		$this->db->where('user_auth_key !=', $user_auth_key);
		$this->db->where('user_nickname', $user_nickname);

		$ret = $this->db->count_all_results();

		return $ret;
	}

	// --------------------------------------------------------------------

	function getUserKey()
	{
		$this->db->select_max('user_key');
		$query = $this->db->get('ci_user');
		$row = $query->row();

		$ret = $row->user_key + 1;

		return $ret;
	}

	// --------------------------------------------------------------------

	function getUserAuthKey()
	{
		$ret = FALSE;
		$keyCount = mb_strlen($this->user->getUserKey());
		if ($keyCount != 10) {
			$count = 10 - $keyCount;

			$count_own = "1";
			$count_two = "9";
			for($i=1; $i <= $count; $i++) {
				$count_own .= "0";
				$count_two .= "9";
			}
			$rand_key = mt_rand($count_own, $count_two);

			$ret = $rand_key . $this->user->getUserKey() . mt_rand(100, 999);
		}

		return $ret;
	}

	// --------------------------------------------------------------------

	function saveUserAdd($row = NULL)
	{
		$ret = FALSE;

		if($row !== NULL && is_array($row) && !empty($row)) {

			$this->db->insert('ci_user', $row);

			$ret = TRUE;
		}

		return $ret;
	}

	// --------------------------------------------------------------------

	function saveUserModify($key = NULL, $row = NULL)
	{
		$ret = FALSE;

		if($key !== NULL && $row !== NULL && is_array($row) && !empty($row) && $this->getUserCount(array('user_auth_key' => $key)) == 1) {


			$this->db->where('user_auth_key', $key);
			$this->db->update('ci_user', $row);

			$ret = TRUE;
		}

		return $ret;
	}

	// --------------------------------------------------------------------

	function getUserCount($where = NULL)
	{
		$ret = -1;

		if($where !== NULL) {
			$this->db->where($where);
		}

		$ret = $this->db->count_all_results('ci_user');

		return $ret;
	}



	// --------------------------------------------------------------------


	function find_member($where = NULL, $select = '*', $limit = 1000)
	{
		$this->db->select($select);
		$this->db->from('ci_member');
		if($where !== NULL) $this->db->where($where);
		if($limit !== NULL) $this->db->limit($limit);
		$rs = $this->db->get();

		return $rs->result_array();
	}

	// --------------------------------------------------------------------

	function get_member($id = NULL, $select = '*', $limit = NULL)
	{
	   $ret = NULL;

		if($id !== NULL) {
			$ret = $this->find_member(array('member_pid' => $id), $select, $limit);
		}

		return $ret;
	}

	// --------------------------------------------------------------------

	function get_member_count($where = NULL)
	{
		$ret = -1;

		if($where !== NULL) {
			$this->db->where($where);
		}

		$res = $this->db->count_all_results('ci_member');
		$ret = isset($res['numrows']) ? $res['numrows'] : $ret;

		return $ret;
	}

	// --------------------------------------------------------------------

	function delete_member($id = NULL)
	{
 		$ret = FALSE;

		if($id !== NULL) {
			$this->db->where('member_pid', $id);
			$this->db->delete('ci_member');

			$ret = TRUE;
		}

		return $ret;
	}
}
