<?php
	$servername = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "kingstonrun";

	// Create connection
	$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
	// Check connection for errors
	if (!$conn) 
	{
	    die("Connection failed: ".mysqli_connect_error());
	}