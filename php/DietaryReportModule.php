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
    require_once("DietaryEntry.php");
    require_once("DietaryReport.php");
	
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
           //get all active calorie goals
           $goals = $this->dietMod->getCalorieGoals();

           //array to store goal completions
           $progresses = Array();

           //get progress for all goals
           for($i=0; $i<count($goals); $i++)
           {
               //get current calorie goal data
               $calories = $goals[$i]->getCalorieIntake();
               $days = $goals[$i]->getNumDays();
               
               //find out dates in goal range
               $dateStr = strtotime("-".$days." days");
               $startDate = new DateTime("-".$days." days");
               $start = $startDate->format('Y-m-d');

               //query database to get calorie intake logs in date range
               $calSQL = "SELECT * FROM DIETARY_DATA WHERE DIET_DATA_OWNER='$this->dataOwner' AND DIET_DATE>='$start 00:00:00' AND DIET_CALORIES IS NOT NULL";
               $calQuery = $this->comMod->queryDatabase($calSQL);
              
               //count number of calories in selected date range
               $totalCals = 0;
               while($currEntry = mysqli_fetch_array($calQuery))
               {                    
                   $totalCals += $currEntry['DIET_CALORIES'];
               }//end while

               //get percent of goal completion
               $progress = $totalCals / $calories;
               $progresses[$i] = round($progress,2);
           }//end for

           //return all progresses
           return $progresses;
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
         * getDietaryEntries()
         * This method builds an array of all dietary entried
         * Parameters:  $startDate->date to start selecting entries
         *              $endDate->date to stop selecting entries
         * Returns: array of DietaryEntry objects
         * Exceptions: none
         **/
        function getDietaryEntries($startDate, $endDate)
        {
            //array to contain all dietary entries
            $dietaryEntries = [];
            $entryIndex = 0;
            
            //format date objects for use in SQL
            $startDateDisplay = date_format($startDate,'Y-m-d H:i:s');
            $endDateDisplay = date_format($endDate,'Y-m-d H:i:s');

            //get all dietary data points in data range
            $dietSQL =  "SELECT *
                         FROM DIETARY_DATA
                         WHERE DIET_DATA_OWNER='$this->dataOwner'
                         AND DIET_DATE BETWEEN '$startDateDisplay' AND '$endDateDisplay'";
            $entries = $this->comMod->queryDatabase($dietSQL);

            //read all dietary entries, create objects, and add to array
            while($currEntry = mysqli_fetch_array($entries))
            {
                //get details from database
                $id = $currEntry['DIET_DATA_ID'];
                $date = $currEntry['DIET_DATE'];
                $desc = $currEntry['DIET_TITLE'];
                $cals = $currEntry['DIET_CALORIES'];
                $water = $currEntry['DIET_WATER'];
                $timestamp = $currEntry['DIET_TIMESTAMP'];

                //create dietary object
                $entry = new DietaryEntry($id, $date, $desc, $cals, $water, $timestamp);

                //add object to array
                $dietaryEntries[$entryIndex] = $entry;
                $entryIndex++;
            }//end while

            //return array of entries
            return $dietaryEntries;
        }//close getDietaryEntries

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

    echo "starting...<br>";
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo "errors on<br>";

    $mod = new DietaryReportModule();
    echo "mod created<br>";
    
    $start = date_create("2018-3-15 00:00:00");
    $end = date_create("2018-4-15 00:00:00");
    echo "dates created<br>";

    $entries = $mod->getDietaryEntries($start, $end);
    
    for($i=0; $i<count($entries); $i++)
    {
        echo "<br>entry ".($i+1).":<br>";
        echo "id: ".$entries[$i]->getEntryID()."<br>";
        echo "date: ".$entries[$i]->getEntryDate()."<br>";
        echo "Description: ".$entries[$i]->getDescription()."<br>";
        echo "cals: ".$entries[$i]->getCalories()."<br>";
        echo "water: ".$entries[$i]->getWater()."<br>";
        echo "timestamp: ".$entries[$i]->getTimestamp()."<br>";
    }
?>