<?php
    /**
     * StressGoal.php
     * This class allows the user to create stress level goals
     * Author: Davis Doherty
     * Last Updated: 3/20/18 DD
     **/

    class StressGoal
    {
        private $numDays;       //number of days to acheive goal
        private $level;         //stress level to reach to acheive goal
        private $goalID;        //ID of mental goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the mental goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $level->stress level to reach to acheive goal
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $level, $id)
        {
            $this->numDays = $numDays;
            $this->level = $level;
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
         * getLevel()
         * This method gets the target stress level to reach the goal
         * Parameters: none
         * Returns: target stress level
         * Exceptions: None
         **/
        function getLevel()
        {
            return $this->level;
        }//close getLevel

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
    }//close StressGoal
?>