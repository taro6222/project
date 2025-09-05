<?php
/**
 * @name		CodeIgniter Secure Authentication Library
 * @author		Jens Segers
 * @link		http://www.jenssegers.be
 * @license		MIT License Copyright (c) 2012 Jens Segers
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Auth extends MX_Controller
{
    // default values
    private $cookie_name = 'autologin';
    private $cookie_encrypt = TRUE;
    private $autologin_expire = 5184000;
    private $hash_algorithm = 'sha256';

    private $ci;

    /**
     * Constructor, loads dependencies, initializes the library
     * and detects the autologin cookie
     */
    public function __construct() {
        $this->ci = &get_instance();

        // load session library
        $this->ci->load->library('session');

        // initialize from config
        $this->config->load('auth');
        if (!empty($authentication)) {
            $this->initialize($authentication);
        }

        log_message('debug', 'Authentication library initialized');

        // detect autologin
        if (!$this->ci->session->userdata('auth_loggedin')) {
            $this->autologin();
        }
    }

    /**
     * Initialize with configuration array
     * 
     * @param array $config
     */
    public function initialize($config = array()) {
        foreach ($config as $key => $val) {
            $this->$key = $val;
        }
    }


    /**
     * Password Encrypt function
     *
     * @param string $passwd
     * @return string
     */
    public function passwd_encode($passwd) {
        return password_hash($passwd, PASSWORD_BCRYPT);
    }

    /**
     * Password crypt check function
     *
     * @param string $passwd
     * @param string $hash
     * @return boolean
     */
    public function password_check($passwd, $hash) {
        if (password_verify($passwd, $hash)) {
            $ret = true;
        }
        else {
            $ret = false;
        }
        return $ret;
    }

    /**
     * Mark a user as logged in and create autologin cookie if wanted
     * 
     * @param string $id
     * @param boolean $remember
     * @return boolean
     */
    public function login($key, $public, $email, $name, $nickname, $admin, $user_lastlogin, $remember = false) {
        if(!$this->loggedin()) {
            // mark user as logged in
            $this->ci->session->set_userdata(
                array(
                    'auth_key' => $key,
                    'auth_public' => $public,
                    'auth_email' => $email,
                    'auth_name' => $name,
                    'auth_nickname' => $nickname,
                    'auth_admin' => $admin,
                    'user_lastlogin' => $user_lastlogin,
                    'auth_loggedin' => true,
                )
            );

            if ($remember) {
                //$this->create_autologin($id);
            }
        }
        return;
    }

    /**
     * Logout the current user, destroys the current session and autologin key
     */
    public function logout() {
        // mark user as logged out
        $this->ci->session->set_userdata(
            array(
                'auth_key' => FALSE,
                'auth_public' => FALSE,
                'auth_email' => FALSE,
                'auth_name' => FALSE,
                'auth_nickname' => FALSE,
                'auth_admin' => FALSE,
                'user_lastlogin' => FALSE,
                'auth_loggedin' => FALSE,
            )
        );

        // remove cookie and active key
        $this->delete_autologin();
    }

    /**
     * Check if the current user is logged in or not
     *
     * @return boolean
     */
    public function loggedin() {
        return $this->ci->session->userdata('auth_loggedin');
    }

    public function isadult() {
        return $this->ci->session->userdata('auth_adult');
    }

    public function isadmin() {
        return $this->ci->session->userdata('auth_admin');
    }

    public function userid() {
        return $this->ci->session->userdata('auth_id');
    }

    public function username() {
        return $this->ci->session->userdata('auth_name');
    }

    public function get_auth_key() {
        return $this->loggedin() ? $this->ci->session->userdata('auth_key') : FALSE;
    }

    /**
     * Returns the user id of the current user when logged in
     * 
     * @return int
     */
    public function userkey() {
        return $this->loggedin() ? $this->ci->session->userdata('auth_key') : FALSE;
    }

    /**
     * Generate a new key pair and create the autologin cookie
     * 
     * @param int $id
     * @param string $series
     */
    private function create_autologin($id, $series = FALSE) {
        // generate keys
        list($public, $private) = $this->generate_keys();

        $this->ci->load->model('autologin_model');

        // create new series or expand current series
        if (!$series) {
            list($series) = $this->generate_keys();
            $this->ci->autologin_model->insert($id, $series, $private);
        } else {
            $this->ci->autologin_model->update($id, $series, $private);
        }

        // write public key to cookie
        $cookie = array('id' => $id, 'series' => $series, 'key' => $public);
        $this->write_cookie($cookie);
    }
    
    /**
     * Disable the current autologin key and remove the cookie
     */
    private function delete_autologin() {
        if ($cookie = $this->read_cookie()) {
            // remove current series
            $this->ci->load->model('autologin_model');
            $this->ci->autologin_model->delete($cookie['id'], $cookie['series']);
            
            // delete cookie
            $this->ci->input->set_cookie(array('name' => $this->cookie_name, 'value' => '', 'expire' => ''));
        }
    }
    
    /**
     * Detects the autologin cookie and check public/private key pair
     * 
     * @return boolean
     */
    private function autologin() {
        if ($cookie = $this->read_cookie()) {
            // remove expired keys
            $this->ci->load->model('autologin_model');
            $this->ci->autologin_model->purge();
            
            // get private key
            $private = $this->ci->autologin_model->get($cookie['id'], $cookie['series']);
            
            if ($this->validate_keys($cookie['key'], $private)) {
                // mark user as logged in
                $this->ci->session->set_userdata(array('auth_key' => $cookie['id'], 'auth_loggedin' => TRUE));
                
                // user has a valid key, extend current series with new key
                $this->create_autologin($cookie['id'], $cookie['series']);
                return TRUE;
            } else {
                // the key was not valid, strange stuff going on
                // remove the active session to prevent theft!
                $this->delete_autologin();
            }
        }
        
        return FALSE;
    }
    
    /**
     * Write data to autologin cookie
     * 
     * @param array $data
     */
    private function write_cookie($data = array()) {
        $data = serialize($data);
        
        // encrypt cookie
        if ($this->cookie_encrypt) {
            $this->ci->load->library('encrypt');
            $data = $this->ci->encrypt->encode($data);
        }
        
        return $this->ci->input->set_cookie(array('name' => $this->cookie_name, 'value' => $data, 'expire' => $this->autologin_expire));
    }
    
    /**
     * Read data from autologin cookie
     * 
     * @return boolean
     */
    private function read_cookie() {
        $cookie = $this->ci->input->cookie($this->cookie_name, TRUE);
        
        if (!$cookie) {
            return FALSE;
        }
        
        // decrypt cookie
        if ($this->cookie_encrypt) {
            $this->ci->load->library('encrypt');
            $data = $this->ci->encrypt->decode($cookie);
        }
        
        $data = @unserialize($data);
        
        if (isset($data['id']) && isset($data['series']) && isset($data['key'])) {
            return $data;
        }
        
        return FALSE;
    }
    
    /**
     * Generate public/private key pair
     * 
     * @return array
     */
    private function generate_keys() {
        $public = hash($this->hash_algorithm, uniqid(rand()));
        $private = hash_hmac($this->hash_algorithm, $public, $this->ci->config->item('encryption_key'));
        
        return array($public, $private);
    }
    
    /**
     * Validate public/private key pair
     * 
     * @param string $public
     * @param string $private
     * @return boolean
     */
    private function validate_keys($public, $private) {
        $check = hash_hmac($this->hash_algorithm, $public, $this->ci->config->item('encryption_key'));
        return $check == $private;
    }

}