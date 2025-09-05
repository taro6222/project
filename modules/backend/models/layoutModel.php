<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class layoutModel extends CI_Model
{

	// --------------------------------------------------------------------

    function __construct()
    {
        parent::__construct();
    }


	// --------------------------------------------------------------------

	function getContentsNewPosts($limit=0)
	{
		$this->db->select( '*' );
		$this->db->from('nb_contents');
		$this->db->where('contents_slr =', 0);
		$this->db->order_by('contents_date', 'desc');
		$this->db->limit($limit);
		$ret = $this->db->get();

		return $ret->result_array();
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

	function getRecentlyList()
	{
		$sql = "R.*, C.*";
		$this->db->select( $sql );
		$this->db->from('nb_recently R');
		//$this->db->join('nb_files F', 'F.contents_auth=R.contents_auth', 'LEFT');
		$this->db->join('nb_contents C', 'C.contents_auth=R.contents_auth', 'LEFT');
		$this->db->where('R.user_auth =', 0);
		$this->db->order_by('recently_date', 'desc');
		$this->db->limit(10);
		$query = $this->db->get();

		return $query->result_array();
	}



}
