<?php
session_start();
//example_put.php?q=Iphone&u=name:Tablet,value:103
if($_SESSION['loggedin']) {
	include('./simple_api_rest_class.php');
	include('./login.php');
	//Example
	$query = new SimpleApiRestClass();
	$query->session_ok = $_SESSION['loggedin'];
	$query->query = $_REQUEST['q'];
	$query->update = $_REQUEST['u'];
	$query->allows_services = 'put';
	$post_query = $query->ReturnLogin();
	include('./server.php');
}
?>