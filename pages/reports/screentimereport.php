<?php
	/**
     * Screen Time Report (screentimereport.php)
     * This creates the user interface of the user's screen time report.
	 * Initally assigned to Sarah Kurtz
     * Author: Jaclyn Cuevas
     * Last Updated: 4/9/18 JC
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

		//create date objects for dietary report module
		$startDate = date_create($_GET['start']);
		$endDate = date_create($_GET['end']);

		//dietary report module dependency
		require_once($phpFolderPath."ScreenTimeReportModule.php");
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
        	<h2>Screen Time Report</h2><br>
		
	<?php
		//only show if report dates specified
		if($runReport)
		{
			//create screen time report module and generate report
			require_once($phpFolderPath."ScreenTimeReportModule.php");
			$reportModule = new ScreenTimeReportModule();
			$report = $reportModule->getScreenTimeReport($startDate, $endDate);

			//display report details
			echo "<h3>Screen Time Report From ".date_format($report->getStartDate(),"m/d/Y")." to ".date_format($report->getEndDate(),"m/d/Y")."</h3>";
			
			//get screen time entries
			$entries = $report->getScreenTimeEntries();

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
					echo "<strong>".$entries[$i]->getDuration()."</strong> minutes spent on a <em> ".$entries[$i]->getType()."</em><br>";
				}//end for

				echo "</div>";
			}//end if

			//if no data entries
			else
			{
				echo "<div class='reportError'>There are no screen time entries between ".date_format($report->getStartDate(),"m/d/Y")." and ".date_format($report->getEndDate(),"m/d/Y")."</div>";
			}//end if

			//get screen time goals and progresses
			$stGoals = $report->getScreenTimeGoals();
			$stProgress = $report->getScreenTimeProgresses();

			//if there are any goals to show
			if(count($stGoals) > 0)
			{
				echo "<br>";
				echo "<h3>Current Goal Status</h3>";
				echo "<div class='goals'>";

				//display all active screen time goals
				for($i=0; $i<count($stGoals); $i++)
				{
					//hide separation bar if first item
					if($i!=0)
					{			
						echo "<hr>";
					}//end if

					echo $stGoals[$i]->getMinutes()." minutes in ".$stGoals[$i]->getNumDays()." day(s)<br>";
					echo "<progress value=".($stProgress[$i]*100)." max='100'></progress><br>";
					echo ($stProgress[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveScreenTimeGoal.php?goalID=".$stGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for
					
				echo "</div>";
			}//end if

			//if there are no goals to show
			else
			{
				echo "<div class='reportError'>There are no active screen time goals";
			}//end else
		}//end if
		
		//if not running report
		else
		{
	?>
			<div class="reportError">
				We're sorry, but there was an error generating your screen time report. We could not find a start and end date!
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