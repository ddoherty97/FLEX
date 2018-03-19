<?php
    /**
     * CalorieGoal.php
     * This class allows the user to create daily calorie intake goals
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

     class CalorieGoal
     {
        private $calIntake;
        private $numDays;
        private $goalID;

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the dietary goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $intake->amount of calories
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $intake, $id)
        {
            $this->numDays = $numDays;
            $this->calIntake = $intake;
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
         * getCalorieIntake()
         * This method gets the number of calories to meet the goal
         * Parameters: none
         * Returns: number of caloris to acheive the goal
         * Exceptions: None
         **/
        function getCalorieIntake()
        {
            return $this->calIntake;
        }//close getCalorieIntake

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
     }//close CalorieGoal
?>