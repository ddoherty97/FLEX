<?php
	 /**
     * CreateSpiritualData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a spiritual data to the FLEX application. It will process the form fields on
     * the tracking/spiritualtracking.php page. Note: This is intended to be an action script
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

    //include access to the spiritual data module
    require_once("SpiritualTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create spiritual data module
        $spiritualMod = new SpiritualTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];					//date of spiritual activity
        $name = trim($_POST['title']);			//name of spiritual activity
        $startTime = $_POST['sTime'];			//start time of spiritual activity
		$endTime = $_POST['eTime'];				//end time of spiritual activity
		$location = trim($_POST['location']);	//location of spiritual activity
		$type = trim($_POST['type']);			//type of spiritual activity
		$notes = trim($_POST['notes']);			//notes about spiritual activity
		
		//validate all inputs
		//ensure date is provided 
		if($date == "")
		{
			$isValid = false;
		}//end if
		
		//ensure name is provided 
		if($name == "")
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
		
		//ensure location is provided 
		if($location == "")
		{
			$isValid = false;
		}//end if
		
		//ensure type is provided
		if($type == "")
		{
			$isValid = false;			
		}//end if
		
		//if data is valid, add to database through SpiritualDataModule
		if($isValid)
		{
			$date = date($date);					//convert text date to DateTime object
    		$start = new DateTime($startTime);		//convert text start time to DateTime object
    		$end = new DateTime($endTime);			//convert text end time to DateTime object
			
			$spiritualMod->addSpiritualData($date, $name, $location, $start, $end, $type, $notes);

			//redirect to spiritual tracking page with creation success
            header("Location: ../pages/tracking/spiritualtracking.php?s=s");
            exit();
		}//end if

		//if data is not valid
		else
		{
			//redirect to spiritual tracking page with creation error
			header("Location: ../pages/tracking/spiritualtracking.php?s=f");
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