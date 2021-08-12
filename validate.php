<?php 

	class Validate
	{
		//Validate key value 
	    function valid()
	    {
	         if (empty($_POST["fname"])) {  
	        	$error = "Please provide fname";  
	        }

	        if (empty($_POST["lname"])) {  
	         	$error= "Please provide lname";  
	        }
	        
	        if (empty($_POST["email"])) {  
	        	$error = "Please provide email";  
	        }

	        if (empty($_POST["password"])) {  
	        	$error = "Please provide password";  
	        }

	        if (empty($_POST["location"])) {  
	        	$error = "Please provide location";  
	        }

			if (empty($_POST["location_latitude"])) {  
	        	$error = "Please provide location_latitude";  
	        }

	        if (empty($_POST["location_longitude"])) {  
	        	$error = "Please provide location_longitude";  
	        }

	        if (empty($_POST["auth_token"])) {  
	        	$error = "Please provide auth_token";  
	        }

	        
	        if(isset($error))
	        {
	            die($error);
	        }
	        return true;
	    }

	    //Validate key value 
	    function locationValidation()
	    {
	        
	        if (empty($_POST["auth_token"])) {  
	        	$error = "Please provide auth_token"; 
	        } 
	       
	        if (empty($_POST["longitude"])) {  
	        	$error = "Please provide location_longitude";  
	        }

	        if (empty($_POST["latitude"])) {  
	        	$error = "Please provide location_latitude";  
	        }

			 

	        if(isset($error))
	        {
	            die($error);
	        }
	        return true;
	    }
	}


?>