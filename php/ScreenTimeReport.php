<?php
	/**
     * Screen Time Report (ScreenTimeReport.php)
     * A screen time report object represents all the screen time data available including all
     *      entries in the database, goals to complete, and completion progress of the goals
     * Author: Jaclyn Cuevas
     * Last Updated: 4/9/18 JC
     **/

    class ScreenTimeReport
    {
        private $screenTimeGoals;		//all screen time goals
        private $screenTimeProgress;	//completion progress of all screen time goals
        private $entries;           	//all screen time entries
        private $startDate;         	//start date of the report
        private $endDate;           	//end date of the report

        /**
         * __construct()
         * This method creates a screen time report with immutable attributes
         * Parameters:  $stGoalArray->all screen time goals
         *              $stProgressArray->completion progress of all screen time goals
         *              $entryArray->all screen time entries
         *              $startDate->start date of the report
         *              $endDate->end date of the report
         * Exceptions: none
         **/
        function __construct($stGoalArray, $stProgressArray, $entryArray, $startDate, $endDate)
        {
            //assign constructor params to member variables
            $this->screenTimeGoals = $stGoalArray;
            $this->screenTimeProgress = $stProgressArray;
            $this->entries = $entryArray;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }//close constructor

        /**
         * getScreenTimeGoals()
         * This method gets the active screen time goals
         * Parameters:  none
         * Returns: active screen time goals
         * Exceptions: none
         **/
        function getScreenTimeGoals()
        {
            return $this->screenTimeGoals;
        }//close getScreenTimeGoals

        /**
         * getScreenTimeProgresses()
         * This method gets the progress of all active screen time goals
         * Parameters:  none
         * Returns: progress of all active screen time goals
         * Exceptions: none
         **/
        function getScreenTimeProgresses()
        {
            return $this->screenTimeProgress;
        }//close getScreenTimeProgresses

        /**
         * getScreenTimeEntries()
         * This method gets all screen time entries between the report start date and end date
         * Parameters:  none
         * Returns: screen time entries between the report start date and end date
         * Exceptions: none
         **/
        function getScreenTimeEntries()
        {
            return $this->entries;
        }//close getScreenTimeEntries

        /**
         * getStartDate()
         * This method gets the start date of the screen time report
         * Parameters:  none
         * Returns: start date of the screen time report
         * Exceptions: none
         **/
        function getStartDate()
        {
            return $this->startDate;
        }//close getStartDate

        /**
         * getEndDate()
         * This method gets the end date of the screen time report
         * Parameters:  none
         * Returns: end date of the screen time report
         * Exceptions: none
         **/
        function getEndDate()
        {
            return $this->endDate;
        }//close getendDate
    }//close ScreenTimeReport
?>