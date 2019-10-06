<?php
//Checks that user is gettin here from the add button and not by changing the URL
if (isset($_POST['add-submit']))
{
	//Links to our database without having to enter in big chunk each time
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
	require 'dbhandler.inc.php';
	session_start();


	//html injection prevention
	$tag = mysqli_real_escape_string($conn, $_POST['tag_number']);
	$type = mysqli_real_escape_string($conn, $_POST['type_id']);
	$gender = mysqli_real_escape_string($conn, $_POST['sex']);
	$hp = mysqli_real_escape_string($conn, $_POST['health']);
	$date = mysqli_real_escape_string($conn, $_POST['dob']);
	$id = mysqli_real_escape_string($conn, $_SESSION['sessionId']);
	//get image
	$image = file_get_contents($_FILES['image']['tmp_name']);



	//begin prepared statement for insertion
	if (empty($tag) || empty($type) || empty($gender))
		{
			header("Location: ../addanimal.php?error=emptyfields");
			exit();
		}
	else
	{

		$sql = "SELECT tag_number FROM animals WHERE tag_number=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../addanimal.php?error=sqlerror1");

		exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $tag);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0)
			{
				header("Location: ../addanimal.php?error=tagnumtaken");
				exit();
			}
			else
			{
				$stmt = $conn->prepare("INSERT INTO animals( user_id, `image`, tag_number, type_id, sex, health, `dob` ) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("ibissis", $id, $image, $tag, $type, $gender, $hp, $date);
				//code to add image to database using prepared statement
				$stmt->send_long_data(1, $image);


				//embedded code: if $stmt executes successfully
				if($stmt->execute() === TRUE)
				{
					//alert and redirect
					echo "<script type='text/javascript'>
			             alert('Animal Added!');
			             location='../index.php';
			             </script>";
				}
				else
				{
					
					echo "<script type='text/javascript'>
			             alert('Error: Unable to Add Animal. Please try again.');
			             location='../index.php';
			             </script>";
				}
			}
		}
	}
	
	
	
	//close $stmt
	$stmt->close();
	//close the connection
	$conn->close();

}
else
{
	header("Location: ../addanimal.php");
	exit();
}
