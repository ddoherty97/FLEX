<?php
	/**
     * Fitness Entry (FitnessEntry.php)
     * A fitness entry object represents a row in the FITNESS_DATA table which contains
     *      all the information for a single entry made using the Fitness Tracking Module.
     *      It's purpose is to be used in the Fitness Report Module as a concise way to
     *      represent a fitness "event".
     * Author: Jaclyn Cuevas
     * Last Updated: 4/11/18 JC
     **/

    class FitnessEntry
    {
        private $entryID;           //ID of the fitness entry in the database
        private $entryDate;         //date of fitness entry
        private $activityDuration;  //duration of fitness activity
        private $activityMilestone;	//fitness activity milestone
        private $activityType;      //type of fitness activity
        private $activityNotes;		//notes for fitness activity
        private $entrySubmitted;    //submitted date of entry

         /**
         * __construct()
         * This method creates dietary entry object with immutable attributes
         * Parameters:  $ID->ID of the dietary entry in the database
         *              $date->date of fitness entry
         *              $duration->duration of fitness activity
         *              $milestone->fitness activity milestone
         *              $type->type of fitness activity
		 *				$notes->notes for fitness activity 
         *              $submitted->submitted date of entry
         * Exceptions: none
         **/
        function __construct($ID, $date, $duration, $milestone, $type, $notes, $submitted)
        {
            //if no calories provided
            if($notes == "")
            {
                $notes = "No Notes Provided";
            }//end if

            //assign constructor params to member variables
            $this->entryID = $ID;
            $this->entryDate = $date;
            $this->activityDuration = $duration;
            $this->activityMilestone = $milestone;
            $this->activityType = $type;
			$this->activityNotes = $notes;
            $this->entrySubmitted = $submitted;
        }//close constructor

        /**
         * getEntryID()
         * This method gets the ID of the fitness entry in the database
         * Parameters:  none
         * Returns: ID of the fitness entry in the database
         * Exceptions: none
         **/
        function getEntryID()
        {
            return $this->entryID;
        }//close getEntryID

        /**
         * getEntryDate()
         * This method gets the date of fitness entry
         * Parameters:  none
         * Returns: date of fitness entry
         * Exceptions: none
         **/
        function getEntryDate()
        {
            return $this->entryDate;
        }//close getEntryDate

        /**
         * getDuration()
         * This method gets the duration of the fitness activity
         * Parameters:  none
         * Returns: duration of fitness activity
         * Exceptions: none
         **/
        function getDuration()
        {
            return $this->activityDuration;
        }//close getDuration

        /**
         * getMilestone()
         * This method gets the fitness activity milestone
         * Parameters:  none
         * Returns: fitness activity milestone
         * Exceptions: none
         **/
        function getMilestone()
        {
            return $this->activityMilestone;
        }//close getMilestone

        /**
         * getType()
         * This method gets the type of fitness activity
         * Parameters:  none
         * Returns: type of fitness activity
         * Exceptions: none
         **/
        function getType()
        {
            return $this->activityType;
        }//close getType
        
          /**
         * getNotes()
         * This method gets the notes of fitness activity
         * Parameters:  none
         * Returns: notes of fitness activity
         * Exceptions: none
         **/
        function getNotes()
        {
            return $this->activityNotes;
        }//close getNotes

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
    }//close FitnessEntry
?>