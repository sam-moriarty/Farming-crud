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
		<h1>Edit a animal</h1>
		<?php
		//Error handling
			if(isset($_GET['error']))
 				{
 					if ($_GET['error'] == "emptyfields")
 					{
 						echo '<p class="signuperror">Fill in all fields!</p>';
 					}
 					else if ($_GET['error'] == "tagnumtaken")
 					{
 						echo '<p class="signuperror">The tag number you have enetered is already in use!</p>';
 					}
 					else if ($_GET['error'] == "sqlerror1")
	 					{
	 						echo '<p class="signuperror">There is a problem with the website contact the administrator!</p>';
	 					}
 				}

			require 'includes/dbhandler.inc.php'; 

			$id = mysqli_real_escape_string($conn, ($_GET['id']));
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

						echo '<img class="crudpic" alt="an image of the animal you would like to edit" width="100" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ) . '" />';
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
					<form class="editform" name="edit_animals" id="edit_animals"  action="includes/edit.inc.php" method="post" enctype="multipart/form-data">
						<label for="id">Tag Number:</label>
						
						<input type="number" id="id" name="id" required="required" readonly value="<?php echo $id?>" />
						<br /><br /> 
						<label for="image">Image:</label>
					
						<input type="file" id="image" name="image" required="required" />
						<br /><br /> 

						<label for="type_id">Animal Type:</label>
						<select type="text" id="type_id" name="type_id" required="required" class="form-control" value="<?php echo $type?>">
		               		<option value = "Sheep">Sheep</option>
		               		<option value = "Cattle">Cattle</option>
             			</select>
						<br /><br /> 

						<label for="sex">Gender of Animal:</label>
						
						<select type="text" id="sex" name="sex" class="form-control" required="required" value="<?php echo $gender?>"><br /> 
		               		<option value = "Male">Male</option>
		               		<option value = "Female">Female</option>
		               		<option value = "Wether">Wether</option>
             			</select><br />

						<br />
						<label for="health" >Health Status (out of 5):</label>
						<select type="Number" id="healt" name="health" class="form-control" required="required" value="<?php echo $hp?>"><br /> 
		               		<option value = "1">1</option>
		               		<option value = "2">2</option>
		               		<option value = "3">3</option>
		               		<option value = "4">4</option>
		               		<option value = "5">5</option>
		             	</select><br /><br />

						<label for="dob" >Date of Birth:</label>
						
						<input type="date" id="dob" name="dob" min="0" max="10" required="required" value="<?php echo $date?>" />
						<br /><br /> 
						<input type="submit" name="edit-submit" value="Edit Animal" />
						<input type ="button" value="Cancel" onclick="location.href='index.php'" />
					</form>
				</section>
	
		

	</body>
</html>

<?php
	require "footer.php"
?>