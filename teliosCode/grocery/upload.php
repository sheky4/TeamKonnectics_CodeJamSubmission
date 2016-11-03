<html>
<head>
<title> PHP - Album System </title>
<link rel = 'stylesheet' href ='style.css' />
</head>
<body>
<?php 	include("services/databaseConnection.php"); ?>
<div id = 'body'>

<?php session_start();
	
	
	
?>
	<div id='container'>
		<h3> Upload Photos : </h3>
		<form enctype='multipart/form-data' method='post' >
		<?php
		
		
			if(isset($_POST['upload'])){
				$name = $_POST['username'];
				$email = $_POST['email'];
				$file = $_FILES['file']['type'];
				$file_type = $_FILES['file']['size'];
				$file_tmp = $_FILES['file']['tmp_name'];
				$random_name = rand();
				$random_name = $random_name.".jpg";
				
				if(empty($name) or empty($file)){
					echo"Please Fill all the Fields! <br/><br/>";
				} else {
					move_uploaded_file($file_tmp, 'businessDocuments/'.$random_name.'.jpg');
					
					if ($stmt = mysqli_prepare($mysqli, "INSERT INTO grocery(username, email, busRegCert) VALUES (?, ?, ?)")) 
			{
				
				mysqli_stmt_bind_param($stmt, "sss", $name, $email, $random_name);
				
				
				mysqli_stmt_execute($stmt) or die (mysqli_error($mysqli));

				
				mysqli_stmt_close($stmt);
			}
					
					
					echo"Photo Uploaded!! <br/> <br/>";
					
				}
			}
		?>
			Username : <br/>
			<input type ='text' name='username'/>
			<br/><br/>
			
			Email : <br/>
			<input type ='text' name='email'/>
			<br/><br/>
			

			<br/><br/> 
			Select Photo : <br/>
			<input type ='file' name='file' />
			<br/><br/>
			<input type = 'submit' name='upload' value='Upload' />
		</form>
	</div>
</div>

</body>
</html>