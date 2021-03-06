<?php
	/**
     * Goals Front End (goals.php)
     * This creates the user interface of the main goals page.  
	 * Links direct the user to a specific goal page.
	 * Initially assigned to Muhammad Mubasit
     * Author: Jaclyn Cuevas
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
                <a href="goals.php">Goals</a>
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
            <a href="dietarygoals.php" style="text-decoration: none; ">Dietary Goals</a><br><br>
            <a href="fitnessgoals.php" style="text-decoration: none; ">Fitness Goals</a><br><br>
            <a href="mentalgoals.php" style="text-decoration: none; ">Mental Goals</a><br><br>
            <a href="screentimegoals.php" style="text-decoration: none; ">Screen Time Goals</a><br><br>
            <a href="socialgoals.php" style="text-decoration: none; ">Social Goals</a><br><br>
            <a href="spiritualgoals.php" style="text-decoration: none; ">Spiritual Goals</a><br><br>
            
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