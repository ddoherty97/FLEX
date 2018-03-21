<?php
    /**
     * CreateDietaryGoal.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a dietary goal to the FLEX application. It will process the form fields on
     * the goals/dietarygoals.php page. Note: This is intended to be an action script
     * 
     * Author: Davis Doherty
     * Last Updated: 3/20/18 DD
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

    //include access to the dietary goal module
    require_once("DietaryGoalModule.php");

    //only run if form was submitted
    if(isset($_POST['goalType']))
    {
        //create dietary goal module
        $dietMod = new DietaryGoalModule();
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $goalType = $_POST['goalType'];                 //type of dietary goal
        $calIntake = intval(trim($_POST['calories']));  //calorie intake
        $waterIntake = intval(trim($_POST['water']));   //water intake

        //ensure goal type selected
        if($goalType == "-1")
        {
            $isValid = false;
        }//end if

        //if calorie goal
        else if($goalType == "0")
        {            
            //ensure calories provided and are an integer
            if($calIntake=="" || !is_int($calIntake) || $calIntake<=0)
            {
                $isValid = false;
            }//end if
        }//end if

        //if water goal
        else if($goalType == "1")
        {
            //ensure water provided and is an integer
            if($waterIntake=="" || !is_int($waterIntake) || $waterIntake<=0)
            {
                $isValid = false;
            }//end if
        }//end if

        //if undefined goal type
        else
        {
            $isValid = false;
        }//end else

        //if data is valid, add to database through Dietary Goal Module
        if($isValid)
        {            
            //if calorie goal
            if($goalType == "0")
            {
                $dietMod->setDailyCalorieGoal($calIntake);
            }//end if

            //if water goal
            else if($goalType == "1")
            {
                $dietMod->setDailyWaterGoal($waterIntake);
            }//end if

            //redirect to dietary goals page with creation success
            header("Location: ../pages/goals/dietarygoals.php?s=s");
            exit();
        }//end if
        
        //if data is not valid
        else
        {
            //redirect to dietary goals page with creation error
            header("Location: ../pages/goals/dietarygoals.php?s=f");
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