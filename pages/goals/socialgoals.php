<?php
	/**
     * Social Goals Front End (socialgoals.php)
     * This creates the user interface to record the user's social goals
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
        <script src="../../javascript/socialgoals.js"></script>

        <script>
            function check(that) 
            {
                if (that.value == 0) 
                {
                    document.getElementById("ifOther").style.display = "block";
                }//end if
                else
                {
                    document.getElementById("ifOther").style.display = "none";
                }//end else
            }//close check
        </script>
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a> <!--  -->
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
            <h2>Social Goals</h2>
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
                    <div style="color: green; padding: 20px;">Social Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateSocialGoal.php" onsubmit="return validateSocialGoalSubmission();">			
	 			<div>
		 			<label for="eventType">Type of Social Event<sup>*</sup>: </label>
		 				<select id="eventType" name="eventType" onchange="check(this);">
							<option value="-1">Select</option>  
							<option value="CLUB MEETING">Club Meeting</option>
		  					<option value="F@N">Fairfield at Night Event</option>
		  					<option value="RA EVENT">RA Event</option>
		  					<option value="SPORTS EVENT">Sports Game/Event</option>
		  					<option value="0">Other</option>
						</select> 
				</div>
				<div class="errorMSG" id="type_error">You must provide a social goal type.</div><br>
					
                <div id="ifOther" style="display:none;">
                    <div>
                    	<label for="other">Event Type<sup>*</sup>: </label>
                        	<input type="text" name="other" id="other">
                    </div>
                    <div class="errorMSG" id="other_error">You must provide an event type.</div><br>
                </div>
	                
	            <div>
	                <label for="numDays">Goal Time to Spend on Activity<sup>*</sup>: </label>
	                    <input type="text" name="time" id="time" size="5"> Minutes
	            </div>    
	            <div class="errorMSG" id="time_error">You must provide a social time goal.</div><br>
	            
	            <div>
               		<label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
                	    <input type="text" name="numDays" id="numDays" size="5"> Day(s)
                </div>
                <div class="errorMSG" id="numDays_error">You must provide a number of days for the goal.</div><br>
                
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