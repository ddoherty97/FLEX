<?php
	/**
     * Spiritual Goals Front End (dietarygoals.php)
     * This creates the user interface to record the user's spirutual goals
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

		<script>			
			function check(that) 
			{
				if (that.value == 0) 
				{
					document.getElementById("ifDuration").style.display = "block";
					document.getElementById("ifEvents").style.display = "none";
				}
				else if (that.value == 1) 
				{
					document.getElementById("ifEvents").style.display = "block";
					document.getElementById("ifDuration").style.display = "none";
				}
				else
				{
					document.getElementById("ifEvents").style.display = "none";
					document.getElementById("ifDuration").style.display = "none";
				}
			}		
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
                <a href="../tracking/tracking.php">Tracking</a>
                <a href="goals.php">Goals</a>
                <a href="../reports/reports.php">Reports</a>
                <a href="../../php/logout.php">Logout</a>
                </div>
            </li>
        </ul>
        </nav>
        </header>
        <main>
        	<h1>FLEX</h1>
        	<h2>Spiritual Goals</h2>
			<br>

			<?php
                //display status of last goal creation result
                if($result=="f")
                {
            ?>
                    <div style="color: red; padding: 20px;">THERE WAS AN ERROR CREATING YOUR GOAL.</div>
            <?php
                }//end if
                else if($result=="s")
                {
            ?>
                    <div style="color: green; padding: 20px;">Spiritual Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateSpiritualGoal.php">
				<label for="spiritualGoalType">Spiritual Goal Type<sup>*</sup>: </label>
	 				<select id="spiritualGoalType" name="spiritualGoalType" onchange="check(this);">
						<option value="-1">Select</option>  
			  			<option value="0">Duration</option>
						<option value="1">Events</option>
					</select> <br><br>
        	
        		<div id="ifDuration" style="display:none;">
					<label for="durationGoal">Spiritual Duration Goal<sup>*</sup>: </label>
						<input type="text" name="durationGoal" id="durationGoal" size="5"> Minutes<br>
				</div>

				<div id="ifEvents" style="display:none;">
					<label for="eventGoal">Spiritual Events Goal<sup>*</sup>: </label>
						<input type="text" name="eventGoal" id="eventGoal" size="5"> Events<br>
				</div>
				
				<label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
 					<input type="text" name="numDays" id="numDays" size="5"> Day(s)<br><br>
 						
 				<input type="submit"  value="Add Goal">
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