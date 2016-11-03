 <?php
 include('services/db.php');

  $listID = 28;
 
	if(isset($_POST['saverecord']))
	{
		mysql_query("INSERT INTO listItems (itemID, listID, quantity) VALUES('{$_POST['itemID']}','$listID','{$_POST['quantity']}') ");
		echo 0;
		exit();
	}
	
	if(isset($_POST['show']))
	{
		$sql = mysql_query("SELECT * FROM listItems");
		while($row = mysql_fetch_object($sql)){
			
			?>
			<tr>
				<td><?php echo $row->itemID ?></td>
				<td><?php echo $row->listID ?></td>
				<td><?php echo $row->quantity ?></td>
				
				
				<td><a href="#" data-id="<?php echo $row->listID?>" class="edit">Edit</a></td>
				
				<td><a href="#"  data-id="<?php echo $row->listID?>" class="delete">Delete</a></td>
				
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
				<td>Student Name</td>
				<td>:</td>
				<td><input type="text" name="itemID" id = "itemID"></td>
			</tr>

			<tr>
				<td>Phone</td>
				<td>:</td>
				<td><input type="text" name="phone" id = "phone"></td>
			</tr>
			<tr><td><input type="button" value="Save" id="save"></td><tr>
			
			<tr><td><input type="button" value="Update" id="update"></td><tr>
	 </table>
	 
	 <table>
		<thead>
			<th>Item ID</th>
			<th>List ID</th>
			<th>Quantity</th>
		</thead>
		<tbody id = "showdata">
		</tbody>
	 </table>
	 
 </body>
 </html>
 
  <script type = "text/javascript">
	$(function(){


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
						$('#itemID').val('');
						$('#phone').val('');
						
						
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