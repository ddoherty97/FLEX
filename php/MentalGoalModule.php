<?php
    /**
     * Mental Goal Module (MentalGoalModule.php)
     * This class allows the user to create goals pertaining to their mental health
     * Author: Davis Doherty
     * Last Updated: 3/20/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("CounselingGoal.php");
    require_once("StressGoal.php");

    class MentalGoalModule
    {
        private $comMod;    //communication module to interact with database
        private $goalOwner; //owner of the goal
        
        /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the mental goal module
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
         * setCounselingGoal()
         * This method sets the goal time the user wants to spend in counseling sessions within a certain time period
         * Parameters:  $numDays->number of days the user has set to achieve the goal
         *              $time->target amount of time to be spent in a counseling session
         * Returns: void
         * Exceptions: None
         **/
        function setCounselingGoal($numDays, $time)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO MENTAL_GOALS 	(MENTAL_GOAL_OWNER, MENTAL_GOAL_TYPE, MENTAL_GOAL_DURATION, MENTAL_GOAL_COUNSELING_TIME, MENTAL_GOAL_ACTIVE)
                    VALUES  					('$this->goalOwner', 'COUNSELING', '$numDays', '$time', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setCounselingGoal

        /**
         * setDailyStressGoal()
         * This method sets the goal stress level
         * Parameters:  $level->target stress level to achieve
         * Returns: void
         * Exceptions: None
         **/
        function setDailyStressGoal($level)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO MENTAL_GOALS 	(MENTAL_GOAL_OWNER, MENTAL_GOAL_TYPE, MENTAL_GOAL_DURATION, MENTAL_GOAL_STRESS_LEVEL, MENTAL_GOAL_ACTIVE)
                    VALUES  					('$this->goalOwner', 'STRESS', '1', '$level', '1')";
            
            //query database
            $this->comMod->queryDatabase($sql);
        }//close setDailyStressGoal

        /**
         * getCounselingGoals()
         * This method gets an array of CounselingGoal objects containing goal data
         * Parameters:  none
         * Returns: CounselingGoal objects containing counseling goal data
         * Exceptions: None
         **/
        function getCounselingGoals()
        {
            //query to get all counseling goals of logged in user
            $sql = "SELECT MENTAL_GOAL_DURATION,MENTAL_GOAL_COUNSELING_TIME,MENTAL_GOAL_ID FROM MENTAL_GOALS WHERE MENTAL_GOAL_OWNER='$this->goalOwner' AND MENTAL_GOAL_TYPE='COUNSELING' AND MENTAL_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $counselingGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['MENTAL_GOAL_DURATION'];
                $minutes = $currGoal['MENTAL_GOAL_COUNSELING_TIME'];
                $id = $currGoal['MENTAL_GOAL_ID'];

                //create new goal object and add to array
                $goal = new CounselingGoal($days, $minutes, $id);
                $counselingGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $counselingGoals;
        }//close getCounselingGoals

        /**
         * getStressGoals()
         * This method gets an array of StressGoal objects containing goal data
         * Parameters:  none
         * Returns: StressGoal objects containing stress goal data
         * Exceptions: None
         **/
        function getStressGoals()
        {
            //query to get all stress goals of logged in user
            $sql = "SELECT MENTAL_GOAL_DURATION,MENTAL_GOAL_STRESS_LEVEL,MENTAL_GOAL_ID FROM MENTAL_GOALS WHERE MENTAL_GOAL_OWNER='$this->goalOwner' AND MENTAL_GOAL_TYPE='STRESS' AND MENTAL_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $stressGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['MENTAL_GOAL_DURATION'];
                $level = $currGoal['MENTAL_GOAL_STRESS_LEVEL'];
                $id = $currGoal['MENTAL_GOAL_ID'];

                //create new goal object and add to array
                $goal = new StressGoal($days, $level, $id);
                $stressGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $stressGoals;
        }//close getStressGoals

        /**
         * removeGoal()
         * This method removes a specific mental goal by setting it inactive in the database
         * Parameters:  $goalID->ID of goal in database
         * Returns: TRUE if goal set inactive, FALSE otherwise
         * Exceptions: none
         **/
        function removeGoal($goalID)
        {
            //build SQL to make goal inactive
            $sql = "UPDATE MENTAL_GOALS SET MENTAL_GOAL_ACTIVE='0' WHERE MENTAL_GOAL_ID='$goalID'";

            //query database
            return $this->comMod->queryDatabase($sql);
        }//close removeGoal
    }//close MentalGoalModule

    session_start();
    echo "session started<br>";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $mod = new MentalGoalModule();
    echo "module created<br>";

    $mod->removeGoal(3);
    echo "goal removed<br>";

    $cGoals = $mod->getCounselingGoals();
    echo "counseling goals received<br>";
    $sGoals = $mod->getStressGoals();
    echo "stress goals received<br>";

    for($i=0; $i<count($cGoals); $i++)
    {
        echo "id: ".$cGoals[$i]->getID()."<br>";
        echo "type: counseling<br>";
        echo "duration: ".$cGoals[$i]->getNumDays()."<br>";
        echo "minutes: ".$cGoals[$i]->getMinutes()."<br><br>";
    }
    for($i=0; $i<count($sGoals); $i++)
    {
        echo "id: ".$sGoals[$i]->getID()."<br>";
        echo "type: stress<br>";
        echo "duration: ".$sGoals[$i]->getNumDays()."<br>";
        echo "minutes: ".$sGoals[$i]->getLevel()."<br><br>";
    }
?>