<?php
    /**
     * WeightGoal.php
     * This class allows the user to create goals based on their personal and desired fitness level
     * Author: Davis Doherty
     * Last Updated: 3/18/18 DD
     **/

     class WeightGoal
     {
        private $numDays;   //number of days to acheive goal
        private $weight;    //target weight to acheive
        private $goalID;    //id of goal in database
        
        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the fitness goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $weight->target weight to acheive
         * Exceptions: none
         **/
        function __construct($numDays, $weight, $id)
        {
            $this->numDays = $numDays;
            $this->weight = $weight;
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
         * getWeight()
         * This method gets the target weight to reach
         * Parameters: none
         * Returns: target weight of goal
         * Exceptions: None
         **/
        function getWeight()
        {
            return $this->weight;
        }//close getWeight

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
     }//close WeightGoal
?>