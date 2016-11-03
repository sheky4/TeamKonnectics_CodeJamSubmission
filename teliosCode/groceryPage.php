<?php

	$listID = $_GET['listID'];
 
	echo $sql = "UPDATE list SET groceryAccess = 'yes' WHERE list.listID = $listID";
 
	include("services/databaseConnection.php");
		 
			
			if ($stmt = mysqli_prepare($mysqli, "UPDATE list SET groceryAccess = 'yes' WHERE list.listID = ?;")) 
			{
				//bind parameters for markers
				mysqli_stmt_bind_param($stmt, "i", $listID);
			
				//execute query
				mysqli_stmt_execute($stmt);
				//store result
			
				mysqli_stmt_store_result($stmt);
		
			
				//get the number of rows returned
				$test = mysqli_stmt_num_rows($stmt);

				Header("Location:viewCustomerList.php?listID=$listID&successMsg=success");
					

				//close statement
				mysqli_stmt_close($stmt);
			}
 

?>