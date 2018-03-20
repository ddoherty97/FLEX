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
        private $minutes;       //number of minnutes to complete in alloted time
        private $type;          //social event type
        private $goalID;        //ID of social goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the social goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $minutes->number of minutes to complete in alloted time
         *              $type->social event type
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $minutes, $type, $id)
        {
            $this->numDays = $numDays;
            $this->minutes = $minutes;
            $this->type = $type;
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
         * This method gets the number of minutes for the goal type
         * Parameters: none
         * Returns: number of minutes for the social goal
         * Exceptions: None
         **/
        function getMinutes()
        {
            return $this->minutes;
        }//close getMinutes

        /**
         * getType()
         * This method gets the goal type
         * Parameters: none
         * Returns: social goal type
         * Exceptions: None
         **/
        function getType()
        {
            return $this->type;
        }//close getType

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