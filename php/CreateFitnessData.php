<?php
	 /**
     * CreateFitnessData.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a fitness data to the FLEX application. It will process the form fields on
     * the tracking/fitnesstracking.php page. Note: This is intended to be an action script
     * Author: Jaclyn Cuevas
     * Last Updated: 4/7/18 JC
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
        $date = $_POST['date'];								//date of fitness activity
        $startTime = $_POST['sTime'];						//start time of fitness activity
		$endTime = $_POST['eTime'];							//end time of fitness activity
		$fitnessType = $_POST['goalType'];					//type of fitness activity
		$cardioType = $_POST['cardioType'];					//type of cardio activity
		$strengthType = $_POST['strengthType'];				//type of strength activity
		$weight = floatval(trim($_POST['weightChange']));	//new weight of user
		$milestone = floatval(trim($_POST['milestone']));	//fitness activity milestone
		$notes = trim($_POST['notes']);						//notes about fitness activity
	
		//if fitness type is weight change
		//set start and end times to 00:00
		//set milestone to weight change
		if($fitnessType == "WEIGHT")
		{
			$startTime = "00:00";
			$endTime = "00:00";
			$milestone = $weight;
		}
		
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
		
		//ensure fitness type is provided
		if($fitnessType == "-1")
		{
			$isValid = false;			
		}//end if
		
		//if cardio activity
		else if($fitnessType == "CARDIO")
		{
			//ensure cardio type provided
			if($cardioType == "-1")
			{
				$isValid = false;
			}//end if
		}//end if

		//if strength activity
		else if($fitnessType == "STRENGTH")
		{
			//ensure strength type provided
			if($strengthType == "-1")
			{
				$isValid = false;
			}//end if
		}//end if
	
		//if weight change
		else if($fitnessType == "WEIGHT")
		{
			//ensure weight provided
			if($weight == "")
			{
				$isValid = false;
			}//end if
		}//end if
		
		//ensure milestone is provided
		if($milestone == "" || $milestone == 0)
		{
			$isValid = false;			
		}//end if
		
		//if data is valid, add to database through FitnessDataModule
		if($isValid)
		{
			$date = date($date);					//convert text date to DateTime object
    		$start = new DateTime($startTime);		//convert text start time to DateTime object
    		$end = new DateTime($endTime);			//convert text end time to DateTime object
			
			//build fitness type
			if($fitnessType=="CARDIO")
			{
				$type = $fitnessType."-".$cardioType;
			}//end if
			else if($fitnessType=="STRENGTH")
			{
				$type = $fitnessType."-".$strengthType;
			}//end if
			else if($fitnessType=="WEIGHT")
			{
				$type = "WEIGHT";
			}//end if
			else
			{
				$type = "UNKNOWN";
			}//end else

			//add fitness data
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