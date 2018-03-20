<?php
    /**
     * CounselingGoal.php
     * This class allows the user to create counseling goals
     * Author: Davis Doherty
     * Last Updated: 3/20/18 DD
     **/

    class CounselingGoal
    {
        private $numDays;       //number of days to acheive goal
        private $minutes;       //number of minutes to attend at a counseling session
        private $goalID;        //ID of mental goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the mental goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $minutes->number of minutes to attend at a counseling session
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $minutes, $id)
        {
            $this->numDays = $numDays;
            $this->minutes = $minutes;
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
         * getMinutes()
         * This method gets the number of minutes to reach the goal
         * Parameters: none
         * Returns: number of minutes to reach the goal
         * Exceptions: None
         **/
        function getMinutes()
        {
            return $this->minutes;
        }//close getMinutes

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
    }//close CounselingGoal
?>