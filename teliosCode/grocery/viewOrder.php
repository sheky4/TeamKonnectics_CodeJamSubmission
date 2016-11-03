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

	
	 if(isset($_POST['lateNotification'])){ 
	Header("Location:lateNotification.php?list_id=$list_id");
  }
 
 
 if(isset($_POST['fulfillOrder'])){ 
 
	include("../services/databaseConnection.php");
		 
			$fulfilledStatus = "fulfilled";
			
			if ($stmt = mysqli_prepare($mysqli, "UPDATE list SET status = ?, triggered = 1  WHERE list.listID = ?;")) 
			{
				//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "si", $fulfilledStatus, $list_id);
			
				//execute query
				mysqli_stmt_execute($stmt);
				//store result
			
				mysqli_stmt_store_result($stmt);
		
			
				//get the number of rows returned
				$test = mysqli_stmt_num_rows($stmt);

				Header("Location:viewOrdersForToday.php?fulfilment=success");
					

				//close statement
				mysqli_stmt_close($stmt);
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
			<li ><a  href="usershp.php">Home</a></li>
			<li ><a  href="viewOrdersForToday.php">Today's Unfulfilled Orders</a></li>
			<li ><a class="red" href="#">Order Request</a></li>

			
			</ul>
	<br/>

	<div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 center">
								
                                    <h1 class="red center">Today's Unfulfilled Orders</h1>
									<br/>
										<?php
						include("../services/databaseConnection.php");
						
						$date = date('d-m-Y');
						$orderStatus = "unfulfilled";
						
						//$sql = "SELECT list.listID, list.listDate, list.customerID, list.status FROM list WHERE status = '$orderStatus' AND groceryID = $groceryID AND listDate = '$date'  AND list.listID = $list_id";
						//echo $sql;
							
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT list.listID, list.listDate, list.customerID, list.status FROM list WHERE status = ? AND groceryID = ? AND listDate = ?  AND list.listID = ?");
						if ($stmt) 
						{
							
				mysqli_stmt_bind_param($stmt, "sisi", $orderStatus, $groceryID, $date, $list_id);
				
				

			/* execute query */
			mysqli_stmt_execute($stmt);
			
			
			/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				if($test ==0)
				{
					echo"<span class='errorMessage'> There are no items in this list</span>";
				}
				else if($test != 0)
				{
					
										

			mysqli_stmt_bind_result($stmt, $listID, $listDate, $customerID, $status);	

				
					
					
					 
					 
					echo "<table>
  <tr>
    <th>List ID</th>
    <th>Date</th>
    <th>Customer ID</th>
    <th>Status</th>
  </tr>";		
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				
			echo "
  <tr>
    <td>$listID</td>
    <td>$listDate</td>
    <td>$customerID</td>
    <td>$status</td>
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
					
					
					
					
					 <div class=" col-lg-offset-4 col-lg-4">
					
					 <br/>		
						<h2> Grocery List </h2>
					
					<?php
						include("../services/databaseConnection.php");
						
						$date = date('d-m-Y');
						$orderStatus = "unfulfilled";
							
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT item.itemName, listItems.quantity FROM list, listItems, item WHERE list.listID = listItems.listID AND list.listID = ? and listItems.itemID = item.itemID AND list.groceryID = ? AND list.listDate = ?  AND status = ? 
						
						");
						if ($stmt) 
						{
							
							

							
				mysqli_stmt_bind_param($stmt, "ssii", $list_id, $groceryID, $date, $orderStatus);

			/* execute query */
			mysqli_stmt_execute($stmt);
			
			
			/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				if($test ==0)
				{
					echo"<span class='errorMessage'> There are no items in this list.</span>";
				}
				else if($test != 0)
				{
					
					
					

			mysqli_stmt_bind_result($stmt, $itemName, $quantity);			
					echo "<table>
  <tr>
    <th>Item</th>
    <th>Quantity</th>

  </tr>";		
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				
			echo "
  <tr>
    <td>$itemName</td>
    <td>$quantity</td>
  </tr>


";
			
	
				
			
			}
			echo "  </tr>
</table>";
?> 
						<br/>
					<br/>
					<br/>
						<form name="fulfillOrder" method="post"  >
							
							<button type="submit" name="fulfillOrder" value="Submit"class="btn btn-danger">Fulfill Order</button>
							
							<button type="submit" name="lateNotification" value="Submit"class="btn btn-danger">Late Order Fulfilment</button>
							
						</form>
					
					<?php
				}	
					
					
			//close statement
			mysqli_stmt_close($stmt);
		}
						//close connection
						mysqli_close($mysqli);	
					?>
				
							
							
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