<?php
	/**
     * Mental Goals Front End (mentalgoals.php)
     * This creates the user interface to record the user's mental health goals
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
        <script src="../../javascript/mentalgoals.js"></script>

		<script>
			function check(that) 
			{
				if (that.value == 0) 
				{
					document.getElementById("ifCounseling").style.display = "block";
					document.getElementById("ifStress").style.display = "none";
				}
				else if (that.value == 1) 
				{
					document.getElementById("ifStress").style.display = "block";
					document.getElementById("ifCounseling").style.display = "none";
				}
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
        	<h2>Mental Health Goals</h2>
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
                    <div style="color: green; padding: 20px;">Mental Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateMentalGoal.php" onsubmit="return validateMentalGoalSubmission();">
	 			<div>
		 			<label for="goalType">Type of Goal<sup>*</sup>: </label>
		 				<select id="goalType" name="goalType" onchange="check(this);">
							<option value="-1">Select</option>  
							<option value="0">Counseling</option>
		  					<option value="1">Stress Level</option>
						</select> 
				</div>
					<div class="errorMSG" id="type_error">You must select a type of mental goal.</div>
					<br>
					
				<div id="ifCounseling" style="display:none;">
					<div>
						<label for="counselingTimeGoal">Counseling Time Goal<sup>*</sup>: </label>
							<input type="text" name="counselingTimeGoal" id="counselingTimeGoal" size="5"> Hours
					</div>
					<div class="errorMSG" id="counseling_error">You must provide a counseling time goal.</div><br>
					
					<div>
						<label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
	 						<input type="text" name="numDays" id="numDays" size="5"> Day(s)
 					</div>	
 					<div class="errorMSG" id="numDays_error">You must provide a number of days for the goal.</div><br>
				</div>
					
				<div id="ifStress" style="display:none;">
					<div>
						<label for="stressLevelGoal">Daily Goal Stress Level<sup>*</sup>: </label>
							<select id="stressLevelGoal" name="stressLevelGoal" onchange="check(this);">
								<option value="-1">Select</option>  
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select> 
					</div>
						<div class="errorMSG" id="stress_error">You must provide a stress level goal.</div><br>
				</div>
 						
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