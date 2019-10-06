<?php
//Checks that user is gettin here from create a user page and not by changing the URL
if (isset($_POST['signup-submit']))
{
	require 'dbhandler.inc.php';

	$useremail = $_POST['mail'];
	$userpassword = $_POST['pwd'];
	$passwordrepeat = $_POST['pwd-repeat'];


	//Error Handling

		#If Empty inputs sends them back to sign up page and should keep email input if it was correct
		if (empty($useremail) || empty($userpassword) || empty($passwordrepeat))
		{
			header("Location: ../signup.php?error=emptyfields&mail=".$useremail);

			exit();
		}
		//Checking for both invalid email and password
		else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userpassword))  
		{
			header("Location: ../signup.php?error=invalidmailandpwd");

			exit();
		}
		// Checking for invalid email
		else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) 
		{
			header("Location: ../signup.php?error=invalidemail");

			exit();
		}
		// Checking for invalid password and doesn't allow symbols
		else if (!preg_match("/^[a-zA-Z0-9]*$/", $userpassword)) 
		{
			header("Location: ../signup.php?error=invalidpassword&mail=".$useremail);

			exit();
		}
		//Check that the two passwords match
		else if ($userpassword !== $passwordrepeat) 
		{
			header("Location: ../signup.php?error=passwordcheck&mail=".$useremail);

			exit();
		}
		//Checking that a duplicate email is not added to the database with injection prevention
		else
		{
			$sql = "SELECT email FROM users WHERE email=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql))
			{
				header("Location: ../signup.php?error=sqlerror1");

			exit();
			}
			else
			{
				mysqli_stmt_bind_param($stmt, "s", $useremail);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0)
				{
					header("Location: ../signup.php?error=usernametaken");
					exit();
				}

				//ADDING the new user and HASHING the password for security
				else
				{
					$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql))
					{
						header("Location: ../signup.php?error=sqlerror2");
					exit();
					}
					//Password is hashed for security and the account is made
					else
					{
						$hashedpassword = password_hash($userpassword, PASSWORD_DEFAULT);

						mysqli_stmt_bind_param($stmt, "ss", $useremail, $hashedpassword);
						mysqli_stmt_execute($stmt);
						
						header("Location: ../login.php?signup=success");
						exit();
					}
				}
			}
		}
	//Closing mysqli connection to save resources
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}


//Stop users gaining acess without clicking the button
else
{
	header("Location: ../signup.php");
	exit();
}
