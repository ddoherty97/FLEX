<?php
	/**
     * Dietary Tracking Front End (dietarytracking.php)
     * This creates the user interface to record the user's dietary information
     * Author: John Wiley
     * Last Updated: 4/18/18 DD
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
        <script src="../../javascript/dietarytracking.js"></script>
        
        <script>
            function check(that) 
            {
                if (that.value == "CALORIES") 
                {
                    document.getElementById("ifCalories").style.display = "block";
                    document.getElementById("ifOunces").style.display = "none";
                } //end if
                else if (that.value == "WATER") 
                {
                    document.getElementById("ifOunces").style.display = "block";
                    document.getElementById("ifCalories").style.display = "none";
                }//end if
                else if (that.value == "BOTH") 
                {
                    document.getElementById("ifCalories").style.display = "block";
                    document.getElementById("ifOunces").style.display = "block";
                }//end if
                else
                {
                    document.getElementById("ifCalories").style.display = "none";
                    document.getElementById("ifOunces").style.display = "none";
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

			<form action="../../php/CreateDietaryData.php" method="POST" onsubmit="return validateDietaryTrackingSubmission();">
                <div>
                    <label for = "date">Date</label><sup>*</sup>: 
                        <input type="date" id="date" name="date">
                </div>
				<div class="errorMSG" id="date_error">You must enter a date in the format YYYY-MM-DD.</div>
                    <br>
                <div>
                    <label for="type">Time of Consumption</label><sup>*</sup>: 
                        <input type="time" id="time" name="time">
                </div>
                <div class="errorMSG" id="time_error">You must enter a valid time.</div>
                    <br>
                <div>
                    <label for="dataType">Type of Consumption<sup>*</sup>: </label>
                        <select id="dataType" name="dataType" onchange="check(this);">
                            <option value="-1">Select</option>  
                            <option value="CALORIES">Calories</option>
                            <option value="WATER">Water</option>
                            <option value="BOTH">Both</option>
                        </select>
                </div>
                <div class="errorMSG" id="type_error">You must select a consumption type.</div>
                
                
                <div id="ifCalories" style="display: none;">
                        <br>
                    <div>
                        <label for="type">Item(s) Consumed<sup>*</sup>: </label>
                            <input type="text" id="type" name="type">
                    </div>
                    <div class="errorMSG" id="item_error">You must enter at least one item consumed.</div>
                        <br>
                    <div>
                        <label for="calories">Calories Consumed<sup>*</sup>: </label>
                            <input type="text" id="calories" name="calories">
                    </div>
                    <div class="errorMSG" id="calorie_error">You must enter the number of calories consumed.</div>
				</div>
				
				<div id="ifOunces" style="display: none;">
                        <br>
                    <div>
                        <label for="ounces">Ounces of Water Consumed: </label>
                            <input type="text" id="ounces" name="ounces">
                    </div>
                    <div class="errorMSG" id="water_error">You must enter the number of ounces consumed.</div>
                </div>
                
                <br>
				<input type="submit" value="Submit">
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