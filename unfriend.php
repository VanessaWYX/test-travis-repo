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
$num_of_friends = $_SESSION["num_of_friends"];

$friend_id = $_SESSION["friend_id"];
$friend2 = $_POST['friendid'];

//delete the record from myfriends table
$unfriendQuery1 = "Delete from myfriends where (myfriends.friend_id1 = '$friend_id' and myfriends.friend_id2 = '$friend2') or (myfriends.friend_id2 = '$friend_id' and myfriends.friend_id1 = '$friend2');";
$unfriendResult1 = sqlsrv_query($connection, $unfriendQuery1);

if (!$unfriendResult1) {
	die(print_r(sqlsrv_errors(), true));
}
else {
	//update number of friends.	
	$unfriendQuery2 = "UPDATE accountData SET num_of_friends=num_of_friends-1 WHERE friend_id = '$friend_id'";
	$unfriendResult2 = sqlsrv_query($connection, $unfriendQuery2);

	if (!$unfriendResult2) {
		die(print_r(sqlsrv_errors(), true));
	}
	else {
		$_SESSION["num_of_friends"] = $num_of_friends - 1;
	}
}

//redirect to friendlist page
header("location:friendlist.php");

?>