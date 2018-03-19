<?php
    /**
     * Fitness Goal Module (FitnessGoalModule.php)
     * This class allows the user to create goals based on their personal and desired fitness level
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("WeightGoal.php");
    require_once("CardioGoal.php");
    require_once("StrengthGoal.php");

    class FitnessGoalModule
    {
        private $comMod;    //communication module to interact with database
        private $goalOwner; //owner of the goal
        
        /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the fitness goal module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
        function __construct()
        {
            //create communication object
            $this->comMod = new CommunicationModule();

            //get owner of goal if logged in
            if(isset($_SESSION['ffld_id']))
            {
                $this->goalOwner = $_SESSION["ffld_id"];
            }//end if
            else
            {
                echo "ERROR: This resource cannot be accessed unless logged in.<br>";
                exit();
            }//end else            
        }//close constructor

        /**
         * setWeightGoal()
         * This method sets the goal weight for the user to achieve in a designated period of time
         * Parameters:  $numDays->number of days the user has set to achieve the goal weight
         *              $weight->goal weight in pounds the user would like to reach
         * Returns: void
         * Exceptions: None
         **/
        function setWeightGoal($numDays, $weight)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO FITNESS_GOALS 	(FITNESS_GOAL_OWNER, FITNESS_GOAL_DURATION, FITNESS_GOAL_TYPE, FITNESS_GOAL_WEIGHT, FITNESS_GOAL_ACTIVE)
                    VALUES 					    ('$this->goalOwner', '$numDays', 'WEIGHT', '$weight', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setWeightGoal

        /**
         * setCardioGoal()
         * This method sets a cardio goal for the user
         * Parameters:  $numDays->number of days the user has set to achieve the goal
         *              $type->type of cardio being evaluated in the goal
         *              $milestone->milestone to achieve for given goal type
         * Returns: void
         * Exceptions: $type is not in predefined list
         **/
        function setCardioGoal($numDays, $type, $milestone)
        {
            //begin to build SQL statement 
            $sql = "INSERT INTO FITNESS_GOALS (FITNESS_GOAL_OWNER, FITNESS_GOAL_DURATION, FITNESS_GOAL_TYPE, FITNESS_GOAL_ACTIVE, "; //FITNESS_GOAL_DISTANCE)

            //determine sql statement to use based on type of cardio goal
            switch($type)
            {
                case "CARDIO-DISTANCE":
                    $sql = $sql."FITNESS_GOAL_DISTANCE) ";
                break;
                   
                case "CARDIO-SPEED":
                    $sql = $sql."FITNESS_GOAL_SPEED) ";
                break;

                case "CARDIO-TIME":
                    $sql = $sql."FITNESS_GOAL_TIME) ";
                break;
            }//end switch
            
            //finish sql statement
            $sql = $sql."VALUES ('$this->goalOwner', '$numDays', '$type', '1', '$milestone')";
           
            //if one of the labels was met
            if($type=="CARDIO-DISTANCE" || $type=="CARDIO-SPEED" || $type=="CARDIO-TIME")
            {
                //query database
                $this->comMod->queryDatabase($sql);
            }//end if     
        }//close setCardioGoal

        /**
         * setStrengthGoal()
         * This method sets a strength goal for the user
         * Parameters:  $numDays->number of days the user has set to achieve the goal
         *              $maxWeight->weight that must be reached to achieve the goal
         *              $type->type of strength conditioning being evaluated in the goal
         * Returns: void
         * Exceptions: $type is not in predefined list
         **/
        function setStrengthGoal($numDays, $type, $maxWeight)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO FITNESS_GOALS 	(FITNESS_GOAL_OWNER, FITNESS_GOAL_DURATION, FITNESS_GOAL_TYPE, FITNESS_GOAL_MAXWEIGHT, FITNESS_GOAL_ACTIVE)
                    VALUES 					    ('$this->goalOwner', '$numDays', '$type', '$maxWeight', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setStrengthGoal

         /**
         * getWeightGoals()
         * This method gets the weight goal(s) that the user has set
         * Parameters: none
         * Returns: array of WeightGoal objects containing all weight goal data
         * Exceptions: none
         **/
        function getWeightGoals()
        {
            //query to get all weight goals of logged in user
            $sql = "SELECT FITNESS_GOAL_DURATION,FITNESS_GOAL_WEIGHT,FITNESS_GOAL_ID FROM FITNESS_GOALS WHERE FITNESS_GOAL_OWNER='$this->goalOwner' AND FITNESS_GOAL_TYPE='WEIGHT' AND FITNESS_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $weightGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['FITNESS_GOAL_DURATION'];
                $weight = $currGoal['FITNESS_GOAL_WEIGHT'];
                $id = $currGoal['FITNESS_GOAL_ID'];

                //create new goal object and add to array
                $goal = new WeightGoal($days, $weight, $id);
                $weightGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $weightGoals;
        }//close getWeightGoals

        /**
         * getCardioGoals()
         * This method gets the cardio goal(s) that the user has set
         * Parameters: none
         * Returns: array of CardioGoal objects containing all weight goal data
         * Exceptions: none
         **/
        function getCardioGoals()
        {
            //make array of all cardio goals and index to iterate through
            $cardioGoals = [];
            $index = 0;

            //query database to get all cardio distance goals
            $cardioSQL = "SELECT FITNESS_GOAL_ID,FITNESS_GOAL_DURATION,FITNESS_GOAL_TYPE,FITNESS_GOAL_DISTANCE FROM FITNESS_GOALS WHERE FITNESS_GOAL_OWNER='$this->goalOwner' AND FITNESS_GOAL_TYPE='CARDIO-DISTANCE' AND FITNESS_GOAL_ACTIVE='1'";
            $cardioQuery = $this->comMod->queryDatabase($cardioSQL);

            //add distance goals to array
            while($currGoal = mysqli_fetch_array($cardioQuery))
            {
                //get goal details from database
                $days = $currGoal['FITNESS_GOAL_DURATION'];
                $type = $currGoal['FITNESS_GOAL_TYPE'];
                $milestone = $currGoal['FITNESS_GOAL_DISTANCE'];
                $id = $currGoal['FITNESS_GOAL_ID'];

                //create new goal object and add to array
                $goal = new CardioGoal($days, $type, $milestone, $id);
                $cardioGoals[$index] = $goal;

                //increase array index
                $index++;
            }//close while

            //query database to get all cardio speed goals
            $speedSQL = "SELECT FITNESS_GOAL_ID,FITNESS_GOAL_DURATION,FITNESS_GOAL_TYPE,FITNESS_GOAL_SPEED FROM FITNESS_GOALS WHERE FITNESS_GOAL_OWNER='$this->goalOwner' AND FITNESS_GOAL_TYPE='CARDIO-SPEED' AND FITNESS_GOAL_ACTIVE='1'";
            $speedQuery = $this->comMod->queryDatabase($speedSQL);

            //add speed goals to array
            while($currGoal = mysqli_fetch_array($speedQuery))
            {
                //get goal details from database
                $days = $currGoal['FITNESS_GOAL_DURATION'];
                $type = $currGoal['FITNESS_GOAL_TYPE'];
                $milestone = $currGoal['FITNESS_GOAL_SPEED'];
                $id = $currGoal['FITNESS_GOAL_ID'];

                //create new goal object and add to array
                $goal = new CardioGoal($days, $type, $milestone, $id);
                $cardioGoals[$index] = $goal;

                //increase array index
                $index++;
            }//close while

            //query database to get all cardio time goals
            $timeSQL = "SELECT FITNESS_GOAL_ID,FITNESS_GOAL_DURATION,FITNESS_GOAL_TYPE,FITNESS_GOAL_TIME FROM FITNESS_GOALS WHERE FITNESS_GOAL_OWNER='$this->goalOwner' AND FITNESS_GOAL_TYPE='CARDIO-TIME' AND FITNESS_GOAL_ACTIVE='1'";
            $timeQuery = $this->comMod->queryDatabase($timeSQL);

            //add time goals to array
            while($currGoal = mysqli_fetch_array($timeQuery))
            {
                //get goal details from database
                $days = $currGoal['FITNESS_GOAL_DURATION'];
                $type = $currGoal['FITNESS_GOAL_TYPE'];
                $milestone = $currGoal['FITNESS_GOAL_TIME'];
                $id = $currGoal['FITNESS_GOAL_ID'];

                //create new goal object and add to array
                $goal = new CardioGoal($days, $type, $milestone, $id);
                $cardioGoals[$index] = $goal;

                //increase array index
                $index++;
            }//close while

            //return array of all three cardio goal types
            return $cardioGoals;
        }//close getCardioGoals

        /**
         * getStrengthGoals()
         * This method gets the strength goal(s) that the user has set
         * Parameters: none
         * Returns: array of StrengthGoal objects containing all weight goal data
         * Exceptions: none
         **/
        function getStrengthGoals()
        {
            //query to get all strength goals of logged in user
            $sql = "SELECT FITNESS_GOAL_ID,FITNESS_GOAL_TYPE,FITNESS_GOAL_DURATION,FITNESS_GOAL_MAXWEIGHT FROM FITNESS_GOALS WHERE FITNESS_GOAL_OWNER='$this->goalOwner' AND FITNESS_GOAL_TYPE LIKE 'STRENGTH-%' AND FITNESS_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $strengthGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['FITNESS_GOAL_DURATION'];
                $type = $currGoal['FITNESS_GOAL_TYPE'];
                $maxWeight = $currGoal['FITNESS_GOAL_MAXWEIGHT'];
                $id = $currGoal['FITNESS_GOAL_ID'];

                //create new goal object and add to array
                $goal = new StrengthGoal($days, $type, $maxWeight, $id);
                $strengthGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $strengthGoals;
        }//close getStrengthGoals

        /**
         * removeGoal()
         * This method removes a specific fitness goal by setting it inactive in the database
         * Parameters:  $goalID->ID of goal in database
         * Returns: TRUE if goal set inactive, FALSE otherwise
         * Exceptions: none
         **/
        function removeGoal($goalID)
        {
            //build SQL to make goal inactive
            $sql = "UPDATE FITNESS_GOALS SET FITNESS_GOAL_ACTIVE='0' WHERE FITNESS_GOAL_ID='$goalID'";

            //query database
            return $this->comMod->queryDatabase($sql);
        }//close removeGoal
    }//close FitnessGoalModule
?>