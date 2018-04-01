<?php
	/**
     * Screen Time Report Module (ScreenTimeReportModule.php)
     * The purpose of the Spiritual Report Module is to display the user’s screen time progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 4/1/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("ScreenTimeGoalModule.php");
	
	class ScreenTimeReportModule
	{
        private $comMod;        //communication module to interact with database
        private $screenMod;     //screen time goal module
        private $dataOwner;     //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the screen time report module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication and screen time goal objects
            $this->comMod = new CommunicationModule();
            $this->screenMod = new ScreenTimeGoalModule();

            //get owner of goal if logged in
            if(isset($_SESSION['ffld_id']))
            {
                $this->dataOwner = $_SESSION["ffld_id"];
            }//end if
            else
            {
                echo "ERROR: This resource cannot be accessed unless logged in.<br>";
                exit();
            }//end else            
        }//close constructor

        /**
         * getScreenTimeProgress()
         * This method gets the progress of screen time usage goal based on the user’s goals
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a screen time goal must be set
         **/
        function getScreenTimeProgress()
        {
            //get all active screen time goals
            $goals = $this->screenMod->getScreenTimeGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current screen time goal data
                $duration = $goals[$i]->getMinutes();
                $days = $goals[$i]->getNumDays();

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to get screen time logs in range time
                $durationSQL = "SELECT * FROM SCREEN_TIME_DATA WHERE SCREEN_DATA_OWNER='$this->dataOwner' AND SCREEN_DATA_DATE>='$start 00:00:00'";
                $durationQuery = $this->comMod->queryDatabase($durationSQL);
               
                //count number of total minutes in selected events
                $minutes = 0;
                while($event = mysqli_fetch_array($durationQuery))
                {                    
                    $minutes += $event['SCREEN_DATA_DURATION'];
                }//end while

                //get percent of goal completion
                $progress = $minutes / $duration;
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getScreenTimeProgress

        /**
         * getScreenTimeReport()
         * This method builds a report of the user’s screen time usage
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: ScreenTimeReport object of user’s spiritual data
         * Exceptions: none
         **/
        function getScreenTimeReport($startDate, $endDate)
        {

        }//close getScreenTimeReport
    }//close ScreenTimeReportModule
?>