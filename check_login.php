<?php
session_start();

if($_GET['logout']) {
	
	session_destroy();
	echo '<script>window.location.replace("./login.html");</script>';
	
} else {

	include('connect.php');

	if(!mysql_select_db('api_rest', $connect)) {

		session_destroy();
		echo 'Could not select database';

	} else {

		$username = $_POST['user'];
		$password = $_POST['password'];

		$sql = mysql_query('SELECT `user`, `password` FROM `users` WHERE `user` = \'' . mysql_real_escape_string($username) . '\'', $connect);

		$result = mysql_fetch_row($sql);

		if($result > 0) {     

			if(md5($password) === $result[1]) { 

				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
				
				mysql_close($connect);
				
				
				echo '<!DOCTYPE html>';
				echo '<html>';
				echo '<head>';
				echo '<meta charset="utf-8">';
				echo '<link href=\'https://fonts.googleapis.com/css?family=Asap\' rel=\'stylesheet\'>';
				echo '<style>';
				echo 'body {font-family: \'Asap\';font-size: 15px;}';
				echo 'input[type="text"] {width: 95%;height: 30px;padding: 5px;margin: 5px;}';
				echo 'button {width: 20%;height: 30px;padding: 5px;margin: 5px;}';
				echo '</style>';
				echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
				echo '<script>';
				echo '$(document).ready(function(){';
				echo '$(\'button\').click(function(){';
				echo 'var service = $(this).attr(\'id\');';
				echo 'var query = $(\'#input-\' + service).val();';
				echo 'if(service === \'put\') {var update = $(\'#input-put-u\').val();}';
				echo '$(\'#view\').html(\'<iframe style="width: 100%;margin: 5px 0 0 10px;" src="example_\' + service + \'.php?q=\' + query + \'&u=\' + update + \'"></iframe>\');';
				echo 'return false;';
				echo '})';
				echo '})';
				echo '</script>';
				echo '</head>';
				echo '<body>';
				echo '<div style="width:25%;float:left">';
				echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
				echo '<h3>Simple Api Rest query Examples</h3><hr>';
				echo '<p><b>Example service post</b></p>';
				echo '<form type="post" action="./example_post.php">';
				echo '<label>Name of new objects separated by commas:</label><br>';
				echo '<input type="text" id="input-post" name="q" value="Iphone,Asus,Samsung" /><br><br>';
				echo '<button name="post" id="post" >Post</button>';
				echo '</form><hr>';
				echo '<p><b>Example service put</b></p>';
				echo '<form type="put" action="./example_put.php">';
				echo '<label>Name of the object:</label><br>';
				echo '<input type="text" id="input-put" name="q" value="Iphone" /><br>';
				echo '<label>Fields to modify "object title: new value", separated by commas:</label><br>';
				echo '<input type="text" id="input-put-u" name="u" value="name:Mobile,value:100" /><br><br>';
				echo '<button name="put" id="put" >Put</button>';
				echo '</form><hr>';
				echo '<p><b>Example service get</b></p>';
				echo '<form type="post" action="./example_get.php">';
				echo '<label>Name of objects to list, separated by commas:</label><br>';
				echo '<input type="text" id="input-get" name="q" value="Iphone,Asus,Samsung" /><br><br>';
				echo '<button name="get" id="get" >Get</button>';
				echo '</form><hr>';
				echo '<p><b>Example service delete</b></p>';
				echo '<form type="post" action="./example_delete.php">';
				echo '<label>Name of object to delete,  separated by commas:</label><br>';
				echo '<input type="text" id="input-delete" name="q" value="Iphone,Asus,Samsung" /><br><br>';
				echo '<button name="delete" id="delete" >Delete</button>';
				echo '</form>';
				echo '<a href="./check_login.php?logout=1">Logout</a>';
				echo '</div>';
				echo '<div id="view" style="width:70%;float:left"></div>';
				echo '</body>';
				echo '</html>';

				
			} else { 

				session_destroy();
				echo 'The user or password is incorrect <a href="./login.html">Login</a>';

			}
		 
		} else {
			
			session_destroy();
			echo 'The user or password is incorrect <a href="./login.html">Login</a>';
		
		}
		
	}
}

?>