<?php
	/**
     * Reports Front End (reports.php)
     * This creates the user interface of the main reports page.
	 * The user specifies which report to create and is brought 
	 * to that specific report page.  
     * Author: Sarah Kurtz
     * Last Updated: 3/28/18 JC
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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/reportstyle.css">
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
			<div><br>
                <fieldset>
                    <legend>Select which type of report you would like to generate:</legend>
                    <select onchange="check(this);">
                        <option value="" disabled selected>Select</option>
                        <option value="fitness">Fitness</option>
                        <option value="dietary">Dietary</option>
                        <option value="social">Social</option>
                        <option value="mental">Mental</option>
                        <option value="spiritual">Spiritual</option>
                        <option value="screentime">Screen Time</option>
                    </select>
                    <div id="ifFitness" style="display: none;">
                    <br>
                        <select>
                            <option value="aerobic">1 - Aerobic</option>
                            <option value="stretching">2 - Stretching</option>
                            <option value="high">3 - High Impact</option>
                            <option value="low">4 - Low Impact</option>
                            <option value="other">0 - Other</option>
                        </select>
                        
                        <!--
                        <select>
                            <option value="cardio">Cardio</option>
                            <option value="strength">Strength</option>
                            <option value="weight">Weight Gain/Loss</option>
                        </select>
                        -->
                    </div>   
                    <div id="ifDietary" style="display: none;">
                    <br>
                        <select>
                            <option value="water">1 - Water</option>
                            <option value="calories">2 - Calories</option>
                            <option value="other">0 - Other</option>
                        </select>
                    </div>
                    <div id="ifSocial" style="display: none;">
                    <br>
                        <select>
                            <option value="fusa">1 - FUSA</option>
                            <option value="ra">2 - RA</option>
                            <option value="night">3 - Fairfield @ Night</option>
                            <option value="family">4 - Family</option>
                            <option value="other">0 - Other</option>
                        </select>
                    </div>
                    <div id="ifMental" style="display: none;">
                    <br>
                        <select>
                            <option value="meditation">1 - Meditation</option>
                            <option value="formal">2 - Formal Counseling</option>
                            <option value="informal">3 - Informal Counseling</option>
                            <option value="mind">4 - Mindfulness Practice</option>
                            <option value="other">0 - Other</option>
                        </select>
                    </div>
                    <div id="ifSpiritual" style="display: none;">
                    <br>
                        <select>
                            <option value="mass">1 - Mass</option>
                            <option value="adoration">2 - Adoration</option>
                            <option value="reflection">3 - Reflection</option>
                            <option value="other">0 - Other</option>
                        </select>
                    </div>
                    <div id="ifScreenTime" style="display: none;">
                    <br>
                    </div>
                    <script>
                    function check(that) {
                        if (that.value == "fitness") {
                            document.getElementById("ifFitness").style.display = "block";
                            document.getElementById("ifSocial").style.display = "none";
                            document.getElementById("ifSpiritual").style.display = "none";
                            document.getElementById("ifMental").style.display = "none";
                            document.getElementById("ifDietary").style.display = "none";
                        } else if (that.value == "dietary") {
                            document.getElementById("ifDietary").style.display = "block";
                            document.getElementById("ifFitness").style.display = "none";
                            document.getElementById("ifSocial").style.display = "none";
                            document.getElementById("ifSpiritual").style.display = "none";
                            document.getElementById("ifMental").style.display = "none";
                        } else if (that.value == "social") {
                            document.getElementById("ifSocial").style.display = "block";
                            document.getElementById("ifFitness").style.display = "none";
                            document.getElementById("ifDietary").style.display = "none";
                            document.getElementById("ifSpiritual").style.display = "none";
                            document.getElementById("ifMental").style.display = "none";
                        } else if (that.value == "mental") {
                            document.getElementById("ifMental").style.display = "block";
                            document.getElementById("ifFitness").style.display = "none";
                            document.getElementById("ifSocial").style.display = "none";
                            document.getElementById("ifSpiritual").style.display = "none";
                            document.getElementById("ifDietary").style.display = "none";
                        } else if (that.value == "spiritual") {
                            document.getElementById("ifSpiritual").style.display = "block";
                            document.getElementById("ifFitness").style.display = "none";
                            document.getElementById("ifSocial").style.display = "none";
                            document.getElementById("ifDietary").style.display = "none";
                            document.getElementById("ifMental").style.display = "none";
                        } else if (that.value == "screentime") {
                            document.getElementById("ifScreenTime").style.display = "block";
                            document.getElementById("ifSpiritual").style.display = "none";
                            document.getElementById("ifFitness").style.display = "none";
                            document.getElementById("ifSocial").style.display = "none";
                            document.getElementById("ifDietary").style.display = "none";
                            document.getElementById("ifMental").style.display = "none";
                        }
                    }
                    </script>
                </fieldset>
				<br><br>
                <fieldset>
				    <legend>Select the time range for the report:</legend>
                    Start Date: <input type="date" id = "date" name="date" >
                    <br><br>End Date: <input type="date" id = "date" name="date" >
				</fieldset>
                    <br><br>
                <div id="container">
					<button type="submit" name="submit" id="submit" value="Submit">Submit</button>
                </div>
			</div>
        </main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block">
            1073 North Benson Road
            <br>Fairfield, CT 06824
            </div>
        </footer>
    </body>
</html>
