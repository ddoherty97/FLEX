<?php
    /**
     * ScreenTimeGoal.php
     * This class allows the user to create goals based on their screen time preferences
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

     class ScreenTimeGoal
     {
        private $numDays;   //number of days to acheive goal
        private $duration;  //minutes to use screen device
        private $goalID;    //id of goal in database
        
        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the screen time goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $duration->number of minutes to use screen device
         * Exceptions: none
         **/
        function __construct($numDays, $minutes, $id)
        {
            $this->numDays = $numDays;
            $this->duration = $minutes;
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
         * This method gets the number of minutes of goal
         * Parameters: none
         * Returns: number of minutes
         * Exceptions: None
         **/
        function getMinutes()
        {
            return $this->duration;
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
    }//close ScreenTimeGoal
?>