<?php 
 
  $itemID = $_GET["ItemID"];
 $quantity = $_GET["ItemQuantity"];
 $itemName = $_GET["itemName"];
 $listID = $_GET["listID"];
 
  include('services/db.php');
	
		if(isset($_POST['update']))
	{
		$updateQuery = "UPDATE listItems 
		SET quantity = {$_POST['quantity']} WHERE itemID = {$_POST['itemID']} AND listID = {$_POST['listID']}";
		echo $updateQuery;
		mysql_query($updateQuery);
		//echo 0;
		exit();
	}


	?>
	<script rel = "text/javascript" src = "js/jquery-1.11.3.min.js" ></script>
	<form method="post" action="testEdit3.php">
		<input type="hidden" id="listID" name="listID" value="<?php echo $listID; ?>" />
		
		<input type="hidden" id="itemID" name="itemID" value="<?php echo $itemID; ?>" />

		Update quantity for <b><?php echo $itemName; ?> </b>
		<br/>
		<br/>
		<input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" />
		<br/>
		<br/>
		<tr><td><input type="submit" value="Update" id="update" name="update" /></td><tr>
	
	</form>
	<hr/>
	
	<a href="ajax.php">Back</a>
		
<script type = "text/javascript">
	$(function(){
		//update data
		$('#update').click(function(){
			var itemID  = $('#itemID').val();
			var listID	= $('#listID').val();
			var quantity = $('#quantity').val();	
			$.ajax({
				url	:'testEdit3.php',
				type:'POST',
				async: false,
				data: {
					'update': 1,
					'itemID': itemID,
					'listID': listID, 
					'quantity': quantity
				},
				success:function(u)
				{
					if(u==0)
					{
						alert("Update Successful");
					}
				}
			});
		});
		//end update
		
		
		
	});//last end 
	

</script>