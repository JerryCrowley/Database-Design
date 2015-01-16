<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8" />
	<title> Assignment 7</title>
	<link rel="stylesheet" href="assignments.css" />
</head>

<style>
	#box {  
        margin: 0px auto 0px auto;  
        width:600px;  
    }  
</style>
<body>
<div id="box" class="box">  
        <h4>Assignment 7</h4>
        <h5></h5>
          
        <div class="area">
			<?php
				$make = $_POST['Make'];
				$model = $_POST['Model'];
				
				if(($make == 'Make') || ($make == 'make')){
					echo '<p>No results found, please try again.</p>';
				}
				
				else{
                	$sort = $_POST['sortKey'];
                	include('/home/jcc608/Databases/database_config.php');
                
                	$db_link= mysqli_connect($db_server,$db_user,$db_password,$db_name);
                	if (!$db_link)    		
                    	die("Cannot connect!!!".mysqli_error());
            			
					$q = "SELECT lot,year,make,model,salePrice,highBid,pic FROM results WHERE (make = '".$make."') AND (model = '".$model."') ORDER BY salePrice ".$sort;
				
            	    // print the query for testing purposes
                	print("<p>Query: $q</p>\n");
                	$r = mysqli_query($db_link, $q);
                	$n = mysqli_num_rows($r)  ; 	
                	print("<p>$n rows found.</p>\n");
				
					if($n == 0){
						echo '<p>No results found, please try again.</p>';
					}
        
					else{
						echo '<table border="1" style="width:100%"><thead><tr>';
						echo '<th>Lot</th>';
						echo '<th>Year</th>';
						echo '<th>Make</th>';
						echo '<th>Model</th>';
						echo '<th>Sale Price</th>';
						echo '<th>High Bid</th>';
						echo '<th>Picture</th>';
						echo '</tr></thead><tbody>';	
								
						while ($row = mysqli_fetch_row($r)){
							echo '<tr>';
							for($i = 0; $i < sizeof($row); $i++){
								switch($i){
									case 1:{
										if(($row[$i] == 0) || ($row[$i] > 2014)){
											echo '<td>N/A</td>';
										}
										else{
											echo '<td>'.$row[$i].'</td>';
										}
										break;
									}
									case 4:{
										if(($row[$i] == 0)||($row[$i] == '0')){
											echo '<td>Not Sold</td>';
										}
										else{
											echo '<td>$'.$row[$i].'</td>';
										}
										break;
									}
									case 5:{
										if(($row[4] != '0')||($row[4] == 0)){
											echo '<td>$'.$row[4].'</td>';
										}
										else{
											echo '<td>$'.$row[5].'</td>';
										}
										break;
									}
									case 6:{
										if(($row[$i] == 'None')||($row[$i] == "none")){
											echo '<td><img src="no_image_found.png" height="137" width="182"></td>';
										}
										else{
											echo "<td><img src='".$row[$i]."'></td>";
										} 
										break;
									}
									default:{
										echo '<td>'.$row[$i].'</td>';
									}
								}
							}
							echo '</tr>';
						}
									
						echo '</tbody></table>';
						mysqli_free_result($r);
						mysqli_close($db_link);
					}
				}
            ?>
      </div>
<footer>
 	<p style="color:#cccccc;font-family:Verdana, Geneva, sans-serif;font-size:10px"><a href="index.html">Assignments Page</a></p>
</footer> 
</body>
</html>