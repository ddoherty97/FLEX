<?php
	 /**
     * Dietary Goals Front End (dietarygoals.php)
     * This creates the user interface to record the user's dietary goals
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
        <script src="../../javascript/dietarygoals.js"></script>

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
                }//end else if 
                else if (element.value == -1) 
                {
                    document.getElementById("ifWater").style.display = "none";
                    document.getElementById("ifCalories").style.display = "none";   
                }//end else
            }//close check
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
            <h2>Dietary Goals</h2>
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
                    <div style="color: green; padding: 20px;">Dietary Goal Created!</div>
            <?php
                }//end if
            ?>
        	
        	<form method="POST" action="../../php/CreateDietaryGoal.php" onsubmit="return validateDietaryGoalSubmission();">				
                <div> 
                    <label for="goalType">Type of Goal<sup>*</sup>: </label>
                        <select id="goalType" name="goalType" onchange="show(this);">
                            <option value="-1">Select</option>  
                            <option value="0">Calorie Intake</option>
                            <option value="1">Water Intake</option>
                        </select>
                </div>
                <div class="errorMSG" id="type_error">You must select a type of goal.</div>
					
                <div id="ifCalories" style="display:none;">
                    <br>
                    <div>
                        <label for="calories">Daily Calorie Intake Goal<sup>*</sup>: </label><br>
                            <input type="text" name="calories" id="calories" size="6"> Calories
                    </div>
                    <div class="errorMSG" id="calorie_error">You must enter the goal number of calories.</div>
                </div>
					
                <div id="ifWater" style="display:none;">
                    <br>
                    <div>
                        <label for="water">Daily Water Intake Goal<sup>*</sup>: </label><br>
                            <input type="text" name="water" id="water" size="6"> Ounces
                    </div>
                    <div class="errorMSG" id="water_error">You must enter the goal number of ounces of water.</div>
                </div>
                 
                <br>
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