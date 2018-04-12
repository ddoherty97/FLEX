<?php
	/**
     * Screen Time Tracking Front End (screentimetracking.php)
     * This creates the user interface to record the user's screen time information
     * Author: John Wiley
     * Last Updated: 4/3/18 JC
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
			<h2>Screen Time Tracking</h2>
			
			 <?php
                //display status of last data recording result
                if($result=="f")
                {
            ?>
                    <div style="color: red; padding: 20px;">THERE WAS AN ERROR RECORDING YOUR INFORMATION.</div>
            <?php
                }//end if
                else if($result=="s")
                {
            ?>
                    <div style="color: green; padding: 20px;">Screen Time Information Recorded</div>
            <?php
                }//end if
            ?>
			<p>Lets track your Device Usage!<br></p>

			<form action="../../php/CreateScreenTimeData.php" method="POST">
				<label for = "date">Date </label> : 
					<input type="date" id = "date" name="date">
				<br>
				<br>
				<label for="speed">Time Spent on Device<sup>*</sup>: </label>
					<input type="text" name="time" id="time" size="7"> minutes<br><br>
				
				<label for="type">Type of device Used: </label>
					<select name="device">
		  				<option value="Phone">Phone</option>
		  				<option value="Computer">Computer/Laptop</option>
		  				<option value="Tablet">Tablet</option>
		  				<option value="TV">TV</option>
		  				<option value="Gaming System">Gaming System</option>
  					</select>
  				<br>
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