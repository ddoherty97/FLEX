<?php
 	/**
     * Fitness Tracking Front End (fitnesstracking.php)
     * This creates the user interface to record the user's fitness activities
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
        <script src="../../javascript/fitnesstracking.js"></script>

        <script>
            function check(that) 
            {
                if (that.value == "CARDIO") 
                {
                	document.getElementById("timeOption").style.display = "block";
                    document.getElementById("ifCardio").style.display = "block";
                    document.getElementById("ifStrength").style.display = "none";
                    document.getElementById("ifWeightChange").style.display = "none";
                    document.getElementById("milestone").style.display = "block";
                } //end if
                else if (that.value == "STRENGTH") 
                {
                	document.getElementById("timeOption").style.display = "block";
                    document.getElementById("ifStrength").style.display = "block";
                    document.getElementById("ifCardio").style.display = "none";
                    document.getElementById("ifWeightChange").style.display = "none";
					document.getElementById("milestone").style.display = "block";

                }//end if
                else if (that.value == "WEIGHT") 
                {
                	document.getElementById("timeOption").style.display = "none";
                	document.getElementById("ifWeightChange").style.display = "block";
                    document.getElementById("ifStrength").style.display = "none";
                    document.getElementById("ifCardio").style.display = "none";
					document.getElementById("milestone").style.display = "none";

                }//end if
                else
                {
                    document.getElementById("ifCardio").style.display = "none";
                    document.getElementById("ifStrength").style.display = "none";
                    document.getElementById("ifWeightChange").style.display = "none";
                    document.getElementById("milestone").style.display = "none";
                }//end else
            }//close check
        </script>
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
        	<h1>FLEX</h1>
			<h2>Fitness Tracking</h2>
            <br>

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
                    <div style="color: green; padding: 20px;">Fitness Activity Recorded</div>
            <?php
                }//end if
            ?>

			<p>Lets track some of your fitness activities!<br></p>

			<form action="../../php/CreateFitnessData.php" method="POST" onsubmit="return validateFitnessTrackingSubmission();">
                <div>
                    <label for="date">Date<sup>*</sup>: </label>
                        <input type="date" id="date" name="date">
                </div>
				<div class="errorMSG" id="date_error">You must enter a date in the format YYYY-MM-DD.</div>
				    <br>
                <div>
                    <label for="goalType">Type of Fitness<sup>*</sup>: </label>
                        <select id="goalType" name="goalType" onchange="check(this);">
                            <option value="-1">Select</option>  
                            <option value="CARDIO">Cardio</option>
                            <option value="STRENGTH">Strength</option>
                            <option value="WEIGHT">Weight</option>
                        </select>
                </div>
                <div class="errorMSG" id="fitType_error">You must select your fitness type.</div>
                    <br>	
                <div id="timeOption" style="display: none;">
                    <div>
                        <label for="sTime">Start Time<sup>*</sup>: </label>
                            <input type="time" id="sTime" name="sTime">
                    </div>
                    <div class="errorMSG" id="start_error">You must enter a start time.</div>
				        <br>
				    <div>
                        <label for="eTime">End Time<sup>*</sup>: </label>
                            <input type="time" id="eTime" name="eTime">
                    </div>
                    <div class="errorMSG" id="end_error">You must enter an end time.</div>
				        <br>
				</div>

				<!--Cardio Types-->
				<div id="ifCardio" style="display: none;">
                    <div>
						<label for="cardioType">Type of Cardio<sup>*</sup>: </label>
                            <select id="cardioType" name="cardioType">
                                <option value="-1">Select</option>
                                <option value="DISTANCE">Distance</option>
                                <option value="SPEED">Speed</option>
                                <option value="TIME">Time</option>
                            </select>
                    </div>
                    <div class="errorMSG" id="cardioType_error">You must select a cardio type.</div>
                        <br>
                </div>

                <!--Strength Types-->
                <div id="ifStrength" style="display: none;">
                    <div>
						<label for="strengthType">Type of Strength Training<sup>*</sup>: </label>
                            <select id="strengthType" name="strengthType">
                                <option value="-1">Select</option>
                                <option value="BICEP">Bicep Curl</option>
                                <option value="CHEST">Chest Press</option>
                                <option value="DEADLIFT">Deadlift</option>
                                <option value="SQUAT">Squat</option>
                            </select>
                    </div>
                    <div class="errorMSG" id="strengthType_error">You must select a strength training type.</div>
                        <br>
                </div>

                <!--Weight Change-->
                <div id="ifWeightChange" style="display: none;">
                    <div>
						<label for="milestone">New Weight<sup>*</sup>: </label>
						    <input type="text" id="weightChange" name="weightChange" size="5"> lbs
                    </div>
                    <div class="errorMSG" id="weight_error">You must enter your new weight.</div>
                        <br>
                </div>

                <!-- milestone for other fitness types-->
				<div id="milestone" style="display: none;">
				    <div>
                        <label for="milestone">Milestone<sup>*</sup>: </label>
					        <input type="text" id="milestoneInput" name="milestone" size="7">
                            <select id="milestoneType" name="milestoneType">
                                <option value="-1">Select</option> 
                                <option value="">Lbs</option> 
                                <option value="">Miles</option>
                                <option value="">Minutes</option>
                                <option value="">MPH</option>
                            </select>
                    </div>
                    <div class="errorMSG" id="milestone_error">You must enter a new milestone.</div>
                    <div class="errorMSG" id="label_error">You must select a label for your milestone.</div>
				        <br>
				</div>

                <div>
                    <label for="textarea">Other Notes</label>:
                        <textarea rows="4" id="textarea" name="notes" cols="30"></textarea>
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
