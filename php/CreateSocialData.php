<?php
	 /**
     * CreateSocialData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a social activity data to the FLEX application. It will process the form fields on
     * the tracking/socialtracking.php page. Note: This is intended to be an action script
     * Author: Jaclyn Cuevas
     * Last Updated: 4/4/18 JC
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

    //include access to the social activity module
    require_once("SocialTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create social data module
        $socialMod = new SocialTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];					//date of social activity
        $startTime = $_POST['sTime'];			//start time of social activity
		$endTime = $_POST['eTime'];				//end time of social activity
		$name = trim($_POST['title']);			//name of social activity
        $location = trim($_POST['location']);	//location of social activity
		$type = $_POST['type'];					//type of social activity
		$notes = trim($_POST['notes']);			//notes about social activity
		
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
		
		//ensure name is provided 
		if($name == "")
		{
			$isValid = false;
		}//end if
		
		//ensure location is provided 
		if($location == "")
		{
			$isValid = false;
		}//end if
		
		//ensure type is provided
		if($type == "-1")
		{
			$isValid = false;			
		}//end if
		
		//if data is valid, add to database through SocialDataModule
		if($isValid)
		{
			$date = date($date);					//convert text date to DateTime object
    		$start = new DateTime($startTime);		//convert text start time to DateTime object
    		$end = new DateTime($endTime);			//convert text end time to DateTime object
			
			$socialMod->addSocialData($date, $name, $location, $start, $end, $type, $notes);

			//redirect to social tracking page with creation success
            header("Location: ../pages/tracking/socialtracking.php?s=s");
            exit();
		}//end if

		//if data is not valid
		else
		{
			//redirect to social tracking page with creation error
			header("Location: ../pages/tracking/socialtracking.php?s=f");
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