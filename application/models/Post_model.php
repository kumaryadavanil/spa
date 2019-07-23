<?php

require_once APPPATH . 'libraries/Requests.php';

class Post_model extends CI_Model {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();     
        Requests::register_autoloader();        
    }
    
    public function getPosts($id = FALSE){
        $posts = [];
        if($id){                        
            $url = "https://jsonplaceholder.typicode.com/posts/" . $id;   
            $response = Requests::get($url);
        }else{                        
            $_page = $this->input->get('_page', TRUE);
            if($_page === null){
                $_page = 1;
            }
            $_limit = $this->input->get('_limit', TRUE);
            if($_limit === null){
                $_limit = 20;
            }    
            $params['_page'] = $_page;
            $params['_limit'] = $_limit;     
            $url = "https://jsonplaceholder.typicode.com/posts?" . http_build_query($params, NULL, '&');   
            $response = Requests::get($url);            
            $links = $response->headers['Link'];
            $links = str_replace("http://jsonplaceholder.typicode.com/posts", "http://172.104.46.176/codeigniter/api/post/posts", $links);            
            $posts['links'] = $links;
        }                
        $posts['data'] = json_decode($response->body);        
        return $posts;
    }
    
}