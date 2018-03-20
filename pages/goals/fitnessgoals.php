<?php
    //check if session is already running
	if(!isset($_SESSION)) 
    { 
        session_start();
    }//end if
	
	//if no session is active, redirect to login page
    $logoutFile = "../../php/logout.php";
    require("../../php/IsLoggedIn.php");

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

        <!--This will allow certain options to be visible when specific options are chosen -->
        <script>
            function check(that) 
            {
                if (that.value == 0) 
                {
                    document.getElementById("ifCardio").style.display = "block";
                    document.getElementById("ifStrength").style.display = "none";
                    document.getElementById("ifWeight").style.display = "none";
                } 
                else if (that.value == 1) 
                {
                    document.getElementById("ifStrength").style.display = "block";
                    document.getElementById("ifWeight").style.display = "none";
                    document.getElementById("ifCardio").style.display = "none";
                    document.getElementById("ifDistance").style.display = "none";
                    document.getElementById("ifSpeed").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                } else if (that.value == 2) 
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
                if (that.value == 'distance') 
                {
                    document.getElementById("ifDistance").style.display = "block";
                    document.getElementById("ifSpeed").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                } 
                else if (that.value == 'speed') 
                {
                    document.getElementById("ifSpeed").style.display = "block";
                    document.getElementById("ifDistance").style.display = "none";
                    document.getElementById("ifTime").style.display = "none";
                } 
                else if (that.value == 'time') 
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
            <a href="../home.html"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a> <!--  -->
            <nav>
                <ul>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Menu</a>
                        <div class="dropdown-content">
                        <a href="../users/profile.html">Profile</a>
                        <a href="../synchronize.html">Synchronize</a>
                        <a href="../tracking/tracking.html">Tracking</a>
                        <a href="goals.html">Goals</a>
                        <a href="../reports/reports.html">Reports</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>FLEX</h1>
            <br>
        	<h2>Fitness Goals</h2>
        	
        	<form method="POST" action=""> <!-- add php -->				
	 			<label for="goalType">Type of Fitness<sup>*</sup>: </label>
	 				<select id="goalType" name="goalType" onchange="check(this);">
						<option value="-1">Select</option>  
						<option value="0">Cardio</option>
	  					<option value="1">Strength</option>
	  					<option value="2">Weight Gain/Loss</option>
                    </select>
                
                <br><br>
					
					<!--Cardio Types-->
					<div id="ifCardio" style="display: none;">
						<label for="cardioType">Type of Cardio<sup>*</sup>: </label>
                        <select id="cardioType" name="cardioType" onchange="check2(this);">
                        	<option value="-1">Select</option>
                            <option value="distance">Distance</option>
                            <option value="speed">Speed</option>
                            <option value="time">Time</option>
                        </select>
                    </div>
                    
                <br>
						
					<div id="ifDistance" style="display:none;">
						<label for="distance">Goal Distance<sup>*</sup>: </label>
					    	<input type="text" name="distance" id="distance" size="5"> Miles<br><br>
					</div>
					<div id="ifSpeed" style="display:none;">
						<label for="speed">Goal Speed<sup>*</sup>: </label>
							<input type="text" name="speed" id="speed" size="5"> MPH<br><br>
					</div>
					<div id="ifTime" style="display:none;">
						<label for="time">Goal Time<sup>*</sup>: </label>
							<input type="text" name="time" id="time" size="5"> Minutes<br><br>
					</div>
					
					<!--Strength Types-->
					<div id="ifStrength" style="display: none;">
						<label for="strengthType">Type of Weight Training<sup>*</sup>: </label>
                        <select id="strengthType" name="strengthType">
                        	<option value="-1">Select</option>
                            <option value="biceps">Bicep Curl</option>
                            <option value="chest">Chest Press</option>
                            <option value="deadlift">Deadlift</option>
                            <option value="squats">Squat</option>
                        </select>
						
						<input type="text" name="maxWeight" id="maxWeight" size="5"> lbs<br><br><br>
					</div>
					
					<div id="ifWeight" style="display: none;"> 
						<label for="weightType">Gain or Loss<sup>*</sup>: </label>
						<select id="weightType" name="weightType">
                            <option value="-1">Select</option>
                            <option value="gain">Weight Gain</option>
                            <option value="loss">Weight Loss</option>
                        </select><br>
                        
                        <label for="weightDif">Weight Difference<sup>*</sup>: </label>
						<input type="text" name="weightDif" id="weightDif" size="5"> lbs<br><br><br>
					</div>
					
				<label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
 					<input type="text" name="numDays" id="numDays" size="5"> Day(s)<br><br>
 				
 				<button type="submit"  value="Submit">Add Goal</button>
            </form>	
        </main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block">
            <br>1073 North Benson Road
            <br>Fairfield, CT 06824
            </div>
        </footer>       
    </body>
</html>