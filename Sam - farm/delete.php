<?php require "header.php";

	//Stopping people from url jumping
 	if (!isset($_SESSION['sessionId']))
	{
		header("Location: login.php");
		exit;
	}
 ?>

 	
 <!DOCtitle html> 
<html>  
	<body>
		<h1>Delete a animal</h1>
		<?php
			require 'includes/dbhandler.inc.php'; 
			$id = mysqli_real_escape_string($conn, htmlentities($_GET['id']));
			$sql = "SELECT * FROM animals WHERE tag_number=" . $id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
				{
					//while loop
					while($row = $result->fetch_assoc())
					{
						//loop to define variables for later
						$image = $row['image'];
						$tag = htmlentities($row['tag_number']);
						$type = htmlentities($row['type_id']);
						$gender = htmlentities($row['sex']);
						$hp = htmlentities($row['health']);
						$date = htmlentities($row['dob']);

						echo '<img alt="an image of the animal you would like to delete" width="100" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ) . '" />';
					}
				}
				else
				{
					header("Location: delete.php?error=databaseerror");
					exit();
				}
				//close connection
				$conn->close();
			?>	
			<section>
				<form class="editform" id="delete_aniaml" action="includes/delete.inc.php" method="post">
					<label for="id">Tag Number:</label>
					<input type="text" id="id" name="id" required="required" size="3" readonly value="<?php echo $id?>" />
					<br />
					<br />
					Animal Type: <?php echo $type ?>
					<br />
					<br />
					Sex: <?php echo $gender ?>
					<br />
					<br />
					Health of the animal: <?php echo $hp ?>
					<br />
					<br />
					Date of Birth: <?php echo $date ?>
					<br />
					<br />
					<input type="submit" value="Delete" name="delete-submit" />
					<!-- Cancel button to redirect -->
					<input type ="button" value="Cancel" onclick="location.href='index.php'" />
				</form>
			</section>
		
		

	</body>
</html>

<?php
	require "footer.php"
?>