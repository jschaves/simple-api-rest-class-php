<?php
session_start();
/**
 * this class displays a Simple Api Rest query in json format.
 * @author Juan Chaves, juan.cha63@gmail.com
 * Copyright (C) 2017 Juan Chaves
 * This program is free software; distributed under the artistic license.
 */
//example_delete.php?u=admin&p=123456&q=Iphone,Asus&s=delete
if($_SESSION['loggedin']) {
	include('./simple_api_rest_class.php');
	//Example
	$query = new SimpleApiRestClass();
	$query->session_ok = $_SESSION['loggedin'];
	$query->query = $_REQUEST['q'];
	$query->allows_services = 'delete';
	$post_query = $query->ReturnLogin();
	include('./server.php');
}
?>