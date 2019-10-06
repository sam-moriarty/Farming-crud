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
		<h1>Sheep Catalogue</h1>
		<a href="index.php" class="addbtn">Back</a>
		<a href="addanimal.php" class="addbtn">Add Sheep</a>


		<?php
			//Connecting to the database
			require 'includes/dbhandler.inc.php';


			//Checks that only sheep are displyed AND the the logged in user can only view their own animals
			$sql = ("SELECT * FROM  animals WHERE upper(type_id) LIKE '%SHEEP%' AND   user_id = '{$_SESSION['sessionId']}'");
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{

			

					echo "<table>
							<tr>
								<th>Tag Number</th>
								<th>Image</th>
								<th>Sex</th>
								<th>Date of Birth</th>
								<th>Health</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>";
				    // output data of each row
				    while($row = $result->fetch_assoc()) 
				    {

				    	/*$image = sanitize input($row[$"image"]):
						$title = sanitize_input($row["title"]);
						$author = sanitize_input($row["author"]);
						$year = sanitize_input($row["year"]);
						*/
							

				        echo('<tr>');
				        	echo('<td>' . $row["tag_number"] . '</td>');
							echo('<td><img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="There is no image for this sheep" width="100" /></td>');
							echo('<td>' . $row["sex"] . '</td>');
							echo('<td>' . $row["dob"] . '</td>');
							echo('<td>' . $row["health"] . '</td>');
							echo('<td><a class="tblbtn" href="edit.php?id=' . $row["tag_number"] . '">Edit</a></td>');
							echo('<td><a class="tblbtn" href="delete.php?id=' . $row["tag_number"] . '">Delete</a></td>');
						echo('</tr>');
				    }
				    echo "</table>";
				}
			else {
			    echo 'No sheep currently exist in the database :(';
			}
			$conn->close();
		 	

 		?>

	</body>
</html>

<?php
	require "footer.php"
?>