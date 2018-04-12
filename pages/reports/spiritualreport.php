<?php
	/**
     * Spiritual Report (spiritualreport.php)
     * This creates the user interface of the user's spiritual report.
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

		//create date objects for spiritual report module
		$startDate = date_create($_GET['start']);
		$endDate = date_create($_GET['end']);

		//spiritual report module dependency
		require_once($phpFolderPath."SpiritualReportModule.php");
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
        	<h2>Spiritual Report</h2><br>

			<?php
		//only show if report dates specified
		if($runReport)
		{
			//create spiritual report module and generate report
			require_once($phpFolderPath."SpiritualReportModule.php");
			$reportModule = new SpiritualReportModule();
			$report = $reportModule->getSpiritualReport($startDate, $endDate);

			//display report details
			echo "<h3>Spiritual Report From ".date_format($report->getStartDate(),"m/d/Y")." to ".date_format($report->getEndDate(),"m/d/Y")."</h3>";
			
			//get spiritual entries
			$entries = $report->getSpiritualEntries();

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
					echo "<em>".$entries[$i]->getTitle()."</em><br>";
					echo "Type of Activity: <em>".$entries[$i]->getType()."</em><br>";
					echo "Location: <em>".$entries[$i]->getLocation()."</em><br>";
					echo "Time Spent: <strong>".$entries[$i]->getDuration()."</strong> Minutes<br>";
				}//end for
				echo "</div>";
			}//end if

			//if no data entries
			else
			{
				echo "<div class='reportError'>There are no spiritual entries between ".date_format($report->getStartDate(),"m/d/Y")." and ".date_format($report->getEndDate(),"m/d/Y")."</div>";
			}//end if

			//get spiritual duration and event goals and progresses
			$dGoals = $report->getDurationGoals();
			$eGoals = $report->getEventGoals();
			$dProgresses = $report->getDurationProgresses();
			$eProgresses = $report->getEventProgresses();

			//if there are any goals to show
			if((count($dGoals) + count($eGoals)) > 0)
			{
				echo "<br>";
				echo "<h3>Current Goal Status</h3>";
				echo "<div class='goals'>";

				//display all active spiritual duration goals
				for($i=0; $i<count($dGoals); $i++)
				{
					//hide separation bar if first item
					if($i!=0)
					{			
						echo "<hr>";
					}//end if

					echo $dGoals[$i]->getMinutes()." minutes in ".$dGoals[$i]->getNumDays()." day(s)<br>";
					echo "<progress value=".($dProgresses[$i]*100)." max='100'></progress><br>";
					echo ($dProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveSpiritualGoal.php?goalID=".$dGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for

				//display all active spiritual event goals
				for($i=0; $i<count($eGoals); $i++)
				{
					//hide separation bar if first overall item
					if(count($eGoals)>0 || $i!=0)
					{			
						echo "<hr>";
					}//end if

					echo "Attend ".$eGoals[$i]->getEvents()." events in ".$eGoals[$i]->getNumDays()." day(s)<br>";
					echo "<progress value=".($eProgresses[$i]*100)." max='100'></progress><br>";
					echo ($eProgresses[$i]*100)."% Complete<br><br>";
					
					//remove button
					echo "<a href='../../php/RemoveSpiritualGoal.php?goalID=".$eGoals[$i]->getID()."'>";
					echo "<input type='button' value='Delete Goal'>";
					echo "</a>";
				}//end for
					
				echo "</div>";
			}//end if

			//if there are no goals to show
			else
			{
				echo "<div class='reportError'>There are no active spiritual goals";
			}//end else
		}//end if
		
		//if not running report
		else
		{
	?>
			<div class="reportError">
				We're sorry, but there was an error generating your spiritual report. We could not find a start and end date!
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