<?php
	session_start();
	$customerID = $_SESSION['customerID'];

	if(!isset($_SESSION['customerID'])){
		Header("Location:kkhome.php");
	 }
	 $email = $_SESSION['email'];
?>

<!DOCTYPE HTML>

<html>
		<head>
		
			<title>Kitchen Konnect</title>
			<style>
	.design{
	font-family: Rockwell;
		text-decoration:bold;
		text-align: center;
	}
			</style>
					<!--[if lt IE 9]>
					<script src="js/dist/html5shiv.js"></script>
					<![endif]-->
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				  <!-- If IE use the latest rendering engine -->
				<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
				
				   <!-- Set the page to the width of the device and set the zoon level -->
				<meta name="viewport" content="width = device-width, initial-scale = 1"/>
				   
				<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
				<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Rockwell">
		
		
			   
		</head>

<body>


<!-- NOTE THIS WEB SITE BUILT WAS DESIGNED USING A BOOTSTRAP TEMPLATE TAKEN FROM Derek Banas AT http://www.newthinktank.com/2015/11/learn-bootstrap-one-video/ --> 


	<!-- bootstrap bit --> 

		<!-- container puts padding around itself while container-fluid fills the whole screen. Bootstap grids require a container. -->
			<div class="container"  > 
			<div class="page-header">
				 <legend class = "red medium" align="center">Select an Option:</legend>
			</div>
		   </div> 

				<div align = "center">
				<form name="cam" method="post" action="customerLogout.php">
					<button type="submit"  class = "btn btn-danger" style="width: 100px;" role = "button">Logout</button>
					</form> 
				</div>
					<br/> <br/> 
					
				<!-- TEXT CONTENT IN THE BODY -->
				<div align = "center" > 
				<form name="cam" method="post" action="ipCamera/cam.html">
				<button type="submit"  class = "btn btn-danger" role = "button">View Fridge</button>
				</div> 
				<br/> 
				<br/> 
				</form> 
				<div align = "center" > 
				<form name="cam" method="post" action="ipCamera/camPantry.html">
				<button type="submit"  class = "btn btn-danger" role = "button">View Pantry</button>
				</div>
				<br/> 
				<br/> 
				</form>
				<form name="createList1" method="post" action="createList1.php">
				<div align = "center" > 
				<button type="submit" class = "btn btn-danger" role = "button">Create List</button>
				</div> 
				<br/> 
				<br/> 
				</form>
				<form name="list" method="post" action="viewCustomerLists.php">
				<div align = "center" > 
				<button type="submit"  class = "btn btn-danger" role = "button">View List</button>
				</div> 
				<br/> 
				<br/> 
				</form>
				<form name="list" method="post" action="viewStatus.php">
				<div align = "center" > 
				<button type="submit"  class = "btn btn-danger" role = "button">View Order Status</button>
				</div> 
				<br/> 
				<br/>
				</form>
				<!--<div align = "center" > 
				<button type="submit"  class = "btn btn-danger" role = "button">Exit</button>
				</div> 
				
-->
				<!-- FOOTER AREA --> 
				<footer id="footer" align = "center">
		
		 </footer>

		<!-- BootStrap Links --> 
		<audio id="trigger1" src="triggerSound1.mp3" preload="auto"></audio>
    		<script type="text/javascript" src="fence.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    
</body>

</html>
<html>
<!--This is the notification code-->
			<script>
			//put the customerID here as a javascript variable
			var customerID = <?php echo ($customerID);?>;
			//alert(customerID);
		</script>
		<script src="ajax_Refresh.js"></script>
		<script src="count_down.js"></script>
		
		<div style="visibility: hidden;">
		<audio id="trigger1" src="triggerSound1.mp3" preload="auto"></audio>
		<p>
			Content Refreshes Automatically In: <span id="timeLeft"></span>
		</p>
		<div id="refreshContent">
			Initial Content
			
		</div>
		</div>
	<!-- This is the end of it-->
			   
</html>
