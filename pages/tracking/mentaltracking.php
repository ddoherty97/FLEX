<?php
	/**
     * Mental Tracking Front End (mentaltracking.php)
     * This creates the user interface to record the user's mental health activities
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
        <script src="../../javascript/mentaltracking.js"></script>
        
         <script>
            function check(that) 
            {
                if (that.value == "COUNSELING") 
                {
                    document.getElementById("ifCounseling").style.display = "block";
                    document.getElementById("ifStress").style.display = "none";
                } //end if
                else if (that.value == "STRESS") 
                {
                    document.getElementById("ifStress").style.display = "block";
                    document.getElementById("ifCounseling").style.display = "none";
                }//end if
                else if (that.value == "BOTH") 
                {
                    document.getElementById("ifCounseling").style.display = "block";
                    document.getElementById("ifStress").style.display = "block";
                }//end if
                else
                {
                    document.getElementById("ifCounseling").style.display = "none";
                    document.getElementById("ifStress").style.display = "none";
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
			<h2>Mental Health Tracking</h2>
			
			<?php
                //display status of last data recording result
                if($result=="f")
                {
            ?>
                    <div style="color: red; padding: 20px;">THERE WAS AN ERROR RECORDING YOUR ACTIVITY.</div>
            <?php
                }//end if
                else if($result=="s")
                {
            ?>
                    <div style="color: green; padding: 20px;">Mental Activity Recorded</div>
            <?php
                }//end if
            ?>
			<p>Lets track some of your Mental Health Activities!</p>

			<form action="../../php/CreateMentalData.php" method="POST" onsubmit="return validateMentalTrackingSubmission();">
                <div>
                    <label for = "date">Date</label><sup>*</sup>: 
                        <input type="date" id = "date" name="date">
                </div>
				<div class="errorMSG" id="date_error">You must enter a date in the format YYYY-MM-DD.</div>
                    <br>
                <div>
                    <label for="type">Start Time<sup>*</sup>: </label>
                        <input type="time" id="sTime" name="sTime">
                </div>
				<div class="errorMSG" id="sTime_error">You must enter a start valid time.</div>
                    <br>
                <div>
                    <label for="type">End Time<sup>*</sup>: </label>
                        <input type="time" id="eTime" name="eTime">
                </div>
				<div class="errorMSG" id="eTime_error">You must enter a end valid time.</div>
                    <br>
                <div>
                    <select id="dataType" name="dataType" onchange="check(this);">
                        <option value="-1">Select</option>  
                        <option value="COUNSELING">Enter Counseling Information</option>
                        <option value="STRESS">Enter Stress Level</option>
                        <option value="BOTH">Enter Counseling &amp; Stress</option>
                    </select>
                </div>
                <div class="errorMSG" id="type_error">You must select a data type to track.</div>
                
                <div id="ifCounseling" style="display: none;">
                    <br>
                    <div>
                        <label for="type">Type of Counseling<sup>*</sup>: </label>
                            <input type="text" id="notes" name="notes">
                    </div>
					<div class="errorMSG" id="cNotes_error">You must enter the counseling type.</div>
                        <br>
                    <div>
                        <label for="textarea">Counseling Notes: </label>
                            <textarea rows="4" id="textarea" name="other" cols="20"></textarea>
                    </div>
                </div>
                
				<div id="ifStress" style="display: none;">
                    <br>
                    <div>
                        <label for="type">Current Stress Level<sup>*</sup>: </label>
                            <select name="level" id="level">
                                <option value="-1">Select</option>
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
                    </div>
					<div class="errorMSG" id="stress_error">You must select a stress level.</div>
                        <br>
                    <div>
                        <label for="type">Factors Contributing to Stress Level: </label>
                            <textarea rows="4" id="textarea1" name="factors" cols="20"></textarea>
                    </div>	
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