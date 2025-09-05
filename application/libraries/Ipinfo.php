<?php
if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Ipinfo extends MX_Controller
{
    private $ci;

    public function __construct() {
        $this->ci = &get_instance();
        parent::__construct();
    }

    public function ipinfo() {
        return json_decode(file_get_contents("http://ipinfo.io/")); // 받음
    }
}
