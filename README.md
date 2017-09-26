# simple-api-rest-class-php
This class displays a Simple Api Rest query in json format
<pre>
&#60;?php
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
	private $get_key;
	
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
			
			return $this->_login();
		//if loguin error
		} else {
			
			echo 'User or password is wrong';
		
		}
		
    }
   
    /**
     * Method private _login.
     * @return the result in json format.
     */
    private function _login() {

		return '{"' . $this->query . '":' . json_encode($this->db[$this->query]) . '}'; 
		
    }
		
}


//name user
$array_login['user'] = 'admin';
//pass - md5 example e10adc3949ba59abbe56e057f20f883e = 123456
$array_login['pass'] = 'e10adc3949ba59abbe56e057f20f883e';
//fields to consult example simple_api_rest_class.php?u=admin&p=123456&q=brand
//results brand : "Iphone, Samsung"
$array_login['brand'] = 'Iphone, Samsung';
$array_login['model'] = '{Iphone:[Iphone 5, Iphone 6]}, {Samsung:[Samsung Galaxy S6, Samsung Galaxy S7]}';
$array_login['quantity'] = '{Iphone:{Iphone 5:3, Iphone 6:4}';


//Example
$query = new SimpleApiRestClass();
$query->login_user = $_GET['u'];
$query->login_pass = $_GET['p'];
$query->query = $_GET['q'];
$query->db = $array_login;

header('Content-type: application/json');
echo $query->ReturnLogin();

?&#62;

</pre>
