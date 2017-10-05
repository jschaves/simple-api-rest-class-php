<?php
/**
 * this class displays a Simple Api Rest query in json format.
 * @author Juan Chaves, juan.cha63@gmail.com
 * Copyright (C) 2017 Juan Chaves
 * This program is free software; distributed under the artistic license.
 */
class SimpleApiRestClass {
   
    public $login_user;
    public $login_pass;
    public $query;
    public $db;
	public $allows_services;
	public $service;
   
    /**
     * Method public ReturnLogin.
     * @return Method private _login
     */
    public function ReturnLogin() {
        //if logging is ok
        if(
            $this->login_user === $this->db['user'] &&
            md5($this->login_pass) === $this->db['pass']
        ) {
			//If the requested permission is correct
			if($this->allows_services == $this->service) {

				switch($this->service) {
					
					case 'get':
						return $this->_return_get();
						break;
					case 'post':
						return $this->_return_post();
						break;
					case 'put':
						return $this->_return_put();
						break;
					case 'delete':
						return $this->_return_delete();
						break;
						
				}
				
			} else {
				//If the requested permission is not correct
				return 'error';
				
			}
        //if loguin error
        } else {
			//If there is a user or password error
            return 'error';
       
        }
       
    }
  
    /**
     * Method private _return_get.
     * @return the result in json format.
     */
    private function _return_get() {
		
		foreach(explode(',', $this->query) as $q) {
			
			$result[] = $q;
			
		}
		return  $result;
		
    }
	
    /**
     * Method private _return_post.
     * @return the result in json format.
     */
    private function _return_post() {
		
		foreach(explode(',', $this->query) as $q) {
			
			$result[] = $q;
			
		}
		return  $result;
		
    }
	
    /**
     * Method private _return_put.
     * @return the result in json format.
     */
    private function _return_put() {
		
		$get_key = explode('->', $this->query);
		$key = $get_key[0];
		$data = $get_key[1];
		foreach(explode(',', $data) as $q) {

			$r[$key][] = str_replace(array('{', '}'), array('', ''), $q);
			
		}

		return  $r;
		
    }
	
    /**
     * Method private _return_delete.
     * @return the result in json format.
     */
    private function _return_delete() {
		
		foreach(explode(',', $this->query) as $q) {
		
			$result[] = $q;
			
		}
		return  $result;
		
    }
       
}