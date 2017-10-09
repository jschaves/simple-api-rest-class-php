# simple-api-rest-class-php
This class displays a Simple Api Rest query in json format.
Services GET, POST, PUT and DELETE.


$this->session_ok:
It is used to confirm that the user is accredited

$this->query:
Separate comma array to create, access, modify, or delete an element
note: in the put service only one field can be updated at a time

$this->update:
Array separated by comma, update the fields with the format (title: value, title: value) for service only put

$this->allows_services:
Type of service I allow in the query

To use the example, first download all the files, import simple_api_rest.sql and put the connection data to the database in connect.php.php. Then log in to login.html.

<pre>
<h2>Service post</h2>
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

<h2>Service put</h2>
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
} else {

	echo 'You must be logged in to access this site'; 
	
}

<h2>Service get</h2>
//example_get.php?q=Iphone,Asus
if($_SESSION['loggedin']) {
	include('./simple_api_rest_class.php');
	//Example
	$query = new SimpleApiRestClass();
	$query->session_ok = $_SESSION['loggedin'];
	$query->query = $_REQUEST['q'];
	$query->allows_services = 'get';
	$post_query = $query->ReturnLogin();
	include('./server.php');
} else {

	echo 'You must be logged in to access this site'; 
	
}

<h2>Service delete</h2>
//example_delete.php?q=Iphone,Asus
if($_SESSION['loggedin']) {
	include('./simple_api_rest_class.php');
	//Example
	$query = new SimpleApiRestClass();
	$query->session_ok = $_SESSION['loggedin'];
	$query->query = $_REQUEST['q'];
	$query->allows_services = 'delete';
	$post_query = $query->ReturnLogin();
	include('./server.php');
} else {

	echo 'You must be logged in to access this site'; 
	
}
</pre>
