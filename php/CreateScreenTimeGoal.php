<?php
    /**
     * CreateScreenTimeGoal.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a screen time goal to the FLEX application. It will process the form fields on
     * the goals/screentimegoals.php page. Note: This is intended to be an action script
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

    //include access to the screen time goal module
    require_once("ScreenTimeGoalModule.php");

    //only run if form was submitted
    if(isset($_POST['screenTimeGoal']))
    {
        //create screen time goal module
        $screenMod = new ScreenTimeGoalModule();
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $goalMinutes = intval(trim($_POST['screenTimeGoal']));  //goal amount of time to spend on screens per day
 
        //ensure screen time is provided and positive
        if($goalMinutes=="" || $goalMinutes<=0)
        {
            $isValid = false;
        }//end if

        //if data is valid, add to database through Screen Time Goal Module
        if($isValid)
        {            
            $screenMod->setScreenTimeDailyGoal($goalMinutes);

            //redirect to screen time goals page with creation success
            header("Location: ../pages/goals/screentimegoals.php?s=s");
            exit();
        }//end if
        
        //if data is not valid
        else
        {
            //redirect to screen time goals page with creation error
            header("Location: ../pages/goals/screentimegoals.php?s=f");
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