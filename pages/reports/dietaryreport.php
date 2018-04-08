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
        	<h2>Dietary Report</h2><br>

			<h3>Data Entries</h3>
			<div style="display: block; width: 100%; height: 100px; margin: 15px; border: 3px solid #e03a3e; overflow:scroll">
				Entry 1 <br>
				Date: 03/14/2018<br>
				Description: Fruit<br>
				Calories Consumed: 250<br>
				Water Consumed: 10<br>
				<hr>
				Entry 2<br>
				Date: 03/14/2018<br>
				Description: Only Liquid Consumed<br>
				Calories Consumed: 0<br>
				Water Consumed: 20 <br>
				<hr>
				Entry 3<br>
				Date: 03/15/2018<br>
				Description: Cereal<br>
				Calories Consumed: 200<br>
				Water Consumed: 15 <br>
			</div>
			
			<h3>Goals & Progress</h3>
			<div style="display: block; width: 100%; height: 100px; margin: 15px; border: 3px solid #e03a3e; overflow:scroll">
				Calorie Goal 1<br>
				Description: 3500 calories in 1 day(s)<br>
				Progress: 30%<br>
				<hr>
				Calorie Goal 2<br>
				Description: 2500 calories in 1 day(s)<br>
				Progress: 90%<br>
				<hr>
				Water Goal 1<br>
				Description: 60 ounces in 1 day(s)<br>
				Progress: 50%<br>
			</div>
			
			
        </main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block"><br>1073 North Benson Road<br>Fairfield, CT 06824</div>
        </footer>
        </body>
</html>