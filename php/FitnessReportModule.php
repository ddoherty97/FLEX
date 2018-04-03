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
         * getFitnessReport()
         * This method builds a report of all the fitness activities logged
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: FitnessReport object of user’s fitness data
         * Exceptions: none
         **/
        function getFitnessReport($startDate, $endDate)
        {

        }//close getFitnessReport
    }//close FitnessReportModule
?>