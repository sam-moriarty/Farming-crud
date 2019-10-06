<?php
//When I edit an entry the image dissapers and I cannot seem to find a fix for it

//Checks that user is gettin here from the add button and not by changing the URL
if (isset($_POST['edit-submit']))
{
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
	require 'dbhandler.inc.php';
	session_start();
	//define variables whilst mitigating against HTML injection
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$type = mysqli_real_escape_string($conn, $_POST['type_id']);
	$gender = mysqli_real_escape_string($conn, $_POST['sex']);
	$hp = mysqli_real_escape_string($conn, $_POST['health']);
	$date = mysqli_real_escape_string($conn, $_POST['dob']);
	//get image
	$image = file_get_contents($_FILES['image']['tmp_name']);

	if (empty($id) || empty($type) || empty($gender))
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
				//begin prepared statement for update
				$stmt = $conn->prepare("UPDATE `animals` SET `image`=?,`type_id`=?,`sex`=?,`health`=?,`dob`=? WHERE `tag_number`=?;");
				$stmt->bind_param("bssisi", $image, $type, $gender, $hp, $date, $id);
				//code to insert blob image into database
				$stmt->send_long_data(0, $image);

				//if command executes
				if($stmt->execute() === TRUE)
				{
					//alert and redirect
					echo "<script type='text/javascript'>
			        alert('Animal Successfully Edited');
			        location='../index.php';
			        </script>";
				}
				else
				{
					"<script type='text/javascript'>
			        alert('Error: Unable to Edit Animal. Please try again.');
			        location='../delete.php';
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
	header("Location: ../login.php");
	exit();
}