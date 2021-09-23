<!DOCTYPE html>
<html lang="en">
<head>
<meta charset= "utf-8" />
<meta name="author"	content="Brahamjot Singh" />

<!-- stylesheet -->
<link href= "css/style.css" rel="stylesheet" />

<title>My Friend List page</title>
</head>
<body>

<!-- navigation menu -->
<nav>
	<a class = "btn" href = "index.php">Home Page</a> &nbsp;
	<!-- <a class = "btn" href = "signup.php">Sign Up Page</a> &nbsp;
	<a class = "btn" href = "login.php">Login Page</a> &nbsp; -->
	<a class = "btn" id = "about" href = "about.php">About Page</a>
</nav>

<?php

$serverName = "tcp:dev-ops-server.database.windows.net,1433";
$username = "myphp";
$password = "Mypassword!";
$database = "dev-ops-server";
$connectionInfo = array("Database" => $database, "UID" => $username, "PWD" => $password);
$connection = sqlsrv_connect($serverName, $connectionInfo);
if (!$connection) {
	echo "The database is not available.";
}

echo "<header>";
echo "<p>My Friend System<br />";

session_start();
//declare session variables.
$friend_id = $_SESSION["friend_id"];
$profile = $_SESSION["profile"];
$numOfFriends = $_SESSION["num_of_friends"];
echo "$profile's Friend List Page<br />";
echo "Total number of friends is $numOfFriends";
echo "</p>";
echo "</header>";

//display the friends of the user.
$friendsQuery = "SELECT distinct profile_name, friend_id from accountData, myfriends where  accountData.friend_id=myfriends.friend_id2  and myfriends.friend_id1 = '$friend_id';";
$queryResult1 = sqlsrv_query($connection, $friendsQuery, array(), array("Scrollable" => "keyset"));
if (!$queryResult1) {
	die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_fetch($queryResult1) === false) {
	die(print_r(sqlsrv_errors(), true));
}

echo "<table class = 'border'>";
echo "<tr>
	<th>Profile Name</th>
	<th class = 'width'>Unfriend</th>
	</tr>";

for ($i = 0; $i < sqlsrv_num_rows($queryResult1); $i++) {
	$row = sqlsrv_fetch_array($queryResult1, SQLSRV_FETCH_NUMERIC, SQLSRV_SCROLL_ABSOLUTE, $i);

	echo "<tr>";
	echo "<td>{$row[0]}</td>";
	echo "<td>
			<form style='width: 200px;' method='POST' action='unfriend.php'>
				<input type='hidden' name='friendid' value='" . $row[1] . "'>
				<input type='submit' value='Unfriend'>
			</form>
		</td>";
	echo "</tr>";
}


sqlsrv_free_stmt($queryResult1);
echo "</table>";

echo "<a class = 'btn' href = 'friendadd.php'>Add Friends</a>";
echo "<a class = 'btn' href = 'logout.php'>Log Out</a>";

sqlsrv_close($conn);


//footer
echo "<footer>";
echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
echo "</footer>";
?>
</body>
</html>