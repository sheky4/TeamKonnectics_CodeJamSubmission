<?php
	session_start();
	 $customerID = $_SESSION['customerID'];
	 $email = $_SESSION['email'];
	//echo"This is the ID ". $customerID;
	//echo"<br/>This is the email  ". $email;
	

	$success = "";
	$listID2 = "";
	//if the user clicked the submit button
	if(isset($_POST['createListSubmit']))
	{
		//make empty error messages
		$error1 = "";
		$error2 = "";
		$error3 = "";
		
		
		//make empty value holders
		$value1 = "";
		$value2 = "";
		$value3 = "";
		
		
		
		
		
		//post the values from the form
		$name = trim($_POST["name"]);
		$category = trim($_POST["category"]);
		$grocery = trim($_POST["grocery"]);
		
		$errorCounter = 0;
		
		//validation for name
		if($name == "" || $name == null)
		{
			$errorCounter++;
			$error1 = "You must enter your list name";
		}
		else
		{
			$error1 = "";
			$value1 = $name;
		}
		
		
		
		//validation for category
		if($category == "" || $category == null || $category == "default")
		{
			$errorCounter++;
			$error2 = "You must select a category";
		}
		else
		{
			$error2 = "";
			$value2 = $category;
		}
		
		
		
		//validation for grocery
		if($grocery == "" || $grocery == null || $grocery == "default")
		{
			$errorCounter++;
			$error3 = "You must select a grocery";
		}
		else
		{
			$error3 = "";
			$value3 = $grocery;
		}
		
		
		
		
		//put all validation before this final check
		if($errorCounter !=0)
		{
			//regenerate the captcha
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 6; $i++) 
			{
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
		   $captchaVal = implode($pass);
			$_SESSION['cval'] = $captchaVal;
		}
		else
		{
			//insert into the db
			//commonize
			$name = strtolower($name);
			
			
			
			//sanitize
			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$category = filter_var($category, FILTER_SANITIZE_STRING);
			$grocery = filter_var($grocery, FILTER_SANITIZE_STRING);
			
			
			$date = date('d-m-Y');
		 $triggered = 0;
		 $groceryAccess = 'no';
		 $status = 'unfulfilled';
			
			include("services/databaseConnection.php");
			if ($stmt = mysqli_prepare($mysqli, "INSERT INTO list(listName, catID, groceryID, customerID, listDate, triggered, groceryAccess, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) 
			{
				//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "siiisiss", $name, $category, $grocery, $customerID, $date, $triggered, $groceryAccess, $status);
				
				//execute the query or die with the error message
				mysqli_stmt_execute($stmt) or die (mysqli_error($mysqli));
				
				mysqli_stmt_store_result($stmt);
				
				$test = mysqli_stmt_num_rows($stmt);
				
				if($test ==0){
					
				//create a prepared statement
				include("services/databaseConnection2.php");
						$stmt = mysqli_prepare($mysqli, "SELECT list.listID FROM list WHERE customerID = ? ORDER BY list.listID  DESC LIMIT 1 "); 
						
			//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "i", $customerID);
				
			/* execute query */
			mysqli_stmt_execute($stmt);
			
			
			/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				mysqli_stmt_bind_result($stmt, $listID2);	
				
				/* fetch values */
					if(mysqli_stmt_fetch($stmt)) 
					{
					//	echo $listID2 = $listID2;
						
						//echo "This is the list ID ". $listID2;
					
					
					//echo $listID2;
					$success = "<div align='center'>Success!! <br/> <a  href='viewCustomerLists.php?listID=$listID2'><img src='images/addBtn.png' alt='Edit' class='img'/>Add items to last list.</a></div>";

}
				
				}
				else{
					
				}

				//close statement
				mysqli_stmt_close($stmt);
			}
			
		
			
			
			

			//close connection
			mysqli_close($mysqli);
			
			
			//or rather send to a confirmation page
			//Header("Location: registrationConfirmation.php");
			
			//die(); 
		}
		
	}
	//if the page is loading for the first time
	else
	{
		
		
		//make empty error messages
		$error1 = "";
		$error2 = "";
		$error3 = "";
		
		//make empty value holders
		$value1 = "";
		$value2 = "";
		$value3 = "";
	}
	
	
?>





<!DOCTYPE HTML>


		<head>

			<title>KitchenKonnect</title>
			<style>
				.design{
				font-family: Rockwell;
					text-decoration:bold;
					text-align: center;
				}
			</style>
					<!--[if lt IE 9]>
					<script src="js/dist/html5shiv.js"></script>
					<![endif]-->
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				  <!-- If IE use the latest rendering engine -->
				<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
				
				   <!-- Set the page to the width of the device and set the zoon level -->
				<meta name="viewport" content="width = device-width, initial-scale = 1"/>
				   
				<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
				<link rel="stylesheet" type="text/css" href="css/styles.css">
			   
		</head>

<body>
					<form name="back" method="post" action="index.php">
					<input type="image" src="images/homeBtn.png" alt="Home">
					</form> 
					
					<form name="back" method="post"align = "right"action="ipCamera/cam.html">
					<input type="image" src="images/viewFeed.png" alt="Camera Feed">
					</form> 
					
<form name="sampleForm" method="post" align="center" class="design" action="createList1.php">
			<fieldset>
				<legend class = "red medium">Please Create Your List</legend>
				
				<label>*ListName:</label>
				<input type="text" name="name" required="required" value="<?php echo($value1); ?>" placeholder="Enter Name" />
				<span id="error1"><?php echo($error1); ?></span>
				<br /><br />
				
				
				<label>Category:</label>
				<select name="category">
					<option value="default">Select Category</option>
					<?php
						include("services/databaseConnection.php");
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT catID, catDescription FROM category");
						if ($stmt) 
						{
							//execute query
							mysqli_stmt_execute($stmt);
							
							mysqli_stmt_bind_result($stmt, $catID, $catDescription);
							
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				if($value2 == $catID)
				{
					echo('<option value="'.$catID.'" selected="selected">'.$catDescription.'</option>');
				}
				else
				{
					echo('<option value="'.$catID.'">'.$catDescription.'</option>');
				}
			}	
					
			//close statement
			mysqli_stmt_close($stmt);
		}
						//close connection
						mysqli_close($mysqli);	
					?>
				</select>
				<span id="error2"><?php echo($error2); ?></span>
				<br /><br />
					
					
					<label>Grocery:</label>
				<select name="grocery">
					<option value="default">Select Grocery</option>
					<?php
						include("services/databaseConnection.php");
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT groceryID, supermarket FROM grocery");
						if ($stmt) 
						{
							//execute query
							mysqli_stmt_execute($stmt);
							
							mysqli_stmt_bind_result($stmt, $groceryID, $supermarket);
							
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				if($value3 == $groceryID)
				{
					echo('<option value="'.$groceryID.'" selected="selected">'.$supermarket.'</option>');
				}
				else
				{
					echo('<option value="'.$groceryID.'">'.$supermarket.'</option>');
				}
			}	
					
			//close statement
			mysqli_stmt_close($stmt);
		}
						//close connection
						mysqli_close($mysqli);	
					?>
				</select>
				<span id="error3"><?php echo($error3); ?></span>
				<br /><br />
					
					
					
					
				
			</fieldset>
			
			<input type="submit" class ="btn-danger" name="createListSubmit" value="Submit" />
			<input type="reset" class ="btn-danger" name="createListReset" value="Reset" onclick="return resetForm();" />
		</form>
		<span class="errorMessage"><?php echo($success); ?></span>
		
<!-- NOTE THIS WEB SITE BUILT WAS DESIGNED USING A BOOTSTRAP TEMPLATE TAKEN FROM Derek Banas AT http://www.newthinktank.com/2015/11/learn-bootstrap-one-video/ --> 


	<!-- bootstrap bit --> 

		<!-- container puts padding around itself while container-fluid fills the whole screen. Bootstap grids require a container. -->
			<div class="container"  > 
			<div class="page-header">
				 
			</div>
		   </div> 

					
					
					<br/> <br/> 
					
				
				<!-- FOOTER AREA --> 
				<footer id="footer" align = "center">
			 
		 </footer>

		<!-- BootStrap Links --> 
		<audio id="trigger1" src="triggerSound1.mp3" preload="auto"></audio>
    		<script type="text/javascript" src="fence.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    
</body>

</html>
<html>
<!--This is the notification code-->
			<script>
			//put the customerID here as a javascript variable
			var customerID = <?php echo ($customerID);?>;
			//alert(customerID);
		</script>
		<script src="ajax_Refresh.js"></script>
		<script src="count_down.js"></script>
		
		
		<audio id="trigger1" src="triggerSound1.mp3" preload="auto"></audio>
		
	<!-- This is the end of it-->
</html>