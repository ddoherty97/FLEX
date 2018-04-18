<?php
	/**
     * Screen Time Goals Front End (screentimegoals.php)
     * This creates the user interface to record the user's screen time goals
	 * Initially assigned to Muhammad Mubasit
     * Author: Jaclyn Cuevas
     * Last Updated: 4/18/18 JC
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

    //get result of last goal creation
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
        <script src="../../javascript/screentimegoals.js"></script>
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a> <!-- -->
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="../users/profile.php">Profile</a>
                <a href="../tracking/tracking.php">Tracking</a>
                <a href="goals.php">Goals</a>
                <a href="../reports/reports.php">Reports</a>
                <a href="../../php/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
        	<h1>FLEX</h1>
            <h2>Screen Time Goal</h2>
            <br>

            <?php
                //display status of last goal creation result
                if($result=="f")
                {
            ?>
                    <div style="color: red; padding: 20px;">THERE WAS AN ERROR CREATING YOUR GOAL.</div>
            <?php
                }//end if
                else if($result=="s")
                {
            ?>
                    <div style="color: green; padding: 20px;">Screen Time Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateScreenTimeGoal.php" onsubmit="return validateScreenTimeGoalSubmission();">
                <div>
                	<label for="screenTimeGoal">Daily Screen Time Goal<sup>*</sup>: </label>
                    	<input type="text" name="screenTimeGoal" id="screenTimeGoal" size="5"> Minutes
                </div>
                <div class="errorMSG" id="st_error">You must provide a screen time duration goal.</div><br>
                
                <input type="submit"  value="Add Goal">
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