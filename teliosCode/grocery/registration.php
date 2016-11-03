<?php
session_start();

?>
<html>
<head>
<meta charset="UTF-8">

	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	
	<meta name="viewport" content="width= device-width, initial-scale = 1">

	<title>Kitchen Konnect </title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	
	<script rel = "text/javascript" src = "js/jquery-1.11.3.min.js" ></script>
	<script src="processing/regFormValidation.js"></script>
</head>

<div class="container">
		<br/>
		<nav class="navbar navbar-default">
			 <a href="index.php" class="pull-left"><img src="../images/kc_logo.png" alt="Kitchen Konnect" class="img"></a>
			<div class="container-fluid"> 
				<div class="navbar-header">
					
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
						<li class="active"><a href="#">Registration<span class="sr-only">(Registration)</span></a></li>
						<li><a href="login.php">Login<span class="sr-only">(Login Page)</span></a></li>
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
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4 ">
<body>
<?php 	include("../services/databaseConnection.php"); ?>
<div id = 'body'>

<?php 
	
	
	
?>


		<form enctype='multipart/form-data' method='post' >
		<?php
		$error1 = "";
		$error2 = "";
		$error3 = "";
		$error4 = "";
		$error5 = "";
		$error6 = "";
		$error7 = "";

		
		
		$value1 = "";
		$value2 = "";
		$value3 = "";
		$value4 = "";
		$value5 = "";
		$value6 = "";
		$value7 = "";
		
		
			if(isset($_POST['upload'])){
			
			
				$email = trim($_POST["email"]);
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$confirmpassword = trim($_POST["confirmpassword"]);
		$supermarket = trim($_POST["supermarket"]);
		
		$captchaFromForm = trim($_POST["captcha"]);
		
		$errorCounter = 0;
		
		if($username == "" || $username == null)
		{
			$errorCounter++;
			$error1 = "Enter a username";
			$value1=$username;
		}
		
		else if(strlen($username) < 5) 
		{
			$error1 = "Username cannot be less than 5 characters. E.g. alex4";
			$errorCounter++;
			$value1=$username;
		}
		
		else
		{
			
			$username1 = filter_var($username, FILTER_SANITIZE_STRING);
			
			
			include("../services/databaseConnection.php");
			
			if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM grocery WHERE username=?")) 
			{
				
				mysqli_stmt_bind_param($stmt, "s", $username1);
				
				mysqli_stmt_execute($stmt);
				
				mysqli_stmt_store_result($stmt);
				
				$test = mysqli_stmt_num_rows($stmt);
				if($test !=0)
				{
					$errorCounter++;
					$error1 = "Username already exists. Please enter a different username.";
					$value1 = $username;					
				}
				else
				{
					$error1 = "";
					$value1 = $username;
				}
				
				
				mysqli_stmt_close($stmt);
			}
			
			mysqli_close($mysqli);
		}
		
		if($password == "" || $password == null)
		{
			$errorCounter++;
			$error2 = "Enter a password";
		}
		else if(strlen($password) < 8) 
		{
			$errorCounter++;
			$error2 = "You must enter a password that is at least 8 characters in length, for example: password!1";
			$value2 = $password;
		}
		
		else if( (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))==false && (preg_match('/[\'^£$%&!*()}{@#~?><>,|=_+¬-]/', $password))== false)
		{
			$error2 = "Password must contain at least 1 number and 1 symbol E.g. hello_1";
			$errorCounter++;
			$value2 = $password;
		}
		
		
		else if( (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))==false)
		{
			$error2 = "Password must contain at least 1 number. E.g. hello_1.";
			$errorCounter++;
			$value2 = $password;
		}

		
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
		
		$captchaVal = $_SESSION['cval'];
		if($captchaFromForm == "" || $captchaFromForm == null)
		{
			$errorCounter++;
			$error4 = "Please enter the captcha value";
		}
		
		else if($captchaFromForm != $captchaVal)
		{
			$errorCounter++;
			$error4 = "Invalid captcha entered";
		}
		
		else
		{
			$error4 = "";
		}

		if($supermarket == "" || $supermarket == null || $supermarket == "default")
		{
			$errorCounter++;
			$error6 = "You must select a supermarket";
		}
		else
		{
			$error6 = "";
			$value6 = $supermarket;
		}

				
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
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errorCounter++;
			$error3 = "Please enter a valid email address. E.g. janedoe@hotmail.com";
			$value3 = $email;
		}
		
		else
		{
			
			$email1 = filter_var($email, FILTER_SANITIZE_STRING);
			$email1 = filter_var($email1, FILTER_SANITIZE_EMAIL);
			
			
			include("../services/databaseConnection.php");
			
			if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM grocery WHERE email=?")) 
			{
				
				mysqli_stmt_bind_param($stmt, "s", $email1);
				
				mysqli_stmt_execute($stmt);
				
				mysqli_stmt_store_result($stmt);
				
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
				
				
				mysqli_stmt_close($stmt);
			}
			
			mysqli_close($mysqli);
		}
		
		$file = $_FILES['file']['type'];
				$file_type = $_FILES['file']['size'];
				$file_tmp = $_FILES['file']['tmp_name'];
				$random_name = rand();
				$random_name = $random_name.".jpg";
				
				$other = $_FILES['other']['type'];
				
				if(empty($file)){
					$errorCounter++;
					$error7 = "Upload Business Registration Certificate";
				} else {
					$error7 = "";
					$value7 = $file;
					
				}
		
		if($errorCounter != 0){
			
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); 
			$alphaLength = strlen($alphabet) - 1; 
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
			
			$email = filter_var($email, FILTER_SANITIZE_STRING);
			$username = filter_var($username, FILTER_SANITIZE_STRING);
			$password = filter_var($password, FILTER_SANITIZE_STRING);
			
			
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			
			
			$hash_format = "$2y$10$";
			
			$unique_random_string = md5(uniqid(mt_rand(), true));
			$base64_string = base64_encode($unique_random_string);
			$modified_base64_string = str_replace('+', '.', $base64_string);
			$salt = substr($modified_base64_string, 0, 22);

			$format_and_salt = $hash_format.$salt;
			
			$hash = crypt($password, $format_and_salt);
			
			
			$image = "defaultImage.jpg";
			
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
			
				 $file = $_FILES['file']['type'];
				$file_type = $_FILES['file']['size'];
				$file_tmp = $_FILES['file']['tmp_name'];
				$random_name = rand();
				$random_name = $random_name.".pdf";
				
