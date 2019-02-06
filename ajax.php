<?php
/*
	Author: Jacob Pell
	Date: 02/03/2019
	Description: This page will serve as the ajax request page for the site
	It will process all of the AJAX requests that are needed for the site 
	to be able to validate and function properly.
*/

$dbName = "projectJP";

require("connecti2db.inc.php");

if(!empty($_GET['uname']))
{
	$uname = $_GET['uname'];
	$uname = mysqli_real_escape_string($connection, stripslashes($uname));

	$query = "SELECT username
			  FROM registration
			  WHERE username = '$uname'";
	$result = mysqli_query($connection,$query) or
	die("<b>Query Failed</b><br />$query<br />".mysqli_error($connection));

	$count = mysqli_num_rows($result);
	if($count != 0)
	{
		echo "Sorry! That username has already been taken, please select another.";
	}
	else
	{
		echo "Yes! That username is available!";
	}
}

?>