# simple-api-rest-class-php
This class displays a Simple Api Rest query in json format
The services are added GET, POST, PUT and DELETE

<h2>Example service post</h2>
//example_post.php?u=admin&p=123456&q=Iphone,Asus&s=post

<pre>
include('./simple_api_rest_class.php');
include('./login.php');
//Example
$query = new SimpleApiRestClass();
$query->login_user = $_GET['u'];
$query->login_pass = $_GET['p'];
$query->query = $_GET['q'];
$query->service = $_GET['s'];
$query->allows_services = 'post';
$query->db = $array_login;
$post_query = $query->ReturnLogin();
include('./server.php');
</pre>

<h2>Example service put</h2>
//example_put.php?u=admin&p=123456&q=Iphone->{name:Tablet},{value:103}&s=put
//example_put.php?u=admin&p=123456&q=Asus->{name:Phone},{value:53}&s=put

<pre>
include('./simple_api_rest_class.php');
include('./login.php');
//Example
$query = new SimpleApiRestClass();
$query->login_user = $_GET['u'];
$query->login_pass = $_GET['p'];
$query->query = $_GET['q'];
$query->service = $_GET['s'];
$query->allows_services = 'put';
$query->db = $array_login;
$post_query = $query->ReturnLogin();
include('./server.php');
</pre>

<h2>Example service get</h2>
//example_get.php?u=admin&p=123456&q=Asus,Iphone&s=get

<pre>
include('./simple_api_rest_class.php');
include('./login.php');
//Example
$query = new SimpleApiRestClass();
$query->login_user = $_GET['u'];
$query->login_pass = $_GET['p'];
$query->query = $_GET['q'];
$query->service = $_GET['s'];
$query->allows_services = 'get';
$query->db = $array_login;
$post_query = $query->ReturnLogin();
include('./server.php');
</pre>

<h2>Example service delete</h2>
//example_delete.php?u=admin&p=123456&q=Iphone,Asus&s=delete

<pre>
include('./simple_api_rest_class.php');
include('./login.php');
//Example
$query = new SimpleApiRestClass();
$query->login_user = $_GET['u'];
$query->login_pass = $_GET['p'];
$query->query = $_GET['q'];
$query->service = $_GET['s'];
$query->allows_services = 'delete';
$query->db = $array_login;
$post_query = $query->ReturnLogin();
include('./server.php');
</pre>

<h2>User data and password in login.php</h2>
Get or Post variables from the query:
?u=admin&p=123456
//name user
$array_login['user'] = 'admin';
//pass - md5 example e10adc3949ba59abbe56e057f20f883e = 123456
$array_login['pass'] = 'e10adc3949ba59abbe56e057f20f883e';

<h2>Change in server.php the connection data to the database</h2>
$connect =  mysql_connect('localhost', 'api_rest', 'xxxxxxxx');

<h2>Use</h2>

u = User login 
p = User Password
q = Query
s = Service request
$query->allows_services = That is allowed
Services get, post and delete comma separator
Examples:
q=Iphone,Asus
Service put the bitch before -> would be the name of the key and update {object name:object value}
Example:
q=Iphone->{name:Tablet},{value:103}