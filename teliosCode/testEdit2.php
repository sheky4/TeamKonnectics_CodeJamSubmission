<?php 


 
  include('services/db.php');
	
		if(isset($_POST['update']))
	{
		mysql_query("UPDATE listItems 
		SET quantity = '{$_POST['quantity']}', 
					WHERE itemID = '{$_POST['itemID']}'
					AND listID = '{$_POST['listID']}'");
		echo 0;
		exit();
	}
	
	

 $itemID = $_GET["ItemID"];
 $quantity = $_GET["ItemQuantity"];
 $itemName = $_GET["itemName"];
 $listID = $_GET["listID"];
	?>
	
		<input type="hidden" id="listID" name="listID" value="<?php echo $listID; ?>" />
		
		<input type="hidden" id="itemID" name="itemID" value="<?php echo $itemID; ?>" />

		Update quantity for <b><?php echo $itemName; ?> </b>
		<br/>
		<br/>
		<input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" />
		<br/>
		<br/>
		<tr><td><input type="button" value="Update" id="update"></td><tr>
	
	<hr/>
	
	<a href="ajax.php">Back</a>
		
<script type = "text/javascript">
	$(function(){
		
	//update data
		$('#update').click(function(){
			var listID  		= $('#listID').val();
			var itemID	= $('#ItemID').val();
			var quantity 		= $('#quantity').val();
			alert(listID);
			$.ajax({
				url	:'testEdit2.php',
				type:'POST',
				async: false,
				data: {
					'update' 	 : 1,
					'listID'		 : listID,
					'itemID': itemID, 
					'quantity' 	 : quantity
				},
				success:function(u)
				{
					if(u==0)
					{
						alert("Update Successful");
						$('#quantity').val('');
						showdata();
					}
				}
			});
		});
		//end update
		
		
	});//last end 
	

</script>