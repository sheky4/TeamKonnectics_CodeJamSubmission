<?php

	//get the values from the url
	$customerID = $_GET["customerID"];
	//$custStatus = $_GET["value2"];
	//echo("the id is ".$customerID);
	//$modified = $_GET["value3"];
//echo($customerID);
	//hard code modified always leave as 1
	$triggered = 1;
	
	include("services/databaseConnection.php");
	$exists = "";
	
	$lName = "";
	$triggeredStatus = "";
	$statusName = "";
	
	//check db to see if the person's status has been verified
	if ($stmt = mysqli_prepare($mysqli, "SELECT listName, triggered, status FROM list WHERE customerID = ? AND triggered =?")) 
	{
		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "ii", $customerID, $triggered);

		/* execute query */
		mysqli_stmt_execute($stmt);

		/* store result */
		mysqli_stmt_store_result($stmt);

		$exists = mysqli_stmt_num_rows($stmt);
		
		mysqli_stmt_bind_result($stmt, $ln, $t, $sn);
		
		/* fetch values */
		if (mysqli_stmt_fetch($stmt)) 
		{
			$lName = $ln;
			$triggeredStatus = $t;
			$statusName = $sn;
		}
		mysqli_stmt_close($stmt);
	}			

	/* close connection */
	//mysqli_close($mysqli);

	if($exists != 0)
	{
		echo("List has been updated: List Name: $lName | Triggered: $triggeredStatus | List Status: $statusName");
	}
	else{
		echo("No changes have been detected");
	}

//write sql to reset modify to 0
	//check db to see if the person's status has been verified
	$resetVal = 0;
	if ($stmt = mysqli_prepare($mysqli, "UPDATE list SET triggered = ? WHERE customerID = ?")) 
	{
		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "ii", $resetVal, $customerID);

		/* execute query */
		mysqli_stmt_execute($stmt);

		mysqli_stmt_close($stmt);
	}			

	/* close connection */
	mysqli_close($mysqli);
	

?>