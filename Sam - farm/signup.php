<?php
	require "header.php"
?>

 	<main>
 		<div class="main-body">
 			<section class="section-default">
	 			<h1 class ="loginh1">Signup</h1>
	 			<label class="errorhandling">
	 			<?php
	 			//Error messages
	 				if(isset($_GET['error']))
	 				{
	 					if ($_GET['error'] == "emptyfields")
	 					{
	 						echo '<p class="signuperror">Fill in all fields!</p>';
	 					}
	 					else if ($_GET['error'] == "invalidmailandpwd")
	 					{
	 						echo '<p class="signuperror">Both your email and password are invalid!</p>';
	 					}
	 					else if ($_GET['error'] == "invalidemail")
	 					{
	 						echo '<p class="signuperror">Your email is invalid!</p>';
	 					}
	 					else if ($_GET['error'] == "iinvalidpassword")
	 					{
	 						echo '<p class="signuperror">Your password is invalid, make sure not to include any special characters.</p>';
	 					}
	 					else if ($_GET['error'] == "passwordcheck")
	 					{
	 						echo '<p class="signuperror">Your passwords do not match!</p>';
	 					}
	 					else if ($_GET['error'] == "usernametaken")
	 					{
	 						echo '<p class="signuperror">The email address you have enetered is already in use!</p>';
	 					}
	 				}
	 			?>
	 		</label>
	 			<form class="account-form" action="includes/signup.inc.php" method="post">
	 				<input type="email" name="mail" placeholder="Email">
	 				<input type="password" name="pwd" placeholder="Password (Containg only letters and numbers)">
	 				<input type="password" name="pwd-repeat" placeholder="Repeat Password">
	 				<button class="loginbtn" type="submit" name="signup-submit">Create your account</button>
	 			</form>
	 			<a class="accbtn" href="login.php">Cancel</a>
 			</section>
 		</div>

 	</main>


<?php
	require "footer.php"
?>