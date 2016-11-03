<?php 
 
  $itemID = $_GET["ItemID"];
 $quantity = $_GET["ItemQuantity"];
 $itemName = $_GET["itemName"];
 $listID = $_GET["listID"];

 include('services/db.php');
	
	if(isset($_POST['update']))
	{
		mysql_query("UPDATE listItems 
		SET quantity = {$_POST['quantity']} WHERE itemID = {$_POST['itemID']} AND listID = {$_POST['listID']}");
		
	}

		
	
	
 ?>
 
 
<!DOCTYPE html>
 <html>
 <head>
	<title>Edit List</title>
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
 <body class ="design" >
	 <table id = "data">
	 
		<input type="hidden" id="listID" name="listID" value="<?php echo $listID; ?>" />
		
		<input type="hidden" id="itemID" name="itemID" value="<?php echo $itemID; ?>" />
				
				<tr><td><a href="viewCustomerList.php?listID=<?php echo $listID; ?>"><img src='images/backBtn.png' alt='Back' class='img'/></a></td><tr>
			
				
			<tr>
				<td> Update quantity for <b><?php echo $itemName; ?> </b></td>
			</tr>
			<tr>
				<td><input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" /></td>
			</tr>
			
			<tr><td><input type="button" class="btn-danger" value="Update" id="update"></td><tr>
			
		
			
	 </table>
	 
 </body>
 </html>
 
  <script type = "text/javascript">
	$(function(){
		
		//update data
		$('#update').click(function(){
			var itemID  = $('#itemID').val();
			var listID	= $('#listID').val();
			var quantity = $('#quantity').val();
			//alert("Item ID = " +itemID);
			//alert("List ID = " + listID);
			//alert("Quantity = " +quantity);
			$.ajax({
				url	:'editCustomerItem.php',
				type:'POST',
				async: false,
				data: {
					'update' 	 : 1,
					'itemID'	: itemID,
					'listID': listID, 
					'quantity' 	 : quantity
				},
				success:function(u)
				{
					if(u!=0)
					{
						alert("Update Successful");
						window.location = "viewCustomerList.php?listID=<?php echo($listID); ?>";
					}
				}
			});
		});
		//end update
		
		
		
		
	});

</script>