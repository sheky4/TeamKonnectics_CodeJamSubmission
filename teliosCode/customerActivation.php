<?php
	
	
	//get the value from the query string
	$emailFromURL = "";
	if(isset($_GET["email"]))
	{
		//if an email variable is present in the url
		$emailFromURL = trim($_GET["email"]);
		
		$decodedEmail = base64_decode(strtr($emailFromURL, '-_', '+/'));
	//echo($decodedEmail);
	
			include("services/databaseConnection.php");
			
			$verificationStatus = 0;
			if ($stmt = mysqli_prepare($mysqli, "SELECT email FROM customer WHERE email = ? AND status = ?")) 
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
	
	//for security you should
	//decode the email
	//sanitize
	//check the database to see if the email address exists, if it does not exist direct the user to a page informing them no emails being found
	//check the database to see if the email address exists, if it exists and is already verified, log them in and direct them to their home page
	//check the database to see if the email address exists, if it exists and is not verified, then they should be able to enter their verification code here on this form

	
	
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
		include("services/databaseConnection.php");
		$verificationStatus = 0;
		
		$found = false;


		
		//do not forget to include the confirmation code, this is just a sample query without the confirmation code!!!!!!
		if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM customer WHERE email = ? AND status = ? AND activationCode = ?"))
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
			include("services/databaseConnection.php");
			$verificationStatus = 1;
			
			//update the customer's verification status
			if ($stmt = mysqli_prepare($mysqli, "UPDATE customer SET status = ? WHERE email = ?")) 
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


			include("services/databaseConnection.php");
			
			//best one to use is the id because it is the primary key
			//check db to see if credentials exist and retrieve the user's id/email/username
			$verificationStatus = 1;
			echo $decodedEmail;
			echo"here";
			if ($stmt = mysqli_prepare($mysqli, "SELECT customerID, email, password FROM customer WHERE email = ? AND status = ?")) 
			{
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "si", $decodedEmail, $verificationStatus);

				/* execute query */
				mysqli_stmt_execute($stmt);

				/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				echo("/////////////");
				echo $test; 
				echo "Testtttttttttttt";
				if($test ==0)
				{
					//if no records matched
					echo"No matches";
				}
				else if($test != 0)
				{
					//if we found a record
					mysqli_stmt_bind_result($stmt, $cid, $em, $pass);
							
					$customerID = "";
					$email = "";
					$password = "";
					

					/* fetch values */
					if(mysqli_stmt_fetch($stmt)) 
					{
						$customerID = $cid;
						$email = $em;
						$password = $pass;
						
						echo" <hr/>$customerID";
						echo" <hr/>$email";
						echo" <hr/>$password";
						
					}
						//store necessary values in session
						//$_SESSION['AngelID'] = $AngelID;
						//$_SESSION['username'] = $username;
						//$_SESSION['password'] = $password;
						//$_SESSION['email'] = $email;
				}
				
				/* close statement */
				mysqli_stmt_close($stmt);
			}
			/* close connection */
			mysqli_close($mysqli);
			
			
			
			//////////////Log User in/////////////////
			include("services/databaseConnection.php");
			

			$verificationStatus = 1;
			if ($stmt = mysqli_prepare($mysqli, "SELECT customerID, email FROM customer WHERE email = ? AND password = ? AND status = ?")) 
			{
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "ssi", $email, $password, $verificationStatus);

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
					mysqli_stmt_bind_result($stmt, $cid, $em);
							
					$cid = "";
					$em = "";

					/* fetch values */
					if(mysqli_stmt_fetch($stmt)) 
					{
						$customerID = $cid;
						$email = $em;
					}
						//store necessary values in session
						session_start();
						$_SESSION['customerID'] = $customerID;
						$_SESSION['email'] = $email;
						
						Header("Location:index.php");
						
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

	<title>Activate Account</title>
	<style>
	.design{
	font-family: Rockwell;
		text-decoration:bold;
		text-align: center;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Pacifico">
	<!-- <script src="../processing/regFormValidation.js"></script> -->
<script rel = "text/javascript" src = "js/jquery-1.11.3.min.js" ></script>
	
	
		<!-- line style
	http://codepen.io/ibrahimjabbari/pen/ozinB-->


</head>

<body>
	<div class="container design" align="center">
	<br/>
	<br/>
	<br/>
	<br/>
		<div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
								<!-- onsubmit="return validateRegForm(this);" -->
								<form action="customerActivation.php?email=<?php echo($emailFromURL); ?>" method="post">
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

			</div>
		</form>
									
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

            </div>
            <!-- /.row -->
      
        <!-- /#page-wrapper -->


 
		<hr class="style2"/>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					</div>			
				</div>
			</div>
		</footer>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


	<script src="js/bootstrap.min.js"></script>
</body>
</html>