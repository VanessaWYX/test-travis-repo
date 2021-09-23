<!DOCTYPE html>
<html lang="en">
<head>
<meta charset= "utf-8" />
<meta name="author"	content="Brahamjot Singh" />

<!-- stylesheet -->
<link href= "css/style.css" rel="stylesheet" />

<title>Log In Page</title>
</head>
<body>

<!-- navigation menu -->
<nav>
	<a class = "btn" href = "index.php">Home Page</a> &nbsp;
	<a class = "btn" href = "signup.php">Sign Up Page</a> &nbsp;
	<!-- <a class = "btn" href = "login.php">Login Page</a> &nbsp; -->
	<a class = "btn" id = "about" href = "about.php">About Page</a>
</nav>

<header>
	<p>My Friend System<br />
	Log In Page
	</p>
</header>

<form action = "login.php" method = "post" >

&nbsp;&nbsp;Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="email" value="<?php if (isset($_POST["email"])) {
	echo $_POST["email"];
}?>"> <br />

&nbsp;&nbsp;Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="password" name="password"><br />

<input class = "btn" type="submit" name="submit" value="Log In">
<input class = "btn" type="reset" value ="Clear">

</form>

<?php


//initialization of error messages
$errorMsg = "";


if (isset($_POST["submit"])) {

	$serverName = "tcp:dev-ops-server.database.windows.net,1433";
	$username = "myphp";
	$password = "Mypassword!";
	$database = "dev-ops-server";
	$connectionInfo = array("Database" => $database, "UID" => $username, "PWD" => $password);
	$connection = sqlsrv_connect($serverName, $connectionInfo);

	if ($connection) {
		if (empty($_POST["email"]))
			$errorMsg .= "Please enter Email ID.<br /><br />";
		if (empty($_POST["password"]))
			$errorMsg .= "Please enter Password.<br /><br />";
		else {
			$email = $_POST["email"];
			$password = $_POST["password"];

			//check if input details match any record in the database.
			$emailCheckQuery = "select * from accountData WHERE friend_email = '" . $email . "'" . "and password = '" . $password . "';";
			$queryResult1 = sqlsrv_query($connection, $emailCheckQuery);
			if (!$queryResult1) {
				die(print_r(sqlsrv_errors(), true));
			}
			// $row = sqlsrv_fetch_array($queryResult1);

			if (sqlsrv_fetch($queryResult1) === false) {
				die(print_r(sqlsrv_errors(), true));
			}

			session_start();
			$_SESSION["email"] = $email;
			$_SESSION["friend_id"] = sqlsrv_get_field($queryResult1, 0);
			$_SESSION["email"] = sqlsrv_get_field($queryResult1, 1);
			$_SESSION["profile"] = sqlsrv_get_field($queryResult1, 3);
			$_SESSION["num_of_friends"] = sqlsrv_get_field($queryResult1, 5);

			sqlsrv_free_stmt($queryIdResult1);
			header("location:friendlist.php"); //redirects to friendlist page.	

		}
		sqlsrv_close($connection);
	}
	else
		die("Connection failed. Reason: " . $connection);

	echo $errorMsg;
}


//footer
echo "<footer>";
echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
echo "</footer>";
?> 
</body>
</html>