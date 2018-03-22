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
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a> <!--  -->
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
        	<br>
            <h2>Social Goals</h2>

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
                    <div style="color: green; padding: 20px;">Social Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action=""> <!-- add php -->				
	 			<label for="eventType">Type of Social Event<sup>*</sup>: </label>
	 				<select id="eventType" name="eventType" onchange="check(this);">
						<option value="-1">Select</option>  
						<option value="0">Club Meeting</option>
	  					<option value="1">Fairfield at Night Event</option>
	  					<option value="2">RA Event</option>
	  					<option value="3">Sports Game/Event</option>
	  					<option value="4">Other</option>
					</select> <br><br>
					
					<div id="ifOther" style="display:none;">
						<label for="other">Event Type<sup>*</sup>: </label>
							<input type="text" name="other" id="other"><br><br>
					</div>
					
					<script>
					function check(that) 
					{
	                	if (that.value == 4) 
	                	{
	                    	document.getElementById("ifOther").style.display = "block";
	                  	}
	            	} //close check
	                </script>
	                
	                <label for="numDays">Goal Time to Spend on Activity<sup>*</sup>: </label>
 						<input type="text" name="numDays" id="numDays" size="5"> Hours<br><br>
	                
	                <label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
 						<input type="text" name="numDays" id="numDays" size="5"> Day(s)<br><br>
 						
 					<button type="submit"  value="Submit">Submit</button>
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