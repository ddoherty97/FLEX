<?php
	/**
     * Fitness Report (FitnessReport.php)
     * A fitness report object represents all the fitness data available including all
     *      entries in the database, goals to complete, and completion progress of the goals
     * Author: Jaclyn Cuevas
     * Last Updated: 4/11/18 JC
     **/

    class FitnessReport
    {
        private $cardioGoals;          	//all fitness cardio goals
        private $strengthGoals;        	//all fitness strength goals
        private $weightGoals;			//all fitness weight goals
        private $cardioProgresses;     	//completion progress of all cardio goals
        private $strengthProgresses;   	//completion progress of all strength goals
        private $weightProgresses;		//completion progress of all weight goals
        private $entries;           	//all fitness entries
        private $startDate;         	//start date of the report
        private $endDate;           	//end date of the report

        /**
         * __construct()
         * This method creates a fitness report with immutable attributes
         * Parameters:  $cardioGoalArray->all cardio goals
         *              $strengthGoalArray->all strength goals
		 * 				$weightGoalArray->all weight goals
         *              $cardioProgressArray->completion progress of all cardio goals
         *              $strengthProgressArray->completion progress of all strength goals
		 * 				$weightProgressArray->completion progress of all weight goals
         *              $entryArray->all fitness entries
         *              $startDate->start date of the report
         *              $endDate->end date of the report
         * Exceptions: none
         **/
        function __construct($cardioGoalArray, $strengthGoalArray, $weightGoalArray, $cardioProgressArray, $strengthProgressArray, $weightProgressArray, $entryArray, $startDate, $endDate)
        {
            //assign constructor params to member variables
            $this->cardioGoals = $cardioGoalArray;
            $this->strengthGoals = $strengthGoalArray;
            $this->weightGoals = $weightGoalArray;
            $this->cardioProgresses = $cardioProgressArray;
			$this->strengthProgresses = $strengthProgressArray;
			$this->weightProgresses = $weightProgressArray;
            $this->entries = $entryArray;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }//close constructor

        /**
         * getCardioGoals()
         * This method gets the active cardio goals
         * Parameters:  none
         * Returns: active cardio goals
         * Exceptions: none
         **/
        function getCardioGoals()
        {
            return $this->cardioGoals;
        }//close getCardioGoals

        /**
         * getStrengthGoals()
         * This method gets the active strength goals
         * Parameters:  none
         * Returns: active strength goals
         * Exceptions: none
         **/
        function getStrengthGoals()
        {
            return $this->strengthGoals;
        }//close getStrengthGoals
        
        /**
         * getWeightGoals()
         * This method gets the active weight goals
         * Parameters:  none
         * Returns: active weight goals
         * Exceptions: none
         **/
        function getWeightGoals()
        {
            return $this->weightGoals;
        }//close getWeightGoals
        
        /**
         * getCardioProgresses()
         * This method gets the progress of all active cardio goals
         * Parameters:  none
         * Returns: progress of all active cardio goals
         * Exceptions: none
         **/
        function getCardioProgresses()
        {
            return $this->cardioProgresses;
        }//close getCardioProgresses
        
        /**
         * getStrengthProgresses()
         * This method gets the progress of all active strength goals
         * Parameters:  none
         * Returns: progress of all active strength goals
         * Exceptions: none
         **/
        function getStrengthProgresses()
        {
            return $this->strengthProgresses;
        }//close getStrengthProgresses
        
        /**
         * getWeightProgresses()
         * This method gets the progress of all active weight goals
         * Parameters:  none
         * Returns: progress of all active weight goals
         * Exceptions: none
         **/
        function getWeightProgresses()
        {
            return $this->weightProgresses;
        }//close getWeightProgresses

        /**
         * getFitnessEntries()
         * This method gets all fitness entries between the report start date and end date
         * Parameters:  none
         * Returns: fitness entries between the report start date and end date
         * Exceptions: none
         **/
        function getFitnessEntries()
        {
            return $this->entries;
        }//close getFitnessEntries

        /**
         * getStartDate()
         * This method gets the start date of the fitness report
         * Parameters:  none
         * Returns: start date of the fitness report
         * Exceptions: none
         **/
        function getStartDate()
        {
            return $this->startDate;
        }//close getStartDate

        /**
         * getEndDate()
         * This method gets the end date of the fitness report
         * Parameters:  none
         * Returns: end date of the fitness report
         * Exceptions: none
         **/
        function getEndDate()
        {
            return $this->endDate;
        }//close getendDate
    }//close FitnessReport
?>