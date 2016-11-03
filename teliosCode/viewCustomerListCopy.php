 <?php
 include('services/db.php');
session_start();
	 echo $customerID = $_SESSION['customerID'];
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
				echo "Hey";
			}

			
			
			?>
			<tr>
				<td><?php echo $row->itemName ?></td>
				<td><input value="<?php echo $row->quantity ?> "type="text"<?php echo $row->quantity ?>></td>
				
				
				
				
				
				<!--<td><a href="#" data-item="<?php echo $row->itemID?>"  data-list="<?php echo $row->listID?>" class="update">Edit</a></td>-->
						
				<td><a href="editCustomerItem.php?ItemID=<?php echo $row->itemID; ?>&ItemQuantity=<?php echo $row->quantity;?>&itemName=<?php echo $row->itemName;?>&listID=<?php echo $listID; ?>">Edit</a></td>
				
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
	<title></title>
	
	<script rel = "text/javascript" src = "js/jquery-1.11.3.min.js" ></script>
 </head>
 <body>
 <div>	
	<a href='viewCustomerLists.php'>Back</a>
 </div>
	 <table id = "data">
			
			<tr>
				<td>Select Item</td>
				<td>:</td>
				<td><select name="itemID" id="itemID">
					<option value="default">Select Item</option>
					<?php
						include("services/databaseConnection2.php");
						//create a prepared statement
						$stmt = mysqli_prepare($mysqli, "SELECT itemID, itemName FROM item ORDER BY itemName");
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
			<th>Item</th>
			<th>Quantity</th>
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
				url	:'viewCustomerList.php?listID=<?php echo($listID); ?>',
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
				url	:'viewCustomerList.php?listID=<?php echo($listID); ?>',
				type:'POST',
				async: false,
				data: {
					'saverecord' : 1,
					'itemID': itemID, 
					'quantity'		 : quantity
				},
				success:function(re)
				{
					if(re!=0)
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
				url	:'viewCustomerList.php?listID=<?php echo($listID); ?>',
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
			url	:"viewCustomerList.php?listID=<?php echo($listID); ?>&customerID=<?php echo($customerID);?>",
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