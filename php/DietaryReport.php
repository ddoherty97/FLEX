<?php
	/**
     * Dietary Report (DietaryReport.php)
     * A dietary report object represents all the dietary data available including all
     *      entries in the database, goals to complete, and completion progress of the goals
     * Author: Davis Doherty
     * Last Updated: 4/7/18 DD
     **/

    class DietaryReport
    {
        private $goals;         //all dietary goals
        private $progresses;    //completion progress of all the goals
        private $entries;       //all dietary entries
        private $startDate;     //start date of the report
        private $endDate;       //end date of the report

        /**
         * __construct()
         * This method creates a dietary report with immutable attributes
         * Parameters:  $goalArray->all dietary goals
         *              $progressArray->completion progress of all the goals
         *              $entryArray->all dietary entries
         *              $startDate->start date of the report
         *              $endDate->end date of the report
         * Exceptions: none
         **/
        function __construct($goalArray, $progressArray, $entryArray, $startDate, $endDate)
        {
            //assign constructor params to member variables
            $this->goals = $goalArray;
            $this->progresses = $progressArray;
            $this->entries = $entryArray;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }//close constructor

        /**
         * getGoals()
         * This method gets the active dietary goals
         * Parameters:  none
         * Returns: active dietary goals
         * Exceptions: none
         **/
        function getGoals()
        {
            return $this->goals;
        }//close getGoals

        /**
         * getGoalProgresses()
         * This method gets the progress of all active dietary goals
         * Parameters:  none
         * Returns: progress of all active dietary goals
         * Exceptions: none
         **/
        function getProgresses()
        {
            return $this->progresses;
        }//close getProgresses

        /**
         * getDietaryEntries()
         * This method gets all dietary entries between the report start date and end date
         * Parameters:  none
         * Returns: dietary entries between the report start date and end date
         * Exceptions: none
         **/
        function getDietaryEntries()
        {
            return $this->entries;
        }//close getDietaryEntries

        /**
         * getStartDate()
         * This method gets the start date of the dietary report
         * Parameters:  none
         * Returns: start date of the dietary report
         * Exceptions: none
         **/
        function getStartDate()
        {
            return $this->startDate;
        }//close getStartDate

        /**
         * getEndDate()
         * This method gets the end date of the dietary report
         * Parameters:  none
         * Returns: end date of the dietary report
         * Exceptions: none
         **/
        function getEndDate()
        {
            return $this->endDate;
        }//close getendDate
    }//close DietaryReport
?>