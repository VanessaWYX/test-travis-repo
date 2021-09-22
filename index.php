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
<!-- <nav>
	<a class = "btn" href = "index.php">Home Page</a> &nbsp;
	<a class = "btn" href = "signup.php">Sign Up Page</a> &nbsp;
	<a class = "btn" href = "login.php">Login Page</a> &nbsp;
	<a class = "btn" id = "about" href = "about.php">About Page</a>
</nav> -->

<header>
	<p>My Friend System<br />
	Assignment Home Page
	</p>
</header>

<p>
	Name: Brahamjot Singh <br />
	Student ID: 102613921 <br />
	Email: <a href="mailto:102613921@student.swin.edu.au">102613921@student.swin.edu.au</a>
</p>

<p>
	I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student’s work or from any other source.
</p>

<?php

//footer
echo "<footer>";
	echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
echo "</footer>";
?>
</body>
</html>