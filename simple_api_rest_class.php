<?php
/**
 * this class displays a Simple Api Rest query in json format.
 * @author Juan Chaves, juan.cha63@gmail.com
 * Copyright (C) 2017 Juan Chaves
 * GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007.
 */
class SimpleApiRestClass {
   
    public $query;
	public $allows_services;
	public $session_ok;
	public $update;
  
    /**
     * Method public ReturnLogin.
     * @return Method private _login
     */
    public function ReturnLogin() {
		
        //if logging is ok
        if($this->session_ok) {
			//If the requested permission is correct
			if($this->allows_services && !empty($this->query)) {

				switch($this->allows_services) {
					
					case 'get':
						return $this->_return_get();
						break;
					case 'post':
						return $this->_return_post();
						break;
					case 'put':
						if(!empty($this->query)) {
							
							return $this->_return_put();
							
						} else {
							//If the camp is empty
							return array('error', 'Field can not be empty');
							
						}
						break;
					case 'delete':
						return $this->_return_delete();
						break;
						
				}
				
			} else {
				//If the requested permission is not correct
				return array('error', 'Field can not be empty');
				
			}
        //if loguin error
        } else {
			//If there is a user or password error
            return array('error', 'User or password error');
       
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

		foreach(explode(',', $this->update) as $q) {

			$r[$this->query][] = $q;
			
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