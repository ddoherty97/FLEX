<?php
	 /**
     * CreateFitnessData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a fitness data to the FLEX application. It will process the form fields on
     * the tracking/fitnesstracking.php page. Note: This is intended to be an action script
     * Author: Jaclyn Cuevas
     * Last Updated: 3/28/18 DD
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

    //include access to the fitness data module
    require_once("FitnessTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create fitness data module
        $fitMod = new FitnessTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];					//date of fitness activity
        $startTime = $_POST['sTime'];			//start time of fitness activity
		$endTime = $_POST['eTime'];				//end time of fitness activity
		$type = trim($_POST['type']);			//type of fitness activity
		$milestone = trim($_POST['milestone']);	//fitness activity milestone
		$notes = trim($_POST['notes']);			//notes about fitness activity
		
		//validate all inputs
		//ensure date is provided 
		if($date == "")
		{
			$isValid = false;
		}//end if
		
		//ensure start time is provided
		if($startTime == "")
		{
			$isValid = false;			
		}//end if
		
		//ensure end time is provided
		if($endTime == "")
		{
			$isValid = false;			
		}//end if
		
		//ensure type is provided
		if($type == "")
		{
			$isValid = false;			
		}//end if
		
		//ensure milestone is provided
		if($milestone == "")
		{
			$isValid = false;			
		}//end if
		
		//if data is valid, add to database through FitnessDataModule
		if($isValid)
		{
			$date = date($date);					//convert text date to DateTime object
    		$start = new DateTime($startTime);		//convert text start time to DateTime object
    		$end = new DateTime($endTime);			//convert text end time to DateTime object
			
			$fitMod->addFitnessData($date, $start, $end, $type, $milestone, $notes);

			//redirect to fitness tracking page with creation success
            header("Location: ../pages/tracking/fitnesstracking.php?s=s");
            exit();
		}//end if

		//if data is not valid
		else
		{
			//redirect to fitness tracking page with creation error
			header("Location: ../pages/tracking/fitnesstracking.php?s=f");
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