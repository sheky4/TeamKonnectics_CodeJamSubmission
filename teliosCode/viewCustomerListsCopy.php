<?php

session_start();

if(!isset($_SESSION['customerID']))
	{
		Header("Location:index.php");
	}
	

   $email = $_SESSION['email'];
	echo $customerID = $_SESSION['customerID'];

 

 
 

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
			<li ><a class="red" href="#">Completed Orders</a></li>

			
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
								<div class='center'>
									<a href='index.php'>Home Page </a>
									</div>
                                    <h1 class="red center"> Lists</h1>
									<br/>
									
										<?php
										 if(isset($_GET['fulfilment'])){ 

										echo"<span class='errorMessage'> The order has been successfully fulfilled</span>";
									
										 }
										echo "<br/>";
						include("services/databaseConnection.php");
						
						$date = date('d-m-Y');
						$orderStatus = "unfulfilled";
							
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT list.listID, list.listName FROM list, customer WHERE list.customerID = customer.customerID AND list.customerID = ? ORDER BY list.listName ");
						if ($stmt) 
						{
							
				mysqli_stmt_bind_param($stmt, "i", $customerID);

			/* execute query */
			mysqli_stmt_execute($stmt);
			
			
			/* store result */
				mysqli_stmt_store_result($stmt);

				$test = mysqli_stmt_num_rows($stmt);
				//echo($test);
				
				if($test ==0)
				{
					echo"<span class='errorMessage'> You have not created any lists yet. Click <a href='createList1.php'>here </a> to create a list </span>";
				}
				else if($test != 0)
				{
					
					
					

			mysqli_stmt_bind_result($stmt, $listID, $listName);			
					echo "<table>
";		
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				
			echo "
  <tr>
    <td><a href='viewCustomerList.php?listID=$listID'>$listName</a></td>

   
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