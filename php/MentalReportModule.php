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
                echo "goal ".($i+1).":<br>";

                //get current counseling session goal data
                $duration = $goals[$i]->getMinutes();
                $days = $goals[$i]->getNumDays();
                echo $duration." minutes in ".$days." days<br>";

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
                    echo "event took ".$event['MENTAL_COUNSELING_DURATION']." minutes<br>";
                    
                    $minutes += $event['MENTAL_COUNSELING_DURATION'];

                    echo "total minutes so far: ".$minutes."<br>";
                }//end while

                //get percent of goal completion
                $progress = $minutes / $duration;
                $progresses[$i] = round($progress,2);
                echo "total minutes: ".$minutes."<br><br>";
            }//end for

            //return all progresses
            return $progresses;
        }//close getCounselingSessionProgress

        /**
         * getStressLevelProgress()
         * This method gets the user's stress level progress based on their goals
         * Parameters:  none
         * Returns: double representing the percent of goal completion
         * Exceptions: a stress level goal must be set
         **/
        function getStressLevelProgress()
        {
            //get all active spiritual goals
            $goals = $this->spiritMod->getSpiritualEventGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current spiritual event goal data
                $events = $goals[$i]->getEvents();
                $days = $goals[$i]->getNumDays();

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to count number of events in given time
                $eventSQL = "SELECT COUNT(*) AS NUM_EVENTS FROM SPIRITUAL_DATA WHERE SPIRITUAL_DATA_OWNER='$this->dataOwner' AND SPIRITUAL_ACTIVITY_DATE>='$start 00:00:00'";
                $eventsDB = mysqli_fetch_array($this->comMod->queryDatabase($eventSQL));
                $numEvents = $eventsDB['NUM_EVENTS'];

                //get percent of goal completion
                $progress = $numEvents / $events;
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
    $results = $mod->getCounselingSessionProgress();

    for($i=0; $i<count($results); $i++)
    {
        echo "goal ".($i+1)." is ".($results[$i]*100)."% complete.<br>";
    }//end for
?>