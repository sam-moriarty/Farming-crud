<?php
//Checks that user is gettin here from the add button and not by changing the URL
if (isset($_POST['delete-submit']))
{
	//Links to our database without having to enter in big chunk each time
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
	require 'dbhandler.inc.php';
	session_start();

	//get $id variable from POST method from delete_beer.php form
	$id = mysqli_real_escape_string($conn, $_POST['id']);

	//begin prepared statement for delete
	$stmt = $conn->prepare("DELETE FROM animals WHERE tag_number =?");
	$stmt->bind_param("i", $id);

	//if and else statement for if command executes or not
	if($stmt->execute() === TRUE)
	{
		//alert and redirect
		echo "<script type='text/javascript'>
             alert('Animal Deleted!');
             location='../index.php';
             </script>";
	}
	else
	{
		header("Location: ../delete.php?error=sqlerror");
		exit();
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