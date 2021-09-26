<!DOCTYPE html>
<html lang="en">
<head>
<meta charset= "utf-8" />
<meta name="author"	content="Brahamjot Singh" />

<!-- stylesheet -->
<link href= "css/style.css" rel="stylesheet" />

<title>Home Page</title>
</head>
<body>

<!-- navigation menu -->
<nav>
	<!-- <a class = "btn" href = "index.php">Home Page</a> &nbsp; -->
	<a class = "btn" href = "signup.php">Sign Up Page</a> &nbsp;
	<a class = "btn" href = "login.php">Login Page</a> &nbsp;
</nav>

<header>
	<p>My Friend System<br />
	Assignment Home Page
	</p>
</header>

<p>
	Originally created by: <br />
	Name: Brahamjot Singh <br />
	Student ID: 102613921 <br />
	Email: <a href="mailto:102613921@student.swin.edu.au">102613921@student.swin.edu.au</a>
</p>

<p>
	Modified by for the purpose for Deployment Project: <br />
	Name: Vanessa Wong <br />
	Student ID: 101951824 <br />
	Email: <a href="mailto:101951824@student.swin.edu.au">101951824@student.swin.edu.au</a>
</p>

<?php

$serverName = "tcp:dev-ops-server.database.windows.net,1433";

$username = "myphp";
$password = "Mypassword!";
$database = "dev-ops-server";

$connectionInfo = array("Database" => $database, "UID" => $username, "PWD" => $password);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
	echo "Connection established.<br />";
}
else {
	echo "Connection could not be established.<br />";
	die(print_r(sqlsrv_errors(), true));
}

sqlsrv_close($conn);

//footer
echo "<footer>";
echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
echo "</footer>";
?>

</body>
</html>
