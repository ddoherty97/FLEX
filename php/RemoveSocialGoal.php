<?php
    /**
     * RemoveSocialGoal.php
     * This file, written in procedural language (not object-oriented), is used to remove
     * a social goal from the FLEX application. It will react to user interaction on
     * the reports/socialreport.php page. Note: This is intended to be an action script
     * 
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
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

    //only run if goal ID provided
    if(isset($_GET['goalID']))
    {
        //create social goal module
        $socialMod = new SocialGoalModule();

        //make sure id is valid integer
        if(intval($_GET['goalID']) != 0)
        {
            //remove goal
            $dietMod->removeGoal($_GET['goalID']);
        }//end if

        //redirect to report page
        header("Location: ../pages/reports/reports.php");
		exit();
    }//end if

    //if no id provided
    else
    {
        //redirect to home
        header("Location: ../pages/home.php");
		exit();
    }//end else
?>