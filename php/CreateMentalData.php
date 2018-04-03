<?php
	 /**
     * CreateMentalData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a mental health data to the FLEX application. It will process the form fields on
     * the tracking/mentaltracking.php page. Note: This is intended to be an action script
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

    //include access to the mental data module
    require_once("MentalTrackingModule.php");
	
	//only run if form was submitted
    if(isset($_POST['date']))
    {
    	//create mental data module
        $mentalMod = new MentalTrackingModule();
		
		//flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $date = $_POST['date'];					//date of mental activity
        $startTime = $_POST['sTime'];			//start time of mental activity
		$endTime = $_POST['eTime'];				//end time of mental activity
		$notes = trim($_POST['notes']);			//notes about mental activity
		$level = $_POST['level'];				//stress level
		$factors = trim($_POST['factors']);		//factors contributing to stress level
		$other = trim($_POST['other']);			//other notes about activity/stress level
		
		//validate all inputs
		//ensure date is provided 
		if($date == "")
		{
			$isValid = false;
		}//end if
				
		//if data is valid, add to database through MentalDataModule
		if($isValid)
		{
			$date = date($date);					//convert text date to DateTime object
    		$start = new DateTime($startTime);		//convert text start time to DateTime object
    		$end = new DateTime($endTime);			//convert text end time to DateTime object
			
			$mentalMod->addMentalData($date, $start, $end, $notes, $level, $factors, $other);

			//redirect to mental tracking page with creation success
            header("Location: ../pages/tracking/mentaltracking.php?s=s");
            exit();
		}//end if

		//if data is not valid
		else
		{
			//redirect to mental tracking page with creation error
			header("Location: ../pages/tracking/mentaltracking.php?s=f");
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