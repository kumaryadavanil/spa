<?php

class Post_model extends CI_Model {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();     
        $this->load->library('curl'); 
    }
    
    public function getPosts($id = FALSE){
        if($id){
            $url = "https://my-json-server.typicode.com/kumaryadavanil/json/posts/" . $id;   
            $posts = $this->curl->simple_get($url);
        }else{
            $url = "https://my-json-server.typicode.com/kumaryadavanil/json/posts";   
            $posts = $this->curl->simple_get($url);
        }        
        $posts = json_decode($posts);
        return $posts;
    }
    
}