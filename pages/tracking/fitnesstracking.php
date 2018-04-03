<?php
 	/**
     * Fitness Tracking Front End (fitnesstracking.php)
     * This creates the user interface to record the user's fitness activities
     * Author: John Wiley
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

        <script>
            function check(that) 
            {
                if (that.value == "CARDIO") 
                {
                    document.getElementById("ifCardio").style.display = "block";
                    document.getElementById("ifStrength").style.display = "none";
                } //end if
                else if (that.value == "STRENGTH") 
                {
                    document.getElementById("ifStrength").style.display = "block";
                    document.getElementById("ifCardio").style.display = "none";
                }//end if
                else
                {
                    document.getElementById("ifCardio").style.display = "none";
                    document.getElementById("ifStrength").style.display = "none";
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
        	<h1> FLEX </h1>
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

			<form action="../../php/CreateFitnessData.php" method="POST">
				<label for = "date">Date</label><sup>*</sup>: 
					<input type="date" id = "date" name="date" >
				<br>
				<br>
				<label for="type">Start Time</label><sup>*</sup>:
					<input type="time" id = "sTime" name="sTime">
				<br>
				<br>
				<label for="type">End Time</label><sup>*</sup>:
					<input type="time" id = "eTime" name="eTime">
				<br>
				<br>
				<label for="goalType">Type of Fitness<sup>*</sup>: </label>
	 				<select id="goalType" name="goalType" onchange="check(this);">
						<option value="-1">Select</option>  
						<option value="CARDIO">Cardio</option>
	  					<option value="STRENGTH">Strength</option>
                    </select>
                <br>
                <br>	
					<!--Cardio Types-->
					<div id="ifCardio" style="display: none;">
						<label for="cardioType">Type of Cardio<sup>*</sup>: </label>
                        <select id="cardioType" name="cardioType">
                        	<option value="-1">Select</option>
                            <option value="DISTANCE">Distance</option>
                            <option value="SPEED">Speed</option>
                            <option value="TIME">Time</option>
                        </select>
                    </div>    	
					<!--Strength Types-->
					<div id="ifStrength" style="display: none;">
						<label for="strengthType">Type of Weight Training<sup>*</sup>: </label>
                        <select id="strengthType" name="strengthType">
                        	<option value="-1">Select</option>
                            <option value="BICEP">Bicep Curl</option>
                            <option value="CHEST">Chest Press</option>
                            <option value="DEADLIFT">Deadlift</option>
                            <option value="SQUAT">Squat</option>
                        </select>
					</div>
				<br>
				<label for="textarea">Other Notes</label>:
					<textarea rows="4" id="textarea" name="notes" cols="30"></textarea>
				<br>
				<br>
				<input type="submit" value="Submit">
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
