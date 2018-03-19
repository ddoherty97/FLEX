<?php
    /**
     * StrengthGoal.php
     * This class allows the user to create strength goals
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/

    class StrengthGoal
    {
        private $numDays;       //number of days to acheive goal
        private $type;          //type of strength goal
        private $maxWeight;     //max weight to achieve for given type
        private $goalID;        //ID of strength goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the fitness goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $type->type of strength goal
         *              $maxWeight->max weight to achieve for given type
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $type, $maxWeight, $id)
        {
            $this->numDays = $numDays;
            $this->type = $type;
            $this->maxWeight = $maxWeight;
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
         * This method gets the strength goal type
         * Parameters: none
         * Returns: strength goal type
         * Exceptions: None
         **/
        function getType()
        {
            return $this->type;
        }//close getType

        /**
         * getMaxWeight()
         * This method gets the max weight for the specific goal type
         * Parameters: none
         * Returns: max weight for goal type
         * Exceptions: None
         **/
        function getMaxWeight()
        {
            return $this->maxWeight;
        }//close getMaxWeight

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