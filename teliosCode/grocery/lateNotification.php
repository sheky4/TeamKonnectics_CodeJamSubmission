<?php

session_start();

if(!isset($_SESSION['groceryID']))
	{
		Header("Location:index.php");
	}

$list_id =  $_GET['list_id'];
	
   $username = $_SESSION['username'];
	$groceryID = $_SESSION['groceryID'];
	$supermarket = $_SESSION['supermarket'];
	$email = $_SESSION['email'];
	//$customerListID = $_SESSION['customerListID'];
	$error1 = "";

	if(isset($_POST['lateNotification'])){
		
		
		
		echo $lateDate = $_POST['date'];
		echo "<br/>";
		echo $date = date('Y-m-d');
		
		if($lateDate < $date){
					$error1 = "The date cannot be a date in the past.";
		}else{
		
		

		//send e-mail to the user's email 
			$to=$email;
			
			//your subject 
			$subject ="Late Order Fulfilment Notification";
			
			//From 
			$header = "From: <konnectics@kitchenkonnect.com>";
			
			
			//Your message 
			$message = "Hello Valued Customer,  \r\n We regret to inform you that your order will not be ready on time . \r\n";
			
			$message.="We are sorry for any inconveniences caused. Your order will be ready on the ".$lateDate.".\r\n";
			$message.="\r\n Kind Regards, \r\n ";
			$message.="\r\n".$supermarket."";
			
		
			//send email 
			$sentmail = mail($to, $subject, $message, $header);
			
			Header("Location:viewOrder.php?list_id=$list_id");	
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

	<title>Late Notification</title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Pacifico">
	<link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css" />
		<script src="../jquery/jquery.js"></script>
		<script src="../jquery/jquery-ui.min.js"></script>
		<script src="../js/formValidation.js"></script>
		<script>
			$(function() 
			{
				$( "#date" ).datepicker({ dateFormat: "yy-mm-dd" });
			});
		</script>
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
						<li><a href="usersHP.php">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="AboutUs.php">About Us<span class="sr-only">(About Us)</span></a></li>
						<li><a href="logout.php">Logout<span class="sr-only">(Logout Page)</span></a></li>
						
					</ul>
				</div>
			</div>
		</nav>
		
		<ul class="breadcrumb">
			<li ><a class="red" href="usershp.php">Home</a></li>
			<li class="active"><a class="red" href="#">Late Notification</a></li>
			
			</ul>
			
			
			<div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
							
                                <div class="col-lg-3">
								 <h1 class="red">Order Request</h1>
								 
								 <br/><br/>
								
									<p> <b>State the date that the order will be ready by  :</b></p>
										<div class="form-group">
								<form method="post">
											<input type="text"name="date" id="date" placeholder="yyyy-mm-dd" class="form-control"  />
										</div>
										<span class="errorMessage"><?php echo($error1); ?></span>
										<br/>
										
										<button type="submit" name="lateNotification" value="Submit"class="btn btn-danger">Submit
										</button>
                                   
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


	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
</body>
</html>