<?php
    /**
     * CardioGoal.php
     * This class allows the user to create cardio goals
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    class CardioGoal
    {
        private $numDays;       //number of days to acheive goal
        private $type;          //type of cardio goal
        private $milestone;     //milestone to achieve for given goal type
        private $goalID;        //ID of cardio goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the fitness goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $type->type of cardio goal
         *              $milestone->milestone to achieve for given goal type
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $type, $milestone, $id)
        {
            $this->numDays = $numDays;
            $this->type = $type;
            $this->milestone = $milestone;
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
         * getType()
         * This method gets the cardio goal type
         * Parameters: none
         * Returns: cardio goal type
         * Exceptions: None
         **/
        function getType()
        {
            return $this->type;
        }//close getType

        /**
         * getMilestone()
         * This method gets the specific milestone for the goal type
         * Parameters: none
         * Returns: milestone for goal type
         * Exceptions: None
         **/
        function getMilestone()
        {
            return $this->milestone;
        }//close getMilestone

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
    }//close CardioGoal
?>