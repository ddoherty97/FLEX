<?php
	/**
     * Spiritual Entry (SpiritualEntry.php)
     * A spiritual entry object represents a row in the SPIRITUAL_DATA table which contains
     *      all the information for a single entry made using the Spiritual Tracking Module.
     *      It's purpose is to be used in the Spiritual Report Module as a concise way to
     *      represent a spiritual "event".
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
     **/

    class SpiritualEntry
    {
        private $entryID;           //ID of the spiritual entry in the database
        private $entryDate;         //date of spiritual entry
        private $activityTitle;     //title of spiritual activity
        private $activityLocation;  //location of spiritual activity
        private $activityDuration;  //duration of spiritual activity
        private $activityType;		//type of spiritual activity
        private $activityNotes;		//notes for spiritual activity
        private $entrySubmitted;    //submitted date of entry

         /**
         * __construct()
         * This method creates spiritual entry object with immutable attributes
         * Parameters:  $ID->ID of the spiritual entry in the database
         *              $date->date of spiritual entry
         *              $title->title of spiritual activity
         *              $location->location of spiritual activity
         *              $duration->duration of spiritual activity
		 *				$type-> type of spiritual activity
		 *				$notes->notes for spiritual activity  
         *              $submitted->submitted date of entry
         * Exceptions: none
         **/
        function __construct($ID, $date, $title, $location, $duration, $type, $notes, $submitted)
        {
            //if no notes provided
            if($notes == "")
            {
                $notes = "No Notes Provided";
            }//end if   
            
            //assign constructor params to member variables
            $this->entryID = $ID;
            $this->entryDate = $date;
            $this->activityTitle = $title;
            $this->activityLocation = $location;
            $this->activityDuration = $duration;
			$this->activityType = $type;
			$this->activityNotes = $notes;
            $this->entrySubmitted = $submitted;
        }//close constructor

        /**
         * getEntryID()
         * This method gets the ID of the spiritual entry in the database
         * Parameters:  none
         * Returns: ID of the spiritual entry in the database
         * Exceptions: none
         **/
        function getEntryID()
        {
            return $this->entryID;
        }//close getEntryID

        /**
         * getEntryDate()
         * This method gets the date of spiritual entry
         * Parameters:  none
         * Returns: date of spiritual entry
         * Exceptions: none
         **/
        function getEntryDate()
        {
            return $this->entryDate;
        }//close getEntryDate

        /**
         * getTitle()
         * This method gets the title of spiritual activity
         * Parameters:  none
         * Returns: title of spiritual activity
         * Exceptions: none
         **/
        function getTitle()
        {
            return $this->activityTitle;
        }//close getTitle

        /**
         * getLocation()
         * This method gets the location of spiritual activity
         * Parameters:  none
         * Returns: location of spiritual activity
         * Exceptions: none
         **/
        function getLocation()
        {
            return $this->activityLocation;
        }//close getLocation

        /**
         * getDuration()
         * This method gets the duration of spiritual activity
         * Parameters:  none
         * Returns: duration of spiritual activity
         * Exceptions: none
         **/
        function getDuration()
        {
            return $this->activityDuration;
        }//close getDuration
        
        /**
         * getType()
         * This method gets the type of spiritual activity
         * Parameters:  none
         * Returns: type of spiritual activity
         * Exceptions: none
         **/
        function getType()
        {
            return $this->activityType;
        }//close getType
        
        /**
         * getNotes()
         * This method gets the notes of spiritual activity
         * Parameters:  none
         * Returns: notes of spiritual activity
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
    }//close SpiritualEntry
?>