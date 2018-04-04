<?php
	 /**
     * CreateDietaryData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a dietary data to the FLEX application. It will process the form fields on
     * the tracking/dietarytracking.php page. Note: This is intended to be an action script
     * Author: Jaclyn Cuevas
     * Last Updated: 4/3/18 DD
     **/

	//check if session is already running
	if(!isset($_SESSION)) 
    { 
        session_start();
    }//end if
	
	//if no session is active, redirect to login page
    $phpFolderPath = "";
    $logoutFile = $phpFolderPath."logout.php";
    require($phpFolderPath."IsLoggedIn.php");

    //include access to the dietary goal module
    require_once("DietaryTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create dietary data module
        $dietMod = new DietaryTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];						//date of consumption
        $time = $_POST['time'];						//time of consumption
		$typeOfFood = trim($_POST['type']);			//type of food consumed
		$calories = trim($_POST['calories']);		//number of calories consumed
		$ounces = trim($_POST['ounces']);			//number of ounces of water consumed
		
		//validate all inputs
		//ensure date is provided 
		if($date == "")
		{
			$isValid = false;
		}//end if
		
		//if data is valid, add to database through DietaryDataModule
		if($isValid)
		{
			
			$dietDate = date($date);				//convert text date to DateTime object
    		$dietTime = new DateTime($time);		//convert text time to DateTime object
			
			//if no calories provided
			if(is_null($calories) || $calories=="")
			{
				$calories = 0;
			}//end if

			//if no water provided
			if(is_null($ounces) || $ounces=="")
			{
				$ounces = 0;
			}//end if
			
			//add to database
			$dietMod->addDietaryData($dietDate, $typeOfFood, $calories, $ounces);

			//redirect to dietary tracking page with creation success
            header("Location: ../pages/tracking/dietarytracking.php?s=s");
            exit();
		}//end if

		//if data is not valid
		else
		{
			//redirect to dietary tracking page with creation error
			header("Location: ../pages/tracking/dietarytracking.php?s=f");
			exit();
		}//end else
    }//end if
    
    //if no form submitted
    else
    {
        //redirect to home page
        header("Location: ../pages/home.php");
        exit();
    }//end else
?>