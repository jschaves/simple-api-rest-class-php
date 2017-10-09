<?php
//Server DB
if($post_query[0] != 'error' && $_SESSION['loggedin']) {

	include('./connect.php');
	
	if(!$connect) {
		
		echo ' Could not select database';

	} else {
		
		if(!mysql_select_db('api_rest', $connect)) {
		
			echo 'Could not select database';
		
		} else {
			//The post service creates a new field
			if($query->allows_services === 'post') {
				
				foreach($post_query as $pq) {

					$consult = mysql_query('INSERT INTO `simple_api_rest`(`ID`) VALUES (\'' . mysql_real_escape_string($pq) . '\')', $connect);
					
					if(mysql_affected_rows() > 0) {

						$output_data[$pq] = $pq . ': Created successfully';
					
					} else {

						$output_data[$pq] = $pq . ': already exists';
						
					}
				
				}
			//The delete service deletes a field and its values
			} else if($query->allows_services === 'delete') {
				
				foreach($post_query as $pq) {

					$consult = mysql_query('DELETE FROM simple_api_rest WHERE ID = "' . mysql_real_escape_string($pq) . '"', $connect);

					if(mysql_affected_rows() > 0) {

						$output_data[$pq] = $pq . ': Was successfully eliminated';
					
					} else {

						$output_data[$pq] = $pq . ': Not found in the database';
						
					}
				
				}
			//The get service displays a field and its values
			} else if($query->allows_services === 'get') {

				foreach($post_query as $pq) {

					$consult = mysql_query('SELECT `name`, `value` FROM simple_api_rest WHERE ID = \'' . mysql_real_escape_string($pq) . '\'', $connect);
					
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
			} else if($query->allows_services === 'put') {

				foreach($post_query as $key => $pq) {
					
					foreach($pq as $data) {
						
						$name_value = explode(':', $data);
						$string_query = 'UPDATE `simple_api_rest` SET `' . trim(mysql_real_escape_string($name_value[0])) . '`=\'' . trim(mysql_real_escape_string($name_value[1])) . '\' WHERE `ID`=\'' . trim(mysql_real_escape_string($key)) . '\'';
						$consult = mysql_query($string_query, $connect);
						if(mysql_affected_rows() > 0) {
							
							$output_data[$key][] = $data . ' was successfully updated';
						
						} else {

							$output_data[$key][$data] = $data . ' Failed to update, view sent values or the value is not changed because it is the same';
							
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
	
	echo $post_query[1];
	
}
?>