<?php
	/**
     * Social Report (SocialReport.php)
     * A social report object represents all the social data available including all
     *      entries in the database, goals to complete, and completion progress of the goals
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
     **/

    class SocialReport
    {
        private $socialGoals;       //all social goals
        private $socialProgresses;  //completion progress of all social goals
        private $entries;           //all social entries
        private $startDate;         //start date of the report
        private $endDate;           //end date of the report

        /**
         * __construct()
         * This method creates a social report with immutable attributes
         * Parameters:  $socialGoalArray->all social goals
         *              $socialProgressArray->completion progress of all social goals
         *              $entryArray->all social entries
         *              $startDate->start date of the report
         *              $endDate->end date of the report
         * Exceptions: none
         **/
        function __construct($socialGoalArray, $socialProgressArray, $entryArray, $startDate, $endDate)
        {
            //assign constructor params to member variables
            $this->socialGoals = $socialGoalArray;
            $this->socialProgresses = $socialProgressArray;
            $this->entries = $entryArray;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }//close constructor

        /**
         * getSocialGoals()
         * This method gets the active social goals
         * Parameters:  none
         * Returns: active social goals
         * Exceptions: none
         **/
        function getSocialGoals()
        {
            return $this->socialGoals;
        }//close getSocialGoals

        /**
         * getSocialProgresses()
         * This method gets the progress of all active social goals
         * Parameters:  none
         * Returns: progress of all active social goals
         * Exceptions: none
         **/
        function getSocialProgresses()
        {
            return $this->socialProgresses;
        }//close getSocialProgresses

        /**
         * getSocialEntries()
         * This method gets all social entries between the report start date and end date
         * Parameters:  none
         * Returns: social entries between the report start date and end date
         * Exceptions: none
         **/
        function getSocialEntries()
        {
            return $this->entries;
        }//close getSocialEntries

        /**
         * getStartDate()
         * This method gets the start date of the social report
         * Parameters:  none
         * Returns: start date of the social report
         * Exceptions: none
         **/
        function getStartDate()
        {
            return $this->startDate;
        }//close getStartDate

        /**
         * getEndDate()
         * This method gets the end date of the social report
         * Parameters:  none
         * Returns: end date of the social report
         * Exceptions: none
         **/
        function getEndDate()
        {
            return $this->endDate;
        }//close getendDate
    }//close SocialReport
?>