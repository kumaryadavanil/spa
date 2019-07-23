<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Comment extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();     
        $this->load->model('Comment_model', 'post');
    }

    public function comments_get()
    {
        $response = [];
        $headers = $this->input->request_headers();
        $token = $this->config->item('token_auth_token');        
        if(AUTHORIZATION::validateToken($headers, $token)){
            $id = $this->get('id');
            if($id === null){
                $posts = $this->post->getComments();        
            }else{
                $posts = $this->post->getComments($id);
            }
            $this->set_response($posts, REST_Controller::HTTP_OK);
        }else{
            $status = REST_Controller::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'error' => 'Unauthorized Access!'];
            $this->response($response, $status);
        }
    }
}
