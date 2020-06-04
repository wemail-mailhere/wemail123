<?php
	
session_start();
	$link = mysqli_connect("shareddb-t.hosting.stackcp.net","myBook-313331caf6","eqhnvq83hv","myBook-313331caf6");

if(mysqli_connect_error()){
		$alert = die("<p>There was a problem connecting to your database.</p>");
		
	}


 if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }

    if (array_key_exists("id", $_SESSION)) {
              
      
      
      $query = "SELECT text FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
 
      $mystory = $row['text'];
      
    } else {
        
        header("Location: challange.php");
        
    }


?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>MyStory</title>
	  
	  <style type="text/css">
	  
	  	#content {
		  background: url(https://images.pexels.com/photos/268415/pexels-photo-268415.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940) no-repeat center center fixed;
		  background-size: cover;
		  height: 90.9%;

		  overflow: hidden;
		}

		  #textarea{
			  width: 97%;
			  margin-left: auto;
			  margin-right: auto;
			  margin-top: 20px;
			  background-color: aliceblue;
			  height: 94%;
			  border: none;
			  resize: none;
			  
		  }
		 
		  .navbar{
			  
			  height: 60px;
			 
		  }
		  
		  .navbar-brand{
			  
			  margin-bottom: 10px;
			  
		  }
		  
		  #logout{
			  	margin-bottom: auto;
			  	margin-top: auto;
		  }
	  
	  </style>
	  
  </head>
  <body>
   
	  
	  		<nav class="navbar navbar-light bg-light">
			  <a class="navbar-brand" style="font-size:30px;font-weight:350;" >MyStory</a>
			  <form class="form-inline" >
				
				<button class="btn btn-outline-success my-2 " type="submit" name="Logout"  id="logout"><a href="challange.php?logout=1">Logout</a></button>
			  </form>
			</nav>
	  
	  		<div id="content">
	  
				<form method="post">
	  			<textarea class="longInput form-control container-fluid" cols="30" rows="10" id="textarea" name="textarea"><?php echo $mystory; ?></textarea>
				</form>
	  	  </div>
	  
	  
	
	  
	  
	  
	  
	  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	  
	    <script type="text/javascript">
	    
	  
	  	    $('#textarea').bind('input propertychange', function() {

				
              $.ajax({
				  method: "POST",
				  url: "udb.php",
				  data: {mystory: $("#textarea").val() }
				})
				  
				
			});
	  
	  </script>
	  
	 
	  
	  
  </body>
</html>




