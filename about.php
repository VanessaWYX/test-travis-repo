<!DOCTYPE html>
<html lang="en">
<head>
<meta charset= "utf-8" />
<meta name="author"	content="Brahamjot Singh" />

<!-- stylesheet -->
<link href= "css/style.css" rel="stylesheet" />

<title>About Page</title>
</head>
<body>
<!-- navigation menu -->
<nav>
	<a class = "btn" href = "index.php">Home Page</a> 
	<a class = "btn" href = "signup.php">Sign Up Page</a>
	<a class = "btn" href = "login.php">Login Page</a>  
	<!-- <a class = "btn" id = "about" href = "about.php">About Page</a> -->
</nav>

<header>About this assignment </header>

<br /><br /><br /><br />
<!--Answers to the questions in a bullet point list.-->
Answers:
<ul><li>What tasks you have not attempted or not completed?
		<ul>
		<li>Extra challenge part is not attempted.
		<li>Validation not done.
		<li>Code not commented.
		<li>Code not indented.
		<li>Video not made.		
		</ul><br />
	<li>What special features have you done, or attempted, in creating the site that we should know about?
		<ul>
		<li>"Add" and "unfriend" buttons redirect to different pages for processing respective data.
		<li>All the pages contain the Current date and time in the footer.
		</ul><br />
	<li>Which parts did you have trouble with?<br />
	<ul>
		<li>Linking "Unfriend" and "Add" button to different people.
		<li>Displaying the profile names of people who are not the user's friends in friendlist page.
		</ul><br />
	<li>What would you like to do better next time?
	<ul>
		<li>I would like to enhance the styling of the website and I knew how to do the extra challenge parts but due to some extra burden of other units, I could not take out the time to finish the extra challenge. I would like to finish it next time.
		</ul><br />
	<li>Screenshot of a discussion response that answered someone’s thread in the unit’s
discussion board for Assignment 2:
<img class = "img" src = "images/ss.PNG" alt="discussion screen shot">
</ul>

<footer>
<?php
echo "Date:" . date("Y-m-d h:i:sa") . "<br />";
?>
</footer>

</body>
</html>