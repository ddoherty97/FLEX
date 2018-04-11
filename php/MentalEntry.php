<?php
	/**
     * Mental Entry (MentalEntry.php)
     * A mental entry object represents a row in the MENTAL_DATA table which contains
     *      all the information for a single entry made using the Mental Tracking Module.
     *      It's purpose is to be used in the Mental Report Module as a concise way to
     *      represent a mental "event".
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
     **/

    class MentalEntry
    {
        private $entryID;           	//ID of the mental entry in the database
        private $entryDate;         	//date of mental entry
        private $counselingDuration;	//time spent at counseling session
        private $counselingType;		//type of counseling attended
		private $counselingNotes;		//notes for counseling session
        private $stressLevel;       	//stress level of user
        private $stressFactors;			//factors contributing to stress
        private $entrySubmitted;    	//submitted date of entry

         /**
         * __construct()
         * This method creates mental entry object with immutable attributes
         * Parameters:  $ID->ID of the mental entry in the database
         *              $date->date of mental entry
         *              $duration->duration of counseling session
         *              $type->type of counseling session
         *              $notes->notes for counseling session
		 * 				$level->stress level
		 *				$factors->stress factors 
         *              $submitted->submitted date of entry
         * Exceptions: none
         **/
        function __construct($ID, $date, $duration, $type, $notes, $level, $factors, $submitted)
        {
            //if no duration provided
            if($duration == "")
            {
                $duration = "0";
            }//end if

            //if no type provided
            if($type == "")
            {
                //assign new title
                $type = "Only Stress Level Provided";
            }//end if

            //if no notes provided
            if($notes == "")
            {
                $notes = "No Notes Provided";
            }//end if    
            
             //if no stress level provided
            if($level == "")
            {
                $level = 0;
            }//end if      
            
             //if no stress factors provided
            if($factors == "")
            {
                $factors = "No Stress Factors Provided";
            }//end if    
            
            //assign constructor params to member variables
            $this->entryID = $ID;
            $this->entryDate = $date;
            $this->counselingDuration = $duration;
            $this->counselingType = $type;
            $this->counselingNotes = $notes;
			$this->stressLevel = $level;
			$this->stressFactors = $factors;
            $this->entrySubmitted = $submitted;
        }//close constructor

        /**
         * getEntryID()
         * This method gets the ID of the mental entry in the database
         * Parameters:  none
         * Returns: ID of the mental entry in the database
         * Exceptions: none
         **/
        function getEntryID()
        {
            return $this->entryID;
        }//close getEntryID

        /**
         * getEntryDate()
         * This method gets the date of mental entry
         * Parameters:  none
         * Returns: date of mental entry
         * Exceptions: none
         **/
        function getEntryDate()
        {
            return $this->entryDate;
        }//close getEntryDate

        /**
         * getDuration()
         * This method gets the duration of the counseling session
         * Parameters:  none
         * Returns: duration of counseling session
         * Exceptions: none
         **/
        function getDuration()
        {
            return $this->counselingDuration;
        }//close getDuration

        /**
         * getType()
         * This method gets the type of counseling session
         * Parameters:  none
         * Returns: type of counseling session
         * Exceptions: none
         **/
        function getType()
        {
            return $this->counselingType;
        }//close getType

        /**
         * getNotes()
         * This method gets the notes on the counseling session
         * Parameters:  none
         * Returns: notes on counseling session
         * Exceptions: none
         **/
        function getNotes()
        {
            return $this->counselingNotes;
        }//close getNotes
        
         /**
         * getLevel()
         * This method gets the stress level
         * Parameters:  none
         * Returns: stress level
         * Exceptions: none
         **/
        function getLevel()
        {
            return $this->stressLevel;
        }//close getLevel
        
         /**
         * getFactors()
         * This method gets the factors for the stress level
         * Parameters:  none
         * Returns: factors for stress level
         * Exceptions: none
         **/
        function getFactors()
        {
            return $this->stressFactors;
        }//close getFactors

        /**
         * getTimestamp()
         * This method gets the submitted date of entry
         * Parameters:  none
         * Returns: submitted date of entry
         * Exceptions: none
         **/
        function getTimestamp()
        {
            return $this->entrySubmitted;
        }//close getTimestamp
    }//close MentalEntry
?>