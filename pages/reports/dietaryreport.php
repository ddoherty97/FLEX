<?php
	/**
     * Dietary Report (dietaryreport.php)
     * This creates the user interface of the user's dietary report.
	 * Initally assigned to Sarah Kurtz
     * Author: Jaclyn Cuevas
     * Last Updated: 4/8/18 JC
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
	
	//get result of last report creation
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
            <a href="home.html"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        <nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                <a href="../users/profile.html">Profile</a>
                <a href="synchronize.html">Synchronize</a>
                <a href="tracking.html">Tracking</a>
                <a href="../goals/goals.html">Goals</a>
                <a href="../reports/reports.html">Reports</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
			<h1>FLEX</h1>
        	<h2>Dietary Report</h2><br>

			<h3>Data Entries</h3>
			<div style="float: left; width: 95%; height: 75px; margin: 15px; border: 3px solid #e03a3e; overflow:scroll">
				This will include data entires for dietary information. 
				How many words until i can see the scroll bar.
				i hope this works but idk if it looks good.
			</div>
			
			<h3>Goals</h3>
			<div style="float: left; width: 95%; height: 75px; margin: 15px; border: 3px solid #e03a3e; overflow:scroll">
				This will include goals
			</div>
			
			<h3>Progress</h3>
			<div style="float: left; width: 95%; height: 75px; margin: 15px; border: 3px solid #e03a3e; overflow:scroll">
				This will include progress
			</div>
			
			
			
        </main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block">1073 North Benson Road<br>Fairfield, CT 06824</div>
        </footer>
        </body>
</html>