<?php

		$searchError = "";
	//get the value from the query string
	$emailFromURL = "";
	if(isset($_GET["email"]))
	{
		//if an email variable is present in the url
		$emailFromURL = trim($_GET["email"]);
		
		$decodedEmail = base64_decode(strtr($emailFromURL, '-_', '+/'));
	
	
			include("../services/databaseConnection.php");
			
			$verificationStatus = 0;
			if ($stmt = mysqli_prepare($mysqli, "SELECT email FROM grocery WHERE email = ? AND status = ?")) 
			{
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "si", $decodedEmail, $verificationStatus);

				/* execute query */
				mysqli_stmt_execute($stmt);

				/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				if($test ==0)
				{
					Header("Location:emailUrlError.php?error=error1");
				}
				
				
				/* close statement */
				mysqli_stmt_close($stmt);
			}
			/* close connection */
			mysqli_close($mysqli);
	
		
		// do validation 
		if($emailFromURL == "" || $emailFromURL == null)
		{
			//direct the user elsewhere since the email value is empty
			//header location.....
			Header("Location:emailUrlError.php?error=error2");
		}
	}else
	{
		//if no email is present in the url
		Header("Location:emailUrlError.php?error=error3");
	}
	
	
	$errorMessage = "";
	
	//make empty error messages 
		$error1 = "";
	
		//make empty value holders 
		$value1 = "";
	
	if(isset($_POST['confirmSubmit']))
	{
		//get email address from hidden field
		$encodedEmail = $_POST['emailEnc'];
		
		//get the code entered on the form
		$confirmCode = trim($_POST["confirmCode"]);
		
		//do validation
		

		$errorCounter = 0;
		
		//validate confirmCode 
		if($confirmCode == "" || $confirmCode == null)
		{
			$errorCounter++;
			$error1 = "You must enter a confirmation code.";
			$value1=$confirmCode;
		}
		else
		{
		$error2 = "";
		$value1 = $confirmCode;
		
		
		//decode email
		$decodedEmail = base64_decode(strtr($emailFromURL, '-_', '+/'));
		
		//sanitize values
		$confirmCode = filter_var($confirmCode, FILTER_SANITIZE_STRING);
		$decodedEmail = filter_var($decodedEmail, FILTER_SANITIZE_STRING);
		

		
		
		//check the database to see if the email address and the confirm code match a record in the db
		include("../services/databaseConnection.php");
		$verificationStatus = 0;
		
		$found = false;
		
		//do not forget to include the confirmation code, this is just a sample query without the confirmation code!!!!!!
		if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM grocery WHERE email = ? AND status = ? AND activationCode = ?"))
		{
			//bind parameters for markers
			mysqli_stmt_bind_param($stmt, "sis", $decodedEmail, $verificationStatus, $confirmCode);
			//execute query
			mysqli_stmt_execute($stmt);
			//store result
			mysqli_stmt_store_result($stmt);
			//get the number of rows returned
			$test = mysqli_stmt_num_rows($stmt);
			//if no results found
			if($test !=1)
			{	
				$errorMessage = "Invalid Confirmation Code or Email Address";	
			}
			else
			{
				$found = true;
			}
			//close statement
			mysqli_stmt_close($stmt);
		}
		//close connection
		mysqli_close($mysqli);
		
		
		if($found == true)
		{
			include("../services/databaseConnection.php");
			$verificationStatus = 1;
			
			//update the customer's verification status
			if ($stmt = mysqli_prepare($mysqli, "UPDATE grocery SET status = ? WHERE email = ?")) 
			{
				//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "is", $verificationStatus, $decodedEmail);
				
				//execute the query or die with the error message
				mysqli_stmt_execute($stmt) or die (mysqli_error($mysqli));

				//close statement
				mysqli_stmt_close($stmt);
			}
			//close connection
			mysqli_close($mysqli);
			
			//log the user in(remember to start the session at the top) and direct them to their home page

		//include database connection


			include("../services/databaseConnection.php");
			
			//best one to use is the id because it is the primary key
			//check db to see if credentials exist and retrieve the user's id/email/username
			$verificationStatus = 1;
			echo "Hello";
			if ($stmt = mysqli_prepare($mysqli, "SELECT groceryID, username, password, email FROM grocery WHERE email = ? AND status = ?")) 
			{
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "si", $decodedEmail, $verificationStatus);

				/* execute query */
				mysqli_stmt_execute($stmt);

				/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);

				if($test ==0)
				{
					//if no records matched
					echo"No matches";
				}
				else if($test != 0)
				{
					//if we found a record
					mysqli_stmt_bind_result($stmt, $gid, $un, $pass, $em);
							
					$GroceryID = "";
					$username = "";
					$password = "";
					$email = "";

					/* fetch values */
					if(mysqli_stmt_fetch($stmt)) 
					{
						
						echo $GroceryID = $gid;
						
						echo$username = $un;
						echo$password = $pass;
						echo$email = $em;
						
					}

				}
				
				/* close statement */
				mysqli_stmt_close($stmt);
			}
			/* close connection */
			mysqli_close($mysqli);
			
			
			
			//////////////Log User in/////////////////
			include("../services/databaseConnection.php");
			

			$verificationStatus = 1;
			if ($stmt = mysqli_prepare($mysqli, "SELECT groceryID, username, email FROM grocery WHERE username = ? AND password = ? AND status = ?")) 
			{
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "ssi", $username, $password, $verificationStatus);

				/* execute query */
				mysqli_stmt_execute($stmt);

				/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				if($test ==0)
				{
					//if no records matched
					echo"No matches";
				}
				else if($test != 0)
				{
					//if we found a record
					mysqli_stmt_bind_result($stmt, $groceryID, $un, $em);
							
					$gid = "";
					$un = "";
					$em = "";

					/* fetch values */
					if(mysqli_stmt_fetch($stmt)) 
					{
						echo "Hello <hr/>";
						echo $groceryID = $groceryID;
						echo "World <hr/>";
						
						$un = $un;
						$em = $em;
					}
						//store necessary values in session
						session_start();
					
						 $_SESSION['groceryID'] = $groceryID;
						 $_SESSION['username'] = $un;
						 $_SESSION['email'] = $em;
						
						
						Header("Location:usershp.php?email=$encodedEmail");
				}
				
				/* close statement */
				mysqli_stmt_close($stmt);
			}
			/* close connection */
			mysqli_close($mysqli);

		
		}
		
		

		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<!-- Tell MS IE to use the latest rendering engine - something you always want to include-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Set page width to size of the device and set the zoom level to 1-->
	<meta name="viewport" content="width= device-width, initial-scale = 1">

	<title>Kitchen Konnect </title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Pacifico">
	
		<!-- line style
	http://codepen.io/ibrahimjabbari/pen/ozinB-->

