<?php

require_once APPPATH . 'libraries/Requests.php';

class Comment_model extends CI_Model {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();     
        Requests::register_autoloader(); 
    }
    
    public function getComments($id = FALSE){
        if($id){
            $url = "https://jsonplaceholder.typicode.com/comments?postId=" . $id;   
            $response = Requests::get($url);            
        }else{
            $url = "https://jsonplaceholder.typicode.com/comments";   
            $response = Requests::get($url);            
        }        
        $comments = json_decode($response->body);
        return $comments;
    }
    
}