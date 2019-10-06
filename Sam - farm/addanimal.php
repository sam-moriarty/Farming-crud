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
		<h1>Add a animal</h1>
		<?php
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
	 				}
	 	?>
		<section>
			<form class="editform" name ="add-submit"  id="animalform" action="includes/add.inc.php" method="post" enctype="multipart/form-data">
				<label for="image">Image</label> 
				<input type="file" id="image" name="image" /><br /> <br />
				<label for="tag_number">Tag Number</label> 
				<input type="text" id="tag_number" name="tag_number" /><br /><br />

				<label for="type_id">Type of Animal</label> 
				<select type="text" id="type_id" name="type_id" class="form-control"><br /> 
               		<option value = "Sheep">Sheep</option>
               		<option value = "Cattle">Cattle</option>
             	</select><br /><br />

				<label for="sex">Gender of Animal</label> 
				<select type="text" id="sex" name="sex" class="form-control"><br /> 
               		<option value = "Male">Male</option>
               		<option value = "Female">Female</option>
               		<option value = "Wether">Wether</option>
             	</select><br /><br />

				<label for="dob">Date of Birth</label> 
				<input type="Date" id="dob" name="dob" /><br /><br />

				<label for="health">Health of Animal (Out of 5):  </label>
				<select type="Number" id="healt" name="health" class="form-control"><br /> 
               		<option value = "1">1</option>
               		<option value = "2">2</option>
               		<option value = "3">3</option>
               		<option value = "4">4</option>
               		<option value = "5">5</option>
             	</select><br /><br />
				
				<input type="submit" value="Add Animal" name="add-submit" />
				<input type="button" value="Cancel" onclick="location.href='index.php'" />
			</form>
		</section>
		

	</body>
</html>

<?php
	require "footer.php"
?>