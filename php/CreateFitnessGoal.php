<?php
    /**
     * CreateFitnessGoal.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a fitness goal to the FLEX application. It will process the form fields on
     * the goals/fitnessgoals.php page. Note: This is intended to be an action script
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

    //include access to the fitness goal module
    require_once("FitnessGoalModule.php");

    //only run if form was submitted
    if(isset($_POST['goalType']))
    {
        //create fitness goal module
        $fitMod = new FitnessGoalModule();
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $goalType = $_POST['goalType'];                         //type of fitness goal
        $cardioType = $_POST['cardioType'];                     //type of cardio goal
        $cardioDistance = intval(trim($_POST['distance']));     //goal for cardio-distance
        $cardioSpeed = intval(trim($_POST['speed']));           //goal for cardio-speed
        $cardioTime = intval(trim($_POST['time']));             //goal for cardio-time
        $strengthType = $_POST['strengthType'];                 //type of strength goal
        $strengthWeight = intval(trim($_POST['maxWeight']));    //strength goal weight
        $weightType = $_POST['weightType'];                     //type of weight goal (+/-)
        $weightChange = intval(trim($_POST['weightDif']));      //relative target weight
        $days = intval(trim($_POST['numDays']));                //number of days to acheive goal

        //flags for ease of submission
        $cardioMilestone;
        $cardioDataType;

        //ensure goal type selected
        if($goalType == "-1")
        {
            $isValid = false;
        }//end if

        //if cardio goal
        else if($goalType == "CARDIO")
        {            
            //ensure type of cardio selected
            if($cardioType=="DISTANCE")
            {
                $cardioDataType = "CARDIO-DISTANCE";
                $cardioMilestone = $cardioDistance;

                //ensure distance is provided and positive
                if($cardioDistance=="" || $cardioDistance<=0)
                {
                    $isValid = false;
                }//end if
            }//end if

            //if cardio speed goal
            else if($cardioType=="SPEED")
            {
                $cardioDataType = "CARDIO-SPEED";
                $cardioMilestone = $cardioSpeed;

                //ensure speed is provided and positive
                if($cardioSpeed=="" || $cardioSpeed<=0)
                {
                    $isValid = false;
                }//end if
            }//end if

            //if cardio time goal
            else if($cardioType=="TIME")
            {
                $cardioDataType = "CARDIO-TIME";
                $cardioMilestone = $cardioTime;

                //ensure time is provided and positive
                if($cardioTime=="" || $cardioTime<=0)
                {
                    $isValid = false;
                }//end if
            }//end if

            //if cardio type not recognized
            else
            {
                $isValid = false;
            }//end if
        }//end if

        //if strength goal
        else if($goalType == "STRENGTH")
        {
            //ensure strength type selected
            if($strengthType=="-1")
            {
                $isValid = false;
            }//end if

            else
            {
                //ensure max weight submitted
                if($strengthWeight=="" || $strengthWeight<=0)
                {
                    $isValid = false;
                }//end if
            }//end else
        }//end if

        //if weight goal
        else if($goalType == "WEIGHT")
        {
            //ensure weight type selected
            if($weightType=="-1")
            {
                $isValid = false;
            }//end if

            else
            {
                //ensure weight change submitted
                if($weightChange=="" || $weightChange<=0)
                {
                    $isValid = false;
                }//end if
            }//end else
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

        //if data is valid, add to database through Dietary Goal Module
        if($isValid)
        {            
            //if cardio goal
            if($goalType == "CARDIO")
            {  
                $fitMod->setCardioGoal($days,$cardioDataType,$cardioMilestone);
            }//end if

            //if strength goal
            else if($goalType == "STRENGTH")
            {
                $strengthDataType = "STRENGTH-".$strengthType;
                $fitMod->setStrengthGoal($days,$strengthDataType,$strengthWeight);
            }//end if

            //if weight goal
            else if($goalType == "WEIGHT")
            {
                if($weightType=="LOSS")
                {
                    $weightChange *= -1;
                }//end if
                echo "weightChange: ".$weightChange."<br>tring to add<br>";
                $fitMod->setWeightGoal($days,$weightChange);
                echo "added<br>";
            }//end if

            //redirect to fitness goals page with creation success
            header("Location: ../pages/goals/fitnessgoals.php?s=s");
            exit();
        }//end if
        
        //if data is not valid
        else
        {
            //redirect to fitness goals page with creation error
            header("Location: ../pages/goals/fitnessgoals.php?s=f");
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