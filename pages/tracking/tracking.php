<?php
	/**
     * Tracking Front End (tracking.php)
     * This creates the user interface of the main tracking page.  
	 * Links direct the user to a specific tracking page.
     * Author: John Wiley
     * Last Updated: 4/11/18 JC
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
        <br>
        <main style="font-size: 20px; font-weight: bold;">
            <img src="../../images/stag.png" alt="Stag" height="100px" width="100px"><br><br>
            <a href="dietarytracking.php" style="text-decoration: none; ">Dietary Tracking</a><br><br>
            <a href="fitnesstracking.php" style="text-decoration: none; ">Fitness Tracking</a><br><br>
            <a href="mentaltracking.php" style="text-decoration: none; ">Mental Tracking</a><br><br>
            <a href="screentimetracking.php" style="text-decoration: none; ">Screen Time Tracking</a><br><br>
            <a href="socialtracking.php" style="text-decoration: none; ">Social Tracking</a><br><br>
            <a href="spiritualtracking.php" style="text-decoration: none; ">Spiritual Tracking</a><br><br>
            
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