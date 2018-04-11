<?php
	/**
     * Spiritual Report (SpiritualReport.php)
     * A spiritual report object represents all the spiritual data available including all
     *      entries in the database, goals to complete, and completion progress of the goals
     * Author: Jaclyn Cuevas
     * Last Updated: 4/11/18 JC
     **/

    class SpiritualReport
    {
        private $durationGoals;        	//all spiritual duration goals
        private $eventsGoals;        	//all spiritual event goals
        private $durationProgresses;   	//completion progress of all spiritual duration goals
        private $eventsProgresses;   	//completion progress of all spiritual events goals
        private $entries;           	//all spiritual entries
        private $startDate;         	//start date of the report
        private $endDate;           	//end date of the report

        /**
         * __construct()
         * This method creates a spiritual report with immutable attributes
         * Parameters:  $durationGoalArray->all spiritual duration goals
		 * 				$eventsGoalArray->all spiritual events goals
         *              $durationGoalProgressArray->completion progress of all spiritual duration goals
		 * 				$eventsGoalProgressArray->completion progress of all spiritual event goals
         *              $entryArray->all spiritual entries
         *              $startDate->start date of the report
         *              $endDate->end date of the report
         * Exceptions: none
         **/
        function __construct($durationGoalArray, $eventsGoalArray, $durationGoalProgressArray, $eventsGoalProgressArray, $entryArray, $startDate, $endDate)
        {
            //assign constructor params to member variables
            $this->durationGoals = $durationGoalArray;
			$this->eventsGoals = $eventsGoalArray;
            $this->durationProgresses = $durationGoalProgressArray;
			$this->eventsProgresses = $eventsGoalProgressArray;
            $this->entries = $entryArray;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }//close constructor

        /**
         * getDurationGoals()
         * This method gets the active spiritual duration goals
         * Parameters:  none
         * Returns: active spiritual duration goals
         * Exceptions: none
         **/
        function getDurationGoals()
        {
            return $this->durationGoals;
        }//close getDurationGoals
        
         /**
         * getEventGoals()
         * This method gets the active spiritual event goals
         * Parameters:  none
         * Returns: active spiritual event goals
         * Exceptions: none
         **/
        function getEventGoals()
        {
            return $this->eventsGoals;
        }//close getDurationGoals

        /**
         * getDurationProgresses()
         * This method gets the progress of all active spiritual duration goals
         * Parameters:  none
         * Returns: progress of all active spiritual duration goals
         * Exceptions: none
         **/
        function getDurationProgresses()
        {
            return $this->durationProgresses;
        }//close getDurationProgresses
        
        /**
         * getEventProgresses()
         * This method gets the progress of all active spiritual event goals
         * Parameters:  none
         * Returns: progress of all active spiritual event goals
         * Exceptions: none
         **/
        function getEventProgresses()
        {
            return $this->eventsProgresses;
        }//close getEventProgresses

        /**
         * getSpiritualEntries()
         * This method gets all spiritual entries between the report start date and end date
         * Parameters:  none
         * Returns: spiritual entries between the report start date and end date
         * Exceptions: none
         **/
        function getSpiritualEntries()
        {
            return $this->entries;
        }//close getSpiritualEntries

        /**
         * getStartDate()
         * This method gets the start date of the spiritual report
         * Parameters:  none
         * Returns: start date of the spiritual report
         * Exceptions: none
         **/
        function getStartDate()
        {
            return $this->startDate;
        }//close getStartDate

        /**
         * getEndDate()
         * This method gets the end date of the spiritual report
         * Parameters:  none
         * Returns: end date of the spiritual report
         * Exceptions: none
         **/
        function getEndDate()
        {
            return $this->endDate;
        }//close getendDate
    }//close SpiritualReport
?>