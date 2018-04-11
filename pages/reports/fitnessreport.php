<?php
	/**
     * Fitness Report (fitnessreport.php)
     * This creates the user interface of the user's fitness report.
	 * Initally assigned to Sarah Kurtz
     * Author: Jaclyn Cuevas
     * Last Updated: 4/11/18 JC
     **/

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
    //check if session is already running
	if(!isset($_SESSION)) 
    { 
        session_start();
    }//end if
	
	//if no session is active, redirect to login page
    $phpFolderPath = "../../php/";
    $logoutFile = $phpFolderPath."logout.php";
    require($phpFolderPath."IsLoggedIn.php");
	
	//get start and end dates of report
    if(isset($_GET['start']) && isset($_GET['end']))
    {
		//flag to ensure report is run
		$runReport = true;

		//create date objects for fitness report module
		$startDate = date_create($_GET['start']);
		$endDate = date_create($_GET['end']);

		//dietary report module dependency
		require_once($phpFolderPath."FitnessReportModule.php");
	}//end if
	
	//if report dates not submitted
	else
    {
		//flag to ensure error message is displayed
		$runReport = false;
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
        <br>
        <main>
        	<h1>FLEX</h1>
        	<h2>Fitness Report</h2><br>

	<?php
		//only show if report dates specified
		if($runReport)
		{
			//create fitness report module and generate report
			require_once($phpFolderPath."FitnessReportModule.php");
			$reportModule = new FitnessReportModule();
			$report = $reportModule->getFitnessReport($startDate, $endDate);

			//display report details
			echo "<h3>Fitness Report From ".date_format($report->getStartDate(),"m/d/Y")." to ".date_format($report->getEndDate(),"m/d/Y")."</h3>";
			
			//get fitness entries
			$entries = $report->getFitnessEntries();

			//if there are entries to show
			if(count($entries)>0)
			{
				echo "<h3>Data Entries</h3>";
				echo "<div class='entries'>";

				//display all entries in time frame
				for($i=0; $i<count($entries); $i++)
				{
					//hide separation bar if first item
					if($i!=0)
					{			
						echo "<hr>";
					}//end if
					
					echo "Entry on <em>".date_format($entries[$i]->getEntryDate(),"m/d/Y")."</em><br><br>";
					
					//if a cardio entry
					if($entries[$i]->substr(getType(), 0, 5) == "CARDIO")
					{
						if($entries[$i]->substr(getType(), 7) == "DISTANCE"){
							echo "<strong>".$entries[$i]->getMilestone()."</strong> Miles<br>";
						}
						if($entries[$i]->substr(getType(), 7) == "SPEED"){
							echo "<strong>".$entries[$i]->getMilsetone()."</strong> MPH<br>";
						}
						if($entries[$i]->substr(getType(), 7) == "TIME"){
							echo "<strong>".$entries[$i]->getMilsetone()."</strong> Minutes<br>";
						}
					}//end if
					
					//if a strength entry
					if($entries[$i]->substr(getType(), 0, 7) == "DISTANCE")
					{
						if($entries[$i]->substr(getType(), 9) == "BICEP"){
							echo "Bicep Curl <strong>".$entries[$i]->getMilestone()."</strong> Lbs<br>";
						}
						if($entries[$i]->substr(getType(), 9) == "CHEST"){
							echo "Chest Press <strong>".$entries[$i]->getMilestone()."</strong> Lbs<br>";
						}
						if($entries[$i]->substr(getType(), 9) == "DEADLIFT"){
							echo "Deadlift <strong>".$entries[$i]->getMilestone()."</strong> Lbs<br>";
						}
						if($entries[$i]->substr(getType(), 9) == "SQUAT"){
							echo "Squat <strong>".$entries[$i]->getMilestone()."</strong> Lbs<br>";
						}
					}//end if
					
					//if a weight entry
					if($entries[$i]->getType() == "WEIGHT")
					{
						echo "New Weight: <strong>".$entries[$i]->getMilestone()."</strong><br>";
					}//end if
				}//end for

				echo "</div>";
			}//end if

			//if no data entries
			else
			{
				echo "<div class='reportError'>There are no fitness entries between ".date_format($report->getStartDate(),"m/d/Y")." and ".date_format($report->getEndDate(),"m/d/Y")."</div>";
			}//end if

			//get calorie and water goals and progresses
			$cGoals = $report->getCardioGoals();
			$sGoals = $report->getStrengthGoals();
			$wGoals = $report->getWeightGoals();
			$cProgresses = $report->getCardioProgresses();
			$sProgresses = $report->getStrengthProgresses();
			$wProgresses = $report->getWeightProgresses();

			//if there are any goals to show
			if((count($cGoals)+count($sGoals)+count($wGoals)) > 0)
			{
				echo "<br>";
				echo "<h3>Current Goal Status</h3>";
				echo "<div class='goals'>";

				//display all active cardio goals
				for($i=0; $i<count($cGoals); $i++)
				{
					//hide separation bar if first item
					if($i!=0)
					{			
						echo "<hr>";
					}//end if

					if($cGoals[$i]->substr(getType(),7) == "DISTANCE"){
						echo $cGoals[$i]->getMilestone()." Miles in ".$cGoals[$i]->getNumDays()." day(s)<br>";
					}
					if($cGoals[$i]->substr(getType(),7) == "SPEED"){
						$cGoals[$i]->getMilestone()." MPH in ".$cGoals[$i]->getNumDays()." day(s)<br>";
					}
					if($cGoals[$i]->substr(getType(),7) == "TIME"){
						$cGoals[$i]->getMilestone()." Minutes in ".$cGoals[$i]->getNumDays()." day(s)<br>";
					}
					
					echo "<progress value=".($cProgresses[$i]*100)." max='100'></progress><br>";
					echo ($cProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveFitnessGoal.php?goalID=".$cGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for
				
				//display all active strength goals
				for($i=0; $i<count($sGoals); $i++)
				{
					//hide separation bar if first overall item
					if(count($cGoals)>0 || $i!=0)
					{			
						echo "<hr>";
					}//end if
					
					if($sGoals->substr(getType(), 9) == "BICEP"){
						echo "Bicep Curl ".$sGoals[$i]->getMilestone()." Lbs in ".$sGoals[$i]->getNumDays()." day(s)<br>";
					}
					if($sGoals->substr(getType(), 9) == "CHEST"){
						echo "Chest Press ".$sGoals[$i]->getMilestone()." Lbs in ".$sGoals[$i]->getNumDays()." day(s)<br>";
					}
					if($sGoals->substr(getType(), 9) == "DEADLIFT"){
						echo "Deadlift ".$sGoals[$i]->getMilestone()." Lbs in ".$sGoals[$i]->getNumDays()." day(s)<br>";
					}
					if($sGoals->substr(getType(), 9) == "SQUAT"){
						echo "Squat ".$sGoals[$i]->getMilestone()." Lbs in ".$sGoals[$i]->getNumDays()." day(s)<br>";
					}
					echo "<progress value=".($sProgresses[$i]*100)." max='100'></progress><br>";
					echo ($sProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveFitnessGoal.php?goalID=".$sGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for
				
				//display all active weight goals
				for($i=0; $i<count($wGoals); $i++)
				{
					//hide separation bar if first overall item
					if(count($sGoals)>0 || $i!=0)
					{			
						echo "<hr>";
					}//end if
					
					echo "Reach ".$wGoals[$i].getWeight()." Lbs in ".$wGoals[$i].getNumDays()." day(s)<br>";
					echo "<progress value=".($wProgresses[$i]*100)." max='100'></progress><br>";
					echo ($wProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveFitnessGoal.php?goalID=".$wGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for
					
				echo "</div>";
			}//end if

			//if there are no goals to show
			else
			{
				echo "<div class='reportError'>There are no active fitness goals";
			}//end else
		}//end if
		
		//if not running report
		else
		{
	?>
			<div class="reportError">
				We're sorry, but there was an error generating your fitness report. We could not find a start and end date!
			</div>
	<?php
		}//end else
	?>

        </main>
        <footer>
            <br>
            <div style="float:left; display: block;">&copy; 2018 <br>Fairfield University <br>School of Nursing</div>
            <div style="float: right; display: block"><br>1073 North Benson Road<br>Fairfield, CT 06824
            </div>
        </footer>
        </body>
</html>