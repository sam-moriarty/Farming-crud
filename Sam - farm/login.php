<?php require "header.php" ?>
<style> <?php include 'styles.css'; ?> </style>

 	<main>
 		
 		
 		<div class="login">

 				<h1 class="loginh1">Please Log In</h1>

 				<label class="errorhandling">
 				<?php
	 			//Error messages
				 	if (isset($_SESSION['sessionId']) )
					{
						echo '<p class="alreadyloggedin">Please Log Out First!</p>';
					}
	 				
	 				if(isset($_GET['error']))
	 				{
	 					if ($_GET['error'] == "emptyfields")
	 					{
	 						echo '<p class="signuperror">Fill in all fields!</p>';
	 					}
	 					else if ($_GET['error'] == "sqlemailerror")
	 					{
	 						echo '<p class="signuperror">The email you have entered does not have an account attached to it</p>';
	 					}
	 					else if ($_GET['error'] == "wrongpassword")
	 					{
	 						echo '<p class="signuperror">The password you have entered is incorrect!</p>';
	 					}
	 					else if ($_GET['error'] == "nomatchinguser")
	 					{
	 						echo '<p class="signuperror">The email you have entered does not have an account attached to it</p>';
	 					}
	 				}
	 			?>
	 			</label>

				<form class="loginform" action="includes/login.inc.php" method="post">
					
					<input type="email" name="mail" placeholder="Email">
					<input type="password" name="pwd" placeholder="Password">
					<button class="loginbtn" type="submit" name="login-submit">Login</button>
				</form>

				<a class="accbtn" href="signup.php">Sign Up</a>
		</div>
 	</main>

<?php
	require "footer.php"
?>

