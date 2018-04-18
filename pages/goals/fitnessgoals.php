<?php
	 /**
     * Fitness Goals Front End (fitnessgoals.php)
     * This creates the user interface to record the user's fitness goals
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
        <script src="../../javascript/fitnessgoals.js"></script>

        <!--This will allow certain options to be visible when specific options are chosen -->
        <script>
            function check(that) 
            {
                if (that.value == "CARDIO") 
                {
                    document.getElementById("ifCardio").style.display = "block";
                    document.getElementById("ifStrength").style.display = "none";
                    document.getElementById("ifWeight").style.display = "none";
                } 
                else if (that.value == "STRENGTH") 
                {
                    document.getElementById("ifStrength").style.display = "block";
                    document.getElementById("ifWeight").style.display = "none";
                    document.getElementById("ifCardio").style.display = "none";
                    document.getElementById("ifDistance").style.display = "none";
                    document.getElementById("ifSpeed").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                } else if (that.value == "WEIGHT") 
                {
                    document.getElementById("ifWeight").style.display = "block";
                    document.getElementById("ifCardio").style.display = "none";
                    document.getElementById("ifStrength").style.display = "none";
                    document.getElementById("ifDistance").style.display = "none";
                    document.getElementById("ifSpeed").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                }
            }//close check
            
            function check2(that) 
            {
                if (that.value == 'DISTANCE') 
                {
                    document.getElementById("ifDistance").style.display = "block";
                    document.getElementById("ifSpeed").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                } 
                else if (that.value == 'SPEED') 
                {
                    document.getElementById("ifSpeed").style.display = "block";
                    document.getElementById("ifDistance").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                } 
                else if (that.value == 'TIME') 
                {
                    document.getElementById("ifTime").style.display = "block";
                    document.getElementById("ifDistance").style.display = "none";
                    document.getElementById("ifSpeed").style.display = "none";
                }
            }//close check2
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
        	<h2>Fitness Goals</h2>
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
                    <div style="color: green; padding: 20px;">Fitness Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateFitnessGoal.php" onsubmit="return validateFitnessGoalSubmission();">				
                <div> 
                    <label for="goalType">Type of Fitness<sup>*</sup>: </label>
                        <select id="goalType" name="goalType" onchange="check(this);">
                            <option value="-1">Select</option>  
                            <option value="CARDIO">Cardio</option>
                            <option value="STRENGTH">Strength</option>
                            <option value="WEIGHT">Weight Gain/Loss</option>
                        </select>
                </div>
                <div class="errorMSG" id="type_error">You must select a type of fitness goal.</div>
                <br>
					
				<!--Cardio Types-->
				<div id="ifCardio" style="display: none;">
                    <div>
						<label for="cardioType">Type of Cardio<sup>*</sup>: </label>
                        <select id="cardioType" name="cardioType" onchange="check2(this);">
                        	<option value="-1">Select</option>
                            <option value="DISTANCE">Distance</option>
                            <option value="SPEED">Speed</option>
                            <option value="TIME">Time</option>
                        </select>
                    </div>
                    <div class="errorMSG" id="cardio_error">You must select a type of cardio goal.</div>
                    <br>
                </div>
                		
			    <div id="ifDistance" style="display:none;">
                    <div>
						<label for="distance">Goal Distance<sup>*</sup>: </label>
                            <input type="text" name="distance" id="distance" size="5"> Miles
                    </div>
                    <div class="errorMSG" id="distance_error">You must provide a distance goal.</div>
                    <br>
                </div>
                <div id="ifSpeed" style="display:none;">
                    <div>
						<label for="speed">Goal Speed<sup>*</sup>: </label>
                            <input type="text" name="speed" id="speed" size="5"> MPH
                    </div>
                    <div class="errorMSG" id="speed_error">You must provide a speed goal.</div>
                    <br>
                </div>
                <div id="ifTime" style="display:none;">
                    <div>
						<label for="time">Goal Time<sup>*</sup>: </label>
                            <input type="text" name="time" id="time" size="5"> Minutes
                    </div>
                    <div class="errorMSG" id="time_error">You must provide a time goal.</div>
                    <br>
                </div>
					
                <!--Strength Types-->
                <div id="ifStrength" style="display: none;">
                    <div>
						<label for="strengthType">Type of Weight Training<sup>*</sup>: </label>
                        <select id="strengthType" name="strengthType">
                        	<option value="-1">Select</option>
                            <option value="BICEP">Bicep Curl</option>
                            <option value="CHEST">Chest Press</option>
                            <option value="DEADLIFT">Deadlift</option>
                            <option value="SQUAT">Squat</option>
                        </select>
                    </div>
                    <div class="errorMSG" id="strengthType_error">You must select a type of strength goal.</div>
                    <br>
                    <div>
                        Goal<sup>*</sup>: <input type="text" name="maxWeight" id="maxWeight" size="5"> lbs
                    </div>
                    <div class="errorMSG" id="strengthGoal_error">You must provide a strength goal.</div>
                    <br>
                </div>
					
                <div id="ifWeight" style="display: none;"> 
                    <div>
						<label for="weightType">Gain or Loss<sup>*</sup>: </label>
						<select id="weightType" name="weightType">
                            <option value="-1">Select</option>
                            <option value="GAIN">Weight Gain</option>
                            <option value="LOSS">Weight Loss</option>
                        </select>
                    </div>
                    <div class="errorMSG" id="weightType_error">You must select a type of weight goal.</div><br>
                    <div>    
                        <label for="weightDif">Weight Difference<sup>*</sup>: </label>
                        <input type="text" name="weightDif" id="weightDif" size="5"> lbs
                    </div>
                    <div class="errorMSG" id="weightGoal_error">You must provide a weight goal.</div>
                    <br>
                </div>
					
				<div>
                    <label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
                         <input type="text" name="numDays" id="numDays" size="5"> Day(s)
                </div>
                <div class="errorMSG" id="numDays_error">You must provide a number of days for the goal.</div>
                <br>
 				
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