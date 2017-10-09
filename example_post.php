<?php
session_start();
//example_post.php?q=Iphone,Asus
if($_SESSION['loggedin']) {
	include('./simple_api_rest_class.php');
	//Example
	$query = new SimpleApiRestClass();
	$query->session_ok = $_SESSION['loggedin'];
	$query->query = $_REQUEST['q'];
	$query->allows_services = 'post';
	$post_query = $query->ReturnLogin();
	include('./server.php');
} else {

	echo 'You must be logged in to access this site'; 
	
}
?>