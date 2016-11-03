 <?php
 include('services/db.php');

  $listID = 28;
 
	if(isset($_POST['saverecord']))
	{
		mysql_query("INSERT INTO listItems (itemID, listID, quantity) VALUES('{$_POST['itemID']}','$listID','{$_POST['phone']}') ");
		exit();
	}
	
	if(isset($_POST['delete']))
	{
		mysql_query("DELETE FROM listItems WHERE listID = $listID AND itemID = '{$_POST['id']}'");
		exit();
	}
	
	
	
	
	if(isset($_POST['show']))
	{
		$sql = mysql_query("SELECT listItems.listID, listItems.itemID, item.itemName, listitems.quantity FROM item, listitems WHERE listitems.itemID = item.itemID AND listItems.listID = 28 ORDER BY listID ");
		while($row = mysql_fetch_object($sql)){
			
			?>
			<tr>
				<td><?php echo $row->listID ?></td> 
				<td><?php echo $row->itemName ?></td>
				<!--<td><?php echo $row->itemID ?></td> -->
				<td><input value="<?php echo $row->quantity ?> "type="text"<?php echo $row->quantity ?>></td>
				
				
				
				
				
				<td><a href="#" data-id="<?php echo $row->listID?>" class="edit">Edit</a></td>
				
				<td><a href="#"  data-id="<?php echo $row->itemID?>" class="delete">Delete</a></td>
				
				
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
	 <table id = "data">
			
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
				<td><input type="number"  name="phone" id = "phone"></td>
			</tr>
			<tr><td><input type="button" value="Save" id="save"></td><tr>
			
			<tr><td><input type="button" value="Update" id="update"></td><tr>
			
		
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
			var id = $(this).data('id');
			$.ajax({
				url	:'ajax.php',
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
			var phone = $('#phone').val();
			$.ajax({
				url	:'ajax.php',
				type:'POST',
				async: false,
				data: {
					'saverecord' : 1,
					'itemID': itemID, 
					'phone'		 : phone
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
	});
	
		//show/select data
	function showdata()
	{
		$.ajax({
			url	:"ajax.php",
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