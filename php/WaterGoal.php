<?php
    /**
     * WaterGoal.php
     * This class allows the user to create daily water goals
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

     class WaterGoal
     {
        private $waterIntake;
        private $numDays;
        private $goalID;

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the dietary goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $intake->amount of ounces of water intake
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $intake, $id)
        {
            $this->numDays = $numDays;
            $this->waterIntake = $intake;
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
         * getWaterIntake()
         * This method gets the ounces of water to meet the goal
         * Parameters: none
         * Returns: number of ounces to acheive the goal
         * Exceptions: None
         **/
        function getWaterIntake()
        {
            return $this->waterIntake;
        }//close getWaterIntake

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
     }//close WaterGoal
?>