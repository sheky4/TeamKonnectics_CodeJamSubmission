<?php
	session_start();
//get the value from the query string
	$emailFromURL = "";
	$searchError = "";
	if(isset($_GET["email"]))
	{
		//if an email variable is present in the url
		$emailFromURL = trim($_GET["email"]);
		
		// do validation 
		if($emailFromURL == "" || $emailFromURL == null)
		{
			//direct the user elsewhere since the email value is empty
			//header location.....
			die("Email value empty in url");
		}
	}

 echo '<META HTTP-EQUIV="Refresh" Content="15; url=regActivation.php?email=' . $emailFromURL . '">'; 

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
                                <div class="col-lg-12">
                                    <h1 class="red">Registration Successful</h1>
									<p>
											Your registration was successful, you will be automatically redirected to the Account Activation page in 15 seconds.
											
											A confirmation email has been sent to your email address. Please follow the instructions contained within to verifiy your account. You will not be able to login until you have verified your account.
										</p>
								<br/>
									<br/>
									<br/>
									<br/>
									<br/>
									<br/>
									<br/>
									<br/>
									<br/>
									<br/>
									<br/>
							
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