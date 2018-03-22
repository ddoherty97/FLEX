<?php
    /**
     * CreateSpiritualGoal.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a spiritual goal to the FLEX application. It will process the form fields on
     * the goals/spiritualgoals.php page. Note: This is intended to be an action script
     * 
     * Author: Davis Doherty
     * Last Updated: 3/21/18 DD
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

    //include access to the spiritual goal module
    require_once("SpiritualGoalModule.php");

    //only run if form was submitted
    if(isset($_POST['spiritualGoalType']))
    {
        //create spiritual goal module
        $spiritMod = new SpiritualGoalModule();
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $goalType = $_POST['spiritualGoalType'];                //type of spiritual goal
        $durationGoal = intval(trim($_POST['durationGoal']));   //goal minutes to attend to reach goal
        $eventGoal = intval(trim($_POST['eventGoal']));         //goal events to attend to reach goal
        $days = intval(trim($_POST['numDays']));                //number of days to acheive goal

        //ensure goal type selected
        if($goalType == "-1")
        {
            $isValid = false;
        }//end if

        //if duration goal
        else if($goalType == "0")
        {            
            //ensure number of minutes are provided and positive
            if($durationGoal=="" || $durationGoal<=0)
            {
                $isValid = false;
            }//end if
        }//end if

        //if events goal
        else if($goalType == "1")
        {
            //ensure number of events are provided and positive
            if($eventGoal=="" || $eventGoal<=0)
            {
                $isValid = false;
            }//end if
        }//end if

        //if undefined goal type
        else
        {
            $isValid = false;
        }//end else

        //ensure goal duration submitted
        if($days=="" || $days<=0)
        {
            $isValid = false;
        }//end if

        //if data is valid, add to database through Spiritual Goal Module
        if($isValid)
        {            
            //if duration goal
            if($goalType == "0")
            {  
                $spiritMod->setSpiritualDurationGoal($days,$durationGoal);
            }//end if

            //if events goal
            else if($goalType == "1")
            {
                $spiritMod->setSpiritualEventGoal($days,$eventGoal);
            }//end if

            //redirect to spiritual goals page with creation success
            header("Location: ../pages/goals/spiritualgoals.php?s=s");
            exit();
        }//end if
        
        //if data is not valid
        else
        {
            //redirect to spiritual goals page with creation error
            header("Location: ../pages/goals/spiritualgoals.php?s=f");
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