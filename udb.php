<?php
	
    session_start();

	$link = mysqli_connect("shareddb-t.hosting.stackcp.net","myBook-313331caf6","eqhnvq83hv","myBook-313331caf6");

if(mysqli_connect_error()){
		$alert = die("<p>There was a problem connecting to your database.</p>");
		
	}




$query = "UPDATE `users` SET `text` = '".mysqli_real_escape_string($link, $_POST['mystory'])."' WHERE id =".mysqli_real_escape_string($link,$_SESSION['id'])." LIMIT 1";

mysqli_query($link,$query);




?>