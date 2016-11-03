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
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Pacifico">
	
		<!-- line style
	http://codepen.io/ibrahimjabbari/pen/ozinB-->

</head>

<body>
	<div class="container">
		<br/>
		
		<!-- As the screen is scrolled, the nav is going to disappear and come back -->
		<nav class="navbar navbar-default">
			 <a href="index.php" class="pull-left"><img src="images/kc_logo.png" alt="Kitchen Konnect" class="img"></a>
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
			<li ><a  href="usershp.php">Home</a></li>
			<li ><a class="red" href="#">Today's Unfulfilled Orders</a></li>

			
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
								
                                    <h1 class="red center">Today's Unfulfilled Orders</h1>
									<br/>
									
									
										<?php
										 if(isset($_GET['fulfilment'])){ 

										echo"<span class='errorMessage'> The order has been successfully fulfilled</span>";
									
										 }
										echo "<br/>";
						include("services/databaseConnection.php");
						
						$date = date('d-m-Y');
						$orderStatus = "unfulfilled";
						
							echo $orderStatus;
							echo $groceryID;
							echo $date;
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT list.listID, list.listDate, list.customerID, list.status FROM list WHERE status = ? AND groceryID = ? AND listDate = ? ");
						
						if ($stmt) 
						{
							
				mysqli_stmt_bind_param($stmt, "sis", $orderStatus, $groceryID, $date);

			/* execute query */
			mysqli_stmt_execute($stmt);
			
			
			/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				if($test ==0)
				{
					echo"<span class='errorMessage'> There are no orders for today</span>";
				}
				else if($test != 0)
				{
			mysqli_stmt_bind_result($stmt, $listID, $listDate, $customerID, $status);			
					echo "<table>
  <tr>
    <th>List ID</th>
    <th>Date</th>
    <th>Customer List ID</th>
    <th>Customer Number</th>
    <th>Status</th>
    <th>View Order</th>

  </tr>";		
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				
			echo "
  <tr>
    <td>$listID</td>
    <td>$listDate</td>
    <td>$status</td>
    <td><a href='viewOrder.php?list_id=$listID'>View Order </a></td>
  </tr>


";
			
	
				
			
			}
			echo "  </tr>
</table>";
				}			
					
			//close statement
			mysqli_stmt_close($stmt);
		}
						//close connection
						mysqli_close($mysqli);	
					?>
									
						
				
							
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

	<script src="js/bootstrap.min.js"></script>
</body>
</html>