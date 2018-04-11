<?php
	/**
     * Social Report Module (SocialReportModule.php)
     * The purpose of the Spiritual Report Module is to display the user’s social progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 4/11/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("SocialGoalModule.php");
    require_once("SocialEntry.php");
    require_once("SocialReport.php");
	
	class SocialReportModule
	{
        private $comMod;        //communication module to interact with database
        private $socialMod;     //social goal module
        private $dataOwner;     //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the social report module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication and social goal objects
            $this->comMod = new CommunicationModule();
            $this->socialMod = new SocialGoalModule();

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
         * getSocialProgress()
         * This method gets the social activity progress in relation to the user’s goals
         * Parameters: none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a social goal must be set
         **/
        function getSocialProgress()
        {
            //get all active social goals
            $goals = $this->socialMod->getSocialActivityGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current social goal data
                $duration = $goals[$i]->getMinutes();
                $days = $goals[$i]->getNumDays();
                $type = $goals[$i]->getType();

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to get events in goal range time
                $socialSQL = "SELECT * FROM SOCIAL_DATA WHERE SOCIAL_DATA_OWNER='$this->dataOwner' AND SOCIAL_ACTIVITY_DATE>='$start 00:00:00' AND SOCIAL_ACTIVITY_TYPE='$type'";
                $socialQuery = $this->comMod->queryDatabase($socialSQL);
               
                //count number of total minutes in selected events
                $minutes = 0;
                while($event = mysqli_fetch_array($socialQuery))
                {                    
                    $minutes += $event['SOCIAL_ACTIVITY_DURATION'];
                }//end while

                //get percent of goal completion
                $progress = $minutes / $duration;
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getSocialProgress

        /**
         * getSocialEntries()
         * This method builds an array of all social activity entries
         * Parameters:  $startDate->date to start selecting entries
         *              $endDate->date to stop selecting entries
         * Returns: array of SocialEntry objects
         * Exceptions: none
         **/
        function getSocialEntries($startDate, $endDate)
        {
            //array to contain all social entries
            $socialEntries = [];
            $entryIndex = 0;
            
            //format date objects for use in SQL
            $startDateDisplay = date_format($startDate,'Y-m-d H:i:s');
            $endDateDisplay = date_format($endDate,'Y-m-d H:i:s');

            //get all social data points in data range
            $socialSQL = "SELECT *
                          FROM SOCIAL_DATA
                          WHERE SOCIAL_DATA_OWNER='$this->dataOwner'
                          AND SOCIAL_ACTIVITY_DATE BETWEEN '$startDateDisplay' AND '$endDateDisplay'";
            $entries = $this->comMod->queryDatabase($socialSQL);

            //read all social entries, create objects, and add to array
            while($currEntry = mysqli_fetch_array($entries))
            {
                //get details from database
                $id = $currEntry['SOCIAL_DATA_ID'];
                $date = $currEntry['SOCIAL_ACTIVITY_DATE'];
                $title = $currEntry['SOCIAL_ACTIVITY_TITLE'];
                $location = $currEntry['SOCIAL_ACTIVITY_LOCATION'];
                $duration = $currEntry['SOCIAL_ACTIVITY_DURATION'];
                $type = $currEntry['SOCIAL_ACTIVITY_TYPE'];
                $notes = $currEntry['SOCIAL_ACTIVITY_NOTES'];
                $timestamp = $currEntry['SOCIAL_DATA_TIMESTAMP'];
                
                //create social entry
                $entry = new SocialEntry($id, date_create($date), $title, $location, $duration, $type, $notes, $timestamp);

                //add object to array
                $socialEntries[$entryIndex] = $entry;
                $entryIndex++;
            }//end while

            //return array of entries
            return $socialEntries;
        }//close getSocialEntries

        /**
         * getSocialReport()
         * This method builds a report of all the social events attended
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: SocialReport object of user’s social activity
         * Exceptions: none
         **/
        function getSocialReport($startDate, $endDate)
        {
            //get all social goals
            $goals = $this->socialMod->getSocialActivityGoals();

            //get all social goal progresses
            $progresses = $this->getSocialProgress();

            //get all social activity entries
            $entries = $this->getSocialEntries($startDate, $endDate);

            //build and return social report object
            $report = new SocialReport($goals, $progresses, $entries, $startDate, $endDate);
            return $report;
        }//close getSocialReport
    }//close SocialReportModule
?>