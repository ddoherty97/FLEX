<?php
    /**
     * RemoveMentalGoal.php
     * This file, written in procedural language (not object-oriented), is used to remove
     * a mental goal from the FLEX application. It will react to user interaction on
     * the reports/mentalreport.php page. Note: This is intended to be an action script
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

    //include access to the mental goal module
    require_once("MentalGoalModule.php");

    //only run if goal ID provided
    if(isset($_GET['goalID']))
    {
        //create mental goal module
        $mentalMod = new MentalGoalModule();

        //make sure id is valid integer
        if(intval($_GET['goalID']) != 0)
        {
            //remove goal
            $mentalMod->removeGoal($_GET['goalID']);
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