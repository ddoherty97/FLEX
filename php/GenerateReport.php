<?php
    /**
     * GenerateReport.php
     * This file, written in procedural language (not object-oriented), is used to generate
     * a report from the FLEX application. It will process the report information on
     * the reports.php page. Note: This is intended to be an action script
     * 
     * Author: Davis Doherty
     * Last Updated: 4/8/18 DD
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

    //only run if form submitted
    if(isset($_POST['reportType']))
    {
        //collect submitted data
        $type = $_POST['reportType'];
        $start = trim($_POST['sDate']);
        $end = trim($_POST['eDate']);

        //flag to ensure valid report data
        $isValid = true;

        //ensure report type selected
        if($type=="-1")
        {
            $isValid = false;
        }//end if

        //ensure start date provided and valid
        if($start=="")
        {
            $isValid = false;
        }//end if
        else
        {
            if(!DateTime::createFromFormat("Y-m-d",$start))
            {
                $isValid = false;
            }//end if
        }//end else

        //ensure end date provided and valid
        if($end=="")
        {
            $isValid = false;
        }//end if
        else
        {
            if(!DateTime::createFromFormat("Y-m-d",$end))
            {
                $isValid = false;
            }//end if
        }//end else

        //if data valid
        if($isValid)
        {
            //set redirect URL
            switch($type)
            {
                case "Fitness":
                    $reportPage = "fitnessreport.php";
                break;

                case "Dietary":
                    $reportPage = "dietaryreport.php";
                break;

                case "Social":
                    $reportPage = "socialreport.php";
                break;

                case "Mental":
                    $reportPage = "mentalreport.php";
                break;

                case "Spiritual":
                    $reportPage = "spiritualreport.php";
                break;

                case "Screen Time":
                    $reportPage = "screentimereport.php";
                break;
            }//end switch

            //redirect to report
            $url = "../pages/reports/".$reportPage."?start=".$start."&end=".$end;
            header("Location: ".$url);
            exit();
        }//end if

        //if data not valid
        else
        {
             //redirect to reports page
            header("Location: ../pages/reports/reports.php?s=f");
            exit();
        }//end else
    }//end if

    //if form not submitted
    else
    {
        //redirect to reports page
        header("Location: ../pages/reports/reports.php");
        exit();
    }//end else
?>