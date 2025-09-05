<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class logModel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function add($row = NULL)
	{
		$this->db->insert('nb_logs', $row);
		return;
	}
}