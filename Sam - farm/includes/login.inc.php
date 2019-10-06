<?php
//Checks that user is gettin here from the login button and not by changing the URL
if (isset($_POST['login-submit']))
{
	//Links to our database without having to enter in big chunk each time
	require 'dbhandler.inc.php';

	$useremail = $_POST['mail'];
	$userpassword = $_POST['pwd'];

	//Error Checking
	#Empty entries
	if (empty($useremail) || empty($userpassword))
	{
		header("Location: ../login.php?error=emptyfields");
	exit();
	}
	#Matching up email and password with DB
	else
	{
		$sql = "SELECT * FROM users WHERE email=?;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../login.php?error=sqlemailerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"s", $useremail);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			#make sure our result from the DB is not empty
			if ($row = mysqli_fetch_assoc($result))
			{
				$pwdCheck = password_verify($userpassword, $row['password']);

				//If not equal do not them them log in
				if ($pwdCheck == false)
				{
					header("Location: ../login.php?error=wrongpassword");
					exit();
				}
				//If true then log them in
				else if($pwdCheck == true)
				{
					//SESSIONS<--------------------!
					session_start();
					$_SESSION['sessionId'] = $row['user_id'];
					$_SESSION['sessionEmail'] = $row['email'];

					header("Location: ../index.php?login=success");
					exit();
				}
				//Just in case...
				else
				{
					header("Location: ../login.php?error=wrongpassword");
					exit();
				}
			}
			else
			{
				header("Location: ../login.php?error=nomatchinguser");
				exit();
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else
{
	header("Location: ../login.php");
	exit();
}
