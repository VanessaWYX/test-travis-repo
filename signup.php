<!DOCTYPE html>
<html lang="en">
<head>
<meta charset= "utf-8" />
<meta name="author"	content="Brahamjot Singh" />

<!-- stylesheet -->
<link href= "css/style.css" rel="stylesheet" />

<title>Sign Up Page</title>
</head>
<body>

<!-- navigation menu -->
<nav>
	<a class = "btn" href = "index.php">Home Page</a> &nbsp;
	<!-- <a class = "btn" href = "signup.php">Sign Up Page</a> &nbsp; -->
	<a class = "btn" href = "login.php">Login Page</a> &nbsp;
</nav>

<header>
	<p>My Friend System<br />
	Registration Page
	</p>
</header>

<form action = "signup.php" method = "post" >

&nbsp;&nbsp;Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="email" value="<?php if (isset($_POST["email"])) {
	echo $_POST["email"];
}?>"> <br />

&nbsp;&nbsp;Profile Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="profile" value="<?php if (isset($_POST["profile"])) {
	echo $_POST["profile"];
}?>"><br />

&nbsp;&nbsp;Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="password" name="password"><br />

&nbsp;&nbsp;Confirm Password:
<input type="password" name="confirm"><br />

<input class = "btn" type="submit" name="submit" value="Register">
<input class = "btn" type="reset" value ="Clear">

</form>
<br /><br />
<?php

$serverName = "tcp:dev-ops-server.database.windows.net,1433";
$username = "myphp";
$password = "Mypassword!";
$database = "dev-ops-server";
$connectionInfo = array("Database" => $database, "UID" => $username, "PWD" => $password);
$connection = sqlsrv_connect($serverName, $connectionInfo);


if ($connection) {

	//patterns for validation
	$email_pattern = "/\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6}/";
	$profile_pattern = "/[A-Za-z]+/";
	$pw_pattern = "/[A-Za-z0-9]+/";

	//initialization of error messages
	$errorMsg = "";

	if (isset($_POST["submit"])) {

		if (isset($_POST["email"]))
			$email = $_POST["email"];
		if (isset($_POST["profile"]))
			$profile = $_POST["profile"];
		if (isset($_POST["password"]))
			$password = $_POST["password"];
		if (isset($_POST["confirm"]))
			$confirm = $_POST["confirm"];

		//check if all the information is provided or not.
		if ((isset($email) && !empty($email)) && (isset($profile) && !empty($profile)) && (isset($password) && !empty($password)) && (isset($confirm) && !empty($confirm))) {

			//email validation
			if (empty($email))
				$errorMsg .= "<p class='error'>Please enter Email ID.</p><br />";

			if (!preg_match($email_pattern, $email))
				$errorMsg .= "<p class='error'>Enter a valid Email ID.</p><br />";

			$emailCheckQuery = "select * from accountData WHERE friend_email = '" . $email . "';";
			$queryResult1 = sqlsrv_query($connection, $emailCheckQuery);
			$row = sqlsrv_has_rows($queryResult1);
			if ($row > 0)
				$errorMsg .= "<p class='error'>Email ID is already registered.</p><br />";

			//profile name validation 
			if (!preg_match($profile_pattern, $profile))
				$errorMsg .= "<p class='error'>Profile must contain only letters and cannot be blank.</p><br />";

			//password validation
			if (!preg_match($pw_pattern, $password))
				$errorMsg .= "<p class='error'>Password must contain only letters and numbers and cannot be blank.</p><br />";
			if ($confirm != $password)
				$errorMsg .= "<p class='error'>Passwords do not match.</p><br />";

			$today = date("Y-m-d");
			//if the input if validated and there are no errors, log the user in and display list of people to add.
			if ($errorMsg == "") {
				// echo "<p class='inform'>Successfully registered.</p><br />";

				//insert the new registration into datatbase.
				$inputQuery = "insert into accountData( friend_email, password, profile_name, date_started, num_of_friends) values
				('$email', '$confirm', '$profile','$today', 0);";
				$queryResult2 = sqlsrv_query($connection, $inputQuery);
				if (!$queryResult2) {
					$errorMsg .= "<p class='error'>Failed to create Account.</p><br />";
				}
				else {
					$idQuery = "select friend_id, friend_email, profile_name, num_of_friends from accountData where friend_email = '" . $email . "';";
					$queryResult3 = sqlsrv_query($connection, $idQuery);
					if (!$queryResult3) {
						$errorMsg .= "<p class='error'>Failed to retrieve Account.</p><br />";

					}
					else {
						// create the session variables
						session_start();
						if (sqlsrv_fetch($queryResult3) === false) {
							die(print_r(sqlsrv_errors(), true));
						}
						$_SESSION["friend_id"] = sqlsrv_get_field($queryResult3, 0);
						$_SESSION["email"] = sqlsrv_get_field($queryResult3, 1);
						$_SESSION["profile"] = sqlsrv_get_field($queryResult3, 2);
						$_SESSION["num_of_friends"] = sqlsrv_get_field($queryResult3, 3);

						header("location:friendadd.php");
					}
				}

				sqlsrv_free_stmt($queryResult3);

			}
		}
		else
			$errorMsg .= "<p class='error'>Please provide all the information.</p><br />";
	}
	sqlsrv_close($connection);
}
else
	die("Connection failed. Reason: " . sqlsrv_errors());

echo $errorMsg . "<br />";


//footer
echo "<footer>";
echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
echo "</footer>";
?>
</body>
</html>