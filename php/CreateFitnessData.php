<?php
	 /**
     * CreateFitnessData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a fitness data to the FLEX application. It will process the form fields on
     * the tracking/fitnesstracking.php page. Note: This is intended to be an action script
     * Author: Jaclyn Cuevas
     * Last Updated: 3/27/18 JC
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

    //include access to the fitness goal module
    require_once("FitnessTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create fitness data module
        $fitMod = new FitnessTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];				//date of fitness activity
        $startTime = $_POST['sTime'];		//start time of fitness activity
		$endTime = $_POST['eTime'];			//end time of fitness activity
		$type = $_POST['type'];				//type of fitness activity
		$notes = $_POST['textarea'];		//notes about fitness activity
		
		
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
		
		//if data is valid, add to database through FitnessDataModule
		if($isValid)
		{
			$fitMod->addFitnessData($date, $startTime, $endTime, $type, $notes);
		}//end if
		
    }//end if
    
    //if no form submitted
    else
    {
        //redirect to home page
        header("Location: ../pages/home.php");
        exit();
    }//end else




?>