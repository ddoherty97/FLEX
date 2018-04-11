<?php
	/**
     * Fitness Report Module (FitnessReportModule.php)
     * The purpose of the Fitness Report Module is to display the user’s fitness progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 4/2/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("FitnessGoalModule.php");
    require_once("FitnessEntry.php");
    require_once("FitnessReport.php");
	
	class FitnessReportModule
	{
        private $comMod;        //communication module to interact with database
        private $fitMod;        //fitness goal module
        private $dataOwner;     //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the fitness report module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication and fitness goal objects
            $this->comMod = new CommunicationModule();
            $this->fitMod = new FitnessGoalModule();

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
         * getWeightProgress()
         * This method gets the user’s weight gain/loss progress in relation to their weight goals
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a weight goal must be set
         **/
        function getWeightProgress()
        {
            //get all active weight goals
            $goals = $this->fitMod->getWeightGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {
                //get current weight goal data
                $goalWeight = $goals[$i]->getWeight();
                $flag = $goals[$i]->getChange();

                //query database and get current user weight
                $weightSQL = "SELECT USER_WEIGHT FROM USER_INFORMATION WHERE USER_FFLD_ID='$this->dataOwner'";
                $weightDB = mysqli_fetch_array($this->comMod->queryDatabase($weightSQL));
                $weight = $weightDB['USER_WEIGHT'];

                //check if weight exists
                if($weight=="" || is_null($weight))
                {
                    $progress = 0;
                }//end if
                else
                {
                    //get percent of goal completion
                    if($flag < 0)
                    {
                        $progress = $goalWeight / $weight;
                    }//end if
                    else
                    {
                        $progress = $weight / $goalWeight;
                    }//end else  
                }//end else
                
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getWeightProgress

        /**
         * getCardioProgress()
         * This method gets the user’s cardio progress in relation to their cardio goals
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a cardio goal must be set
         **/
        function getCardioProgress()
        {
            //get all active cardio goals
            $goals = $this->fitMod->getCardioGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {                
                //get current cardio goal data
                $cardioType = $goals[$i]->getType();
                $cardioMilestone = $goals[$i]->getMilestone();

                //query database and get most recent milestone for current cardio type
                $cardioSQL = "SELECT FITNESS_ACTIVITY_MILESTONE FROM FITNESS_DATA WHERE FITNESS_DATA_OWNER='$this->dataOwner' AND FITNESS_ACTIVITY_TYPE='$cardioType' ORDER BY FITNESS_ACTIVITY_DATE DESC";
                $cardioDB = mysqli_fetch_array($this->comMod->queryDatabase($cardioSQL));
                $currMilestone = $cardioDB['FITNESS_ACTIVITY_MILESTONE'];

                //check if milestone exists for goal type
                if($currMilestone=="" || is_null($currMilestone))
                {
                    $progress = 0;
                }//end if
                else
                {
                    $progress = $currMilestone / $cardioMilestone;  
                }//end else
                
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getCardioProgress

        /**
         * getStrengthProgress()
         * This method gets the user’s strength progress in relation to their strength goals
         * Parameters:  none
         * Returns: array of doubles representing the percent of goal completion
         * Exceptions: a strength goal must be set
         **/
        function getStrengthProgress()
        {
            //get all active strength goals
            $goals = $this->fitMod->getStrengthGoals();

            //array to store goal completions
            $progresses = Array();

            //get progress for all goals
            for($i=0; $i<count($goals); $i++)
            {                
                //get current strength goal data
                $strengthType = $goals[$i]->getType();
                $strengthWeight = $goals[$i]->getMaxWeight();

                //query database and get most recent max weight for current strength type
                $strengthSQL = "SELECT FITNESS_ACTIVITY_MILESTONE FROM FITNESS_DATA WHERE FITNESS_DATA_OWNER='$this->dataOwner' AND FITNESS_ACTIVITY_TYPE='$strengthType' ORDER BY FITNESS_ACTIVITY_DATE DESC";
                $strengthDB = mysqli_fetch_array($this->comMod->queryDatabase($strengthSQL));
                $currMilestone = $strengthDB['FITNESS_ACTIVITY_MILESTONE'];

                //check if milestone exists for goal type
                if($currMilestone=="" || is_null($currMilestone))
                {
                    $progress = 0;
                }//end if
                else
                {
                    $progress = $currMilestone / $strengthWeight;  
                }//end else
                
                $progresses[$i] = round($progress,2);
            }//end for

            //return all progresses
            return $progresses;
        }//close getStrengthProgress

        /**
         * getFitnessEntries()
         * This method builds an array of all fitness entries
         * Parameters:  $startDate->date to start selecting entries
         *              $endDate->date to stop selecting entries
         * Returns: array of FitnessEntry objects
         * Exceptions: none
         **/
        function getFitnessEntries($startDate, $endDate)
        {
            //array to contain all fitness entries
            $fitnessEntries = [];
            $entryIndex = 0;
            
            //format date objects for use in SQL
            $startDateDisplay = date_format($startDate,'Y-m-d H:i:s');
            $endDateDisplay = date_format($endDate,'Y-m-d H:i:s');

            //get all dietary data points in data range
            $fitnessSQL = "SELECT *
                           FROM FITNESS_DATA
                           WHERE FITNESS_DATA_OWNER='$this->dataOwner'
                           AND FITNESS_ACTIVITY_DATE BETWEEN '$startDateDisplay' AND '$endDateDisplay'";
            $entries = $this->comMod->queryDatabase($fitnessSQL);

            //read all fitness entries, create objects, and add to array
            while($currEntry = mysqli_fetch_array($entries))
            {
                //get details from database
                $id = $currEntry['FITNESS_DATA_ID'];
                $date = $currEntry['FITNESS_ACTIVITY_DATE'];
                $duration = $currEntry['FITNESS_ACTIVITY_DURATION'];
                $milestone = $currEntry['FITNESS_ACTIVITY_MILESTONE'];
                $type = $currEntry['FITNESS_ACTIVITY_TYPE'];
                $notes = $currEntry['FITNESS_ACTIVITY_NOTES'];
                $timestamp = $currEntry['FITNESS_ACTIVITY_SUBMITTED_TIME'];         

                //create fitness object
                $entry = new FitnessEntry($id, date_create($date), $duration, $milestone, $type, $notes, $timestamp);

                //add object to array
                $fitnessEntries[$entryIndex] = $entry;
                $entryIndex++;
            }//end while

            //return array of entries
            return $fitnessEntries;
        }//close getFitnessEntries
        
        /**
         * getFitnessReport()
         * This method builds a report of all the fitness activities logged
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: FitnessReport object of user’s fitness data
         * Exceptions: none
         **/
        function getFitnessReport($startDate, $endDate)
        {
            //get all weight goals
            $wGoals = $this->fitMod->getWeightGoals();

            //get all weight goal progresses
            $wProgress = $this->getWeightProgress();

            //get all cardio goals
            $cGoals = $this->fitMod->getCardioGoals();

            //get all cardio goal progresses
            $cProgress = $this->getCardioProgress();

            //get all strength goals
            $sGoals = $this->fitMod->getStrengthGoals();

            //get all strength goal progresses
            $sProgress = $this->getStrengthProgress();

            //get all fitness entries
            $entries = $this->getFitnessEntries($startDate, $endDate);

            //build and return fitness report object
            $report = new FitnessReport($cGoals, $sGoals, $wGoals, $cProgress, $sProgress, $wProgress, $entries, $startDate, $endDate);
            return $report;
        }//close getFitnessReport
    }//close FitnessReportModule
?>