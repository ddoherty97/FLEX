<?php
    /**
     * Dietary Goal Module (DietaryGoalModule.php)
     * This class allows the user to create goals relative to their diet
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("CalorieGoal.php");
    require_once("WaterGoal.php");

    class DietaryGoalModule
    {
        private $comMod;    //communication module to interact with database
        private $goalOwner; //owner of the goal

        /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the dietary goal module
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
         * setDailyCalorieGoal()
         * This method sets the daily calorie intake goal
         * Parameters:  $calories->target number of calories consumed per day
         * Returns: void
         * Exceptions: None
         **/
        function setDailyCalorieGoal($calories)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO DIETARY_GOALS 	(DIETARY_GOAL_OWNER, DIETARY_GOAL_DURATION, DIETARY_GOAL_CALORIES, DIETARY_GOAL_ACTIVE)
                    VALUES 					    ('$this->goalOwner', '1', '$calories', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setDailyCalorieGoal

        /**
         * setDailyWaterGoal()
         * This method sets the daily water intake goal
         * Parameters:  $ounces->target amount of water, in ounces, per day
         * Returns: void
         * Exceptions: None
         **/
        function setDailyWaterGoal($ounces)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO DIETARY_GOALS 	(DIETARY_GOAL_OWNER, DIETARY_GOAL_DURATION, DIETARY_GOAL_WATER, DIETARY_GOAL_ACTIVE)
                    VALUES 					    ('$this->goalOwner', '1', '$ounces', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setDailyWaterGoal

        /**
         * getCalorieGoals()
         * This method gets all calorie goals
         * Parameters: none
         * Returns: array of CalorieGoal objects containing all goal data
         * Exceptions: None
         **/
        function getCalorieGoals()
        {
            //query to get all calorie goals of logged in user
            $sql = "SELECT DIETARY_GOAL_ID,DIETARY_GOAL_CALORIES,DIETARY_GOAL_DURATION FROM DIETARY_GOALS WHERE DIETARY_GOAL_OWNER='$this->goalOwner' AND DIETARY_GOAL_CALORIES IS NOT NULL AND DIETARY_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $calorieGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['DIETARY_GOAL_DURATION'];
                $cals = $currGoal['DIETARY_GOAL_CALORIES'];
                $id = $currGoal['DIETARY_GOAL_ID'];

                //create new goal object and add to array
                $goal = new CalorieGoal($days, $cals, $id);
                $calorieGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $calorieGoals;
        }//close getCalorieGoals
        
        /**
         * getWaterGoals()
         * This method gets all water goals
         * Parameters: none
         * Returns: array of WaterGoal objects containing all goal data
         * Exceptions: None
         **/
        function getWaterGoals()
        {
            //query to get all water goals of logged in user
            $sql = "SELECT DIETARY_GOAL_ID,DIETARY_GOAL_WATER,DIETARY_GOAL_DURATION FROM DIETARY_GOALS WHERE DIETARY_GOAL_OWNER='$this->goalOwner' AND DIETARY_GOAL_WATER IS NOT NULL AND DIETARY_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $waterGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['DIETARY_GOAL_DURATION'];
                $water = $currGoal['DIETARY_GOAL_WATER'];
                $id = $currGoal['DIETARY_GOAL_ID'];

                //create new goal object and add to array
                $goal = new WaterGoal($days, $water, $id);
                $waterGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $waterGoals;
        }//close getWaterGoals

        /**
         * removeGoal()
         * This method removes a specific dietary goal by setting it inactive in the database
         * Parameters:  $goalID->ID of goal in database
         * Returns: TRUE if goal set inactive, FALSE otherwise
         * Exceptions: none
         **/
        function removeGoal($goalID)
        {
            //build SQL to make goal inactive
            $sql = "UPDATE DIETARY_GOALS SET DIETARY_GOAL_ACTIVE='0' WHERE DIETARY_GOAL_ID='$goalID'";

            //query database
            return $this->comMod->queryDatabase($sql);
        }//close removeGoal
    }//close DietaryGoalModule
?>