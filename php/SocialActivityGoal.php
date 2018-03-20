<?php
    /**
     * SocialActivityGoal.php
     * This class allows the user to create social goals
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    class SocialActivityGoal
    {
        private $numDays;       //number of days to acheive goal
        private $numActivities; //number of activities to complete in alloted time
        private $goalID;        //ID of social goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the social goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $numActivities->number of activities to complete in alloted time
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $numActivities, $id)
        {
            $this->numDays = $numDays;
            $this->numActivities = $numActivities;
            $this->goalID = $id;
        }//close constructor

        /**
         * getNumDays()
         * This method gets the number of days to acheive the goal
         * Parameters: none
         * Returns: number of days to acheive the goal
         * Exceptions: None
         **/
        function getNumDays()
        {
            return $this->numDays;
        }//close getNumDays

        /**
         * getActivities()
         * This method gets the number of social activities for the goal type
         * Parameters: none
         * Returns: number of social activities for the goal
         * Exceptions: None
         **/
        function getActivities()
        {
            return $this->numActivities;
        }//close getActivities

        /**
         * getID()
         * This method gets ID of the goal in the database
         * Parameters: none
         * Returns: ID of goal
         * Exceptions: None
         **/
        function getID()
        {
            return $this->goalID;
        }//close getID
    }//close StrengthGoal
?>