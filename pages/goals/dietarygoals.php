<?php
    //check if session is already running
	if(!isset($_SESSION)) 
    { 
        session_start();
    }//end if
	
	//if no session is active, redirect to login page
    $phpFolderPath = "../../php/";
    $logoutFile = $phpFolderPath."logout.php";
    require("../../php/IsLoggedIn.php");

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
            function show(element) 
            {
                if (element.value == 0) 
                {
                    document.getElementById("ifCalories").style.display = "block";
                    document.getElementById("ifWater").style.display = "none";
                }//end if
                else if (element.value == 1) 
                {
                    document.getElementById("ifWater").style.display = "block";
                    document.getElementById("ifCalories").style.display = "none";   
                }//end else
            }//close check
        </script>
    </head>
    
    <body>
        <header>
            <a href="../home.html"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
            <nav>
                <ul>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Menu</a>
                        <div class="dropdown-content">
                        <a href="../users/profile.html">Profile</a>
                        <a href="synchronize.html">Synchronize</a>
                        <a href="../tracking/tracking.html">Tracking</a>
                        <a href="goals.html">Goals</a>
                        <a href="../reports/reports.html">Reports</a>
                        <a href="../../php/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
        	<h1>FLEX</h1>
            <br>
            <h2>Dietary Goals</h2>

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
                    <div style="color: green; padding: 20px;">Dietary Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateDietaryGoal.php">				
	 			<label for="goalType">Type of Goal<sup>*</sup>: </label>
	 				<select id="goalType" name="goalType" onchange="show(this);">
						<option value="-1">Select</option>  
						<option value="0">Calorie Intake</option>
	  					<option value="1">Water Intake</option>
                    </select>
                
                <br><br>
					
                <div id="ifCalories" style="display:none;">
                    <label for="calories">Daily Calorie Intake Goal<sup>*</sup>: </label>
                        <input type="text" name="calories" id="calories" size="6"> Calories<br><br>
                </div>
					
                <div id="ifWater" style="display:none;">
                    <label for="water">Daily Water Intake Goal<sup>*</sup>: </label>
                        <input type="text" name="water" id="water" size="6"> Ounces<br><br>
                </div>
					
                <!-- this is unneeded since the goals are daily. So, numDays always == 1
                    <label for="numDays">Number of Days to Achieve Goal<sup>*</sup>: </label>
                        <input type="text" name="numDays" id="numDays" size="5"> Day(s)
                -->
                
                <br><br>
 						
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