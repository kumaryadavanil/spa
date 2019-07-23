<?php

class AUTHORIZATION
{
	public static function generateToken($data) {
        
    }
	
	public static function validateToken($headers, $token) {    	
		$token_input = $headers['Authorization'];
		if($token_input == $token){
			return true;
		}
		return false;
    }
}