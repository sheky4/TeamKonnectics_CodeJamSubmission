 <?php
 include('services/db.php');
session_start();
	$customerID = $_SESSION['customerID'];
	
 
 //die("myHeadIsVeryBig ".$listID);
 
 	if(isset($_POST['delete']))
	{
		mysql_query("DELETE FROM listItems WHERE listID = '{$_POST['id']}'");
		mysql_query("DELETE FROM list WHERE listID = '{$_POST['id']}'");
		exit();
	}

	

	if(isset($_POST['show']))
		
	{
		$sql = mysql_query("SELECT list.listID, list.listName FROM list, customer WHERE list.customerID = customer.customerID AND list.customerID = $customerID ORDER BY list.listName");
		while($row = mysql_fetch_object($sql)){
			$count = mysql_num_rows($sql);
			
			if($count == 0){
				echo "Achieved";
			}else{ echo"Yes";}

			
			
			?>
			<tr class = "red medium">
				<td><?php echo $row->listID ?></td>
				<td><a href='viewCustomerList.php?listID=<?php echo $row->listID ?>'><?php echo $row->listName ?></td>
				
				
				

				<td><a href="#"  data-item ="<?php echo $row->listID?>" class="delete"><img src="images/deleteBtn.png" alt="Delete" class="img"/></a></td>
				

			
				
			</tr>
			<?php
		}
		exit();
	}
	
	
	
 ?>
 
 
<!DOCTYPE html>
 <html>
 <head>
	<title>View Created Lists</title>
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
 <legend class = "red medium design">View List</legend>
	
	 
	 <table>
		<thead>
			<th class = "red medium">List ID</th>
			<th class = "red medium" >List Name</th>
		</thead>
		<tbody id = "showdata">
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
<!-- Geofence Links --> 
		<audio id="trigger1" src="triggerSound1.mp3" preload="auto"></audio>
    		<script type="text/javascript" src="fence.js"></script>
</html>