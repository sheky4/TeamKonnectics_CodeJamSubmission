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
						<li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="AboutUs.php">About Us<span class="sr-only">(About Us)</span></a></li>
						<li><a href="registration.php">Registration<span class="sr-only">(Registration)</span></a></li>
						<li><a href="login.php">Login<span class="sr-only">(Login Page)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		
		
		<br/>

		<!-- Carousel -->
		<!-- Surround everything with a div with the class carousel slide -->
		<div id="theCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Define how many slides to put in the carousel -->
			<ol class="carousel-indicators">
				<li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
				<li data-target="#theCarousel" data-slide-to="1"> </li>
				<li data-target ="#theCarousel" data-slide-to="2"> </li>
			</ol >
		 
		  <!-- Define the text to place over the image -->
			<div class="carousel-inner">
			<div class="item active" >
				<div class ="slide1" ></div>
				
			</div>
		  
			<div class="item">
				<div class="slide2"></div>
				
			</div>
			
			<div class="item">
				<div class="slide3"></div>
				
			</div>
			</div>
		 
			<!-- Set the actions to take when the arrows are clicked -->
			<a class="left carousel-control" href="#theCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"> </span>
			</a>
			<a class="right carousel-control" href="#theCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
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