<?php
	 /**
     * Social Tracking Front End (socialtracking.php)
     * This creates the user interface to record the user's social activities
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
			<h2>Social Tracking</h2>
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
                    <div style="color: green; padding: 20px;">Social Activity Recorded</div>
            <?php
                }//end if
            ?>
			<p>Lets track your Social Activity!<br></p>

			<form action="../../php/CreateSocialData.php" method="POST">
				<label for="type">Name of event : </label>
					<input type="text" id = "title" name="title">
				<br>
				<br>
				<label for = "date">Date </label> : 
					<input type="date" id = "date" name="date" >
				<br>
				<br>
				<label for="type">Start Time : </label>
					<input type="time" id = "sTime" name="sTime">
				<br>
				<br>
				<label for="type">End Time : </label>
					<input type="time" id = "eTime" name="eTime">
				<br>
				<br>
				<label for="type">Where did this event take place : </label>
					<input type="text" id = "location" name="location">
				<br>
				<br>
				<label for="type">What type of event did you attend? : </label>
					<input type="text" id = "type" name="type">
				<br>
				<br>
				<label for="textarea">Any other notes you have about this activity : </label>
					<textarea rows="4" id="textarea" name="notes" cols="20"></textarea>
				<br>
				<br>
  				<input type="submit" value="Submit">
			</form>

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