<?php
	/**
     * Dietary Report Module (DietaryReportModule.php)
     * The purpose of the Dietary Report Module is to display the user’s dietary progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 4/1/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("DietaryGoalModule.php");
	
	class DietaryReportModule
	{
        private $comMod;        //communication module to interact with database
        private $dietMod;       //dietary goal module
        private $dataOwner;     //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the dietary report module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication and dietary goal objects
            $this->comMod = new CommunicationModule();
            $this->dietMod = new DietaryGoalModule();

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
         * getCalorieProgress()
         * This method gets the calorie intake progress data in relation to dietary goals
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a calorie intake goal must be set
         **/
        function getCalorieProgress()
        {
           
        }//close getCalorieProgress

        /**
         * getWaterProgress()
         * This method gets the water intake progress data in relation to dietary goals
         * Parameters:  none
         * Returns: double representing the percent of goal completion
         * Exceptions: a water intake goal must be set
         **/
        function getWaterProgress()
        {
            //get all active water goals
            $goals = $this->dietMod->getWaterGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current water goal data
                $water = $goals[$i]->getWaterIntake();
                $days = $goals[$i]->getNumDays();

                echo "goal ".($i+1).": ".$water." ounces in ".$days." days<br>";

                //find out dates in goal range
                $dateStr = strtotime("-".$days." days");
                $startDate = new DateTime("-".$days." days");
                $start = $startDate->format('Y-m-d');

                //query database to get water logs in date range
                $waterSQL = "SELECT * FROM DIETARY_DATA WHERE DIET_DATA_OWNER='$this->dataOwner' AND DIET_DATE>='$start 00:00:00' AND DIET_WATER IS NOT NULL";
                $waterQuery = $this->comMod->queryDatabase($waterSQL);
               
                //count number of ounces in selected date range
                $ounces = 0;
                while($currEntry = mysqli_fetch_array($waterQuery))
                {                    
                    $ounces += $currEntry['DIET_WATER'];
                }//end while

                //get percent of goal completion
                $progress = $ounces / $water;
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getWaterProgress

        /**
         * getDietaryReport()
         * This method builds a report of all dietary data
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: DietaryReport object of user’s spiritual data
         * Exceptions: none
         **/
        function getDietaryReport($startDate, $endDate)
        {

        }//close getDietaryReport
    }//close DietaryReportModule

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $mod = new DietaryReportModule();
    $results = $mod->getWaterProgress();

    for($i=0; $i<count($results); $i++)
    {
        echo "goal ".($i+1)." is ".($results[$i]*100)."% complete.<br>";
    }//end for
?>