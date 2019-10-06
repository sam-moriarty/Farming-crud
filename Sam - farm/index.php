<?php
	require "header.php"
?>
<style> <?php include 'styles.css'; ?> </style>

 	<main>
 		<div class="wrapper-main">
 			<section class="successhandling">

		 		<?php
		 			if(isset($_SESSION['sessionId']))
		 			{
		 				echo '<p class="login-staus">You are logged in!</p>
		 					<a class="homebtn" href="sheep.php">Sheep Catalogue</a>
 							<a class="homebtn" href="cattle.php">Cattle Catalogue</a>';
		 			}
		 			else
		 			{
		 				header("Location: login.php");
						exit();
		 			}
		 		?>

 			</section>
 			
 		</div>

 	</main>


<?php
	require "footer.php"
?>