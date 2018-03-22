<?php
    /**
     * CreateMentalGoal.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a mental goal to the FLEX application. It will process the form fields on
     * the goals/mentalgoals.php page. Note: This is intended to be an action script
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

    //include access to the mental goal module
    require_once("MentalGoalModule.php");

    //only run if form was submitted
    if(isset($_POST['goalType']))
    {
        //create mental goal module
        $mentalMod = new MentalGoalModule();
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $goalType = $_POST['goalType'];                         //type of fitness goal
        $timeGoal = intval(trim($_POST['counselingTimeGoal'])); //goal amount of time to spend at counseling
        $stressGoal = $_POST['stressLevelGoal'];                //goal stress level
        $days = intval(trim($_POST['numDays']));                //number of days to acheive goal

        //ensure goal type selected
        if($goalType == "-1")
        {
            $isValid = false;
        }//end if

        //if counseling goal
        else if($goalType == "0")
        {            
            //ensure counseling time is provided and positive
            if($timeGoal=="" || $timeGoal<=0)
            {
                $isValid = false;
            }//end if

            //ensure goal duration submitted
            if($days=="" || $days<=0)
            {
                $isValid = false;
            }//end if
        }//end if

        //if stress goal
        else if($goalType == "1")
        {
            //ensure strength type selected
            if($stressGoal=="-1")
            {
                $isValid = false;
            }//end if
        }//end if

        //if undefined goal type
        else
        {
            $isValid = false;
        }//end else

        //if data is valid, add to database through Mental Goal Module
        if($isValid)
        {            
            //if counseling goal
            if($goalType == "0")
            {  
                $mentalMod->setCounselingGoal($days,$timeGoal);
            }//end if

            //if stress goal
            else if($goalType == "1")
            {
                $mentalMod->setDailyStressGoal($stressGoal);
            }//end if

            //redirect to mental goals page with creation success
            header("Location: ../pages/goals/mentalgoals.php?s=s");
            exit();
        }//end if
        
        //if data is not valid
        else
        {
            //redirect to mental goals page with creation error
            header("Location: ../pages/goals/mentalgoals.php?s=f");
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