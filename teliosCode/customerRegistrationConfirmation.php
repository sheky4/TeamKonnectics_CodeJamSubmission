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

 echo '<META HTTP-EQUIV="Refresh" Content="15; url=customerActivation.php?email=' . $emailFromURL . '">'; 

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
	
		<!-- line style
	http://codepen.io/ibrahimjabbari/pen/ozinB-->

</head>

<body>
	<div class="container design">
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		
		
		<br/>
		
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
					</div>			
				</div>
			</div>
		</footer>
	</div>


	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>