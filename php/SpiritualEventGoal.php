<?php
    /**
     * SpiritualEventGoal.php
     * This class allows the user to create spiritual event goals
     * Author: Davis Doherty
     * Last Updated: 3/20/18 DD
     **/

    class SpiritualEventGoal
    {
        private $numDays;       //number of days to acheive goal
        private $events;        //number of events to attend to acheive goal
        private $goalID;        //ID of spiritual goal in database

        /**
         * __construct()
         * This method initializes the parameters of the goal into the object
         *      and the spiritual goal module
         * Parameters:  $numDays->number of days to acheive goal
         *              $events->number of events to attend to acheive goal
         *              $id->ID of goal in database
         * Exceptions: none
         **/
        function __construct($numDays, $events, $id)
        {
            $this->numDays = $numDays;
            $this->events = $events;
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
         * getEvents()
         * This method gets the number of events to reach the goal
         * Parameters: none
         * Returns: number of events to reach the goal
         * Exceptions: None
         **/
        function getEvents()
        {
            return $this->events;
        }//close getEvents

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
    }//close SpiritualEventGoal
?>