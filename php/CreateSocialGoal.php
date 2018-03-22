<?php
    /**
     * CreateSocialGoal.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a social goal to the FLEX application. It will process the form fields on
     * the goals/socialgoals.php page. Note: This is intended to be an action script
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

    //include access to the social goal module
    require_once("SocialGoalModule.php");

    //only run if form was submitted
    if(isset($_POST['eventType']))
    {
        //create social goal module
        $socialMod = new SocialGoalModule();
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $eventType = $_POST['eventType'];               //type of social event
        $otherEventType = trim($_POST['other']);        //description of social event (if other)
        $socialTime = intval(trim($_POST['time']));     //goal spent on social activity
        $days = intval(trim($_POST['numDays']));        //number of days to acheive goal

        //ensure event type selected
        if($eventType == "-1")
        {
            $isValid = false;
        }//end if

        //if other event type
        else if($eventType == "0")
        {            
            //ensure event type is provided
            if($otherEventType=="")
            {
                $isValid = false;
            }//end if
        }//end if

        //ensure time spent on activities submitted and positive
        if($socialTime=="" || $socialTime<=0)
        {
            $isValid = false;
        }//end if

        //ensure goal duration submitted
        if($days=="" || $days<=0)
        {
            $isValid = false;
        }//end if

        //if data is valid, add to database through Social Goal Module
        if($isValid)
        {            
            //get social event type
            if($eventType=="0")
            {
                $eventType = $otherEventType;
            }//end if

            $socialMod->setSocialActivityGoal($days,$socialTime,$eventType);

            //redirect to social goals page with creation success
            header("Location: ../pages/goals/socialgoals.php?s=s");
            exit();
        }//end if
        
        //if data is not valid
        else
        {
            //redirect to social goals page with creation error
            header("Location: ../pages/goals/socialgoals.php?s=f");
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