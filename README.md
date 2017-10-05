# simple-api-rest-class-php
This class displays a Simple Api Rest query in json format
The services are added GET, POST, PUT and DELETE
example_post.php?u=admin&p=123456&q=Iphone,Asus&s=post
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
