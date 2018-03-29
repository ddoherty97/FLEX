<?php
	/**
     * Spiritual Report Module (SpiritualReportModule.php)
     * The purpose of the Screen Time Report Module is to display the user’s screen time progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 3/28/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("SpiritualGoalModule.php");
	
	class SpiritualReportModule
	{
        private $comMod;        //communication module to interact with database
        private $spiritMod;     //spiritual goal module
        private $dataOwner;     //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the spiritual report module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication and spiritual goal object
            $this->comMod = new CommunicationModule();
            $this->spiritMod = new SpiritualGoalModule();

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
         * getSpiritualEventProgress()
         * This method gets the progress of the spiritual events based on the user’s goals
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a spiritual goal must be set
         **/
        function getSpiritualEventProgress()
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
        }//close getSpiritualEventProgress

        /**
         * getSpiritualDurationProgress()
         * This method gets the progress of spiritual duration based on the user’s goals
         * Parameters:  none
         * Returns: double representing the percent of goal completion
         * Exceptions: a spiritual goal must be set
         **/
        function getSpiritualDurationProgress()
        {

        }//close getSpiritualDurationProgress

        /**
         * getSpiritualReport()
         * This method builds a report of all the spiritual events attended
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: SpiritualReport object of user’s spiritual data
         * Exceptions: none
         **/
        function getSpiritualReport($startDate, $endDate)
        {

        }//close getSpiritualReport
    }//close SpiritualReportModule

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $mod = new SpiritualReportModule();
    $results = $mod->getSpiritualEventProgress();

    for($i=0; $i<count($results); $i++)
    {
        echo "goal ".($i+1)." is ".($results[$i]*100)."% complete.<br>";
    }//end for
?>