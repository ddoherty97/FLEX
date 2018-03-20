<?php
    /**
     * Spiritual Goal Module (SpiritualGoalModule.php)
     * This class allows the user to set goals based on spiritual events they attend
     * Author: Davis Doherty
     * Last Updated: 3/20/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("SpiritualEventGoal.php");
    require_once("SpiritualDurationGoal.php");

    class SpiritualGoalModule
    {
        private $comMod;    //communication module to interact with database
        private $goalOwner; //owner of the goal
        
        /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the spiritual goal module
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
         * setSpiritualDurationGoal()
         * This method sets a spiritual goal based on spending a certain amount of time on spiritual
         *      activities within a certain number of days
         * Parameters:  $numDays->number of days the user has set to achieve the goal
         *              $duration->minutes of how long the user would like to spend on spiritual events
         * Returns: void
         * Exceptions: None
         **/
        function setSpiritualDurationGoal($numDays, $duration)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO SPIRITUAL_GOALS 	(SPIRITUAL_GOAL_OWNER, SPIRITUAL_GOAL_TYPE, SPIRITUAL_GOAL_NUMDAYS, SPIRITUAL_GOAL_DURATION, SPIRITUAL_GOAL_ACTIVE)
                    VALUES  					    ('$this->goalOwner', 'DURATION', '$numDays', '$duration', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setSpiritualDurationGoal

        /**
         * setSpiritualEventGoal()
         * This method sets a spiritual goal based on attending a certain number of events
         * Parameters:  $numDays->number of days the user has set to achieve the goal
         *              $events->the number of events the user would like to attend
         * Returns: void
         * Exceptions: None
         **/
        function setSpiritualEventGoal($numDays, $events)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO SPIRITUAL_GOALS 	(SPIRITUAL_GOAL_OWNER, SPIRITUAL_GOAL_TYPE, SPIRITUAL_GOAL_NUMDAYS, SPIRITUAL_GOAL_NUMEVENTS, SPIRITUAL_GOAL_ACTIVE)
                    VALUES  					    ('$this->goalOwner', 'EVENT', '$numDays', '$events', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setSpiritualEventGoal

        /**
         * getSpiritualDurationGoals()
         * This method gets an array of SpiritualDurationGoal objects containing spiritual goal data
         * Parameters:  none
         * Returns: SpiritualDurationGoal objects containing spiritual duration goal data
         * Exceptions: None
         **/
        function getSpiritualDurationGoals()
        {
            //query to get all spiritual duration goals of logged in user
            $sql = "SELECT SPIRITUAL_GOAL_NUMDAYS,SPIRITUAL_GOAL_DURATION,SPIRITUAL_GOAL_ID FROM SPIRITUAL_GOALS WHERE SPIRITUAL_GOAL_OWNER='$this->goalOwner' AND SPIRITUAL_GOAL_TYPE='DURATION' AND SPIRITUAL_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $durationGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['SPIRITUAL_GOAL_NUMDAYS'];
                $minutes = $currGoal['SPIRITUAL_GOAL_DURATION'];
                $id = $currGoal['SPIRITUAL_GOAL_ID'];

                //create new goal object and add to array
                $goal = new SpiritualDurationGoal($days, $minutes, $id);
                $durationGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $durationGoals;
        }//close getSpiritualDurationGoals

        /**
         * getSpiritualEventGoals()
         * This method gets an array of SpiritualEventGoal objects containing spiritual goal data
         * Parameters:  none
         * Returns: SpiritualEventGoal objects containing spiritual goal data
         * Exceptions: None
         **/
        function getSpiritualEventGoals()
        {
            //query to get all spiritual duration goals of logged in user
            $sql = "SELECT SPIRITUAL_GOAL_NUMDAYS,SPIRITUAL_GOAL_NUMEVENTS,SPIRITUAL_GOAL_ID FROM SPIRITUAL_GOALS WHERE SPIRITUAL_GOAL_OWNER='$this->goalOwner' AND SPIRITUAL_GOAL_TYPE='EVENT' AND SPIRITUAL_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $eventGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['SPIRITUAL_GOAL_NUMDAYS'];
                $events = $currGoal['SPIRITUAL_GOAL_NUMEVENTS'];
                $id = $currGoal['SPIRITUAL_GOAL_ID'];

                //create new goal object and add to array
                $goal = new SpiritualEventGoal($days, $events, $id);
                $eventGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $eventGoals;
        }//close getSpiritualEventGoals

        /**
         * removeGoal()
         * This method removes a specific spiritual goal by setting it inactive in the database
         * Parameters:  $goalID->ID of goal in database
         * Returns: TRUE if goal set inactive, FALSE otherwise
         * Exceptions: none
         **/
        function removeGoal($goalID)
        {
            //build SQL to make goal inactive
            $sql = "UPDATE SPIRITUAL_GOALS SET SPIRITUAL_GOAL_ACTIVE='0' WHERE SPIRITUAL_GOAL_ID='$goalID'";

            //query database
            return $this->comMod->queryDatabase($sql);
        }//close removeGoal
    }//close SpiritualGoalModule
?>