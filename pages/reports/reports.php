<?php
	/**
     * Reports Front End (reports.php)
     * This creates the user interface of the main reports page.
	 * The user specifies which report to create and is brought 
	 * to that specific report page.  
     * Author: Sarah Kurtz
     * Last Updated: 4/8/18 JC
     **/

    //check if session is already running
	if(!isset($_SESSION)) 
    { 
        session_start();
    }//end if
	
	//if no session is active, redirect to login page
    $phpFolderPath = "../../php/";
    $logoutFile = $phpFolderPath."logout.php";
    require($phpFolderPath."IsLoggedIn.php");
	
	//get result of last report creation
    if(isset($_GET['s']))
    {
        $result = $_GET['s'];
    }//end if
    else
    {
        $result = "none";
    }//end else
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       	<link rel="stylesheet" href="../../css/style.css">
       	<script src="../../javascript/reports.js"></script>
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="../users/profile.php">Profile</a>
                <a href="../tracking/tracking.php">Tracking</a>
                <a href="../goals/goals.php">Goals</a>
                <a href="reports.php">Reports</a>
                <a href="../../php/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
            <h1>FLEX</h1>
            <h2>Generate a Report</h2>
            <br>
            
            <?php
                //display status of last report result
                if($result=="f")
                {
            ?>
                    <div style="color: red; padding: 20px;">THERE WAS AN ERROR GENERATING YOUR REPORT.</div>
            <?php
                }//end if
            ?>

            <form method="POST" action="../../php/GenerateReport.php" onsubmit="return validateReportSubmission();">
				<div>
					<label for="reportType">Type of report to generate:</label>
	                    <select id="reportType" name="reportType" onchange="check(this);">
	                        <option value="-1">Select</option>
	                        <option value="Fitness">Fitness</option>
	                        <option value="Dietary">Dietary</option>
	                        <option value="Social">Social</option>
	                        <option value="Mental">Mental</option>
	                        <option value="Spiritual">Spiritual</option>
	                        <option value="Screen Time">Screen Time</option>
	                    </select>
                </div>
                <div class="errorMSG" id="type_error">You must select a report type.</div><br>
                
                
				    <label for="timeRange">Time range for report:</label>
				    <br><br>
				    	<div>
	                    	<label>Start Date: </label>
	                    		<input type="date" id = "sDate" name="sDate">
                    	</div>
                    	<div class="errorMSG" id="start_error">You must enter a valid start date in the form yyyy-mm-dd.</div><br>
                    	
                    	<div>
	                    	<label>End Date: </label>
	                    		<input type="date" id = "eDate" name="eDate">
                    	</div>
                    	<div class="errorMSG" id="end_error">You must enter a valid end date in the form yyyy-mm-dd.</div><br>

					<button type="submit" name="submit" id="submit" value="Submit">Submit</button>
				</form>
        </main>
        <footer>
            <div class="leftFootCol">
                &copy; 2018
                    <br>
                Fairfield University
            </div>
            <div class="rightFootCol">
                1073 North Benson Road
                    <br>
                Fairfield, CT 06824
            </div>
            <div class="clear"></div>
        </footer>
    </body>
</html>
