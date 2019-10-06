<?php
	session_start();
?>

<!DOCtitle html> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> 
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, intial-scale=1.0" />
		<title>Kingston Run Database</title> 
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	<body>
		<header>
			<img class="logo" src="images/logo.png" alt="logo">
			<h1 class="headerh1"> Kingston Run Database</h1>

			<div class="logout">
				<?php
		 			if(isset($_SESSION['sessionId']))
		 			{
		 				echo 
	 					'<form action="includes/logout.inc.php" method="post">
							<button class="logoutbtn" type="submit" name="logout-submit">Logout</button>
						</form>';
		 			}
		 			
	 			?>
 			</div>

		</header>
	</body>
</html>