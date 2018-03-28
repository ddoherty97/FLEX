<?php
	/**
     * Dietary Tracking Front End (dietarytracking.php)
     * This creates the user interface to record the user's dietary information
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
			<h2>Dietary Tracking</h2>
			
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
                    <div style="color: green; padding: 20px;">Dietary Information Recorded</div>
            <?php
                }//end if
            ?>
			<p>Lets track your Diet!<br></p>

			<form action="/action_page.php">
				<label for="type">Type of food consumed : </label>
					<input type="text" id = "title" name="title">
				<br>
				<br>
				<label for="type">Time of consumption : </label>
					<input type="time" id = "Time" name="Time">
				<br>
				<br>
				<label for="type">Calories Consumed : </label>
					<input type="text" id = "title" name="title">
				<br>
				<br>
				<label for="type">Ounces of Water Consumed : </label>
					<input type="text" id = "title" name="title">
				<br>
				<br>
				<input type="submit" value="Submit">
			</form>

        </main>
        <footer>
            <br>
            <div style="float: left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block">
            <br>1073 North Benson Road
            <br>Fairfield, CT 06824
            </div>
        </footer>
    </body>
</html>