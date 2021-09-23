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

session_start();
//declare session variables.
$friend_id = $_SESSION["friend_id"];
$friend2 = $_POST['friendid'];
$num_of_friends = $_SESSION["num_of_friends"];


//add the new friend connection to the database.
$addQuery1 = "Insert into myfriends(friend_id1, friend_id2) values('$friend_id', '$friend2');";
$addResult1 = sqlsrv_query($connection, $addQuery1);

if ($addResult1) { //update number of friends.	
	$addQuery1 = "UPDATE accountData SET num_of_friends=num_of_friends+1 WHERE friend_id = '$friend_id'";
	$addResult1 = sqlsrv_query($connection, $addQuery1);
	if ($addResult1) {
		$_SESSION["num_of_friends"] = $num_of_friends + 1;
	}
	else {
		echo "Rquest failed.";
	}
}
else {
	echo "Rquest failed.";
}

//redirect to friendadd page.
header("location:friendadd.php");

?>