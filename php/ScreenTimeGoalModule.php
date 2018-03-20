<?php
    /**
     * Screen Time Goal Module (ScreenTimeGoalModule.php)
     * This class allows a user to set goals based on how often they use devices
     *      with screens, such as televisions, computers, phones, and tablets
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("ScreenTimeGoal.php");

    class ScreenTimeGoalModule
    {
        private $comMod;    //communication module to interact with database
        private $goalOwner; //owner of the goal

        /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the screen time goal module
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
         * setScreenTimeDailyGoal()
         * This method sets a screen time goal based on using a screened device for a certain
         *      number of minutes
         * Parameters:  $duration->duration, in minutes, of how long a user would like to spend
         *      using a screened device
         * Returns: void
         * Exceptions: None
         **/
        function setScreenTimeDailyGoal($duration)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO SCREEN_TIME_GOALS 	(SCREEN_GOAL_OWNER, SCREEN_GOAL_DURATION, SCREEN_GOAL_TIME, SCREEN_GOAL_ACTIVE)
                    VALUES 					        ('$this->goalOwner', '1', '$duration', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setScreenTimeDailyGoal

        /**
         * getScreenTimeGoals()
         * This method gets a ScreenTimeGoal object containing the number of minutes the user
         *      wants to spend on screen-enabled devices per day
         * Parameters: none
         * Returns: array of ScreenTimeGoal objects containing all goal data
         * Exceptions: none
         **/
        function getScreenTimeGoals()
        {
            //query to get all screen time goals of logged in user
            $sql = "SELECT SCREEN_GOAL_DURATION,SCREEN_GOAL_TIME,SCREEN_GOAL_ID FROM SCREEN_TIME_GOALS WHERE SCREEN_GOAL_OWNER='$this->goalOwner' AND SCREEN_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $screenGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['SCREEN_GOAL_DURATION'];
                $minutes = $currGoal['SCREEN_GOAL_TIME'];
                $id = $currGoal['SCREEN_GOAL_ID'];

                //create new goal object and add to array
                $goal = new ScreenTimeGoal($days, $minutes, $id);
                $screenGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $screenGoals;
        }//close getScreenTimGoals

        /**
         * removeGoal()
         * This method removes a specific screen time goal by setting it inactive in the database
         * Parameters:  $goalID->ID of goal in database
         * Returns: TRUE if goal set inactive, FALSE otherwise
         * Exceptions: none
         **/
        function removeGoal($goalID)
        {
            //build SQL to make goal inactive
            $sql = "UPDATE SCREEN_TIME_GOALS SET SCREEN_GOAL_ACTIVE='0' WHERE SCREEN_GOAL_ID='$goalID'";

            //query database
            return $this->comMod->queryDatabase($sql);
        }//close removeGoal
    }//close ScreenTimeGoalModule
?>