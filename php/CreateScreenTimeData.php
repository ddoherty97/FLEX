<?php
	 /**
     * CreateScreenTimeData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a screen time data to the FLEX application. It will process the form fields on
     * the tracking/screentimetracking.php page. Note: This is intended to be an action script
     * Author: Jaclyn Cuevas
     * Last Updated: 4/2/18 JC
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

    //include access to the screen time tracking module
    require_once("ScreenTimeTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create screen time data module
        $stMod = new ScreenTimeTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];			//date of screen usage
        $time = trim($_POST['time']);	//time spent on device
		$device = $_POST['device'];		//device used

		
		//validate all inputs
		//ensure date is provided 
		if($date == "")
		{
			$isValid = false;
		}//end if
		
		//ensure time is provided
		if($time == "")
		{
			$isValid = false;			
		}//end if
		
		//ensure device is provided
		if($device == "")
		{
			$isValid = false;			
		}//end if
		
		//if data is valid, add to database through ScreenTimeDataModule
		if($isValid)
		{
			$date = date($date);			//convert text date to DateTime object
    		
			$stMod->addScreenTimeData($date, $time, $device);

			//redirect to screen time tracking page with creation success
            header("Location: ../pages/tracking/screentimetracking.php?s=s");
            exit();
		}//end if

		//if data is not valid
		else
		{
			//redirect to screen time tracking page with creation error
			header("Location: ../pages/tracking/screentimetracking.php?s=f");
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