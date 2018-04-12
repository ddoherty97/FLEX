<?php
	/**
     * Mental Report (mentalreport.php)
     * This creates the user interface of the user's mental report.
	 * Initally assigned to Sarah Kurtz
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
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

		//create date objects for mental report module
		$startDate = date_create($_GET['start']);
		$endDate = date_create($_GET['end']);

		//dietary mental module dependency
		require_once($phpFolderPath."MentalReportModule.php");
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
		<link rel="stylesheet" href="../../css/reportstyle.css">
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
        	<h2>Mental Health Report</h2><br>

		<?php
		//only show if report dates specified
		if($runReport)
		{
			//create mental report module and generate report
			require_once($phpFolderPath."MentalReportModule.php");
			$reportModule = new MentalReportModule();
			$report = $reportModule->getMentalReport($startDate, $endDate);

			//mental report details
			echo "<h3>Mental Report From ".date_format($report->getStartDate(),"m/d/Y")." to ".date_format($report->getEndDate(),"m/d/Y")."</h3>";
			
			//get mental entries
			$entries = $report->getMentalEntries();

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
					
					//if a counseling entry
					if($entries[$i]->getDuration() != "0")
					{
						echo "<strong>".$entries[$i]->getDuration()."</strong> Minute ".$entries[$i]->getType()." Counseling Session<br>";
						echo "<em>Session Notes:</em> ".$entries[$i]->getNotes()."<br>";
					}//end if
					
					//if a stress entry
					if($entries[$i]->getLevel() != "0")
					{
						if($entries[$i]->getDuration() != "0")
						{
							echo "<br>";
						}//end if

						echo "Stress Level: <strong>".$entries[$i]->getLevel()."</strong><br>";
						echo "<em>Stress Factors:</em> ".$entries[$i]->getFactors()."<br>";
					}//end if
				}//end for

				echo "</div>";
			}//end if

			//if no data entries
			else
			{
				echo "<div class='reportError'>There are no mental entries between ".date_format($report->getStartDate(),"m/d/Y")." and ".date_format($report->getEndDate(),"m/d/Y")."</div>";
			}//end if

			//get counseling and stress goals and progresses
			$cGoals = $report->getCounselingGoals();
			$sGoals = $report->getStressGoals();
			$cProgresses = $report->getCounselingProgresses();
			$sProgresses = $report->getStressProgresses();

			//if there are any goals to show
			if((count($cGoals)+count($sGoals)) > 0)
			{
				echo "<br>";
				echo "<h3>Current Goal Status</h3>";
				echo "<div class='goals'>";

				//display all active counseling goals
				for($i=0; $i<count($cGoals); $i++)
				{
					//hide separation bar if first item
					if($i!=0)
					{			
						echo "<hr>";
					}//end if

					echo $cGoals[$i]->getMinutes()." minutes of counseling in ".$cGoals[$i]->getNumDays()." day(s)<br>";
					echo "<progress value=".($cProgresses[$i]*100)." max='100'></progress><br>";
					echo ($cProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveMentalGoal.php?goalID=".$cGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for

				//display all active stress goals
				for($i=0; $i<count($sGoals); $i++)
				{
					//hide separation bar if first overall item
					if(count($cGoals)>0 || $i!=0)
					{			
						echo "<hr>";
					}//end if

					echo "Stress Level of ".$sGoals[$i]->getLevel()." for ".$sGoals[$i]->getNumDays()." day(s)<br>";
					echo "<progress value=".($sProgresses[$i]*100)." max='100'></progress><br>";
					echo ($sProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveMentalGoal.php?goalID=".$sGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for
					
				echo "</div>";
			}//end if

			//if there are no goals to show
			else
			{
				echo "<div class='reportError'>There are no active mental goals";
			}//end else
		}//end if
		
		//if not running report
		else
		{
	?>
			<div class="reportError">
				We're sorry, but there was an error generating your mental report. We could not find a start and end date!
			</div>
	<?php
		}//end else
	?>

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