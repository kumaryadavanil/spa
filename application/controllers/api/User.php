<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/**
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User extends REST_Controller {

    function __construct()
    {
        parent::__construct();             
    }

    public function login_post()
    {
        $reponse = [];
        $user = $this->post('user');
        $pass = $this->post('pass');
        if($user == 'anil' && $pass == 'pass'){
            $reponse['token'] = $this->config->item('token_auth_token');
            $this->set_response($reponse, REST_Controller::HTTP_OK);
        }else{
            $reponse['error'] = 'Invalid Login Details';
            $this->set_response($reponse, REST_Controller::HTTP_UNAUTHORIZED);
        }  
    }
}
