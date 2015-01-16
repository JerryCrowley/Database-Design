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
            <form id="form1" action="addNewCar.php" method="post">
            
			<fieldset>
				<legend>Add Car</legend>
                <p>
					Lot Number
					<input type="text" name="lot" />
				</p>
				<p>
					Make
					<input type="text" name="make" />
				</p>
				<p>
					Model
					<input type="text" name="model" />
				</p>
				<p>
					Year
					<input type="text" name="year" />
				</p> 
                <p>
					Sale Price
					<input type="text" name="salePrice" />
				</p> 
                <p>
					High Bid
					<input type="text" name="highBid" />
				</p> 
                <p>
					Pic
					<input type="text" name="pic" />
				</p> 
            </fieldset>
			<input type=submit value=Submit>
			<input type=reset value=Reset>
			</form>
        </div>
        <footer>
    		<p style="color:#cccccc;font-family:Verdana, Geneva, sans-serif;font-size:10px"><a href="index.html">Assignments Page</a></p>
		</footer> 
    </div>
</body>
</html>