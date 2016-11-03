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
			<li class="active"><a class="red" href="#">About Us</a></li>
			
			</ul>
			
			
			<div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="red">About Us </h1>
									<p> Kitchen Konnect would like to promote a positive urban environment in Trinidad and Tobago by easing the cognitive load of its citizens.  Cognitive load refers to the total amount of mental effort being used in the working memory. This website aims to allow local registered groceries to be able to receive order requests from their customers and be able to notify them when their order has been prepared and ready for pickup.            
									</p>
									<br/>
									<p>
									This website works in collaboration with the mobile application for Kitchen Konnect. The mobile application has a plethora of functions that help to ease the cognitive load of customers.  It allows customers to view the contents within their refrigerator or pantry from a remote location through a live stream. Customers can then log their grocery list in the grocery reminder list tool on the application.       
									</p>
									<br/>
									<p>
									After logging their grocery list, customers can then set a reminder for a particular date and time or/and a geo reminder when passing the grocery’s brick and mortar store. This would alert them that they have to make a grocery stop when best convenient for them. Customers also have the option of sending their selected grocery a request to prepare their grocery list. This is all done from the mobile application.  
									</p>
									<br/>
									<p>
									When customers send their grocery list to their desired grocery, the grocery can access these requests through this website. Here, the grocery can view their requests and have a medium of alerting the customer when their order is ready for pickup. This alert is done through a push notification on their mobile devices. This application aims to make the interactions between local groceries and customers more convenient for both parties. 
									</p>
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