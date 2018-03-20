<?php
    /**
     * Social Goal Module (SocialGoalModule.php)
     * This class allows the user to create goals relative to their social activity
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    require_once("CommunicationModule.php");
    require_once("SocialActivityGoal.php");

    class SocialGoalModule
    {
        private $comMod;    //communication module to interact with database
        private $goalOwner; //owner of the goal
        
        /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the social goal module
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
         * setSocialActivityGoal()
         * This method sets goals relative to how social the user should to be over a certain time
         * Parameters:  $numDays->number of days the user has set to achieve the goal
         *              $numActivities->number of activities the user would like to participate in
         * Returns: void
         * Exceptions: None
         **/
        function setSocialActivityGoal($numDays, $numActivities)
        {
            //build SQL to insert goal into database
            $sql = "INSERT INTO SOCIAL_GOALS 	(SOCIAL_GOAL_OWNER, SOCIAL_GOAL_DURATION, SOCIAL_GOAL_TIME, SOCIAL_GOAL_ACTIVE)
                    VALUES 					    ('$this->goalOwner', '$numDays', '$numActivities', '1')";

            //query database
            $this->comMod->queryDatabase($sql);
        }//close setSocialActivityGoal

        /**
         * getSocialActivityGoals()
         * This method gets the social goals that the user has set
         * Parameters: none
         * Returns: array of SocialActivityGoal objects containing all social goal data
         * Exceptions: none
         **/
        function getSocialActivityGoals()
        {
            //query to get all social goals of logged in user
            $sql = "SELECT SOCIAL_GOAL_DURATION,SOCIAL_GOAL_TIME,SOCIAL_GOAL_ID FROM SOCIAL_GOALS WHERE SOCIAL_GOAL_OWNER='$this->goalOwner' AND SOCIAL_GOAL_ACTIVE='1'";
            $query = $this->comMod->queryDatabase($sql);

            //make array of all goals
            $socialGoals = [];
            $index = 0;

            //create goal objects and add into array
            while($currGoal = mysqli_fetch_array($query))
            {
                //get goal details from database
                $days = $currGoal['SOCIAL_GOAL_DURATION'];
                $numEvents = $currGoal['SOCIAL_GOAL_TIME'];
                $id = $currGoal['SOCIAL_GOAL_ID'];

                //create new goal object and add to array
                $goal = new SocialActivityGoal($days, $numEvents, $id);
                $socialGoals[$index] = $goal;

                //increase array index
                $index++;
            }//end while

            //return array of goals
            return $socialGoals;
        }//close getSocialActivityGoals

        /**
         * removeGoal()
         * This method removes a specific social goal by setting it inactive in the database
         * Parameters:  $goalID->ID of goal in database
         * Returns: TRUE if goal set inactive, FALSE otherwise
         * Exceptions: none
         **/
        function removeGoal($goalID)
        {
            //build SQL to make goal inactive
            $sql = "UPDATE SOCIAL_GOALS SET SOCIAL_GOAL_ACTIVE='0' WHERE SOCIAL_GOAL_ID='$goalID'";

            //query database
            return $this->comMod->queryDatabase($sql);
        }//close removeGoal
    }//close SocialGoalModule
?>