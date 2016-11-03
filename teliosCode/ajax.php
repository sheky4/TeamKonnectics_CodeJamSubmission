 <?php
 include('services/db.php');
session_start();
	  $customerID = $_SESSION['customerID'];
	 $email = $_SESSION['email'];
	
 
 $listID = $_GET['listID'];
 
 //die("myHeadIsVeryBig ".$listID);
 

 //$listID = 36;
 
	if(isset($_POST['saverecord']))
	{
		
		mysql_query("INSERT INTO listItems (itemID, listID, quantity) VALUES('{$_POST['itemID']}','$listID','{$_POST['quantity']}') ");
		exit();
	}
	
	if(isset($_POST['delete']))
	{
		mysql_query("DELETE FROM listItems WHERE listID = $listID AND itemID = '{$_POST['id']}'");
		exit();
	}
	
	if(isset($_POST['update']))
	{
		mysql_query("UPDATE listItems 
		SET quantity = '{$_POST['quantity']}'
					WHERE itemID = '{$_POST['itemID']}'
					AND listID = '{$_POST['listID']}'");
		exit();
	}
	
	
	

	if(isset($_POST['show']))
		
	{
		$sql = mysql_query("SELECT listItems.listID, listItems.itemID, item.itemName, listitems.quantity FROM item, listitems, list WHERE listitems.itemID = item.itemID AND list.listID = listitems.listID AND listItems.listID = $listID AND customerID = $customerID ORDER BY listID ");
		while($row = mysql_fetch_object($sql)){
			$count = mysql_num_rows($sql);
			
			if($count == 0){
				echo "Achieved";
			}

			
			
			?>
			<tr>
				<td><?php echo $row->itemName ?></td>
				<td><input value="<?php echo $row->quantity ?> "type="text"<?php echo $row->quantity ?>></td>
				
				
				
				
				
				<!--<td><a href="#" data-item="<?php echo $row->itemID?>"  data-list="<?php echo $row->listID?>" class="update">Edit</a></td>-->
						
				<td><a href="testEdit3.php?ItemID=<?php echo $row->itemID; ?>&ItemQuantity=<?php echo $row->quantity;?>&itemName=<?php echo $row->itemName;?>&listID=<?php echo $listID; ?>">Edit</a></td>
				
				<td><a href="#"  data-item ="<?php echo $row->itemID?>" class="delete">Delete</a></td>
				<td><input type='hidden' value = "<?php echo $row->itemID; ?>" />  </td> 
				<td><input type='hidden' value = "<?php echo $row->listID; ?>" />  </td> 
				
			</tr>
			<?php
		}
		exit();
	}
	
	
	
 ?>
 
 
<!DOCTYPE html>
 <html>
 <head>
	<title>Add Item</title>
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
 <body>
 <form name="back" method="post" action="viewCustomerLists.php">
					<input type="image" src="images/backBtn.png" alt="Back">
					</form>
 <legend class = "red medium design">Add Items to List</legend>
	 <table class="design" id = "data">
			
			<tr>
				<td>Select Item</td>
				<td>:</td>
				<td><select name="itemID" id="itemID">
					<option value="default">Select Item</option>
					<?php
						include("services/databaseConnection2.php");
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT itemID, itemName FROM item");
						if ($stmt) 
						{
							//execute query
							mysqli_stmt_execute($stmt);
							
							mysqli_stmt_bind_result($stmt, $itemID, $itemName);
							
							//fetch values
			while(mysqli_stmt_fetch($stmt)) 
			{
				if($value2 == $itemID)
				{
					echo('<option value="'.$itemID.'" selected="selected">'.$itemName.'</option>');
				}
				else
				{
					echo('<option value="'.$itemID.'">'.$itemName.'</option>');
				}
			}	
					
			//close statement
			mysqli_stmt_close($stmt);
		}
						//close connection
						mysqli_close($mysqli);	
					?>
				</select></td>
			</tr>

			<tr>
				<td>Quantity</td>
				<td>:</td>
				<td><input type="number"  name="quantity" id = "quantity"></td>
			</tr>
			<tr><td><input type="button" value="Save" id="save"></td><tr>
	 </table>
	 
	 <table>
		<thead>
			<th class = "red medium">Item</th>
			<th class = "red medium">Quantity</th>
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
			$.ajax({
				url	:'ajax.php?listID=<?php echo($listID); ?>',
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
		
		//save data
		$('#save').click(function(){
			var itemID = $('#itemID').val();
			var quantity = $('#quantity').val();
			$.ajax({
				url	:"ajax.php?listID=<?php echo($listID);?>&customerID=<?php echo($customerID);?>",
				type:'POST',
				async: false,
				data: {
					'saverecord' : 1,
					'itemID': itemID, 
					'quantity'		 : quantity
				},
				success:function(re)
				{
					if(re==0)
					{
						alert("Insert Successful");
						showdata();
						
					}
				}
			});
		});
		//end save
		
			//edit 
		$('body').delegate('.update', 'click', function(){
			var item = $(this).data('item');
			var list = $(this).data('list');
			alert(item);
			alert(list);
			$.ajax({
				url	:'ajax.php?listID=<?php echo($listID); ?>',
				type:'POST',
				async: false,
				data: {
					'update' 	: 1,
					'item'	: item,
					'list'	: list
				},
				success:function(e)
				{
					alert("success");
				}
			});
		});
		
		//end edit
		
		
	});//last end 
	
	
	
		//show/select data
	function showdata()
	{
		$.ajax({
			url	:"ajax.php?listID=<?php echo($listID); ?>&customerID=<?php echo($customerID);?>",
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