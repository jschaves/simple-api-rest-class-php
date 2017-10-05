<?php
/**
 * this class displays a Simple Api Rest query in json format.
 * @author Juan Chaves, juan.cha63@gmail.com
 * Copyright (C) 2017 Juan Chaves
 * This program is free software; distributed under the artistic license.
 */
//example_post.php?u=admin&p=123456&q=Iphone,Asus&s=post
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
?>