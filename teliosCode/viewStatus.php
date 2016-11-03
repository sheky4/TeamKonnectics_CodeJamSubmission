
 
<!DOCTYPE html>
 <html>
 <head>
	<title>View Order Status</title>
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
				<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script rel = "text/javascript" src = "js/jquery-1.11.3.min.js" ></script>
 </head>
 <body class="design">
<div>	
		<form name="back" method="post" action="index.php">
			<input type="image" src="images/backBtn.png" alt="Back">
		</form>
    </div>
 <legend class = "red medium design">View List Status</legend>
	
	 
	 <table>
		<thead>
			<th class = "red medium">List ID</th>
			<th class = "red medium" >List Name</th>
			<th class = "red medium" >Order Status</th>
		</thead>
		<tbody>
		
		
		 <?php
 // include database connection
 include('services/databaseConnection.php');
 
 //start session
session_start();

// call customerID from session
 $customerID = $_SESSION['customerID'];


		
			$stmt= mysqli_prepare($mysqli,"SELECT listID,listName,status FROM list WHERE customerID= $customerID AND status='unfulfilled' AND groceryAccess= 'yes'");
				if($stmt)
			{
			
				mysqli_stmt_execute($stmt);
				
				mysqli_stmt_bind_result($stmt, $listID,$listName,$status);
				
				//fetch values
				while(mysqli_stmt_fetch($stmt))
				{
					
				echo '<table width="100%" border="0" cellspacing="0" cellpadding="6">
					<tr>
					<td>
		  
         			<td> ' . $listID . '<br />
         			<td> ' . $listName . '<br />
					 <td>' . $status . '<br />
        </tr>
      </table>';
					
				
			
	}// End of While Loop
	
				
			/* close statement */
			mysqli_stmt_close($stmt);
				
				
}// End of Statement
				//close connection
				mysqli_close($mysqli);
				

	
	
 ?>
 
		
		
		
		
		
		
		</tbody>
	 </table>
	 
 </body>
 </html>
 
  <script type = "text/javascript">
	$(function(){
				//delete
		$('body').delegate('.delete', 'click', function(){
			var id = $(this).data('item');
			alert(id);
			$.ajax({
				url	:'viewCustomerLists.php',
				type:'POST',
				async: false,
				data: {
					'delete' 	: 1,
					'id'	: id
				},
				success:function(d)
				{
					alert("Delete Successful...!!!");
				
					showdata();
				}
			});
		});
		//delete end



		
		//show/select data
		showdata();
		
		//end edit
		
		
	});//last end 
	
	
	
		//show/select data
	function showdata()
	{
		$.ajax({
			url	:"viewCustomerLists.php?customerID=<?php echo($customerID);?>",
			type : "post",
			async : false, 
			data : {
				'show' : 1
			},
			success:function(r)
			{
				$('#showdata').html(r);
			}
		});
	}
	// end show/select data
	

</script>
<html>
<!--This is the notification code-->
			<script>
			//put the customerID here as a javascript variable
			var customerID = <?php echo ($customerID);?>;
			//alert(customerID);
		</script>
		<script src="ajax_Refresh.js"></script>
		<script src="count_down.js"></script>
		
		
		<audio id="trigger1" src="triggerSound1.mp3" preload="auto"></audio>
		
	<!-- This is the end of it-->
</html>