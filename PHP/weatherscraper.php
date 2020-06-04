<?php

session_start();

	$alert= "1";
	$weather="1";


if(isset($_POST['check'])){
	
	if($_POST['city']==""){
		$alert = "<p>Please enter a city to know it's weather.</p>";
		
	}else{
		$url= file_get_contents( "http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_POST['city'])."&appid=90e9a6d11c21be16f216f287bc48a82f");
		
		$weatherarray = json_decode($url,true);
		
		 
        if ($weatherarray['cod'] == 200) {
        
            $weather = "The weather in ".$_POST['city']." is currently '".$weatherarray['weather'][0]['description']."'. ";

            $tempInCelcius = intval(($weatherarray['main']['temp_min']) - 273);

            $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherarray['wind']['speed']."m/s.";
            
        } else {
            
            $alert = "Could not find city - please try again.";
            
        }
	}
	
}




?>


<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  
	  <script src="jQsrc.js" type="text/javascript"></script>

		<title>Weatherforecast</title>
	  
	  <style>
			body{
				
				margin: 0;
				padding: 0;
				
				
			}
		
			#main{
				
				background-image: url(https://images.pexels.com/photos/989941/pexels-photo-989941.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
				width: 100%;
				height: 100%;
				
			}
		  .jumbotron{
			  background-color: transparent;
			  padding-top: 150px;
			  
			  
		  }
		  #city{
			  width: 350px;
			  margin-left: auto;
			  margin-right: auto;
			  
		  }
		  .alert{
			  display: none;
			  width: 500px;
			  margin-left: auto;
			  margin-right: auto;
		  }
		  
		 
		
		</style>
	

  </head>
  <body>
    	<div id="main">
		
			<div class="jumbotron jumbotron-fluid text-center">
			  <div class="container">
				<h1 class="display-4">What's The Weather?</h1>
				<p class="lead" style="font-weight:400;">Enter the city.</p>
				  <form method="post">
		  <div class="form-group">

			<input type="text" class="form-control" id="city" name="city" aria-describedby="emailHelp" placeholder="Enter city">

		  </div>

	  <button type="submit" name="check" class="btn btn-primary">Check</button>
	</form>

		<div class="alert alert-danger" role="alert" id="alerts">
				  <?php   echo $alert;                 ?>
				</div>
				<div class="alert alert-info" role="alert" id="weather">
					<?php    echo $weather;                  ?>
				</div>
				  
				  
				  
				</div>
			</div>
		
		
		</div>
	
    
	
	  
	  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	  
	  <script type="text/javascript">
	  
	  var alerts = "<?php    echo $alert;              ?>";
	  var weather = "<?php echo $weather;        ?>";
		  
		  if(alerts == "1"){
			   $('#alerts').css("display","none");
			 
		  }else{
			  $('#alerts').css("display","block");
		  }
		  
		    if(weather == "1"){
				
				 $('#weather').css("display","none");
			 
		  }else{
			  $('#weather').css("display","block");
		  }
		  
	  
	  </script>
	  
	  
	  
  </body>
</html>