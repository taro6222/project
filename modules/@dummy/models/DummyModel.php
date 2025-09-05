<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class authModel extends CI_Model
{

	// --------------------------------------------------------------------

    function __construct()
    {
        parent::__construct();
    }


	/**
	 * user check function
	 *
	 * @param [type] $user_id
	 * @param [type] $user_passwd
	 * @return void
	 */
	function userCheck( $user_email )
	{
		$this->db->select( '*' );
		$this->db->from('nb_user');
		$this->db->where('user_email', $user_email);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			$ret = $query->row();
		}
		else {
			$ret = false;
		}

		return $ret;
	}


	// --------------------------------------------------------------------

	function userLogonUpdate( $user_key )
	{
		$data = array(
			'user_lastip' => $_SERVER['REMOTE_ADDR'],
			'user_lastlogin' => date( 'Y-m-d H:i:s' ),
		);
		$this->db->where('user_key', $user_key);
		$this->db->update('nb_user', $data);
	}


}
