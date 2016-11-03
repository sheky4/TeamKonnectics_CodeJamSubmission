 <?php
 include('services/db.php');
 
	
	if(isset($_POST['delete']))
	{
		mysql_query("DELETE FROM listItems WHERE itemID =  '{$_POST['id']}'");
		exit();
	}
	
 
 
	if(isset($_POST['saverecord']))
	{
		mysql_query("INSERT INTO listItems (itemID, listID, quantity) VALUES('{$_POST['itemID']}','{$_POST['listID']}','{$_POST['quantity']}') ");
		echo 0;
		exit();
	}
	
	
	
	if(isset($_POST['show']))
	{
		$sql = mysql_query("SELECT * FROM listItems");
		while($row = mysql_fetch_object($sql)){
		
			
			?>
			<tr>
				<td><?php echo $row->listID ?></td>
				<td><?php echo $row->itemID ?></td>
				<td><?php echo $row->quantity ?></td>

				
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
			<input type = "text" id ="id"  value="">
			<tr>
				<td>List ID</td>
				<td>:</td>
				<td><input type="text" name="listID" id = "listID"></td>
			</tr>

			<tr>
				<td>ItemID</td>
				<td>:</td>
				<td><input type="text" name="itemID" id = "itemID"></td>
			</tr>
			
			<tr>
				<td>quantity</td>
				<td>:</td>
				<td><input type="text" name="quantity" id = "quantity"></td>
			</tr>
			
			<tr><td><input type="button" value="Save" id="save"></td><tr>
			
	 </table>
	 
	 <table>
		<thead>
			<th>List ID</th>
			<th>Item ID</th>
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
				url	:'delete.php',
				type:'POST',
				async: false,
				data: {
					'delete' 	: 1,
					'id'	: id
				},
				success:function(d)
				{
					alert("Delete Successful...!!!");
					alert(id);
					showdata();
				}
			});
		});
		//delete end
		

		
		
		//show/select data
		showdata();
		
		
		
		
		//save data
		$('#save').click(function(){
			var listID = $('#listID').val();
			var itemID = $('#itemID').val();
			var quantity = $('#quantity').val();
			$.ajax({
				url	:'delete.php',
				type:'POST',
				async: false,
				data: {
					'saverecord' : 1,
					'listID': listID, 
					'itemID' 	 : itemID,
					'quantity'		 : quantity
				},
				success:function(re)
				{
					if(re==0)
					{
						alert("Insert Successful");
						$('#listID').val('');
						$('#itemID').val('');
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
			url	:"delete.php",
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