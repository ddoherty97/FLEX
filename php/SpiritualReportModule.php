<?php
	/**
     * Spiritual Report Module (SpiritualReportModule.php)
     * The purpose of the Spiritual Report Module is to display the user’s spiritual progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 3/31/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("SpiritualGoalModule.php");
    require_once("SpiritualEntry.php");
    require_once("SpiritualReport.php");
	
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
            //create communication and spiritual goal objects
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
            //get all active spiritual goals
            $goals = $this->spiritMod->getSpiritualDurationGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current spiritual duration goal data
                $duration = $goals[$i]->getMinutes();
                $days = $goals[$i]->getNumDays();

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to get events in goal range time
                $durationSQL = "SELECT * FROM SPIRITUAL_DATA WHERE SPIRITUAL_DATA_OWNER='$this->dataOwner' AND SPIRITUAL_ACTIVITY_DATE>='$start 00:00:00'";
                $durationQuery = $this->comMod->queryDatabase($durationSQL);
               
                //count number of total minutes in selected events
                $minutes = 0;
                while($event = mysqli_fetch_array($durationQuery))
                {                    
                    $minutes += $event['SPIRITUAL_ACTIVITY_DURATION'];
                }//end while

                //get percent of goal completion
                $progress = $minutes / $duration;
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getSpiritualDurationProgress

        /**
         * getSpiritualEntries()
         * This method builds an array of all spiritual entries
         * Parameters:  $startDate->date to start selecting entries
         *              $endDate->date to stop selecting entries
         * Returns: array of SpiritualEntry objects
         * Exceptions: none
         **/
        function getSpiritualEntries($startDate, $endDate)
        {
            //array to contain all spiritual entries
            $spiritualEntries = [];
            $entryIndex = 0;
            
            //format date objects for use in SQL
            $startDateDisplay = date_format($startDate,'Y-m-d H:i:s');
            $endDateDisplay = date_format($endDate,'Y-m-d H:i:s');

            //get all spiritual data points in data range
            $spiritSQL = "SELECT *
                          FROM SPIRITUAL_DATA
                          WHERE SPIRITUAL_DATA_OWNER='$this->dataOwner'
                          AND SPIRITUAL_ACTIVITY_DATE BETWEEN '$startDateDisplay' AND '$endDateDisplay'";
            $entries = $this->comMod->queryDatabase($spiritSQL);

            //read all spiritual entries, create objects, and add to array
            while($currEntry = mysqli_fetch_array($entries))
            {
                //get details from database
                $id = $currEntry['SPIRITUAL_DATA_ID'];
                $date = $currEntry['SPIRITUAL_ACTIVITY_DATE'];
                $title = $currEntry['SPIRITUAL_ACTIVITY_TITLE'];
                $location = $currEntry['SPIRITUAL_ACTIVITY_LOCATION'];
                $duration = $currEntry['SPIRITUAL_ACTIVITY_DURATION'];
                $type = $currEntry['SPIRITUAL_ACTIVITY_TYPE'];
                $notes = $currEntry['SPIRITUAL_ACTIVITY_NOTES'];
                $timestamp = $currEntry['SPIRITUAL_DATA_TIMESTAMP'];

                //create dietary object
                $entry = new SpiritualEntry($id, date_create($date), $title, $location, $duration, $type, $notes, $timestamp);

                //add object to array
                $spiritualEntries[$entryIndex] = $entry;
                $entryIndex++;
            }//end while

            //return array of entries
            return $spiritualEntries;
        }//close getSpiritualEntries

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
            //get all duration goals
            $durationGoals = $this->spiritMod->getSpiritualDurationGoals();

            //get all duration goal progresses
            $durationProgress = $this->getSpiritualDurationProgress();

            //get all event goals
            $eventGoals = $this->spiritMod->getSpiritualEventGoals();

            //get all event goal progresses
            $eventProgress = $this->getSpiritualDurationProgress();

            //get all spiritual entries
            $entries = $this->getSpiritualEntries($startDate, $endDate);

            //build and return spiritual report object
            $report = new SpiritualReport($durationGoals, $eventGoals, $durationProgress, $eventProgress, $entries, $startDate, $endDate);
            return $report;
        }//close getSpiritualReport
    }//close SpiritualReportModule
?>