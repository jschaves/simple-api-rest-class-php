<?php
/**
 * this class displays a Simple Api Rest query in json format.
 * @author Juan Chaves, juan.cha63@gmail.com
 * Copyright (C) 2017 Juan Chaves
 * This program is free software; distributed under the artistic license.
 */
if($post_query != 'error') {
	
	$connect =  mysql_connect('localhost', 'api_rest', '9243aabb');
	mysql_set_charset('utf8', $connect);
	
	if(!$connect) {
		
		echo ' Could not select database';

	} else {
		
		if(!mysql_select_db('api_rest', $connect)) {
		
			echo 'Could not select database';
		
		} else {
			//The post service creates a new field
			if($query->service === 'post') {
				
				foreach($post_query as $pq) {
				
					$consult = mysql_query('INSERT INTO `simple_api_rest`(`ID`) VALUES (\'' . $pq . '\')', $connect);
					
					if(mysql_affected_rows() > 0) {

						$output_data[$pq] = $pq . ': Created successfully';
					
					} else {

						$output_data[$pq] = $pq . ': already exists';
						
					}
				
				}
			//The delete service deletes a field and its values
			} else if($query->service === 'delete') {
				
				foreach($post_query as $pq) {

					$consult = mysql_query('DELETE FROM simple_api_rest WHERE ID = "' . $pq . '"', $connect);

					if(mysql_affected_rows() > 0) {

						$output_data[$pq] = $pq . ': Was successfully eliminated';
					
					} else {

						$output_data[$pq] = $pq . ': Not found in the database';
						
					}
				
				}
			//The get service displays a field and its values
			} else if($query->service === 'get') {

				foreach($post_query as $pq) {

					$consult = mysql_query('SELECT `name`, `value` FROM simple_api_rest WHERE ID = "' . $pq . '"', $connect);
					$rows = mysql_fetch_row($consult);
					
					if($rows > 0) {

						foreach($rows as $key => $value) {
							
							if($key === 0) {
								
								$k = 'name';
								
							} else if($key === 1) {
								
								$k = 'value';
							
							}
								
							$output_data[$pq][$k] = $value;
							
						}
					
					} else {

						$output_data[$pq] = $pq . ': Not found in the database';
						
					}
				
				}
			//The put service updates the values ​​of a field
			} else if($query->service === 'put') {

				foreach($post_query as $key => $pq) {
					
					foreach($pq as $data) {
						
						$name_value = explode(':', $data);
						$string_query = 'UPDATE `simple_api_rest` SET `' . trim($name_value[0]) . '`=\'' . trim($name_value[1]) . '\' WHERE `ID`=\'' . trim($key) . '\'';
						$consult = mysql_query($string_query, $connect);
						if(mysql_affected_rows() > 0) {
							
							$output_data[$key][] = $data . ' was successfully updated';
						
						} else {

							$output_data[$key][$data] = $data . ' Not found in the database';
							
						}
		
					}
									
				}
			
			}
			
			mysql_close($connect);
			header('Content-type: application/json');
			//Display query in json format
			echo json_encode($output_data);				
			
		}
		
	}
	
} else {
	
	echo 'Error check your permissions';
	
}
?>