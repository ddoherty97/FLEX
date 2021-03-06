<?php
	 /**
     * Spiritual Tracking Front End (spiritualtracking.php)
     * This creates the user interface to record the user's spirutal activities
     * Author: John Wiley
     * Last Updated: 4/19/18 DD
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
	
	//get result of last data recorded
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
        <script src="../../javascript/spiritualtracking.js"></script>
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
                <a href="tracking.php">Tracking</a>
                <a href="../goals/goals.php">Goals</a>
                <a href="../reports/reports.php">Reports</a>
                <a href="../../php/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
        	
        	<h1> FLEX </h1>
			<h2>Spiritual Tracking</h2>
			
			 <?php
                //display status of last data recording result
                if($result=="f")
                {
            ?>
                    <div style="color: red; padding: 20px;">THERE WAS AN ERROR RECORDING YOUR ACTIVITY.</div>
            <?php
                }//end if
                else if($result=="s")
                {
            ?>
                    <div style="color: green; padding: 20px;">Spiritual Activity Recorded</div>
            <?php
                }//end if
            ?>
			<p>Lets track your Spiritual Activity!<br></p>

			<form action="../../php/CreateSpiritualData.php" method="POST" onsubmit="return validateSpiritualTrackingSubmission();">
				<div>
                    <label for="type">Name of Event<sup>*</sup>: </label>
                        <input type="text" id="title" name="title">
                </div>
                <div class="errorMSG" id="title_error">You must enter the title of the event.</div>
				    <br>
                <div>
                    <label for = "date">Date<sup>*</sup>: </label>
                        <input type="date" id="date" name="date">
                </div>
                <div class="errorMSG" id="date_error">You must enter a date in the format YYYY-MM-DD.</div>
				    <br>
                <div>
                    <label for="type">Start Time<sup>*</sup>: </label>
                        <input type="time" id="sTime" name="sTime">
                </div>
				<div class="errorMSG" id="start_error">You must enter a start time.</div>
				    <br>
                <div>
                    <label for="type">End Time<sup>*</sup>: </label>
                        <input type="time" id="eTime" name="eTime">
                </div>
				<div class="errorMSG" id="end_error">You must enter an end time.</div>
				    <br>
                <div>
                    <label for="type">Location of Event<sup>*</sup>: </label>
                        <input type="text" id="location" name="location">
                </div>
				<div class="errorMSG" id="location_error">You must enter the location.</div>
				    <br>
                <div>
                    <label for="type">Type of Event<sup>*</sup>: </label>
                        <input type="text" id="type" name="type">
				</div>
                <div class="errorMSG" id="type_error">You must select an event type.</div>
				    <br>
                <div>
                    <label for="textarea">Other Notes: </label>
                        <textarea rows="3" id="notes" name="notes" cols="20"></textarea>
				</div>
				
                <br>
  				<input type="submit" value="Submit">
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