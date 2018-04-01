<?php
	/**
     * Mental Report Module (MentalReportModule.php)
     * The purpose of the Mental Report Module is to display the user’s mental health progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 3/31/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("MentalGoalModule.php");
	
	class MentalReportModule
	{
        private $comMod;        //communication module to interact with database
        private $mentalMod;     //mental goal module
        private $dataOwner;     //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the mental report module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication and mental goal objects
            $this->comMod = new CommunicationModule();
            $this->mentalMod = new MentalGoalModule();

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
         * getCounselingSessionProgress()
         * This method gets the counseling session progress in reference to the counseling session goal(s)
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a mental counseling session goal must be set
         **/
        function getCounselingSessionProgress()
        {
            //get all active counseling session goals
            $goals = $this->mentalMod->getCounselingGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current counseling session goal data
                $duration = $goals[$i]->getMinutes();
                $days = $goals[$i]->getNumDays();

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to get events in goal range time
                $counselingSQL = "SELECT * FROM MENTAL_DATA WHERE MENTAL_DATA_OWNER='$this->dataOwner' AND MENTAL_COUNSELING_DATE>='$start 00:00:00'";
                $counselingQuery = $this->comMod->queryDatabase($counselingSQL);
               
                //count number of total minutes in selected events
                $minutes = 0;
                while($event = mysqli_fetch_array($counselingQuery))
                {
                    $minutes += $event['MENTAL_COUNSELING_DURATION'];
                }//end while

                //get percent of goal completion
                $progress = $minutes / $duration;
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getCounselingSessionProgress

        /**
         * getStressLevelProgress()
         * This method gets the user's stress level progress based on their goals
         * Parameters:  none
         * Returns: double representing the percent of goal completion (max=100%)
         * Exceptions: a stress level goal must be set
         **/
        function getStressLevelProgress()
        {
            //get all active stress level goals
            $goals = $this->mentalMod->getStressGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current stress goal data
                $level = $goals[$i]->getLevel();
                $days = $goals[$i]->getNumDays();

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to get minimum stress level in date range
                $stressSQL = "SELECT MIN(MENTAL_STRESS_LEVEL) AS MOST_RECENT_LEVEL FROM MENTAL_DATA WHERE MENTAL_DATA_OWNER='$this->dataOwner' AND MENTAL_DATA_TIMESTAMP>='$start 00:00:00'";
                $stressDB = mysqli_fetch_array($this->comMod->queryDatabase($stressSQL));
                $minLevel = $stressDB['MOST_RECENT_LEVEL'];

                //get percent of goal completion
                $progress = $level / $minLevel;

                //if goal is complete, set to 100%
                if($progress>1)
                {
                    $progress = 1;
                }//end if

                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getStressLevelProgress

        /**
         * getMentalReport()
         * This method builds a report of all the mental health related activities
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: MentalReport object of user’s mental health data
         * Exceptions: none
         **/
        function getMentalReport($startDate, $endDate)
        {

        }//close getMentalReport
    }//close MentalReportModule

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $mod = new MentalReportModule();
    $results = $mod->getStressLevelProgress();

    for($i=0; $i<count($results); $i++)
    {
        echo "goal ".($i+1)." is ".($results[$i]*100)."% complete.<br>";
    }//end for
?>