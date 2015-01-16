<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title> Assignment 7</title>
	<link rel="stylesheet" href="assignments.css" />
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 

<script>
	function updateModels(sel) {	
		$.ajax({
       		type: 'POST',
 			url: "models.php?f=phpFunction&p="+sel.options[sel.selectedIndex].value, 
  			dataType:"json",
			data: {},
  			success: function(data1){
        		addSelects(data1)
			}
		});
	}
	
	function addSelects(data1){	
		select = document.getElementById('Model');
		
		select.options.length = 0;
		counter = 0;
		
		for (var i = 0; i<data1.length; i++){
    		var opt = document.createElement('option');
    		opt.value = data1[i];
    		opt.innerHTML = data1[i];
    		select.appendChild(opt);
			counter++;
		}
		
		if(counter == 0){
			var opt = document.createElement('option');
    		opt.value = "Model";
    		opt.innerHTML = "Model";
    		select.appendChild(opt);
		}
	}
		
</script>
</head>

<body>   
    <div id="box" class="box">  
        <h4>Assignment 7</h4>
        <h5></h5>
          
        <div class="area">  
            <form id="form1" action="assignment7.php" method="post">
            
			<fieldset>
				<legend>Mecum Auction Database</legend>
					<p>To get started, select a make and model.</p>
                    
                    <select name="Make" onchange="updateModels(this);">
                   		<?php
							$value=$_POST ["make"];
                            include('/home/jcc608/Databases/database_config.php');
							
                            $db_link= mysqli_connect($db_server,$db_user,$db_password,$db_name);
 	    					if (!$db_link)    		
    							die("Cannot connect!!!".mysqli_error());

							$fetch_makes = mysqli_query($db_link, "SELECT DISTINCT name FROM MAKE");
							$counter = 0;

							while($throw_makes = mysqli_fetch_row($fetch_makes)) {
								if($counter == 0){
									echo '<option value=',"Make",'>Make</option>';
								}
                            	echo '<option   value=',"$throw_makes[0]",'>',"$throw_makes[0]",'</option>';
								$counter+=1;
							}
							echo "</select>";
							
                           	mysqli_free_result($fetch_makes);
							mysqli_close($db_link);
						?>
                	</br>
                    
					<select name="Model" id="Model">
						<option value="Model">Model</option>
					</select>
                    </br>
                    
                    <select name="sortKey">
                    	<option value="Asc">Price Ascending</option>
                        <option value="Desc">Price Descending</option>
                    </select>
        	</fieldset>
       	
        	<input type="submit">
			<input type="button" value="Reset" onClick="document.getElementById('form1').reset();">
            <input type="button" value="Create New Value" onClick="location.href='newCar.php';"> 
	    	</form>
        </div>
         
        <footer>
    		<p style="color:#cccccc;font-family:Verdana, Geneva, sans-serif;font-size:10px"><a href="index.html">Assignments Page</a></p>
		</footer> 
    </div>
</body>
</html>