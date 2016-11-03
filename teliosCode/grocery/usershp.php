<?php

session_start();

if(!isset($_SESSION['groceryID']))
	{
		Header("Location:index.php");
	}
	
   $username = $_SESSION['username'];
	echo $groceryID = $_SESSION['groceryID'];
	$supermarket = $_SESSION['supermarket'];
 $email = $_SESSION['email'];
 

 
 

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
		<br/>
		
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		<nav class="navbar navbar-default">
			 <a href="index.php" class="pull-left"><img src="../images/kc_logo.png" alt="Kitchen Konnect" class="img"></a>
		<!--Container fluid which means that it is going to completely fill the container-->
			<div class="container-fluid"> 
				
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="AboutUs.php">About Us<span class="sr-only">(About Us)</span></a></li>
						<li><a href="logout.php">Logout<span class="sr-only">(Login Page)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br/>

		<ul class="breadcrumb">
			<li ><a class="red" href="index.php">Home</a></li>

			
			</ul>
	<br/>

	<div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="red center">Welcome <?php echo $supermarket; ?> </h1>
									
					    <div class="col-lg-4 col-lg-offset-4">
						<h2 class="center"> Supermarket Menu </h2>
				<div id = 'title_bar'>
	<table>
		<tr>
			<td  align='center'><a href ='viewOrdersForToday.php'>Today's Order Requests </a></td>
			
		</tr>
		<tr>
			<td  align='center'><a href ='viewPastUnfulfilledOrders.php'>Past Unfulfilled  Order Requests </a></td>
		</tr>
		<tr>
			<td  align='center'><a href ='viewCompletedOrderRequests.php'>Completed Order Requests </a></td>
		</tr>
	
	</table>
</div>
		</div>		
				
							
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


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<script src="../js/bootstrap.min.js"></script>
</body>
</html>