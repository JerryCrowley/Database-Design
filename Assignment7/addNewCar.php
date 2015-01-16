<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title> Assignment 7</title>
	<link rel="stylesheet" href="assignments.css" />
</head>

<body> 

<div id="box" class="box">  
        <h4>Assignment 7</h4>
        <h5></h5>
          
        <div class="area">  
        <fieldset>
            <?php
            include('/home/jcc608/Databases/database_config.php');
            $db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
            if ($db_link->connect_errno) {
                print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
            }
            print("Connection: ".$db_link->host_info . "\n");
                
            $lot     = mysqli_real_escape_string($db_link,$_POST['lot']);
            $make   = mysqli_real_escape_string($db_link,$_POST['make']);
            $model     = mysqli_real_escape_string($db_link,$_POST['model']);
            $year     = mysqli_real_escape_string($db_link,$_POST['year']); 
            $salePrice     = mysqli_real_escape_string($db_link,$_POST['salePrice']); 
            $highBid     = mysqli_real_escape_string($db_link,$_POST['highBid']); 
            $pic       = mysqli_real_escape_string($db_link,$_POST['pic']);
            $dataCheck = 1;
            
            if ((empty ($make)) OR (empty($model)) ){
               print("<h3>The make and model are required. Please fill in the data.</h3>\n");
               $dataCheck = 0;
            }
            
            if (empty($lot))
                $lot = "NULL";
            if (empty($year))
                $year = "0";
            if (empty($salePrice))
                $salePrice = "0";
            if (empty($highBid))
                $highBid = "0";
            if (empty($pic))
                $pic = "none";
            
            if ($dataCheck > 0) {
                print("<h3><i>Added to the Results's Table: </i></h3>\n");
                print("\t<i>Lot:</i> $lot <br>\n");
                print("\t<i>Year:</i> $year <br>\n ");
                print("\t<i>Make:</i> $make <br>\n");
                print("\t<i>Model:</i> $model <br>\n");
                print("\t<i>Sale Price:</i> $salePrice <br>\n");
                print("\t<i>High Bid:</i> $highBid <br>\n");
                print("\t<i>Pic:</i> $pic \n");
                
                
                /* Creating the SQL INSERT query for testing purposes */
                $query1 = "INSERT INTO results (pic, lot, make, model, salePrice, highBid, year)
                           VALUES (\"$pic\",\"$lot\", \"$make\", \"$model\", \"$salePrice\", \"$highBid\", \"$year\");";
                
                /* for testing purposes */
                print("\n<p>Test the fields: An INSERT query would be: ". $query1 . "</p>\n");
                
                /* This is how you would run an INSERT without protection from SQL Injection: 
                $insertResult =  mysqli_query($db_link,$query1);
                */
                
                /* However ... To run this with protection from SQL Injection: */
                if ($stmt = $db_link->prepare("INSERT INTO results (pic,lot,make,model,salePrice,highBid,year)
                           VALUES (?, ?, ?, ?, ?, ?, ?)")) {
                
                  // Bind the variables to the parameter as strings. 
                  // Note that the "sssss" specifies strings for the following fields
                  $stmt->bind_param("sssssss", $pic,$lot,$make,$model,$salePrice,$highBid,$year);
                  // Execute the query
                  $stmt->execute();
                  // Close the prepared statement.
                  $stmt->close();
                }
				
				/* However ... To run this with protection from SQL Injection: */
                if ($x = $db_link->prepare("INSERT INTO make_model (make,model)
                           VALUES (?, ?)")) {
                  // Bind the variables to the parameter as strings. 
                  // Note that the "sssss" specifies strings for the following fields
                  $x->bind_param("ss", $make,$model);
                  // Execute the query
                  $x->execute();
                  // Close the prepared statement.
                  $x->close();
                }
				
				/* However ... To run this with protection from SQL Injection: */
                if ($y = $db_link->prepare("INSERT INTO MAKE (name)
                           VALUES (?)")) {
                  // Bind the variables to the parameter as strings. 
                  // Note that the "sssss" specifies strings for the following fields
                  $y->bind_param("s",$make);
                  // Execute the query
                  $y->execute();
                  // Close the prepared statement.
                  $y->close();
                }
                        
                /* Closing connection */
                mysqli_close($db_link);
            
            } // end of dataCheck >0
            ?>
           </fieldset>
           </div>
           <footer>
    			<p style="color:#cccccc;font-family:Verdana, Geneva, sans-serif;font-size:10px"><a href="index.html">Assignments Page</a></p>
		   </footer> 
           </div>
</body>
</html>


