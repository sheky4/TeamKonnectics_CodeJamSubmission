<?php
	session_start();


	$error1 = "";
	$error2 = "";
	$error3 = "";

	$value1 = "";
	
	$usernameFormValue = "";
	$cookieUsername = "";
	if(isset($_COOKIE["usernameCookie"]))
	{
		$cookieUsername = $_COOKIE["usernameCookie"];
		
	}
	
	if(isset($_COOKIE["usernameCookie"]))
	{
		$checked = "yes";
		
	}else{
		$checked = "no";
	}
	
	$usernameFormValue = "";
	
	if($cookieUsername != null || $cookieUsername != "")
	{
		$usernameFormValue = $cookieUsername;
	}


	$error1 = "";
	$error2 = "";
	$error3 = "";
	
	$value1 = "";
	
	//if the user clicked the submit button
	if(isset($_POST['loginSubmit']))
	{
		
		//get values from form
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Declare empty error messages
		$error1 = "";
		$error2 = "";
		
		$errorCounter = 0;
		
		//validate username 
		if($username == "" || $username == null)
		{
			$errorCounter++;
			$error1 = "You must enter a username";
		}
		else
		{
			$error1 = "";
			$value1 = $username;
		}
		
		
		//validate username 
		if($password == "" || $password == null)
		{
			$errorCounter++;
			$error2 = "You must enter a password";
		}
		else
		{
			$error2= "";
		}

		
		
		//Sanitize values to remove html and bad characters	
		$username = filter_var($username, FILTER_SANITIZE_STRING);
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		
		//check database to see if any credentials match
		
		//include database connection
		include("../services/databaseConnection.php");
		if($errorCounter ==0)
		{
			
		
			//sanitize
			$username = filter_var($username, FILTER_SANITIZE_STRING);
			$password = filter_var($password, FILTER_SANITIZE_STRING);
			
			
			include("../services/databaseConnection.php");
			
			//best one to use is the id because it is the primary key
			//check db to see if credentials exist and retrieve the user's id/email/username
			$verificationStatus = 1;
			if ($stmt = mysqli_prepare($mysqli, "SELECT groceryID, username, password, email, supermarket FROM grocery WHERE username = ? AND status = ?")) 
			{
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "si", $username, $verificationStatus);

				/* execute query */
				mysqli_stmt_execute($stmt);

				/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				if($test ==0)
				{
					//if no records matched
					$error1 = "";
					$error2 = "";
				}
				else if($test != 0)
				{
					//if we found a record
					mysqli_stmt_bind_result($stmt, $gid, $un, $pass, $em, $sm);
							
					$groceryID = "";
					$username = "";
					$readPassword = "";
					$email = "";
					$supermarket = "";

					/* fetch values */
					if(mysqli_stmt_fetch($stmt)) 
					{
						$groceryID = $gid;
						$username = $un;
						$readPassword = $pass;
						$email = $em;
						$supermarket = $sm;
					}
					//encrypt the password from the db with the password entered on the form
					
					$encryptedPw = crypt($password, $readPassword);
					//if the newly encrypted password is equal to the password entered from the form then log them in
					if($encryptedPw == $readPassword)
					{
						//store necessary values in session
						$_SESSION['groceryID'] = $groceryID;
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email;
						$_SESSION['supermarket'] = $supermarket;
						
						//check if cookie option was selected
						if(isset($_POST['rememberMe'])) 
						{
							//expire old cookie
							setcookie ("usernameCookie", "", time() - 3600);
							
							//store a cookie on the user's machine
							//set the time to desired number by multiplying the number of seconds in an hour by the number of hours desired
							setcookie("usernameCookie",$username, time()+3600*24, "/"); //will store for 24 hrs
							//die("cookie stored");
						}
						
				
						
						//send user to userHome page
						Header("Location:usershp.php");
						
					}
					else
					{
						//passwords do not match
						$error1 = "";
						
					}

				}
				
				/* close statement */
				mysqli_stmt_close($stmt);
			}
			/* close connection */
			mysqli_close($mysqli);
			
			include("../services/databaseConnection.php");
			////////////if user exists but not verified//////////////
			echo $verificationStatus = 0;
			echo"$username";
	
			if ($stmt1 = mysqli_prepare($mysqli, "SELECT groceryID, username, password, email FROM grocery WHERE username = ? AND status = ?")) 
			{
 
				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt1, "si", $username, $verificationStatus);

				/* execute query */
				mysqli_stmt_execute($stmt1);

				/* store result */
				mysqli_stmt_store_result($stmt1);

				$test1 = mysqli_stmt_num_rows($stmt1);
				//echo($test);
				
				if($test1 ==0)
				{
					//if no records matched
					$error3 = "Invalid Username or Password Entered";
				}
				else if($test1 != 0)
				{
					//if we found a record
					mysqli_stmt_bind_result($stmt1, $gid, $un, $pass, $em);
							
					$groceryID = "";
					$username = "";
					$readPassword = "";
					$email = "";

					/* fetch values */
					if(mysqli_stmt_fetch($stmt1)) 
					{
						$groceryID = $gid;
						$username = $un;
						$readPassword = $pass;
						$email = $em;
						
					}
					
					
					echo "<br/>";
					//to encode the email address being passed in the url
			$encodedEmail = rtrim(strtr(base64_encode($email), '+/', '-_'), '=');
			echo $encodedEmail;
				Header("Location:regActivation.php?email=$encodedEmail");

				}
				
				/* close statement */
				mysqli_stmt_close($stmt1);
			}
			/* close connection */
			mysqli_close($mysqli);
		}
		}

	
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>

	<!-- Tell MS IE to use the latest rendering engine - something you always want to include-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<!-- Set page width to size of the device and set the zoom level to 1-->
	<meta name="viewport" content="width= device-width, initial-scale = 1"/>
	
	
	<script src='../js/jquery-2.1.3.min.js'></script>
