<!DOCTYPE html>
<html lang="en">
<head>
<meta charset= "utf-8" />
<meta name="author"	content="Brahamjot Singh" />

<!-- stylesheet -->
<link href= "css/style.css" rel="stylesheet" />

<title>Add Friend page</title>
</head>
<body>

<!-- navigation menu -->
<nav>
	<a class = "btn" href = "index.php">Home Page</a> 
	<!-- <a class = "btn" href = "signup.php">Sign Up Page</a>  -->
	<!-- <a class = "btn" href = "login.php">Login Page</a>  -->
	<a class = "btn" id = "about" href = "about.php">About Page</a>
</nav>


<?php

echo "<header>";
echo "<p>My Friend System<br />";

session_start();
//declare session variables.
$profile = $_SESSION["profile"];
$friend_id = $_SESSION["friend_id"];
$num_of_friends = $_SESSION["num_of_friends"];

echo "$profile's Friend List Page<br />";
echo "Total number of friends is $num_of_friends";
echo "</p>";
echo "</header>";

$serverName = "tcp:dev-ops-server.database.windows.net,1433";

$username = "myphp";
$password = "Mypassword!";
$database = "dev-ops-server";
$connectionInfo = array("Database" => $database, "UID" => $username, "PWD" => $password);
$connection = sqlsrv_connect($serverName, $connectionInfo);
if (!$connection) {
	echo "The database is not available.";
}

//get the friends of the user.
$friendsQuery = "SELECT distinct friend_id, profile_name 
from accountData, myfriends 
where accountData.friend_id = myfriends.friend_id2 and myfriends.friend_id1 = '$friend_id' order by profile_name;";

$queryResult = sqlsrv_query($connection, $friendsQuery, array(), array("Scrollable" => "keyset"));

if (!$queryResult) {
	die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_fetch($queryResult) === false) {
	die(print_r(sqlsrv_errors(), true));
}

$rowcount = sqlsrv_has_rows($queryResult); // return boolean 

if ($queryResult) {
	$peopleArray = array();

	//store the user's friends' friend_id in an array.
	for ($i = 0; $i < sqlsrv_num_rows($queryResult); $i++) {
		$idColumn = sqlsrv_fetch_array($queryResult, SQLSRV_FETCH_NUMERIC, SQLSRV_SCROLL_ABSOLUTE, $i);
		array_push($peopleArray, $idColumn[0]);
	}

	//If the user has 0 friends.
	if ($rowcount == false) {
		echo "</table>";

		$allQuery = "SELECT distinct profile_name, friend_id 
		             from accountData 
		             where friend_id <> '$friend_id' order by profile_name;";

		$allResult = sqlsrv_query($connection, $allQuery, array(), array("Scrollable" => "keyset"));

		if (!$allResult) {
			die(print_r(sqlsrv_errors(), true));
		}

		if (sqlsrv_fetch($allResult) === false) {
			die(print_r(sqlsrv_errors(), true));
		}

		if ($allResult) {
			echo "<table class = 'border'>";
			echo "<tr>
				<th>Profile Name</th>
				<th class = 'width'>Add Friends</th>
			</tr>";
			

			for ($i = 0; $i < sqlsrv_num_rows($allResult); $i++) {
				$allRow = sqlsrv_fetch_array($allResult, SQLSRV_FETCH_NUMERIC, SQLSRV_SCROLL_ABSOLUTE, $i);
				echo "<tr>";
				echo "<td>{$allRow[0]}</td>";
				echo "<td>
					<form style='width: 200px;' method='POST' action='add.php'>
						<input type='hidden' name='friendid' value='" . $allRow[1] . "'>
						<input type='submit' value='Add as friend'>
					</form></td>";
				echo "</tr>";
			}
			echo "</table>";
			sqlsrv_free_stmt($allResult);
		}
	}
	else {
		$friendVariable = "'" . implode("','", $peopleArray) . "'";
		// foreach($peopleArray as $i){
		//use the friendVariable to display users who are not the friends of the logged-in user.
		$notFriendsQuery = "select distinct f.profile_name, f.friend_id from accountData f, myfriends m 
			where f.friend_id <>'$friend_id' and f.friend_id not in($friendVariable) order by f.profile_name;";

		// }
		$queryResult1 = sqlsrv_query($connection, $notFriendsQuery, array(), array("Scrollable" => "keyset"));
		if ($queryResult1) {

			echo "<table class = 'border'>";
			echo "<tr>
				<th>Profile Name</th>
				<th class = 'width'>Add Friends</th>
			</tr>";

			for ($i = 0; $i < sqlsrv_num_rows($queryResult1); $i++) {
				$row = sqlsrv_fetch_array($queryResult1, SQLSRV_FETCH_NUMERIC, SQLSRV_SCROLL_ABSOLUTE, $i);

				echo "<tr>";
				echo "<td>{$row[0]}</td>";
				//send friend_id of the person who is to be added as a friend to add.php
				echo "<td>
					<form style='width: 200px;' method='POST' action='add.php'>
						<input type='hidden' name='friendid' value='" . $row[1] . "'>
						<input type='submit' value='Add as friend'>
					</form>
				</td>";
				echo "</tr>";
			}

			echo "</table>";
			sqlsrv_free_stmt($queryResult1);
		}
		else {
			die(print_r(sqlsrv_errors(), true));
		}
	}
}

sqlsrv_close($connection);

echo "<a class = 'btn' href = 'friendlist.php'>Friend List</a>";
echo "<a class = 'btn' href = 'logout.php'>Log Out</a>";


//footer
echo "<footer>";
echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
echo "</footer>";
?>
</body>
</html>