include("../services/databaseConnection.php");
				move_uploaded_file($file_tmp, 'businessDocuments/'.$random_name);
				
					$other = $_FILES['other']['type'];
					
									if(!empty($other)){
										
					$file_type2 = $_FILES['other']['size'];
				$file_tmp2 = $_FILES['other']['tmp_name'];
				$random_name2 = rand();
				$random_name2 = $random_name2.".pdf";
									
					
					move_uploaded_file($file_tmp2, 'businessDocuments/'.$random_name2);
									}
					
					$accountStatus = 0;
					
					if ($stmt = mysqli_prepare($mysqli, "INSERT INTO grocery(username, email, busRegCert, password, supermarket, other, activationCode, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) 
			{
				
				mysqli_stmt_bind_param($stmt, "sssssssi", $username, $email, $random_name, $hash, $supermarket, $random_name2, $activationCode, $accountStatus);
				
				
				mysqli_stmt_execute($stmt) or die (mysqli_error($mysqli));

				
				mysqli_stmt_close($stmt);
			}
					
				//get the user's id from the database 
				$customerID = 0; 
				if($stmt = mysqli_prepare($mysqli, "SELECT gorceryID FROM grocery WHERE username=?"))
				{
					//bind parameters for markers
					mysqli_stmt_bind_param($stmt, "s", $username);
					
					//execute query 
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $gID);
					
					//fetch values 
					if(mysqli_stmt_fetch($stmt))
					{
						$angelID = $gID;
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
			$message = "Hello ".$supermarket.",  \r\n Thank you for registering with Kitchen Konnect. Please follow the link below to confirm your account information. \r\n";
			
			$message.="Follow the link below: \r\n";
			$message.=" http://konnecticstest.netai.net/regActivation.php?email=$encodedEmail";
			$message.="\r\n Your confirm code is $activationCode";
		
			//send email 
			$sentmail = mail($to, $subject, $message, $header);
			
			Header("Location:registrationConfirmation.php?email=$encodedEmail");	
					
					
				
			}
			
		}
			
	else
	{
		
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); 
		$alphaLength = strlen($alphabet) - 1; 
		for ($i = 0; $i < 6; $i++) 
		{
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
	   $captchaVal = implode($pass);
		$_SESSION['cval'] = $captchaVal;	
		
		
		$error1 = "";
		$error2 = "";
		$error3 = "";
		$error4 = "";
		$error5 = "";
		$error6 = "";
		$error7 = "";

		
		
		$value1 = "";
		$value2 = "";
		$value3 = "";
		$value4 = "";
		$value5 = "";
		$value6 = "";
		$value7 = "";
	}
		?>
		<form name="registrationForm" method="post"  onsubmit="return val(this);" action="registration.php" >
			
			<legend class = "red big">
										Supermarket Registration 
										</legend>
			<div class="form-group">
											<label>*Username :</label>

											<input type="username" name="username" value="<?php echo($value1); ?>" id="username" class="form-control" placeholder="Enter a username.">
										</div>
										<span id="error1" class="errorMessage"><?php echo($error1); ?></span>
										<br/>
										
										<div class="form-group">
											<label>*Password :</label>

											<input type="password" name="password" value="<?php echo($value2); ?>" id="password" class="form-control" placeholder="Enter a password.">
										</div>
										<span id="error2" class="errorMessage"><?php echo($error2); ?></span>
										<br/>
										
										<div class="form-group">
											<label>*Confirm Password :</label>

											<input type="password" name="confirmpassword" value="<?php echo($value5); ?>" id="confirmpassword" class="form-control" placeholder="Enter confirm password.">
										</div>
										<span id="error5" class="errorMessage"><?php echo($error5); ?></span>
										<br/>

										<div class="form-group">
											<label>*Email :</label>
											
											<input type="text" name="email" id="email" value="<?php echo($value3); ?>"  class="form-control" placeholder="Enter your email.">
										</div>
										<span id="error3" class="errorMessage"><?php echo($error3); ?></span>
										<br/>
										<div class="form-group">
											<label>*Supermarket :</label>
											<br/>
											<select class="form-control" name="supermarket" id="supermarket">
											
											<option value="default">Select Supermarket</option>
											<option value="JTA" <?php if ($value6 === 'JTA') echo ' selected="selected"'?>>JTA</option>
											<option value="Pricesmart" <?php if ($value6 === 'Pricesmart') echo ' selected="selected"'?>>Pricesmart</option>
											<option value="Massy Stores"<?php if ($value6 === 'Massy Stores') echo ' selected="selected"'?> >Massy Stores</option>
											<option value="Persads Supermarket" <?php if ($value6 === 'Persads Supermarket') echo ' selected="selected"'?>>Persads Supermarket</option>
											</select>
										</div>
										<span id="error6" class="errorMessage"><?php echo($error6); ?></span>
										<br/>
										
										<tr>
											<td align="right">*Business Registration Certificate</td>
											<br/>
											<td><label>
											  <input name="file" value="<?php echo($value7); ?>" type="file"  id="file" />
											  </label></td>
									  </tr>
									  <br/>
									  <span id="error7" class="errorMessage"><?php echo($error7); ?></span>
									<br/>
									
									  <tr>
											<td align="right"> Other</td>
											<br/>
											<td><label>
											  <input name="other" type="file"  id="other" />
											  </label></td>
									  </tr>
										<br/>
										<div class="form-group ">
											<img src="../services/generateCaptcha.php" alt="" title="" />
											<br/>
											<span>Enter the captcha value you see above</span>
											<br/>
											<input type="text" class="form-control" id="captcha" name="captcha" value="" placeholder="Enter Captcha" />	
										</div>
										<span id="error4" class="errorMessage"><?php echo($error4); ?></span>
										<br/> <br/>
										
										<button type="submit" name="upload" value="Submit"class="btn btn-danger">Register Supermarket
										</button>
										<button type="reset" name="registrationReset" value="Reset" onclick = "return resetForm();" class="btn btn-danger">Reset
										</button>
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


	<script src="../js/jquery.min.js"></script>


	<script src="../js/bootstrap.min.js"></script>
</body>
</html>