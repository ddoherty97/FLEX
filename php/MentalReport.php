<?php
	/**
     * Mental Report (MentalReport.php)
     * A mental report object represents all the mental data available including all
     *      entries in the database, goals to complete, and completion progress of the goals
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
     **/

    class MentalReport
    {
        private $counselingGoals;		//counseling goals
        private $stressGoals;        	//stress goals
        private $counselingProgresses;	//completion progress of all counseling goals
        private $stressProgresses;		//completion progress of all stress goals
        private $entries;           	//all mental entries
        private $startDate;         	//start date of the report
        private $endDate;           	//end date of the report

        /**
         * __construct()
         * This method creates a mental report with immutable attributes
         * Parameters:  $counselingGoalArray->all counseling goals
         *              $stressGoalArray->all stress goals
         *              $counselingProgressArray->completion progress of all counseling goals
         *              $stressProgressArray->completion progress of all stress goals
         *              $entryArray->all mental entries
         *              $startDate->start date of the report
         *              $endDate->end date of the report
         * Exceptions: none
         **/
        function __construct($counselingGoalArray, $stressGoalArray, $counselingProgressArray, $stressProgressArray, $entryArray, $startDate, $endDate)
        {
            //assign constructor params to member variables
            $this->counselingGoals = $counselingGoalArray;
            $this->stressGoals = $stressGoalArray;
            $this->counselingProgresses = $counselingProgressArray;
            $this->stressProgresses = $stressProgressArray;
            $this->entries = $entryArray;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }//close constructor

        /**
         * getCounselingGoals()
         * This method gets the active counseling goals
         * Parameters:  none
         * Returns: active counseling goals
         * Exceptions: none
         **/
        function getCounselingGoals()
        {
            return $this->counselingGoals;
        }//close getCounselingGoals

        /**
         * getStressGoals()
         * This method gets the active stress level goals
         * Parameters:  none
         * Returns: active stress level goals
         * Exceptions: none
         **/
        function getStressGoals()
        {
            return $this->stressGoals;
        }//close getStressGoals

        /**
         * getCounselingProgresses()
         * This method gets the progress of all active counseling goals
         * Parameters:  none
         * Returns: progress of all active counseling goals
         * Exceptions: none
         **/
        function getCounselingProgresses()
        {
            return $this->counselingProgresses;
        }//close getCounselingProgresses

        /**
         * getStressProgresses()
         * This method gets the progress of all active stress level goals
         * Parameters:  none
         * Returns: progress of all active stress level goals
         * Exceptions: none
         **/
        function getStressProgresses()
        {
            return $this->stressProgresses;
        }//close getStressProgresses

        /**
         * getMentalEntries()
         * This method gets all mental entries between the report start date and end date
         * Parameters:  none
         * Returns: mental entries between the report start date and end date
         * Exceptions: none
         **/
        function getMentalEntries()
        {
            return $this->entries;
        }//close getMentalEntries

        /**
         * getStartDate()
         * This method gets the start date of the mental report
         * Parameters:  none
         * Returns: start date of the mental report
         * Exceptions: none
         **/
        function getStartDate()
        {
            return $this->startDate;
        }//close getStartDate

        /**
         * getEndDate()
         * This method gets the end date of the mental report
         * Parameters:  none
         * Returns: end date of the mental report
         * Exceptions: none
         **/
        function getEndDate()
        {
            return $this->endDate;
        }//close getendDate
    }//close MentalReport
?>