</head>

<body>
	<div class="container">
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		
		
		<br/>
		
		
		
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		<nav class="navbar navbar-default">
		<a href="index.php" class="pull-left"><img src="../images/kc_logo.png" alt="Kitchen Konnect" class="img"></a>
		<!--Container fluid which means that it is going to completely fill the container-->
			<div class="container-fluid"> 
				 
		<!--Container fluid which means that it is going to completely fill the container-->
			<div class="container-fluid"> 
			
				<div class="navbar-header">
					<!-- This button toggles the nav bar on and off when you are on smaller screens -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<!--  This span is to hide information from screen readers -->
						<span class="sr-only"></span>
						
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>	
					</button>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
						<li class="active"><a href="#">About Us<span class="sr-only">(About Us)</span></a></li>
						<li><a href="registration.php">Registration<span class="sr-only">(Registration)</span></a></li>
						<li><a href="login.php">Login<span class="sr-only">(Login Page)</span></a></li>
						
					</ul>
				</div>
			</div>
		</nav>
		
		<ul class="breadcrumb">
			<li ><a class="red" href="index.php">Home</a></li>
			
			</ul>
			
			
			<div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">                  
							<div class="col-md-4 ">
								<!-- onsubmit="return validateRegForm(this);" -->
								<form action="regActivation.php?email=<?php echo($emailFromURL); ?>"  onsubmit="return codeVal(this);" method="post">
		<p><legend class = "red big">
										Account Activation
										</legend>
		<span class="errorMessage"><?php echo($errorMessage); ?></span>
			
		</p>
			<label>
				Enter Confirm Code:
			</label>
			
			<input type="hidden" name="emailEnc" value="<?php echo($emailFromURL) ?>" />
			<input type="text" class="form-control" placeholder="Enter confirmation code." name="confirmCode" id="confirmCode" value="<?php echo($value1); ?>" />
			
			<span id="error1" class="errorMessage"><?php echo($error1); ?></span>
			<div>
			
			<br/>
			<button type="submit" name="confirmSubmit" value="Submit" class="btn btn-danger">Verify Account</button>
										<br/>		
							<br/>		
							<br/>		
							<br/>		
							<br/>		
							
									
			</div>
		</form>
									
                                </div>
									

				
							
                               
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
						<br/><br/><br/><br/>
                    </div>
                    <!-- /.panel -->	
                </div>
                <!-- /.col-lg-12 -->	
            </div>
            <!-- /.row -->

		<hr class="style2"/>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h6>Copyright &copy; 2016 Kitchen Konnect </h6>
					</div>			
				</div>
			</div>
		</footer>
	</div>


	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>