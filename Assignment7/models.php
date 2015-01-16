<?php 
if(function_exists($_GET['f'])) { 
	$model = $_GET["p"]; 

	include('/home/jcc608/Databases/database_config.php');
							
    $db_link= mysqli_connect($db_server,$db_user,$db_password,$db_name);
 	if (!$db_link)    		
    	die("Cannot connect!!!".mysqli_error());

	$str1 = 'SELECT DISTINCT model FROM make_model WHERE(make=';
	$str2 = ')ORDER BY model ASC;';
	$full = $str1.'"'.$model.'"'.$str2;

	$r = mysqli_query($db_link, $full);
	$array = array();
	
	while ($row = mysqli_fetch_row($r))   {
 		$array[] = $row[0];
 	}

	mysqli_free_result($r);
	mysqli_close($db_link);
	
	echo json_encode($array);
} 
else {
	echo 'Method Not Exist';
}


function phpFunction($val=''){      // create php function here  
echo $val ;
}
 					
?>