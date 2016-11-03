<?php 

session_start();


	//if the user clicked the submit button
	if(isset($_POST['registrationSubmit']))
	{
		//make empty error meggages 
		$error1 = "";
		$error2 = "";
		$error3 = "";
		$error4 = "";
		$error5 = "";

		
		//make empty value holders 
		$value1 = "";
		$value2 = "";
		$value3 = "";
		$value4 = "";
		$value5 = "";
		
		//post the values from the form
		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);
		$confirmpassword = trim($_POST["confirmpassword"]);

		$errorCounter = 0;
		
		//validation for password
		if($password == "" || $password == null)
		{
			$errorCounter++;
			$error2 = "Enter a password";
		}
		
		//http://stackoverflow.com/questions/4366730/check-if-string-contains-specific-words
		else if (preg_match("/'/",$password)){
			$error2 = "Password cannot contain apostrophe '";
			$errorCounter++;
			$value2 = $password;
		}
		
		else if(strlen($password) < 8) 
		{
			$errorCounter++;
			$error2 = "You must enter a password that is at least 8 characters in length, for example: cow1234";
			$value2 = $password;
		}
		
		else if( (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))==false && (preg_match('/[\'^£$%&!*()}{@#~?><>,|=_+¬-]/', $password))== false)
		{
			$error2 = "Password must contain at least 1 number and 1 symbol E.g. hello_1";
			$errorCounter++;
			$value2 = $password;
		}
		
		//http://stackoverflow.com/questions/9335915/check-if-a-string-contains-numbers-and-letters
		else if( (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))==false)
		{
			$error2 = "Password must contain at least 1 number. E.g. hello_1.";
			$errorCounter++;
			$value2 = $password;
		}

		//http://stackoverflow.com/questions/3938021/how-to-check-for-special-characters-php
		else if( (preg_match('/[\'^£$%&!*()}{@#~?><>,|=_+¬-]/', $password))== false)
		{
			$error2 = "Username must contain at least 1 symbol. E.g. hello_1.";
			$errorCounter++;
			$value2 = $password;
		}
		
		else
		{
			$error2 = "";
			$value2 = $password;
		}
	
		//validation for confirm password
		if($confirmpassword == "" || $confirmpassword == null)
		{
			$errorCounter++;
			$error5 = "Enter confirm password.";
		}
		
		 else if($password != $confirmpassword)
		{
			$error5 = "Password and Confirm password do not match.";
			$errorCounter++;
			$value5 = $password;
		}
		
		else
		{
			$error5 = "";
			$value5 = $confirmpassword;
		}
	
		//do validation for email
		if($email == "" || $email == null)
		{
			$errorCounter++;
			$error3 = "Enter an email address";
		}
		
		else if (preg_match("/'/",$email)){
			$error3 = "Email cannot contain apostrophe '";
			$errorCounter++;
			$value3 = $email;
		}
		
		//check for format conformance
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errorCounter++;
			$error3 = "Please enter a valid email address. E.g. janedoe@hotmail.com";
			$value3 = $email;
		}
		
		else
		{
			//sanitize to strip html and other tags before db check
			$email1 = filter_var($email, FILTER_SANITIZE_STRING);
			$email1 = filter_var($email1, FILTER_SANITIZE_EMAIL);
			
			//include the database connection
			include("services/databaseConnection.php");
			
			if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM customer WHERE email=?")) 
			{
				//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "s", $email1);
				//execute query
				mysqli_stmt_execute($stmt);
				//store result
				mysqli_stmt_store_result($stmt);
				//get the number of rows returned
				$test = mysqli_stmt_num_rows($stmt);
				if($test !=0)
				{
					$errorCounter++;
					$error3 = "Email address already exists. Please enter a different email address.";
					$value3 = $email;					
				}
				
				else
				{
					$error3 = "";
					$value3 = $email;
				}
				
				//close statement
				mysqli_stmt_close($stmt);
			}
			//close connection
			mysqli_close($mysqli);
		}

		
		if($errorCounter = 0){
			//sanitize
			$email = filter_var($email, FILTER_SANITIZE_STRING);
			$password = filter_var($password, FILTER_SANITIZE_STRING);
			
			//sanitize email specifically 
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			
			//encrypt password
			$hash_format = "$2y$10$";
			//generate salt
			$unique_random_string = md5(uniqid(mt_rand(), true));
			$base64_string = base64_encode($unique_random_string);
			$modified_base64_string = str_replace('+', '.', $base64_string);
			$salt = substr($modified_base64_string, 0, 22);

			$format_and_salt = $hash_format.$salt;
			//this is the encrypted password to save to db
			$hash = crypt($password, $format_and_salt);
			
			//do the insert into the database 
			$image = "defaultImage.jpg";
			//http://stackoverflow.com/questions/4356289/php-random-string-generator
			function generateRandomString($length = 5) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
			}

			$activationCode = generateRandomString();
			
			$verified=0;

			
			include("services/databaseConnection.php");
			
			if ($stmt = mysqli_prepare($mysqli, "INSERT INTO customer(email, password, activationCode, status) VALUES (?, ?, ?, ?)")) 
			{
				//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "sssi", $email, $hash, $activationCode, $verified );
				
				//execute the query or die with the error message
				mysqli_stmt_execute($stmt) or die (mysqli_error($mysqli));

				//close statement
				mysqli_stmt_close($stmt);
			}
				//get the user's id from the database 
				$customerID = 0; 
				if($stmt = mysqli_prepare($mysqli, "SELECT customerID FROM customer WHERE email=?"))
				{
					//bind parameters for markers
					mysqli_stmt_bind_param($stmt, "s", $email);
					
					//execute query 
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $customerID);
					
					//fetch values 
					if(mysqli_stmt_fetch($stmt))
					{
						$customerID = $customerID;
					}
					
					/* close statement */
					mysqli_stmt_close($stmt);
				}

				//close connestion 
				mysqli_close($mysqli);
			
			//send e-mail to the user's email 
			$to=$email;
			
			//your subject 
			$subject ="Kitchen Konnect Account Confirmation";
			
			//From 
			$header = "From: <registration@kitchenkonnect.com>";
			
			//to encode the email address being passed in the url
			$encodedEmail = rtrim(strtr(base64_encode($email), '+/', '-_'), '=');
			
			//to encrypt the value in the URL 
			
			//Your message 
			$message = "Hello valued customer, \r\n Thank you for registering with the Kitchen Konnect. Please follow the link below to confirm your account information. \r\n";
			
			$message.="Follow the link below: \r\n";
			$message.=" http://localhost/kitchenkonnect/customerActivation.php?email=$encodedEmail";
			$message.="\r\n Your confirm code is $activationCode";
			
			//send email 
			$sentmail = mail($to, $subject, $message, $header);
			
			Header("Location:customerRegistrationConfirmation.php?email=$encodedEmail");	
		}
		
	}//if the page is loading for the first time
	
	else
	{

		
		//make empty error meggages 
		$error1 = "";
		$error2 = "";
		$error3 = "";
		$error4 = "";
		$error5 = "";

		
		//make empty value holders 
		$value1 = "";
		$value2 = "";
		$value3 = "";
		$value4 = "";
		$value5 = "";
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

	<title>Bootstrap Tutorial </title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!--<script src="../processing/regFormValidation.js"></script> -->
	<script rel = "text/javascript" src = "js/jquery-1.11.3.min.js" ></script>
		<!-- line style
	http://codepen.io/ibrahimjabbari/pen/ozinB-->
</head>

<body>
	<div class="container">
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		<nav class="navbar navbar-default">
		<!--Container fluid which means that it is going to completely fill the container-->
			<div class="container-fluid"> 
				<form class="navbar-form navbar-left collapse navbar-collapse" role="search">					
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search Angel">
					</div>
				
					
					<button type="button" class="btn btn-default btn-md">
					<!--Accessible rich internet applications- aria-hidden - hides decorative icons like this so that it won't affect screen rearders. -->
					<span class="glyphicon glyphicon-search" aria-hidden="true">&nbsp;Search</span>
					</button>
				</form>
					
				<form class="navbar-form navbar-right" role="search">
					<a class="pull-right" href="login.php">Login</a> 
					<span class="pull-right">&nbsp; &nbsp;| &nbsp; &nbsp;</span>
					<a class="pull-right" href="register.php">Register</a>
					<span >&nbsp; &nbsp; &nbsp; &nbsp;</span>
				</form>		
			</div>
		</nav>
		
		<br/>
		
		<a href="index.php"><img class ="displayed" src="images/kc_logo.png" id="nttLogo" alt="Royal Borough of Greenwich Logo"/></a>
		<span >&nbsp; &nbsp; </span>
		<hr class="style18"/>
		
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		<nav class="navbar navbar-default">
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
						<li ><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
						<li ><a href="ContactUs.php">Contact Us<span class="sr-only">(Contact Us)</span></a></li>
						<li><a href="AboutUs.php">About Us<span class="sr-only">(About us)</span></a></li>
						
					</ul>
				</div>
			</div>
		</nav>

		
		<ul class="breadcrumb">
			<li ><a class="red" href="index.php">Home</a></li>
			<li class="active"><a class="red" href="#">Registration</a></li>
		</ul>
			
		<div class="row">
			<div class="col-lg-12"> 
				<div class="panel panel-default">
					<div class="panel-heading">
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4 ">
								<!-- onsubmit="return val(this);" -->
								<form name="registrationForm" method="post"  onsubmit="return val(this);" action="customerRegistration.php" >
									<fieldset>
										<legend class = "red big">
										 Registration
										</legend>
										
										<div class="form-group">
											<label>Email :</label>
											
											<input type="text" name="email" id="email" value="<?php echo($value3); ?>"  class="form-control" placeholder="Enter your email.">
										</div>
										<span id="error3" class="errorMessage"><?php echo($error3); ?></span>
										<br/>
										
										<div class="form-group">
											<label>Password :</label>

											<input type="password" name="password" value="<?php echo($value2); ?>" id="password" class="form-control" placeholder="Enter a password.">
										</div>
										<span id="error2" class="errorMessage"><?php echo($error2); ?></span>
										<br/>
										
										<div class="form-group">
											<label>Confirm Password :</label>

											<input type="password" name="confirmpassword" value="<?php echo($value5); ?>" id="confirmpassword" class="form-control" placeholder="Enter confirm password.">
										</div>
										<span id="error5" class="errorMessage"><?php echo($error5); ?></span>
										<br/>
										
										<button type="submit" name="registrationSubmit" value="Submit"class="btn btn-danger">Register</button>
										<button type="reset" name="registrationReset" value="Reset" onclick = "return resetForm();" class="btn btn-danger">Reset</button>
									</fieldset>
								</form>
								
							</div>
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

		<hr class="style2"/>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h6>Copyright &copy; 2016 The Royal Borough of Greenwich </h6>
					</div>			
				</div>
			</div>
		</footer>
	</div>


	<script src="js/jquery.min.js"></script>


	<script src="js/bootstrap.min.js"></script>
</body>
</html>