<link rel='stylesheet' type='text/css' href='../css/jquery-eu-cookie-law-popup.css'/>
<script src='js/jquery-eu-cookie-law-popup.js'></script>

	<title>Login </title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">

	<script rel = "text/javascript" src = "../js/jquery-1.11.3.min.js" ></script>
</head>

<body class='eupopup eupopup-top'>

	
		
	<div class="container">
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
	
		<br/>
		
		
		
		
		<nav class="navbar navbar-default">
		
			<div class="container-fluid"> 
				<div class="navbar-header">
					 <a href="index.php" class="pull-left"><img src="../images/kc_logo.png" alt="Kitchen Konnect" class="img"></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						
						<span class="sr-only"></span>
						
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>	
					</button>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
				<!--Container fluid which means that it is going to completely fill the container-->
					<div class="container-fluid"> 
			
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="AboutUs.php">About Us<span class="sr-only">(About Us)</span></a></li>
						<li ><a href="registration.php">Registration<span class="sr-only">(Registration)</span></a></li>
						<li class="active"><a href="#">Login<span class="sr-only">(Login Page)</span></a></li>
						
					</ul>
				</div>
			</div>
		</nav>
		


		
		<ul class="breadcrumb">
			<li ><a class="red" href="index.php">Home</a></li>
			<li class="active"><a class="red" href="#">Login</a></li>
		</ul>
		
		<div class="row">
			<div class="col-lg-12"> 
			
				<div class="panel panel-default">
					<div class="panel-heading">
					</div>
	<div class="col-lg-8">	
<br/>	
	
	This website uses cookies, to improve your browsing experience.
	
										   <!-- This code for the Cookie Button was taken from http://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_modal&stacked=h -->	

											<div class="container">
										  
											  <!-- Trigger the modal with a button -->
											  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Cookie Information</button>

											  <!-- Modal -->
											  <div class="modal stay" id="myModal" role="dialog">
												<div class="modal-dialog">
														
													  <!-- Modal content-->
													  <div class="modal-content">
														<div class="modal-header">
														  <button type="button" class="close" data-dismiss="modal">&times;</button>
														  <h4 class="modal-title">This Website Uses Cookies to improve your browsing Experience</h4>
														</div>
														<div class="modal-body">
														  <p>It is important that you the user approve the use of the cookie function, as in compliance of EU Cookie law.</p> 
														  <p>Remember Me initiates the cookie function: By clicking the remember me check-box, every-time you re-visit our site, your will only be required to enter your password</p>
														  <p>This website uses a User name cookie, which means that we would be accessing the user name you registered with, to make the login process easier</p>
														  <p>If you do not wish to use the cookie function: please leave the remember me option unchecked</p>
														  <p>Remember you are in control!!</p>
														  <p>If you wish to have your details deleted from our server, or have any questions in relation to the use of the cookie function then feel free to contact us</p>
														  <p>All, of our Contact Information is on the Contact Page Provided</p>
														 
														</div>
														
														
														<div class="modal-footer">
														  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													  </div>
													</div>
												  </div>
												</div>
	
										<br/>
										
   
	</div>
    <div class='clearfix'></div>

					<div class="panel-body">
						<div class="row">
							<div class="col-md-4 ">
							
							
								
								<form name="registrationForm" method="post"  onsubmit="return loginValidation(this);" action="login.php" >
									<fieldset>
										<legend class = "red big">Login Page</legend>
									
										<span class="errorMessage"><?php echo($error3); ?></span>
										
										<div class="form-group">
											<label> Username:</label>
											<input type="text" name="username"

												<?php 
											if (!isset($_POST["loginSubmit"])) {
											?> value="<?php echo($usernameFormValue); ?>"<?php
										} ?><?php 
											if (isset($_POST["loginSubmit"])) {
											?> value="<?php echo($value1); ?>"<?php
										} ?>
											
											class="form-control" placeholder="Enter a username." />
										</div>
										
										<span id="error1" class="errorMessage"><?php echo($error1); ?></span>
										<br/>
		
										<div class="form-group">
											<label>Password:</label>
											<input type="password" name="password" value="" class="form-control" placeholder="Enter a password." />
										</div>
										<span id="error2" class="errorMessage"><?php echo($error2); ?></span>
										<br/>

										<div class="form-group">
											<label>Remember Me</label>
											<input type="checkbox" <?php if ($checked == 'yes')
											{echo "checked='checked'";} ?> name="rememberMe[]" value="remember" />
										</div>
										
										
										
										
										<div>
											<button type="submit" class="btn btn-danger" name="loginSubmit" >Login</button>
											<button type="reset" class="btn btn-danger">Reset</button>
										</div>	
										
										
										
									</fieldset>
								</form>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
              
		</div>
       



 
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
<!-- BootStrap Links --> 

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		 <script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="../../js/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
</body>
</html>