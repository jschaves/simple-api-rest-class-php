# simple-api-rest-class-php
This class displays a Simple Api Rest query in json format
<pre>
//name user
$array_login['user'] = 'admin';
//pass - md5 example e10adc3949ba59abbe56e057f20f883e = 123456
$array_login['pass'] = 'e10adc3949ba59abbe56e057f20f883e';
//fields to consult example simple_api_rest_class.php?u=admin&p=123456&q=brand
//results brand : "Iphone, Samsung"
$array_login['brand'] = 'Iphone, Samsung';
$array_login['model'] = '{Iphone:[Iphone 5, Iphone 6]}, {Samsung:[Samsung Galaxy S6, Samsung Galaxy S7]}';
$array_login['quantity'] = '[3, 5], [4, 2]';




//Example
$query = new SimpleApiRestClass();
$query->login_user = $_GET['u'];
$query->login_pass = $_GET['p'];
$query->query = $_GET['q'];
$query->db = $array_login;

header('Content-type: application/json');
echo $query->ReturnLogin();
</pre>
