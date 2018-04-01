<?php
	/**
     * Social Report Module (SocialReportModule.php)
     * The purpose of the Spiritual Report Module is to display the user’s social progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 4/1/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("SocialGoalModule.php");
	
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

                echo "goal ".($i+1).": ".$duration." minutes of ".$type." in ".$days." days<br>";

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
         * getSocialReport()
         * This method builds a report of all the social events attended
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: SocialReport object of user’s social activity
         * Exceptions: none
         **/
        function getSocialReport($startDate, $endDate)
        {

        }//close getSocialReport
    }//close SocialReportModule

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $mod = new SocialReportModule();
    $results = $mod->getSocialProgress();

    for($i=0; $i<count($results); $i++)
    {
        echo "goal ".($i+1)." is ".($results[$i]*100)."% complete.<br>";
    }//end for
?>