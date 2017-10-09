<?php
session_start();
//example_delete.php?&q=Iphone,Asus
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