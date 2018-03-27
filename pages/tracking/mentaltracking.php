<?php
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
        <main>
        		<h1> FLEX </h1>
			<h2>Mental Health Tracking</h2>
			<p>
				Lets track some of your Mental Health Activities!
			</p>

			<form action="/action_page.php">


				
				<label for = "date">Date </label>
				<br>
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
				<label for="type">What was the purpose of this activity? : </label>
				<textarea rows="4" id="textarea1" cols="20">
				</textarea>
				<br>
				<br>
				<label for="type">Set current Stress level : </label>
				<select>
  				<option value="1">1</option>
  				<option value="2">2</option>
  				<option value="3">3</option>
  				<option value="4">4</option>
  				<option value="5">5</option>
  				<option value="6">6</option>
  				<option value="7">7</option>
  				<option value="8">8</option>
  				<option value="9">9</option>
  				<option value="10">10</option>
  				
</select>
<br>
<br>
		<label for="type">Please list factors for given stress level : </label>
				<textarea rows="4" id="textarea1" cols="20">
				</textarea>
				<br>
				<br>	
				
				<label for="textarea">Any other notes you have about this activity : </label>
				<textarea rows="4" id="textarea" cols="20">

				</textarea>
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