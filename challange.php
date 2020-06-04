<?php
		 session_start();

    $alert = "1";    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
		session_destroy();
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: index.php");
        
    }

	 if (array_key_exists('submit', $_POST)) {
		
		 
	$link = mysqli_connect("shareddb-t.hosting.stackcp.net","myBook-313331caf6","eqhnvq83hv","myBook-313331caf6");

		 
	mysqli_connect_error();
		 

	if(mysqli_connect_error()){
		$alert = "<p>There was a problem connecting to your database.</p>";
		
	}

	if($_POST['email']=='' || $_POST['password']==''){

		$alert= "<p>enter your your details</p>";

	} else if($_POST['signUp'] == 1){
            
            $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0) {
                
                $alert = "<p>That email address has already been taken.</p>";
                
            } else {
                
				$protected = password_hash($_POST['password'],PASSWORD_DEFAULT);
				
				
                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $protected)."')";
                
                if (mysqli_query($link, $query)) {
					 $_SESSION['id'] = mysqli_insert_id($link);
					
                  if($_POST['stayloggedin'] == '1'){
					 
					  setcookie("id",mysqli_insert_id($link),time()+60*60*24*365);
					  
				  }  
					
					header('Location: index.php');
                  
                } else {
                    
                    $alert = "<p>There was a problem signing you up - please try again later.</p>";
                    
                }
                
            }
            
        }else {
		
		 $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0) {
				
       			$query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";
				
				$result = mysqli_query($link,$query);
				
				$row = mysqli_fetch_array($result);
				
                if(password_verify($_POST['password'],$row['password'])){
					
					 $_SESSION['id'] = $row['id'];
					
                  if($_POST['stayloggedin'] == '1'){
					 
					  setcookie("id",$row['id'],time()+60*60*24*365);
					  
				  }  
					
					header("Location: index.php");
				}else{
					$alert = "Incorrect password. Please try again.";
				
				}
                
            }else{
				
				$alert = "<p>You are not registered yet. Please sign up first.</p>";
				
			}
		
	}



	}




?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  
	  <script src="jQsrc.js" ></script>

    <title>MyBook</title>
	  
	  <style type="text/css">
		
		#main {
		  background: url(https://images.pexels.com/photos/268415/pexels-photo-268415.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940) no-repeat center center fixed;
		  background-size: cover;
		  height: 100%;

		  overflow: hidden;
		}

		  .jumbotron{
			  background-color: transparent;
			  padding-top: 100px;
			  margin-left: auto;
			  margin-right: auto;
			  
		  }
		  
		  .form-group{
			  
			  width: 340px;
			  margin-left: auto;
			  margin-right: auto;
			 
			  
			  
		  }

		  .alert{
			  width: 400px;
			  display: none;
			  margin-left: auto;
			  margin-right: auto;
			  
		  }
		  
		  
		  #loginForm{
			  display: none;
			  
		  }
		  
		  
		</style>
	  
	  
	  
  </head>
  <body>
    

	  <div id="main">
		  
		  
	  
			<div class="jumbotron text-center text-white">
				
				
				<div class="alert alert-warning alert-dismissible fade show" role="alert"  >
  			<?php    
			 echo $alert;
			  ?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			  <h1 class="display-4" style="font-weight:600;">Secret Diary</h1>
			  <h4 class="lead" style="font-weight:600;">Store your thoughts permanently and securely</h4>
			 
			  
			  
				<form method="post" id="signupForm">
					<p>Interested? Sign up now.</p>
					
				  <div class="form-group">
					
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  </div>
				  <div class="form-group">
					
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				  </div>
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" id="stayloggedin" name="stayloggedin">
					<label class="form-check-label" for="exampleCheck1">Stay logged in</label>
				  </div><br>
					<input type="hidden" name="signUp" value="1">
				  <button type="submit" name="submit" class="btn btn-primary">Sign up</button><br><br>
					<p> <a  id="loginbutton" style="color:black;font-weight:bold;">Login</a></p>
					
					
				</form>
				
				
				
	  <form method="post" id="loginForm">
				  <div class="form-group">
					<p>Log in using your username and password.</p>
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  </div>
				  <div class="form-group">
					
					<input type="password" name="password" class="form-control" id="password" placeholder="Password">
				  </div>
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" id="stayloggedin" name="stayloggedin">
					<label class="form-check-label" for="exampleCheck1">Stay logged in</label>
				  </div><br>
					<input type="hidden" name="signUp" value="0">
					
				  <button type="submit" name="submit" class="btn btn-primary">Login</button><br><br>
		  <p> <a  id="signupbutton" style="color:black;font-weight:bold;">Sign up</a></p>
					
					
					
				</form>
	  
				
				
			</div>
	  
	  
	  </div>
	  
	 
	  
	  
	 
	  
	  
	  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	  
	   <script type="text/javascript">
	  
	  
		  
		   
		   
		  $("#loginbutton").click(function(){
			  
			  $("#signupForm").toggle();
			  $("#loginForm").toggle();
			 
			  
		  })
		  
		   $("#signupbutton").click(function(){
			  
			  $("#loginForm").toggle();
			  $("#signupForm").toggle();
			  
		  })
		   
		  var error = "<?php     echo $alert;              ?>" ;
		  
		  if(error != '1'){
			  
			  $(".alert").toggle();
		  }
			
		  
		   
		   
	  
	  
	  </script>
	  
  </body>
</html>
		
		
		
		
	

